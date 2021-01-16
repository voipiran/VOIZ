<?php /* Smarty version Smarty-3.1.7, created on 2019-02-16 13:24:45
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/EmailTemplates/ModuleHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160204875c67dde5ee5565-33198519%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '71022c33de1109f2944f6924966d911645d0dd31' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/EmailTemplates/ModuleHeader.tpl',
      1 => 1522233378,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160204875c67dde5ee5565-33198519',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'MODULE_MODEL' => 0,
    'RECORD' => 0,
    'MODULE_BASIC_ACTIONS' => 0,
    'BASIC_ACTION' => 0,
    'SELECTED_MENU_CATEGORY' => 0,
    'FIELDS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c67dde604264',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c67dde604264')) {function content_5c67dde604264($_smarty_tpl) {?>

<div class="col-sm-12 col-xs-12 module-action-bar clearfix coloredBorderTop"><div class="module-action-content clearfix"><div class="col-lg-5 col-md-5 module-breadcrumb"><?php $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_variable(Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><a title="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
" href='<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultUrl();?>
'><h4 class="module-title pull-left text-uppercase">&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</h4></a><p class="current-filter-name filter-name pull-left cursorPointer">&nbsp;&nbsp;<span class="fa fa-angle-right pull-left" aria-hidden="true"></span><?php if ($_REQUEST['view']=='List'){?><?php echo vtranslate('LBL_FILTER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?>&nbsp;<?php if ($_REQUEST['view']=='Detail'){?><a title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('templatename');?>
">&nbsp;<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('templatename');?>
&nbsp;</a><?php }?><?php if ($_smarty_tpl->tpl_vars['RECORD']->value&&$_REQUEST['view']=='Edit'){?><a title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('templatename');?>
">&nbsp;<?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('templatename');?>
 &nbsp;</a><?php }elseif($_REQUEST['view']=='Edit'){?><a>&nbsp;<?php echo vtranslate('LBL_ADDING_NEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a><?php }?></p></div><div class="col-lg-7 col-md-7 pull-right"><div id="appnav" class="navbar-right"><ul class="nav navbar-nav"><?php  $_smarty_tpl->tpl_vars['BASIC_ACTION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BASIC_ACTION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_BASIC_ACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BASIC_ACTION']->key => $_smarty_tpl->tpl_vars['BASIC_ACTION']->value){
$_smarty_tpl->tpl_vars['BASIC_ACTION']->_loop = true;
?><li><button id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_basicAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getLabel());?>
" type="button" class="btn addButton btn-default module-buttons"<?php if (stripos($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getUrl(),'javascript:')===0){?>onclick='<?php echo substr($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getUrl(),strlen("javascript:"));?>
;'<?php }else{ ?>onclick='window.location.href = "<?php echo $_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getUrl();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
"'<?php }?>><div class="fa <?php echo $_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getIcon();?>
" aria-hidden="true"></div>&nbsp;&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></li><?php } ?></ul></div></div></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value!=null){?><script type="text/javascript">var uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}}};})();</script><?php }?></div><?php }} ?>