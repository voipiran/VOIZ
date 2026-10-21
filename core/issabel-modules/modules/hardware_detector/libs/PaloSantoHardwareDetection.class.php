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
  $Id: puetos  */

//include_once("/var/www/html/libs/paloSantoDB.class.php");
//include_once("/var/www/html/modules/hardware_detector/libs/paloSantoConfEcho.class.php");

class PaloSantoHardwareDetection
{
    var $_DB; // instancia de la clase paloDB
    var $errMsg;

    function PaloSantoHardwareDetection()
    {

    }

    /**
     * Procedimiento para obtener el listado los puertos con la descripcion de la tarjeta
     *
     * @return array    Listado de los puertos
     */
    function getPorts($pDB)
    {
        $pconfEcho = new paloSantoConfEcho($pDB);
        $pconfEcho->deleteEchoCanceller();
        $pconfEcho->deleteCardParameter();
        //$this->deleteCardManufacturer($pDB);
        //$data = array();
        $tarjetas = array();
        $data = array();
        $data2 = array();
        $data3 = array();
        $exist_data = "no";
        unset($respuesta);
        exec('/usr/sbin/lsdahdi',$respuesta,$retorno);

        if($retorno==0 && $respuesta!=null && count($respuesta) > 0 && is_array($respuesta)){
            $idTarjeta = 0;
            $count = 0;
            foreach($respuesta as $key => $linea){
                $estado_asterisk       = _tr('Unknown');
                $estado_asterisk_color = "gray";
                $estado_dahdi_image    = "conn_unkown.png";
                if(preg_match("/^### Span[[:space:]]+([[:digit:]]{1,}): ([[:alnum:]| |-|\/]+)(.*)$/",$linea,$regs)){
                   $idTarjeta = $regs[1];
                   $dataCardParam = $this->getCardManufacturerById($pDB, $idTarjeta);
                   if(empty($dataCardParam)){
                   $dataCardParam['manufacturer'] = " ";
                   $dataCardParam['num_serie'] = " ";
                   $dataCardParam['id_card'] = " ";
                   }else $dataCardParam['id_card']=$idTarjeta;
                   if($dataCardParam['manufacturer']!=" "){
                        $exist_data="yes";
                        $data3['manufacturer'] = $pDB->DBCAMPO($dataCardParam['manufacturer']);
                   }else{ $data3['manufacturer']    = $pDB->DBCAMPO(" ");
                        $exist_data = "no";
                   }

                   if($dataCardParam['num_serie']!=" "){
                        $exist_data="yes";
                        $data3['num_serie'] = $pDB->DBCAMPO($dataCardParam['num_serie']);
                   }else{ $data3['num_serie'] = $pDB->DBCAMPO(" ");
                        $exist_data = "no";
                   }
                   if($dataCardParam['manufacturer']==" " && $dataCardParam['num_serie']==" " && $dataCardParam['id_card']==" "){
                        $data3['id_card']    = $pDB->DBCAMPO($regs[1]);
                        $this->addCardManufacturer($pDB, $data3);
                   }else $this->updateCardParameter($pDB, $data3, array("id_card"=>$regs[1]));
                   $tarjetas["TARJETA$idTarjeta"]['DESC'] = array(
                        'ID'                => $regs[1],
                        'TIPO'              => $regs[2],
                        'ADICIONAL'         => $regs[3],
                        'MANUFACTURER'      => $exist_data,
                        'MEDIA'             => NULL,
                        'MEDIA_SWITCHABLE'  =>  file_exists("/etc/wanpipe/wanpipe{$idTarjeta}.conf"));
                    $count++;
                    $data2['id_card']    = $pDB->DBCAMPO($regs[1]);
                    $data2['type']       = $pDB->DBCAMPO($regs[2]);
                    $data2['additonal']  = $pDB->DBCAMPO($regs[3]);

                    $pconfEcho->addCardParameter($data2);
                }
                else if(preg_match("/[[:space:]]*([[:digit:]]+) ([[:alnum:]_]+)[[:space:]]+([[:alnum:]-]+)[[:space:]]*(.*)/",$linea,$regs1)){
                    //Estados de las lineas
                   if(preg_match("/Hardware-assisted/i",$regs1[3].$regs1[4]) || preg_match("/HDLC(FCS)?/i",$regs1[3])){
                        if(preg_match("/In use.*RED/i",$regs1[4])){
                            $estado_asterisk       = _tr('Detected by Asterisk');
                            $estado_asterisk_color = "green";
                            $estado_dahdi_image    = "conn_alarm_HC.png";
                        }
                        else if(preg_match("/In use/i",$regs1[4])){
                            $estado_asterisk       = _tr('Detected by Asterisk');
                            $estado_asterisk_color = "green";
                            $estado_dahdi_image    = "conn_ok_HC.png";
                        }
                        else if(preg_match("/RED/i",$regs1[4])){
                            $estado_asterisk       = _tr('Not detected by Asterisk');
                            $estado_asterisk_color = "#FF7D7D";
                            $estado_dahdi_image    = "conn_alarm_HC.png";
                        }
                        else{
                            $estado_asterisk       = _tr('Not detected by Asterisk');
                            $estado_asterisk_color = "#FF7D7D";
                            $estado_dahdi_image    = "conn_ok_HC.png";
                        }
                   }
                   else if(preg_match("/In use.*RED/i",$regs1[4])){
                        $estado_asterisk       = _tr('Detected by Asterisk');
                        $estado_asterisk_color = "green";
                        $estado_dahdi_image    = "conn_alarm.png";
                   }
                   else if(preg_match("/In use/i",$regs1[4])){
                        $estado_asterisk       = _tr('Detected by Asterisk');
                        $estado_asterisk_color = "green";
                        $estado_dahdi_image    = "conn_ok.png";
                   }
                   else if(preg_match("/RED/i",$regs1[4])){
                        $estado_asterisk       = _tr('Not detected by Asterisk');
                        $estado_asterisk_color = "#FF7D7D";
                        $estado_dahdi_image    = "conn_alarm.png";
                   }
                   else{
                        $estado_asterisk       = _tr('Not detected by Asterisk');
                        $estado_asterisk_color = "#FF7D7D";
                        $estado_dahdi_image    = "conn_ok.png";
                   }

                    //Tipo de las lineas
                    $tipo = $regs1[2];
                    $tarjetas["TARJETA$idTarjeta"]['DESC']['MEDIA'] = $tipo;

                    $dataType=preg_split('/[:]/',$regs1[4],2);
                    if(count($dataType)>1){
                        $arrEcho=preg_split('/[^\w]/',trim($dataType[1]),2);
                        $data['num_port']       = $pDB->DBCAMPO($regs1[1]);
                        $data['name_port']       = $pDB->DBCAMPO($regs1[2]);
                        $data['echocanceller']   = $pDB->DBCAMPO(trim($arrEcho[0]));
                        $data['id_card']   = $pDB->DBCAMPO($count);
                        $pconfEcho->addEchoCanceller($data);
                    }else if($regs1[3]!="HDLCFCS" && $regs1[3] != 'Hardware-assisted'){
                        $data['num_port']       = $pDB->DBCAMPO($regs1[1]);
                        $data['name_port']       = $pDB->DBCAMPO($regs1[2]);
                        $data['echocanceller']   = $pDB->DBCAMPO("none");
                        $data['id_card']   = $pDB->DBCAMPO($count);
                        $pconfEcho->addEchoCanceller($data);
                    }
                   $tarjetas["TARJETA$idTarjeta"]['PUERTOS']["PUERTO$regs1[1]"] = array('LOCALIDAD' =>$regs1[1],'TIPO' => $tipo, 'ADICIONAL' => "$regs1[2] - $regs1[3]", 'ESTADO_ASTERISK' => $estado_asterisk,'ESTADO_ASTERISK_COLOR' => $estado_asterisk_color,'ESTADO_DAHDI' => $estado_dahdi_image);

                }
                else if(preg_match("/[[:space:]]*([[:digit:]]+) ([[:alnum:]]+)/",$linea,$regs1)){
                   if($regs1[2] == 'unknown'){
                        $estado_asterisk       = _tr('Unknown');
                        $estado_asterisk_color = 'gray';
                        $estado_dahdi_image    = 'conn_unkown.png';
                   }else if(preg_match("/EMPTY/i",$regs1[2])){
                        $estado_asterisk       = _tr('Channel Empty');
                        $estado_asterisk_color = 'gray';
                        $estado_dahdi_image    = 'conn_empty.png';
                   }
                   $tarjetas["TARJETA$idTarjeta"]['PUERTOS']["PUERTO$regs1[1]"] = array('LOCALIDAD' =>$regs1[1],'TIPO' => "&nbsp;", 'ADICIONAL' => $regs1[2], 'ESTADO_ASTERISK' => $estado_asterisk,'ESTADO_ASTERISK_COLOR' => $estado_asterisk_color,'ESTADO_DAHDI' => $estado_dahdi_image);
                }
            }
        }

        if(count($tarjetas)<=0){ //si no hay tarjetas instaladas
            $this->errMsg = _tr("Cards undetected on your system, press for detecting hardware detection.");
            $tarjetas = array();
        }
        if(count($tarjetas)==1){ //si aparace la tarjeta por default ZTDUMMY
            $valor = $tarjetas["TARJETA1"]['DESC']['TIPO'];
            if(preg_match("/^DAHDI_DUMMY\/1/i", $valor))
            {
                $this->errMsg = _tr("Cards undetected on your system, press for detecting hardware detection.");
                $tarjetas = array();
            }
        }
        return($tarjetas);
    }

    function getMisdnPortInfo()
    {

        exec('/usr/bin/misdnportinfo',$arrConsole,$flagStatus);
        if($flagStatus == 0)
            return $arrConsole;
        else return array();
    }

    function hardwareDetection($chk_dahdi_replace,$path_file_dahdi,$there_is_sangoma_card,$there_is_misdn_card)
    {
        $there_is_other_card= "";
        $message = _tr("Satisfactory Hardware Detection");
        $there_is_other_card  ="";
        $overwrite_chan_dahdi ="";

        if($there_is_sangoma_card=="true")
            $there_is_other_card = "-t";
        if($there_is_misdn_card=="true")
            $there_is_other_card .= " -m";
        if($chk_dahdi_replace=="true")
            $overwrite_chan_dahdi = " -o";

        $respuesta = $retorno = NULL;
        exec("/usr/bin/issabel-helper hardware_detector $there_is_other_card $overwrite_chan_dahdi", $respuesta, $retorno);
        if(is_array($respuesta)){
            foreach($respuesta as $key => $linea){
                //falta validar algun error
                //if(ereg("^(\[Errno [[:digit:]]{1,}\])",$linea,$reg))
                //  return $linea;
            }
            return $message;
        }
    }

    /////////////////////////NEW FUNCTIONS/////////////////////////

    /**
     * Procedimiento que combina la transferencia de spans digitales, y la
     * recuperación de los datos transferidos.
     *
     * @param   object  $pDB    Conexión a la base hardware_detector.db
     *
     * @return  NULL en caso de error, o lista indexada por span_num:
     *          id_card span_num tmsource linebuildout framing coding
     */
    function getSpanConfig($pDB)
    {
        $this->transferirSpanConfig($pDB);
        return $this->leerSpanConfig($pDB);
    }

    /**
     * Procedimiento que transfiere la información de los spans digitales desde
     * el archivo /etc/dahdi/system.conf hacia la tabla span_parameter.
     *
     * @param   object  $pDB    Conexión a la base hardware_detector.db
     *
     * @return  void
     */
    function transferirSpanConfig($pDB)
    {
        $pDB->genQuery('DELETE FROM span_parameter');
        foreach (file('/etc/dahdi/system.conf') as $sLinea) {
            // TODO: preserve and restore 'crc4' and 'yellow' parameters
            // TODO: cross-check id_card with table 'card'
            $regs = NULL;
            if (preg_match('/^span=(\d+),(\d+),(\d+),(\w+),(\w+)/', $sLinea, $regs)) {
                // Revisar si este span es un wanpipe
                list($dummy, $iSpan, $iTimeSource, $iLBO, $sFraming, $sCoding) = $regs;
                $crc = (strpos($sLinea, 'crc4') !== FALSE) ? 'crc4' : 'ncrc4';

                $sMedioWanpipe = NULL;  // T1/E1 o NULL si no es wanpipe o no es digital
                if (file_exists("/proc/dahdi/$iSpan") &&
                    strpos(file_get_contents("/proc/dahdi/$iSpan"), 'wanpipe') !== FALSE) {
                    // Confirmado que es wanpipe. Se busca /etc/wanpipe/wanpipeN.conf
                    if (file_exists("/etc/wanpipe/wanpipe$iSpan.conf")) {
                    	foreach (file("/etc/wanpipe/wanpipe$iSpan.conf") as $sLinea) {
                            if (preg_match('/^FE_MEDIA\s*=\s*(T1|E1)/', $sLinea, $regs)) {
                    			$sMedioWanpipe = $regs[1];
                    		}
                    	}
                    }
                }

                $pDB->genQuery(
                    'INSERT INTO span_parameter (id_card, span_num, timing_source, '.
                        'linebuildout, framing, coding, wanpipe_force_media, crc) '.
                    'VALUES (?, ?, ?, ?, ?, ?, ?, ?)',
                    array($iSpan, $iSpan, $iTimeSource, $iLBO, $sFraming, $sCoding, $sMedioWanpipe, $crc));
            }
        }
    }

    /**
     * Procedimiento que lee la información de la tabla de spans digitales que
     * ha sido previamente llenada por transferirSpanConfig()
     *
     * @param   object  $pDB    Conexión a la base hardware_detector.db
     *
     * @return  NULL en caso de error, o lista indexada por span_num:
     *          id_card span_num tmsource linebuildout framing coding
     */
    function leerSpanConfig($pDB, $iSpan = NULL)
    {
    	$sPeticionSQL =
            'SELECT id_card, span_num, timing_source AS tmsource, ' .
                'linebuildout AS lnbuildout, framing, coding, '.
                'wanpipe_force_media, crc ' .
            'FROM span_parameter';
        $paramSQL = array();
        if (!is_null($iSpan)) {
        	$sPeticionSQL .= ' WHERE span_num = ?';
            $paramSQL[] = (int)$iSpan;
        }
        $sPeticionSQL .= ' ORDER BY span_num';
        $r = $pDB->fetchTable($sPeticionSQL, TRUE, $paramSQL);
        if (!is_array($r)) {
            $this->errMsg = $pDB->errMsg;
            return NULL;
        }
        $dataSpans = array();
        foreach ($r as $tupla) {
        	$dataSpans[$tupla['span_num']] = $tupla;
        }
        return $dataSpans;
    }

    /**
     * Procedimiento que guarda para el span indicado, la configuración de span
     * Luego se debe llamar refreshDahdiConfiguration() para aplicar cambios
     *
     * @param int       $idSpan     ID del span que se va a modificar
     * @param int       $tmsource   0 si es master, o prioridad de esclavo 1..N
     * @param int       $lnbuildout Longitud del cable 0..7
     * @param string    $framing    d4 esf cas ccs
     * @param string    $coding     ami b8zs hdb3
     *
     * @return  bool    VERDADERO para éxito, FALSO para error
     */
    function guardarSpanConfig($pDB, $idSpan, $tmsource, $lnbuildout, $framing, $coding, $crc, $force_media = NULL)
    {
    	$idSpan = (int)$idSpan;
        $tmsource = (int)$tmsource;
        $lnbuildout = (int)$lnbuildout;
        if (!in_array($framing, array('d4', 'esf', 'cas', 'ccs'))) {
            $this->errMsg = _tr('Invalid framing');
        	return FALSE;
        }
        if (!in_array($coding, array('ami', 'b8zs', 'hdb3'))) {
            $this->errMsg = _tr('Invalid coding');
            return FALSE;
        }
        if (!is_null($force_media) && !in_array($force_media, array('E1', 'T1'))) {
            $this->errMsg = _tr('Invalid media type');
        	return FALSE;
        }
        if (is_null($crc)) $crc = 'ncrc4';
        if (!in_array($crc, array('crc4', 'ncrc4'))) {
            $this->errMsg = _tr('Invalid CRC type');
            return FALSE;
        }
        $r = $pDB->genQuery(
            'UPDATE span_parameter SET timing_source = ?, linebuildout = ?, ' .
                'framing = ?, coding = ?, wanpipe_force_media = ?, crc = ? ' .
            'WHERE span_num = ?',
            array($tmsource, $lnbuildout, $framing, $coding, $force_media, $crc, $idSpan));
        if (!$r) {
            $this->errMsg = $pDB->errMsg;
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Procedimiento que llama al ayudante dahdiconfig para que modifique la
     * información de spans y de cancelador de eco para que se ajuste a lo
     * almacenado en la base de datos.
     *
     * @return bool VERDADERO en caso de éxito, FALSO en error
     */
    function refreshDahdiConfiguration()
    {
        $this->errMsg = '';
        $sComando = '/usr/bin/issabel-helper dahdiconfig --refresh 2>&1';
        $output = $ret = NULL;
        exec($sComando, $output, $ret);
        if ($ret != 0) {
            $this->errMsg = implode('', $output);
            return FALSE;
        }
        return TRUE;
    }

    //FUNCIONES DE CARD MANUFACTURER//

    function updateCardParameter($pDB, $arrParameter, $where)
    {
        $queryUpdate = $pDB->construirUpdate('card_parameter', $arrParameter, $where);
        $result = $pDB->genQuery($queryUpdate);

        return $result;
    }


    private function addCardManufacturer($pDB, $data)
    {
        $queryInsert = $pDB->construirInsert('card_parameter', $data);
        $result = $pDB->genQuery($queryInsert);

        return $result;
    }

    function getCardManufacturer($pDB)
    {
        $query = "SELECT * FROM card_parameter";
        $providers = array();
        $result= $pDB->fetchTable($query, true);

        if($result==FALSE){
            $this->errMsg = $pDB->errMsg;
            return array();
        }
        return $result;
    }

    private function deleteCardManufacturer($pDB, $idCard){
        $query = "DELETE FROM card_parameter";

        $strWhere = "id_card=$idCard";
        // Clausula WHERE aqui
        if(!empty($strWhere)) $query .= "WHERE $strWhere ";

        $result = $pDB->genQuery($query);
    }

    private function getCardManufacturerById($pDB, $idCard){
        $query   = "SELECT manufacturer, num_serie FROM card_parameter ";
        $strWhere = "id_card=$idCard";

        // Clausula WHERE aqui
        if(!empty($strWhere)) $query .= "WHERE $strWhere ";

        $result=$pDB->getFirstRowQuery($query, true);
        return $result;
    }

    function isInstalled_mISDN()
    {
        $mISDN_service  = "/usr/sbin/mISDN";
        $mISDN_portinfo = "/usr/bin/misdnportinfo";

        return file_exists($mISDN_service) && file_exists($mISDN_portinfo);
    }

}
?>
