<?php /* Smarty version Smarty-3.1.7, created on 2018-11-28 12:30:11
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Workflows/AdvanceFilterCondition.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18950603935bfe591b695182-61218135%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7cbb57c8a8d917ab79bd201566dba22a371e5ea0' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Workflows/AdvanceFilterCondition.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18950603935bfe591b695182-61218135',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'NOCHOSEN' => 0,
    'QUALIFIED_MODULE' => 0,
    'RECORD_STRUCTURE' => 0,
    'BLOCK_LABEL' => 0,
    'SELECTED_MODULE_NAME' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'COLUMNNAME_API' => 0,
    'columnNameApi' => 0,
    'FIELD_NAME' => 0,
    'CONDITION_INFO' => 0,
    'MODULE_MODEL' => 0,
    'PICKLIST_VALUES' => 0,
    'FIELD_INFO' => 0,
    'SPECIAL_VALIDATOR' => 0,
    'MODULE' => 0,
    'FIELD_TYPE' => 0,
    'ADVANCED_FILTER_OPTIONS_BY_TYPE' => 0,
    'ADVANCE_FILTER_OPTIONS' => 0,
    'ADVANCE_FILTER_OPTION' => 0,
    'ADVANCED_FILTER_OPTIONS' => 0,
    'SELECTED_FIELD_MODEL' => 0,
    'CONDITION' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfe591b76d7a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfe591b76d7a')) {function content_5bfe591b76d7a($_smarty_tpl) {?>
<div class="row conditionRow" style="margin-bottom: 10px;"><span class="col-lg-4 col-md-4 col-sm-4"><select class="<?php if (empty($_smarty_tpl->tpl_vars['NOCHOSEN']->value)){?>select2<?php }?> col-lg-12" name="columnname" data-placeholder="<?php echo vtranslate('LBL_SELECT_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><option value="none"></option><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
'><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule(), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['COLUMNNAME_API']->value)){?><?php $_smarty_tpl->tpl_vars['columnNameApi'] = new Smarty_variable($_smarty_tpl->tpl_vars['COLUMNNAME_API']->value, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['columnNameApi'] = new Smarty_variable('getCustomViewColumnName', null, 0);?><?php }?><option value="<?php $_tmp1=$_smarty_tpl->tpl_vars['columnNameApi']->value;?><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->$_tmp1();?>
" data-fieldtype="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"<?php $_tmp2=$_smarty_tpl->tpl_vars['columnNameApi']->value;?><?php if (decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->$_tmp2())==$_smarty_tpl->tpl_vars['CONDITION_INFO']->value['columnname']){?><?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType(), null, 0);?><?php $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value, null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['value'] = decode_html($_smarty_tpl->tpl_vars['CONDITION_INFO']->value['value']);?>selected="selected"<?php }?><?php if (($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=='Events')&&($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='recurringtype')){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable(Calendar_Field_Model::getReccurencePicklistValues(), null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;?><?php }?><?php if (($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=='Documents')&&($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='filelocationtype'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='folderid'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='filename')){?><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='filelocationtype'){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFileLocationType(), null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['type'] = 'picklist';?><?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable('picklist', null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='folderid'){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDocumentFolders(), null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['type'] = 'picklist';?><?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable('picklist', null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='filename'){?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['type'] = 'string';?><?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable('string', null, 0);?><?php }?><?php }?>data-fieldinfo='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value));?>
'<?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)){?>data-validator='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
'<?php }?>><?php if ($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value!=$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')){?>(<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
)  <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
<?php }?></option><?php } ?></optgroup><?php } ?></select></span><span class="conditionComparator col-lg-3 col-md-3 col-sm-3"><select class="<?php if (empty($_smarty_tpl->tpl_vars['NOCHOSEN']->value)){?>select2<?php }?> col-lg-12" name="comparator" data-placeholder="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><option value="none"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTIONS'] = new Smarty_variable($_smarty_tpl->tpl_vars['ADVANCED_FILTER_OPTIONS_BY_TYPE']->value[$_smarty_tpl->tpl_vars['FIELD_TYPE']->value], null, 0);?><?php  $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->key => $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value){
$_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value==$_smarty_tpl->tpl_vars['CONDITION_INFO']->value['comparator']){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['ADVANCED_FILTER_OPTIONS']->value[$_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value]);?>
</option><?php } ?></select></span><span class="col-lg-4 col-md-4 col-sm-4  fieldUiHolder"><input name="<?php if ($_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value){?><?php echo $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value->get('name');?>
<?php }?>" data-value="value" class="inputElement col-lg-12" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['CONDITION_INFO']->value['value'], ENT_QUOTES, 'UTF-8', true);?>
" /></span><span class="hide"><!-- TODO : see if you need to respect CONDITION_INFO condition or / and  --><?php if (empty($_smarty_tpl->tpl_vars['CONDITION']->value)){?><?php $_smarty_tpl->tpl_vars['CONDITION'] = new Smarty_variable("and", null, 0);?><?php }?><input type="hidden" name="column_condition" value="<?php echo $_smarty_tpl->tpl_vars['CONDITION']->value;?>
" /></span><span class="col-lg-1" style="line-height: 30px;"><i class="deleteCondition glyphicon glyphicon-trash cursorPointer" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></span></div><?php }} ?>