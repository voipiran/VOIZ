<?php /* Smarty version Smarty-3.1.7, created on 2018-12-17 11:16:27
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Picklist/EditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7443910775c175453739875-12808217%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ab011ac6d7833cf382feec817b6c906859c856c' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Picklist/EditView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7443910775c175453739875-12808217',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'SOURCE_MODULE' => 0,
    'FIELD_MODEL' => 0,
    'SELECTED_PICKLISTFIELD_EDITABLE_VALUES' => 0,
    'PICKLIST_VALUES' => 0,
    'FIELD_VALUE' => 0,
    'PICKLIST_VALUE' => 0,
    'PICKLIST_VALUE_KEY' => 0,
    'SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES' => 0,
    'NON_EDITABLE_VALUE' => 0,
    'NON_EDITABLE_VALUE_KEY' => 0,
    'FIELD_VALUE_ID' => 0,
    'qualifiedName' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c1754537cf14',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c1754537cf14')) {function content_5c1754537cf14($_smarty_tpl) {?>



<div class="modal-dialog"><div class='modal-content'><?php ob_start();?><?php echo vtranslate('LBL_EDIT_PICKLIST_ITEM',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable($_tmp1, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<form id="renameItemForm" class="form-horizontal" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><input type="hidden" name="action" value="SaveAjax" /><input type="hidden" name="mode" value="edit" /><input type="hidden" name="picklistName" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" /><input type="hidden" name="pickListValues" value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_EDITABLE_VALUES']->value));?>
' /><input type="hidden" name="picklistColorMap" value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode(Settings_Picklist_Module_Model::getPicklistColorMap($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'))));?>
' /><div class="modal-body tabbable"><div class="form-group"><div class="control-label col-sm-3 col-xs-3"><?php echo vtranslate('LBL_ITEM_TO_RENAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls col-sm-4 col-xs-4"><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_EDITABLE_VALUES']->value, null, 0);?><select class="select2 form-control" name="oldValue"><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value==$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){?> selected="" <?php }?>value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
" data-id=<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value;?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php } ?><?php if ($_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES']->value){?><?php  $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->key => $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->value){
$_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE_KEY']->value = $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->key;
?><option data-edit-disabled="true" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value==$_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->value){?> selected="" <?php }?>value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->value);?>
" data-id=<?php echo $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE_KEY']->value;?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php } ?><?php }?></select></div><br></div><div class="form-group"><div class="control-label col-sm-3 col-xs-3"><span class="redColor">*</span><?php echo vtranslate('LBL_ENTER_NEW_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls col-sm-4 col-xs-4"><input class="form-control" type="text"  name="renamedValue" <?php if (in_array($_smarty_tpl->tpl_vars['FIELD_VALUE']->value,$_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES']->value)){?> disabled='disabled' <?php }?> data-rule-required="true" value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['FIELD_VALUE']->value);?>
"></div></div><div class="form-group"><div class="control-label col-sm-3 col-xs-3"><?php echo vtranslate('LBL_SELECT_COLOR',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls col-sm-3 col-xs-3"><input type="hidden" name="selectedColor" value="<?php echo Settings_Picklist_Module_Model::getPicklistColor($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['FIELD_VALUE_ID']->value);?>
" /><div class="colorPicker"></div></div></div></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl',$_smarty_tpl->tpl_vars['qualifiedName']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div></div>
<?php }} ?>