<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 0.5                                                  |
  | http://www.issabel.org                                               |
  +----------------------------------------------------------------------+
  | Copyright (c) 2018 Issabel Foundation                                |
  | Copyright (c) 2006 Palosanto Solutions S. A.                         |
  +----------------------------------------------------------------------+
  | The contents of this file are subject to the General Public License  |
  | (GPL) Version 2 (the "License"); you may not use this file except in |
  | compliance with the License. You may obtain a copy of the License at |
  | http://www.opensource.org/licenses/gpl-license.php                   |
  |                                                                      |
  | Software distributed under the License is distributed on an "AS IS"  |
  | basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See  |
  | the License for the specific language governing rights and           |
  | limitations under the License.                                       |
  +----------------------------------------------------------------------+
  | The Initial Developer of the Original Code is PaloSanto Solutions    |
  +----------------------------------------------------------------------+
*/
if (file_exists('/usr/share/php/php-simplepie/autoloader.php'))
    require_once 'php-simplepie/autoloader.php';
else
    require_once 'php-simplepie/simplepie.inc';

class Applet_News
{
	function handleJSON_getContent($smarty, $module_name, $appletlist)
    {
        /* Se cierra la sesión para quitar el candado sobre la sesión y permitir
         * que otras operaciones ajax puedan funcionar. */
	    $infoRSS = new SimplePie();
        session_commit();

        global $arrConf;
        $pDB = new paloDB($arrConf['issabel_dsn']['settings']);
        $channel=get_key_settings($pDB,'issabel_news_channel');
        if($channel=='') {
            set_key_settings($pDB,'issabel_news_channel','https://cloud.issabel.org/news.php');
            $channel='https://cloud.issabel.org/news.php';
        }

        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );

        $lang=get_language();
        $cachedir = '/tmp/rss-cache';
        if($lang=="es")$infoRSS->set_feed_url("$channel?lang=es");
        else $infoRSS->set_feed_url("$channel?lang=en");
        $infoRSS->enable_order_by_date(TRUE);
        $infoRSS->set_output_encoding('UTF-8');
        $infoRSS->enable_cache(TRUE);
        $infoRSS->set_cache_location($cachedir);
        if (!is_dir($cachedir) && ! @mkdir($cachedir)) {
            $infoRSS->enable_cache(FALSE);
        }
        $infoRSS->init();
        $infoRSS->handle_content_type(); //This method ensures that the SimplePie-enabled page is being served with the correct mime-type and character encoding HTTP headers

        if (strpos($infoRSS->error(), 'HTTP Error: connection failed') !== FALSE) {
            $respuesta['status'] = 'error';
            $respuesta['message'] = _tr('Could not get web server information. You may not have internet access or the web server is down');
        } else {
            $news = array();

            // Formato de fecha y hora
            foreach ($infoRSS->get_items() as $item) {
                $news[] = array(
                    'title'       =>  $item->get_title(),
                    'link'        =>  $item->get_link(),
                    'date_format' =>  date('Y.m.d', $item->get_date('U')),
                );
            }

            $smarty->assign(array(
                'WEBSITE'   =>  'http://www.issabel.com',
                'NO_NEWS'   =>  _tr('No News to display'),
                'NEWS_LIST' =>  array_slice($news, 0, 7),
            ));
            $local_templates_dir = dirname($_SERVER['SCRIPT_FILENAME'])."/modules/$module_name/applets/News/tpl";
            $respuesta['html'] = $smarty->fetch("$local_templates_dir/rssfeed.tpl");
        }

        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }
}
