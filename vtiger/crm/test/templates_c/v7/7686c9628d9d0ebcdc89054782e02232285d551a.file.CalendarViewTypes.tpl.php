<?php /* Smarty version Smarty-3.1.7, created on 2018-06-18 09:23:01
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Calendar/CalendarViewTypes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8812110685b273aadd6aba9-15657304%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7686c9628d9d0ebcdc89054782e02232285d551a' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Calendar/CalendarViewTypes.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8812110685b273aadd6aba9-15657304',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEWTYPES' => 0,
    'VIEWINFO' => 0,
    'MODULE' => 0,
    'ADDVIEWS' => 0,
    'INVISIBLE_CALENDAR_VIEWS_EXISTS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5b273aade4dfc',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b273aade4dfc')) {function content_5b273aade4dfc($_smarty_tpl) {?>

<div class="sidebar-widget-contents" name='calendarViewTypes'><div id="calendarview-feeds"><ul class="list-group feedslist"><?php  $_smarty_tpl->tpl_vars['VIEWINFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VIEWINFO']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['VIEWTYPES']->value['visible']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VIEWINFO']->key => $_smarty_tpl->tpl_vars['VIEWINFO']->value){
$_smarty_tpl->tpl_vars['VIEWINFO']->_loop = true;
?><li class="activitytype-indicator calendar-feed-indicator container-fluid" style="background-color: <?php echo $_smarty_tpl->tpl_vars['VIEWINFO']->value['color'];?>
;"><span><?php echo vtranslate($_smarty_tpl->tpl_vars['VIEWINFO']->value['module'],$_smarty_tpl->tpl_vars['VIEWINFO']->value['module']);?>
<?php if ($_smarty_tpl->tpl_vars['VIEWINFO']->value['conditions']['name']!=''){?> (<?php echo vtranslate($_smarty_tpl->tpl_vars['VIEWINFO']->value['conditions']['name'],$_smarty_tpl->tpl_vars['MODULE']->value);?>
) <?php }?>-<?php echo vtranslate($_smarty_tpl->tpl_vars['VIEWINFO']->value['fieldlabel'],$_smarty_tpl->tpl_vars['VIEWINFO']->value['module']);?>
</span><span class="activitytype-actions pull-right"><input class="toggleCalendarFeed cursorPointer" type="checkbox" data-calendar-sourcekey="<?php echo $_smarty_tpl->tpl_vars['VIEWINFO']->value['module'];?>
_<?php echo $_smarty_tpl->tpl_vars['VIEWINFO']->value['fieldname'];?>
<?php if ($_smarty_tpl->tpl_vars['VIEWINFO']->value['conditions']['name']!=''){?>_<?php echo $_smarty_tpl->tpl_vars['VIEWINFO']->value['conditions']['name'];?>
<?php }?>" data-calendar-feed="<?php echo $_smarty_tpl->tpl_vars['VIEWINFO']->value['module'];?>
"data-calendar-feed-color="<?php echo $_smarty_tpl->tpl_vars['VIEWINFO']->value['color'];?>
" data-calendar-fieldlabel="<?php echo vtranslate($_smarty_tpl->tpl_vars['VIEWINFO']->value['fieldlabel'],$_smarty_tpl->tpl_vars['VIEWINFO']->value['module']);?>
"data-calendar-fieldname="<?php echo $_smarty_tpl->tpl_vars['VIEWINFO']->value['fieldname'];?>
" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['VIEWINFO']->value['module'],$_smarty_tpl->tpl_vars['VIEWINFO']->value['module']);?>
" data-calendar-type="<?php echo $_smarty_tpl->tpl_vars['VIEWINFO']->value['type'];?>
"data-calendar-feed-textcolor="white" data-calendar-feed-conditions='<?php echo $_smarty_tpl->tpl_vars['VIEWINFO']->value['conditions']['rules'];?>
' />&nbsp;&nbsp;<i class="fa fa-pencil editCalendarFeedColor cursorPointer"></i>&nbsp;&nbsp;<i class="fa fa-trash deleteCalendarFeed cursorPointer"></i></span></li><?php } ?></ul><?php $_smarty_tpl->tpl_vars['INVISIBLE_CALENDAR_VIEWS_EXISTS'] = new Smarty_variable('false', null, 0);?><?php if ($_smarty_tpl->tpl_vars['ADDVIEWS']->value){?><?php $_smarty_tpl->tpl_vars['INVISIBLE_CALENDAR_VIEWS_EXISTS'] = new Smarty_variable('true', null, 0);?><?php }?><input type="hidden" class="invisibleCalendarViews" value="<?php echo $_smarty_tpl->tpl_vars['INVISIBLE_CALENDAR_VIEWS_EXISTS']->value;?>
" /><ul class="hide dummy"><li class="activitytype-indicator calendar-feed-indicator feed-indicator-template container-fluid"><span></span><span class="activitytype-actions pull-right"><input class="toggleCalendarFeed cursorPointer" type="checkbox" data-calendar-sourcekey="" data-calendar-feed=""data-calendar-feed-color="" data-calendar-fieldlabel=""data-calendar-fieldname="" title="" data-calendar-type=""data-calendar-feed-textcolor="white">&nbsp;&nbsp;<i class="fa fa-pencil editCalendarFeedColor cursorPointer"></i>&nbsp;&nbsp;<i class="fa fa-trash deleteCalendarFeed cursorPointer"></i></span></li></ul></div></div><?php }} ?>