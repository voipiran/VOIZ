<?php /* Smarty version Smarty-3.1.7, created on 2020-08-23 10:26:59
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/ModComments/FilePreview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:589867365f42052ba1a817-24443405%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '810016c0f4af9281a563981a72bcf2283c11a846' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/ModComments/FilePreview.tpl',
      1 => 1522233380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '589867365f42052ba1a817-24443405',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'FILE_PREVIEW_NOT_SUPPORTED' => 0,
    'FILE_NAME' => 0,
    'TRIMMED_FILE_NAME' => 0,
    'DOWNLOAD_URL' => 0,
    'MODULE_NAME' => 0,
    'BASIC_FILE_TYPE' => 0,
    'FILE_CONTENTS' => 0,
    'OPENDOCUMENT_FILE_TYPE' => 0,
    'PDF_FILE_TYPE' => 0,
    'SITE_URL' => 0,
    'FILE_PATH' => 0,
    'IMAGE_FILE_TYPE' => 0,
    'AUDIO_FILE_TYPE' => 0,
    'FILE_TYPE' => 0,
    'VIDEO_FILE_TYPE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f42052bad0f4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f42052bad0f4')) {function content_5f42052bad0f4($_smarty_tpl) {?>
<div class="modal-dialog modal-lg"><div class="modal-content"><div class="filePreview container-fluid"><div class="modal-header row"><div class="filename <?php if ($_smarty_tpl->tpl_vars['FILE_PREVIEW_NOT_SUPPORTED']->value!='yes'){?> col-lg-8 <?php }else{ ?> col-lg-11 <?php }?>"><h4 class="textOverflowEllipsis maxWidth50" title="<?php echo $_smarty_tpl->tpl_vars['FILE_NAME']->value;?>
"><b><?php echo $_smarty_tpl->tpl_vars['TRIMMED_FILE_NAME']->value;?>
</b></h4></div><?php if ($_smarty_tpl->tpl_vars['FILE_PREVIEW_NOT_SUPPORTED']->value!='yes'){?><div class="col-lg-3"><a class="btn btn-default btn-small pull-right marginTop5px" href="<?php echo $_smarty_tpl->tpl_vars['DOWNLOAD_URL']->value;?>
"><?php echo vtranslate('LBL_DOWNLOAD_FILE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div><?php }?><div class="col-lg-1 pull-right"><button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true" class='fa fa-close'></span></button></div></div><div class="modal-body row" style="height:550px;"><?php if ($_smarty_tpl->tpl_vars['FILE_PREVIEW_NOT_SUPPORTED']->value=='yes'){?><div class="well" style="height:100%;"><center><b><?php echo vtranslate('LBL_PREVIEW_NOT_AVAILABLE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</b><br><br><br><a class="btn btn-default btn-large" href="<?php echo $_smarty_tpl->tpl_vars['DOWNLOAD_URL']->value;?>
"><?php echo vtranslate('LBL_DOWNLOAD_FILE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a><br><br><br><br><div class='span11 offset1 alert-info' style="padding:10px"><span class='span offset1 alert-info'><i class="icon-info-sign"></i><?php echo vtranslate('LBL_PREVIEW_SUPPORTED_FILES',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</span></div><br></center></div><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['BASIC_FILE_TYPE']->value=='yes'){?><div style="overflow:auto;height:100%;"><pre><?php echo $_smarty_tpl->tpl_vars['FILE_CONTENTS']->value;?>
</pre></div><?php }elseif($_smarty_tpl->tpl_vars['OPENDOCUMENT_FILE_TYPE']->value=='yes'){?><iframe id="viewer" src="libraries/jquery/Viewer.js/#../../../<?php echo $_smarty_tpl->tpl_vars['DOWNLOAD_URL']->value;?>
" width="100%" height="100%" allowfullscreen webkitallowfullscreen></iframe><?php }elseif($_smarty_tpl->tpl_vars['PDF_FILE_TYPE']->value=='yes'){?><iframe id='viewer' src="libraries/jquery/pdfjs/web/viewer.html?file=<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['FILE_PATH']->value;?>
" height="100%" width="100%"></iframe><?php }elseif($_smarty_tpl->tpl_vars['IMAGE_FILE_TYPE']->value=='yes'){?><div style="overflow:auto;height:100%;width:100%;float:left;background-image: url(<?php echo $_smarty_tpl->tpl_vars['DOWNLOAD_URL']->value;?>
);background-color: #EEEEEE;background-position: center 25%;background-repeat: no-repeat;display: block; background-size: contain;"></div><?php }elseif($_smarty_tpl->tpl_vars['AUDIO_FILE_TYPE']->value=='yes'){?><div style="overflow:auto;height:100%;width:100%;float:left;background-color: #EEEEEE;background-position: center 25%;background-repeat: no-repeat;display: block;text-align: center;"><div style="display: inline-block;margin-top : 10%;"><audio controls><source src="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['DOWNLOAD_URL']->value;?>
" type="<?php echo $_smarty_tpl->tpl_vars['FILE_TYPE']->value;?>
"></audio></div></div><?php }elseif($_smarty_tpl->tpl_vars['VIDEO_FILE_TYPE']->value=='yes'){?><div style="overflow:auto;height:100%;"><link href="libraries/jquery/video-js/video-js.css" rel="stylesheet"><script src="libraries/jquery/video-js/video.js"></script><video class="video-js vjs-default-skin" controls preload="auto" data-setup="{'techOrder': ['flash', 'html5']}" width="100%" height="100%"><source src="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['DOWNLOAD_URL']->value;?>
" type='<?php echo $_smarty_tpl->tpl_vars['FILE_TYPE']->value;?>
' /></video></div><?php }?><?php }?></div></div></div></div>
<?php }} ?>