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
  $Id: index.php,v 1.1.1.1 2007/07/06 21:31:56 gcarrillo Exp $ */

function _moduleContent(&$smarty, $module_name)
{
    require_once "libs/paloSantoDB.class.php";
    require_once "libs/paloSantoForm.class.php";
    require_once "modules/$module_name/configs/default.conf.php";

    load_language_module($module_name);

    //global variables
    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf,$arrConfModule);

    //folder path for custom templates
    $base_dir = dirname($_SERVER['SCRIPT_FILENAME']);
    $templates_dir = (isset($arrConf['templates_dir']))?$arrConf['templates_dir']:'themes';
    $local_templates_dir = "$base_dir/modules/$module_name/".$templates_dir.'/'.$arrConf['theme'];

    $languages = load_available_languages();

    //si no me puedo conectar a la base de datos
//       debo presentar un mensaje en vez del boton cambiar
//       un
    $arrForm  = array(
        "language"  => array(
            "LABEL"                  => _tr("Select language"),
            "REQUIRED"               => "yes",
            "INPUT_TYPE"             => "SELECT",
            "INPUT_EXTRA_PARAM"      => $languages,
            "VALIDATION_TYPE"        => "text",
            "VALIDATION_EXTRA_PARAM" => ""
        ),
    );
    $oForm = new paloForm($smarty, $arrForm);
    $pDB = new paloDB($arrConf['issabel_dsn']['settings']);
    if (!empty($pDB->errMsg)) {
        $smarty->assign(array(
            'mb_title'      =>  _tr('Error'),
            'mb_message'    =>  _tr("You can't change language").': '.$pDB->errMsg,
        ));
        return '';
    }

    if (isset($_POST['save_language'])) {
        if (!isset($languages[$_POST['language']])) {
            $smarty->assign(array(
                'mb_title'      =>  _tr('Error'),
                'mb_message'    =>  _tr('Unsupported language'),
            ));
        } else {
            // guardar el nuevo valor
            $bExito = set_key_settings($pDB, 'language', $_POST['language']);
			if ($_POST['language']=='fa'){
				set_them_languages();
			}else{
				set_them_languages(0);
			}
            if (!$bExito) {
                $smarty->assign(array(
                    'mb_title'      =>  _tr('Error'),
                    'mb_message'    =>  $pDB->errMsg,
                ));
            } else {
                // Refrescar para que tome efecto el nuevo idioma
                Header('Location: ?menu='.$module_name);
                return '';
            }
        }
    }

    $_POST['language'] = get_key_settings($pDB, 'language');
    if (empty($_POST['language'])) $_POST['language'] = "en";

    $smarty->assign("CAMBIAR", _tr("Save"));
    $smarty->assign("icon","modules/$module_name/images/system_preferencies_language.png");
    return $oForm->fetchForm("$local_templates_dir/language.tpl", _tr("Language"), $_POST);
}

function load_available_languages()
{
    require "configs/languages.conf.php";

    ksort($languages);
    return $languages;
}


function set_them_languages($isfarsi=1)
{
    $dbfile="../../../db/settings.db";
	$dbfile="/var/www/db/settings.db";
	$sqlstr = "Update settings set value = 'tenant' where key = 'theme'";
	$db = new SQLite3($dbfile);
	if ($isfarsi==1){
	$sqlstr = "Update settings set value = 'vitenant' where key = 'theme'";
	}
	$results = $db->query($sqlstr);
}