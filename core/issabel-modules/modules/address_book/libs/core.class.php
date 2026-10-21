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
  $Id: puntosF_AddressBook.class.php,v 1.0 2011-03-31 11:30:00 Alberto Santos F.  asantos@palosanto.com Exp $*/

$root = $_SERVER["DOCUMENT_ROOT"];
require_once("$root/libs/misc.lib.php");
require_once("$root/configs/default.conf.php");
require_once("$root/modules/address_book/libs/paloSantoAdressBook.class.php");
require_once("$root/modules/address_book/configs/default.conf.php");
require_once("$root/libs/paloSantoACL.class.php");
require_once("$root/libs/paloSantoDB.class.php");

if (file_exists("/var/lib/asterisk/agi-bin/phpagi-asmanager.php")) {
    require_once "/var/lib/asterisk/agi-bin/phpagi-asmanager.php";
}

$arrConf = array_merge($arrConf,$arrConfModule);

class core_AddressBook
{
    /**
     * Description error message
     *
     * @var array
     */
    private $errMsg;

    /**
     * DSN for connection to asterisk database
     *
     * @var string
     */
    private $_astDSN;

    /**
     * ACL User ID for authenticated user
     *
     * @var integer
     */
    private $_id_user;

    /**
     * Object paloACL
     *
     * @var object
     */
    private $_pACL;

    /**
     * Array that contains a paloDB Object, the key is the DSN of a specific database
     *
     * @var array
     */
    private $_dbCache;

    /**
     * Constructor
     *
     */
    public function core_AddressBook()
    {
        $this->_id_user = NULL;
        $this->_pACL = NULL;
        $this->errMsg = NULL;
        $this->_dbCache = array();
        $this->_astDSN = generarDSNSistema('asteriskuser', 'asterisk', $_SERVER['DOCUMENT_ROOT'].'/');
    }

    /**
     * Static function that creates an array with all the functional points with the parameters IN and OUT
     *
     * @return  array     Array with the definition of the function points.
     */
    public static function getFP()
    {
        $arrData["listAddressBook"]["params_IN"] = array(
            "addressBookType"       => array("type" => "string",              "required" => true),
            "offset"                => array("type" => "positiveInteger",     "required" => false),
            "limit"                 => array("type" => "positiveInteger",     "required" => false)
        );

        $arrData["listAddressBook"]["params_OUT"] = array(
            "totalCount"     => array("type" => "positiveInteger",   "required" => true),
            "extension"      => array("type" => "array",             "required" => true, "minOccurs"=>"0", "maxOccurs"=>"unbounded",
                "params" => array(
                    "id"            => array("type" => "positiveInteger",  "required" => true),
                    "phone"         => array("type" => "string",           "required" => true),
                    "name"          => array("type" => "string",           "required" => true),
                    "first_name"    => array("type" => "string",           "required" => false),
                    "last_name"     => array("type" => "string",           "required" => false),
                    "email"         => array("type" => "string",           "required" => false)
                        )
                    )
            );

        $arrData["addAddressBookContact"]["params_IN"] = array(
            "phone"          => array("type" => "string",   "required" => true),
            "first_name"     => array("type" => "string",   "required" => false),
            "last_name"      => array("type" => "string",   "required" => false),
            "email"          => array("type" => "string",   "required" => false)
        );

        $arrData["addAddressBookContact"]["params_OUT"] = array(
            "return"         => array("type" => "boolean",    "required" => true)
        );

        $arrData["delAddressBookContact"]["params_IN"] = array(
            "id"            => array("type" => "positiveInteger",    "required" => true)
        );

        $arrData["delAddressBookContact"]["params_OUT"] = array(
            "return"        => array("type" => "boolean",     "required" => true)
        );

        return $arrData;
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
     * Function that verifies if the authenticated user is authorized to the passed module.
     *
     * @param   string   $sModuleName   name of the module to check if the user is authorized
     * @return  boolean    true if the user is authorized, or false if not
     */
    private function _checkUserAuthorized($sModuleName)
    {
        $pACL = $this->_getACL();        
        $id_user = $this->_leerIdUser();
        if (!$pACL->isUserAuthorizedById($id_user, "access", $sModuleName)) { 
            $this->errMsg["fc"] = 'UNAUTHORIZED';
            $this->errMsg["fm"] = 'Not authorized for this module: '.$sModuleName;
            $this->errMsg["fd"] = 'Your user login is not authorized for this functionality. Please contact your system administrator.';
            $this->errMsg["cn"] = get_class($this);
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Function that verifies the parameters offset and limit, if offset is not set it will be set to 0
     *
     * @param   integer   $offset   value of offset passed by reference
     * @param   integer   $limit    value of limit passed by reference
     * @return  mixed    true if both parameters are correct, or NULL if an error exists
     */
    private function _checkOffsetLimit(&$offset,&$limit)
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
     * Functional point that consults the address book of the authenticated user. The address book has an intern part that is the list * of available extensions, and an extern part that resides in a SQLITE database managed by Issabel
     *
     * @param   string    $addressBookType    Can be 'internal' or 'external'
     * @param   integer   $offset             (Optional) start of records or 0 if omitted
     * @param   integer   $limit              (Optional) limit records or all if omitted
     * @return  array     Array with the information of the contact list (address book).
     */
    function listAddressBook($addressBookType, $offset, $limit, $id_contact=NULL)
    {
        global $arrConf;

        if (!$this->_checkUserAuthorized('address_book')) return false;

        if (!$this->_checkOffsetLimit($offset, $limit)) return false;

        // Elegir entre la agenda interna y externa
        if (!isset($addressBookType) || 
            !in_array($addressBookType, array('internal', 'external'))) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Unrecognized address book type, must be internal or external';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

        $extension = array();
        $iNumTotal = NULL;

        $dbAddressBook = $this->_getDB($arrConf['dsn_conn_database']);

        $addressBook = new paloAdressBook($dbAddressBook);
        switch ($addressBookType) {
        case 'internal':
            // Contar número de elementos de la agenda interna
	    if(isset($id_contact)){
		$field_name = "telefono";
		$field_pattern = $id_contact;
	    }
	    else{
		$field_name = NULL;
		$field_pattern = NULL;
	    }
	    $iNumTotal = $addressBook->getDeviceFreePBX_Completed($this->_astDSN, NULL, NULL, $field_name, $field_pattern, TRUE);
            if ($iNumTotal === false) {
                $this->errMsg["fc"] = 'DBERROR';
                $this->errMsg["fm"] = 'Database operation failed';
                $this->errMsg["fd"] = 'Unable to count data from internal phonebook';
                $this->errMsg["cn"] = get_class($addressBook);
                return false;
            }
            if (!isset($limit)) $limit = $iNumTotal;

            // Recuperar la agenda interna
            $extension = $addressBook->getDeviceFreePBX_Completed($this->_astDSN, $limit, $offset, $field_name, $field_pattern);
            if ($extension === false) {
                $this->errMsg["fc"] = 'DBERROR';
                $this->errMsg["fm"] = 'Database operation failed';
                $this->errMsg["fd"] = 'Unable to read data from internal phonebook';
                $this->errMsg["cn"] = get_class($addressBook);
                return false;
            }
            break;
        case 'external':
            // Obtener el ID del usuario logoneado
            $id_user = $this->_leerIdUser();
            if (is_null($id_user)) return false;

            /* Contar número de elementos de la agenda externa. Debido a un mal 
             * diseño de la función getAddressBook, se requiere poner un filtro 
             * de mentira, porque de lo contrario, la función ignora id_user, y
             * devuelve los contactos de todos los usuarios. */ 
	    if(isset($id_contact)){
		$field_name = "id";
		$field_pattern = $id_contact;
	    }
	    else{
		$field_name = "name";
		$field_pattern = "%%";
	    }
            $rs = $addressBook->getAddressBook(
                NULL, NULL, 
                $field_name, $field_pattern,
                TRUE, $id_user);

            if (!is_array($rs)) {
                $this->errMsg["fc"] = 'DBERROR';
                $this->errMsg["fm"] = 'Database operation failed';
                $this->errMsg["fd"] = 'Unable to count data from external phonebook - '.$addressBook->_DB->errMsg;
                $this->errMsg["cn"] = get_class($addressBook);
                return false;
            }
            $iNumTotal = $rs[0]['total'];
            if (!isset($limit)) $limit = $iNumTotal;

            /* Recuperar la agenda externa. Debido a un mal diseño de la función
             * getAddressBook, se requiere poner un filtro de mentira, porque
             * de lo contrario, la función ignora id_user, y devuelve los 
             * contactos de todos los usuarios. */ 
            $extension = $addressBook->getAddressBook(
                $limit, $offset, 
                $field_name, $field_pattern, 
                FALSE, $id_user);
            if (!is_array($extension)) {
                $this->errMsg["fc"] = 'DBERROR';
                $this->errMsg["fm"] = 'Database operation failed';
                $this->errMsg["fd"] = 'Unable to read data from external phonebook - '.$addressBook->_DB->errMsg;
                $this->errMsg["cn"] = get_class($addressBook);
                return false;
            }
            break;
        }
        
        /* Para mantener la compatibilidad con el API de SOAP, la extensión debe
         * de tener un elemento 'phone'. Véase bug Elastix #1730. */
        for ($i = 0; $i < count($extension); $i++) {
        	if (!isset($extension[$i]['phone']) && isset($extension[$i]['work_phone']))
                $extension[$i]['phone'] = $extension[$i]['work_phone'];
        }
        
        return array(
                'totalCount'    =>  $iNumTotal,
                'extension'     => $extension,
            );
    }

    /**
     * Functional point that add a new contact to the external address book of the authenticated user
     *
     * @param   integer   $phone            Can be 'internal' or 'external'
     * @param   string    $first_name       (Optional) First name of the new contact
     * @param   string    $last_name        (Optional) Last name of the new contact
     * @param   string    $email            (Optional) Email of the new contact
     * @return  boolean   True if the contact was successfully added, or false if an error exists
     */
    function addAddressBookContact($phone, $first_name, $last_name, $email, $getIdInserted=FALSE, $address=NULL, $company=NULL, $notes=NULL, $status=NULL, $cell_phone=NULL, $home_phone=NULL, $fax1=NULL, $fax2=NULL, $province=NULL, $city=NULL, $company_contact=NULL, $contact_rol=NULL, $picture=NULL)
    {
        global $arrConf;

        if (!$this->_checkUserAuthorized('address_book')) return false;

        $dbAddressBook = $this->_getDB($arrConf['dsn_conn_database']);
        $addressBook = new paloAdressBook($dbAddressBook);

        // Obtener el ID del usuario logoneado
        $id_user = $this->_leerIdUser();
        if (is_null($id_user)) return false;
        
        // Validar que el teléfono está presente y es numérico
        if (!isset($phone) || !preg_match('/^\d+$/', $phone)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid phone, must be numeric string';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

	if (isset($cell_phone) && !preg_match('/^[\*|#]*[[:digit:]]*$/', $cell_phone)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid cell phone, it must be a numeric string and can only contain at the beginning * or #';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

	if (isset($home_phone) && !preg_match('/^[\*|#]*[[:digit:]]*$/', $home_phone)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid home phone, it must be a numeric string and can only contain at the beginning * or #';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

	if (isset($fax1) && !preg_match('/^[\*|#]*[[:digit:]]*$/', $fax1)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid fax1, it must be a numeric string and can only contain at the beginning * or #';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

	if (isset($fax2) && !preg_match('/^[\*|#]*[[:digit:]]*$/', $fax2)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid fax2, it must be a numeric string and can only contain at the beginning * or #';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

	$arrStatus = array("isPrivate","isPublic");
	if(!in_array($status,$arrStatus))
		$status = "isPrivate";
        
	$lastId = $addressBook->getLastContactInsertedId();
        $nextId = $lastId + 1; //TODO: Hay que tener en cuenta la posibilidad de una condición de carrera, es decir en caso de que existan dos peticiones hechas exactamente al mismo tiempo, con lo cual las dos obtendrían el mismo id y una de estas peticiones sobreescribirá la imagen enviada por la otra. (escenario muy complicado pero de todas formas posible)

	if(isset($picture) && $picture!=""){
		$picture = base64_decode($picture);
                $tmpname = "/tmp/image".time();
		file_put_contents($tmpname,$picture); //localización temporal de la imagen
		$size = getimagesize($tmpname);
		if(!is_array($size)){
			$this->errMsg["fc"] = 'PARAMERROR';
            		$this->errMsg["fm"] = 'Invalid format';
            		$this->errMsg["fd"] = 'Invalid picture, the format of the image is incorrect';
            		$this->errMsg["cn"] = get_class($this);
            		return false;
		}
		$destination_path = "/var/www/address_book_images";
		//Se procede a redimensionar la imagen para evitar inyección de código dentro de la imagen y luego se guarda
                $extension = $addressBook->saveResizeImage($tmpname,$size[0],$size[1],$size[0],$size[1],$size[2],$destination_path."/$nextId");
		//Se procede a guardar la imagen en formato thumbnail
		$new_width = 48;
		$new_height = 48;
		$addressBook->saveResizeImage($tmpname,$size[0],$size[1],$new_width,$new_height,$size[2],$destination_path."/{$nextId}_Thumbnail");
		$picture = $nextId.$extension;
		unlink($tmpname);
	}

	$arrStatus = array("isPrivate","isPublic");
	if(!in_array($status,$arrStatus))
		$status = "isPrivate";

        // Construir el arreglo de datos que hay que almacenar
        if (!isset($first_name)) $first_name = NULL;
        if (!isset($last_name)) $last_name = NULL;
        if (!isset($email)) $email = NULL;

        $data = array(
            $first_name,
            $last_name,
            $phone,
	    $cell_phone,
	    $home_phone,
	    $fax1,
	    $fax2,
            $email,
            $id_user,
            $picture,
	    $province,
	    $city,
	    $address,
	    $company,
	    $company_contact,
	    $contact_rol,
	    "external",
	    $notes,
	    $status,
            NULL,
            NULL
        );
        $result = $addressBook->addContact($data);
        if (!$result) {
            $this->errMsg["fc"] = 'DBERROR';
            $this->errMsg["fm"] = 'Database operation failed';
            $this->errMsg["fd"] = 'Unable to write data to external phonebook - '.$addressBook->_DB->errMsg;
            $this->errMsg["cn"] = get_class($addressBook);
            return false;
        }
	if($getIdInserted)
	    return $nextId;
	else
	    return true;
    }

    //Solo se pueden actualizar los contactos internos por parte de un
    //user que pertenezca al grupo administrador
    function updateContact($id, $phone, $first_name, $last_name, $email=NULL, $address=NULL, $company=NULL, $notes=NULL, $status=NULL, $cell_phone=NULL, $home_phone=NULL, $fax1=NULL, $fax2=NULL, $province=NULL, $city=NULL, $company_contact=NULL, $contact_rol=NULL, $picture=NULL, $addressBookType="external")
    {
	global $arrConf;

        if (!$this->_checkUserAuthorized('address_book')) return false;

        $isAdminGroup = $this->_getACL()->isUserAdministratorGroup($_SERVER['PHP_AUTH_USER']);
        
        $dbAddressBook = $this->_getDB($arrConf['dsn_conn_database']);
        $addressBook = new paloAdressBook($dbAddressBook);

        // Obtener el ID del usuario logoneado
        $id_user = $this->_leerIdUser();
        if (is_null($id_user)) return false;

        // Elegir entre la agenda interna y externa
        if (!isset($addressBookType) || 
            !in_array($addressBookType, array('internal', 'external'))) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Unrecognized address book type, must be internal or external';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }
        
	$contactData = $addressBook->contactData($id,$id_user,$addressBookType, $isAdminGroup, $this->_astDSN);
	if(!is_array($contactData) || count($contactData) == 0){
	    $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid id contact';
            $this->errMsg["fd"] = 'Contact do not exist';
            $this->errMsg["cn"] = get_class($this);
            return false;
	}

	// Validar que el teléfono está presente y es numérico
        if (!isset($phone) || !preg_match('/^\d+$/', $phone)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid phone, must be numeric string';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

	if (isset($cell_phone) && !preg_match('/^[\*|#]*[[:digit:]]*$/', $cell_phone)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid cell phone, it must be a numeric string and can only contain at the beginning * or #';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

	if (isset($home_phone) && !preg_match('/^[\*|#]*[[:digit:]]*$/', $home_phone)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid home phone, it must be a numeric string and can only contain at the beginning * or #';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

	if (isset($fax1) && !preg_match('/^[\*|#]*[[:digit:]]*$/', $fax1)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid fax1, it must be a numeric string and can only contain at the beginning * or #';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

	if (isset($fax2) && !preg_match('/^[\*|#]*[[:digit:]]*$/', $fax2)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid fax2, it must be a numeric string and can only contain at the beginning * or #';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }
        
        if(isset($picture) && $picture!=""){
		$picture = base64_decode($picture);
                $tmpname = "/tmp/image".time();
		file_put_contents($tmpname,$picture); //localización temporal de la imagen
		$size = getimagesize($tmpname);
		if(!is_array($size)){
			$this->errMsg["fc"] = 'PARAMERROR';
            		$this->errMsg["fm"] = 'Invalid format';
            		$this->errMsg["fd"] = 'Invalid picture, the format of the image is incorrect';
            		$this->errMsg["cn"] = get_class($this);
            		return false;
		}
		$destination_path = "/var/www/address_book_images";
		//Se procede a redimensionar la imagen para evitar inyección de código dentro de la imagen y luego se guarda
                $extension = $addressBook->saveResizeImage($tmpname,$size[0],$size[1],$size[0],$size[1],$size[2],$destination_path."/$id");
		//Se procede a guardar la imagen en formato thumbnail
		$new_width = 48;
		$new_height = 48;
		$addressBook->saveResizeImage($tmpname,$size[0],$size[1],$new_width,$new_height,$size[2],$destination_path."/{$id}_Thumbnail");
		$picture = $id.$extension;
		unlink($tmpname);
	}
        else
            $picture = $contactData["picture"];

	$arrStatus = array("isPrivate","isPublic");
	if(!in_array($status,$arrStatus))
		$status = $contactData["status"];
        
        $first_name 	 = (isset($first_name))      ? $first_name      : $contactData["name"];
        $last_name 	 = (isset($last_name))       ? $last_name       : $contactData["last_name"];
        $work_phone	 = (isset($phone)) 	     ? $phone 	        : $contactData["telefono"];
	$cell_phone 	 = (isset($cell_phone))      ? $cell_phone      : $contactData["cell_phone"];
	$home_phone 	 = (isset($home_phone))      ? $home_phone      : $contactData["home_phone"];
	$fax1 		 = (isset($fax1)) 	     ? $fax1            : $contactData["fax1"];
	$fax2 		 = (isset($fax2)) 	     ? $fax2 	        : $contactData["fax2"];
        $email 		 = (isset($email)) 	     ? $email 	        : $contactData["email"];
        $province	 = (isset($province))        ? $province 	: $contactData["province"];
	$city		 = (isset($city)) 	     ? $city 	        : $contactData["city"];
        $address 	 = (isset($address))         ? $address 	: $contactData["address"];
	$company 	 = (isset($company)) 	     ? $company 	: $contactData["company"];
        $company_contact = (isset($company_contact)) ? $company_contact : $contactData["company_contact"];
	$contact_rol  	 = (isset($contact_rol))     ? $contact_rol     : $contactData["contact_rol"];
    	$notes 	 	 = (isset($notes)) 	     ? $notes 	        : $contactData["notes"];
        
	$data = array(
            $first_name,
            $last_name,
            $phone,
	    $cell_phone,
	    $home_phone,
	    $fax1,
	    $fax2,
            $email,
            $id_user,
            $picture,
	    $province,
	    $city,
	    $address,
	    $company,
	    $company_contact,
	    $contact_rol,
	    "external",
	    $notes,
	    $status,
            NULL,
            NULL
        );
	$result = $addressBook->updateContact($data,$id);
	if (!$result) {
            $this->errMsg["fc"] = 'DBERROR';
            $this->errMsg["fm"] = 'Database operation failed';
            $this->errMsg["fd"] = 'Unable to write data to external phonebook - '.$addressBook->_DB->errMsg;
            $this->errMsg["cn"] = get_class($addressBook);
            return false;
        }

        return true;
    }

    /**
     * Functional point that deletes a contact of the external address book of the authenticated user
     *
     * @param   integer   $id            ID of the contact to be deleted
     * @return  boolean   True if the contact was successfully deleted, or false if an error exists
     */
    function delAddressBookContact($id)
    {
        global $arrConf;

        if (!$this->_checkUserAuthorized('address_book')) return false;

        $dbAddressBook = $this->_getDB($arrConf['dsn_conn_database']);
        $addressBook = new paloAdressBook($dbAddressBook);

        // Obtener el ID del usuario logoneado
        $id_user = $this->_leerIdUser();
        if (is_null($id_user)) return false;

        // Validar que el ID está presente y es numérico
        if (!isset($id) || !preg_match('/^\d+$/', $id)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid ID, must be positive integer';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }
               
        // Verificar si el contacto existe y pertenece al usuario logoneado
        $tupla = $addressBook->contactData($id, $id_user, "external", false, NULL);
        if (!is_array($tupla)) {
            $this->errMsg["fc"] = 'DBERROR';
            $this->errMsg["fm"] = 'Database operation failed';
            $this->errMsg["fd"] = 'Unable to read data from external phonebook - '.$addressBook->_DB->errMsg;
            $this->errMsg["cn"] = get_class($addressBook);
            return false;
        }

        if (count($tupla) <= 0 || $tupla['iduser'] != $id_user) {
            $this->errMsg["fc"] = 'ADDRESSBOOK';
            $this->errMsg["fm"] = 'Contact lookup failed';
            $this->errMsg["fd"] = 'No contact was found for user '.$_SERVER['PHP_AUTH_USER'];
            $this->errMsg["cn"] = get_class($addressBook);
            return false;
        }

        // Borrar el contacto indicado
        $result = $addressBook->deleteContact($id, $id_user);
        if($tupla['picture']!="" && isset($tupla['picture'])){
            if('/var/www/address_book_images/'.$tupla['picture'])
                unlink('/var/www/address_book_images/'.$tupla['picture']);

            $arrIm = explode(".",$tupla['picture']);
            $typeImage = $arrIm[count($arrIm)-1];
            if(is_file("/var/www/address_book_images/{$id}_Thumbnail.{$typeImage}"))
                unlink("/var/www/address_book_images/{$id}_Thumbnail.{$typeImage}");
        }
        return true;
    }

    public function getContactImage($id, $thumbnail, $directory)
    {
	global $arrConf;

        if (!$this->_checkUserAuthorized('address_book')) return false;
        
        $dbAddressBook = $this->_getDB($arrConf['dsn_conn_database']);
        $addressBook = new paloAdressBook($dbAddressBook);

        // Obtener el ID del usuario logoneado
        $id_user = $this->_leerIdUser();
        if (is_null($id_user)) return false;

        // Validar que el ID estÃ¡ presente y es numÃ©rico
        if (!isset($id) || !preg_match('/^\d+$/', $id)) {
            $this->errMsg["fc"] = 'PARAMERROR';
            $this->errMsg["fm"] = 'Invalid format';
            $this->errMsg["fd"] = 'Invalid ID, must be positive integer';
            $this->errMsg["cn"] = get_class($this);
            return false;
        }

        // Verificar si el contacto existe y pertenece al usuario logoneado
        $tupla = $addressBook->contactData($id, $id_user, $directory, true, $this->_astDSN);
        if (!is_array($tupla)) {
            $this->errMsg["fc"] = 'DBERROR';
            $this->errMsg["fm"] = 'Database operation failed';
            $this->errMsg["fd"] = 'Unable to read data from external phonebook - '.$addressBook->_DB->errMsg;
            $this->errMsg["cn"] = get_class($addressBook);
            return false;
        }

        $ruta_destino = "/var/www/address_book_images";
        $arrIm = explode(".",$tupla['picture']);
        $typeImage = $arrIm[count($arrIm)-1];
        $idt = ($directory=="external")?$tupla['id']:$tupla['id_on_address_book_db'];
        if($thumbnail=="yes"){
            $imgDefault = $_SERVER['DOCUMENT_ROOT']."/modules/address_book/images/Icon-user_Thumbnail.png";
            $image = $ruta_destino."/".$idt."_Thumbnail.$typeImage";
        }
        else{
            $imgDefault = $_SERVER['DOCUMENT_ROOT']."/modules/address_book/images/Icon-user.png";
            $image = $ruta_destino."/".$tupla['picture'];
        }
        if(is_file($image)){

	    if(strtolower($typeImage) == "png"){
                Header("Content-type: image/png");
                $im = imagecreatefromPng($image);
                ImagePng($im); // Mostramos la imagen
                ImageDestroy($im); // Liberamos la memoria que ocupaba la imagen
            }else{
                Header("Content-type: image/jpeg");
                $im = imagecreatefromJpeg($image);
                ImageJpeg($im); // Mostramos la imagen
                ImageDestroy($im); // Liberamos la memoria que ocupaba la imagen
            }
        }else{
            Header("Content-type: image/png");
            $image = file_get_contents($imgDefault);
            return $image;
        }
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
