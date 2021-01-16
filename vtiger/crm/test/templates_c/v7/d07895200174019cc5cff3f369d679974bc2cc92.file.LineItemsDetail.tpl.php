<?php /* Smarty version Smarty-3.1.7, created on 2018-11-28 10:29:29
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Inventory/LineItemsDetail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21136575125bfe3cd18c3a89-82930138%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd07895200174019cc5cff3f369d679974bc2cc92' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Inventory/LineItemsDetail.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21136575125bfe3cd18c3a89-82930138',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BLOCK_LIST' => 0,
    'ITEM_DETAILS_BLOCK' => 0,
    'LINEITEM_FIELDS' => 0,
    'IMAGE_VIEWABLE' => 0,
    'COL_SPAN1' => 0,
    'PRODUCT_VIEWABLE' => 0,
    'QUANTITY_VIEWABLE' => 0,
    'PURCHASE_COST_VIEWABLE' => 0,
    'COL_SPAN2' => 0,
    'LIST_PRICE_VIEWABLE' => 0,
    'MARGIN_VIEWABLE' => 0,
    'COL_SPAN3' => 0,
    'RELATED_PRODUCTS' => 0,
    'MODULE_NAME' => 0,
    'RECORD' => 0,
    'TAX_REGION_MODEL' => 0,
    'REGION_LABEL' => 0,
    'CURRENCY_INFO' => 0,
    'FINAL_DETAILS' => 0,
    'MODULE' => 0,
    'LINE_ITEM_DETAIL' => 0,
    'COMMENT_VIEWABLE' => 0,
    'ITEM_DISCOUNT_AMOUNT_VIEWABLE' => 0,
    'ITEM_DISCOUNT_PERCENT_VIEWABLE' => 0,
    'DISCOUNT_INFO' => 0,
    'tax_details' => 0,
    'COMPOUND_TAX_ID' => 0,
    'INDIVIDUAL_TAX_INFO' => 0,
    'DISCOUNT_AMOUNT_VIEWABLE' => 0,
    'DISCOUNT_PERCENT_VIEWABLE' => 0,
    'FINAL_DISCOUNT_INFO' => 0,
    'SH_PERCENT_VIEWABLE' => 0,
    'SELECTED_CHARGES_AND_ITS_TAXES' => 0,
    'CHARGE_INFO' => 0,
    'CHARGES_INFO' => 0,
    'GROUP_TAX_INFO' => 0,
    'CHARGE_TAX_INFO' => 0,
    'CHARGES_TAX_INFO' => 0,
    'DEDUCTED_TAX_INFO' => 0,
    'DEDUCTED_TAXES_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfe3cd1cd929',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfe3cd1cd929')) {function content_5bfe3cd1cd929($_smarty_tpl) {?>


<?php $_smarty_tpl->tpl_vars['ITEM_DETAILS_BLOCK'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_LIST']->value['LBL_ITEM_DETAILS'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['LINEITEM_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['ITEM_DETAILS_BLOCK']->value->getFields(), null, 0);?>

<?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(0, null, 0);?>
<?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(0, null, 0);?>
<?php $_smarty_tpl->tpl_vars['COL_SPAN3'] = new Smarty_variable(2, null, 0);?>
<?php $_smarty_tpl->tpl_vars['IMAGE_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['PRODUCT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['QUANTITY_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['PURCHASE_COST_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['LIST_PRICE_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['MARGIN_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['COMMENT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['SH_PERCENT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']){?>
    <?php $_smarty_tpl->tpl_vars['IMAGE_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['IMAGE_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']){?>
    <?php $_smarty_tpl->tpl_vars['PRODUCT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['PRODUCT_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']){?>
    <?php $_smarty_tpl->tpl_vars['QUANTITY_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['QUANTITY_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']){?>
    <?php $_smarty_tpl->tpl_vars['PURCHASE_COST_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['PURCHASE_COST_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN2']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']){?>
    <?php $_smarty_tpl->tpl_vars['LIST_PRICE_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['LIST_PRICE_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN2']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']){?>
    <?php $_smarty_tpl->tpl_vars['MARGIN_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['MARGIN_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN3'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN3']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['comment']){?>
    <?php $_smarty_tpl->tpl_vars['COMMENT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['comment']->isViewable(), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_amount']){?>
    <?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_amount']->isViewable(), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_percent']){?>
    <?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_percent']->isViewable(), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnS_H_Percent']){?>
    <?php $_smarty_tpl->tpl_vars['SH_PERCENT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnS_H_Percent']->isViewable(), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountAmount']){?>
    <?php $_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountAmount']->isViewable(), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountPercent']){?>
    <?php $_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountPercent']->isViewable(), null, 0);?>
<?php }?>

<input type="hidden" class="isCustomFieldExists" value="false">

<?php $_smarty_tpl->tpl_vars['FINAL_DETAILS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value[1]['final_details'], null, 0);?>
<div class="details block">
    <div class="lineItemTableDiv">
        <table class="table table-bordered lineItemsTable" style = "margin-top:15px">
            <thead>
            <th colspan="<?php echo $_smarty_tpl->tpl_vars['COL_SPAN1']->value;?>
" class="lineItemBlockHeader">
                <?php $_smarty_tpl->tpl_vars['REGION_LABEL'] = new Smarty_variable(vtranslate('LBL_ITEM_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), null, 0);?>
                <?php if ($_smarty_tpl->tpl_vars['RECORD']->value->get('region_id')&&$_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']&&$_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']->isViewable()){?>
                    <?php $_smarty_tpl->tpl_vars['TAX_REGION_MODEL'] = new Smarty_variable(Inventory_TaxRegion_Model::getRegionModel($_smarty_tpl->tpl_vars['RECORD']->value->get('region_id')), null, 0);?>
                    <?php if ($_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value){?>
                        <?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['REGION_LABEL'] = new Smarty_variable($_tmp1." : ".($_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value->getName()), null, 0);?>
                    <?php }?>
                <?php }?>
                <?php echo $_smarty_tpl->tpl_vars['REGION_LABEL']->value;?>

            </th>
            <th colspan="<?php echo $_smarty_tpl->tpl_vars['COL_SPAN2']->value;?>
" class="lineItemBlockHeader">
                <?php $_smarty_tpl->tpl_vars['CURRENCY_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->getCurrencyInfo(), null, 0);?>
                <?php echo vtranslate('LBL_CURRENCY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 : <?php echo vtranslate($_smarty_tpl->tpl_vars['CURRENCY_INFO']->value['currency_name'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
(<?php echo $_smarty_tpl->tpl_vars['CURRENCY_INFO']->value['currency_symbol'];?>
)
            </th>
            <th colspan="<?php echo $_smarty_tpl->tpl_vars['COL_SPAN3']->value;?>
" class="lineItemBlockHeader">
                <?php echo vtranslate('LBL_TAX_MODE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 : <?php echo vtranslate($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxtype'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

            </th>
            </thead>
            <tbody>
                <tr>
                    <?php if ($_smarty_tpl->tpl_vars['IMAGE_VIEWABLE']->value){?>
                        <td class="lineItemFieldName">
                            <strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']->get('label');?>
<?php $_tmp2=ob_get_clean();?><?php echo vtranslate($_tmp2,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
                        </td>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['PRODUCT_VIEWABLE']->value){?>
                        <td class="lineItemFieldName">
                            <span class="redColor">*</span><strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']->get('label');?>
<?php $_tmp3=ob_get_clean();?><?php echo vtranslate($_tmp3,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </td>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['QUANTITY_VIEWABLE']->value){?>
                        <td class="lineItemFieldName">
                            <strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']->get('label');?>
<?php $_tmp4=ob_get_clean();?><?php echo vtranslate($_tmp4,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </td>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['PURCHASE_COST_VIEWABLE']->value){?>
                        <td class="lineItemFieldName">
                            <strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']->get('label');?>
<?php $_tmp5=ob_get_clean();?><?php echo vtranslate($_tmp5,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </td>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['LIST_PRICE_VIEWABLE']->value){?>
                        <td style="white-space: nowrap;">
                            <strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']->get('label');?>
<?php $_tmp6=ob_get_clean();?><?php echo vtranslate($_tmp6,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </td>
                    <?php }?>
                    <td class="lineItemFieldName">
                        <strong class="pull-right"><?php echo vtranslate('LBL_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                    </td>
                    <?php if ($_smarty_tpl->tpl_vars['MARGIN_VIEWABLE']->value){?>
                        <td class="lineItemFieldName">
                            <strong class="pull-right"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']->get('label');?>
<?php $_tmp7=ob_get_clean();?><?php echo vtranslate($_tmp7,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </td>
                    <?php }?>
                    <td class="lineItemFieldName">
                        <strong class="pull-right"><?php echo vtranslate('LBL_NET_PRICE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                    </td>
                </tr>
                <?php  $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->_loop = false;
 $_smarty_tpl->tpl_vars['INDEX'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->key => $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value){
$_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->_loop = true;
 $_smarty_tpl->tpl_vars['INDEX']->value = $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->key;
?>
                    <tr>
                        <?php if ($_smarty_tpl->tpl_vars['IMAGE_VIEWABLE']->value){?>
                            <td style="text-align:center;">
                                <img src='<?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productImage".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
' height="42" width="42">
                            </td>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['PRODUCT_VIEWABLE']->value){?>
                            <td>
                                <div>
                                    <?php if ($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productDeleted".($_smarty_tpl->tpl_vars['INDEX']->value)]){?>
                                        <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productName".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                                    <?php }else{ ?>
                                        <h5><a class="fieldValue" href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["entityType".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["hdnProductId".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productName".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
</a></h5>
                                        <?php }?>
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productDeleted".($_smarty_tpl->tpl_vars['INDEX']->value)]){?>
                                    <div class="redColor deletedItem">
                                        <?php if (empty($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productName".($_smarty_tpl->tpl_vars['INDEX']->value)])){?>
                                            <?php echo vtranslate('LBL_THIS_LINE_ITEM_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_THIS_LINE_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                        <?php }else{ ?>
                                            <?php echo vtranslate('LBL_THIS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["entityType".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
 <?php echo vtranslate('LBL_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_OR_REPLACE_THIS_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                        <?php }?>
                                    </div>
                                <?php }?>
                                <div>
                                    <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["subprod_names".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['COMMENT_VIEWABLE']->value&&!empty($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productName".($_smarty_tpl->tpl_vars['INDEX']->value)])){?>
                                    <div>
                                        <?php echo nl2br(decode_html($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["comment".($_smarty_tpl->tpl_vars['INDEX']->value)]));?>

                                    </div>
                                <?php }?>
                            </td>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['QUANTITY_VIEWABLE']->value){?>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["qty".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                            </td>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['PURCHASE_COST_VIEWABLE']->value){?>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["purchaseCost".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                            </td>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['LIST_PRICE_VIEWABLE']->value){?>
                            <td style="white-space: nowrap;">
                                <div>
                                    <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["listPrice".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_VIEWABLE']->value||$_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_VIEWABLE']->value){?>
                                    <div>
                                        <?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["discount_type".($_smarty_tpl->tpl_vars['INDEX']->value)]=='amount'){?><?php echo " ";?><?php echo vtranslate('LBL_DIRECT_AMOUNT_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php echo " = ";?><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["discountTotal".($_smarty_tpl->tpl_vars['INDEX']->value)];?><?php echo "
									";?><?php }elseif($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["discount_type".($_smarty_tpl->tpl_vars['INDEX']->value)]=='percentage'){?><?php echo " ";?><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["discount_percent".($_smarty_tpl->tpl_vars['INDEX']->value)];?><?php echo " % ";?><?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php echo " ";?><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productTotal".($_smarty_tpl->tpl_vars['INDEX']->value)];?><?php echo " = ";?><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["discountTotal".($_smarty_tpl->tpl_vars['INDEX']->value)];?><?php echo "
									";?><?php }?><?php $_tmp8=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['DISCOUNT_INFO'] = new Smarty_variable($_tmp8, null, 0);?>
                                        (-)&nbsp; <strong><a href="javascript:void(0)" class="individualDiscount inventoryLineItemDetails" tabindex="0" role="tooltip" id ="example" data-toggle="popover" data-trigger="focus" title="<?php echo vtranslate('LBL_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" data-content="<?php echo $_smarty_tpl->tpl_vars['DISCOUNT_INFO']->value;?>
"><?php echo vtranslate('LBL_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a> : </strong>
                                    </div>
                                <?php }?>
                                <div>
                                    <strong><?php echo vtranslate('LBL_TOTAL_AFTER_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 :</strong>
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxtype']!='group'){?>
                                    <div class="individualTaxContainer">
                                        <?php ob_start();?><?php echo vtranslate('LBL_TOTAL_AFTER_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp9=ob_get_clean();?><?php ob_start();?><?php  $_smarty_tpl->tpl_vars['tax_details'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tax_details']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tax_details']->key => $_smarty_tpl->tpl_vars['tax_details']->value){
$_smarty_tpl->tpl_vars['tax_details']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value[($_smarty_tpl->tpl_vars['tax_details']->value['taxname'])]){?><?php echo $_smarty_tpl->tpl_vars['tax_details']->value['taxlabel'];?><?php echo " : \t";?><?php echo $_smarty_tpl->tpl_vars['tax_details']->value['percentage'];?><?php echo "%  ";?><?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php echo "  ";?><?php if ($_smarty_tpl->tpl_vars['tax_details']->value['method']=='Compound'){?><?php echo "(";?><?php }?><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["totalAfterDiscount".($_smarty_tpl->tpl_vars['INDEX']->value)];?><?php if ($_smarty_tpl->tpl_vars['tax_details']->value['method']=='Compound'){?><?php  $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tax_details']->value['compoundon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->key => $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value){
$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxes'][$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value]['taxlabel']){?><?php echo " + ";?><?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxes'][$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value]['taxlabel'];?><?php }?><?php } ?><?php echo ")";?><?php }?><?php echo " = ";?><?php echo $_smarty_tpl->tpl_vars['tax_details']->value['amount'];?><?php echo "<br />";?><?php }?><?php } ?><?php $_tmp10=ob_get_clean();?><?php ob_start();?><?php echo vtranslate('LBL_TOTAL_TAX_AMOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp11=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['INDIVIDUAL_TAX_INFO'] = new Smarty_variable($_tmp9." = ".($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["totalAfterDiscount".($_smarty_tpl->tpl_vars['INDEX']->value)])."<br /><br />".$_tmp10."<br /><br />".$_tmp11." = ".($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["taxTotal".($_smarty_tpl->tpl_vars['INDEX']->value)]), null, 0);?>
                                        (+)&nbsp;<strong><a href="javascript:void(0)" class="individualTax inventoryLineItemDetails" tabindex="0" role="tooltip" id="example" title ="<?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" data-trigger ="focus" data-toggle ="popover" data-content="<?php echo $_smarty_tpl->tpl_vars['INDIVIDUAL_TAX_INFO']->value;?>
"><?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 </a> : </strong>
                                    </div>
                                <?php }?>
                            </td>
                        <?php }?>

                        <td>
                            <div align = "right"><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productTotal".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
</div>
                            <?php if ($_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_VIEWABLE']->value||$_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_VIEWABLE']->value){?>
                                <div align = "right"><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["discountTotal".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
</div>           
                            <?php }?>
                            <div align = "right"><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["totalAfterDiscount".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
</div>
                            <?php if ($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxtype']!='group'){?>
                                <div align = "right"><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["taxTotal".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
</div>
                            <?php }?>
                        </td>
                        <?php if ($_smarty_tpl->tpl_vars['MARGIN_VIEWABLE']->value){?>
                            <td><div align = "right"><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["margin".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
</div></td>
							<?php }?>
                        <td>
                            <div align = "right"><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["netPrice".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
</div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <table class="table table-bordered lineItemsTable">
        <tr>
            <td width="83%">
                <div class="pull-right">
                    <strong><?php echo vtranslate('LBL_ITEMS_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                </div>
            </td>
            <td>
                <span class="pull-right">
                    <strong><?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value["hdnSubTotal"];?>
</strong>
                </span>
            </td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_VIEWABLE']->value||$_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_VIEWABLE']->value){?>
            <tr>
                <td width="83%">
                    <div align="right">
                        <?php ob_start();?><?php echo vtranslate('LBL_FINAL_DISCOUNT_AMOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp12=ob_get_clean();?><?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_VIEWABLE']->value&&$_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['discount_type_final']=='percentage'){?><?php echo " ";?><?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['discount_percentage_final'];?><?php echo "	% ";?><?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php echo " ";?><?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['hdnSubTotal'];?><?php echo " = ";?><?php }?><?php $_tmp13=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['FINAL_DISCOUNT_INFO'] = new Smarty_variable($_tmp12." = ".$_tmp13.($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['discountTotal_final']), null, 0);?>
                        (-)&nbsp;<strong><a class="inventoryLineItemDetails" href="javascript:void(0)" id="finalDiscount" tabindex="0" role="tooltip" data-trigger ="focus" data-placement="left" data-toggle = "popover" title= "<?php echo vtranslate('LBL_OVERALL_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" data-content="<?php echo $_smarty_tpl->tpl_vars['FINAL_DISCOUNT_INFO']->value;?>
"><?php echo vtranslate('LBL_OVERALL_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></strong>
                    </div>
                </td>
                <td>
                    <div align="right">
                        <?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['discountTotal_final'];?>

                    </div>

                </td>
            </tr>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['SH_PERCENT_VIEWABLE']->value){?>
            <tr>
                <td width="83%">
                    <div align="right">
                        <?php ob_start();?><?php echo vtranslate('LBL_TOTAL_AFTER_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp14=ob_get_clean();?><?php ob_start();?><?php  $_smarty_tpl->tpl_vars['CHARGE_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CHARGE_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['CHARGE_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_CHARGES_AND_ITS_TAXES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CHARGE_INFO']->key => $_smarty_tpl->tpl_vars['CHARGE_INFO']->value){
$_smarty_tpl->tpl_vars['CHARGE_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['CHARGE_ID']->value = $_smarty_tpl->tpl_vars['CHARGE_INFO']->key;
?><?php echo " ";?><?php if ($_smarty_tpl->tpl_vars['CHARGE_INFO']->value['deleted']){?><?php echo "(";?><?php echo strtoupper(vtranslate('LBL_DELETED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
<?php echo ")";?><?php }?><?php echo " ";?><?php echo $_smarty_tpl->tpl_vars['CHARGE_INFO']->value['name'];?><?php echo " ";?><?php if ($_smarty_tpl->tpl_vars['CHARGE_INFO']->value['percent']){?><?php echo ": ";?><?php echo $_smarty_tpl->tpl_vars['CHARGE_INFO']->value['percent'];?><?php echo "% ";?><?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php echo " ";?><?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['totalAfterDiscount'];?><?php }?><?php echo " = ";?><?php echo $_smarty_tpl->tpl_vars['CHARGE_INFO']->value['amount'];?><?php echo "<br />";?><?php } ?><?php $_tmp15=ob_get_clean();?><?php ob_start();?><?php echo vtranslate('LBL_CHARGES_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp16=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['CHARGES_INFO'] = new Smarty_variable($_tmp14." = ".($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['totalAfterDiscount'])."<br /><br />".$_tmp15."<br /><h5>".$_tmp16." = ".($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['shipping_handling_charge'])."</h5>", null, 0);?>
                        (+)&nbsp;<strong><a class="inventoryLineItemDetails" tabindex="0" role="tooltip" href="javascript:void(0)" id="example" data-trigger="focus" data-placement ="left"  data-toggle="popover" title=<?php echo vtranslate('LBL_CHARGES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 data-content="<?php echo $_smarty_tpl->tpl_vars['CHARGES_INFO']->value;?>
"><?php echo vtranslate('LBL_CHARGES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></strong>
                    </div>
                </td>
                <td>
                    <div align="right">
                        <?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value["shipping_handling_charge"];?>

                    </div>
                </td>
            </tr>
        <?php }?>
        <tr>
            <td width="83%">
                <div align="right">
                    <strong><?php echo vtranslate('LBL_PRE_TAX_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 </strong>
                </div>
            </td>
            <td>
                <div align="right">
                    <?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value["preTaxTotal"];?>

                </div>
            </td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxtype']=='group'){?>
            <tr>
                <td width="83%">
                    <div align="right">
                        <?php ob_start();?><?php echo vtranslate('LBL_TOTAL_AFTER_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp17=ob_get_clean();?><?php ob_start();?><?php  $_smarty_tpl->tpl_vars['tax_details'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tax_details']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tax_details']->key => $_smarty_tpl->tpl_vars['tax_details']->value){
$_smarty_tpl->tpl_vars['tax_details']->_loop = true;
?><?php echo $_smarty_tpl->tpl_vars['tax_details']->value['taxlabel'];?><?php echo " : \t";?><?php echo $_smarty_tpl->tpl_vars['tax_details']->value['percentage'];?><?php echo "% ";?><?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php echo " ";?><?php if ($_smarty_tpl->tpl_vars['tax_details']->value['method']=='Compound'){?><?php echo "(";?><?php }?><?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['totalAfterDiscount'];?><?php if ($_smarty_tpl->tpl_vars['tax_details']->value['method']=='Compound'){?><?php  $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tax_details']->value['compoundon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->key => $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value){
$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxes'][$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value]['taxlabel']){?><?php echo " + ";?><?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['taxes'][$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value]['taxlabel'];?><?php }?><?php } ?><?php echo ")";?><?php }?><?php echo " = ";?><?php echo $_smarty_tpl->tpl_vars['tax_details']->value['amount'];?><?php echo "<br />";?><?php } ?><?php $_tmp18=ob_get_clean();?><?php ob_start();?><?php echo vtranslate('LBL_TOTAL_TAX_AMOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp19=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['GROUP_TAX_INFO'] = new Smarty_variable($_tmp17." = ".($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['totalAfterDiscount'])."<br /><br />".$_tmp18."<br />".$_tmp19." = ".($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['tax_totalamount']), null, 0);?>
                        (+)&nbsp;<strong><a class="inventoryLineItemDetails" tabindex="0" role="tooltip" href="javascript:void(0)" id="finalTax" data-trigger ="focus" data-placement ="left" title = "<?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" data-toggle ="popover" data-content="<?php echo $_smarty_tpl->tpl_vars['GROUP_TAX_INFO']->value;?>
"><?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></strong>
                    </div>
                </td>
                <td>
                    <div align="right">
                        <?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['tax_totalamount'];?>

                    </div>
                </td>
            </tr>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['SH_PERCENT_VIEWABLE']->value){?>
            <tr>
                <td width="83%">
                    <div align="right">
                        <?php ob_start();?><?php echo vtranslate('LBL_CHARGES_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp20=ob_get_clean();?><?php ob_start();?><?php  $_smarty_tpl->tpl_vars['CHARGE_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CHARGE_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['CHARGE_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_CHARGES_AND_ITS_TAXES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CHARGE_INFO']->key => $_smarty_tpl->tpl_vars['CHARGE_INFO']->value){
$_smarty_tpl->tpl_vars['CHARGE_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['CHARGE_ID']->value = $_smarty_tpl->tpl_vars['CHARGE_INFO']->key;
?><?php if ($_smarty_tpl->tpl_vars['CHARGE_INFO']->value['taxes']){?><?php if ($_smarty_tpl->tpl_vars['CHARGE_INFO']->value['deleted']){?><?php echo "(";?><?php echo strtoupper(vtranslate('LBL_DELETED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value));?>
<?php echo ")";?><?php }?><?php echo " ";?><?php echo $_smarty_tpl->tpl_vars['CHARGE_INFO']->value['name'];?><?php echo "<br />";?><?php  $_smarty_tpl->tpl_vars['CHARGE_TAX_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CHARGE_TAX_INFO']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['CHARGE_INFO']->value['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CHARGE_TAX_INFO']->key => $_smarty_tpl->tpl_vars['CHARGE_TAX_INFO']->value){
$_smarty_tpl->tpl_vars['CHARGE_TAX_INFO']->_loop = true;
?><?php echo "&emsp;";?><?php echo $_smarty_tpl->tpl_vars['CHARGE_TAX_INFO']->value['name'];?><?php echo ": &emsp;";?><?php echo $_smarty_tpl->tpl_vars['CHARGE_TAX_INFO']->value['percent'];?><?php echo "% ";?><?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php echo " ";?><?php if ($_smarty_tpl->tpl_vars['CHARGE_TAX_INFO']->value['method']=='Compound'){?><?php echo "(";?><?php }?><?php echo $_smarty_tpl->tpl_vars['CHARGE_INFO']->value['amount'];?><?php echo " ";?><?php if ($_smarty_tpl->tpl_vars['CHARGE_TAX_INFO']->value['method']=='Compound'){?><?php  $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['CHARGE_TAX_INFO']->value['compoundon']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->key => $_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value){
$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['CHARGE_INFO']->value['taxes'][$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value]['name']){?><?php echo " + ";?><?php echo $_smarty_tpl->tpl_vars['CHARGE_INFO']->value['taxes'][$_smarty_tpl->tpl_vars['COMPOUND_TAX_ID']->value]['name'];?><?php }?><?php } ?><?php echo ")";?><?php }?><?php echo " = ";?><?php echo $_smarty_tpl->tpl_vars['CHARGE_TAX_INFO']->value['amount'];?><?php echo "<br />";?><?php } ?><?php echo "<br />";?><?php }?><?php } ?><?php $_tmp21=ob_get_clean();?><?php ob_start();?><?php echo vtranslate('LBL_TOTAL_TAX_AMOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp22=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['CHARGES_TAX_INFO'] = new Smarty_variable($_tmp20." = ".($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value["shipping_handling_charge"])."<br /><br />".$_tmp21."\r\n".$_tmp22." = ".($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['shtax_totalamount']), null, 0);?>
                        (+)&nbsp;<strong><a class="inventoryLineItemDetails" tabindex="0" role="tooltip" title = "<?php echo vtranslate('LBL_TAXES_ON_CHARGES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" data-trigger ="focus" data-placement ="left" data-toggle="popover"  href="javascript:void(0)" id="taxesOnChargesList" data-content="<?php echo $_smarty_tpl->tpl_vars['CHARGES_TAX_INFO']->value;?>
">
                                <?php echo vtranslate('LBL_TAXES_ON_CHARGES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 </a></strong>
                    </div>
                </td>
                <td>
                    <div align="right">
                        <?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value["shtax_totalamount"];?>

                    </div>
                </td>
            </tr>
        <?php }?>
        <tr>
            <td width="83%">
                <div align="right">
                    <?php ob_start();?><?php echo vtranslate('LBL_TOTAL_AFTER_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp23=ob_get_clean();?><?php ob_start();?><?php  $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['DEDUCTED_TAX_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['deductTaxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->key => $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value){
$_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['DEDUCTED_TAX_ID']->value = $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->key;
?><?php if ($_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['selected']==true){?><?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['taxlabel'];?><?php echo ": \t";?><?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['percentage'];?><?php echo "%  = ";?><?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAX_INFO']->value['amount'];?><?php echo "\r\n";?><?php }?><?php } ?><?php $_tmp24=ob_get_clean();?><?php ob_start();?><?php echo vtranslate('LBL_DEDUCTED_TAXES_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp25=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['DEDUCTED_TAXES_INFO'] = new Smarty_variable($_tmp23." = ".($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value["totalAfterDiscount"])."<br /><br />".$_tmp24."\r\n\r\n".$_tmp25." = ".($_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['deductTaxesTotalAmount']), null, 0);?>
                    (-)&nbsp;<strong><a class="inventoryLineItemDetails" tabindex="0" role="tooltip" href="javascript:void(0)" id="deductedTaxesList" data-trigger="focus" data-toggle="popover" title = "<?php echo vtranslate('LBL_DEDUCTED_TAXES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" data-placement ="left" data-content="<?php echo $_smarty_tpl->tpl_vars['DEDUCTED_TAXES_INFO']->value;?>
">
                            <?php echo vtranslate('LBL_DEDUCTED_TAXES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 </a></strong>
                </div>
            </td>
            <td>
                <div align="right">
                    <?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value['deductTaxesTotalAmount'];?>

                </div>
            </td>
        </tr>
        <tr>
            <td width="83%">
                <div align="right">
                    <strong><?php echo vtranslate('LBL_ADJUSTMENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                </div>
            </td>
            <td>
                <div align="right">
                    <?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value["adjustment"];?>

                </div>
            </td>
        </tr>
        <tr>
            <td width="83%">
                <div align="right">
                    <strong><?php echo vtranslate('LBL_GRAND_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                </div>
            </td>
            <td>
                <div align="right">
                    <?php echo $_smarty_tpl->tpl_vars['FINAL_DETAILS']->value["grandTotal"];?>

                </div>
            </td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Invoice'||$_smarty_tpl->tpl_vars['MODULE_NAME']->value=='PurchaseOrder'){?>
            <tr>
                <td width="83%">
                    <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Invoice'){?>
                        <div align="right">
                            <strong><?php echo vtranslate('LBL_RECEIVED',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </div>
                    <?php }else{ ?>
                        <div align="right">
                            <strong><?php echo vtranslate('LBL_PAID',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </div>
                    <?php }?>
                </td>
                <td>
                    <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Invoice'){?>
                        <div align="right">
                            <?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('received')){?>
                                <?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('received');?>

                            <?php }else{ ?>
                                0
                            <?php }?>
                        </div>
                    <?php }else{ ?>
                        <div align="right">
                            <?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('paid')){?>
                                <?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('paid');?>

                            <?php }else{ ?>
                                0
                            <?php }?>
                        </div>
                    <?php }?>
                </td>
            </tr>
            <tr>
                <td width="83%">
                    <div align="right">
                        <strong><?php echo vtranslate('LBL_BALANCE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                    </div>
                </td>
                <td>
                    <div align="right">
                        <?php if ($_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('balance')){?>
                            <?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue('balance');?>

                        <?php }else{ ?>0
                        <?php }?>
                    </div>
                </td>
            </tr>
        <?php }?>
    </table>
</div><?php }} ?>