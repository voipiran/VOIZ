<?php /* Smarty version Smarty-3.1.7, created on 2018-04-16 11:43:33
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/uitypes/StringDetailView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10024432625ad44d1d010612-21448615%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c205f8a96aca626dfb8f41c46d43282bc949e7d3' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/uitypes/StringDetailView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10024432625ad44d1d010612-21448615',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'FIELD_MODEL' => 0,
    'MODULE' => 0,
    'PICKLIST_COLOR' => 0,
    'RECORD' => 0,
    'PICKLIST_DISPLAY_VALUE' => 0,
    'MULTI_RAW_PICKLIST_VALUES' => 0,
    'MULTI_PICKLIST_VALUE' => 0,
    'MULTI_PICKLIST_INDEX' => 0,
    'MULTI_PICKLIST_VALUES' => 0,
    'CURRENT_USER_MODEL' => 0,
    'BASE_CURRENCY_SYMBOL' => 0,
    'CURRENCY_INFO' => 0,
    'SYMBOL_PLACEMENT' => 0,
    'CURRENCY_SYMBOL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ad44d1d0c7f8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad44d1d0c7f8')) {function content_5ad44d1d0c7f8($_smarty_tpl) {?>


<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='picklist'&&$_smarty_tpl->tpl_vars['MODULE']->value!='Users'){?>
    <?php $_smarty_tpl->tpl_vars['PICKLIST_COLOR'] = new Smarty_variable(Settings_Picklist_Module_Model::getPicklistColorByValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?>  
    <span <?php if (!empty($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value)){?> class="picklist-color" style="background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
; line-height:15px; color: <?php echo Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value);?>
;" <?php }?>>
        <?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value);?>

    </span>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='multipicklist'&&$_smarty_tpl->tpl_vars['MODULE']->value!='Users'){?>
    <?php $_smarty_tpl->tpl_vars['PICKLIST_DISPLAY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['MULTI_RAW_PICKLIST_VALUES'] = new Smarty_variable(explode('|##|',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue')), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['PICKLIST_DISPLAY_VALUE']->value), null, 0);?>
    <?php  $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MULTI_RAW_PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value = $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->key;
?>
        <?php $_smarty_tpl->tpl_vars['PICKLIST_COLOR'] = new Smarty_variable(Settings_Picklist_Module_Model::getPicklistColorByValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName(),trim($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->value)), null, 0);?>
        <span class="picklist-color" <?php if (!empty($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value)){?> style="background-color: <?php echo $_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value;?>
; color: <?php echo Settings_Picklist_Module_Model::getTextColor($_smarty_tpl->tpl_vars['PICKLIST_COLOR']->value);?>
;" <?php }?>> <?php echo trim($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES']->value[$_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value]);?>
 </span>
        <?php if ($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES']->value[$_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value+1]!=''){?>,<?php }?>
    <?php } ?> 
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='currency'){?>
    <?php $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL'] = new Smarty_variable(Users_Record_Model::getCurrentUserModel(), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['SYMBOL_PLACEMENT'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_symbol_placement'), null, 0);?>
    <?php if (($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='72')&&($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName()=='unit_price')){?>
        <?php $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL'] = new Smarty_variable($_smarty_tpl->tpl_vars['BASE_CURRENCY_SYMBOL']->value, null, 0);?>
    <?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='71'){?>
        <?php $_smarty_tpl->tpl_vars['CURRENCY_INFO'] = new Smarty_variable(getCurrencySymbolandCRate($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_id')), null, 0);?>
        <?php $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENCY_INFO']->value['symbol'], null, 0);?>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['SYMBOL_PLACEMENT']->value=='$1.0'){?>
        <?php echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;?>
&nbsp;<span class="currencyValue"><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
</span>
    <?php }else{ ?>
        <span class="currencyValue"><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'));?>
</span>&nbsp;<?php echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;?>

    <?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')=='signature'){?>
	<?php echo decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value));?>

<?php }else{ ?>
    <?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'),$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value);?>

<?php }?>
<?php }} ?>