<?php /* Smarty version Smarty-3.1.7, created on 2019-02-06 12:58:48
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/CustomView/EditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11667466015c5aa8d0c04567-10974742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9480f0e20ba5b0e874ce7cede221524597621bde' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/CustomView/EditView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11667466015c5aa8d0c04567-10974742',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CUSTOMVIEW_MODEL' => 0,
    'MODULE_MODEL' => 0,
    'RECORD_ID' => 0,
    'MODULE' => 0,
    'TITLE' => 0,
    'SOURCE_MODULE' => 0,
    'CV_PRIVATE_VALUE' => 0,
    'DATE_FILTERS' => 0,
    'CUSTOM_VIEWS_LIST' => 0,
    'RECORD_STRUCTURE' => 0,
    'BLOCK_LABEL' => 0,
    'BLOCK_FIELDS' => 0,
    'FIELD_MODEL' => 0,
    'MANDATORY_FIELDS' => 0,
    'FIELD_NAME' => 0,
    'SELECTED_FIELDS' => 0,
    'FIELD_MODULE_NAME' => 0,
    'NUMBER_OF_COLUMNS_SELECTED' => 0,
    'MAX_ALLOWED_COLUMNS' => 0,
    'EVENT_RECORD_STRUCTURE' => 0,
    'LIST_SHARED' => 0,
    'CV_PUBLIC_VALUE' => 0,
    'MEMBER_GROUPS' => 0,
    'GROUP_LABEL' => 0,
    'TRANS_GROUP_LABEL' => 0,
    'ALL_GROUP_MEMBERS' => 0,
    'MEMBER' => 0,
    'SELECTED_MEMBERS_GROUP' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5aa8d0e062b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5aa8d0e062b')) {function content_5c5aa8d0e062b($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['SELECTED_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->getSelectedFields(), null, 0);?><?php $_smarty_tpl->tpl_vars['MODULE_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getFields(), null, 0);?><div id="filterContainer" style="height:100%"><form id="CustomView" style="height:100%"><div class="modal-content" style="height:100%"><div class="overlayHeader"><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value){?><?php ob_start();?><?php echo vtranslate('LBL_EDIT_CUSTOM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["TITLE"] = new Smarty_variable($_tmp1, null, 0);?><?php }else{ ?><?php ob_start();?><?php echo vtranslate('LBL_CREATE_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["TITLE"] = new Smarty_variable($_tmp2, null, 0);?><?php }?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0);?>
</div><div class="modal-body" style="height:100%"><div class="customview-content row" style="height:90%"><input type=hidden name="record" id="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" /><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="Save" /><input type="hidden" id="sourceModule" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
"/><input type="hidden" id="stdfilterlist" name="stdfilterlist" value=""/><input type="hidden" id="advfilterlist" name="advfilterlist" value=""/><input type="hidden" name="status" value="<?php echo $_smarty_tpl->tpl_vars['CV_PRIVATE_VALUE']->value;?>
"/><?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value){?><input type="hidden" name="status" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->get('status');?>
" /><?php }?><input type="hidden" name="date_filters" data-value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['DATE_FILTERS']->value));?>
' /><div class="form-group"><label><?php echo vtranslate('LBL_VIEW_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="redColor">*</span> </label><div class="row"><div class="col-lg-5 col-md-5 col-sm-5"><input class="form-control" type="text" data-record-id="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" id="viewname" name="viewname" value="<?php echo $_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->get('viewname');?>
" data-rule-required="true" data-rule-maxsize="100" data-rule-check-filter-duplicate='<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_JSON::encode($_smarty_tpl->tpl_vars['CUSTOM_VIEWS_LIST']->value));?>
'></div><div class="col-lg-5 col-md-5 col-sm-5"><label class="checkbox-inline"><input type="checkbox" name="setdefault" value="1" <?php if ($_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->isDefault()){?> checked="checked"<?php }?>> &nbsp;&nbsp;<?php echo vtranslate('LBL_SET_AS_DEFAULT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><label class="checkbox-inline"><input id="setmetrics" name="setmetrics" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->get('setmetrics')=='1'){?> checked="checked"<?php }?>> &nbsp;&nbsp;<?php echo vtranslate('LBL_LIST_IN_METRICS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></label></div></div></div><div class="form-group"><label><?php echo vtranslate('LBL_CHOOSE_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 (<?php echo vtranslate('LBL_MAX_NUMBER_FILTER_COLUMNS');?>
)</label><div class="columnsSelectDiv clearfix"><?php $_smarty_tpl->tpl_vars['MANDATORY_FIELDS'] = new Smarty_variable(array(), null, 0);?><?php $_smarty_tpl->tpl_vars['NUMBER_OF_COLUMNS_SELECTED'] = new Smarty_variable(0, null, 0);?><?php $_smarty_tpl->tpl_vars['MAX_ALLOWED_COLUMNS'] = new Smarty_variable(15, null, 0);?><select name="selectColumns" data-rule-required="true" data-msg-required="<?php echo vtranslate('LBL_PLEASE_SELECT_ATLEAST_ONE_OPTION',$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
" data-placeholder="<?php echo vtranslate('LBL_ADD_MORE_COLUMNS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" multiple class="select2 columnsSelect col-lg-10" id="viewColumnsSelect" ><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
'><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayType()=='6'){?><?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()){?><?php echo array_push($_smarty_tpl->tpl_vars['MANDATORY_FIELDS']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName());?>
<?php }?><?php $_smarty_tpl->tpl_vars['FIELD_MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getModule()->getName(), null, 0);?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"<?php if (in_array(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName()),$_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value)){?>selected<?php }elseif((!$_smarty_tpl->tpl_vars['RECORD_ID']->value)&&($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryField()||$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderField())&&($_smarty_tpl->tpl_vars['FIELD_MODULE_NAME']->value==$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value)&&(!(preg_match("/\([A-Za-z_0-9]* \; \([A-Za-z_0-9]*\) [A-Za-z_0-9]*\)/",$_smarty_tpl->tpl_vars['FIELD_NAME']->value)))&&$_smarty_tpl->tpl_vars['NUMBER_OF_COLUMNS_SELECTED']->value<$_smarty_tpl->tpl_vars['MAX_ALLOWED_COLUMNS']->value){?>selected<?php $_smarty_tpl->tpl_vars['NUMBER_OF_COLUMNS_SELECTED'] = new Smarty_variable($_smarty_tpl->tpl_vars['NUMBER_OF_COLUMNS_SELECTED']->value+1, null, 0);?><?php }?>><?php echo Vtiger_Util_Helper::toSafeHTML(vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value));?>
<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span>*</span> <?php }?></option><?php } ?></optgroup><?php } ?><?php  $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['EVENT_RECORD_STRUCTURE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key => $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value){
$_smarty_tpl->tpl_vars['BLOCK_FIELDS']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->key;
?><optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,'Events');?>
'><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_NAME']->value = $_smarty_tpl->tpl_vars['FIELD_MODEL']->key;
?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayType()=='6'){?><?php continue 1?><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()){?><?php echo array_push($_smarty_tpl->tpl_vars['MANDATORY_FIELDS']->value,$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName());?>
<?php }?><option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName();?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_NAME']->value;?>
"<?php if (in_array(decode_html($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getCustomViewColumnName()),$_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value)){?>selected<?php }?>><?php echo Vtiger_Util_Helper::toSafeHTML(vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value));?>
<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory()==true){?> <span>*</span> <?php }?></option><?php } ?></optgroup><?php } ?></select><input type="hidden" name="columnslist" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['SELECTED_FIELDS']->value);?>
' /><input id="mandatoryFieldsList" type="hidden" value='<?php echo Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($_smarty_tpl->tpl_vars['MANDATORY_FIELDS']->value));?>
' /></div><div class="col-lg-2 col-md-2 col-sm-2"></div></div><div><label class="filterHeaders"><?php echo vtranslate('LBL_CHOOSE_FILTER_CONDITIONS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 :</label><div class="filterElements well filterConditionContainer filterConditionsDiv"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('AdvanceFilter.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div><div class="checkbox"><label><input type="hidden" name="sharelist" value="0" /><input type="checkbox" data-toogle-members="true" name="sharelist" value="1" <?php if ($_smarty_tpl->tpl_vars['LIST_SHARED']->value){?> checked="checked"<?php }?>> &nbsp;&nbsp;<?php echo vtranslate('LBL_SHARE_THIS_LIST',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><select id="memberList" class="col-lg-7 col-md-7 col-sm-7 select2 members op0<?php if ($_smarty_tpl->tpl_vars['LIST_SHARED']->value){?> fadeInx<?php }?>" multiple="true" name="members[]" data-placeholder="<?php echo vtranslate('LBL_ADD_USERS_ROLES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" style="margin-bottom: 10px;" data-rule-required="<?php if ($_smarty_tpl->tpl_vars['LIST_SHARED']->value){?>true<?php }else{ ?>false<?php }?>"><optgroup label="<?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><option value="All::Users" data-member-type="<?php echo vtranslate('LBL_ALL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"<?php if (($_smarty_tpl->tpl_vars['CUSTOMVIEW_MODEL']->value->get('status')==$_smarty_tpl->tpl_vars['CV_PUBLIC_VALUE']->value)){?> selected="selected"<?php }?>><?php echo vtranslate('LBL_ALL_USERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></optgroup><?php  $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->_loop = false;
 $_smarty_tpl->tpl_vars['GROUP_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MEMBER_GROUPS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->key => $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value){
$_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->_loop = true;
 $_smarty_tpl->tpl_vars['GROUP_LABEL']->value = $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->key;
?><?php $_smarty_tpl->tpl_vars['TRANS_GROUP_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['GROUP_LABEL']->value, null, 0);?><?php if ($_smarty_tpl->tpl_vars['GROUP_LABEL']->value=='RoleAndSubordinates'){?><?php $_smarty_tpl->tpl_vars['TRANS_GROUP_LABEL'] = new Smarty_variable('LBL_ROLEANDSUBORDINATE', null, 0);?><?php }?><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['TRANS_GROUP_LABEL']->value);?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['TRANS_GROUP_LABEL'] = new Smarty_variable($_tmp3, null, 0);?><optgroup label="<?php echo $_smarty_tpl->tpl_vars['TRANS_GROUP_LABEL']->value;?>
"><?php  $_smarty_tpl->tpl_vars['MEMBER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MEMBER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_GROUP_MEMBERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MEMBER']->key => $_smarty_tpl->tpl_vars['MEMBER']->value){
$_smarty_tpl->tpl_vars['MEMBER']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getId();?>
" data-member-type="<?php echo $_smarty_tpl->tpl_vars['GROUP_LABEL']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['SELECTED_MEMBERS_GROUP']->value[$_smarty_tpl->tpl_vars['GROUP_LABEL']->value][$_smarty_tpl->tpl_vars['MEMBER']->value->getId()])){?>selected="true"<?php }?>><?php echo $_smarty_tpl->tpl_vars['MEMBER']->value->getName();?>
</option><?php } ?></optgroup><?php } ?></select><input type="hidden" name="status" id="allUsersStatusValue" value=""data-public="<?php echo $_smarty_tpl->tpl_vars['CV_PUBLIC_VALUE']->value;?>
" data-private="<?php echo $_smarty_tpl->tpl_vars['CV_PRIVATE_VALUE']->value;?>
"/></div></div><div class='modal-overlay-footer clearfix border1px'><div class="row clearfix"><div class=' textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton' id="customViewSubmit"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class='cancelLink' href="javascript:void(0);" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></div></form></div>
<?php }} ?>