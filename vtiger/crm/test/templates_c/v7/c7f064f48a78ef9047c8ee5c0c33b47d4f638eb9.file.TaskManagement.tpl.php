<?php /* Smarty version Smarty-3.1.7, created on 2019-02-05 10:52:21
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Calendar/TaskManagement.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14383955495c5939adc1f461-60178161%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7f064f48a78ef9047c8ee5c0c33b47d4f638eb9' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Calendar/TaskManagement.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14383955495c5939adc1f461-60178161',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COLORS' => 0,
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'TASK_FILTERS' => 0,
    'OWNER_FIELD' => 0,
    'STATUS_FIELD' => 0,
    'FIELD_MODEL' => 0,
    'FIELD_INFO' => 0,
    'SEARCH_INFO' => 0,
    'PICKLIST_VALUES' => 0,
    'PICKLIST_KEY' => 0,
    'PICKLIST_LABEL' => 0,
    'PRIORITIES' => 0,
    'PRIORITY' => 0,
    'PAGE' => 0,
    'MODULE_MODEL' => 0,
    'USER_PRIVILEGES_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5939add352c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5939add352c')) {function content_5c5939add352c($_smarty_tpl) {?>

<div id="taskManagementContainer" class='fc-overlay-modal modal-content' style="height:100%;"><input type="hidden" name="colors" value='<?php echo json_encode($_smarty_tpl->tpl_vars['COLORS']->value);?>
'><div class="overlayHeader"><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable("TASK MANAGEMENT", null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
</div><hr style="margin:0px;"><div class='modal-body overflowYAuto'><div class='datacontent'><div class="data-header clearfix"><div class="btn-group dateFilters pull-left" role="group" aria-label="..."><button type="button" class="btn btn-default <?php if ($_smarty_tpl->tpl_vars['TASK_FILTERS']->value['date']=="all"){?>active<?php }?>" data-filtermode="all"><?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><button type="button" class="btn btn-default <?php if ($_smarty_tpl->tpl_vars['TASK_FILTERS']->value['date']=="today"){?>active<?php }?>" data-filtermode="today"><?php echo vtranslate('LBL_TODAY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><button type="button" class="btn btn-default <?php if ($_smarty_tpl->tpl_vars['TASK_FILTERS']->value['date']=="thisweek"){?>active<?php }?>" data-filtermode="thisweek"><?php echo vtranslate('LBL_THIS_WEEK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><button type="button" class="btn btn-default dateRange dateField" data-calendar-type="range" data-filtermode="range"><i class="fa fa-calendar"></i></button><button type="button" class="btn btn-default hide rangeDisplay"><span class="selectedRange"></span>&nbsp;<i class="fa fa-times clearRange"></i></button></div><div id="taskManagementOtherFilters" class="otherFilters pull-right" style="width:550px;"><div class='field pull-left' style="width:250px;padding-right: 5px;"><?php echo $_smarty_tpl->getSubTemplate ("modules/Calendar/uitypes/OwnerFieldTaskSearchView.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['OWNER_FIELD']->value), 0);?>
</div><div class='field pull-left' style="width:250px;padding-right: 5px;"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['STATUS_FIELD']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'], null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable(Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['FIELD_INFO']->value)), null, 0);?><?php $_smarty_tpl->tpl_vars['SEARCH_VALUES'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['SEARCH_INFO']->value['searchValue']), null, 0);?><select class="select2 listSearchContributor" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
" multiple data-fieldinfo='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['FIELD_INFO']->value, ENT_QUOTES, 'UTF-8', true);?>
'><?php  $_smarty_tpl->tpl_vars['PICKLIST_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->key => $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->value){
$_smarty_tpl->tpl_vars['PICKLIST_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value = $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->key;
?><option <?php if (in_array($_smarty_tpl->tpl_vars['PICKLIST_KEY']->value,$_smarty_tpl->tpl_vars['TASK_FILTERS']->value['status'])){?>selected<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['PICKLIST_KEY']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['PICKLIST_LABEL']->value;?>
</option><?php } ?></select></div><div><button class="btn btn-success search"><span class="fa fa-search"></span></button></div></div></div><hr><div class="data-body row"><?php $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_variable(Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['USER_PRIVILEGES_MODEL'] = new Smarty_variable(Users_Privileges_Model::getCurrentUserPrivilegesModel(), null, 0);?><?php  $_smarty_tpl->tpl_vars['PRIORITY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PRIORITY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['PRIORITIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PRIORITY']->key => $_smarty_tpl->tpl_vars['PRIORITY']->value){
$_smarty_tpl->tpl_vars['PRIORITY']->_loop = true;
?><div class="col-lg-4 contentsBlock <?php echo strtolower($_smarty_tpl->tpl_vars['PRIORITY']->value);?>
 ui-droppable" data-priority='<?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
' data-page="<?php echo $_smarty_tpl->tpl_vars['PAGE']->value;?>
"><div class="<?php echo strtolower($_smarty_tpl->tpl_vars['PRIORITY']->value);?>
-header" style="border-bottom: 2px solid <?php echo $_smarty_tpl->tpl_vars['COLORS']->value[$_smarty_tpl->tpl_vars['PRIORITY']->value];?>
"><div class="title" style="background:<?php echo $_smarty_tpl->tpl_vars['COLORS']->value[$_smarty_tpl->tpl_vars['PRIORITY']->value];?>
"><span><?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
</span></div></div><br><div class="<?php echo strtolower($_smarty_tpl->tpl_vars['PRIORITY']->value);?>
-content content" data-priority='<?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
' style="border-bottom: 1px solid <?php echo $_smarty_tpl->tpl_vars['COLORS']->value[$_smarty_tpl->tpl_vars['PRIORITY']->value];?>
;padding-bottom: 10px"><?php if ($_smarty_tpl->tpl_vars['USER_PRIVILEGES_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getId(),'CreateView')){?><div class="input-group"><input type="text" class="form-control taskSubject <?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
" placeholder="<?php echo vtranslate('LBL_ADD_TASK_AND_PRESS_ENTER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" aria-describedby="basic-addon1" style="width: 99%"><span class="quickTask input-group-addon js-task-popover-container more cursorPointer" id="basic-addon1" style="border: 1px solid #ddd; padding: 0 13px;"><a href="#" id="taskPopover" priority='<?php echo $_smarty_tpl->tpl_vars['PRIORITY']->value;?>
'><i class="fa fa-plus icon"></i></a></span></div><?php }?><br><div class='<?php echo strtolower($_smarty_tpl->tpl_vars['PRIORITY']->value);?>
-entries container-fluid scrollable dataEntries padding20' style="height:400px;overflow:auto;width:400px;padding-left: 0px;padding-right: 0px;"></div></div></div><?php } ?></div><div class="editTaskContent hide"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("TaskManagementEdit.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div></div></div><?php }} ?>