<?php /* Smarty version Smarty-3.1.7, created on 2018-03-28 06:59:47
         compiled from "/var/www/vtigercrm/includes/runtime/../../layouts/v7/modules/Vtiger/uitypes/Reference.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8295069945abb3d631fe789-13407082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82b76fc29fb5c7d5b051c92e23573301f59f90fe' => 
    array (
      0 => '/var/www/vtigercrm/includes/runtime/../../layouts/v7/modules/Vtiger/uitypes/Reference.tpl',
      1 => 1520586669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8295069945abb3d631fe789-13407082',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'REFERENCE_LIST' => 0,
    'FIELD_VALUE' => 0,
    'REFERENCE_LIST_COUNT' => 0,
    'DISPLAYID' => 0,
    'REFERENCED_MODULE_STRUCT' => 0,
    'REFERENCED_MODULE_NAME' => 0,
    'AUTOFILL_VALUE' => 0,
    'FIELD_NAME' => 0,
    'displayId' => 0,
    'MODULE' => 0,
    'FIELD_INFO' => 0,
    'MODULE_NAME' => 0,
    'QUICKCREATE_RESTRICTED_MODULES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5abb3d6336b5f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5abb3d6336b5f')) {function content_5abb3d6336b5f($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["FIELD_INFO"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars["REFERENCE_LIST"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getReferenceList(), null, 0);?><?php $_smarty_tpl->tpl_vars["REFERENCE_LIST_COUNT"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['REFERENCE_LIST']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["SPECIAL_VALIDATOR"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getValidator(), null, 0);?><?php $_smarty_tpl->tpl_vars["AUTOFILL_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getAutoFillValue(), null, 0);?><?php $_smarty_tpl->tpl_vars["QUICKCREATE_RESTRICTED_MODULES"] = new Smarty_variable(Vtiger_Functions::getNonQuickCreateSupportedModules(), null, 0);?><div class="referencefield-wrapper <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value!=0){?> selected <?php }?>"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['REFERENCE_LIST_COUNT']->value;?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1==1){?><input name="popupReferenceModule" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['REFERENCE_LIST']->value[0];?>
"/><?php }?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['REFERENCE_LIST_COUNT']->value;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2>1){?><?php $_smarty_tpl->tpl_vars["DISPLAYID"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars["REFERENCED_MODULE_STRUCT"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getReferenceModule($_smarty_tpl->tpl_vars['DISPLAYID']->value), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value)){?><?php $_smarty_tpl->tpl_vars["REFERENCED_MODULE_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value->get('name'), null, 0);?><?php }?><?php if (in_array($_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['REFERENCE_LIST']->value)){?><input name="popupReferenceModule" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value;?>
" /><?php }else{ ?><input name="popupReferenceModule" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['REFERENCE_LIST']->value[0];?>
" /><?php }?><?php }?><?php $_smarty_tpl->tpl_vars["displayId"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_VALUE']->value, null, 0);?><div class="input-group"><input name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" class="sourceField" data-displayvalue='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
' <?php if ($_smarty_tpl->tpl_vars['AUTOFILL_VALUE']->value){?> data-autofill=<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['AUTOFILL_VALUE']->value);?>
 <?php }?>/><input id="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_display" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
_display" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" data-fieldtype="reference" type="text"class="marginLeftZero autoComplete inputElement"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['displayId']->value);?>
"placeholder="<?php echo vtranslate('LBL_TYPE_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"<?php if ($_smarty_tpl->tpl_vars['displayId']->value!=0){?>disabled="disabled"<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value["mandatory"]==true){?> data-rule-required="true" data-rule-reference_required="true" <?php }?><?php if (count($_smarty_tpl->tpl_vars['FIELD_INFO']->value['validator'])){?>data-specific-rules='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value["validator"]);?>
'<?php }?>/><a href="#" class="clearReferenceSelection <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value==0){?>hide<?php }?>"> x </a><span class="input-group-addon relatedPopup cursorPointer" title="<?php echo vtranslate('LBL_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_select" class="fa fa-search"></i></span></div><?php if ((($_REQUEST['view']=='Edit')||($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Webforms'))&&!in_array($_smarty_tpl->tpl_vars['REFERENCE_LIST']->value[0],$_smarty_tpl->tpl_vars['QUICKCREATE_RESTRICTED_MODULES']->value)){?><span class="createReferenceRecord cursorPointer clearfix" title="<?php echo vtranslate('LBL_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_editView_fieldName_<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
_create" class="fa fa-plus"></i></span><?php }?></div><?php }} ?>