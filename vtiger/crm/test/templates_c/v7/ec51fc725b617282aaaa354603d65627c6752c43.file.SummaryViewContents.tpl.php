<?php /* Smarty version Smarty-3.1.7, created on 2020-11-26 13:28:10
         compiled from "/var/www/html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/SummaryViewContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13585203965fbf7c321c8399-75444948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec51fc725b617282aaaa354603d65627c6752c43' => 
    array (
      0 => '/var/www/html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/SummaryViewContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13585203965fbf7c321c8399-75444948',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PICKIST_DEPENDENCY_DATASOURCE' => 0,
    'SUMMARY_RECORD_STRUCTURE' => 0,
    'FIELD_MODEL' => 0,
    'MODULE_NAME' => 0,
    'USER_MODEL' => 0,
    'CURRENCY_INFO' => 0,
    'DISPLAY_VALUE' => 0,
    'RECORD' => 0,
    'IS_AJAX_ENABLED' => 0,
    'fieldDataType' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5fbf7c3227cee',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fbf7c3227cee')) {function content_5fbf7c3227cee($_smarty_tpl) {?>
<?php if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value)){?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value);?>
' /><?php }?><table class="summary-table no-border"><tbody><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SUMMARY_RECORD_STRUCTURE']->value['SUMMARY_FIELDS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['fieldDataType'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')!='modifiedtime'&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')!='createdtime'){?><tr class="summaryViewEntries"><td class="fieldLabel" ><label class="muted textOverflowEllipsis" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='71'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='72'){?><?php $_smarty_tpl->tpl_vars['CURRENCY_INFO'] = new Smarty_variable(getCurrencySymbolandCRate($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_id')), null, 0);?>&nbsp;(<?php echo $_smarty_tpl->tpl_vars['CURRENCY_INFO']->value['symbol'];?>
)<?php }?></label></td><td class="fieldValue"><div class="row"><?php $_smarty_tpl->tpl_vars['DISPLAY_VALUE'] = new Smarty_variable(($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get("fieldvalue"))), null, 0);?><span class="value textOverflowEllipsis" title="<?php echo strip_tags($_smarty_tpl->tpl_vars['DISPLAY_VALUE']->value);?>
"  <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='19'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='20'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='21'){?>style="word-wrap: break-word;"<?php }?>><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getDetailViewTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value,'RECORD'=>$_smarty_tpl->tpl_vars['RECORD']->value), 0);?>
</span><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEditable()=='true'&&$_smarty_tpl->tpl_vars['IS_AJAX_ENABLED']->value&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isAjaxEditable()=='true'&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')!=69){?><span class="hide edit"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='multipicklist'){?><input type="hidden" class="fieldBasicData" data-name='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
[]' data-type="<?php echo $_smarty_tpl->tpl_vars['fieldDataType']->value;?>
" data-displayvalue='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));?>
' data-value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" /><?php }else{ ?><input type="hidden" class="fieldBasicData" data-name='<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
' data-type="<?php echo $_smarty_tpl->tpl_vars['fieldDataType']->value;?>
" data-displayvalue='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')));?>
' data-value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue');?>
" /><?php }?></span><span class="action"><a href="#" onclick="return false;" class="editAction fa fa-pencil"></a></span><?php }?></div></td></tr><?php }?><?php } ?></tbody></table><?php }} ?>