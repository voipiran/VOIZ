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
  $Id: puntosF_CDR.class.php,v 1.0 2011-03-31 09:55:00 Alberto Santos F.  asantos@palosanto.com Exp $*/

define('SOAP_DATETIME_FORMAT', 'Y-m-d\TH:i:sP');

$root = $_SERVER["DOCUMENT_ROOT"];
require_once("$root/libs/misc.lib.php");
require_once("$root/configs/default.conf.php");
require_once("$root/libs/paloSantoDB.class.php");
require_once("$root/libs/paloSantoACL.class.php");
require_once("$root/libs/paloSantoConfig.class.php");


class core_CDR
{
    /**
     * Description error message
     *
     * @var array
     */
    private $errMsg;

    /**
     * DSN for connection to asterisk cdr database
     *
     * @var string
     */
    private $_astcdrDSN;

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
     * ACL User ID for authenticated user
     *
     * @var integer
     */
    private $_id_user;

    /**
     * Constructor
     *
     */
    public function core_CDR()
    {
        $this->_dbCache   = array();
        $this->_pACL      = NULL;
        $this->_id_user   = NULL;
        $pConfig          = new paloConfig("/etc", "amportal.conf", "=", "[[:space:]]*=[[:space:]]*");
        $ampConf   = $pConfig->leer_configuracion(false);
        $this->_astcdrDSN = 
            $ampConf['AMPDBENGINE']['valor']."://".
            $ampConf['AMPDBUSER']['valor']. ":".
            $ampConf['AMPDBPASS']['valor']. "@".
            $ampConf['AMPDBHOST']['valor']."/asteriskcdrdb";
        $this->errMsg = NULL;
    }

    /**
     * Static function that creates an array with all the functional points with the parameters IN and OUT
     *
     * @return  array     Array with the definition of the function points.
     */
    public static function getFP()
    {
        $arrData["listCDR"]["params_IN"] = array(
            "limit"      => array("type" => "positiveInteger",   "required" => false),
            "offset"     => array("type" => "positiveInteger",   "required" => false),
            "startdate"  => array("type" => "dateTime",          "required" => false),
            "enddate"    => array("type" => "dateTime",          "required" => false)
        );

        $arrData["listCDR"]["params_OUT"] = array(
            "totalcdrcount" => array("type" => "positiveInteger",   "required" => true),
            "cdrs"          => array("type" => "array",   "required" => true, "minOccurs"=>"0", "maxOccurs"=>"unbounded",
                "params" => array(
                    "calldate"       => array("type" => "dateTime",          "required" => true),
                    "src"            => array("type" => "string",            "required" => true),
                    "dst"            => array("type" => "string",            "required" => true),
                    "channel"        => array("type" => "string",            "required" => true),
                    "dstchannel"     => array("type" => "string",            "required" => true),
                    "disposition"    => array("type" => "string",            "required" => true),
                    "uniqueid"       => array("type" => "string",            "required" => true),
                    "duration"       => array("type" => "positiveInteger",   "required" => true),
                    "billsec"        => array("type" => "positiveInteger",   "required" => true),
                    "accountcode"    => array("type" => "string",            "required" => true),
                        )
                    )
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
        if ($user == FALSE) {
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
     * like yyyy-mm-dd hh:mm:ss in local time.
     *
     * @param   string   $sDateString   string date to be parsed as a date time
     * @return  date     parsed date, or NULL if the $sDateString can not be parsed
     */
    private function _checkDateTimeFormat($sDateString)
    {
        $sTimestamp = strtotime($sDateString);
        if ($sTimestamp === FALSE) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Unrecognized date format, expected yyyy-mm-dd hh:mm:ss';
            $this->errMsg["cn"] = get_class($this);
            return NULL;
        }
        return date('Y-m-d H:i:s', $sTimestamp);
    }

    /**
     * Function that verifies the parameters offset and limit, if offset is not set it will be set to 0
     *
     * @param   integer   $offset   value of offset passed by reference
     * @param   integer   $limit    value of limit passed by reference
     * @return  mixed    true if both parameters are correct, or NULL if an error exists
     */
    private function _checkOffsetLimit(&$offset, &$limit)
    {
        // Validar los parámetros de offset y limit
        if (!isset($offset)) $offset = 0;
        if (!preg_match('/\d+/', $offset)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid offset, must be numeric and positive';
            $this->errMsg["cn"] = get_class($this);
            return NULL;
        }
        if (isset($limit) && !preg_match('/\d+/', $limit)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid limit, must be numeric and positive';
            $this->errMsg["cn"] = get_class($this);
            return NULL;
        }
        return TRUE;
    }

    /**
     * Functional point that list CDRs were originated or received by the authenticated user's extension in the range Date indicated  * by the petition.
     *
     * @param   date      $startdate   (optional) initial date and time for the report, or all if omitted
     * @param   date      $enddate     (optional) end date and time for the report, or all if omitted
     * @param   integer   $offset      (optional) start of records or 0 if omitted
     * @param   integer   $limit       (optional) limit records or all if omitted
     * @return  array     Array of CDRs with the following information:
     *                      totalcdrcount (positiveInteger) Total number of records
     *                      cdrs: (array) Settlement of CDRs with the following information:
     *                          calldate (datetime) Date and time of call
     *                          src (string) Power Call
     *                          dst (string) Destination of the call
     *                          channel (string) channel that originated the call
     *                          dstchannel (string) call destination Canal
     *                          disposition (string) Description of call status
     *                          uniqueid (string) unique ID call made
     *                          duration (positiveInteger) Duration of call in seconds
     *                          billsec (positiveInteger)
     *                          accountcode (string)
     *                    or false if an error exists
     */
    function listCDR($startdate,$enddate,$offset,$limit)
    {
        /* La verificación siguiente se desactiva porque normalmente cdrreport 
         * sólo se puede consultar por administrador. */
        //if (!$this->_checkUserAuthorized('cdrreport')) return NULL;

        if (!$this->_checkOffsetLimit($offset,$limit)) return NULL;

        // Validación de instantes de inicio y final
        $sFechaInicio = isset($startdate) ? $this->_checkDateTimeFormat($startdate) : NULL;
        $sFechaFinal  = isset($enddate) ? $this->_checkDateTimeFormat($enddate) : NULL;
        if (!(is_null($sFechaInicio) || is_null($sFechaFinal)) && $sFechaFinal < $sFechaInicio) {
            $t = $sFechaFinal; $sFechaFinal = $sFechaInicio; $sFechaInicio = $t;
        }

        // Se prepara la expresión regular para filtrar por extensión
        $sExtUsuario = $this->_leerExtension();

	// nuevo realizado por eduardo cueva
        $id_user = $this->_leerIdUser();
	
        $pACL = $this->_getACL();
        $user = $pACL->getUsers($id_user);
	$isUserAdmin = $pACL->isUserAdministratorGroup($user[0][1]);

	if((!isset($sExtUsuario) || $sExtUsuario == "")  && !$isUserAdmin){
	    $this->errMsg["fc"] = 'Not data found';
            $this->errMsg["fm"] = 'Username does not have any extension assigned.';
            $this->errMsg["fd"] = 'Unable to get CDRs';
            $this->errMsg["cn"] = get_class($this);
            return false;
	}
	// nuevo realizado por eduardo cueva



        $sRegExp = "^[[:alnum:]]+/{$sExtUsuario}[^[:digit:]]+";
        // Se construye la condición WHERE
        $sFromWhere = "FROM cdr ";
	$paramSQL = array();

	if(!$isUserAdmin){
	    $sWhere = "WHERE (channel REGEXP ? OR dstchannel REGEXP ?)";
	    $paramSQL = array($sRegExp, $sRegExp);
	}
        
        if (!is_null($sFechaInicio)) {
	    if(isset($sWhere))
		$sWhere .= " AND calldate >= ?";
	    else
		$sWhere = " WHERE calldate >= ?";
            array_push($paramSQL, $sFechaInicio);
        }
        if (!is_null($sFechaFinal)) {
	    if(isset($sWhere))
		$sWhere .= " AND calldate <= ?";
	    else
		$sWhere = " WHERE calldate <= ?";
            array_push($paramSQL, $sFechaFinal);
        }
	if(isset($sWhere))
	    $sFromWhere .= $sWhere;
        
        // Cuenta de registros que cumplen con las condiciones
        $pDB_AstCDR = $this->_getDB($this->_astcdrDSN);
        $sql = 'SELECT COUNT(*) '.$sFromWhere;
        $tupla = $pDB_AstCDR->getFirstRowQuery($sql, FALSE, $paramSQL);
        if (!is_array($tupla)) {
            $this->errMsg["fc"] = 'DBERROR';
            $this->errMsg["fm"] = 'Database operation failed';
            $this->errMsg["fd"] = 'Unable to count CDRs - '.$pDB_AstCDR->errMsg;
            $this->errMsg["cn"] = get_class($this);
            return false;
        }
        $infoCDRs = array(
            'totalcdrcount' =>  $tupla[0],
            'cdrs'          =>  array(),
        );

        if ($infoCDRs['totalcdrcount'] > 0) {
            $sql = 
                'SELECT calldate, src, dst, channel, dstchannel, disposition, '.
                'uniqueid, duration, billsec, accountcode '.$sFromWhere.
                ' ORDER BY calldate DESC';
            if (isset($offset) && !isset($limit)) {
                $limit = $infoCDRs['totalcdrcount']; 
            }
            if (isset($limit)) {
                $sql .= ' LIMIT ?';
                array_push($paramSQL, $limit);
            }
            if (isset($offset) && $offset > 0) {
                $sql .= ' OFFSET ?';
                array_push($paramSQL, $offset);
            }
            $infoCDRs['cdrs'] = $pDB_AstCDR->fetchTable($sql, TRUE, $paramSQL);
            if (!is_array($infoCDRs['cdrs'])) {
                $this->errMsg["fc"] = 'DBERROR';
                $this->errMsg["fm"] = 'Database operation failed';
                $this->errMsg["fd"] = 'Unable to fetch CDRs - '.$pDB_AstCDR->errMsg;
                $this->errMsg["cn"] = get_class($this);
                return false;
            }

            // Formatear fechas como formato SOAP
            for ($i = 0; $i < count($infoCDRs['cdrs']); $i++) {
                $infoCDRs['cdrs'][$i]['calldate'] = date(
                    SOAP_DATETIME_FORMAT, 
                    strtotime($infoCDRs['cdrs'][$i]['calldate']));
            }
        }

        return $infoCDRs;
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