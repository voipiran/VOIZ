<?php /* Smarty version Smarty-3.1.7, created on 2018-11-21 10:11:01
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/RelatedList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4346230955bf4fdfdb0baa0-02305257%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '61ec50458523d5f69b5b8f084052629ba944f4d8' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/RelatedList.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4346230955bf4fdfdb0baa0-02305257',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RELATED_MODULE' => 0,
    'MODULE' => 0,
    'RELATED_HEADERS' => 0,
    'RELATION_FIELD' => 0,
    'PAGING' => 0,
    'RELATED_MODULE_NAME' => 0,
    'ORDER_BY' => 0,
    'SORT_ORDER' => 0,
    'RELATED_ENTIRES_COUNT' => 0,
    'TOTAL_ENTRIES' => 0,
    'TAB_LABEL' => 0,
    'IS_RELATION_FIELD_ACTIVE' => 0,
    'RELATED_LIST_LINKS' => 0,
    'PARENT_RECORD' => 0,
    'IS_VIEWABLE' => 0,
    'HEADER_FIELD' => 0,
    'COLUMN_NAME' => 0,
    'NEXT_SORT_ORDER' => 0,
    'FASORT_IMAGE' => 0,
    'SORT_IMAGE' => 0,
    'FIELD_UI_TYPE_MODEL' => 0,
    'SEARCH_DETAILS' => 0,
    'USER_MODEL' => 0,
    'RELATED_RECORDS' => 0,
    'RELATED_RECORD' => 0,
    'DETAILVIEWPERMITTED' => 0,
    'IS_EDITABLE' => 0,
    'LISTPRICE' => 0,
    'quantity' => 0,
    'IS_DELETABLE' => 0,
    'RELATED_HEADERNAME' => 0,
    'CURRENCY_SYMBOL' => 0,
    'CURRENCY_VALUE' => 0,
    'EVENT_STATUS_FIELD_MODEL' => 0,
    'RELATED_LIST_VALUE' => 0,
    'PICKLIST_FIELD_ID' => 0,
    'RECORD_ID' => 0,
    'DOCUMENT_RECORD_MODEL' => 0,
    'RELATED_FIELDS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bf4fdfded600',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bf4fdfded600')) {function content_5bf4fdfded600($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("PicklistColorMap.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('LISTVIEW_HEADERS'=>$_smarty_tpl->tpl_vars['RELATED_HEADERS']->value), 0);?>
<div class="relatedContainer"><?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value){?><?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->isActiveField();?><?php }else{ ?><?php echo "false";?><?php }?><?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['IS_RELATION_FIELD_ACTIVE'] = new Smarty_variable($_tmp1, null, 0);?><input type="hidden" name="currentPageNum" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getCurrentPage();?>
" /><input type="hidden" name="relatedModuleName" class="relatedModuleName" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_ENTIRES_COUNT']->value;?>
" id="noOfEntries"><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getPageLimit();?>
" id='pageLimit'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->get('page');?>
" id='pageNumber'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->isNextPageExists();?>
" id="nextPageExist"/><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['TOTAL_ENTRIES']->value;?>
" id='totalCount'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['TAB_LABEL']->value;?>
" id='tab_label' name='tab_label'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['IS_RELATION_FIELD_ACTIVE']->value;?>
" id='isRelationFieldActive'><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("partials/RelatedListHeader.tpl",$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='Products'&&$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value=='Products'&&$_smarty_tpl->tpl_vars['TAB_LABEL']->value==='Product Bundles'&&$_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value){?><div data-module="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" style = "margin-left:20px"><?php $_smarty_tpl->tpl_vars['IS_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['PARENT_RECORD']->value->isBundleViewable(), null, 0);?><input type="hidden" class="isShowBundles" value="<?php echo $_smarty_tpl->tpl_vars['IS_VIEWABLE']->value;?>
"><label class="showBundlesInInventory checkbox"><input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['IS_VIEWABLE']->value){?>checked<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['IS_VIEWABLE']->value;?>
">&nbsp;&nbsp;<?php echo vtranslate('LBL_SHOW_BUNDLE_IN_INVENTORY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><?php }?><div class="relatedContents col-lg-12 col-md-12 col-sm-12 table-container"><div class="bottomscroll-div"><table id="listview-table" class="table listview-table"><thead><tr class="listViewHeaders"><th style="min-width:100px"></th><?php  $_smarty_tpl->tpl_vars['HEADER_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->key => $_smarty_tpl->tpl_vars['HEADER_FIELD']->value){
$_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')=='time_start'||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')=='time_end'){?><th class="nowrap" style="width:15px"><?php }else{ ?><th class="nowrap"><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')=="access_count"||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')=="idlists"){?><a href="javascript:void(0);" class="noSorting"><?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</a><?php }else{ ?><a href="javascript:void(0);" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column');?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php }else{ ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
"><?php }?>&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?><?php }?><?php }?></th><?php } ?></tr><tr class="searchRow"><th class="inline-search-btn"><button class="btn btn-success btn-sm" data-trigger="relatedListSearch"><?php echo vtranslate("LBL_SEARCH",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></th><?php  $_smarty_tpl->tpl_vars['HEADER_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->key => $_smarty_tpl->tpl_vars['HEADER_FIELD']->value){
$_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = true;
?><th><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')=='time_start'||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')=='time_end'||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType()=='reference'){?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getUITypeModel(), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['HEADER_FIELD']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getName()],'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value), 0);?>
<input type="hidden" class="operatorValue" value="<?php echo $_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getName()]['comparator'];?>
"><?php }?></th><?php } ?></tr></thead><?php  $_smarty_tpl->tpl_vars['RELATED_RECORD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_RECORD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_RECORDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_RECORD']->key => $_smarty_tpl->tpl_vars['RELATED_RECORD']->value){
$_smarty_tpl->tpl_vars['RELATED_RECORD']->_loop = true;
?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
'<?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value=='Calendar'){?>data-recurring-enabled='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->isRecurringEnabled();?>
'<?php $_smarty_tpl->tpl_vars['DETAILVIEWPERMITTED'] = new Smarty_variable(isPermitted($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,'DetailView',$_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId()), null, 0);?><?php if ($_smarty_tpl->tpl_vars['DETAILVIEWPERMITTED']->value=='yes'){?>data-recordUrl='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
'<?php }?><?php }else{ ?>data-recordUrl='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
'<?php }?>><td class="related-list-actions"><span class="actionImages">&nbsp;&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_EDITABLE']->value&&$_smarty_tpl->tpl_vars['RELATED_RECORD']->value->isEditable()){?><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value=='PriceBooks'&&(!empty($_smarty_tpl->tpl_vars['RELATED_HEADERS']->value['listprice'])||!empty($_smarty_tpl->tpl_vars['RELATED_HEADERS']->value['unit_price']))){?><?php if (!empty($_smarty_tpl->tpl_vars['RELATED_HEADERS']->value['listprice'])){?><?php $_smarty_tpl->tpl_vars["LISTPRICE"] = new Smarty_variable(CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('listprice'),null,true), null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value=='PriceBooks'){?><a data-url="index.php?module=PriceBooks&view=ListPriceUpdate&record=<?php echo $_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId();?>
&relid=<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
&currentPrice=<?php echo $_smarty_tpl->tpl_vars['LISTPRICE']->value;?>
"class="editListPrice cursorPointer" data-related-recordid='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
' data-list-price=<?php echo $_smarty_tpl->tpl_vars['LISTPRICE']->value;?>
<?php }elseif($_smarty_tpl->tpl_vars['MODULE']->value=='Products'&&$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value=='Products'&&$_smarty_tpl->tpl_vars['TAB_LABEL']->value==='Product Bundles'&&$_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value&&$_smarty_tpl->tpl_vars['PARENT_RECORD']->value->isBundle()){?><?php $_smarty_tpl->tpl_vars['quantity'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATION_FIELD']->value->getName()), null, 0);?><a class="quantityEdit"data-url="index.php?module=Products&view=SubProductQuantityUpdate&record=<?php echo $_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId();?>
&relid=<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
&currentQty=<?php echo $_smarty_tpl->tpl_vars['quantity']->value;?>
"onclick ="Products_Detail_Js.triggerEditQuantity('index.php?module=Products&view=SubProductQuantityUpdate&record=<?php echo $_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId();?>
&relid=<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
&currentQty=<?php echo $_smarty_tpl->tpl_vars['quantity']->value;?>
');if(event.stopPropagation){event.stopPropagation();}else{event.cancelBubble=true;}"<?php }else{ ?><a name="relationEdit" data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getEditViewUrl();?>
"<?php }?>><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></a> &nbsp;&nbsp;<?php }?><?php if ($_smarty_tpl->tpl_vars['IS_DELETABLE']->value){?><a class="relationDelete"><i title="<?php echo vtranslate('LBL_UNLINK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="vicon-linkopen"></i></a><?php }?></span></td><?php  $_smarty_tpl->tpl_vars['HEADER_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->key => $_smarty_tpl->tpl_vars['HEADER_FIELD']->value){
$_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['RELATED_HEADERNAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('name'), null, 0);?><?php $_smarty_tpl->tpl_vars['RELATED_LIST_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value), null, 0);?><td class="relatedListEntryValues" title="<?php echo strip_tags($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value));?>
" data-field-type="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType();?>
" nowrap><span class="value textOverflowEllipsis"><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value=='Documents'&&$_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='document_source'){?><center><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
</center><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->isNameField()==true||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype')=='4'){?><a href="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='access_count'){?><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getAccessCountValue($_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId());?>
<?php }elseif($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='time_start'||$_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='time_end'){?><?php }elseif($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value=='PriceBooks'&&($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='listprice'||$_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='unit_price')){?><?php if ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='listprice'){?><?php $_smarty_tpl->tpl_vars["LISTPRICE"] = new Smarty_variable(CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value),null,true), null, 0);?><?php }?><?php echo CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value),null,true);?>
<?php }elseif($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype')=='71'||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype')=='72'){?><?php $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL'] = new Smarty_variable(Vtiger_RelationListView_Model::getCurrencySymbol($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('id'),$_smarty_tpl->tpl_vars['HEADER_FIELD']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['CURRENCY_VALUE'] = new Smarty_variable(CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value)), null, 0);?><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype')=='72'){?><?php $_smarty_tpl->tpl_vars['CURRENCY_VALUE'] = new Smarty_variable(CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value),null,true), null, 0);?><?php }?><?php if (Users_Record_Model::getCurrentUserModel()->get('currency_symbol_placement')=='$1.0'){?><?php echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['CURRENCY_VALUE']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['CURRENCY_VALUE']->value;?>
<?php echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='listprice'){?><?php $_smarty_tpl->tpl_vars["LISTPRICE"] = new Smarty_variable(CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value),null,true), null, 0);?><?php }?><?php }elseif($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType()=='picklist'){?><?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value=='Calendar'||$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value=='Events'){?><?php if ($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('activitytype')=='Task'){?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['PICKLIST_FIELD_ID'] = new Smarty_variable($_tmp2, null, 0);?><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getName()=='taskstatus'){?><?php $_smarty_tpl->tpl_vars["EVENT_STATUS_FIELD_MODEL"] = new Smarty_variable(Vtiger_Field_Model::getInstance('eventstatus',Vtiger_Module_Model::getInstance('Events')), null, 0);?><?php if ($_smarty_tpl->tpl_vars['EVENT_STATUS_FIELD_MODEL']->value){?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['EVENT_STATUS_FIELD_MODEL']->value->getId();?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['PICKLIST_FIELD_ID'] = new Smarty_variable($_tmp3, null, 0);?><?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();?>
<?php $_tmp4=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['PICKLIST_FIELD_ID'] = new Smarty_variable($_tmp4, null, 0);?><?php }?><?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();?>
<?php $_tmp5=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['PICKLIST_FIELD_ID'] = new Smarty_variable($_tmp5, null, 0);?><?php }?><?php }?><?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();?>
<?php $_tmp6=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['PICKLIST_FIELD_ID'] = new Smarty_variable($_tmp6, null, 0);?><?php }?><span <?php if (!empty($_smarty_tpl->tpl_vars['RELATED_LIST_VALUE']->value)){?> class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['PICKLIST_FIELD_ID']->value;?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['RELATED_LIST_VALUE']->value);?>
" <?php }?>> <?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
 </span><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
<?php if ($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value=='Documents'&&$_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='filename'&&isPermitted($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,'DetailView',$_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId())=='yes'){?><span class="actionImages"><?php $_smarty_tpl->tpl_vars['RECORD_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId(), null, 0);?><?php $_smarty_tpl->tpl_vars["DOCUMENT_RECORD_MODEL"] = new Smarty_variable(Vtiger_Record_Model::getInstanceById($_smarty_tpl->tpl_vars['RECORD_ID']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename')&&$_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filestatus')){?><a name="viewfile" href="javascript:void(0)" data-filelocationtype="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filelocationtype');?>
" data-filename="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename');?>
" onclick="Vtiger_Header_Js.previewFile(event)"><i title="<?php echo vtranslate('LBL_VIEW_FILE',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
" class="icon-picture alignMiddle"></i></a>&nbsp;<?php }?><?php if ($_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename')&&$_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filestatus')&&$_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filelocationtype')=='I'){?><a name="downloadfile" href="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->getDownloadFileURL();?>
"><i title="<?php echo vtranslate('LBL_DOWNLOAD_FILE',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
" class="icon-download-alt alignMiddle"></i></a>&nbsp;<?php }?></span><?php }?><?php }?><?php }?></span></td><?php } ?></tr><?php } ?></table></div></div><script type="text/javascript">var related_uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['RELATED_FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}}};})();</script></div><?php }} ?>