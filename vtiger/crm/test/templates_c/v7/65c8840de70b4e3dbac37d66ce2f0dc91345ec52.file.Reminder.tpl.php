<?php /* Smarty version Smarty-3.1.7, created on 2019-03-25 12:21:05
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/uitypes/Reminder.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2325872255c9888695652c4-02983846%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65c8840de70b4e3dbac37d66ce2f0dc91345ec52' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/uitypes/Reminder.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2325872255c9888695652c4-02983846',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'REMINDER_VALUES' => 0,
    'FIELD_MODEL' => 0,
    'DAYS' => 0,
    'DAY' => 0,
    'MODULE' => 0,
    'HOURS' => 0,
    'HOUR' => 0,
    'MINUTES' => 0,
    'MINUTE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c9888695e6d8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c9888695e6d8')) {function content_5c9888695e6d8($_smarty_tpl) {?>

<?php if (!$_smarty_tpl->tpl_vars['REMINDER_VALUES']->value){?><?php $_smarty_tpl->tpl_vars['REMINDER_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value==''){?><?php $_smarty_tpl->tpl_vars['DAYS'] = new Smarty_variable(0, null, 0);?><?php $_smarty_tpl->tpl_vars['HOURS'] = new Smarty_variable(0, null, 0);?><?php $_smarty_tpl->tpl_vars['MINUTES'] = new Smarty_variable(1, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['DAY'] = new Smarty_variable($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value[0], null, 0);?><?php $_smarty_tpl->tpl_vars['HOUR'] = new Smarty_variable($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value[1], null, 0);?><?php $_smarty_tpl->tpl_vars['MINUTE'] = new Smarty_variable($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value[2], null, 0);?><?php }?><div id="js-reminder-controls"><div style="float:left;margin-top: 1%;"><input type=hidden name=set_reminder value=0 /><input type=checkbox name=set_reminder <?php if ($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value!=''){?>checked<?php }?> value=1 />&nbsp;&nbsp;</div><div id="js-reminder-selections" style="float:left;visibility:<?php if ($_smarty_tpl->tpl_vars['REMINDER_VALUES']->value!=''){?>visible<?php }else{ ?>collapse<?php }?>;"><div style="float:left"><div style="float:left"><select class="select2" name="remdays"><?php $_smarty_tpl->tpl_vars['DAYS'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['DAYS']->step = 1;$_smarty_tpl->tpl_vars['DAYS']->total = (int)ceil(($_smarty_tpl->tpl_vars['DAYS']->step > 0 ? 31+1 - (0) : 0-(31)+1)/abs($_smarty_tpl->tpl_vars['DAYS']->step));
if ($_smarty_tpl->tpl_vars['DAYS']->total > 0){
for ($_smarty_tpl->tpl_vars['DAYS']->value = 0, $_smarty_tpl->tpl_vars['DAYS']->iteration = 1;$_smarty_tpl->tpl_vars['DAYS']->iteration <= $_smarty_tpl->tpl_vars['DAYS']->total;$_smarty_tpl->tpl_vars['DAYS']->value += $_smarty_tpl->tpl_vars['DAYS']->step, $_smarty_tpl->tpl_vars['DAYS']->iteration++){
$_smarty_tpl->tpl_vars['DAYS']->first = $_smarty_tpl->tpl_vars['DAYS']->iteration == 1;$_smarty_tpl->tpl_vars['DAYS']->last = $_smarty_tpl->tpl_vars['DAYS']->iteration == $_smarty_tpl->tpl_vars['DAYS']->total;?><option value="<?php echo $_smarty_tpl->tpl_vars['DAYS']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['DAYS']->value==$_smarty_tpl->tpl_vars['DAY']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['DAYS']->value;?>
</option><?php }} ?></select></div><div style="float:left;margin-top:5px">&nbsp;<?php echo vtranslate('LBL_DAYS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</div><div class="clearfix"></div></div><div style="float:left"><div style="float:left"><select class="select2" name="remhrs"><?php $_smarty_tpl->tpl_vars['HOURS'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['HOURS']->step = 1;$_smarty_tpl->tpl_vars['HOURS']->total = (int)ceil(($_smarty_tpl->tpl_vars['HOURS']->step > 0 ? 23+1 - (0) : 0-(23)+1)/abs($_smarty_tpl->tpl_vars['HOURS']->step));
if ($_smarty_tpl->tpl_vars['HOURS']->total > 0){
for ($_smarty_tpl->tpl_vars['HOURS']->value = 0, $_smarty_tpl->tpl_vars['HOURS']->iteration = 1;$_smarty_tpl->tpl_vars['HOURS']->iteration <= $_smarty_tpl->tpl_vars['HOURS']->total;$_smarty_tpl->tpl_vars['HOURS']->value += $_smarty_tpl->tpl_vars['HOURS']->step, $_smarty_tpl->tpl_vars['HOURS']->iteration++){
$_smarty_tpl->tpl_vars['HOURS']->first = $_smarty_tpl->tpl_vars['HOURS']->iteration == 1;$_smarty_tpl->tpl_vars['HOURS']->last = $_smarty_tpl->tpl_vars['HOURS']->iteration == $_smarty_tpl->tpl_vars['HOURS']->total;?><option value="<?php echo $_smarty_tpl->tpl_vars['HOURS']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['HOURS']->value==$_smarty_tpl->tpl_vars['HOUR']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['HOURS']->value;?>
</option><?php }} ?></select></div><div style="float:left;margin-top:5px">&nbsp;<?php echo vtranslate('LBL_HOURS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</div><div class="clearfix"></div></div><div style="float:left"><div style="float:left"><select class="select2" name="remmin"><?php $_smarty_tpl->tpl_vars['MINUTES'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['MINUTES']->step = 1;$_smarty_tpl->tpl_vars['MINUTES']->total = (int)ceil(($_smarty_tpl->tpl_vars['MINUTES']->step > 0 ? 59+1 - (1) : 1-(59)+1)/abs($_smarty_tpl->tpl_vars['MINUTES']->step));
if ($_smarty_tpl->tpl_vars['MINUTES']->total > 0){
for ($_smarty_tpl->tpl_vars['MINUTES']->value = 1, $_smarty_tpl->tpl_vars['MINUTES']->iteration = 1;$_smarty_tpl->tpl_vars['MINUTES']->iteration <= $_smarty_tpl->tpl_vars['MINUTES']->total;$_smarty_tpl->tpl_vars['MINUTES']->value += $_smarty_tpl->tpl_vars['MINUTES']->step, $_smarty_tpl->tpl_vars['MINUTES']->iteration++){
$_smarty_tpl->tpl_vars['MINUTES']->first = $_smarty_tpl->tpl_vars['MINUTES']->iteration == 1;$_smarty_tpl->tpl_vars['MINUTES']->last = $_smarty_tpl->tpl_vars['MINUTES']->iteration == $_smarty_tpl->tpl_vars['MINUTES']->total;?><option value="<?php echo $_smarty_tpl->tpl_vars['MINUTES']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MINUTES']->value==$_smarty_tpl->tpl_vars['MINUTE']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['MINUTES']->value;?>
</option><?php }} ?></select></div><div style="float:left;margin-top:5px">&nbsp;<?php echo vtranslate('LBL_MINUTES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</div><div class="clearfix"></div></div></div><div class="clearfix"></div></div><?php }} ?>