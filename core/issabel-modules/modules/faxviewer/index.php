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
  $Id: index.php,v 1.2 2007/09/07 01:18:43 gcarrillo Exp $ */
require_once 'libs/paloSantoForm.class.php';
require_once 'libs/paloSantoFaxVisor.class.php';
require_once 'libs/paloSantoDB.class.php';
require_once 'libs/paloSantoGrid.class.php';
require_once "libs/date.php";
//print_r($_POST); 
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
$dh = new Application_Helper_date;
if (isset($_POST["date_fax"])) {
    $date_fax = explode("-", $_POST["date_fax"]);
    $gregorian_date = $dh->jalali_to_gregorian($date_fax[0], $date_fax[1], $date_fax[2]);
    if (strlen($gregorian_date[1]) == 1) {
        $gregorian_date[1] = "0" . $gregorian_date[1];
    }
    if (strlen($gregorian_date[2]) == 1) {
        $gregorian_date[2] = "0" . $gregorian_date[2];
    }
    $_POST["date_fax"] = $gregorian_date[0] . "-" . $gregorian_date[1] . "-" . $gregorian_date[2];
    $_GET["date_fax"] = $_POST["date_fax"];

    // print_r($_POST);
    //print_r($_POST);exit;
}

function _moduleContent(&$smarty, $module_name) {
    require_once "modules/$module_name/configs/default.conf.php";

    load_language_module($module_name);

    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf, $arrConfModule);

    //folder path for custom templates
    $base_dir = dirname($_SERVER['SCRIPT_FILENAME']);
    $templates_dir = (isset($arrConf['templates_dir'])) ? $arrConf['templates_dir'] : 'themes';
    $local_templates_dir = "$base_dir/modules/$module_name/" . $templates_dir . '/' . $arrConf['theme'];

    switch (getAction()) {
        case 'edit':
            return actualizarFax($smarty, $module_name, $local_templates_dir);
        case 'download_faxFile':
            return download_faxFile();
        case 'report':
        default:
            return listarFaxes($smarty, $module_name, $local_templates_dir);
    }
}

function listarFaxes(&$smarty, $module_name, $local_templates_dir) {
    $dh = new Application_Helper_date;
    $smarty->assign(array(
        'SEARCH' => _tr('Search'),
    ));

    $oFax = new paloFaxVisor();

    // Generación del filtro
    $oFilterForm = new paloForm($smarty, getFormElements());

    // Parámetros base y validación de parámetros
    $url = array('menu' => $module_name);
    $paramFiltroBase = $paramFiltro = array(
        'name_company' => '',
        'fax_company' => '',
        'date_fax' => NULL,
        'filter' => 'All',
    );
    foreach (array_keys($paramFiltro) as $k) {
        if (!is_null(getParameter($k))) {
            $paramFiltro[$k] = getParameter($k);
        }
    }


    $oGrid = new paloSantoGrid($smarty);
    $arrType = array("All" => _tr('All'), "In" => _tr('in'), "Out" => _tr('out'));
    // developed by daghlavi

    $mgdate = explode("-", $paramFiltro['date_fax']);
    $jalalidate = $dh->gregorian_to_jalali($mgdate[0], $mgdate[1], $mgdate[2]);
    if (strlen($jalalidate[2]) == 1) {
        $jalalidate[2] = "0" . $jalalidate[2];
    }
    if (strlen($jalalidate[1]) == 1) {
        $jalalidate[1] = "0" . $jalalidate[1];
    }
    $jdate = $jalalidate[2] . "-" . $jalalidate[1] . "-" . $jalalidate[0];
    //$paramFiltro['date_fax'] = $jalalidate[2] ."-".$jalalidate[1]."-".$jalalidate[0];
    //print_r($paramFiltro['date_fax']);
    $oGrid->addFilterControl(_tr("Filter applied ") . _tr("Company Name") . " = " . $paramFiltro['name_company'], $paramFiltro, array("name_company" => ""));
    $oGrid->addFilterControl(_tr("Filter applied ") . _tr("Company Fax") . " = " . $paramFiltro['fax_company'], $paramFiltro, array("fax_company" => ""));
    $oGrid->addFilterControl(_tr("Filter applied ") . _tr("Fax Date") . " = " . $jdate, $paramFiltro, array("date_fax" => NULL));
    $oGrid->addFilterControl(_tr("Filter applied ") . _tr("Type Fax") . " = " . $arrType[$paramFiltro['filter']], $paramFiltro, array("filter" => "All"), true);

    $htmlFilter = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl", "", $paramFiltro);

    if (!$oFilterForm->validateForm($paramFiltro)) {
        $smarty->assign(array(
            'mb_title' => _tr('Validation Error'),
            'mb_message' => '<b>' . _tr('The following fields contain errors') . ':</b><br/>' .
            implode(', ', array_keys($oFilterForm->arrErroresValidacion)),
        ));
        $paramFiltro = $paramFiltroBase;
        unset($_POST['faxes_delete']);    // Se aborta el intento de borrar faxes, si había uno.
    }

    $url = array_merge($url, $paramFiltro);

    // Ejecutar el borrado, si se ha validado.
    if (isset($_POST['faxes_delete']) && isset($_POST['faxes']) &&
            is_array($_POST['faxes']) && count($_POST['faxes']) > 0) {
        $msgError = NULL;
        foreach ($_POST['faxes'] as $idFax) {
            if (!$oFax->deleteInfoFax($idFax)) {
                if ($oFax->errMsg = '')
                    $msgError = _tr('Unable to eliminate pdf file from the path.');
                else
                    $msgError = _tr('Unable to eliminate pdf file from the database.') . ' - ' . $oFax->errMsg;
            }
        }
        if (!is_null($msgError)) {
            $smarty->assign(array(
                'mb_title' => _tr('ERROR'),
                'mb_message' => $oFax->errMsg,
            ));
        }
    }

    $oGrid->setTitle(_tr("Fax Viewer"));
    $oGrid->setIcon("modules/$module_name/images/kfaxview.png");
    $oGrid->pagingShow(true); // show paging section.

    $oGrid->setURL($url);

    $arrData = NULL;
    $total = $oFax->obtener_cantidad_faxes($paramFiltro['name_company'], $paramFiltro['fax_company'], $paramFiltro['date_fax'], $paramFiltro['filter']);
    $limit = 20;
    $oGrid->setLimit($limit);
    $oGrid->setTotal($total);

    $offset = $oGrid->calculateOffset();
    $arrResult = $oFax->obtener_faxes($paramFiltro['name_company'], $paramFiltro['fax_company'], $paramFiltro['date_fax'], $offset, $limit, $paramFiltro['filter']);

    $oGrid->setColumns(array(
        "",
        _tr('Type'),
        _tr('File'),
        _tr('Company Name'),
        _tr('Company Fax'),
        _tr('Fax Destiny'),
        _tr('Fax Date'),
        _tr('Status'),
        _tr('Options')));

    if (is_array($arrResult) && $total > 0) {
        foreach ($arrResult as $fax) {
            //print_r($fax['date']);
            $missdate = explode(" ", $fax['date']);
            $mgdate = explode("-", $missdate[0]);
            $jalalidate = $dh->gregorian_to_jalali($mgdate[0], $mgdate[1], $mgdate[2]);
            if (strlen($jalalidate[1]) == 1) {
                $jalalidate[1] = "0" . $jalalidate[1];
            }
            if (strlen($jalalidate[2]) == 1) {
                $jalalidate[2] = "0" . $jalalidate[2];
            }
            $fax['date'] = implode("-", $jalalidate) . " " . $missdate[1];
            foreach (array('pdf_file', 'company_name', 'company_fax',
        'destiny_name', 'destiny_fax', 'errormsg') as $k)
                $fax[$k] = htmlentities($fax[$k], ENT_COMPAT, 'UTF-8');
            if (empty($fax['status']) && !empty($fax['errormsg']))
                $fax['status'] = 'failed';
            $arrData[] = array(
                '<input type="checkbox" name="faxes[]" value="' . $fax['id'] . '" />',
                _tr($fax['type']),
                (strtolower($fax['type']) == 'in' || strpos($fax['pdf_file'], '.pdf') !== FALSE) ? "<a href='?menu=$module_name&action=download&id=" . $fax['id'] . "&rawmode=yes'>" . $fax['pdf_file'] . "</a>" : $fax['pdf_file'],
                $fax['company_name'],
                $fax['company_fax'],
                $fax['destiny_name'] . " - " . $fax['destiny_fax'],
                $fax['date'],
                _tr($fax['status']) . (empty($fax['errormsg']) ? '' : ': ' . $fax['errormsg']),
                "<a href='?menu=$module_name&action=edit&id=" . $fax['id'] . "'>" . _tr('Edit') . "</a>"
            );
        }
    }
    if (!is_array($arrResult)) {
        $smarty->assign(array(
            'mb_title' => _tr('ERROR'),
            'mb_message' => $oFax->errMsg,
        ));
    }

    $oGrid->setData($arrData);
    $oGrid->deleteList(_tr('Are you sure you wish to delete fax (es)?'), "faxes_delete", _tr("Delete"));
    $oGrid->showFilter($htmlFilter);
    return $oGrid->fetchGrid();
}

function actualizarFax($smarty, $module_name, $local_templates_dir) {
    $smarty->assign(array(
        'CANCEL' => _tr('Cancel'),
        'APPLY_CHANGES' => _tr('Apply changes'),
        'REQUIRED_FIELD' => _tr('Required field'),
    ));
    $idFax = getParameter('id');
    if (isset($_POST['cancel']) || !ctype_digit("$idFax")) {
        header("Location: ?menu=$module_name");
        return;
    }
    $smarty->assign("id_fax", $idFax);

    $oFax = new paloFaxVisor();
    if (isset($_POST['save'])) {
        if (empty($_POST['name_company']) || empty($_POST['fax_company'])) {
            $smarty->assign("mb_title", _tr('ERROR') . ":");
            $smarty->assign("mb_message", _tr('ERROR'));
        } elseif (!$oFax->updateInfoFaxFromDB($idFax, $_POST['name_company'], $_POST['fax_company'])) {
            $smarty->assign("mb_title", _tr('ERROR') . ":");
            $smarty->assign("mb_message", _tr('ERROR'));
        } else {
            header("Location: ?menu=$module_name");
            return;
        }
    }

    $arrDataFax = $oFax->obtener_fax($idFax);
    if (is_array($arrDataFax) && count($arrDataFax) > 0) {
        if (!isset($_POST['name_company']))
            $_POST['name_company'] = $arrDataFax['company_name'];
        if (!isset($_POST['fax_company']))
            $_POST['fax_company'] = $arrDataFax['company_fax'];
    }
    $oForm = new paloForm($smarty, getFormElements());
    $htmlForm = $oForm->fetchForm("$local_templates_dir/edit.tpl", _tr('Edit'), $_POST);
    return "<form  method='POST' style='margin-bottom:0;' action='?menu=$module_name&action=edit'>" . $htmlForm . "</form>";
}

function getFormElements() {
    return array(
        "name_company" => array(
            "LABEL" => _tr('Company Name'),
            "REQUIRED" => "no",
            "INPUT_TYPE" => "TEXT",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "fax_company" => array(
            "LABEL" => _tr('Company Fax'),
            "REQUIRED" => "no",
            "INPUT_TYPE" => "TEXT",
            "INPUT_EXTRA_PARAM" => "",
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "date_fax" => array(
            "LABEL" => _tr('Fax Date'),
            "REQUIRED" => "no",
            "INPUT_TYPE" => "DATE",
            "INPUT_EXTRA_PARAM" => array("TIME" => false, "FORMAT" => "%Y-%m-%d", "TIMEFORMAT" => "12"),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
        "filter" => array(
            "LABEL" => _tr('Type Fax'),
            "REQUIRED" => "no",
            "INPUT_TYPE" => "SELECT",
            "INPUT_EXTRA_PARAM" => array("All" => _tr('All'), "In" => _tr('in'), "Out" => _tr('out')),
            "VALIDATION_TYPE" => "text",
            "VALIDATION_EXTRA_PARAM" => ""),
    );
}

function download_faxFile() {
    $oFax = new paloFaxVisor();
    $idFax = getParameter("id");
    $arrFax = $oFax->obtener_fax($idFax);
    $dir_backup = "/var/www/faxes";
    $file_path = $arrFax['faxpath'] . "/fax.pdf";
    $file_name = $arrFax['pdf_file'];

    if (!file_exists("$dir_backup/$file_path")) {
        header('HTTP/1.1 404 Not Found');
        return "File $file_path not found!";
    } else {
        header("Cache-Control: private");
        header("Pragma: cache");
        header('Content-Type: application/pdf');
        header("Content-Length: " . filesize("$dir_backup/$file_path"));
        header("Content-disposition: attachment; filename=$file_name");
        readfile("$dir_backup/$file_path");
    }
}

function getAction() {
    if (getParameter("action") == "edit")
        return "edit";
    else if (getParameter("action") == "download")
        return "download_faxFile";
    else
        return "report";
}

?>