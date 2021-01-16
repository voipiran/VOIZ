<?php /* Smarty version Smarty-3.1.7, created on 2018-12-10 09:09:06
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/PDFMaker/DetailFree.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14253082845c0dfbfa486dc2-82175641%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dcf537d582991368b660c1f6b096c198af0758e8' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/PDFMaker/DetailFree.tpl',
      1 => 1523862902,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14253082845c0dfbfa486dc2-82175641',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TEMPLATEID' => 0,
    'PARENTTAB' => 0,
    'DESCRIPTION' => 0,
    'MODULENAME' => 0,
    'MODULE' => 0,
    'BODY' => 0,
    'HEADER' => 0,
    'FOOTER' => 0,
    'VERSION' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c0dfbfa4cc8d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c0dfbfa4cc8d')) {function content_5c0dfbfa4cc8d($_smarty_tpl) {?>
<div class="detailview-content container-fluid"><div class="details row"><form id="detailView" method="post" action="index.php" name="etemplatedetailview"><input type="hidden" name="action" value=""><input type="hidden" name="view" value=""><input type="hidden" name="module" value="PDFMaker"><input type="hidden" name="retur_module" value="PDFMaker"><input type="hidden" name="return_action" value="PDFMaker"><input type="hidden" name="return_view" value="Detail"><input type="hidden" name="templateid" value="<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
"><input type="hidden" name="parenttab" value="<?php echo $_smarty_tpl->tpl_vars['PARENTTAB']->value;?>
"><input type="hidden" name="subjectChanged" value=""><input type="hidden" name="record" id="recordId" value="<?php echo $_smarty_tpl->tpl_vars['TEMPLATEID']->value;?>
" ><div class="col-lg-12"><div class="left-block col-lg-4"><div class="summaryView"><div class="summaryViewHeader"><h4 class="display-inline-block"><?php echo vtranslate('LBL_TEMPLATE_INFORMATIONS','PDFMaker');?>
</h4></div><div class="summaryViewFields"><div class="recordDetails"><table class="summary-table no-border"><tbody><tr class="summaryViewEntries"><td class="fieldLabel"><label class="muted textOverflowEllipsis"><?php echo vtranslate('LBL_DESCRIPTION','PDFMaker');?>
</label></td><td class="fieldValue" valign=top><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</td></tr><tr class="summaryViewEntries"><td class="fieldLabel"><label class="muted textOverflowEllipsis"><?php echo vtranslate('LBL_MODULENAMES','PDFMaker');?>
</label></td><td class="fieldValue" valign=top><?php echo $_smarty_tpl->tpl_vars['MODULENAME']->value;?>
</td></tr></tbody></table></div></div></div><br><br></div><div class="middle-block col-lg-8"><div id="ContentEditorTabs"><ul class="nav nav-pills"><li class="active" data-type="body"><a href="#body_div2" aria-expanded="false" data-toggle="tab"><?php echo vtranslate('LBL_BODY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li data-type="header"><a href="#header_div2" aria-expanded="false" data-toggle="tab"><?php echo vtranslate('LBL_HEADER_TAB',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li data-type="footer"><a href="#footer_div2" aria-expanded="false" data-toggle="tab"><?php echo vtranslate('LBL_FOOTER_TAB',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li></ul></div><div class="tab-content"><div class="tab-pane active" id="body_div2"><div id="previewcontent_body" class="hide"><?php echo $_smarty_tpl->tpl_vars['BODY']->value;?>
</div><iframe id="preview_body" class="col-lg-12" style="height:1200px;"></iframe></div><div class="tab-pane" id="header_div2"><div id="previewcontent_header" class="hide"><?php echo $_smarty_tpl->tpl_vars['HEADER']->value;?>
</div><iframe id="preview_header" class="col-lg-12" style="height:500px;"></iframe></div><div class="tab-pane" id="footer_div2"><div id="previewcontent_footer" class="hide"><?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>
</div><iframe id="preview_footer" class="col-lg-12" style="height:500px;"></iframe></div></div></div></div><center style="color: rgb(153, 153, 153);"><?php echo vtranslate('PDF_MAKER','PDFMaker');?>
 <?php echo $_smarty_tpl->tpl_vars['VERSION']->value;?>
 <?php echo vtranslate('COPYRIGHT','PDFMaker');?>
</center></form></div></div><script type="text/javascript">jQuery(document).ready(function() {PDFMaker_DetailFree_Js.setPreviewContent('body');PDFMaker_DetailFree_Js.setPreviewContent('header');PDFMaker_DetailFree_Js.setPreviewContent('footer');});</script><?php }} ?>