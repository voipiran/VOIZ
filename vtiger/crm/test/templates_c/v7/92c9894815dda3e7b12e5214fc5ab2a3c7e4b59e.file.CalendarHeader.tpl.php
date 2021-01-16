<?php /* Smarty version Smarty-3.1.7, created on 2019-02-05 10:53:03
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Calendar/CalendarHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3428138625c5939d7cf1825-12739652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92c9894815dda3e7b12e5214fc5ab2a3c7e4b59e' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Calendar/CalendarHeader.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3428138625c5939d7cf1825-12739652',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'IS_CREATE_PERMITTED' => 0,
    'VIEW' => 0,
    'VIEW_HEADER_LABEL' => 0,
    'MODULE' => 0,
    'MODULE_SETTING_ACTIONS' => 0,
    'SETTING' => 0,
    'MODULE_NAME' => 0,
    'FIELDS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5939d7db22d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5939d7db22d')) {function content_5c5939d7db22d($_smarty_tpl) {?>

<input type="hidden" name="is_record_creation_allowed" id="is_record_creation_allowed" value="<?php echo $_smarty_tpl->tpl_vars['IS_CREATE_PERMITTED']->value;?>
"><div class="col-sm-12 col-xs-12 module-action-bar clearfix"><div class="module-action-content clearfix coloredBorderTop"><div class="col-lg-5 col-md-5"><span><?php $_smarty_tpl->tpl_vars["VIEW_HEADER_LABEL"] = new Smarty_variable("LBL_CALENDAR_VIEW", null, 0);?><?php if ($_smarty_tpl->tpl_vars['VIEW']->value==='SharedCalendar'){?><?php $_smarty_tpl->tpl_vars["VIEW_HEADER_LABEL"] = new Smarty_variable("LBL_SHARED_CALENDAR", null, 0);?><?php }?><a href='javascript:void(0)'><h4 class="module-title pull-left"><span style="cursor: default;"> <?php echo strtoupper(vtranslate($_smarty_tpl->tpl_vars['VIEW_HEADER_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value));?>
 </span></h4></a></span></div><div class="col-lg-7 col-md-7 pull-right"><div id="appnav" class="navbar-right"><ul class="nav navbar-nav"><?php if ($_smarty_tpl->tpl_vars['IS_CREATE_PERMITTED']->value){?><li><button id="calendarview_basicaction_addevent" type="button"class="btn addButton btn-default module-buttons cursorPointer"onclick='Calendar_Calendar_Js.showCreateEventModal();'><div class="fa fa-plus" aria-hidden="true"></div>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_EVENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><button id="calendarview_basicaction_addtask" type="button"class="btn addButton btn-default module-buttons cursorPointer"onclick='Calendar_Calendar_Js.showCreateTaskModal();'><div class="fa fa-plus" aria-hidden="true"></div>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_TASK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></li><?php }?><li><div class="settingsIcon"><button type="button" class="btn btn-default module-buttons dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-wrench" aria-hidden="true" title="<?php echo vtranslate('LBL_SETTINGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></span>&nbsp;&nbsp;<?php echo vtranslate('LBL_CUSTOMIZE','Reports');?>
&nbsp; <span class="caret"></span></button><ul class="detailViewSetting dropdown-menu"><?php  $_smarty_tpl->tpl_vars['SETTING'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SETTING']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_SETTING_ACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SETTING']->key => $_smarty_tpl->tpl_vars['SETTING']->value){
$_smarty_tpl->tpl_vars['SETTING']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['SETTING']->value->getLabel()=='LBL_EDIT_FIELDS'){?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
_Events"><a href="<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
&sourceModule=Events"><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate('LBL_EVENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
_Calendar"><a href="<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
&sourceModule=Calendar"><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate('LBL_TASKS','Calendar'));?>
</a></li><?php }elseif($_smarty_tpl->tpl_vars['SETTING']->value->getLabel()=='LBL_EDIT_WORKFLOWS'){?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
_WORKFLOWS"><a href="<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
&sourceModule=Events"><?php echo vtranslate('LBL_EVENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_WORKFLOWS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></li><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
_WORKFLOWS"><a href="<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
&sourceModule=Calendar"><?php echo vtranslate('LBL_TASKS','Calendar');?>
 <?php echo vtranslate('LBL_WORKFLOWS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></li><?php }else{ ?><li id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_listview_advancedAction_<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getLabel();?>
"><a href=<?php echo $_smarty_tpl->tpl_vars['SETTING']->value->getUrl();?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['SETTING']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value,vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
</a></li><?php }?><?php } ?><li><a><span id="calendarview_basicaction_calendarsetting" onclick='Calendar_Calendar_Js.showCalendarSettings();' class="cursorPointer"><?php echo vtranslate('LBL_CALENDAR_SETTINGS','Calendar');?>
</span></a></li></ul></div></li></ul></div></div></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value!=null){?><script type="text/javascript">var uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();</script><?php }?></div><?php }} ?>