<?php
  /* vim: set expandtab tabstop=4 softtabstop=4 shiftwidth=4:
  Codificación: UTF-8
  +----------------------------------------------------------------------+
  | Issabel version 1.1-4                                               |
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
  $Id: default.conf.php,v 1.1 2008-06-12 09:06:35 afigueroa Exp $ */

function _moduleContent(&$smarty, $module_name)
{
    //include issabel framework
    include_once "libs/paloSantoGrid.class.php";
    include_once "libs/paloSantoForm.class.php";
    include_once "libs/paloSantoConfig.class.php";

    //include module files
    include_once "modules/$module_name/configs/default.conf.php";
    include_once "modules/$module_name/libs/paloSantoRecordings.class.php";
    //include file language agree to elastix configuration
    //if file language not exists, then include language by default (en)
    $base_dir=dirname($_SERVER['SCRIPT_FILENAME']);

    load_language_module($module_name);

    //global variables
    global $arrConf;
    global $arrConfModule;
    $arrConf = array_merge($arrConf,$arrConfModule);

    //folder path for custom templates
    $templates_dir=(isset($arrConf['templates_dir']))?$arrConf['templates_dir']:'themes';
    $local_templates_dir="$base_dir/modules/$module_name/".$templates_dir.'/'.$arrConf['theme'];

    $pConfig = new paloConfig("/etc", "amportal.conf", "=", "[[:space:]]*=[[:space:]]*");
    $arrConfig = $pConfig->leer_configuracion(false);

    $dsn_agi_manager['password'] = $arrConfig['AMPMGRPASS']['valor'];
    $dsn_agi_manager['host'] = $arrConfig['AMPDBHOST']['valor'];
    $dsn_agi_manager['user'] = 'admin';

    $pDBACL = new paloDB($arrConf['issabel_dsn']['acl']);
    $accion = getAction();

    $content = "";
    switch($accion)
    {
        case "record":
            $content = new_recording($smarty, $module_name, $local_templates_dir, $dsn_agi_manager, $arrConf, $pDBACL);
            break;
        case "save":
            $content = save_recording($smarty, $module_name, $local_templates_dir, $arrConf, $pDBACL);
            break;
        default:
            $content = form_Recordings($smarty, $module_name, $local_templates_dir, $pDBACL);
            break;
    }

    return $content;
}

function save_recording($smarty, $module_name, $local_templates_dir, $arrConf, $pDBACL)
{
    $bExito = true;
    $pRecording = new paloSantoRecordings();
    $extension = $pRecording->Obtain_Extension_Current_User($arrConf);

    if(!$extension)
        return form_Recordings($smarty, $module_name, $local_templates_dir, $pDBACL);

    $destiny_path = "/var/lib/asterisk/sounds/custom/$extension/";

    if(isset($_POST['option_record']) && $_POST['option_record']=='by_record')
    {
        $filename   = isset($_POST['filename'])?$_POST['filename']:'';
        $smarty->assign("filename", $filename);

        if($filename != "")
        {
            $path = "/var/spool/asterisk/tmp";
            $archivo = "";
            $file_ext = "";
            if ($handle = opendir($path)) {
                while (false !== ($dir = readdir($handle))) {
                    if (preg_match("/({$extension}-.*)\.([gsm|wav]*)$/", $dir, $regs)) {
                        $archivo = $regs[1];
                        $file_ext = $regs[2];
                        break;
                    }
                }
            }

            $tmp_file = "$archivo.$file_ext";
            $filename .= ".$file_ext";

            if($filename != "" && $tmp_file != "" && $extension != "")
            {
                if(!file_exists($destiny_path))
                {
                    if (!mkdir($destiny_path, 0755, false)){
                        $bExito = false;
                    }
                }
                if($bExito)
                {
                    $filetmp = basename("$destiny_path/$filename");
                    $dirFile = "/var/spool/asterisk/tmp/$tmp_file";
                    $dirDest = $destiny_path.$filetmp;

                    if(is_file($dirFile)){
                        if(!rename($dirFile, $dirDest)){
                            $smarty->assign("mb_title", _tr('ERROR').":");
                            $smarty->assign("mb_message", _tr("Possible file upload attack")." $filename");
                            $bExito = false;
                            return form_Recordings($smarty, $module_name, $local_templates_dir, $pDBACL);
                        }
                    }else{
                        $bExito = false;
                    }
                }
            }else $bExito = false;
        }else $bExito = false;

        if(!$bExito)
        {
            $smarty->assign("mb_title", _tr('ERROR').":");
            $smarty->assign("mb_message", _tr("The recording couldn't be realized"));
        }
    }else{
        if (isset($_FILES['file_record'])) {
            if($_FILES['file_record']['name']!=""){
                $smarty->assign("file_record_name", $_FILES['file_record']['name']);
                if(!file_exists($destiny_path))
                {
                    $bExito = mkdir($destiny_path, 0755, TRUE);
                }
                if (!preg_match("/^(\w|-|\.|\(|\)|\s)+\.(wav|WAV|Wav|gsm|GSM|Gsm|Wav49|wav49|WAV49)$/",$_FILES['file_record']['name'])) {
                    $smarty->assign("mb_title", _tr('ERROR').":");
                    $smarty->assign("mb_message", _tr("Possible file upload attack")." ".$_FILES["file_record"]["name"]);
                    $bExito = false;
                    return form_Recordings($smarty, $module_name, $local_templates_dir, $pDBACL);
                }
                if($bExito)
                {
                    $filenameTmp = $_FILES['file_record']['name'];
                    $tmp_name = $_FILES['file_record']['tmp_name'];
                    $filename = basename("$destiny_path/$filenameTmp");
                    if (!move_uploaded_file($tmp_name, "$destiny_path/$filename"))
                    {
                        $smarty->assign("mb_title", _tr('ERROR').":");
                        $smarty->assign("mb_message", _tr("Possible file upload attack")." $filename");
                        $bExito = false;
                    }
                }else
                {
                    $smarty->assign("mb_title", _tr('ERROR').":");
                    $smarty->assign("mb_message", _tr("Destiny directory couldn't be created"));
                    $bExito = false;
                }
            }
            else{
                $smarty->assign("mb_title", _tr('ERROR').":");
                $smarty->assign("mb_message", _tr("Error copying the file"));
                $bExito = false;
            }
        }else{
            $smarty->assign("mb_title", _tr('ERROR').":");
            $smarty->assign("mb_message", _tr("Error copying the file"));
            $bExito = false;
        }
    }

    if($bExito)
    {
       $smarty->assign("mb_title", _tr("Message"));
       $smarty->assign("mb_message", _tr("The recording was saved"));
    }

    return form_Recordings($smarty, $module_name, $local_templates_dir, $pDBACL);
}

function new_recording($smarty, $module_name, $local_templates_dir, $dsn_agi_manager, $arrConf, $pDBACL)
{
    $recording_name = isset($_POST['recording_name'])?$_POST['recording_name']:'';
    if($recording_name != '')
    {
        $pRecording = new paloSantoRecordings();
        $result = $pRecording->Obtain_Protocol_Current_User($arrConf);

        $number2call = '*77';
        if($result != FALSE)
        {
            $result = $pRecording->Call2Phone($dsn_agi_manager, $result['id'], $number2call, $result['dial'], $result['description']);
            if($result)
            {
                $smarty->assign("filename", $recording_name);
                $smarty->assign("mb_message", _tr("To continue: record a message then click on save"));
            }
            else{
                $smarty->assign("mb_title", _tr('ERROR').":");
                $smarty->assign("mb_message", _tr("The call couldn't be realized"));
            }
        }
    }
    else{
        $smarty->assign("mb_title", _tr("Validation Error"));
        $smarty->assign("mb_message", _tr('Insert the Recording Name'));
    }

    return form_Recordings($smarty, $module_name, $local_templates_dir, $pDBACL);
}

function form_Recordings($smarty, $module_name, $local_templates_dir, $pDBACL)
{
    $pACL = new paloACL($pDBACL);
    $user = isset($_SESSION['issabel_user'])?$_SESSION['issabel_user']:"";
    $extension = $pACL->getUserExtension($user);
    if(is_null($extension) || $extension==""){
	$smarty->assign("DISABLED","DISABLED");
	if($pACL->isUserAdministratorGroup($user))
	    $smarty->assign("mb_message", "<b>"._tr("You don't have extension number associated with user")."</b>");
	else
	    $smarty->assign("mb_message", "<b>"._tr("contact_admin")."</b>");
    }
    if(isset($_POST['option_record']) && $_POST['option_record']=='by_file')
        $smarty->assign("check_file", "checked");
    else
        $smarty->assign("check_record", "checked");

    $oForm = new paloForm($smarty,array());

    $smarty->assign("recording_name_Label", _tr("Record Name"));
    $smarty->assign("record_Label", _tr("File Upload"));

    $smarty->assign("Record", _tr("Record"));
    $smarty->assign("SAVE", _tr("Save"));
    $smarty->assign("INFO", _tr("You can start your recording after you hear a beep in your phone. Once you have finished recording you must press the # key and then hangup").".");
    $smarty->assign("NAME", _tr("You do not need to add an extension to the record name").".");
    $smarty->assign("icon", "/modules/$module_name/images/recording.png");
    $smarty->assign("module_name", $module_name);
    $smarty->assign("file_upload", _tr("File Upload"));
    $smarty->assign("record", _tr("Record"));

    $htmlForm = $oForm->fetchForm("$local_templates_dir/form.tpl", _tr("Recordings"), $_POST);

    $contenidoModulo = "<form enctype='multipart/form-data' method='POST' style='margin-bottom:0;' action='?menu=$module_name'>".$htmlForm."</form>";

    return $contenidoModulo;
}

function getAction()
{
    if(getParameter("record"))
        return "record";
    else if(getParameter("save"))
        return "save";
    else
        return "report";
}
?>
