<?php /* Smarty version Smarty-3.1.7, created on 2018-11-28 12:23:41
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Profiles/EditViewContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166712485bfe5795d41f20-21779742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '91de7e6d056986bfa609a3d6e1e81c4104856bef' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Profiles/EditViewContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166712485bfe5795d41f20-21779742',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SHOW_EXISTING_PROFILES' => 0,
    'SCRIPTS' => 0,
    'jsModel' => 0,
    'QUALIFIED_MODULE' => 0,
    'ALL_PROFILES' => 0,
    'PROFILE' => 0,
    'RECORD_ID' => 0,
    'RECORD_MODEL' => 0,
    'IS_DUPLICATE_RECORD' => 0,
    'PROFILE_MODULES' => 0,
    'PROFILE_MODULE' => 0,
    'MODULE_NAME' => 0,
    'TABID' => 0,
    'BASIC_ACTION_ORDER' => 0,
    'ORDERID' => 0,
    'ALL_BASIC_ACTIONS' => 0,
    'ACTION_MODEL' => 0,
    'IS_RESTRICTED_MODULE' => 0,
    'ACTION_ID' => 0,
    'FIELD_MODEL' => 0,
    'COUNTER' => 0,
    'FIELD_NAME' => 0,
    'FIELD_ID' => 0,
    'FIELD_LOCKED' => 0,
    'EVENT_MODULE' => 0,
    'ALL_UTILITY_ACTIONS' => 0,
    'ALL_UTILITY_ACTIONS_ARRAY' => 0,
    'index' => 0,
    'colspan' => 0,
    'ACTIONID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfe579605155',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfe579605155')) {function content_5bfe579605155($_smarty_tpl) {?>


<?php if ($_smarty_tpl->tpl_vars['SHOW_EXISTING_PROFILES']->value){?>
	<?php  $_smarty_tpl->tpl_vars['jsModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jsModel']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SCRIPTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jsModel']->key => $_smarty_tpl->tpl_vars['jsModel']->value){
$_smarty_tpl->tpl_vars['jsModel']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['jsModel']->key;
?>
		<script type="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getType();?>
" src="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getSrc();?>
"></script>
	<?php } ?>
	<div class="form-group row">
		<div class="col-lg-3 col-md-3 col-sm-3 control-label fieldLabel">
			<strong><?php echo vtranslate('LBL_COPY_PRIVILEGES_FROM',"Settings:Roles");?>
</strong>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6">
			<select class="select2" id="directProfilePriviligesSelect" placeholder="<?php echo vtranslate('LBL_CHOOSE_PROFILES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
">
				<option></option>
				<?php  $_smarty_tpl->tpl_vars['PROFILE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PROFILE']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_PROFILES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PROFILE']->key => $_smarty_tpl->tpl_vars['PROFILE']->value){
$_smarty_tpl->tpl_vars['PROFILE']->_loop = true;
?>
					<?php if ($_smarty_tpl->tpl_vars['PROFILE']->value->isDirectlyRelated()==false){?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['PROFILE']->value->getId();?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value==$_smarty_tpl->tpl_vars['PROFILE']->value->getId()){?> selected="" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['PROFILE']->value->getName();?>
</option>
					<?php }?>
				<?php } ?>
			</select>
		</div>
	</div>
<?php }?>
<input type="hidden" name="viewall" value="0" />
<input type="hidden" name="editall" value="0" />
<?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value&&$_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getId()&&empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)){?>
	<?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalReadPermission()||$_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalWritePermission()){?>
		<div class="form-group row">
			<div class="col-lg-3 col-md-3 col-sm-3 fieldLabel"></div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<label class="control-label">
					<input type="hidden" name="viewall" value="0" />
					<label class="control-label">
						<input class="listViewEntriesCheckBox" type="checkbox" name="viewall" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalReadPermission()){?>checked="true"<?php }?> style="top: -2px;" />
						&nbsp;<?php echo vtranslate('LBL_VIEW_ALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;
					</label>
					<span style="margin-left: 10px">
						<i class="fa fa-info-circle" title="<?php echo vtranslate('LBL_VIEW_ALL_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>
					</span>
				</label>
				<br>
				<label class="control-label">
					<input type="hidden" name="editall" value="0" />
					<label class="control-label">
						<input class="listViewEntriesCheckBox" type="checkbox" name="editall" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasGlobalReadPermission()){?>checked="true"<?php }?> style="top: -2px;"/>
						&nbsp;<?php echo vtranslate('LBL_EDIT_ALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;
					</label>
					<span style="margin-left: 15px">
						<i class="fa fa-info-circle" title="<?php echo vtranslate('LBL_EDIT_ALL_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>
					</span>
				</label>
				<br><br>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 fieldLabel"></div>
			<div class="col-lg-7 col-md-7 col-sm-7">
				<div class="alert alert-warning" style="width:85%">
					<?php echo vtranslate('LBL_GLOBAL_PERMISSION_WARNING',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

				</div>
			</div>
	<?php }?>
<?php }?>
<div class="row col-lg-12 col-md-12 col-sm-12">
	<div class=" col-lg-10 col-md-10 col-sm-10">
		<h5><?php echo vtranslate('LBL_EDIT_PRIVILEGES_OF_THIS_PROFILE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h5><br>
	</div>
</div>
<div class="row">
	<div class="col-lg-1 col-md-1 col-sm-1"></div>
	<div class=" col-lg-10 col-md-10 col-sm-10">
		<table class="table table-bordered profilesEditView">
			<thead>
				<tr class="blockHeader">
					<th width="25%" style="text-align: left !important">
						<label><input class="verticalAlignMiddle" checked="true" type="checkbox" id="mainModulesCheckBox" style="top: -2px;"/>&nbsp;
							<?php echo vtranslate('LBL_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						</label>
					</th>
					<th class='textAlignCenter' width="14%">
						<label><input class="verticalAlignMiddle" type="checkbox" <?php if (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value)&&empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)){?> checked="true" <?php }?> id="mainAction4CheckBox" style="top: -2px;" />&nbsp;
							<?php echo vtranslate('LBL_VIEW_PRVILIGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						</label>
					</th>
					<th class='textAlignCenter' width="14%">
						<label><input class="verticalAlignMiddle" <?php if (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value)&&empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)){?> checked="true" <?php }?> type="checkbox" id="mainAction7CheckBox" style="top: -2px;"/>&nbsp;
							<?php echo vtranslate('LBL_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						</label>
					</th>
					<th class='textAlignCenter' width="14%">
						<label><input class="verticalAlignMiddle" <?php if (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value)&&empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)){?> checked="true" <?php }?> type="checkbox" id="mainAction1CheckBox" style="top: -2px;" />&nbsp;
							<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						</label>
					</th>
					<th class='textAlignCenter' width="14%">
						<label><input class="verticalAlignMiddle" checked="true" type="checkbox" id="mainAction2CheckBox" style="top: -2px;" />&nbsp;
							<?php echo vtranslate('LBL_DELETE_PRVILIGE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

						</label>
					</th>
					<th class='textAlignCenter verticalAlignMiddleImp' width="28%;" nowrap="nowrap">
						<?php echo vtranslate('LBL_FIELD_AND_TOOL_PRIVILEGES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

					</th>
				</tr>
			</thead>
			<tbody>
				<?php $_smarty_tpl->tpl_vars['PROFILE_MODULES'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModulePermissions(), null, 0);?>
				<?php  $_smarty_tpl->tpl_vars['PROFILE_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PROFILE_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['TABID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PROFILE_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PROFILE_MODULE']->key => $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value){
$_smarty_tpl->tpl_vars['PROFILE_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['TABID']->value = $_smarty_tpl->tpl_vars['PROFILE_MODULE']->key;
?>
					<?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName(), null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value!='Events'){?>
						<?php $_smarty_tpl->tpl_vars['IS_RESTRICTED_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->isRestrictedModule($_smarty_tpl->tpl_vars['MODULE_NAME']->value), null, 0);?>
						<tr>
							<td class="verticalAlignMiddleImp">
								<input class="modulesCheckBox" type="checkbox" name="permissions[<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
][is_permitted]" data-value="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
" data-module-state="" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModulePermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value)){?>checked="true"<?php }else{ ?> data-module-unchecked="true" <?php }?>> <?php echo vtranslate($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->get('label'),$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName());?>

							</td>
							<?php $_smarty_tpl->tpl_vars["BASIC_ACTION_ORDER"] = new Smarty_variable(array(2,3,0,1), null, 0);?>
							<?php  $_smarty_tpl->tpl_vars['ORDERID'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ORDERID']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['BASIC_ACTION_ORDER']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ORDERID']->key => $_smarty_tpl->tpl_vars['ORDERID']->value){
$_smarty_tpl->tpl_vars['ORDERID']->_loop = true;
?>
								<td class="textAlignCenter verticalAlignMiddleImp">
									<?php $_smarty_tpl->tpl_vars["ACTION_MODEL"] = new Smarty_variable($_smarty_tpl->tpl_vars['ALL_BASIC_ACTIONS']->value[$_smarty_tpl->tpl_vars['ORDERID']->value], null, 0);?>
									<?php $_smarty_tpl->tpl_vars['ACTION_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->get('actionid'), null, 0);?>
									<?php if (!$_smarty_tpl->tpl_vars['IS_RESTRICTED_MODULE']->value&&$_smarty_tpl->tpl_vars['ACTION_MODEL']->value->isModuleEnabled($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value)){?>
										<input class="action<?php echo $_smarty_tpl->tpl_vars['ACTION_ID']->value;?>
CheckBox" type="checkbox" name="permissions[<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
][actions][<?php echo $_smarty_tpl->tpl_vars['ACTION_ID']->value;?>
]" data-action-state="<?php echo $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName();?>
" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['ACTION_MODEL']->value)){?>checked="true"<?php }elseif(empty($_smarty_tpl->tpl_vars['RECORD_ID']->value)&&empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)){?> checked="true" <?php }else{ ?> data-action<?php echo $_smarty_tpl->tpl_vars['ACTION_ID']->value;?>
-unchecked="true"<?php }?>></td>
									<?php }?>
								</td>
							<?php } ?>
							<td class="textAlignCenter">
								<?php if (($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields()&&$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isEntityModule()&&$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isProfileLevelUtilityAllowed())||$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isUtilityActionEnabled()){?>
									<button type="button" data-handlerfor="fields" data-togglehandler="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" class="btn btn-default btn-sm" style="padding-right: 20px; padding-left: 20px;">
										<i class="fa fa-chevron-down"></i>
									</button>
								<?php }?>
							</td>
						</tr>
						<tr class="hide">
							<td colspan="6" class="row" style="padding-left: 5%;padding-right: 5%">
								<div class="row" data-togglecontent="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" style="display: none">
									<?php if ($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields()&&$_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->isEntityModule()){?>
										<div class="col-sm-12">
											<label class="pull-left"><strong><?php echo vtranslate('LBL_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Calendar'){?> <?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 <?php echo vtranslate('LBL_TASKS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php }?></strong></label>
											<div class="pull-right">
												<span class="mini-slider-control ui-slider" data-value="0">
													<a style="margin-top: 3px" class="ui-slider-handle"></a>
												</span>
												<span style="margin: 0 20px;"><?php echo vtranslate('LBL_INIVISIBLE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;
												<span class="mini-slider-control ui-slider" data-value="1">
													<a style="margin-top: 3px" class="ui-slider-handle"></a>
												</span>
												<span style="margin: 0 20px;"><?php echo vtranslate('LBL_READ_ONLY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;
												<span class="mini-slider-control ui-slider" data-value="2">
													<a style="margin-top: 3px" class="ui-slider-handle"></a>
												</span>
												<span style="margin: 0 20px;"><?php echo vtranslate('LBL_WRITE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>
											</div>
											<div class="clearfix"></div>
										</div>
										<table class="table table-bordered no-border">
											<?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?>
											<?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration++;
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->last = $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration === $_smarty_tpl->tpl_vars['FIELD_MODEL']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["fields"]['last'] = $_smarty_tpl->tpl_vars['FIELD_MODEL']->last;
?>
												<?php $_smarty_tpl->tpl_vars['FIELD_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId(), null, 0);?>
												<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isActiveField()&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('uitype')!='83'&&$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('displaytype')!='6'){?>
													<?php if ($_smarty_tpl->tpl_vars['COUNTER']->value%3==0){?>
														<tr>
													<?php }?>
													<td >
														<!-- Field will be locked iff that field is non editable or Mandatory or UIType 70.
														 But, we can't set emailoptout field to either Mandatory/non-editable/uitype70
														-->
														<?php $_smarty_tpl->tpl_vars["FIELD_LOCKED"] = new Smarty_variable(true, null, 0);?>
														<?php if ($_smarty_tpl->tpl_vars['FIELD_NAME']->value!='emailoptout'){?>
															<?php $_smarty_tpl->tpl_vars["FIELD_LOCKED"] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->isModuleFieldLocked($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value), null, 0);?>
														<?php }?>
														<input type="hidden" name="permissions[<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
][fields][<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
]" data-range-input="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModuleFieldPermissionValue($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value);?>
" readonly="true">
														<div class="mini-slider-control editViewMiniSlider pull-left" data-locked="<?php echo $_smarty_tpl->tpl_vars['FIELD_LOCKED']->value;?>
" data-range="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
" data-value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModuleFieldPermissionValue($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value);?>
"></div>
														<div class="pull-left">
															<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()){?><span class="redColor">*</span><?php }?>
														</div>
													</td>
													<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fields']['last']||($_smarty_tpl->tpl_vars['COUNTER']->value+1)%3==0){?>
														</tr>
													<?php }?>
												<?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?>
												<?php }elseif($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('displaytype')=='6'||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getName()=='adjusted_amount'){?>
													<input type='hidden' name='permissions[<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
][fields][<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
]' value='2' />
												<?php }?>
											<?php } ?>
										</table>
										<?php if ($_smarty_tpl->tpl_vars['MODULE_NAME']->value=='Calendar'){?>
											<?php $_smarty_tpl->tpl_vars['EVENT_MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['PROFILE_MODULES']->value[16], null, 0);?>
											<?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable(0, null, 0);?>
											<label class="pull-left"><strong><?php echo vtranslate('LBL_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 <?php echo vtranslate('LBL_OF',$_smarty_tpl->tpl_vars['EVENT_MODULE']->value->getName());?>
 <?php echo vtranslate('LBL_EVENTS',$_smarty_tpl->tpl_vars['EVENT_MODULE']->value->getName());?>
</strong></label>
											<table class="table table-bordered">
												<?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['EVENT_MODULE']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration++;
 $_smarty_tpl->tpl_vars['FIELD_MODEL']->last = $_smarty_tpl->tpl_vars['FIELD_MODEL']->iteration === $_smarty_tpl->tpl_vars['FIELD_MODEL']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["fields"]['last'] = $_smarty_tpl->tpl_vars['FIELD_MODEL']->last;
?>
													<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isActiveField()){?>
														<?php $_smarty_tpl->tpl_vars["FIELD_ID"] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getId(), null, 0);?>
														<?php if ($_smarty_tpl->tpl_vars['COUNTER']->value%3==0){?>
															<tr>
															<?php }?>
															<td>
																<?php $_smarty_tpl->tpl_vars["FIELD_LOCKED"] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->isModuleFieldLocked($_smarty_tpl->tpl_vars['EVENT_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value), null, 0);?>
																<input type="hidden" name="permissions[16][fields][<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
]" data-range-input="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModuleFieldPermissionValue($_smarty_tpl->tpl_vars['EVENT_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value);?>
" readonly="true">
																<div class="mini-slider-control editViewMiniSlider pull-left" data-locked="<?php echo $_smarty_tpl->tpl_vars['FIELD_LOCKED']->value;?>
" data-range="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
" data-value="<?php echo $_smarty_tpl->tpl_vars['RECORD_MODEL']->value->getModuleFieldPermissionValue($_smarty_tpl->tpl_vars['EVENT_MODULE']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value);?>
"></div>
																<div class="pull-left">
																	<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()){?><span class="redColor">*</span><?php }?> 
																</div>
															</td>
															<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fields']['last']||($_smarty_tpl->tpl_vars['COUNTER']->value+1)%3==0){?>
															</tr>
														<?php }?>
														<?php $_smarty_tpl->tpl_vars['COUNTER'] = new Smarty_variable($_smarty_tpl->tpl_vars['COUNTER']->value+1, null, 0);?>
													<?php }?>
												<?php } ?>
											</table>
										<?php }?>
									<?php }?>
								</div>
							</td>
						</tr>
						<tr class="hide <?php echo $_smarty_tpl->tpl_vars['PROFILE_MODULE']->value->getName();?>
_ACTIONS">
							<?php $_smarty_tpl->tpl_vars['UTILITY_ACTION_COUNT'] = new Smarty_variable(0, null, 0);?>
							<?php $_smarty_tpl->tpl_vars["ALL_UTILITY_ACTIONS_ARRAY"] = new Smarty_variable(array(), null, 0);?>
							<?php  $_smarty_tpl->tpl_vars['ACTION_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ACTION_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_MODEL']->key => $_smarty_tpl->tpl_vars['ACTION_MODEL']->value){
$_smarty_tpl->tpl_vars['ACTION_MODEL']->_loop = true;
?>
								<?php if ($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->isModuleEnabled($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value)){?>
									<?php $_smarty_tpl->tpl_vars["testArray"] = new Smarty_variable(array_push($_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS_ARRAY']->value,$_smarty_tpl->tpl_vars['ACTION_MODEL']->value), null, 0);?>
								<?php }?>
							<?php } ?>
							<?php if ($_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS_ARRAY']->value){?>
								<td colspan="6" class="row" style="padding-left: 5%;padding-right: 5%;">
									<div class="row" data-togglecontent="<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
-fields" style="display: none">
										<div class="col-sm-12">
											<label class="pull-left">
												<strong><?php echo vtranslate('LBL_TOOLS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong>
											</label>
										</div>
										<table class="table table-bordered">
											<tr>
												<?php  $_smarty_tpl->tpl_vars['ACTION_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ACTION_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_UTILITY_ACTIONS_ARRAY']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['ACTION_MODEL']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['ACTION_MODEL']->iteration=0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["actions"]['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['ACTION_MODEL']->key => $_smarty_tpl->tpl_vars['ACTION_MODEL']->value){
$_smarty_tpl->tpl_vars['ACTION_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['ACTION_MODEL']->iteration++;
 $_smarty_tpl->tpl_vars['ACTION_MODEL']->last = $_smarty_tpl->tpl_vars['ACTION_MODEL']->iteration === $_smarty_tpl->tpl_vars['ACTION_MODEL']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["actions"]['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["actions"]['last'] = $_smarty_tpl->tpl_vars['ACTION_MODEL']->last;
?>
													<?php $_smarty_tpl->tpl_vars['ACTIONID'] = new Smarty_variable($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->get('actionid'), null, 0);?>
													<td <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['actions']['last']&&(($_smarty_tpl->getVariable('smarty')->value['foreach']['actions']['index']+1)%3!=0)){?>
														<?php $_smarty_tpl->tpl_vars["index"] = new Smarty_variable(($_smarty_tpl->getVariable('smarty')->value['foreach']['actions']['index']+1)%3, null, 0);?>
														<?php $_smarty_tpl->tpl_vars["colspan"] = new Smarty_variable(4-$_smarty_tpl->tpl_vars['index']->value, null, 0);?>
														colspan="<?php echo $_smarty_tpl->tpl_vars['colspan']->value;?>
"
														<?php }?>>
														<input type="checkbox" <?php if (empty($_smarty_tpl->tpl_vars['RECORD_ID']->value)&&empty($_smarty_tpl->tpl_vars['IS_DUPLICATE_RECORD']->value)){?> checked="true" <?php }?> name="permissions[<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
][actions][<?php echo $_smarty_tpl->tpl_vars['ACTIONID']->value;?>
]" <?php if ($_smarty_tpl->tpl_vars['RECORD_MODEL']->value->hasModuleActionPermission($_smarty_tpl->tpl_vars['PROFILE_MODULE']->value,$_smarty_tpl->tpl_vars['ACTIONID']->value)){?>checked="true"<?php }?> data-action-name='<?php echo $_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName();?>
' data-action-tool='<?php echo $_smarty_tpl->tpl_vars['TABID']->value;?>
'> <?php echo vtranslate($_smarty_tpl->tpl_vars['ACTION_MODEL']->value->getName(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>

													</td>
													<?php if (($_smarty_tpl->getVariable('smarty')->value['foreach']['actions']['index']+1)%3==0){?>
														</tr><tr>
													<?php }?>
												<?php } ?>
											</tr>
										</table>
									</div>
								</td>
							<?php }?>
						</tr>
					<?php }?>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php }} ?>