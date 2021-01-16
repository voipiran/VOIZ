<?php /* Smarty version Smarty-3.1.7, created on 2019-04-28 10:40:15
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/EmailRelatedList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16560001625cc543c7e7b183-72061106%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49cda672d607cb651afa1cb995ecc5eb99d07838' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/EmailRelatedList.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16560001625cc543c7e7b183-72061106',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PAGING' => 0,
    'RELATED_MODULE' => 0,
    'RELATED_MODULE_NAME' => 0,
    'ORDER_BY' => 0,
    'SORT_ORDER' => 0,
    'RELATED_ENTIRES_COUNT' => 0,
    'TOTAL_ENTRIES' => 0,
    'RELATED_LIST_LINKS' => 0,
    'RELATED_LINK' => 0,
    'MODULE' => 0,
    'IS_SELECT_BUTTON' => 0,
    'RELATION_FIELD' => 0,
    'RELATED_RECORDS' => 0,
    'USER_MODEL' => 0,
    'WIDTHTYPE' => 0,
    'RELATED_HEADERS' => 0,
    'HEADER_FIELD' => 0,
    'COLUMN_NAME' => 0,
    'NEXT_SORT_ORDER' => 0,
    'FASORT_IMAGE' => 0,
    'SORT_IMAGE' => 0,
    'RELATED_RECORD' => 0,
    'EMAIL_FLAG' => 0,
    'PARENT_RECORD' => 0,
    'RELATED_HEADERNAME' => 0,
    'IS_DELETABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5cc543c812ff8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cc543c812ff8')) {function content_5cc543c812ff8($_smarty_tpl) {?>
<div class="relatedContainer"><input type="hidden" name="currentPageNum" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getCurrentPage();?>
" /><?php $_smarty_tpl->tpl_vars["RELATED_MODULE_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_MODULE']->value->get('name'), null, 0);?><input type="hidden" name="relatedModuleName" class="relatedModuleName" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" id="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" id="sortOrder"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_ENTIRES_COUNT']->value;?>
" id="noOfEntries"><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->getPageLimit();?>
" id='pageLimit'><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->get('page');?>
" id='pageNumber'><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['PAGING']->value->isNextPageExists();?>
" id="nextPageExist"/><input type='hidden' value="<?php echo $_smarty_tpl->tpl_vars['TOTAL_ENTRIES']->value;?>
" id='totalCount'><div class="relatedHeader "><div class="btn-toolbar row-fluid"><div class="col-lg-6 col-md-6 col-sm-6"><?php  $_smarty_tpl->tpl_vars['RELATED_LINK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_LINK']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value['LISTVIEWBASIC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_LINK']->key => $_smarty_tpl->tpl_vars['RELATED_LINK']->value){
$_smarty_tpl->tpl_vars['RELATED_LINK']->_loop = true;
?><div class="btn-group"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_selectRelation');?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['IS_SELECT_BUTTON'] = new Smarty_variable($_tmp1, null, 0);?><button onclick="javascript:Vtiger_Detail_Js.triggerSendEmail('index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=MassActionAjax&mode=showComposeEmailForm&step=step1&relatedLoad=true','Emails');" type="button" class="btn addButton btn-default<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value==true){?> selectRelation <?php }?> "<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value==true){?> data-moduleName=<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_module')->get('name');?>
 <?php }?><?php if (($_smarty_tpl->tpl_vars['RELATED_LINK']->value->isPageLoadLink())){?><?php if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value){?> data-name="<?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->getName();?>
" <?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value!=true){?>name="composeEmail"<?php }?>><?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value==false){?><i class="fa fa-plus"></i>&nbsp;<?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
</button></div><?php } ?>&nbsp;</div><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_ACTION'] = new Smarty_variable('relatedViewActions', null, 0);?><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_PAGING_INPUT'] = new Smarty_variable('relatedViewPagingInput', null, 0);?><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_PAGING_INPUT_SUBMIT'] = new Smarty_variable('relatedViewPagingInputSubmit', null, 0);?><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_BASIC_ACTION'] = new Smarty_variable('relatedViewBasicAction', null, 0);?><?php $_smarty_tpl->tpl_vars['PAGING_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['PAGING']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['RECORD_COUNT'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['RELATED_RECORDS']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['PAGE_NUMBER'] = new Smarty_variable($_smarty_tpl->tpl_vars['PAGING']->value->get('page'), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('SHOWPAGEJUMP'=>true), 0);?>
</div></div><div class="relatedContents col-lg-12 col-md-12 col-sm-12 table-container"><div class="bottomscroll-div"><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('rowheight'), null, 0);?><table id="listview-table"  class="table listview-table"><thead><tr class="listViewHeaders"><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a href="javascript:void(0);" class="noSorting"><?php echo vtranslate('LBL_SENDER_NAME');?>
</a></th><?php  $_smarty_tpl->tpl_vars['HEADER_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->key => $_smarty_tpl->tpl_vars['HEADER_FIELD']->value){
$_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = true;
?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')=='access_count'||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')=='idlists'){?><a href="javascript:void(0);" class="noSorting"><?php echo vtranslate($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</a><?php }else{ ?><a href="javascript:void(0);" class="relatedListHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-fieldname="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column');?>
"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php }else{ ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;&nbsp;<?php echo vtranslate(html_entity_decode($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('label')),$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><img class="<?php echo $_smarty_tpl->tpl_vars['SORT_IMAGE']->value;?>
"><?php }?>&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value==$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('column')){?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?><?php }?></th><?php } ?><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a href="javascript:void(0);" class="noSorting"><?php echo vtranslate('LBL_ORIGIN');?>
</a></th></tr></thead><?php  $_smarty_tpl->tpl_vars['RELATED_RECORD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_RECORD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_RECORDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_RECORD']->key => $_smarty_tpl->tpl_vars['RELATED_RECORD']->value){
$_smarty_tpl->tpl_vars['RELATED_RECORD']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['EMAIL_FLAG'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getEmailFlag(), null, 0);?><tr class="listViewEntries" data-id='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
' data-emailflag='<?php echo $_smarty_tpl->tpl_vars['EMAIL_FLAG']->value;?>
' name="emailsRelatedRecord"><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><a><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getSenderName($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId());?>
</a></td><?php  $_smarty_tpl->tpl_vars['HEADER_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_HEADERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['HEADER_FIELD']->key => $_smarty_tpl->tpl_vars['HEADER_FIELD']->value){
$_smarty_tpl->tpl_vars['HEADER_FIELD']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['RELATED_HEADERNAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('name'), null, 0);?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->isNameField()==true||$_smarty_tpl->tpl_vars['HEADER_FIELD']->value->get('uitype')=='4'){?><a><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='access_count'){?><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getAccessCountValue($_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId());?>
<?php }elseif($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='click_count'){?><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getClickCountValue($_smarty_tpl->tpl_vars['PARENT_RECORD']->value->getId());?>
<?php }elseif($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='date_start'){?><?php if ($_smarty_tpl->tpl_vars['EMAIL_FLAG']->value!='SAVED'){?><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
<?php }?><?php }elseif($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value=='time_start'){?><?php if ($_smarty_tpl->tpl_vars['EMAIL_FLAG']->value!='SAVED'){?><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
<?php }?><?php }elseif($_smarty_tpl->tpl_vars['HEADER_FIELD']->value->getFieldDataType()=='owner'){?><?php echo getOwnerName($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value));?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['RELATED_HEADERNAME']->value);?>
<?php }?></td><?php } ?><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><span class="label <?php if ($_smarty_tpl->tpl_vars['EMAIL_FLAG']->value=='SAVED'){?>label-info<?php }elseif($_smarty_tpl->tpl_vars['EMAIL_FLAG']->value=='SENT'){?>label-success<?php }else{ ?>label-warning<?php }?>"><?php echo vtranslate($_smarty_tpl->tpl_vars['EMAIL_FLAG']->value);?>
</span><div class="pull-right actions"><span class="actionImages"><a name="emailsDetailView" data-id='<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId();?>
'><i title="<?php echo vtranslate('LBL_SHOW_COMPLETE_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-bars"></i></a>&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getEmailFlag()=='SAVED'){?><a name="emailsEditView"><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-pencil"></i></a>	&nbsp;&nbsp;<?php }?><?php if ($_smarty_tpl->tpl_vars['IS_DELETABLE']->value){?><a class="relationDelete"><i title="<?php echo vtranslate('LBL_UNLINK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="vicon-linkopen"></i></a><?php }?></span></div></td></tr><?php } ?></table></div></div></div>
<?php }} ?>