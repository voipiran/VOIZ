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
  $Id: SOAP_AddressBook.class.php,v 1.0 2011-03-31 11:50:00 Alberto Santos F.  asantos@palosanto.com Exp $*/

$root = $_SERVER["DOCUMENT_ROOT"];
require_once("$root/modules/address_book/libs/core.class.php");

class SOAP_AddressBook extends core_AddressBook
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
    public function SOAP_AddressBook($objSOAPServer)
    {
        parent::core_AddressBook();
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
     * Function that implements the SOAP call to see the address book of User Logon SOAP service. The address book has an internal part
     * that is a list of available extensions, and an external part that resides in SQLITE database managed by Issabel. If an
     * error exists a SOAP fault is thrown
     *
     * @param mixed    $request:
     *                      addressBookType {internal, external}
     *                      offset (optional): positiveInteger
     *                      limit (optional): positiveInteger
     * @return mixed   Array with the information of the contact list (address book).
     */
    public function listAddressBook($request)
    {

        $return = parent::listAddressBook($request->addressBookType,$request->offset,$request->limit);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return $return;
    }

    /**
     * Function that implements the SOAP call to add a new contact to the external address book. If an error exists a SOAP fault is    * thrown
     *
     * @param mixed    $request:
     *                      phone:      phone number of new contact
     *                      first_name: First Name of the contact
     *                      last_name:  Last Name of the contact
     *                      email:      Email of the contact
     * @return mixed   Array with boolean data, true if was successful or false if an error exists
     */
    public function addAddressBookContact($request)
    {
        $return = parent::addAddressBookContact($request->phone,$request->first_name,$request->last_name,$request->email);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return array("return" => $return);
    }

    /**
     * Function that implements the SOAP call to remove a contact from the external address book. If an error exists a SOAP fault is   * thrown
     * 
     * @param   mixed   $request:
     *                      id: ID of the contact to remove
     * @return  mixed   Array with boolean data, true if was successful or false if an error exists
     */
    public function delAddressBookContact($request)
    {
        $return = parent::delAddressBookContact($request->id);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return array("return" => $return);
    }
}
?>
