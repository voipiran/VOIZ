<?php /* Smarty version Smarty-3.1.7, created on 2019-03-25 12:27:23
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Quotes/DetailViewSummaryContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9771664465c9889e38f7c88-70548828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e409df02891a4e1e43ac38e03346211d3bb31726' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Quotes/DetailViewSummaryContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9771664465c9889e38f7c88-70548828',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c9889e3903bf',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c9889e3903bf')) {function content_5c9889e3903bf($_smarty_tpl) {?>
<form id="detailView" method="POST"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewWidgets.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }} ?>