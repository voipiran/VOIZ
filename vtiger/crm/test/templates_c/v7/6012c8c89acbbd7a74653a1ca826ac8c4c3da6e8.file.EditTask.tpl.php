<?php /* Smarty version Smarty-3.1.7, created on 2019-03-25 12:32:24
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Workflows/EditTask.tpl" */ ?>
<?php /*%%SmartyHeaderCode:232739985c988b10754445-94812748%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6012c8c89acbbd7a74653a1ca826ac8c4c3da6e8' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Workflows/EditTask.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '232739985c988b10754445-94812748',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'TASK_TYPE_MODEL' => 0,
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'WORKFLOW_ID' => 0,
    'TASK_ID' => 0,
    'TASK_MODEL' => 0,
    'TASK_OBJECT' => 0,
    'trigger' => 0,
    'days' => 0,
    'direction' => 0,
    'DATETIME_FIELDS' => 0,
    'DATETIME_FIELD' => 0,
    'TASK_TEMPLATE_PATH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c988b1082a2b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c988b1082a2b')) {function content_5c988b1082a2b($_smarty_tpl) {?>
<div class="fc-overlay-modal modal-content"><div class="modal-content"><?php ob_start();?><?php echo vtranslate('LBL_ADD_TASKS_FOR_WORKFLOW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['TASK_TYPE_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable((($_tmp1).(" -> ")).($_tmp2), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<div class="modal-body editTaskBody"><form class="form-horizontal" id="saveTask" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="action" value="TaskAjax" /><input type="hidden" name="mode" value="Save" /><input type="hidden" name="for_workflow" value="<?php echo $_smarty_tpl->tpl_vars['WORKFLOW_ID']->value;?>
" /><input type="hidden" name="task_id" value="<?php echo $_smarty_tpl->tpl_vars['TASK_ID']->value;?>
" /><input type="hidden" name="taskType" id="taskType" value="<?php echo $_smarty_tpl->tpl_vars['TASK_TYPE_MODEL']->value->get('tasktypename');?>
" /><input type="hidden" name="tmpTaskId" value="<?php echo $_smarty_tpl->tpl_vars['TASK_MODEL']->value->get('tmpTaskId');?>
" /><?php if ($_smarty_tpl->tpl_vars['TASK_MODEL']->value->get('active')=='false'){?> <input type="hidden" name="active" value="false" /> <?php }?><div id="scrollContainer"><div class="tabbable"><div class="row form-group"><div class="col-sm-6 col-xs-6"><div class="row"><div class="col-sm-3 col-xs-3"><?php echo vtranslate('LBL_TASK_TITLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></div><div class="col-sm-9 col-xs-9"><input name="summary" class="inputElement" data-rule-required="true" type="text" value="<?php echo $_smarty_tpl->tpl_vars['TASK_MODEL']->value->get('summary');?>
" /></div></div></div></div><?php if ($_smarty_tpl->tpl_vars['TASK_TYPE_MODEL']->value->get('tasktypename')=="VTEmailTask"&&$_smarty_tpl->tpl_vars['TASK_OBJECT']->value->trigger!=null){?><?php if (($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->trigger!=null)){?><?php $_smarty_tpl->tpl_vars['trigger'] = new Smarty_variable($_smarty_tpl->tpl_vars['TASK_OBJECT']->value->trigger, null, 0);?><?php $_smarty_tpl->tpl_vars['days'] = new Smarty_variable($_smarty_tpl->tpl_vars['trigger']->value['days'], null, 0);?><?php if (($_smarty_tpl->tpl_vars['days']->value<0)){?><?php $_smarty_tpl->tpl_vars['days'] = new Smarty_variable($_smarty_tpl->tpl_vars['days']->value*-1, null, 0);?><?php $_smarty_tpl->tpl_vars['direction'] = new Smarty_variable('before', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['direction'] = new Smarty_variable('after', null, 0);?><?php }?><?php }?><div class="row form-group"><div class="col-sm-9 col-xs-9"><div class="row"><div class="col-sm-2 col-xs-2"> <?php echo vtranslate('LBL_DELAY_ACTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 </div><div class="col-sm-10 col-xs-10"><div class="row"><div class="col-sm-1 col-xs-1" style="margin-top: 7px;"><input type="checkbox" class="alignTop" name="check_select_date" <?php if ($_smarty_tpl->tpl_vars['trigger']->value!=null){?>checked<?php }?>/></div><div class="col-sm-10 col-xs-10 <?php if ($_smarty_tpl->tpl_vars['trigger']->value!=null){?>show <?php }else{ ?> hide <?php }?>" id="checkSelectDateContainer"><div class="row"><div class="col-sm-2 col-xs-2"><div class="row"><div class="col-sm-6 col-xs-6" style="padding: 0px;"><input class="inputElement" type="text" name="select_date_days" value="<?php echo $_smarty_tpl->tpl_vars['days']->value;?>
" data-rule-WholeNumber=="true" >&nbsp;</div><div class="alignMiddle col-sm-5 col-xs-5" style="padding: 0px; margin-left: 2px;"><span style="position:relative;top:3px;">&nbsp;<?php echo vtranslate('LBL_DAYS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div></div><div class="col-sm-3 col-xs-3" ><select class="select2" name="select_date_direction" style="width: 100px"><option <?php if ($_smarty_tpl->tpl_vars['direction']->value=='after'){?> selected="" <?php }?> value="after"><?php echo vtranslate('LBL_AFTER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><option <?php if ($_smarty_tpl->tpl_vars['direction']->value=='before'){?> selected="" <?php }?> value="before"><?php echo vtranslate('LBL_BEFORE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option></select></div><div class="col-sm-6 col-xs-6 marginLeftZero"><select class="select2" name="select_date_field"><?php  $_smarty_tpl->tpl_vars['DATETIME_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DATETIME_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DATETIME_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DATETIME_FIELD']->key => $_smarty_tpl->tpl_vars['DATETIME_FIELD']->value){
$_smarty_tpl->tpl_vars['DATETIME_FIELD']->_loop = true;
?><option <?php if ($_smarty_tpl->tpl_vars['trigger']->value['field']==$_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->get('name')){?> selected="" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->get('name');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['DATETIME_FIELD']->value->getModuleName());?>
</option><?php } ?></select></div></div></div></div></div></div></div></div><?php }?><br><div class="taskTypeUi"><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['TASK_TEMPLATE_PATH']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div></div><div class="modal-overlay-footer clearfix" style="margin-left: 230px; border-left-width: 0px;"><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type="submit" class="btn btn-success" ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div></div></div>
<?php }} ?>