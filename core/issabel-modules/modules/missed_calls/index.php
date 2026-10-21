<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 4.0.4-18 |
  | http://www.issabel.org |
  +----------------------------------------------------------------------+
  | Copyright (c) 2006 Palosanto Solutions S. A. |
  +----------------------------------------------------------------------+
  | The contents of this file are subject to the General Public License |
  | (GPL) Version 2 (the "License"); you may not use this file except in |
  | compliance with the License. You may obtain a copy of the License at |
  | http://www.opensource.org/licenses/gpl-license.php |
  | |
  | Software distributed under the License is distributed on an "AS IS" |
  | basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See |
  | the License for the specific language governing rights and |
  | limitations under the License. |
  +----------------------------------------------------------------------+
  | The Initial Developer of the Original Code is PaloSanto Solutions |
  +----------------------------------------------------------------------+
  $Id: index.php,v 1.1 2011-04-25 09:04:41 Eduardo Cueva ecueva@palosanto.com Exp $ */
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoForm.class.php";
include_once "libs/paloSantoConfig.class.php";
require_once "libs/misc.lib.php";
require_once "libs/date.php";
require_once "libs/mylib/tarikh_func.php";

function _moduleContent(&$smarty, $module_name)
{
    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoMissedCalls.class.php";
    $base_dir = dirname($_SERVER['SCRIPT_FILENAME']);
    load_language_module($module_name);

    //global variables
    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf, $arrConfModule);

    //folder path for custom templates
    $templates_dir = (isset($arrConf['templates_dir'])) ? $arrConf['templates_dir'] : 'themes';
    $local_templates_dir = "$base_dir/modules/$module_name/" . $templates_dir . '/' . $arrConf['theme'];

    //conexion resource
    // DSN برای consulta de cdrs
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
    // برای کاربرانی که مدیر نیستند، محدود به CDRهای خودشان می‌شود. مراقب کاربران غیرمدیر بدون اکستنشن باشید.
    $viewany = $pACL->hasModulePrivilege($_SESSION['issabel_user'], $module_name, 'viewany');
    $sExtension = $viewany ? '' : $pACL->getUserExtension($_SESSION['issabel_user']);
    $sExtension = trim("$sExtension");
    if (!$viewany && $sExtension == '') {
        return _tr('No extension for missed calls. Contact your administrator.');
    }
    switch ($action) {
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
    $oFilterForm = new paloForm($smarty, createFieldFilter());
    $filter_field = getParameter("filter_field");
    $filter_value = getParameter("filter_value");
    $date_start = getParameter("date_start_shamsi");
    $date_end = getParameter("date_end_shamsi");

    //begin grid parameters
    $oGrid = new paloSantoGrid($smarty);
    $oGrid->setTitle(_tr("Missed Calls"));
    $oGrid->pagingShow(true); // show paging section.
    $oGrid->enableExport(); // enable export.
    $oGrid->setNameFile_Export(_tr("Missed Calls"));
    $url = array(
        "menu" => $module_name,
        "filter_field" => $filter_field,
        "filter_value" => $filter_value
    );

    // تنظیم تاریخ پیش‌فرض به فرمت شمسی
    $shamdatestr = tarikhemroz();
    $date_start = (isset($date_start)) ? $date_start : adad_en_to_fa($shamdatestr['shamsi_d'] . " " . $shamdatestr['shamsi_mn'] . " " . $shamdatestr['shamsi_y'] . " 00:00");
    $date_end = (isset($date_end)) ? $date_end : adad_en_to_fa($shamdatestr['shamsi_d'] . " " . $shamdatestr['shamsi_mn'] . " " . $shamdatestr['shamsi_y'] . " 23:59");
    $_POST['date_start_shamsi'] = $date_start;
    $_POST['date_end_shamsi'] = $date_end;

    $parmFilter = array(
        "date_start_shamsi" => $date_start,
        "date_end_shamsi" => $date_end
    );

    if (!$oFilterForm->validateForm($parmFilter)) {
        $smarty->assign(array(
            'mb_title' => _tr('Validation Error'),
            'mb_message' => '<b>' . _tr('The following fields contain errors') . ':</b><br/>' .
                implode(', ', array_keys($oFilterForm->arrErroresValidacion)),
        ));
        $shamdatestr = tarikhemroz();
        $date_start = adad_en_to_fa($shamdatestr['shamsi_d'] . " " . $shamdatestr['shamsi_mn'] . " " . $shamdatestr['shamsi_y'] . " 00:00");
        $date_end = adad_en_to_fa($shamdatestr['shamsi_d'] . " " . $shamdatestr['shamsi_mn'] . " " . $shamdatestr['shamsi_y'] . " 23:59");
    }

    $url = array_merge($url, array('date_start_shamsi' => $date_start, 'date_end_shamsi' => $date_end));
    $oGrid->setURL($url);
    $arrColumns = array(_tr("Date"), _tr("Source"), _tr("Destination"), _tr("Time since last call"), _tr("Number of attempts"), _tr("Status"));
    $oGrid->setColumns($arrColumns);
    $arrData = null;

    // تبدیل تاریخ شمسی به گرگوری برای دیتابیس
    $date_start_format = tarjomedatehshamsi($date_start . ":00");
    $date_end_format = tarjomedatehshamsi($date_end . ":59");

    $total = $pCallingReport->getNumCallingReport($date_start_format, $date_end_format, $filter_field, $filter_value, $sExtension);
    if ($oGrid->isExportAction()) {
        $limit = $total; // max number of rows.
        $offset = 0; // since the start.
        $arrResult = $pCallingReport->getCallingReport($date_start_format, $date_end_format, $filter_field, $filter_value, $sExtension);
        $arrData = $pCallingReport->showDataReport($arrResult, $total);
        $size = count($arrData);
        $oGrid->setData($arrData);
    } else {
        $limit = 20;
        $oGrid->setLimit($limit);
        $arrResult = $pCallingReport->getCallingReport($date_start_format, $date_end_format, $filter_field, $filter_value, $sExtension);
        $arrData = $pCallingReport->showDataReport($arrResult, $total);
        if ($pCallingReport->errMsg != '') {
            $smarty->assign('mb_message', $pCallingReport->errMsg);
        }
        // recalculando el total para la paginación
        $size = count($arrData);
        $oGrid->setTotal($size);
        $offset = $oGrid->calculateOffset();
        $arrResult = $pCallingReport->getDataByPagination($arrData, $limit, $offset);
        $oGrid->setData($arrResult);
    }

    //begin section filter
    $smarty->assign("SHOW", _tr("Show"));
    $htmlFilter = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl", "", $_POST);
    //end section filter
    $oGrid->showFilter(trim($htmlFilter));
    $content = $oGrid->fetchGrid();
    //end grid parameters
    return $content;
}

function createFieldFilter()
{
    $arrFilter = array(
        "src" => _tr("Source"),
        "dst" => _tr("Destination"),
    );
    $arrFormElements = array(
        "filter_field" => array("LABEL" => _tr("Search"),
            "REQUIRED" => "no",
            "INPUT_TYPE" => "SELECT",
            "INPUT_EXTRA_PARAM" => $arrFilter,
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "filter_value" => array("LABEL" => "",
            "REQUIRED" => "no",
            "INPUT_TYPE" => "TEXT",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "date_start_shamsi" => array("LABEL" => _tr("Start Date"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "DATE_SHAMSI",
            "INPUT_EXTRA_PARAM" => array("TIME" => true, "FORMAT" => "%d %b %Y %H:%M"),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "date_end_shamsi" => array("LABEL" => _tr("End Date"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "DATE_SHAMSI",
            "INPUT_EXTRA_PARAM" => array("TIME" => true, "FORMAT" => "%d %b %Y %H:%M"),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
    );
    return $arrFormElements;
}

function getAction()
{
    if (getParameter("save_new")) //Get parameter by POST (submit)
        return "save_new";
    else if (getParameter("save_edit"))
        return "save_edit";
    else if (getParameter("delete"))
        return "delete";
    else if (getParameter("new_open"))
        return "view_form";
    else if (getParameter("action") == "view") //Get parameter by GET (command pattern, links)
        return "view_form";
    else if (getParameter("action") == "view_edit")
        return "view_form";
    else
        return "report"; //cancel
}
?>