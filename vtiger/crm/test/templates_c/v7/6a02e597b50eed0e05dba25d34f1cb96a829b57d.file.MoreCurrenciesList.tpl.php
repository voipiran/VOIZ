<?php /* Smarty version Smarty-3.1.7, created on 2018-11-28 10:17:54
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Products/MoreCurrenciesList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6837953965bfe3a1ad7c458-99743650%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a02e597b50eed0e05dba25d34f1cb96a829b57d' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Products/MoreCurrenciesList.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6837953965bfe3a1ad7c458-99743650',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'TITLE' => 0,
    'PRICE_DETAILS' => 0,
    'price' => 0,
    'check_value' => 0,
    'disable_value' => 0,
    'USER_MODEL' => 0,
    'base_cur_check' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfe3a1ae1e9f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfe3a1ae1e9f')) {function content_5bfe3a1ae1e9f($_smarty_tpl) {?>


<div id="currency_class" class="multiCurrencyEditUI modelContainer">
	<div class = "modal-dialog modal-lg">
		<div class = "modal-content">
			<?php ob_start();?><?php echo vtranslate('LBL_PRICES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['TITLE'] = new Smarty_variable($_tmp1, null, 0);?>
			<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0);?>

			<div class="multiCurrencyContainer">
				<div class = "currencyContent">
					<div class = "modal-body">
						<table width="100%" border="0" cellpadding="5" cellspacing="0" class="table listViewEntriesTable">
							<thead class="detailedViewHeader">
							<th><?php echo vtranslate('LBL_CURRENCY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th>
							<th><?php echo vtranslate('LBL_PRICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th>
							<th><?php echo vtranslate('LBL_CONVERSION_RATE','Products');?>
</th>
							<th><?php echo vtranslate('LBL_RESET_PRICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th>
							<th><?php echo vtranslate('LBL_BASE_CURRENCY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</th>
							</thead>
							<?php  $_smarty_tpl->tpl_vars['price'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['price']->_loop = false;
 $_smarty_tpl->tpl_vars['count'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PRICE_DETAILS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['price']->key => $_smarty_tpl->tpl_vars['price']->value){
$_smarty_tpl->tpl_vars['price']->_loop = true;
 $_smarty_tpl->tpl_vars['count']->value = $_smarty_tpl->tpl_vars['price']->key;
?>
								<tr data-currency-id=<?php echo $_smarty_tpl->tpl_vars['price']->value['curname'];?>
>
									<?php if ($_smarty_tpl->tpl_vars['price']->value['check_value']==1||$_smarty_tpl->tpl_vars['price']->value['is_basecurrency']==1){?>
										<?php $_smarty_tpl->tpl_vars['check_value'] = new Smarty_variable("checked", null, 0);?>
										<?php $_smarty_tpl->tpl_vars['disable_value'] = new Smarty_variable('', null, 0);?>
									<?php }else{ ?>
										<?php $_smarty_tpl->tpl_vars['check_value'] = new Smarty_variable('', null, 0);?>
										<?php $_smarty_tpl->tpl_vars['disable_value'] = new Smarty_variable("disabled=true", null, 0);?>
									<?php }?>

									<?php if ($_smarty_tpl->tpl_vars['price']->value['is_basecurrency']==1){?>
										<?php $_smarty_tpl->tpl_vars['base_cur_check'] = new Smarty_variable("checked", null, 0);?>
									<?php }else{ ?>
										<?php $_smarty_tpl->tpl_vars['base_cur_check'] = new Smarty_variable('', null, 0);?>
									<?php }?>
									<td>
										<div class="row col-lg-12">
											<div class="col-lg-10 currencyInfo"  style = "padding-left:5px">
												<span class="pull-left currencyName" ><?php echo getTranslatedCurrencyString($_smarty_tpl->tpl_vars['price']->value['currencylabel']);?>
 (<span class='currencySymbol'><?php echo $_smarty_tpl->tpl_vars['price']->value['currencysymbol'];?>
</span>)</span>
											</div>
											<div class="col-lg-2">
												<span><input type="checkbox" name="cur_<?php echo $_smarty_tpl->tpl_vars['price']->value['curid'];?>
_check" id="cur_<?php echo $_smarty_tpl->tpl_vars['price']->value['curid'];?>
_check" class="pull-right enableCurrency" <?php echo $_smarty_tpl->tpl_vars['check_value']->value;?>
></span>
											</div>
										</div>
									</td>
									<td>
										<div>
											<input <?php echo $_smarty_tpl->tpl_vars['disable_value']->value;?>
 type="text" size="10" class="col-lg-9 form-control convertedPrice" data-rule-currency ="true" name="<?php echo $_smarty_tpl->tpl_vars['price']->value['curname'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['price']->value['curname'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['price']->value['curvalue'];?>
" data-decimal-separator='<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_decimal_separator');?>
' data-group-separator='<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_grouping_separator');?>
' />
										</div>
									</td>
									<td>
										<div>
											<input readonly="" type="text" size="10" class="col-lg-9 form-control conversionRate" name="cur_conv_rate<?php echo $_smarty_tpl->tpl_vars['price']->value['curid'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['price']->value['conversionrate'];?>
">
										</div>
									</td>
									<td>
										<div class = "textAlignCenter">
											<button <?php echo $_smarty_tpl->tpl_vars['disable_value']->value;?>
 type="button" class="btn btn-default currencyReset" id="cur_reset<?php echo $_smarty_tpl->tpl_vars['price']->value['curid'];?>
" value="<?php echo vtranslate('LBL_RESET',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class = "fa fa-refresh"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_RESET',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>
										</div>
									</td>
									<td>
										<div class="textAlignCenter">
											<input <?php echo $_smarty_tpl->tpl_vars['disable_value']->value;?>
 style = "vertical-align:middle" type="radio" class="baseCurrency" id="base_currency<?php echo $_smarty_tpl->tpl_vars['price']->value['curid'];?>
" name="base_currency_input" value="<?php echo $_smarty_tpl->tpl_vars['price']->value['curname'];?>
" <?php echo $_smarty_tpl->tpl_vars['base_cur_check']->value;?>
 />
										</div>
									</td>
								</tr>
							<?php } ?>
						</table>
					</div>
				</div>
				<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl',$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			</div>
		</div>
	</div>
</div><?php }} ?>