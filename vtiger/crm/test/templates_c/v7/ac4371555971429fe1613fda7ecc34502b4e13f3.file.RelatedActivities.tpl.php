<?php /* Smarty version Smarty-3.1.7, created on 2018-11-21 10:10:21
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/RelatedActivities.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4421704205bf4fdd5722a37-29773033%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac4371555971429fe1613fda7ecc34502b4e13f3' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/RelatedActivities.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4421704205bf4fdd5722a37-29773033',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'CALENDAR_MODEL' => 0,
    'RECORD' => 0,
    'ACTIVITIES' => 0,
    'DETAILVIEW_PERMITTED' => 0,
    'EDITVIEW_PERMITTED' => 0,
    'SOURCE_MODEL' => 0,
    'DELETE_PERMITTED' => 0,
    'START_DATE' => 0,
    'START_TIME' => 0,
    'PICKLIST_COLOR_MAP' => 0,
    'PICKLIST_COLOR' => 0,
    'PICKLIST_VALUE' => 0,
    'FIELD_MODEL' => 0,
    'CONVERTED_PICKLIST_VALUE' => 0,
    'PICKLIST_TEXT_COLOR' => 0,
    'USER_MODEL' => 0,
    'PAGING_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bf4fdd584bba',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bf4fdd584bba')) {function content_5bf4fdd584bba($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable("Calendar", null, 0);?><div class="summaryWidgetContainer"><div class="widget_header clearfix"><h4 class="display-inline-block pull-left"><?php echo vtranslate('LBL_ACTIVITIES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><?php $_smarty_tpl->tpl_vars['CALENDAR_MODEL'] = new Smarty_variable(Vtiger_Module_Model::getInstance('Calendar'), null, 0);?><div class="pull-right" style="margin-top: -5px;"><?php if ($_smarty_tpl->tpl_vars['CALENDAR_MODEL']->value->isPermitted('CreateView')){?><button class="btn addButton btn-sm btn-default createActivity toDotask textOverflowEllipsis max-width-100" title="<?php echo vtranslate('LBL_ADD_TASK',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" type="button" href="javascript:void(0)" data-url="sourceModule=<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getModuleName();?>
&sourceRecord=<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
&relationOperation=true" ><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_TASK',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button>&nbsp;&nbsp;<button class="btn addButton btn-sm btn-default createActivity textOverflowEllipsis max-width-100" title="<?php echo vtranslate('LBL_ADD_EVENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" data-name="Events"data-url="index.php?module=Events&view=QuickCreateAjax" href="javascript:void(0)" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_EVENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button><?php }?></div><?php $_smarty_tpl->tpl_vars['SOURCE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value, null, 0);?></div><div class="widget_contents"><?php if (count($_smarty_tpl->tpl_vars['ACTIVITIES']->value)!='0'){?><?php  $_smarty_tpl->tpl_vars['RECORD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RECORD']->_loop = false;
 $_smarty_tpl->tpl_vars['KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ACTIVITIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RECORD']->key => $_smarty_tpl->tpl_vars['RECORD']->value){
$_smarty_tpl->tpl_vars['RECORD']->_loop = true;
 $_smarty_tpl->tpl_vars['KEY']->value = $_smarty_tpl->tpl_vars['RECORD']->key;
?><?php $_smarty_tpl->tpl_vars['START_DATE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->get('date_start'), null, 0);?><?php $_smarty_tpl->tpl_vars['START_TIME'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->get('time_start'), null, 0);?><?php $_smarty_tpl->tpl_vars['EDITVIEW_PERMITTED'] = new Smarty_variable(isPermitted('Calendar','EditView',$_smarty_tpl->tpl_vars['RECORD']->value->get('crmid')), null, 0);?><?php $_smarty_tpl->tpl_vars['DETAILVIEW_PERMITTED'] = new Smarty_variable(isPermitted('Calendar','DetailView',$_smarty_tpl->tpl_vars['RECORD']->value->get('crmid')), null, 0);?><?php $_smarty_tpl->tpl_vars['DELETE_PERMITTED'] = new Smarty_variable(isPermitted('Calendar','Delete',$_smarty_tpl->tpl_vars['RECORD']->value->get('crmid')), null, 0);?><div class="activityEntries"><input type="hidden" class="activityId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('activityid');?>
"/><div class='media'><div class='row'><div class='media-left module-icon col-lg-1 col-md-1 col-sm-1 textAlignCenter'><span class='vicon-<?php echo strtolower($_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype'));?>
'></span></div><div class='media-body col-lg-7 col-md-7 col-sm-7'><div class="summaryViewEntries"><?php if ($_smarty_tpl->tpl_vars['DETAILVIEW_PERMITTED']->value=='yes'){?><a href="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDetailViewUrl();?>
" title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('subject');?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('subject');?>
</a><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('subject');?>
<?php }?>&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['EDITVIEW_PERMITTED']->value=='yes'){?><a href="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getEditViewUrl();?>
&sourceModule=<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODEL']->value->getModuleName();?>
&sourceRecord=<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODEL']->value->getId();?>
&relationOperation=true" class="fieldValue"><i class="summaryViewEdit fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></i></a><?php }?>&nbsp;<?php if ($_smarty_tpl->tpl_vars['DELETE_PERMITTED']->value=='yes'){?><a onclick="Vtiger_Detail_Js.deleteRelatedActivity(event);" data-id="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
" data-recurring-enabled="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->isRecurringEnabled();?>
" class="fieldValue"><i class="summaryViewEdit fa fa-trash " title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></i></a><?php }?></div><span><strong title="<?php echo Vtiger_Util_Helper::formatDateTimeIntoDayString(($_smarty_tpl->tpl_vars['START_DATE']->value)." ".($_smarty_tpl->tpl_vars['START_TIME']->value));?>
"><?php echo Vtiger_Util_Helper::formatDateIntoStrings($_smarty_tpl->tpl_vars['START_DATE']->value,$_smarty_tpl->tpl_vars['START_TIME']->value);?>
</strong></span></div><div class='col-lg-4 col-md-4 col-sm-4 activityStatus' style='line-height: 0px;padding-right:30px;'><div class="row"><?php if ($_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype')=='Task'){?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->getModuleName(), null, 0);?><input type="hidden" class="activityModule" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getModuleName();?>
"/><input type="hidden" class="activityType" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype');?>
"/><div class="pull-right"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->getModule()->getField('taskstatus'), null, 0);?><style><?php $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP'] = new Smarty_variable(Settings_Picklist_Module_Model::getPicklistColorMap('taskstatus',true), null, 0);?><?php  $_smarty_tpl->tpl_vars['PICKLIST_COLOR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->key => $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value){
$_smarty_tpl->tpl_vars['PICKLIST_COLOR']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value = $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->key;
?><?php $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR'] = new Smarty_variable(Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['CONVERTED_PICKLIST_VALUE'] = new Smarty_variable(Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value), null, 0);?>.picklist-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
-<?php echo Vtiger_Util_Helper::escapeCssSpecialCharacters($_smarty_tpl->tpl_vars['CONVERTED_PICKLIST_VALUE']->value);?>
 {background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
;color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR']->value;?>
;}<?php } ?></style><strong><span class="value picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['RECORD']->value->get('status'));?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD']->value->get('status'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span></strong>&nbsp&nbsp;<?php if ($_smarty_tpl->tpl_vars['EDITVIEW_PERMITTED']->value=='yes'){?><span class="editStatus cursorPointer"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></i></span><span class="edit hide"><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['RECORD']->value->get('status')), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value,'OCCUPY_COMPLETE_WIDTH'=>'true'), 0);?>
<input type="hidden" class="fieldname" value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
' data-prev-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
' /></span><?php }?></div><?php }else{ ?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable("Events", null, 0);?><input type="hidden" class="activityModule" value="Events"/><input type="hidden" class="activityType" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('activitytype');?>
"/><div class="pull-right"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->getModule()->getField('eventstatus'), null, 0);?><style><?php $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP'] = new Smarty_variable(Settings_Picklist_Module_Model::getPicklistColorMap('eventstatus',true), null, 0);?><?php  $_smarty_tpl->tpl_vars['PICKLIST_COLOR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->key => $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value){
$_smarty_tpl->tpl_vars['PICKLIST_COLOR']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value = $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->key;
?><?php $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR'] = new Smarty_variable(Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['CONVERTED_PICKLIST_VALUE'] = new Smarty_variable(Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value), null, 0);?>.picklist-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
-<?php echo Vtiger_Util_Helper::escapeCssSpecialCharacters($_smarty_tpl->tpl_vars['CONVERTED_PICKLIST_VALUE']->value);?>
 {background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
;color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR']->value;?>
;}<?php } ?></style><strong><span class="value picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['RECORD']->value->get('eventstatus'));?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD']->value->get('eventstatus'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span></strong>&nbsp&nbsp;<?php if ($_smarty_tpl->tpl_vars['EDITVIEW_PERMITTED']->value=='yes'){?><span class="editStatus cursorPointer"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"></i></span><span class="edit hide"><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->set('fieldvalue',$_smarty_tpl->tpl_vars['RECORD']->value->get('eventstatus')), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value,'OCCUPY_COMPLETE_WIDTH'=>'true'), 0);?>
<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='multipicklist'){?><input type="hidden" class="fieldname" value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
[]' data-prev-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
' /><?php }else{ ?><input type="hidden" class="fieldname" value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
' data-prev-value='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
' /><?php }?></span></div><?php }?><?php }?></div></div></div></div><hr></div><?php } ?><?php }else{ ?><div class="summaryWidgetContainer noContent"><p class="textAlignCenter"><?php echo vtranslate('LBL_NO_PENDING_ACTIVITIES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</p></div><?php }?><?php if ($_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists()){?><div class="row"><div class="textAlignCenter"><a href="javascript:void(0)" class="moreRecentActivities"><?php echo vtranslate('LBL_SHOW_MORE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div></div><?php }?></div></div><?php }} ?>