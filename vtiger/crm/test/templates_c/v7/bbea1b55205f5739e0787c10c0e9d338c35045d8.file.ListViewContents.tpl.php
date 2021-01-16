<?php /* Smarty version Smarty-3.1.7, created on 2018-11-19 14:12:30
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Users/ListViewContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2560155415bf293966d9d01-60863728%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bbea1b55205f5739e0787c10c0e9d338c35045d8' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Users/ListViewContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2560155415bf293966d9d01-60863728',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LISTVIEW_ENTRIES_COUNT' => 0,
    'PAGING_MODEL' => 0,
    'PAGE_NUMBER' => 0,
    'MODULE_MODEL' => 0,
    'OPERATOR' => 0,
    'ALPHABET_VALUE' => 0,
    'LISTVIEW_COUNT' => 0,
    'ORDER_BY' => 0,
    'SORT_ORDER' => 0,
    'NO_SEARCH_PARAMS_CACHE' => 0,
    'QUALIFIED_MODULE' => 0,
    'LISTVIEW_HEADERS' => 0,
    'LISTVIEW_HEADER' => 0,
    'COLUMN_NAME' => 0,
    'NEXT_SORT_ORDER' => 0,
    'FASORT_IMAGE' => 0,
    'HEADER_LABEL' => 0,
    'MODULE' => 0,
    'SEARCH_MODE_RESULTS' => 0,
    'FIELD_UI_TYPE_MODEL' => 0,
    'SEARCH_DETAILS' => 0,
    'CURRENT_USER_MODEL' => 0,
    'LISTVIEW_ENTRIES' => 0,
    'LISTVIEW_ENTRY' => 0,
    'LISTVIEW_HEADERNAME' => 0,
    'LISTVIEW_ENTRY_RAWVALUE' => 0,
    'IMAGE_DETAILS' => 0,
    'IMAGE_INFO' => 0,
    'WIDTHTYPE' => 0,
    'COLSPAN_WIDTH' => 0,
    'SEARCH_VALUE' => 0,
    'IS_MODULE_EDITABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bf2939695c74',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bf2939695c74')) {function content_5bf2939695c74($_smarty_tpl) {?>



<input type="hidden" id="listViewEntriesCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" /><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" /><input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" /><input type="hidden" id="pageNumberValue" value= "<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
"/><input type="hidden" id="pageLimitValue" value= "<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
" /><input type="hidden" id="numberOfEntries" value= "<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" /><input type="hidden" id="alphabetSearchKey" value= "<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getAlphabetSearchField();?>
" /><input type="hidden" id="Operator" value="<?php echo $_smarty_tpl->tpl_vars['OPERATOR']->value;?>
" /><input type="hidden" id="alphabetValue" value="<?php echo $_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value;?>
" /><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><input type="hidden" name="orderBy" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" name="sortOrder" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
" id='pageNumber'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
" id='pageLimit'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" id="noOfEntries"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['NO_SEARCH_PARAMS_CACHE']->value;?>
" id="noFilterCache" ><div id="table-content" class="table-container"><form name='list' id='listedit' action='' onsubmit="return false;"><table id="listview-table" class="table <?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value=='0'){?>listview-table-norecords <?php }?> listview-table"><thead><tr class="listViewContentHeader"><th><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()!='last_name'&&$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()!='email1'&&$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()!='status'){?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()=='first_name'){?><?php $_smarty_tpl->tpl_vars['HEADER_LABEL'] = new Smarty_variable('LBL_NAME_EMAIL', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['HEADER_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'), null, 0);?><?php }?><th <?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')){?> nowrap="nowrap" <?php }?> ><a href="#" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name');?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')){?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php }else{ ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')){?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th><?php }?><?php } ?></tr></thead><tbody class="overflow-y"><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isQuickSearchEnabled()&&!$_smarty_tpl->tpl_vars['SEARCH_MODE_RESULTS']->value){?><tr class="searchRow"><th class="inline-search-btn"><div class="table-actions"><button class="btn btn-success btn-sm" data-trigger="listSearch"><?php echo vtranslate("LBL_SEARCH",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></th><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()=='last_name'||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()=='email1'||$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()=='status'){?><?php continue 1?><?php }?><th><?php $_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getUITypeModel(), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_UI_TYPE_MODEL']->value->getListSearchTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value,'SEARCH_INFO'=>$_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()],'USER_MODEL'=>$_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value), 0);?>
<input type="hidden" class="operatorValue" value="<?php echo $_smarty_tpl->tpl_vars['SEARCH_DETAILS']->value[$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()]['comparator'];?>
"></th><?php } ?></tr><?php }?><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['listview']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['listview']['index']++;
?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
' data-recordUrl='<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDetailViewUrl();?>
&parentblock=LBL_USER_MANAGEMENT' id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_row_<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['listview']['index']+1;?>
"><td class="listViewRecordActions"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ListViewRecordActions.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name'), null, 0);?><?php $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_RAWVALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getRaw($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('column')), null, 0);?><?php $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()=='first_name'){?><td data-name="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name');?>
" data-rawvalue="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY_RAWVALUE']->value;?>
" data-type="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getFieldDataType();?>
"><span class="fieldValue"><span class="value textOverflowEllipsis"><div style="margin-left: -13px;"><?php $_smarty_tpl->tpl_vars['IMAGE_DETAILS'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getImageDetails(), null, 0);?><?php  $_smarty_tpl->tpl_vars['IMAGE_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['IMAGE_INFO']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['IMAGE_INFO']->key => $_smarty_tpl->tpl_vars['IMAGE_INFO']->value){
$_smarty_tpl->tpl_vars['IMAGE_INFO']->_loop = true;
?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
<?php $_tmp1=ob_get_clean();?><?php if (!empty($_smarty_tpl->tpl_vars['IMAGE_INFO']->value['path'])&&!empty($_tmp1)){?><div class='col-lg-2'><img height="25px" width="25px" src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['path'];?>
_<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['orgname'];?>
"></div><?php }?><?php } ?><?php if ($_smarty_tpl->tpl_vars['IMAGE_DETAILS']->value[0]['id']==null){?><div class='col-lg-2'><i class="fa fa-user userDefaultIcon"></i></div><?php }?><div class="usersinfo col-lg-9 textOverflowEllipsis" title="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('last_name');?>
"><a href="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDetailViewUrl();?>
"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('last_name');?>
</a></div><div class="usersinfo col-lg-9 textOverflowEllipsis"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('email1');?>
</div></div></span></span></td><?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()!='last_name'&&$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()!='email1'&&$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->getName()!='status'){?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap><span class="fieldValue"><span class="value textOverflowEllipsis"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
</span></span></td><?php }?><?php } ?></tr><?php } ?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value=='0'){?><tr class="emptyRecordsDiv"><?php ob_start();?><?php echo count($_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['COLSPAN_WIDTH'] = new Smarty_variable($_tmp2, null, 0);?><td colspan="<?php echo $_smarty_tpl->tpl_vars['COLSPAN_WIDTH']->value;?>
"><div class="emptyRecordsContent"><center><?php if ($_smarty_tpl->tpl_vars['SEARCH_VALUE']->value=='Active'){?><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE'] = new Smarty_variable("SINGLE_".($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');?>
,<?php if ($_smarty_tpl->tpl_vars['IS_MODULE_EDITABLE']->value){?> <a style="color:blue" href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getCreateRecordUrl();?>
"> <?php echo vtranslate('LBL_CREATE_USER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }?><?php }else{ ?><?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');?>
<?php }?></center></div></td></tr><?php }?></tbody></table></form></div><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div><?php }} ?>