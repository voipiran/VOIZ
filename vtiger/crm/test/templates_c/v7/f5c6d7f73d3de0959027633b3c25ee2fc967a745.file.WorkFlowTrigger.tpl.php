<?php /* Smarty version Smarty-3.1.7, created on 2018-11-28 12:30:10
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Workflows/WorkFlowTrigger.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15425294255bfe591a45e2c9-02922276%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5c6d7f73d3de0959027633b3c25ee2fc967a745' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Workflows/WorkFlowTrigger.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15425294255bfe591a45e2c9-02922276',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WORKFLOW_MODEL_OBJ' => 0,
    'EXECUTION_CONDITION' => 0,
    'QUALIFIED_MODULE' => 0,
    'SINGLE_SELECTED_MODULE' => 0,
    'SELECTED_MODULE' => 0,
    'SCHEDULED_WORKFLOW_COUNT' => 0,
    'MAX_ALLOWED_SCHEDULED_WORKFLOWS' => 0,
    'dayOfWeek' => 0,
    'DAYS' => 0,
    'specificDate' => 0,
    'specificDate1' => 0,
    'CURRENT_USER' => 0,
    'ANNUAL_DATES' => 0,
    'DATES' => 0,
    'ACTIVE_ADMIN' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfe591a61dcf',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfe591a61dcf')) {function content_5bfe591a61dcf($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['EXECUTION_CONDITION'] = new Smarty_variable($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->executionCondition, null, 0);?><input type="hidden" name="workflow_trigger" value="<?php echo $_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value;?>
" /><div class="form-group"><label for="name" class="col-sm-3 control-label"><?php echo vtranslate('LBL_TRIGGER_WORKFLOW_ON',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-6 controls"><?php $_smarty_tpl->tpl_vars['SINGLE_SELECTED_MODULE'] = new Smarty_variable("SINGLE_".($_smarty_tpl->tpl_vars['SELECTED_MODULE']->value), null, 0);?><span><input type="radio" name="workflow_trigger" value="1" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value=='1'){?> checked="" <?php }?>> <span id="workflowTriggerCreate"><?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_SELECTED_MODULE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value);?>
 <?php echo vtranslate('LBL_CREATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></span><br><span><input type="radio" name="workflow_trigger" value="3" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value=='3'||$_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value=='2'){?> checked="" <?php }?>> <span id="workflowTriggerUpdate"><?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_SELECTED_MODULE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE']->value);?>
 <?php echo vtranslate('LBL_UPDATED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span> &nbsp;(<?php echo vtranslate('LBL_INCLUDES_CREATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
)</span><br><span><input type="radio" name="workflow_trigger" value="6" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value=='6'){?> checked="" <?php }elseif($_smarty_tpl->tpl_vars['SCHEDULED_WORKFLOW_COUNT']->value>=$_smarty_tpl->tpl_vars['MAX_ALLOWED_SCHEDULED_WORKFLOWS']->value){?> disabled="disabled" <?php }?>> <?php echo vtranslate('LBL_TIME_INTERVAL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php if ($_smarty_tpl->tpl_vars['SCHEDULED_WORKFLOW_COUNT']->value>=$_smarty_tpl->tpl_vars['MAX_ALLOWED_SCHEDULED_WORKFLOWS']->value){?>&nbsp;&nbsp;<span class="alert-info textAlignCenter"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;(<?php echo vtranslate('LBL_MAX_SCHEDULED_WORKFLOWS_EXCEEDED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,$_smarty_tpl->tpl_vars['MAX_ALLOWED_SCHEDULED_WORKFLOWS']->value);?>
)</span><?php }?></span></div></div><div class="form-group workflowRecurrenceBlock <?php if (!in_array($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value,array(2,3))){?> hide <?php }?>"><label for="name" class="col-sm-3 control-label"><?php echo vtranslate('LBL_RECURRENCE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-5 controls"><span><input type="radio" name="workflow_recurrence" value="2" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value=='2'){?> checked="" <?php }?>> <?php echo vtranslate('LBL_FIRST_TIME_CONDITION_MET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><span><input type="radio" name="workflow_recurrence" value="3" <?php if ($_smarty_tpl->tpl_vars['EXECUTION_CONDITION']->value=='3'){?> checked="" <?php }?>> <?php echo vtranslate('LBL_EVERY_TIME_CONDITION_MET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div><?php if ($_smarty_tpl->tpl_vars['SCHEDULED_WORKFLOW_COUNT']->value<$_smarty_tpl->tpl_vars['MAX_ALLOWED_SCHEDULED_WORKFLOWS']->value){?><div id="scheduleBox" class='contentsBackground <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->executionCondition!=6){?> hide <?php }?>'><div class="form-group"><label class="col-sm-3 control-label"> <?php echo vtranslate('LBL_FREQUENCY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 </label><div class="col-sm-9 controls"><div class="well"><div class="form-group"><label for="schtypeid" class="col-sm-2 control-label"><?php echo vtranslate('LBL_RUN_WORKFLOW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-4 controls"><select class='select2' id='schtypeid' name='schtypeid' style="min-width: 150px;"><option value="1" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid==1){?>selected<?php }?>><?php echo vtranslate('LBL_HOURLY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="2" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid==2){?>selected<?php }?>><?php echo vtranslate('LBL_DAILY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="3" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid==3){?>selected<?php }?>><?php echo vtranslate('LBL_WEEKLY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="4" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid==4){?>selected<?php }?>><?php echo vtranslate('LBL_SPECIFIC_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option value="5" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid==5){?>selected<?php }?>><?php echo vtranslate('LBL_MONTHLY_BY_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><!--option value="6" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid==6){?>selected<?php }?>><?php echo vtranslate('LBL_MONTHLY_BY_WEEKDAY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option--><option value="7" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid==7){?>selected<?php }?>><?php echo vtranslate('LBL_YEARLY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></div></div><div class='form-group <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid!=3){?> hide <?php }?>' id='scheduledWeekDay'><label class='col-sm-2 control-label' style='position:relative;top:5px;'><?php echo vtranslate('LBL_ON_THESE_DAYS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></label><div class='col-sm-10 controls' style="padding-top: 15px; padding-bottom: 15px;"><?php $_smarty_tpl->tpl_vars['dayOfWeek'] = new Smarty_variable(Zend_Json::decode($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schdayofweek), null, 0);?><div class="weekDaySelect"><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value)&&in_array("7",$_smarty_tpl->tpl_vars['dayOfWeek']->value)){?>ui-selected<?php }?>" data-value="7"> <?php echo vtranslate('LBL_DAY0','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value)&&in_array("1",$_smarty_tpl->tpl_vars['dayOfWeek']->value)){?>ui-selected<?php }?>" data-value="1"> <?php echo vtranslate('LBL_DAY1','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value)&&in_array("2",$_smarty_tpl->tpl_vars['dayOfWeek']->value)){?>ui-selected<?php }?>" data-value="2"> <?php echo vtranslate('LBL_DAY2','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value)&&in_array("3",$_smarty_tpl->tpl_vars['dayOfWeek']->value)){?>ui-selected<?php }?>" data-value="3"> <?php echo vtranslate('LBL_DAY3','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value)&&in_array("4",$_smarty_tpl->tpl_vars['dayOfWeek']->value)){?>ui-selected<?php }?>" data-value="4"> <?php echo vtranslate('LBL_DAY4','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value)&&in_array("5",$_smarty_tpl->tpl_vars['dayOfWeek']->value)){?>ui-selected<?php }?>" data-value="5"> <?php echo vtranslate('LBL_DAY5','Calendar');?>
 </span><span class="ui-state-default <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value)&&in_array("6",$_smarty_tpl->tpl_vars['dayOfWeek']->value)){?>ui-selected<?php }?>" data-value="6"> <?php echo vtranslate('LBL_DAY6','Calendar');?>
 </span><input type="hidden" data-rule-required="true" name='schdayofweek' id='schdayofweek' <?php if (is_array($_smarty_tpl->tpl_vars['dayOfWeek']->value)){?> value="<?php echo implode(',',$_smarty_tpl->tpl_vars['dayOfWeek']->value);?>
" <?php }else{ ?> value=""<?php }?>/></div></div></div><div class='form-group <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid!=5){?> hide <?php }?>' id='scheduleMonthByDates' style="padding:5px 0px;"><label class='col-sm-2 control-label'><?php echo vtranslate('LBL_ON_THESE_DAYS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></label><div class='col-sm-4 controls'><?php $_smarty_tpl->tpl_vars['DAYS'] = new Smarty_variable(Zend_Json::decode($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schdayofmonth), null, 0);?><select style='width:150px;' multiple class="select2" data-rule-required="true" name='schdayofmonth[]' id='schdayofmonth' ><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['foo'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['name'] = 'foo';
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'] = is_array($_loop=31) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['foo']['total']);
?><option value=<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['foo']['iteration'];?>
 <?php if (is_array($_smarty_tpl->tpl_vars['DAYS']->value)&&in_array($_smarty_tpl->getVariable('smarty')->value['section']['foo']['iteration'],$_smarty_tpl->tpl_vars['DAYS']->value)){?>selected<?php }?>><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['foo']['iteration'];?>
</option><?php endfor; endif; ?></select></div></div><div class='form-group <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid!=4){?> hide <?php }?>' id='scheduleByDate' style="padding:5px 0px;"><label class='col-sm-2 control-label'><?php echo vtranslate('LBL_CHOOSE_DATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></label><div class='col-sm-3 controls'><div class="input-group" style="margin-bottom: 3px"><?php $_smarty_tpl->tpl_vars['specificDate'] = new Smarty_variable(Zend_Json::decode($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schannualdates), null, 0);?><?php if ($_smarty_tpl->tpl_vars['specificDate']->value[0]!=''){?><?php $_smarty_tpl->tpl_vars['specificDate1'] = new Smarty_variable(DateTimeField::convertToUserFormat($_smarty_tpl->tpl_vars['specificDate']->value[0]), null, 0);?><?php }?><input type="text" class="dateField form-control" name="schdate" value="<?php echo $_smarty_tpl->tpl_vars['specificDate1']->value;?>
" data-date-format="<?php echo $_smarty_tpl->tpl_vars['CURRENT_USER']->value->date_format;?>
" data-rule-required="true"/><span class="input-group-addon"><i class="fa fa-calendar "></i></span></div></div></div><div class='form-group <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid!=7){?> hide <?php }?>' id='scheduleAnually'><label class='col-sm-2 control-label'> <?php echo vtranslate('LBL_SELECT_MONTH_AND_DAY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <span class="redColor">*</span> </label><div class='col-sm-6 controls'><div id='annualDatePicker'></div></div><div class='col-sm-4 controls'><label style='padding-bottom:5px;'><?php echo vtranslate('LBL_SELECTED_DATES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div><input type=hidden id=hiddenAnnualDates value='<?php echo $_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schannualdates;?>
' /><select multiple class="select2" id='annualDates' name='schannualdates[]' data-rule-required="true" style="min-width: 100px;"><?php  $_smarty_tpl->tpl_vars['DATES'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DATES']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ANNUAL_DATES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DATES']->key => $_smarty_tpl->tpl_vars['DATES']->value){
$_smarty_tpl->tpl_vars['DATES']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['DATES']->value;?>
" selected><?php echo $_smarty_tpl->tpl_vars['DATES']->value;?>
</option><?php } ?></select></div></div></div><div class="form-group <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid<2){?> hide <?php }?>" id='scheduledTime' style='padding:5px 0px 10px 0px;'><label for="schtime" class="col-sm-2 control-label"><?php echo vtranslate('LBL_AT_TIME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <span class="redColor">*</span></label><div class="col-sm-2 controls" id='schtime'><div class="input-group time" ><input type='text' data-format='24' name='schtime' value="<?php echo $_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtime;?>
" data-rule-required="true" class="timepicker-default inputElement"/><span  class="input-group-addon"><i  class="fa fa-clock-o"></i></span></div></div></div><?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->nexttrigger_time){?><div class="form-group"><label class='col-sm-2 control-label'><?php echo vtranslate('LBL_NEXT_TRIGGER_TIME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class='col-sm-4 controls'><?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->schtypeid!=4){?><?php echo DateTimeField::convertToUserFormat($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->nexttrigger_time);?>
<span>&nbsp;(<?php echo $_smarty_tpl->tpl_vars['ACTIVE_ADMIN']->value->time_zone;?>
)</span><?php }?></div></div><?php }?></div></div></div></div><?php }?><?php }} ?>