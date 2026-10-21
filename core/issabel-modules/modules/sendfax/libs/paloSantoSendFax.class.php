<?php
  /* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 2.0.0-7                                               |
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
  $Id: paloSantoSendFax.class.php,v 1.1 2009-12-14 02:12:12 Oscar Navarrete J. onavarrete@palosanto.com Exp $ */
class paloSantoSendFax {
    var $_DB;
    var $errMsg;

    function paloSantoSendFax(&$pDB)
    {
        // Se recibe como parámetro una referencia a una conexión paloDB
        if (is_object($pDB)) {
            $this->_DB =& $pDB;
            $this->errMsg = $this->_DB->errMsg;
        } else {
            $dsn = (string)$pDB;
            $this->_DB = new paloDB($dsn);

            if (!$this->_DB->connStatus) {
                $this->errMsg = $this->_DB->errMsg;
                // debo llenar alguna variable de error
            } else {
                // debo llenar alguna variable de error
            }
        }
    }

    function generarArchivoTextoPS(&$data_content)
    {
        // Si el contenido es ASCII se escribe directamente al archivo
        $bEsAscii = TRUE;
        foreach (str_split($data_content) as $c) if (ord($c) >= 127) {
             $bEsAscii = FALSE; break;
        }
        if ($bEsAscii) {
            $ruta_archivo = tempnam('/tmp', 'data_');
            file_put_contents($ruta_archivo, $data_content);
            return $ruta_archivo;
        }
        
        /* El contenido a escribir no es ASCII. Ya que la página web emite 
         * UTF-8, se asumirá que el contenido está también codificado en UTF-8
         * (verificado en Firefox 16 e Internet Explorer 6). 
         * 
         * El código de abajo es necesario debido a que
         * 1) /usr/bin/sendfax no reconoce como texto un archivo en codificación
         *    distinta de ASCII
         * 2) /usr/sbin/textfmt sólo puede convertir desde una fuente ISO-8859-15
         */
        $ruta_temp = tempnam('/tmp', 'data_');
        file_put_contents($ruta_temp, iconv('UTF-8', 'ISO-8859-15//TRANSLIT', $data_content));
        $ruta_archivo = tempnam('/tmp', 'data_');
        $output = $retval = NULL;
        exec('/usr/sbin/textfmt -B -f Courier-Bold -Ml=0.4in -p11 < '.
            escapeshellarg($ruta_temp).' > '.escapeshellarg($ruta_archivo),
            $output, $retval);
        unlink($ruta_temp);

        return ($retval == 0) ? $ruta_archivo : NULL;
    }

    /*HERE YOUR FUNCTIONS*/
    function sendFax($faxexten, $destine, $data)
    {
        $faxhost = escapeshellarg("$faxexten@127.0.0.1");
        $destine = escapeshellarg($destine);
        $data = escapeshellarg($data);
        $output = $retval = NULL;
        exec("sendfax -D -h $faxhost -n -d $destine $data 2>&1", $output, $retval);
        $regs = NULL;
        if ($retval != 0 || !preg_match('/request id is (\d+)/', implode('', $output), $regs)) {
            $this->errMsg = implode('<br/>', $output);
            return NULL;
        }
        return $regs[1];
    }
}
?>