<?php

/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 4.0.0-18                                               |
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
  $Id: index.php,v 1.3 2007/09/05 00:26:21 gcarrillo Exp $
  $Id: index.php,v 1.3 2008/04/14 09:22:21 afigueroa Exp $
  $Id: index.php,v 2.0 2010/02/03 09:00:00 onavarre Exp $
  $Id: index.php,v 2.1 2010-03-22 05:03:48 Eduardo Cueva ecueva@palosanto.com Exp $ */
//include issabel framework
// exten => s,n,Set(CDR(userfield)=audio:${CALLFILENAME}.${MIXMON_FORMAT})   extensions_additional


require_once "libs/paloSantoACL.class.php";
require_once "libs/date.php";

function _moduleContent(&$smarty, $module_name) {
    require_once "modules/$module_name/configs/default.conf.php";
    require_once "modules/$module_name/libs/paloSantoMonitoring.class.php";

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
    $arrConf['dsn_conn_database'] = generarDSNSistema('asteriskuser', 'asteriskcdrdb');
    $pDB = new paloDB($arrConf['dsn_conn_database']);
    $pDBACL = new paloDB($arrConf['issabel_dsn']['acl']);
    $pACL = new paloACL($pDBACL);
    $user = isset($_SESSION['issabel_user']) ? $_SESSION['issabel_user'] : "";
    $extension = $pACL->getUserExtension($user);
    if ($extension == '')
        $extension = NULL;

    // Sólo el administrador puede consultar con $extension == NULL
    if (is_null($extension)) {
        if (hasModulePrivilege($user, $module_name, 'reportany'))
            $smarty->assign("mb_message", "<b>" . _tr("no_extension") . "</b>");
        else {
            $smarty->assign("mb_message", "<b>" . _tr("contact_admin") . "</b>");
            return "";
        }
    }

    switch (getParameter('action')) {
        case 'download':
            $h = 'downloadFile';
            break;
        case 'display_record':
            $h = 'display_record';
            break;
        default:
            $h = 'reportMonitoring';
            break;
    }
    return $h($smarty, $module_name, $local_templates_dir, $pDB, $pACL, $arrConf, $user, $extension);
}

function reportMonitoring($smarty, $module_name, $local_templates_dir, &$pDB, $pACL, $arrConf, $user, $extension) {
    require_once "libs/paloSantoGrid.class.php";
    require_once "libs/paloSantoForm.class.php";

    if (isset($_POST['submit_eliminar']) && isset($_POST['uniqueid']) &&
            is_array($_POST['uniqueid']) && count($_POST['uniqueid']) > 0) {
        deleteRecord($smarty, $module_name, $local_templates_dir, $pDB, $pACL, $arrConf, $user, $extension);
    }

    $bPuedeVerTodos = hasModulePrivilege($user, $module_name, 'reportany');
    $bPuedeBorrar = hasModulePrivilege($user, $module_name, 'deleteany');

    $pMonitoring = new paloSantoMonitoring($pDB);
    $filter_field = getParameter("filter_field");

    switch ($filter_field) {
        case "dst":
            $filter_field = "dst";
            $nameFilterField = _tr("Destination");
            break;
        case "recordingfile":
            $filter_field = "recordingfile";
            $nameFilterField = _tr("Type");
            break;
        default:
            $filter_field = "src";
            $nameFilterField = _tr("Source");
            break;
    }
    if ($filter_field == "recordingfile") {
        $filter_value = getParameter("filter_value_recordingfile");
        $filter = "";
        $filter_recordingfile = $filter_value;
    } else {
        $filter_value = getParameter("filter_value");
        $filter = $filter_value;
        $filter_recordingfile = "";
    }
    switch ($filter_value) {
        case "outgoing":
            $smarty->assign("SELECTED_2", "Selected");
            $nameFilterUserfield = _tr("Outgoing");
            break;
        case "queue":
            $smarty->assign("SELECTED_3", "Selected");
            $nameFilterUserfield = _tr("Queue");
            break;
        case "group":
            $smarty->assign("SELECTED_4", "Selected");
            $nameFilterUserfield = _tr("Group");
            break;
        default:
            $smarty->assign("SELECTED_1", "Selected");
            $nameFilterUserfield = _tr("Incoming");
            break;
    } 
    $months = array
        (
        "0" => "...",
        1 => "Jan",
        2 => "Feb",
        3 => "Mar",
        4 => "Apr",
        5 => "May",
        6 => "Jun",
        7 => "Jul",
        8 => "Aug",
        9 => "Sep",
        10 => "Oct",
        11 => "Nov",
        12 => "Dec"
    );
    
        if (isset($_POST["date_start"])) {
        $dh = new Application_Helper_date;
        $date_parts = explode("-", $_POST["date_start"]);

        $gregorian_date = $dh->jalali_to_gregorian($date_parts[0], $date_parts[1], $date_parts[2]);
        $gregorian_date[1] = $months[$gregorian_date[1]];

        $_POST["date_start"] = $gregorian_date[2] . " " . $gregorian_date[1] . " " . $gregorian_date[0] ;


        $date_parts = explode("-", $_POST["date_end"]);
        $gregorian_date = $dh->jalali_to_gregorian($date_parts[0], $date_parts[1], $date_parts[2]);
        $gregorian_date[1] = $months[$gregorian_date[1]];
        $_POST["date_end"] =  $gregorian_date[2] . " " . $gregorian_date[1] . " " . $gregorian_date[0] ;
    }
    
    $date_ini = getParameter("date_start");
    $date_end = getParameter("date_end");

    $path_record = $arrConf['records_dir'];

    $_POST['date_start'] = isset($date_ini) ? $date_ini : date("d M Y");
    $_POST['date_end'] = isset($date_end) ? $date_end : date("d M Y");

    if ($date_ini === "") {
        $_POST['date_start'] = " ";
    }
    if ($date_end === "")
        $_POST['date_end'] = " ";

    if (!empty($pACL->errMsg)) {
        echo "ERROR DE ACL: $pACL->errMsg <br>";
    }

    $date_initial = date('Y-m-d', strtotime($_POST['date_start'])) . " 00:00:00";
    $date_final = date('Y-m-d', strtotime($_POST['date_end'])) . " 23:59:59";

    $_DATA = $_POST;
    //begin grid parameters
    $oGrid = new paloSantoGrid($smarty);
    $oGrid->setTitle(_tr("Monitoring"));
    $oGrid->setIcon("modules/$module_name/images/pbx_monitoring.png");
    $oGrid->pagingShow(true); // show paging section.

    $oGrid->enableExport();   // enable export.
    $oGrid->setNameFile_Export(_tr("Monitoring"));

    // TODO: agregar filtro por extensión de usuario de Issabel sólo para reportany
    // Se asume que sólo el administrador puede consultar con extension NULL
    $param = array(
        'date_start' => $date_initial,
        'date_end' => $date_final,
    );
    if (!$bPuedeVerTodos)
        $param['extension'] = $extension;
    if ($filter_field != '' && $filter_value != '')
        $param[$filter_field] = $filter_value;
    $totalMonitoring = $pMonitoring->getNumMonitoring($param);
    $url = array('menu' => $module_name);

    $paramFilter = array(
        'filter_field' => $filter_field,
        'filter_value' => $filter,
        'filter_value_recordingfile' => $filter_recordingfile,
        'date_start' => $_POST['date_start'],
        'date_end' => $_POST['date_end']
    );
    $url = array_merge($url, $paramFilter);
    $oGrid->setURL($url);

    $arrData = null;
    $oGrid->setTotal($totalMonitoring);
    if ($oGrid->isExportAction()) {
        $limit = $totalMonitoring;
        $offset = 0;

        $arrColumns = array(_tr("Date"), _tr("Time"), _tr("Source"),
            _tr("Destination"), _tr("Duration"), _tr("Type"), _tr("File"));
    } else {
        $limit = 20;
        $oGrid->setLimit($limit);
        $offset = $oGrid->calculateOffset();

        $arrColumns = array('', _tr("Date"), _tr("Time"), _tr("Source"),
            _tr("Destination"), _tr("Duration"), _tr("Type"), _tr("Message"));
    }

    $oGrid->setColumns($arrColumns);

    // Se asume que sólo el administrador puede consultar con extension NULL
    $arrResult = $pMonitoring->getMonitoring($param, $limit, $offset);

    if (is_array($arrResult)) {
        if ($oGrid->isExportAction()) {
            $arrData = array_map('formatCallRecordingTuple', $arrResult);
        } else
            foreach ($arrResult as $value) {

                $arrTmp = formatCallRecordingTuple($value);
                array_unshift($arrTmp, ($bPuedeBorrar && ($value['recordingfile'] != 'deleted')) ? '<input type="checkbox" name="uniqueid[]" value="' .
                                htmlentities($value['uniqueid'] . '|' . $value['recordingfile'], ENT_COMPAT, 'UTF-8') . '"/>' : '');

                // checkbox(id_uniqueid) date time src dst hh:mm:ss rectype namefile

                if ($arrTmp[3] == '')
                    $arrTmp[3] = "<font color='gray'>" . _tr("unknown") . "</font>";
                if ($arrTmp[4] == '')
                    $arrTmp[4] = "<font color='gray'>" . _tr("unknown") . "</font>";
                $arrTmp[5] = "<label title='" . $value['duration'] . " " . _tr('seconds') . "' style='color:green'>" . $arrTmp[5] . "</label>";

                if ($arrTmp[7] != 'deleted') {
                    $esc_recfile = htmlentities($value['recordingfile'], ENT_COMPAT, 'UTF-8');
                    $recinfo = $pMonitoring->resolveRecordingPath($value['recordingfile']);
                    if (is_null($recinfo['fullpath'])) {
                        $recordingLink = '<span title="' . $esc_recfile . '" style="color: red"><b>' .
                                htmlentities(_tr('Recording missing', ENT_COMPAT, 'UTF-8')) . '</b></span>';
                    } else {
                        $urlparams = array(
                            'menu' => $module_name,
                            'action' => 'display_record',
                            'id' => $value['uniqueid'],
                            'namefile' => $arrTmp[7],
                            'rawmode' => 'yes',
                        );
                        $recordingLink = "<a title=\"$esc_recfile\" href=\"javascript:popUp('index.php?" . urlencode(http_build_query($urlparams) . "',350,100);") . "\">" . _tr("Listen") . "</a>&nbsp;";

                        $urlparams['action'] = 'download';
                        $recordingLink .= "<a title=\"$esc_recfile\" href='?" . http_build_query($urlparams) . "' >" . _tr("Download") . "</a>";
                    }
                } else {
                    $recordingLink = '';
                }
                $arrTmp[7] = $recordingLink;

                $arrData[] = $arrTmp;
            }
    }
    $oGrid->setData($arrData);

    if ($bPuedeBorrar) {
        $oGrid->deleteList(_tr("message_alert"), 'submit_eliminar', _tr("Delete"));
    }

    //begin section filter
    $arrFormFilterMonitoring = createFieldFilter();
    $oFilterForm = new paloForm($smarty, $arrFormFilterMonitoring);

    $smarty->assign("INCOMING", _tr("Incoming"));
    $smarty->assign("OUTGOING", _tr("Outgoing"));
    $smarty->assign("QUEUE", _tr("Queue"));
    $smarty->assign("GROUP", _tr("Group"));
    $smarty->assign("SHOW", _tr("Show"));
    $_POST["filter_field"] = $filter_field;
    $_POST["filter_value"] = $filter;
    $_POST["filter_value_recordingfile"] = $filter_recordingfile;
  
    $dh = new Application_Helper_date;
    $date_parts = explode(" ", $paramFilter['date_start']);
    $date_partsend = explode(" ", $paramFilter['date_end']);
    $months = array
        (
        "..." => "0",
        "Jan" => 1,
        "Feb" => 2,
        "Mar" => 3,
        "Apr" => 4,
        "May" => 5,
        "Jun" => 6,
        "Jul" => 7,
        "Aug" => 8,
        "Sep" => 9,
        "Oct" => 10,
        "Nov" => 11,
        "Dec" => 12,
    );

    $date_parts[1] = $months[$date_parts[1]];

    $date_parts = $date_parts[2] . "-" . $date_parts[1] . "-" . $date_parts[0];
    $meghdare_date = explode("-", $date_parts);
    $jalali_date = $dh->gregorian_to_jalali($meghdare_date[0], $meghdare_date[1], $meghdare_date[2]);
    if (strlen($jalali_date[1]) == 1) {
        $jalali_date[1] = "0" . $jalali_date[1];
    }
    if (strlen($jalali_date[2]) == 1) {
        $jalali_date[2] = "0" . $jalali_date[2];
    }
    $date_startm = $jalali_date[2] . "-" . $jalali_date[1] . "-" . $jalali_date[0];

    $date_partsend[1] = $months[$date_partsend[1]];
    $date_partsend = $date_partsend[2] . "-" . $date_partsend[1] . "-" . $date_partsend[0];
    $meghdare_date = explode("-", $date_partsend);
    $jalali_date = $dh->gregorian_to_jalali($meghdare_date[0], $meghdare_date[1], $meghdare_date[2]);
    if (strlen($jalali_date[1]) == 1) {
        $jalali_date[1] = "0" . $jalali_date[1];
    }
    if (strlen($jalali_date[2]) == 1) {
        $jalali_date[2] = "0" . $jalali_date[2];
    }
    $date_endm = $jalali_date[2] . "-" . $jalali_date[1] . "-" . $jalali_date[0];

    $oGrid->addFilterControl(_tr("Filter applied ") . _tr("Start Date") . " = " . $date_startm . ", " . _tr("End Date") . " = " . $date_endm, $paramFilter, array('date_start' => date("d M Y"), 'date_end' => date("d M Y")), true);

    if ($filter_field == "recordingfile") {
        $oGrid->addFilterControl(_tr("Filter applied ") . " $nameFilterField = $nameFilterUserfield", $_POST, array('filter_field' => "src", 'filter_value_recordingfile' => "incoming"));
    } else {
        $oGrid->addFilterControl(_tr("Filter applied ") . " $nameFilterField = $filter", $_POST, array('filter_field' => "src", "filter_value" => ""));
    }

    $htmlFilter = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl", "", $_POST);
    //end section filter
    $oGrid->showFilter(trim($htmlFilter));
    $content = $oGrid->fetchGrid();

    //end grid parameters

    return $content;
}

function formatCallRecordingTuple($value) {
    $namefile = basename($value['recordingfile']);
    if ($namefile == 'deleted') {
        $rectype = _tr('Deleted');
    } else
        switch ($namefile[0]) {
            case 'O':  // FreePBX 2.8.1
            case 'o':  // FreePBX 2.11+
                $rectype = _tr("Outgoing");
                break;
            case 'g':  // FreePBX 2.8.1
            case 'r':  // FreePBX 2.11+
                $rectype = _tr("Group");
                break;
            case "q":
                $rectype = _tr("Queue");
                break;
            default :
                $rectype = _tr("Incoming");
                break;
        }
    $dh = new Application_Helper_date;
    $meghdare_date = date('Y-m-d', strtotime($value['calldate']));
    $date_parts = explode("-", $meghdare_date);
    $jalali_date = $dh->gregorian_to_jalali($date_parts[0], $date_parts[1], $date_parts[2]);

    return array(
        $jalali_date[0] . "-" . $jalali_date[1] . "-" . $jalali_date[2],
        date('H:i:s', strtotime($value['calldate'])),
        isset($value['src']) ? $value['src'] : '',
        isset($value['dst']) ? $value['dst'] : '',
        SecToHHMMSS($value['duration']),
        $rectype,
        $namefile,
    );
}

function downloadFile($smarty, $module_name, $local_templates_dir, &$pDB, $pACL, $arrConf, $user, $extension) {
    $record = getParameter("id");
    $namefile = getParameter('namefile');
    if (is_null($record) || !preg_match('/^[[:digit:]]+\.[[:digit:]]+$/', $record)) {
        // Missing or invalid uniqueid
        Header('HTTP/1.1 404 Not Found');
        die("<b>404 " . _tr("no_file") . " </b>");
    }

    $pMonitoring = new paloSantoMonitoring($pDB);
    if (!hasModulePrivilege($user, $module_name, 'downloadany')) {
        if (!$pMonitoring->recordBelongsToUser($record, $extension)) {
            Header('HTTP/1.1 403 Forbidden');
            die("<b>403 " . _tr("You are not authorized to download this file") . " </b>");
        }
    }

    // Check record is valid and points to an actual file
    $filebyUid = $pMonitoring->getAudioByUniqueId($record, $namefile);
    if (is_null($filebyUid) || count($filebyUid) <= 0) {
        // Uniqueid does not point to a record with specified file
        Header('HTTP/1.1 404 Not Found');
        die("<b>404 " . _tr("no_file") . " </b>");
    }
    if ($filebyUid['deleted']) {
        // Specified file has been deleted
        Header('HTTP/1.1 410 Gone');
        die("<b>410 " . _tr("no_file") . " </b>");
    }
    if (is_null($filebyUid['fullpath']) || is_null($filebyUid['mimetype'])) {
        Header('HTTP/1.1 404 Not Found');
        die("<b>404 " . _tr("no_file") . " </b>");
    }

    // Actually open and transmit the file
    $fp = fopen($filebyUid['fullpath'], 'rb');
    if (!$fp) {
        Header('HTTP/1.1 404 Not Found');
        die("<b>404 " . _tr("no_file") . " </b>");
    }
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: wav file");
    header("Content-Type: " . $filebyUid['mimetype']);
    header("Content-Disposition: attachment; filename=" . basename($filebyUid['fullpath']));
    header("Content-Transfer-Encoding: binary");
    header("Content-length: " . filesize($filebyUid['fullpath']));
    fpassthru($fp);
    fclose($fp);
}

function display_record($smarty, $module_name, $local_templates_dir, &$pDB, $pACL, $arrConf, $user, $extension) {
    $file = getParameter("id");
    $namefile = getParameter('namefile');
    $pMonitoring = new paloSantoMonitoring($pDB);

    if (!hasModulePrivilege($user, $module_name, 'downloadany')) {
        if (!$pMonitoring->recordBelongsToUser($file, $extension)) {
            return _tr("You are not authorized to listen this file");
        }
    }

    $recinfo = $pMonitoring->getAudioByUniqueId($file, $namefile);
    if (!is_array($recinfo)) {
        return $pMonitoring->errMsg;
    }
    $ctype = is_null($recinfo['mimetype']) ? '' : $recinfo['mimetype'];
    $audiourl = construirURL(array(
        'menu' => $module_name,
        'action' => 'download',
        'id' => $file,
        'namefile' => $namefile,
        'rawmode' => 'yes',
        'issabelSession' => session_id(),
    ));
    $sContenido = <<<contenido
<!DOCTYPE html>
<html>
<head><title>Issabel</title></head>
<body>
    <audio src="$audiourl" controls autoplay>
        <embed src="$audiourl" width="300" height="20" autoplay="true" loop="false" type="$ctype" />
    </audio>
    <br/>
</body>
</html>
contenido;
    return $sContenido;
}

function deleteRecord($smarty, $module_name, $local_templates_dir, &$pDB, $pACL, $arrConf, $user, $extension) {
    if (!hasModulePrivilege($user, $module_name, 'deleteany')) {
        $smarty->assign("mb_title", _tr("ERROR"));
        $smarty->assign("mb_message", _tr("You are not authorized to delete any records"));
        return FALSE;
    }
    $pMonitoring = new paloSantoMonitoring($pDB);
    $path_record = $arrConf['records_dir'];
    foreach ($_POST['uniqueid'] as $ID) {
        $l = explode('|', $ID);
        if (count($l) >= 2)
            $pMonitoring->deleteRecordFile($l[0], $l[1]);
    }

    return TRUE;
}

function SecToHHMMSS($sec) {
    $HH = 0;
    $MM = 0;
    $SS = 0;
    $segundos = $sec;

    if ($segundos / 3600 >= 1) {
        $HH = (int) ($segundos / 3600);
        $segundos = $segundos % 3600;
    } if ($HH < 10)
        $HH = "0$HH";
    if ($segundos / 60 >= 1) {
        $MM = (int) ($segundos / 60);
        $segundos = $segundos % 60;
    } if ($MM < 10)
        $MM = "0$MM";
    $SS = $segundos;
    if ($SS < 10)
        $SS = "0$SS";

    return "$HH:$MM:$SS";
}

function createFieldFilter() {
    $arrFilter = array(
        "src" => _tr("Source"),
        "dst" => _tr("Destination"),
        "recordingfile" => _tr("Type"),
    );

    $arrFormElements = array(
        "date_start" => array("LABEL" => _tr("Start_Date"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "DATE",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "ereg",
            "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"),
        "date_end" => array("LABEL" => _tr("End_Date"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "DATE",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "ereg",
            "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"),
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
    );
    return $arrFormElements;
}

// Abstracción de privilegio por módulo hasta implementar (Issabel bug #1100).
// Parámetro $module se usará en un futuro al implementar paloACL::hasModulePrivilege().
function hasModulePrivilege($user, $module, $privilege) {
    global $arrConf;

    $pDB = new paloDB($arrConf['issabel_dsn']['acl']);
    $pACL = new paloACL($pDB);

    if (method_exists($pACL, 'hasModulePrivilege'))
        return $pACL->hasModulePrivilege($user, $module, $privilege);

    $isAdmin = ($pACL->isUserAdministratorGroup($user) !== FALSE);
    return ($isAdmin && in_array($privilege, array(
                'reportany', // ¿Está autorizado el usuario a ver la información de todos los demás?
                'downloadany', // ¿Está autorizado el usuario a descargar grabaciones de otros usuarios?
                'deleteany', // ¿Está autorizado el usuario a borrar grabaciones (propias o de otros)?
    )));
}
