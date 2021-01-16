<?php /* Smarty version Smarty-3.1.7, created on 2018-11-27 16:41:44
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Portal/ListViewContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14428327005bfd429041b9d7-17190719%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f661ce072536178368325044abb6166400e3d20' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Portal/ListViewContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14428327005bfd429041b9d7-17190719',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CURRENT_PAGE' => 0,
    'PAGING_INFO' => 0,
    'ALPHABET_VALUE' => 0,
    'NO_OF_ENTRIES' => 0,
    'COLUMN_NAME' => 0,
    'SORT_ORDER' => 0,
    'MODULE' => 0,
    'CURRENT_USER_MODEL' => 0,
    'NEXT_SORT_ORDER' => 0,
    'FASORT_IMAGE' => 0,
    'LISTVIEW_ENTRIES' => 0,
    'RECORD_ID' => 0,
    'LISTVIEW_ENTRY' => 0,
    'WIDTHTYPE' => 0,
    'LISTVIEW_HEADERS' => 0,
    'COLSPAN_WIDTH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfd42904d237',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfd42904d237')) {function content_5bfd42904d237($_smarty_tpl) {?>



<input type="hidden" id="pageNumber" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_PAGE']->value;?>
"><input type="hidden" id="totalCount" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['recordCount'];?>
" /><input type="hidden" id="recordsCount" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['recordCount'];?>
"/><input type="hidden" id="selectedIds" name="selectedIds" /><input type="hidden" id="excludedIds" name="excludedIds" /><input type="hidden" id="alphabetValue" value="<?php echo $_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value;?>
" /><input type="hidden" id="pageStartRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['startSequence'];?>
" /><input type="hidden" id="pageEndRange" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['endSequence'];?>
" /><input type="hidden" id="previousPageExist" <?php if ($_smarty_tpl->tpl_vars['CURRENT_PAGE']->value!=1){?>value="1"<?php }?> /><input type="hidden" id="nextPageExist" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['nextPageExists'];?>
" /><input type="hidden" id="pageLimit" value="<?php echo $_smarty_tpl->tpl_vars['PAGING_INFO']->value['pageLimit'];?>
" /><input type="hidden" id="noOfEntries" value="<?php echo $_smarty_tpl->tpl_vars['NO_OF_ENTRIES']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['COLUMN_NAME']->value;?>
" name="orderBy"><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" name="sortOrder"><?php echo $_smarty_tpl->getSubTemplate ("modules/Portal/ListViewActions.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<div id="selectAllMsgDiv" class="hide" style = "background:gold;height:20px"><center><a href="#"><?php echo vtranslate('LBL_SELECT_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;(<span id="totalRecordsCount" value=""></span>)</a></center></div><div id="deSelectAllMsgDiv" class="hide" style = "background:gold;height:20px"><center><a href="#"><?php echo vtranslate('LBL_DESELECT_ALL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div><div class="contents-topscroll noprint"><div class="topscroll-div">&nbsp;</div></div><div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 listViewContentDiv" id="listViewContents"><div id="table-content" class="table-container"><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><table id="listview-table" class="table listview-table portal-table"><thead><tr class="listViewContentHeader"><th><div class="table-actions" style="margin-left:0px !important;"><span class="input"><input class="listViewEntriesMainCheckBox" type="checkbox"></span></div></th><th><a href="#" class="listViewContentHeaderValues" data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value=='portalname'){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="portalname"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value=='portalname'){?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php }else{ ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate('LBL_BOOKMARK_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value=='portalname'){?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th><th><a href="#" class="listViewContentHeaderValues"data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value=='portalurl'){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="portalurl"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value=='portalurl'){?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php }else{ ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate('LBL_BOOKMARK_URL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value=='portalurl'){?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th><th><a href="#" class="listViewContentHeaderValues"data-nextsortorderval="<?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value=='createdtime'){?><?php echo $_smarty_tpl->tpl_vars['NEXT_SORT_ORDER']->value;?>
<?php }else{ ?>ASC<?php }?>" data-columnname="createdtime"><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value=='createdtime'){?><i class="fa fa-sort <?php echo $_smarty_tpl->tpl_vars['FASORT_IMAGE']->value;?>
"></i><?php }else{ ?><i class="fa fa-sort customsort"></i><?php }?>&nbsp;<?php echo vtranslate('LBL_CREATED_ON',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</a><?php if ($_smarty_tpl->tpl_vars['COLUMN_NAME']->value=='createdtime'){?><a href="#" class="removeSorting"><i class="fa fa-remove"></i></a><?php }?></th></tr></thead><tbody class="overflow-y"><?php  $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = false;
 $_smarty_tpl->tpl_vars['RECORD_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key => $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->_loop = true;
 $_smarty_tpl->tpl_vars['RECORD_ID']->value = $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->key;
?><tr class="listViewEntries" data-id="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" data-recordurl="index.php?module=Portal&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
"><td class="listViewRecordActions"><div class="table-actions"><span class="input" ><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" class="listViewEntriesCheckBox"/></span><span class="more dropdown action"><span href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v icon"></i></span><ul class="dropdown-menu" style="top:auto;bottom:30%;" data-id="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
"><li><a href="javascript:void(0);" class="editPortalRecord" ><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li><a href="javascript:void(0);" class="deleteRecordButton"><?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li></ul></span></div></td><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap><a href="index.php?module=Portal&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" sl-processed="1"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('portalname');?>
</a></td><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap><a class="urlField cursorPointer" href="<?php if (substr($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('portalurl'),0,4)!='http'){?>//<?php }?><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('portalurl');?>
" target="_blank" sl-processed="1"><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('portalurl');?>
</a></td><td class="listViewEntryValue <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" nowrap><?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('createdtime');?>
</td></tr><?php } ?><?php if ($_smarty_tpl->tpl_vars['PAGING_INFO']->value['recordCount']=='0'){?><tr class="emptyRecordsDiv"><?php ob_start();?><?php echo count($_smarty_tpl->tpl_vars['LISTVIEW_HEADERS']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['COLSPAN_WIDTH'] = new Smarty_variable($_tmp1+1, null, 0);?><td colspan="<?php echo $_smarty_tpl->tpl_vars['COLSPAN_WIDTH']->value;?>
"><div class="emptyRecordsContent"><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE'] = new Smarty_variable("SINGLE_".($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?><?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate('LBL_BOOKMARKS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_FOUND');?>
. <?php echo vtranslate('LBL_CREATE');?>
&nbsp;<a class="addBookmark" style="color:blue;"><?php echo vtranslate('LBL_BOOKMARK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></td></tr><?php }?></tbody></table></div></div>
<?php }} ?>