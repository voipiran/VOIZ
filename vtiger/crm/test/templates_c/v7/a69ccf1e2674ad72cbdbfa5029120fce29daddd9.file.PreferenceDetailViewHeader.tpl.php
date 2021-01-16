<?php /* Smarty version Smarty-3.1.7, created on 2018-04-16 11:43:32
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Users/PreferenceDetailViewHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8059125155ad44d1ccabc21-79784485%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a69ccf1e2674ad72cbdbfa5029120fce29daddd9' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Users/PreferenceDetailViewHeader.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8059125155ad44d1ccabc21-79784485',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_MODEL' => 0,
    'RECORD' => 0,
    'IMAGE_DETAILS' => 0,
    'IMAGE_INFO' => 0,
    'MODULE_NAME' => 0,
    'DETAILVIEW_LINKS' => 0,
    'DETAIL_VIEW_BASIC_LINK' => 0,
    'MODULE' => 0,
    'DETAIL_VIEW_LINK' => 0,
    'CURRENT_USER_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ad44d1cd2f74',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad44d1cd2f74')) {function content_5ad44d1cd2f74($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars["MODULE_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name'), null, 0);?><input id="recordId" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
" /><div class="detailViewContainer"><div class="detailViewTitle" id="prefPageHeader"><div class="col-lg-12 col-sm-12 col-xs-12"><div class="col-xs-8"><?php $_smarty_tpl->tpl_vars['IMAGE_DETAILS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->getImageDetails(), null, 0);?><?php  $_smarty_tpl->tpl_vars['IMAGE_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['IMAGE_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['ITER'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['IMAGE_INFO']->key => $_smarty_tpl->tpl_vars['IMAGE_INFO']->value){
$_smarty_tpl->tpl_vars['IMAGE_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['ITER']->value = $_smarty_tpl->tpl_vars['IMAGE_INFO']->key;
?><?php if (!empty($_smarty_tpl->tpl_vars['IMAGE_INFO']->value['path'])&&!empty($_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'])){?><span class="logo col-xs-2"><img height="75px" width="75px" src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['path'];?>
_<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
" data-image-id="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['id'];?>
"></span><?php }?><?php } ?><?php if ($_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0]['id']==null){?><span class="logo col-xs-2"><i class="fa fa-user" style="font-size: 75px"></i></span><?php }?><span class="col-xs-9"><span id="myPrefHeading"><h3><?php echo vtranslate('LBL_MY_PREFERENCES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 </h3></span><span><?php echo vtranslate('LBL_USERDETAIL_INFO',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;&nbsp;"<b><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
</b>"</span></span></div><div class="col-xs-4"><div class="row detailViewButtoncontainer"><div class="btn-group pull-right"><?php  $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWPREFERENCE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->key => $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value){
$_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->_loop = true;
?><button class="btn btn-default"<?php if ($_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->isPageLoadLink()){?>onclick="window.location.href='<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->getUrl();?>
'"<?php }else{ ?>onclick=<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->getUrl();?>
<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button><?php } ?><?php if (count($_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEW'])>0){?><button class="btn btn-default" data-toggle="dropdown" href="javascript:void(0);"><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<i class="caret"></i></button><ul class="dropdown-menu pull-right"><?php  $_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEW']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->key => $_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value){
$_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getLabel()=="Delete"){?><?php if ($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->isAdminUser()&&$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->getId()!=$_smarty_tpl->tpl_vars['RECORD']->value->getId()){?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_detailView_moreAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getLabel());?>
"><a href=<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getUrl();?>
 ><?php echo vtranslate($_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }?><?php }else{ ?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_detailView_moreAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getLabel());?>
"><a href=<?php echo $_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getUrl();?>
 ><?php echo vtranslate($_smarty_tpl->tpl_vars['DETAIL_VIEW_LINK']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }?><?php } ?></ul><?php }?></div></div></div></div><div class="detailViewInfo userPreferences"><div class="details col-xs-12"><br><?php }} ?>