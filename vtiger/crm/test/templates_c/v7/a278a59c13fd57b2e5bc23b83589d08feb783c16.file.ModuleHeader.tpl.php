<?php /* Smarty version Smarty-3.1.7, created on 2019-02-06 10:24:19
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Documents/ModuleHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3022215045c5a849b340ec2-94825896%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a278a59c13fd57b2e5bc23b83589d08feb783c16' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Documents/ModuleHeader.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3022215045c5a849b340ec2-94825896',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'MODULE_MODEL' => 0,
    'DEFAULT_FILTER_ID' => 0,
    'CVURL' => 0,
    'DEFAULT_FILTER_URL' => 0,
    'SELECTED_MENU_CATEGORY' => 0,
    'VIEWID' => 0,
    'CUSTOM_VIEWS' => 0,
    'FILTER_TYPES' => 0,
    'FILTERS' => 0,
    'CVNAME' => 0,
    'RECORD' => 0,
    'MODULE_BASIC_ACTIONS' => 0,
    'BASIC_ACTION' => 0,
    'MODULE_NAME' => 0,
    'MODULE_SETTING_ACTIONS' => 0,
    'SETTING' => 0,
    'FIELDS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5a849b4a9c5',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5a849b4a9c5')) {function content_5c5a849b4a9c5($_smarty_tpl) {?>

<div class="col-sm-12 col-xs-12 module-action-bar clearfix coloredBorderTop"><div class="module-action-content clearfix"><div class="col-lg-7 col-md-7 module-breadcrumb module-breadcrumb-<?php echo $_REQUEST['view'];?>
"><?php $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_variable(Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultViewName()!='List'){?><?php $_smarty_tpl->tpl_vars['DEFAULT_FILTER_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultUrl(), null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['DEFAULT_FILTER_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultCustomFilter(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['DEFAULT_FILTER_ID']->value){?><?php $_smarty_tpl->tpl_vars['CVURL'] = new Smarty_variable(("&viewname=").($_smarty_tpl->tpl_vars['DEFAULT_FILTER_ID']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['DEFAULT_FILTER_URL'] = new Smarty_variable(($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrl()).($_smarty_tpl->tpl_vars['CVURL']->value), null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['DEFAULT_FILTER_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrlWithAllFilter(), null, 0);?><?php }?><?php }?><a title="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
" href='<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FILTER_URL']->value;?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
'><h4 class="module-title pull-left textOverflowEllipsis text-uppercase">&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</h4></a><?php if ($_SESSION['lvs'][$_smarty_tpl->tpl_vars['MODULE']->value]['viewname']){?><?php $_smarty_tpl->tpl_vars['VIEWID'] = new Smarty_variable($_SESSION['lvs'][$_smarty_tpl->tpl_vars['MODULE']->value]['viewname'], null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['VIEWID']->value){?><?php  $_smarty_tpl->tpl_vars['FILTER_TYPES'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FILTER_TYPES']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FILTER_TYPES']->key => $_smarty_tpl->tpl_vars['FILTER_TYPES']->value){
$_smarty_tpl->tpl_vars['FILTER_TYPES']->_loop = true;
?><?php  $_smarty_tpl->tpl_vars['FILTERS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FILTERS']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FILTER_TYPES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FILTERS']->key => $_smarty_tpl->tpl_vars['FILTERS']->value){
$_smarty_tpl->tpl_vars['FILTERS']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['FILTERS']->value->get('cvid')==$_smarty_tpl->tpl_vars['VIEWID']->value){?><?php $_smarty_tpl->tpl_vars['CVNAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FILTERS']->value->get('viewname'), null, 0);?><?php break 1?><?php }?><?php } ?><?php } ?><p  class="current-filter-name filter-name pull-left cursorPointer" title="<?php echo $_smarty_tpl->tpl_vars['CVNAME']->value;?>
">&nbsp;<span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a  href='<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrl();?>
&viewname=<?php echo $_smarty_tpl->tpl_vars['VIEWID']->value;?>
'>&nbsp;<?php echo $_smarty_tpl->tpl_vars['CVNAME']->value;?>
&nbsp;</a> </p><?php }?><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME'] = new Smarty_variable(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['RECORD']->value&&$_REQUEST['view']=='Edit'){?><p class="current-filter-name filter-name pull-left "><span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
">&nbsp;<?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
&nbsp;</a></p><?php }elseif($_REQUEST['view']=='Edit'){?><p class="current-filter-name filter-name pull-left "><span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a>&nbsp;<?php echo vtranslate('LBL_ADDING_NEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a></p><?php }?><?php if ($_REQUEST['view']=='Detail'){?><p class="current-filter-name filter-name pull-left"><span class="fa fa-angle-right pull-left" aria-hidden="true"></span><a title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
">&nbsp;<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('label');?>
&nbsp;</a></p><?php }?></div><div class="col-lg-5 col-md-5 pull-right "><div id="appnav" class="navbar-right"><ul class="nav navbar-nav"><?php  $_smarty_tpl->tpl_vars['BASIC_ACTION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BASIC_ACTION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_BASIC_ACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BASIC_ACTION']->key => $_smarty_tpl->tpl_vars['BASIC_ACTION']->value){
$_smarty_tpl->tpl_vars['BASIC_ACTION']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getLabel()=='LBL_ADD_RECORD'){?><li><div><button type="button" class="btn btn-default module-buttons dropdown-toggle" data-toggle="dropdown"><span class="fa fa-plus" title="<?php echo vtranslate('LBL_NEW_DOCUMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></span>&nbsp;&nbsp;<?php echo vtranslate('LBL_NEW_DOCUMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="caret"></span></button><ul class="dropdown-menu"><li class="dropdown-header"><i class="fa fa-upload"></i> <?php echo vtranslate('LBL_FILE_UPLOAD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</li><li id="VtigerAction"><a href="javascript:Documents_Index_Js.uploadTo('Vtiger')"><img style="  margin-top: -3px;margin-right: 4%;" title="Vtiger" alt="Vtiger" src="layouts/v7/skins//images/Vtiger.png"><?php ob_start();?><?php echo vtranslate('LBL_VTIGER',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp1=ob_get_clean();?><?php echo vtranslate('LBL_TO_SERVICE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_tmp1);?>
</a></li><li role="separator" class="divider"></li><li class="dropdown-header"><i class="fa fa-link"></i> <?php echo vtranslate('LBL_LINK_EXTERNAL_DOCUMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</li><li id="shareDocument"><a href="javascript:Documents_Index_Js.createDocument('E')">&nbsp;<i class="fa fa-external-link"></i>&nbsp; <?php ob_start();?><?php echo vtranslate('LBL_FILE_URL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp2=ob_get_clean();?><?php echo vtranslate('LBL_FROM_SERVICE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_tmp2);?>
</a></li><li role="separator" class="divider"></li><li id="createDocument"><a href="javascript:Documents_Index_Js.createDocument('W')"><i class="fa fa-file-text"></i> <?php ob_start();?><?php echo vtranslate('SINGLE_Documents',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp3=ob_get_clean();?><?php echo vtranslate('LBL_CREATE_NEW',$_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_tmp3);?>
</a></li></ul></div></li><?php }?><?php } ?><?php if (count($_smarty_tpl->tpl_vars['MODULE_SETTING_ACTIONS']->value)>0){?><li><div class="settingsIcon"><button type="button" class="btn btn-default module-buttons dropdown-toggle" data-toggle="dropdown"><span class="fa fa-wrench" aria-hidden="true" title="<?php echo vtranslate('LBL_SETTINGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></span>&nbsp;<?php echo vtranslate('LBL_CUSTOMIZE','Reports');?>
&nbsp; <span class="caret"></span></button><ul class="detailViewSetting dropdown-menu"><?php  $_smarty_tpl->tpl_vars['SETTING'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SETTING']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_SETTING_ACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SETTING']->key => $_smarty_tpl->tpl_vars['SETTING']->value){
$_smarty_tpl->tpl_vars['SETTING']->_loop = true;
?><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel());?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4=="%s Numbering"){?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
"><a href=<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><?php }else{ ?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
"><a href=<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate("SINGLE_".($_smarty_tpl->tpl_vars['MODULE_NAME']->value),$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><?php }?><?php } ?></ul></div></li><?php }?></ul></div></div></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value!=null){?><script type="text/javascript">var uimeta = (function() {var fieldInfo  = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function(name, property) {if(name && property === undefined) {return fieldInfo[name];}if(name && property) {return fieldInfo[name][property]}},isMandatory : function(name){if(fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType : function(name){if(fieldInfo[name]) {return fieldInfo[name].type}return false;}}};})();</script><?php }?></div>
<?php }} ?>