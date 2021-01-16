<?php /* Smarty version Smarty-3.1.7, created on 2018-12-10 09:02:25
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/dashboards/MiniListWizard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9998521645c0dfa69de3120-62857353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a9403d5fb58df37411a25922a55a760f5e828b7' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/dashboards/MiniListWizard.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9998521645c0dfa69de3120-62857353',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WIZARD_STEP' => 0,
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'MODULES' => 0,
    'MODULE_NAME' => 0,
    'TRANSLATED_MODULE_NAMES' => 0,
    'ALLFILTERS' => 0,
    'FILTERGROUP' => 0,
    'FILTERS' => 0,
    'FILTER' => 0,
    'LIST_VIEW_CONTROLLER' => 0,
    'FIELD_NAME' => 0,
    'FIELD' => 0,
    'SELECTED_MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c0dfa69e944f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c0dfa69e944f')) {function content_5c0dfa69e944f($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['WIZARD_STEP']->value=='step1'){?><div id="minilistWizardContainer" class='modelContainer modal-dialog'><div class="modal-content"><?php ob_start();?><?php echo vtranslate('LBL_MINI_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable((($_tmp1).(" ")).($_tmp2), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<form class="form-horizontal" method="post" action="javascript:;"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="MassSave" /><table class="table no-border"><tbody><tr><td class="col-lg-1"></td><td class="fieldLabel col-lg-4"><label class="pull-right"><?php echo vtranslate('LBL_SELECT_MODULE');?>
</label></td><td class="fieldValue col-lg-5"><select name="module" style="width: 100%"><option></option><?php $_smarty_tpl->tpl_vars['TRANSLATED_MODULES_NAMES'] = new Smarty_variable(array(), null, 0);?><?php  $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['MODULE_NAME']->value = $_smarty_tpl->tpl_vars['MODULE_MODEL']->key;
?><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->createLocalArrayVariable('TRANSLATED_MODULE_NAMES', null, 0);
$_smarty_tpl->tpl_vars['TRANSLATED_MODULE_NAMES']->value[$_smarty_tpl->tpl_vars['MODULE_NAME']->value] = $_tmp3;?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option><?php } ?></select></td><td class="col-lg-4"></td></tr><tr><td class="col-lg-1"></td><td class="fieldLabel col-lg-4"><label class="pull-right"><?php echo vtranslate('LBL_FILTER');?>
</label></td><td class="fieldValue col-lg-5"><select name="filterid" style="width: 100%"><option></option></select></td><td class="col-lg-4"></td></tr><tr><td class="col-lg-1"></td><td class="fieldLabel col-lg-4"><label class="pull-right"><?php echo vtranslate('LBL_EDIT_FIELDS');?>
</label></td><td class="fieldValue col-lg-5"><select name="fields" size="2" multiple="true" style="width: 100%"><option></option></select></td><td class="col-lg-4"></td></tr></tbody><input type="hidden" id="translatedModuleNames" value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['TRANSLATED_MODULE_NAMES']->value));?>
'></table><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div></div><?php }elseif($_smarty_tpl->tpl_vars['WIZARD_STEP']->value=='step2'){?><option></option><?php  $_smarty_tpl->tpl_vars['FILTERS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FILTERS']->_loop = false;
 $_smarty_tpl->tpl_vars['FILTERGROUP'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALLFILTERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FILTERS']->key => $_smarty_tpl->tpl_vars['FILTERS']->value){
$_smarty_tpl->tpl_vars['FILTERS']->_loop = true;
 $_smarty_tpl->tpl_vars['FILTERGROUP']->value = $_smarty_tpl->tpl_vars['FILTERS']->key;
?><optgroup label="<?php echo $_smarty_tpl->tpl_vars['FILTERGROUP']->value;?>
"><?php  $_smarty_tpl->tpl_vars['FILTER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FILTER']->_loop = false;
 $_smarty_tpl->tpl_vars['FILTERNAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FILTERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FILTER']->key => $_smarty_tpl->tpl_vars['FILTER']->value){
$_smarty_tpl->tpl_vars['FILTER']->_loop = true;
 $_smarty_tpl->tpl_vars['FILTERNAME']->value = $_smarty_tpl->tpl_vars['FILTER']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FILTER']->value->getId();?>
"><?php echo $_smarty_tpl->tpl_vars['FILTER']->value->get('viewname');?>
</option><?php } ?></optgroup><?php } ?><?php }elseif($_smarty_tpl->tpl_vars['WIZARD_STEP']->value=='step3'){?><option></option><?php  $_smarty_tpl->tpl_vars['FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LIST_VIEW_CONTROLLER']->value->getListViewHeaderFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD']->key => $_smarty_tpl->tpl_vars['FIELD']->value){
$_smarty_tpl->tpl_vars['FIELD']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value->getFieldLabelKey(),$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value);?>
</option><?php } ?><?php }?><?php }} ?>