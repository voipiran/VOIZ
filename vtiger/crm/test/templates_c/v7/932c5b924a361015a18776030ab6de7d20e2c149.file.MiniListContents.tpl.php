<?php /* Smarty version Smarty-3.1.7, created on 2018-12-10 09:03:02
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/dashboards/MiniListContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13010668665c0dfa8eb5bde7-60952763%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '932c5b924a361015a18776030ab6de7d20e2c149' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/dashboards/MiniListContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13010668665c0dfa8eb5bde7-60952763',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'WIDGET' => 0,
    'CURRENT_PAGE' => 0,
    'MINILIST_WIDGET_MODEL' => 0,
    'HEADER_COUNT' => 0,
    'HEADER_FIELDS' => 0,
    'SPANSIZE' => 0,
    'FIELD' => 0,
    'BASE_MODULE' => 0,
    'MINILIST_WIDGET_RECORDS' => 0,
    'NAME' => 0,
    'RECORD' => 0,
    'USER_MODEL' => 0,
    'RECORD_ID' => 0,
    'CURRENCY_ID' => 0,
    'CURRENCY_INFO' => 0,
    'MODULE_NAME' => 0,
    'MORE_EXISTS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c0dfa8ec6524',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c0dfa8ec6524')) {function content_5c0dfa8ec6524($_smarty_tpl) {?>
<div style='padding-top: 0;margin-bottom: 2%;padding-right:15px;'>
    <input type="hidden" id="widget_<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->get('id');?>
_currentPage" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_PAGE']->value;?>
">
	
	<?php $_smarty_tpl->tpl_vars["SPANSIZE"] = new Smarty_variable(12, null, 0);?>
	<?php $_smarty_tpl->tpl_vars['HEADER_COUNT'] = new Smarty_variable($_smarty_tpl->tpl_vars['MINILIST_WIDGET_MODEL']->value->getHeaderCount(), null, 0);?>
	<?php if ($_smarty_tpl->tpl_vars['HEADER_COUNT']->value){?>
		<?php $_smarty_tpl->tpl_vars["SPANSIZE"] = new Smarty_variable(12/$_smarty_tpl->tpl_vars['HEADER_COUNT']->value, null, 0);?>
	<?php }?>

	<div class="row" style="padding:5px">
		<?php $_smarty_tpl->tpl_vars['HEADER_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['MINILIST_WIDGET_MODEL']->value->getHeaders(), null, 0);?>
		<?php  $_smarty_tpl->tpl_vars['FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['HEADER_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD']->key => $_smarty_tpl->tpl_vars['FIELD']->value){
$_smarty_tpl->tpl_vars['FIELD']->_loop = true;
?>
		<div class="col-lg-<?php echo $_smarty_tpl->tpl_vars['SPANSIZE']->value;?>
"><strong><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['BASE_MODULE']->value);?>
</strong></div>
		<?php } ?>
	</div>

	<?php $_smarty_tpl->tpl_vars["MINILIST_WIDGET_RECORDS"] = new Smarty_variable($_smarty_tpl->tpl_vars['MINILIST_WIDGET_MODEL']->value->getRecords(), null, 0);?>

	<?php  $_smarty_tpl->tpl_vars['RECORD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RECORD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MINILIST_WIDGET_RECORDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RECORD']->key => $_smarty_tpl->tpl_vars['RECORD']->value){
$_smarty_tpl->tpl_vars['RECORD']->_loop = true;
?>
	<div class="row miniListContent" style="padding:5px">
		<?php  $_smarty_tpl->tpl_vars['FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD']->_loop = false;
 $_smarty_tpl->tpl_vars['NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['HEADER_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['FIELD']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['FIELD']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD']->key => $_smarty_tpl->tpl_vars['FIELD']->value){
$_smarty_tpl->tpl_vars['FIELD']->_loop = true;
 $_smarty_tpl->tpl_vars['NAME']->value = $_smarty_tpl->tpl_vars['FIELD']->key;
 $_smarty_tpl->tpl_vars['FIELD']->iteration++;
 $_smarty_tpl->tpl_vars['FIELD']->last = $_smarty_tpl->tpl_vars['FIELD']->iteration === $_smarty_tpl->tpl_vars['FIELD']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["minilistWidgetModelRowHeaders"]['last'] = $_smarty_tpl->tpl_vars['FIELD']->last;
?>
			<div class="col-lg-<?php echo $_smarty_tpl->tpl_vars['SPANSIZE']->value;?>
 textOverflowEllipsis" title="<?php echo strip_tags($_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME']->value));?>
" style="padding-right: 5px;">
               <?php if ($_smarty_tpl->tpl_vars['FIELD']->value->get('uitype')=='71'||($_smarty_tpl->tpl_vars['FIELD']->value->get('uitype')=='72'&&$_smarty_tpl->tpl_vars['FIELD']->value->getName()=='unit_price')){?>
					<?php $_smarty_tpl->tpl_vars['CURRENCY_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_id'), null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['FIELD']->value->get('uitype')=='72'&&$_smarty_tpl->tpl_vars['NAME']->value=='unit_price'){?>
						<?php $_smarty_tpl->tpl_vars['CURRENCY_ID'] = new Smarty_variable(getProductBaseCurrency($_smarty_tpl->tpl_vars['RECORD_ID']->value,$_smarty_tpl->tpl_vars['RECORD']->value->getModuleName()), null, 0);?>
					<?php }?>
					<?php $_smarty_tpl->tpl_vars['CURRENCY_INFO'] = new Smarty_variable(getCurrencySymbolandCRate($_smarty_tpl->tpl_vars['CURRENCY_ID']->value), null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME']->value)!=null){?>
						&nbsp;<?php echo CurrencyField::appendCurrencySymbol($_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME']->value),$_smarty_tpl->tpl_vars['CURRENCY_INFO']->value['symbol']);?>
&nbsp;
					<?php }?>
				<?php }else{ ?>
					<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['NAME']->value);?>
&nbsp;
				<?php }?>
				<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['minilistWidgetModelRowHeaders']['last']){?>
					<a href="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDetailViewUrl();?>
" class="pull-right"><i title="<?php echo vtranslate('LBL_SHOW_COMPLETE_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
" class="fa fa-list"></i></a>
				<?php }?>
			</div>
		<?php } ?>
	</div>
	<?php } ?>
    
    <?php if ($_smarty_tpl->tpl_vars['MORE_EXISTS']->value){?>
        <div class="moreLinkDiv" style="padding-top:10px;padding-bottom:5px;">
            <a class="miniListMoreLink" data-linkid="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->get('linkid');?>
" data-widgetid="<?php echo $_smarty_tpl->tpl_vars['WIDGET']->value->get('id');?>
" onclick="Vtiger_MiniList_Widget_Js.registerMoreClickEvent(event);"><?php echo vtranslate('LBL_MORE');?>
...</a>
        </div>
    <?php }?>
</div><?php }} ?>