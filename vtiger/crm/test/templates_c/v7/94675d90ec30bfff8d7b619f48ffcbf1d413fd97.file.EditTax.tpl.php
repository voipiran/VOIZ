<?php /* Smarty version Smarty-3.1.7, created on 2019-02-06 12:56:02
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Vtiger/EditTax.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9921637355c5aa82a6167e7-62718408%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94675d90ec30bfff8d7b619f48ffcbf1d413fd97' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Vtiger/EditTax.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9921637355c5aa82a6167e7-62718408',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TAX_RECORD_MODEL' => 0,
    'CURRENT_USER_MODEL' => 0,
    'TAX_ID' => 0,
    'TAX_MODEL_EXISTS' => 0,
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
    'TITLE' => 0,
    'TAX_TYPE' => 0,
    'SIMPLE_TAX_MODELS_LIST' => 0,
    'SIMPLE_TAX_ID' => 0,
    'SELECTED_SIMPLE_TAXES' => 0,
    'SIMPLE_TAX_MODEL' => 0,
    'WIDTHTYPE' => 0,
    'i' => 0,
    'TAX_REGIONS' => 0,
    'TAX_REGION_MODEL' => 0,
    'TAX_REGION_ID' => 0,
    'REGIONS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5aa82a7e487',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5aa82a7e487')) {function content_5c5aa82a7e487($_smarty_tpl) {?>


<?php $_smarty_tpl->tpl_vars['TAX_MODEL_EXISTS'] = new Smarty_variable(true, null, 0);?><?php $_smarty_tpl->tpl_vars['TAX_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getId(), null, 0);?><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><?php if (empty($_smarty_tpl->tpl_vars['TAX_ID']->value)){?><?php $_smarty_tpl->tpl_vars['TAX_MODEL_EXISTS'] = new Smarty_variable(false, null, 0);?><?php }?><div class="taxModalContainer modal-dialog modal-xs"><div class="modal-content"><form id="editTax" class="form-horizontal" method="POST"><?php if ($_smarty_tpl->tpl_vars['TAX_MODEL_EXISTS']->value){?><?php ob_start();?><?php echo vtranslate('LBL_EDIT_TAX',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['TITLE'] = new Smarty_variable($_tmp1, null, 0);?><?php }else{ ?><?php ob_start();?><?php echo vtranslate('LBL_ADD_NEW_TAX',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['TITLE'] = new Smarty_variable($_tmp2, null, 0);?><?php }?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0);?>
<input type="hidden" name="taxid" value="<?php echo $_smarty_tpl->tpl_vars['TAX_ID']->value;?>
" /><input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['TAX_TYPE']->value;?>
" /><div class="modal-body" id="scrollContainer"><div class=""><div class="block nameBlock row"><div class="col-lg-1"></div><div class="col-lg-3"><label class="pull-right"><?php echo vtranslate('LBL_TAX_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label></div><div class="col-lg-5"><input class="inputElement" type="text" name="taxlabel" placeholder="<?php echo vtranslate('LBL_ENTER_TAX_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getName();?>
" data-rule-required="true" data-prompt-position="bottomLeft" /></div><div class="col-lg-3"></div></div><div class="block statusBlock row"><div class="col-lg-1"></div><div class="col-lg-3"><label class="pull-right"><?php echo vtranslate('LBL_STATUS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></div><div class="col-lg-7"><input type="hidden" name="deleted" value="1" /><label><input type="checkbox" name="deleted" value="0" class="taxStatus" <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->isDeleted()==0||!$_smarty_tpl->tpl_vars['TAX_ID']->value){?> checked <?php }?> /><span>&nbsp;&nbsp;<?php echo vtranslate('LBL_TAX_STATUS_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></label></div><div class="col-lg-1"></div></div><?php if ($_smarty_tpl->tpl_vars['TAX_MODEL_EXISTS']->value==false){?><div class="block taxCalculationBlock row"><div class="col-lg-1"></div><div class="col-lg-3"><label class="pull-right"><?php echo vtranslate('LBL_TAX_CALCULATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></div><div class="col-lg-7"><label class="span radio-group" id="simple"><input type="radio" name="method" class="input-medium" <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxMethod()=='Simple'||!$_smarty_tpl->tpl_vars['TAX_ID']->value){?>checked<?php }?> value="Simple" />&nbsp;&nbsp;<span class="radio-label"><?php echo vtranslate('LBL_SIMPLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></label>&nbsp;&nbsp;<label class="span radio-group" id="compound"><input type="radio" name="method" class="input-medium" <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxMethod()=='Compound'){?>checked<?php }?> value="Compound" />&nbsp;&nbsp;<span class="radio-label"><?php echo vtranslate('LBL_COMPOUND',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></label>&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['TAX_TYPE']->value!=1){?><label class="span radio-group" id="deducted"><input type="radio" name="method" class="input-medium" <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxMethod()=='Deducted'){?>checked<?php }?> value="Deducted" />&nbsp;&nbsp;<span class="radio-label"><?php echo vtranslate('LBL_DEDUCTED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></label><?php }?></div><div class="col-lg-1"></div></div><?php }else{ ?><input type="hidden" name="method" value="<?php echo $_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxMethod();?>
" /><?php }?><div class="block compoundOnContainer row <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxMethod()!='Compound'){?>hide<?php }?>"><div class="col-lg-1"></div><div class="col-lg-3"><label class="pull-right"><?php echo vtranslate('LBL_COMPOUND_ON',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label></div><div class="col-lg-5"><div class=""><?php $_smarty_tpl->tpl_vars['SELECTED_SIMPLE_TAXES'] = new Smarty_variable($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxesOnCompound(), null, 0);?><select data-placeholder="<?php echo vtranslate('LBL_SELECT_SIMPLE_TAXES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" id="compoundOn" class="select2 inputEle" multiple="" name="compoundon" data-rule-required="true"><?php  $_smarty_tpl->tpl_vars['SIMPLE_TAX_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SIMPLE_TAX_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['SIMPLE_TAX_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SIMPLE_TAX_MODELS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SIMPLE_TAX_MODEL']->key => $_smarty_tpl->tpl_vars['SIMPLE_TAX_MODEL']->value){
$_smarty_tpl->tpl_vars['SIMPLE_TAX_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['SIMPLE_TAX_ID']->value = $_smarty_tpl->tpl_vars['SIMPLE_TAX_MODEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['SIMPLE_TAX_ID']->value;?>
" <?php if (!empty($_smarty_tpl->tpl_vars['SELECTED_SIMPLE_TAXES']->value)&&in_array($_smarty_tpl->tpl_vars['SIMPLE_TAX_ID']->value,$_smarty_tpl->tpl_vars['SELECTED_SIMPLE_TAXES']->value)){?>selected=""<?php }?>><?php echo $_smarty_tpl->tpl_vars['SIMPLE_TAX_MODEL']->value->getName();?>
 (<?php echo $_smarty_tpl->tpl_vars['SIMPLE_TAX_MODEL']->value->getTax();?>
%)</option><?php } ?></select></div></div><div class="col-lg-3"></div></div><div class="block taxTypeContainer row <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxMethod()=='Deducted'){?>hide<?php }?>"><div class="col-lg-1"></div><div class="col-lg-3"><label class="pull-right"><?php echo vtranslate('LBL_TAX_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></div><div class="col-lg-7"><label class="span radio-group" id="fixed"><input type="radio" name="taxType" class="input-medium" <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxType()=='Fixed'||!$_smarty_tpl->tpl_vars['TAX_ID']->value){?>checked<?php }?> value="Fixed" />&nbsp;&nbsp;<span class="radio-label"><?php echo vtranslate('LBL_FIXED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></label>&nbsp;&nbsp;<label class="span radio-group" id="variable"><input type="radio" name="taxType" class="input-medium" <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxType()=='Variable'){?>checked<?php }?> value="Variable" />&nbsp;&nbsp;<span class="radio-label"><?php echo vtranslate('LBL_VARIABLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></label>&nbsp;&nbsp;</div><div class="col-lg-1"></div></div><div class="block taxValueContainer row <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxType()=='Variable'){?>hide<?php }?>"><div class="col-lg-1"></div><div class="col-lg-3"><label class="pull-right"><?php echo vtranslate('LBL_TAX_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label></div><div class="col-lg-5"><div class="input-group" style="min-height:30px;"><span class="input-group-addon">%</span><input class="inputElement" type="text" name="percentage" placeholder="<?php echo vtranslate('LBL_ENTER_TAX_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="<?php echo $_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTax();?>
" data-rule-required="true" data-rule-inventory_percentage="true" /></div></div><div class="col-lg-3"></div></div><div class="control-group dedcutedTaxDesc <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxMethod()!='Deducted'){?>hide<?php }?>"><div style="text-align:center;"><i class="fa fa-info-circle"></i> <?php echo vtranslate('LBL_DEDUCTED_TAX_DISC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><br><br></div><div class="block regionsContainer row <?php if ($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTaxType()!='Variable'){?>hide<?php }?>" style="padding: 0px 40px;"><table class="table table-bordered regionsTable"><tr><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="width:70%;"><strong><?php echo vtranslate('LBL_REGIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></th><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="text-align: center; width:30%;"><strong><?php echo vtranslate('LBL_TAX_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;(%)</strong></th></tr><tr><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><label><?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="text-align: center;"><input class="inputElement smallInputBox input-medium" type="text" name="defaultPercentage" value="<?php echo $_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getTax();?>
" data-rule-required="true" data-rule-inventory_percentage="true" /></td></tr><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?><?php  $_smarty_tpl->tpl_vars['REGIONS_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['REGIONS_INFO']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getRegionTaxes(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['REGIONS_INFO']->key => $_smarty_tpl->tpl_vars['REGIONS_INFO']->value){
$_smarty_tpl->tpl_vars['REGIONS_INFO']->_loop = true;
?><tr><td class="regionsList <?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class="deleteRow close" style="float:left;margin-top:2px;">×</div>&nbsp;&nbsp;<select id="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" data-placeholder="<?php echo vtranslate('LBL_SELECT_REGIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" name="regions[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
][list]" class="regions select2 inputElement" multiple="" data-rule-required="true" style="width: 90%;"><?php  $_smarty_tpl->tpl_vars['TAX_REGION_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TAX_REGIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->key => $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value){
$_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->_loop = true;
?><?php $_smarty_tpl->tpl_vars['TAX_REGION_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value->getId(), null, 0);?><option value="<?php echo $_smarty_tpl->tpl_vars['TAX_REGION_ID']->value;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['TAX_REGION_ID']->value,$_smarty_tpl->tpl_vars['REGIONS_INFO']->value['list'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value->getName();?>
</option><?php } ?></select></td><td class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" style="text-align: center;"><input class="inputElement" type="text" name="regions[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
][value]" value="<?php echo $_smarty_tpl->tpl_vars['REGIONS_INFO']->value['value'];?>
" data-rule-required="true" data-rule-inventory_percentage="true" /></td></tr><?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?><?php } ?><input type="hidden" class="regionsCount" value="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" /></table><span class="addNewTaxBracket"><a href="#"><u><?php echo vtranslate('LBL_ADD_TAX_BRACKET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</u></a><select class="taxRegionElements hide"><?php  $_smarty_tpl->tpl_vars['TAX_REGION_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TAX_REGIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->key => $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value){
$_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value->getId();?>
"><?php echo $_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value->getName();?>
</option><?php } ?></select></span><br><br><div><i class="fa fa-info-circle"></i> <?php echo vtranslate('LBL_TAX_BRACKETS_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div></div></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl','Vtiger'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div></div>
<?php }} ?>