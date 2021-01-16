<?php /* Smarty version Smarty-3.1.7, created on 2018-11-28 10:39:00
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/PDFMaker/GetPDFActions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14700495655bfe3f0c0f3543-68801982%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b507896e832363875f32e5644243e5060c1cd6de' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/PDFMaker/GetPDFActions.tpl',
      1 => 1523862902,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14700495655bfe3f0c0f3543-68801982',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ENABLE_PDFMAKER' => 0,
    'EMAIL_FUNCTION' => 0,
    'TEMPLATE_LANGUAGES' => 0,
    'CURRENT_LANGUAGE' => 0,
    'lang_key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfe3f0c171d8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfe3f0c171d8')) {function content_5bfe3f0c171d8($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/var/www/webroot/ROOT/libraries/Smarty/libs/plugins/function.html_options.php';
?>
<?php if ($_smarty_tpl->tpl_vars['ENABLE_PDFMAKER']->value=='true'){?>

    <input type="hidden" name="email_function" id="email_function" value="<?php echo $_smarty_tpl->tpl_vars['EMAIL_FUNCTION']->value;?>
"/>
    
    <li>
        <a href="javascript:;" class="PDFMakerDownloadPDF PDFMakerTemplateAction"><?php echo vtranslate('LBL_DOWNLOAD','PDFMaker');?>
</a>
    </li>
    <li class="dropdown-header">
        <i class="fa fa-settings"></i> <?php echo vtranslate('LBL_SETTINGS','PDFMaker');?>

    </li>
        <li>
            <a href="javascript:;" class="showPDFBreakline"><?php echo vtranslate('LBL_PRODUCT_BREAKLINE','PDFMaker');?>
</a>
        </li>
    <li>
        <a href="javascript:;" class="showProductImages"><?php echo vtranslate('LBL_PRODUCT_IMAGE','PDFMaker');?>
</a>
    </li>

    <?php if (sizeof($_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value)>1){?>
        <li class="dropdown-header">
            <i class="fa fa-settings"></i> <?php echo vtranslate('LBL_PDF_LANGUAGE','PDFMaker');?>

        </li>
        <li>
            <select name="template_language" id="template_language" class="col-lg-12">
                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value,'selected'=>$_smarty_tpl->tpl_vars['CURRENT_LANGUAGE']->value),$_smarty_tpl);?>

            </select>
        </li>
    <?php }else{ ?>
        <?php  $_smarty_tpl->tpl_vars["lang"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["lang"]->_loop = false;
 $_smarty_tpl->tpl_vars["lang_key"] = new Smarty_Variable;
 $_from = ($_smarty_tpl->tpl_vars['TEMPLATE_LANGUAGES']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["lang"]->key => $_smarty_tpl->tpl_vars["lang"]->value){
$_smarty_tpl->tpl_vars["lang"]->_loop = true;
 $_smarty_tpl->tpl_vars["lang_key"]->value = $_smarty_tpl->tpl_vars["lang"]->key;
?>
            <input type="text" name="template_language" id="template_language" value="<?php echo $_smarty_tpl->tpl_vars['lang_key']->value;?>
"/>
        <?php } ?>
    <?php }?>
<?php }?>
<?php }} ?>