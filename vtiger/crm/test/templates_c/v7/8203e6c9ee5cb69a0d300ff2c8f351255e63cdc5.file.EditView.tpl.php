<?php /* Smarty version Smarty-3.1.7, created on 2019-02-06 12:33:50
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Profiles/EditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20545688215c5aa2f604c1d3-05514224%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8203e6c9ee5cb69a0d300ff2c8f351255e63cdc5' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Profiles/EditView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20545688215c5aa2f604c1d3-05514224',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RECORD_MODEL' => 0,
    'QUALIFIED_MODULE' => 0,
    'RECORD_ID' => 0,
    'MODE' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5aa2f60cca8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5aa2f60cca8')) {function content_5c5aa2f60cca8($_smarty_tpl) {?>



<div class="editViewPageDiv">
	<div class="col-sm-12 col-xs-12 main-scroll">
		<form class="form-horizontal" id="EditView" name="EditProfile" method="post" action="index.php" enctype="multipart/form-data">
			<div class="editViewHeader">
				<?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId()){?>
					<h4>
						<?php echo vtranslate('LBL_EDIT_PROFILE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

					</h4>
				<?php }else{ ?>
					<h4>
						<?php echo vtranslate('LBL_CREATE_PROFILE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

					</h4>
				<?php }?>
			</div>
			<hr>
			<div class="editViewBody">
				<div class="editViewContents">
					<div id="submitParams">
						<input type="hidden" name="module" value="Profiles" />
						<input type="hidden" name="action" value="Save" />
						<input type="hidden" name="parent" value="Settings" />
						<?php $_smarty_tpl->tpl_vars['RECORD_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId(), null, 0);?>
						<input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" />
						<input type="hidden" name="mode" value="<?php echo $_smarty_tpl->tpl_vars['MODE']->value;?>
" />
						<input type="hidden" name="viewall" value="0" />
						<input type="hidden" name="editall" value="0" />
					</div>

					<div name='editContent'>
						<div class="row form-group"><div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel"> 
								<label>
									<strong><?php echo vtranslate('LBL_PROFILE_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong>&nbsp;<span class="redColor">*</span>:&nbsp;
								</label></div>
							<div class="fieldValue col-lg-6 col-md-6 col-sm-6" > 
								<input type="text" class="inputElement" name="profilename" id="profilename" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getName();?>
" data-rule-required="true" />
							</div>
						</div>

						<div class="row"><div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel"> 
								<label>
									<strong><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;:&nbsp;</strong>
								</label></div>
							<div class="fieldValue col-lg-6 col-md-6 col-sm-6">
								<textarea name="description" class="inputElement" id="description" style="height:50px; resize: vertical;padding:5px 8px;"><?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getDescription();?>
</textarea>
							</div>
						</div>
						<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('EditViewContents.tpl',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					</div>
				</div>
			</div>
			<div class='modal-overlay-footer clearfix'>
				<div class="row clearfix">
					<div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
						<button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;
						<a class='cancelLink' data-dismiss="modal" href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php }} ?>