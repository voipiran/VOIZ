<?php /* Smarty version Smarty-3.1.7, created on 2019-02-06 12:55:53
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Vtiger/TaxIndex.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1501483895c5aa821ebbac3-49718050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea32fcd784cad331d5226ed1749b1738087a1490' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Vtiger/TaxIndex.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1501483895c5aa821ebbac3-49718050',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'TAX_RECORD_MODEL' => 0,
    'CURRENT_USER_MODEL' => 0,
    'CREATE_TAX_URL' => 0,
    'WIDTHTYPE' => 0,
    'PRODUCT_AND_SERVICES_TAXES' => 0,
    'PRODUCT_SERVICE_TAX_MODEL' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5aa822040aa',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5aa822040aa')) {function content_5c5aa822040aa($_smarty_tpl) {?>


<div class="col-lg-12 col-md-12 col-sm-12" id="TaxCalculationsContainer"><div class="editViewHeader"><h4><?php echo vtranslate('LBL_TAX_CALCULATIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><hr><br><div class="contents tabbable clearfix"><ul class="nav nav-tabs layoutTabs massEditTabs"><li class="tab-item taxesTab active"><a data-toggle="tab" href="#taxes"><strong><?php echo vtranslate('LBL_TAXES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><li class="tab-item chargesTab"><a data-toggle="tab" href="#charges"><strong><?php echo vtranslate('LBL_CHARGES_AND ITS_TAXES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li><li class="tab-item taxRegionsTab"><a data-toggle="tab" href="#taxRegions"><strong><?php echo vtranslate('LBL_TAX_REGIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></a></li></ul><div class="tab-content layoutContent padding20 overflowVisible"><div class="tab-pane active" id="taxes"><div class="col-lg-3 col-md-3 col-sm-3"></div><div class="col-lg-6"><?php $_smarty_tpl->tpl_vars['CREATE_TAX_URL'] = new Smarty_variable($_smarty_tpl->tpl_vars['TAX_RECORD_MODEL']->value->getCreateTaxUrl(), null, 0);?><?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENT_USER_MODEL']->value->get('rowheight'), null, 0);?><div class="marginBottom10px"><button type="button" class="btn btn-default addTax addButton btn-default module-buttons" data-url="<?php echo $_smarty_tpl->tpl_vars['CREATE_TAX_URL']->value;?>
" data-type="0"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_NEW_TAX',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div><table class="table table-bordered inventoryTaxTable"><tr><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><strong><?php echo vtranslate('LBL_TAX_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></th><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><strong><?php echo vtranslate('LBL_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></th><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><strong><?php echo vtranslate('LBL_CALCULATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></th><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><strong><?php echo vtranslate('LBL_TAX_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></th><th class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
" colspan="2"><strong><?php echo vtranslate('LBL_STATUS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></th></tr><?php  $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['PRODUCT_AND_SERVICES_TAXES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->key => $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->value){
$_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->_loop = true;
?><tr class="opacity" data-taxid="<?php echo $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->value->get('taxid');?>
" data-taxtype="<?php echo $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->value->getType();?>
"><td style="border-left:none;border-right:none;" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><span class="taxLabel" style="width:120px"><?php echo $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->value->getName();?>
</span></td><td style="border-left:none;border-right:none;" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><span class="taxType"><?php echo $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->value->getTaxType();?>
</span></td><td style="border-left:none;border-right:none;" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><span class="taxMethod"><?php echo $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->value->getTaxMethod();?>
</span></td><td style="border-left:none;border-right:none;" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><span class="taxPercentage"><?php echo $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->value->getTax();?>
%</span></td><td style="border-left:none;border-right:none;" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><input type="checkbox" class="editTaxStatus" <?php if (!$_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->value->isDeleted()){?>checked<?php }?> /></td><td style="border-left:none;border-right:none;" class="<?php echo $_smarty_tpl->tpl_vars['WIDTHTYPE']->value;?>
"><div class="pull-right actions"><a class="editTax cursorPointer" data-url="<?php echo $_smarty_tpl->tpl_vars['PRODUCT_SERVICE_TAX_MODEL']->value->getEditTaxUrl();?>
"><i title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-pencil alignMiddle"></i></a>&nbsp;</div></td></tr><?php } ?></table></div></div><div class="tab-pane" id="charges"></div><div class="tab-pane" id="taxRegions"></div></div></div></div><?php }} ?>