<?php /* Smarty version Smarty-3.1.7, created on 2019-02-06 12:58:49
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/AdvanceFilterCondition.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6532534435c5aa8d102f154-95553743%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94f7f85a9cff1b73dd05c6f3ce1e4cf5f9c27cb1' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/AdvanceFilterCondition.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6532534435c5aa8d102f154-95553743',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'NOCHOSEN' => 0,
    'MODULE' => 0,
    'RECORD_STRUCTURE' => 0,
    'BLOCK_LABEL' => 0,
    'SOURCE_MODULE' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'COLUMNNAME_API' => 0,
    'columnNameApi' => 0,
    'FIELD_NAME' => 0,
    'CONDITION_INFO' => 0,
    'MODULE_MODEL' => 0,
    'PICKLIST_VALUES' => 0,
    'referenceList' => 0,
    'CURRENT_USER_MODEL' => 0,
    'ACCESSIBLE_USERS' => 0,
    'USER_NAME' => 0,
    'USERSLIST' => 0,
    'FIELD_INFO' => 0,
    'SPECIAL_VALIDATOR' => 0,
    'EVENT_RECORD_STRUCTURE' => 0,
    'FIELD_TYPE' => 0,
    'ADVANCED_FILTER_OPTIONS_BY_TYPE' => 0,
    'DATE_FILTERS' => 0,
    'ADVANCE_FILTER_OPTIONS' => 0,
    'DATE_FILTER_CONDITIONS' => 0,
    'ADVANCE_FILTER_OPTION' => 0,
    'ADVANCED_FILTER_OPTIONS' => 0,
    'SELECTED_FIELD_MODEL' => 0,
    'CONDITION' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5aa8d12826c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5aa8d12826c')) {function content_5c5aa8d12826c($_smarty_tpl) {?>	
<div class="row conditionRow"><div class="col-lg-4 col-md-4 col-sm-4"><select class="<?php if (empty($_smarty_tpl->tpl_vars['NOCHOSEN']->value)){?>select2<?php }?> col-lg-12" name="columnname"><option value="none"><?php echo vtranslate('LBL_SELECT_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
'><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule(), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['COLUMNNAME_API']->value)){?><?php $_smarty_tpl->tpl_vars['columnNameApi'] = new Smarty_variable($_smarty_tpl->tpl_vars['COLUMNNAME_API']->value, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['columnNameApi'] = new Smarty_variable('getCustomViewColumnName', null, 0);?><?php }?><option value="<?php $_tmp1=$_smarty_tpl->tpl_vars['columnNameApi']->value;?><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->$_tmp1();?>
" data-fieldtype="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"<?php $_tmp2=$_smarty_tpl->tpl_vars['columnNameApi']->value;?><?php if (decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->$_tmp2())==decode_html($_smarty_tpl->tpl_vars['CONDITION_INFO']->value['columnname'])){?><?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType(), null, 0);?><?php $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value, null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='reference'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='multireference'){?><?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable('V', null, 0);?><?php }?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['value'] = decode_html($_smarty_tpl->tpl_vars['CONDITION_INFO']->value['value']);?>selected="selected"<?php }?><?php if (($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=='Calendar'||$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=='Events')&&($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='recurringtype')){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable(Calendar_Field_Model::getReccurencePicklistValues(), null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;?><?php }?><?php if (($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=='Calendar')&&($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='activitytype')){?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues']['Task'] = vtranslate('Task','Calendar');?><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='reference'){?><?php $_smarty_tpl->tpl_vars['referenceList'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getWebserviceFieldObject()->getReferenceList(), null, 0);?><?php if (is_array($_smarty_tpl->tpl_vars['referenceList']->value)&&in_array('Users',$_smarty_tpl->tpl_vars['referenceList']->value)){?><?php $_smarty_tpl->tpl_vars['USERSLIST'] = new Smarty_variable(array(), null, 0);?><?php $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL'] = new Smarty_variable(Users_Record_Model::getCurrentUserModel(), null, 0);?><?php $_smarty_tpl->tpl_vars['ACCESSIBLE_USERS'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->getAccessibleUsers(), null, 0);?><?php  $_smarty_tpl->tpl_vars['USER_NAME'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['USER_NAME']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ACCESSIBLE_USERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['USER_NAME']->key => $_smarty_tpl->tpl_vars['USER_NAME']->value){
$_smarty_tpl->tpl_vars['USER_NAME']->_loop = true;
?><?php $_smarty_tpl->createLocalArrayVariable('USERSLIST', null, 0);
$_smarty_tpl->tpl_vars['USERSLIST']->value[$_smarty_tpl->tpl_vars['USER_NAME']->value] = $_smarty_tpl->tpl_vars['USER_NAME']->value;?><?php } ?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['USERSLIST']->value;?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['type'] = 'picklist';?><?php }?><?php }?>data-fieldinfo='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value));?>
'<?php if (!empty($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value)){?>data-validator='<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['SPECIAL_VALIDATOR']->value);?>
'<?php }?>><?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value!=$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')){?>(<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
) <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<?php }?></option><?php } ?></optgroup><?php } ?><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['EVENT_RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,'Events');?>
'><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule(), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['COLUMNNAME_API']->value)){?><?php $_smarty_tpl->tpl_vars['columnNameApi'] = new Smarty_variable($_smarty_tpl->tpl_vars['COLUMNNAME_API']->value, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['columnNameApi'] = new Smarty_variable('getCustomViewColumnName', null, 0);?><?php }?><option value="<?php $_tmp3=$_smarty_tpl->tpl_vars['columnNameApi']->value;?><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->$_tmp3();?>
" data-fieldtype="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"<?php $_tmp4=$_smarty_tpl->tpl_vars['columnNameApi']->value;?><?php if (decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->$_tmp4())==$_smarty_tpl->tpl_vars['CONDITION_INFO']->value['columnname']){?><?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldType(), null, 0);?><?php $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value, null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='reference'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='multireference'){?><?php $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_variable('V', null, 0);?><?php }?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['value'] = decode_html($_smarty_tpl->tpl_vars['CONDITION_INFO']->value['value']);?>selected="selected"<?php }?><?php if (($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=='Calendar'||$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')=='Events')&&($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='recurringtype')){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable(Calendar_Field_Model::getReccurencePicklistValues(), null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value;?><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='reference'){?><?php $_smarty_tpl->tpl_vars['referenceList'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getWebserviceFieldObject()->getReferenceList(), null, 0);?><?php if (is_array($_smarty_tpl->tpl_vars['referenceList']->value)&&in_array('Users',$_smarty_tpl->tpl_vars['referenceList']->value)){?><?php $_smarty_tpl->tpl_vars['USERSLIST'] = new Smarty_variable(array(), null, 0);?><?php $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL'] = new Smarty_variable(Users_Record_Model::getCurrentUserModel(), null, 0);?><?php $_smarty_tpl->tpl_vars['ACCESSIBLE_USERS'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->getAccessibleUsers(), null, 0);?><?php  $_smarty_tpl->tpl_vars['USER_NAME'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['USER_NAME']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ACCESSIBLE_USERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['USER_NAME']->key => $_smarty_tpl->tpl_vars['USER_NAME']->value){
$_smarty_tpl->tpl_vars['USER_NAME']->_loop = true;
?><?php $_smarty_tpl->createLocalArrayVariable('USERSLIST', null, 0);
$_smarty_tpl->tpl_vars['USERSLIST']->value[$_smarty_tpl->tpl_vars['USER_NAME']->value] = $_smarty_tpl->tpl_vars['USER_NAME']->value;?><?php } ?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'] = $_smarty_tpl->tpl_vars['USERSLIST']->value;?><?php $_smarty_tpl->createLocalArrayVariable('FIELD_INFO', null, 0);
$_smarty_tpl->tpl_vars['FIELD_INFO']->value['type'] = 'picklist';?><?php }?><?php }?>data-fieldinfo='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value));?>
' ><?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value!=$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')){?>(<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
)  <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<?php }?></option><?php } ?></optgroup><?php } ?></select></div><div class="conditionComparator col-lg-3 col-md-3 col-sm-3"><select class="<?php if (empty($_smarty_tpl->tpl_vars['NOCHOSEN']->value)){?>select2<?php }?> col-lg-12" name="comparator"><option value="none"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTIONS'] = new Smarty_variable($_smarty_tpl->tpl_vars['ADVANCED_FILTER_OPTIONS_BY_TYPE']->value[$_smarty_tpl->tpl_vars['FIELD_TYPE']->value], null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_TYPE']->value=='D'||$_smarty_tpl->tpl_vars['FIELD_TYPE']->value=='DT'){?><?php $_smarty_tpl->tpl_vars['DATE_FILTER_CONDITIONS'] = new Smarty_variable(array_keys($_smarty_tpl->tpl_vars['DATE_FILTERS']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTIONS'] = new Smarty_variable(array_merge($_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTIONS']->value,$_smarty_tpl->tpl_vars['DATE_FILTER_CONDITIONS']->value), null, 0);?><?php }?><?php  $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->key => $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value){
$_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value==$_smarty_tpl->tpl_vars['CONDITION_INFO']->value['comparator']){?>selected<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['ADVANCED_FILTER_OPTIONS']->value[$_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value]);?>
</option><?php } ?></select></div><div class="col-lg-4 col-md-4 col-sm-4  fieldUiHolder"><input name="<?php if ($_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value){?><?php echo $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODEL']->value->get('name');?>
<?php }?>" data-value="value" class=" inputElement col-lg-12" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['CONDITION_INFO']->value['value'], ENT_QUOTES, 'UTF-8', true);?>
" /></div><span class="hide"><!-- TODO : see if you need to respect CONDITION_INFO condition or / and  --><?php if (empty($_smarty_tpl->tpl_vars['CONDITION']->value)){?><?php $_smarty_tpl->tpl_vars['CONDITION'] = new Smarty_variable("and", null, 0);?><?php }?><input type="hidden" name="column_condition" value="<?php echo $_smarty_tpl->tpl_vars['CONDITION']->value;?>
" /></span><div class="col-lg-1 col-md-1 col-sm-1"><i class="deleteCondition glyphicon glyphicon-trash cursorPointer" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></div></div><?php }} ?>