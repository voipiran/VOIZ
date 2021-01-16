<?php /* Smarty version Smarty-3.1.7, created on 2019-02-05 10:37:57
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Leads/MappingDetail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4373135415c59364ddfd9f5-40197205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f69566ebea24d266bb4ae797d87bf1887a360d18' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Leads/MappingDetail.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4373135415c59364ddfd9f5-40197205',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_MODEL' => 0,
    'LINK_MODEL' => 0,
    'QUALIFIED_MODULE' => 0,
    'LABEL' => 0,
    'MAPPING_ID' => 0,
    'MAPPING' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c59364dec134',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c59364dec134')) {function content_5c59364dec134($_smarty_tpl) {?>

<div class="leadsFieldMappingListPageDiv"><div class="col-sm-12 col-xs-12"><div class="row settingsHeader"><span class="col-sm-12"><span class="pull-right"><?php  $_smarty_tpl->tpl_vars['LINK_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LINK_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDetailViewLinks(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LINK_MODEL']->key => $_smarty_tpl->tpl_vars['LINK_MODEL']->value){
$_smarty_tpl->tpl_vars['LINK_MODEL']->_loop = true;
?><button type="button" class="btn btn-default" onclick=<?php echo $_smarty_tpl->tpl_vars['LINK_MODEL']->value->getUrl();?>
><?php echo vtranslate($_smarty_tpl->tpl_vars['LINK_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php } ?></span></span></div><div class="contents table-container" id="detailView"><table id="listview-table" class="table listview-table"><thead><tr><th width="5%"></th><th width="15%"><?php echo vtranslate('LBL_FIELD_LABEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th width="15%"><?php echo vtranslate('LBL_FIELD_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th colspan="3" width="70%"><?php echo vtranslate('LBL_MAPPING_WITH_OTHER_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr><tr><th width="5%"><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getHeaders(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><th width="15%"><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['LABEL']->value);?>
</th><?php } ?></tr></thead><tbody><?php  $_smarty_tpl->tpl_vars['MAPPING'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MAPPING']->_loop = false;
 $_smarty_tpl->tpl_vars['MAPPING_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMapping(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MAPPING']->key => $_smarty_tpl->tpl_vars['MAPPING']->value){
$_smarty_tpl->tpl_vars['MAPPING']->_loop = true;
 $_smarty_tpl->tpl_vars['MAPPING_ID']->value = $_smarty_tpl->tpl_vars['MAPPING']->key;
?><tr class="listViewEntries" data-cfmid="<?php echo $_smarty_tpl->tpl_vars['MAPPING_ID']->value;?>
"><td width="5%"><?php if ($_smarty_tpl->tpl_vars['MAPPING']->value['editable']==1){?><?php  $_smarty_tpl->tpl_vars['LINK_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LINK_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMappingLinks(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LINK_MODEL']->key => $_smarty_tpl->tpl_vars['LINK_MODEL']->value){
$_smarty_tpl->tpl_vars['LINK_MODEL']->_loop = true;
?><div class="table-actions"><span><a onclick=<?php echo $_smarty_tpl->tpl_vars['LINK_MODEL']->value->getUrl();?>
><i title="<?php echo vtranslate($_smarty_tpl->tpl_vars['LINK_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-trash alignMiddle"></i></a></span></div><?php } ?><?php }?></td><td width="10%"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MAPPING']->value['Leads']['label'];?>
<?php $_tmp1=ob_get_clean();?><?php echo vtranslate($_tmp1,'Leads');?>
</td><td width="10%"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MAPPING']->value['Leads']['fieldDataType'];?>
<?php $_tmp2=ob_get_clean();?><?php echo vtranslate($_tmp2,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</td><td width="10%"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MAPPING']->value['Accounts']['label'];?>
<?php $_tmp3=ob_get_clean();?><?php echo vtranslate($_tmp3,'Accounts');?>
</td><td width="10%"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MAPPING']->value['Contacts']['label'];?>
<?php $_tmp4=ob_get_clean();?><?php echo vtranslate($_tmp4,'Contacts');?>
</td><td width="10%"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MAPPING']->value['Potentials']['label'];?>
<?php $_tmp5=ob_get_clean();?><?php echo vtranslate($_tmp5,'Potentials');?>
</td></tr><?php } ?></tbody></table></div><div id="scroller_wrapper" class="bottom-fixed-scroll"><div id="scroller" class="scroller-div"></div></div></div></div><?php }} ?>