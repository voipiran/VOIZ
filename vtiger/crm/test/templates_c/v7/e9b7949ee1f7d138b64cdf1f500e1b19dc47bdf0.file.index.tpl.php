<?php /* Smarty version Smarty-3.1.7, created on 2018-11-26 14:48:19
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/PBXManager/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:865335165bfbd67ba72bd4-73120640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9b7949ee1f7d138b64cdf1f500e1b19dc47bdf0' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/PBXManager/index.tpl',
      1 => 1522233374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '865335165bfbd67ba72bd4-73120640',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RECORD_ID' => 0,
    'QUALIFIED_MODULE' => 0,
    'MODULE_MODEL' => 0,
    'FIELDS' => 0,
    'FIELD_NAME' => 0,
    'RECORD_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfbd67baea30',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfbd67baea30')) {function content_5bfbd67baea30($_smarty_tpl) {?>

<div class="col-sm-12 col-xs-12"><div class="container-fluid" id="AsteriskServerDetails"><input type="hidden" name="module" value="PBXManager"/><input type="hidden" name="action" value="SaveAjax"/><input type="hidden" name="parent" value="Settings"/><input type="hidden" class="recordid" name="id" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
"><div class="widget_header row"><div class="col-sm-8"><h4><?php echo vtranslate('LBL_PBXMANAGER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><?php $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_variable(Settings_PBXManager_Module_Model::getCleanInstance(), null, 0);?><div class="col-sm-4"><div class="clearfix"><div class="btn-group pull-right editbutton-container"><button class="btn btn-default editButton" data-url="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getEditViewUrl();?>
&mode=showpopup&id=<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div></div></div><hr><div class="contents col-lg-12"><table class="table detailview-table no-border"><tbody><?php $_smarty_tpl->tpl_vars['FIELDS'] = new Smarty_variable(PBXManager_PBXManager_Connector::getSettingsParameters(), null, 0);?><?php  $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_TYPE']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->key => $_smarty_tpl->tpl_vars['FIELD_TYPE']->value){
$_smarty_tpl->tpl_vars['FIELD_TYPE']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_TYPE']->key;
?><tr><td class="fieldLabel" style="width:25%"><label><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_NAME']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td style="word-wrap:break-word;"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
</td></tr><?php } ?></tbody></table></div></div><div class="col-sm-12 col-xs-12"><div class="col-sm-8 col-xs-8"><div class="alert alert-danger container-fluid"><b><?php echo vtranslate('LBL_NOTE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b>&nbsp;<?php echo vtranslate('LBL_PBXMANAGER_INFO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div></div></div><?php }} ?>