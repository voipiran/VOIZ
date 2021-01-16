<?php /* Smarty version Smarty-3.1.7, created on 2019-02-05 10:52:22
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Calendar/TaskManagementContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9366850285c5939ae79fe22-64620017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55e5866834fb6a9ac9667df93985a9fa93650c5f' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Calendar/TaskManagementContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9366850285c5939ae79fe22-64620017',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'MODULE_MODEL' => 0,
    'SELECTED_PICKLIST_FIELDMODEL' => 0,
    'PICKLIST_COLOR_MAP' => 0,
    'PICKLIST_COLOR' => 0,
    'PICKLIST_KEY_ID' => 0,
    'PICKLIST_TEXT_COLOR' => 0,
    'TASKS' => 0,
    'RECORD_MODEL' => 0,
    'PRIORITY' => 0,
    'RECORD_BASIC_INFO' => 0,
    'COLORS' => 0,
    'STATUS' => 0,
    'RECORDID' => 0,
    'SELECTED_PICKLISTFIELD_ALL_VALUES' => 0,
    'PICKLIST_VALUE' => 0,
    'PICKLIST_KEY' => 0,
    'RELATED_PARENT' => 0,
    'RELATED_PARENT_MODULE' => 0,
    'RELATED_CONTACT' => 0,
    'PAGING_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5939ae8c555',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5939ae8c555')) {function content_5c5939ae8c555($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_variable(Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL'] = new Smarty_variable(Vtiger_Field_Model::getInstance('taskstatus',$_smarty_tpl->tpl_vars['MODULE_MODEL']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP'] = new Smarty_variable(Settings_Picklist_Module_Model::getPicklistColorMap($_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getName()), null, 0);?><style type="text/css"><?php  $_smarty_tpl->tpl_vars['PICKLIST_COLOR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_COLOR_MAP']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->key => $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value){
$_smarty_tpl->tpl_vars['PICKLIST_COLOR']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY_ID']->value = $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->key;
?><?php $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR'] = new Smarty_variable(Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value), null, 0);?>.picklist-<?php echo $_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getId();?>
-<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY_ID']->value;?>
 {background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
;color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_TEXT_COLOR']->value;?>
;}<?php } ?></style><?php  $_smarty_tpl->tpl_vars['RECORD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RECORD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['RECORDID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['TASKS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RECORD_MODEL']->key => $_smarty_tpl->tpl_vars['RECORD_MODEL']->value){
$_smarty_tpl->tpl_vars['RECORD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['RECORDID']->value = $_smarty_tpl->tpl_vars['RECORD_MODEL']->key;
?><div class="entries ui-draggable"><?php $_smarty_tpl->tpl_vars['RECORD_BASIC_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('basicInfo'), null, 0);?><div class="task clearfix" data-recordid="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('id');?>
" data-priority="<?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
" data-basicinfo='<?php echo json_encode($_smarty_tpl->tpl_vars['RECORD_BASIC_INFO']->value);?>
' style="border-left:4px solid <?php echo $_smarty_tpl->tpl_vars['COLORS']->value[$_smarty_tpl->tpl_vars['PRIORITY']->value];?>
"><?php $_smarty_tpl->tpl_vars['STATUS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('status'), null, 0);?><div class="task-status pull-left"><input class='statusCheckbox' type="checkbox" name="taskstatus" <?php if ($_smarty_tpl->tpl_vars['STATUS']->value=="Completed"){?> checked disabled <?php }?>/></div><div class='task-body clearfix'><div class="taskSubject pull-left <?php if ($_smarty_tpl->tpl_vars['STATUS']->value=="Completed"){?> textStrike <?php }?> textOverflowEllipsis" style='width:70%;'><a class="quickPreview" data-id="<?php echo $_smarty_tpl->tpl_vars['RECORDID']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('subject');?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('subject');?>
</a></div><?php $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_ALL_VALUES'] = new Smarty_variable(Vtiger_Util_Helper::getPickListValues('taskstatus'), null, 0);?><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_PICKLISTFIELD_ALL_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><?php if ($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value==$_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('status')){?><div class="more pull-right taskStatus picklist-<?php echo $_smarty_tpl->tpl_vars['SELECTED_PICKLIST_FIELDMODEL']->value->getId();?>
-<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('status');?>
</div><?php }?><?php } ?></div><div class='other-details clearfix'><div class="pull-left drag-task"><img class="cursorPointerMove" src="<?php echo vimage_path('drag.png');?>
" />&nbsp;&nbsp;</div><?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('sendnotification')==1){?><i class='notificationEnabled fa fa-bell'></i>&nbsp;&nbsp;<?php }?><div class="task-details"><span class='taskDueDate'><i class="fa fa-calendar"></i>&nbsp;<span style="vertical-align: middle"><?php echo Vtiger_Date_UIType::getDisplayDateValue($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get('due_date'));?>
</span></span><?php $_smarty_tpl->tpl_vars['RELATED_PARENT'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_BASIC_INFO']->value['parent_id'], null, 0);?><?php $_smarty_tpl->tpl_vars['RELATED_CONTACT'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_BASIC_INFO']->value['contact_id'], null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['RELATED_PARENT']->value)){?><span class='related_account' style='margin-left: 8px;'><?php $_smarty_tpl->tpl_vars['RELATED_PARENT_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_PARENT']->value['module'], null, 0);?><span style="font-size: 12px;"><?php echo Vtiger_Module_Model::getModuleIconPath($_smarty_tpl->tpl_vars['RELATED_PARENT_MODULE']->value);?>
&nbsp;</span><span class="recordName textOverflowEllipsis" style="vertical-align: middle"><a class="quickPreview" href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT_MODULE']->value;?>
&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT']->value['id'];?>
"  data-id="<?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT']->value['id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT']->value['display_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT']->value['display_value'];?>
</a></span></span><?php }?><?php if (!empty($_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['id'])){?><span class='related_contact' style='margin-left: 8px;'><span style="font-size: 12px;"><?php echo Vtiger_Module_Model::getModuleIconPath('Contacts');?>
&nbsp;</span><span class="recordName textOverflowEllipsis" style="vertical-align: middle"><a class="quickPreview" href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['module'];?>
&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['id'];?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['id'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['display_value'];?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_CONTACT']->value['display_value'];?>
</a></span></span><?php }?></div><div class="more pull-right cursorPointer task-actions"><a href="#" class="quickTask" id="taskPopover"><i class="fa fa-pencil-square-o icon"></i></a>&nbsp;&nbsp;<a href="#" class="taskDelete"><i class="fa fa-trash icon"></i></a></div></div></div></div><?php } ?><?php if ($_smarty_tpl->tpl_vars['PAGING_MODEL']->value->get("nextPageExists")==true){?><div class="row moreButtonBlock"><button class="btn btn-default moreRecords" style="width:100%;"> <?php echo vtranslate("LBL_MORE",$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </button></div><?php }?><?php }} ?>