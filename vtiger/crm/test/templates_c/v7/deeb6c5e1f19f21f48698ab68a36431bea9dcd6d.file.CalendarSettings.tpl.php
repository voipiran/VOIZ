<?php /* Smarty version Smarty-3.1.7, created on 2018-11-27 15:57:54
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Calendar/CalendarSettings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:809597395bfd384a0631e2-88727385%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'deeb6c5e1f19f21f48698ab68a36431bea9dcd6d' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Calendar/CalendarSettings.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '809597395bfd384a0631e2-88727385',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'RECORD' => 0,
    'DAY_STARTS' => 0,
    'RECORD_STRUCTURE' => 0,
    'FIELD_MODEL' => 0,
    'FIELD_NAME' => 0,
    'TRANSLATION_MODULE' => 0,
    'LABEL' => 0,
    'ID' => 0,
    'FIELD_VALUE' => 0,
    'HOUR_FORMAT_VALUE' => 0,
    'DECODED_DAYS_STARTS' => 0,
    'PICKLIST_VALUES' => 0,
    'EVENTS_MODULE_MODEL' => 0,
    'DEFAULT_EVENT_STATUS_MODEL' => 0,
    'EVENT_STATUS_MODEL' => 0,
    'DEFAULT_ACTIVITY_TYPE_MODEL' => 0,
    'ACTIVITY_TYPE_MODEL' => 0,
    'CALL_DURATION_MODEL' => 0,
    'EVENT_DURATION_MODEL' => 0,
    'HIDE_COMPLETED_EVENTS_MODEL' => 0,
    'SHAREDTYPE' => 0,
    'SHARED_TYPE' => 0,
    'ALL_USERS' => 0,
    'CURRENTUSER_MODEL' => 0,
    'SHAREDUSERS' => 0,
    'USER_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfd384a23301',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfd384a23301')) {function content_5bfd384a23301($_smarty_tpl) {?>

<div class="modal-dialog modal-lg calendarSettingsContainer"><div class="modal-content"><?php ob_start();?><?php echo vtranslate('LBL_CALENDAR_SETTINGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable($_tmp1, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<?php $_smarty_tpl->tpl_vars['TRANSLATION_MODULE'] = new Smarty_variable("Users", null, 0);?><div class="modal-body"><form class="form-horizontal" id="CalendarSettings" name="CalendarSettings" method="post" action="index.php"><input type="hidden" name="module" value="Users" /><input type="hidden" name="action" value="SaveCalendarSettings" /><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" /><input type=hidden name="timeFormatOptions" data-value='<?php echo $_smarty_tpl->tpl_vars['DAY_STARTS']->value;?>
' /><input type=hidden name="sourceView" /><div><div style="margin-left: 20px;"><?php  $_smarty_tpl->tpl_vars["FIELD_MODEL"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["FIELD_MODEL"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['LBL_CALENDAR_SETTINGS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["FIELD_MODEL"]->key => $_smarty_tpl->tpl_vars["FIELD_MODEL"]->value){
$_smarty_tpl->tpl_vars["FIELD_MODEL"]->_loop = true;
?><?php $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='callduration'){?><?php $_smarty_tpl->tpl_vars['CALL_DURATION_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='othereventduration'){?><?php $_smarty_tpl->tpl_vars['EVENT_DURATION_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='hour_format'){?><?php $_smarty_tpl->tpl_vars['HOUR_FORMAT_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='defaulteventstatus'){?><?php $_smarty_tpl->tpl_vars['DEFAULT_EVENT_STATUS_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='defaultactivitytype'){?><?php $_smarty_tpl->tpl_vars['DEFAULT_ACTIVITY_TYPE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='hidecompletedevents'){?><?php $_smarty_tpl->tpl_vars['HIDE_COMPLETED_EVENTS_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value, null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value!='callduration'&&$_smarty_tpl->tpl_vars['FIELD_NAME']->value!='othereventduration'&&$_smarty_tpl->tpl_vars['FIELD_NAME']->value!='defaulteventstatus'&&$_smarty_tpl->tpl_vars['FIELD_NAME']->value!='defaultactivitytype'&&$_smarty_tpl->tpl_vars['FIELD_NAME']->value!='hidecompletedevents'){?><div class="form-group"><label class="fieldLabel col-lg-4 col-sm-4 col-xs-4"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['TRANSLATION_MODULE']->value);?>
</label><div class="fieldValue col-lg-8 col-sm-8 col-xs-8"><?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='hour_format'||$_smarty_tpl->tpl_vars['FIELD_NAME']->value=='activity_view'){?><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPicklistValues(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['ID']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['LABEL']->value!='This Year'){?><input type="radio" value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value==$_smarty_tpl->tpl_vars['ID']->value){?>checked=""<?php }?> name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" class="alignTop" />&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='hour_format'){?><?php echo vtranslate('LBL_HOUR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?>&nbsp;&nbsp;&nbsp;<?php }?><?php } ?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='start_hour'){?><?php $_smarty_tpl->tpl_vars['DECODED_DAYS_STARTS'] = new Smarty_variable(ZEND_JSON::decode($_smarty_tpl->tpl_vars['DAY_STARTS']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['DECODED_DAYS_STARTS']->value['hour_format'][$_smarty_tpl->tpl_vars['HOUR_FORMAT_VALUE']->value][$_smarty_tpl->tpl_vars['FIELD_NAME']->value], null, 0);?><select class="select2" style="min-width: 150px;" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['ID']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value==$_smarty_tpl->tpl_vars['ID']->value){?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></select><?php }else{ ?><select class="select2" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value=='time_zone'){?> style="min-width: 350px" <?php }else{ ?> style="min-width: 150px" <?php }?>><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEmptyPicklistOptionAllowed()){?><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php }?><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getPicklistValues(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['ID']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_VALUE']->value==$_smarty_tpl->tpl_vars['ID']->value){?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></select><?php }?></div></div><?php }?><?php } ?><?php $_smarty_tpl->tpl_vars['EVENTS_MODULE_MODEL'] = new Smarty_variable(Vtiger_Module_Model::getInstance('Events'), null, 0);?><?php $_smarty_tpl->tpl_vars['EVENT_STATUS_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['EVENTS_MODULE_MODEL']->value->getField('eventstatus'), null, 0);?><?php $_smarty_tpl->tpl_vars['ACTIVITY_TYPE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['EVENTS_MODULE_MODEL']->value->getField('activitytype'), null, 0);?><div class="form-group"><label class="fieldLabel col-lg-4 col-sm-4 col-xs-4"><?php echo vtranslate('LBL_DEFAULT_STATUS_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="fieldValue col-lg-8 col-sm-8 col-xs-8"><span class="alignMiddle"><?php echo vtranslate('LBL_STATUS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span>&nbsp;&nbsp;<select class="select2" style="min-width: 133px" name="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_EVENT_STATUS_MODEL']->value->get('name');?>
"><option value="<?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['EVENT_STATUS_MODEL']->value->getPicklistValues(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['ID']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['DEFAULT_EVENT_STATUS_MODEL']->value->get('fieldvalue')==$_smarty_tpl->tpl_vars['ID']->value){?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></select>&nbsp;&nbsp;&nbsp;<span class="alignMiddle"><?php echo vtranslate('LBL_TYPE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span>&nbsp;&nbsp;<select class="select2" style="min-width: 133px" name="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_ACTIVITY_TYPE_MODEL']->value->get('name');?>
"><option value="<?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
"><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ACTIVITY_TYPE_MODEL']->value->getPicklistValues(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['ID']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['DEFAULT_ACTIVITY_TYPE_MODEL']->value->get('fieldvalue')==$_smarty_tpl->tpl_vars['ID']->value){?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></select></div></div><div class="form-group"><label class="fieldLabel col-lg-4 col-sm-4 col-xs-4"><?php echo vtranslate('LBL_DEFAULT_EVENT_DURATION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="fieldValue col-lg-8 col-sm-8 col-xs-8"><span class="alignMiddle"><?php echo vtranslate('LBL_CALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="select2" name="<?php echo $_smarty_tpl->tpl_vars['CALL_DURATION_MODEL']->value->get('name');?>
"><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CALL_DURATION_MODEL']->value->getPicklistValues(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['ID']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['CALL_DURATION_MODEL']->value->get('fieldvalue')==$_smarty_tpl->tpl_vars['ID']->value){?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate('LBL_MINUTES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></select>&nbsp;&nbsp;&nbsp;<span class="alignMiddle"><?php echo vtranslate('LBL_OTHER_EVENTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span>&nbsp;&nbsp;<select class="select2" name="<?php echo $_smarty_tpl->tpl_vars['EVENT_DURATION_MODEL']->value->get('name');?>
"><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['EVENT_DURATION_MODEL']->value->getPicklistValues(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['ID']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['EVENT_DURATION_MODEL']->value->get('fieldvalue')==$_smarty_tpl->tpl_vars['ID']->value){?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate('LBL_MINUTES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php } ?></select></div></div><div class="form-group"><label class="fieldLabel col-lg-4 col-sm-4 col-xs-4"><?php echo vtranslate($_smarty_tpl->tpl_vars['HIDE_COMPLETED_EVENTS_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="fieldValue col-lg-8 col-sm-8 col-xs-8"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['HIDE_COMPLETED_EVENTS_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['HIDE_COMPLETED_EVENTS_MODEL']->value,'FIELD_NAME'=>'hidecompletedevents'), 0);?>
</div></div><?php $_smarty_tpl->tpl_vars['SHARED_TYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['SHAREDTYPE']->value, null, 0);?><div class="form-group"><label class="fieldLabel col-lg-4"><?php echo vtranslate('LBL_CALENDAR_SHARING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="fieldValue col-lg-8 col-sm-8 col-xs-8" style="margin-top: -8px; padding-left: 35px;"><label class="radio inline"><input type="radio" value="private"<?php if ($_smarty_tpl->tpl_vars['SHARED_TYPE']->value=='private'){?> checked="" <?php }?> name="sharedtype" />&nbsp;<?php echo vtranslate('Private',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</label><label class="radio inline"><input type="radio" value="public" <?php if ($_smarty_tpl->tpl_vars['SHARED_TYPE']->value=='public'){?> checked="" <?php }?> name="sharedtype" />&nbsp;<?php echo vtranslate('Public',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</label><label class="radio inline"><input type="radio" value="selectedusers" <?php if ($_smarty_tpl->tpl_vars['SHARED_TYPE']->value=='selectedusers'){?> checked="" <?php }?> data-sharingtype="selectedusers" name="sharedtype" id="selectedUsersSharingType" />&nbsp;<?php echo vtranslate('Selected Users',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><br><br><select class="select2 row <?php if ($_smarty_tpl->tpl_vars['SHARED_TYPE']->value!='selectedusers'){?> hide <?php }?>" id="selectedUsers" name="sharedIds[]" multiple="" data-placeholder="<?php echo vtranslate('LBL_SELECT_USERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php  $_smarty_tpl->tpl_vars['USER_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['USER_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_USERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['USER_MODEL']->key => $_smarty_tpl->tpl_vars['USER_MODEL']->value){
$_smarty_tpl->tpl_vars['USER_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['ID']->value = $_smarty_tpl->tpl_vars['USER_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['ID']->value!=$_smarty_tpl->tpl_vars['CURRENTUSER_MODEL']->value->get('id')){?><option value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
" <?php if (array_key_exists($_smarty_tpl->tpl_vars['ID']->value,$_smarty_tpl->tpl_vars['SHAREDUSERS']->value)){?> selected="" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['USER_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php }?><?php } ?></select></div></div><br></div></div></form></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalFooter.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><?php }} ?>