<?php /* Smarty version Smarty-3.1.7, created on 2018-11-26 10:21:11
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Leads/ConvertLead.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20649860805bfb97df1d7843-82088347%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6bb5b975d9d8a5b680c41c18bfd03929f5922525' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Leads/ConvertLead.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20649860805bfb97df1d7843-82088347',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CONVERT_LEAD_FIELDS' => 0,
    'MODULE' => 0,
    'RECORD' => 0,
    'HEADER_TITLE' => 0,
    'IMAGE_ATTACHMENT_ID' => 0,
    'MODULE_NAME' => 0,
    'ACCOUNT_FIELD_MODEL' => 0,
    'CONTACT_FIELD_MODEL' => 0,
    'CONTACT_ACCOUNT_FIELD_MODEL' => 0,
    'LEAD_COMPANY_NAME' => 0,
    'SINGLE_MODULE_NAME' => 0,
    'MODULE_FIELD_MODEL' => 0,
    'FIELD_MODEL' => 0,
    'ASSIGN_TO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfb97df3383c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfb97df3383c')) {function content_5bfb97df3383c($_smarty_tpl) {?>
<div class="modal-dialog"><div id="convertLeadContainer" class='modelContainer modal-content'><?php if (!$_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Accounts']&&!$_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Contacts']){?><input type="hidden" id="convertLeadErrorTitle" value="<?php echo vtranslate('LBL_CONVERT_ERROR_TITLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><input id="convertLeadError" class="convertLeadError" type="hidden" value="<?php echo vtranslate('LBL_CONVERT_LEAD_ERROR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/><?php }else{ ?><?php ob_start();?><?php echo vtranslate('LBL_CONVERT_LEAD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable((($_tmp1).(" ")).($_tmp2), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<form class="form-horizontal" id="convertLeadForm" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"/><input type="hidden" name="view" value="SaveConvertLead"/><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
"/><input type="hidden" name="modules" value=''/><input type="hidden" name="imageAttachmentId" value="<?php echo $_smarty_tpl->tpl_vars['IMAGE_ATTACHMENT_ID']->value;?>
"><?php $_smarty_tpl->tpl_vars['LEAD_COMPANY_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->get('company'), null, 0);?><div class="modal-body accordion container-fluid" id="leadAccordion"><?php  $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['MODULE_NAME']->value = $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->key;
?><div class="row"><div class="col-lg-1"></div><div class="col-lg-10 moduleContent" style="border:1px solid #CCC;"><div class="accordion-group convertLeadModules"><div class="header accordion-heading"><div data-parent="#leadAccordion" data-toggle="collapse" class="accordion-toggle moduleSelection" href="#<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_FieldInfo"><?php if ($_smarty_tpl->tpl_vars['ACCOUNT_FIELD_MODEL']->value->isMandatory()){?><input type="hidden" id="oppAccMandatory" value=<?php echo $_smarty_tpl->tpl_vars['ACCOUNT_FIELD_MODEL']->value->isMandatory();?>
 /><?php }?><?php if ($_smarty_tpl->tpl_vars['CONTACT_FIELD_MODEL']->value->isMandatory()){?><input type="hidden" id="oppConMandatory" value=<?php echo $_smarty_tpl->tpl_vars['CONTACT_FIELD_MODEL']->value->isMandatory();?>
 /><?php }?><?php if ($_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value->isMandatory()){?><input type="hidden" id="conAccMandatory" value=<?php echo $_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value->isMandatory();?>
 /><?php }?><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME'] = new Smarty_variable("SINGLE_".($_smarty_tpl->tpl_vars['MODULE_NAME']->value), null, 0);?><h5><input id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
Module" class="convertLeadModuleSelection" data-module="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Contacts'||($_smarty_tpl->tpl_vars['LEAD_COMPANY_NAME']->value!=''&&$_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Accounts')||($_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value&&$_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value->isMandatory()&&$_smarty_tpl->tpl_vars['MODULE_NAME']->value!='Potentials')){?><?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Accounts'&&$_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value&&$_smarty_tpl->tpl_vars['CONTACT_ACCOUNT_FIELD_MODEL']->value->isMandatory()){?> disabled="disabled" <?php }?> checked="" <?php }?>/>&nbsp;&nbsp;&nbsp;<?php echo vtranslate('LBL_CREATE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h5></div></div><div id="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_FieldInfo" class="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
_FieldInfo accordion-body collapse fieldInfo <?php if ($_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Accounts']&&$_smarty_tpl->tpl_vars['MODULE_NAME']->value=="Accounts"){?> in <?php }elseif(!$_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Accounts']&&$_smarty_tpl->tpl_vars['MODULE_NAME']->value=="Contacts"){?> in <?php }?>"><hr><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
?><div class="row"><div class="fieldLabel col-lg-4"><label class='muted pull-right'><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?></label></div><div class="fieldValue col-lg-8"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName()), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><br><?php } ?></div></div></div><div class="col-lg-1"></div></div><br><?php } ?><div class="defaultFields"><div class="row"><div class="col-lg-1"></div><div class="col-lg-10" style="border:1px solid #CCC;"><div style="margin-top:20px;margin-bottom: 20px;"><div class="row"><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['ASSIGN_TO']->value, null, 0);?><div class="fieldLabel col-lg-4"><label class='muted pull-right'><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;<span class="redColor">*</span></label></div><div class="fieldValue col-lg-8"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><br><div class="row"><div class="fieldLabel col-lg-4"><label class='muted pull-right'><?php echo vtranslate('LBL_TRANSFER_RELATED_RECORD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><div class="fieldValue col-lg-8"><?php  $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['MODULE_NAME']->value = $_smarty_tpl->tpl_vars['MODULE_FIELD_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value!='Potentials'){?><input type="radio" id="transfer<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
" class="transferModule" name="transferModule" value="<?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Contacts']&&$_smarty_tpl->tpl_vars['MODULE_NAME']->value=="Contacts"){?> checked="" <?php }elseif(!$_smarty_tpl->tpl_vars['CONVERT_LEAD_FIELDS']->value['Contacts']&&$_smarty_tpl->tpl_vars['MODULE_NAME']->value=="Accounts"){?> checked="" <?php }?>/><?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Contacts'){?>&nbsp; <?php echo vtranslate('SINGLE_Contacts',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 &nbsp;&nbsp;<?php }else{ ?>&nbsp; <?php echo vtranslate('SINGLE_Accounts',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 &nbsp;&nbsp;<?php }?><?php }?><?php } ?></div></div></div></div><div class="col-lg-1"></div></div><br></div></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }?></div></div>
<?php }} ?>