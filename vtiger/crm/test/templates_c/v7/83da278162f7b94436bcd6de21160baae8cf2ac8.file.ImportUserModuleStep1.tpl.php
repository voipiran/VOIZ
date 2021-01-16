<?php /* Smarty version Smarty-3.1.7, created on 2018-04-16 11:44:09
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/ModuleManager/ImportUserModuleStep1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11688117485ad44d41a398c6-02216410%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83da278162f7b94436bcd6de21160baae8cf2ac8' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/ModuleManager/ImportUserModuleStep1.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11688117485ad44d41a398c6-02216410',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ad44d41a8ff4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad44d41a8ff4')) {function content_5ad44d41a8ff4($_smarty_tpl) {?>

<div class="detailViewContainer col-lg-12 col-md-12 col-sm-12" id="importModules"><div class="widget_header row col-lg-12 col-md-12 col-sm-12"><h4><?php echo vtranslate('LBL_IMPORT_MODULE_FROM_ZIP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div><form class="form-horizontal" id="importUserModule" name="importUserModule" action='index.php' method="POST" enctype="multipart/form-data"><input type="hidden" name="module" value="ModuleManager" /><input type="hidden" name="moduleAction" value="Import"/><input type="hidden" name="parent" value="Settings" /><input type="hidden" name="view" value="ModuleImport" /><input type="hidden" name="mode" value="importUserModuleStep2" /><div class="contents"><div class="row col-lg-12 col-md-12 col-sm-12" style="margin-top:3%"><div class="col-lg-1 col-md-1 col-sm-1">&nbsp;</div><div class="col-lg-10 col-md-10 col-sm-10"><div class="alert alert-danger"><?php echo vtranslate('LBL_DISCLAIMER_FOR_IMPORT_FROM_ZIP',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><div><input type="checkbox" name="acceptDisclaimer" /> &nbsp;&nbsp;<b><?php echo vtranslate('LBL_ACCEPT_WITH_THE_DISCLAIMER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></div><div style="margin-top: 15px; display: none;"><span name="proceedInstallation" class="fileUploadBtn btn btn-primary"><span><i class="fa fa-laptop"></i> <?php echo vtranslate('Select from My Computer',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><input type="file" name="moduleZip" id="moduleZip" size="80px" data-validation-engine="validate[required, funcCall[Vtiger_Base_Validator_Js.invokeValidation]]"data-validator=<?php echo Zend_Json::encode(array(array('name'=>'UploadModuleZip')));?>
 /></span><span id="moduleFileDetails" style="margin-left: 15px;"></span></div></div></div></div><div class="modal-overlay-footer clearfix"><div class="row clearfix"><div class="textAlignCenter col-lg-12 col-md-12 col-sm-12"><button class="btn btn-success saveButton" disabled="disabled" type="submit" name="importFromZip"><strong><?php echo vtranslate('LBL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button>&nbsp;&nbsp;<a class="cancelLink" href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></form></div>
<?php }} ?>