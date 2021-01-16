<?php /* Smarty version Smarty-3.1.7, created on 2020-11-26 13:29:24
         compiled from "/var/www/html/crm/includes/runtime/../../layouts/v7/modules/RecycleBin/ListViewActions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14310423605fbf7c7c455332-50074074%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7be012c4b20d2f5eef2cda4be8774e2ad4203035' => 
    array (
      0 => '/var/www/html/crm/includes/runtime/../../layouts/v7/modules/RecycleBin/ListViewActions.tpl',
      1 => 1522233380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14310423605fbf7c7c455332-50074074',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LISTVIEW_MASSACTIONS' => 0,
    'LISTVIEW_ACTIONS' => 0,
    'MODULE' => 0,
    'LISTVIEW_MASSACTION' => 0,
    'LISTVIEW_LINKS' => 0,
    'LISTVIEW_BASICACTION' => 0,
    'IS_RECORDS_DELETED' => 0,
    'LISTVIEW_ENTRIES_COUNT' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5fbf7c7c4cbb2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fbf7c7c4cbb2')) {function content_5fbf7c7c4cbb2($_smarty_tpl) {?>

<div id="listview-actions" class="listview-actions-container"><div class = "row"><div class="btn-group col-md-4" role="group" aria-label="..."><span class="recordDependentListActions" style="float: left;"><?php $_smarty_tpl->tpl_vars['LISTVIEW_ACTIONS'] = new Smarty_variable(array_reverse($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS']->value), null, 0);?><?php  $_smarty_tpl->tpl_vars["LISTVIEW_MASSACTION"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["LISTVIEW_MASSACTION"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_ACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["LISTVIEW_MASSACTION"]->key => $_smarty_tpl->tpl_vars["LISTVIEW_MASSACTION"]->value){
$_smarty_tpl->tpl_vars["LISTVIEW_MASSACTION"]->_loop = true;
?><button type="button" class="btn btn-default" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getLabel());?>
"<?php if (stripos($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getUrl(),'javascript:')===0){?>onclick='<?php echo substr($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getUrl(),strlen("javascript:"));?>
;'<?php }else{ ?> onclick="Vtiger_List_Js.triggerMassAction('<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getUrl();?>
')"<?php }?> disabled="disabled"title="<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getLabel()=='LBL_RESTORE'){?><?php echo vtranslate('LBL_RESTORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?>"><i class="<?php if ($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTION']->value->getLabel()=='LBL_RESTORE'){?> fa fa-refresh <?php }else{ ?> fa fa-trash <?php }?>"></i></button><?php } ?></span><?php  $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_LINKS']->value['LISTVIEWBASIC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->key => $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value){
$_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->_loop = true;
?><span class="btn-group" style="margin-left: 5px;"><button id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_basicAction_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getLabel());?>
" class="btn btn-danger clearRecycleBin" <?php if (stripos($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getUrl(),'javascript:')===0){?> onclick='<?php echo substr($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getUrl(),strlen("javascript:"));?>
;'<?php }else{ ?>onclick='window.location.href="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getUrl();?>
"'<?php }?> <?php if (!$_smarty_tpl->tpl_vars['IS_RECORDS_DELETED']->value){?> disabled="disabled" <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['LISTVIEW_BASICACTION']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></span><?php } ?></div><div class='col-md-5'><div class="hide messageContainer" style = "height:30px;"><center><a id="selectAllMsgDiv" href="#"><?php echo vtranslate('LBL_SELECT_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;(<span id="totalRecordsCount" value=""></span>)</a></center></div><div class="hide messageContainer" style = "height:30px;"><center><a href="#" id="deSelectAllMsgDiv"><?php echo vtranslate('LBL_DESELECT_ALL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></div><div class="col-md-3"><?php $_smarty_tpl->tpl_vars['RECORD_COUNT'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('SHOWPAGEJUMP'=>true), 0);?>
</div></div><?php }} ?>