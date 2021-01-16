<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 10:59:44
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Import/ImportStatus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20440760245c46c668100f82-91477761%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95c10e2c0e6f52d17228d6664d068a79af6508e1' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Import/ImportStatus.tpl',
      1 => 1522233374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20440760245c46c668100f82-91477761',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'FOR_MODULE' => 0,
    'TITLE' => 0,
    'CONTINUE_IMPORT' => 0,
    'ERROR_MESSAGE' => 0,
    'IMPORT_RESULT' => 0,
    'IMPORT_ID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46c6681ad05',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46c6681ad05')) {function content_5c46c6681ad05($_smarty_tpl) {?>

<div class='fc-overlay-modal' id="scheduleImportStatus">
    <div class = "modal-content">
        <div class="overlayHeader">
            <?php ob_start();?><?php echo vtranslate('LBL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['FOR_MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo vtranslate('LBL_RUNNING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['TITLE'] = new Smarty_variable($_tmp1." ".$_tmp2." -
                    <span style = 'color:red'>".$_tmp3." ... </span>", null, 0);?>
			<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0);?>

			</div>
        <div class='modal-body' id = "importStatusDiv" style="margin-bottom:100%">
            <hr>
                <form onsubmit="VtigerJS_DialogBox.block();" action="index.php" enctype="multipart/form-data" method="POST" name="importStatusForm" id = "importStatusForm">
                    <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
" />
                    <input type="hidden" name="view" value="Import" />
                    <?php if ($_smarty_tpl->tpl_vars['CONTINUE_IMPORT']->value=='true'){?>
                        <input type="hidden" name="mode" value="continueImport" />
                    <?php }else{ ?>
                        <input type="hidden" name="mode" value="" />
                    <?php }?>
                </form>
                <?php if ($_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value!=''){?>
                    <div class = "alert alert-danger">
                        <?php echo $_smarty_tpl->tpl_vars['ERROR_MESSAGE']->value;?>

                    </div>
                <?php }?>
                <div class = "col-lg-12 col-md-12 col-sm-12">
                    <div class = "col-lg-3 col-md-4 col-sm-6">
                        <span><?php echo vtranslate('LBL_TOTAL_RECORDS_IMPORTED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span> 
                    </div>
                    <div class ="col-lg-1 col-md-1 col-sm-1"><span>:</span> </div>
                    <div class = "col-lg-2 col-md-3 col-sm-4"><span><strong><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['IMPORTED'];?>
 / <?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['TOTAL'];?>
</strong></span></div> 
                </div>
                <div class = "col-lg-12 col-md-12 col-sm-12">
                    <div class = "col-lg-3 col-md-4 col-sm-6">
                        <span><?php echo vtranslate('LBL_NUMBER_OF_RECORDS_CREATED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span> 
                    </div>
                    <div class ="col-lg-1 col-md-1 col-sm-1"><span>:</span> </div>
                    <div class = "col-lg-2 col-md-3 col-sm-4"><span><strong><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['CREATED'];?>
</strong></span></div> 
                </div>
                <div class = "col-lg-12 col-md-12">
                    <div class = "col-lg-3 col-md-3">
                        <span><?php echo vtranslate('LBL_NUMBER_OF_RECORDS_UPDATED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span> 
                    </div>
                    <div class ="col-lg-1 col-md-1"><span>:</span> </div>
                    <div class = "col-lg-2 col-md-2"><span><strong><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['UPDATED'];?>
</strong></span></div> 
                </div>
                <div class = "col-lg-12 col-md-12">
                    <div class = "col-lg-3 col-md-3">
                        <span><?php echo vtranslate('LBL_NUMBER_OF_RECORDS_SKIPPED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span> 
                    </div>
                    <div class ="col-lg-1 col-md-1"><span>:</span> </div>
                    <div class = "col-lg-2 col-md-2"><span><strong><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['SKIPPED'];?>
</strong></span></div> 
                </div>
                <div class = "col-lg-12 col-md-12">
                    <div class = "col-lg-3 col-md-3">
                        <span><?php echo vtranslate('LBL_NUMBER_OF_RECORDS_MERGED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span> 
                    </div>
                    <div class ="col-lg-1 col-md-1"><span>:</span> </div>
                    <div class = "col-lg-2 col-md-2"><span><strong><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['MERGED'];?>
</strong></span></div> 
                </div>
        </div>
        <div class='modal-overlay-footer border1px clearfix'>
            <div class="row clearfix">
                <div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
                    <button name="cancel" class="btn btn-danger btn-lg"
                            onclick="return Vtiger_Import_Js.cancelImport('index.php?module=<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
&view=Import&mode=cancelImport&import_id=<?php echo $_smarty_tpl->tpl_vars['IMPORT_ID']->value;?>
')"><?php echo vtranslate('LBL_CANCEL_IMPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }} ?>