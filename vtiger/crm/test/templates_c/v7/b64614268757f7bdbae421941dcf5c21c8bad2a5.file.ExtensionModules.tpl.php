<?php /* Smarty version Smarty-3.1.7, created on 2018-12-17 11:17:18
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/ExtensionStore/ExtensionModules.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21313491705c175486e07931-20092200%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b64614268757f7bdbae421941dcf5c21c8bad2a5' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/ExtensionStore/ExtensionModules.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21313491705c175486e07931-20092200',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'REGISTRATION_STATUS' => 0,
    'PASSWORD_STATUS' => 0,
    'EXTENSIONS_LIST' => 0,
    'EXTENSION' => 0,
    'EXTENSIONS_COUNT' => 0,
    'QUALIFIED_MODULE' => 0,
    'EXTENSION_MODULE_MODEL' => 0,
    'SUMMARY' => 0,
    'imageSource' => 0,
    'ON_RATINGS' => 0,
    'IS_AUTH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c1754870f39c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c1754870f39c')) {function content_5c1754870f39c($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/webroot/ROOT/libraries/Smarty/libs/plugins/modifier.truncate.php';
?>

<div class="row"><?php $_smarty_tpl->tpl_vars['IS_AUTH'] = new Smarty_variable(($_smarty_tpl->tpl_vars['REGISTRATION_STATUS']->value&&$_smarty_tpl->tpl_vars['PASSWORD_STATUS']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['EXTENSIONS_COUNT'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['EXTENSION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['EXTENSION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['EXTENSIONS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['EXTENSION']->key => $_smarty_tpl->tpl_vars['EXTENSION']->value){
$_smarty_tpl->tpl_vars['EXTENSION']->_loop = true;
?><?php if (!$_smarty_tpl->tpl_vars['EXTENSION']->value->isVtigerCompatible()){?><?php continue 1?><?php }?><?php $_smarty_tpl->tpl_vars['EXTENSIONS_COUNT'] = new Smarty_variable($_smarty_tpl->tpl_vars['EXTENSIONS_COUNT']->value+1, null, 0);?><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isAlreadyExists()){?><?php $_smarty_tpl->tpl_vars['EXTENSION_MODULE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['EXTENSION']->value->get('moduleModel'), null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['EXTENSION_MODULE_MODEL'] = new Smarty_variable('false', null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars['IS_FREE'] = new Smarty_variable((($_smarty_tpl->tpl_vars['EXTENSION']->value->get('price')=='Free')||($_smarty_tpl->tpl_vars['EXTENSION']->value->get('price')==0)), null, 0);?><div class="col-lg-4 col-md-6 col-sm-6 " style="margin-bottom:10px;"><div class="extension_container extensionWidgetContainer"><div class="extension_header"><div class="font-x-x-large boxSizingBorderBox"><?php echo vtranslate($_smarty_tpl->tpl_vars['EXTENSION']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><input type="hidden" name="extensionName" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('name');?>
" /><input type="hidden" name="extensionUrl" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('downloadURL');?>
" /><input type="hidden" name="moduleAction" value="<?php if (($_smarty_tpl->tpl_vars['EXTENSION']->value->isAlreadyExists())&&(!$_smarty_tpl->tpl_vars['EXTENSION_MODULE_MODEL']->value->get('trial'))){?><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isUpgradable()){?>Upgrade<?php }else{ ?>Installed<?php }?><?php }else{ ?>Install<?php }?>" /><input type="hidden" name="extensionId" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('id');?>
" /></div><div style="padding-left:3px;"><div class="row extension_contents" style="border:none;"><div class="col-sm-8 col-xs-8"><div class="row extensionDescription" style="word-wrap:break-word;margin: 0px;"><?php $_smarty_tpl->tpl_vars['SUMMARY'] = new Smarty_variable($_smarty_tpl->tpl_vars['EXTENSION']->value->get('summary'), null, 0);?><?php if (empty($_smarty_tpl->tpl_vars['SUMMARY']->value)){?><?php ob_start();?><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['EXTENSION']->value->get('description'),100);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['SUMMARY'] = new Smarty_variable($_tmp1, null, 0);?><?php }?><?php echo $_smarty_tpl->tpl_vars['SUMMARY']->value;?>
</div></div><div class="col-sm-4 col-xs-4"><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->get('thumbnailURL')!=null){?><?php $_smarty_tpl->tpl_vars['imageSource'] = new Smarty_variable($_smarty_tpl->tpl_vars['EXTENSION']->value->get('thumbnailURL'), null, 0);?><img width="100%" height="100%" class="thumbnailImage" src="<?php echo $_smarty_tpl->tpl_vars['imageSource']->value;?>
"/><?php }else{ ?><i class="fa fa-picture-o" style="color:#ddd;font-size: 90px;" title="Image not available"></i><?php }?></div></div><div class="extensionInfo"><div class="row"><?php $_smarty_tpl->tpl_vars['ON_RATINGS'] = new Smarty_variable($_smarty_tpl->tpl_vars['EXTENSION']->value->get('avgrating'), null, 0);?><div class="col-sm-5 col-xs-5"><span class="rating" data-score="<?php echo $_smarty_tpl->tpl_vars['ON_RATINGS']->value;?>
" data-readonly=true></span><span><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->get('avgrating')){?>&nbsp;(<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('avgrating');?>
)<?php }?></span></div><div class="col-sm-7 col-xs-7"><div class="pull-right"><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isVtigerCompatible()){?><button class="btn btn-sm btn-default installExtension addButton" style="margin-right:5px;"><?php echo vtranslate('LBL_MORE_DETAILS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isAlreadyExists()){?><?php if (($_smarty_tpl->tpl_vars['EXTENSION']->value->isUpgradable())){?><button class="oneclickInstallFree btn btn-success btn-sm margin0px <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value){?>authenticated <?php }else{ ?> loginRequired<?php }?>"><?php echo vtranslate('LBL_UPGRADE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['EXTENSION_MODULE_MODEL']->value!='false'&&$_smarty_tpl->tpl_vars['EXTENSION_MODULE_MODEL']->value->get('trial')){?><span class="alert alert-info"><?php echo vtranslate('LBL_TRIAL_INSTALLED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><?php }else{ ?><span class="alert alert-info" style="vertical-align:middle; padding: 3px 8px;"><?php echo vtranslate('LBL_INSTALLED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><?php }?><?php if (!($_smarty_tpl->tpl_vars['EXTENSION']->value->get('price')=='Free'||$_smarty_tpl->tpl_vars['EXTENSION']->value->get('price')==0)){?>&nbsp;&nbsp;<button class="oneclickInstallPaid btn btn-info <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value){?>authenticated <?php }else{ ?> loginRequired<?php }?>" data-trial=<?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->get('trialdays')>0){?>true<?php }else{ ?>false<?php }?>><?php echo vtranslate('LBL_BUY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
$<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('price');?>
</button><?php }?><?php }?><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->get('price')=='Free'||$_smarty_tpl->tpl_vars['EXTENSION']->value->get('price')==0){?><button class="oneclickInstallFree btn btn-success btn-sm <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value){?>authenticated <?php }else{ ?> loginRequired<?php }?>"><?php echo vtranslate('LBL_INSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php }else{ ?><button class="oneclickInstallPaid btn btn-info btn-sm <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value){?>authenticated <?php }else{ ?> loginRequired<?php }?>" data-trial=false><?php echo vtranslate('LBL_BUY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
$<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('price');?>
</button><?php }?><?php }?><?php }else{ ?><span class="alert alert-error"><?php echo vtranslate('LBL_EXTENSION_NOT_COMPATABLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><?php }?></div></div></div></div></div></div></div><?php } ?><?php if (empty($_smarty_tpl->tpl_vars['EXTENSIONS_LIST']->value)||$_smarty_tpl->tpl_vars['EXTENSIONS_COUNT']->value==0){?><div class="row"><div class="col-sm-2 col-xs-2"></div><div class="col-sm-8 col-xs-8"><br><br><br><h3><center> <?php echo vtranslate('LBL_NO_EXTENSIONS_FOUND',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 </center></h3></div><div class="col-sm-2 col-xs-2"></div></div><?php }?></div><?php }} ?>