<?php /* Smarty version Smarty-3.1.7, created on 2018-12-17 11:16:22
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Picklist/PickListValueByRole.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21015274845c17544e069346-33734854%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1d47338d6fd6bc56a69788a9683850f1dfdd935' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Picklist/PickListValueByRole.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21015274845c17544e069346-33734854',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ALL_PICKLIST_VALUES' => 0,
    'PICKLIST_VALUE' => 0,
    'PICKLIST_KEY' => 0,
    'ROLE_PICKLIST_VALUES' => 0,
    'SELECTED_MODULE_NAME' => 0,
    'QUALIFIED_MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c17544e0bbd0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c17544e0bbd0')) {function content_5c17544e0bbd0($_smarty_tpl) {?>



<br><div class="row"><div class="form-group"><div class="control-label col-lg-2 col-md-2">&nbsp;</div><div class="controls col-lg-4 col-md-4"><select class="select2 form-control" id="role2picklist" multiple name="role2picklist[]"><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value;?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['ROLE_PICKLIST_VALUES']->value)){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</option><?php } ?></select></div></div></div><br><div class="row"><div class="form-group"><div class="control-label col-lg-2 col-md-2">&nbsp;</div><div class="controls col-lg-4 col-md-4"><button id="saveOrder" class="btn btn-success pull-right"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div></div><?php }} ?>