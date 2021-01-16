<?php /* Smarty version Smarty-3.1.7, created on 2019-02-06 12:52:22
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Currency/EditAjax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14905795875c5aa74ea23af7-45458102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec06f9037e656d409553d33648413ed09780fc19' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Currency/EditAjax.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14905795875c5aa74ea23af7-45458102',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RECORD_MODEL' => 0,
    'CURRENCY_ID' => 0,
    'CURRENCY_MODEL_EXISTS' => 0,
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'ALL_CURRENCIES' => 0,
    'CURRENCY_MODEL' => 0,
    'BASE_CURRENCY_MODEL' => 0,
    'OTHER_EXISTING_CURRENCIES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5aa74eb41d4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5aa74eb41d4')) {function content_5c5aa74eb41d4($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['CURRENCY_MODEL_EXISTS'] = new Smarty_variable(true, null, 0);?><?php $_smarty_tpl->tpl_vars['CURRENCY_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId(), null, 0);?><?php if (empty($_smarty_tpl->tpl_vars['CURRENCY_ID']->value)){?><?php $_smarty_tpl->tpl_vars['CURRENCY_MODEL_EXISTS'] = new Smarty_variable(false, null, 0);?><?php }?><div class="currencyModalContainer modal-dialog modelContainer"><?php if ($_smarty_tpl->tpl_vars['CURRENCY_MODEL_EXISTS']->value){?><?php ob_start();?><?php echo vtranslate('LBL_EDIT_CURRENCY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["HEADER_TITLE"] = new Smarty_variable($_tmp1, null, 0);?><?php }else{ ?><?php ob_start();?><?php echo vtranslate('LBL_ADD_NEW_CURRENCY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["HEADER_TITLE"] = new Smarty_variable($_tmp2, null, 0);?><?php }?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<div class="modal-content"><form id="editCurrency" class="form-horizontal" method="POST"><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['CURRENCY_ID']->value;?>
" /><div class="modal-body"><div class="row-fluid"><div class="form-group"><label class="control-label fieldLabel col-sm-5"><?php echo vtranslate('LBL_CURRENCY_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label><div class="controls fieldValue col-xs-6"><select class="select2 inputElement" name="currency_name"><?php  $_smarty_tpl->tpl_vars['CURRENCY_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['CURRENCY_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_CURRENCIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->key => $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->value){
$_smarty_tpl->tpl_vars['CURRENCY_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['CURRENCY_ID']->value = $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->key;
 $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->index++;
 $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->first = $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['currencyIterator']['first'] = $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->first;
?><?php if (!$_smarty_tpl->tpl_vars['CURRENCY_MODEL_EXISTS']->value&&$_smarty_tpl->getVariable('smarty')->value['foreach']['currencyIterator']['first']){?><?php $_smarty_tpl->tpl_vars['RECORD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENCY_MODEL']->value, null, 0);?><?php }?><option value="<?php echo $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->value->get('currency_name');?>
" data-code="<?php echo $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->value->get('currency_code');?>
"data-symbol="<?php echo $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->value->get('currency_symbol');?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('currency_name')==$_smarty_tpl->tpl_vars['CURRENCY_MODEL']->value->get('currency_name')){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['CURRENCY_MODEL']->value->get('currency_name'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;(<?php echo $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->value->get('currency_symbol');?>
)</option><?php } ?></select></div></div><div class="form-group"><label class="control-label fieldLabel col-sm-5"><?php echo vtranslate('LBL_CURRENCY_CODE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label><div class="controls fieldValue col-xs-6"><input type="text" class="inputElement bgColor cursorPointerNotAllowed" name="currency_code" readonly value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('currency_code');?>
" data-rule-required = "true" /></div></div><div class="form-group"><label class="control-label fieldLabel col-sm-5"><?php echo vtranslate('LBL_CURRENCY_SYMBOL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label><div class="controls fieldValue col-xs-6"><input type="text"  class="inputElement bgColor cursorPointerNotAllowed" name="currency_symbol" readonly value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('currency_symbol');?>
" data-rule-required = "true" /></div></div><div class="form-group"><label class="control-label fieldLabel col-sm-5"><?php echo vtranslate('LBL_CONVERSION_RATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label><div class="controls fieldValue col-xs-6"><input type="text" class="inputElement" name="conversion_rate" data-rule-required = "true" data-rule-positive ="true" data-rule-greater_than_zero = "true" placeholder="<?php echo vtranslate('LBL_ENTER_CONVERSION_RATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('conversion_rate');?>
"/><br><span class="muted">(<?php echo vtranslate('LBL_BASE_CURRENCY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['BASE_CURRENCY_MODEL']->value->get('currency_name');?>
)</span></div></div><div class="form-group"><label class="control-label fieldLabel col-sm-5"><?php echo vtranslate('LBL_STATUS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls fieldValue col-xs-6"><label class="checkbox"><input type="hidden" name="currency_status" value="Inactive" /><input type="checkbox" name="currency_status" value="Active" class="currencyStatus alignBottom"<?php if (!$_smarty_tpl->tpl_vars['CURRENCY_MODEL_EXISTS']->value){?> checked <?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('currency_status');?>
<?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('currency_status')=='Active'){?> checked <?php }?><?php }?> /><span>&nbsp;<?php echo vtranslate('LBL_CURRENCY_STATUS_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></label></div></div><div class="control-group transferCurrency hide"><label class="muted control-label"><?php echo vtranslate('LBL_TRANSFER_CURRENCY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php echo vtranslate('LBL_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label>&nbsp;<span class="redColor">*</span><div class="controls row-fluid"><select class="select2 span6" name="transform_to_id"><?php  $_smarty_tpl->tpl_vars['CURRENCY_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['CURRENCY_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['OTHER_EXISTING_CURRENCIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->key => $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->value){
$_smarty_tpl->tpl_vars['CURRENCY_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['CURRENCY_ID']->value = $_smarty_tpl->tpl_vars['CURRENCY_MODEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['CURRENCY_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['CURRENCY_MODEL']->value->get('currency_name'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php } ?></select></div></div></div></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl','Vtiger'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div></div>
<?php }} ?>