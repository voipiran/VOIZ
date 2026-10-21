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
  */
include_once "libs/paloSantoJSON.class.php";
include_once "libs/paloSantoGrid.class.php";
include_once "libs/paloSantoForm.class.php";
include_once "libs/paloSantoACL.class.php";




function _moduleContent(&$smarty, $module_name)
{
    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoConfEcho.class.php";

    load_language_module($module_name);

    //global variables
    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf,$arrConfModule);

    require_once "modules/$module_name/libs/PaloSantoHardwareDetection.class.php";

    //folder path for custom templates
    $base_dir=dirname($_SERVER['SCRIPT_FILENAME']);
    $templates_dir=(isset($arrConf['templates_dir']))?$arrConf['templates_dir']:'themes';
    $local_templates_dir="$base_dir/modules/$module_name/".$templates_dir.'/'.$arrConf['theme'];


    //conexion resource
    $pDB = new paloDB($arrConf['dsn_conn_database']);

    $action = getAction();
    $content = "";

    switch($action){
        case "config_echol":
            $content = viewFormConfEchoCard($smarty, $module_name, $local_templates_dir, $pDB, $arrConf); // para configurar echo canceler
            break;
        case "config_echo":
            $content = viewFormConfEchoCardParam($smarty, $module_name, $local_templates_dir, $pDB, $arrConf); // para configurar echo canceler
            break;
        case 'config_span':
            $content = viewFormConfSpan($smarty, $module_name, $local_templates_dir, $pDB, $arrConf); // para configurar span
            break;
        case 'config_param':
            $content = viewFormConfSpanParam($smarty, $module_name, $local_templates_dir, $pDB, $arrConf); // para configurar span
            break;
        case "save_new":
            $content = saveNewConfEchoCard($smarty, $module_name, $local_templates_dir, $pDB, $arrConf); // save conf echo canceler
            break;
        case "save_span":
            $content = saveNewConfSpan($smarty, $module_name, $local_templates_dir, $pDB, $arrConf); // save conf span
            break;
/*
        case "setConfig":
            $content = setConfigHardware($pDB); 
            break;
*/
        case "detection":
            $content = hardwareDetect($smarty, $module_name, $local_templates_dir, $pDB, $arrConf); // detection button
            break;
        default:
            $content = listPorts($smarty, $module_name, $local_templates_dir, $pDB);
            break;
    }
    return $content;
}

function listPorts($smarty, $module_name, $local_templates_dir, $pDB) {

    $oPortsDetails = new PaloSantoHardwareDetection();
    $contenidoModulo = "";

    $arrSpanConf = $oPortsDetails->getSpanConfig($pDB);
    $arrCardManufacturer = $oPortsDetails->getCardManufacturer($pDB);
    $smarty->assign("arrSpanConf",$arrSpanConf);
    $smarty->assign("arrCardManufacturer",$arrCardManufacturer);

    $smarty->assign("HARDWARE_DETECT",_tr('Hardware Detect'));
    $smarty->assign("CHAN_DAHDI_REPLACE",_tr('Replace file chan_dahdi.conf'));
    $smarty->assign("DETECT_SANGOMA", _tr('Detect Sangoma hardware'));
    $smarty->assign("DETECT_mISDN", _tr('Detect ISDN hardware'));
    $smarty->assign("MODULE_NAME",$module_name);
    $smarty->assign("detectandoHardware",_tr('Hardware Detecting'));
    $smarty->assign("CARD",_tr('Card'));
    $smarty->assign("CARD_MISDN",_tr('Misdn Card'));
    $smarty->assign("CARD_NO_MOSTRAR",'DAHDI');
    $smarty->assign("PORT_NOT_FOUND",_tr('Ports not Founds'));
    $smarty->assign("NO_PUERTO",_tr("Port")." ");
    $smarty->assign("Channel_detected_notused",_tr('Channel detected and not used'));
    $smarty->assign("Channel_detected_use",_tr('Channel detected and in use'));
    $smarty->assign("Undetected_Channel",_tr('Undetected Channel'));
    $smarty->assign("SET_PARAMETERS_PORTS",_tr('You can set the parameters for these ports here'));
    $smarty->assign("Status_ports",_tr('Port Status'));
    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("EDIT", _tr("Edit"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("Configuration_Span", _tr("Configuration of Span"));
    $smarty->assign("Parameters_Span", _tr("Span Parameters"));
    $smarty->assign("Span_Settings", _tr("Span Settings"));
    $smarty->assign("Advanced", _tr("Advanced"));
    $smarty->assign("Preferences", _tr("Preferences"));
    $smarty->assign("Timing_source", _tr("Timing source"));
    $smarty->assign('Timing_source_title', _tr("Enter 0 if this port provides a master clock, or nonzero priority for clock source"));
    $smarty->assign("Line_build_out", _tr("Line build out"));
    $smarty->assign("Framing", _tr("Framing"));
    $smarty->assign("Coding", _tr("Coding"));
    $smarty->assign("NoPorts",_tr("No Ports availables"));
    $smarty->assign("LBL_LOADING",_tr("Loading SPAN"));
    $smarty->assign("LBL_SAVING",_tr("Saving configuration"));
    $smarty->assign("LBL_SAVED",_tr("Saved"));
    $smarty->assign("HARDWARE_CONTROL",_tr("Hardware Control"));
    $smarty->assign("CHANNELS_EMPTY",_tr("Channel Empty"));
    $smarty->assign("Media",_tr("ISDN PRI Media Type"));

    if($oPortsDetails->isInstalled_mISDN()){
        $smarty->assign("isInstalled_mISDN",true);
        $smarty->assign("MSG_isInstalled_mISDN", _tr('mISDN Driver Installed'));
    }
    else{
        $smarty->assign("isInstalled_mISDN",false);
        $smarty->assign("MSG_isInstalled_mISDN", _tr('mISDN Driver not Installed'));
    }

    $arrMisdnInfo = $oPortsDetails->getMisdnPortInfo();
    if(count($arrMisdnInfo)<=0)
        $arrMisdnInfo = "noMISDN";


    $arrPortsDetails = $oPortsDetails->getPorts($pDB);

    if(!(is_array($arrPortsDetails) && count($arrPortsDetails) >0)){
        $smarty->assign("CARDS_NOT_FOUNDS",$oPortsDetails->errMsg);
    }
    $arrGrid = array("title"    => _tr('Hardware Detector'),
            "icon"     => "modules/$module_name/images/system_hardware_detector.png",
            "width"    => "100%"
            );
    $contenidoModulo .= llenarTpl($local_templates_dir,$smarty,$arrGrid, $arrPortsDetails, $arrMisdnInfo);    
    return $contenidoModulo;
}

function llenarTpl($local_templates_dir,$smarty,$arrGrid, $arrData, $arrMisdn)
{
    $smarty->assign("title", $arrGrid['title']);
    $smarty->assign("icon",  $arrGrid['icon']);
    $smarty->assign("width", $arrGrid['width']);
    $smarty->assign("arrData", $arrData);
    $smarty->assign("arrMisdn", $arrMisdn);

    //Span Parameters
/*
    $smarty->assign('type_timing_source', array(
                              '0' => '0',
                              '1' => '1',
                              '2' => '2',
                              '3' => '3',
                              '4' => '4',
                              '5' => '5',
                              '6' => '6',
                              '7' => '7'));
*/

    $smarty->assign('type_lnbuildout', array(
                              '0' => _tr('0 db (CSU) / 0-133 feet (DSX-1)'),
                              '1' => _tr('133-266 feet (DSX-1)'),
                              '2' => _tr('266-399 feet (DSX-1)'),
                              '3' => _tr('399-533 feet (DSX-1)'),
                              '4' => _tr('533-655 feet (DSX-1)'),
                              '5' => _tr('-7.5db (CSU)'),
                              '6' => _tr('-15db (CSU)'),
                              '7' => _tr('-22.5db (CSU)')));

    $smarty->assign('type_media', array(
                              'T1' => _tr('T1: 24 channels, USA'),
                              'E1' => _tr('E1: 31 channels, Europe')));
/*
    //Card Manufacturer
    $smarty->assign('type_manufacturer', array(
                              'Digium' => 'Digium',
                              'OpenVox' => 'OpenVox',
                              'Rhino' => 'Rhino',
                              'Sangoma' => 'Sangoma',
                              'RedFone' => 'RedFone',
                              'XorCom' => 'XorCom',
                              'Dialogic' => 'Dialogic',
                              'Otros' => 'Otros' ));
*/
    return $smarty->fetch($local_templates_dir."/listPorts.tpl");
}

function hardwareDetect($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf)
{
    $chk_dahdi_replace     = getParameter("chk_dahdi_replace");
    $there_is_sangoma_card = getParameter("there_is_sangoma_card");
    $there_is_misdn_card   = getParameter("there_is_misdn_card");

    // Anular la configuración anterior de cancelador. Se refrescará en listPorts()
    $pconfEcho = new paloSantoConfEcho($pDB);
    $pconfEcho->deleteEchoCanceller();

    $oHardwareDetect = new PaloSantoHardwareDetection();
    $resultado  = $oHardwareDetect->hardwareDetection($chk_dahdi_replace,"/etc/asterisk",$there_is_sangoma_card, $there_is_misdn_card);

    $jsonObject = new PaloSantoJSON();
    $msgResponse['msg'] = $resultado;
    $jsonObject->set_message($msgResponse);
    return $jsonObject->createJSON();
}


function viewFormConfEchoCardParam($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf)
{

    $oForm = new paloForm($smarty,array());
  
    $smarty->assign("CARD",_tr('Card'));    
    $oPortsDetails = new PaloSantoHardwareDetection();
    $pconfEcho     = new paloSantoConfEcho($pDB);
    $card_id       = getParameter("cardId");
    $card_id       = str_replace("confSPAN","",$card_id);
    $arrPortsEcho  = $pconfEcho->getEchoCancellerByIdCard($card_id);

    //begin, Form data persistence to errors and other events.
    $_DATA  = $_POST;
    $id     = getParameter("id");
    $card_id = str_replace("confSPAN","",$card_id);
    $dataCard = $pconfEcho->getCardParameterById($card_id);

    if(is_array($arrPortsEcho) && count($arrPortsEcho)>1){
        $smarty->assign("arrPortsEcho", $arrPortsEcho);
        $i=1;
    }
  
    $msgResponse['type_echo_names'] = array(
                              'none'  => 'none',
                              'OSLEC' => 'OSLEC',
                              'MG2'   => 'MG2',
                              'KB1'   => 'KB1',
                              'SEC2'  => 'SEC2',
                              'SEC'   => 'SEC');
    $msgResponse['arrPortsEcho'] = $arrPortsEcho;
    $jsonObject = new PaloSantoJSON();
    $msgResponse['card_id'] = $card_id;
    $msgResponse['msg'] = "";
    $jsonObject->set_message($msgResponse);
    return $jsonObject->createJSON();

}

function viewFormConfEchoCard($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf)
{
     
    $oForm = new paloForm($smarty,array());
    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("CARD",_tr('Card'));
   
    $jsonObject   = new PaloSantoJSON();

    $response['html']  = $oForm->fetchForm("$local_templates_dir/_hdetector.tpl","", "");
    $response['title'] = _tr('Configuration of Span');

    $jsonObject->set_message($response);
    return $jsonObject->createJSON();

}
function viewFormConfSpanParam($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf)
{
    
    $oForm = new paloForm($smarty,array());
    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("CARD",_tr('Card'));
    $smarty->assign('Timing_source_title', _tr("Enter 0 if this port provides a master clock, or nonzero priority for clock source"));
    $smarty->assign("Timing_source", _tr("Timing source"));
    $smarty->assign("Line_build_out", _tr("Line build out"));
    $smarty->assign("Framing", _tr("Framing"));
    $smarty->assign("Coding", _tr("Coding")); 
    $smarty->assign("Media",_tr("ISDN PRI Media Type"));
    $smarty->assign('CRC', _tr('CRC'));
    $smarty->assign('type_lnbuildout', array(
                              '0' => _tr('0 db (CSU) / 0-133 feet (DSX-1)'),
                              '1' => _tr('133-266 feet (DSX-1)'),
                              '2' => _tr('266-399 feet (DSX-1)'),
                              '3' => _tr('399-533 feet (DSX-1)'),
                              '4' => _tr('533-655 feet (DSX-1)'),
                              '5' => _tr('-7.5db (CSU)'),
                              '6' => _tr('-15db (CSU)'),
                              '7' => _tr('-22.5db (CSU)')));
     $smarty->assign('type_media', array(
                              'T1' => _tr('T1: 24 channels, USA'),
                              'E1' => _tr('E1: 31 channels, Europe')));
    $jsonObject   = new PaloSantoJSON();

    $response['html']  = $oForm->fetchForm("$local_templates_dir/_parameters.tpl","", "");
    $response['title'] = _tr('Span Parameters');

    $jsonObject->set_message($response);
    return $jsonObject->createJSON();
} 

function viewFormConfSpan($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf)
{
    $oPortsDetails = new PaloSantoHardwareDetection();
    $pconfEcho     = new paloSantoConfEcho($pDB);
    $idSpan = str_replace('paramSPAN', '', getParameter('cardId'));
    $listaSpans = $oPortsDetails->leerSpanConfig($pDB, $idSpan);
    if (!is_array($listaSpans) || count($listaSpans) <= 0) return NULL;
    $response = array(
        'spaninfo'  =>  $listaSpans[$idSpan],
        'card_id'   =>  $idSpan,
    );

    $arrPortsEcho  = $pconfEcho->getEchoCancellerByIdCard($idSpan);
    $sMediaType = $response['spaninfo']['wanpipe_force_media'];
    if (is_null($sMediaType)) {
    	$sMediaType = 'BRI';
        if (count($arrPortsEcho) == 23) $sMediaType = 'T1';
        if (count($arrPortsEcho) == 30) $sMediaType = 'E1';
    }
    switch ($sMediaType) {
    case 'T1':
        // Este es un puerto T1
        $response['framing_options'] = array('esf', 'd4');
        $response['coding_options'] = array('b8zs', 'ami');
        $response['crc_options'] = array();
        break;
    case 'E1':
        $response['framing_options'] = array('ccs', 'cas');
        $response['coding_options'] = array('hdb3', 'ami');
        $response['crc_options'] = array('crc4', 'ncrc4');
        break;
    default:
        // Este es un puerto BRI
        $response['framing_options'] = array('ccs');
        $response['coding_options'] = array('ami');
        $response['crc_options'] = array();
        break;
    }

    $jsonObject = new PaloSantoJSON();
    $jsonObject->set_message($response);
    return $jsonObject->createJSON();
} 

function saveNewConfEchoCard($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf)
{
    $pconfEcho = new paloSantoConfEcho($pDB);

    $id_card = getParameter("idCard");
    $type_echo_selected = getParameter("data");
    $type_echo_actual   = getParameter("data2");
    $arrPorts           = explode(",",$type_echo_selected);//typeecho_1|OSLEC,typeecho_2|OSLEC,typeecho_3|OSLEC,typeecho_4|OSLEC,
    $arrPortsActual     = explode(",",$type_echo_actual);//tmpTypeEcho1|OSLEC,tmpTypeEcho2|OSLEC,tmpTypeEcho3|OSLEC,tmpTypeEcho4|OSLEC,
    $arrEchoPort        = "";
    $arrEchoPortActual  = "";

    //{"0":"typeecho_1|OSLEC","1":"typeecho_2|OSLEC","2":"typeecho_3|OSLEC","3":"typeecho_4|OSLEC"}
    for($i=0; $i<count($arrPorts)-1; $i++){
        $arr = explode("|",$arrPorts[$i]);
        $arrEchoPort[$arr[0]] = $arr[1];
    }

    //{"0":"tmpTypeEcho1|OSLEC","1":"tmpTypeEcho2|OSLEC","2":"tmpTypeEcho3|OSLEC","3":"tmpTypeEcho4|OSLEC"}
    for($i=0; $i<count($arrPortsActual)-1; $i++){
        $arr = explode("|",$arrPortsActual[$i]);
        $arrEchoPortActual[$arr[0]] = $arr[1];
    }
    $arrPortsEcho = $pconfEcho->getEchoCancellerByIdCard2($id_card);
    $dataCard = $pconfEcho->getCardParameterById($id_card);
    foreach($arrPortsEcho as $key => $value){
        $num = $value['num_port'];
        $type_echo_pas      = $arrEchoPortActual["tmpTypeEcho".$num]; // antes
        $type_echo_selected = $arrEchoPort["typeecho_".$num]; // despues
        $data = array();
        $data['echocanceller'] = $pDB->DBCAMPO($type_echo_selected);
        $pconfEcho->updateEchoCancellerCard($id_card, $num, $type_echo_selected);
    }
    $pconfEcho->refreshDahdiConfiguration();
    $jsonObject = new PaloSantoJSON();
    $msgResponse['msg']   = _tr("Card Configured");
    $jsonObject->set_message($msgResponse);
    return $jsonObject->createJSON();

}

function saveNewConfSpan($smarty, $module_name, $local_templates_dir, &$pDB, $arrConf)
{
    $bExito = TRUE;
    $estadoAnterior = NULL;
    $estadoNuevo = array(
        'span_num'              =>  getParameter('idSpan'),
        'tmsource'              =>  getParameter('tmsource'),
        'lnbuildout'            =>  getParameter('lnbuildout'),
        'framing'               =>  getParameter('framing'),
        'coding'                =>  getParameter('coding'),
        'crc'                   =>  getParameter('crc'),
        'wanpipe_force_media'   =>  getParameter('media_pri'),
    );
    $response = array(
        'msg'   =>  _tr('Saved'),
        'reload'    =>  FALSE,
    );
    $oPortsDetails = new PaloSantoHardwareDetection();
    if ($bExito) {
        $listaSpans = $oPortsDetails->leerSpanConfig($pDB, $estadoNuevo['span_num']);
        if (!is_array($listaSpans) || count($listaSpans) <= 0) {
        	$bExito = FALSE;
            $response['msg'] = _tr('Span is invalid or out of range').$oPortsDetails->errMsg;
        } else {
        	$estadoAnterior = $listaSpans[$estadoNuevo['span_num']];
            if (is_null($estadoAnterior['wanpipe_force_media']))
                $estadoNuevo['wanpipe_force_media'] = NULL;
        }
    }
    if ($bExito) {
        $bExito = $oPortsDetails->guardarSpanConfig(
            $pDB,
            $estadoNuevo['span_num'], 
            $estadoNuevo['tmsource'],
            $estadoNuevo['lnbuildout'],
            $estadoNuevo['framing'],
            $estadoNuevo['coding'],
            $estadoNuevo['crc'],
            $estadoNuevo['wanpipe_force_media']);
        if (!$bExito) {
        	$response['msg'] = $oPortsDetails->errMsg;
        }
    }
    if ($bExito) {
    	// Se verifica si se cambia medio de tarjeta Sangoma.
        if (!is_null($estadoAnterior['wanpipe_force_media']) && 
            $estadoAnterior['wanpipe_force_media'] != $estadoNuevo['wanpipe_force_media']) {
        	/* Se requiere re-enumerar las tarjetas con hardware detector. Se
             * asume que se debe de agregar la bandera de detectar Sangoma. 
             * También se asume que el acto de iniciar la detección de hardware
             * no cambia el ID de span que fue modificado. */
            $response['reload'] = TRUE;
            $resultado  = $oPortsDetails->hardwareDetection(
                '',
                "/etc/asterisk",
                'true', // Detección de Sangoma 
                '' // TODO: qué se hace si de verdad hay tarjetas MISDN?
                );
            
            /* Invalidar la configuración anterior de cancelador de eco */
            $oPortsDetails->getPorts($pDB);

            // Volver a escribir el estado deseado
            $bExito = $oPortsDetails->guardarSpanConfig(
                $pDB,
                $estadoNuevo['span_num'], 
                $estadoNuevo['tmsource'],
                $estadoNuevo['lnbuildout'],
                $estadoNuevo['framing'],
                $estadoNuevo['coding'],
                $estadoNuevo['crc'],
                $estadoNuevo['wanpipe_force_media']);
            if (!$bExito) {
                $response['msg'] = $oPortsDetails->errMsg;
            }
        }
    }
    if ($bExito) {
    	$bExito = $oPortsDetails->refreshDahdiConfiguration();
        if (!$bExito) {
            $response['msg'] = $oPortsDetails->errMsg;
        }
        $oPortsDetails->transferirSpanConfig($pDB);
    }
    if (!$bExito) $response['msg'] = 'FAILED: '.$response['msg'];

	$jsonObject = new PaloSantoJSON();
    $jsonObject->set_message($response);
    return $jsonObject->createJSON();
}

function createFieldForm()
{
    $arrTypeEcho = array('none' => 'none', 'OSLEC' => 'OSLEC', 'MG2' => 'MG2', 'KB1' => 'KB1', 'SEC2' => 'SEC2', 'SEC' => 'SEC');

    $arrFields = array(
        "0"   => array(         "LABEL"                  => "",
                                "REQUIRED"               => "no",
                                "INPUT_TYPE"             => "SELECT",
                                "INPUT_EXTRA_PARAM"      => $arrTypeEcho,
                                "VALIDATION_TYPE"        => "text",
                                "VALIDATION_EXTRA_PARAM" => "",
                                "EDITABLE"               => "si"
                        ),
    );

    return $arrFields;
}

/*
function setConfigHardware(&$pDB)
{
    $oPortsDetails = new PaloSantoHardwareDetection();
    $oPortsDetails->guardarSpanConfig(
        $pDB,
        getParameter("idSpan"), 
        getParameter("tmsource"),
        getParameter("lnbuildout"),
        getParameter("framing"),
        getParameter("coding"));
    $oPortsDetails->refreshDahdiConfiguration();
    return "";    
}
*/

function setDataCardHardware(&$pDB){
    $arrCardParam  = array();
    $idCard        = getParameter("idCard");
    $oPortsDetails = new PaloSantoHardwareDetection();

    $arrCardParam['manufacturer'] = $pDB->DBCAMPO(getParameter("manufacturer"));
    $arrCardParam['num_serie']    = $pDB->DBCAMPO(trim(getParameter("num_serie")));
    $oPortsDetails->updateCardParameter($pDB, $arrCardParam, array("id_card"=>$idCard));
    return $idCard;
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
    else if(getParameter("action")=="config_echo")
        return "config_echo";
    else if(getParameter("action")=="config_echol")
        return "config_echol";
    else if(getParameter("action")=="config_param")
        return "config_param";
    else if(getParameter("action")=="config_span")
        return "config_span";
    else if(getParameter("action")=="setConfig")
        return "setConfig";
    else if(getParameter("action")=="detection")
        return "detection";
    else if(getParameter("action")=="save_echo")
        return "save_new";
    else if(getParameter("action")=="save_span")
        return "save_span";
    else
        return "report"; //cancel
}

?>
