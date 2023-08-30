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
define('MAX_FAX_RECORDS', 8);

class Applet_Faxes extends Applet_ReportForExtension
{
    protected function _formatReportForExtension($smarty, $module_name, $extension, &$respuesta)
    {
        global $arrConf;
        
        $dbFax = new paloDB("sqlite3:///{$arrConf['issabel_dbdir']}/fax.db");
        $sql = <<<SQL_FAXES_EXTENSION
SELECT a.pdf_file, a.company_name, a.date, a.id
FROM info_fax_recvq a, fax b
WHERE b.extension = ? AND b.id = a.fax_destiny_id AND type='in'
ORDER BY a.id desc LIMIT ?
SQL_FAXES_EXTENSION;
        $recordset = $dbFax->fetchTable($sql, TRUE, array($extension, MAX_FAX_RECORDS));
        if (!is_array($recordset)) $recordset = array();
        if (count($recordset) <= 0) {
            $respuesta['status'] = 'error';
            $respuesta['message'] = _tr("You don't recibed faxes");
        } else {
            $estadoFaxes = array();
            
            foreach ($recordset as $tupla) {
            	$estadoFaxes[] = str_replace(array(
                        '{file}',
                        '{source}',
                        '{date}',
                    ),
                    array(
                        "<a href='?menu=faxviewer&action=download&rawmode=yes&id={$tupla['id']}'>{$tupla['pdf_file']}</a>",
                        ($tupla['company_name'] == 'XXXXXXX')? _tr('unknow') : $tupla['company_name'],
                        $tupla['date'],
                    ),
                    _tr('fax recived'));
            }
            $respuesta['html'] = implode("<br/>\n", $estadoFaxes);
        }
    }
}
?>