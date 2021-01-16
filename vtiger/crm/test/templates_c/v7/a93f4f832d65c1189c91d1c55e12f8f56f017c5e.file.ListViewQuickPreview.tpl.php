<?php /* Smarty version Smarty-3.1.7, created on 2018-12-08 14:41:50
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/ListViewQuickPreview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:363927405c0ba6f6622914-10548836%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a93f4f832d65c1189c91d1c55e12f8f56f017c5e' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/ListViewQuickPreview.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '363927405c0ba6f6622914-10548836',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'NEXT_RECORD_ID' => 0,
    'PREVIOUS_RECORD_ID' => 0,
    'MODULE_MODEL' => 0,
    'RECORD' => 0,
    'SELECTED_MENU_CATEGORY' => 0,
    'NAVIGATION' => 0,
    'SUMMARY_RECORD_STRUCTURE' => 0,
    'FIELD_MODEL' => 0,
    'USER_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c0ba6f67e1b8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c0ba6f67e1b8')) {function content_5c0ba6f67e1b8($_smarty_tpl) {?>
<div class = "quickPreview">
    <input type="hidden" name="sourceModuleName" id="sourceModuleName" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" />
    <input type="hidden" id = "nextRecordId" value ="<?php echo $_smarty_tpl->tpl_vars['NEXT_RECORD_ID']->value;?>
">
    <input type="hidden" id = "previousRecordId" value ="<?php echo $_smarty_tpl->tpl_vars['PREVIOUS_RECORD_ID']->value;?>
">

    <div class='quick-preview-modal modal-content'>
        <div class='modal-body'>
            <div class = "quickPreviewModuleHeader row">
                <div class = "col-lg-10">
                    <div class="row qp-heading">
                        <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ListViewQuickPreviewHeaderTitle.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('MODULE_MODEL'=>$_smarty_tpl->tpl_vars['MODULE_MODEL']->value,'RECORD'=>$_smarty_tpl->tpl_vars['RECORD']->value), 0);?>

                    </div>
                </div>
                <div class = "col-lg-2 pull-right">
                    <button class="close" aria-hidden="true" data-dismiss="modal" type="button" title="<?php echo vtranslate('LBL_CLOSE');?>
">x</button>
                </div>
            </div>

            <div class="quickPreviewActions clearfix">
                <div class="btn-group pull-left">
                    <button class="btn btn-success btn-xs" onclick="window.location.href = '<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getFullDetailViewUrl();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
'">
                       <?php echo vtranslate('LBL_VIEW_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 
                    </button>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['NAVIGATION']->value){?>
                    <div class="btn-group pull-right">
                        <button class="btn btn-default btn-xs" id="quickPreviewPreviousRecordButton" data-record="<?php echo $_smarty_tpl->tpl_vars['PREVIOUS_RECORD_ID']->value;?>
" data-app="<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" <?php if (empty($_smarty_tpl->tpl_vars['PREVIOUS_RECORD_ID']->value)){?> disabled="disabled" <?php }?> >
                            <i class="fa fa-chevron-left"></i>
                        </button>
                        <button class="btn btn-default btn-xs" id="quickPreviewNextRecordButton" data-record="<?php echo $_smarty_tpl->tpl_vars['NEXT_RECORD_ID']->value;?>
" data-app="<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" <?php if (empty($_smarty_tpl->tpl_vars['NEXT_RECORD_ID']->value)){?> disabled="disabled" <?php }?>>
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>
                <?php }?>

            </div>
            <div class = "quickPreviewSummary">
                <table class="summary-table no-border" style="width:100%;">
                    <tbody>
                        <?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SUMMARY_RECORD_STRUCTURE']->value['SUMMARY_FIELDS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?>
                            <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')!='modifiedtime'&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')!='createdtime'){?>
                                <tr class="summaryViewEntries">
                                    <td class="fieldLabel col-lg-5" ><label class="muted"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</label></td>
                                    <td class="fieldValue col-lg-7">
                                        <div class="row">
                                            <span class="value textOverflowEllipsis" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='19'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='20'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='21'){?>style="word-wrap: break-word;"<?php }?>>
                                                <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getDetailViewTemplateName(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['FIELD_MODEL']->value,'USER_MODEL'=>$_smarty_tpl->tpl_vars['USER_MODEL']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value,'RECORD'=>$_smarty_tpl->tpl_vars['RECORD']->value), 0);?>

                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            <?php }?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="engagementsContainer">
				<?php ob_start();?><?php echo vtranslate('LBL_UPDATES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ListViewQuickPreviewSectionHeader.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_tmp1), 0);?>

				<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("RecentActivities.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            </div>

            <br>
            <?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isCommentEnabled()){?>
                <div class="quickPreviewComments">
                    <?php ob_start();?><?php echo vtranslate('LBL_RECENT_COMMENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp2=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ListViewQuickPreviewSectionHeader.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_tmp2), 0);?>

                    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("QuickViewCommentsList.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                </div>
            <?php }?>
        </div>
    </div>
</div>

<?php }} ?>