<?php
  /* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 2.4.0-9                                               |
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
  $Id: index.php,v 1.1 2013-08-12 04:08:50 Jose Briones jbriones@elastix.com Exp $ */
//include issabel framework
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoForm.class.php";

function _moduleContent(&$smarty, $module_name)
{
    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoSoftphones.class.php";

    $base_dir=dirname($_SERVER['SCRIPT_FILENAME']);

    load_language_module($module_name);

    //global variables
    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf,$arrConfModule);

    //folder path for custom templates
    $templates_dir=(isset($arrConf['templates_dir']))?$arrConf['templates_dir']:'themes';
    $local_templates_dir="$base_dir/modules/$module_name/".$templates_dir.'/'.$arrConf['theme'];

    $content = "";

    switch($action){
        default: // view_form
            $content = viewFormSoftphones($smarty, $module_name, $local_templates_dir, $arrConf);
            break;
    }
    return $content;
}

function viewFormSoftphones($smarty, $module_name, $local_templates_dir, $arrConf)
{
    $smarty->assign("icon",  "modules/$module_name/images/softphones.png");
    $smarty->assign("xlite_img",  "modules/$module_name/images/x-lite-4-lrg.png");
    $smarty->assign("zoiper_img",  "modules/$module_name/images/zoiper.png");
    $smarty->assign("tag_manuf_description", _tr("Developer Description"));
    $smarty->assign("download_link", _tr("Download Link"));
    $smarty->assign("tag_manufacturer", _tr("Developer"));



    $smarty->assign("training_description", _tr("training_description"));
    $smarty->assign("training_img",  "modules/$module_name/images/training.png");
    $smarty->assign("forum_img",  "modules/$module_name/images/forum.png");
    $smarty->assign("telegram_img",  "modules/$module_name/images/telegram.png");



    $smarty->assign("xlite_software_description", _tr("xlite_software_description"));
    $smarty->assign("xlite_manufacturer_description", _tr("xlite_manufacturer_description"));
    $smarty->assign("zoiper_software_description", _tr("zoiper_software_description"));
    $smarty->assign("zoiper_manufacturer_description", _tr("zoiper_manufacturer_description"));

    $oForm    = new paloForm($smarty,array());
    $content  = $oForm->fetchForm("$local_templates_dir/form.tpl",_tr("Softphones"), array());

    return $content;
}
?>
