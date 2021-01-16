<?php /* Smarty version Smarty-3.1.7, created on 2019-02-16 13:29:59
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Calendar/QuickCreate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20854432535c67df1fd18a49-23210218%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82f4a92083d2eec1a25bcbb1f82b2372af526b34' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Calendar/QuickCreate.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20854432535c67df1fd18a49-23210218',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SCRIPTS' => 0,
    'jsModel' => 0,
    'MODE' => 0,
    'RECORD_ID' => 0,
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'PICKIST_DEPENDENCY_DATASOURCE' => 0,
    'USER_MODEL' => 0,
    'QUICK_CREATE_CONTENTS' => 0,
    'PICKIST_DEPENDENCY_DATASOURCE_TODO' => 0,
    'PICKIST_DEPENDENCY_DATASOURCE_EVENT' => 0,
    'RECORD_STRUCTURE' => 0,
    'FIELD_MODEL' => 0,
    'SPECIAL_VALIDATOR' => 0,
    'FIELD_INFO' => 0,
    'VALIDATOR' => 0,
    'VALIDATOR_NAME' => 0,
    'FIELD_NAME' => 0,
    'referenceList' => 0,
    'COUNTER' => 0,
    'isReferenceField' => 0,
    'referenceListCount' => 0,
    'DISPLAYID' => 0,
    'REFERENCED_MODULE_STRUCT' => 0,
    'value' => 0,
    'REFERENCED_MODULE_NAME' => 0,
    'BUTTON_NAME' => 0,
    'CALENDAR_MODULE_MODEL' => 0,
    'EDIT_VIEW_URL' => 0,
    'BUTTON_ID' => 0,
    'BUTTON_LABEL' => 0,
    'FIELDS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c67df2001fab',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c67df2001fab')) {function content_5c67df2001fab($_smarty_tpl) {?>

<?php  $_smarty_tpl->tpl_vars['jsModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jsModel']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SCRIPTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jsModel']->key => $_smarty_tpl->tpl_vars['jsModel']->value){
$_smarty_tpl->tpl_vars['jsModel']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['jsModel']->key;
?><script type="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getType();?>
" src="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getSrc();?>
"></script><?php } ?><div class="modal-dialog modal-lg"><div class="modal-content" style='width: 525px;left:23%;'><form class="form-horizontal recordEditView" id="QuickCreate" name="QuickCreate" method="post" action="index.php"><?php if ($_smarty_tpl->tpl_vars['MODE']->value=='edit'&&!empty($_smarty_tpl->tpl_vars['RECORD_ID']->value)){?><?php ob_start();?><?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value),$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable((($_tmp1).(" ")).($_tmp2), null, 0);?><?php }else{ ?><?php ob_start();?><?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value),$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp4=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable((($_tmp3).(" ")).($_tmp4), null, 0);?><?php }?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<div class="modal-body"><?php if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value)){?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value);?>
' /><?php }?><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><input type="hidden" name="action" value="SaveAjax"><input type="hidden" name="calendarModule" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"><input type="hidden" name="defaultCallDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('callduration');?>
" /><input type="hidden" name="defaultOtherEventDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('othereventduration');?>
" /><?php if ($_smarty_tpl->tpl_vars['MODE']->value=='edit'&&!empty($_smarty_tpl->tpl_vars['RECORD_ID']->value)){?><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
" /><?php }else{ ?><input type="hidden" name="record" value=""><?php }?><?php $_smarty_tpl->tpl_vars["RECORD_STRUCTURE_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['QUICK_CREATE_CONTENTS']->value[$_smarty_tpl->tpl_vars['MODULE']->value]['recordStructureModel'], null, 0);?><?php $_smarty_tpl->tpl_vars["RECORD_STRUCTURE"] = new Smarty_variable($_smarty_tpl->tpl_vars['QUICK_CREATE_CONTENTS']->value[$_smarty_tpl->tpl_vars['MODULE']->value]['recordStructure'], null, 0);?><?php $_smarty_tpl->tpl_vars["MODULE_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['QUICK_CREATE_CONTENTS']->value[$_smarty_tpl->tpl_vars['MODULE']->value]['moduleModel'], null, 0);?><div class="quickCreateContent calendarQuickCreateContent" style="padding-top:2%;margin-top:5px;"><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Calendar'){?><?php if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE_TODO']->value)){?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE_TODO']->value);?>
' /><?php }?><?php }else{ ?><?php if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE_EVENT']->value)){?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE_EVENT']->value);?>
' /><?php }?><?php }?><div><?php $_smarty_tpl->tpl_vars["FIELD_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['subject'], null, 0);?><div style="margin-left: 14px;width: 95%;"><?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" type="text" class="inputElement <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isNameField()){?>nameField<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='3'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='4'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isReadOnly()){?> readonly <?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)){?>data-validator="<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
"<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"]==true){?> data-rule-required="true" <?php }?><?php  $_smarty_tpl->tpl_vars['VALIDATOR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALIDATOR']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALIDATOR']->key => $_smarty_tpl->tpl_vars['VALIDATOR']->value){
$_smarty_tpl->tpl_vars['VALIDATOR']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['VALIDATOR_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['VALIDATOR']->value["name"], null, 0);?>data-rule-<?php echo $_smarty_tpl->tpl_vars['VALIDATOR_NAME']->value;?>
 = "true"<?php } ?>placeholder="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
 *" style="width: 100%;"/></div></div><div class="row" style="padding-top: 2%;"><div class="col-sm-12"><div class="col-sm-5"><?php $_smarty_tpl->tpl_vars["FIELD_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['date_start'], null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><div class="muted col-sm-1" style="line-height: 67px;left: 20px; padding-right: 7%;"><?php echo vtranslate('LBL_TO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div class="col-sm-5" <?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Calendar'){?>style="margin-top: 4%;"<?php }?>><?php $_smarty_tpl->tpl_vars["FIELD_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['due_date'], null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div></div><table class="massEditTable table no-border"><tr><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='subject'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='date_start'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='due_date'){?></tr><?php continue 1?><?php }?><?php $_smarty_tpl->tpl_vars["isReferenceField"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType(), null, 0);?><?php $_smarty_tpl->tpl_vars["referenceList"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getReferenceList(), null, 0);?><?php $_smarty_tpl->tpl_vars["referenceListCount"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['referenceList']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=="19"){?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value=='1'){?><td></td><td></td></tr><tr><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php }?><?php }?></tr><tr><td class='fieldLabel col-lg-3'><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value!="reference"){?><label class="muted pull-right"><?php }?><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value=="reference"){?><?php if ($_smarty_tpl->tpl_vars['referenceListCount']->value>1){?><?php $_smarty_tpl->tpl_vars["DISPLAYID"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars["REFERENCED_MODULE_STRUCT"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getReferenceModule($_smarty_tpl->tpl_vars['DISPLAYID']->value), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value)){?><?php $_smarty_tpl->tpl_vars["REFERENCED_MODULE_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value->get('name'), null, 0);?><?php }?><span class="pull-right"><select style="width: 150px;" class="select2 referenceModulesList"><?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['referenceList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['value']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['value']->value==$_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value){?> selected <?php }?> ><?php echo vtranslate($_smarty_tpl->tpl_vars['value']->value,$_smarty_tpl->tpl_vars['value']->value);?>
</option><?php } ?></select></span><?php }else{ ?><label class="muted pull-right"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
 &nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?></label><?php }?><?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value!="reference"){?></label><?php }?></td><td class="fieldValue col-lg-9" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='19'){?> colspan="3" <?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?> <?php }?>><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td><?php } ?></tr></table></div></div><div class="modal-footer"><center><?php if ($_smarty_tpl->tpl_vars['BUTTON_NAME']->value!=null){?><?php $_smarty_tpl->tpl_vars['BUTTON_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BUTTON_NAME']->value, null, 0);?><?php }else{ ?><?php ob_start();?><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp5=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['BUTTON_LABEL'] = new Smarty_variable($_tmp5, null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars["CALENDAR_MODULE_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['QUICK_CREATE_CONTENTS']->value['Calendar']['moduleModel'], null, 0);?><?php $_smarty_tpl->tpl_vars["EDIT_VIEW_URL"] = new Smarty_variable($_smarty_tpl->tpl_vars['CALENDAR_MODULE_MODEL']->value->getCreateTaskRecordUrl(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Events'){?><?php $_smarty_tpl->tpl_vars["EDIT_VIEW_URL"] = new Smarty_variable($_smarty_tpl->tpl_vars['CALENDAR_MODULE_MODEL']->value->getCreateEventRecordUrl(), null, 0);?><?php }?><button class="btn btn-default" id="goToFullForm" data-edit-view-url="<?php echo $_smarty_tpl->tpl_vars['EDIT_VIEW_URL']->value;?>
" type="button"><strong><?php echo vtranslate('LBL_GO_TO_FULL_FORM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><button <?php if ($_smarty_tpl->tpl_vars['BUTTON_ID']->value!=null){?> id="<?php echo $_smarty_tpl->tpl_vars['BUTTON_ID']->value;?>
" <?php }?> class="btn btn-success" type="submit" name="saveButton"><strong><?php echo $_smarty_tpl->tpl_vars['BUTTON_LABEL']->value;?>
</strong></button><a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></form></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value!=null){?><script type="text/javascript">var quickcreate_uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type;}return false;}},};})();</script><?php }?></div>
<?php }} ?>