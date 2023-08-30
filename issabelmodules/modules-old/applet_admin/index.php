<?php
  /* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 4.0.0-7                                               |
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
  $Id: index.php,v 1.1 2009-12-28 06:12:49 Bruno bomv.27 Exp $ */
//include issabel framework
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoForm.class.php";

function _moduleContent(&$smarty, $module_name)
{
    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoAppletAdmin.class.php";

    load_language_module($module_name);

    //global variables
    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf,$arrConfModule);

    //folder path for custom templates
    $base_dir=dirname($_SERVER['SCRIPT_FILENAME']);
    $templates_dir=(isset($arrConf['templates_dir']))?$arrConf['templates_dir']:'themes';
    $local_templates_dir="$base_dir/modules/$module_name/".$templates_dir.'/'.$arrConf['theme'];

    //actions
    $action = getAction();
    $content = "";

    switch($action){
        case "save_new":
            $content = saveApplets_Admin($module_name);
            break;
        default: // view_form
            $content = showApplets_Admin($module_name);
            break;
    }
    return $content;
}

function showApplets_Admin($module_name)
{
    global $smarty;
    global $arrConf;

    $pAppletAdmin = new paloSantoAppletAdmin();
    $oForm = new paloForm($smarty,array());

    $arrApplets = $pAppletAdmin->getApplets_User($_SESSION["issabel_user"]);

    //Codigo para tomar en cuenta el nombre de applets para los archivos de idioma
    foreach($arrApplets as &$applet){
      $applet['name']=_tr($applet['name']);
    }
    unset($applet);
    //

    $smarty->assign("applets",$arrApplets);
    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("Applet", _tr("Applet"));
    $smarty->assign("Activated", _tr("Activated"));
    $smarty->assign("checkall", _tr("Check All"));
    $smarty->assign("icon", "modules/$module_name/images/system_dashboard_applet_admin.png");

    //folder path for custom templates
    $base_dir=dirname($_SERVER['SCRIPT_FILENAME']);
    $templates_dir=(isset($arrConf['templates_dir']))?$arrConf['templates_dir']:'themes';
    $local_templates_dir="$base_dir/modules/$module_name/".$templates_dir.'/'.$arrConf['theme'];
    $htmlForm = $oForm->fetchForm("$local_templates_dir/applet_admin.tpl",_tr("Dashboard Applet Admin"), $_POST);
    $content = "<form  method='POST' style='margin-bottom:0;' action='?menu=$module_name'>".$htmlForm."</form>";

    return $content;
}

function saveApplets_Admin($module_name)
{
    global $smarty;
    $arrIDs_DAU = null;

    if(is_array($_POST) & count($_POST)>0){
        foreach($_POST as $key => $value){
            if(substr($key,0,7) == "chkdau_")
                $arrIDs_DAU[] = substr($key,7);
        }
    }

    $pAppletAdmin = new paloSantoAppletAdmin();
    if(count($arrIDs_DAU)==0){
        $smarty->assign("mb_title", _tr("ERROR"));
        $smarty->assign("mb_message", _tr("You must have at least one applet activated"));
    }
    else{
        $ok = $pAppletAdmin->setApplets_User($arrIDs_DAU, $_SESSION["issabel_user"]);
        if(!$ok){
            $smarty->assign("mb_title", _tr("Validation Error"));
            $smarty->assign("mb_message", $pAppletAdmin->errMsg);
        }
    }
    return showApplets_Admin($module_name);
}

function getAction()
{
    if(getParameter("save_new")) //Get parameter by POST (submit)
        return "save_new";
    else
        return "report"; //cancel
}
?>
