<?php /* Smarty version Smarty-3.1.7, created on 2018-11-26 14:14:17
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/ChartReportHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:705032205bfbce81371b98-37016674%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ec8e109eff47d4d34903f12be0d672150fd428b' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/ChartReportHeader.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '705032205bfbce81371b98-37016674',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'DATE_FILTERS' => 0,
    'MODULE' => 0,
    'REPORT_MODEL' => 0,
    'RECORD' => 0,
    'PRIMARY_MODULE' => 0,
    'SECONDARY_MODULES' => 0,
    'ADVANCED_FILTERS' => 0,
    'CHART_MODEL' => 0,
    'PRIMARY_MODULE_RECORD_STRUCTURE' => 0,
    'BLOCK_LABEL' => 0,
    'LINEITEM_FIELD_IN_CALCULATION' => 0,
    'key' => 0,
    'BLOCK_FIELDS' => 0,
    'SECONDARY_MODULE_RECORD_STRUCTURES' => 0,
    'MODULE_LABEL' => 0,
    'SECONDARY_MODULE_RECORD_STRUCTURE' => 0,
    'SELECTED_ADVANCED_FILTER_FIELDS' => 0,
    'filterConditionNotExists' => 0,
    'RECORD_STRUCTURE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfbce814512b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfbce814512b')) {function content_5bfbce814512b($_smarty_tpl) {?>
<div class=""><div class="reportsDetailHeader"><input type="hidden" name="date_filters" data-value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['DATE_FILTERS']->value));?>
' /><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("DetailViewActions.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<div class="filterElements contactAdd filterConditionsDiv<?php if (!$_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isEditableBySharing()){?> hide<?php }?>"><form name='chartDetailForm' id='chartDetailForm' method="POST"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="ChartSave" /><input type="hidden" name="recordId" id="recordId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value;?>
" /><input type="hidden" name="reportname" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reportname');?>
" /><input type="hidden" name="folderid" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('folderid');?>
" /><input type="hidden" name="reports_description" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reports_description');?>
" /><input type="hidden" name="primary_module" value="<?php echo $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value;?>
" /><input type="hidden" name="secondary_modules" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SECONDARY_MODULES']->value);?>
 /><input type="hidden" name="advanced_filter" id="advanced_filter" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['ADVANCED_FILTERS']->value);?>
 /><input type="hidden" name='groupbyfield' value=<?php echo $_smarty_tpl->tpl_vars['CHART_MODEL']->value->getGroupByField();?>
 /><input type="hidden" name='datafields' value=<?php echo Zend_JSON::encode($_smarty_tpl->tpl_vars['CHART_MODEL']->value->getDataFields());?>
 /><input type="hidden" name='charttype' value="<?php echo $_smarty_tpl->tpl_vars['CHART_MODEL']->value->getChartType();?>
" /><?php $_smarty_tpl->tpl_vars['RECORD_STRUCTURE'] = new Smarty_variable(array(), null, 0);?><?php $_smarty_tpl->tpl_vars['PRIMARY_MODULE_LABEL'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value), null, 0);?><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PRIMARY_MODULE_RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><?php $_smarty_tpl->tpl_vars['PRIMARY_MODULE_BLOCK_LABEL'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(($_smarty_tpl->tpl_vars['PRIMARY_MODULE_LABEL']->value)." ".($_smarty_tpl->tpl_vars['PRIMARY_MODULE_BLOCK_LABEL']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELD_IN_CALCULATION']->value==false&&$_smarty_tpl->tpl_vars['BLOCK_LABEL']->value=='LBL_ITEM_DETAILS'){?><?php }else{ ?><?php $_smarty_tpl->createLocalArrayVariable('RECORD_STRUCTURE', null, 0);
$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value[$_smarty_tpl->tpl_vars['key']->value] = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value;?><?php }?><?php } ?><?php  $_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE']->_loop = false;
 $_smarty_tpl->tpl_vars['MODULE_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE']->key => $_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE']->value){
$_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE']->_loop = true;
 $_smarty_tpl->tpl_vars['MODULE_LABEL']->value = $_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE']->key;
?><?php $_smarty_tpl->tpl_vars['SECONDARY_MODULE_LABEL'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['MODULE_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE_LABEL']->value), null, 0);?><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SECONDARY_MODULE_RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><?php $_smarty_tpl->tpl_vars['SECONDARY_MODULE_BLOCK_LABEL'] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE_LABEL']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(($_smarty_tpl->tpl_vars['SECONDARY_MODULE_LABEL']->value)." ".($_smarty_tpl->tpl_vars['SECONDARY_MODULE_BLOCK_LABEL']->value), null, 0);?><?php $_smarty_tpl->createLocalArrayVariable('RECORD_STRUCTURE', null, 0);
$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value[$_smarty_tpl->tpl_vars['key']->value] = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value;?><?php } ?><?php } ?><div class="well filterConditionContainer"><div><div class='row'><span class="col-lg-4"><div><span><?php echo vtranslate('LBL_SELECT_GROUP_BY_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="redColor">*</span></div><br><div><select id='groupbyfield' name='groupbyfield' class="col-lg-10" data-validation-engine="validate[required]" style='min-width:300px;'></select></div></span><span class="col-lg-2">&nbsp;</span><span class="col-lg-4"><div><span><?php echo vtranslate('LBL_SELECT_DATA_FIELD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><span class="redColor">*</span></div><br><div><select id='datafields' name='datafields[]' class="col-lg-10" data-validation-engine="validate[required]" style='min-width:300px;'></select></div></span></div><br><div class='hide'><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("chartReportHiddenContents.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div></div><div><?php $_smarty_tpl->tpl_vars['filterConditionNotExists'] = new Smarty_variable((count($_smarty_tpl->tpl_vars['SELECTED_ADVANCED_FILTER_FIELDS']->value[1]['columns'])==0&&count($_smarty_tpl->tpl_vars['SELECTED_ADVANCED_FILTER_FIELDS']->value[2]['columns'])==0), null, 0);?><button class="btn btn-default" name="modify_condition" data-val="<?php echo $_smarty_tpl->tpl_vars['filterConditionNotExists']->value;?>
"><strong><?php echo vtranslate('LBL_MODIFY_CONDITION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>&nbsp;&nbsp;<i class="fa <?php if ($_smarty_tpl->tpl_vars['filterConditionNotExists']->value==true){?>fa-chevron-right<?php }else{ ?>fa-chevron-down<?php }?>"></i></button></div><br><div id='filterContainer' class='<?php if ($_smarty_tpl->tpl_vars['filterConditionNotExists']->value==true){?> hide <?php }?>'><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('AdvanceFilter.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'ADVANCE_CRITERIA'=>$_smarty_tpl->tpl_vars['SELECTED_ADVANCED_FILTER_FIELDS']->value,'COLUMNNAME_API'=>'getReportFilterColumnName'), 0);?>
</div><?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isEditableBySharing()){?><div class="row textAlignCenter hide reportActionButtons"><button class="btn btn-success generateReportChart" data-mode="save" value="<?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><strong><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div><?php }?></div></form></div></div><div id="reportContentsDiv"><?php }} ?>