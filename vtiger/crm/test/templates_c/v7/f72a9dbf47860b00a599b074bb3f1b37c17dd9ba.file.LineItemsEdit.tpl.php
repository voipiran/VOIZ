<?php /* Smarty version Smarty-3.1.7, created on 2018-11-28 09:12:27
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Inventory/partials/LineItemsEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18694083595bfe2ac364c7f3-00798404%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f72a9dbf47860b00a599b074bb3f1b37c17dd9ba' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Inventory/partials/LineItemsEdit.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18694083595bfe2ac364c7f3-00798404',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RECORD_STRUCTURE' => 0,
    'LINEITEM_FIELDS' => 0,
    'IMAGE_EDITABLE' => 0,
    'COL_SPAN1' => 0,
    'PRODUCT_EDITABLE' => 0,
    'QUANTITY_EDITABLE' => 0,
    'PURCHASE_COST_EDITABLE' => 0,
    'COL_SPAN2' => 0,
    'LIST_PRICE_EDITABLE' => 0,
    'MARGIN_EDITABLE' => 0,
    'COL_SPAN3' => 0,
    'RELATED_PRODUCTS' => 0,
    'TAX_TYPE' => 0,
    'USER_MODEL' => 0,
    'row_no' => 0,
    'LINE_ITEM_BLOCK_LABEL' => 0,
    'BLOCK_FIELDS' => 0,
    'BLOCK_LABEL' => 0,
    'MODULE' => 0,
    'DEFAULT_TAX_REGION_INFO' => 0,
    'TAX_REGIONS' => 0,
    'TAX_REGION_ID' => 0,
    'TAX_REGION_INFO' => 0,
    'RECORD' => 0,
    'CURRENCINFO' => 0,
    'SELECTED_CURRENCY' => 0,
    'CURRENCIES' => 0,
    'currency_details' => 0,
    'USER_CURRENCY_ID' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'RECORD_CURRENCY_RATE' => 0,
    'IS_INDIVIDUAL_TAX_TYPE' => 0,
    'IS_GROUP_TAX_TYPE' => 0,
    'data' => 0,
    'PRODUCT_ACTIVE' => 0,
    'SERVICE_ACTIVE' => 0,
    'FINAL' => 0,
    'DISCOUNT_AMOUNT_EDITABLE' => 0,
    'DISCOUNT_PERCENT_EDITABLE' => 0,
    'DISCOUNT_TYPE_FINAL' => 0,
    'SH_PERCENT_EDITABLE' => 0,
    'INVENTORY_CHARGES' => 0,
    'CHARGE_ID' => 0,
    'CHARGE_AND_CHARGETAX_VALUES' => 0,
    'CHARGE_MODEL' => 0,
    'CHARGE_PERCENT' => 0,
    'RECORD_ID' => 0,
    'CHARGE_VALUE' => 0,
    'PRE_TAX_TOTAL' => 0,
    'TAXES' => 0,
    'tax_detail' => 0,
    'CHARGE_TAX_ID' => 0,
    'CHARGE_TAX_MODEL' => 0,
    'SH_TAX_VALUE' => 0,
    'DEDUCTED_TAXES' => 0,
    'DEDUCTED_TAX_INFO' => 0,
    'IS_DUPLICATE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfe2ac39f2c4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfe2ac39f2c4')) {function content_5bfe2ac39f2c4($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['LINEITEM_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['LBL_ITEM_DETAILS'], null, 0);?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']){?><?php $_smarty_tpl->tpl_vars['IMAGE_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['IMAGE_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']){?><?php $_smarty_tpl->tpl_vars['PRODUCT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['PRODUCT_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']){?><?php $_smarty_tpl->tpl_vars['QUANTITY_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['QUANTITY_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']){?><?php $_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN2']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']){?><?php $_smarty_tpl->tpl_vars['LIST_PRICE_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['LIST_PRICE_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN2']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']){?><?php $_smarty_tpl->tpl_vars['MARGIN_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN3'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN3']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['comment']){?><?php $_smarty_tpl->tpl_vars['COMMENT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['comment']->isEditable(), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_amount']){?><?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_amount']->isEditable(), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_percent']){?><?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_percent']->isEditable(), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnS_H_Percent']){?><?php $_smarty_tpl->tpl_vars['SH_PERCENT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnS_H_Percent']->isEditable(), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountAmount']){?><?php $_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountAmount']->isEditable(), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountPercent']){?><?php $_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountPercent']->isEditable(), null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars["FINAL"] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value[1]['final_details'], null, 0);?><?php $_smarty_tpl->tpl_vars["IS_INDIVIDUAL_TAX_TYPE"] = new Smarty_variable(false, null, 0);?><?php $_smarty_tpl->tpl_vars["IS_GROUP_TAX_TYPE"] = new Smarty_variable(true, null, 0);?><?php if ($_smarty_tpl->tpl_vars['TAX_TYPE']->value=='individual'){?><?php $_smarty_tpl->tpl_vars["IS_GROUP_TAX_TYPE"] = new Smarty_variable(false, null, 0);?><?php $_smarty_tpl->tpl_vars["IS_INDIVIDUAL_TAX_TYPE"] = new Smarty_variable(true, null, 0);?><?php }?><input type="hidden" class="numberOfCurrencyDecimal" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('no_of_currency_decimals');?>
" /><input type="hidden" name="totalProductCount" id="totalProductCount" value="<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" /><input type="hidden" name="subtotal" id="subtotal" value="" /><input type="hidden" name="total" id="total" value="" /><div name='editContent'><?php $_smarty_tpl->tpl_vars['LINE_ITEM_BLOCK_LABEL'] = new Smarty_variable("LBL_ITEM_DETAILS", null, 0);?><?php $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value[$_smarty_tpl->tpl_vars['LINE_ITEM_BLOCK_LABEL']->value], null, 0);?><?php $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINE_ITEM_BLOCK_LABEL']->value, null, 0);?><?php if (count($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value)>0){?><div class='fieldBlockContainer'><div class="row"><div class="col-lg-5 col-md-5 col-sm-5"><div class="row"><div class="col-lg-4 col-md-4 col-sm-4"><h4 class='fieldBlockHeader' style="margin-top:5px;"><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4></div><div class="col-lg-8 col-md-8 col-sm-8" style="top: 3px;"><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']&&$_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']->isEditable()){?><span class="pull-right"><i class="fa fa-info-circle"></i>&nbsp;<label><?php echo vtranslate($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>&nbsp;<select class="select2" id="region_id" name="region_id" style="width: 164px;"><option value="0" data-info="<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['DEFAULT_TAX_REGION_INFO']->value));?>
"><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['TAX_REGION_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['TAX_REGION_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['TAX_REGIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->key => $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->value){
$_smarty_tpl->tpl_vars['TAX_REGION_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['TAX_REGION_ID']->value = $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TAX_REGION_ID']->value;?>
" data-info='<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['TAX_REGION_INFO']->value));?>
' <?php if ($_smarty_tpl->tpl_vars['TAX_REGION_ID']->value==$_smarty_tpl->tpl_vars['RECORD']->value->get('region_id')){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->value['name'];?>
</option><?php } ?></select><input type="hidden" id="prevRegionId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('region_id');?>
" />&nbsp;&nbsp;<a class="fa fa-wrench" href="index.php?module=Vtiger&parent=Settings&view=TaxIndex" target="_blank" style="vertical-align:middle;"></a></span><?php }?></div></div></div><div class="col-lg-3 col-md-3 col-sm-3" style="top: 3px;"><center><i class="fa fa-info-circle"></i>&nbsp;<label><?php echo vtranslate('LBL_CURRENCY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>&nbsp;<?php $_smarty_tpl->tpl_vars['SELECTED_CURRENCY'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENCINFO']->value, null, 0);?><?php if ($_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value==''){?><?php $_smarty_tpl->tpl_vars['USER_CURRENCY_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_id'), null, 0);?><?php  $_smarty_tpl->tpl_vars['currency_details'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency_details']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['CURRENCIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency_details']->key => $_smarty_tpl->tpl_vars['currency_details']->value){
$_smarty_tpl->tpl_vars['currency_details']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['currency_details']->value['curid']==$_smarty_tpl->tpl_vars['USER_CURRENCY_ID']->value){?><?php $_smarty_tpl->tpl_vars['SELECTED_CURRENCY'] = new Smarty_variable($_smarty_tpl->tpl_vars['currency_details']->value, null, 0);?><?php }?><?php } ?><?php }?><select class="select2" id="currency_id" name="currency_id" style="width: 150px;"><?php  $_smarty_tpl->tpl_vars['currency_details'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency_details']->_loop = false;
 $_smarty_tpl->tpl_vars['count'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CURRENCIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency_details']->key => $_smarty_tpl->tpl_vars['currency_details']->value){
$_smarty_tpl->tpl_vars['currency_details']->_loop = true;
 $_smarty_tpl->tpl_vars['count']->value = $_smarty_tpl->tpl_vars['currency_details']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['currency_details']->value['curid'];?>
" class="textShadowNone" data-conversion-rate="<?php echo $_smarty_tpl->tpl_vars['currency_details']->value['conversionrate'];?>
" <?php if ($_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['currency_id']==$_smarty_tpl->tpl_vars['currency_details']->value['curid']){?> selected <?php }?>><?php echo getTranslatedCurrencyString($_smarty_tpl->tpl_vars['currency_details']->value['currencylabel']);?>
 (<?php echo $_smarty_tpl->tpl_vars['currency_details']->value['currencysymbol'];?>
)</option><?php } ?></select><?php $_smarty_tpl->tpl_vars["RECORD_CURRENCY_RATE"] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getRecord()->get('conversion_rate'), null, 0);?><?php if ($_smarty_tpl->tpl_vars['RECORD_CURRENCY_RATE']->value==''){?><?php $_smarty_tpl->tpl_vars["RECORD_CURRENCY_RATE"] = new Smarty_variable($_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['conversionrate'], null, 0);?><?php }?><input type="hidden" name="conversion_rate" id="conversion_rate" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_CURRENCY_RATE']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['currency_id'];?>
" id="prev_selected_currency_id" /><!-- TODO : To get default currency in even better way than depending on first element --><input type="hidden" id="default_currency_id" value="<?php echo $_smarty_tpl->tpl_vars['CURRENCIES']->value[0]['curid'];?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['currency_id'];?>
" id="selectedCurrencyId" /></center></div><div class="col-lg-4 col-md-4 col-sm-4" style="top: 3px;"><div style="float: right;"><i class="fa fa-info-circle"></i>&nbsp;<label><?php echo vtranslate('LBL_TAX_MODE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>&nbsp;<select class="select2 lineItemTax" id="taxtype" name="taxtype" style="width: 150px;"><option value="individual" <?php if ($_smarty_tpl->tpl_vars['IS_INDIVIDUAL_TAX_TYPE']->value){?>selected<?php }?>><?php echo vtranslate('LBL_INDIVIDUAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="group" <?php if ($_smarty_tpl->tpl_vars['IS_GROUP_TAX_TYPE']->value){?>selected<?php }?>><?php echo vtranslate('LBL_GROUP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select></div></div></div><div class="lineitemTableContainer"><table class="table table-bordered" id="lineItemTab"><tr><td><strong><?php echo vtranslate('LBL_TOOLS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php if ($_smarty_tpl->tpl_vars['IMAGE_EDITABLE']->value){?><td><strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']->get('label');?>
<?php $_tmp1=ob_get_clean();?><?php echo vtranslate($_tmp1,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }?><?php if ($_smarty_tpl->tpl_vars['PRODUCT_EDITABLE']->value){?><td><span class="redColor">*</span><strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']->get('label');?>
<?php $_tmp2=ob_get_clean();?><?php echo vtranslate($_tmp2,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }?><td><strong><?php echo vtranslate('LBL_QTY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php if ($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value){?><td><strong class="pull-right"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']->get('label');?>
<?php $_tmp3=ob_get_clean();?><?php echo vtranslate($_tmp3,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }?><?php if ($_smarty_tpl->tpl_vars['LIST_PRICE_EDITABLE']->value){?><td><strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']->get('label');?>
<?php $_tmp4=ob_get_clean();?><?php echo vtranslate($_tmp4,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }?><td><strong class="pull-right"><?php echo vtranslate('LBL_TOTAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php if ($_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value&&$_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value){?><td><strong class="pull-right"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']->get('label');?>
<?php $_tmp5=ob_get_clean();?><?php echo vtranslate($_tmp5,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }?><td><strong class="pull-right"><?php echo vtranslate('LBL_NET_PRICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td></tr><tr id="row0" class="hide lineItemCloneCopy" data-row-num="0"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("partials/LineItemsContent.tpl",'Inventory'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('row_no'=>0,'data'=>array(),'IGNORE_UI_REGISTRATION'=>true), 0);?>
</tr><?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_smarty_tpl->tpl_vars['row_no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
$_smarty_tpl->tpl_vars['data']->_loop = true;
 $_smarty_tpl->tpl_vars['row_no']->value = $_smarty_tpl->tpl_vars['data']->key;
?><tr id="row<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" data-row-num="<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" class="lineItemRow" <?php if ($_smarty_tpl->tpl_vars['data']->value["entityType".($_smarty_tpl->tpl_vars['row_no']->value)]=='Products'){?>data-quantity-in-stock=<?php echo $_smarty_tpl->tpl_vars['data']->value["qtyInStock".($_smarty_tpl->tpl_vars['row_no']->value)];?>
<?php }?>><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("partials/LineItemsContent.tpl",'Inventory'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('row_no'=>$_smarty_tpl->tpl_vars['row_no']->value,'data'=>$_smarty_tpl->tpl_vars['data']->value), 0);?>
</tr><?php } ?><?php if (count($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value)==0&&($_smarty_tpl->tpl_vars['PRODUCT_ACTIVE']->value=='true'||$_smarty_tpl->tpl_vars['SERVICE_ACTIVE']->value=='true')){?><tr id="row1" class="lineItemRow" data-row-num="1"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("partials/LineItemsContent.tpl",'Inventory'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('row_no'=>1,'data'=>array(),'IGNORE_UI_REGISTRATION'=>false), 0);?>
</tr><?php }?></table></div></div><br><div><div><?php if ($_smarty_tpl->tpl_vars['PRODUCT_ACTIVE']->value=='true'&&$_smarty_tpl->tpl_vars['SERVICE_ACTIVE']->value=='true'){?><div class="btn-toolbar"><span class="btn-group"><button type="button" class="btn btn-default" id="addProduct" data-module-name="Products" ><i class="fa fa-plus"></i>&nbsp;&nbsp;<strong><?php echo vtranslate('LBL_ADD_PRODUCT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></span><span class="btn-group"><button type="button" class="btn btn-default" id="addService" data-module-name="Services" ><i class="fa fa-plus"></i>&nbsp;&nbsp;<strong><?php echo vtranslate('LBL_ADD_SERVICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></span></div><?php }elseif($_smarty_tpl->tpl_vars['PRODUCT_ACTIVE']->value=='true'){?><div class="btn-group"><button type="button" class="btn btn-default" id="addProduct" data-module-name="Products"><i class="fa fa-plus"></i><strong>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_PRODUCT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div><?php }elseif($_smarty_tpl->tpl_vars['SERVICE_ACTIVE']->value=='true'){?><div class="btn-group"><button type="button" class="btn btn-default" id="addService" data-module-name="Services"><i class="fa fa-plus"></i><strong>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_SERVICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div><?php }?></div></div><br><div class="fieldBlockContainer"><table class="table table-bordered blockContainer lineItemTable" id="lineItemResult"><tr><td width="83%"><div class="pull-right"><strong><?php echo vtranslate('LBL_ITEMS_TOTAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></div></td><td><div id="netTotal" class="pull-right netTotal"><?php if (!empty($_smarty_tpl->tpl_vars['FINAL']->value['hdnSubTotal'])){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['hdnSubTotal'];?>
<?php }else{ ?>0<?php }?></div></td></tr><?php if ($_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_EDITABLE']->value||$_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_EDITABLE']->value){?><tr><td width="83%"><span class="pull-right">(-)&nbsp;<strong><a href="javascript:void(0)" id="finalDiscount"><?php echo vtranslate('LBL_OVERALL_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span id="overallDiscount"><?php if ($_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_EDITABLE']->value&&$_smarty_tpl->tpl_vars['FINAL']->value['discount_type_final']=='percentage'){?>(<?php echo $_smarty_tpl->tpl_vars['FINAL']->value['discount_percentage_final'];?>
%)<?php }elseif($_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_EDITABLE']->value&&$_smarty_tpl->tpl_vars['FINAL']->value['discount_type_final']=='amount'){?>(<?php echo $_smarty_tpl->tpl_vars['FINAL']->value['discount_amount_final'];?>
)<?php }else{ ?>(0)<?php }?></span></a></strong></span></td><td><span id="discountTotal_final" class="pull-right discountTotal_final"><?php if ($_smarty_tpl->tpl_vars['FINAL']->value['discountTotal_final']){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['discountTotal_final'];?>
<?php }else{ ?>0<?php }?></span><!-- Popup Discount Div --><div id="finalDiscountUI" class="finalDiscountUI validCheck hide"><?php $_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL'] = new Smarty_variable("zero", null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['FINAL']->value['discount_type_final'])){?><?php $_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FINAL']->value['discount_type_final'], null, 0);?><?php }?><input type="hidden" id="discount_type_final" name="discount_type_final" value="<?php echo $_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value;?>
" /><p class="popover_title hide"><?php echo vtranslate('LBL_SET_DISCOUNT_FOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <span class="subTotalVal"><?php if (!empty($_smarty_tpl->tpl_vars['FINAL']->value['hdnSubTotal'])){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['hdnSubTotal'];?>
<?php }else{ ?>0<?php }?></span></p><table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-nobordered popupTable"><tbody><tr><td><input type="radio" name="discount_final" class="finalDiscounts" data-discount-type="zero" <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value=='zero'){?>checked<?php }?> />&nbsp; <?php echo vtranslate('LBL_ZERO_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td class="lineOnTop"><!-- Make the discount value as zero --><input type="hidden" class="discountVal" value="0" /></td></tr><?php if ($_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_EDITABLE']->value){?><tr><td><input type="radio" name="discount_final" class="finalDiscounts" data-discount-type="percentage" <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value=='percentage'){?>checked<?php }?> />&nbsp; % <?php echo vtranslate('LBL_OF_PRICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td><span class="pull-right">&nbsp;%</span><input type="text" data-rule-positive=true data-rule-inventory_percentage=true id="discount_percentage_final" name="discount_percentage_final" value="<?php echo $_smarty_tpl->tpl_vars['FINAL']->value['discount_percentage_final'];?>
" class="discount_percentage_final span1 pull-right discountVal <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value!='percentage'){?>hide<?php }?>" /></td></tr><?php }?><?php if ($_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_EDITABLE']->value){?><tr><td><input type="radio" name="discount_final" class="finalDiscounts" data-discount-type="amount" <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value=='amount'){?>checked<?php }?> />&nbsp;<?php echo vtranslate('LBL_DIRECT_PRICE_REDUCTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td><input type="text" data-rule-positive=true id="discount_amount_final" name="discount_amount_final" value="<?php echo $_smarty_tpl->tpl_vars['FINAL']->value['discount_amount_final'];?>
" class="span1 pull-right discount_amount_final discountVal <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_TYPE_FINAL']->value!='amount'){?>hide<?php }?>" /></td></tr><?php }?></tbody></table></div><!-- End Popup Div --></td></tr><?php }?><?php if ($_smarty_tpl->tpl_vars['SH_PERCENT_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['FINAL']->value['chargesAndItsTaxes'], null, 0);?><tr><td width="83%"><span class="pull-right">(+)&nbsp;<strong><a href="javascript:void(0)" id="charges"><?php echo vtranslate('LBL_CHARGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></strong></span><div id="chargesBlock" class="validCheck hide chargesBlock"><table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-nobordered popupTable"><?php  $_smarty_tpl->tpl_vars['CHARGE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CHARGE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['CHARGE_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['INVENTORY_CHARGES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CHARGE_MODEL']->key => $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value){
$_smarty_tpl->tpl_vars['CHARGE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['CHARGE_ID']->value = $_smarty_tpl->tpl_vars['CHARGE_MODEL']->key;
?><tr><?php $_smarty_tpl->tpl_vars['CHARGE_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['value'], null, 0);?><?php $_smarty_tpl->tpl_vars['CHARGE_PERCENT'] = new Smarty_variable(0, null, 0);?><?php if ($_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->get('format')=='Percent'&&$_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['percent']!=null){?><?php $_smarty_tpl->tpl_vars['CHARGE_PERCENT'] = new Smarty_variable($_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['percent'], null, 0);?><?php }?><td class="lineOnTop chargeName" data-charge-id="<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->getName();?>
</td><td class="lineOnTop"><?php if ($_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->get('format')=='Percent'){?><input type="text" class="span1 chargePercent" size="5" data-rule-positive=true data-rule-inventory_percentage=true name="charges[<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
][percent]" value="<?php if ($_smarty_tpl->tpl_vars['CHARGE_PERCENT']->value){?><?php echo $_smarty_tpl->tpl_vars['CHARGE_PERCENT']->value;?>
<?php }elseif($_smarty_tpl->tpl_vars['RECORD_ID']->value){?>0<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->getValue();?>
<?php }?>" />&nbsp;%<?php }?></td><td style="text-align: right;" class="lineOnTop"><input type="text" class="span1 chargeValue" size="5" <?php if ($_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->get('format')=='Percent'){?>readonly<?php }?> data-rule-positive=true name="charges[<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
][value]" value="<?php if ($_smarty_tpl->tpl_vars['CHARGE_VALUE']->value){?><?php echo $_smarty_tpl->tpl_vars['CHARGE_VALUE']->value;?>
<?php }elseif($_smarty_tpl->tpl_vars['RECORD_ID']->value){?>0<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->getValue()*$_smarty_tpl->tpl_vars['USER_MODEL']->value->get('conv_rate');?>
<?php }?>" />&nbsp;</td></tr><?php } ?></table></div></td><td><input type="hidden" class="lineItemInputBox" id="chargesTotal" name="shipping_handling_charge" value="<?php if ($_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge']){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'];?>
<?php }else{ ?>0<?php }?>" /><span id="chargesTotalDisplay" class="pull-right chargesTotalDisplay"><?php if ($_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge']){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'];?>
<?php }else{ ?>0<?php }?></span></td></tr><?php }?><tr><td width="83%"><span class="pull-right"><strong><?php echo vtranslate('LBL_PRE_TAX_TOTAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </strong></span></td><td><?php $_smarty_tpl->tpl_vars['PRE_TAX_TOTAL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FINAL']->value['preTaxTotal'], null, 0);?><span class="pull-right" id="preTaxTotal"><?php if ($_smarty_tpl->tpl_vars['PRE_TAX_TOTAL']->value){?><?php echo $_smarty_tpl->tpl_vars['PRE_TAX_TOTAL']->value;?>
<?php }else{ ?>0<?php }?></span><input type="hidden" id="pre_tax_total" name="pre_tax_total" value="<?php if ($_smarty_tpl->tpl_vars['PRE_TAX_TOTAL']->value){?><?php echo $_smarty_tpl->tpl_vars['PRE_TAX_TOTAL']->value;?>
<?php }else{ ?>0<?php }?>"/></td></tr><!-- Group Tax - starts --><tr id="group_tax_row" valign="top" class="<?php if ($_smarty_tpl->tpl_vars['IS_INDIVIDUAL_TAX_TYPE']->value){?>hide<?php }?>"><td width="83%"><span class="pull-right">(+)&nbsp;<strong><a href="javascript:void(0)" id="finalTax"><?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></strong></span><!-- Pop Div For Group TAX --><div class="hide finalTaxUI validCheck" id="group_tax_div"><input type="hidden" class="popover_title" value="<?php echo vtranslate('LBL_GROUP_TAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" /><table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-nobordered popupTable"><?php  $_smarty_tpl->tpl_vars['tax_detail'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tax_detail']->_loop = false;
 $_smarty_tpl->tpl_vars['loop_count'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['TAXES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['group_tax_loop']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['tax_detail']->key => $_smarty_tpl->tpl_vars['tax_detail']->value){
$_smarty_tpl->tpl_vars['tax_detail']->_loop = true;
 $_smarty_tpl->tpl_vars['loop_count']->value = $_smarty_tpl->tpl_vars['tax_detail']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['group_tax_loop']['iteration']++;
?><tr><td class="lineOnTop"><?php echo $_smarty_tpl->tpl_vars['tax_detail']->value['taxlabel'];?>
</td><td class="lineOnTop"><input type="text" size="5" data-compound-on="<?php if ($_smarty_tpl->tpl_vars['tax_detail']->value['method']=='Compound'){?><?php echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['tax_detail']->value['compoundon']));?>
<?php }?>"name="<?php echo $_smarty_tpl->tpl_vars['tax_detail']->value['taxname'];?>
_group_percentage" id="group_tax_percentage<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['group_tax_loop']['iteration'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['tax_detail']->value['percentage'];?>
" class="span1 groupTaxPercentage"data-rule-positive=true data-rule-inventory_percentage=true />&nbsp;%</td><td style="text-align: right;" class="lineOnTop"><input type="text" size="6" name="<?php echo $_smarty_tpl->tpl_vars['tax_detail']->value['taxname'];?>
_group_amount" id="group_tax_amount<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['group_tax_loop']['iteration'];?>
" style="cursor:pointer;" value="<?php echo $_smarty_tpl->tpl_vars['tax_detail']->value['amount'];?>
" readonly class="cursorPointer span1 groupTaxTotal" /></td></tr><?php } ?><input type="hidden" id="group_tax_count" value="<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['group_tax_loop']['iteration'];?>
" /></table></div><!-- End Popup Div Group Tax --></td><td><span id="tax_final" class="pull-right tax_final"><?php if ($_smarty_tpl->tpl_vars['FINAL']->value['tax_totalamount']){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['tax_totalamount'];?>
<?php }else{ ?>0<?php }?></span></td></tr><!-- Group Tax - ends --><?php if ($_smarty_tpl->tpl_vars['SH_PERCENT_EDITABLE']->value){?><tr><td width="83%"><span class="pull-right">(+)&nbsp;<strong><a href="javascript:void(0)" id="chargeTaxes"><?php echo vtranslate('LBL_TAXES_ON_CHARGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </a></strong></span><!-- Pop Div For Shipping and Handling TAX --><div id="chargeTaxesBlock" class="hide validCheck chargeTaxesBlock"><p class="popover_title hide"><?php echo vtranslate('LBL_TAXES_ON_CHARGES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <span id="SHChargeVal" class="SHChargeVal"><?php if ($_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge']){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['shipping_handling_charge'];?>
<?php }else{ ?>0<?php }?></span></p><table class="table table-nobordered popupTable"><tbody><?php  $_smarty_tpl->tpl_vars['CHARGE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CHARGE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['CHARGE_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['INVENTORY_CHARGES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CHARGE_MODEL']->key => $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value){
$_smarty_tpl->tpl_vars['CHARGE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['CHARGE_ID']->value = $_smarty_tpl->tpl_vars['CHARGE_MODEL']->key;
?><?php  $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['CHARGE_TAX_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD']->value->getChargeTaxModelsList($_smarty_tpl->tpl_vars['CHARGE_ID']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->key => $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value){
$_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value = $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->key;
?><?php if (!isset($_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['taxes'][$_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value])&&$_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->isDeleted()){?><?php continue 1?><?php }?><?php if (!$_smarty_tpl->tpl_vars['RECORD_ID']->value&&$_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->isDeleted()){?><?php continue 1?><?php }?><tr><?php $_smarty_tpl->tpl_vars['SH_TAX_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->getTax(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['value']!=null){?><?php $_smarty_tpl->tpl_vars['SH_TAX_VALUE'] = new Smarty_variable(0, null, 0);?><?php if ($_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['taxes'][$_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value]){?><?php $_smarty_tpl->tpl_vars['SH_TAX_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CHARGE_AND_CHARGETAX_VALUES']->value[$_smarty_tpl->tpl_vars['CHARGE_ID']->value]['taxes'][$_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value], null, 0);?><?php }?><?php }?><td class="lineOnTop"><?php echo $_smarty_tpl->tpl_vars['CHARGE_MODEL']->value->getName();?>
 - <?php echo $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->getName();?>
</td><td class="lineOnTop"><input type="text" data-charge-id="<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
" data-compound-on="<?php if ($_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->getTaxMethod()=='Compound'){?><?php echo $_smarty_tpl->tpl_vars['CHARGE_TAX_MODEL']->value->get('compoundon');?>
<?php }?>"class="span1 chargeTaxPercentage" name="charges[<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
][taxes][<?php echo $_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['SH_TAX_VALUE']->value;?>
"data-rule-positive=true data-rule-inventory_percentage=true />&nbsp;%</td><td style="text-align: right;" class="lineOnTop"><input type="text" class="span1 chargeTaxValue cursorPointer pull-right chargeTax<?php echo $_smarty_tpl->tpl_vars['CHARGE_ID']->value;?>
<?php echo $_smarty_tpl->tpl_vars['CHARGE_TAX_ID']->value;?>
" size="5" value="0" readonly />&nbsp;</td></tr><?php } ?><?php } ?></tbody></table></div><!-- End Popup Div for Shipping and Handling TAX --></td><td><input type="hidden" id="chargeTaxTotalHidden" class="chargeTaxTotal" name="s_h_percent" value="<?php if ($_smarty_tpl->tpl_vars['FINAL']->value['shtax_totalamount']){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['shtax_totalamount'];?>
<?php }else{ ?>0<?php }?>" /><span class="pull-right" id="chargeTaxTotal"><?php if ($_smarty_tpl->tpl_vars['FINAL']->value['shtax_totalamount']){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['shtax_totalamount'];?>
<?php }else{ ?>0<?php }?></span></td></tr><tr><td width="83%"><span class="pull-right">(-)&nbsp;<strong><a href="javascript:void(0)" id="deductTaxes"><?php echo vtranslate('LBL_DEDUCTED_TAXES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </a></strong></span><div id="deductTaxesBlock" class="hide validCheck deductTaxesBlock"><table class="table table-nobordered popupTable"><tbody><?php  $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['DEDUCTED_TAX_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['DEDUCTED_TAXES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->key => $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value){
$_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['DEDUCTED_TAX_ID']->value = $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->key;
?><tr><td class="lineOnTop"><?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['taxlabel'];?>
</td><td class="lineOnTop"><input type="text" class="span1 deductTaxPercentage" name="<?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['taxname'];?>
_group_percentage" value="<?php if ($_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['selected']||!$_smarty_tpl->tpl_vars['RECORD_ID']->value){?><?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['percentage'];?>
<?php }else{ ?>0<?php }?>"data-rule-positive=true data-rule-inventory_percentage=true />&nbsp;%</td><td style="text-align: right;" class="lineOnTop"><input type="text" class="span1 deductTaxValue cursorPointer pull-right" name="<?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['taxname'];?>
_group_amount" size="5" readonly value="<?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['amount'];?>
"/>&nbsp;</td></tr><?php } ?></tbody></table></div></td><td><span class="pull-right" id="deductTaxesTotalAmount"><?php if ($_smarty_tpl->tpl_vars['FINAL']->value['deductTaxesTotalAmount']){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['deductTaxesTotalAmount'];?>
<?php }else{ ?>0<?php }?></span></td></tr><?php }?><tr valign="top"><td width="83%" ><div class="pull-right"><strong><?php echo vtranslate('LBL_ADJUSTMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</strong><span><input type="radio" name="adjustmentType" option value="+" <?php if ($_smarty_tpl->tpl_vars['FINAL']->value['adjustment']>=0){?>checked<?php }?>>&nbsp;<?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;&nbsp;</span><span><input type="radio" name="adjustmentType" option value="-" <?php if ($_smarty_tpl->tpl_vars['FINAL']->value['adjustment']<0){?>checked<?php }?>>&nbsp;<?php echo vtranslate('LBL_DEDUCT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div></td><td><span class="pull-right"><input id="adjustment" name="adjustment" type="text" data-rule-positive="true" class="lineItemInputBox form-control" value="<?php if ($_smarty_tpl->tpl_vars['FINAL']->value['adjustment']<0){?><?php echo abs($_smarty_tpl->tpl_vars['FINAL']->value['adjustment']);?>
<?php }elseif($_smarty_tpl->tpl_vars['FINAL']->value['adjustment']){?><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['adjustment'];?>
<?php }else{ ?>0<?php }?>"></span></td></tr><tr valign="top"><td width="83%"><span class="pull-right"><strong><?php echo vtranslate('LBL_GRAND_TOTAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></span></td><td><span id="grandTotal" name="grandTotal" class="pull-right grandTotal"><?php echo $_smarty_tpl->tpl_vars['FINAL']->value['grandTotal'];?>
</span></td></tr><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Invoice'||$_smarty_tpl->tpl_vars['MODULE']->value=='PurchaseOrder'){?><tr valign="top"><td width="83%" ><div class="pull-right"><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Invoice'){?><strong><?php echo vtranslate('LBL_RECEIVED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong><?php }else{ ?><strong><?php echo vtranslate('LBL_PAID',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong><?php }?></div></td><td><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Invoice'){?><span class="pull-right"><input id="received" name="received" type="text" class="lineItemInputBox form-control" value="<?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('received')&&!($_smarty_tpl->tpl_vars['IS_DUPLICATE']->value)){?><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('received');?>
<?php }else{ ?>0<?php }?>"></span><?php }else{ ?><span class="pull-right"><input id="paid" name="paid" type="text" class="lineItemInputBox" value="<?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('paid')&&!($_smarty_tpl->tpl_vars['IS_DUPLICATE']->value)){?><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('paid');?>
<?php }else{ ?>0<?php }?>"></span><?php }?></td></tr><tr valign="top"><td width="83%" ><div class="pull-right"><strong><?php echo vtranslate('LBL_BALANCE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></div></td><td><span class="pull-right"><input id="balance" name="balance" type="text" class="lineItemInputBox form-control" value="<?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('balance')&&!($_smarty_tpl->tpl_vars['IS_DUPLICATE']->value)){?><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('balance');?>
<?php }else{ ?>0<?php }?>" readonly></span></td></tr><?php }?></table></div><?php }?></div><?php }} ?>