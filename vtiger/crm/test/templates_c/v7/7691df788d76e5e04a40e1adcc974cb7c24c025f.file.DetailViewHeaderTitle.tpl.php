<?php /* Smarty version Smarty-3.1.7, created on 2019-02-06 13:04:43
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/PDFMaker/DetailViewHeaderTitle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20457930405c5aaa33674566-95723913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7691df788d76e5e04a40e1adcc974cb7c24c025f' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/PDFMaker/DetailViewHeaderTitle.tpl',
      1 => 1523862902,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20457930405c5aaa33674566-95723913',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'MODULE_NAME' => 0,
    'SELECTED_MENU_CATEGORY' => 0,
    'RECORD' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5aaa336a258',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5aaa336a258')) {function content_5c5aaa336a258($_smarty_tpl) {?>

<div class="col-lg-6 col-md-6 col-sm-6"><div class="record-header clearfix"><?php if (!$_smarty_tpl->tpl_vars['MODULE']->value){?><?php $_smarty_tpl->tpl_vars['MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_NAME']->value, null, 0);?><?php }?><div class="hidden-sm hidden-xs recordImage bg_<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
 app-<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
"><div class="name"><span><strong><i class="vicon-<?php echo strtolower($_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></strong></span></div></div><div class="recordBasicInfo"><div class="info-row"><h4><span class="modulename_label"><?php echo vtranslate('LBL_MODULENAMES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:</span>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD']->value->get('module'),$_smarty_tpl->tpl_vars['RECORD']->value->get('module'));?>
</h4></div></div></div></div><?php }} ?>