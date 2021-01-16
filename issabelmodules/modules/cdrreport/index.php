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
  $Id: index.php, Thu 05 Dec 2019 03:51:40 PM EST, nicolas@issabel.com
*/
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoDB.class.php";
include_once "libs/paloSantoForm.class.php";
include_once "libs/paloSantoConfig.class.php";
include_once "libs/paloSantoCDR.class.php";
require_once "libs/misc.lib.php";
require_once "libs/date.php";

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
if (isset($_POST["date_start"])) {
    $date_parts = explode("-", $_POST["date_start"]);
    $gregorian_date = $dh->jalali_to_gregorian($date_parts[0], $date_parts[1], $date_parts[2]);
    $gregorian_date[1] = $months[$gregorian_date[1]];

    if (strlen($gregorian_date[2]) == 1) {
        $gregorian_date[2] = "0" . $gregorian_date[2];
    }
    $_POST["date_start"] = $gregorian_date[2] . " " . $gregorian_date[1] . " " . $gregorian_date[0];
    $_GET["date_start"] = $_POST["date_start"];

    $date_parts = explode("-", $_POST["date_end"]);
    $gregorian_date = $dh->jalali_to_gregorian($date_parts[0], $date_parts[1], $date_parts[2]);
    if (strlen($gregorian_date[2]) == 1) {
        $gregorian_date[2] = "0" . $gregorian_date[2];
    }
    $gregorian_date[1] = $months[$gregorian_date[1]];
    $_POST["date_end"] = $gregorian_date[2] . " " . $gregorian_date[1] . " " . $gregorian_date[0];
    $_GET["date_end"] = $_POST["date_end"];
}


function _moduleContent(&$smarty, $module_name)
{
    require_once "modules/$module_name/libs/ringgroup.php";

    //include module files
    include_once "modules/$module_name/configs/default.conf.php";

    load_language_module($module_name);

    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf,$arrConfModule);

    //folder path for custom templates
    $base_dir=dirname($_SERVER['SCRIPT_FILENAME']);
    $templates_dir=(isset($arrConf['templates_dir']))?$arrConf['templates_dir']:'themes';
    $local_templates_dir="$base_dir/modules/$module_name/".$templates_dir.'/'.$arrConf['theme'];

    // DSN para consulta de cdrs
    $dsn = generarDSNSistema('asteriskuser', 'asteriskcdrdb');
    $pDB     = new paloDB($dsn);
    $oCDR    = new paloSantoCDR($pDB);

    $pDBACL = new paloDB($arrConf['issabel_dsn']['acl']);
    if (!empty($pDBACL->errMsg)) {
        return "ERROR DE DB: $pDBACL->errMsg";
    }
    $pACL = new paloACL($pDBACL);
    if (!empty($pACL->errMsg)) {
        return "ERROR DE ACL: $pACL->errMsg";
    }
    $user = $_SESSION['issabel_user'];
    $extension = $pACL->getUserExtension($user);
    if ($extension == '') $extension = NULL;

    $bPuedeVerTodos = hasModulePrivilege($user, $module_name, 'reportany');

    // Sólo el administrador puede consultar con $extension == NULL
    if (is_null($extension)) {
        if ($bPuedeVerTodos)
            $smarty->assign("mb_message", "<b>"._tr("no_extension")."</b>");
        else{
            $smarty->assign("mb_message", "<b>"._tr("contact_admin")."</b>");
            return "";
        }
    }

    $bPuedeBorrar = hasModulePrivilege($user, $module_name, 'deleteany');

    // DSN para consulta de ringgroups
    $dsn_asterisk = generarDSNSistema('asteriskuser', 'asterisk');
    $pDB_asterisk=new paloDB($dsn_asterisk);
    $oRG    = new RingGroup($pDB_asterisk);
    $dataRG = $oRG->getRingGroup();
    $dataRG[''] = _tr('(Any ringgroup)');

    $disableCel=false;
    $query  = "DESC asteriskcdrdb.cel";
    $result = $pDB->genQuery($query);
    if ($result === false) {
        $disableCel=true;
    }

    // Cadenas estáticas en la plantilla
    $smarty->assign(array(
        "Filter"    =>  _tr("Filter"),
    ));

    $arrFormElements = array(
        "date_start"  => array("LABEL"                  => _tr("Start Date"),
                            "REQUIRED"               => "yes",
                            "INPUT_TYPE"             => "DATE",
                            "INPUT_EXTRA_PARAM"      => "",
                            "VALIDATION_TYPE"        => "ereg",
                            "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"),
        "date_end"    => array("LABEL"                  => _tr("End Date"),
                            "REQUIRED"               => "yes",
                            "INPUT_TYPE"             => "DATE",
                            "INPUT_EXTRA_PARAM"      => "",
                            "VALIDATION_TYPE"        => "ereg",
                            "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"),
        "field_name"  => array("LABEL"                  => _tr("Field Name"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "SELECT",
                            "INPUT_EXTRA_PARAM"      => array( "dst"         => _tr("Destination"),
                                                               "src"         => _tr("Source"),
                                                               "channel"     => _tr("Src. Channel"),
                                                               "accountcode" => _tr("Account Code"),
                                                               "dstchannel"  => _tr("Dst. Channel"),
                                                               "userfield"   => _tr("User Field")),
                            "VALIDATION_TYPE"        => "ereg",
                            "VALIDATION_EXTRA_PARAM" => "^(dst|src|channel|dstchannel|accountcode|userfield)$"),
        "field_pattern" => array("LABEL"                  => _tr("Field"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "TEXT",
                            "INPUT_EXTRA_PARAM"      => "",
                            "VALIDATION_TYPE"        => "ereg",
                            "VALIDATION_EXTRA_PARAM" => "^[\*|[:alnum:]@_\.,\/\-]+$"),
        "status"  => array("LABEL"                  => _tr("Status"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "SELECT",
                            "INPUT_EXTRA_PARAM"      => array(
                                                        "ALL"         => _tr("ALL"),
                                                        "ANSWERED"    => _tr("ANSWERED"),
                                                        "BUSY"        => _tr("BUSY"),
                                                        "FAILED"      => _tr("FAILED"),
                                                        "NO ANSWER "  => _tr("NO ANSWER")),
                            "VALIDATION_TYPE"        => "text",
                            "VALIDATION_EXTRA_PARAM" => ""),
        "ringgroup"  => array("LABEL"                  => _tr("Ring Group"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "SELECT",
                            "INPUT_EXTRA_PARAM"      => $dataRG ,
                            "VALIDATION_TYPE"        => "text",
                            "VALIDATION_EXTRA_PARAM" => ""),
        );

    $oFilterForm = new paloForm($smarty, $arrFormElements);

    // Parámetros base y validación de parámetros
    $url = array('menu' => $module_name);
    $paramFiltroBase = $paramFiltro = array(
        'date_start'    => date("d M Y"),
        'date_end'      => date("d M Y"),
        'field_name'    => 'dst',
        'field_pattern' => '',
        'status'        => 'ALL',
        'ringgroup'     =>  '',
    );
    foreach (array_keys($paramFiltro) as $k) {
        if (!is_null(getParameter($k))){
            $paramFiltro[$k] = getParameter($k);
        }
    }

    $oGrid  = new paloSantoGrid($smarty);

    if(isset($_REQUEST['loading'])) {
        $content="<html><body><div style='margin:auto; text-align:center'><img src='/modules/$module_name/images/loading.svg'></div>";
        return $content;
        die();
    }
//VOIPIRAN
    $dh = new Application_Helper_date;
    $date_parts = explode(" ", $paramFiltro['date_start']);
    $date_partsend = explode(" ", $paramFiltro['date_end']);
   
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
				   
    if(isset($_REQUEST['uniqueid'])) {
        $oGrid->setTitle(_tr("CDR Events"));
        $arrColumns =array('eventtime', 'eventtype', 'cid_name', 'cid_num', 'cid_dnid', 'exten', 'appname', 'uniqueid');
        $columnas = implode(",",$arrColumns);

        $sPeticionSQL = "SELECT linkedid FROM cel WHERE uniqueid=? LIMIT 1";
        $paramSQL=array($_REQUEST['uniqueid']);
        $arrData = $pDB->fetchTable($sPeticionSQL, FALSE, $paramSQL);
        $linkedId = $arrData[0][0];
        $sPeticionSQL = "SELECT $columnas FROM cel WHERE linkedid=?";
        $paramSQL = array($linkedId);

        $arrData = $pDB->fetchTable($sPeticionSQL, FALSE, $paramSQL);
        $oGrid->setColumns($arrColumns);
        $oGrid->setData($arrData);
        $content = $smarty->fetch("$local_templates_dir/cel.tpl");
        $content.= $oGrid->fetchGrid();
        return $content;
        die();
    }
	
    if($paramFiltro['date_start']==="")
        $paramFiltro['date_start']  = " ";


    if($paramFiltro['date_end']==="")
        $paramFiltro['date_end']  = " ";


        $valueFieldName = $arrFormElements['field_name']["INPUT_EXTRA_PARAM"][$paramFiltro['field_name']];
        $valueStatus = $arrFormElements['status']["INPUT_EXTRA_PARAM"][$paramFiltro['status']];
        $valueRingGRoup = $arrFormElements['ringgroup']["INPUT_EXTRA_PARAM"][$paramFiltro['ringgroup']];


    $oGrid->addFilterControl(_tr("Filter applied: ")._tr("Start Date")." = ".$date_startm.", "._tr("End Date")." = ".
    $date_endm, $paramFiltro, array('date_start' => date("d M Y"),'date_end' => date("d M Y")),true);

    $oGrid->addFilterControl(_tr("Filter applied: ").$valueFieldName." = ".$paramFiltro['field_pattern'],$paramFiltro, array('field_name' => "dst",'field_pattern' => ""));

    $oGrid->addFilterControl(_tr("Filter applied: ")._tr("Status")." = ".$valueStatus,$paramFiltro, array('status' => 'ALL'),true);

    $oGrid->addFilterControl(_tr("Filter applied: ")._tr("Ring Group")." = ".$valueRingGRoup,$paramFiltro, array('ringgroup' => ''));


    $htmlFilter = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl", "", $paramFiltro);
    if (!$oFilterForm->validateForm($paramFiltro)) {
        $smarty->assign(array(
            'mb_title'      =>  _tr('Validation Error'),
            'mb_message'    =>  '<b>'._tr('The following fields contain errors').':</b><br/>'.
                                implode(', ', array_keys($oFilterForm->arrErroresValidacion)),
        ));
        $paramFiltro = $paramFiltroBase;
        unset($_POST['delete']);    // Se aborta el intento de borrar CDRs, si había uno.
    }

    // Tradudir fechas a formato ISO para comparación y para API de CDRs.
    $url = array_merge($url, $paramFiltro);
    $paramFiltro['date_start'] = translateDate($paramFiltro['date_start']).' 00:00:00';
    $paramFiltro['date_end'] = translateDate($paramFiltro['date_end']).' 23:59:59';

    // Valores de filtrado que no se seleccionan mediante filtro
    if (!$bPuedeVerTodos) $paramFiltro['extension'] = $extension;

    // Ejecutar el borrado, si se ha validado.
    if (isset($_POST['delete'])) {
        if ($bPuedeBorrar) {
            if ($paramFiltro['date_start'] <= $paramFiltro['date_end']) {
                $r = $oCDR->borrarCDRs($paramFiltro);
                if (!$r) $smarty->assign(array(
                    'mb_title'      =>  _tr('ERROR'),
                    'mb_message'    =>  $oCDR->errMsg,
                ));
            } else {
                $smarty->assign(array(
                    'mb_title'      =>  _tr('ERROR'),
                    'mb_message'    =>  _tr("Please End Date must be greater than Start Date"),
                ));
            }
        } else {
            $smarty->assign(array(
                'mb_title'      =>  _tr('ERROR'),
                'mb_message'    =>  _tr("Only administrators can delete CDRs"),
            ));
        }
    }

    $oGrid->setTitle(_tr("CDR Report"));
    $oGrid->pagingShow(true); // show paging section.

    $oGrid->enableExport();   // enable export.
    $oGrid->setNameFile_Export(_tr("CDRReport"));
    $oGrid->setURL($url);
    if ($bPuedeBorrar)
        $oGrid->deleteList("Are you sure you wish to delete CDR(s) Report(s)?","delete",_tr("Delete"));

    $arrData = null;
    $total = $oCDR->contarCDRs($paramFiltro);

    if($oGrid->isExportAction()){
        $limit = $total;
        $offset = 0;

       $arrColumns = array(_tr("Date"), _tr("Source"), _tr("Ring Group"), _tr("Destination"), _tr("Src. Channel"),_tr("Account Code"),_tr("Dst. Channel"),_tr("Status"),_tr("Duration"),_tr("UniqueID"),_tr("Recording"), _tr("Cnum"),_tr("Cnam"), _tr("Outbound Cnum"), _tr("DID"),_tr("User Field"));  

      $oGrid->setColumns($arrColumns);

        $arrResult = $oCDR->listarCDRs($paramFiltro, $limit, $offset);
		//VOIPIRAN												 
        $arrResult = $oCDR->listarCDRs($paramFiltro, $limit, $offset);
        $dh = new Application_Helper_date;
        if (is_array($arrResult['cdrs']) && $total > 0) {
            foreach ($arrResult['cdrs'] as $key => $value) {
                $value[0] = $dh->npdate($value[0]);
                $prdate = explode(" ", $value[0]);
                $prtime = explode("&nbsp;", $prdate[6]);

                $value[0] = $prdate[5] . "-" . $prdate[3] . "-" . $prdate[1] . " " . $prtime[5];

      //  if(is_array($arrResult['cdrs']) && $total>0){
      //      foreach($arrResult['cdrs'] as $key => $value){
                $arrTmp[0] = $value[0];
                $arrTmp[1] = $value[1];
                $arrTmp[2] = $value[11];
                $arrTmp[3] = $value[2];
                $arrTmp[4] = $value[3];
                $arrTmp[5] = $value[9];
                $arrTmp[6] = $value[4];
                $arrTmp[7] = $value[5];
                $iDuracion = $value[8];
                $iSec = $iDuracion % 60; $iDuracion = (int)(($iDuracion - $iSec) / 60);
                $iMin = $iDuracion % 60; $iDuracion = (int)(($iDuracion - $iMin) / 60);
                $sTiempo = "{$value[8]} ثانیه";
                if ($value[8] >= 60) {
                      if ($iDuracion > 0) $sTiempo .= " ({$iDuracion}ساعت {$iMin}دقیقه {$iSec}ثانیه)";
                      elseif ($iMin > 0)  $sTiempo .= " ({$iMin}دقیقه {$iSec}ثانیه)";
                }
                $arrTmp[8]  = $sTiempo;

                $arrTmp[9]  = $value[6];  //uniqueid
                $arrTmp[10] = $value[12]; //recordingfile 
                $arrTmp[11] = $value[13]; //cnum 
                $arrTmp[12] = $value[14]; //cnam
                $arrTmp[13] = $value[15]; //outbound_cnum
                $arrTmp[14] = $value[16]; //did
                $arrTmp[15] = $value[17]; //userfield
                
                $arrData[] = $arrTmp;
            }
        }
        if (!is_array($arrResult)) {
        $smarty->assign(array(
            'mb_title'      =>  _tr('ERROR'),
            'mb_message'    =>  $oCDR->errMsg,
        ));
        }
    }else {
        $limit = 20;
        $oGrid->setLimit($limit);
        $oGrid->setTotal($total);

        $offset = $oGrid->calculateOffset();
        $arrResult = $oCDR->listarCDRs($paramFiltro, $limit, $offset);

        $arrColumns = array(_tr("Date"), _tr("Source"), _tr("Ring Group"), _tr("Destination"), _tr("Src. Channel"),_tr("Account Code"),_tr("Dst. Channel"),_tr("Status"),_tr("Duration"),_tr("Uniqueid"),_tr("User Field"));
        if(!$disableCel) { $arrColumns[]=''; }
        $oGrid->setColumns($arrColumns);
//VOIPIRAN
        $dh = new Application_Helper_date;
        if (is_array($arrResult['cdrs']) && $total > 0) {
            foreach ($arrResult['cdrs'] as $key => $value) {

                $value[0] = $dh->npdate($value[0]);
                $prdate = explode(" ", $value[0]);
                $prtime = explode("&nbsp;", $prdate[6]);
                $value[0] = $prdate[5] . "-" . $prdate[3] . "-" . $prdate[1] . " " . $prtime[5];
//        if(is_array($arrResult['cdrs']) && $total>0){
 //           foreach($arrResult['cdrs'] as $key => $value){
                $arrTmp[0] = $value[0];
                $arrTmp[1] = $value[1];
                $arrTmp[2] = $value[11];
                $arrTmp[3] = $value[2];
                $arrTmp[4] = $value[3];
                $arrTmp[5] = $value[9];
                $arrTmp[6] = $value[4];

                if ($value[5] == "ANSWERED") {
                   $value[5] = "<font color=green>"._tr($value[5])."</font>";
                }
                elseif ($value[5] == "NO ANSWER") {
                   $value[5] = "<font color=red>"._tr($value[5])."</font>";
                }
                elseif ($value[5] == "BUSY") {
                    $value[5] = "<font color=ambar>"._tr($value[5])."</font>";
                }
                elseif ($value[5] == "FAILED") {
                    $value[5] = "<font color=red>"._tr($value[5])."</font>";
                }
                else {
                    $value[5] = "<font color=red>$value[5]</font>";
                }

                $arrTmp[7] = $value[5];
                $iDuracion = $value[8];
                $iSec = $iDuracion % 60; $iDuracion = (int)(($iDuracion - $iSec) / 60);
                $iMin = $iDuracion % 60; $iDuracion = (int)(($iDuracion - $iMin) / 60);
                $sTiempo = "{$value[8]} ثانیه";
                if ($value[8] >= 60) {
                      if ($iDuracion > 0) $sTiempo .= " ({$iDuracion} ساعت {$iMin} دقیقه {$iSec} ثانیه)";
                      elseif ($iMin > 0)  $sTiempo .= " ({$iMin} دقیقه {$iSec} ثانیه)";
                }
                $arrTmp[8]  = $sTiempo;
                $arrTmp[9]  = $value[6]; // uniqueid
                $arrTmp[10] = $value[17]; // userfield

                if(!$disableCel) {
                    $arrTmp[11] = '<a onclick="showCel(\''.$value[6].'\')"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> </a>';
                }
                
                $arrData[] = $arrTmp;
            }
        }
        if (!is_array($arrResult)) {
        $smarty->assign(array(
            'mb_title'      =>  _tr('ERROR'),
            'mb_message'    =>  $oCDR->errMsg,
        ));
        }
    }
    $smarty->assign('modalClass','modal-lg');
    $smarty->assign('modalContent','<iframe id="celdetails" onLoad="celFrameLoaded();" src="index.php?menu='.$module_name.'&rawmode=yes&loading=yes" frameborder=0 width="100%" height="100px"></iframe>');

    $cel_code = "
        function showCel(uniqueid) {
            $('#celdetails').attr('src','index.php?menu=".$module_name."&rawmode=yes&uniqueid='+uniqueid);
            $('#gridModal').modal();
        }

        function celFrameLoaded() {
            fh = $('#celdetails').contents().find('html').height();
            if(fh==0) {fh=100;}
            $('#celdetails').height(fh);
            $('#gridModal').find('.modal-body').css({
              height: fh, 
            });
        }

        $('#gridModal').on('hidden.bs.modal', function () {
            $('#celdetails').attr('src','index.php?menu=".$module_name."&rawmode=yes&loading=yes');
        })
    ";

    $smarty->assign('customJS',$cel_code);

    $oGrid->setData($arrData);
    $smarty->assign("SHOW", _tr("Show"));
    $oGrid->showFilter($htmlFilter);
    $content = $oGrid->fetchGrid();
    return $content;
}

// Abstracción de privilegio por módulo hasta implementar (Elastix bug #1100).
// Parámetro $module se usará en un futuro al implementar paloACL::hasModulePrivilege().
function hasModulePrivilege($user, $module, $privilege)
{
    global $arrConf;

    $pDB = new paloDB($arrConf['issabel_dsn']['acl']);
    $pACL = new paloACL($pDB);

    if (method_exists($pACL, 'hasModulePrivilege'))
        return $pACL->hasModulePrivilege($user, $module, $privilege);

    $isAdmin = ($pACL->isUserAdministratorGroup($user) !== FALSE);
    return ($isAdmin && in_array($privilege, array(
        'reportany',    // ¿Está autorizado el usuario a ver la información de todos los demás?
        'deleteany',    // ¿Está autorizado el usuario a borrar CDRs?
    )));
}
