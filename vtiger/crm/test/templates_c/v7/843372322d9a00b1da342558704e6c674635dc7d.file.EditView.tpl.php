<?php /* Smarty version Smarty-3.1.7, created on 2019-03-25 12:29:08
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Workflows/EditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:828552155c988a4c687654-76954061%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '843372322d9a00b1da342558704e6c674635dc7d' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Workflows/EditView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '828552155c988a4c687654-76954061',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WORKFLOW_MODEL' => 0,
    'RECORDID' => 0,
    'RETURN_SOURCE_MODULE' => 0,
    'RETURN_PAGE' => 0,
    'RETURN_SEARCH_VALUE' => 0,
    'QUALIFIED_MODULE' => 0,
    'WORKFLOW_MODEL_OBJ' => 0,
    'MODE' => 0,
    'MODULE_MODEL' => 0,
    'ALL_MODULES' => 0,
    'SELECTED_MODULE' => 0,
    'SINGLE_MODULE' => 0,
    'TARGET_MODULE_NAME' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c988a4c75380',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c988a4c75380')) {function content_5c988a4c75380($_smarty_tpl) {?>
<div class="editViewPageDiv"><div class="col-sm-12 col-xs-12" id="EditView"><form name="EditWorkflow" action="index.php" method="post" id="workflow_edit" class="form-horizontal"><?php $_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ'] = new Smarty_variable($_smarty_tpl->tpl_vars['WORKFLOW_MODEL']->value->getWorkflowObject(), null, 0);?><input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORDID']->value;?>
" id="record" /><input type="hidden" name="module" value="Workflows" /><input type="hidden" name="action" value="SaveWorkflow" /><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="returnsourcemodule" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_SOURCE_MODULE']->value;?>
" /><input type="hidden" name="returnpage" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_PAGE']->value;?>
" /><input type="hidden" name="returnsearch_value" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_SEARCH_VALUE']->value;?>
" /><div class="editViewHeader"><div class='row'><div class="col-lg-12 col-md-12 col-lg-pull-0"><h4><?php echo vtranslate('LBL_BASIC_INFORMATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div></div></div><hr style="margin-top: 0px !important;"><div class="editViewBody"><div class="editViewContents" style="text-align: center; "><div class="form-group"><label for="name" class="col-sm-3 control-label"><?php echo vtranslate('LBL_WORKFLOW_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<span class="redColor">*</span></label><div class="col-sm-5 controls"><input class="form-control" id="name"  name="workflowname" value="<?php echo $_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->workflowname;?>
" data-rule-required="true"></div></div><div class="form-group"><label for="name" class="col-sm-3 control-label"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-5 controls"><textarea class="form-control" name="summary" id="summary"><?php echo $_smarty_tpl->tpl_vars['WORKFLOW_MODEL']->value->get('summary');?>
</textarea></div></div><div class="form-group"><label for="module_name" class="col-sm-3 control-label"><?php echo vtranslate('LBL_TARGET_MODULE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-5 controls"><?php if ($_smarty_tpl->tpl_vars['MODE']->value=='edit'){?><div class="pull-left"><input type='text' disabled='disabled' class="inputElement" value="<?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());?>
" ><input type='hidden' id="module_name" name='module_name' value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->get('name');?>
" ></div><?php }else{ ?><select class="select2 col-sm-6 pull-left" id="module_name" name="module_name" required="true" data-placeholder="Select Module..." style="text-align: left"><?php  $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['TABID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_MODEL']->key => $_smarty_tpl->tpl_vars['MODULE_MODEL']->value){
$_smarty_tpl->tpl_vars['MODULE_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['TABID']->value = $_smarty_tpl->tpl_vars['MODULE_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['TARGET_MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName(), null, 0);?><?php $_smarty_tpl->tpl_vars['SINGLE_MODULE'] = new Smarty_variable("SINGLE_".($_smarty_tpl->tpl_vars['TARGET_MODULE_NAME']->value), null, 0);?><option value="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName();?>
" <?php if ($_smarty_tpl->tpl_vars['SELECTED_MODULE']->value==$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName()){?> selected <?php }?>data-create-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE']->value,$_smarty_tpl->tpl_vars['TARGET_MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_CREATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"data-update-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE']->value,$_smarty_tpl->tpl_vars['TARGET_MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_UPDATED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName()=='Calendar'){?><?php echo vtranslate('LBL_TASK',$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());?>
<?php }else{ ?><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getName());?>
<?php }?></option><?php } ?></select><?php }?></div></div><div class="form-group"><label for="status" class="col-sm-3 control-label"><?php echo vtranslate('LBL_STATUS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="col-sm-5 controls"><div class="pull-left"><span style="margin-right: 10px;"><input name="status" type="radio" value="active" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->status=='1'){?> checked="" <?php }?>>&nbsp;<span><?php echo vtranslate('Active',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></span><span style="margin-right: 10px;"><input name="status" type="radio" value="inActive" <?php if ($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value->status=='0'||empty($_smarty_tpl->tpl_vars['WORKFLOW_MODEL_OBJ']->value)){?> checked="" <?php }?>>&nbsp;<span><?php echo vtranslate('InActive',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></span></div></div></div></div></div><div class="editViewHeader"><div class='row'><div class="col-lg-12 col-md-12 col-lg-pull-0"><h4><?php echo vtranslate('LBL_WORKFLOW_TRIGGER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div></div></div><hr style="margin-top: 0px !important;"><div class="editViewBody"><div class="editViewContents" style="padding-bottom: 0px;"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('WorkFlowTrigger.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><div id="workflow_condition"></div><div class="modal-overlay-footer clearfix"><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink' href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div></div><?php }} ?>