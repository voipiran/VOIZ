<?php /* Smarty version Smarty-3.1.7, created on 2019-02-24 09:20:23
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Inventory/PopupEntries.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1015909205c72309f9b3839-86270000%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6df479d3bb2f2a15978e9c160d828bc18f346d57' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Inventory/PopupEntries.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1015909205c72309f9b3839-86270000',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PAGE_NUMBER' => 0,
    'PAGING_MODEL' => 0,
    'LISTVIEW_ENTRIES_COUNT' => 0,
    'VIEW' => 0,
    'LISTVIEW_COUNT' => 0,
    'SEARCH_DETAILS' => 0,
    'SUBPRODUCTS_POPUP' => 0,
    'PARENT_PRODUCT_ID' => 0,
    'ORDER_BY' => 0,
    'SORT_ORDER' => 0,
    'CURRENT_USER_MODEL' => 0,
    'MULTI_SELECT' => 0,
    'WIDTHTYPE' => 0,
    'LISTVIEW_HEADERS' => 0,
    'LISTVIEW_HEADER' => 0,
    'NEXT_SORT_ORDER' => 0,
    'FASORT_IMAGE' => 0,
    'TARGET_MODULE' => 0,
    'RELATED_MODULE' => 0,
    'MODULE_MODEL' => 0,
    'MODULE' => 0,
    'FIELD_UI_TYPE_MODEL' => 0,
    'MODULE_NAME' => 0,
    'LISTVIEW_ENTRIES' => 0,
    'LISTVIEW_ENTRY' => 0,
    'GETURL' => 0,
    'SOURCE_MODULE' => 0,
    'LISTVIEW_HEADERNAME' => 0,
    'RECORD_DATA' => 0,
    'CURRENCY_SYMBOL_PLACEMENT' => 0,
    'IS_MODULE_DISABLED' => 0,
    'FIELDS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c72309fb6a30',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c72309fb6a30')) {function content_5c72309fb6a30($_smarty_tpl) {?>


<input type='hidden' id='pageNumber' value="<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
"><input type='hidden' id='pageLimit' value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
"><input type="hidden" id="noOfEntries" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
"><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" /><input type="hidden" id="view" value="<?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>
"/><input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" /><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><input type="hidden" value="<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value));?>
" id="currentSearchParams" /><?php if ((!empty($_smarty_tpl->tpl_vars['SUBPRODUCTS_POPUP']->value))&&(!empty($_smarty_tpl->tpl_vars['PARENT_PRODUCT_ID']->value))){?><input type="hidden" id="subProductsPopup" value="<?php echo $_smarty_tpl->tpl_vars['SUBPRODUCTS_POPUP']->value;?>
" /><input type="hidden" id="parentProductId" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_PRODUCT_ID']->value;?>
" /><?php }?><div class="contents-topscroll"><div class="topscroll-div">&nbsp;</div></div><div class="popupEntriesDiv relatedContents contents-bottomscroll"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type="hidden" value="Inventory_Popup_Js" id="popUpClassName"/><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><div class="bottomscroll-div"><table class="listview-table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><?php if ($_smarty_tpl->tpl_vars['MULTI_SELECT']->value){?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input type="checkbox"  class="selectAllInCurrentPage" /></th><?php }else{ ?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
">&nbsp;</th><?php }?><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a href="javascript:void(0);" class="listViewContentHeaderValues listViewHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['ORDER_BY']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column');?>
"><?php if ($_smarty_tpl->tpl_vars['ORDER_BY']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')){?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php }else{ ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['TARGET_MODULE']->value);?>
&nbsp;</a></th><?php } ?><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value=='Products'){?><th></th><?php }?></tr></thead><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value&&$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isQuickSearchEnabled()){?><tr class="searchRow"><td class="searchBtn textAlignCenter"><button class="btn btn-success" data-trigger="PopupListSearch"><?php echo vtranslate('LBL_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></td><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
?><td><?php $_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getUITypeModel(), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()],'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0);?>
</td><?php } ?><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value=='Products'){?><td></td><?php }?></tr><?php }?><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['popupListView']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['popupListView']['index']++;
?><?php $_smarty_tpl->tpl_vars["RECORD_DATA"] = new Smarty_variable(($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRawData()), null, 0);?><tr class="listViewEntries" data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" data-name='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getName();?>
' data-info='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRawData()));?>
'<?php if ($_smarty_tpl->tpl_vars['GETURL']->value!=''){?> data-url="<?php $_tmp1=$_smarty_tpl->tpl_vars['GETURL']->value;?><?php echo (($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->$_tmp1()).('&sourceModule=')).($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
" <?php }?>  id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_popUpListView_row_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['popupListView']['index']+1;?>
"><?php if ($_smarty_tpl->tpl_vars['MULTI_SELECT']->value){?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input class="entryCheckBox" type="checkbox" /></td><?php }else{ ?><td></td><?php }?><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name'), null, 0);?><td class="listViewEntryValue textOverflowEllipsis <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['RECORD_DATA']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value];?>
"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->isNameField()==true||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('uitype')=='4'){?><a><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('uitype')=='72'){?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_symbol_placement');?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL_PLACEMENT'] = new Smarty_variable($_tmp2, null, 0);?><?php if ($_smarty_tpl->tpl_vars['CURRENCY_SYMBOL_PLACEMENT']->value=='1.0$'){?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('currencySymbol');?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('currencySymbol');?>
<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
<?php }?><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
<?php }?></td><?php } ?><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE']->value=='Products'){?><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('subProducts')==true){?><a class="subproducts"><b><?php echo vtranslate('LBL_SUB_PRODUCTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</b></a><!--<img class="lineItemPopup cursorPointer alignMiddle" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid" src="<?php echo vimage_path('Products.png');?>
"/>--><?php }else{ ?><?php echo vtranslate('NOT_A_BUNDLE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php }?></td><?php }?></tr><?php } ?></table><!--added this div for Temporarily --><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value=='0'){?><?php if ($_smarty_tpl->tpl_vars['IS_MODULE_DISABLED']->value=='true'){?><div class="emptyRecordsDiv"><?php echo vtranslate('LBL_PRODUCTSMOD_DISABLED',$_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
.</div><?php }else{ ?><div class="emptyRecordsDiv"><?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND',$_smarty_tpl->tpl_vars['MODULE']->value);?>
.</div><?php }?><?php }?></div></div><?php if ((!empty($_smarty_tpl->tpl_vars['SUBPRODUCTS_POPUP']->value))&&(!empty($_smarty_tpl->tpl_vars['PARENT_PRODUCT_ID']->value))){?><div style="margin-top: 10px; height:50px"><div class="pull-right"><button type="button" class="btn btn-default" id="backToProducts"><strong><?php echo vtranslate('LBL_BACK_TO_PRODUCTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div></div><?php }?><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value!=null){?><script type="text/javascript">var popup_uimeta = (function() {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function(name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function(name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function(name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();</script><?php }?>
<?php }} ?>