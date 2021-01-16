<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 12:44:06
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/SharingAccess/ListRules.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4850672625c46dede112a35-63867433%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e0efa1ea50bdfbb3bbd5b13370fdccbaa26e1fc' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/SharingAccess/ListRules.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4850672625c46dede112a35-63867433',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
    'FOR_MODULE' => 0,
    'MODULE_MODEL' => 0,
    'RULE_MODEL_LIST' => 0,
    'RULE_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46dede20e0d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46dede20e0d')) {function content_5c46dede20e0d($_smarty_tpl) {?>



<div class="ruleListContainer"><div class="title row"><div class="rulehead col-sm-6"><!-- Check if the module should the for module to get the translations--><strong><?php echo vtranslate('LBL_SHARING_RULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php echo vtranslate('LBL_FOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FOR_MODULE']->value=='Accounts'){?><?php echo vtranslate($_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?> :</strong></div><div class="col-sm-6"><div class="pull-right"><button class="btn btn-sm btn-default addButton addCustomRule" type="button" data-url="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateRuleUrl();?>
"><i class="fa fa-plus"></i> &nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_CUSTOM_RULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div></div><hr><div class="contents"><?php if ($_smarty_tpl->tpl_vars['RULE_MODEL_LIST']->value){?><table class="table table-bordered table-condensed customRuleTable"><thead><tr class="customRuleHeaders"><th><?php echo vtranslate('LBL_RULE_NO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><!-- Check if the module should the for module to get the translations --><th><?php if ($_smarty_tpl->tpl_vars['FOR_MODULE']->value=='Accounts'){?><?php echo vtranslate($_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?>&nbsp;<?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_CAN_ACCESSED_BY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['RULE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RULE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['RULE_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RULE_MODEL_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["customRuleIterator"]['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['RULE_MODEL']->key => $_smarty_tpl->tpl_vars['RULE_MODEL']->value){
$_smarty_tpl->tpl_vars['RULE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['RULE_ID']->value = $_smarty_tpl->tpl_vars['RULE_MODEL']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["customRuleIterator"]['index']++;
?><tr class="customRuleEntries"><td class="sequenceNumber"><?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['customRuleIterator']['index']+1;?>
</td><td><a href="<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->getSourceDetailViewUrl();?>
"><?php echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['RULE_MODEL']->value->getSourceMemberName()),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
::<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->getSourceMember()->getName();?>
</a></td><td><a href="<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->getTargetDetailViewUrl();?>
"><?php echo vtranslate(('SINGLE_').($_smarty_tpl->tpl_vars['RULE_MODEL']->value->getTargetMemberName()),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
::<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->getTargetMember()->getName();?>
</a></td><td><?php if ($_smarty_tpl->tpl_vars['RULE_MODEL']->value->isReadOnly()){?><?php echo vtranslate('Read Only',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate('Read Write',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?><div class="table-actions pull-right"><span><a href="javascript:void(0);" class="edit" data-url="<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->getEditViewUrl();?>
"><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-pencil"></i></a></span>&nbsp;<span><a href="javascript:void(0);" class="delete" data-url="<?php echo $_smarty_tpl->tpl_vars['RULE_MODEL']->value->getDeleteActionUrl();?>
"><i title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-trash"></i></a></span></div></td></tr><?php } ?></tbody></table><div class="recordDetails hide"><p class="textAlignCenter"><?php echo vtranslate('LBL_CUSTOM_ACCESS_MESG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
.<!--<a href=""><?php echo vtranslate('LBL_CLICK_HERE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>&nbsp;<?php echo vtranslate('LBL_CREATE_RULE_MESG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
--></p></div><?php }else{ ?><div class="recordDetails"><p class="textAlignCenter"><?php echo vtranslate('LBL_CUSTOM_ACCESS_MESG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
.<!--<a href=""><?php echo vtranslate('LBL_CLICK_HERE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>&nbsp;<?php echo vtranslate('LBL_CREATE_RULE_MESG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
--></p></div><?php }?></div></div>
<?php }} ?>