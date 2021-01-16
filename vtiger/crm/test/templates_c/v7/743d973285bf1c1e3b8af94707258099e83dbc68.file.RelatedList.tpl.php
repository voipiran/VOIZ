<?php /* Smarty version Smarty-3.1.7, created on 2018-11-28 16:14:50
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Campaigns/RelatedList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9506596285bfe8dc2ef5ed0-25493398%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '743d973285bf1c1e3b8af94707258099e83dbc68' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Campaigns/RelatedList.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9506596285bfe8dc2ef5ed0-25493398',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CUSTOM_VIEWS' => 0,
    'MODULE' => 0,
    'RELATED_HEADERS' => 0,
    'RELATED_MODULE' => 0,
    'RELATION_FIELD' => 0,
    'VIEW' => 0,
    'PAGING' => 0,
    'RELATED_MODULE_NAME' => 0,
    'ORDER_BY' => 0,
    'SORT_ORDER' => 0,
    'RELATED_ENTIRES_COUNT' => 0,
    'SELECTED_IDS' => 0,
    'EXCLUDED_IDS' => 0,
    'TOTAL_ENTRIES' => 0,
    'TAB_LABEL' => 0,
    'IS_RELATION_FIELD_ACTIVE' => 0,
    'RELATED_LIST_LINKS' => 0,
    'RELATED_LINK' => 0,
    'DROPDOWNS' => 0,
    'DROPDOWN' => 0,
    'IS_SELECT_BUTTON' => 0,
    'IS_SEND_EMAIL_BUTTON' => 0,
    'GROUP_LABEL' => 0,
    'GROUP_CUSTOM_VIEWS' => 0,
    'CUSTOM_VIEW' => 0,
    'RELATED_RECORDS' => 0,
    'USER_MODEL' => 0,
    'COLUMN_NAME' => 0,
    'HEADER_FIELD' => 0,
    'NEXT_SORT_ORDER' => 0,
    'FASORT_IMAGE' => 0,
    'SORT_IMAGE' => 0,
    'FIELD_UI_TYPE_MODEL' => 0,
    'SEARCH_DETAILS' => 0,
    'RELATED_RECORD' => 0,
    'WIDTHTYPE' => 0,
    'IS_DELETABLE' => 0,
    'RELATED_HEADERNAME' => 0,
    'CURRENCY_SYMBOL' => 0,
    'CURRENCY_VALUE' => 0,
    'RELATED_LIST_VALUE' => 0,
    'STATUS_VALUES' => 0,
    'STATUS_ID' => 0,
    'STATUS' => 0,
    'RELATED_FIELDS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfe8dc32a98d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfe8dc32a98d')) {function content_5bfe8dc32a98d($_smarty_tpl) {?>
<?php if (!empty($_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value)){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("PicklistColorMap.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('LISTVIEW_HEADERS'=>$_smarty_tpl->tpl_vars['RELATED_HEADERS']->value), 0);?>
<div class="relatedContainer"><?php $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'), null, 0);?><?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value){?><?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->isActiveField();?><?php }else{ ?><?php echo "false";?><?php }?><?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['IS_RELATION_FIELD_ACTIVE'] = new Smarty_variable($_tmp1, null, 0);?><input type="hidden" name="emailEnabledModules" value=true /><input type="hidden" id="view" value="<?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>
" /><input type="hidden" name="currentPageNum" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getCurrentPage();?>
" /><input type="hidden" name="relatedModuleName" class="relatedModuleName" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_ENTIRES_COUNT']->value;?>
" id="noOfEntries"><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getPageLimit();?>
" id='pageLimit'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->get('page');?>
" id='pageNumber'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->isNextPageExists();?>
" id="nextPageExist"/><input type="hidden" id="selectedIds" name="selectedIds" data-selected-ids=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_IDS']->value);?>
 /><input type="hidden" id="excludedIds" name="excludedIds" data-excluded-ids=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['EXCLUDED_IDS']->value);?>
 /><input type="hidden" id="recordsCount" name="recordsCount" /><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['TOTAL_ENTRIES']->value;?>
" id='totalCount'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['TAB_LABEL']->value;?>
" id='tab_label' name='tab_label'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['IS_RELATION_FIELD_ACTIVE']->value;?>
" id='isRelationFieldActive'><div class="relatedHeader"><div class="btn-toolbar row"><div class="col-lg-5 col-md-5 col-sm-5 btn-toolbar"><?php  $_smarty_tpl->tpl_vars['RELATED_LINK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_LINK']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value['LISTVIEWBASIC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_LINK']->key => $_smarty_tpl->tpl_vars['RELATED_LINK']->value){
$_smarty_tpl->tpl_vars['RELATED_LINK']->_loop = true;
?><div class="btn-group"><?php $_smarty_tpl->tpl_vars['DROPDOWNS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkdropdowns'), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['DROPDOWNS']->value)>0){?><div class="btn-group"><a class="btn dropdown-toggle" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200" data-close-others="false" style="width:20px;height:18px;"><img title="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
" alt="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
" src="<?php echo vimage_path(($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getIcon()));?>
"></a><ul class="dropdown-menu"><?php  $_smarty_tpl->tpl_vars['DROPDOWN'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DROPDOWN']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DROPDOWNS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DROPDOWN']->key => $_smarty_tpl->tpl_vars['DROPDOWN']->value){
$_smarty_tpl->tpl_vars['DROPDOWN']->_loop = true;
?><li><a id="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
_relatedlistView_add_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['DROPDOWN']->value['label']);?>
" class="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkclass');?>
" href='javascript:void(0)' data-documentType="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['type'];?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['url'];?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" data-firsttime="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['firsttime'];?>
"><i class="icon-plus"></i>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['DROPDOWN']->value['label'],$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</a></li><?php } ?></ul></div><?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_sendEmail');?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON'] = new Smarty_variable($_tmp2, null, 0);?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_selectRelation');?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['IS_SELECT_BUTTON'] = new Smarty_variable($_tmp3, null, 0);?><button type="button" module="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
"  class="btn addButton btn-default<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value==true){?> selectRelation <?php }?> <?php if ($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value==true){?> sendEmail <?php }?>"<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value==true){?> data-moduleName="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_module')->get('name');?>
"<?php }?><?php if (($_smarty_tpl->tpl_vars['RELATED_LINK']->value->isPageLoadLink())){?><?php if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value){?> data-name="<?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->getName();?>
" <?php }?><?php if ($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value!=true){?>data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
"<?php }?><?php }elseif($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value==true){?>onclick="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
"<?php }?><?php if (($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value!=true)&&($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value!=true)){?>name="addButton"<?php }?><?php if ($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value==true){?> disabled="disabled" <?php }?>><?php if (($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value!=true)&&($_smarty_tpl->tpl_vars['IS_SEND_EMAIL_BUTTON']->value!=true)){?><i class="fa fa-plus"></i><?php }?>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
</button><?php }?></div><?php } ?>&nbsp;</div><div class='col-lg-4 col-md-4 col-sm-4'><span class="customFilterMainSpan"><?php if (count($_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value)>0){?><select id="recordsFilter" class="select2 col-lg-8" data-placeholder="<?php echo vtranslate('LBL_SELECT_TO_LOAD_LIST',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
"><option></option><?php  $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->_loop = false;
 $_smarty_tpl->tpl_vars['GROUP_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CUSTOM_VIEWS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->key => $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value){
$_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->_loop = true;
 $_smarty_tpl->tpl_vars['GROUP_LABEL']->value = $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->key;
?><optgroup label=' <?php if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value=='Mine'){?> &nbsp; <?php }else{ ?> <?php echo vtranslate($_smarty_tpl->tpl_vars['GROUP_LABEL']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
 <?php }?>' ><?php  $_smarty_tpl->tpl_vars["CUSTOM_VIEW"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['GROUP_CUSTOM_VIEWS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->key => $_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->value){
$_smarty_tpl->tpl_vars["CUSTOM_VIEW"]->_loop = true;
?><option id="filterOptionId_<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('cvid');?>
" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('cvid');?>
" class="filterOptionId_<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('cvid');?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('cvid');?>
"><?php if ($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname')=='All'){?><?php echo vtranslate($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->get('viewname'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value!='Mine'){?> [ <?php echo $_smarty_tpl->tpl_vars['CUSTOM_VIEW']->value->getOwnerName();?>
 ] <?php }?></option><?php } ?></optgroup><?php } ?></select><?php }else{ ?><input type="hidden" value="0" id="customFilter" /><?php }?></span></div><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_ACTION'] = new Smarty_variable('relatedViewActions', null, 0);?><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_PAGING_INPUT'] = new Smarty_variable('relatedViewPagingInput', null, 0);?><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_PAGING_INPUT_SUBMIT'] = new Smarty_variable('relatedViewPagingInputSubmit', null, 0);?><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_BASIC_ACTION'] = new Smarty_variable('relatedViewBasicAction', null, 0);?><?php $_smarty_tpl->tpl_vars['PAGING_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['PAGING']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['RECORD_COUNT'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['RELATED_RECORDS']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['PAGE_NUMBER'] = new Smarty_variable($_smarty_tpl->tpl_vars['PAGING']->value->get('page'), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('SHOWPAGEJUMP'=>true), 0);?>
</div></div><div class='col-lg-12 col-md-12 col-sm-12'><?php $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'), null, 0);?><div class="hide messageContainer" style = "height:30px;"><center><a id="selectAllMsgDiv" href="#"><?php echo vtranslate('LBL_SELECT_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
&nbsp;(<span id="totalRecordsCount" value=""></span>)</a></center></div><div class="hide messageContainer" style = "height:30px;"><center><a id="deSelectAllMsgDiv" href="#"><?php echo vtranslate('LBL_DESELECT_ALL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></div><div class="relatedContents col-lg-12 col-md-12 col-sm-12 table-container"><div class="bottomscroll-div"><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('rowheight'), null, 0);?><table id="listview-table"  class="table listview-table"><thead><tr class="listViewHeaders"><th width="4%" style="padding-left: 12px;"><input type="checkbox" id="listViewEntriesMainCheckBox"/></th><th style="min-width:100px"></th><?php  $_smarty_tpl->tpl_vars['HEADER_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->key => $_smarty_tpl->tpl_vars['HEADER_FIELD']->value){
$_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = true;
?><th class="nowrap"><a href="javascript:void(0);" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column');?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php }else{ ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
"><?php }?>&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th><?php } ?><th class="nowrap"><a href="javascript:void(0);" class="listViewContentHeaderValues noSorting"><?php echo vtranslate('Status',$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</a></th></tr><tr class="searchRow"><th></th><th class="inline-search-btn"><button class="btn btn-success btn-sm" data-trigger="relatedListSearch"><?php echo vtranslate("LBL_SEARCH",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></th><?php  $_smarty_tpl->tpl_vars['HEADER_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->key => $_smarty_tpl->tpl_vars['HEADER_FIELD']->value){
$_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = true;
?><th><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')=='time_start'||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')=='time_end'||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType()=='reference'){?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getUITypeModel(), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['HEADER_FIELD']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getName()],'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value), 0);?>
<input type="hidden" class="operatorValue" value="<?php echo $_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getName()]['comparator'];?>
"><?php }?></th><?php } ?><th></th></tr></thead><?php  $_smarty_tpl->tpl_vars['RELATED_RECORD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_RECORD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_RECORDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_RECORD']->key => $_smarty_tpl->tpl_vars['RELATED_RECORD']->value){
$_smarty_tpl->tpl_vars['RELATED_RECORD']->_loop = true;
?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
' data-recordUrl='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
'><td width="4%" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
" class="listViewEntriesCheckBox"/></td><td style="width:100px"><span class="actionImages"><a name="relationEdit" data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getEditViewUrl();?>
" href="javascript:void(0)"><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-pencil"></i></a> &nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_DELETABLE']->value){?><a class="relationDelete"><i title="<?php echo vtranslate('LBL_UNLINK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="vicon-linkopen"></i></a><?php }?></span></td><?php  $_smarty_tpl->tpl_vars['HEADER_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->key => $_smarty_tpl->tpl_vars['HEADER_FIELD']->value){
$_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['RELATED_HEADERNAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('name'), null, 0);?><?php $_smarty_tpl->tpl_vars['RELATED_LIST_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value), null, 0);?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
 relatedListEntryValues" data-field-type="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType();?>
" nowrap><span class="value textOverflowEllipsis"><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->isNameField()==true||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype')=='4'){?><a href="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype')=='71'||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype')=='72'){?><?php $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL'] = new Smarty_variable(Vtiger_RelationListView_Model::getCurrencySymbol($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('id'),$_smarty_tpl->tpl_vars['HEADER_FIELD']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['CURRENCY_VALUE'] = new Smarty_variable(CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value)), null, 0);?><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype')=='72'){?><?php $_smarty_tpl->tpl_vars['CURRENCY_VALUE'] = new Smarty_variable(CurrencyField::convertToUserFormat($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value),null,true), null, 0);?><?php }?><?php if (Users_Record_Model::getCurrentUserModel()->get('currency_symbol_placement')=='$1.0'){?><?php echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;?>
<?php echo $_smarty_tpl->tpl_vars['CURRENCY_VALUE']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['CURRENCY_VALUE']->value;?>
<?php echo $_smarty_tpl->tpl_vars['CURRENCY_SYMBOL']->value;?>
<?php }?><?php }elseif($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType()=='picklist'){?><span <?php if (!empty($_smarty_tpl->tpl_vars['RELATED_LIST_VALUE']->value)){?> class="picklist-color picklist-<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getId();?>
-<?php echo Vtiger_Util_Helper::convertSpaceToHyphen($_smarty_tpl->tpl_vars['RELATED_LIST_VALUE']->value);?>
" <?php }?>> <?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
 </span><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
<?php }?></span></td><?php } ?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap><span class="currentStatus more dropdown action"><span class="statusValue dropdown-toggle" data-toggle="dropdown"><?php echo vtranslate($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('status'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</span><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-arrow-down alignMiddle editRelatedStatus"></i></a><ul class="dropdown-menu dropdown-menu-right"><?php  $_smarty_tpl->tpl_vars['STATUS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['STATUS']->_loop = false;
 $_smarty_tpl->tpl_vars['STATUS_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['STATUS_VALUES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['STATUS']->key => $_smarty_tpl->tpl_vars['STATUS']->value){
$_smarty_tpl->tpl_vars['STATUS']->_loop = true;
 $_smarty_tpl->tpl_vars['STATUS_ID']->value = $_smarty_tpl->tpl_vars['STATUS']->key;
?><li id="<?php echo $_smarty_tpl->tpl_vars['STATUS_ID']->value;?>
" data-status="<?php echo vtranslate($_smarty_tpl->tpl_vars['STATUS']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><a><?php echo vtranslate($_smarty_tpl->tpl_vars['STATUS']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php } ?></ul></span></td></tr><?php } ?></table></div></div></div><script type="text/javascript">var related_uimeta = (function () {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['RELATED_FIELDS_INFO']->value;?>
;return {field: {get: function (name, property) {if (name && property === undefined) {return fieldInfo[name];}if (name && property) {return fieldInfo[name][property]}},isMandatory: function (name) {if (fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType: function (name) {if (fieldInfo[name]) {return fieldInfo[name].type}return false;}},};})();</script><?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('RelatedList.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?>
<?php }} ?>