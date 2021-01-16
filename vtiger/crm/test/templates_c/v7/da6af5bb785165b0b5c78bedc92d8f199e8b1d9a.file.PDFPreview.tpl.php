<?php /* Smarty version Smarty-3.1.7, created on 2018-11-28 10:39:03
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/PDFMaker/PDFPreview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14263785645bfe3f0ff25400-13978984%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da6af5bb785165b0b5c78bedc92d8f199e8b1d9a' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/PDFMaker/PDFPreview.tpl',
      1 => 1523862902,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14263785645bfe3f0ff25400-13978984',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'FILE_PATH' => 0,
    'DOWNLOAD_URL' => 0,
    'PRINT_ACTION' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfe3f10024ef',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfe3f10024ef')) {function content_5bfe3f10024ef($_smarty_tpl) {?>
<div class="modal-dialog modal-lg"><div class="modal-content"><div class="filePreview container-fluid"><div class="modal-header row"><div class="filename col-lg-8"><h4 class="textOverflowEllipsis maxWidth50" title="<?php echo vtranslate('LBL_PREVIEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><b><?php echo vtranslate('LBL_PREVIEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></h4></div><div class="col-lg-1 pull-right"><button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true" class='fa fa-close'></span></button></div></div><div class="modal-body row" style="height:550px;"><iframe id='PDFMakerPreviewContent' src="<?php echo $_smarty_tpl->tpl_vars['FILE_PATH']->value;?>
" data-desc="<?php echo $_smarty_tpl->tpl_vars['FILE_PATH']->value;?>
" height="100%" width="100%"></iframe></div></div><div class="modal-footer"><div class='clearfix modal-footer-overwrite-style'><div class="row clearfix "><div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='button' class='btn btn-success downloadButton' data-desc="<?php echo $_smarty_tpl->tpl_vars['DOWNLOAD_URL']->value;?>
"><strong><?php echo vtranslate('LBL_DOWNLOAD_FILE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['PRINT_ACTION']->value=="1"){?><button type='button' class='btn btn-success printButton'><strong><?php echo vtranslate('LBL_PRINT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<?php }?><a class='cancelLink' href="javascript:void(0);" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></div></div></div>
<?php }} ?>