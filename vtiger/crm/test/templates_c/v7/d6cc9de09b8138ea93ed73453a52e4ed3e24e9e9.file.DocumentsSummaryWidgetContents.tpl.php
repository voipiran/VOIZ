<?php /* Smarty version Smarty-3.1.7, created on 2019-02-05 13:32:24
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/DocumentsSummaryWidgetContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:806749685c595f302324e6-60665297%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6cc9de09b8138ea93ed73453a52e4ed3e24e9e9' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/DocumentsSummaryWidgetContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '806749685c595f302324e6-60665297',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RELATED_RECORDS' => 0,
    'RELATED_RECORD' => 0,
    'MODULE' => 0,
    'RELATED_MODULE' => 0,
    'DOWNLOAD_STATUS' => 0,
    'RECORD_ID' => 0,
    'DOCUMENT_RECORD_MODEL' => 0,
    'NUMBER_OF_RECORDS' => 0,
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c595f3030867',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c595f3030867')) {function content_5c595f3030867($_smarty_tpl) {?>
<div class="paddingLeft5px"><span class="col-sm-5"><strong><?php echo vtranslate('Title','Documents');?>
</strong></span><span class="col-sm-7"><strong><?php echo vtranslate('File Name','Documents');?>
</strong></span><?php  $_smarty_tpl->tpl_vars['RELATED_RECORD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_RECORD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_RECORDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_RECORD']->key => $_smarty_tpl->tpl_vars['RELATED_RECORD']->value){
$_smarty_tpl->tpl_vars['RELATED_RECORD']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['DOWNLOAD_FILE_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDownloadFileURL(), null, 0);?><?php $_smarty_tpl->tpl_vars['DOWNLOAD_STATUS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('filestatus'), null, 0);?><?php $_smarty_tpl->tpl_vars['DOWNLOAD_LOCATION_TYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('filelocationtype'), null, 0);?><div class="recentActivitiesContainer row"><ul class="" style="padding-left: 0px;list-style-type: none;"><li><div class="" id="documentRelatedRecord pull-left"><span class="col-sm-5 textOverflowEllipsis"><a href="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE']->value;?>
_Related_Record_<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('id');?>
" title="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue('notes_title');?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue('notes_title');?>
</a></span><span class="col-sm-5 textOverflowEllipsis" id="DownloadableLink"><?php if ($_smarty_tpl->tpl_vars['DOWNLOAD_STATUS']->value==1){?><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue('filename',$_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RELATED_RECORD']->value);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('filename');?>
<?php }?></span><span class="col-sm-2"><?php $_smarty_tpl->tpl_vars['RECORD_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getId(), null, 0);?><?php if (isPermitted('Documents','DetailView',$_smarty_tpl->tpl_vars['RECORD_ID']->value)=='yes'){?><?php $_smarty_tpl->tpl_vars["DOCUMENT_RECORD_MODEL"] = new Smarty_variable(Vtiger_Record_Model::getInstanceById($_smarty_tpl->tpl_vars['RECORD_ID']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename')&&$_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filestatus')){?><a name="viewfile" href="javascript:void(0)" data-filelocationtype="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filelocationtype');?>
" data-filename="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename');?>
" onclick="Vtiger_Header_Js.previewFile(event,<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
)"><i title="<?php echo vtranslate('LBL_VIEW_FILE','Documents');?>
" class="fa fa-picture-o alignMiddle"></i></a>&nbsp;<?php }?><?php if ($_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filename')&&$_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filestatus')&&$_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->get('filelocationtype')=='I'){?><a name="downloadfile" href="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_RECORD_MODEL']->value->getDownloadFileURL();?>
"><i title="<?php echo vtranslate('LBL_DOWNLOAD_FILE','Documents');?>
" class="fa fa-download alignMiddle"></i></a>&nbsp;<?php }?><?php }?></span></div></li></ul></div><?php } ?></div><?php $_smarty_tpl->tpl_vars['NUMBER_OF_RECORDS'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['RELATED_RECORDS']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['NUMBER_OF_RECORDS']->value==5){?><div class="row"><div class="pull-right"><a class="moreRecentDocuments cursorPointer"><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div></div><?php }?><?php }} ?>