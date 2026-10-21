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
  $Id: index.php, Thu 13 May 2021 06:13:41 PM EDT, nicolas@issabel.com
*/
require_once "libs/paloSantoGraphImage.lib.php";

class Applet_SystemResources
{
    function handleJSON_getContent($smarty, $module_name, $appletlist)
    {
        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );

        $smarty->assign(array(
            'LABEL_CPU'         =>  _tr('CPU'),
            'LABEL_RAM'         =>  _tr('RAM'),
            'LABEL_SWAP'        =>  _tr('SWAP'),
            'LABEL_CPUINFO'     =>  _tr('CPU Info'),
            'LABEL_UPTIME'      =>  _tr('Uptime'),
            'LABEL_CPUSPEED'    =>  _tr('CPU Speed'),
            'LABEL_MEMORYUSE'   =>  _tr('Memory usage'),
        ));

        $lastdata = `grep -h "Web Interface login successful" $(ls -rt /var/log/issabel/audit.log*) | tail -n 2 | head -n 1 | awk '{print $1" "$2" "$3","$15}'`;
        if(trim($lastdata)=='') {
            $lastlogin = _tr('No last login info');
        } else {
            $lastdata = str_replace(array('[',']'),'',$lastdata);
            $partes = preg_split("/,/",$lastdata);
            $ll = get_language();
            if($ll=="br" || $ll=="pt-br") {
                $lllocale = "pt_BR";
            } else if($ll=="fa") {
                $lllocale = "fa_IR";
            } else {
                $lllocale = $ll."_".strtoupper($ll);
            }
            setlocale(LC_TIME, $lllocale);
            $fecha = strftime("%c",strtotime($partes[0]));
            $current_encoding = mb_detect_encoding($fecha,'UTF-8, ISO-8859-1, ISO-8859-2');
            if($current_encoding<>'UTF-8') {
                $fecha = mb_convert_encoding($fecha,'UTF-8',$current_encoding);
            }
            $lastlogin   = sprintf(_tr('Last login: %s from %s'),$fecha,$partes[1]);


            $lastlogin   = sprintf(_tr('Last login: %s from %s'),$fecha,$partes[1]);
        }

        $status = $this->_recolectarCargaSistema($module_name);

        $cpuinfo = $this->getCPUInfo();
        $speed = number_format($cpuinfo['CpuMHz'], 2)." MHz";
        $cpu_info = $cpuinfo['CpuModel'];

        //MEMORY USAGE
        $inf2 = number_format($status['MemTotal']/1024, 2)." Mb";

        //SWAP USAGE
        $inf3 = number_format($status['SwapTotal']/1024, 2)." Mb";

        //UPTIME
        $upfields = array();
        $up = $this->getUptime(); // Segundos de actividad desde arranque
        $upfields[] = $up % 60; $up = ($up - $upfields[0]) / 60;
        $upfields[] = $up % 60; $up = ($up - $upfields[1]) / 60;
        $upfields[] = $up % 24; $up = ($up - $upfields[2]) / 24;
        $upfields[] = $up;

        $uptime = $upfields[1].' '._tr('minute(s)');
        if ($upfields[2] > 0) $uptime = $upfields[2].' '._tr('hour(s)').' '.$uptime;
        if ($upfields[3] > 0) $uptime = $upfields[3].' '._tr('day(s)').' '.$uptime;

        $smarty->assign(array(
            'cpu_info'      =>  $cpu_info,
            'uptime'        =>  $uptime,
            'speed'         =>  $speed,
            'memtotal'      =>  $inf2,
            'swaptotal'     =>  $inf3,
            'lastlogin'     =>  $lastlogin,
        ));
        $smarty->assign($this->_formatGauges($status['cpugauge'], $status['memgauge'], $status['swapgauge']));
        $local_templates_dir = dirname($_SERVER['SCRIPT_FILENAME'])."/modules/$module_name/applets/SystemResources/tpl";
        $respuesta['html'] = $smarty->fetch("$local_templates_dir/system_resources.tpl");

        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }

    function handleJSON_updateStatus($smarty, $module_name, $appletlist)
    {
        $respuesta['status'] = $this->_recolectarCargaSistema($module_name);
        unset($respuesta['status']['MemTotal']);
        unset($respuesta['status']['SwapTotal']);
        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }

    private function _recolectarCargaSistema($module_name)
    {
        $cpu_b = $this->obtener_muestra_actividad_cpu();
        if (isset($_SESSION[$module_name]['cpusample'])) {
            $cpu_a = $_SESSION[$module_name]['cpusample'];
        } else {
            $cpu_a = $cpu_b;
            /* Se cierra la sesión para quitar el candado sobre la sesión y permitir
             * que otras operaciones ajax puedan funcionar. */
            session_commit();

            usleep(200000);
            $cpu_b = $this->obtener_muestra_actividad_cpu();
            @session_start();
        }
        $fraction_cpu_used = $this->calcular_carga_cpu_intervalo($cpu_a, $cpu_b);
        $_SESSION[$module_name]['cpusample'] = $cpu_b;

        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );

        $meminfo = $this->getMemInfo();
        $fraction_mem_used = ($meminfo['MemTotal'] - $meminfo['MemFree'] - $meminfo['Cached'] - $meminfo['SReclaimable'] - $meminfo['Buffers']) / $meminfo['MemTotal'];
        if($meminfo['SwapTotal']==0) {
            $fraction_swap_used = 0;
        } else {
            $fraction_swap_used = ($meminfo['SwapTotal'] - $meminfo['SwapFree']) / $meminfo['SwapTotal'];
        }

        return array(
            'cpugauge'  =>  $fraction_cpu_used,
            'memgauge'  =>  $fraction_mem_used,
            'swapgauge' =>  $fraction_swap_used,
            'MemTotal'  =>  $meminfo['MemTotal'],
            'SwapTotal' =>  $meminfo['SwapTotal'],
        );
    }

    private function _formatGauges($fraction_cpu_used, $fraction_mem_used, $fraction_swap_used)
    {
        return array(
            'cpugauge'      =>  array(
                'height_used'   =>  (int)(100.0 * $fraction_cpu_used),
                'height_free'   =>  100 - (int)(100.0 * $fraction_cpu_used),
                'fraction'      =>  $fraction_cpu_used,
                'percent'       =>  number_format($fraction_cpu_used * 100.0, 1),
            ),
            'memgauge'      =>  array(
                'height_used'   =>  (int)(100.0 * $fraction_mem_used),
                'height_free'   =>  100 - (int)(100.0 * $fraction_mem_used),
                'fraction'      =>  $fraction_mem_used,
                'percent'       =>  number_format(100.0 * $fraction_mem_used, 1),
            ),
            'swapgauge'      =>  array(
                'height_used'   =>  (int)(100.0 * $fraction_swap_used),
                'height_free'   =>  100 - (int)(100.0 * $fraction_swap_used),
                'fraction'      =>  $fraction_swap_used,
                'percent'       =>  number_format(100.0 * $fraction_swap_used, 1),
            ),
        );
    }

    private function getMemInfo()
    {
        $arrInfo = array(
            'MemTotal'      =>  0,
            'MemFree'       =>  0,
            'Buffers'       =>  0,
            'SwapTotal'     =>  0,
            'SwapFree'      =>  0,
            'Cached'        =>  0,
            'SReclaimable'  =>  0,
        );
        foreach (file('/proc/meminfo') as $linea) {
            $regs = NULL;
            if (preg_match('/^(\w+):\s+(\d+) kB/', $linea, $regs)) {
                if (isset($arrInfo[$regs[1]])) $arrInfo[$regs[1]] = $regs[2];
            }
        }
        return $arrInfo;
    }

    private function getCPUInfo()
    {
        $arrInfo = array(
            'CpuModel'      =>  '(unknown)',
            'CpuVendor'     =>  '(unknown)',
            'CpuMHz'        =>  0.0,
        );
        foreach (file('/proc/cpuinfo') as $linea) {
            $regs = NULL;
            if (preg_match('/^(.+?)\s*:\s*(.+)/', $linea, $regs)) {
                $regs[1] = trim($regs[1]);
                $regs[2] = trim($regs[2]);
                if ($regs[1] == 'model name' || $regs[1] == 'Processor')
                    $arrInfo['CpuModel'] = $regs[2];
                if ($regs[1] == 'vendor_id')
                    $arrInfo['CpuVendor'] = $regs[2];
                if ($regs[1] == 'cpu MHz')
                    $arrInfo['CpuMHz'] = $regs[2];
            }
        }
        return $arrInfo;
    }

    private function getUptime()
    {
        $btime = NULL;
        foreach (file('/proc/stat') as $linea) {
            if (strpos($linea, 'btime ') === 0) {
                $t = explode(' ', $linea);
                $btime = $t[1];
                break;
            }
        }
        return $this->_info_sistema_diff_stat($btime, time());
    }

    private function obtener_muestra_actividad_cpu()
    {
        if (!function_exists('_info_sistema_linea_cpu')) {
            function _info_sistema_linea_cpu($s) { return (strpos($s, 'cpu ') === 0); }
        }
        $ras = array_filter(file('/proc/stat', FILE_IGNORE_NEW_LINES), '_info_sistema_linea_cpu');
        $res = array_shift($ras);
        $muestra = preg_split('/\s+/', $res);
        array_shift($muestra);
        return $muestra;
    }

    private function calcular_carga_cpu_intervalo($m1, $m2)
    {
        $diffmuestra = array_map(array($this, '_info_sistema_diff_stat'), $m1, $m2);
        $cpuActivo = $diffmuestra[0] + $diffmuestra[1] + $diffmuestra[2] + $diffmuestra[4] + $diffmuestra[5] + $diffmuestra[6];
        $cpuTotal = $cpuActivo + $diffmuestra[3];
        $result = ($cpuTotal > 0) ? $cpuActivo / $cpuTotal : 0;
        return $result;
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

    function handleJSON_graphic($smarty, $module_name, $appletlist)
    {
        $value = $_REQUEST['percent'];
        if (!is_numeric($value)) return;

        $size = '140,140';

        $result = array();
        $result['ATTRIBUTES'] = array('TYPE'=>'gauge','SIZE'=>$size);  // bar => gauge
        $result['MESSAGES'] = array('ERROR'=>'Error','NOTHING_SHOW'=>'Nada que mostrar');

        $temp = array();
        $temp['DAT_1'] = array('VALUES'=>array("value"=>$value));
        $result['DATA'] = $temp;

        displayGraphResult($result);
    }
}

?>
