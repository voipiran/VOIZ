<?php
  /* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 4.0.4-18                                               |
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
  $Id: index.php,v 1.1 2011-04-25 09:04:41 Eduardo Cueva ecueva@palosanto.com Exp $ */
//include issabel framework
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoForm.class.php";
include_once "libs/paloSantoConfig.class.php";
require_once "libs/misc.lib.php";

function _moduleContent(&$smarty, $module_name)
{
    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoMissedCalls.class.php";

    $base_dir=dirname($_SERVER['SCRIPT_FILENAME']);

    load_language_module($module_name);

    //global variables
    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf,$arrConfModule);

    //folder path for custom templates
    $templates_dir=(isset($arrConf['templates_dir']))?$arrConf['templates_dir']:'themes';
    $local_templates_dir="$base_dir/modules/$module_name/".$templates_dir.'/'.$arrConf['theme'];

    //conexion resource
    // DSN para consulta de cdrs
    $dsn = generarDSNSistema('asteriskuser', 'asteriskcdrdb');
    $pDB = new paloDB($dsn);

    $pDBACL = new paloDB($arrConf['issabel_dsn']['acl']);
    if (!empty($pDBACL->errMsg)) {
        return "ERROR DE DB: $pDBACL->errMsg";
    }
    $pACL = new paloACL($pDBACL);
    if (!empty($pACL->errMsg)) {
        return "ERROR DE ACL: $pACL->errMsg";
    }

    //actions
    $action = getAction();
    $content = "";

    // Para usuarios que no son administradores, se restringe a los CDR de la
    // propia extensión. Cuidado con no-admin que no tiene extensión.
    $viewany = $pACL->hasModulePrivilege($_SESSION['issabel_user'],
        $module_name, 'viewany');
    $sExtension = $viewany ? '' : $pACL->getUserExtension($_SESSION['issabel_user']);
    $sExtension = trim("$sExtension");
    if (!$viewany && $sExtension == '') {
        return _tr('No extension for missed calls. Contact your administrator.');
    }

    switch($action) {
    default:
        $content = reportMissedCalls($smarty, $module_name, $local_templates_dir, $pDB, $sExtension);
        break;
    }
    return $content;
}

function reportMissedCalls($smarty, $module_name, $local_templates_dir, &$pDB, $sExtension)
{
    ini_set('max_execution_time', 3600);

    $pCallingReport = new paloSantoMissedCalls($pDB);
    $oFilterForm  = new paloForm($smarty, createFieldFilter());
    $filter_field = getParameter("filter_field");
    $filter_value = getParameter("filter_value");
    $date_start   = getParameter("date_start");
    $date_end     = getParameter("date_end");

    //begin grid parameters
    $oGrid  = new paloSantoGrid($smarty);
    $oGrid->setTitle(_tr("Missed Calls"));
    $oGrid->pagingShow(true); // show paging section.
    $oGrid->enableExport();   // enable export.
    $oGrid->setNameFile_Export(_tr("Missed Calls"));

    $url = array(
        "menu"         =>  $module_name,
        "filter_field" =>  $filter_field,
        "filter_value" =>  $filter_value
    );

    $date_start = (isset($date_start))?$date_start:date("d M Y").' 00:00';
    $date_end   = (isset($date_end))?$date_end:date("d M Y").' 23:59';
    $_POST['date_start'] = $date_start;
    $_POST['date_end']   = $date_end;

    $parmFilter = array(
        "date_start" => $date_start,
        "date_end" => $date_end
    );

    if (!$oFilterForm->validateForm($parmFilter)) {
        $smarty->assign(array(
            'mb_title'      =>  _tr('Validation Error'),
            'mb_message'    =>  '<b>'._tr('The following fields contain errors').':</b><br/>'.
                                implode(', ', array_keys($oFilterForm->arrErroresValidacion)),
        ));
        $date_start = date("d M Y").' 00:00';
        $date_end   = date("d M Y").' 23:59';
    }

    $url = array_merge($url, array('date_start' => $date_start,'date_end' => $date_end));

    $oGrid->setURL($url);

    $arrColumns = array(_tr("Date"),_tr("Source"),_tr("Destination"),_tr("Time since last call"),_tr("Number of attempts"),_tr("Status"));
    $oGrid->setColumns($arrColumns);

    $arrData = null;
    $date_start_format = date('Y-m-d H:i:s',strtotime($date_start.":00"));
    $date_end_format   = date('Y-m-d H:i:s',strtotime($date_end.":59"));

    $total = $pCallingReport->getNumCallingReport($date_start_format, $date_end_format,
        $filter_field, $filter_value, $sExtension);

    if($oGrid->isExportAction()){
        $limit  = $total; // max number of rows.
        $offset = 0;      // since the start.
        $arrResult = $pCallingReport->getCallingReport($date_start_format, $date_end_format,
            $filter_field, $filter_value, $sExtension);
        $arrData = $pCallingReport->showDataReport($arrResult, $total);

        $size = count($arrData);
        $oGrid->setData($arrData);
    }
    else{
        $limit  = 20;
        $oGrid->setLimit($limit);
        $arrResult = $pCallingReport->getCallingReport($date_start_format, $date_end_format,
            $filter_field, $filter_value, $sExtension);
        $arrData = $pCallingReport->showDataReport($arrResult, $total);
        if ($pCallingReport->errMsg != '') {
                $smarty->assign('mb_message', $pCallingReport->errMsg);
        }

        //recalculando el total para la paginación
        $size = count($arrData);
        $oGrid->setTotal($size);
        $offset = $oGrid->calculateOffset(); //echo $size." : ".$offset;
        $arrResult = $pCallingReport->getDataByPagination($arrData, $limit, $offset);
        $oGrid->setData($arrResult);
    }

    //begin section filter

    $smarty->assign("SHOW", _tr("Show"));
    $htmlFilter  = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl","",$_POST);
    //end section filter

    $oGrid->showFilter(trim($htmlFilter));
    $content = $oGrid->fetchGrid();
    //end grid parameters

    return $content;
}


function createFieldFilter(){
    $arrFilter = array(
            "src" => _tr("Source"),
            "dst" => _tr("Destination"),
                    );

    $arrFormElements = array(
            "filter_field" => array("LABEL"                  => _tr("Search"),
                                    "REQUIRED"               => "no",
                                    "INPUT_TYPE"             => "SELECT",
                                    "INPUT_EXTRA_PARAM"      => $arrFilter,
                                    "VALIDATION_TYPE"        => "text",
                                    "VALIDATION_EXTRA_PARAM" => ""),
            "filter_value" => array("LABEL"                  => "",
                                    "REQUIRED"               => "no",
                                    "INPUT_TYPE"             => "TEXT",
                                    "INPUT_EXTRA_PARAM"      => "",
                                    "VALIDATION_TYPE"        => "text",
                                    "VALIDATION_EXTRA_PARAM" => ""),
            "date_start"  => array("LABEL"                  => _tr("Start Date"),
                                    "REQUIRED"               => "yes",
                                    "INPUT_TYPE"             => "DATE",
                                    "INPUT_EXTRA_PARAM"      => array("TIME" => true, "FORMAT" => "%d %b %Y %H:%M"),
                                    "VALIDATION_TYPE"        => "",
                                    "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}[[:space:]]+[[:digit:]]{1,2}:[[:digit:]]{1,2}$"),
            "date_end"    => array("LABEL"                  => _tr("End Date"),
                                    "REQUIRED"               => "yes",
                                    "INPUT_TYPE"             => "DATE",
                                    "INPUT_EXTRA_PARAM"      => array("TIME" => true, "FORMAT" => "%d %b %Y %H:%M"),
                                    "VALIDATION_TYPE"        => "ereg",
                                    "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}[[:space:]]+[[:digit:]]{1,2}:[[:digit:]]{1,2}$"),
                    );
    return $arrFormElements;
}


function getAction()
{
    if(getParameter("save_new")) //Get parameter by POST (submit)
        return "save_new";
    else if(getParameter("save_edit"))
        return "save_edit";
    else if(getParameter("delete"))
        return "delete";
    else if(getParameter("new_open"))
        return "view_form";
    else if(getParameter("action")=="view")      //Get parameter by GET (command pattern, links)
        return "view_form";
    else if(getParameter("action")=="view_edit")
        return "view_form";
    else
        return "report"; //cancel
}
?>
