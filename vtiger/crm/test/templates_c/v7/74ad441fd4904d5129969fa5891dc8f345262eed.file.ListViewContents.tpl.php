<?php /* Smarty version Smarty-3.1.7, created on 2018-11-26 10:30:22
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Workflows/ListViewContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17056478235bfb9a062798d4-25963667%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74ad441fd4904d5129969fa5891dc8f345262eed' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Workflows/ListViewContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17056478235bfb9a062798d4-25963667',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PAGING_MODEL' => 0,
    'LISTVIEW_COUNT' => 0,
    'ORDER_BY' => 0,
    'SORT_ORDER' => 0,
    'PAGE_NUMBER' => 0,
    'LISTVIEW_ENTRIES_COUNT' => 0,
    'MODULES_COUNT' => 0,
    'QUALIFIED_MODULE' => 0,
    'SUPPORTED_MODULE_MODELS' => 0,
    'SOURCE_MODULE' => 0,
    'MODULE_MODEL' => 0,
    'TAB_ID' => 0,
    'SEARCH_VALUE' => 0,
    'MODULE' => 0,
    'CURRENT_USER_MODEL' => 0,
    'LISTVIEW_HEADERS' => 0,
    'LISTVIEW_HEADER' => 0,
    'HEADER_NAME' => 0,
    'COLUMN_NAME' => 0,
    'NEXT_SORT_ORDER' => 0,
    'SORT_IMAGE' => 0,
    'LISTVIEW_ENTRIES' => 0,
    'LISTVIEW_ENTRY' => 0,
    'LISTVIEW_HEADERNAME' => 0,
    'WIDTHTYPE' => 0,
    'WIDTH' => 0,
    'WORKFLOW_CONDITION' => 0,
    'ALL_CONDITIONS' => 0,
    'ALL_CONDITION' => 0,
    'ANY_CONDITIONS' => 0,
    'ANY_CONDITION' => 0,
    'ACTIONS' => 0,
    'ACTION_COUNT' => 0,
    'COLSPAN_WIDTH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfb9a0649fb4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfb9a0649fb4')) {function content_5bfb9a0649fb4($_smarty_tpl) {?>

<div class="col-sm-12 col-xs-12 "><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordStartRange();?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getRecordEndRange();?>
" /><input type="hidden" id="previousPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isPrevPageExists();?>
" /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists();?>
" /><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_COUNT']->value;?>
" /><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGE_NUMBER']->value;?>
" id='pageNumber'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING_MODEL']->value->getPageLimit();?>
" id='pageLimit'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value;?>
" id="noOfEntries"><div class = "row"><div class='col-md-5'><div class="foldersContainer hidden-xs pull-left"><select class="select2" style="width: 300px;" id="moduleFilter"><option value="" data-count='<?php echo $_smarty_tpl->tpl_vars['MODULES_COUNT']->value['All'];?>
'><?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php echo vtranslate('LBL_WORKFLOWS');?>
</option><?php  $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['TAB_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SUPPORTED_MODULE_MODELS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['TAB_ID']->value = $_smarty_tpl->tpl_vars['MODULE_MODEL']->key;
?><option <?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value==$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName()){?> selected="" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName();?>
" data-count='<?php if ($_smarty_tpl->tpl_vars['MODULES_COUNT']->value[$_smarty_tpl->tpl_vars['TAB_ID']->value]){?><?php echo $_smarty_tpl->tpl_vars['MODULES_COUNT']->value[$_smarty_tpl->tpl_vars['TAB_ID']->value];?>
<?php }else{ ?>0<?php }?>'><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName()=='Calendar'){?><?php echo vtranslate('LBL_TASK',$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());?>
&nbsp;<?php echo vtranslate('LBL_WORKFLOWS');?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());?>
&nbsp;<?php echo vtranslate('LBL_WORKFLOWS');?>
<?php }?></option><?php } ?></select></div></div><div class="col-md-4"><div class="search-link hidden-xs" style="margin-top: 0px;"><span aria-hidden="true" class="fa fa-search"></span><input class="searchWorkflows" type="text" type="text" value="<?php echo $_smarty_tpl->tpl_vars['SEARCH_VALUE']->value;?>
" placeholder="<?php echo vtranslate('LBL_WORKFLOW_SEARCH',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></div></div><div class="col-md-3"><?php $_smarty_tpl->tpl_vars['RECORD_COUNT'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('SHOWPAGEJUMP'=>true), 0);?>
</div></div><div class="list-content row"><div class="col-sm-12 col-xs-12 "><div id="table-content" class="table-container" style="padding-top:0px !important;"><table id="listview-table" class="workflow-table table listview-table"><?php $_smarty_tpl->tpl_vars["NAME_FIELDS"] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getNameFields(), null, 0);?><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><thead><tr class="listViewContentHeader"><th style="width: 100px;"></th><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
?><?php $_smarty_tpl->tpl_vars["HEADER_NAME"] = new Smarty_variable(($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name')), null, 0);?><?php if ($_smarty_tpl->tpl_vars['HEADER_NAME']->value!='summary'&&$_smarty_tpl->tpl_vars['HEADER_NAME']->value!='module_name'){?><th nowrap><a <?php if (!($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->has('sort'))){?> class="listViewHeaderValues cursorPointer" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_NAME']->value){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['HEADER_NAME']->value;?>
" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_NAME']->value){?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
 icon-white"><?php }?></a>&nbsp;</th><?php }elseif($_smarty_tpl->tpl_vars['HEADER_NAME']->value=='module_name'&&empty($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value)){?><th nowrap><a <?php if (!($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->has('sort'))){?> class="listViewHeaderValues cursorPointer" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_NAME']->value){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="<?php echo $_smarty_tpl->tpl_vars['HEADER_NAME']->value;?>
" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('label'),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_NAME']->value){?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
 icon-white"><?php }?></a>&nbsp;</th><?php }else{ ?><?php }?><?php } ?><th nowrap><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
?><tr class="listViewEntries" data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
"data-recordurl="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getEditViewUrl();?>
&mode=V7Edit"><td><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ListViewRecordActions.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td><?php  $_smarty_tpl->tpl_vars['LISTVIEW_HEADER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->key => $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->_loop = true;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration++;
 $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last = $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->iteration === $_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->total;
?><?php $_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->value->get('name'), null, 0);?><?php $_smarty_tpl->tpl_vars['LAST_COLUMN'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_HEADER']->last, null, 0);?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value!='summary'&&$_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value!='module_name'){?><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" width="<?php echo $_smarty_tpl->tpl_vars['WIDTH']->value;?>
%" nowrap><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value=='test'){?><?php $_smarty_tpl->tpl_vars['WORKFLOW_CONDITION'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getConditonDisplayValue(), null, 0);?><?php $_smarty_tpl->tpl_vars['ALL_CONDITIONS'] = new Smarty_variable($_smarty_tpl->tpl_vars['WORKFLOW_CONDITION']->value['All'], null, 0);?><?php $_smarty_tpl->tpl_vars['ANY_CONDITIONS'] = new Smarty_variable($_smarty_tpl->tpl_vars['WORKFLOW_CONDITION']->value['Any'], null, 0);?><span><strong><?php echo vtranslate('All');?>
&nbsp;:&nbsp;&nbsp;&nbsp;</strong></span><?php if (is_array($_smarty_tpl->tpl_vars['ALL_CONDITIONS']->value)&&!empty($_smarty_tpl->tpl_vars['ALL_CONDITIONS']->value)){?><?php  $_smarty_tpl->tpl_vars['ALL_CONDITION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ALL_CONDITION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_CONDITIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['allCounter']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['ALL_CONDITION']->key => $_smarty_tpl->tpl_vars['ALL_CONDITION']->value){
$_smarty_tpl->tpl_vars['ALL_CONDITION']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['allCounter']['iteration']++;
?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['allCounter']['iteration']!=1){?><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><?php }?><span><?php echo $_smarty_tpl->tpl_vars['ALL_CONDITION']->value;?>
</span><br><?php } ?><?php }else{ ?><?php echo vtranslate('LBL_NA');?>
<?php }?><br><span><strong><?php echo vtranslate('Any');?>
&nbsp;:&nbsp;</strong></span><?php if (is_array($_smarty_tpl->tpl_vars['ANY_CONDITIONS']->value)&&!empty($_smarty_tpl->tpl_vars['ANY_CONDITIONS']->value)){?><?php  $_smarty_tpl->tpl_vars['ANY_CONDITION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ANY_CONDITION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ANY_CONDITIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['anyCounter']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['ANY_CONDITION']->key => $_smarty_tpl->tpl_vars['ANY_CONDITION']->value){
$_smarty_tpl->tpl_vars['ANY_CONDITION']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['anyCounter']['iteration']++;
?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['anyCounter']['iteration']!=1){?><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><?php }?><span><?php echo $_smarty_tpl->tpl_vars['ANY_CONDITION']->value;?>
</span><br><?php } ?><?php }else{ ?><?php echo vtranslate('LBL_NA');?>
<?php }?><?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value=='execution_condition'){?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDisplayValue('v7_execution_condition');?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getDisplayValue($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value);?>
<?php }?></td><?php }elseif($_smarty_tpl->tpl_vars['LISTVIEW_HEADERNAME']->value=='module_name'&&empty($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value)){?><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" width="<?php echo $_smarty_tpl->tpl_vars['WIDTH']->value;?>
%" nowrap><?php ob_start();?><?php echo strtolower($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('raw_module_name'));?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["MODULE_ICON_NAME"] = new Smarty_variable($_tmp1, null, 0);?><?php echo Vtiger_Module_Model::getModuleIconPath($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('raw_module_name'));?>
</td><?php }else{ ?><?php }?><?php } ?><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" width="<?php echo $_smarty_tpl->tpl_vars['WIDTH']->value;?>
%" nowrap><?php $_smarty_tpl->tpl_vars['ACTIONS'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getActionsDisplayValue(), null, 0);?><?php if (is_array($_smarty_tpl->tpl_vars['ACTIONS']->value)&&!empty($_smarty_tpl->tpl_vars['ACTIONS']->value)){?><?php  $_smarty_tpl->tpl_vars['ACTION_COUNT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ACTION_COUNT']->_loop = false;
 $_smarty_tpl->tpl_vars['ACTION_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_COUNT']->key => $_smarty_tpl->tpl_vars['ACTION_COUNT']->value){
$_smarty_tpl->tpl_vars['ACTION_COUNT']->_loop = true;
 $_smarty_tpl->tpl_vars['ACTION_NAME']->value = $_smarty_tpl->tpl_vars['ACTION_COUNT']->key;
?><?php echo vtranslate("LBL_".($_smarty_tpl->tpl_vars['ACTION_NAME']->value),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;(<?php echo $_smarty_tpl->tpl_vars['ACTION_COUNT']->value;?>
)<?php } ?><?php }?></td></tr><?php } ?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value=='0'){?><tr class="emptyRecordsDiv"><?php ob_start();?><?php echo count($_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value)+1;?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['COLSPAN_WIDTH'] = new Smarty_variable($_tmp2, null, 0);?><td colspan="<?php echo $_smarty_tpl->tpl_vars['COLSPAN_WIDTH']->value;?>
" style="vertical-align:inherit !important;"><center><?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');?>
</center></td></tr><?php }?></tbody></table></div><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div></div></div></div>
<?php }} ?>