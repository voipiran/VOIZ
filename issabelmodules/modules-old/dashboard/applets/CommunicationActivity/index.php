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
  $Id: index.php,v 1.1 2007/01/09 23:49:36 alex Exp $
*/
global $arrConf;
require_once "{$arrConf['basePath']}/libs/paloSantoTrunk.class.php";
require_once "/var/lib/asterisk/agi-bin/phpagi-asmanager.php";

class Applet_CommunicationActivity
{
    private $errMsg = NULL;

    function handleJSON_getContent($smarty, $module_name, $appletlist)
    {
        /* Se cierra la sesión para quitar el candado sobre la sesión y permitir
         * que otras operaciones ajax puedan funcionar. */
        session_commit();

        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );
        $smarty->assign(array(
            'LABEL_CALLS'           =>  _tr('Calls'),
            'LABEL_TOTAL_CALLS'     =>  _tr('Total_calls'),
            'LABEL_STATUS_OK'       =>  _tr('OK'),
            'LABEL_STATUS_NO_OK'    =>  _tr('NO_OK'),
            'LABEL_INTERNAL_CALLS'  =>  _tr('internal_calls'),
            'LABEL_EXTERNAL_CALLS'  =>  _tr('external_calls'),
            'LABEL_TOTAL_CHANNELS'  =>  _tr('total_channels'),
            'LABEL_QUEUES_WAITING'  =>  _tr('Queues_waiting'),
            'LABEL_WAITING'         =>  _tr('Waiting'),
            'LABEL_TRUNKS'          =>  _tr('Trunks'),
            'LABEL_NETWORK_TRAFFIC' =>  _tr('Network_traffic'),
            'LABEL_BYTES'           =>  _tr('Bytes'),
            'LABEL_EXTENSIONS'      =>  _tr('Extensions'),
            'LABEL_SIP_EXTENSIONS'  =>  _tr('sip_extensions'),
            'LABEL_IAX_EXTENSIONS'  =>  _tr('iax_extensions'),
            'LABEL_UNKNOWN'         =>  _tr('Unknown'),
        ));

        $muestrared_1 = $this->obtener_muestra_actividad_red();

        $astman = $this->_getami();
        if (is_null($astman)) {
        	$respuesta['status'] = 'error';
            $respuesta['message'] = $this->errMsg;
        } else {
            $channels = $this->_getAsteriskChannels($astman);
            if (!is_array($channels)) {
                $respuesta['status'] = 'error';
                $respuesta['message'] = $this->errMsg;
            }
            $queues = $this->_getAsteriskQueueWaiting($astman);
            if (!is_array($queues)) {
                $respuesta['status'] = 'error';
                $respuesta['message'] = $this->errMsg;
            }
            $connections = $this->_getAsteriskConnections($astman);
            if (!is_array($connections)) {
                $respuesta['status'] = 'error';
                $respuesta['message'] = $this->errMsg;
            }
            $astman->disconnect();
            if ($respuesta['status'] != 'error') {
                usleep(200000);
                $muestrared_2 = $this->obtener_muestra_actividad_red();
                $trafico = $this->calcular_actividad_red($muestrared_1, $muestrared_2);
                @session_start();
                $_SESSION[$module_name]['networksample'] = $muestrared_2;

                $smarty->assign(array(
                    'total'             => $channels['total_calls'],
                    'internal'          => $channels['internal_calls'],
                    'external'          => $channels['external_calls'],
                    'channel'           => $channels['total_channels'].' '.
                        (($channels['total_channels'] == 1) ? _tr('channel') : _tr('channels')),
                    'totalQueues'       => array_sum($queues),
                    'total_sip_Ext'     => array_sum($connections['sip']['ext']),
                    'sip_Ext_ok'        => $connections['sip']['ext']['ok'],
                    'sip_Ext_nok'       => $connections['sip']['ext']['no_ok'],
                    'total_iax_Ext'     => array_sum($connections['iax']['ext']),
                    'iax_Ext_ok'        => $connections['iax']['ext']['ok'],
                    'iax_Ext_nok'       => $connections['iax']['ext']['no_ok'],
                    'rx_bytes'          => $trafico['rx_bytes'],
                    'tx_bytes'          => $trafico['tx_bytes'],
                ));
                $totalTrunks = array(
                    'total_trunks_ok'   => $connections['sip']['trunk']['ok'] + $connections['iax']['trunk']['ok'],
                    'total_trunks_nok'  => $connections['sip']['trunk']['no_ok'] + $connections['iax']['trunk']['no_ok'],
                    'total_trunks_unk'  => $connections['sip']['trunk']['unknown'] + $connections['iax']['trunk']['unknown'],
                );
                $totalTrunks['total_trunks'] = array_sum($totalTrunks);
                $smarty->assign($totalTrunks);
            }
        }


        $local_templates_dir = dirname($_SERVER['SCRIPT_FILENAME'])."/modules/$module_name/applets/CommunicationActivity/tpl";
        $respuesta['html'] = $smarty->fetch("$local_templates_dir/communication_activity.tpl");

        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }

    function handleJSON_updateStatus($smarty, $module_name, $appletlist)
    {
        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );

        $respuesta['rx_bytes'] = $respuesta['tx_bytes'] = 0;
        $muestrared_2 = $this->obtener_muestra_actividad_red();
        if (isset($_SESSION[$module_name]['networksample'])) {
            $trafico = $this->calcular_actividad_red($_SESSION[$module_name]['networksample'], $muestrared_2);
            $respuesta['rx_bytes'] = $trafico['rx_bytes'];
            $respuesta['tx_bytes'] = $trafico['tx_bytes'];
        }
        $_SESSION[$module_name]['networksample'] = $muestrared_2;

        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }

    private function _getami()
    {
        $astman = new AGI_AsteriskManager();
        $astman->log_level = 0;
        if (!$astman->connect("127.0.0.1", "admin" , obtenerClaveAMIAdmin())) {
            $this->errMsg = _tr('Error when connecting to Asterisk Manager');
            return NULL;
        }
        return $astman;
    }

    private function _getAsteriskConnections($astman)
    {
        //SIPs
        $arrActivity["sip"]["ext"]["ok"]=0;
        $arrActivity["sip"]["ext"]["no_ok"]=0;
        $arrActivity["sip"]["trunk"]["ok"]=0;
        $arrActivity["sip"]["trunk"]["no_ok"]=0;
        $arrActivity["sip"]["trunk"]["unknown"]=0;
        $arrActivity["sip"]["trunk_registry"]["ok"]=0;
        $arrActivity["sip"]["trunk_registry"]["no_ok"]=0;
        //IAXs
        $arrActivity["iax"]["ext"]["ok"]=0;
        $arrActivity["iax"]["ext"]["no_ok"]=0;
        $arrActivity["iax"]["trunk"]["ok"]=0;
        $arrActivity["iax"]["trunk"]["no_ok"]=0;
        $arrActivity["iax"]["trunk"]["unknown"]=0;
        $arrActivity["iax"]["trunk_registry"]["ok"]=0;
        $arrActivity["iax"]["trunk_registry"]["no_ok"]=0;

        //1.- get all trunk in asterisk
        $arrTrunks = $this->_getAll_Trunk();

        //2.- get sip peers.
        $r = $astman->Command('sip show peers');
        if (!isset($r['Response']) || $r['Response'] == 'Error') {
            $this->errMsg = _tr('(internal) failed to run ami:sip show peers').print_r($r, TRUE);
            return NULL;
        }
        foreach (explode("\n", $r['data']) as $line) {
            //ex: Name/username              Host            Dyn Nat ACL Port     Status
            //    412/412                    192.168.1.82     D   N   A  5060     OK (17 ms)
            if(preg_match("/^\s*(.+)\s+((\d{1,3}(\.\d{1,3}){1,3})|\(Unspecified\))\s+\D*\s*\D*\s*\D*\s*\d+\s+(\D+)/",$line,$arrToken)) {
                $name = explode("/",$arrToken[1]);
                if (stripos($arrToken[5], 'OK') !== FALSE) {
                    // estado OK
                    if(in_array($name[0],$arrTrunks)) // es una troncal?, registrada
                        $arrActivity["sip"]["trunk"]["ok"]++;
                    else
                        $arrActivity["sip"]["ext"]["ok"]++;
                } elseif (stripos($arrToken[5], 'Unmonitored') !== FALSE) { // estado desconocido, un caso es cuando no esta definido el parametro quality=yes
                    if (in_array($name[0],$arrTrunks)) // es una troncal?, registrada
                        $arrActivity["sip"]["trunk"]["unknown"]++;
                    else
                        $arrActivity["sip"]["ext"]["ok"]++;
                } else {
                    if(in_array($name[0],$arrTrunks)) // es una troncal?, no registrada
                        $arrActivity["sip"]["trunk"]["no_ok"]++;
                    else
                        $arrActivity["sip"]["ext"]["no_ok"]++;
                }
            }
        }

        //3.- get iax peers
        $r = $astman->Command('iax2 show peers');
        if (!isset($r['Response']) || $r['Response'] == 'Error') {
            $this->errMsg = _tr('(internal) failed to run ami:iax2 show peers').print_r($r, TRUE);
            return NULL;
        }
        foreach (explode("\n", $r['data']) as $line) {
            //ex: Name/Username    Host                 Mask             Port          Status
            //    512              127.0.0.1       (D)  255.255.255.255  40002         OK (3 ms)
            if (preg_match("/^\s*(.+)\s+((\d{1,3}(\.\d{1,3}){1,3})|\(null\))\s+\(\D\)\s+\d{1,3}(\.\d{1,3}){1,3}\s+\d+\s+\(?\D?\)?\s+(\D+)/",$line,$arrToken)) {
                $name = explode("/",$arrToken[1]);
                if (stripos($arrToken[6], 'OK') !== FALSE) { // estado OK
                    if (in_array($name[0],$arrTrunks)) // es una troncal?, registrada
                        $arrActivity["iax"]["trunk"]["ok"]++;
                    else
                        $arrActivity["iax"]["ext"]["ok"]++;
                } elseif (stripos($arrToken[6], 'Unmonitored') !== FALSE) { // estado desconocido, un caso es cuando no esta definido el parametro quality=yes
                    if (in_array($name[0],$arrTrunks)) // es una troncal?, registrada
                        $arrActivity["iax"]["trunk"]["unknown"]++;
                    else
                        $arrActivity["iax"]["ext"]["ok"]++;
                } else {
                    if (in_array($name[0],$arrTrunks)) // es una troncal?, no registrada
                        $arrActivity["iax"]["trunk"]["no_ok"]++;
                    else
                        $arrActivity["iax"]["ext"]["no_ok"]++;
                }
            }
        }
        return $arrActivity;
    }

    private function _getAsteriskChannels($astman)
    {
        $arrChann = array(
            'external_calls'    =>  0,
            'internal_calls'    =>  0,
            'total_calls'       =>  0,
            'total_channels'    =>  0,
        );
        $r = $astman->Command('core show channels');
        if (!isset($r['Response']) || $r['Response'] == 'Error') {
            $this->errMsg = _tr('(internal) failed to run ami:core show channels').print_r($r, TRUE);
        	return NULL;
        }
        foreach (explode("\n", $r['data']) as $line) {
        	$regs = NULL;
            if (strpos($line, 's@macro-dialout') !== FALSE) {
        		$arrChann['external_calls']++;
        	} elseif (strpos($line, 's@macro-dial:') !== FALSE) {
        		$arrChann['internal_calls']++;
        	} elseif (preg_match('/^(\d+) active call/', $line, $regs)) {
        		$arrChann['total_calls'] = (int)$regs[1];
            } elseif (preg_match('/^(\d+) active channel/', $line, $regs)) {
                $arrChann['total_channels'] = (int)$regs[1];
        	}
        }
        return $arrChann;
    }

    private function _getAsteriskQueueWaiting($astman)
    {
        $arrQue = array();

        $r = $astman->Command('queue show');
        if (!isset($r['Response']) || $r['Response'] == 'Error') {
            $this->errMsg = _tr('(internal) failed to run ami:queue show').print_r($r, TRUE);
            return NULL;
        }
        foreach (explode("\n", $r['data']) as $line) {
            $regs = NULL;
            if (preg_match('/^(\d+)\s*has (\d+)/', $line, $regs))
                $arrQue[$regs[1]] = (int)$regs[2];
        }
        return $arrQue;
    }

    private function _getAll_Trunk()
    {
        $dsn = generarDSNSistema('asteriskuser', 'asterisk');
        $pDBTrunk  = new paloDB($dsn);
        $arrTrunks = getTrunks($pDBTrunk);
        $trunks = array();
        if(empty($arrTrunks)) return $trunks;

        if(is_array($arrTrunks) & count($arrTrunks)>0){
            foreach($arrTrunks as $key => $trunk){
                $tmp = explode("/",$trunk[1]);
                $trunks[] = $tmp[1];
            }
        }
        return $trunks;
    }

    private function calcular_actividad_red(&$muestrared_1, &$muestrared_2)
    {
    	$actividad = array(
            'rx_bytes'  =>  0,
            'tx_bytes'  =>  0,
        );

        foreach (array_keys($muestrared_1['interface']) as $dev) {
        	$actividad['rx_bytes'] += $this->_info_sistema_diff_stat(
                $muestrared_1['interface'][$dev]['rx_bytes'],
                $muestrared_2['interface'][$dev]['rx_bytes']);
            $actividad['tx_bytes'] += $this->_info_sistema_diff_stat(
                $muestrared_1['interface'][$dev]['tx_bytes'],
                $muestrared_2['interface'][$dev]['tx_bytes']);
        }
        $intervalo = $muestrared_2['timestamp'] - $muestrared_1['timestamp'];
        $actividad['rx_bytes'] = number_format((($actividad['rx_bytes'] / 1000.0) / $intervalo), 2);
        $actividad['tx_bytes'] = number_format((($actividad['tx_bytes'] / 1000.0) / $intervalo), 2);

        return $actividad;
    }

    private function obtener_muestra_actividad_red()
    {
        $muestra = array(
            'timestamp' =>  microtime(TRUE),
            'interface' =>  array(),
        );
        foreach (file('/proc/net/dev') as $s) {
            if (preg_match('/^([\w-]+):(.+)$/', trim($s), $regs)) {
                if (strpos($regs[1], 'eth') === 0 || strpos($regs[1], 'mv-') === 0) {
                    $campos = preg_split('/\s+/', trim($regs[2]));
                    $muestra['interface'][$regs[1]] = array(
                        'rx_bytes'      =>  $campos[0],
                        'rx_packets'    =>  $campos[1],
                        'tx_bytes'      =>  $campos[8],
                        'tx_packets'    =>  $campos[9],
                    );
                }
            }
        }
        return $muestra;
    }

    /* Método para poder realizar la resta de dos cantidades enteras que pueden
     * no caber en un entero de PHP, pero cuya diferencia es pequeña y puede
     * caber en el mismo entero. */
    private function _info_sistema_diff_stat($a, $b)
    {
        $aa = str_split("$a");
        $bb = str_split("$b");
        while (count($aa) < count($bb)) array_unshift($aa, '0');
        while (count($aa) > count($bb)) array_unshift($bb, '0');
        while (count($aa) > 0 && $aa[0] == $bb[0]) {
            array_shift($aa);
            array_shift($bb);
        }
        if (count($aa) <= 0) return 0;
        $a = implode('', $aa); $b = implode('', $bb);
        return (int)$b - (int)$a;
    }

}
?>