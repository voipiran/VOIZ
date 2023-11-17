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
  $Id: SOAP_Voicemail.class.php,v 1.0 2011-03-31 13:20:00 Alberto Santos F.  asantos@palosanto.com Exp $*/

$root = $_SERVER["DOCUMENT_ROOT"];
require_once("$root/modules/voicemail/lib/core.class.php");

class SOAP_Voicemail extends core_Voicemail
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
    public function SOAP_Voicemail($objSOAPServer)
    {
        parent::core_Voicemail();
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
     * Function that implements the SOAP call to list the voicemails associated to the extension of the authenticated user.
     * If an error exists a SOAP fault is thrown
     * 
     * @param mixed request:
     *                  startdate: (date) lowest date which could be created the voicemail
     *                  enddate:   (date) highest date which could be created the voicemail
     * @return  mixed   Array with the information of the voicemails.
     */
    public function listVoicemail($request)
    {
        $return = parent::listVoicemail($request->startdate, $request->enddate);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return $return;
    }

    /**
     * Function that implements the SOAP call to delete a voicemail associated to the extension of the authenticated user.
     * If an error exists a SOAP fault is thrown
     * 
     * @param mixed request:
     *                  file:  (string) name of the voicemail file to be deleted
     * @return  mixed   Array with boolean data, true if was successful or false if an error exists
     */
    public function delVoicemail($request)
    {
        $return = parent::delVoicemail($request->file);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return array("return" => $return);
    }

    /**
     * Function that implements the SOAP call to set the voicemail configuration associated to the extension of the authenticated user.
     * If an error exists a SOAP fault is thrown
     * 
     * @param mixed request:
     *                  enable:              (boolean) TRUE if the configuration will be enabled or FALSE if it will be disabled
     *                  email:               (string) email for the voicemail
     *                  pagerEmail:          (string,Optional) pager email for the voicemail 
     *                  password:            (string) password for the voicemail
     *                  confirmPassword:     (string) must be equal to password
     *                  emailAttachment:     (boolean) TRUE if the email Attachment is 'on' or FALSE if it is 'off'
     *                  playCID:             (boolean) TRUE if the play CID is 'on' or FALSE if it is 'off'
     *                  playEnvelope:        (boolean) TRUE if the play Envelope is 'on' or FALSE if it is 'off'
     *                  deleteVmail:         (boolean) TRUE if the delete Vmail is 'on' or FALSE if it is 'off'
     * @return  mixed   Array with boolean data, true if was successful or false if an error exists
     */
    public function setConfiguration($request)
    {
        $return = parent::setConfiguration($request->enable, $request->email, $request->pagerEmail, $request->password, $request->confirmPassword, $request->emailAttachment, $request->playCID, $request->playEnvelope, $request->deleteVmail);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return array("return" => $return);
    }

    /**
     * Function that implements the SOAP call to download a Voicemail associated to the extension of the authenticated user.
     * If an error exists a SOAP fault is thrown
     * 
     * @param mixed request:
     *                  file:   (string)  name of the voicemail file to be downloaded
     * @return  mixed   Array with boolean data, true if was successful or false if an error exists
     */
    public function downloadVoicemail($request)
    {
        $return = parent::downloadVoicemail($request->file);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return $return;
    }

    /**
     * Function that implements the SOAP call to listen a Voicemail associated to the extension of the authenticated user.
     * If an error exists a SOAP fault is thrown
     * 
     * @param mixed request:
     *                  file:   (string)  name of the voicemail file to be listened
     * @return  TODO:FALTA LA IMPLEMENTACIÓN DE LA FUNCIÓN LISTENVOICEMAIL DEL PADRE
     */
    public function listenVoicemail($request)
    {
        $return = parent::listenVoicemail($request->file);
        if(!$return){
            $eMSG = parent::getError();
            $this->objSOAPServer->fault($eMSG['fc'],$eMSG['fm'],$eMSG['cn'],$eMSG['fd'],'fault');
        }
        return array("return" => $return);
    }
}
?>