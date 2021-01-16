<?php /* Smarty version Smarty-3.1.7, created on 2019-02-05 10:39:08
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Picklist/DeleteView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2119466455c593694edbbf9-90869464%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49a3ebbba324432cc4a512a3e3c6e71dca113a03' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Picklist/DeleteView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2119466455c593694edbbf9-90869464',
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
    'PICKLIST_VALUE' => 0,
    'FIELD_VALUES' => 0,
    'PICKLIST_VALUE_KEY' => 0,
    'SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES' => 0,
    'NON_EDITABLE_VALUE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c59369508266',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c59369508266')) {function content_5c59369508266($_smarty_tpl) {?>



<div class="modal-dialog"><div class='modal-content'><?php ob_start();?><?php echo vtranslate('LBL_DELETE_PICKLIST_ITEMS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable($_tmp1, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<form id="deleteItemForm" class="form-horizontal" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><input type="hidden" name="action" value="SaveAjax" /><input type="hidden" name="mode" value="remove" /><input type="hidden" name="picklistName" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" /><div class="modal-body tabbable"><div class="form-group"><div class="control-label col-sm-3 col-xs-3"><?php echo vtranslate('LBL_ITEMS_TO_DELETE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls col-sm-4 col-xs-4"><select class="select2 form-control" multiple="" id="deleteValue" name="delete_value[]" ><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_EDITABLE_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option <?php if (in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['FIELD_VALUES']->value)){?> selected="" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php } ?></select><input id="pickListValuesCount" type="hidden" value="<?php echo count($_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_EDITABLE_VALUES']->value)+count($_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES']->value);?>
"/></div></div><br><div class="form-group"><div class="control-label col-sm-3 col-xs-3"><?php echo vtranslate('LBL_REPLACE_IT_WITH',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls  col-sm-4 col-xs-4"><select id="replaceValue" name="replace_value" class="select2 form-control" data-validation-engine="validate[required]"><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_EDITABLE_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><?php if (!(in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['FIELD_VALUES']->value))){?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php }?><?php } ?><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><?php if (!(in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['FIELD_VALUES']->value))){?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</option><?php }?><?php } ?></select></div></div><?php if ($_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES']->value){?><br><div class="form-group"><div class="control-label col-sm-3 col-xs-3"><?php echo vtranslate('LBL_NON_EDITABLE_PICKLIST_VALUES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div class="controls col-sm-4 col-xs-4 nonEditableValuesDiv"><ul class="nonEditablePicklistValues" style="list-style-type: none;"><?php  $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_NON_EDITABLE_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->key => $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->value){
$_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE_KEY']->value = $_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->key;
?><li><?php echo vtranslate($_smarty_tpl->tpl_vars['NON_EDITABLE_VALUE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</li><?php } ?></ul></div></div><?php }?></div><div class="modal-footer"><center><button class="btn btn-danger" type="submit" name="saveButton"><strong><?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></form></div></div>
<?php }} ?>