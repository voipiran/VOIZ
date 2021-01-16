<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 10:53:43
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Import/ImportAdvanced.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3362184045c46c4ff7f7d18-72988106%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e4ece28ca78ce68dfec201e21836bd3c3f6fd15' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Import/ImportAdvanced.tpl',
      1 => 1522233374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3362184045c46c4ff7f7d18-72988106',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'FOR_MODULE' => 0,
    'TITLE' => 0,
    'USER_INPUT' => 0,
    'HAS_HEADER' => 0,
    'FORMAT' => 0,
    'DUPLICATE_HANDLING_NOT_SUPPORTED' => 0,
    'LABELS' => 0,
    'ERROR_MESSAGE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46c4ff8b2c2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46c4ff8b2c2')) {function content_5c46c4ff8b2c2($_smarty_tpl) {?>




<div class='fc-overlay-modal modal-content'>
    <div class="overlayHeader">
        <?php ob_start();?><?php echo vtranslate('LBL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['FOR_MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['TITLE'] = new Smarty_variable($_tmp1." ".$_tmp2, null, 0);?>
        <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0);?>

    </div>
    <div class="importview-content">
        <form action="index.php" enctype="multipart/form-data" method="POST" name="importAdvanced" id = "importAdvanced">
            <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
" />
            <input type="hidden" name="view" value="Import" />
            <input type="hidden" name="mode" value="import" />
            <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['USER_INPUT']->value->get('type');?>
" />
            <input type="hidden" name="has_header" value='<?php echo $_smarty_tpl->tpl_vars['HAS_HEADER']->value;?>
' />
            <input type="hidden" name="file_encoding" value='<?php echo $_smarty_tpl->tpl_vars['USER_INPUT']->value->get('file_encoding');?>
' />
            <input type="hidden" name="delimiter" value='<?php echo $_smarty_tpl->tpl_vars['USER_INPUT']->value->get('delimiter');?>
' />

            <div class='modal-body'>
				<?php $_smarty_tpl->tpl_vars['LABELS'] = new Smarty_variable(array(), null, 0);?>
                <?php if ($_smarty_tpl->tpl_vars['FORMAT']->value=='vcf'){?>
                    <?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step1"] = 'LBL_UPLOAD_VCF';?>
                <?php }elseif($_smarty_tpl->tpl_vars['FORMAT']->value=='ics'){?>
					<?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step1"] = 'LBL_UPLOAD_ICS';?>
				<?php }else{ ?>
                    <?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step1"] = 'LBL_UPLOAD_CSV';?>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['DUPLICATE_HANDLING_NOT_SUPPORTED']->value=='true'){?>
                    <?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step3"] = 'LBL_FIELD_MAPPING';?>
                <?php }else{ ?>
                    <?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step2"] = 'LBL_DUPLICATE_HANDLING';?>
                    <?php $_smarty_tpl->createLocalArrayVariable('LABELS', null, 0);
$_smarty_tpl->tpl_vars['LABELS']->value["step3"] = 'LBL_FIELD_MAPPING';?>
                <?php }?>
                <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("BreadCrumbs.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('BREADCRUMB_ID'=>'navigation_links','ACTIVESTEP'=>3,'BREADCRUMB_LABELS'=>$_smarty_tpl->tpl_vars['LABELS']->value,'MODULE'=>$_smarty_tpl->tpl_vars['MODULE']->value), 0);?>

                <div class = "importBlockContainer">
                    <table class = "table table-borderless">
                        <?php if ($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value!=''){?>
                            <tr>
                                <td align="left">
                                    <?php echo $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value;?>

                                </td>
                            </tr>
                        <?php }?>
                        <tr>
                            <td>
                                <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ImportStepThree.tpl','Import'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class='modal-overlay-footer border1px clearfix'>
                <div class="row clearfix">
                        <div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
                        <button type="submit" name="import" id="importButton" class="btn btn-success btn-lg" onclick="return Vtiger_Import_Js.sanitizeAndSubmit()"
                                ><?php echo vtranslate('LBL_IMPORT_BUTTON_LABEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>
                        &nbsp;&nbsp;&nbsp;<a class='cancelLink' data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php }} ?>