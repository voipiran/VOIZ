<?php /* Smarty version Smarty-3.1.7, created on 2018-11-21 11:07:49
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/AdvanceFilter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8244730535bf50b4da08ff3-70370427%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bca217d52e852fec7b97703736b6d5695a8db2be' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/AdvanceFilter.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8244730535bf50b4da08ff3-70370427',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ADVANCE_CRITERIA' => 0,
    'ALL_CONDITION_CRITERIA' => 0,
    'ANY_CONDITION_CRITERIA' => 0,
    'DATE_FILTERS' => 0,
    'ADVANCED_FILTER_OPTIONS_BY_TYPE' => 0,
    'ADVANCED_FILTER_OPTIONS' => 0,
    'ADVANCE_FILTER_OPTION_KEY' => 0,
    'ADVANCE_FILTER_OPTION' => 0,
    'MODULE' => 0,
    'QUALIFIED_MODULE' => 0,
    'RECORD_STRUCTURE' => 0,
    'CONDITION_INFO' => 0,
    'GROUP_CONDITION' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bf50b4dab445',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bf50b4dab445')) {function content_5bf50b4dab445($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['ALL_CONDITION_CRITERIA'] = new Smarty_variable($_smarty_tpl->tpl_vars['ADVANCE_CRITERIA']->value[1], null, 0);?><?php $_smarty_tpl->tpl_vars['ANY_CONDITION_CRITERIA'] = new Smarty_variable($_smarty_tpl->tpl_vars['ADVANCE_CRITERIA']->value[2], null, 0);?><?php if (empty($_smarty_tpl->tpl_vars['ALL_CONDITION_CRITERIA']->value)){?><?php $_smarty_tpl->tpl_vars['ALL_CONDITION_CRITERIA'] = new Smarty_variable(array(), null, 0);?><?php }?><?php if (empty($_smarty_tpl->tpl_vars['ANY_CONDITION_CRITERIA']->value)){?><?php $_smarty_tpl->tpl_vars['ANY_CONDITION_CRITERIA'] = new Smarty_variable(array(), null, 0);?><?php }?><div class="filterContainer filterElements well filterConditionContainer filterConditionsDiv"><input type="hidden" name="date_filters" data-value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['DATE_FILTERS']->value));?>
' /><input type=hidden name="advanceFilterOpsByFieldType" data-value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['ADVANCED_FILTER_OPTIONS_BY_TYPE']->value);?>
' /><?php  $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->_loop = false;
 $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ADVANCED_FILTER_OPTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->key => $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value){
$_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->_loop = true;
 $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION_KEY']->value = $_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->key;
?><?php $_smarty_tpl->createLocalArrayVariable('ADVANCED_FILTER_OPTIONS', null, 0);
$_smarty_tpl->tpl_vars['ADVANCED_FILTER_OPTIONS']->value[$_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION_KEY']->value] = vtranslate($_smarty_tpl->tpl_vars['ADVANCE_FILTER_OPTION']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?><?php } ?><input type=hidden name="advanceFilterOptions" data-value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['ADVANCED_FILTER_OPTIONS']->value);?>
' /><div class="allConditionContainer conditionGroup contentsBackground" style="padding-bottom:15px;"><div class="header"><span><strong><?php echo vtranslate('LBL_ALL_CONDITIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></span>&nbsp;<span>(<?php echo vtranslate('LBL_ALL_CONDITIONS_DESC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
)</span></div><div class="contents"><div class="conditionList"><?php  $_smarty_tpl->tpl_vars['CONDITION_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CONDITION_INFO']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_CONDITION_CRITERIA']->value['columns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CONDITION_INFO']->key => $_smarty_tpl->tpl_vars['CONDITION_INFO']->value){
$_smarty_tpl->tpl_vars['CONDITION_INFO']->_loop = true;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('AdvanceFilterCondition.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'CONDITION_INFO'=>$_smarty_tpl->tpl_vars['CONDITION_INFO']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value), 0);?>
<?php } ?><?php if (count($_smarty_tpl->tpl_vars['ALL_CONDITION_CRITERIA']->value)==0){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('AdvanceFilterCondition.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value,'CONDITION_INFO'=>array()), 0);?>
<?php }?></div><div class="hide basic"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('AdvanceFilterCondition.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'CONDITION_INFO'=>array(),'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value,'NOCHOSEN'=>true), 0);?>
</div><div class="addCondition"><button type="button" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_CONDITION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div><div class="groupCondition"><?php $_smarty_tpl->tpl_vars['GROUP_CONDITION'] = new Smarty_variable($_smarty_tpl->tpl_vars['ALL_CONDITION_CRITERIA']->value['condition'], null, 0);?><?php if (empty($_smarty_tpl->tpl_vars['GROUP_CONDITION']->value)){?><?php $_smarty_tpl->tpl_vars['GROUP_CONDITION'] = new Smarty_variable("and", null, 0);?><?php }?><input type="hidden" name="condition" value="<?php echo $_smarty_tpl->tpl_vars['GROUP_CONDITION']->value;?>
" /></div></div></div><div class="anyConditionContainer conditionGroup contentsBackground"><div class="header"><span><strong><?php echo vtranslate('LBL_ANY_CONDITIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></span>&nbsp;<span>(<?php echo vtranslate('LBL_ANY_CONDITIONS_DESC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
)</span></div><div class="contents"><div class="conditionList"><?php  $_smarty_tpl->tpl_vars['CONDITION_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CONDITION_INFO']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ANY_CONDITION_CRITERIA']->value['columns']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CONDITION_INFO']->key => $_smarty_tpl->tpl_vars['CONDITION_INFO']->value){
$_smarty_tpl->tpl_vars['CONDITION_INFO']->_loop = true;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('AdvanceFilterCondition.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'CONDITION_INFO'=>$_smarty_tpl->tpl_vars['CONDITION_INFO']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value,'CONDITION'=>"or"), 0);?>
<?php } ?><?php if (count($_smarty_tpl->tpl_vars['ANY_CONDITION_CRITERIA']->value)==0){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('AdvanceFilterCondition.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value,'CONDITION_INFO'=>array(),'CONDITION'=>"or"), 0);?>
<?php }?></div><div class="hide basic"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('AdvanceFilterCondition.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value,'CONDITION_INFO'=>array(),'CONDITION'=>"or",'NOCHOSEN'=>true), 0);?>
</div><div class="addCondition"><button type="button" class="btn  btn-default"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_CONDITION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></div></div></div><?php }} ?>