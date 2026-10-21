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

define('CALENDAR_EVENTO_DIARIO', 1);
define('CALENDAR_EVENTO_SEMANAL', 5);
define('CALENDAR_EVENTO_MENSUAL', 6);

define('MAX_REGISTROS_CALENDAR', 8);

class Applet_Calendar
{
    function handleJSON_getContent($smarty, $module_name, $appletlist)
    {
        /* Se cierra la sesión para quitar el candado sobre la sesión y permitir
         * que otras operaciones ajax puedan funcionar. */
        $issabeluser = $_SESSION['issabel_user'];
        session_commit();
        
        $respuesta = array(
            'status'    =>  'success',
            'message'   =>  '(no message)',
        );
        
        // Leer credenciales a partir del usuario y el perfil asociado
        global $arrConf;
        $dbAcl = new paloDB($arrConf["issabel_dsn"]["acl"]);
        $pACL  = new paloACL($dbAcl);
        $userId  = $pACL->getIdUser($issabeluser);
        
        $listaEventos = $this->_leerRegistrosEventos($userId);
        $listaEventosDias = $this->_expandirRegistrosEventos($listaEventos);
        $smarty->assign(array(
            'NO_EVENTOS'    =>  _tr("You don't have events"),
            'EVENTOS_DIAS'  =>  $listaEventosDias,
            'tag_date' => _tr("Date"),  
            'tag_call' => _tr("Call"),
        ));
        
        $local_templates_dir = dirname($_SERVER['SCRIPT_FILENAME'])."/modules/$module_name/applets/Calendar/tpl";
        $respuesta['html'] = $smarty->fetch("$local_templates_dir/calendar_events.tpl");

        $json = new Services_JSON();
        Header('Content-Type: application/json');
        return $json->encode($respuesta);
    }
    
    private function _leerRegistrosEventos($idUser)
    {
        global $arrConf;

        $db = new paloDB("sqlite3:///{$arrConf['issabel_dbdir']}/calendar.db");
        $sql = <<<SQL_EVENTOS
SELECT id, subject, asterisk_call, startdate, enddate, starttime, endtime, eventtype
FROM events
WHERE uid = ? AND enddate >= ?
ORDER BY id desc        
SQL_EVENTOS;
        $recordset = $db->fetchTable($sql, TRUE, array($idUser, date('Y-m-d')));
        if (!is_array($recordset)) return array();
        return $recordset;
    }
    
    private function _expandirRegistrosEventos(&$listaEventos)
    {
    	$iTimestamp = time();
        
        $listaEventosDias = array();
        foreach ($listaEventos as $evento) {
        	$sIncremento = NULL;
            switch ($evento['eventtype']) {
            case CALENDAR_EVENTO_DIARIO:
                $sIncremento = '+1 days';
                break;
            case CALENDAR_EVENTO_SEMANAL:
                $sIncremento = '+1 weeks';
                break;
            case CALENDAR_EVENTO_MENSUAL:
                $sIncremento = '+1 months';
                break;
            }
            if (is_null($sIncremento)) continue;
            
            $iStartTimestamp = strtotime($evento['starttime']);
            $iEndTimestamp   = strtotime($evento['endtime']);
            while ($iStartTimestamp <= $iEndTimestamp) {
                if ($iStartTimestamp >= $iTimestamp) {
                    $sFechaEvento = date('Y-m-d H:i:s', $iStartTimestamp);
                    $listaEventosDias[$sFechaEvento] = array(
                        "date"      =>  $sFechaEvento,
                        'dateshort' =>  date('Y-m-d', $iStartTimestamp),
                        "subject"   =>  $evento['subject'],
                        "call"      =>  $evento['asterisk_call'],
                        "id"        =>  $evento['id']
                    );
                }
                $iStartTimestamp = strtotime($sIncremento, $iStartTimestamp);
            }
        }
        ksort($listaEventosDias);
        
        return array_slice($listaEventosDias, 0, MAX_REGISTROS_CALENDAR);
    }
}
?>
