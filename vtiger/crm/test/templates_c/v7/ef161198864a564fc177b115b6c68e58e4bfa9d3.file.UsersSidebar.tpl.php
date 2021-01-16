<?php /* Smarty version Smarty-3.1.7, created on 2019-09-08 09:29:15
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Users/UsersSidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21040223425d748aa37fd8f8-65032187%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef161198864a564fc177b115b6c68e58e4bfa9d3' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Users/UsersSidebar.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21040223425d748aa37fd8f8-65032187',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SETTINGS_MENU_LIST' => 0,
    'BLOCK_MENUS' => 0,
    'NUM_OF_MENU_ITEMS' => 0,
    'BLOCK_NAME' => 0,
    'ACTIVE_BLOCK' => 0,
    'QUALIFIED_MODULE' => 0,
    'MENU' => 0,
    'USER_MODEL' => 0,
    'URL' => 0,
    'SETTINGS_MENU_ITEMS' => 0,
    'MENU_URL' => 0,
    'MENU_LABEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5d748aa38c3d9',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d748aa38c3d9')) {function content_5d748aa38c3d9($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['SETTINGS_MENU_LIST'] = new Smarty_variable(Settings_Vtiger_Module_Model::getSettingsMenuListForNonAdmin(), null, 0);?><div class="settingsgroup"><div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"><div class="settingsgroup-panel panel panel-default"><?php  $_smarty_tpl->tpl_vars['BLOCK_MENUS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_MENUS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SETTINGS_MENU_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_MENUS']->key => $_smarty_tpl->tpl_vars['BLOCK_MENUS']->value){
$_smarty_tpl->tpl_vars['BLOCK_MENUS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_NAME']->value = $_smarty_tpl->tpl_vars['BLOCK_MENUS']->key;
?><?php $_smarty_tpl->tpl_vars['NUM_OF_MENU_ITEMS'] = new Smarty_variable(sizeof($_smarty_tpl->tpl_vars['BLOCK_MENUS']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['NUM_OF_MENU_ITEMS']->value>0){?><div id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_NAME']->value;?>
_accordion" class="app-nav" role="tab"><div class="app-settings-accordion"><div class="settingsgroup-accordion"><a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $_smarty_tpl->tpl_vars['BLOCK_NAME']->value;?>
"><i class="fa <?php if ($_smarty_tpl->tpl_vars['ACTIVE_BLOCK']->value['block']==$_smarty_tpl->tpl_vars['BLOCK_NAME']->value){?> fa-angle-down <?php }else{ ?> fa-angle-right <?php }?>"></i>&nbsp;<span><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_NAME']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></a></div></div></div><div id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_NAME']->value;?>
" class="panel-collapse collapse <?php if ($_smarty_tpl->tpl_vars['ACTIVE_BLOCK']->value['block']==$_smarty_tpl->tpl_vars['BLOCK_NAME']->value){?> in <?php }?>"><ul class="list-group"><?php  $_smarty_tpl->tpl_vars['URL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['URL']->_loop = false;
 $_smarty_tpl->tpl_vars['MENU'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_MENUS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['URL']->key => $_smarty_tpl->tpl_vars['URL']->value){
$_smarty_tpl->tpl_vars['URL']->_loop = true;
 $_smarty_tpl->tpl_vars['MENU']->value = $_smarty_tpl->tpl_vars['URL']->key;
?><?php $_smarty_tpl->tpl_vars['MENU_URL'] = new Smarty_variable('#', null, 0);?><?php $_smarty_tpl->tpl_vars['MENU_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['MENU']->value, null, 0);?><?php if ($_smarty_tpl->tpl_vars['MENU']->value=='My Preferences'){?><?php $_smarty_tpl->tpl_vars['MENU_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->getPreferenceDetailViewUrl(), null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['MENU']->value=='Calendar Settings'){?><?php $_smarty_tpl->tpl_vars['MENU_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->getCalendarSettingsDetailViewUrl(), null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['MENU']->value===$_smarty_tpl->tpl_vars['URL']->value){?><?php if ($_smarty_tpl->tpl_vars['SETTINGS_MENU_ITEMS']->value[$_smarty_tpl->tpl_vars['MENU']->value]){?><?php $_smarty_tpl->tpl_vars['MENU_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['SETTINGS_MENU_ITEMS']->value[$_smarty_tpl->tpl_vars['MENU']->value]->getURL(), null, 0);?><?php }?><?php }elseif(is_string($_smarty_tpl->tpl_vars['URL']->value)){?><?php $_smarty_tpl->tpl_vars['MENU_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['URL']->value, null, 0);?><?php }?><li><a href="<?php echo $_smarty_tpl->tpl_vars['MENU_URL']->value;?>
" class="menuItemLabel <?php if ($_smarty_tpl->tpl_vars['ACTIVE_BLOCK']->value['menu']==$_smarty_tpl->tpl_vars['MENU']->value){?> settingsgroup-menu-color <?php }?>"><?php echo vtranslate($_smarty_tpl->tpl_vars['MENU_LABEL']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></li><?php } ?></ul></div><?php }?><?php } ?></div></div></div><?php }} ?>