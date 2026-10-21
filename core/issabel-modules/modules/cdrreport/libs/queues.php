<?php
/*
  vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 0.5                                                  |
  | http://www.issabel.org                                               |
  +----------------------------------------------------------------------+
  | Copyright (c) 2006 Palosanto Solutions S. A.                         |
  | Copyright (c) 1997-2003 Palosanto Solutions S. A.                    |
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
  | Autores: Carlos Barcos <cbarcos@palosanto.com>                       |
  +----------------------------------------------------------------------+
  $Id: ringgroup.php,v 1.1 2007/01/09 23:49:36 alex Exp $
*/
class Queue {
    var $db=null;
    var $errMsg=null;

    function __construct($pDB){
      $this->db=$pDB;
      if (is_object($pDB)) {
        $this->db =& $pDB;
        $this->errMsg = $this->db->errMsg;
      }else{
        $dsn = (string)$pDB;
        $this->db = new paloDB($dsn);
        if (!$this->db->connStatus) {
          $this->errMsg = $this->db->errMsg;
        }
      }
    }
    
    function getQueue($id=null){
      $where="";
      $result=null;
      $data=array();
      $query   = "SELECT extension,descr FROM queues_config ";
      if(!is_null($id) && !empty($id) && is_numeric($id) ){
        $query .= "where extension=?";
        $result=$this->db->getFirstRowQuery($query, true, array($id));
        if(isset($result) && is_array($result) && count($result)>0){
          $data[$result['extension']]=$result['descr'];
          return $data;
        }
      }else{
        $result=$this->db->fetchTable($query, true);
        if(isset($result) && is_array($result) && count($result)>0){
          foreach ($result as $row){
            $data[$row['extension']]=$row['extension'].' / '.$row['descr'];
          }
          return $data;
        }
      }
      return $data;
    }
}
?>
