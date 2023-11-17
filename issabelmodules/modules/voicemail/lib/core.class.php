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
  $Id: puntosF_Voicemail.class.php,v 1.0 2011-03-30 15:00:00 Alberto Santos F.  asantos@palosanto.com Exp $*/

$root = $_SERVER["DOCUMENT_ROOT"];
require_once("$root/libs/paloSantoConfig.class.php");
require_once("$root/libs/misc.lib.php");
require_once("$root/configs/default.conf.php");
require_once("$root/libs/paloSantoDB.class.php");
require_once("$root/libs/paloSantoACL.class.php");
require_once("$root/modules/voicemail/lib/paloSantoVoiceMail.class.php");

class core_Voicemail
{
    /**
     * Description error message
     *
     * @var array
     */
    private $errMsg;

    /**
     * ACL User ID for authenticated user
     *
     * @var integer
     */
    private $_id_user;

    /**
     * Array that contains a paloDB Object, the key is the DSN of a specific database
     *
     * @var array
     */
    private $_dbCache;

    /**
     * Object paloACL
     *
     * @var object
     */
    private $_pACL;

    /**
     * DSN for connection to asterisk database
     *
     * @var string
     */
    private $_astDSN;

    /**
     * Constructor
     *
     */
    public function core_Voicemail()
    {
        $this->errMsg   = NULL;
        $this->_id_user = NULL;
        $this->_dbCache = array();
        $this->_pACL    = NULL;
        $pConfig = new paloConfig("/etc", "amportal.conf", "=", "[[:space:]]*=[[:space:]]*");
        $ampConf = $pConfig->leer_configuracion(false);
        $this->_astDSN =
            $ampConf['AMPDBENGINE']['valor']."://".
            $ampConf['AMPDBUSER']['valor']. ":".
            $ampConf['AMPDBPASS']['valor']. "@".
            $ampConf['AMPDBHOST']['valor']."/asterisk";
    }

    /**
     * Static function that creates an array with all the functional points with the parameters IN and OUT
     *
     * @return  array     Array with the definition of the function points.
     */
    public static function getFP()
    {
        $arrData["listVoicemail"]["params_IN"] = array(
            "startdate"      => array("type" => "date",   "required" => true),
            "enddate"        => array("type" => "date",   "required" => true)
        );

        $arrData["listVoicemail"]["params_OUT"] = array(
            "totalVoicemail" => array("type" => "positiveInteger",   "required" => true),
            "voicemail"      => array("type" => "array",   "required" => true, "minOccurs"=>"0", "maxOccurs"=>"unbounded",
                "params" => array(
                    "date"         => array("type" => "date",            "required" => true),
                    "time"         => array("type" => "date",            "required" => true),
                    "callerid"     => array("type" => "string",          "required" => true),
                    "extension"    => array("type" => "string",          "required" => true),
                    "duration"     => array("type" => "positiveInteger", "required" => true)
                        )
                    )
            );

        $arrData["delVoicemail"]["params_IN"] = array(
            "file"      => array("type" => "string",  "required" => true)
        );

        $arrData["delVoicemail"]["params_OUT"] = array(
            "return" => array("type" => "boolean",   "required" => true)
        );

        $arrData["setConfiguration"]["params_IN"] = array(
            "enable"               => array("type" => "boolean",  "required" => true),
            "email"                => array("type" => "string",   "required" => true),
            "pagerEmail"           => array("type" => "string",   "required" => false),
            "password"             => array("type" => "string",   "required" => true),
            "confirmPassword"      => array("type" => "string",   "required" => true),
            "emailAttachment"      => array("type" => "boolean",  "required" => true),
            "playCID"              => array("type" => "boolean",  "required" => true),
            "playEnvelope"         => array("type" => "boolean",  "required" => true),
            "deleteVmail"          => array("type" => "boolean",  "required" => true)
        );

        $arrData["setConfiguration"]["params_OUT"] = array(
            "return" => array("type" => "boolean",   "required" => true)
        );

        $arrData["downloadVoicemail"]["params_IN"] = array(
            "file"      => array("type" => "string",  "required" => true)
        );

        $arrData["downloadVoicemail"]["params_OUT"] = array(
            "audio"       => array("type" => "string",   "required" => true),
            "contentType" => array("type" => "string",   "required" => true),
            "size"        => array("type" => "string",   "required" => true)
        );

        $arrData["listenVoicemail"]["params_IN"] = array(
            "file"      => array("type" => "string",  "required" => true)
        );

        $arrData["listenVoicemail"]["params_OUT"] = array(
            "return"       => array("type" => "boolean",   "required" => true)
        );

        return $arrData;
    }

    /**
     * Function that creates, if do not exist in the attribute dbCache, a new paloDB object for the given DSN
     *
     * @param   string   $sDSN   DSN of a specific database
     * @return  object   paloDB object for the entered database
     */
    private function & _getDB($sDSN)
    {
        if (!isset($this->_dbCache[$sDSN])) {
            $this->_dbCache[$sDSN] = new paloDB($sDSN);
        }
        return $this->_dbCache[$sDSN];
    }

    /**
     * Function that creates, if do not exist in the attribute _pACL, a new paloACL object
     *
     * @return  object   paloACL object
     */
    private function & _getACL()
    {
        global $arrConf;

        if (is_null($this->_pACL)) {
            $pDB_acl = $this->_getDB($arrConf['issabel_dsn']['acl']);
            $this->_pACL = new paloACL($pDB_acl);
        }
        return $this->_pACL;
    }

    /**
     * Function that reads the login user ID, that assumed is on $_SERVER['PHP_AUTH_USER']
     *
     * @return  integer   ACL User ID for authenticated user, or NULL if the user in $_SERVER['PHP_AUTH_USER'] does not exist
     */
    private function _leerIdUser()
    {
        if (!is_null($this->_id_user)) return $this->_id_user;

        $pACL = $this->_getACL();
        $id_user = $pACL->getIdUser($_SERVER['PHP_AUTH_USER']);
        if ($id_user == FALSE) {
            $this->errMsg["fc"] = 'INTERNAL';
            $this->errMsg["fm"] = 'User-ID not found';
            $this->errMsg["fd"] = 'Could not find User-ID in ACL for user '.$_SERVER['PHP_AUTH_USER'];
            $this->errMsg["cn"] = get_class($this);
            return NULL;
        }
        $this->_id_user = $id_user;
        return $id_user;
    }

    /**
     * Function that gets the extension of the login user, that assumed is on $_SERVER['PHP_AUTH_USER']
     *
     * @return  string   extension of the login user, or NULL if the user in $_SERVER['PHP_AUTH_USER'] does not have an extension     *                   assigned
     */
    private function _leerExtension()
    {
        // Identificar el usuario para averiguar el número telefónico origen
        $id_user = $this->_leerIdUser();

        $pACL = $this->_getACL();
        $user = $pACL->getUsers($id_user);
        if ($user === FALSE) {
            $this->errMsg["fc"] = 'ACL';
            $this->errMsg["fm"] = 'ACL lookup failed';
            $this->errMsg["fd"] = 'Unable to read information from ACL - '.$pACL->errMsg;
            $this->errMsg["cn"] = get_class($pACL);
            return NULL;
        }

        // Verificar si tiene una extensión
        $extension = $user[0][3];
        if ($extension == "") {
            $this->errMsg["fc"] = 'EXTENSION';
            $this->errMsg["fm"] = 'Extension lookup failed';
            $this->errMsg["fd"] = 'No extension has been set for user '.$_SERVER['PHP_AUTH_USER'];
            $this->errMsg["cn"] = get_class($pACL);
            return NULL;
        }

        return $extension;
    }

    /**
     * Function that verifies if the parameter can be parsed as a date, and returns the canonic value of the date
     * like yyyy-mm-dd in local time.
     *
     * @param   string   $sDateString   string date to be parsed as a date
     * @return  date     parsed date, or NULL if the $sDateString can not be parsed
     */
    private function _checkDateFormat($sDateString)
    {
        $sTimestamp = strtotime($sDateString);
        if ($sTimestamp === FALSE) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Unrecognized date format, expected yyyy-mm-dd';
            $this->errMsg["cn"] = get_class($this);
            return NULL;
        }
        return date('Y-m-d', $sTimestamp);
    }

    /**
     * Functional point that returns an array with the voicemail list for the extension of the authenticated user
     *
     * @param   date      $startdate   lowest date which could be created the voicemail
     * @param   date      $enddate     highest date which could be created the voicemail
     * @return  array     Array with the list of all voicemails in the specified range, or false if an error exists
     */
    public function listVoicemail($startdate, $enddate)
    {
        if(!isset($startdate) || !isset($enddate)){
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Required Parameter';
            $this->errMsg["fd"] = "The Parameters 'startdate' and 'enddate' are required";
            $this->errMsg["cn"] = get_class($this);
            return false;
        }
        $archivos=array();
        $extension = $this->_leerExtension();
        if (is_null($extension)) return false;

        $sFechaInicio = $this->_checkDateFormat(isset($startdate) ? $startdate : NULL);
        $sFechaFinal  = $this->_checkDateFormat(isset($enddate) ? $enddate : NULL);

        if (is_null($sFechaInicio) || is_null($sFechaFinal)) return false;

        if ($sFechaFinal < $sFechaInicio) {
            $t = $sFechaFinal; $sFechaFinal = $sFechaInicio; $sFechaInicio = $t;
        }

        $paloVoice = new paloSantoVoiceMail();
        $rs = $paloVoice->listVoicemail(array(
            'date_start'    => $sFechaInicio,
            'date_end'      => $sFechaFinal,
            'extension'     => $extension,
        ));
        $arrData = array();
        foreach ($rs as $t) {
            $arrData[] = array(
                'date'      =>  date('Y-m-d', $t['origtime']),
                'time'      =>  date('H:i:s', $t['origtime']),
                'callerid'  =>  $t['callerid'],
                'extension' =>  $t['extension'],
                'duration'  =>  $t['duration'],
            );
        }

        return array(
            "totalVoicemail" => count($arrData),
            "voicemail"      => $arrData);
    }

    /**
     * Functional point that deletes a voicemail
     *
     * @param   string      $file   name of the voicemail file to be deleted
     * @return  boolean   True if the voicemail was deleted, or false if an error exists
     */
    public function delVoicemail($file)
    {
        if(!isset($file)){
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Required Parameter';
            $this->errMsg["fd"] = "The Parameter 'file' is required";
            $this->errMsg["cn"] = get_class($this);
            return false;
        }
        $extension = $this->_leerExtension();
        if (is_null($extension)) return false;
        $paloVoice = new paloSantoVoiceMail();
        if (!$paloVoice->deleteVoiceMail($extension, $file)) {
            $this->errMsg = array(
                'fc'    =>  'ERROR',
                'fm'    =>  'File does not exist',
                'fd'    =>  $paloVoice->errMsg,
                'cn'    =>  get_class($this),
            );
            return FALSE;
        }
        return true;
    }

    /**
     * Functional point that sets the configuration for the voicemail of the extension of the authenticated user
     *
     * @param   boolean     $enable               true if the configuration will be enabled or false if it will be disabled
     * @param   string      $email                email for the voicemail
     * @param   string      $pagerEmail           (optional) pager email for the voicemail
     * @param   string      $password             password for the voicemail
     * @param   string      $confirmPassword      must be equal to $password
     * @param   boolean     $emailAttachment      true if the email Attachment is on or false if it is off
     * @param   boolean     $playCID              true if the play CID is on or false if it is off
     * @param   boolean     $playEnvelope         true if the play Envelope is on or false if it is off
     * @param   boolean     $deleteVmail          true if the delete Vmail is on or false if it is off
     * @return  boolean    True if the voicemail was configurated, or false if an error exists
     */
    public function setConfiguration($enable, $email, $pagerEmail, $password, $confirmPassword, $emailAttachment, $playCID, $playEnvelope, $deleteVmail)
    {
        $extension = $this->_leerExtension();
        if (is_null($extension)) return false;

        if(!isset($enable) || !isset($email) || !isset($password) || !isset($confirmPassword) || !isset($emailAttachment) || !isset($playCID) || !isset($playEnvelope) || !isset($deleteVmail)){
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Required Parameter';
            $this->errMsg["fd"] = "The Parameters 'enable', 'email', 'password', 'confirmPassword', 'emailAttachment', 'playCID', 'playEnvelope' and 'deleteVmail' are required";
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

        if(!preg_match("/^[a-z0-9]+([\._\-]?[a-z0-9]+[_\-]?)*@[a-z0-9]+([\._\-]?[a-z0-9]+)*(\.[a-z0-9]{2,4})+$/",$email)){
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Validation Error';
            $this->errMsg["fd"] = "$email is not a valid email";
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

        if(isset($pagerEmail))
            if(!preg_match("/^[a-z0-9]+([\._\-]?[a-z0-9]+[_\-]?)*@[a-z0-9]+([\._\-]?[a-z0-9]+)*(\.[a-z0-9]{2,4})+$/",$pagerEmail)){
                $this->errMsg["fc"] = 'PARAMERROR';
                $this->errMsg["fm"] = 'Validation Error';
                $this->errMsg["fd"] = "$pagerEmail is not a valid email";
                $this->errMsg["cn"] = get_class($this);
                return false;
            }

        if($password != $confirmPassword){
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Validation Error';
            $this->errMsg["fd"] = "'password' and 'confirmPassword' do not match";
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

        $paloVoice = new paloSantoVoiceMail();
        $bandera = $paloVoice->writeFileVoiceMail($extension, $enable
            ? array(
                'voicemail_password'    =>  $password,
                // user_name se conserva
                'user_email_address'    =>  $email,
                'pager_email_address'   =>  $pagerEmail,
                'user_options'          =>  array(
                    // toda bandera distinta de las indicadas abajo se conserva
                    'attach'    =>  $emailAttachment ? 'yes' : 'no',
                    'saycid'    =>  $playCID     ? 'yes' : 'no',
                    'envelope'  =>  $playEnvelope? 'yes' : 'no',
                    'delete'    =>  $deleteVmail ? 'yes' : 'no',
                ),
            )
            : NULL);

        if(!$bandera){
            $this->errMsg["fc"] = 'ERROR';
            $this->errMsg["fm"] = 'Error writing the file';
            $this->errMsg["fd"] = "An error occurs while writing the file: {$paloVoice->errMsg}";
            $this->errMsg["cn"] = get_class($paloVoice);
            return false;
        }
        return true;
    }


    /**
     * Functional point that gets the size and content Type of a voicemail to be downloaded and returns it with the content as a       * string, but codified in base64, of the voicemail file
     *
     * @param   string      $file   name of the voicemail file to be downloaded
     * @return  array   Array with the size, content Type and audio as a string in base64 code, or false if an error exists
     */
    public function downloadVoicemail($file)
    {
        if(!isset($file)){
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Required Parameter';
            $this->errMsg["fd"] = "The Parameter 'file' is required";
            $this->errMsg["cn"] = get_class($this);
            return false;
        }
        $extension = $this->_leerExtension();
        if (is_null($extension)) return false;

        $paloVoice = new paloSantoVoiceMail();
        $msgbase = substr($file, 0, -4);
        $recinfo = $paloVoice->resolveVoiceMailFiles($extension, $msgbase);
        if (is_null($recinfo)) {
            $this->errMsg = array(
                'fc'    =>  'ERROR',
                'fm'    =>  'File does not exist',
                'fd'    =>  $paloVoice->errMsg,
                'cn'    =>  get_class($this),
            );
            return FALSE;
        }
        $voicemailPath = NULL;
        foreach ($recinfo['recordings'] as $rec) {
            if (basename($rec['fullpath']) == $file) {
                $voicemailPath = $rec['fullpath'];
                $ctype = $rec['mimetype'];
                $size = filesize($voicemailPath);
                break;
            }
        }
        if (is_null($voicemailPath)) {
            $this->errMsg = array(
                'fc'    =>  'FILERROR',
                'fm'    =>  'Wrong Audio format file',
                'fd'    =>  'The file $file does not have a correct audio format',
                'cn'    =>  get_class($this),
            );
            return FALSE;
        }

        $audio = file_get_contents($voicemailPath);
        if($audio=="" || $size == 0){
            $this->errMsg["fc"] = 'ERROR';
            $this->errMsg["fm"] = 'File Error';
            $this->errMsg["fd"] = "The file $file is empty";
            $this->errMsg["cn"] = get_class($this);
            return false;
        }
        return array("audio"       => base64_encode($audio),
                     "contentType" => $ctype,
                     "size"        => $size);
    }

    //TODO: Queda pendiente este punto funcional debido a que hay problemas para escuchar el voicemail ya que pide plug in el browser
    public function listenVoicemail($file)
    {
        return true;
    }

    /**
     *
     * Function that returns the error message
     *
     * @return  string   Message error if had an error.
     */
    public function getError()
    {
        return $this->errMsg;
    }
}

?>
