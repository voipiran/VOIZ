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

function _moduleContent(&$smarty, $module_name)
{
    require_once "modules/$module_name/configs/default.conf.php";
    require_once "modules/$module_name/libs/paloSantoMonitoring.class.php";

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
    $arrConf['dsn_conn_database'] = generarDSNSistema('asteriskuser', 'asteriskcdrdb');
    $pDB = new paloDB($arrConf['dsn_conn_database']);
    $pDBACL = new paloDB($arrConf['issabel_dsn']['acl']);
    $pACL = new paloACL($pDBACL);
    $user = isset($_SESSION['issabel_user'])?$_SESSION['issabel_user']:"";
    $extension = $pACL->getUserExtension($user);
    if ($extension == '') $extension = NULL;

    // Sólo el administrador puede consultar con $extension == NULL
    if (is_null($extension)) {
        if (hasModulePrivilege($user, $module_name, 'reportany'))
            $smarty->assign("mb_message", "<b>"._tr("no_extension")."</b>");
        else{
            $smarty->assign("mb_message", "<b>"._tr("contact_admin")."</b>");
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

function reportMonitoring($smarty, $module_name, $local_templates_dir, &$pDB, $pACL, $arrConf, $user, $extension)
{
    require_once "libs/paloSantoForm.class.php";
    $arrUniqueids=explode(',', $_POST['uniqueid']);    
    if (isset($_POST['submit_eliminar']) && isset($_POST['uniqueid']) &&
        is_array($arrUniqueids) && count($arrUniqueids) > 0) {
        deleteRecord($smarty, $module_name, $local_templates_dir, $pDB, $pACL, $arrConf, $user, $extension, $arrUniqueids);
    }

    $bPuedeVerTodos = hasModulePrivilege($user, $module_name, 'reportany');
    $bPuedeBorrar = hasModulePrivilege($user, $module_name, 'deleteany');

    $pMonitoring = new paloSantoMonitoring($pDB);

    $filter_field = getParameter("filter_field");

    switch($filter_field){
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
    if($filter_field == "recordingfile"){
        $filter_value     = getParameter("filter_value_recordingfile");
        $filter           = "";
        $filter_recordingfile = $filter_value;
    }
    else{
        $filter_value     = getParameter("filter_value");
        $filter           = $filter_value;
        $filter_recordingfile = "";
    }
    switch($filter_value){
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
    $date_ini = getParameter("date_start");
    $date_end = getParameter("date_end");
    $limit    = getParameter("limit");
    if ($limit == 0) {
        $limit = 100000;
    }

    $path_record = $arrConf['records_dir'];

    $_POST['date_start'] = isset($date_ini)?$date_ini:date("d M Y");
    $_POST['date_end']   = isset($date_end)?$date_end:date("d M Y");
    $_POST['limit']      = isset($limit)?$limit:'100000';

    if($date_ini===""){
        $_POST['date_start'] = " ";
    }
    if($date_end==="")
        $_POST['date_end'] = " ";

    if (!empty($pACL->errMsg)) {
        echo "ERROR DE ACL: $pACL->errMsg <br>";
    }

    $date_initial = date('Y-m-d',strtotime($_POST['date_start']))." 00:00:00";
    $date_final   = date('Y-m-d',strtotime($_POST['date_end']))." 23:59:59";
    $_DATA = $_POST;

    // TODO: agregar filtro por extensión de usuario de Issabel sólo para reportany

    // Se asume que sólo el administrador puede consultar con extension NULL
    $param = array(
        'date_start'    =>  $date_initial,
        'date_end'      =>  $date_final,
    );
    if (!$bPuedeVerTodos) $param['extension'] = $extension;
    if ($filter_field != '' && $filter_value != '') $param[$filter_field] = $filter_value;
    $total = $pMonitoring->getNumMonitoring($param);
    $url = array('menu' => $module_name);

    $paramFilter = array(
       'filter_field'           => $filter_field,
       'filter_value'           => $filter,
       'filter_value_recordingfile' => $filter_recordingfile,
       'date_start'             => $_POST['date_start'],
       'date_end'               => $_POST['date_end'],
       'limit'                  => isset($limit)?$limit:'100000',
    );
    $url = array_merge($url, $paramFilter);

    $arrData = null;
    $arrColumns = array(_tr("UniqueID"), _tr("Date"), _tr("Time"), _tr("Source"),
            _tr("Destination"),_tr("Duration"),_tr("Type"),_tr("Message"));

    // Se asume que sólo el administrador puede consultar con extension NULL
    $offset=0;
    $arrResult = $pMonitoring->getMonitoring($param, $limit, $offset);

    if (is_array($arrResult)) {
        foreach ($arrResult as $value) {
            $arrTmp = formatCallRecordingTuple($value);
            array_unshift($arrTmp, $value['uniqueid']);

            // checkbox(id_uniqueid) date time src dst hh:mm:ss rectype namefile
            if ($arrTmp[3] == '') $arrTmp[3] = "<font color='gray'>"._tr("unknown")."</font>";
            if ($arrTmp[4] == '') $arrTmp[4] = "<font color='gray'>"._tr("unknown")."</font>";
            $arrTmp[5] = "<label title='".$value['duration']." "._tr('seconds')."' style='color:green'>".$arrTmp[5]."</label>";

            if ($arrTmp[7] != 'deleted') {
                $esc_recfile = htmlentities($value['recordingfile'], ENT_COMPAT, 'UTF-8');
                $recinfo = $pMonitoring->resolveRecordingPath($value['recordingfile']);
                if (is_null($recinfo['fullpath'])) {
                    $recordingLink = '<span title="'.$esc_recfile.'" style="color: red"><b>'.
                        htmlentities(_tr('Recording missing', ENT_COMPAT, 'UTF-8')).'</b></span>';
                } else {
                    $urlparams = array(
                        'menu'      =>  $module_name,
                        'action'    =>  'display_record',
                        'id'        =>  $value['uniqueid'],
                        'namefile'  =>  $arrTmp[7],
                        'rawmode'   =>  'yes',
                    );
                    //$recordingLink = "<a title=\"$esc_recfile\" href=\"javascript:popUp('index.php?".urlencode(http_build_query($urlparams)."',350,100);")."\">"._tr("Listen")."</a>&nbsp;";
                    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
                    $recURL=$protocol.'://'.$_SERVER["HTTP_HOST"].'/'.'index.php?'.urlencode(http_build_query($urlparams));
                    $recordingLink = "<a title=\"$esc_recfile\" href=\"javascript:playaudio('".$recURL."')\">"._tr("Listen")."</a>&nbsp;";

                    $urlparams['action'] = 'download';
                    $recordingLink .= "<a title=\"$esc_recfile\" href='?".http_build_query($urlparams)."' >"._tr("Download")."</a>";
                }
            } else {
                $recordingLink = '';
            }
            $arrTmp[7] = $recordingLink;

            $arrData[] = $arrTmp;
        }
    }

    //begin section filter
    $arrFormFilterMonitoring = createFieldFilter();
    $oFilterForm = new paloForm($smarty, $arrFormFilterMonitoring);

    $smarty->assign("INCOMING", _tr("Incoming"));
    $smarty->assign("OUTGOING", _tr("Outgoing"));
    $smarty->assign("QUEUE", _tr("Queue"));
    $smarty->assign("GROUP", _tr("Group"));
    $smarty->assign("SHOW", _tr("Show"));
    $_POST["filter_field"]           = $filter_field;
    $_POST["filter_value"]           = $filter;
    $_POST["filter_value_recordingfile"] = $filter_recordingfile;
    $_POST["limit"]                  = $limit;

    $htmlFilter = $oFilterForm->fetchForm("$local_templates_dir/filter.tpl","",$_POST);
    //end section filter

   $valueLimit = number_format($limit,0,",",".");
    if ($total == $paramFilter['limit']) {
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
    _tr("Start Date")." = ".$paramFilter['date_start'].", "._tr("End Date")." = ".
    $paramFilter['date_end']." - ".
    '<span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>'." ".
    $filter_field." = ".$paramFilter['filter_value'] . _tr(ucfirst($paramFilter['filter_value_recordingfile'])) . " - ".
    $msgLimit;
    $smarty->assign("FILTER_SHOW"  , _tr("Show Filter"));
    $smarty->assign("FILTER_MSG"  , $MsgFilter);
    $smarty->assign("COLUMNS", $arrColumns);
    $smarty->assign("CDR", json_encode($arrData));
    $smarty->assign("DELMSG", _tr("message_alert"));
    $smarty->assign("puedeBorrar", json_encode($bPuedeBorrar));
    $lang = get_language();
    $smarty->assign("LANG",$lang);
    $smarty->assign("module_name","monitoring");
    $content .= $oFilterForm->fetchForm("$local_templates_dir/filter.tpl", "", $paramFilter);
    $content .= $smarty->fetch("$local_templates_dir/datatables.tpl");
    return $content;
}

function formatCallRecordingTuple($value)
{
    $namefile = basename($value['recordingfile']);
    if ($namefile == 'deleted') {
        $rectype = _tr('Deleted');
    } else switch($namefile[0]){
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

    // Prefer cnum to src if they differ, to show original extension instead of external cidnum
    $src       = isset($value['src']) ? $value['src'] : '';
    $cnum      = isset($value['cnum']) ? $value['cnum'] : '';
    $final_src = $src;
    if(($cnum != $src) && ($cnum != "")) {
        $final_src = $cnum;
    }

    return array(
        date('d/m/Y',strtotime($value['calldate'])),
        date('H:i:s',strtotime($value['calldate'])),
        $final_src,
        isset($value['dst']) ? $value['dst'] : '',
        SecToHHMMSS($value['duration']),
        $rectype,
        $namefile,
    );
}

function downloadFile($smarty, $module_name, $local_templates_dir, &$pDB, $pACL,
    $arrConf, $user, $extension)
{
    $record = getParameter("id");
    $namefile = getParameter('namefile');
    if (is_null($record) || !preg_match('/^[[:digit:]]+\.[[:digit:]]+$/', $record)) {
        // Missing or invalid uniqueid
        Header('HTTP/1.1 404 Not Found');
        die("<b>404 "._tr("no_file")." </b>");
    }

    $pMonitoring = new paloSantoMonitoring($pDB);
    if (!hasModulePrivilege($user, $module_name, 'downloadany')) {
        if (!$pMonitoring->recordBelongsToUser($record, $extension)) {
            Header('HTTP/1.1 403 Forbidden');
            die("<b>403 "._tr("You are not authorized to download this file")." </b>");
        }
    }

    // Check record is valid and points to an actual file
    $filebyUid = $pMonitoring->getAudioByUniqueId($record, $namefile);
    if (is_null($filebyUid) || count($filebyUid) <= 0) {
        // Uniqueid does not point to a record with specified file
        Header('HTTP/1.1 404 Not Found');
        die("<b>404 "._tr("no_file")." </b>");
    }
    if ($filebyUid['deleted']) {
        // Specified file has been deleted
        Header('HTTP/1.1 410 Gone');
        die("<b>410 "._tr("no_file")." </b>");
    }
    if (is_null($filebyUid['fullpath']) || is_null($filebyUid['mimetype'])) {
        Header('HTTP/1.1 404 Not Found');
        die("<b>404 "._tr("no_file")." </b>");
    }

    // Actually open and transmit the file
    $fp = fopen($filebyUid['fullpath'], 'rb');
    if (!$fp) {
        Header('HTTP/1.1 404 Not Found');
        die("<b>404 "._tr("no_file")." </b>");
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

function display_record($smarty, $module_name, $local_templates_dir, &$pDB, $pACL, $arrConf, $user, $extension){
    $file = getParameter("id");
    $namefile = getParameter('namefile');
    $pMonitoring = new paloSantoMonitoring($pDB);

    if (!hasModulePrivilege($user, $module_name, 'downloadany')) {
        if(!$pMonitoring->recordBelongsToUser($file, $extension)){
            return _tr("You are not authorized to listen this file");
        }
    }

    $recinfo = $pMonitoring->getAudioByUniqueId($file, $namefile);
    if (!is_array($recinfo)) {
        return $pMonitoring->errMsg;
    }
    $ctype = is_null($recinfo['mimetype']) ? '' : $recinfo['mimetype'];
    $audiourl = construirURL(array(
        'menu'             =>  $module_name,
        'action'           =>  'download',
        'id'               =>  $file,
        'namefile'         =>  $namefile,
        'rawmode'          =>  'yes',
        'issabelSession'   =>  session_id(),
    ));
    $sContenido=<<<contenido
<!DOCTYPE html>
<script>
modal.style.display = "block";
</script>
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
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    $sContenido=$protocol.'://'.$_SERVER["HTTP_HOST"].'/index.php'.$audiourl;
    return $sContenido;
}

function deleteRecord($smarty, $module_name, $local_templates_dir, &$pDB, $pACL, $arrConf, $user, $extension, $arrUniqueids)
{
    if (!hasModulePrivilege($user, $module_name, 'deleteany')) {
        $smarty->assign("mb_title", _tr("ERROR"));
        $smarty->assign("mb_message", _tr("You are not authorized to delete any records"));
        return FALSE;
    }
    $pMonitoring = new paloSantoMonitoring($pDB);
    $path_record = $arrConf['records_dir'];
    foreach ($arrUniqueids as $ID) {
        $nameFile=$pMonitoring->getAudioByUniqueId($ID);
        if ($nameFile['recordingfile'] != "") $pMonitoring->deleteRecordFile($ID, $nameFile['recordingfile']);
    }

    return TRUE;
}

function SecToHHMMSS($sec)
{
    $HH = 0;$MM = 0;$SS = 0;
    $segundos = $sec;

    if( $segundos/3600 >= 1 ){ $HH = (int)($segundos/3600);$segundos = $segundos%3600;} if($HH < 10) $HH = "0$HH";
    if(  $segundos/60 >= 1  ){ $MM = (int)($segundos/60);  $segundos = $segundos%60;  } if($MM < 10) $MM = "0$MM";
    $SS = $segundos; if($SS < 10) $SS = "0$SS";

    return "$HH:$MM:$SS";
}

function createFieldFilter(){
    $arrFilter = array(
            "src"       => _tr("Source"),
            "dst"       => _tr("Destination"),
            "recordingfile" => _tr("Type"),
                    );

    $arrFormElements = array(
            "date_start"  => array(           "LABEL"                  => _tr("Start_Date"),
                                              "REQUIRED"               => "yes",
                                              "INPUT_TYPE"             => "DATE",
                                              "INPUT_EXTRA_PARAM"      => "",
                                              "VALIDATION_TYPE"        => "ereg",
                                              "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"),
            "date_end"    => array(           "LABEL"                  => _tr("End_Date"),
                                              "REQUIRED"               => "yes",
                                              "INPUT_TYPE"             => "DATE",
                                              "INPUT_EXTRA_PARAM"      => "",
                                              "VALIDATION_TYPE"        => "ereg",
                                              "VALIDATION_EXTRA_PARAM" => "^[[:digit:]]{1,2}[[:space:]]+[[:alnum:]]{3}[[:space:]]+[[:digit:]]{4}$"),
            "filter_field" => array(          "LABEL"                  => _tr("Search"),
                                              "REQUIRED"               => "no",
                                              "INPUT_TYPE"             => "SELECT",
                                              "INPUT_EXTRA_PARAM"      => $arrFilter,
                                              "VALIDATION_TYPE"        => "text",
                                              "VALIDATION_EXTRA_PARAM" => ""),
            "filter_value" => array(          "LABEL"                  => "",
                                              "REQUIRED"               => "no",
                                              "INPUT_TYPE"             => "TEXT",
                                              "INPUT_EXTRA_PARAM"      => "",
                                              "VALIDATION_TYPE"        => "text",
                                              "VALIDATION_EXTRA_PARAM" => ""),
        "limit"  => array("LABEL"                  => _tr("Limit"),
                            "REQUIRED"               => "no",
                            "INPUT_TYPE"             => "SELECT",
                            "INPUT_EXTRA_PARAM"      => array(
                                                        "100000"         => _tr("100.000"),
                                                        "50000"    => _tr("50.000"),
                                                        "20000"        => _tr("20.000"),
                                                        "10000"      => _tr("10.000"),
                                                        "1000"  => _tr("1.000")),
                            "VALIDATION_TYPE"        => "text",
                            "VALIDATION_EXTRA_PARAM" => ""),
                    );
    return $arrFormElements;
}

// Abstracción de privilegio por módulo hasta implementar (Issabel bug #1100).
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
        'downloadany',  // ¿Está autorizado el usuario a descargar grabaciones de otros usuarios?
        'deleteany',    // ¿Está autorizado el usuario a borrar grabaciones (propias o de otros)?
    )));
}
