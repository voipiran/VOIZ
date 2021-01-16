<?php /* Smarty version Smarty-3.1.7, created on 2019-03-25 12:27:23
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Quotes/ModuleSummaryView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17431905015c9889e38920e4-76452018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8195d10f31d418451b438edcdacb35b2517af14c' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Quotes/ModuleSummaryView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17431905015c9889e38920e4-76452018',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c9889e38d72d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c9889e38d72d')) {function content_5c9889e38d72d($_smarty_tpl) {?>
<div class="recordDetails"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewContents.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><?php }} ?>