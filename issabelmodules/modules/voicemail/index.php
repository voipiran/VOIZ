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

// error_reporting(1);
//    ini_set('display_errors', '1');

require_once "libs/paloSantoConfig.class.php";
require_once "libs/paloSantoACL.class.php";
require_once "libs/paloSantoForm.class.php";
require_once "libs/date.php";

function _moduleContent(&$smarty, $module_name) {

    require_once "modules/$module_name/configs/default.conf.php";
    require_once "modules/$module_name/lib/paloSantoVoiceMail.class.php";

    require_once "libs/paloSantoGrid.class.php";

    load_language_module($module_name);

    //global variables
    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf, $arrConfModule);

    //folder path for custom templates
    $base_dir = dirname($_SERVER['SCRIPT_FILENAME']);
    $templates_dir = (isset($arrConf['templates_dir'])) ? $arrConf['templates_dir'] : 'themes';
    $local_templates_dir = "$base_dir/modules/$module_name/" . $templates_dir . '/' . $arrConf['theme'];

    //segun el usuario que esta logoneado consulto si tiene asignada extension para buscar los voicemails
    $pDB = new paloDB($arrConf['issabel_dsn']['acl']);
    if (!empty($pDB->errMsg)) {
        return "ERROR DE DB: $pDB->errMsg <br>";
    }
    $pACL = new paloACL($pDB);
    if (!empty($pACL->errMsg)) {
        return "ERROR DE ACL: $pACL->errMsg <br>";
    }
    $user = isset($_SESSION['issabel_user']) ? $_SESSION['issabel_user'] : "";
    $extension = $pACL->getUserExtension($user);
    if ($extension == '')
        $extension = NULL;

    // Sólo el administrador puede consultar con $extension == NULL
    if (is_null($extension)) {
        if (!hasModulePrivilege($user, $module_name, 'reportany')) {
            $smarty->assign("mb_message", "<b>" . _tr("contact_admin") . "</b>");
            return "";
        }
    }

    if (getParameter('config') && !is_null($extension)) {
        return form_config($smarty, $module_name, $local_templates_dir, $extension);
    }
    if (getParameter('save')) {
        if (!save_config($smarty, $module_name, $local_templates_dir, $extension))
            return form_config($smarty, $module_name, $local_templates_dir, $extension);
    }

    switch (getParameter('action')) {
        case 'download':
            $h = 'downloadFile';
            break;
        case 'display_record':
            $h = 'display_record';
            break;
        default:
            $h = 'reportVoicemails';
            break;
    }
    return $h($smarty, $module_name, $local_templates_dir, $user, $extension);
}

function reportVoicemails($smarty, $module_name, $local_templates_dir, $user, $extension) {
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

    $monthsRev = array
        (
        "..." => 0,
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
        "Januray"     => 1,
        "February"    => 2,
        "March"       => 3,
        "April"       => 4,
        "May"         => 5,
        "June"        => 6,
        "Julay"       => 7,
        "August"      => 8,
        "September"   => 9,
        "October"     => 10,
        "November"    => 11,
        "December"    => 12
    );
/*
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
*/
    if (isset($_POST['submit_eliminar']) && isset($_POST['voicemails']) &&
            is_array($_POST['voicemails']) && count($_POST['voicemails']) > 0) {
        borrarVoicemails($smarty, $module_name, $local_templates_dir, $user, $extension);
    }

    $bPuedeVerTodos = hasModulePrivilege($user, $module_name, 'reportany');
    $bPuedeBorrar = hasModulePrivilege($user, $module_name, 'deleteany');
    $bPuedeDescargar = hasModulePrivilege($user, $module_name, 'downloadany');

    $smarty->assign("Filter", _tr('Show'));
    //formulario para el filtro
    $arrFormElements = createFieldFormVoiceList();
    $oFilterForm = new paloForm($smarty, $arrFormElements);
    // Por omision las fechas toman el sgte. valor (la fecha de hoy)



    $date_start = date("Y-m-d") . " 00:00:00";
    $date_end = date("Y-m-d") . " 23:59:59";
// <msm>
    //require_once "libs/mylib/tarikh_func.php";
    $dateStartFilterShamsi = dateG2J($_POST["date_start"]);
    $dateEndFilterShamsi = dateG2J($_POST["date_end"]);
// </msm>

    $dateEndFilter = getParameter('date_end');
    $report = false;

    if (getParameter('filter')) {
        if ($oFilterForm->validateForm($_POST)) {

            // Exito, puedo procesar los datos ahora.
            $date_start = translateDate($dateStartFilter) . " 00:00:00";
            $date_end = translateDate($dateEndFilter) . " 23:59:59";
            $arrFilterExtraVars = array("date_start" => $dateStartFilter, "date_start_shamsi" => $dateStartFilterShamsi, "date_end" => $dateEndFilter);
        } else {
            // Error
            $smarty->assign("mb_title", _tr("Validation Error"));
            $arrErrores = $oFilterForm->arrErroresValidacion;
            $strErrorMsg = "<b>" . _tr('The following fields contain errors') . ":</b><br>";
            foreach ($arrErrores as $k => $v) {
                $strErrorMsg .= "$k, ";
            }
            $strErrorMsg .= "";
            $smarty->assign("mb_message", $strErrorMsg);
        }
        if ($dateStartFilter == "") {
            $dateStartFilter = " ";
        }
        if ($dateEndFilter == "") {
            $dateEndFilter = " ";
        }
        //se añade control a los filtros
        $report = true;
        $arrDate = array('date_start' => $dateStartFilter, 'date_end' => $dateEndFilter);
        $htmlFilter = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl", "", $_POST);
    } else if (isset($dateStartFilter) AND isset($dateEndFilter)) {
        $report = true;
        $date_start = translateDate($dateStartFilter) . " 00:00:00";
        $date_end = translateDate($dateEndFilter) . " 23:59:59";

        $arrDate = array('date_start' => $dateStartFilter, 'date_end' => $dateEndFilter);
        $arrFilterExtraVars = array("date_start" => $dateStartFilter, "date_end" => $dateEndFilter);
        $htmlFilter = $contenidoModulo = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl", "", $_GET);
    } else {
        $report = true;
        //se añade control a los filtros
        $arrDate = array('date_start' => date("d M Y"), 'date_end' => date("d M Y"));
        $htmlFilter = $contenidoModulo = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl", "", array('date_start' => date("d M Y"), 'date_end' => date("d M Y")));
    }
    
    $dh = new Application_Helper_date;
    $date_parts = explode(" ", $arrDate['date_start']);
    $date_partsend = explode(" ", $arrDate['date_end']);
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

   
    $oGrid = new paloSantoGrid($smarty);
    if ($report) {
        $oGrid->addFilterControl(_tr("Filter applied ") . _tr("Start Date") . " = " . $dateStartFilterShamsi . ", " . _tr("End Date") . " = " . $dateEndFilterShamsi, $arrDate, array('date_start' => date("d M Y"), 'date_end' => date("d M Y")), true);
    }

    $url = array('menu' => $module_name);

    //si tiene extension consulto sino, muestro un mensaje de que no tiene asociada extension
    if (is_null($extension) || $extension == "")
        $smarty->assign("mb_message", "<b>" . _tr("no_extension_assigned") . "</b>");

    $param = array(
        'date_start' => $date_start,
        'date_end' => $date_end,
    );
    if (!$bPuedeVerTodos)
        $param['extension'] = $extension;

    $paloVoice = new paloSantoVoiceMail();
    $rs = $paloVoice->listVoicemail($param);

    $limit = 15;
    $oGrid->setLimit($limit);
    $oGrid->setTotal(count($rs));
    $offset = $oGrid->calculateOffset();
    $arrData = array_slice($rs, $offset, $limit);

    $arrVoiceData = array();
    foreach ($arrData as $t) {
        $urlparam = array(
            'menu' => $module_name,
            'action' => 'display_record',
            'ext' => $t['mailbox'],
            'name' => basename($t['file'], '.txt'),
            'rawmode' => 'yes'
        );
        $displayurl = construirURL($urlparam);
        $urlparam['action'] = 'download';
        $downloadurl = construirURL($urlparam);


        $dh = new Application_Helper_date;
        $meghdare_date = date('Y-m-d', $t['origtime']);
        $date_parts = explode("-", $meghdare_date);
        $jalali_date = $dh->gregorian_to_jalali($date_parts[0], $date_parts[1], $date_parts[2]);

        $arrVoiceData[] = array(
            ($bPuedeBorrar || ($extension == $t['mailbox'])) ? '<input type="checkbox" name="voicemails[]" value="' . htmlentities($t['mailbox'] . ',' . basename($t['file'], '.txt'), ENT_COMPAT, 'UTF-8') . '" />' : '',
            $jalali_date[0] . "-" . $jalali_date[1] . "-" . $jalali_date[2],
            date('H:i:s', $t['origtime']),
            htmlentities($t['callerid'], ENT_COMPAT, 'UTF-8'),
            $t['extension'],
            $t['duration'] . ' ثانیه',
            ($bPuedeDescargar || ($extension == $t['mailbox'])) ? "<a href='#' onClick=\"javascript:popUp('$displayurl',350,100); return false;\">" . _tr('Listen') . "</a>&nbsp;" .
                    "<a href='$downloadurl'>" . _tr('Download') . "</a>" : '',
        );
    }
    $oGrid->setData($arrVoiceData);

    // Construyo el URL base
    if (isset($arrFilterExtraVars) && is_array($arrFilterExtraVars) and count($arrFilterExtraVars) > 0) {
        $url = array_merge($url, $arrFilterExtraVars);
    }

    $oGrid->setTitle(_tr("Voicemail List"));
    $oGrid->setURL($url);
    $oGrid->setIcon("/modules/$module_name/images/pbx_voicemail.png");
    $oGrid->setColumns(array('', _tr('Date'), _tr('Time'), _tr('CallerID'),
        _tr('Extension'), _tr('Duration'), _tr('Message')));

    if (!is_null($extension))
        $oGrid->customAction("config", _tr("Configuration"));
    $oGrid->deleteList(_tr("Are you sure you wish to delete voicemails?"), "submit_eliminar", _tr("Delete"));
    $oGrid->showFilter($htmlFilter);
    $contenidoModulo = $oGrid->fetchGrid();
    if (strpos($contenidoModulo, '<form') === FALSE)
        $contenidoModulo = "<form style='margin-bottom:0;' method='POST' action='?menu=$module_name'>$contenidoModulo</form>";
    return $contenidoModulo;
}

function form_config($smarty, $module_name, $local_templates_dir, $ext) {
    $arrForm = createFieldFormConfig();
    $oForm = new paloForm($smarty, $arrForm);

    $smarty->assign("REQUIRED_FIELD", _tr("Required Field"));
    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("icon", "images/list.png");

    $paloVoice = new paloSantoVoiceMail();
    $arrDat = $paloVoice->loadConfiguration($ext);

    if (!isset($_POST['save'])) {
        if (is_null($arrDat)) {
            $_POST['status'] = "Disable";
            $_POST['email_attach'] = "No";
            $_POST['play_cid'] = "No";
            $_POST['play_envelope'] = "No";
            $_POST['delete_vmail'] = "No";
        } else {
            $_POST['status'] = "Enable";
            $_POST['password'] = $arrDat['voicemail_password'];
            $_POST['password_confir'] = $arrDat['voicemail_password'];
            $_POST['email'] = $arrDat['user_email_address'];
            $_POST['pager_email'] = $arrDat['pager_email_address'];
            $_POST['email_attach'] = (isset($arrDat['user_options']['attach']) && $arrDat['user_options']['attach'] == 'yes') ? "Yes" : "No";
            $_POST['play_cid'] = (isset($arrDat['user_options']['saycid']) && $arrDat['user_options']['saycid'] == 'yes') ? "Yes" : "No";
            $_POST['play_envelope'] = (isset($arrDat['user_options']['envelope']) && $arrDat['user_options']['envelope'] == 'yes') ? "Yes" : "No";
            $_POST['delete_vmail'] = (isset($arrDat['user_options']['delete']) && $arrDat['user_options']['delete'] == 'yes') ? "Yes" : "No";
        }
    }

    $htmlForm = $oForm->fetchForm("$local_templates_dir/configuration.tpl", _tr("Configuration"), $_POST);

    $contenidoModulo = "<form  method='POST' style='margin-bottom:0;' action='?menu=$module_name'>" . $htmlForm . "</form>";

    return $contenidoModulo;
}

function save_config($smarty, $module_name, $local_templates_dir, $ext) {
    $paloVoice = new paloSantoVoiceMail();
    $arrDat = $paloVoice->loadConfiguration($ext);

    $arrForm = createFieldFormConfig();
    $oForm = new paloForm($smarty, $arrForm);

    if (!$oForm->validateForm($_POST) || $_POST['password'] != $_POST['password_confir']) {
        $smarty->assign("mb_title", "Validation Error");
        $arrErrores = $oForm->arrErroresValidacion;
        $strErrorMsg = "<b>'The following fields contain errors':</b><br/>";
        if (is_array($arrErrores) && count($arrErrores) > 0) {
            foreach ($arrErrores as $k => $v)
                $strErrorMsg .= "$k, ";
        }

        if ($_POST['password'] != $_POST['password_confir'])
            $strErrorMsg .= "Confirm Password";

        $smarty->assign("mb_message", $strErrorMsg);
        return false;
    }

    $bandera = $paloVoice->writeFileVoiceMail($ext, ($_POST['status'] == "Enable") ? array(
                'voicemail_password' => $_POST['password'],
                // user_name se conserva
                'user_email_address' => $_POST['email'],
                'pager_email_address' => $_POST['pager_email'],
                'user_options' => array(
                    // toda bandera distinta de las indicadas abajo se conserva
                    'attach' => ($_POST['email_attach'] == 'Yes') ? 'yes' : 'no',
                    'saycid' => ($_POST['play_cid'] == 'Yes') ? 'yes' : 'no',
                    'envelope' => ($_POST['play_envelope'] == 'Yes') ? 'yes' : 'no',
                    'delete' => ($_POST['delete_vmail'] == 'Yes') ? 'yes' : 'no',
                ),
                    ) : NULL);

    if ($bandera == true)
        return true;
    else {
        $smarty->assign("mb_title", "Error");
        $smarty->assign("mb_message", $paloVoice->errMsg);
        return false;
    }
}

function downloadFile($smarty, $module_name, $local_templates_dir, $user, $extension) {
    $record = getParameter("name");
    $ext = getParameter("ext");

    if (!hasModulePrivilege($user, $module_name, 'downloadany')) {
        if ($extension != $ext) {
            Header('HTTP/1.1 403 Forbidden');
            die("<b>403 " . _tr("no_extension") . " </b>");
        }
    }

    $paloVoice = new paloSantoVoiceMail();
    $recinfo = $paloVoice->resolveVoiceMailFiles($ext, $record);
    if (is_null($recinfo) || count($recinfo['recordings']) <= 0) {
        Header("HTTP/1.1 404 Not Found");
        die("<b>404 " . _tr("no_file") . "</b>");
    }
    $size = filesize($recinfo['recordings'][0]['fullpath']);
    $name = basename($recinfo['recordings'][0]['fullpath']);
    $ctype = $recinfo['recordings'][0]['mimetype'];

    $fp = fopen($recinfo['recordings'][0]['fullpath'], "rb");
    if (!$fp) {
        Header('HTTP/1.1 404 Not Found');
        die("<b>404 " . _tr("no_file") . " </b>");
    }
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public");
    header("Content-Description: wav file");
    header("Content-Type: " . $ctype);
    header("Content-Disposition: attachment; filename=" . $name);
    header("Content-Transfer-Encoding: binary");
    header("Content-length: " . $size);
    fpassthru($fp);
    fclose($fp);
}

function display_record($smarty, $module_name, $local_templates_dir, $user, $extension) {
    $file = getParameter("name");
    $ext = getParameter("ext");

    if (!hasModulePrivilege($user, $module_name, 'downloadany')) {
        if ($extension != $ext) {
            Header('HTTP/1.1 403 Forbidden');
            die("<b>403 " . _tr("no_extension") . " </b>");
        }
    }

    $paloVoice = new paloSantoVoiceMail();
    $recinfo = $paloVoice->resolveVoiceMailFiles($ext, $file);
    if (is_null($recinfo) || count($recinfo['recordings']) <= 0) {
        Header("HTTP/1.1 404 Not Found");
        die("<b>404 " . _tr("no_file") . "</b>");
    }
    $ctype = $recinfo['recordings'][0]['mimetype'];
    $audiourl = construirURL(array(
        'menu' => $module_name,
        'action' => 'download',
        'ext' => $ext,
        'name' => $file,
        'rawmode' => 'yes',
        'issabelSession' => session_id(),
    ));
    $sContenido = <<<contenido
<!DOCTYPE html>
<html>
<head><title>Issabel</title></head>
<body>
    <audio src="$audiourl" controls autoplay>
        <embed src="$audiourl" type="$ctype" width="300" height="20" autoplay="true" loop="false" />
    </audio>
    <br/>
</body>
</html>
contenido;
    return $sContenido;
}

function borrarVoicemails($smarty, $module_name, $local_templates_dir, $user, $extension) {
    $bPuedeBorrar = hasModulePrivilege($user, $module_name, 'deleteany');

    $listaArchivos = array();
    $paloVoice = new paloSantoVoiceMail();
    if (is_array($_POST))
        foreach ($_POST['voicemails'] as $name) {
            // El formato esperado de clave es 1064,msg0001
            $regs = NULL;
            if (preg_match('/^(\d+),(\w+)$/', $name, $regs)) {
                if ($bPuedeBorrar || $extension == $regs[1]) {
                    if (!$paloVoice->deleteVoiceMail($regs[1], $regs[2])) {
                        $smarty->assign("mb_title", _tr("ERROR"));
                        $smarty->assign("mb_message", $paloVoice->errMsg);
                        return FALSE;
                    }
                } else {
                    // Intento de borrar el voicemail de otro usuario
                    $smarty->assign("mb_title", _tr("ERROR"));
                    $smarty->assign("mb_message", _tr("Voicemail to delete not from current user"));
                    return FALSE;
                }
            }
        }
    return TRUE;
}

function createFieldFormVoiceList() {
    $arrayFields = [
        "date_start_shamsi" => [
            "LABEL" => _tr("Start Date"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "DATE_SHAMSI",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "ereg",
            "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"
        ],
        "date_start" => [
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "HIDDEN",
            "VALIDATION_TYPE" => "ereg",
            "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"
        ],
        "date_end_shamsi" => [
            "LABEL" => _tr("End Date"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "DATE_SHAMSI",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "ereg",
            "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"
        ],
        "date_end" => [
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "HIDDEN",
            "VALIDATION_TYPE" => "ereg",
            "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"
        ],
    ];
    return $arrayFields;
}

function createFieldFormConfig() {
    $arrFields = array(
        "email" => array("LABEL" => _tr('Email'),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "TEXT",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "email",
            "VALIDATION_EXTRA_PARAM" => ""),
        "pager_email" => array("LABEL" => _tr('Pager Email Address'),
            "REQUIRED" => "no",
            "INPUT_TYPE" => "TEXT",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "email",
            "VALIDATION_EXTRA_PARAM" => ""),
        "status" => array("LABEL" => _tr('Status'),
            "REQUIRED" => "no",
            "INPUT_TYPE" => "SELECT",
            "INPUT_EXTRA_PARAM" => array("Enable" => _tr("Enable"), "Disable" => _tr("Disable")),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "password" => array("LABEL" => _tr('Password'),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "PASSWORD",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "ereg",
            "VALIDATION_EXTRA_PARAM" => "[[:digit:]]+"),
        "password_confir" => array("LABEL" => _tr('Confirm Password'),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "PASSWORD",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "ereg",
            "VALIDATION_EXTRA_PARAM" => "[[:digit:]]+"),
        "email_attach" => array("LABEL" => _tr("Email Attachment"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "RADIO",
            "INPUT_EXTRA_PARAM" => array("Yes" => _tr("Yes"), "No" => _tr("No")),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "play_cid" => array("LABEL" => _tr("Play CID"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "RADIO",
            "INPUT_EXTRA_PARAM" => array("Yes" => _tr("Yes"), "No" => _tr("No")),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "play_envelope" => array("LABEL" => _tr("Play Envelope"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "RADIO",
            "INPUT_EXTRA_PARAM" => array("Yes" => _tr("Yes"), "No" => _tr("No")),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "delete_vmail" => array("LABEL" => _tr("Delete Vmail"),
            "REQUIRED" => "yes",
            "INPUT_TYPE" => "RADIO",
            "INPUT_EXTRA_PARAM" => array("Yes" => _tr("Yes"), "No" => _tr("No")),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
    );

    return $arrFields;
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
                'downloadany', // ¿Está autorizado el usuario a descargar voicemail de otros usuarios?
                'deleteany', // ¿Está autorizado el usuario a borrar voicemail de otros usuarios?
    )));
}

function dateG2J($date) {
    $monthsRev = [
        "..." => 0, 
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
        "Januray"     => 1,
        "February"    => 2,
        "March"       => 3,
        "April"       => 4,
        "May"         => 5,
        "June"        => 6,
        "Julay"       => 7,
        "August"      => 8,
        "September"   => 9,
        "October"     => 10,
        "November"    => 11,
        "December"    => 12
    ];
    
    $dh = new Application_Helper_date;
    $gregorian_date = explode(" ", $date);
    $gregorian_date[1] = $monthsRev[$gregorian_date[1]];
    $jalali_date = $dh->gregorian_to_jalali($gregorian_date[2], $gregorian_date[1], $gregorian_date[0]);

    return sprintf('%d/%02d/%02d', $jalali_date[0], $jalali_date[1], $jalali_date[2]);
}
