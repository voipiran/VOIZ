<?php /* Smarty version Smarty-3.1.7, created on 2018-12-17 11:14:26
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Webforms/ShowForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10779720485c1753da821405-30893210%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86b042b90355278d387ab9805c3310de81c6d16c' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Webforms/ShowForm.tpl',
      1 => 1522233382,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10779720485c1753da821405-30893210',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'QUALIFIED_MODULE' => 0,
    'RECORD_MODEL' => 0,
    'HEADER_TITLE' => 0,
    'ALLOWED_ALL_FILES_SIZE' => 0,
    'ACTION_PATH' => 0,
    'SELECTED_FIELD_MODELS_LIST' => 0,
    'FIELD_MODEL' => 0,
    'SOURCE_MODULE' => 0,
    'DATA_TYPE' => 0,
    'FIELD_INFO' => 0,
    'FIELD_NAME' => 0,
    'FIELD_LABEL' => 0,
    'HIDDEN_STATUS' => 0,
    'PICKLIST_NAME' => 0,
    'PICKLIST_DATA_LABEL' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_VALUE' => 0,
    'FIELD_VALUE_LIST' => 0,
    'TYPE' => 0,
    'EXPLODED_FIELD_VALUES' => 0,
    'DOCUMENT_FILE_FIELDS' => 0,
    'DOCUMENT_FILE_FIELD' => 0,
    'IS_CAPTCHA_ENABLED' => 0,
    'CAPTCHA_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c1753da9fd45',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c1753da9fd45')) {function content_5c1753da9fd45($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/var/www/webroot/ROOT/libraries/Smarty/libs/plugins/modifier.replace.php';
?>

<div class="modal-dialog modelContainer modal-content"><?php ob_start();?><?php echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('name');?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable((($_tmp1).(" - ")).($_tmp2), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<div class="modal-body"><div class="marginBottom10px"><span><?php echo vtranslate('LBL_EMBED_THE_FOLLOWING_FORM_IN_YOUR_WEBSITE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><span class="pull-right"><a href="" id="webformCopyClipboard"><i class="fa fa-clipboard" aria-hidden="true"></i><?php echo vtranslate('LBL_COPY_TO_CLIPBOARD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></span></div><input type="hidden" class="allowedAllFilesSize" value="<?php echo $_smarty_tpl->tpl_vars['ALLOWED_ALL_FILES_SIZE']->value;?>
"><textarea id="showFormContent" class="input-xxlarge" style="min-height:400px;width: 100%" readonly></textarea><code><pre><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><form id="__vtigerWebForm" name="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
" action="<?php echo $_smarty_tpl->tpl_vars['ACTION_PATH']->value;?>
" method="post" accept-charset="utf-8" enctype="multipart/form-data"><input type="hidden" name="publicid" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('publicid');?>
" /><input type="hidden" name="urlencodeenable" value="1" /><input type="hidden" name="name" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
" /><?php $_smarty_tpl->tpl_vars['IS_CAPTCHA_ENABLED'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->isCaptchaEnabled(), null, 0);?><table><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODELS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['SOURCE_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModuleName(), null, 0);?><?php $_smarty_tpl->tpl_vars['DATA_TYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType(), null, 0);?><?php $_smarty_tpl->tpl_vars['HIDDEN_STATUS'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden'), null, 0);?><?php $_smarty_tpl->tpl_vars['TYPE'] = new Smarty_variable('', null, 0);?><tr><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden')!=1){?><td><label><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo vtranslate(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label')),$_tmp3);?>
<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required')==1){?>*<?php }?></label></td><?php }?><td><?php if (($_smarty_tpl->tpl_vars['DATA_TYPE']->value=='picklist'||$_smarty_tpl->tpl_vars['DATA_TYPE']->value=='multipicklist')){?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'], null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value)), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'), null, 0);?><?php if (Settings_Webforms_Record_Model::isCustomField($_smarty_tpl->tpl_vars['FIELD_NAME']->value)){?><?php ob_start();?><?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'));?>
<?php $_tmp4=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['FIELD_LABEL'] = new Smarty_variable($_tmp4, null, 0);?><?php ob_start();?><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,' ','_');?>
<?php $_tmp5=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['PICKLIST_DATA_LABEL'] = new Smarty_variable("label:".$_tmp5, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['PICKLIST_DATA_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'), null, 0);?><?php }?><?php }elseif(($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="salutation")||($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="string")||($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="time")||($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="currency")||($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="url")||($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="phone")){?><?php $_smarty_tpl->tpl_vars['TYPE'] = new Smarty_variable("text", null, 0);?><?php }elseif(($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="text")){?><?php $_smarty_tpl->tpl_vars['TYPE'] = new Smarty_variable("text", null, 0);?><textarea name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required')==1){?> required<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden')==1){?> hidden<?php }?> ><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
</textarea><?php }elseif(($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="email")){?><?php $_smarty_tpl->tpl_vars['TYPE'] = new Smarty_variable("email", null, 0);?><?php }elseif(($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="image")){?><?php $_smarty_tpl->tpl_vars['TYPE'] = new Smarty_variable("image", null, 0);?><?php }elseif((($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="integer")||($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="double"))){?><?php $_smarty_tpl->tpl_vars['TYPE'] = new Smarty_variable("number", null, 0);?><?php }elseif(($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="boolean")){?><?php $_smarty_tpl->tpl_vars['TYPE'] = new Smarty_variable("checkbox", null, 0);?><?php }elseif(($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="date")){?><?php $_smarty_tpl->tpl_vars['TYPE'] = new Smarty_variable("date", null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['HIDDEN_STATUS']->value==1){?><?php $_smarty_tpl->tpl_vars['TYPE'] = new Smarty_variable('hidden', null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['DATA_TYPE']->value=='picklist'){?><select name="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_DATA_LABEL']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required')==1){?> required<?php }?> <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden')==1){?> hidden<?php }?>><option value><?php echo vtranslate('LBL_SELECT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
" <?php if (trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')))==trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value)){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select><?php }elseif($_smarty_tpl->tpl_vars['DATA_TYPE']->value=='multipicklist'){?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE_LIST"] = new Smarty_variable(explode(' |##| ',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?><select name="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value;?>
[]" data-label="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_DATA_LABEL']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required')==1){?> required<?php }?> multiple style="width: 60%;" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden')==1){?> hidden<?php }?>><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
" <?php if (in_array(Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value),$_smarty_tpl->tpl_vars['FIELD_VALUE_LIST']->value)){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></select><?php }elseif($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="reference"){?><input type="hidden" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" /><?php $_smarty_tpl->tpl_vars['EXPLODED_FIELD_VALUES'] = new Smarty_variable(explode('x',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?><input type="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['EXPLODED_FIELD_VALUES']->value[1]);?>
" readonly= /><?php }elseif($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="image"){?><input type="file" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
[]" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden')==1){?> hidden<?php }?> <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required')==1){?> required<?php }?>/><?php }elseif($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="boolean"){?><input type="hidden" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" value=0 /><?php if (($_smarty_tpl->tpl_vars['HIDDEN_STATUS']->value==1)&&($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')=="on")){?><input type="hidden" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" value=1 checked /><?php }elseif(($_smarty_tpl->tpl_vars['HIDDEN_STATUS']->value!=1)){?><input type="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" value=1 <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')=="on"){?> checked <?php }?> <?php if (($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required')==1)||($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true))){?> required<?php }?>/><?php }?><?php }elseif(($_smarty_tpl->tpl_vars['DATA_TYPE']->value!="text")&&($_smarty_tpl->tpl_vars['DATA_TYPE']->value!="boolean")){?><input type="<?php echo $_smarty_tpl->tpl_vars['TYPE']->value;?>
" name="<?php echo urlencode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName());?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedFieldName');?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" <?php if (($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required')==1)||($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true))){?> required<?php }?> <?php if (($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="double")){?> datatype="<?php echo $_smarty_tpl->tpl_vars['DATA_TYPE']->value;?>
" step="any" <?php }?>/><?php if (($_smarty_tpl->tpl_vars['DATA_TYPE']->value=="date")&&($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden')!=1)){?>(yyyy-mm-dd)<?php }?><?php }?></td></tr><?php } ?><?php  $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->key => $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value){
$_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->_loop = true;
?><tr><td><label><?php echo $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['fieldlabel'];?>
 <?php if ($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['required']){?>*<?php }?></label></td><td><input type="file" name="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['fieldname'];?>
" <?php if ($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['required']){?>required='required'<?php }?>></td></tr><?php } ?></table><?php if ($_smarty_tpl->tpl_vars['IS_CAPTCHA_ENABLED']->value){?><div id="captchaField"></div><input type="hidden" id="captchaUrl" value="<?php echo $_smarty_tpl->tpl_vars['CAPTCHA_PATH']->value;?>
"><input type="hidden" id="recaptcha_validation_value" ><?php }?><input type="submit" value="Submit" ></input></form></pre></code><input type="hidden" name="isCaptchaEnabled" value="<?php echo $_smarty_tpl->tpl_vars['IS_CAPTCHA_ENABLED']->value;?>
"></div><div class="modal-footer"><center><a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></div>
<?php }} ?>