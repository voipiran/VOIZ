<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 15:46:46
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Inventory/partials/LineItemsContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8860093355c4709ae4cb537-25274591%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e77cc1a0f7cdd2bb2c9f49fb17a6b819577dd9a' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Inventory/partials/LineItemsContent.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8860093355c4709ae4cb537-25274591',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'row_no' => 0,
    'entityIdentifier' => 0,
    'data' => 0,
    'RELATED_PRODUCTS' => 0,
    'hdnProductId' => 0,
    'productId' => 0,
    'MODULE' => 0,
    'purchaseCost' => 0,
    'qty' => 0,
    'RECORD_CURRENCY_RATE' => 0,
    'CURRENCIES' => 0,
    'currency_details' => 0,
    'IMAGE_EDITABLE' => 0,
    'image' => 0,
    'PRODUCT_EDITABLE' => 0,
    'tax_row_no' => 0,
    'productName' => 0,
    'productDeleted' => 0,
    'entityType' => 0,
    'PRODUCT_ACTIVE' => 0,
    'SERVICE_ACTIVE' => 0,
    'subproduct_ids' => 0,
    'subprod_names' => 0,
    'subprod_qty_list' => 0,
    'SUB_PRODUCT_INFO' => 0,
    'SUB_PRODUCT_ID' => 0,
    'COMMENT_EDITABLE' => 0,
    'comment' => 0,
    'QUANTITY_EDITABLE' => 0,
    'PURCHASE_COST_EDITABLE' => 0,
    'MARGIN_EDITABLE' => 0,
    'margin' => 0,
    'qtyInStock' => 0,
    'LIST_PRICE_EDITABLE' => 0,
    'listPrice' => 0,
    'RECORD_ID' => 0,
    'listPriceValues' => 0,
    'PRICEBOOK_MODULE_MODEL' => 0,
    'ITEM_DISCOUNT_AMOUNT_EDITABLE' => 0,
    'ITEM_DISCOUNT_PERCENT_EDITABLE' => 0,
    'discount_type' => 0,
    'discount_percent' => 0,
    'discount_amount' => 0,
    'DISCOUNT_TYPE' => 0,
    'productTotal' => 0,
    'checked_discount_zero' => 0,
    'checked_discount_percent' => 0,
    'checked_discount_amount' => 0,
    'IS_GROUP_TAX_TYPE' => 0,
    'totalAfterDiscount' => 0,
    'tax_data' => 0,
    'taxname' => 0,
    'popup_tax_rowname' => 0,
    'discountTotal' => 0,
    'taxTotal' => 0,
    'netPrice' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c4709ae97525',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c4709ae97525')) {function content_5c4709ae97525($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars["deleted"] = new Smarty_variable(("deleted").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable(("productImage").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["purchaseCost"] = new Smarty_variable(("purchaseCost").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["margin"] = new Smarty_variable(("margin").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["hdnProductId"] = new Smarty_variable(("hdnProductId").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["productName"] = new Smarty_variable(("productName").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["comment"] = new Smarty_variable(("comment").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["productDescription"] = new Smarty_variable(("productDescription").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["qtyInStock"] = new Smarty_variable(("qtyInStock").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["qty"] = new Smarty_variable(("qty").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["listPrice"] = new Smarty_variable(("listPrice").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["productTotal"] = new Smarty_variable(("productTotal").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["subproduct_ids"] = new Smarty_variable(("subproduct_ids").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["subprod_names"] = new Smarty_variable(("subprod_names").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["subprod_qty_list"] = new Smarty_variable(("subprod_qty_list").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["entityIdentifier"] = new Smarty_variable(("entityType").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["entityType"] = new Smarty_variable($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['entityIdentifier']->value], null, 0);?><?php $_smarty_tpl->tpl_vars["discount_type"] = new Smarty_variable(("discount_type").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["discount_percent"] = new Smarty_variable(("discount_percent").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["checked_discount_percent"] = new Smarty_variable(("checked_discount_percent").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["style_discount_percent"] = new Smarty_variable(("style_discount_percent").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["discount_amount"] = new Smarty_variable(("discount_amount").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["checked_discount_amount"] = new Smarty_variable(("checked_discount_amount").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["style_discount_amount"] = new Smarty_variable(("style_discount_amount").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["checked_discount_zero"] = new Smarty_variable(("checked_discount_zero").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["discountTotal"] = new Smarty_variable(("discountTotal").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["totalAfterDiscount"] = new Smarty_variable(("totalAfterDiscount").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["taxTotal"] = new Smarty_variable(("taxTotal").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["netPrice"] = new Smarty_variable(("netPrice").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["FINAL"] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value[1]['final_details'], null, 0);?><?php $_smarty_tpl->tpl_vars["productDeleted"] = new Smarty_variable(("productDeleted").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["productId"] = new Smarty_variable($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['hdnProductId']->value], null, 0);?><?php $_smarty_tpl->tpl_vars["listPriceValues"] = new Smarty_variable(Products_Record_Model::getListPriceValues($_smarty_tpl->tpl_vars['productId']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='PurchaseOrder'){?><?php $_smarty_tpl->tpl_vars["listPriceValues"] = new Smarty_variable(array(), null, 0);?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['RECORD_CURRENCY_RATE']->value;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value]){?><?php echo (((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])/((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]*$_tmp1));?><?php }else{ ?><?php echo "0";?><?php }?><?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["purchaseCost"] = new Smarty_variable($_tmp2, null, 0);?><?php  $_smarty_tpl->tpl_vars['currency_details'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency_details']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['CURRENCIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency_details']->key => $_smarty_tpl->tpl_vars['currency_details']->value){
$_smarty_tpl->tpl_vars['currency_details']->_loop = true;
?><?php $_smarty_tpl->createLocalArrayVariable('listPriceValues', null, 0);
$_smarty_tpl->tpl_vars['listPriceValues']->value[$_smarty_tpl->tpl_vars['currency_details']->value['currency_id']] = $_smarty_tpl->tpl_vars['currency_details']->value['conversionrate']*$_smarty_tpl->tpl_vars['purchaseCost']->value;?><?php } ?><?php }?><td style="text-align:center;"><i class="fa fa-trash deleteRow cursorPointer" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i>&nbsp;<a><img src="<?php echo vimage_path('drag.png');?>
" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/></a><input type="hidden" class="rowNumber" value="<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" /></td><?php if ($_smarty_tpl->tpl_vars['IMAGE_EDITABLE']->value){?><td class='lineItemImage' style="text-align:center;"><img src='<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['image']->value];?>
' height="42" width="42"></td><?php }?><?php if ($_smarty_tpl->tpl_vars['PRODUCT_EDITABLE']->value){?><td><!-- Product Re-Ordering Feature Code Addition Starts --><input type="hidden" name="hidtax_row_no<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" id="hidtax_row_no<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['tax_row_no']->value;?>
"/><!-- Product Re-Ordering Feature Code Addition ends --><div class="itemNameDiv form-inline"><div class="row"><div class="col-lg-10"><div class="input-group" style="width:100%"><input type="text" id="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productName']->value];?>
" class="productName form-control <?php if ($_smarty_tpl->tpl_vars['row_no']->value!=0){?> autoComplete <?php }?> " placeholder="<?php echo vtranslate('LBL_TYPE_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"data-rule-required=true <?php if (!empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productName']->value])){?> disabled="disabled" <?php }?>><?php if (!$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value]){?><span class="input-group-addon cursorPointer clearLineItem" title="<?php echo vtranslate('LBL_CLEAR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-times-circle"></i></span><?php }?><input type="hidden" id="<?php echo $_smarty_tpl->tpl_vars['hdnProductId']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['hdnProductId']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['hdnProductId']->value];?>
" class="selectedModuleId"/><input type="hidden" id="lineItemType<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" name="lineItemType<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['entityType']->value;?>
" class="lineItemType"/><div class="col-lg-2"><?php if ($_smarty_tpl->tpl_vars['row_no']->value==0){?><span class="lineItemPopup cursorPointer" data-popup="ServicesPopup" title="<?php echo vtranslate('Services',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Services" data-field-name="serviceid"><?php echo Vtiger_Module_Model::getModuleIconPath('Services');?>
</span><span class="lineItemPopup cursorPointer" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid"><?php echo Vtiger_Module_Model::getModuleIconPath('Products');?>
</span><?php }elseif($_smarty_tpl->tpl_vars['entityType']->value==''&&$_smarty_tpl->tpl_vars['PRODUCT_ACTIVE']->value=='true'){?><span class="lineItemPopup cursorPointer" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid"><?php echo Vtiger_Module_Model::getModuleIconPath('Products');?>
</span><?php }elseif($_smarty_tpl->tpl_vars['entityType']->value==''&&$_smarty_tpl->tpl_vars['SERVICE_ACTIVE']->value=='true'){?><span class="lineItemPopup cursorPointer" data-popup="ServicesPopup" title="<?php echo vtranslate('Services',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Services" data-field-name="serviceid"><?php echo Vtiger_Module_Model::getModuleIconPath('Services');?>
</span><?php }else{ ?><?php if (($_smarty_tpl->tpl_vars['entityType']->value=='Services')&&(!$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value])){?><span class="lineItemPopup cursorPointer" data-popup="ServicesPopup" title="<?php echo vtranslate('Services',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Services" data-field-name="serviceid"><?php echo Vtiger_Module_Model::getModuleIconPath('Services');?>
</span><?php }elseif((!$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value])){?><span class="lineItemPopup cursorPointer" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid"><?php echo Vtiger_Module_Model::getModuleIconPath('Products');?>
</span><?php }?><?php }?></div></div></div></div></div><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['subproduct_ids']->value];?>
" id="<?php echo $_smarty_tpl->tpl_vars['subproduct_ids']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['subproduct_ids']->value;?>
" class="subProductIds" /><div id="<?php echo $_smarty_tpl->tpl_vars['subprod_names']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['subprod_names']->value;?>
" class="subInformation"><span class="subProductsContainer"><?php  $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['SUB_PRODUCT_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['subprod_qty_list']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->key => $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value){
$_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['SUB_PRODUCT_ID']->value = $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->key;
?><em> - <?php echo $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value['name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value['qty'];?>
)<?php if ($_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value['qty']>getProductQtyInStock($_smarty_tpl->tpl_vars['SUB_PRODUCT_ID']->value)){?>&nbsp;-&nbsp;<span class="redColor"><?php echo vtranslate('LBL_STOCK_NOT_ENOUGH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><?php }?></em><br><?php } ?></span></div><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value]){?><div class="row-fluid deletedItem redColor"><?php if (empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productName']->value])){?><?php echo vtranslate('LBL_THIS_LINE_ITEM_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_THIS_LINE_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate('LBL_THIS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['entityType']->value;?>
 <?php echo vtranslate('LBL_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_OR_REPLACE_THIS_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?></div><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['COMMENT_EDITABLE']->value){?><div><br><textarea id="<?php echo $_smarty_tpl->tpl_vars['comment']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['comment']->value;?>
" class="lineItemCommentBox"><?php echo decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['comment']->value]);?>
</textarea></div><?php }?><?php }?></td><?php }?><td><input id="<?php echo $_smarty_tpl->tpl_vars['qty']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['qty']->value;?>
" type="text" class="qty smallInputBox inputElement"data-rule-required=true data-rule-positive=true data-rule-greater_than_zero=true value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value])){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value];?>
<?php }else{ ?>1<?php }?>"<?php if ($_smarty_tpl->tpl_vars['QUANTITY_EDITABLE']->value==false){?> disabled=disabled <?php }?> /><?php if ($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value==false&&$_smarty_tpl->tpl_vars['MODULE']->value!='PurchaseOrder'){?><input id="<?php echo $_smarty_tpl->tpl_vars['purchaseCost']->value;?>
" type="hidden" value="<?php if (((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])){?><?php echo ((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])/((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]);?>
<?php }else{ ?>0<?php }?>" /><span style="display:none" class="purchaseCost">0</span><input name="<?php echo $_smarty_tpl->tpl_vars['purchaseCost']->value;?>
" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value];?>
<?php }else{ ?>0<?php }?>" /><?php }?><?php if ($_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value==false){?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['margin']->value;?>
" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value];?>
<?php }else{ ?>0<?php }?>"></span><span class="margin pull-right" style="display:none"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value];?>
<?php }else{ ?>0<?php }?></span><?php }?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value!='PurchaseOrder'){?><br><span class="stockAlert redColor <?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]<=$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qtyInStock']->value]){?>hide<?php }?>" ><?php echo vtranslate('LBL_STOCK_NOT_ENOUGH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<br><?php echo vtranslate('LBL_MAX_QTY_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="maxQuantity"><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qtyInStock']->value];?>
</span></span><?php }?></td><?php if ($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value){?><td><input id="<?php echo $_smarty_tpl->tpl_vars['purchaseCost']->value;?>
" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value]){?><?php echo ((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])/((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]);?>
<?php }else{ ?>0<?php }?>" /><input name="<?php echo $_smarty_tpl->tpl_vars['purchaseCost']->value;?>
" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value];?>
<?php }else{ ?>0<?php }?>" /><span class="pull-right purchaseCost"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value];?>
<?php }else{ ?>0<?php }?></span></td><?php }?><?php if ($_smarty_tpl->tpl_vars['LIST_PRICE_EDITABLE']->value){?><td><div><input id="<?php echo $_smarty_tpl->tpl_vars['listPrice']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['listPrice']->value;?>
" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['listPrice']->value])){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['listPrice']->value];?>
<?php }else{ ?>0<?php }?>" type="text"data-rule-required=true data-rule-positive=true class="listPrice smallInputBox inputElement" data-is-price-changed="<?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value&&$_smarty_tpl->tpl_vars['row_no']->value!=0){?>true<?php }else{ ?>false<?php }?>" list-info='<?php if (isset($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['listPrice']->value])){?><?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['listPriceValues']->value);?>
<?php }?>' data-base-currency-id="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['entityType']->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo getProductBaseCurrency($_smarty_tpl->tpl_vars['productId']->value,$_tmp3);?>
" />&nbsp;<?php $_smarty_tpl->tpl_vars['PRICEBOOK_MODULE_MODEL'] = new Smarty_variable(Vtiger_Module_Model::getInstance('PriceBooks'), null, 0);?><?php if ($_smarty_tpl->tpl_vars['PRICEBOOK_MODULE_MODEL']->value->isPermitted('DetailView')&&$_smarty_tpl->tpl_vars['MODULE']->value!='PurchaseOrder'){?><span class="priceBookPopup cursorPointer" data-popup="Popup"  title="<?php echo vtranslate('PriceBooks',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="PriceBooks" style="float:left"><?php echo Vtiger_Module_Model::getModuleIconPath('PriceBooks');?>
</span><?php }?></div><div style="clear:both"></div><?php if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_EDITABLE']->value||$_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_EDITABLE']->value){?><div><span>(-)&nbsp;<strong><a href="javascript:void(0)" class="individualDiscount"><?php echo vtranslate('LBL_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<span class="itemDiscount"><?php if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_EDITABLE']->value&&$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value]=='percentage'){?>(<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_percent']->value];?>
%)<?php }elseif($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_EDITABLE']->value&&$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value]=='amount'){?>(<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_amount']->value];?>
)<?php }else{ ?>(0)<?php }?></span></a> : </strong></span></div><div class="discountUI validCheck hide" id="discount_div<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
"><?php $_smarty_tpl->tpl_vars["DISCOUNT_TYPE"] = new Smarty_variable("zero", null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value])){?><?php $_smarty_tpl->tpl_vars["DISCOUNT_TYPE"] = new Smarty_variable($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value], null, 0);?><?php }?><input type="hidden" id="discount_type<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" name="discount_type<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['DISCOUNT_TYPE']->value;?>
" class="discount_type" /><p class="popover_title hide"><?php echo vtranslate('LBL_SET_DISCOUNT_FOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <span class="variable"><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productTotal']->value];?>
</span></p><table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-nobordered popupTable"><!-- TODO : discount price and amount are hide by default we need to check id they are already selected if so we should not hide them  --><tr><td><input type="radio" name="discount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_zero']->value];?>
 <?php if (empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_type']->value])){?>checked<?php }?> class="discounts" data-discount-type="zero" />&nbsp;<?php echo vtranslate('LBL_ZERO_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td><!-- Make the discount value as zero --><input type="hidden" class="discountVal" value="0" /></td></tr><?php if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_EDITABLE']->value){?><tr><td><input type="radio" name="discount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_percent']->value];?>
 class="discounts" data-discount-type="percentage" />&nbsp; %<?php echo vtranslate('LBL_OF_PRICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td><span class="pull-right">&nbsp;%</span><input type="text" data-rule-positive=true data-rule-inventory_percentage=true id="discount_percentage<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" name="discount_percentage<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_percent']->value];?>
" class="discount_percentage span1 pull-right discountVal <?php if (empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_percent']->value])){?>hide<?php }?>" /></td></tr><?php }?><?php if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_EDITABLE']->value){?><tr><td class="LineItemDirectPriceReduction"><input type="radio" name="discount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" <?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_amount']->value];?>
 class="discounts" data-discount-type="amount" />&nbsp;<?php echo vtranslate('LBL_DIRECT_PRICE_REDUCTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td><td><input type="text" data-rule-positive=true id="discount_amount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" name="discount_amount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discount_amount']->value];?>
" class="span1 pull-right discount_amount discountVal <?php if (empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['checked_discount_amount']->value])){?>hide<?php }?>"/></td></tr><?php }?></table></div><div style="width:150px;"><strong><?php echo vtranslate('LBL_TOTAL_AFTER_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 :</strong></div><?php }?><div class="individualTaxContainer <?php if ($_smarty_tpl->tpl_vars['IS_GROUP_TAX_TYPE']->value){?>hide<?php }?>">(+)&nbsp;<strong><a href="javascript:void(0)" class="individualTax"><?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 </a> : </strong></div><span class="taxDivContainer"><div class="taxUI hide" id="tax_div<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
"><p class="popover_title hide"><?php echo vtranslate('LBL_SET_TAX_FOR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 : <span class="variable"><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['totalAfterDiscount']->value];?>
</span></p><?php if (count($_smarty_tpl->tpl_vars['data']->value['taxes'])>0){?><div class="individualTaxDiv"><!-- we will form the table with all taxes --><table width="100%" border="0" cellpadding="5" cellspacing="0" class="table table-nobordered popupTable" id="tax_table<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
"><?php  $_smarty_tpl->tpl_vars['tax_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tax_data']->_loop = false;
 $_smarty_tpl->tpl_vars['tax_row_no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tax_data']->key => $_smarty_tpl->tpl_vars['tax_data']->value){
$_smarty_tpl->tpl_vars['tax_data']->_loop = true;
 $_smarty_tpl->tpl_vars['tax_row_no']->value = $_smarty_tpl->tpl_vars['tax_data']->key;
?><?php $_smarty_tpl->tpl_vars["taxname"] = new Smarty_variable((($_smarty_tpl->tpl_vars['tax_data']->value['taxname']).("_percentage")).($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["tax_id_name"] = new Smarty_variable(("hidden_tax").($_smarty_tpl->tpl_vars['tax_row_no']->value)+((1).("_percentage")).($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["taxlabel"] = new Smarty_variable((($_smarty_tpl->tpl_vars['tax_data']->value['taxlabel']).("_percentage")).($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["popup_tax_rowname"] = new Smarty_variable(("popup_tax_row").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><tr><td>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['tax_data']->value['taxlabel'];?>
</td><td style="text-align: right;"><input type="text" data-rule-positive=true data-rule-inventory_percentage=true  name="<?php echo $_smarty_tpl->tpl_vars['taxname']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['taxname']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['tax_data']->value['percentage'];?>
" data-compound-on="<?php if ($_smarty_tpl->tpl_vars['tax_data']->value['method']=='Compound'){?><?php echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['tax_data']->value['compoundon']));?>
<?php }?>" data-regions-list="<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['tax_data']->value['regionsList']));?>
" class="span1 taxPercentage" />&nbsp;%</td><td style="text-align: right; padding-right: 10px;"><input type="text" name="<?php echo $_smarty_tpl->tpl_vars['popup_tax_rowname']->value;?>
" class="cursorPointer span1 taxTotal taxTotal<?php echo $_smarty_tpl->tpl_vars['tax_data']->value['taxid'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['tax_data']->value['amount'];?>
" readonly /></td></tr><?php } ?></table></div><?php }?></div></span></td><?php }?><td><div id="productTotal<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" align="right" class="productTotal"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productTotal']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productTotal']->value];?>
<?php }else{ ?>0<?php }?></div><?php if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_EDITABLE']->value||$_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_EDITABLE']->value){?><div id="discountTotal<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" align="right" class="discountTotal"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discountTotal']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['discountTotal']->value];?>
<?php }else{ ?>0<?php }?></div><div id="totalAfterDiscount<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" align="right" class="totalAfterDiscount"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['totalAfterDiscount']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['totalAfterDiscount']->value];?>
<?php }else{ ?>0<?php }?></div><?php }?><div id="taxTotal<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" align="right" class="productTaxTotal <?php if ($_smarty_tpl->tpl_vars['IS_GROUP_TAX_TYPE']->value){?>hide<?php }?>"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['taxTotal']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['taxTotal']->value];?>
<?php }else{ ?>0<?php }?></div></td><?php if ($_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value&&$_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value){?><td><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['margin']->value;?>
" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value];?>
<?php }else{ ?>0<?php }?>"></span><span class="margin pull-right"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value];?>
<?php }else{ ?>0<?php }?></span></td><?php }?><td><span id="netPrice<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" class="pull-right netPrice"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['netPrice']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['netPrice']->value];?>
<?php }else{ ?>0<?php }?></span></td><?php }} ?>