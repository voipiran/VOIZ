<?php /* Smarty version Smarty-3.1.7, created on 2019-02-05 13:31:32
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Documents/UploadDocument.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15413524775c595efc6850b5-34176695%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9861ca7bd49eefb4c1799ef469d7c6b42cc23267' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Documents/UploadDocument.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15413524775c595efc6850b5-34176695',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'PICKIST_DEPENDENCY_DATASOURCE' => 0,
    'RELATION_OPERATOR' => 0,
    'PARENT_MODULE' => 0,
    'PARENT_ID' => 0,
    'RELATION_FIELD_NAME' => 0,
    'MAX_UPLOAD_LIMIT_BYTES' => 0,
    'MAX_UPLOAD_LIMIT_MB' => 0,
    'FIELD_MODELS' => 0,
    'FIELD_MODEL' => 0,
    'FIELD_VALUE' => 0,
    'FIELD_NAME' => 0,
    'HARDCODED_FIELDS' => 0,
    'referenceList' => 0,
    'COUNTER' => 0,
    'isReferenceField' => 0,
    'referenceListCount' => 0,
    'DISPLAYID' => 0,
    'REFERENCED_MODULE_STRUCT' => 0,
    'value' => 0,
    'REFERENCED_MODULE_NAME' => 0,
    'TAXCLASS_DETAILS' => 0,
    'taxCount' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c595efc8c949',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c595efc8c949')) {function content_5c595efc8c949($_smarty_tpl) {?>

<div class="modal-dialog modelContainer"><?php ob_start();?><?php echo vtranslate('LBL_UPLOAD_TO_VTIGER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable($_tmp1, null, 0);?><div class="modal-content" style="width:675px;"><form class="form-horizontal recordEditView" name="upload" method="post" action="index.php"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<div class="modal-body"><div class="uploadview-content container-fluid"><div class="uploadcontrols row"><div id="upload" data-filelocationtype="I"><?php if (!empty($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value)){?><input type="hidden" name="picklistDependency" value='<?php echo Vtiger_Util_Helper::toSafeHTML($_smarty_tpl->tpl_vars['PICKIST_DEPENDENCY_DATASOURCE']->value);?>
' /><?php }?><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="SaveAjax" /><input type="hidden" name="document_source" value="Vtiger" /><?php if ($_smarty_tpl->tpl_vars['RELATION_OPERATOR']->value=='true'){?><input type="hidden" name="relationOperation" value="<?php echo $_smarty_tpl->tpl_vars['RELATION_OPERATOR']->value;?>
" /><input type="hidden" name="sourceModule" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_MODULE']->value;?>
" /><input type="hidden" name="sourceRecord" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
" /><?php if ($_smarty_tpl->tpl_vars['RELATION_FIELD_NAME']->value){?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD_NAME']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_ID']->value;?>
" /><?php }?><?php }?><input type="hidden" name="max_upload_limit" value="<?php echo $_smarty_tpl->tpl_vars['MAX_UPLOAD_LIMIT_BYTES']->value;?>
" /><input type="hidden" name="max_upload_limit_mb" value="<?php echo $_smarty_tpl->tpl_vars['MAX_UPLOAD_LIMIT_MB']->value;?>
" /><div id="dragandrophandler" class="dragdrop-dotted"><div style="font-size:175%;"><span class="fa fa-upload"></span>&nbsp;&nbsp;<?php echo vtranslate('LBL_DRAG_&_DROP_FILE_HERE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div style="margin-top: 1%;text-transform: uppercase;margin-bottom: 2%;"><?php echo vtranslate('LBL_OR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><div><div class="fileUploadBtn btn btn-primary"><span><i class="fa fa-laptop"></i> <?php echo vtranslate('LBL_SELECT_FILE_FROM_COMPUTER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODELS']->value['filename'], null, 0);?><input type="file" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldName();?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_VALUE']->value;?>
" data-rule-required="true" /></div>&nbsp;&nbsp;&nbsp;<i class="fa fa-info-circle cursorPointer" data-toggle="tooltip" title="<?php echo vtranslate('LBL_MAX_UPLOAD_SIZE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['MAX_UPLOAD_LIMIT_MB']->value;?>
<?php echo vtranslate('MB',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></div><div class="fileDetails"></div></div><table class="massEditTable table no-border"><tr><?php $_smarty_tpl->tpl_vars["FIELD_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODELS']->value['notes_title'], null, 0);?><td class="fieldLabel col-lg-2"><label class="muted pull-right"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?><span class="redColor">*</span><?php }?></label></td><td class="fieldValue col-lg-4" colspan="3"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td></tr><tr><?php $_smarty_tpl->tpl_vars["FIELD_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODELS']->value['assigned_user_id'], null, 0);?><td class="fieldLabel col-lg-2"><label class="muted pull-right"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?><span class="redColor">*</span><?php }?></label></td><td class="fieldValue col-lg-4"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td><?php $_smarty_tpl->tpl_vars["FIELD_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODELS']->value['folderid'], null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODELS']->value['folderid']){?><td class="fieldLabel col-lg-2"><label class="muted pull-right"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?><span class="redColor">*</span><?php }?></label></td><td class="fieldValue col-lg-4"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td><?php }?></tr><tr><?php $_smarty_tpl->tpl_vars["FIELD_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODELS']->value['notecontent'], null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODELS']->value['notecontent']){?><td class="fieldLabel col-lg-2" colspan="1"><label class="muted pull-right"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?><span class="redColor">*</span><?php }?></label></td><td class="fieldValue col-lg-4" colspan="3"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td><?php }?></tr><tr><?php $_smarty_tpl->tpl_vars['HARDCODED_FIELDS'] = new Smarty_variable(explode(',',"filename,assigned_user_id,folderid,notecontent,notes_title"), null, 0);?><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELD_MODELS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if (!in_array($_smarty_tpl->tpl_vars['FIELD_NAME']->value,$_smarty_tpl->tpl_vars['HARDCODED_FIELDS']->value)&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateEnabled()){?><?php $_smarty_tpl->tpl_vars["isReferenceField"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataType(), null, 0);?><?php $_smarty_tpl->tpl_vars["referenceList"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getReferenceList(), null, 0);?><?php $_smarty_tpl->tpl_vars["referenceListCount"] = new Smarty_variable(count($_smarty_tpl->tpl_vars['referenceList']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=="19"){?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value=='1'){?><td></td><td></td></tr><tr><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value==2){?></tr><tr><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(1, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?><?php }?><td class='fieldLabel col-lg-2'><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value!="reference"){?><label class="muted pull-right"><?php }?><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value=="reference"){?><?php if ($_smarty_tpl->tpl_vars['referenceListCount']->value>1){?><?php $_smarty_tpl->tpl_vars["DISPLAYID"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('fieldvalue'), null, 0);?><?php $_smarty_tpl->tpl_vars["REFERENCED_MODULE_STRUCT"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getReferenceModule($_smarty_tpl->tpl_vars['DISPLAYID']->value), null, 0);?><?php if (!empty($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value)){?><?php $_smarty_tpl->tpl_vars["REFERENCED_MODULE_NAME"] = new Smarty_variable($_smarty_tpl->tpl_vars['REFERENCED_MODULE_STRUCT']->value->get('name'), null, 0);?><?php }?><span class="pull-right"><select style="width:150px;" class="select2 referenceModulesList <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?>reference-mandatory<?php }?>"><?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['referenceList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value){
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['value']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['value']->value==$_smarty_tpl->tpl_vars['REFERENCED_MODULE_NAME']->value){?> selected <?php }?> ><?php echo vtranslate($_smarty_tpl->tpl_vars['value']->value,$_smarty_tpl->tpl_vars['value']->value);?>
</option><?php } ?></select></span><?php }else{ ?><label class="muted pull-right"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?></label><?php }?><?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='83'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('COUNTER'=>$_smarty_tpl->tpl_vars['COUNTER']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value), 0);?>
<?php if ($_smarty_tpl->tpl_vars['TAXCLASS_DETAILS']->value){?><?php $_smarty_tpl->tpl_vars['taxCount'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['TAXCLASS_DETAILS']->value)%2, null, 0);?><?php if ($_smarty_tpl->tpl_vars['taxCount']->value==0){?><?php if ($_smarty_tpl->tpl_vars['COUNTER']->value==2){?><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(1, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(2, null, 0);?><?php }?><?php }?><?php }?><?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span class="redColor">*</span> <?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['isReferenceField']->value!="reference"){?></label><?php }?></td><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')!='83'){?><td class="fieldValue col-lg-4" <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')=='19'){?> colspan="3" <?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?> <?php }?>><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getUITypeModel()->getTemplateName(),$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</td><?php }?><?php }?><?php } ?></tr></table></div></div></div></div><?php ob_start();?><?php echo vtranslate('LBL_UPLOAD',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['BUTTON_NAME'] = new Smarty_variable($_tmp2, null, 0);?><?php $_smarty_tpl->tpl_vars['BUTTON_ID'] = new Smarty_variable("js-upload-document", null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalFooter.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div></div>
<?php }} ?>