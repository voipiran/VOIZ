<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 12:29:38
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Picklist/ModulePickListDetail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3595581265c46db7ac7dc82-25414815%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e03bd065e39ef07d47f63d8c3b92adb4775bde2' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Picklist/ModulePickListDetail.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3595581265c46db7ac7dc82-25414815',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'NO_PICKLIST_FIELDS' => 0,
    'SELECTED_MODULE_NAME' => 0,
    'QUALIFIED_NAME' => 0,
    'CREATE_PICKLIST_URL' => 0,
    'QUALIFIED_MODULE' => 0,
    'PICKLIST_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'DEFAULT_FIELD' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46db7acc9d1',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46db7acc9d1')) {function content_5c46db7acc9d1($_smarty_tpl) {?>



<?php if (!empty($_smarty_tpl->tpl_vars['NO_PICKLIST_FIELDS']->value)){?><label style="padding-top: 40px;"> <b><?php echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
 <?php echo vtranslate('NO_PICKLIST_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_NAME']->value);?>
. &nbsp;<?php if (!empty($_smarty_tpl->tpl_vars['CREATE_PICKLIST_URL']->value)){?><a href="<?php echo $_smarty_tpl->tpl_vars['CREATE_PICKLIST_URL']->value;?>
"><?php echo vtranslate('LBL_CREATE_NEW',$_smarty_tpl->tpl_vars['QUALIFIED_NAME']->value);?>
</a><?php }?></b></label><?php }else{ ?><div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel"><label class="fieldLabel"><strong><?php echo vtranslate('LBL_SELECT_PICKLIST_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></label></div><div class="col-sm-3 col-xs-3 fieldValue"><select class="select2 inputElement" id="modulePickList" name="modulePickList"><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_FIELD'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_FIELD']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['DEFAULT_FIELD']->value==$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName()){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</option><?php } ?></select></div></div><br><?php }?>
<?php }} ?>