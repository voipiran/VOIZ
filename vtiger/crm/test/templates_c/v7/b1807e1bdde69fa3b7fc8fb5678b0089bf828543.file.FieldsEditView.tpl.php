<?php /* Smarty version Smarty-3.1.7, created on 2018-09-22 15:52:58
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Webforms/FieldsEditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3666545695ba63422cf6f19-17722238%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1807e1bdde69fa3b7fc8fb5678b0089bf828543' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Webforms/FieldsEditView.tpl',
      1 => 1522233382,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3666545695ba63422cf6f19-17722238',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODE' => 0,
    'SOURCE_MODULE' => 0,
    'MODULE' => 0,
    'ALL_FIELD_MODELS_LIST' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'FIELD_INFO' => 0,
    'SELECTED_FIELD_MODELS_LIST' => 0,
    'FIELD_NAME' => 0,
    'SELECETED_FIELD_MODEL' => 0,
    'IS_PARENT_EXISTS' => 0,
    'SPLITTED_MODULE' => 0,
    'DATATYPEMARGINLEFT' => 0,
    'SPECIAL_VALIDATOR' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_NAME' => 0,
    'PICKLIST_VALUE' => 0,
    'QUALIFIED_MODULE' => 0,
    'DOCUMENT_FILE_FIELDS' => 0,
    'FILE_INDEX' => 0,
    'DOCUMENT_FILE_FIELD' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ba6342310177',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ba6342310177')) {function content_5ba6342310177($_smarty_tpl) {?>
<input type="hidden" name="selectedFieldsData" val=""/><input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
"/><input type="hidden" name="targetModule" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
"/><div class="fieldBlockContainer-webform" style="margin-bottom: 0;"><div class="fieldBlockHeader"><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
 <?php echo vtranslate('LBL_FIELD_INFORMATION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4></div><hr><table class="table table-bordered" width="100%" name="targetModuleFields"><colgroup><col style="width:5%;"><col style="width:5%;"><col style="width:25%;"><col style="width:40%;"><col style="width:25%;"></colgroup><tr><td colspan="5"><div class="row"><div class="col-sm-2 col-lg-2"><div class="textAlignCenter" style="margin-top:8px;"><b><?php echo vtranslate('LBL_ADD_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></div></div><div class="col-sm-8 col-lg-8"><select id="fieldsList" multiple="multiple" data-placeholder="<?php echo vtranslate('LBL_SELECT_FIELDS_OF_TARGET_MODULE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="select2" style="width:100%"><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_FIELD_MODELS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable(Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo()), null, 0);?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" data-field-info='<?php echo $_smarty_tpl->tpl_vars['FIELD_INFO']->value;?>
' data-mandatory="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true)==1 ? "true" : "false";?>
"<?php if ((array_key_exists($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['SELECTED_FIELD_MODELS_LIST']->value))||($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true))){?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true)){?><span class="redColor">*</span><?php }?></option><?php } ?><?php } ?></select></div><div class="col-sm-2 col-lg-2" style="margin-top: 2px"><button type="button" id="saveFieldsOrder" class="btn btn-success" disabled="disabled"><?php echo vtranslate('LBL_SAVE_FIELDS_ORDER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></div></td></tr><tr name="fieldHeaders"><td class="textAlignCenter"><b><?php echo vtranslate('LBL_MANDATORY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></td><td class="textAlignCenter"><b><?php echo vtranslate('LBL_HIDDEN',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></td><td><b><?php echo vtranslate('LBL_FIELD_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></td><td class="textAlignCenter"><b><?php echo vtranslate('LBL_OVERRIDE_VALUE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></td><td><b><?php echo vtranslate('LBL_WEBFORM_REFERENCE_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></td></tr><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_FIELD_MODELS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true)||array_key_exists($_smarty_tpl->tpl_vars['FIELD_NAME']->value,$_smarty_tpl->tpl_vars['SELECTED_FIELD_MODELS_LIST']->value)){?><?php if (array_key_exists($_smarty_tpl->tpl_vars['FIELD_NAME']->value,$_smarty_tpl->tpl_vars['SELECTED_FIELD_MODELS_LIST']->value)){?><?php $_smarty_tpl->tpl_vars['SELECETED_FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['SELECTED_FIELD_MODELS_LIST']->value[$_smarty_tpl->tpl_vars['FIELD_NAME']->value], null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['SELECETED_FIELD_MODEL']->value->get('fieldvalue')), null, 0);?><?php }?><tr data-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" class="listViewEntries" data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType();?>
" data-mandatory-field=<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true)==1 ? "true" : "false";?>
><td class="textAlignCenter" style="vertical-align: inherit"><?php if (!empty($_smarty_tpl->tpl_vars['SELECETED_FIELD_MODEL']->value)){?><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SELECETED_FIELD_MODEL']->value->get('sequence');?>
" class="sequenceNumber" name='selectedFieldsData[<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
][sequence]'/><?php }else{ ?><input type="hidden" value="" class="sequenceNumber" name='selectedFieldsData[<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
][sequence]'/><?php }?><input type="hidden" value="0" name='selectedFieldsData[<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
][required]'/><input type="checkbox" <?php if (($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true)==1)||($_smarty_tpl->tpl_vars['SELECETED_FIELD_MODEL']->value->get('required')==1)){?>checked="checked"<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true)==1){?> onclick="return false;" onkeydown="return false;"<?php }?>name='selectedFieldsData[<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
][required]' class="markRequired mandatoryField" value="1" style="margin-top: -3px;"/></td><td class="textAlignCenter verticalAlignMiddle" style="vertical-align: inherit"><input type="hidden" value="0" name='selectedFieldsData[<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
][hidden]'/><input type="checkbox" <?php if ((!empty($_smarty_tpl->tpl_vars['SELECETED_FIELD_MODEL']->value))&&($_smarty_tpl->tpl_vars['SELECETED_FIELD_MODEL']->value->get('hidden')==1)){?> checked="checked"<?php }?>name="selectedFieldsData[<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
][hidden]" class="markRequired hiddenField" value="1"/></td><td class="fieldLabel" style="vertical-align: inherit" data-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true)){?>*<?php }?>"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true)){?><span class="redColor">*</span><?php }?></td><?php $_smarty_tpl->tpl_vars['DATATYPEMARGINLEFT'] = new Smarty_variable(array("date","currency","percentage","reference","multicurrency"), null, 0);?><?php $_smarty_tpl->tpl_vars['IS_PARENT_EXISTS'] = new Smarty_variable(strpos($_smarty_tpl->tpl_vars['MODULE']->value,":"), null, 0);?><?php if ($_smarty_tpl->tpl_vars['IS_PARENT_EXISTS']->value){?><?php $_smarty_tpl->tpl_vars['SPLITTED_MODULE'] = new Smarty_variable(explode(":",$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE'] = new Smarty_variable(($_smarty_tpl->tpl_vars['SPLITTED_MODULE']->value[1]), null, 0);?><?php }?><td class="fieldValue" data-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" <?php if (in_array($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType(),$_smarty_tpl->tpl_vars['DATATYPEMARGINLEFT']->value)){?> <?php }?>><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='boolean'){?><?php $_smarty_tpl->tpl_vars["FIELD_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName(), null, 0);?><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'], null, 0);?><select class="select2 col-sm-6 inputElement" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> data-rule-required="true" <?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)){?>data-specific-rules='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]);?>
'<?php }?> data-selected-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
'><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
" <?php if ((trim(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')))==trim($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value))||($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')=="1"&&($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value=='on'))||($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')=="0"&&($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value=='off'))){?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
</option><?php } ?></select><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()!='image'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BLOCK_FIELDS'=>$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE']->value,'FIELD_NAME'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName(),'MODE'=>'webform'), 0);?>
<?php }?></td><td style="vertical-align: inherit"><?php if (Settings_Webforms_Record_Model::isCustomField($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'))){?><?php echo vtranslate('LBL_LABEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
<?php $_tmp1=ob_get_clean();?><?php echo vtranslate($_tmp1,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<?php }?><?php if (!$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true)){?><div class="pull-right actions"><span class="actionImages"><a class="removeTargetModuleField" href="javascript:void(0);"><i class="icon-remove-sign"></i></a></span></div><?php }?></td></tr><?php }?><?php } ?><?php } ?></tbody></table></div><?php if (Vtiger_Functions::isDocumentsRelated($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value)){?><div class="fieldBlockContainer"><div class="fieldBlockHeader"><h4><?php echo vtranslate('LBL_UPLOAD_DOCUMENTS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><hr><div><div><button class="btn btn-default" id="addFileFieldBtn"><span class="fa fa-plus"></span>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_FILE_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div><div class="row" style="margin-top: 10px;"><div class="col-lg-7"><table class="table table-bordered" id='fileFieldsTable'><tbody><tr><td><b><?php echo vtranslate('LBL_FIELD_LABEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></td><td class="textAlignCenter"><b><?php echo vtranslate('LBL_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></td><td class="textAlignCenter"><b><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></td></tr><?php  $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->_loop = false;
 $_smarty_tpl->tpl_vars['FILE_INDEX'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->key => $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value){
$_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->_loop = true;
 $_smarty_tpl->tpl_vars['FILE_INDEX']->value = $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->key;
?><tr><td style="vertical-align: middle;"><input type="text" class="inputElement nameField" name="file_field[<?php echo $_smarty_tpl->tpl_vars['FILE_INDEX']->value;?>
][fieldlabel]" value="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['fieldlabel'];?>
" data-rule-required="true"></td><td class="textAlignCenter" style="vertical-align: middle;"><input type="checkbox" name="file_field[<?php echo $_smarty_tpl->tpl_vars['FILE_INDEX']->value;?>
][required]" <?php if ($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['required']){?>checked='checked'<?php }?> value='1'></td><td class="textAlignCenter" style="vertical-align: middle;"><a class="removeFileField" style="color: black;"><i class="fa fa-trash icon-trash"></i></a></td></tr><?php } ?><tr class="noFileField <?php if (count($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELDS']->value)>0){?>hide<?php }?>"><td colspan="3" style="height: 100px; vertical-align: middle;"><center><?php echo vtranslate('LBL_NO_FILE_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</center></td></tr></tbody></table></div><div class="col-lg-5"><div class="vt-default-callout vt-info-callout" style="margin: 0;"><h4 class="vt-callout-header"><span class="fa fa-info-circle"></span>&nbsp; <?php echo vtranslate('LBL_INFO');?>
</h4><div><?php echo vtranslate('LBL_FILE_FIELD_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate("SINGLE_".($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value));?>
</div></div></div></div><input type="hidden" id='fileFieldNextIndex' value='<?php echo count($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELDS']->value)+1;?>
'><input type="hidden" id="fileFieldsCount" value="<?php echo count($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELDS']->value);?>
"></div><?php }?>
<?php }} ?>