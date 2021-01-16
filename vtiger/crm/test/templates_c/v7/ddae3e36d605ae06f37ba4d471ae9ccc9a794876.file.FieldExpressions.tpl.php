<?php /* Smarty version Smarty-3.1.7, created on 2019-03-25 12:29:10
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Workflows/FieldExpressions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4772072015c988a4e789337-61956593%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddae3e36d605ae06f37ba4d471ae9ccc9a794876' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Workflows/FieldExpressions.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4772072015c988a4e789337-61956593',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'MODULE_MODEL' => 0,
    'RECORD_STRUCTURE' => 0,
    'FIELDS' => 0,
    'MODULE_FIELD' => 0,
    'RELATED_MODULE_MODEL' => 0,
    'MODULE_FIELDS' => 0,
    'FIELD_EXPRESSIONS' => 0,
    'FIELD_EXPRESSIONS_KEY' => 0,
    'FIELD_EXPRESSION_VALUE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c988a4e841ec',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c988a4e841ec')) {function content_5c988a4e841ec($_smarty_tpl) {?>
<div class="popupUi modal-dialog modal-md hide" data-backdrop="false"><div class="modal-content"><?php ob_start();?><?php echo vtranslate('LBL_SET_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable($_tmp1, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<div class="modal-body"><div class="row"><div class="col-sm-4"><select class="textType" style="min-width: 160px;"><option data-ui="textarea" value="rawtext"><?php echo vtranslate('LBL_RAW_TEXT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option data-ui="textarea" value="fieldname"><?php echo vtranslate('LBL_FIELD_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option data-ui="textarea" value="expression"><?php echo vtranslate('LBL_EXPRESSION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></div><div class="col-sm-4 hide useFieldContainer"><span name="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name');?>
" class="useFieldElement"><?php $_smarty_tpl->tpl_vars['MODULE_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFields(), null, 0);?><select class="useField" data-placeholder="<?php echo vtranslate('LBL_USE_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="min-width: 160px;"><option></option><?php  $_smarty_tpl->tpl_vars['FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS']->key => $_smarty_tpl->tpl_vars['FIELDS']->value){
$_smarty_tpl->tpl_vars['FIELDS']->_loop = true;
?><?php  $_smarty_tpl->tpl_vars['MODULE_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_FIELD']->key => $_smarty_tpl->tpl_vars['MODULE_FIELD']->value){
$_smarty_tpl->tpl_vars['MODULE_FIELD']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_FIELD']->value->get('workflow_columnname');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_FIELD']->value->get('workflow_columnlabel'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'));?>
</option><?php } ?><?php } ?></select></span><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value!=''){?><span name="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->get('name');?>
" class="useFieldElement"><?php $_smarty_tpl->tpl_vars['MODULE_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_MODULE_MODEL']->value->getFields(), null, 0);?><select class="useField" data-placeholder="<?php echo vtranslate('LBL_USE_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="min-width: 160px;"><option></option><?php  $_smarty_tpl->tpl_vars['MODULE_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_FIELD']->key => $_smarty_tpl->tpl_vars['MODULE_FIELD']->value){
$_smarty_tpl->tpl_vars['MODULE_FIELD']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_FIELD']->value->getName();?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php } ?></select></span><?php }?></div><div class="col-sm-4 hide useFunctionContainer"><select class="useFunction pull-right" data-placeholder="<?php echo vtranslate('LBL_USE_FUNCTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" style="min-width: 160px;"><option></option><?php  $_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_EXPRESSION_VALUE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY']->key => $_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY']->value){
$_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_EXPRESSION_VALUE']->value = $_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_EXPRESSIONS_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_EXPRESSION_VALUE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php } ?></select></div></div><br><div class="row fieldValueContainer"><div class="col-sm-12"><textarea data-textarea="true" class="fieldValue inputElement hide" style="height: inherit;"></textarea></div></div><br><div id="rawtext_help" class="alert alert-info helpmessagebox hide"><p><h5><?php echo vtranslate('LBL_RAW_TEXT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h5></p><p>2000</p><p><?php echo vtranslate('LBL_VTIGER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p></div><div id="fieldname_help" class="helpmessagebox alert alert-info hide"><p><h5><?php echo vtranslate('LBL_EXAMPLE_FIELD_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h5></p><p><?php echo vtranslate('LBL_ANNUAL_REVENUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p><p><?php echo vtranslate('LBL_NOTIFY_OWNER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p></div><div id="expression_help" class="alert alert-info helpmessagebox hide"><p><h5><?php echo vtranslate('LBL_EXAMPLE_EXPRESSION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h5></p><p><?php echo vtranslate('LBL_ANNUAL_REVENUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
/12</p><p><?php echo vtranslate('LBL_EXPRESSION_EXAMPLE2',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p></div></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalFooter.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><div class="clonedPopUp"></div>
<?php }} ?>