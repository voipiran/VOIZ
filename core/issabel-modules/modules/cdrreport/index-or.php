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
  $Id: index.php, Fri 09 Apr 2021 10:46:33 AM EDT, nicolas@issabel.com
*/
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoDB.class.php";
include_once "libs/paloSantoForm.class.php";
include_once "libs/paloSantoConfig.class.php";
include_once "libs/paloSantoCDR.class.php";
include_once "libs/paloSantoJSON.class.php";
require_once "libs/misc.lib.php";

function _moduleContent(&$smarty, $module_name)
{
    require_once "modules/$module_name/libs/ringgroup.php";
    require_once "modules/$module_name/libs/queues.php";

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
    
    //Filter local channels ;2 from channel field
    $filterLocalChannel = true;

    // DSN para consulta de cdrs
    $dsn  = generarDSNSistema('asteriskuser', 'asteriskcdrdb');
    $pDB  = new paloDB($dsn);
    $oCDR = new paloSantoCDR($pDB);

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
    $pDB_asterisk = new paloDB($dsn_asterisk);
    $oRG          = new RingGroup($pDB_asterisk);
    $dataRG       = $oRG->getRingGroup();
    $oQueue       = new Queue($pDB_asterisk);
    $dataQueue    = $oQueue->getQueue();
    $dataRG       = $dataRG + $dataQueue;
    $dataRG['']  = _tr('(Any ringgroup)');

    $disableCel = false;
    $query      = "DESC asteriskcdrdb.cel";
    $result     = $pDB->genQuery($query);
    if ($result === false) {
        $disableCel=true;
    }

    // Cadenas estáticas en la plantilla
    $smarty->assign(array(
        "Filter"    =>  _tr("Filter"),
    ));

    $arrFormElements = array(
        "date_start"  => array(
                            "LABEL"                  => _tr("Start Date"),
                            "REQUIRED"               => "yes",
                            "INPUT_TYPE"             => "DATE",
                            "INPUT_EXTRA_PARAM"      => "",
                            "VALIDATION_TYPE"        => "ereg",
                            "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"),
        "date_end"    => array(
                            "LABEL"                  => _tr("End Date"),
                            "REQUIRED"               => "yes",
                            "INPUT_TYPE"             => "DATE",
                            "INPUT_EXTRA_PARAM"      => "",
                            "VALIDATION_TYPE"        => "ereg",
                            "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"),
        "field_name"  => array(
                            "LABEL"                  => _tr("Field Name"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "SELECT",
                            "INPUT_EXTRA_PARAM"      => array( "dst"         => _tr("Destination"),
                                                               "src"         => _tr("Source"),
                                                               "channel"     => _tr("Src. Channel"),
                                                               "accountcode" => _tr("Account Code"),
                                                               "dstchannel"  => _tr("Dst. Channel"),
                                                               "did"         => _tr("DID"),
                                                               "userfield"   => _tr("User Field")),
                            "VALIDATION_TYPE"        => "ereg",
                            "VALIDATION_EXTRA_PARAM" => "^(dst|src|channel|dstchannel|accountcode|userfield|did)$"),
        "field_pattern" => array(
                            "LABEL"                  => _tr("Field"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "TEXT",
                            "INPUT_EXTRA_PARAM"      => "",
                            "VALIDATION_TYPE"        => "ereg",
                            "VALIDATION_EXTRA_PARAM" => "^[\*|[:alnum:]@_\.,\/\-]+$"),
        "status"  => array(
                            "LABEL"                  => _tr("Status"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "SELECT",
                            "INPUT_EXTRA_PARAM"      => array(
                                                        "ALL"         => _tr("ALL"),
                                                        "ANSWERED"    => _tr("ANSWERED"),
                                                        "BUSY"        => _tr("BUSY"),
                                                        "FAILED"      => _tr("FAILED"),
                                                        "NO ANSWER"  => _tr("NO ANSWER")),
                            "VALIDATION_TYPE"        => "text",
                            "VALIDATION_EXTRA_PARAM" => ""),
        "ringgroup"  => array(
                            "LABEL"                  => _tr("Ring Group"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "SELECT",
                            "INPUT_EXTRA_PARAM"      => $dataRG ,
                            "VALIDATION_TYPE"        => "text",
                            "VALIDATION_EXTRA_PARAM" => ""),
         "queue"  => array(
                            "LABEL"                  => _tr("Queue"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "SELECT",
                            "INPUT_EXTRA_PARAM"      => $dataQueue ,
                            "VALIDATION_TYPE"        => "text",
                            "VALIDATION_EXTRA_PARAM" => ""),
        "limit"  => array(  
                            "LABEL"                  => _tr("Limit"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "SELECT",
                            "INPUT_EXTRA_PARAM"      => array(
                                                        "100000" => _tr("100.000"),
                                                        "50000"  => _tr("50.000"),
                                                        "20000"  => _tr("20.000"),
                                                        "10000"  => _tr("10.000"),
                                                        "1000"   => _tr("1.000")),
                            "VALIDATION_TYPE"        => "text",
                            "VALIDATION_EXTRA_PARAM" => ""),
        "timeInSecs"     => array( 
                            "LABEL"                  => _tr("Show time in Secs"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "CHECKBOX",
                            "INPUT_EXTRA_PARAM"      => "",
                            "VALIDATION_TYPE"        => "text",
                            "VALIDATION_EXTRA_PARAM" => "",
                            "EDITABLE"               => "yes"),
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
        'limit'         => '100000',
        'timeInSecs'    => 'off',
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

    if($paramFiltro['date_start']==="") {
        $paramFiltro['date_start']  = " ";
    }

    if($paramFiltro['date_end']==="") {
        $paramFiltro['date_end']  = " ";
    }

    $valueFieldName = $arrFormElements['field_name']["INPUT_EXTRA_PARAM"][$paramFiltro['field_name']];
    $valueStatus    = $arrFormElements['status']["INPUT_EXTRA_PARAM"][$paramFiltro['status']];
    $valueRingGRoup = $arrFormElements['ringgroup']["INPUT_EXTRA_PARAM"][$paramFiltro['ringgroup']];

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
    $paramFiltro['date_end']   = translateDate($paramFiltro['date_end']).' 23:59:59';

    // Valores de filtrado que no se seleccionan mediante filtro
    if (!$bPuedeVerTodos) $paramFiltro['extension'] = $extension;

    // Ejecutar el borrado, si se ha validado.
    if (isset($_POST['delete'])) {
        if ($bPuedeBorrar) {
            if ($paramFiltro['date_start'] <= $paramFiltro['date_end']) {
                $paramFiltro['uniqueid'] = $_POST['UIDsList'];
                $r = $oCDR->borrarCDRs($paramFiltro);
                die($r);
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

    $arrData   = null;
    $limit     = $paramFiltro['limit'];
    $timeInSecs = $paramFiltro['timeInSecs'];
    $arrResult = $oCDR->listarCDRs($paramFiltro, $limit, 0, $filterLocalChannel);
    $total     = count($arrResult['cdrs']);

    if(is_array($arrResult['cdrs']) && $total>0) {
        foreach($arrResult['cdrs'] as $key => $value) {
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

            if ($timeInSecs == "on") {
                 $sTiempo = $iDuracion;
            } else {
                $iSec = $iDuracion % 60; $iDuracion = (int)(($iDuracion - $iSec) / 60);
                $iMin = $iDuracion % 60; $iDuracion = (int)(($iDuracion - $iMin) / 60);
                $sTiempo = "{$value[8]}s";
                if ($value[8] >= 60) {
                      if ($iDuracion > 0) $sTiempo = "{$iDuracion}h {$iMin}m {$iSec}s";
                      elseif ($iMin > 0)  $sTiempo = "{$iMin}m {$iSec}s";
                }
            }
            $arrTmp[8]  = $sTiempo;
            $arrTmp[9]  = $value[6];  // uniqueid
            $arrTmp[10] = $value[17]; // userfield
            $arrTmp[11] = $value[16]; // did

            if(!$disableCel) {
                $arrTmp[12] = '<a onclick="showCel(\''.$value[6].'\')"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> </a>';
            }
            
            $arrData[] = $arrTmp;
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
            alto = parent.document.body.clientHeight - 150;
            $('#gridModal').css('maxHeight',alto);
            $('#gridModal').css('overflow','scroll');
        }

        function celFrameLoaded() {
            fh = $('#celdetails').contents().find('html').height();
            if(fh==0) {fh=100;}
            $('#celdetails').height(fh);
            $('#gridModal').find('.modal-body').css({
              height: fh, 
            });
            $('.modal-dialog').css('top',$(window).scrollTop());
        }

        $('#gridModal').on('hidden.bs.modal', function () {
            $('#celdetails').attr('src','index.php?menu=".$module_name."&rawmode=yes&loading=yes');
        })
        $('#gridModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    ";

    $smarty->assign('customJS',$cel_code);

    $valueLimit = $arrFormElements['limit']["INPUT_EXTRA_PARAM"][$paramFiltro['limit']];
    if ($total == $paramFiltro['limit']) {
        $msgLimit =    '<font color=red>'.
                       '<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>'." ".
                       _tr("Limit")." = ".$valueLimit.
                       '</font>';
    } else {
        $msgLimit =    '<font color=green>'.
                       '<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>'." ".
                       _tr("Limit")." = ".$valueLimit.
                       '</font>';
    }

    $MsgFilter = "<b>"._tr("Filter applied: ")."</b>".
    '<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>'." ".
    _tr("Start Date")." = ".$paramFiltro['date_start'].", "._tr("End Date")." = ".
    $paramFiltro['date_end']." - ".
    '<span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>'." ".
    $valueFieldName." = ".$paramFiltro['field_pattern']. " - ".
    '<span class="glyphicon glyphicon-tag" aria-hidden="true"></span>'." ".
    _tr("Status")." = ".$valueStatus." - ".
    '<span class="glyphicon glyphicon-list" aria-hidden="true"></span>'." ".
    _tr("Ring Group")." = ".$valueRingGRoup." - ".
    $msgLimit;

    $arrColumns = array(_tr("Date"), _tr("Source"), _tr("Ring Group"), _tr("Destination"), _tr("Src. Channel"),_tr("Account Code"),_tr("Dst. Channel"),_tr("Status"),_tr("Duration"),_tr("UniqueID"),_tr("Recording"), _tr("Cnum"),_tr("Cnam"), _tr("Outbound Cnum"), _tr("DID"), _tr("User Field"));
    $smarty->assign("SHOW",        _tr("Show"));
    $smarty->assign("DELMSG",      _tr("Are you sure you wish to delete CDR(s) Report(s)?"));
    $smarty->assign("COLUMNS",     $arrColumns);
    $smarty->assign("FILTER_SHOW", _tr("Show Filter"));
    $smarty->assign("FILTER_MSG",  $MsgFilter);
    $smarty->assign("Filter",      _tr("Filter"));
    $lang = get_language();
    $smarty->assign("LANG",$lang);
    $smarty->assign("module_name", "cdrreport");
    $smarty->assign($arrFormElements); 
    $smarty->assign("CDR", json_encode($arrData));
    $paramFiltro['date_start'] = date('d M Y', strtotime($paramFiltro['date_start']));
    $paramFiltro['date_end']   = date('d M Y', strtotime($paramFiltro['date_end']));
    $content = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl", "", $paramFiltro);
    $content .= $smarty->fetch("$local_templates_dir/datatables.tpl");
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

?>
