<?php /* Smarty version Smarty-3.1.7, created on 2019-02-16 15:39:12
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/PopupContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8950755085c67fd68148278-62781983%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '996669a2cac7510cc5e586a45be49fba27cad067' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/PopupContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8950755085c67fd68148278-62781983',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'PAGE_NUMBER' => 0,
    'PAGING_MODEL' => 0,
    'LISTVIEW_ENTRIES_COUNT' => 0,
    'LISTVIEW_COUNT' => 0,
    'GETURL' => 0,
    'SEARCH_DETAILS' => 0,
    'ORDER_BY' => 0,
    'SORT_ORDER' => 0,
    'SOURCE_MODULE' => 0,
    'CURRENT_USER_MODEL' => 0,
    'MULTI_SELECT' => 0,
    'WIDTHTYPE' => 0,
    'LISTVIEW_HEADERS' => 0,
    'LISTVIEW_HEADER' => 0,
    'NEXT_SORT_ORDER' => 0,
    'FASORT_IMAGE' => 0,
    'MODULE_MODEL' => 0,
    'FIELD_UI_TYPE_MODEL' => 0,
    'MODULE_NAME' => 0,
    'LISTVIEW_ENTRIES' => 0,
    'LISTVIEW_ENTRY' => 0,
    'RECORD_DATA' => 0,
    'LISTVIEW_HEADERNAME' => 0,
    'CURRENCY_SYMBOL_PLACEMENT' => 0,
    'LISTVIEW_ENTRY_VALUE' => 0,
    'MULTI_RAW_PICKLIST_VALUES' => 0,
    'MULTI_PICKLIST_VALUE' => 0,
    'MULTI_PICKLIST_INDEX' => 0,
    'MULTI_PICKLIST_VALUES' => 0,
    'IS_MODULE_DISABLED' => 0,
    'RELATED_MODULE' => 0,
    'FIELDS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c67fd6834420',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c67fd6834420')) {function content_5c67fd6834420($_smarty_tpl) {?>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("PicklistColorMap.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<div class="row"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('PopupNavigation.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><div class="row"><div class="col-md-12"><input type='hidden' id='pageNumber' value="<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
"><input type='hidden' id='pageLimit' value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
"><input type="hidden" id="noOfEntries" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
"><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" /><input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" /><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><?php if ($_smarty_tpl->tpl_vars['GETURL']->value){?><input type="hidden" id="getUrl" value="<?php echo $_smarty_tpl->tpl_vars['GETURL']->value;?>
" /><?php }?><input type="hidden" value="<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value));?>
" id="currentSearchParams" /><div class="contents-topscroll"><div class="topscroll-div">&nbsp;</div></div><div class="popupEntriesDiv relatedContents"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value=="Emails"){?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value!='Documents'){?><input type="hidden" value="Vtiger_EmailsRelatedModule_Popup_Js" id="popUpClassName"/><?php }?><?php }?><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><div class="popupEntriesTableContainer <?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='EmailTemplates'){?> emailTemplatesPopupTableContainer<?php }?>"><table class="listview-table table-bordered listViewEntriesTable"><thead><tr class="listViewHeaders"><?php if ($_smarty_tpl->tpl_vars['MULTI_SELECT']->value){?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input type="checkbox"  class="selectAllInCurrentPage" /></th><?php }elseif($_smarty_tpl->tpl_vars['MODULE']->value!='EmailTemplates'){?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
">&nbsp;</th><?php }?><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a href="javascript:void(0);" class="listViewContentHeaderValues listViewHeaderValues <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')=='listprice'){?> noSorting <?php }?>" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['ORDER_BY']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name');?>
"><?php if ($_smarty_tpl->tpl_vars['ORDER_BY']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')){?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php }else{ ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a></th><?php } ?></tr></thead><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value&&$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isQuickSearchEnabled()){?><tr class="searchRow"><td class="textAlignCenter"><button class="btn btn-success" data-trigger="PopupListSearch"><?php echo vtranslate('LBL_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></td><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
?><td><?php $_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getUITypeModel(), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()],'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0);?>
</td><?php } ?></tr><?php }?><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['popupListView']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['popupListView']['index']++;
?><?php $_smarty_tpl->tpl_vars["RECORD_DATA"] = new Smarty_variable(($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRawData()), null, 0);?><tr class="listViewEntries" data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='EmailTemplates'){?> data-name="<?php echo $_smarty_tpl->tpl_vars['RECORD_DATA']->value['subject'];?>
" data-info="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('body');?>
" <?php }else{ ?> data-name="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getName();?>
" data-info='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRawData()));?>
' <?php }?><?php if ($_smarty_tpl->tpl_vars['GETURL']->value!=''){?> data-url='<?php $_tmp1=$_smarty_tpl->tpl_vars['GETURL']->value;?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->$_tmp1();?>
' <?php }?>  id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_popUpListView_row_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['popupListView']['index']+1;?>
"><?php if ($_smarty_tpl->tpl_vars['MULTI_SELECT']->value){?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input class="entryCheckBox" type="checkbox" /></td><?php }elseif($_smarty_tpl->tpl_vars['MODULE']->value!='EmailTemplates'){?><td></td><?php }?><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name'), null, 0);?><?php $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value), null, 0);?><td class="listViewEntryValue value textOverflowEllipsis <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['RECORD_DATA']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value];?>
"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->isNameField()==true||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('uitype')=='4'){?><a><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('uitype')=='72'){?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('currency_symbol_placement');?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL_PLACEMENT'] = new Smarty_variable($_tmp2, null, 0);?><?php if ($_smarty_tpl->tpl_vars['CURRENCY_SYMBOL_PLACEMENT']->value=='1.0$'){?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('currencySymbol');?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('currencySymbol');?>
<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
<?php }?><?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value=='listprice'){?><?php echo CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value),null,true,true);?>
<?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getFieldDataType()=='picklist'){?><span <?php if (!empty($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value)){?> class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRaw($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value));?>
" <?php }?>> <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value;?>
 </span><?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getFieldDataType()=='multipicklist'){?><?php $_smarty_tpl->tpl_vars['MULTI_RAW_PICKLIST_VALUES'] = new Smarty_variable(explode('|##|',$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRaw($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value)), null, 0);?><?php $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES'] = new Smarty_variable(explode(',',$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value), null, 0);?><?php  $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MULTI_RAW_PICKLIST_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->key => $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->value){
$_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value = $_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->key;
?><span <?php if (!empty($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE']->value)){?> class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen(trim($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUE']->value));?>
" <?php }?>> <?php echo trim($_smarty_tpl->tpl_vars['MULTI_PICKLIST_VALUES']->value[$_smarty_tpl->tpl_vars['MULTI_PICKLIST_INDEX']->value]);?>
 </span><?php } ?><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
<?php }?></td><?php } ?></tr><?php } ?></table></div><!--added this div for Temporarily --><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value=='0'){?><div class="row"><div class="emptyRecordsDiv"><?php if ($_smarty_tpl->tpl_vars['IS_MODULE_DISABLED']->value=='true'){?><?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
<?php echo vtranslate('LBL_MODULE_DISABLED',$_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND',$_smarty_tpl->tpl_vars['MODULE']->value);?>
.<?php }?></div></div><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value!=null){?><script type="text/javascript">var popup_uimeta = (function() {var fieldInfo  = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;return {field: {get: function(name, property) {if(name && property === undefined) {return fieldInfo[name];}if(name && property) {return fieldInfo[name][property]}},isMandatory : function(name){if(fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType : function(name){if(fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();</script><?php }?></div></div></div>
<?php }} ?>