<?php /* Smarty version Smarty-3.1.7, created on 2018-11-26 13:58:55
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/ReportContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6475812395bfbcae7a5c8f6-72962337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c71cee722774764970f636e311d281177a2ad66' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/ReportContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6475812395bfbcae7a5c8f6-72962337',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CALCULATION_FIELDS' => 0,
    'MODULE' => 0,
    'CALCULATION_FIELD' => 0,
    'CALCULATION_FIELD_KEYS' => 0,
    'ESCAPE_CHAR' => 0,
    'FIELD_IMPLODE' => 0,
    'MODULE_NAME' => 0,
    'FIELD_LABEL' => 0,
    'CALCULATION_VALUE' => 0,
    'REPORT_MODEL' => 0,
    'BASE_CURRENCY_INFO' => 0,
    'NEW_COUNT' => 0,
    'DATA' => 0,
    'HEADERS' => 0,
    'NAME' => 0,
    'REPORT_RUN_INSTANCE' => 0,
    'RECORD_ID' => 0,
    'REPORTRUN' => 0,
    'GROUPBYFIELDS' => 0,
    'GROUPBYFIELDSCOUNT' => 0,
    'i' => 0,
    'FIELD' => 0,
    'FIELD_EXPLODE' => 0,
    'FIELDNAMES' => 0,
    'j' => 0,
    'VALUES' => 0,
    'FIRST_FIELD' => 0,
    'FIRST_VALUE' => 0,
    'VALUE' => 0,
    'SECOND_FIELD' => 0,
    'SECOND_VALUE' => 0,
    'THIRD_FIELD' => 0,
    'THIRD_VALUE' => 0,
    'LIMIT_EXCEEDED' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfbcae7c4171',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfbcae7c4171')) {function content_5bfbcae7c4171($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/var/www/webroot/ROOT/libraries/Smarty/libs/plugins/modifier.replace.php';
?>
<div class="contents-topscroll"><div class="topscroll-div"><?php if (!empty($_smarty_tpl->tpl_vars['CALCULATION_FIELDS']->value)){?><table class=" table-bordered table-condensed marginBottom10px" width="100%"><thead><tr class="blockHeader"><th><?php echo vtranslate('LBL_FIELD_NAMES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_SUM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_AVG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_MIN',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th><?php echo vtranslate('LBL_MAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><?php $_smarty_tpl->tpl_vars['ESCAPE_CHAR'] = new Smarty_variable(array('_SUM','_AVG','_MIN','_MAX'), null, 0);?><?php  $_smarty_tpl->tpl_vars['CALCULATION_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CALCULATION_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->key => $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->value){
$_smarty_tpl->tpl_vars['CALCULATION_FIELD']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->key;
?><tr><?php $_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEYS'] = new Smarty_variable(array_keys($_smarty_tpl->tpl_vars['CALCULATION_FIELD']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEYS'] = new Smarty_variable(smarty_modifier_replace($_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEYS']->value,$_smarty_tpl->tpl_vars['ESCAPE_CHAR']->value,''), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_IMPLODE'] = new Smarty_variable(explode('_',$_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEYS']->value['0']), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_IMPLODE']->value['0'], null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_LABEL'] = new Smarty_variable(implode(" ",$_smarty_tpl->tpl_vars['FIELD_IMPLODE']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_LABEL'] = new Smarty_variable(str_replace($_smarty_tpl->tpl_vars['MODULE_NAME']->value,'',$_smarty_tpl->tpl_vars['FIELD_LABEL']->value), null, 0);?><td><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate(trim($_smarty_tpl->tpl_vars['FIELD_LABEL']->value),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</td><?php  $_smarty_tpl->tpl_vars['CALCULATION_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CALCULATION_VALUE']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['CALCULATION_FIELD']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CALCULATION_VALUE']->key => $_smarty_tpl->tpl_vars['CALCULATION_VALUE']->value){
$_smarty_tpl->tpl_vars['CALCULATION_VALUE']->_loop = true;
?><td width="15%"><?php echo $_smarty_tpl->tpl_vars['CALCULATION_VALUE']->value;?>
</td><?php } ?></tr><?php } ?></table><?php if ($_smarty_tpl->tpl_vars['REPORT_MODEL']->value->isInventoryModuleSelected()){?><div class="alert alert-info"><?php $_smarty_tpl->tpl_vars['BASE_CURRENCY_INFO'] = new Smarty_variable(Vtiger_Util_Helper::getUserCurrencyInfo(), null, 0);?><i class="fa fa-info-circle"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_CALCULATION_CONVERSION_MESSAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['BASE_CURRENCY_INFO']->value['currency_name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['BASE_CURRENCY_INFO']->value['currency_code'];?>
)</div><?php }?><?php }?></div></div><div id="reportDetails" class="contents-bottomscroll"><div class="bottomscroll-div"><input type="hidden" id="updatedCount" value="<?php echo $_smarty_tpl->tpl_vars['NEW_COUNT']->value;?>
" /><?php if ($_smarty_tpl->tpl_vars['DATA']->value!=''){?><?php $_smarty_tpl->tpl_vars['HEADERS'] = new Smarty_variable($_smarty_tpl->tpl_vars['DATA']->value[0], null, 0);?><table class="table table-bordered"><thead><tr class="blockHeader"><?php  $_smarty_tpl->tpl_vars['HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['HEADER']->_loop = false;
 $_smarty_tpl->tpl_vars['NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['HEADER']->key => $_smarty_tpl->tpl_vars['HEADER']->value){
$_smarty_tpl->tpl_vars['HEADER']->_loop = true;
 $_smarty_tpl->tpl_vars['NAME']->value = $_smarty_tpl->tpl_vars['HEADER']->key;
?><th nowrap><?php echo $_smarty_tpl->tpl_vars['NAME']->value;?>
</th><?php } ?></tr></thead><?php $_smarty_tpl->tpl_vars['REPORTRUN'] = new Smarty_variable($_smarty_tpl->tpl_vars['REPORT_RUN_INSTANCE']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['GROUPBYFIELDS'] = new Smarty_variable(array_keys($_smarty_tpl->tpl_vars['REPORTRUN']->value->getGroupingList($_smarty_tpl->tpl_vars['RECORD_ID']->value)), null, 0);?><?php $_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['GROUPBYFIELDS']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value>0){?><?php $_smarty_tpl->tpl_vars['FIELDNAMES'] = new Smarty_variable(array(), null, 0);?><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value-1+1 - (0) : 0-($_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value-1)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?><?php $_smarty_tpl->tpl_vars['FIELD'] = new Smarty_variable(explode(':',$_smarty_tpl->tpl_vars['GROUPBYFIELDS']->value[$_smarty_tpl->tpl_vars['i']->value]), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_EXPLODE'] = new Smarty_variable(explode('_',$_smarty_tpl->tpl_vars['FIELD']->value[2]), null, 0);?><?php $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['j']->step = 1;$_smarty_tpl->tpl_vars['j']->total = (int)ceil(($_smarty_tpl->tpl_vars['j']->step > 0 ? count($_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value)-1+1 - (1) : 1-(count($_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value)-1)+1)/abs($_smarty_tpl->tpl_vars['j']->step));
if ($_smarty_tpl->tpl_vars['j']->total > 0){
for ($_smarty_tpl->tpl_vars['j']->value = 1, $_smarty_tpl->tpl_vars['j']->iteration = 1;$_smarty_tpl->tpl_vars['j']->iteration <= $_smarty_tpl->tpl_vars['j']->total;$_smarty_tpl->tpl_vars['j']->value += $_smarty_tpl->tpl_vars['j']->step, $_smarty_tpl->tpl_vars['j']->iteration++){
$_smarty_tpl->tpl_vars['j']->first = $_smarty_tpl->tpl_vars['j']->iteration == 1;$_smarty_tpl->tpl_vars['j']->last = $_smarty_tpl->tpl_vars['j']->iteration == $_smarty_tpl->tpl_vars['j']->total;?><?php $_smarty_tpl->createLocalArrayVariable('FIELDNAMES', null, 0);
$_smarty_tpl->tpl_vars['FIELDNAMES']->value[$_smarty_tpl->tpl_vars['i']->value] = (($_smarty_tpl->tpl_vars['FIELDNAMES']->value[$_smarty_tpl->tpl_vars['i']->value]).($_smarty_tpl->tpl_vars['FIELD_EXPLODE']->value[$_smarty_tpl->tpl_vars['j']->value])).(" ");?><?php }} ?><?php }} ?><?php if ($_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value==1){?><?php $_smarty_tpl->tpl_vars['FIRST_FIELD'] = new Smarty_variable(vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[0]),$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value==2){?><?php $_smarty_tpl->tpl_vars['FIRST_FIELD'] = new Smarty_variable(vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[0]),$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['SECOND_FIELD'] = new Smarty_variable(vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[1]),$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['GROUPBYFIELDSCOUNT']->value==3){?><?php $_smarty_tpl->tpl_vars['FIRST_FIELD'] = new Smarty_variable(vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[0]),$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['SECOND_FIELD'] = new Smarty_variable(vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[1]),$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['THIRD_FIELD'] = new Smarty_variable(vtranslate(trim($_smarty_tpl->tpl_vars['FIELDNAMES']->value[2]),$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars['FIRST_VALUE'] = new Smarty_variable(" ", null, 0);?><?php $_smarty_tpl->tpl_vars['SECOND_VALUE'] = new Smarty_variable(" ", null, 0);?><?php $_smarty_tpl->tpl_vars['THIRD_VALUE'] = new Smarty_variable(" ", null, 0);?><?php  $_smarty_tpl->tpl_vars['VALUES'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUES']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DATA']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUES']->key => $_smarty_tpl->tpl_vars['VALUES']->value){
$_smarty_tpl->tpl_vars['VALUES']->_loop = true;
?><tr><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['NAME']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['FIRST_FIELD']->value;?>
<?php $_tmp1=ob_get_clean();?><?php if (($_smarty_tpl->tpl_vars['NAME']->value==$_smarty_tpl->tpl_vars['FIRST_FIELD']->value||strstr($_smarty_tpl->tpl_vars['NAME']->value,$_tmp1))&&($_smarty_tpl->tpl_vars['FIRST_VALUE']->value==$_smarty_tpl->tpl_vars['VALUE']->value||$_smarty_tpl->tpl_vars['FIRST_VALUE']->value==" ")){?><?php if ($_smarty_tpl->tpl_vars['FIRST_VALUE']->value==" "||$_smarty_tpl->tpl_vars['VALUE']->value=="-"){?><td class="summary"><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><?php }else{ ?><td class="summary"><?php echo " ";?>
</td><?php }?><?php if ($_smarty_tpl->tpl_vars['VALUE']->value!=" "){?><?php $_smarty_tpl->tpl_vars['FIRST_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['VALUE']->value, null, 0);?><?php }?><?php }elseif(($_smarty_tpl->tpl_vars['NAME']->value==$_smarty_tpl->tpl_vars['SECOND_FIELD']->value||strstr($_smarty_tpl->tpl_vars['NAME']->value,$_smarty_tpl->tpl_vars['SECOND_FIELD']->value))&&($_smarty_tpl->tpl_vars['SECOND_VALUE']->value==$_smarty_tpl->tpl_vars['VALUE']->value||$_smarty_tpl->tpl_vars['SECOND_VALUE']->value==" ")){?><?php if ($_smarty_tpl->tpl_vars['SECOND_VALUE']->value==" "||$_smarty_tpl->tpl_vars['VALUE']->value=="-"){?><td class="summary"><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><?php }else{ ?><td class="summary"><?php echo " ";?>
</td><?php }?><?php if ($_smarty_tpl->tpl_vars['VALUE']->value!=" "){?><?php $_smarty_tpl->tpl_vars['SECOND_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['VALUE']->value, null, 0);?><?php }?><?php }elseif(($_smarty_tpl->tpl_vars['NAME']->value==$_smarty_tpl->tpl_vars['THIRD_FIELD']->value||strstr($_smarty_tpl->tpl_vars['NAME']->value,$_smarty_tpl->tpl_vars['THIRD_FIELD']->value))&&($_smarty_tpl->tpl_vars['THIRD_VALUE']->value==$_smarty_tpl->tpl_vars['VALUE']->value||$_smarty_tpl->tpl_vars['THIRD_VALUE']->value==" ")){?><?php if ($_smarty_tpl->tpl_vars['THIRD_VALUE']->value==" "||$_smarty_tpl->tpl_vars['VALUE']->value=="-"){?><td class="summary"><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><?php }else{ ?><td class="summary"><?php echo " ";?>
</td><?php }?><?php if ($_smarty_tpl->tpl_vars['VALUE']->value!=" "){?><?php $_smarty_tpl->tpl_vars['THIRD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['VALUE']->value, null, 0);?><?php }?><?php }else{ ?><td><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><?php if ($_smarty_tpl->tpl_vars['NAME']->value==$_smarty_tpl->tpl_vars['FIRST_FIELD']->value||strstr($_smarty_tpl->tpl_vars['NAME']->value,$_smarty_tpl->tpl_vars['FIRST_FIELD']->value)){?><?php $_smarty_tpl->tpl_vars['FIRST_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['VALUE']->value, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['NAME']->value==$_smarty_tpl->tpl_vars['SECOND_FIELD']->value||strstr($_smarty_tpl->tpl_vars['NAME']->value,$_smarty_tpl->tpl_vars['SECOND_FIELD']->value)){?><?php $_smarty_tpl->tpl_vars['SECOND_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['VALUE']->value, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['NAME']->value==$_smarty_tpl->tpl_vars['THIRD_FIELD']->value||strstr($_smarty_tpl->tpl_vars['NAME']->value,$_smarty_tpl->tpl_vars['THIRD_FIELD']->value)){?><?php $_smarty_tpl->tpl_vars['THIRD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['VALUE']->value, null, 0);?><?php }?><?php }?><?php } ?></tr><?php } ?><?php }else{ ?><?php  $_smarty_tpl->tpl_vars['VALUES'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUES']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DATA']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUES']->key => $_smarty_tpl->tpl_vars['VALUES']->value){
$_smarty_tpl->tpl_vars['VALUES']->_loop = true;
?><tr><?php  $_smarty_tpl->tpl_vars['VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['VALUE']->key => $_smarty_tpl->tpl_vars['VALUE']->value){
$_smarty_tpl->tpl_vars['VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['NAME']->value = $_smarty_tpl->tpl_vars['VALUE']->key;
?><td><?php echo $_smarty_tpl->tpl_vars['VALUE']->value;?>
</td><?php } ?></tr><?php } ?><?php }?></table><?php if ($_smarty_tpl->tpl_vars['LIMIT_EXCEEDED']->value){?><center><?php echo vtranslate('LBL_LIMIT_EXCEEDED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="pull-right"><a href="#top" ><?php echo vtranslate('LBL_TOP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></span></center><?php }?><?php }else{ ?><div style="text-align: center; border: 1px solid #DDD; padding: 20px; font-size: 15px;"><?php echo vtranslate('LBL_NO_DATA_AVAILABLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><?php }?></div></div><br>

<?php }} ?>