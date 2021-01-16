<?php /* Smarty version Smarty-3.1.7, created on 2019-03-25 12:32:24
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Workflows/Tasks/VTUpdateFieldsTask.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8668286655c988b10831405-91910047%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c3a8b83c689ee6e6e749446030e842040c0352d' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Workflows/Tasks/VTUpdateFieldsTask.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8668286655c988b10831405-91910047',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'TASK_OBJECT' => 0,
    'FIELD_VALUE_MAPPING' => 0,
    'RECORD_STRUCTURE' => 0,
    'FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'MODULE_MODEL' => 0,
    'RESTRICTFIELDS' => 0,
    'FIELD_MAP' => 0,
    'FIELD_MODULE_MODEL' => 0,
    'FIELD_NAME' => 0,
    'PICKLIST_VALUES' => 0,
    'FIELD_INFO' => 0,
    'SOURCE_MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c988b10937f1',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c988b10937f1')) {function content_5c988b10937f1($_smarty_tpl) {?>
<div class="row"><div class="col-sm-2 col-xs-2"><strong><?php echo vtranslate('LBL_SET_FIELD_VALUES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div></div><br><div><button type="button" class="btn btn-default" id="addFieldBtn"><?php echo vtranslate('LBL_ADD_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div><br><div class="conditionsContainer" id="save_fieldvaluemapping" style="margin-bottom: 70px;"><?php $_smarty_tpl->tpl_vars['FIELD_VALUE_MAPPING'] = new Smarty_variable(ZEND_JSON::decode($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->field_value_mapping), null, 0);?><input type="hidden" id="fieldValueMapping" name="field_value_mapping" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->field_value_mapping);?>
' /><?php  $_smarty_tpl->tpl_vars['FIELD_MAP'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MAP']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELD_VALUE_MAPPING']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MAP']->key => $_smarty_tpl->tpl_vars['FIELD_MAP']->value){
$_smarty_tpl->tpl_vars['FIELD_MAP']->_loop = true;
?><div class="row conditionRow" style="margin-bottom: 15px;"><div class="cursorPointer col-sm-1 col-xs-1"><center> <i class="alignMiddle deleteCondition fa fa-trash" style="position: relative; top: 4px;"></i> </center></div><div class="col-sm-3 col-xs-3"><select name="fieldname" class="select2" style="min-width: 250px" data-placeholder="<?php echo vtranslate('LBL_SELECT_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><option></option><?php  $_smarty_tpl->tpl_vars['FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS']->key => $_smarty_tpl->tpl_vars['FIELDS']->value){
$_smarty_tpl->tpl_vars['FIELDS']->_loop = true;
?><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
?><?php if ((!($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('workflow_fieldEditable')==true))||($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=="Documents"&&in_array($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['RESTRICTFIELDS']->value))){?><?php continue 1?><?php }?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName(), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_MODULE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule(), null, 0);?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('workflow_columnname');?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_MAP']->value['fieldname']==$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('workflow_columnname')){?>selected=""<?php }?>data-fieldtype="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
"<?php if (($_smarty_tpl->tpl_vars['FIELD_MODULE_MODEL']->value->get('name')=='Events')&&($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='recurringtype')){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable(Calendar_Field_Model::getReccurencePicklistValues(), null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;?><?php }?>data-fieldinfo='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['FIELD_INFO']->value);?>
' ><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('workflow_columnlabel'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php } ?><?php } ?></select></div><div class="fieldUiHolder col-sm-4 col-xs-4"><input type="text" class="getPopupUi inputElement" readonly="" name="fieldValue" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MAP']->value['value'];?>
" /><input type="hidden" name="valuetype" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MAP']->value['valuetype'];?>
" /></div></div><?php } ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("FieldExpressions.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><br><div class="row basicAddFieldContainer hide" style="margin-bottom: 15px;"><div class="cursorPointer col-sm-1 col-xs-1"><center> <i class="alignMiddle deleteCondition fa fa-trash" style="position: relative; top: 4px;"></i> </center></div><div class="col-sm-3 col-xs-3"><select name="fieldname" data-placeholder="<?php echo vtranslate('LBL_SELECT_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="min-width: 250px"><option></option><?php  $_smarty_tpl->tpl_vars['FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS']->key => $_smarty_tpl->tpl_vars['FIELDS']->value){
$_smarty_tpl->tpl_vars['FIELDS']->_loop = true;
?><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
?><?php if ((!($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('workflow_fieldEditable')==true))||($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=="Documents"&&in_array($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['RESTRICTFIELDS']->value))){?><?php continue 1?><?php }?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName(), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_MODULE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule(), null, 0);?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('workflow_columnname');?>
" data-fieldtype="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
"<?php if (($_smarty_tpl->tpl_vars['FIELD_MODULE_MODEL']->value->get('name')=='Events')&&($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='recurringtype')){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable(Calendar_Field_Model::getReccurencePicklistValues(), null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;?><?php }?>data-fieldinfo='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['FIELD_INFO']->value);?>
' ><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('workflow_columnlabel'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php } ?><?php } ?></select></div><div class="fieldUiHolder col-sm-4 col-xs-4"><input type="text" class="inputElement" readonly="" name="fieldValue" value="" /><input type="hidden" name="valuetype" value="rawtext" /></div></div>
<?php }} ?>