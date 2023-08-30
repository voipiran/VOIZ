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
require_once "modules/{$module_name}/libs/Applet_ReportForExtension.class.php";

define('MAX_CALL_RECORDS', 8);

class Applet_Calls extends Applet_ReportForExtension
{
    protected function _formatReportForExtension($smarty, $module_name, $extension, &$respuesta)
    {
        $dsnAsteriskCDR = generarDSNSistema("asteriskuser","asteriskcdrdb");
        $pDB = new paloDB($dsnAsteriskCDR);    
        if (!empty($pDB->errMsg)) {
            $respuesta['status'] = 'error';
            $respuesta['message'] = _tr('Error at read yours calls.').$pDB->errMsg;
        } else {
            $sql = <<<SQL_LLAMADAS_RECIBIDAS
SELECT calldate, src, duration, disposition FROM cdr
WHERE dst = ? OR SUBSTRING_INDEX(SUBSTRING_INDEX(dstchannel,'-',1),'/',-1) = ?
ORDER BY calldate DESC LIMIT ?
SQL_LLAMADAS_RECIBIDAS;
            $recordset = $pDB->fetchTable($sql, TRUE, array($extension, $extension, MAX_CALL_RECORDS));
            if (!is_array($recordset)) {
                $respuesta['status'] = 'error';
                $respuesta['message'] = _tr('Error at read yours calls.').$pDB->errMsg;
            } elseif (count($recordset) <= 0) {
                $respuesta['html'] = _tr("You don't recibed calls");
            } else {
                $estadoLlamadas = array();
                foreach ($recordset as $tupla) {
                    $answ = ($tupla['disposition'] == 'ANSWERED');
                    $estadoLlamadas[] = str_replace(array(
                            '{status}',
                            '{date}',
                            '{source}',
                        ),
                        array(
                            ($answ ? _tr('answered') : _tr('missed')),
                            $tupla['calldate'],
                            (empty($tupla['src']) ? _tr('unknow') : $tupla['src']),
                        ),
                        _tr('call record'))
                        .($answ ? str_replace('{time}', $tupla['duration'], _tr('call duration')) : '.');
                }
                $respuesta['html'] = implode('<br/>', $estadoLlamadas);
            }
        }
    }
}
?>