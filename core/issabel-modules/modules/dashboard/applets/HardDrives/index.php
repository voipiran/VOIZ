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
require_once "libs/paloSantoGraphImage.lib.php";

class Applet_HardDrives
{
    function handleJSON_getContent($smarty, $module_name, $appletlist)
    {
        /* Se cierra la sesión para quitar el candado sobre la sesión y permitir
         * que otras operaciones ajax puedan funcionar. */
        session_commit();

        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );

        // Intento de ejecutar los comandos en paralelo
        $pipe_hdmodel = popen('/usr/bin/issabel-helper hdmodelreport', 'r');
        
        $fastgauge = $this->_getFastGraphics();

        // Recolectar la información de particiones
        $output = $retval = NULL;
        exec('/bin/df -P /etc/fstab', $output, $retval);
        $part = array();
        $regexp = "!^([/-_\.[:alnum:]|-]+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d{1,3}%)\s+([/-_\.[:alnum:]]+)$!";
        foreach ($output as $linea) {
            $regs = NULL;
            if (preg_match($regexp, $linea, $regs)) {
                $particion = array(
                    'dispositivo'               =>  $regs[1],
                    'num_bloques_total'         =>  $regs[2],
                    'num_bloques_usados'        =>  $regs[3],
                    'punto_montaje'             =>  $regs[6],
                );
                $particion['porcentaje_usado'] = 100.0 * $particion['num_bloques_usados'] / $particion['num_bloques_total'];
                $particion['porcentaje_libre'] = 100.0 - $particion['porcentaje_usado'];
                $part[] = $particion;
            }
        }
        
        // Recolectar la información acumulada de modelos de partición
        while ($s = fgets($pipe_hdmodel)) {
            $s = trim($s); $l = explode(' ', $s, 2);
            if (count($l) > 1) $hdmodel[$l[0]] = $l[1];
        }
        pclose($pipe_hdmodel);
        
        $partdata = array();
        foreach ($part as $particion) {
            $sTotalGB = number_format($particion['num_bloques_total'] / 1024 / 1024, 2);
            $sPorcentajeUsado = number_format($particion['porcentaje_usado'], 0);
            $sPorcentajeLibre = number_format($particion['porcentaje_libre'], 0);

            // Intentar determinar el modelo del disco que contiene la partición
            $sModelo = isset($hdmodel[$particion['dispositivo']]) ? $hdmodel[$particion['dispositivo']] : 'N/A';
            
            $height_used = (int)($particion['porcentaje_usado']);
            $height_free = 100 - $height_used;
            $partdata[] = array(
                'sTotalGB'                  =>  $sTotalGB,
                'formato_porcentaje_usado'  =>  $sPorcentajeUsado,
                'formato_porcentaje_libre'  =>  $sPorcentajeLibre,
                'sModelo'                   =>  $sModelo,
                'punto_montaje'             =>  $particion['punto_montaje'],
                'height_used'               =>  $height_used,
                'height_free'               =>  $height_free,
                'porcentaje_usado'          =>  $particion['porcentaje_usado'],
            );
        }
        $smarty->assign(array(
            'htmldiskuse_width'     =>  140,
            'htmldiskuse_height'    =>  140,
            'part'                  =>  $partdata,
            'fastgauge'             =>  $fastgauge,
        ));

        $smarty->assign(array(
            'TEXT_WARNING_DIRSPACEREPORT'   =>  _tr('Click below to fetch directory report. WARNING: this operation may take a long time AND impact system performance.'),
            'FETCH_DIRSPACEREPORT'          =>  _tr('Fetch directory report'),
            'LABEL_PERCENT_USED'            =>  _tr('Used'),
            'LABEL_PERCENT_AVAILABLE'       =>  _tr('Available'),
            'LABEL_DISK_CAPACITY'           =>  _tr('Hard Disk Capacity'),
            'LABEL_MOUNTPOINT'              =>  _tr('Mount Point'),
            'LABEL_DISK_VENDOR'             =>  _tr('Manufacturer'),
        ));

        $local_templates_dir = dirname($_SERVER['SCRIPT_FILENAME'])."/modules/$module_name/applets/HardDrives/tpl";
        $respuesta['html'] = $smarty->fetch("$local_templates_dir/harddrives.tpl");
    
        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }
    
    function handleJSON_dirspacereport($smarty, $module_name, $appletlist)
    {
        /* Se cierra la sesión para quitar el candado sobre la sesión y permitir
         * que otras operaciones ajax puedan funcionar. */
        session_commit();

        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );


        // Lista de directorios a buscar
        $listaReporteDir = array(
            'logs'  =>  array(
                'dir'   =>  '/var/log',
                'tag'   =>  _tr('Logs'),
                'use'   =>  'N/A',
                'avail' =>  'N/A',
            ),
            'backups'  =>  array(
                'dir'   =>  '/var/www/backup',
                'tag'   =>  _tr('Local Backups'),
                'use'   =>  'N/A',
                'avail' =>  'N/A',
            ),
            'emails'  =>  array(
                'dir'   =>  '/var/spool/imap',
                'tag'   =>  _tr('Emails'),
                'use'   =>  'N/A',
                'avail' =>  'N/A',
            ),
            'config'  =>  array(
                'dir'   =>  '/etc',
                'tag'   =>  _tr('Configuration'),
                'use'   =>  'N/A',
                'avail' =>  'N/A',
            ),
            'voicemails'  =>  array(
                'dir'   =>  '/var/spool/asterisk/voicemail',
                'tag'   =>  _tr('Voicemails'),
                'use'   =>  'N/A',
                'avail' =>  'N/A',
            ),
            'recordings'  =>  array(
                'dir'   =>  '/var/spool/asterisk/monitor',
                'tag'   =>  _tr('Recordings'),
                'use'   =>  'N/A',
                'avail' =>  'N/A',
            ),
        );
        
        $pipe_dirspace = popen('/usr/bin/issabel-helper dirspacereport', 'r');
        while ($s = fgets($pipe_dirspace)) {
            $s = trim($s); $l = explode(' ', $s);
            if (count($l) > 1 && isset($listaReporteDir[$l[0]]))
                $listaReporteDir[$l[0]]['use'] = $l[1]." "._tr('Used');
                $listaReporteDir[$l[0]]['avail'] = $l[2]." "._tr('Available');
        }
        pclose($pipe_dirspace);
        
        $smarty->assign('listaReporteDir', $listaReporteDir);

        $local_templates_dir = dirname($_SERVER['SCRIPT_FILENAME'])."/modules/$module_name/applets/HardDrives/tpl";
        $respuesta['html'] = $smarty->fetch("$local_templates_dir/dirspacereport.tpl");
    
        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }
    
    function handleJSON_graphic($smarty, $module_name, $appletlist)
    {
        $value = $_REQUEST['percent'];
        if (!is_numeric($value)) return;
        
        $result = array();
        $result['ATTRIBUTES'] = array(
            'TITLE'=>'',
            'TYPE'=>'plot3d2',
            'SIZE'=>"220,100",
            'POS_LEYEND' => "0.06,0.3",
            "COLOR" => "#fafafa",
            "SIZE_PIE" => "50",
            "MARGIN_COLOR" => "#fafafa"
        );
        $result['MESSAGES'] = array(
            'ERROR'=>'Error',
            'NOTHING_SHOW'=>'Nada que mostrar'
        );

        $arrTemp = array();
        for($i=1; $i<=2; $i++){
            $data = array();
            $data['VALUES'] = ($i==1) ? array('VALUE'=>$value) : array('VALUE'=>100-$value);
            $data['STYLE'] = array('COLOR'=> ($i==1) ? '#3184d5' : '#6e407e','LEYEND'=> ($i==1) ? 'Used' : 'Free');
            $arrTemp["DAT_$i"] = $data;
        }

        $result['DATA'] = $arrTemp;

        displayGraphResult($result);
    }

    private function _getFastGraphics()
    {
        global $arrConf;

        $uissabel = FALSE;
        $pDB = new paloDB($arrConf['issabel_dsn']['settings']);
        if (empty($pDB->errMsg)) {
            $uissabel = get_key_settings($pDB, 'uissabel');
            $uissabel = ((int)$uissabel != 0);
        }
        unset($pDB);
        return $uissabel;
    }
}
?>
