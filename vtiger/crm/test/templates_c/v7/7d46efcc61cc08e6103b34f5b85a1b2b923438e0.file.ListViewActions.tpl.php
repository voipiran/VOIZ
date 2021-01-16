<?php /* Smarty version Smarty-3.1.7, created on 2018-06-18 09:40:03
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/ListViewActions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6819226015b273eab018c32-33936755%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d46efcc61cc08e6103b34f5b85a1b2b923438e0' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/ListViewActions.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6819226015b273eab018c32-33936755',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'LISTVIEW_MASSACTIONS' => 0,
    'LIST_MASSACTION' => 0,
    'LISTVIEW_MASSACTIONS_1' => 0,
    'deleteAction' => 0,
    'MODULE' => 0,
    'LISTVIEW_ENTRIES_COUNT' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5b273eab08e17',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b273eab08e17')) {function content_5b273eab08e17($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS_1'] = new Smarty_variable(array(), null, 0);?><div id="listview-actions" class="listview-actions-container"><?php  $_smarty_tpl->tpl_vars['LIST_MASSACTION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LIST_MASSACTION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LIST_MASSACTION']->key => $_smarty_tpl->tpl_vars['LIST_MASSACTION']->value){
$_smarty_tpl->tpl_vars['LIST_MASSACTION']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['LIST_MASSACTION']->value->getLabel()=='LBL_EDIT'){?><?php $_smarty_tpl->tpl_vars['editAction'] = new Smarty_variable($_smarty_tpl->tpl_vars['LIST_MASSACTION']->value, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['LIST_MASSACTION']->value->getLabel()=='LBL_DELETE'){?><?php $_smarty_tpl->tpl_vars['deleteAction'] = new Smarty_variable($_smarty_tpl->tpl_vars['LIST_MASSACTION']->value, null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['LIST_MASSACTION']->value->getLabel()=='LBL_ADD_COMMENT'){?><?php $_smarty_tpl->tpl_vars['commentAction'] = new Smarty_variable($_smarty_tpl->tpl_vars['LIST_MASSACTION']->value, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['a'] = new Smarty_variable(array_push($_smarty_tpl->tpl_vars['LISTVIEW_MASSACTIONS_1']->value,$_smarty_tpl->tpl_vars['LIST_MASSACTION']->value), null, 0);?><?php }?><?php } ?><div class = "row"><div class="col-md-3"><div class="btn-group listViewActionsContainer" role="group" aria-label="..."><?php if ($_smarty_tpl->tpl_vars['deleteAction']->value){?><button type="button" class="btn btn-default" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_LBL_MOVE_REPORT"onclick='Reports_List_Js.massMove("index.php?module=Reports&view=MoveReports")' title="<?php echo vtranslate('LBL_MOVE_REPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" disabled="disabled"><i class="vicon-foldermove" style='font-size:13px;'></i></button><?php }?><?php if ($_smarty_tpl->tpl_vars['deleteAction']->value){?><button type="button" class="btn btn-default" id=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_listView_massAction_<?php echo $_smarty_tpl->tpl_vars['deleteAction']->value->getLabel();?>
<?php if (stripos($_smarty_tpl->tpl_vars['deleteAction']->value->getUrl(),'javascript:')===0){?> href="javascript:void(0);" onclick='<?php echo substr($_smarty_tpl->tpl_vars['deleteAction']->value->getUrl(),strlen("javascript:"));?>
'<?php }else{ ?> href='<?php echo $_smarty_tpl->tpl_vars['deleteAction']->value->getUrl();?>
' <?php }?> title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" disabled="disabled"><i class="fa fa-trash"></i></button><?php }?></div></div><div class='col-md-6'><div class="hide messageContainer" style = "height:30px;"><center><a id="selectAllMsgDiv" href="#"><?php echo vtranslate('LBL_SELECT_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;(<span id="totalRecordsCount" value=""></span>)</a></center></div><div class="hide messageContainer" style = "height:30px;"><center><a id="deSelectAllMsgDiv" href="#"><?php echo vtranslate('LBL_DESELECT_ALL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></center></div></div><div class="col-md-3"><?php $_smarty_tpl->tpl_vars['RECORD_COUNT'] = new Smarty_variable($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('SHOWPAGEJUMP'=>true), 0);?>
</div></div><?php }} ?>