<?php /* Smarty version Smarty-3.1.7, created on 2020-11-26 14:40:20
         compiled from "/var/www/html/crm/includes/runtime/../../layouts/v7/modules/Settings/Vtiger/Sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1400419555fbf8d1c7958f7-97062217%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd230d79cdcdd21472289abd4fbf5277bdb059b39' => 
    array (
      0 => '/var/www/html/crm/includes/runtime/../../layouts/v7/modules/Settings/Vtiger/Sidebar.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1400419555fbf8d1c7958f7-97062217',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'USER_MODEL' => 0,
    'SETTINGS_MODULE_MODEL' => 0,
    'QUALIFIED_MODULE' => 0,
    'SETTINGS_MENUS' => 0,
    'BLOCK_MENUS' => 0,
    'BLOCK_MENU_ITEMS' => 0,
    'NUM_OF_MENU_ITEMS' => 0,
    'BLOCK_NAME' => 0,
    'ACTIVE_BLOCK' => 0,
    'MENUITEM' => 0,
    'MENU' => 0,
    'MENU_URL' => 0,
    'MENU_LABEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5fbf8d1c884f8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fbf8d1c884f8')) {function content_5fbf8d1c884f8($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['USER_MODEL']->value->isAdminUser()){?><?php $_smarty_tpl->tpl_vars['SETTINGS_MODULE_MODEL'] = new Smarty_variable(Settings_Vtiger_Module_Model::getInstance(), null, 0);?><?php $_smarty_tpl->tpl_vars['SETTINGS_MENUS'] = new Smarty_variable($_smarty_tpl->tpl_vars['SETTINGS_MODULE_MODEL']->value->getMenus(), null, 0);?><div class="settingsgroup"><div><input type="text" placeholder="<?php echo vtranslate('LBL_SEARCH_FOR_SETTINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" class="search-list col-lg-8" id='settingsMenuSearch'></div><br><br><div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"><?php  $_smarty_tpl->tpl_vars['BLOCK_MENUS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_MENUS']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['SETTINGS_MENUS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_MENUS']->key => $_smarty_tpl->tpl_vars['BLOCK_MENUS']->value){
$_smarty_tpl->tpl_vars['BLOCK_MENUS']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['BLOCK_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_MENUS']->value->getLabel(), null, 0);?><?php $_smarty_tpl->tpl_vars['BLOCK_MENU_ITEMS'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_MENUS']->value->getMenuItems(), null, 0);?><?php $_smarty_tpl->tpl_vars['NUM_OF_MENU_ITEMS'] = new Smarty_variable(sizeof($_smarty_tpl->tpl_vars['BLOCK_MENU_ITEMS']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['NUM_OF_MENU_ITEMS']->value>0){?><div class="settingsgroup-panel panel panel-default instaSearch"><div id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_NAME']->value;?>
_accordion" class="app-nav" role="tab"><div class="app-settings-accordion"><div class="settingsgroup-accordion"><a data-toggle="collapse" data-parent="#accordion" class='collapsed' href="#<?php echo $_smarty_tpl->tpl_vars['BLOCK_NAME']->value;?>
"><i class="indicator fa<?php if ($_smarty_tpl->tpl_vars['ACTIVE_BLOCK']->value['block']==$_smarty_tpl->tpl_vars['BLOCK_NAME']->value){?> fa-chevron-down <?php }else{ ?> fa-chevron-right <?php }?>"></i>&nbsp;<span><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_NAME']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></a></div></div></div><div id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_NAME']->value;?>
" class="panel-collapse collapse ulBlock <?php if ($_smarty_tpl->tpl_vars['ACTIVE_BLOCK']->value['block']==$_smarty_tpl->tpl_vars['BLOCK_NAME']->value){?> in <?php }?>"><ul class="list-group widgetContainer"><?php  $_smarty_tpl->tpl_vars['MENUITEM'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MENUITEM']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_MENU_ITEMS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MENUITEM']->key => $_smarty_tpl->tpl_vars['MENUITEM']->value){
$_smarty_tpl->tpl_vars['MENUITEM']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['MENU'] = new Smarty_variable($_smarty_tpl->tpl_vars['MENUITEM']->value->get('name'), null, 0);?><?php $_smarty_tpl->tpl_vars['MENU_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['MENU']->value, null, 0);?><?php if ($_smarty_tpl->tpl_vars['MENU']->value=='LBL_EDIT_FIELDS'){?><?php $_smarty_tpl->tpl_vars['MENU_LABEL'] = new Smarty_variable('LBL_MODULE_CUSTOMIZATION', null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['MENU']->value=='LBL_TAX_SETTINGS'){?><?php $_smarty_tpl->tpl_vars['MENU_LABEL'] = new Smarty_variable('LBL_TAX_MANAGEMENT', null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['MENU']->value=='INVENTORYTERMSANDCONDITIONS'){?><?php $_smarty_tpl->tpl_vars['MENU_LABEL'] = new Smarty_variable('LBL_TERMS_AND_CONDITIONS', null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars['MENU_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['MENUITEM']->value->getUrl(), null, 0);?><?php $_smarty_tpl->tpl_vars['USER_MODEL'] = new Smarty_variable(Users_Record_Model::getCurrentUserModel(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['MENU']->value=='My Preferences'){?><?php $_smarty_tpl->tpl_vars['MENU_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->getPreferenceDetailViewUrl(), null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['MENU']->value=='Calendar Settings'){?><?php $_smarty_tpl->tpl_vars['MENU_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->getCalendarSettingsDetailViewUrl(), null, 0);?><?php }?><li><a data-name="<?php echo $_smarty_tpl->tpl_vars['MENU']->value;?>
" href="<?php echo $_smarty_tpl->tpl_vars['MENU_URL']->value;?>
" class="menuItemLabel <?php if ($_smarty_tpl->tpl_vars['ACTIVE_BLOCK']->value['menu']==$_smarty_tpl->tpl_vars['MENU']->value){?> settingsgroup-menu-color <?php }?>"><?php echo vtranslate($_smarty_tpl->tpl_vars['MENU_LABEL']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<img id="<?php echo $_smarty_tpl->tpl_vars['MENUITEM']->value->getId();?>
_menuItem" data-id="<?php echo $_smarty_tpl->tpl_vars['MENUITEM']->value->getId();?>
" class="pinUnpinShortCut cursorPointer pull-right"data-actionurl="<?php echo $_smarty_tpl->tpl_vars['MENUITEM']->value->getPinUnpinActionUrl();?>
"data-pintitle="<?php echo vtranslate('LBL_PIN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"data-unpintitle="<?php echo vtranslate('LBL_UNPIN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"data-pinimageurl="<?php ob_start();?><?php echo vimage_path('pin.png');?>
<?php $_tmp1=ob_get_clean();?><?php echo $_tmp1;?>
"data-unpinimageurl="<?php ob_start();?><?php echo vimage_path('unpin.png');?>
<?php $_tmp2=ob_get_clean();?><?php echo $_tmp2;?>
"<?php if ($_smarty_tpl->tpl_vars['MENUITEM']->value->isPinned()){?>title="<?php echo vtranslate('LBL_UNPIN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" src="<?php echo vimage_path('unpin.png');?>
" data-action="unpin"<?php }else{ ?>title="<?php echo vtranslate('LBL_PIN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" src="<?php echo vimage_path('pin.png');?>
" data-action="pin"<?php }?> /></a></li><?php } ?></ul></div></div><?php }?><?php } ?></div></div><?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate ('modules/Users/UsersSidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>
<?php }} ?>