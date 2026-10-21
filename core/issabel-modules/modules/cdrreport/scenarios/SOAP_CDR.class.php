<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 4.0.4                                                |
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
  $Id: SOAP_CDR.class.php,v 1.0 2011-03-31 12:50:00 Alberto Santos F.  asantos@palosanto.com Exp $*/

$root = $_SERVER["DOCUMENT_ROOT"];
require_once("$root/modules/cdrreport/libs/core.class.php");

class SOAP_CDR extends core_CDR
{
    /**
     * SOAP Server Object
     *
     * @var object
     */
    private $objSOAPServer;

    /**
     * Constructor
     *
     * @param  object   $objSOAPServer     SOAP Server Object
     */
    public function SOAP_CDR($objSOAPServer)
    {
         parent::core_CDR();
         $this->objSOAPServer = $objSOAPServer;
    }

    /**
     * Static function that calls to the function getFP of its parent
     *
     * @return  array     Array with the definition of the function points.
     */
    public static function getFP()
    {
        return parent::getFP();
    }

    /**
     * Function that implements the SOAP call to list the CDRs that were originated or received by the user's extension in the date 
     * range specified by the request. If an error exists a SOAP fault is thrown
     * 
     * @param mixed request:
     *                  startdate:  (datetime,opcional) initial date and time for the report, or all if omitted
     *                  enddate:    (datetime, opcional) end date and time for the report, or all if omitted
     *                  offset:     (positiveInteger,opcional) start of records or 0 if omitted
     *                  limit:      (positiveInteger, opcional) limit records or all if omitted
     * @return  mixed   Array with the information of the CDRs
     */
    public function listCDR($request)
    {
        $return = parent::listCDR($request->startdate,$request->enddate,$request->offset,$request->limit);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return $return;
    }
}
?>
