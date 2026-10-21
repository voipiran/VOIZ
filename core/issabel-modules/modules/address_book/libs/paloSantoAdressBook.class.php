<?php
/* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 4.0                                                  |
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
  $Id: paloSantoCDR.class.php,v 1.1.1.1 2008/01/31 21:31:55 bmacias Exp $
  $Id: paloSantoCDR.class.php,v 1.1.1.1 2008/06/25 16:51:50 afigueroa Exp $
  $Id: index.php,v 1.1 2010/02/04 09:20:00 onavarrete@palosanto.com Exp $
 */

//ini_set("display_errors", true);
if (file_exists("/var/lib/asterisk/agi-bin/phpagi-asmanager.php")) {
require_once "/var/lib/asterisk/agi-bin/phpagi-asmanager.php";
}
global $arrConf;
//include_once("$arrConf[basePath]/libs/paloSantoACL.class.php");

class paloAdressBook {
    var $_DB;
    var $errMsg;

    function paloAdressBook(&$pDB)
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

/*
This function obtain all records in the table, but, if the param $count is passed as true the function only return
a array with the field "total" containing the total of records.
*/
    function getAddressBook($limit=NULL, $offset=NULL, $field_name=NULL, $field_pattern=NULL, $count=FALSE, $iduser=NULL)
    {
        // SIEMPRE se debe filtrar por usuario activo. Véase bug Elastix #1529.
    	$sql = 'SELECT '.($count ? 'COUNT(*) AS total' : '*, telefono work_phone').' FROM contact';
        $whereFields = array('(iduser = ? OR status = ?)',"directory='external'");
        $sqlParams = array($iduser, 'isPublic');

        // Filtro por campo específico. Por omisión se filtra por id
        if (!is_null($field_name) and !is_null($field_pattern)) {
        	if (!in_array($field_name, array('id','name','last_name','telefono','cell_phone','home_phone',
                'fax1','fax2','extension','email','province','city','iduser','address','company','company_contact','contact_rol','notes','status')))
                $field_name = 'id';
            $cond = "$field_name LIKE ?";
            $sqlParams[] = $field_pattern;
            if ($field_name == 'telefono') {
                $cond = "($cond OR extension LIKE ?)";
                $sqlParams[] = $field_pattern;
            }
            $whereFields[] = $cond;
        }

        if (count($whereFields) > 0) $sql .= ' WHERE '.implode(' AND ', $whereFields);
        $sql .= ' ORDER BY last_name, name';

        if (!is_null($limit)) {
        	$sql .= ' LIMIT ?';
            $sqlParams[] = (int)$limit;
        }
        if (!is_null($offset) && $offset > 0) {
            $sql .= ' OFFSET ?';
            $sqlParams[] = (int)$offset;
        }

        $result = $this->_DB->fetchTable($sql, true, $sqlParams);
        if (!is_array($result)) {
        	$this->errMsg = $this->_DB->errMsg;
        }
        return $result;
    }

    function getInternalContacts($arrDevices)
    {
        $arrData = array();

        if(is_array($arrDevices) && count($arrDevices) > 0){
            foreach($arrDevices as $k => $dev)
                $arrIDs[] = $dev['id'];

            $query = "SELECT * FROM contact WHERE telefono in (".implode(',',$arrIDs).") and directory='internal' and status='isPublic'";

            $result = $this->_DB->fetchTable($query, true, array());
            if (!is_array($result)) {
                    $this->errMsg = $this->_DB->errMsg;
            }

            foreach($result as $k => $contact){
                $arrData[$contact['telefono']] = $contact;
            }
        }
        return $arrData;
    }

    function getAddressBookByCsv($limit=NULL, $offset=NULL, $field_name=NULL, $field_pattern=NULL, $count=FALSE, $iduser=NULL)
    {
    	return $this->getAddressBook($limit, $offset, $field_name, $field_pattern, $count, $iduser);
    }

    function contactData($id, $id_user, $directory, $isAdminGroup, $dsn)
    {
        if($directory == "external"){
            $where = "id=? and (iduser=? or status='isPublic') and directory='external'";
            $params = array($id, $id_user);

            $query   = "SELECT *, telefono work_phone FROM contact WHERE $where";

            $result=$this->_DB->getFirstRowQuery($query, true, $params);
            if(!$result && $result==null && count($result) < 1)
                return false;
            else
                return $result;
        }
        else if($directory == "internal" && $isAdminGroup){
            $matriz = $this->getDeviceFreePBX_Completed($dsn,1,0,"telefono",$id,FALSE);
            $result = $matriz[0];

            if(!$result['exists_on_address_book_db'])
                unset($result['id']);

            return $result;
        }
    }

    function addContact($data)
    {
        $queryInsert = "insert into contact(name,last_name,telefono,cell_phone,home_phone,fax1,fax2,email,iduser,picture,province,city,address,company,company_contact,contact_rol,directory,notes,status,department,im) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $result = $this->_DB->genQuery($queryInsert, $data);
        //echo $this->_DB->errMsg;
        return $result;
    }

    function addContactCsv($data)
    {
        $queryInsert = "insert into contact(name,last_name,telefono,cell_phone,home_phone,fax1,fax2,email,province,city,iduser,address,company,company_contact,contact_rol,notes,status,directory) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $result = $this->_DB->genQuery($queryInsert, $data);

        return $result;
    }

    function updateContact($data,$id)
    {
        $queryUpdate = "update contact set name=?, last_name=?, telefono=?, cell_phone=?, home_phone=?, fax1=?, fax2=?, email=?, iduser=?, picture=?, province=?, city=?, address=?, company=?, company_contact=?, contact_rol=?, directory=?, notes=?, status=?, department=?, im=? where id=?";
	$data[] = $id;
        $result = $this->_DB->genQuery($queryUpdate, $data);
        //echo $this->_DB->errMsg;
        return $result;
    }

    function existContact($name, $last_name, $telefono, $directory='external')
    {
        $query =     " SELECT count(*) as total FROM contact "
                    ." WHERE name=? and last_name=?"
                    ." and telefono=? and directory=?";
	$arrParam = array($name,$last_name,$telefono,$directory);
        $result=$this->_DB->getFirstRowQuery($query, true, $arrParam);
        if(!$result)
            $this->errMsg = $this->_DB->errMsg;
        return $result;
    }

    function deleteContact($id, $id_user)
    {
        $params = array($id, $id_user);
        $query = "DELETE FROM contact WHERE id=? and iduser=?";
        $result = $this->_DB->genQuery($query, $params);
        if($result[0] > 0)
            return true;
        else return false;
    }

    function Call2Phone($data_connection, $origen, $destino, $channel, $description)
    {
        $command_data['origen'] = $origen;
        $command_data['destino'] = $destino;
        $command_data['channel'] = $channel;
        $command_data['description'] = $description;
        return $this->AsteriskManager_Originate($data_connection['host'], $data_connection['user'], $data_connection['password'], $command_data);
    }

    function TranferCall($data_connection, $origen, $destino, $channel, $description)
    {
        exec("/usr/sbin/asterisk -rx 'core show channels concise' | grep ^$channel",$arrConsole,$flagStatus);
        if($flagStatus == 0){
            $arrData = explode("!",$arrConsole[0]);
            $command_data['origen']  = $origen;
            $command_data['destino'] = $destino;
            $command_data['channel'] = $arrData[12]; // $arrData[0] tiene mi canal de conversa, $arrData[12] tiene el canal con quies estoy conversando
            $command_data['description'] = $description;
            return $this->AsteriskManager_Redirect($data_connection['host'], $data_connection['user'], $data_connection['password'], $command_data);
        }
        return false;
    }

    function AsteriskManager_Redirect($host, $user, $password, $command_data) {
        $astman = new AGI_AsteriskManager();

        if (!$astman->connect("$host", "$user" , "$password")) {
            $this->errMsg = _tr("Error when connecting to Asterisk Manager");
        } else{
            $salida = $astman->Redirect($command_data['channel'], "", $command_data['destino'], "from-internal", "1");

            $astman->disconnect();
            if (strtoupper($salida["Response"]) != "ERROR") {
                return explode("\n", $salida["Response"]);
            }else return false;
        }
        return false;
    }

    function AsteriskManager_Originate($host, $user, $password, $command_data) {
        $astman = new AGI_AsteriskManager();

        if (!$astman->connect("$host", "$user" , "$password")) {
            $this->errMsg = _tr("Error when connecting to Asterisk Manager");
        } else{
            $parameters = $this->Originate($command_data['origen'], $command_data['destino'], $command_data['channel'], $command_data['description']);

            $salida = $astman->send_request('Originate', $parameters);

            $astman->disconnect();
            if (strtoupper($salida["Response"]) != "ERROR") {
                return explode("\n", $salida["Response"]);
            }else return false;
        }
        return false;
    }

    function Originate($origen, $destino, $channel="", $description="")
    {
        $parameters = array();
        $parameters['Channel']      = $channel;
        $parameters['CallerID']     = "$description <$origen>";
        $parameters['Exten']        = $destino;
        $parameters['Context']      = "from-internal";
        $parameters['Priority']     = 1;
        $parameters['Application']  = "";
        $parameters['Data']         = "";

        return $parameters;
    }

    function Obtain_Protocol_from_Ext($dsn, $id)
    {
        $pDB = new paloDB($dsn);

        $query = "SELECT dial, description FROM devices WHERE id=?";
        $result = $pDB->getFirstRowQuery($query, TRUE, array($id));
        if($result != FALSE)
            return $result;
        else{
            $this->errMsg = $pDB->errMsg;
            return FALSE;
        }
    }

    function existsDeviceFreePBX($dsn, $device)
    {
        $query = "SELECT count(*) existe FROM devices WHERE id=?";

        $pDB = new paloDB($dsn);
        if($pDB->connStatus)
            return false;
        $result = $pDB->getFirstRowQuery($query,true,array($device)); //se consulta a la base asterisk

        if(is_array($result) && count($result)>0){
            if($result['existe']>0)
                return true;
            else
                return false;
        }
        return false;
    }

    function getDeviceFreePBX($dsn, $limit=NULL, $offset=NULL, $field_name=NULL, $field_pattern=NULL,$count=FALSE)
    {
        //Defining the fields to get. If the param $count is true, then we will get the result of the sql function count(), else, we will get all fields in the table.
        $fields=($count)?"count(id) as total":"*";

        //Begin to build the query.
        $query   = "SELECT $fields FROM devices ";

        $strWhere = "";
	$arrParam = array();
        if(!is_null($field_name) and !is_null($field_pattern))
        {
            if($field_name=='name'){
                $strWhere .= " description like ? ";
		$arrParam[] = $field_pattern;
	    }
            else if($field_name=='telefono'){
                $strWhere .= " id like ? ";
		$arrParam[] = $field_pattern;
	    }
        }

        // Clausula WHERE aqui
        if(!empty($strWhere)) $query .= "WHERE $strWhere ";

        //ORDER BY
        $query .= " ORDER BY  description";

        // Limit
        if(!is_null($limit)){
	    $limit = (int)$limit;
            $query .= " LIMIT $limit ";
	}

        if(!is_null($offset) and $offset > 0){
	    $offset = (int)$offset;
            $query .= " OFFSET $offset";
	}


        $pDB = new paloDB($dsn);
        if($pDB->connStatus)
            return false;
        $result = $pDB->fetchTable($query,true,$arrParam); //se consulta a la base asterisk

        return $result;
    }

    function getDeviceFreePBX_Completed($dsn, $limit=NULL, $offset=NULL, $field_name=NULL, $field_pattern=NULL,$count=FALSE)
    {
        $arrDevices = $this->getDeviceFreePBX($dsn,$limit,$offset,$field_name,$field_pattern,$count);

        if(!$count){
            $arrVMs     = $this->getMailsFromVoicemail();
            $arrContact = $this->getInternalContacts($arrDevices);

            if(is_array($arrDevices)){
                foreach($arrDevices as &$device){
                    $device['name']          = $device['description'];
                    $device['work_phone']    = $device['id'];
                    $device['cell_phone']    = isset($arrContact[$device['id']]['cell_phone'])?$arrContact[$device['id']]['cell_phone']:"";
                    $device['home_phone']    = isset($arrContact[$device['id']]['home_phone'])?$arrContact[$device['id']]['home_phone']:"";
                    $device['fax1']          = isset($arrContact[$device['id']]['fax1'])?$arrContact[$device['id']]['fax1']:"";
                    $device['fax2']          = isset($arrContact[$device['id']]['fax2'])?$arrContact[$device['id']]['fax2']:"";
                    $device['email']         = isset($arrVMs[$device['id']])?$arrVMs[$device['id']]:"";
                    $device['province']      = isset($arrContact[$device['id']]['province'])?$arrContact[$device['id']]['province']:"";
                    $device['city']          = isset($arrContact[$device['id']]['city'])?$arrContact[$device['id']]['city']:"";
                    $device['address']       = isset($arrContact[$device['id']]['address'])?$arrContact[$device['id']]['address']:"";
                    $device['company']       = isset($arrContact[$device['id']]['company'])?$arrContact[$device['id']]['company']:"";
                    $device['company_contact'] = isset($arrContact[$device['id']]['company_contact'])?$arrContact[$device['id']]['company_contact']:"";
                    $device['contact_rol']     = isset($arrContact[$device['id']]['contact_rol'])?$arrContact[$device['id']]['contact_rol']:"";
                    $device['directory']       = isset($arrContact[$device['id']]['directory'])?$arrContact[$device['id']]['directory']:"";
                    $device['notes']         = isset($arrContact[$device['id']]['notes'])?$arrContact[$device['id']]['notes']:"";
                    $device['picture']       = isset($arrContact[$device['id']]['picture'])?$arrContact[$device['id']]['picture']:"";
                    $device['status']        = "isPublic";
                    $device['department']    = isset($arrContact[$device['id']]['department'])?$arrContact[$device['id']]['department']:"";
                    $device['im']            = isset($arrContact[$device['id']]['im'])?$arrContact[$device['id']]['im']:"";
                    $device['directory']     = "internal";
                    $device['exists_on_address_book_db'] = isset($arrContact[$device['id']])?true:false;
                    $device['id_on_address_book_db']     = isset($arrContact[$device['id']]['id'])?$arrContact[$device['id']]['id']:false;
                }
                return $arrDevices;
            }
            else{
                return false;//CASO ERROR
            }
        }
        else{
            if(is_array($arrDevices) && count($arrDevices)>0){
                return $arrDevices[0]['total'];
            }
            else
                return false; //CASO DE ERROR
        }
    }

    function getMailsFromVoicemail()
    {
        $result = array();
        $path = "/etc/asterisk/voicemail.conf";
        $lines = file($path);
        foreach($lines as $line)
        {
            if(preg_match("/([[:alnum:]]*) => /i",$line, $regs))
            {
                $arrVal = explode(",", $line);
                $result[$regs[1]] = $arrVal[2];
            }
        }
        return $result;
    }

    function isEditablePublicContact($id, $id_user, $directory, $isAdminGroup=false, $dns)
    {
        //Solo se pueden editar los contactos externos por medio
        //de sus creadores o dueños.
        //Tambien se pueden editar los contactos internos pero
        //solo lo hacen usuarios del grupo administrador

        if($directory == "external"){
            $params = array($id, $id_user);
            $query   = "SELECT * FROM contact WHERE id=? and iduser=? ";

            $result=$this->_DB->getFirstRowQuery($query, true, $params);
            if(!$result && $result==null && count($result) < 1)
                return false;
            return $result;
        }
        else if($directory == "internal" && $isAdminGroup){
            return $this->existsDeviceFreePBX($dns,$id);
        }
        return false;
    }

    function getLastContactInsertedId()
    {
	$query = "SELECT seq FROM sqlite_sequence WHERE name='contact'";
	$result = $this->_DB->getFirstRowQuery($query);
	if($result === FALSE){
	    $this->errMsg = $pDB->errMsg;
            return FALSE;
	}
	return $result[0];
    }

//Esta función redimensiona una imagen y la guarda. El parámetro $image contiene la ruta de la imagen a redireccionar, $width y $height son el ancho y alto original de la image, $new_width y $new_height son el nuevo ancho y alto, $format contiene el tipo de imagen (GIF,JPEG,PNG) y $destination es la ruta destino donde se guardará la imagen redimensionada, a esta ruta hay que agregar la extensión.
    function saveResizeImage($image,$width,$height,$new_width,$new_height,$format,$destination)
    {
	$thumb = imagecreatetruecolor($new_width,$new_height);
	switch($format){
		case 1: //GIF
			$source = imagecreatefromgif($image);
			imagecopyresized($thumb,$source,0,0,0,0,$new_width,$new_height,$width,$height);
			$destination .= ".gif";
			imagegif($thumb,$destination);
			return ".gif";
		case 2: //JPEG
			$source = imagecreatefromjpeg($image);
			imagecopyresized($thumb,$source,0,0,0,0,$new_width,$new_height,$width,$height);
			$destination .= ".jpg";
			imagejpeg($thumb,$destination);
			return ".jpg";
		case 3: //PNG
			$source = imagecreatefrompng($image);
			imagecopyresized($thumb,$source,0,0,0,0,$new_width,$new_height,$width,$height);
			$destination .= ".png";
			imagepng($thumb,$destination);
			return ".png";
		default:
			return FALSE;
	}
    }
}
?>
