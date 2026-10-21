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
  $Id: index.php,v 1.1 2008/01/30 15:55:57 bmacias Exp $
  $Id: index.php,v 1.1 2008/06/25 16:51:50 afigueroa Exp $
  $Id: index.php,v 1.1 2010/02/04 09:20:00 onavarrete@palosanto.com Exp $
 */

//header("Location: https://91.98.33.51:4432/index.php?menu=address_book&filter=&select_directory_type=internal"); 

function _moduleContent(&$smarty, $module_name)
{
    //include issabel framework
    include_once "libs/paloSantoGrid.class.php";
    include_once "libs/paloSantoValidar.class.php";
    include_once "libs/paloSantoConfig.class.php";
    include_once "libs/misc.lib.php";
    include_once "libs/paloSantoForm.class.php";
    include_once "libs/paloSantoACL.class.php";
    include_once "libs/paloSantoJSON.class.php";

    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoAdressBook.class.php";

    $base_dir=dirname($_SERVER['SCRIPT_FILENAME']);
	

    load_language_module($module_name);

    //global variables
    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf,$arrConfModule);

    $smarty->assign('MODULE_NAME', $module_name);

    //folder path for custom templates
    $templates_dir=(isset($arrConf['templates_dir']))?$arrConf['templates_dir']:'themes';
    $local_templates_dir="$base_dir/modules/$module_name/".$templates_dir.'/'.$arrConf['theme'];
	
    $pConfig = new paloConfig("/etc", "amportal.conf", "=", "[[:space:]]*=[[:space:]]*");
    $arrConfig = $pConfig->leer_configuracion(false);

    $dsn_agi_manager['password'] = $arrConfig['AMPMGRPASS']['valor'];
    $dsn_agi_manager['host'] = $arrConfig['AMPDBHOST']['valor'];
    $dsn_agi_manager['user'] = 'admin';

    //solo para obtener los devices (extensiones) creadas.
    $dsnAsterisk = generarDSNSistema('asteriskuser', 'asterisk');
    $pDB   = new paloDB($arrConf['dsn_conn_database']); // address_book
    $pDB_2 = new paloDB($arrConf['dsn_conn_database2']); // acl

    $action = getAction();
    

    $content = "";
    switch($action)
    {
        case "new":
            $content = new_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            break;
        case "cancel":
            header("Location: ?menu=$module_name");
            break;
        case "commit":
            $content = save_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk, true);
            break;
        case "edit":
            $content = view_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            break;
        case "show":
            $content = view_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            break;
        case "save":
            if($_POST['address_book_options']=="address_from_csv")
                $content = save_csv($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            else
                $content = save_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            break;
        case "delete":
            $content = deleteContact($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            break;
        case "call2phone":
            $content = call2phone($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            break;
        case "transfer_call":
            $content = transferCALL($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            break;
        case 'download_csv':
            $content = download_address_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            break;
        case 'getImage':
            $content = getImageContact($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            break;
        default:
            $content = report_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            break;
    }

    return $content;
}

function save_csv($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk)
{
    //valido el tipo de archivo
    if (!preg_match('/\.csv$/i', $_FILES['userfile']['name'])) {
        $smarty->assign("mb_title", _tr("Validation Error"));
        $smarty->assign("mb_message", _tr("Invalid file extension.- It must be csv"));
    }else {
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {
            //Funcion para cargar las extensiones
            load_address_book_from_csv($smarty, $_FILES['userfile']['tmp_name'], $pDB, $pDB_2);
        }else {
            $smarty->assign("mb_title", _tr("Error"));
            $smarty->assign("mb_message", _tr("Possible file upload attack. Filename") ." :". $_FILES['userfile']['name']);
        }
    }
    $content = new_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
    return $content;
}

function load_address_book_from_csv($smarty, $ruta_archivo, $pDB, $pDB_2)
{
    $Messages = "";
    $arrayColumnas = array();
    $pACL         = new paloACL($pDB_2);
    $id_user      = $pACL->getIdUser($_SESSION["issabel_user"]);

    $result = isValidCSV($ruta_archivo, $arrayColumnas);
    if($result != 'true'){
        $smarty->assign("mb_title",_tr("Error"));
        $smarty->assign("mb_message", $result);
        return;
    }

    $hArchivo = fopen($ruta_archivo, 'rt');
    $cont = 0;
    $pAdressBook = new paloAdressBook($pDB);

    if ($hArchivo) {
        //Linea 1 header ignorada
        $tupla = fgetcsv($hArchivo, 4096, ",");
        //Desde linea 2 son datos
        while ($tupla = fgetcsv($hArchivo, 4096, ","))
        {
            if(is_array($tupla) && count($tupla)>=3)
            {
                $data = array();

                $namedb       = $tupla[$arrayColumnas[0]];
                $last_namedb  = $tupla[$arrayColumnas[1]];
                $telefonodb   = $tupla[$arrayColumnas[2]];
                $cellphonedb  = isset($arrayColumnas[3])?$tupla[$arrayColumnas[3]]:"";
                $homephonedb  = isset($arrayColumnas[4])?$tupla[$arrayColumnas[4]]:"";
                $fax1db       = isset($arrayColumnas[5])?$tupla[$arrayColumnas[5]]:"";
                $fax2db       = isset($arrayColumnas[6])?$tupla[$arrayColumnas[6]]:"";
                $emaildb      = isset($arrayColumnas[7])?$tupla[$arrayColumnas[7]]:"";
                $provincedb   = isset($arrayColumnas[8])?$tupla[$arrayColumnas[8]]:"";
                $citydb       = isset($arrayColumnas[9])?$tupla[$arrayColumnas[9]]:"";
                $addressdb    = isset($arrayColumnas[10])?$tupla[$arrayColumnas[10]]:"";
                $companydb    = isset($arrayColumnas[11])?$tupla[$arrayColumnas[11]]:"";
                $company_codb = isset($arrayColumnas[12])?$tupla[$arrayColumnas[12]]:"";
                $contact_pdb  = isset($arrayColumnas[13])?$tupla[$arrayColumnas[13]]:"";
                $notesdb      = isset($arrayColumnas[14])?$tupla[$arrayColumnas[14]]:"";
                $statusdb     = "isPrivate";
                $directory    = "external";
                $iduserdb     = $id_user;

                $data = array($namedb, $last_namedb, $telefonodb, $cellphonedb, $homephonedb, $fax1db, $fax2db, $emaildb,
                  $provincedb, $citydb, $iduserdb, $addressdb, $companydb, $company_codb, $contact_pdb, $notesdb, $statusdb, $directory);
                //Paso 1: verificar que no exista un usuario con los mismos datos
                $result = $pAdressBook->existContact($namedb, $last_namedb, $telefonodb);
                if(!$result)
                    $Messages .= _tr("ERROR").":" . $pAdressBook->errMsg . "  <br />";
                else if($result['total']>0)
                    $Messages .= _tr("ERROR").": "._tr("Contact Data already exists").": {$data[0]} {$data[1]} [{$data[2]}]<br />";
                else{
                    //Paso 2: creando en la contact data
                    if(!$pAdressBook->addContactCsv($data))
                        $Messages .= _tr("ERROR") . $pDB->errMsg . "<br />";

                    $cont++;
                }
            }
        }

        $Messages .= _tr("Total contacts created").": $cont<br />";
        $smarty->assign("mb_message", $Messages);
    }

    unlink($ruta_archivo);
}

function isValidCSV($sFilePath, &$arrayColumnas){
    $hArchivo = fopen($sFilePath, 'rt');
    $cont = 0;
    $ColName = -1;

    //Paso 1: Obtener Cabeceras (Minimas las cabeceras: Display Name, User Extension, Secret)
    if ($hArchivo) {
        $tupla = fgetcsv($hArchivo, 4096, ",");
        if(count($tupla)>=3)
        {
            for($i=0; $i<count($tupla); $i++)
            {
                if($tupla[$i] == 'Name')
                    $arrayColumnas[0] = $i;
                else if($tupla[$i] == 'Last Name')
                    $arrayColumnas[1] = $i;
                else if($tupla[$i] == 'Phone Number' || $tupla[$i] == "Work's Phone Number")
                    $arrayColumnas[2] = $i;
                else if($tupla[$i] == 'Cell Phone Number (SMS)')
                    $arrayColumnas[3] = $i;
                else if($tupla[$i] == 'Home Phone Number')
                    $arrayColumnas[4] = $i;
                else if($tupla[$i] == 'FAX Number 1')
                    $arrayColumnas[5] = $i;
                else if($tupla[$i] == 'FAX Number 2')
                    $arrayColumnas[6] = $i;
                else if($tupla[$i] == 'Email')
                    $arrayColumnas[7] = $i;
                else if($tupla[$i] == 'Province')
                    $arrayColumnas[8] = $i;
                else if($tupla[$i] == 'City')
                    $arrayColumnas[9] = $i;
                else if($tupla[$i] == 'Address')
                    $arrayColumnas[10] = $i;
                else if($tupla[$i] == 'Company')
                    $arrayColumnas[11] = $i;
                else if($tupla[$i] == 'Contact person in your Company')
                    $arrayColumnas[12] = $i;
                else if($tupla[$i] == "Contact person's current position")
                    $arrayColumnas[13] = $i;
                else if($tupla[$i] == 'Notes')
                    $arrayColumnas[14] = $i;
            }
            if(isset($arrayColumnas[0]) && isset($arrayColumnas[1]) && isset($arrayColumnas[2]))
            {
                //Paso 2: Obtener Datos (Validacion que esten llenos los mismos de las cabeceras)
                $count = 2;
                while ($tupla = fgetcsv($hArchivo, 4096,","))
                {
                    if(is_array($tupla) && count($tupla)>=3)
                    {
                            $Name           = $tupla[$arrayColumnas[0]];
                            if($Name == '')
                                return _tr("Can't exist a Name empty. Line").": $count. - ". _tr("Please read the lines in the footer");

                            $LastName       = $tupla[$arrayColumnas[1]];
                            if($LastName == '')
                                return _tr("Can't exist a Last Name empty. Line").": $count. - ". _tr("Please read the lines in the footer");

                            $PhoneNumber    = $tupla[$arrayColumnas[2]];
                            if($PhoneNumber == '')
                                return _tr("Can't exist a Phone Number/Work's Phone Number empty. Line").": $count. - ". _tr("Please read the lines in the footer");
                            if (!preg_match('/^[\*|#]*[[:digit:]]*$/', $PhoneNumber)) {
                            	return _tr("Invalid phone number/Work's phone number . Line").": $count. - ". _tr("Please read the lines in the footer");
                            }
                    }
                    $count++;
                }
                return true;
            }else return _tr("Verify the header") ." - ". _tr("At minimum there must be the columns").": \"Name\", \"Last Name\", \"Work's Phone Number\"";
        }else return _tr("Verify the header") ." - ". _tr("Incomplete Columns");
    }else return _tr("The file is incorrect or empty") .": $sFilePath";
}

function new_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk)
{
    $arrFormadress_book = createFieldForm('external');
    $oForm = new paloForm($smarty,$arrFormadress_book);

    $smarty->assign("Show", 1);
    $smarty->assign("ShowImg",0);
    $smarty->assign("REQUIRED_FIELD", _tr("Required field"));
    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("TYPE", "external");
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("title", _tr("Address Book"));
    $smarty->assign("icon", "modules/$module_name/images/address_book.png");

    $smarty->assign("new_contact", _tr("New Contact"));
    $smarty->assign("address_from_csv", _tr("Address Book from CSV"));
    $smarty->assign("private_contact", _tr("Private Contact"));
    $smarty->assign("public_contact", _tr("Public Contact"));

    if(isset($_POST['address_book_options']) && $_POST['address_book_options']=='address_from_csv')
        $smarty->assign("check_csv", "checked");
    else $smarty->assign("check_new_contact", "checked");


    $smarty->assign("check_isPrivate", "checked");


    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("REQUIRED_FIELD", _tr("Required field"));
    $smarty->assign("label_file", _tr("File"));
    $smarty->assign("DOWNLOAD", _tr("Download Address Book"));
    $smarty->assign("HeaderFile", _tr("Header File Address Book"));
    $smarty->assign("AboutContacts", _tr("About Address Book"));


    //$padress_book = new paloAdressBook($pDB);

    $htmlForm = $oForm->fetchForm("$local_templates_dir/new_adress_book.tpl", _tr("Address Book"), $_POST);

    $contenidoModulo = "<form  method='POST' enctype='multipart/form-data' style='margin-bottom:0;' action='?menu=$module_name'>".$htmlForm."</form>";

    return $contenidoModulo;
}



/*
******** Funciones del modulo
*/
function report_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk)
{
    $padress_book = new paloAdressBook($pDB);
    $pACL         = new paloACL($pDB_2);
    $user	  = $_SESSION["issabel_user"];
    $id_user      = $pACL->getIdUser($user);
    $extension	  = $pACL->getUserExtension($user);
    
	
    
	if(is_null($extension) || $extension==""){
	if($pACL->isUserAdministratorGroup($user)){
            $smarty->assign("mb_title", _tr("MESSAGE"));
	    $smarty->assign("mb_message", "<b>"._tr("You don't have extension number associated with user")."</b>");
	}else
	    $smarty->assign("mb_message", "<b>"._tr("contact_admin")."</b>");
    }
	
    if(getParameter('select_directory_type')=='internal')
    {
		$smarty->assign("internal_sel",'selected=selected');
        $directory_type = 'internal';
    }
    else{
		$smarty->assign("external_sel",'selected=selected');
        $directory_type = 'external';
		
    }
	
	$_POST['select_directory_type'] = $directory_type;


    $arrComboElements = array(  "name"        =>_tr("Name"),
                                "telefono"    => ($directory_type=='external')?_tr("Work's Phone Number"):_tr("Extension"));

    if($directory_type=='external')
        $arrComboElements["last_name"] = _tr("Last Name");

    $arrFormElements = array(   "field" => array(   "LABEL"                  => _tr("Filter"),
                                                    "REQUIRED"               => "no",
                                                    "INPUT_TYPE"             => "SELECT",
                                                    "INPUT_EXTRA_PARAM"      => $arrComboElements,
                                                    "VALIDATION_TYPE"        => "text",
                                                    "VALIDATION_EXTRA_PARAM" => ""),

                                "pattern" => array( "LABEL"          => "",
                                                    "REQUIRED"               => "no",
                                                    "INPUT_TYPE"             => "TEXT",
                                                    "INPUT_EXTRA_PARAM"      => "",
                                                    "VALIDATION_TYPE"        => "text",
                                                    "VALIDATION_EXTRA_PARAM" => "",
                                                    "INPUT_EXTRA_PARAM"      => array('id' => 'filter_value')),
                                );

    $oFilterForm = new paloForm($smarty, $arrFormElements);
    $smarty->assign("SHOW", _tr("Show"));
    $smarty->assign("NEW_adress_book", _tr("New Contact"));
    $smarty->assign("CSV", _tr("CSV"));
    $smarty->assign("module_name", $module_name);

    $smarty->assign("Phone_Directory",_tr("Phone Directory"));
    $smarty->assign("Internal",_tr("Internal"));
    $smarty->assign("External",_tr("External"));

    $field   = NULL;
    $pattern = NULL;
    $namePattern = NULL;
    $allowSelection = array("name", "telefono", "last_name");
    if(isset($_POST['field']) and isset($_POST['pattern']) and ($_POST['pattern']!="")){
        $field      = $_POST['field'];
        if (!in_array($field, $allowSelection))
            $field = "name";
        $pattern    = "%$_POST[pattern]%";
        $namePattern = $_POST['pattern'];
        $nameField=$arrComboElements[$field];
    }

    $arrFilter = array("select_directory_type"=>$directory_type,"field"=>$field,"pattern" =>$namePattern);

    $startDate = $endDate = date("Y-m-d H:i:s");
    $oGrid  = new paloSantoGrid($smarty);

    //$oGrid->addFilterControl(_tr("Filter applied ")._tr("Phone Directory")." =  $directory_type ", $arrFilter, array("select_directory_type" => "internal"),true);
    $oGrid->addFilterControl(_tr("Filter applied ").$field." = $namePattern", $arrFilter, array("field" => "name","pattern" => ""));

    $htmlFilter = $oFilterForm->fetchForm("$local_templates_dir/filter_adress_book.tpl", "", $arrFilter);

    if($directory_type=='external')
        $total = $padress_book->getAddressBook(NULL,NULL,$field,$pattern,TRUE,$id_user);
    else
        $total = $padress_book->getDeviceFreePBX($dsnAsterisk, NULL,NULL,$field,$pattern,TRUE);

    $total_datos = $total[0]["total"];
    //Paginacion
    $limit  = 20;
    $total  = $total_datos;

    $oGrid->setLimit($limit);
    $oGrid->setTotal($total);

    $offset = $oGrid->calculateOffset();

    $inicio = ($total == 0) ? 0 : $offset + 1;

    $end    = ($offset+$limit)<=$total ? $offset+$limit : $total;

    //Fin Paginacion

    if($directory_type=='external')
        $arrResult = $padress_book->getAddressBook($limit, $offset, $field, $pattern, FALSE, $id_user);
    else
        $arrResult = $padress_book->getDeviceFreePBX_Completed($dsnAsterisk, $limit,$offset,$field,$pattern);

    $arrData = null; //echo print_r($arrResult,true);
    if(is_array($arrResult) && $total>0){
        $arrMails = array();
        $typeContact = "";
        if($directory_type=='internal')
            $arrMails = $padress_book->getMailsFromVoicemail();

        foreach($arrResult as $key => $adress_book){
            $idt = ($directory_type=="external")?$adress_book['id']:$adress_book['id_on_address_book_db'];
            $pic = isset($adress_book["picture"])?$adress_book["picture"]:0;

            $exten   = explode(".",$pic);
            if(isset($exten[count($exten)-1]))
                $exten   = $exten[count($exten)-1];
            $picture = "/var/www/address_book_images/{$idt}_Thumbnail.$exten";

            if(file_exists($picture))
                $arrTmp[1] = "<a href='?menu=$module_name&action=show&type=".$directory_type."&id=".$adress_book['id']."'><img alt='image' border='0' src='index.php?menu=$module_name&type=".$directory_type."&action=getImage&idPhoto=$adress_book[id]&thumbnail=yes&rawmode=yes'/></a>";
            else{
                $defaultPicture = "modules/$module_name/images/Icon-user_Thumbnail.png";
                $arrTmp[1] = "<a href='?menu=$module_name&action=show&type=".$directory_type."&id=".$adress_book['id']."'><img border='0' alt='image' src='$defaultPicture'/></a>";
            }

            $arrTmp[0]  = ($directory_type=='external')?"<input type='checkbox' name='contact_{$adress_book['id']}'  />":'';
            if($directory_type=='external'){
                $email = $adress_book['email'];
                if($adress_book['status']=='isPublic'){
                    if($id_user == $adress_book['iduser']){
                        $typeContact = "<div><div style='float: left;'><a href='?menu=$module_name&action=show&type=".$directory_type."&id=".$adress_book['id']."'><img alt='public' style='padding: 5px;' title='"._tr('Public Contact')."' border='0' src='modules/$module_name/images/public_edit.png' /></a></div><div style='padding: 16px 0px 0px 5px; text-align:center;'><span style='visibility: hidden;'>"._tr('Public editable')."</span></div></div>";
                        $arrTmp[0]  = "<input type='checkbox' name='contact_{$adress_book['id']}'  />";
                    }else{
                        $typeContact = "<div><div style='float: left;'><a href='?menu=$module_name&action=show&type=".$directory_type."&id=".$adress_book['id']."'><img alt='public' style='padding: 5px;' title='"._tr('Public Contact')."' border='0' src='modules/$module_name/images/public.png' /></a></div><div style='padding: 16px 0px 0px 5px; text-align:center;'><span style='visibility: hidden;'>"._tr('Public not editable')."</span></div></div>";
                        $arrTmp[0]  = "";
                    }
                }else
                    $typeContact = "<div><div style='float: left;'><a href='?menu=$module_name&action=show&type=".$directory_type."&id=".$adress_book['id']."'><img alt='private' style='padding: 5px;' title='"._tr('Private Contact')."' border='0' src='modules/$module_name/images/contact.png' /></a></div><div style='padding: 16px 0px 0px 5px; text-align:center;'><span style='visibility: hidden;'>"._tr('Private')."</span></div></div>";
            }else if(isset($arrMails[$adress_book['id']])){
                $email = $arrMails[$adress_book['id']];
                $typeContact = "<div><div style='float: left;'><a href='?menu=$module_name&action=show&type=".$directory_type."&id=".$adress_book['id']."'><img alt='public'  style='padding: 5px; 'title='"._tr('Public Contact')."' border='0' src='modules/$module_name/images/public.png' /></a></div><div style='padding: 16px 0px 0px 5px; text-align:center;'><span style='visibility: hidden;'>"._tr('Public not editable')."</span></div></div>";
            }else{
                $email = '';
                $typeContact = "<div><div style='float: left;'><a href='?menu=$module_name&action=show&type=".$directory_type."&id=".$adress_book['id']."'><img alt='public' style='padding: 5px;' title='"._tr('Public Contact')."' border='0' src='modules/$module_name/images/public.png' /></a></div><div style='padding: 16px 0px 0px 5px; text-align:center;'><span style='visibility: hidden;'>"._tr('Public not editable')."</span></div></div>";
            }


            $arrTmp[2]  = ($directory_type=='external')?"<a href='?menu=$module_name&action=show&type=".$directory_type."&id=".$adress_book['id']."'>".htmlspecialchars($adress_book['name'], ENT_QUOTES, "UTF-8")." ".htmlspecialchars($adress_book['last_name'], ENT_QUOTES, "UTF-8")."</a>":"<a href='?menu=$module_name&action=show&type=".$directory_type."&id=".$adress_book['id']."'>".$adress_book['description']."</a>";
         
			
			
			if ($directory_type=='external'){
$arrTmp[3]  = "<a href='#' onclick='callContact({$adress_book['id']},\"{$directory_type}\");'><img border=0 width='25' height='25' src='/modules/$module_name/images/call2.png' />&nbsp;<strong>".$adress_book['work_phone']."</strong></a>";
$arrTmp[4]="<a href='#' onclick='callContact({$adress_book['id']},\"{$directory_type}\");'><img border=0 width='25' height='25' src='/modules/$module_name/images/call2.png' />&nbsp;<strong>".$adress_book['cell_phone']."</strong></a>";

				$arrTmp[5]  = $email;
				$arrData[]  = $arrTmp;
			}else{
				$arrTmp[3]  = $adress_book['id'];
				$arrTmp[4]  = $email;
				$arrTmp[5]  = "<a href='#' onclick='callContact({$adress_book['id']},\"{$directory_type}\");'><img border=0 width='25' height='25' src='/modules/$module_name/images/call2.png' /></a>";
				//$arrTmp[6]  = "<a href='#' onclick='transferCall({$adress_book['id']},\"{$directory_type}\");'>"._tr("Transfer")."</a>";
				$arrTmp[6]  = "<a href='#' onclick='transferCall({$adress_book['id']},\"{$directory_type}\");'><img border=0 width='25' height='25' src='/modules/$module_name/images/transfer.png' /></a>";
				//$arrTmp[7]  = $typeContact;
				$arrData[]  = $arrTmp;
			}
			
			
			
			
			
			
        }
    }
    if($directory_type=='external'){
	$name = "";
        $oGrid->deleteList(_tr("Are you sure you wish to delete the contact."),"delete",_tr("Delete"));
    }
    else {
        $name = "";
    }

  /* $arrGrid = array(   "title"    => _tr("Address Book"),
                        "url"      => array('menu' => $module_name, 'filter' => $pattern, 'select_directory_type' => $directory_type),
                        "icon"     => "modules/$module_name/images/address_book.png",
                        "width"    => "99%",
                        "start"    => $inicio,
                        "end"      => $end,
                        "total"    => $total,
						"columns"  => array(0 => array("name"      => $name,
                                                    "property1" => ""),
                                            1 => array("name"      => _tr("picture"),
                                                    "property1" => ""),
                                            2 => array("name"      => _tr("Name"),
                                                    "property1" => ""),
                                            3 => array("name"      => ($directory_type=='external')?_tr("Work's Phone Number"):_tr("Extension"),
                                                    "property1" => ""),
                                            4 => array("name"      => _tr("Email"),
                                                    "property1" => ""),
                                            5 => array("name"      => _tr("Call"),
                                                    "property1" => ""),
                                            6 => array("name"      => _tr("Transfer"),
                                                    "property1" => ""),
                                            7 => array("name"      => _tr("Type Contact"),
                                                    "property1" => "")
                                        )
                    );*/
                        if ($directory_type=='external'){
							$arrGrid = array(   "title"    => _tr("Address Book"),
                        "url"      => array('menu' => $module_name, 'filter' => $pattern, 'select_directory_type' => $directory_type),
                        "icon"     => "modules/$module_name/images/address_book.png",
                        "width"    => "99%",
                        "start"    => $inicio,
                        "end"      => $end,
                        "total"    => $total,
							"columns"  => array(0 => array("name"      => $name,
                                                    "property1" => ""),
                                            1 => array("name"      => _tr("picture"),
                                                    "property1" => ""),
                                            2 => array("name"      => _tr("Name"),
                                                    "property1" => ""),
                                            3 => array("name"      => _tr("Work's Phone Number"),
                                                    "property1" => ""),
											4 => array("name"      => _tr("Cell Phone Number (SMS)"),
                                                    "property1" => ""),
                                            5 => array("name"      => _tr("Email"),
                                                    "property1" => "")/*,
                                            6 => array("name"      => _tr("Type Contact"),
                                                    "property1" => "")*/
                                        )
										);
							
						}else{
							$arrGrid = array(   "title"    => _tr("Address Book"),
                        "url"      => array('menu' => $module_name, 'filter' => $pattern, 'select_directory_type' => $directory_type),
                        "icon"     => "modules/$module_name/images/address_book.png",
                        "width"    => "99%",
                        "start"    => $inicio,
                        "end"      => $end,
                        "total"    => $total,
								"columns"  => array(0 => array("name"      => $name,
                                                    "property1" => ""),
                                            1 => array("name"      => _tr("picture"),
                                                    "property1" => ""),
                                            2 => array("name"      => _tr("Name"),
                                                    "property1" => ""),
                                            3 => array("name"      => _tr("Extension"),
                                                    "property1" => ""),
                                            4 => array("name"      => _tr("Email"),
                                                    "property1" => ""),
                                            5 => array("name"      => _tr("Call"),
                                                    "property1" => ""),
                                            6 => array("name"      => _tr("Transfer"),
                                                    "property1" => "")/*,
                                            7 => array("name"      => _tr("Type Contact"),
                                                    "property1" => "")*/
                                        )
										);
						}
    $oGrid->addNew("new",_tr("New Contact"));
    $oGrid->showFilter(trim($htmlFilter));
    $contenidoModulo = $oGrid->fetchGrid($arrGrid, $arrData);
    return $contenidoModulo;
}

function createFieldForm($directory)
{
    $arrFields = array(
                "name"          => array(   "LABEL"                 => ($directory=='external')?_tr("First Name"):_tr("Name"),
                                            "REQUIRED"              => ($directory=='external')?"yes":"no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => ($directory=='external')?array("style" => "width:300px;"):array("disabled" => "disabled","readonly" => "readonly","style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "text",
                                            "VALIDATION_EXTRA_PARAM"=> ""),
                "last_name"     => array(   "LABEL"                 => _tr("Last Name"),
                                            "REQUIRED"              => ($directory=='external')?"yes":"no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => array("style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "text",
                                            "VALIDATION_EXTRA_PARAM"=> ""),
                "work_phone"    => array(   "LABEL"                 => ($directory=='external')?_tr("Work's Phone Number"):_tr("Extension"),
                                            //"REQUIRED"              => ($directory=='external')?"yes":"no",
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => ($directory=='external')?"":array("disabled" => "disabled","readonly" => "readonly"),
                                            "VALIDATION_TYPE"       => "ereg",
                                            "VALIDATION_EXTRA_PARAM"=> "^[\*|#]*[[:digit:]]*$"),
                "department"    => array(   "LABEL"                 => _tr("Department"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => array("style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "text",
                                            "VALIDATION_EXTRA_PARAM"=> ""),
                "cell_phone"    => array(   "LABEL"                 => _tr("Cell Phone Number (SMS)"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => "",
                                            "VALIDATION_TYPE"       => "ereg",
                                            "VALIDATION_EXTRA_PARAM"=> "^[\*|#]*[[:digit:]]*$"),
                "home_phone"    => array(   "LABEL"                 => _tr("Home Phone Number"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => "",
                                            "VALIDATION_TYPE"       => "ereg",
                                            "VALIDATION_EXTRA_PARAM"=> "^[\*|#]*[[:digit:]]*$"),
                "fax1"          => array(   "LABEL"                 => _tr("FAX Number 1"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => "",
                                            "VALIDATION_TYPE"       => "ereg",
                                            "VALIDATION_EXTRA_PARAM"=> "^[\*|#]*[[:digit:]]*$"),
                "fax2"          => array(   "LABEL"                 => _tr("FAX Number 2"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => "",
                                            "VALIDATION_TYPE"       => "ereg",
                                            "VALIDATION_EXTRA_PARAM"=> "^[\*|#]*[[:digit:]]*$"),
                "email"         => array(   "LABEL"                 => _tr("Email"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => ($directory=='external')?array("style" => "width:300px;"):array("disabled" => "disabled","readonly" => "readonly","style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "ereg",
                                            "VALIDATION_EXTRA_PARAM"=> "([[:alnum:]]|.|_|-){1,}@([[:alnum:]]|.|_|-){1,}"),
                "im"            => array(   "LABEL"                 => _tr("Address IM (XMPP, Openfire)"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => array("style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "ereg",
                                            "VALIDATION_EXTRA_PARAM"=> "([[:alnum:]]|.|_|-){1,}@([[:alnum:]]|.|_|-){1,}"),
                "picture"   => array(      "LABEL"                  => _tr("picture"),
                                            "REQUIRED"               => "no",
                                            "INPUT_TYPE"             => "FILE",
                                            "INPUT_EXTRA_PARAM"      => array("id" => "picture"),
                                            "VALIDATION_TYPE"        => "text",
                                            "VALIDATION_EXTRA_PARAM" => ""),
                "province"    => array(     "LABEL"                 => _tr("Province"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => array("style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "text",
                                            "VALIDATION_EXTRA_PARAM"=> ""),
                "city"        => array(     "LABEL"                 => _tr("City"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => array("style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "text",
                                            "VALIDATION_EXTRA_PARAM"=> ""),
                "address"     => array(     "LABEL"                 => _tr("Address"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => array("style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "text",
                                            "VALIDATION_EXTRA_PARAM"=> ""),
                "company"     => array(     "LABEL"                 => _tr("Company"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => array("style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "text",
                                            "VALIDATION_EXTRA_PARAM"=> ""),
                "company_contact" => array( "LABEL"                 => ($directory=='external')?_tr("Contact person in your Company"):_tr("Manager"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => array("style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "text",
                                            "VALIDATION_EXTRA_PARAM"=> ""),
                "contact_rol" => array(     "LABEL"                 => ($directory=='external')?_tr("Contact person's current position"):_tr("Current position"),
                                            "REQUIRED"              => "no",
                                            "INPUT_TYPE"            => "TEXT",
                                            "INPUT_EXTRA_PARAM"     => array("style" => "width:300px;"),
                                            "VALIDATION_TYPE"       => "text",
                                            "VALIDATION_EXTRA_PARAM"=> ""),
                "notes"   => array(         "LABEL"                  => _tr("Notes"),
                                            "REQUIRED"               => "no",
                                            "INPUT_TYPE"             => "TEXTAREA",
                                            "INPUT_EXTRA_PARAM"      => array("id" => "notes"),
                                            "VALIDATION_TYPE"        => "text",
                                            "EDITABLE"               => "si",
                                            "COLS"                   => "40",
                                            "ROWS"                   => "4",
                                            "VALIDATION_EXTRA_PARAM" => ""),
                "status"   => array(        "LABEL"                  => _tr("Status"),
                                            "REQUIRED"               => "no",
                                            "INPUT_TYPE"             => "CHECKBOX",
                                            "INPUT_EXTRA_PARAM"      => array("id" => "status"),
                                            "VALIDATION_TYPE"        => "text",
                                            "VALIDATION_EXTRA_PARAM" => ""),
                );
    return $arrFields;
}

function save_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk, $update=FALSE)
{
    $directory = getParameter("type");
    $arrForm   = createFieldForm($directory);
    $oForm     = new paloForm($smarty, $arrForm);
    $pACL      = new paloACL($pDB_2);
    $id_user   = $pACL->getIdUser($_SESSION["issabel_user"]);
    $isAdminGroup = $pACL->isUserAdministratorGroup($_SESSION["issabel_user"]);

    if (isset($_GET['id']) && !ctype_digit($_GET['id'])) unset($_GET['id']);
    if (isset($_POST['id']) && !ctype_digit($_POST['id'])) unset($_POST['id']);

    if(!$oForm->validateForm($_POST)) {
        // Falla la validación básica del formulario
        $smarty->assign("mb_title", _tr("Validation Error"));
        $arrErrores = $oForm->arrErroresValidacion;
        $strErrorMsg = "<b>{"._tr('The following fields contain errors')."}:</b><br/>";
        if(is_array($arrErrores) && count($arrErrores) > 0){
            foreach($arrErrores as $k=>$v) {
                $strErrorMsg .= "$k, ";
            }
        }

        $smarty->assign("mb_message", $strErrorMsg);

        $smarty->assign("REQUIRED_FIELD", _tr("Required field"));
        $smarty->assign("SAVE", _tr("Save"));
        $smarty->assign("CANCEL", _tr("Cancel"));
        $smarty->assign("title", _tr("Address Book"));

        $smarty->assign("new_contact", _tr("New Contact"));
        $smarty->assign("address_from_csv", _tr("Address Book from CSV"));
        $smarty->assign("private_contact", _tr("Private Contact"));
        $smarty->assign("public_contact", _tr("Public Contact"));

        if(isset($_POST['address_book_options']) && $_POST['address_book_options']=='address_from_csv')
            $smarty->assign("check_csv", "checked");
        else $smarty->assign("check_new_contact", "checked");

        if(isset($_POST['address_book_status']) && $_POST['address_book_status']=='isPrivate')
            $smarty->assign("check_isPrivate", "checked");
        else $smarty->assign("check_isPublic", "checked");

        $smarty->assign("label_file", _tr("File"));
        $smarty->assign("DOWNLOAD", _tr("Download Address Book"));
        $smarty->assign("HeaderFile", _tr("Header File Address Book"));
        $smarty->assign("AboutContacts", _tr("About Address Book"));

        if($update)
        {
            $_POST["edit"] = 'edit';
            return view_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
        }else{
            $smarty->assign("Show", 1);
            $smarty->assign("ShowImg",1);
            $htmlForm = $oForm->fetchForm("$local_templates_dir/new_adress_book.tpl", _tr("Address Book"), $_POST);
            $contenidoModulo = "<form  method='POST' enctype='multipart/form-data' style='margin-bottom:0;' action='?menu=$module_name'>".$htmlForm."</form>";
            return $contenidoModulo;
        }
    }else{ //NO HAY ERRORES
        $pictureUpload = $_FILES['picture']['name'];
        $file_upload = "";
        $ruta_destino = "/var/www/address_book_images";
        $idPost    = getParameter('id');
        $directory = getParameter('type');

        $data = array();
        $padress_book = new paloAdressBook($pDB);
        $contactData = $padress_book->contactData($idPost, $id_user,$directory,$isAdminGroup,$dsnAsterisk);
        if($directory=="external")
           $idt = isset($contactData['id'])?$contactData['id']:null;
        else
           $idt = isset($contactData['id_on_address_book_db'])?$contactData['id_on_address_book_db']:null;

        $lastId = 0;
        if($update)
            $idImg = isset($idt)?$idt:date("Ymdhis");
        else{
            $idImg = date("Ymdhis");
        }
        //valido el tipo de archivo
        if(isset($pictureUpload) && $pictureUpload != ""){
            // \w cualquier caracter, letra o guion bajo
            // \s cualquier espacio en blanco
            if (!preg_match("/^(\w|-|\.|\(|\)|\s)+\.(png|PNG|JPG|jpg|JPEG|jpeg)$/",$pictureUpload)) {
                $smarty->assign("mb_title", _tr("Validation Error"));
                $smarty->assign("mb_message", _tr("Invalid file extension.- It must be png or jpg or jpeg"));
                if($update)
                    return view_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk, TRUE);
                else
                    return new_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            }else {
                if(is_uploaded_file($_FILES['picture']['tmp_name'])) {
                    $file_upload = basename($_FILES['picture']['tmp_name']); // verificando que solo tenga la ruta al archivo
                    $file_name = basename("/tmp/".$_FILES['picture']['name']);
                    $ruta_archivo = "/tmp/$file_upload";
                    $arrIm = explode(".",$pictureUpload);
                    $renameFile = "$ruta_destino/$idImg.".$arrIm[count($arrIm)-1];
                    $file_upload = $idImg.".".$arrIm[count($arrIm)-1];
                    $filesize = $_FILES['picture']['size'];
                    $filetype = $_FILES['picture']['type'];

                    $sizeImgUp=getimagesize($ruta_archivo);
                    if(!$sizeImgUp){
                         $smarty->assign("mb_title", _tr("ERROR"));
                         $smarty->assign("mb_message", _tr("Possible file upload attack. Filename") ." : ". $pictureUpload);
                        if($update)
                            return view_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk,TRUE);
                        else
                            return new_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
                    }
                    //realizar acciones
                    if(!rename($ruta_archivo, $renameFile)){
                        $smarty->assign("mb_title", _tr("ERROR"));
                        $smarty->assign("mb_message", _tr("Error to Upload") ." : ". $pictureUpload);
                        if($update)
                            return view_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk,TRUE);
                        else
                            return new_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
                    }else{ //redimensiono la imagen
                        $ancho_thumbnail = 48;
                        $alto_thumbnail = 48;
                        $thumbnail_path = $ruta_destino."/$idImg"."_Thumbnail.".$arrIm[count($arrIm)-1];
                        if(is_file($renameFile)){
                            if(!redimensionarImagen($renameFile,$thumbnail_path,$ancho_thumbnail,$alto_thumbnail)){
                                $smarty->assign("mb_title", _tr("ERROR"));
                                $smarty->assign("mb_message", _tr("Possible file upload attack. Filename") ." : ". $pictureUpload);
                                if($update)
                                    return view_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk,TRUE);
                                else
                                    return new_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
                            }
                        }

                        $ancho = 280;
                        $alto = 200;
                        if(is_file($renameFile)){
                            if(!redimensionarImagen($renameFile,$renameFile,$ancho,$alto)){
                                $smarty->assign("mb_title", _tr("ERROR"));
                                $smarty->assign("mb_message", _tr("Possible file upload attack. Filename") ." : ". $pictureUpload);
                                if($update)
                                    return view_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk,TRUE);
                                else
                                    return new_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
                            }
                        }
                    }
                }else {
                    $smarty->assign("mb_title", _tr("ERROR"));
                    $smarty->assign("mb_message", _tr("Possible file upload attack. Filename") ." : ". $pictureUpload);
                    if($update)
                        return view_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk,TRUE);
                    else
                        return new_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
                }
            }
        }

        $namedb = $last_namedb = $emaildb = "";
        $statusdb = "isPublic";
        $telefonodb = $idPost;
        $departmentdb = $imdb = "";

        if($directory=="external"){
            $namedb       = isset($_POST['name'])?$_POST['name']:"";
            $last_namedb  = isset($_POST['last_name'])?$_POST['last_name']:"";
            $telefonodb   = isset($_POST['work_phone'])?$_POST['work_phone']:"";
            $statusdb     = isset($_POST['address_book_status'])?$_POST['address_book_status']:"";
            $emaildb      = isset($_POST['email'])?$_POST['email']:"";
        }
        else if($directory=="internal"){
            $departmentdb = isset($_POST['department'])?$_POST['department']:"";
            $imdb         = isset($_POST['im'])?$_POST['im']:"";
        }

        $cellphonedb  = isset($_POST['cell_phone'])?$_POST['cell_phone']:"";
        $homephonedb  = isset($_POST['home_phone'])?$_POST['home_phone']:"";
        $fax1db       = isset($_POST['fax1'])?$_POST['fax1']:"";
        $fax2db       = isset($_POST['fax2'])?$_POST['fax2']:"";
        $iduserdb     = isset($id_user)?"$id_user":"";
        $picturedb    = isset($file_upload)?"$file_upload":"";
        $provincedb   = isset($_POST['province'])?$_POST['province']:"";
        $citydb       = isset($_POST['city'])?$_POST['city']:"";
        $addressdb    = isset($_POST['address'])?$_POST['address']:"";
        $companydb    = isset($_POST['company'])?$_POST['company']:"";
        $company_contactdb  = isset($_POST['company_contact'])?$_POST['company_contact']:"";
        $contact_roldb      = isset($_POST['contact_rol'])?$_POST['contact_rol']:"";
        $directorydb  = $directory;
        $notesdb      = isset($_POST['notes'])?$_POST['notes']:"";

        $data = array($namedb, $last_namedb, $telefonodb, $cellphonedb, $homephonedb, $fax1db, $fax2db, $emaildb, $iduserdb,
            $picturedb, $provincedb, $citydb, $addressdb, $companydb, $company_contactdb, $contact_roldb, $directorydb, $notesdb, $statusdb, $departmentdb, $imdb);
        if($update && isset($contactData['id'])){ // actualizacion del contacto
            if($contactData){
                if($file_upload == ""){
                    $data[9] = $contactData['picture'];
                }

                $idt = ($directory=="external")?$contactData['id']:$contactData['id_on_address_book_db'];
                $result = $padress_book->updateContact($data,$idt);
                if(!$result){
                    $smarty->assign("mb_title", _tr("Validation Error"));
                    $smarty->assign("mb_message", _tr("Internal Error"));
                    return report_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
                }
            }else{
                $smarty->assign("mb_title", _tr("Validation Error"));
                $smarty->assign("mb_message", _tr("Internal Error"));
                return report_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            }
        }else{ //// creacion de contacto
            $result = $padress_book->addContact($data);
            if(!$result){
                $smarty->assign("mb_title", _tr("Validation Error"));
                $smarty->assign("mb_message", _tr("Internal Error"));
                return new_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
            }

            $lastId = $pDB->getLastInsertId();
            $idtmp  = ($directory=="external")?$lastId:$idPost;
            $contactData2 = $padress_book->contactData($idtmp, $id_user,$directory,$isAdminGroup,$dsnAsterisk);

            if($contactData2['picture']!="" && isset($contactData2['picture'])){
                $arrIm = explode(".",$contactData2['picture']);
                $renameFile = "$ruta_destino/".$lastId.".".$arrIm[count($arrIm)-1];
                $file_upload = $lastId.".".$arrIm[count($arrIm)-1];
                rename($ruta_destino."/".$contactData2['picture'], $renameFile);
                rename($ruta_destino."/".$idImg."_Thumbnail.".$arrIm[count($arrIm)-1], $ruta_destino."/".$lastId."_Thumbnail.".$arrIm[count($arrIm)-1]);
                $data[9] = $file_upload;
                $padress_book->updateContact($data,$lastId);
            }
        }

        if(!$result)
            return($pDB->errMsg);

        if($_POST['id'])
            header("Location: ?menu=$module_name&action=show&type=$directory&id=".$_POST['id']);
        else
            header("Location: ?menu=$module_name");
    }
}

function deleteContact($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk)
{
    $padress_book = new paloAdressBook($pDB);
    $ruta_destino = "/var/www/address_book_images/";
    $pACL         = new paloACL($pDB_2);
    $id_user      = $pACL->getIdUser($_SESSION["issabel_user"]);
    $result       = "";

    foreach($_POST as $key => $values){
        if(substr($key,0,8) == "contact_")
        {
            $tmpBookID = substr($key, 8);
            if($padress_book->isEditablePublicContact($tmpBookID, $id_user, "external", false, null)){
                $contactTmp = $padress_book->contactData($tmpBookID, $id_user,"external", false, null);
                $result = $padress_book->deleteContact($tmpBookID, $id_user);
                if($contactTmp['picture']!="" && isset($contactTmp['picture'])){
                    if(is_file($ruta_destino."/".$contactTmp['picture']))
                        unlink($ruta_destino."/".$contactTmp['picture']);

                    $arrIm = explode(".",$contactTmp['picture']);
                    $typeImage = $arrIm[count($arrIm)-1];
                    if(is_file($ruta_destino."/{$tmpBookID}_Thumbnail.{$typeImage}"))
                        unlink($ruta_destino."/{$tmpBookID}_Thumbnail.{$typeImage}");
                }
            }
        }
    }
    $content = report_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);

    return $content;
}

function view_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk, $update=FALSE)
{
    $directory = getParameter("type");
    $arrFormadress_book = createFieldForm($directory);
    $pACL    = new paloACL($pDB_2);
    $id_user = $pACL->getIdUser($_SESSION["issabel_user"]);
    $isAdminGroup = $pACL->isUserAdministratorGroup($_SESSION["issabel_user"]);

    $padress_book = new paloAdressBook($pDB);
    $oForm = new paloForm($smarty,$arrFormadress_book);
    $id = getParameter('id');

    if(isset($_POST["edit"]) || $update==TRUE){
        $oForm->setEditMode();
        if($padress_book->isEditablePublicContact($id, $id_user, $directory, $isAdminGroup, $dsnAsterisk)){
            $smarty->assign("Commit", 1);
            $smarty->assign("SAVE",_tr("Save"));
        }else{
            $smarty->assign("Commit", 0);
            $smarty->assign("SAVE",_tr("Save"));
        }
    }else{
        $oForm->setViewMode();
        $smarty->assign("Edit", 1);
        if($padress_book->isEditablePublicContact($id, $id_user, $directory, $isAdminGroup, $dsnAsterisk)){
            $smarty->assign("Edit", 1);
            $smarty->assign("EditW", 0);
        }else{
            $smarty->assign("Edit", 0);
            $smarty->assign("EditW", 0);
        }
    }

    $smarty->assign("EDIT", _tr("Edit"));
    $smarty->assign("REQUIRED_FIELD", _tr("Required field"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("title", _tr("Address Book"));
    $smarty->assign("FirstName",_tr("First Name"));
    $smarty->assign("LastName",_tr("Last Name"));
    $smarty->assign("PhoneNumber",_tr("Phone Number"));
    $smarty->assign("Email",_tr("Email"));
    $smarty->assign("address",_tr("Address"));
    $smarty->assign("company",_tr("Company"));
    $smarty->assign("notes",_tr("Notes"));
    $smarty->assign("picture",_tr("picture"));
    $smarty->assign("private_contact", _tr("Private Contact"));
    $smarty->assign("public_contact", _tr("Public Contact"));

    if(isset($_POST['address_book_options']) && $_POST['address_book_options']=='address_from_csv')
        $smarty->assign("check_csv", "checked");
    else $smarty->assign("check_new_contact", "checked");


    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("CANCEL", _tr("Cancel"));
    $smarty->assign("REQUIRED_FIELD", _tr("Required field"));
    $smarty->assign("label_file", _tr("File"));
    $smarty->assign("DOWNLOAD", _tr("Download Address Book"));
    $smarty->assign("HeaderFile", _tr("Header File Address Book"));
    $smarty->assign("AboutContacts", _tr("About Address Book"));

    $smarty->assign("style_address_options", "style='display:none'");

    $smarty->assign("idPhoto",$id);

    $contactData = $padress_book->contactData($id, $id_user, $directory, true, $dsnAsterisk);
    if($contactData){
        $smarty->assign("ID",$id);
        $smarty->assign("TYPE",$directory);
    }else{
        $smarty->assign("mb_title", _tr("Validation Error"));
        $smarty->assign("mb_message", _tr("Not_allowed_contact"));
        return report_adress_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk);
    }

    if($contactData['status']=='isPrivate')
       $smarty->assign("check_isPrivate", "checked");
    else if($contactData['status']=='isPublic')
        $smarty->assign("check_isPublic", "checked");
    else
        $smarty->assign("check_isPrivate", "checked");


    $arrData['name']          = isset($_POST['name'])?$_POST['name']:$contactData['name'];
    $arrData['last_name']     = isset($_POST['last_name'])?$_POST['last_name']:isset($contactData['last_name'])?$contactData['last_name']:"";
    $arrData['work_phone']    = isset($_POST['work_phone'])?$_POST['work_phone']:$contactData['work_phone'];
    $arrData['cell_phone']    = isset($_POST['cell_phone'])?$_POST['cell_phone']:$contactData['cell_phone'];
    $arrData['home_phone']    = isset($_POST['home_phone'])?$_POST['home_phone']:$contactData['home_phone'];
    $arrData['fax1']          = isset($_POST['fax1'])?$_POST['fax1']:$contactData['fax1'];
    $arrData['fax2']          = isset($_POST['fax2'])?$_POST['fax2']:$contactData['fax2'];
    $arrData['email']         = isset($_POST['email'])?$_POST['email']:$contactData['email'];
    $arrData['province']      = isset($_POST['province'])?$_POST['province']:$contactData['province'];
    $arrData['city']          = isset($_POST['city'])?$_POST['city']:$contactData['city'];
    $arrData['address']       = isset($_POST['address'])?$_POST['address']:$contactData['address'];
    $arrData['company']       = isset($_POST['company'])?$_POST['company']:$contactData['company'];
    $arrData['company_contact'] = isset($_POST['company_contact'])?$_POST['company_contact']:$contactData['company_contact'];
    $arrData['contact_rol']     = isset($_POST['contact_rol'])?$_POST['contact_rol']:$contactData['contact_rol'];
    $arrData['directory']       = isset($_POST['directory'])?$_POST['directory']:$contactData['directory'];
    $arrData['notes']         = isset($_POST['notes'])?$_POST['notes']:$contactData['notes'];
    $arrData['picture']       = isset($_POST['picture'])?$_POST['picture']:$contactData['picture'];
    $arrData['status']        = isset($_POST['status'])?$_POST['status']:$contactData['status'];
    $arrData['department']    = isset($_POST['department'])?$_POST['department']:$contactData['department'];
    $arrData['im']            = isset($_POST['im'])?$_POST['im']:$contactData['im'];

    $smarty->assign("ShowImg",1);
    $htmlForm = $oForm->fetchForm("$local_templates_dir/new_adress_book.tpl",  _tr("Address Book"), $arrData);

    $contenidoModulo = "<form  method='POST' enctype='multipart/form-data' style='margin-bottom:0;' action='?menu=$module_name'>".$htmlForm."</form>";

    return $contenidoModulo;
}

function call2phone($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk)
{
    $jsonObject = new PaloSantoJSON();
    $padress_book = new paloAdressBook($pDB);
    $pACL         = new paloACL($pDB_2);
    $id_user      = $pACL->getIdUser($_SESSION["issabel_user"]);
    $idContact=getParameter('idContact');
    $typeContact=getParameter('typeContact');

    if($id_user != FALSE)
    {
        $user = $pACL->getUsers($id_user);
        if($user != FALSE)
        {
            $extension = $user[0][3];
            if($extension != "")
            {
                if (isset($idContact)){
		    $id=$idContact;
		}
		else{
		    $id="";
 		}

                $phone2call = '';
		if(isset($typeContact) && $typeContact=='external')
                {
                    $contactData = $padress_book->contactData($id, $id_user,"external",false,null);
                    $phone2call = $contactData['telefono'];
                }else
                    $phone2call = $id;

                $result = $padress_book->Obtain_Protocol_from_Ext($dsnAsterisk, $extension);
                if($result != FALSE)
                {
                    $result = $padress_book->Call2Phone($dsn_agi_manager, $extension, $phone2call, $result['dial'], $result['description']);
                    if(!$result)
                    {
                        $jsonObject->set_error(_tr("The call couldn't be realized"));
                        return $jsonObject->createJSON();
                    }
                }
                else {
                     $jsonObject->set_error($padress_book->errMsg);
                     return $jsonObject->createJSON();
                }
            }
        }
        else{
            $jsonObject->set_error($padress_book->errMsg);
            return $jsonObject->createJSON();
        }
    }
    else{
        $jsonObject->set_error($padress_book->errMsg);
        return $jsonObject->createJSON();
    }

    return $jsonObject->createJSON();
}


function transferCALL($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk)
{
    $jsonObject = new PaloSantoJSON();
    $padress_book = new paloAdressBook($pDB);
    $pACL         = new paloACL($pDB_2);
    $id_user      = $pACL->getIdUser($_SESSION["issabel_user"]);
    $idContact=getParameter('idContact');
    $typeContact=getParameter('typeContact');

    if($id_user != FALSE)
    {
        $user = $pACL->getUsers($id_user);
        if($user != FALSE)
        {
            $extension = $user[0][3];
            if($extension != "")
            {
                if (isset($idContact)){
                    $id=$idContact;
                }
                else{
                    $id="";
                }

                $phone2tranfer = '';
                if(isset($typeContact) && $typeContact=='external')
                {
                    $contactData   = $padress_book->contactData($id, $id_user,"external",false,null);
                    $phone2tranfer = $contactData['telefono'];
                }else
                    $phone2tranfer = $id;

                $result = $padress_book->Obtain_Protocol_from_Ext($dsnAsterisk, $extension);
                if($result != FALSE)
                {
                    $result = $padress_book->TranferCall($dsn_agi_manager, $extension, $phone2tranfer, $result['dial'], $result['description']);
                    if(!$result)
                    {
                        $jsonObject->set_error(_tr("The transfer couldn't be realized, maybe you don't have any conversation now."));
                        return $jsonObject->createJSON();
                    }
                }
                else {
                    $jsonObject->set_error($padress_book->errMsg);
                    return $jsonObject->createJSON();
                }
            }
        }
        else{
            $jsonObject->set_error($padress_book->errMsg);
            return $jsonObject->createJSON();
        }
    }
    else{
        $jsonObject->set_error($padress_book->errMsg);
        return $jsonObject->createJSON();
    }

    return $jsonObject->createJSON();
}
/*
******** Fin
*/



function getAction()
{
    if(getParameter("edit"))
        return "edit";
    else if(getParameter("commit"))
        return "commit";
    else if(getParameter("show"))
        return "show";
    else if(getParameter("delete"))
        return "delete";
    else if(getParameter("new"))
        return "new";
    else if(getParameter("save"))
        return "save";
    else if(getParameter("delete"))
        return "delete";
    else if(getParameter("action")=="show")
        return "show";
    else if(getParameter("action")=="download_csv")
        return "download_csv";
    else if(getParameter("action")=="call2phone")
        return "call2phone";
    else if(getParameter("action")=="transfer_call")
        return "transfer_call";
    else if(getParameter("action")=="getImage")
        return "getImage";
    else
        return "report";
}

function download_address_book($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk)
{
    header("Cache-Control: private");
    header("Pragma: cache");
    header('Content-Type: text/csv; charset=iso-8859-1; header=present');
    header("Content-disposition: attachment; filename=address_book.csv");
    echo backup_contacts($pDB, $pDB_2);
}

function getImageContact($smarty, $module_name, $local_templates_dir, $pDB, $pDB_2, $arrConf, $dsn_agi_manager, $dsnAsterisk)
{
    $contact_id = getParameter('idPhoto');
    $thumbnail  = getParameter("thumbnail");
    $directory  = getParameter("type");

    $pACL       = new paloACL($pDB_2);
    $id_user    = $pACL->getIdUser($_SESSION["issabel_user"]);

    $ruta_destino = "/var/www/address_book_images";
    $imgDefault = $_SERVER['DOCUMENT_ROOT']."/modules/$module_name/images/Icon-user.png";
    $padress_book = new paloAdressBook($pDB);
    $contactData = $padress_book->contactData($contact_id, $id_user,$directory,true,$dsnAsterisk);
    $idt = ($directory=="external")?$contactData['id']:$contactData['id_on_address_book_db'];

    $pic = isset($contactData['picture'])?$contactData['picture']:0;
    $arrIm = explode(".",$pic);
    $typeImage = $arrIm[count($arrIm)-1];
    if($thumbnail=="yes")
        $image = $ruta_destino."/".$idt."_Thumbnail.$typeImage";
    else
        $image = $ruta_destino."/".$pic;
    // Creamos la imagen a partir de un fichero existente


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
        echo $image;
    }
    return;
}

function backup_contacts($pDB, $pDB_2)
{
    $Messages = "";
    $csv = "";
    $pAdressBook = new paloAdressBook($pDB);
    $fields = "name, last_name, telefono, cell_phone, home_phone, fax1, fax2, email, province, city, address, company, company_contact, contact_rol, notes";
    $pACL         = new paloACL($pDB_2);
    $id_user      = $pACL->getIdUser($_SESSION["issabel_user"]);
    $arrResult = $pAdressBook->getAddressBookByCsv(null, null, $fields, null, null, $id_user);

    if(!$arrResult)
    {
        $Messages .= _tr("There aren't contacts").". ".$pAdressBook->errMsg;
        echo $Messages;
    }else{
        //cabecera
        $csv .= "\"Name\",\"Last Name\",\"Work's Phone Number\",\"Cell Phone Number (SMS)\",\"Home Phone Number\",";
        $csv .= "\"FAX Number 1\",\"FAX Number 2\",\"Email\",\"Province\",\"City\",\"Address\",\"Company\",";
        $csv .= "\"Contact person in your Company\",\"Contact person's current position\",\"Notes\"\n";
        foreach($arrResult as $key => $contact)
        {
            $csv .= "\"{$contact['name']}\",\"{$contact['last_name']}\",".
                    "\"{$contact['telefono']}\",\"{$contact['cell_phone']}\",".
                    "\"{$contact['home_phone']}\",\"{$contact['fax1']}\",".
                    "\"{$contact['fax2']}\",\"{$contact['email']}\",".
                    "\"{$contact['province']}\",\"{$contact['city']}\",".
                    "\"{$contact['address']}\",\"{$contact['company']}\",".
                    "\"{$contact['company_contact']}\",\"{$contact['contact_rol']}\",".
                    "\"{$contact['notes']}\"".
                    "\n";
        }
    }
    return $csv;
}

function redimensionarImagen($ruta1,$ruta2,$ancho,$alto)
{

    # se obtene la dimension y tipo de imagen
    $datos=getimagesize($ruta1);

    if(!$datos)
        return false;

    $ancho_orig = $datos[0]; # Anchura de la imagen original
    $alto_orig = $datos[1];    # Altura de la imagen original
    $tipo = $datos[2];
    $img = "";
    if ($tipo==1){ # GIF
        if (function_exists("imagecreatefromgif"))
            $img = imagecreatefromgif($ruta1);
        else
            return false;
    }
    else if ($tipo==2){ # JPG
        if (function_exists("imagecreatefromjpeg"))
            $img = imagecreatefromjpeg($ruta1);
        else
            return false;
    }
    else if ($tipo==3){ # PNG
        if (function_exists("imagecreatefrompng"))
            $img = imagecreatefrompng($ruta1);
        else
            return false;
    }

    $anchoTmp = imagesx($img);
    $altoTmp = imagesy($img);
    if(($ancho > $anchoTmp || $alto > $altoTmp)){
        ImageDestroy($img);
        return true;
    }

    # Se calculan las nuevas dimensiones de la imagen
    if ($ancho_orig>$alto_orig){
        $ancho_dest=$ancho;
        $alto_dest=($ancho_dest/$ancho_orig)*$alto_orig;
    }else{
        $alto_dest=$alto;
        $ancho_dest=($alto_dest/$alto_orig)*$ancho_orig;
    }

    // imagecreatetruecolor, solo estan en G.D. 2.0.1 con PHP 4.0.6+
    $img2=@imagecreatetruecolor($ancho_dest,$alto_dest) or $img2=imagecreate($ancho_dest,$alto_dest);

    // Redimensionar
    // imagecopyresampled, solo estan en G.D. 2.0.1 con PHP 4.0.6+
    @imagecopyresampled($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig) or imagecopyresized($img2,$img,0,0,0,0,$ancho_dest,$alto_dest,$ancho_orig,$alto_orig);

    // Crear fichero nuevo, según extensión.
    if ($tipo==1) // GIF
    if (function_exists("imagegif"))
        imagegif($img2, $ruta2);
    else
        return false;

    if ($tipo==2) // JPG
    if (function_exists("imagejpeg"))
        imagejpeg($img2, $ruta2);
    else
        return false;

    if ($tipo==3)  // PNG
    if (function_exists("imagepng"))
        imagepng($img2, $ruta2);
    else
        return false;

    return true;

}
?>