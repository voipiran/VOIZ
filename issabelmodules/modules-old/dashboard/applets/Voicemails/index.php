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

require_once "modules/{$module_name}/libs/Applet_ReportForExtension.class.php";

define('MAX_VM_RECORDS', 8);

class Applet_Voicemails extends Applet_ReportForExtension
{
    protected function _formatReportForExtension($smarty, $module_name, $extension, &$respuesta)
    {
        $voicePath = "/var/spool/asterisk/voicemail/default/$extension/INBOX";            
        $result = is_dir($voicePath) ? glob("$voicePath/*.txt") : array();
        if (count($result) <= 0) {
            $respuesta['status'] = 'error';
            $respuesta['message'] = _tr("You don't recibed voicemails");
        } else {
            $clavesVM = array();
            foreach ($result as $archivo) {
                /* El archivo es formato ini, pero no estoy seguro de que 
                 * sea completamente parseable por parse_ini_file() */
                $content = array();
                foreach (file($archivo) as $s) {
                    $regs = NULL;
                    if (preg_match('/^(\w+)\s*=\s*(.*)/', trim($s), $regs)) {
                        $content[$regs[1]] = $regs[2];
                    }
                }
                $clavesVM[$content['origtime']] = $content;
            }
            krsort($clavesVM, SORT_STRING);                
            
            $estadoVM = array();                
            foreach (array_slice($clavesVM, 0, MAX_VM_RECORDS) as $content) {
                $estadoVM[] = str_replace(array(
                        '{source}',
                        '{date}',
                        '{duration}',
                    ),
                    array(
                        (($content['callerid'] == 'Unknown') ? _tr('unknow') : $content['callerid']),
                        date('Y/m/d H:i:s', $content['origtime']),
                        $content['duration'],
                    ),
                    _tr('voicemail recived'));
            }
            $respuesta['html'] = implode(".<br/>\n", $estadoVM).".<br/>\n";
        }
    }
}
?>