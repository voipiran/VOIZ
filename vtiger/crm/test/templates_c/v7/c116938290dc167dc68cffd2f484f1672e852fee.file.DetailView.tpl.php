<?php /* Smarty version Smarty-3.1.7, created on 2018-11-19 14:12:40
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Profiles/DetailView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:379914865bf293a03af312-96363502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c116938290dc167dc68cffd2f484f1672e852fee' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Profiles/DetailView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '379914865bf293a03af312-96363502',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'RECORD_MODEL' => 0,
    'ENABLE_IMAGE_PATH' => 0,
    'DISABLE_IMAGE_PATH' => 0,
    'PROFILE_MODULE' => 0,
    'MODULE_PERMISSION' => 0,
    'BASIC_ACTION_ORDER' => 0,
    'ACTION_ID' => 0,
    'ALL_BASIC_ACTIONS' => 0,
    'ACTION_MODEL' => 0,
    'MODULE_ACTION_PERMISSION' => 0,
    'IS_RESTRICTED_MODULE' => 0,
    'TABID' => 0,
    'MODULE_NAME' => 0,
    'FIELD_MODEL' => 0,
    'COUNTER' => 0,
    'DATA_VALUE' => 0,
    'FIELD_ID' => 0,
    'ALL_UTILITY_ACTIONS' => 0,
    'ALL_UTILITY_ACTIONS_ARRAY' => 0,
    'index' => 0,
    'colspan' => 0,
    'ACTIONNAME_STATUS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bf293a05929f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bf293a05929f')) {function content_5bf293a05929f($_smarty_tpl) {?>



<div class="detailViewContainer full-height"><div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 col-xs-12 main-scroll"><div class="detailViewTitle form-horizontal" id="profilePageHeader"><div class="clearfix row"><div class="col-sm-10 col-md-10 col-sm-10"><h4><?php echo vtranslate('LBL_PROFILE_VIEW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><div class="col-sm-2"><div class="btn-group pull-right"><button class="btn btn-default  " type="button" onclick='window.location.href = "<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getEditViewUrl();?>
"'><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div></div><hr><br><div class="profileDetailView detailViewInfo"><div class="row form-group"><div class="col-lg-2 col-md-2 col-sm-2 control-label fieldLabel"><label><?php echo vtranslate('LBL_PROFILE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></div><div class="fieldValue col-lg-6 col-md-6 col-sm-12"  name="profilename" id="profilename" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
"><strong><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
</strong></div></div><div class="row form-group"><div class="col-lg-2 col-md-2 col-sm-2 control-label fieldLabel"><label><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
:</label></div><div class="fieldValue col-lg-6 col-md-6 col-sm-12" name="description" id="description"><strong><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getDescription();?>
</strong></div></div><br><?php ob_start();?><?php echo vimage_path('Enable.png');?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["ENABLE_IMAGE_PATH"] = new Smarty_variable($_tmp1, null, 0);?><?php ob_start();?><?php echo vimage_path('Disable.png');?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["DISABLE_IMAGE_PATH"] = new Smarty_variable($_tmp2, null, 0);?><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalReadPermission()){?><div class="row"><div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-10 col-md-10 col-sm-10"><div><img class="alignMiddle" src="<?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalReadPermission()){?><?php echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;?>
<?php }?>" />&nbsp;<?php echo vtranslate('LBL_VIEW_ALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<div class="input-info-addon"><i class="fa fa-info-circle"></i>&nbsp;<span ><?php echo vtranslate('LBL_VIEW_ALL_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div><div><img class="alignMiddle" src="<?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalWritePermission()){?><?php echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;?>
<?php }?>" />&nbsp;<?php echo vtranslate('LBL_EDIT_ALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<div class="input-info-addon"><i class="fa fa-info-circle"></i>&nbsp;<span><?php echo vtranslate('LBL_EDIT_ALL_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div></div></div></div><?php }?><br><div class="row"><div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-lg-10 col-md-10 col-sm-10"><table class="table table-bordered"><thead><tr class='blockHeader'><th width="27%" style="text-align: left !important"><?php echo vtranslate('LBL_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th width="11%"><?php echo vtranslate('LBL_VIEW_PRVILIGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th width="11%"><?php echo vtranslate('LBL_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th width="11%"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th width="11%"><?php echo vtranslate('LBL_DELETE_PRVILIGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th width="29%" nowrap="nowrap"><?php echo vtranslate('LBL_FIELD_AND_TOOL_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['PROFILE_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PROFILE_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['TABID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModulePermissions(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PROFILE_MODULE']->key => $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value){
$_smarty_tpl->tpl_vars['PROFILE_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['TABID']->value = $_smarty_tpl->tpl_vars['PROFILE_MODULE']->key;
?><?php $_smarty_tpl->tpl_vars['IS_RESTRICTED_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->isRestrictedModule($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName()), null, 0);?><tr><?php $_smarty_tpl->tpl_vars['MODULE_PERMISSION'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModulePermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value), null, 0);?><td data-module-name='<?php echo $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName();?>
' data-module-status='<?php echo $_smarty_tpl->tpl_vars['MODULE_PERMISSION']->value;?>
'><img src="<?php if ($_smarty_tpl->tpl_vars['MODULE_PERMISSION']->value){?><?php echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;?>
<?php }?>"/>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->get('label'),$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName());?>
</td><?php $_smarty_tpl->tpl_vars["BASIC_ACTION_ORDER"] = new Smarty_variable(array(2,3,0,1), null, 0);?><?php  $_smarty_tpl->tpl_vars['ACTION_ID'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ACTION_ID']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['BASIC_ACTION_ORDER']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_ID']->key => $_smarty_tpl->tpl_vars['ACTION_ID']->value){
$_smarty_tpl->tpl_vars['ACTION_ID']->_loop = true;
?><?php $_smarty_tpl->tpl_vars["ACTION_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['ALL_BASIC_ACTIONS']->value[$_smarty_tpl->tpl_vars['ACTION_ID']->value], null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_ACTION_PERMISSION'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['ACTION_MODEL']->value), null, 0);?><td data-action-state='<?php echo $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName();?>
' data-moduleaction-status='<?php echo $_smarty_tpl->tpl_vars['MODULE_ACTION_PERMISSION']->value;?>
' style="text-align: center;"><?php if (!$_smarty_tpl->tpl_vars['IS_RESTRICTED_MODULE']->value&&$_smarty_tpl->tpl_vars['ACTION_MODEL']->value->isModuleEnabled($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value)){?><img src="<?php if ($_smarty_tpl->tpl_vars['MODULE_ACTION_PERMISSION']->value){?><?php echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;?>
<?php }?>" /><?php }?></td><?php } ?><td class="textAlignCenter"><?php if (($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields()&&$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isEntityModule())||$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isUtilityActionEnabled()){?><button type="button" data-handlerfor="fields" data-togglehandler="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" class="btn btn-sm btn-default" style="padding-right: 20px; padding-left: 20px;"><i class="fa fa-chevron-down"></i></button><?php }?></td></tr><tr class="hide"><td colspan="6" class="row" style="padding-left: 5%;padding-right: 5%"><div class="row" data-togglecontent="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" style="display: none"><?php if ($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields()&&$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isEntityModule()){?><div class="col-sm-12"><label class="pull-left"><strong><?php echo vtranslate('LBL_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Calendar'){?> <?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_TASKS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php }?></strong></label><div class="pull-right"><span class="mini-slider-control ui-slider" data-value="0"><a style="margin-top: 3px" class="ui-slider-handle"></a></span><span style="margin: 0 20px;"><?php echo vtranslate('LBL_INIVISIBLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;<span class="mini-slider-control ui-slider" data-value="1"><a style="margin-top: 3px" class="ui-slider-handle"></a></span><span style="margin: 0 20px;"><?php echo vtranslate('LBL_READ_ONLY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;<span class="mini-slider-control ui-slider" data-value="2"><a style="margin-top: 3px" class="ui-slider-handle"></a></span><span style="margin: 0 14px;"><?php echo vtranslate('LBL_WRITE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div><div class="clearfix"></div></div><table class="table table-bordered"><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration++;
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->last = $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration === $_smarty_tpl->tpl_vars['FIELD_MODEL']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["fields"]['last'] = $_smarty_tpl->tpl_vars['FIELD_MODEL']->last;
?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isActiveField()&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('displaytype')!='6'){?><?php $_smarty_tpl->tpl_vars["FIELD_ID"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value%3==0){?><tr><?php }?><td class="col-sm-4"><?php $_smarty_tpl->tpl_vars["DATA_VALUE"] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModuleFieldPermissionValue($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['DATA_VALUE']->value==0){?><span class="mini-slider-control ui-slider col-sm-1" data-value="0" data-range-input='<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
' style="width: 0px;"><a style="margin-top: 4px;margin-left: -13px;" class="ui-slider-handle"></a></span><?php }elseif($_smarty_tpl->tpl_vars['DATA_VALUE']->value==1){?><span class="mini-slider-control ui-slider col-sm-1" data-value="1" data-range-input='<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
' style="width: 0px;"><a style="margin-top: 4px;margin-left: -13px;" class="ui-slider-handle"></a></span><?php }else{ ?><span class="mini-slider-control ui-slider col-sm-1" data-value="2" data-range-input='<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
' style="width: 0px;"><a style="margin-top: 4px;margin-left: -13px;" class="ui-slider-handle"></a></span><?php }?>&nbsp;<span class="col-sm-9" style="padding-right: 0px;"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName());?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()){?><span class="redColor">*</span><?php }?></span></td><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fields']['last']||($_smarty_tpl->tpl_vars['COUNTER']->value+1)%3==0){?></tr><?php }?><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?><?php }?><?php } ?></table><?php }?></div></td></tr><tr class="hide"><td colspan="6" class="row" style="padding-left: 5%;padding-right: 5%"><div class="row" data-togglecontent="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" style="display: none"><div class="col-sm-12"><label class="themeTextColor font-x-large pull-left"><strong><?php echo vtranslate('LBL_TOOLS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></label></div><table class="table table-bordered table-striped"><?php $_smarty_tpl->tpl_vars['UTILITY_ACTION_COUNT'] = new Smarty_variable(0, null, 0);?><?php $_smarty_tpl->tpl_vars["ALL_UTILITY_ACTIONS_ARRAY"] = new Smarty_variable(array(), null, 0);?><?php  $_smarty_tpl->tpl_vars['ACTION_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ACTION_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_MODEL']->key => $_smarty_tpl->tpl_vars['ACTION_MODEL']->value){
$_smarty_tpl->tpl_vars['ACTION_MODEL']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->isModuleEnabled($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value)){?><?php $_smarty_tpl->tpl_vars["testArray"] = new Smarty_variable(array_push($_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS_ARRAY']->value,$_smarty_tpl->tpl_vars['ACTION_MODEL']->value), null, 0);?><?php }?><?php } ?><?php  $_smarty_tpl->tpl_vars['ACTION_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ACTION_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS_ARRAY']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['ACTION_MODEL']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['ACTION_MODEL']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["actions"]['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_MODEL']->key => $_smarty_tpl->tpl_vars['ACTION_MODEL']->value){
$_smarty_tpl->tpl_vars['ACTION_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['ACTION_MODEL']->iteration++;
 $_smarty_tpl->tpl_vars['ACTION_MODEL']->last = $_smarty_tpl->tpl_vars['ACTION_MODEL']->iteration === $_smarty_tpl->tpl_vars['ACTION_MODEL']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["actions"]['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["actions"]['last'] = $_smarty_tpl->tpl_vars['ACTION_MODEL']->last;
?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['actions']['index']%3==0){?><tr><?php }?><?php $_smarty_tpl->tpl_vars['ACTION_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->get('actionid'), null, 0);?><?php $_smarty_tpl->tpl_vars['ACTIONNAME_STATUS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['ACTION_ID']->value), null, 0);?><td <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['actions']['last']&&(($_smarty_tpl->getVariable('smarty')->value['foreach']['actions']['index']+1)%3!=0)){?><?php $_smarty_tpl->tpl_vars["index"] = new Smarty_variable(($_smarty_tpl->getVariable('smarty')->value['foreach']['actions']['index']+1)%3, null, 0);?><?php $_smarty_tpl->tpl_vars["colspan"] = new Smarty_variable(4-$_smarty_tpl->tpl_vars['index']->value, null, 0);?>colspan="<?php echo $_smarty_tpl->tpl_vars['colspan']->value;?>
"<?php }?> data-action-name='<?php echo $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName();?>
' data-actionname-status='<?php echo $_smarty_tpl->tpl_vars['ACTIONNAME_STATUS']->value;?>
'><img class="alignMiddle" src="<?php if ($_smarty_tpl->tpl_vars['ACTIONNAME_STATUS']->value){?><?php echo $_smarty_tpl->tpl_vars['ENABLE_IMAGE_PATH']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['DISABLE_IMAGE_PATH']->value;?>
<?php }?>" />&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName();?>
</td><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['actions']['last']||($_smarty_tpl->getVariable('smarty')->value['foreach']['actions']['index']+1)%3==0){?></div><?php }?><?php } ?></table></div></td></tr><?php } ?></tbody></table></div></div></div></div></div></div><?php }} ?>