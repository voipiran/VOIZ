<?php /* Smarty version Smarty-3.1.7, created on 2018-11-21 11:14:17
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/step2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16899505145bf50cd1d96ae2-58453045%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b83d49fb9f7bbdaa53c834cf24257f21fd2c78f7' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/step2.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16899505145bf50cd1d96ae2-58453045',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'RECORD_ID' => 0,
    'REPORT_MODEL' => 0,
    'PRIMARY_MODULE' => 0,
    'SECONDARY_MODULES' => 0,
    'SELECTED_FIELDS' => 0,
    'IS_DUPLICATE' => 0,
    'PRIMARY_MODULE_FIELDS' => 0,
    'PRIMARY_MODULE_NAME' => 0,
    'BLOCK_LABEL' => 0,
    'BLOCK' => 0,
    'FIELD_KEY' => 0,
    'FIELD_LABEL' => 0,
    'SECONDARY_MODULE_FIELDS' => 0,
    'SECONDARY_MODULE' => 0,
    'SECONDARY_MODULE_NAME' => 0,
    'SELECTED_SORT_FIELDS' => 0,
    'ROW_VAL' => 0,
    'SELECTED_SORT_FEILDS_ARRAY' => 0,
    'SELECTED_SORT_FIELDS_COUNT' => 0,
    'CALCULATION_FIELDS' => 0,
    'CALCULATION_FIELDS_MODULE' => 0,
    'CALCULATION_FIELD_KEY' => 0,
    'FIELD_EXPLODE' => 0,
    'FIELDNAME_EXPLODE' => 0,
    'fieldNameArray' => 0,
    'CALCULATION_FIELDS_MODULE_LABEL' => 0,
    'CALCULATION_FIELD' => 0,
    'FIELD_OPERATION_VALUES' => 0,
    'FIELD_OPERATION_VALUE' => 0,
    'FIELD_CALCULATION_VALUE' => 0,
    'SELECTED_CALCULATION_FIELDS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bf50cd213554',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bf50cd213554')) {function content_5bf50cd213554($_smarty_tpl) {?>
<form class="form-horizontal recordEditView" id="report_step2" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="view" value="Edit" /><input type="hidden" name="mode" value="step3" /><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><input type="hidden" name="reportname" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('reportname');?>
" /><?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('members')){?><input type="hidden" name="members" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('members'));?>
 /><?php }?><input type="hidden" name="folderid" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('folderid');?>
" /><input type="hidden" name="description" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('description');?>
" /><input type="hidden" name="primary_module" value="<?php echo $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value;?>
" /><input type="hidden" name="secondary_modules" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SECONDARY_MODULES']->value);?>
 /><input type="hidden" name="selected_fields" id="seleted_fields" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value);?>
' /><input type="hidden" name="selected_sort_fields" id="selected_sort_fields" value="" /><input type="hidden" name="calculation_fields" id="calculation_fields" value="" /><input type="hidden" name="isDuplicate" value="<?php echo $_smarty_tpl->tpl_vars['IS_DUPLICATE']->value;?>
" /><input type="hidden" name="enable_schedule" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('enable_schedule');?>
"><input type="hidden" name="schtime" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schtime');?>
"><input type="hidden" name="schdate" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schdate');?>
"><input type="hidden" name="schdayoftheweek" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schdayoftheweek'));?>
><input type="hidden" name="schdayofthemonth" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schdayofthemonth'));?>
><input type="hidden" name="schannualdates" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schannualdates'));?>
><input type="hidden" name="recipients" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('recipients'));?>
><input type="hidden" name="specificemails" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('specificemails'));?>
><input type="hidden" name="schtypeid" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('schtypeid');?>
"><input type="hidden" name="fileformat" value="<?php echo $_smarty_tpl->tpl_vars['REPORT_MODEL']->value->get('fileformat');?>
"><input type="hidden" class="step" value="2" /><div class="" style="border:1px solid #ccc;padding:4%;"><div class="form-group"><label><?php echo vtranslate('LBL_SELECT_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
(<?php echo vtranslate('LBL_MAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 25)</label><select data-placeholder="<?php echo vtranslate('LBL_ADD_MORE_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" id="reportsColumnsList" style="width :100%;" class="select2-container select2 col-lg-11 columns"  data-rule-required="true" multiple=""><?php  $_smarty_tpl->tpl_vars['PRIMARY_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PRIMARY_MODULE_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->key => $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value){
$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value = $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->key;
?><?php  $_smarty_tpl->tpl_vars['BLOCK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK']->key => $_smarty_tpl->tpl_vars['BLOCK']->value){
$_smarty_tpl->tpl_vars['BLOCK']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK']->key;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
-<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
'><?php  $_smarty_tpl->tpl_vars['FIELD_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_LABEL']->key => $_smarty_tpl->tpl_vars['FIELD_LABEL']->value){
$_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_KEY']->value = $_smarty_tpl->tpl_vars['FIELD_LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value)&&in_array($_smarty_tpl->tpl_vars['FIELD_KEY']->value,array_map('decode_html',$_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value))){?>selected=""<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
</option><?php } ?></optgroup><?php } ?><?php } ?><?php  $_smarty_tpl->tpl_vars['SECONDARY_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SECONDARY_MODULE_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->key => $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->value){
$_smarty_tpl->tpl_vars['SECONDARY_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value = $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->key;
?><?php  $_smarty_tpl->tpl_vars['BLOCK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK']->key => $_smarty_tpl->tpl_vars['BLOCK']->value){
$_smarty_tpl->tpl_vars['BLOCK']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK']->key;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
-<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
'><?php  $_smarty_tpl->tpl_vars['FIELD_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_LABEL']->key => $_smarty_tpl->tpl_vars['FIELD_LABEL']->value){
$_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_KEY']->value = $_smarty_tpl->tpl_vars['FIELD_LABEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
"<?php if (!empty($_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value)&&in_array($_smarty_tpl->tpl_vars['FIELD_KEY']->value,array_map('decode_html',$_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value))){?>selected=""<?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
</option><?php } ?></optgroup><?php } ?><?php } ?></select></div><div class="form-group"><div class="row"><label class="col-lg-6"><?php echo vtranslate('LBL_GROUP_BY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><label class="col-lg-6"><?php echo vtranslate('LBL_SORT_ORDER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><div class=""><?php $_smarty_tpl->tpl_vars['ROW_VAL'] = new Smarty_variable(1, null, 0);?><?php  $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_VALUE']->key => $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_VALUE']->value){
$_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_KEY']->value = $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELD_VALUE']->key;
?><div class="row sortFieldRow" style="padding-bottom:10px;"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('RelatedFields.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('ROW_VAL'=>$_smarty_tpl->tpl_vars['ROW_VAL']->value), 0);?>
<?php $_smarty_tpl->tpl_vars['ROW_VAL'] = new Smarty_variable(($_smarty_tpl->tpl_vars['ROW_VAL']->value+1), null, 0);?></div><?php } ?><?php $_smarty_tpl->tpl_vars['SELECTED_SORT_FEILDS_ARRAY'] = new Smarty_variable($_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS_COUNT'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['SELECTED_SORT_FEILDS_ARRAY']->value), null, 0);?><?php while ($_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS_COUNT']->value<3){?><div class="row sortFieldRow" style="padding-bottom:10px;"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('RelatedFields.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('ROW_VAL'=>$_smarty_tpl->tpl_vars['ROW_VAL']->value), 0);?>
<?php $_smarty_tpl->tpl_vars['ROW_VAL'] = new Smarty_variable(($_smarty_tpl->tpl_vars['ROW_VAL']->value+1), null, 0);?><?php $_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS_COUNT'] = new Smarty_variable(($_smarty_tpl->tpl_vars['SELECTED_SORT_FIELDS_COUNT']->value+1), null, 0);?></div><?php }?></div></div><div class="row block padding1per"><div class="padding1per"><strong><?php echo vtranslate('LBL_CALCULATIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></div><div class="padding1per"><table class="table table-bordered CalculationFields" width="100%"><thead><tr class="calculationHeaders blockHeader"><th><?php echo vtranslate('LBL_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_SUM_VALUE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_AVERAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_LOWEST_VALUE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_HIGHEST_VALUE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><?php $_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUES'] = new Smarty_variable(explode(',','SUM:2,AVG:3,MIN:4,MAX:5'), null, 0);?><?php  $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CALCULATION_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->key => $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->value){
$_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL']->value = $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->key;
?><?php  $_smarty_tpl->tpl_vars['CALCULATION_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->_loop = false;
 $_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->key => $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->value){
$_smarty_tpl->tpl_vars['CALCULATION_FIELD']->_loop = true;
 $_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEY']->value = $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->key;
?><?php $_smarty_tpl->tpl_vars['FIELD_EXPLODE'] = new Smarty_variable(explode(':',$_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEY']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['tableName'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value['0'], null, 0);?><?php $_smarty_tpl->tpl_vars['columnName'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value['1'], null, 0);?><?php $_smarty_tpl->tpl_vars['FIELDNAME_EXPLODE'] = new Smarty_variable(explode('_',$_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value['2']), null, 0);?><?php $_smarty_tpl->tpl_vars['fieldNameArray'] = new Smarty_variable(array_slice($_smarty_tpl->tpl_vars['FIELDNAME_EXPLODE']->value,1), null, 0);?><?php $_smarty_tpl->tpl_vars['fieldName'] = new Smarty_variable(implode('_',$_smarty_tpl->tpl_vars['fieldNameArray']->value), null, 0);?><tr class="calculationFieldRow"><td><?php echo vtranslate($_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
-<?php echo vtranslate($_smarty_tpl->tpl_vars['CALCULATION_FIELD']->value,$_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL']->value);?>
</td><?php  $_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUE']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUE']->key => $_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUE']->value){
$_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUE']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['FIELD_CALCULATION_VALUE'] = new Smarty_variable((("cb:".($_smarty_tpl->tpl_vars['tableName']->value).":".($_smarty_tpl->tpl_vars['columnName']->value).":".($_smarty_tpl->tpl_vars['fieldName']->value)).('_')).($_smarty_tpl->tpl_vars['FIELD_OPERATION_VALUE']->value), null, 0);?><td width="15%"><input class="calculationType" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_CALCULATION_VALUE']->value;?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SELECTED_CALCULATION_FIELDS']->value)&&in_array($_smarty_tpl->tpl_vars['FIELD_CALCULATION_VALUE']->value,$_smarty_tpl->tpl_vars['SELECTED_CALCULATION_FIELDS']->value)){?> checked=""<?php }?> /></td><?php } ?></tr><?php } ?><?php } ?></table></div></div></div><div class="modal-overlay-footer border1px clearfix"><div class="row clearfix"><div class="textAlignCenter col-lg-12 col-md-12 col-sm-12 "><button type="button" class="btn btn-danger backStep"><strong><?php echo vtranslate('LBL_BACK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<button type="submit" class="btn btn-success nextStep"><strong><?php echo vtranslate('LBL_NEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<a class="cancelLink" onclick="window.history.back()"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div><br><br></form><?php }} ?>