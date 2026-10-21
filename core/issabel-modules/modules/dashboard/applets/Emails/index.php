<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 0.5                                                  |
  | http://www.issabel.org                                               |
  +----------------------------------------------------------------------+
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
  $Id: index.php,v 1.1 2007/01/09 23:49:36 alex Exp $
*/
require_once "modules/{$module_name}/applets/System/index.php";

define('MAX_EMAIL_RECORDS', 8);

class Applet_Emails extends Applet_System
{
    protected function leerInformacionImap($smarty, $module_name, $imap, &$respuesta)
    {
        $smarty->assign(array(
            'NO_EMAILS' =>  _tr("You don't recibed emails"),
        ));

        $mails = array();
        $tmp = imap_check($imap);
        if ($tmp->Nmsgs > 0) {
        	$result = imap_fetch_overview($imap, "1:{$tmp->Nmsgs}", 0);
            foreach ($result as $overview) {
                if (!($overview->seen || $overview->answered)) {
                	$mails[] = array(
                        'seen'      =>  $overview->seen,
                        'recent'    =>  $overview->recent,
                        'answered'  =>  $overview->answered,
                        'date'      =>  $overview->date,
                        'from'      =>  $overview->from,
                        'subject'   =>  $overview->subject
                    );
                }
            }
            $mails = array_reverse(array_slice($mails, -1 * MAX_EMAIL_RECORDS, MAX_EMAIL_RECORDS));
        }

        $smarty->assign('mails', $mails);
        $local_templates_dir = dirname($_SERVER['SCRIPT_FILENAME'])."/modules/$module_name/applets/Emails/tpl";
        $respuesta['html'] = $smarty->fetch("$local_templates_dir/emails.tpl");
    }

}

?>