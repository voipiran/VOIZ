<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 1.4-1 |
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
  $Id: index.php,v 1.1 2009-01-06 09:01:38 bmacias bmacias@palosanto.com Exp $ */
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoForm.class.php";
include_once "libs/misc.lib.php";
require_once "libs/date.php";
require_once "libs/mylib/tarikh_func.php";

function _moduleContent(&$smarty, $module_name)
{
    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoReportCall.class.php";
    include_once "libs/paloSantoConfig.class.php";
    $base_dir = dirname($_SERVER['SCRIPT_FILENAME']);
    load_language_module($module_name);

    //global variables
    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf, $arrConfModule);

    //folder path for custom templates
    $templates_dir = (isset($arrConf['templates_dir'])) ? $arrConf['templates_dir'] : 'themes';
    $local_templates_dir = "$base_dir/modules/$module_name/" . $templates_dir . '/' . $arrConf['theme'];

    // Load Jalali calendar if not already included
    $smarty->assign('JALALI_CALENDAR', true);

    //conexion resource
    $pConfig = new paloConfig("/etc", "amportal.conf", "=", "[[:space:]]*=[[:space:]]*");
    $arrConfig = $pConfig->leer_configuracion(false);
    $dsnAsteriskCdr = $arrConfig['AMPDBENGINE']['valor'] . "://" .
                      $arrConfig['AMPDBUSER']['valor'] . ":" .
                      $arrConfig['AMPDBPASS']['valor'] . "@" .
                      $arrConfig['AMPDBHOST']['valor'] . "/asteriskcdrdb";
    $pDB_cdr = new paloDB($dsnAsteriskCdr); //asteriskcdrdb -> CDR
    $pDB_billing = new paloDB("sqlite3:///$arrConf[issabel_dbdir]/rate.db"); //sqlite3 -> rate.db

    //actions
    $accion = getAction();
    $content = "";
    switch ($accion) {
        case 'graph':
            $content = graphLinks($smarty, $module_name, $local_templates_dir);
            break;
        case 'imageTop10Salientes':
        case 'imageTop10Entrantes':
            // The following outputs image data directly and depends on rawmode=yes
            executeImage($module_name, $accion);
            $content = '';
            break;
        default:
            $content = reportReportCall($smarty, $module_name, $local_templates_dir, $pDB_cdr, $pDB_billing, $arrConf);
            break;
    }
    return $content;
}

function reportReportCall($smarty, $module_name, $local_templates_dir, &$pDB_cdr, &$pDB_billing, $arrConf)
{
    $pReportCall = new paloSantoReportCall($pDB_cdr, $pDB_billing);

    //PARAMETERS
    $type = getParameter("option_fil");
    $value_tmp = getParameter("value_fil");
    $date_ini_tmp = getParameter("date_from_shamsi");
    $date_end_tmp = getParameter("date_to_shamsi");
    $order_by_tmp = getParameter("order_by");
    $order_type_tmp = getParameter("order_type");
    $action = getParameter("nav");
    $start = getParameter("start");
    $value = isset($value_tmp) ? $value_tmp : "";
    $order_by = isset($order_by_tmp) ? $order_by_tmp : 1;
    $order_type = isset($order_type_tmp) ? $order_type_tmp : "asc";
    $date_from = isset($date_ini_tmp) ? $date_ini_tmp : adad_en_to_fa(tarikhemroz()['shamsi_d'] . " " . tarikhemroz()['shamsi_mn'] . " " . tarikhemroz()['shamsi_y']);
    $date_to = isset($date_end_tmp) ? $date_end_tmp : adad_en_to_fa(tarikhemroz()['shamsi_d'] . " " . tarikhemroz()['shamsi_mn'] . " " . tarikhemroz()['shamsi_y']);
    $date_ini = tarjomedatehshamsi($date_from . " 00:00:00");
    $date_end = tarjomedatehshamsi($date_to . " 23:59:59");

    //**********************************
    //begin grid parameters
    $oGrid = new paloSantoGrid($smarty);
    $limit = 40;
    $total = $pReportCall->ObtainNumberDevices($type, $value);
    $oGrid->setLimit($limit);
    $oGrid->setTotal($total);
    $oGrid->calculatePagination($action, $start);
    $offset = $oGrid->getOffsetValue();
    $end = $oGrid->getEnd();
    $urlFields = array(
        'menu' => $module_name,
        'option_fil' => $type,
        'value_fil' => $value,
        'date_from_shamsi' => $date_from,
        'date_to_shamsi' => $date_to,
    );
    $url = construirUrl($urlFields, array('nav', 'start'));
    $urlFields['order_by'] = $order_by;
    $urlFields['order_type'] = $order_type;
    $smarty->assign("order_by", $order_by);
    $smarty->assign("order_type", $order_type);
    $arrData = null;
    $arrResult = $pReportCall->ObtainReportCall($limit, $offset, $date_ini, $date_end, $type, $value, $order_by, $order_type);
    if ($pReportCall->errMsg != '') {
        $smarty->assign('mb_message', $pReportCall->errMsg);
    }
    $order_type = ($order_type == "desc") ? "asc" : "desc";
    if (is_array($arrResult) && $total > 0) {
        foreach ($arrResult as $key => $val) {
            $ext = $val['extension'];
            $arrTmp[0] = $ext;
            $arrTmp[1] = $val['user_name'];
            $arrTmp[2] = $val['num_incoming_call'];
            $arrTmp[3] = $val['num_outgoing_call'];
            $arrTmp[4] = "<label style='color: green;' title='{$val['duration_incoming_call']} " . _tr('seconds') . "'>" . $pReportCall->Sec2HHMMSS($val['duration_incoming_call']) . "</label>";
            $arrTmp[5] = "<label style='color: green;' title='{$val['duration_outgoing_call']} " . _tr('seconds') . "'>" . $pReportCall->Sec2HHMMSS($val['duration_outgoing_call']) . "</label>";
            $arrTmp[6] = "<a href='javascript: popup_ventana(\"?menu=$module_name&action=graph&rawmode=yes&ext=$ext&dini=" . urlencode($date_ini) . "&dfin=" . urlencode($date_end) . "\");'>" .
                "" . _tr('Call Details') . "</a>";
            $arrData[] = $arrTmp;
        }
    }
    $img = "<img src='images/flecha_$order_type.png' border='0' align='absmiddle'>";
    $leyend_1 = "<a class='link_summary_off' href='$url&amp;order_by=1&amp;order_type=asc'>" . _tr("Extension") . "</a>";
    $leyend_2 = "<a class='link_summary_off' href='$url&amp;order_by=2&amp;order_type=asc'>" . _tr("User name") . "</a>";
    $leyend_3 = "<a class='link_summary_off' href='$url&amp;order_by=3&amp;order_type=asc'>" . _tr("Num. Incoming Calls") . "</a>";
    $leyend_4 = "<a class='link_summary_off' href='$url&amp;order_by=4&amp;order_type=asc'>" . _tr("Num. Outgoing Calls") . "</a>";
    $leyend_5 = "<a class='link_summary_off' href='$url&amp;order_by=5&amp;order_type=asc'>" . _tr("Sec. Incoming Calls") . "</a>";
    $leyend_6 = "<a class='link_summary_off' href='$url&amp;order_by=6&amp;order_type=asc'>" . _tr("Sec. Outgoing Calls") . "</a>";
    if ($order_by == 1) $leyend_1 = "<a class='link_summary_on' href='$url&amp;order_by=1&amp;order_type=$order_type'>" . _tr("Extension") . "&nbsp;$img</a>";
    else if ($order_by == 2) $leyend_2 = "<a class='link_summary_on' href='$url&amp;order_by=2&amp;order_type=$order_type'>" . _tr("User name") . "&nbsp;$img</a>";
    else if ($order_by == 3) $leyend_3 = "<a class='link_summary_on' href='$url&amp;order_by=3&amp;order_type=$order_type'>" . _tr("Num. Incoming Calls") . "&nbsp;$img</a>";
    else if ($order_by == 4) $leyend_4 = "<a class='link_summary_on' href='$url&amp;order_by=4&amp;order_type=$order_type'>" . _tr("Num. Outgoing Calls") . "&nbsp;$img</a>";
    else if ($order_by == 5) $leyend_5 = "<a class='link_summary_on' href='$url&amp;order_by=5&amp;order_type=$order_type'>" . _tr("Sec. Incoming Calls") . "&nbsp;$img</a>";
    else if ($order_by == 6) $leyend_6 = "<a class='link_summary_on' href='$url&amp;order_by=6&amp;order_type=$order_type'>" . _tr("Sec. Outgoing Calls") . "&nbsp;$img</a>";
    $arrGrid =
        array("title" => _tr("Summary by Extension"),
            "icon" => "images/list.png",
            "width" => "100%",
            "start" => ($total == 0) ? 0 : $offset + 1,
            "end" => $end,
            "total" => $total,
            "url" => $urlFields,
            "columns" => array(
                0 => array("name" => $leyend_1,
                    "property1" => ""),
                1 => array("name" => $leyend_2,
                    "property1" => ""),
                2 => array("name" => $leyend_3,
                    "property1" => ""),
                3 => array("name" => $leyend_4,
                    "property1" => ""),
                4 => array("name" => $leyend_5,
                    "property1" => ""),
                5 => array("name" => $leyend_6,
                    "property1" => ""),
                6 => array("name" => _tr("Details"),
                    "property1" => ""),
            )
        );

    //begin section filter
    $arrFormFilterReportCall = createFieldForm();
    $oFilterForm = new paloForm($smarty, $arrFormFilterReportCall);
    $_POST['option_fil'] = $type;
    $_POST['value_fil'] = $value;
    $_POST['date_from_shamsi'] = $date_from;
    $_POST['date_to_shamsi'] = $date_to;
    $smarty->assign("SHOW", _tr("Show"));
    if ($_POST["date_from_shamsi"] === "")
        $_POST["date_from_shamsi"] = " ";
    if ($_POST['date_to_shamsi'] === "")
        $_POST['date_to_shamsi'] = " ";
    $oGrid->addFilterControl(_tr("Filter applied: ") . _tr("Start Date") . " = " . $date_from . ", " . _tr("End Date") . " = " .
        $date_to, $_POST, array("date_from_shamsi" => adad_en_to_fa(tarikhemroz()['shamsi_d'] . " " . tarikhemroz()['shamsi_mn'] . " " . tarikhemroz()['shamsi_y']), "date_to_shamsi" => adad_en_to_fa(tarikhemroz()['shamsi_d'] . " " . tarikhemroz()['shamsi_mn'] . " " . tarikhemroz()['shamsi_y'])), true);
    $valueType = "";
    if (!is_null($type)) {
        if ($type == "Ext")
            $valueType = _tr("Extension");
        else
            $valueType = _tr("User");
    }
    $oGrid->addFilterControl(_tr("Filter applied: ") . $valueType . " = " . $value, $_POST, array("option_fil" => "Ext", "value_fil" => ""));
    $htmlFilter = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl", "", $_POST);
    //end section filter
    $oGrid->showFilter(trim($htmlFilter));
    $contenidoModulo = $oGrid->fetchGrid($arrGrid, $arrData);
    return $contenidoModulo;
}

function createFieldForm()
{
    $arrFormElements = array(
        "option_fil" => array("LABEL" => _tr("Filter by"),
            "REQUIRED" => "no",
            "INPUT_TYPE" => "SELECT",
            "INPUT_EXTRA_PARAM" => array("Ext" => _tr("Extension"), "User" => _tr("User")),
            "VALIDATION_TYPE" => "text",
            "EDITABLE" => "yes",
            "VALIDATION_EXTRA_PARAM" => ""),
        "value_fil" => array("LABEL" => "",
            "REQUIRED" => "no",
            "INPUT_TYPE" => "TEXT",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "numeric",
            "VALIDATION_EXTRA_PARAM" => ""),
        "date_from_shamsi" => array("LABEL" => _tr("Start date"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "DATE_SHAMSI",
            "INPUT_EXTRA_PARAM" => array("FORMAT" => "%d %b %Y"),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "date_to_shamsi" => array("LABEL" => _tr("End date"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "DATE_SHAMSI",
            "INPUT_EXTRA_PARAM" => array("FORMAT" => "%d %b %Y"),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
    );
    return $arrFormElements;
}

function graphLinks($smarty, $module_name, $local_templates_dir)
{
    $getParams = array('ext', 'dini', 'dfin');
    foreach ($getParams as $k) if (!isset($_GET[$k])) $_GET[$k] = '';
    $urlEntrantes = construirURL(array(
        'module' => $module_name,
        'rawmode' => 'yes',
        'action' => 'imageTop10Entrantes',
        'ext' => $_GET['ext'],
        'dini' => $_GET['dini'],
        'dfin' => $_GET['dfin'],
    ));
    $urlSalientes = construirURL(array(
        'module' => $module_name,
        'rawmode' => 'yes',
        'action' => 'imageTop10Salientes',
        'ext' => $_GET['ext'],
        'dini' => $_GET['dini'],
        'dfin' => $_GET['dfin'],
    ));
    $sPlantilla = <<<PLANTILLA_GRAPH
<html>
<head><title>Top 10</title></head>
<body>
<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
<tr><td align='center'><img alt='imageTop10Entrantes' src='$urlEntrantes' /></td></tr>
<tr><td align='center'><img alt='imageTop10Salientes' src='$urlSalientes' /></td></tr>
</table>
</body>
</html>
PLANTILLA_GRAPH;
    return $sPlantilla;
}

function executeImage($module_name, $sImage)
{
    require_once "libs/paloSantoGraphImage.lib.php";
    $arrParameterCallbyGraph = array();
    $getParams = array('dini', 'dfin', 'ext');
    foreach ($getParams as $k) $arrParameterCallbyGraph[] = isset($_GET[$k]) ? $_GET[$k] : '';
    if ($sImage == 'imageTop10Entrantes')
        displayGraph($module_name, "paloSantoReportCall", "callbackTop10Entrantes", $arrParameterCallbyGraph);
    if ($sImage == 'imageTop10Salientes')
        displayGraph($module_name, "paloSantoReportCall", "callbackTop10Salientes", $arrParameterCallbyGraph);
}

function getAction()
{
    if (getParameter("show")) //Get parameter by POST (submit)
        return "show";
    else if (getParameter("action") == "show") //Get parameter by GET (command pattern, links)
        return "show";
    else if (getParameter("action") == "graph") //Get parameter by GET (command pattern, links)
        return "graph";
    else if (getParameter("action") == "imageTop10Entrantes")
        return "imageTop10Entrantes";
    else if (getParameter("action") == "imageTop10Salientes")
        return "imageTop10Salientes";
    else
        return "report";
}
?>