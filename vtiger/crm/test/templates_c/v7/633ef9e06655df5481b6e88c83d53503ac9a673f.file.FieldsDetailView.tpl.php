<?php /* Smarty version Smarty-3.1.7, created on 2018-12-17 11:14:17
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Webforms/FieldsDetailView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9984306985c1753d180a037-60592270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '633ef9e06655df5481b6e88c83d53503ac9a673f' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Webforms/FieldsDetailView.tpl',
      1 => 1522233382,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9984306985c1753d180a037-60592270',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SOURCE_MODULE' => 0,
    'MODULE_NAME' => 0,
    'SELECTED_FIELD_MODELS_LIST' => 0,
    'FIELD_MODEL' => 0,
    'FIELD_STATUS' => 0,
    'FIELD_VALUE' => 0,
    'FIELD_HIDDEN_STATUS' => 0,
    'EXPLODED_FIELD_VALUE' => 0,
    'RECORD' => 0,
    'DOCUMENT_FILE_FIELDS' => 0,
    'DOCUMENT_FILE_FIELD' => 0,
    'QUALIFIED_MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c1753d196e14',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c1753d196e14')) {function content_5c1753d196e14($_smarty_tpl) {?>

<div class="contents-topscroll"><div class="topscroll-div">&nbsp;</div></div><div class="listViewEntriesDiv contents-bottomscroll"><div class="bottomscroll-div"><div class="fieldBlockContainer"><div class="fieldBlockHeader"><h4><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
<?php $_tmp1=ob_get_clean();?><?php echo vtranslate($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,$_tmp1);?>
 <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo vtranslate('LBL_FIELD_INFORMATION',$_tmp2);?>
</h4></div><hr><table class="table table-bordered"><tr><td class="paddingLeft20"><b><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo vtranslate('LBL_MANDATORY',$_tmp3);?>
</b></td><td><b><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp4=ob_get_clean();?><?php echo vtranslate('LBL_HIDDEN',$_tmp4);?>
</b></td><td><b><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp5=ob_get_clean();?><?php echo vtranslate('LBL_FIELD_NAME',$_tmp5);?>
</b></td><td><b><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp6=ob_get_clean();?><?php echo vtranslate('LBL_OVERRIDE_VALUE',$_tmp6);?>
</b></td><td><b><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp7=ob_get_clean();?><?php echo vtranslate('LBL_WEBFORM_REFERENCE_FIELD',$_tmp7);?>
</b></td></tr><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SELECTED_FIELD_MODELS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['FIELD_STATUS'] = new Smarty_variable(($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('required')), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_HIDDEN_STATUS'] = new Smarty_variable(($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('hidden')), null, 0);?><tr><td class="paddingLeft20"><?php if (($_smarty_tpl->tpl_vars['FIELD_STATUS']->value==1)||($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(true))){?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable("LBL_YES", null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable("LBL_NO", null, 0);?><?php }?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
<?php $_tmp8=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
<?php $_tmp9=ob_get_clean();?><?php echo vtranslate($_tmp8,$_tmp9);?>
</td><td><?php if ($_smarty_tpl->tpl_vars['FIELD_HIDDEN_STATUS']->value==1){?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable("LBL_YES", null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable("LBL_NO", null, 0);?><?php }?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
<?php $_tmp10=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
<?php $_tmp11=ob_get_clean();?><?php echo vtranslate($_tmp10,$_tmp11);?>
</td><td><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
<?php $_tmp12=ob_get_clean();?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_tmp12);?>
<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()){?><span class="redColor">*</span><?php }?></td><td><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType()=='reference'){?><?php $_smarty_tpl->tpl_vars['EXPLODED_FIELD_VALUE'] = new Smarty_variable(explode('x',$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('defaultvalue')), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['EXPLODED_FIELD_VALUE']->value[1], null, 0);?><?php if (!isRecordExists($_smarty_tpl->tpl_vars['FIELD_VALUE']->value)){?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable(0, null, 0);?><?php }?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['FIELD_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('defaultvalue'), null, 0);?><?php }?><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD_VALUE']->value,$_smarty_tpl->tpl_vars['RECORD']->value->getId(),$_smarty_tpl->tpl_vars['RECORD']->value);?>
</td><td><?php if (Settings_Webforms_Record_Model::isCustomField($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name'))){?><?php echo vtranslate('LBL_LABEL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 : <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('neutralizedfield');?>
<?php $_tmp13=ob_get_clean();?><?php echo vtranslate($_tmp13,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
<?php }?></td></tr><?php } ?></tbody></table></div></div></div><?php if (Vtiger_Functions::isDocumentsRelated($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value)&&count($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELDS']->value)){?><div class="listViewEntriesDiv contents-bottomscroll"><div class="bottomscroll-div"><div class="fieldBlockContainer"><div class="fieldBlockHeader"><h4><?php echo vtranslate('LBL_UPLOAD_DOCUMENTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></div><div><div class="col-lg-7 padding0"><table class="table table-bordered"><tr><td><b><?php echo vtranslate('LBL_FIELD_LABEL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</b></td><td><b><?php echo vtranslate('LBL_MANDATORY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</b></td></tr><?php  $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->key => $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value){
$_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->_loop = true;
?><tr><td><?php echo $_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['fieldlabel'];?>
</td><td><?php if ($_smarty_tpl->tpl_vars['DOCUMENT_FILE_FIELD']->value['required']){?><?php echo vtranslate('LBL_YES');?>
<?php }else{ ?><?php echo vtranslate('LBL_NO');?>
<?php }?></td></tr><?php } ?></table></div><div class="col-lg-5"><div class="vt-default-callout vt-info-callout" style="margin: 0;"><h4 class="vt-callout-header"><span class="fa fa-info-circle"></span>&nbsp; <?php echo vtranslate('LBL_INFO');?>
</h4><div><?php echo vtranslate('LBL_FILE_FIELD_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate("SINGLE_".($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value));?>
</div></div></div></div></div></div></div><?php }?></div><?php }} ?>