<?php /* Smarty version Smarty-3.1.7, created on 2018-11-26 14:48:22
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/PBXManager/Edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10565796595bfbd67e0ab716-71384280%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e1cddec38df7158be914b674c9531207dbc99d92' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/PBXManager/Edit.tpl',
      1 => 1522233374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10565796595bfbd67e0ab716-71384280',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODULE_MODEL' => 0,
    'RECORD_ID' => 0,
    'FIELDS' => 0,
    'FIELD_NAME' => 0,
    'FIELD_TYPE' => 0,
    'RECORD_MODEL' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfbd67e116d1',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfbd67e116d1')) {function content_5bfbd67e116d1($_smarty_tpl) {?>

<div class="widget_header col-lg-12"><h4><?php echo vtranslate('LBL_PBXMANAGER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4><hr></div><div class="container-fluid"><?php $_smarty_tpl->tpl_vars['MODULE_MODEL'] = new Smarty_variable(Settings_PBXManager_Module_Model::getCleanInstance(), null, 0);?><form id="MyModal" class="form-horizontal" data-detail-url="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDetailViewUrl();?>
"><input type="hidden" name="module" value="PBXManager"/><input type="hidden" name="action" value="SaveAjax"/><input type="hidden" name="parent" value="Settings"/><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
"><div class="blockData"><table class="table detailview-table no-border"><tbody><?php $_smarty_tpl->tpl_vars['FIELDS'] = new Smarty_variable(PBXManager_PBXManager_Connector::getSettingsParameters(), null, 0);?><?php  $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_TYPE']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_TYPE']->key => $_smarty_tpl->tpl_vars['FIELD_TYPE']->value){
$_smarty_tpl->tpl_vars['FIELD_TYPE']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_TYPE']->key;
?><tr><td class="fieldLabel control-label" style="width:25%"><label><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_NAME']->value,$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<span class="redColor">*</span></label></td><td style="word-wrap:break-word;"><input class="inputElement fieldValue" type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
" data-rule-required="true" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->get($_smarty_tpl->tpl_vars['FIELD_NAME']->value);?>
" /></td></tr><?php } ?></tbody></table></div><div class="modal-overlay-footer clearfix"><div class="row clearfix"><div class="textAlignCenter col-lg-12 col-md-12 col-sm-12"><button type="submit" class="btn btn-success saveButton"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class="cancelLink" data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div><div class="col-lg-12"><div class="col-lg-1"></div><div class="col-sm-5 alert alert-info container-fluid"><b><?php echo vtranslate('LBL_NOTE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b> <?php echo vtranslate('LBL_INFO_WEBAPP_URL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<br><br><?php echo vtranslate('LBL_FORMAT_WEBAPP_URL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : <?php echo vtranslate('LBL_FORMAT_INFO_WEBAPP_URL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div><?php }} ?>