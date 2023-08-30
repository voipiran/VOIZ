<?php
  /* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 4.0.0-1                                               |
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
  $Id: paloSantoConfEcho.class.php,v 1.1 2009-09-14 10:12:09 ecueva onavarrete@palosanto.com Exp $ */
class paloSantoConfEcho {
    var $_DB;
    var $errMsg;

    function paloSantoConfEcho(&$pDB)
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

    /*HERE YOUR FUNCTIONS*/

    function addEchoCanceller($data)
    {
        $queryInsert = $this->_DB->construirInsert('echo_canceller', $data);
        $result = $this->_DB->genQuery($queryInsert);

        return $result;
    }

    function addCardParameter($data)
    {
        $queryInsert = $this->_DB->construirInsert('card', $data);
        $result = $this->_DB->genQuery($queryInsert);

        return $result;
    }

    function deleteEchoCanceller(){
        $query = "DELETE FROM echo_canceller";
        $result = $this->_DB->genQuery($query);
    }
    
    function deleteCardParameter(){
        $query = "DELETE FROM card";
        $result = $this->_DB->genQuery($query);
    }

    function getEchoCancellerByIdCard($id_card)
    {
        $query = "SELECT num_port, name_port, echocanceller FROM echo_canceller WHERE id_card=$id_card";
        
        $result=$this->_DB->fetchTable($query, true);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return array();
        }
        //$count=0;
        $arrEchoCan = array();
        foreach($result as $key => $value){
            //$count++;
            $arrEchoCan[$value['num_port']]['name_port'] = $value['name_port'];
            $arrEchoCan[$value['num_port']]['type_echo'] = $value['echocanceller'];
        }
        return $arrEchoCan;
    }

    function getEchoCancellerByIdCard2($id_card)
    {
        $query = "SELECT num_port, name_port, echocanceller FROM echo_canceller WHERE id_card=$id_card";
        
        $result=$this->_DB->fetchTable($query, true);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return array();
        }

        return $result;
    }

    function getCardParameterById($id_card){
        $query = "SELECT * FROM card WHERE id_card=$id_card";

        $result=$this->_DB->getFirstRowQuery($query,true);

        if($result==FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return null;
        }
        return $result;
        
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

    function updateEchoCancellerCard($id_card, $num_port, $echocanceller)
    {
        $data   = array($echocanceller, $num_port, $id_card);
        $query  = "UPDATE echo_canceller SET echocanceller = ? WHERE num_port = ? AND id_card = ? ";
        $result = $this->_DB->genQuery($query, $data);

        if($result == FALSE){
            $this->errMsg = $this->_DB->errMsg;
            return FALSE;
        }else
            return TRUE;
    }


}
?>