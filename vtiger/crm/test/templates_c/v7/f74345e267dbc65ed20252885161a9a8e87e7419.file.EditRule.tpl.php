<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 12:44:08
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/SharingAccess/EditRule.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7586013345c46dee0961aa6-59428453%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f74345e267dbc65ed20252885161a9a8e87e7419' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/SharingAccess/EditRule.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7586013345c46dee0961aa6-59428453',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RULE_MODEL' => 0,
    'RULE_ID' => 0,
    'QUALIFIED_MODULE' => 0,
    'MODULE_MODEL' => 0,
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'ALL_RULE_MEMBERS' => 0,
    'GROUP_LABEL' => 0,
    'ALL_GROUP_MEMBERS' => 0,
    'MEMBER' => 0,
    'RULE_MODEL_EXISTS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46dee0a6402',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46dee0a6402')) {function content_5c46dee0a6402($_smarty_tpl) {?>



<?php $_smarty_tpl->tpl_vars['RULE_MODEL_EXISTS'] = new Smarty_variable(true, null, 0);?><?php $_smarty_tpl->tpl_vars['RULE_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['RULE_MODEL']->value->getId(), null, 0);?><?php if (empty($_smarty_tpl->tpl_vars['RULE_ID']->value)){?><?php $_smarty_tpl->tpl_vars['RULE_MODEL_EXISTS'] = new Smarty_variable(false, null, 0);?><?php }?><div class="modal-dialog modelContainer"'><?php ob_start();?><?php echo vtranslate('LBL_ADD_CUSTOM_RULE_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable((($_tmp1).(" ")).($_tmp2), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<div class="modal-content"><form class="form-horizontal" id="editCustomRule" method="post"><input type="hidden" name="for_module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name');?>
" /><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RULE_ID']->value;?>
" /><div name='massEditContent'><div class="modal-body"><div class="form-group"><label class="control-label fieldLabel col-sm-5"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="controls fieldValue col-xs-6"><select class="select2 col-sm-9" name="source_id"><?php  $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->_loop = false;
 $_smarty_tpl->tpl_vars['GROUP_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_RULE_MEMBERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->key => $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value){
$_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->_loop = true;
 $_smarty_tpl->tpl_vars['GROUP_LABEL']->value = $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->key;
?><optgroup label="<?php echo vtranslate($_smarty_tpl->tpl_vars['GROUP_LABEL']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php  $_smarty_tpl->tpl_vars['MEMBER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MEMBER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MEMBER']->key => $_smarty_tpl->tpl_vars['MEMBER']->value){
$_smarty_tpl->tpl_vars['MEMBER']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getId();?>
"<?php if ($_smarty_tpl->tpl_vars['RULE_MODEL_EXISTS']->value){?> <?php if ($_smarty_tpl->tpl_vars['RULE_MODEL']->value->getSourceMember()->getId()==$_smarty_tpl->tpl_vars['MEMBER']->value->getId()){?>selected<?php }?><?php }?>><?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getName();?>
</option><?php } ?></optgroup><?php } ?></select></div></div><div class="form-group"><label class="control-label fieldLabel col-sm-5"><?php echo vtranslate('LBL_CAN_ACCESSED_BY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls fieldValue col-xs-6"><select class="select2 col-sm-9" name="target_id"><?php  $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->_loop = false;
 $_smarty_tpl->tpl_vars['GROUP_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_RULE_MEMBERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->key => $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value){
$_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->_loop = true;
 $_smarty_tpl->tpl_vars['GROUP_LABEL']->value = $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->key;
?><optgroup label="<?php echo vtranslate($_smarty_tpl->tpl_vars['GROUP_LABEL']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php  $_smarty_tpl->tpl_vars['MEMBER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MEMBER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MEMBER']->key => $_smarty_tpl->tpl_vars['MEMBER']->value){
$_smarty_tpl->tpl_vars['MEMBER']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getId();?>
"<?php if ($_smarty_tpl->tpl_vars['RULE_MODEL_EXISTS']->value){?><?php if ($_smarty_tpl->tpl_vars['RULE_MODEL']->value->getTargetMember()->getId()==$_smarty_tpl->tpl_vars['MEMBER']->value->getId()){?>selected<?php }?><?php }?>><?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getName();?>
</option><?php } ?></optgroup><?php } ?></select></div></div><div class="form-group"><label class="control-label fieldLabel col-sm-5"><?php echo vtranslate('LBL_WITH_PERMISSIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls fieldValue col-sm-5" style="margin-left: 3%;"><label class="radio"><input type="radio" value="0" name="permission" <?php if ($_smarty_tpl->tpl_vars['RULE_MODEL_EXISTS']->value){?> <?php if ($_smarty_tpl->tpl_vars['RULE_MODEL']->value->isReadOnly()){?> checked <?php }?> <?php }else{ ?> checked <?php }?>/>&nbsp;<?php echo vtranslate('LBL_READ',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;</label><label class="radio"><input type="radio" value="1" name="permission" <?php if ($_smarty_tpl->tpl_vars['RULE_MODEL']->value->isReadWrite()){?> checked <?php }?> />&nbsp;<?php echo vtranslate('LBL_READ_WRITE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;</label></div></div></div></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div></div>
<?php }} ?>