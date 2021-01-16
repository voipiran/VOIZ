<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 10:41:18
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/LayoutEditor/DefaultValueUi.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3546083865c46c216efdfa6-49802036%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cbcff28572e2ead5197cd3199ea82655ec4bf435' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/LayoutEditor/DefaultValueUi.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3546083865c46c216efdfa6-49802036',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'QUALIFIED_MODULE' => 0,
    'NAME_ATTR' => 0,
    'DEFAULT_VALUE' => 0,
    'IS_SET' => 0,
    'PICKLIST_VALUES' => 0,
    'FIELD_INFO' => 0,
    'PICKLIST_NAME' => 0,
    'PICKLIST_VALUE' => 0,
    'SELECTED_MODULE_NAME' => 0,
    'FIELD_VALUE_LIST' => 0,
    'USER_MODEL' => 0,
    'INVENTORY_TERMS_AND_CONDITIONS_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46c2170e65c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46c2170e65c')) {function content_5c46c2170e65c($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()!="true"){?><div class="form-group"><label class="control-label fieldLabel col-sm-5"><img src="<?php echo vimage_path('DefaultValue.png');?>
" height=14 width=14/> &nbsp; <?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls col-sm-7"><div class="defaultValueUi"><?php if (!$_smarty_tpl->tpl_vars['NAME_ATTR']->value){?><?php $_smarty_tpl->tpl_vars['NAME_ATTR'] = new Smarty_variable("fieldDefaultValue", null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value==false&&!$_smarty_tpl->tpl_vars['IS_SET']->value){?><?php $_smarty_tpl->tpl_vars['DEFAULT_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('defaultvalue'), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=="picklist"){?><?php if (!is_array($_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value)){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'], null, 0);?><?php }?><?php if (!$_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value){?><?php $_smarty_tpl->tpl_vars['DEFAULT_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('defaultvalue'), null, 0);?><?php }?><?php ob_start();?><?php echo decode_html($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['DEFAULT_VALUE'] = new Smarty_variable($_tmp1, null, 0);?><select class="col-sm-9 select2" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
"><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['PICKLIST_NAME']->value = $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key;
?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_NAME']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value==$_smarty_tpl->tpl_vars['PICKLIST_NAME']->value){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</option><?php } ?></select><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=="multipicklist"){?><?php if (!is_array($_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value)){?><?php $_smarty_tpl->tpl_vars['PICKLIST_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_INFO']->value['picklistvalues'], null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars["FIELD_VALUE_LIST"] = new Smarty_variable(explode(' |##| ',$_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value), null, 0);?><select multiple class="col-sm-9 select2" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
[]" ><?php  $_smarty_tpl->tpl_vars['PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['PICKLIST_VALUE']->_loop = true;
?><option value="<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value);?>
" <?php if (in_array(Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value),$_smarty_tpl->tpl_vars['FIELD_VALUE_LIST']->value)){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['PICKLIST_VALUE']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</option><?php } ?></select><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=="boolean"){?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
" value="" /><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value=='on'||$_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value==1){?> checked <?php }?> /><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=="time"){?><div class="input-group time"><input type="text" class="timepicker-default inputElement" data-format="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('hour_format');?>
" data-toregister="time" value="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
"  style='width: 75%'/><span class="input-group-addon cursorPointer"><i class="fa fa-times"></i></span></div><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=="date"){?><div class="input-group date"><?php $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'), null, 0);?><input type="text" class="inputElement dateField" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
" data-toregister="date" data-date-format="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('date_format');?>
"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
" style='width: 75%'/><span class="input-group-addon"><i class="fa fa-calendar"></i></span></div><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=="percentage"){?><div class="input-group" style='width: 75%'><input type="number" class="form-control" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
"value="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
"  step="any"/><span class="input-group-addon">%</span></div><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=="currency"){?><div class="input-group"><span class="input-group-addon"><?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_symbol');?>
</span><input type="text" class="inputElement" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
"value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getEditViewDisplayValue($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value,true);?>
"data-decimal-separator='<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_decimal_separator');?>
' data-group-separator='<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_grouping_separator');?>
' style='width: 75%'/></div><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName()=="terms_conditions"&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')==19){?><?php $_smarty_tpl->tpl_vars['INVENTORY_TERMS_AND_CONDITIONS_MODEL'] = new Smarty_variable(Settings_Vtiger_MenuItem_Model::getInstance("INVENTORYTERMSANDCONDITIONS"), null, 0);?><a href="<?php echo $_smarty_tpl->tpl_vars['INVENTORY_TERMS_AND_CONDITIONS_MODEL']->value->getUrl();?>
" target="_blank"><?php echo vtranslate('LBL_CLICK_HERE_TO_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=="text"){?><textarea class="input-lg col-sm-4" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
"  style="resize: vertical"><?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
</textarea><?php }else{ ?><input type="text" class="inputElement col-sm-3" name="<?php echo $_smarty_tpl->tpl_vars['NAME_ATTR']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" style='width: 75%'/><?php }?></div></div></div><?php }?><?php }} ?>