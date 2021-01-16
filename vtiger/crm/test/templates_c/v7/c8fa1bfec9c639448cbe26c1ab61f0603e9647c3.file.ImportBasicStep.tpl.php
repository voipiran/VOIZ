<?php /* Smarty version Smarty-3.1.7, created on 2018-12-10 07:18:59
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Import/ImportBasicStep.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10670871835c0de22b7e7ab7-78868555%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8fa1bfec9c639448cbe26c1ab61f0603e9647c3' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Import/ImportBasicStep.tpl',
      1 => 1522233374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10670871835c0de22b7e7ab7-78868555',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'FOR_MODULE' => 0,
    'TITLE' => 0,
    'FORMAT' => 0,
    'DUPLICATE_HANDLING_NOT_SUPPORTED' => 0,
    'LABELS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c0de22b926b3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c0de22b926b3')) {function content_5c0de22b926b3($_smarty_tpl) {?>


<div class='fc-overlay-modal modal-content'><div class="overlayHeader"><?php ob_start();?><?php echo vtranslate('LBL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['FOR_MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['TITLE'] = new Smarty_variable($_tmp1." ".$_tmp2, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0);?>
</div><div class="importview-content"><form onsubmit="" action="index.php" enctype="multipart/form-data" method="POST" name="importBasic"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
" /><input type="hidden" name="view" value="Import" /><input type="hidden" name="mode" value="uploadAndParse" /><input type="hidden" id="auto_merge" name="auto_merge" value="0"/><div class='modal-body' id ="importContainer"><?php $_smarty_tpl->tpl_vars['LABELS'] = new Smarty_variable(array(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['FORMAT']->value=='vcf'){?><?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step1"] = 'LBL_UPLOAD_VCF';?><?php }elseif($_smarty_tpl->tpl_vars['FORMAT']->value=='ics'){?><?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step1"] = 'LBL_UPLOAD_ICS';?><?php }else{ ?><?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step1"] = 'LBL_UPLOAD_CSV';?><?php }?><?php if ($_smarty_tpl->tpl_vars['FORMAT']->value!='ics'){?><?php if ($_smarty_tpl->tpl_vars['DUPLICATE_HANDLING_NOT_SUPPORTED']->value=='true'){?><?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step3"] = 'LBL_FIELD_MAPPING';?><?php }else{ ?><?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step2"] = 'LBL_DUPLICATE_HANDLING';?><?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step3"] = 'LBL_FIELD_MAPPING';?><?php }?><?php }?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("BreadCrumbs.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BREADCRUMB_ID'=>'navigation_links','ACTIVESTEP'=>1,'BREADCRUMB_LABELS'=>$_smarty_tpl->tpl_vars['LABELS']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ImportStepOne.tpl','Import'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php if ($_smarty_tpl->tpl_vars['FORMAT']->value!='ics'){?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ImportStepTwo.tpl','Import'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?></div></form></div><div class='modal-overlay-footer border1px clearfix'><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><?php if ($_smarty_tpl->tpl_vars['FORMAT']->value=='ics'){?><button type="submit" name="import" id="importButton" class="btn btn-success btn-lg" onclick="return Calendar_Edit_Js.uploadAndParse();"><?php echo vtranslate('LBL_IMPORT_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;&nbsp;<a class="cancelLink" data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a><?php }else{ ?><div id="importStepOneButtonsDiv"><?php if ($_smarty_tpl->tpl_vars['DUPLICATE_HANDLING_NOT_SUPPORTED']->value=='true'){?><button class="btn btn-success btn-lg" id="skipDuplicateMerge" onclick="Vtiger_Import_Js.uploadAndParse('0');"><?php echo vtranslate('LBL_NEXT_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php }else{ ?><button class="btn btn-success btn-lg" id ="importStep2" onclick="Vtiger_Import_Js.importActionStep2();"><?php echo vtranslate('LBL_NEXT_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><?php }?>&nbsp;&nbsp;&nbsp;<a class='cancelLink' onclick="Vtiger_Import_Js.loadListRecords();" data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><div id="importStepTwoButtonsDiv" class = "hide"><button class="btn btn-default btn-lg" id="backToStep1" onclick="Vtiger_Import_Js.bactToStep1();"><?php echo vtranslate('LBL_BACK',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;&nbsp;<button name="next" class="btn btn-success btn-lg" id="uploadAndParse" onclick="Vtiger_Import_Js.uploadAndParse('1');"><?php echo vtranslate('LBL_NEXT_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary btn-lg" id="skipDuplicateMerge" onclick="Vtiger_Import_Js.uploadAndParse('0');"><?php echo vtranslate('Skip this step',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;&nbsp;<a class='cancelLink' data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><?php }?></div></div></div></div><?php }} ?>