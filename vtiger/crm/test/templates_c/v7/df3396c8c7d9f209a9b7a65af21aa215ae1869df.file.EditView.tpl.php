<?php /* Smarty version Smarty-3.1.7, created on 2018-11-28 12:15:05
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/PickListDependency/EditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12017642355bfe5591ce6e38-88771035%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df3396c8c7d9f209a9b7a65af21aa215ae1869df' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/PickListDependency/EditView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12017642355bfe5591ce6e38-88771035',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MAPPED_VALUES' => 0,
    'QUALIFIED_MODULE' => 0,
    'PICKLIST_MODULES_LIST' => 0,
    'MODULE_MODEL' => 0,
    'MODULE_NAME' => 0,
    'SELECTED_MODULE' => 0,
    'PICKLIST_FIELDS' => 0,
    'FIELD_NAME' => 0,
    'RECORD_MODEL' => 0,
    'FIELD_LABEL' => 0,
    'DEPENDENCY_GRAPH' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfe5591d8991',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfe5591d8991')) {function content_5bfe5591d8991($_smarty_tpl) {?>



<div class="editViewPageDiv"><div class="col-sm-12 col-xs-12"><div class="editViewContainer container-fluid"><br><form id="pickListDependencyForm" class="form-horizontal" method="POST"><?php if (!empty($_smarty_tpl->tpl_vars['MAPPED_VALUES']->value)){?><input type="hidden" class="editDependency" value="true"/><?php }?><div class="editViewBody"><div class="editViewContents"><div class="form-group"><label class="muted control-label col-sm-2 col-xs-2"><?php echo vtranslate('LBL_SELECT_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls col-sm-3 col-xs-3"><select name="sourceModule" class="select2 form-control marginLeftZero"><?php  $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_MODULES_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'), null, 0);?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value==$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value){?> selected <?php }?>><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('label')=='Calendar'){?><?php echo vtranslate('LBL_TASK',$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('label'));?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('label'));?>
<?php }?></option><?php } ?></select></div></div><div class="form-group"><label class="muted control-label col-sm-2 col-xs-2"><?php echo vtranslate('LBL_SOURCE_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls col-sm-3 col-xs-3"><select id="sourceField" name="sourceField" class="select2 form-control" data-placeholder="<?php echo vtranslate('LBL_SELECT_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-rule-required="true"><option value=''></option><?php  $_smarty_tpl->tpl_vars['FIELD_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_LABEL']->key => $_smarty_tpl->tpl_vars['FIELD_LABEL']->value){
$_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('sourcefield')==$_smarty_tpl->tpl_vars['FIELD_NAME']->value){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value);?>
</option><?php } ?></select></div></div><div class="form-group"><label class="muted control-label col-sm-2 col-xs-2"><?php echo vtranslate('LBL_TARGET_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls col-sm-3 col-xs-3"><select id="targetField" name="targetField" class="select2 form-control" data-placeholder="<?php echo vtranslate('LBL_SELECT_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-rule-required="true"><option value=''></option><?php  $_smarty_tpl->tpl_vars['FIELD_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_LABEL']->key => $_smarty_tpl->tpl_vars['FIELD_LABEL']->value){
$_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('targetfield')==$_smarty_tpl->tpl_vars['FIELD_NAME']->value){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value);?>
</option><?php } ?></select></div></div><div class="row hide errorMessage" style="margin: 5px;"><div class="alert alert-error"><strong><?php echo vtranslate('LBL_ERR_CYCLIC_DEPENDENCY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></div></div><br><div id="dependencyGraph"><?php if ($_smarty_tpl->tpl_vars['DEPENDENCY_GRAPH']->value){?><div class="row"><div class="col-sm-12 col-xs-12"><?php echo $_smarty_tpl->tpl_vars['DEPENDENCY_GRAPH']->value;?>
</div></div><?php }?></div></div></div><div class='modal-overlay-footer clearfix'><div class="row clearfix"><div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink'  href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div></div></div>
<?php }} ?>