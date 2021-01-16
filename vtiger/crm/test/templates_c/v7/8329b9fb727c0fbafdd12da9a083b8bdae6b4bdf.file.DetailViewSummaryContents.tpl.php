<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 14:17:13
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Invoice/DetailViewSummaryContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9060082985c46f4b12df074-39209146%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8329b9fb727c0fbafdd12da9a083b8bdae6b4bdf' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Invoice/DetailViewSummaryContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9060082985c46f4b12df074-39209146',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46f4b12e970',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46f4b12e970')) {function content_5c46f4b12e970($_smarty_tpl) {?>
<form id="detailView" method="POST"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewWidgets.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }} ?>