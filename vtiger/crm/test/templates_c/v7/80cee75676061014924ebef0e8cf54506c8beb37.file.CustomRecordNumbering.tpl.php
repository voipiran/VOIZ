<?php /* Smarty version Smarty-3.1.7, created on 2018-04-16 11:43:56
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Vtiger/CustomRecordNumbering.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2103405625ad44d34c4e7d0-90721874%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80cee75676061014924ebef0e8cf54506c8beb37' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Vtiger/CustomRecordNumbering.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2103405625ad44d34c4e7d0-90721874',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'DEFAULT_MODULE_MODEL' => 0,
    'CURRENT_USER_MODEL' => 0,
    'WIDTHTYPE' => 0,
    'SUPPORTED_MODULES' => 0,
    'MODULE_MODEL' => 0,
    'MODULE_NAME' => 0,
    'DEFAULT_MODULE_NAME' => 0,
    'DEFAULT_MODULE_DATA' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ad44d34cdc6e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad44d34cdc6e')) {function content_5ad44d34cdc6e($_smarty_tpl) {?>

<div class=" detailViewContainer col-lg-12 col-md-12 col-sm-12"><form id="EditView" method="POST"><div class="blockData"><div class="clearfix"><div class="btn-group pull-right"><button type="button" class="btn addButton btn-default" name="updateRecordWithSequenceNumber"><?php echo vtranslate('LBL_UPDATE_MISSING_RECORD_SEQUENCE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div><div><h4><?php echo vtranslate('LBL_CUSTOMIZE_RECORD_NUMBERING',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div></div><hr><br><div class="table form-horizontal no-border" id="customRecordNumbering" ><?php $_smarty_tpl->tpl_vars['DEFAULT_MODULE_DATA'] = new Smarty_variable($_smarty_tpl->tpl_vars['DEFAULT_MODULE_MODEL']->value->getModuleCustomNumberingData(), null, 0);?><?php $_smarty_tpl->tpl_vars['DEFAULT_MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['DEFAULT_MODULE_MODEL']->value->getName(), null, 0);?><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel"><label><?php echo vtranslate('LBL_SELECT_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></div><div class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class=" col-lg-4 col-md-4 col-sm-4"><select class="select2 inputElement " name="sourceModule"><?php  $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SUPPORTED_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['MODULE_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'), null, 0);?><option value=<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value==$_smarty_tpl->tpl_vars['DEFAULT_MODULE_NAME']->value){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option><?php } ?></select></div></div></div><div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel"><label ><?php echo vtranslate('LBL_USE_PREFIX',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></div><div class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class=" col-lg-4 col-md-4 col-sm-4"><input type="text" id="prefix" class="inputElement" value="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_MODULE_DATA']->value['prefix'];?>
" data-old-prefix="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_MODULE_DATA']->value['prefix'];?>
" name="prefix" /></div></div></div><div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel"><label><b><?php echo vtranslate('LBL_START_SEQUENCE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b>&nbsp;<span class="redColor">*</span></label></div><div class="fieldValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class=" col-lg-4 col-md-4 col-sm-4"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_MODULE_DATA']->value['sequenceNumber'];?>
" class="inputElement " id="sequence"data-old-sequence-number="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_MODULE_DATA']->value['sequenceNumber'];?>
" data-rule-required = "true" data-rule-positive="true" data-rule-wholeNumber="true" name="sequenceNumber"/></div></div></div></div></div><br><div class='modal-overlay-footer clearfix'><div class="row clearfix"><div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button class="btn btn-success saveButton" type="submit" disabled="disabled"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink' href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div></div></div></form></div><?php }} ?>