<?php /* Smarty version Smarty-3.1.7, created on 2018-06-18 09:27:38
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Picklist/PickListValueDetail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:620053695b273bc2b5f180-45108595%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ed053ebe3278a190ad298246f921e8bd6d5177e' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Picklist/PickListValueDetail.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '620053695b273bc2b5f180-45108595',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SELECTED_PICKLIST_FIELDMODEL' => 0,
    'PICKLIST_COLOR_MAP' => 0,
    'PICKLIST_COLOR' => 0,
    'PICKLIST_KEY_ID' => 0,
    'PICKLIST_TEXT_COLOR' => 0,
    'QUALIFIED_MODULE' => 0,
    'SELECTED_MODULE_NAME' => 0,
    'SELECTED_PICKLISTFIELD_ALL_VALUES' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_KEY' => 0,
    'PICKLIST_VALUE' => 0,
    'NON_DELETABLE_VALUES' => 0,
    'ROLES_LIST' => 0,
    'ROLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5b273bc2be49a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b273bc2be49a')) {function content_5b273bc2be49a($_smarty_tpl) {?>



<?php $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP'] = new Smarty_variable(Settings_Picklist_Module_Model::getPicklistColorMap($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getName()), null, 0);?><style type="text/css"><?php  $_smarty_tpl->tpl_vars['PICKLIST_COLOR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->key => $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value){
$_smarty_tpl->tpl_vars['PICKLIST_COLOR']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY_ID']->value = $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->key;
?><?php $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR'] = new Smarty_variable(Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value), null, 0);?>.picklist-<?php echo $_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getId();?>
-<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY_ID']->value;?>
 {background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
;color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR']->value;?>
;}<?php } ?></style><?php $_smarty_tpl->tpl_vars['NON_DELETABLE_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getNonEditablePicklistValues($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getName()), null, 0);?><ul class="nav nav-tabs massEditTabs" style="margin-bottom: 0;"><li class="active"><a href="#allValuesLayout" data-toggle="tab"><strong><?php echo vtranslate('LBL_ALL_VALUES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><?php if ($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->isRoleBased()){?><li id="assignedToRoleTab"><a href="#AssignedToRoleLayout" data-toggle="tab"><strong><?php echo vtranslate('LBL_VALUES_ASSIGNED_TO_A_ROLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><?php }?></ul><div class="tab-content layoutContent padding20 themeTableColor overflowVisible"><br><div class="tab-pane active" id="allValuesLayout"><div class="row"><div class="col-lg-2 col-md-2 col-sm-2"></div><div class="col-lg-8 col-md-8 col-sm-8"><table id="pickListValuesTable" class="table table-bordered" style="table-layout: fixed"><thead><tr class="listViewHeaders bgColor"><th><span><?php echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
&nbsp;<?php echo vtranslate('LBL_ITEMS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><button class="btn pull-right btn-default marginLeftZero" id="addItem"><i class="fa fa-plus"></i>&nbsp;<?php echo vtranslate('LBL_ADD_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><br><br></th></tr></thead><tbody><tr><td><!-- Placeholder role to allow drag-and-drop for last elements --></td></tr><input type="hidden" id="dragImagePath" value="<?php echo vimage_path('drag.png');?>
" /><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_ALL_VALUES']->value, null, 0);?><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><tr class="pickListValue" data-key-id="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
" data-key="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
" data-deletable="<?php if (!in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['NON_DELETABLE_VALUES']->value)){?>true<?php }else{ ?>false<?php }?>"><td class="textOverflowEllipsis fieldPropertyContainer"><span class="pull-left"><img class="cursorDrag alignMiddle" src="<?php echo vimage_path('drag.png');?>
"/> &nbsp;&nbsp;<span class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getId();?>
-<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
"> <?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
 </span></span><span class="pull-right picklistActions" style='margin-top:0px;'><a  title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"  class="renameItem"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;<?php if (!in_array($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['NON_DELETABLE_VALUES']->value)){?><a  title="<?php echo vtranslate('LBL_DELETE_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" class="deleteItem"><i class="fa fa-trash-o"></i></a><?php }?></span></td></tr><?php } ?></tbody><span class="picklistActionsTemplate hide"><a  title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"  class="renameItem"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;<a  title="<?php echo vtranslate('LBL_DELETE_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" class="deleteItem"><i class="fa fa-trash-o"></i></a></span></table></div></div><div id="createViewContents" style="display: none;"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("CreateView.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><br><?php if ($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->isRoleBased()){?><div class="tab-pane form-horizontal row" id="AssignedToRoleLayout"><div class="col-lg-2 col-md-2 col-sm-2"></div><div class="col-lg-10 col-md-10 col-sm-10"><div class="form-group row"><label class="control-label col-lg-2 col-md-2 col-sm-2"><?php echo vtranslate('LBL_ROLE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls col-lg-4 col-md-4 col-sm-4"><select id="rolesList" class="select2 inputElement" name="rolesSelected"  data-placeholder="<?php echo vtranslate('LBL_CHOOSE_ROLES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php  $_smarty_tpl->tpl_vars['ROLE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ROLE']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ROLES_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ROLE']->key => $_smarty_tpl->tpl_vars['ROLE']->value){
$_smarty_tpl->tpl_vars['ROLE']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ROLE']->value->get('roleid');?>
"><?php echo $_smarty_tpl->tpl_vars['ROLE']->value->get('rolename');?>
</option><?php } ?></select></div></div><div id="pickListValeByRoleContainer" class="col-lg-12 col-md-12 col-sm-12"></div></div></div><?php }?></div>
<?php }} ?>