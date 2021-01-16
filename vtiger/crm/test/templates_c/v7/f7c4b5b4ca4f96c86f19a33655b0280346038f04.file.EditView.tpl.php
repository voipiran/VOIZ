<?php /* Smarty version Smarty-3.1.7, created on 2019-02-06 12:49:05
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Groups/EditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6170285665c5aa689d1df08-74661533%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7c4b5b4ca4f96c86f19a33655b0280346038f04' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Groups/EditView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6170285665c5aa689d1df08-74661533',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RECORD_MODEL' => 0,
    'MODE' => 0,
    'MODULE' => 0,
    'QUALIFIED_MODULE' => 0,
    'MEMBER_GROUPS' => 0,
    'GROUP_LABEL' => 0,
    'ALL_GROUP_MEMBERS' => 0,
    'MEMBER' => 0,
    'GROUP_MEMBERS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5aa689e037e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5aa689e037e')) {function content_5c5aa689e037e($_smarty_tpl) {?>


<div class="editViewPageDiv"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="editViewContainer"><form name="EditGroup" action="index.php" method="post" id="EditView" class="form-horizontal"><input type="hidden" name="module" value="Groups"><input type="hidden" name="action" value="Save"><input type="hidden" name="parent" value="Settings"><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId();?>
"><input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
"><h4><?php if (!empty($_smarty_tpl->tpl_vars['MODE']->value)){?><?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
<?php }else{ ?><?php echo vtranslate('LBL_CREATING_NEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?></h4><hr><br><div class="editViewBody"><div class="form-group row"><label class="col-lg-3 col-md-3 col-sm-3 fieldLabel control-label"><?php echo vtranslate('LBL_GROUP_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label><div class="fieldValue col-lg-9 col-md-9 col-sm-9"><div class="row"><div class="col-lg-6 col-md-6 col-sm-12"><input class="inputElement" type="text" name="groupname" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
" data-rule-required="true"></div></div></div></div><div class="form-group row"><label class="col-lg-3 col-md-3 col-sm-3 fieldLabel control-label"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="fieldValue col-lg-9 col-md-9 col-sm-9"><div class="row"><div class="col-lg-6 col-md-6 col-sm-12"><input class="inputElement" type="text" name="description" id="description" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getDescription();?>
" /></div></div></div></div><div class="form-group row"><label class="col-lg-3 col-md-3 col-sm-3 fieldLabel control-label"><?php echo vtranslate('LBL_GROUP_MEMBERS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label><div class="fieldValue col-lg-9 col-md-9 col-sm-9"><div class="row"><?php $_smarty_tpl->tpl_vars["GROUP_MEMBERS"] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getMembers(), null, 0);?><div class="col-lg-6 col-md-6 col-sm-6"><select id="memberList" class="select2 inputElement" multiple="true" name="members[]" data-rule-required="true" data-placeholder="<?php echo vtranslate('LBL_ADD_USERS_ROLES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" ><?php  $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->_loop = false;
 $_smarty_tpl->tpl_vars['GROUP_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MEMBER_GROUPS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->key => $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value){
$_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->_loop = true;
 $_smarty_tpl->tpl_vars['GROUP_LABEL']->value = $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->key;
?><optgroup label="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['GROUP_LABEL']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo vtranslate($_tmp1,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" class="<?php echo $_smarty_tpl->tpl_vars['GROUP_LABEL']->value;?>
"><?php  $_smarty_tpl->tpl_vars['MEMBER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MEMBER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MEMBER']->key => $_smarty_tpl->tpl_vars['MEMBER']->value){
$_smarty_tpl->tpl_vars['MEMBER']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['MEMBER']->value->getName()!=$_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName()){?><option value="<?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getId();?>
" data-member-type="<?php echo $_smarty_tpl->tpl_vars['GROUP_LABEL']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['GROUP_MEMBERS']->value[$_smarty_tpl->tpl_vars['GROUP_LABEL']->value][$_smarty_tpl->tpl_vars['MEMBER']->value->getId()])){?> selected="true"<?php }?>><?php echo trim($_smarty_tpl->tpl_vars['MEMBER']->value->getName());?>
</option><?php }?><?php } ?></optgroup><?php } ?></select></div><div class="groupMembersColors col-lg-3 col-md-3 col-sm-6"><ul class="liStyleNone"><li class="Users textAlignCenter"><?php echo vtranslate('LBL_USERS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li><li class="Groups textAlignCenter"><?php echo vtranslate('LBL_GROUPS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li><li class="Roles textAlignCenter"><?php echo vtranslate('LBL_ROLES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li><li class="RoleAndSubordinates textAlignCenter"><?php echo vtranslate('LBL_ROLEANDSUBORDINATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</li></ul></div></div></div></div></div><div class='modal-overlay-footer clearfix'><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton' type="submit" ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink' data-dismiss="modal" href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div></div></div><?php }} ?>