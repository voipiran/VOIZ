<?php /* Smarty version Smarty-3.1.7, created on 2019-02-05 11:11:19
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/RecentActivities.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1719282605c593e1ff01aa2-86378094%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3b3916aea4ef18596c1660e0e4dba48e2267232' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/RecentActivities.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1719282605c593e1ff01aa2-86378094',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PAGING_MODEL' => 0,
    'RECENT_ACTIVITIES' => 0,
    'RECENT_ACTIVITY' => 0,
    'RELATION' => 0,
    'PROCEED' => 0,
    'USER_MODEL' => 0,
    'IMAGE_DETAILS' => 0,
    'IMAGE_INFO' => 0,
    'MODULE_NAME' => 0,
    'FIELDMODEL' => 0,
    'RELATED_MODULE' => 0,
    'VICON_MODULES' => 0,
    'PERMITTED' => 0,
    'DETAILVIEW_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c593e2022830',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c593e2022830')) {function content_5c593e2022830($_smarty_tpl) {?>

<div class="recentActivitiesContainer" id="updates"><input type="hidden" id="updatesCurrentPage" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->get('page');?>
"/><div class='history'><?php if (!empty($_smarty_tpl->tpl_vars['RECENT_ACTIVITIES']->value)){?><ul class="updates_timeline"><?php  $_smarty_tpl->tpl_vars['RECENT_ACTIVITY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECENT_ACTIVITIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->key => $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value){
$_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['PROCEED'] = new Smarty_variable(true, null, 0);?><?php if (($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRelationLink())||($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRelationUnLink())){?><?php $_smarty_tpl->tpl_vars['RELATION'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getRelationInstance(), null, 0);?><?php if (!($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord())){?><?php $_smarty_tpl->tpl_vars['PROCEED'] = new Smarty_variable(false, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['PROCEED']->value){?><?php if ($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isCreate()){?><li><time class="update_time cursorDefault"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getParent()->get('createdtime'));?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getParent()->get('createdtime'));?>
</small></time><?php $_smarty_tpl->tpl_vars['USER_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getModifiedBy(), null, 0);?><?php $_smarty_tpl->tpl_vars['IMAGE_DETAILS'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->getImageDetails(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value!=''&&$_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0]!=''&&$_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0]['path']==''){?><div class="update_icon bg-info"><i class='update_image vicon-vtigeruser'></i></div><?php }else{ ?><?php  $_smarty_tpl->tpl_vars['IMAGE_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['IMAGE_INFO']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['IMAGE_INFO']->key => $_smarty_tpl->tpl_vars['IMAGE_INFO']->value){
$_smarty_tpl->tpl_vars['IMAGE_INFO']->_loop = true;
?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
<?php $_tmp1=ob_get_clean();?><?php if (!empty($_smarty_tpl->tpl_vars['IMAGE_INFO']->value['path'])&&!empty($_tmp1)){?><div class="update_icon"><img class="update_image" src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['path'];?>
_<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
" ></div><?php }?><?php } ?><?php }?><div class="update_info"><h5><span class="field-name"><?php echo $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getModifiedBy()->getName();?>
</span> <?php echo vtranslate('LBL_CREATED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h5></div></li><?php }elseif($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isUpdate()){?><li><time class="update_time cursorDefault"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getActivityTime());?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getActivityTime());?>
</small></time><?php $_smarty_tpl->tpl_vars['USER_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getModifiedBy(), null, 0);?><?php $_smarty_tpl->tpl_vars['IMAGE_DETAILS'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->getImageDetails(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value!=''&&$_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0]!=''&&$_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0]['path']==''){?><div class="update_icon bg-info"><i class='update_image vicon-vtigeruser'></i></div><?php }else{ ?><?php  $_smarty_tpl->tpl_vars['IMAGE_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['IMAGE_INFO']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['IMAGE_INFO']->key => $_smarty_tpl->tpl_vars['IMAGE_INFO']->value){
$_smarty_tpl->tpl_vars['IMAGE_INFO']->_loop = true;
?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
<?php $_tmp2=ob_get_clean();?><?php if (!empty($_smarty_tpl->tpl_vars['IMAGE_INFO']->value['path'])&&!empty($_tmp2)){?><div class="update_icon"><img class="update_image" src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['path'];?>
_<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
" ></div><?php }?><?php } ?><?php }?><div class="update_info"><div><h5><span class="field-name"><?php echo $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getModifiedBy()->getDisplayName();?>
 </span> <?php echo vtranslate('LBL_UPDATED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h5></div><?php  $_smarty_tpl->tpl_vars['FIELDMODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDMODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getFieldInstances(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDMODEL']->key => $_smarty_tpl->tpl_vars['FIELDMODEL']->value){
$_smarty_tpl->tpl_vars['FIELDMODEL']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['FIELDMODEL']->value&&$_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()&&$_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->isViewable()&&$_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getDisplayType()!='5'){?><div class='font-x-small updateInfoContainer textOverflowEllipsis'><div class='update-name'><span class="field-name"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span><?php if ($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('prevalue')!=''&&$_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue')!=''&&!($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getFieldDataType()=='reference'&&($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue')=='0'||$_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('prevalue')=='0'))){?><span> &nbsp;<?php echo vtranslate('LBL_CHANGED');?>
</span></div><div class='update-from'><span class="field-name"><?php echo vtranslate('LBL_FROM');?>
</span>&nbsp;<em style="white-space:pre-line;" title="<?php ob_start();?><?php echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('prevalue'))));?>
<?php $_tmp3=ob_get_clean();?><?php echo strip_tags($_tmp3);?>
"><?php echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('prevalue'))));?>
</em></div><?php }elseif($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue')==''||($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getFieldDataType()=='reference'&&$_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue')=='0')){?>&nbsp;(<del><?php echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('prevalue'))));?>
</del> ) <?php echo vtranslate('LBL_IS_REMOVED');?>
</div><?php }elseif($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue')!=''&&!($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getFieldDataType()=='reference'&&$_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue')=='0')){?>&nbsp;<?php echo vtranslate('LBL_UPDATED');?>
</div><?php }else{ ?>&nbsp;<?php echo vtranslate('LBL_CHANGED');?>
</div><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue')!=''&&!($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getFieldInstance()->getFieldDataType()=='reference'&&$_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue')=='0')){?><div class="update-to"><span class="field-name"><?php echo vtranslate('LBL_TO');?>
</span>&nbsp;<em style="white-space:pre-line;"><?php echo Vtiger_Util_Helper::toVtiger6SafeHTML($_smarty_tpl->tpl_vars['FIELDMODEL']->value->getDisplayValue(decode_html($_smarty_tpl->tpl_vars['FIELDMODEL']->value->get('postvalue'))));?>
</em></div><?php }?></div><?php }?><?php } ?></div></li><?php }elseif(($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRelationLink()||$_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRelationUnLink())){?><?php $_smarty_tpl->tpl_vars['RELATED_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName(), null, 0);?><li><time class="update_time cursorDefault"><small title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString($_smarty_tpl->tpl_vars['RELATION']->value->get('changedon'));?>
"><?php echo Vtiger_Util_Helper::formatDateDiffInStrings($_smarty_tpl->tpl_vars['RELATION']->value->get('changedon'));?>
 </small></time><div class="update_icon bg-info-<?php echo strtolower($_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
"><?php ob_start();?><?php echo strtolower($_smarty_tpl->tpl_vars['RELATED_MODULE']->value)=='modcomments';?>
<?php $_tmp4=ob_get_clean();?><?php if ($_tmp4){?><?php $_smarty_tpl->tpl_vars["VICON_MODULES"] = new Smarty_variable("vicon-chat", null, 0);?><i class="update_image <?php echo $_smarty_tpl->tpl_vars['VICON_MODULES']->value;?>
"></i><?php }else{ ?><span class="update_image"><?php echo Vtiger_Module_Model::getModuleIconPath($_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
</span><?php }?></div><div class="update_info"><h5><?php $_smarty_tpl->tpl_vars['RELATION'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->getRelationInstance(), null, 0);?><span class="field-name"><?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName(),$_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName());?>
</span>&nbsp;<span><?php if ($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRelationLink()){?><?php echo vtranslate('LBL_LINKED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php }else{ ?><?php echo vtranslate('LBL_UNLINKED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php }?></span></h5><div class='font-x-small updateInfoContainer textOverflowEllipsis'><span><?php if ($_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getModuleName()=='Calendar'){?><?php if (isPermitted('Calendar','DetailView',$_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getId())=='yes'){?><?php $_smarty_tpl->tpl_vars['PERMITTED'] = new Smarty_variable(1, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['PERMITTED'] = new Smarty_variable(0, null, 0);?><?php }?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['PERMITTED'] = new Smarty_variable(1, null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['PERMITTED']->value){?><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value=='ModComments'){?><?php echo $_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getName();?>
<?php }else{ ?><?php $_smarty_tpl->tpl_vars['DETAILVIEW_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATION']->value->getRecordDetailViewUrl(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value){?><a <?php if (stripos($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value,'javascript:')===0){?>onclick<?php }else{ ?>href<?php }?>='<?php echo $_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value;?>
'><?php }?><strong><?php echo $_smarty_tpl->tpl_vars['RELATION']->value->getLinkedRecord()->getName();?>
</strong><?php if ($_smarty_tpl->tpl_vars['DETAILVIEW_URL']->value){?></a><?php }?><?php }?><?php }?></span></div></div></li><?php }elseif($_smarty_tpl->tpl_vars['RECENT_ACTIVITY']->value->isRestore()){?><?php }?><?php }?><?php } ?><?php if ($_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists()){?><li id='more_button'><div class='update_icon' id="moreLink"><button type="button" class="btn btn-success moreRecentUpdates"><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
..</button></div></li><?php }?></ul><?php }else{ ?><div class="summaryWidgetContainer"><p class="textAlignCenter"><?php echo vtranslate('LBL_NO_RECENT_UPDATES');?>
</p></div><?php }?></div></div>
<?php }} ?>