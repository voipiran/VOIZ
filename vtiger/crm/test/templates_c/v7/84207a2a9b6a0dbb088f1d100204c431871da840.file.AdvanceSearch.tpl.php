<?php /* Smarty version Smarty-3.1.7, created on 2019-02-26 09:49:39
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/AdvanceSearch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6581618985c74da7b7e6895-28604662%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84207a2a9b6a0dbb088f1d100204c431871da840' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/AdvanceSearch.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6581618985c74da7b7e6895-28604662',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'SEARCHABLE_MODULES' => 0,
    'MODULE_NAME' => 0,
    'SOURCE_MODULE' => 0,
    'SOURCE_MODULE_MODEL' => 0,
    'SAVE_FILTER_PERMITTED' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c74da7b88ced',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c74da7b88ced')) {function content_5c74da7b88ced($_smarty_tpl) {?>
<div id="searchResults-container"><div class="row"><div class="col-lg-12 clearfix"><div class="pull-right overlay-close" ><button type="button" class="close" aria-label="Close" data-target='#overlayPage' data-dismiss="modal"><span aria-hidden="true" class='fa fa-close'></span></button></div></div></div><div class="container-fluid"><div id="advanceSearchHolder" class="row"><div class="col-lg-2 col-md-1 hidden-xs hidden-sm">&nbsp;</div><div id="advanceSearchContainer" class="col-lg-8 col-md-10 col-sm-12 col-xs-12"><div class="row"><div class="searchModuleComponent"><div class="col-lg-12 col-md-12"><div class="pull-left" style="margin-right:10px;font-size:18px;"><?php echo vtranslate('LBL_SEARCH_IN',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><select class="select2 col-lg-3" id="searchModuleList" data-placeholder="<?php echo vtranslate('LBL_SELECT_MODULE');?>
"><option></option><?php  $_smarty_tpl->tpl_vars['fieldObject'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fieldObject']->_loop = false;
 $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SEARCHABLE_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fieldObject']->key => $_smarty_tpl->tpl_vars['fieldObject']->value){
$_smarty_tpl->tpl_vars['fieldObject']->_loop = true;
 $_smarty_tpl->tpl_vars['MODULE_NAME']->value = $_smarty_tpl->tpl_vars['fieldObject']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value==$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value){?>selected="selected"<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option><?php } ?></select></div></div><div class="clearfix"></div><div class="col-lg-12"><div class="filterElements well filterConditionContainer" id="searchContainer" style="height: auto;"><form name="advanceFilterForm" method="POST"><?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value=='Home'){?><div class="textAlignCenter well contentsBackground"><?php echo vtranslate('LBL_PLEASE_SELECT_MODULE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><?php }else{ ?><input type="hidden" name="labelFields" <?php if (!empty($_smarty_tpl->tpl_vars['SOURCE_MODULE_MODEL']->value)){?>  data-value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SOURCE_MODULE_MODEL']->value->getNameFields());?>
' <?php }?> /><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('AdvanceFilter.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?></form></div></div></div><div class="container-fluid"><div class="row"><div class="col-lg-4 col-md-4 col-sm-4">&nbsp;</div><div class="actions  col-lg-8 col-md-8 col-sm-8"><div class="btn-toolbar"><div class="btn-group"><button class="btn btn-success" id="advanceSearchButton" <?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value=='Home'){?> disabled="" <?php }?>  type="submit"><strong><?php echo vtranslate('LBL_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div><div class="btn-group "><?php if ($_smarty_tpl->tpl_vars['SAVE_FILTER_PERMITTED']->value){?><button class="btn btn-success hide pull-right" <?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value=='Home'){?> disabled="" <?php }?> id="advanceSave"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><button class="btn btn-success" <?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value=='Home'){?> disabled="" <?php }?> id="advanceIntiateSave"><strong><?php echo vtranslate('LBL_SAVE_AS_FILTER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><input class="hide inputElement" type="text" value="" name="viewname"/><?php }?></div></div></div></div></div><div>&nbsp;</div></div><div class="col-lg-2 col-md-1 hidden-xs hidden-sm">&nbsp;</div></div></div><div class="searchResults"></div></div><?php }} ?>