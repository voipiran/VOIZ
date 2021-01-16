<?php /* Smarty version Smarty-3.1.7, created on 2018-04-16 11:43:32
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Vtiger/ModuleHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12644974435ad44d1c866658-97577553%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ecb5b28d06b09a0d3c7ea3e6399cb0684897d3ec' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Vtiger/ModuleHeader.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12644974435ad44d1c866658-97577553',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'USER_MODEL' => 0,
    'MODULE' => 0,
    'VIEW' => 0,
    'ACTIVE_BLOCK' => 0,
    'QUALIFIED_MODULE' => 0,
    'MODULE_MODEL' => 0,
    'ALLOWED_MODULES' => 0,
    'URL' => 0,
    'PAGETITLE' => 0,
    'RECORD' => 0,
    'MODULE_BASIC_ACTIONS' => 0,
    'BASIC_ACTION' => 0,
    'LISTVIEW_LINKS' => 0,
    'QUALIFIEDMODULE' => 0,
    'SETTING' => 0,
    'RESTRICTED_MODULE_LIST' => 0,
    'LISTVIEW_BASICACTION' => 0,
    'FIELDS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ad44d1cbae16',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad44d1cbae16')) {function content_5ad44d1cbae16($_smarty_tpl) {?>

<div class="col-sm-12 col-xs-12 module-action-bar clearfix coloredBorderTop"><div class="module-action-content clearfix"><div class="col-lg-7 col-md-7"><?php if ($_smarty_tpl->tpl_vars['USER_MODEL']->value->isAdminUser()){?><a title="<?php echo vtranslate('Home',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" href='index.php?module=Vtiger&parent=Settings&view=Index'><h4 class="module-title pull-left text-uppercase"><?php echo vtranslate('LBL_HOME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </h4></a>&nbsp;<span class="fa fa-angle-right pull-left <?php if ($_smarty_tpl->tpl_vars['VIEW']->value=='Index'&&$_smarty_tpl->tpl_vars['MODULE']->value=='Vtiger'){?> hide <?php }?>" aria-hidden="true" style="padding-top: 12px;padding-left: 5px; padding-right: 5px;"></span><?php }?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value!='Vtiger'||$_REQUEST['view']!='Index'){?><?php if ($_smarty_tpl->tpl_vars['ACTIVE_BLOCK']->value['block']){?><span class="current-filter-name filter-name pull-left"><?php echo vtranslate($_smarty_tpl->tpl_vars['ACTIVE_BLOCK']->value['block'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="fa fa-angle-right" aria-hidden="true"></span>&nbsp;</span><?php }?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value!='Vtiger'){?><?php $_smarty_tpl->tpl_vars['ALLOWED_MODULES'] = new Smarty_variable(explode(",",'Users,Profiles,Groups,Roles,Webforms,Workflows'), null, 0);?><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value&&in_array($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['ALLOWED_MODULES']->value)){?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Webforms'){?><?php $_smarty_tpl->tpl_vars['URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getListViewUrl(), null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultUrl(), null, 0);?><?php }?><?php if (strpos($_smarty_tpl->tpl_vars['URL']->value,'parent')==''){?><?php $_smarty_tpl->tpl_vars['URL'] = new Smarty_variable((($_smarty_tpl->tpl_vars['URL']->value).('&parent=')).($_REQUEST['parent']), null, 0);?><?php }?><?php }?><span class="current-filter-name settingModuleName filter-name pull-left"><?php if ($_REQUEST['view']=='Calendar'){?><?php if ($_REQUEST['mode']=='Edit'){?><a href="<?php echo ((((("index.php?module=").($_REQUEST['module'])).('&parent=')).($_REQUEST['parent'])).('&view=')).($_REQUEST['view']);?>
"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['PAGETITLE']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo vtranslate($_tmp1,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a>&nbsp;<span class="fa fa-angle-right" aria-hidden="true"></span>&nbsp;<?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 :&nbsp;<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['PAGETITLE']->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo vtranslate($_tmp2,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->getName();?>
<?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['PAGETITLE']->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo vtranslate($_tmp3,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="fa fa-angle-right" aria-hidden="true"></span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->getName();?>
<?php }?><?php }elseif($_REQUEST['view']!='List'&&$_REQUEST['module']=='Users'){?><?php if ($_REQUEST['view']=='PreferenceEdit'){?><a href="<?php echo ((((("index.php?module=").($_REQUEST['module'])).('&parent=')).($_REQUEST['parent'])).('&view=PreferenceDetail&record=')).($_REQUEST['record']);?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['ACTIVE_BLOCK']->value['block'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;</a><span class="fa fa-angle-right" aria-hidden="true"></span>&nbsp;<?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 :&nbsp;<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->getName();?>
<?php }elseif($_REQUEST['view']=='Edit'||$_REQUEST['view']=='Detail'){?><a href="<?php echo $_smarty_tpl->tpl_vars['URL']->value;?>
"><?php if ($_REQUEST['extensionModule']){?><?php echo $_REQUEST['extensionModule'];?>
<?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['PAGETITLE']->value;?>
<?php $_tmp4=ob_get_clean();?><?php echo vtranslate($_tmp4,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?>&nbsp;</a><span class="fa fa-angle-right" aria-hidden="true"></span>&nbsp;<?php if ($_REQUEST['view']=='Edit'){?><?php if ($_smarty_tpl->tpl_vars['RECORD']->value){?><?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 :&nbsp;<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
<?php }else{ ?><?php echo vtranslate('LBL_ADDING_NEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
<?php }?><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->getName();?>
<?php }?><?php }elseif($_smarty_tpl->tpl_vars['URL']->value&&strpos($_smarty_tpl->tpl_vars['URL']->value,$_REQUEST['view'])==''){?><a href="<?php echo $_smarty_tpl->tpl_vars['URL']->value;?>
"><?php if ($_REQUEST['extensionModule']){?><?php echo $_REQUEST['extensionModule'];?>
<?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['PAGETITLE']->value;?>
<?php $_tmp5=ob_get_clean();?><?php echo vtranslate($_tmp5,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?></a>&nbsp;<span class="fa fa-angle-right" aria-hidden="true"></span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['RECORD']->value){?><?php if ($_REQUEST['view']=='Edit'){?><?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 :&nbsp;<?php }?><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
<?php }?><?php }else{ ?>&nbsp;<?php if ($_REQUEST['extensionModule']){?><?php echo $_REQUEST['extensionModule'];?>
<?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['PAGETITLE']->value;?>
<?php $_tmp6=ob_get_clean();?><?php echo vtranslate($_tmp6,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?><?php }?></span><?php }else{ ?><?php if ($_REQUEST['view']=='TaxIndex'){?><?php $_smarty_tpl->tpl_vars['SELECTED_MODULE'] = new Smarty_variable('LBL_TAX_MANAGEMENT', null, 0);?><?php }elseif($_REQUEST['view']=='TermsAndConditionsEdit'){?><?php $_smarty_tpl->tpl_vars['SELECTED_MODULE'] = new Smarty_variable('LBL_TERMS_AND_CONDITIONS', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['SELECTED_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['ACTIVE_BLOCK']->value['menu'], null, 0);?><?php }?><span class="current-filter-name filter-name pull-left" style='width:50%;'><span class="display-inline-block"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['PAGETITLE']->value;?>
<?php $_tmp7=ob_get_clean();?><?php echo vtranslate($_tmp7,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></span><?php }?><?php }?></div><div class="col-lg-5 col-md-5 pull-right"><div id="appnav" class="navbar-right"><ul class="nav navbar-nav"><?php  $_smarty_tpl->tpl_vars['BASIC_ACTION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BASIC_ACTION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_BASIC_ACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BASIC_ACTION']->key => $_smarty_tpl->tpl_vars['BASIC_ACTION']->value){
$_smarty_tpl->tpl_vars['BASIC_ACTION']->_loop = true;
?><li><?php if ($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getLabel()=='LBL_IMPORT'){?><button id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_basicAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getLabel());?>
" type="button" class="btn addButton btn-default module-buttons"<?php if (stripos($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getUrl(),'javascript:')===0){?>onclick='<?php echo substr($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getUrl(),strlen("javascript:"));?>
;'<?php }else{ ?>onclick="Vtiger_Import_Js.triggerImportAction('<?php echo $_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getUrl();?>
')"<?php }?>><div class="fa <?php echo $_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getIcon();?>
" aria-hidden="true"></div>&nbsp;&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php }else{ ?><button type="button" class="btn addButton btn-default module-buttons"id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_basicAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getLabel());?>
"<?php if (stripos($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getUrl(),'javascript:')===0){?>onclick='<?php echo substr($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getUrl(),strlen("javascript:"));?>
;'<?php }else{ ?>onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getUrl();?>
"'<?php }?>><div class="fa <?php echo $_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getIcon();?>
" aria-hidden="true"></div>&nbsp;&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['BASIC_ACTION']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php }?></li><?php } ?><?php if (count($_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEWSETTING'])>0){?><?php if (empty($_smarty_tpl->tpl_vars['QUALIFIEDMODULE']->value)){?><?php $_smarty_tpl->tpl_vars['QUALIFIEDMODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE']->value, null, 0);?><?php }?><li><div class="settingsIcon"><button type="button" class="btn btn-default module-buttons dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="<?php echo vtranslate('LBL_SETTINGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><span class="fa fa-wrench" aria-hidden="true"></span>&nbsp; <span class="caret"></span></button><ul class="detailViewSetting dropdown-menu"><?php  $_smarty_tpl->tpl_vars['SETTING'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SETTING']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEWSETTING']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SETTING']->key => $_smarty_tpl->tpl_vars['SETTING']->value){
$_smarty_tpl->tpl_vars['SETTING']->_loop = true;
?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_setings_lisview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
"><a	<?php if (stripos($_smarty_tpl->tpl_vars['SETTING']->value->getUrl(),'javascript:')===0){?>onclick='<?php echo substr($_smarty_tpl->tpl_vars['SETTING']->value->getUrl(),strlen("javascript:"));?>
;'<?php }else{ ?>onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
"'<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['QUALIFIEDMODULE']->value);?>
</a></li><?php } ?></ul></div></li><?php }?><?php $_smarty_tpl->tpl_vars['RESTRICTED_MODULE_LIST'] = new Smarty_variable(array('Users','EmailTemplates'), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEWBASIC'])>0&&!in_array($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['RESTRICTED_MODULE_LIST']->value)){?><?php if (empty($_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value)){?><?php $_smarty_tpl->tpl_vars['QUALIFIED_MODULE'] = new Smarty_variable(('Settings:').($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php }?><?php  $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEWBASIC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->key => $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Users'){?> <?php $_smarty_tpl->tpl_vars['LANGMODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE']->value, null, 0);?> <?php }?><li><button class="btn btn-default addButton module-buttons"id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_basicAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getLabel());?>
"<?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Workflows'){?>onclick='Settings_Workflows_List_Js.triggerCreate("<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getUrl();?>
&mode=V7Edit")'<?php }else{ ?><?php if (stripos($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getUrl(),'javascript:')===0){?>onclick='<?php echo substr($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getUrl(),strlen("javascript:"));?>
;'<?php }else{ ?>onclick='window.location.href = "<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getUrl();?>
"'<?php }?><?php }?>><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Tags'){?><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_TAG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getIcon()){?><i class="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getIcon();?>
"></i>&nbsp;&nbsp;<?php }?><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?></button></li><?php } ?><?php }?></ul></div></div></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value!=null){?><script type="text/javascript">var uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();</script><?php }?></div>
<?php }} ?>