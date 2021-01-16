<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 10:53:43
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Import/Import_Mapping.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4580512235c46c4ff91d641-60450300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5154319de0033948fae27c8b2fe8ffdd889e3e59' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Import/Import_Mapping.tpl',
      1 => 1522233374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4580512235c46c4ff91d641-60450300',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'USER_INPUT' => 0,
    'MERGE_FIELDS' => 0,
    'LINEITEM_CURRENCY' => 0,
    'ENCODED_MANDATORY_FIELDS' => 0,
    'HAS_HEADER' => 0,
    'MODULE' => 0,
    'ROW_1_DATA' => 0,
    '_COUNTER' => 0,
    '_HEADER_NAME' => 0,
    '_FIELD_VALUE' => 0,
    'FOR_MODULE' => 0,
    'AVAILABLE_FIELDS' => 0,
    '_FIELD_INFO' => 0,
    '_FIELD_NAME' => 0,
    '_TRANSLATED_FIELD_LABEL' => 0,
    'EVENTS_TRANSLATED_FIELD_LABEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46c4ff9b2f6',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46c4ff9b2f6')) {function content_5c46c4ff9b2f6($_smarty_tpl) {?>

<input type="hidden" name="merge_type" value='<?php echo $_smarty_tpl->tpl_vars['USER_INPUT']->value->get('merge_type');?>
' /><input type="hidden" name="merge_fields" value='<?php echo $_smarty_tpl->tpl_vars['MERGE_FIELDS']->value;?>
' /><input type="hidden" name="lineitem_currency" value='<?php echo $_smarty_tpl->tpl_vars['LINEITEM_CURRENCY']->value;?>
'><input type="hidden" id="mandatory_fields" name="mandatory_fields" value='<?php echo $_smarty_tpl->tpl_vars['ENCODED_MANDATORY_FIELDS']->value;?>
' /><input type="hidden" name="field_mapping" id="field_mapping" value="" /><input type="hidden" name="default_values" id="default_values" value="" /><table width="100%" class="table table-bordered"><thead><tr><?php if ($_smarty_tpl->tpl_vars['HAS_HEADER']->value==true){?><th width="25%"><?php echo vtranslate('LBL_FILE_COLUMN_HEADER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><?php }?><th width="25%"><?php echo vtranslate('LBL_ROW_1',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th width="23%"><?php echo vtranslate('LBL_CRM_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th><th width="27%"><?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['_FIELD_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_FIELD_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['_HEADER_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ROW_1_DATA']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["headerIterator"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['_FIELD_VALUE']->key => $_smarty_tpl->tpl_vars['_FIELD_VALUE']->value){
$_smarty_tpl->tpl_vars['_FIELD_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['_HEADER_NAME']->value = $_smarty_tpl->tpl_vars['_FIELD_VALUE']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["headerIterator"]['iteration']++;
?><?php $_smarty_tpl->tpl_vars["_COUNTER"] = new Smarty_variable($_smarty_tpl->getVariable('smarty')->value['foreach']['headerIterator']['iteration'], null, 0);?><tr class="fieldIdentifier" id="fieldIdentifier<?php echo $_smarty_tpl->tpl_vars['_COUNTER']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['HAS_HEADER']->value==true){?><td><span style="word-break:break-all" name="header_name"><?php echo $_smarty_tpl->tpl_vars['_HEADER_NAME']->value;?>
</span></td><?php }?><td><span><?php echo textlength_check($_smarty_tpl->tpl_vars['_FIELD_VALUE']->value);?>
</span></td><td><input type="hidden" name="row_counter" value="<?php echo $_smarty_tpl->tpl_vars['_COUNTER']->value;?>
" /><select name="mapped_fields" class="select2" id ="mappedFieldsSelect" style="width:100%" onchange="Vtiger_Import_Js.loadDefaultValueWidget('fieldIdentifier<?php echo $_smarty_tpl->tpl_vars['_COUNTER']->value;?>
')"><option value=""><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['FOR_MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['_FIELD_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_FIELD_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['_FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['AVAILABLE_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_FIELD_INFO']->key => $_smarty_tpl->tpl_vars['_FIELD_INFO']->value){
$_smarty_tpl->tpl_vars['_FIELD_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['_FIELD_NAME']->value = $_smarty_tpl->tpl_vars['_FIELD_INFO']->key;
?><?php $_smarty_tpl->tpl_vars["_TRANSLATED_FIELD_LABEL"] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['_FIELD_INFO']->value->getFieldLabelKey(),$_smarty_tpl->tpl_vars['FOR_MODULE']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["EVENTS_TRANSLATED_FIELD_LABEL"] = new Smarty_variable(vtranslate($_smarty_tpl->tpl_vars['_FIELD_INFO']->value->getFieldLabelKey(),'Events'), null, 0);?><option value="<?php echo $_smarty_tpl->tpl_vars['_FIELD_NAME']->value;?>
" <?php if (strtolower(decode_html($_smarty_tpl->tpl_vars['_HEADER_NAME']->value))==strtolower($_smarty_tpl->tpl_vars['_TRANSLATED_FIELD_LABEL']->value)){?> selected <?php }?><?php if ($_smarty_tpl->tpl_vars['_FIELD_NAME']->value=='due_date'&&strtolower(decode_html($_smarty_tpl->tpl_vars['_HEADER_NAME']->value))==strtolower($_smarty_tpl->tpl_vars['EVENTS_TRANSLATED_FIELD_LABEL']->value)){?> selected <?php }?>data-label="<?php echo $_smarty_tpl->tpl_vars['_TRANSLATED_FIELD_LABEL']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['_TRANSLATED_FIELD_LABEL']->value;?>
<?php if ($_smarty_tpl->tpl_vars['_FIELD_INFO']->value->isMandatory()=='true'||$_smarty_tpl->tpl_vars['_FIELD_NAME']->value=='activitytype'){?>&nbsp; (*)<?php }?></option><?php } ?></select></td><td name="default_value_container">&nbsp;</td></tr><?php } ?></tbody></table><?php }} ?>