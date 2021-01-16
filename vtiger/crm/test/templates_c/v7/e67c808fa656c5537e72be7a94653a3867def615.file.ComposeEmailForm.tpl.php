<?php /* Smarty version Smarty-3.1.7, created on 2019-03-09 09:57:12
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/ComposeEmailForm.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5153871075c835cc0905e21-53444473%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e67c808fa656c5537e72be7a94653a3867def615' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/ComposeEmailForm.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5153871075c835cc0905e21-53444473',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'SELECTED_IDS' => 0,
    'EXCLUDED_IDS' => 0,
    'VIEWNAME' => 0,
    'TOMAIL_INFO' => 0,
    'TO' => 0,
    'TOMAIL_NAMES_LIST' => 0,
    'MAX_UPLOAD_SIZE' => 0,
    'EMAIL_MODE' => 0,
    'SOURCE_MODULE' => 0,
    'PARENT_EMAIL_ID' => 0,
    'PARENT_RECORD' => 0,
    'RECORDID' => 0,
    'SEARCH_KEY' => 0,
    'OPERATOR' => 0,
    'ALPHABET_VALUE' => 0,
    'SEARCH_PARAMS' => 0,
    'TO_EMAILS' => 0,
    'RELATED_MODULES' => 0,
    'MODULE_NAME' => 0,
    'FIELD_MODULE' => 0,
    'CC' => 0,
    'BCC' => 0,
    'SUBJECT' => 0,
    'FILE_ATTACHED' => 0,
    'DOCUMENTS_URL' => 0,
    'ATTACHMENTS' => 0,
    'ATTACHMENT' => 0,
    'FILE_TYPE' => 0,
    'DOCUMENT_ID' => 0,
    'DESCRIPTION' => 0,
    'RELATED_LOAD' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c835cc0a9d11',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c835cc0a9d11')) {function content_5c835cc0a9d11($_smarty_tpl) {?>


<div class="SendEmailFormStep2 modal-dialog modal-lg" id="composeEmailContainer"><div class="modal-content"><form class="form-horizontal" id="massEmailForm" method="post" action="index.php" enctype="multipart/form-data" name="massEmailForm"><?php ob_start();?><?php echo vtranslate('LBL_COMPOSE_EMAIL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_tmp1), 0);?>
<div class="modal-body"><input type="hidden" name="selected_ids" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_IDS']->value);?>
' /><input type="hidden" name="excluded_ids" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['EXCLUDED_IDS']->value);?>
' /><input type="hidden" name="viewname" value="<?php echo $_smarty_tpl->tpl_vars['VIEWNAME']->value;?>
" /><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"/><input type="hidden" name="mode" value="massSave" /><input type="hidden" name="toemailinfo" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['TOMAIL_INFO']->value);?>
' /><input type="hidden" name="view" value="MassSaveAjax" /><input type="hidden"  name="to" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['TO']->value);?>
' /><input type="hidden"  name="toMailNamesList" value='<?php echo $_smarty_tpl->tpl_vars['TOMAIL_NAMES_LIST']->value;?>
'/><input type="hidden" id="flag" name="flag" value="" /><input type="hidden" id="maxUploadSize" value="<?php echo $_smarty_tpl->tpl_vars['MAX_UPLOAD_SIZE']->value;?>
" /><input type="hidden" id="documentIds" name="documentids" value="" /><input type="hidden" name="emailMode" value="<?php echo $_smarty_tpl->tpl_vars['EMAIL_MODE']->value;?>
" /><input type="hidden" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><?php if (!empty($_smarty_tpl->tpl_vars['PARENT_EMAIL_ID']->value)){?><input type="hidden" name="parent_id" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_EMAIL_ID']->value;?>
" /><input type="hidden" name="parent_record_id" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_RECORD']->value;?>
" /><?php }?><?php if (!empty($_smarty_tpl->tpl_vars['RECORDID']->value)){?><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORDID']->value;?>
" /><?php }?><input type="hidden" name="search_key" value= "<?php echo $_smarty_tpl->tpl_vars['SEARCH_KEY']->value;?>
" /><input type="hidden" name="operator" value="<?php echo $_smarty_tpl->tpl_vars['OPERATOR']->value;?>
" /><input type="hidden" name="search_value" value="<?php echo $_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value;?>
" /><input type="hidden" name="search_params" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SEARCH_PARAMS']->value);?>
' /><div class="row toEmailField"><div class="col-lg-12"><div class="col-lg-2"><span class="pull-right"><?php echo vtranslate('LBL_TO',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span></span></div><div class="col-lg-6"><?php if (!empty($_smarty_tpl->tpl_vars['TO']->value)){?><?php $_smarty_tpl->tpl_vars['TO_EMAILS'] = new Smarty_variable(implode(",",$_smarty_tpl->tpl_vars['TO']->value), null, 0);?><?php }?><input id="emailField" style="width:100%" name="toEmail" type="text" class="autoComplete sourceField select2" data-rule-required="true" data-rule-multiEmails="true" value="<?php echo $_smarty_tpl->tpl_vars['TO_EMAILS']->value;?>
" placeholder="<?php echo vtranslate('LBL_TYPE_AND_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></div><div class="col-lg-4 input-group"><select style="width: 140px;" class="select2 emailModulesList pull-right"><?php  $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_NAME']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_NAME']->key => $_smarty_tpl->tpl_vars['MODULE_NAME']->value){
$_smarty_tpl->tpl_vars['MODULE_NAME']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value==$_smarty_tpl->tpl_vars['FIELD_MODULE']->value){?> selected <?php }?>><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</option><?php } ?></select><a href="#" class="clearReferenceSelection cursorPointer" name="clearToEmailField"> X </a><span class="input-group-addon"><span class="selectEmail cursorPointer"><i class="fa fa-search" title="<?php echo vtranslate('LBL_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></span></span></div></div></div><div class="row <?php if (empty($_smarty_tpl->tpl_vars['CC']->value)){?> hide <?php }?> ccContainer"><div class="col-lg-12"><div class="col-lg-2"><span class="pull-right"><?php echo vtranslate('LBL_CC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div><div class="col-lg-6"><input type="text" name="cc" data-rule-multiEmails="true" value="<?php if (!empty($_smarty_tpl->tpl_vars['CC']->value)){?><?php echo $_smarty_tpl->tpl_vars['CC']->value;?>
<?php }?>"/></div><div class="col-lg-4"></div></div></div><div class="row <?php if (empty($_smarty_tpl->tpl_vars['BCC']->value)){?> hide <?php }?> bccContainer"><div class="col-lg-12"><div class="col-lg-2"><span class="pull-right"><?php echo vtranslate('LBL_BCC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div><div class="col-lg-6"><input type="text" name="bcc" data-rule-multiEmails="true" value="<?php if (!empty($_smarty_tpl->tpl_vars['BCC']->value)){?><?php echo $_smarty_tpl->tpl_vars['BCC']->value;?>
<?php }?>"/></div><div class="col-lg-4"></div></div></div><div class="row <?php if ((!empty($_smarty_tpl->tpl_vars['CC']->value))&&(!empty($_smarty_tpl->tpl_vars['BCC']->value))){?> hide <?php }?> "><div class="col-lg-12"><div class="col-lg-2"></div><div class="col-lg-6"><a href="#" class="cursorPointer <?php if ((!empty($_smarty_tpl->tpl_vars['CC']->value))){?>hide<?php }?>" id="ccLink"><?php echo vtranslate('LBL_ADD_CC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>&nbsp;&nbsp;<a href="#" class="cursorPointer <?php if ((!empty($_smarty_tpl->tpl_vars['BCC']->value))){?>hide<?php }?>" id="bccLink"><?php echo vtranslate('LBL_ADD_BCC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><div class="col-lg-4"></div></div></div><div class="row subjectField"><div class="col-lg-12"><div class="col-lg-2"><span class="pull-right"><?php echo vtranslate('LBL_SUBJECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span></span></div><div class="col-lg-6"><input type="text" name="subject" value="<?php echo $_smarty_tpl->tpl_vars['SUBJECT']->value;?>
" data-rule-required="true" id="subject" spellcheck="true" class="inputElement"/></div><div class="col-lg-4"></div></div></div><div class="row attachment"><div class="col-lg-12"><div class="col-lg-2"><span class="pull-right"><?php echo vtranslate('LBL_ATTACHMENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div><div class="col-lg-9"><div class="row"><div class="col-lg-4 browse"><input type="file" <?php if ($_smarty_tpl->tpl_vars['FILE_ATTACHED']->value){?>class="removeNoFileChosen"<?php }?> id="multiFile" name="file[]"/>&nbsp;</div><div class="col-lg-4 brownseInCrm"><button type="button" class="btn btn-small btn-default" id="browseCrm" data-url="<?php echo $_smarty_tpl->tpl_vars['DOCUMENTS_URL']->value;?>
" title="<?php echo vtranslate('LBL_BROWSE_CRM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><?php echo vtranslate('LBL_BROWSE_CRM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div><div class="col-lg-4 insertTemplate"><button id="selectEmailTemplate" class="btn btn-success pull-right" data-url="module=EmailTemplates&view=Popup"><?php echo vtranslate('LBL_SELECT_EMAIL_TEMPLATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button></div></div><div id="attachments"><?php  $_smarty_tpl->tpl_vars['ATTACHMENT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ATTACHMENT']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ATTACHMENTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ATTACHMENT']->key => $_smarty_tpl->tpl_vars['ATTACHMENT']->value){
$_smarty_tpl->tpl_vars['ATTACHMENT']->_loop = true;
?><?php if ((array_key_exists('docid',$_smarty_tpl->tpl_vars['ATTACHMENT']->value))){?><?php $_smarty_tpl->tpl_vars['DOCUMENT_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['ATTACHMENT']->value['docid'], null, 0);?><?php $_smarty_tpl->tpl_vars['FILE_TYPE'] = new Smarty_variable("document", null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['FILE_TYPE'] = new Smarty_variable("file", null, 0);?><?php }?><div class="MultiFile-label customAttachment" data-file-id="<?php echo $_smarty_tpl->tpl_vars['ATTACHMENT']->value['fileid'];?>
" data-file-type="<?php echo $_smarty_tpl->tpl_vars['FILE_TYPE']->value;?>
"  data-file-size="<?php echo $_smarty_tpl->tpl_vars['ATTACHMENT']->value['size'];?>
" <?php if ($_smarty_tpl->tpl_vars['FILE_TYPE']->value=="document"){?> data-document-id="<?php echo $_smarty_tpl->tpl_vars['DOCUMENT_ID']->value;?>
"<?php }?>><?php if ($_smarty_tpl->tpl_vars['ATTACHMENT']->value['nondeletable']!=true){?><a name="removeAttachment" class="cursorPointer">x </a><?php }?><span><?php echo $_smarty_tpl->tpl_vars['ATTACHMENT']->value['attachment'];?>
</span></div><?php } ?></div></div></div></div><div class="row"><div class="col-lg-12"><div class="col-lg-2"><span class="pull-right"><?php echo vtranslate('LBL_INCLUDE_SIGNATURE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></div><div class="item col-lg-9"><input class="" type="checkbox" name="signature" value="Yes" checked="checked" id="signature"></div></div></div><div class="container-fluid hide" id='emailTemplateWarning'><div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert">&times;</a><p><?php echo vtranslate('LBL_EMAILTEMPLATE_WARNING_CONTENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</p></div></div><div class="row templateContent"><div class="col-lg-12"><textarea style="width:390px;height:200px;" id="description" name="description"><?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
</textarea></div></div><?php if ($_smarty_tpl->tpl_vars['RELATED_LOAD']->value==true){?><input type="hidden" name="related_load" value=<?php echo $_smarty_tpl->tpl_vars['RELATED_LOAD']->value;?>
 /><?php }?><input type="hidden" name="attachments" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['ATTACHMENTS']->value);?>
' /><div id="emailTemplateWarningContent" style="display: none;"><?php echo vtranslate('LBL_EMAILTEMPLATE_WARNING_CONTENT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div></div><div class="modal-footer"><div class="pull-right cancelLinkContainer"><a href="#" class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><button id="sendEmail" name="sendemail" class="btn btn-success" title="<?php echo vtranslate("LBL_SEND_EMAIL",$_smarty_tpl->tpl_vars['MODULE']->value);?>
" type="submit"><strong><?php echo vtranslate("LBL_SEND_EMAIL",$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><button id="saveDraft" name="savedraft" class="btn btn-default" title="<?php echo vtranslate('LBL_SAVE_AS_DRAFT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" type="submit"><strong><?php echo vtranslate('LBL_SAVE_AS_DRAFT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button></div></form></div></div>
<?php }} ?>