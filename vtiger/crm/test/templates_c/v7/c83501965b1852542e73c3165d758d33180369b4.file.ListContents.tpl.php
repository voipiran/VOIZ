<?php /* Smarty version Smarty-3.1.7, created on 2018-04-16 11:43:58
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/ModuleManager/ListContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8584777815ad44d3650e9b9-26028172%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c83501965b1852542e73c3165d758d33180369b4' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/ModuleManager/ListContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8584777815ad44d3650e9b9-26028172',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'IMPORT_USER_MODULE_FROM_FILE_URL' => 0,
    'IMPORT_MODULE_URL' => 0,
    'ALL_MODULES' => 0,
    'MODULE_MODEL' => 0,
    'COUNTER' => 0,
    'MODULE_NAME' => 0,
    'MODULE_LABEL' => 0,
    'MODULE_ACTIVE' => 0,
    'RESTRICTED_MODULES_LIST' => 0,
    'SETTINGS_LINKS' => 0,
    'SETTINGS_LINK' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ad44d366375e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad44d366375e')) {function content_5ad44d366375e($_smarty_tpl) {?>


<div class="listViewPageDiv detailViewContainer" id="moduleManagerContents"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 "><div id="listview-actions" class="listview-actions-container"><div class="clearfix"><h4 class="pull-left"><?php echo vtranslate('LBL_MODULE_MANAGER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><div class="pull-right"><div class="btn-group"><button class="btn btn-default" type="button" onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['IMPORT_USER_MODULE_FROM_FILE_URL']->value;?>
"'><?php echo vtranslate('LBL_IMPORT_MODULE_FROM_ZIP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div>&nbsp;<div class="btn-group"><button class="btn btn-default" type="button" onclick='window.location.href = "<?php echo $_smarty_tpl->tpl_vars['IMPORT_MODULE_URL']->value;?>
"'><?php echo vtranslate('LBL_EXTENSION_STORE','Settings:ExtensionStore');?>
</button></div></div></div><br><div class="contents"><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><table class="table table-bordered modulesTable"><tr><?php  $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['MODULE_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['MODULE_ID']->value = $_smarty_tpl->tpl_vars['MODULE_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_ACTIVE'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isActive(), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_LABEL'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name')), null, 0);?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value==2){?></tr><tr><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php }?><td class="ModulemanagerSettings"><div class="moduleManagerBlock"><span class="col-lg-1" style="line-height: 2.5;"><input type="checkbox" value="" name="moduleStatus" data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" data-module-translation="<?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isActive()){?>checked<?php }?> /></span><span class="col-lg-1 moduleImage <?php if (!$_smarty_tpl->tpl_vars['MODULE_ACTIVE']->value){?>dull <?php }?>"><?php if (vimage_path(($_smarty_tpl->tpl_vars['MODULE_NAME']->value).('.png'))!=false){?><img class="alignMiddle" src="<?php echo vimage_path(($_smarty_tpl->tpl_vars['MODULE_NAME']->value).('.png'));?>
" alt="<?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
"/><?php }else{ ?><img class="alignMiddle" src="<?php echo vimage_path('DefaultModule.png');?>
" alt="<?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
"/><?php }?></span><span class="col-lg-7 moduleName <?php if (!$_smarty_tpl->tpl_vars['MODULE_ACTIVE']->value){?> dull <?php }?>"><h5 style="line-height: 0.5;"><?php echo $_smarty_tpl->tpl_vars['MODULE_LABEL']->value;?>
</h5></span><?php $_smarty_tpl->tpl_vars['SETTINGS_LINKS'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getSettingLinks(), null, 0);?><?php if (!in_array($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['RESTRICTED_MODULES_LIST']->value)&&(count($_smarty_tpl->tpl_vars['SETTINGS_LINKS']->value)>0)){?><span class="col-lg-3 moduleblock"><span class="btn-group pull-right actions <?php if (!$_smarty_tpl->tpl_vars['MODULE_ACTIVE']->value){?>hide<?php }?>"><button class="btn btn-default btn-sm dropdown-toggle unpin hiden " data-toggle="dropdown"><?php echo vtranslate('LBL_SETTINGS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<i class="caret"></i></button><ul class="dropdown-menu pull-right dropdownfields"><?php  $_smarty_tpl->tpl_vars['SETTINGS_LINK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SETTINGS_LINK']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['SETTINGS_LINKS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SETTINGS_LINK']->key => $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value){
$_smarty_tpl->tpl_vars['SETTINGS_LINK']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Calendar'){?><?php if ($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel']=='LBL_EDIT_FIELDS'){?><li><a href="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
&sourceModule=Events"><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate('LBL_EVENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><li><a href="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
&sourceModule=Calendar"><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate('LBL_TASKS','Calendar'));?>
</a></li><?php }elseif($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel']=='LBL_EDIT_WORKFLOWS'){?><li><a href="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
&sourceModule=Events"><?php echo vtranslate('LBL_EVENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_WORKFLOWS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></li><li><a href="<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
&sourceModule=Calendar"><?php echo vtranslate('LBL_TASKS','Calendar');?>
 <?php echo vtranslate('LBL_WORKFLOWS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></li><?php }else{ ?><li><a href=<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><?php }?><?php }else{ ?><li><a	<?php if (stripos($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'],'javascript:')===0){?>onclick='<?php echo substr($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'],strlen("javascript:"));?>
;'<?php }else{ ?>onclick='window.location.href = "<?php echo $_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linkurl'];?>
"'<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTINGS_LINK']->value['linklabel'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate("SINGLE_".($_smarty_tpl->tpl_vars['MODULE_NAME']->value),$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><?php }?><?php } ?></ul></span></span><?php }?></div><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?></td><?php } ?></tr></table></div></div></div></div>
<?php }} ?>