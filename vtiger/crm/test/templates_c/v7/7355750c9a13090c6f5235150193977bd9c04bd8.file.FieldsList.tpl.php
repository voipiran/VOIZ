<?php /* Smarty version Smarty-3.1.7, created on 2018-06-18 11:09:03
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/LayoutEditor/FieldsList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19499925845b275387d28117-72844686%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7355750c9a13090c6f5235150193977bd9c04bd8' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/LayoutEditor/FieldsList.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19499925845b275387d28117-72844686',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SELECTED_MODULE_MODEL' => 0,
    'QUALIFIED_MODULE' => 0,
    'IS_SORTABLE' => 0,
    'BLOCKS' => 0,
    'BLOCK_LABEL_KEY' => 0,
    'BLOCK_MODEL' => 0,
    'BLOCK_ID' => 0,
    'IS_BLOCK_SORTABLE' => 0,
    'SELECTED_MODULE_NAME' => 0,
    'IS_FIELDS_SORTABLE' => 0,
    'FIELDS_LIST' => 0,
    'FIELD_MODEL' => 0,
    'IS_MANDATORY' => 0,
    'NOT_M_FIELD_TITLE' => 0,
    'M_FIELD_TITLE' => 0,
    'IS_QUICK_EDIT_ENABLED' => 0,
    'NOT_Q_FIELD_TITLE' => 0,
    'Q_FIELD_TITLE' => 0,
    'IS_MASS_EDIT_ENABLED' => 0,
    'NOT_M_E_FIELD_TITLE' => 0,
    'M_E_FIELD_TITLE' => 0,
    'IS_HEADER_FIELD' => 0,
    'NOT_H_FIELD_TITLE' => 0,
    'H_FIELD_TITLE' => 0,
    'IS_SUMMARY_VIEW_ENABLED' => 0,
    'NOT_S_FIELD_TITLE' => 0,
    'S_FIELD_TITLE' => 0,
    'DEFAULT_VALUE' => 0,
    'DEFAULT_FIELD_VALUE' => 0,
    'DEFAULT_FIELD_NAME' => 0,
    'ONE_ONE_RELATION_FIELD_LABEL' => 0,
    'ONE_ONE_RELATION_MODULE_NAME' => 0,
    'ONE_ONE_RELATION_FIELD_NAME' => 0,
    'RELATION_MODEL' => 0,
    'IN_ACTIVE_FIELDS' => 0,
    'HEADER_FIELDS_COUNT' => 0,
    'HEADER_FIELDS_META' => 0,
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'ALL_BLOCK_LABELS' => 0,
    'CLEAN_FIELD_MODEL' => 0,
    'FIELDS_INFO' => 0,
    'NEW_FIELDS_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5b2753882b50b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b2753882b50b')) {function content_5b2753882b50b($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['IS_SORTABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['SELECTED_MODULE_MODEL']->value->isSortableAllowed(), null, 0);?><?php $_smarty_tpl->tpl_vars['ALL_BLOCK_LABELS'] = new Smarty_variable(array(), null, 0);?><div class="row fieldsListContainer" style="padding:1% 0"><div class="col-sm-6"><button class="btn btn-default addButton addCustomBlock" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_CUSTOM_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div><div class="col-sm-6"><?php if ($_smarty_tpl->tpl_vars['IS_SORTABLE']->value){?><span class="pull-right"><button class="btn btn-success saveFieldSequence" type="button" style="opacity:0;margin-right:0px;"><?php echo vtranslate('LBL_SAVE_LAYOUT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span><?php }?></div></div><div class="row"><div class="col-sm-12"><div id="moduleBlocks" style="margin-top:17px;"><?php  $_smarty_tpl->tpl_vars['BLOCK_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCKS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_MODEL']->key => $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value){
$_smarty_tpl->tpl_vars['BLOCK_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value = $_smarty_tpl->tpl_vars['BLOCK_MODEL']->key;
?><?php $_smarty_tpl->tpl_vars['IS_BLOCK_SORTABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['SELECTED_MODULE_MODEL']->value->isBlockSortableAllowed($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['FIELDS_LIST'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->getLayoutBlockActiveFields(), null, 0);?><?php $_smarty_tpl->tpl_vars['BLOCK_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('id'), null, 0);?><?php if ($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value!='LBL_INVITE_USER_BLOCK'){?><?php $_smarty_tpl->createLocalArrayVariable('ALL_BLOCK_LABELS', null, 0);
$_smarty_tpl->tpl_vars['ALL_BLOCK_LABELS']->value[$_smarty_tpl->tpl_vars['BLOCK_ID']->value] = $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value;?><?php }?><div id="block_<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" class="editFieldsTable block_<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
 marginBottom10px border1px <?php if ($_smarty_tpl->tpl_vars['IS_BLOCK_SORTABLE']->value){?> blockSortable<?php }?>" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-sequence="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('sequence');?>
" style="background: white;"data-custom-fields-count="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->getCustomFieldsCount();?>
"><div class="col-sm-12"><div class="layoutBlockHeader row"><div class="blockLabel col-sm-3 padding10 marginLeftZero" style="word-break: break-all;"><?php if ($_smarty_tpl->tpl_vars['IS_BLOCK_SORTABLE']->value){?><img class="cursorPointerMove" src="<?php echo vimage_path('drag.png');?>
" />&nbsp;&nbsp;<?php }?><strong class="translatedBlockLabel"><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</strong></div><div class="col-sm-9 padding10 marginLeftZero"><div class="blockActions" style="float:right !important;"><span><i class="fa fa-info-circle" title="<?php echo vtranslate('LBL_COLLAPSE_BLOCK_DETAIL_VIEW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp; <?php echo vtranslate('LBL_COLLAPSE_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<input style="opacity: 0;" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isHidden()){?> checked value='0' <?php }else{ ?> value='1' <?php }?> class ='cursorPointer bootstrap-switch' name="collapseBlock"data-on-text="<?php echo vtranslate('LBL_YES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-off-text="<?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-on-color="primary" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('id');?>
"/></span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isAddCustomFieldEnabled()){?><button class="btn btn-default addButton btn-sm addCustomField" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_CUSTOM_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<?php }?><?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isActionsAllowed()){?><button class="inActiveFields addButton btn btn-default btn-sm"><?php echo vtranslate('LBL_SHOW_HIDDEN_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isCustomized()){?><button class="deleteCustomBlock addButton btn btn-default btn-sm"><?php echo vtranslate('LBL_DELETE_CUSTOM_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php }?><?php }?></div></div></div></div><?php $_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['SELECTED_MODULE_MODEL']->value->isFieldsSortableAllowed($_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value), null, 0);?><div class="blockFieldsList <?php if ($_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE']->value){?> blockFieldsSortable <?php }?> row"><ul name="<?php if ($_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE']->value){?>sortable1<?php }else{ ?>unSortable1<?php }?>" class="connectedSortable col-sm-6"><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fieldlist']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fieldlist']['index']++;
?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fieldlist']['index']%2==0){?><li><div class="row border1px"><div class="col-sm-4"><div class="opacity editFields marginLeftZero" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"data-sequence="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('sequence');?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
"><div class="row"><?php $_smarty_tpl->tpl_vars['IS_MANDATORY'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(), null, 0);?><span class="col-sm-1">&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE']->value){?><img src="<?php echo vimage_path('drag.png');?>
" class="cursorPointerMove" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"/><?php }?></span><div class="col-sm-9" style="word-wrap: break-word;"><div class="fieldLabelContainer row"><span class="fieldLabel"><b><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</b>&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_MANDATORY']->value){?><span class="redColor">*</span><?php }?></span><br><span class="pull-right" style="opacity:0.6;"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataTypeLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div></div></div></div><div class="col-sm-8 fieldPropertyContainer"><div class="row " style="padding: 10px 0px;"><?php ob_start();?><?php echo vtranslate('LBL_MAKE_THIS_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_PROP_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['M_FIELD_TITLE'] = new Smarty_variable($_tmp1, null, 0);?><?php ob_start();?><?php echo vtranslate('LBL_SHOW_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['Q_FIELD_TITLE'] = new Smarty_variable($_tmp2, null, 0);?><?php ob_start();?><?php echo vtranslate('LBL_SHOW_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['M_E_FIELD_TITLE'] = new Smarty_variable($_tmp3, null, 0);?><?php ob_start();?><?php echo vtranslate('LBL_SHOW_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));?>
<?php $_tmp4=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['S_FIELD_TITLE'] = new Smarty_variable($_tmp4, null, 0);?><?php ob_start();?><?php echo vtranslate('LBL_SHOW_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_DETAIL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));?>
<?php $_tmp5=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['H_FIELD_TITLE'] = new Smarty_variable($_tmp5, null, 0);?><?php ob_start();?><?php echo vtranslate('LBL_NOT_MAKE_THIS_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_PROP_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));?>
<?php $_tmp6=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['NOT_M_FIELD_TITLE'] = new Smarty_variable($_tmp6, null, 0);?><?php ob_start();?><?php echo vtranslate('LBL_HIDE_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));?>
<?php $_tmp7=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['NOT_Q_FIELD_TITLE'] = new Smarty_variable($_tmp7, null, 0);?><?php ob_start();?><?php echo vtranslate('LBL_HIDE_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));?>
<?php $_tmp8=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['NOT_M_E_FIELD_TITLE'] = new Smarty_variable($_tmp8, null, 0);?><?php ob_start();?><?php echo vtranslate('LBL_HIDE_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));?>
<?php $_tmp9=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['NOT_S_FIELD_TITLE'] = new Smarty_variable($_tmp9, null, 0);?><?php ob_start();?><?php echo vtranslate('LBL_HIDE_THIS_FIELD_IN',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value,vtranslate('LBL_DETAIL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value));?>
<?php $_tmp10=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['NOT_H_FIELD_TITLE'] = new Smarty_variable($_tmp10, null, 0);?><?php $_smarty_tpl->tpl_vars['IS_MANDATORY'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(), null, 0);?><div class="fieldProperties col-sm-10" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"><span class="mandatory switch text-capitalize <?php if ((!$_smarty_tpl->tpl_vars['IS_MANDATORY']->value)){?>disabled<?php }?> <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatoryOptionDisabled()){?> cursorPointerNotAllowed <?php }else{ ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_MANDATORY']->value){?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_M_FIELD_TITLE']->value;?>
" <?php }else{ ?> title="<?php echo $_smarty_tpl->tpl_vars['M_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-exclamation-circle" data-name="mandatory"data-enable-value="M" data-disable-value="O"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatoryOptionDisabled()){?>readonly="readonly"<?php }?>></i>&nbsp;<?php echo vtranslate('LBL_PROP_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $_smarty_tpl->tpl_vars['IS_QUICK_EDIT_ENABLED'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateEnabled(), null, 0);?><span class="quickCreate switch <?php if ((!$_smarty_tpl->tpl_vars['IS_QUICK_EDIT_ENABLED']->value)){?>disabled<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateOptionDisabled()||$_smarty_tpl->tpl_vars['IS_MANDATORY']->value){?> cursorPointerNotAllowed <?php }else{ ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_QUICK_EDIT_ENABLED']->value){?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_Q_FIELD_TITLE']->value;?>
" <?php }else{ ?> title="<?php echo $_smarty_tpl->tpl_vars['Q_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-plus" data-name="quickcreate"data-enable-value="2" data-disable-value="1"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateOptionDisabled()||$_smarty_tpl->tpl_vars['IS_MANDATORY']->value){?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><?php $_smarty_tpl->tpl_vars['IS_MASS_EDIT_ENABLED'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditable(), null, 0);?><span class="massEdit switch <?php if ((!$_smarty_tpl->tpl_vars['IS_MASS_EDIT_ENABLED']->value)){?> disabled <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditOptionDisabled()){?> cursorPointerNotAllowed <?php }else{ ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_MASS_EDIT_ENABLED']->value){?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_M_E_FIELD_TITLE']->value;?>
" <?php }else{ ?> title="<?php echo $_smarty_tpl->tpl_vars['M_E_FIELD_TITLE']->value;?>
" <?php }?>><img src="<?php echo vimage_path('MassEdit.png');?>
" data-name="masseditable"data-enable-value="1" data-disable-value="2" title="<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditOptionDisabled()){?>readonly="readonly"<?php }?> height=14 width=14/>&nbsp;<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $_smarty_tpl->tpl_vars['IS_HEADER_FIELD'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderField(), null, 0);?><span class="header switch <?php if ((!$_smarty_tpl->tpl_vars['IS_HEADER_FIELD']->value)){?> disabled <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderFieldOptionDisabled()){?> cursorPointerNotAllowed <?php }else{ ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_HEADER_FIELD']->value){?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_H_FIELD_TITLE']->value;?>
" <?php }else{ ?> title="<?php echo $_smarty_tpl->tpl_vars['H_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-flag-o" data-name="headerfield"data-enable-value="1" data-disable-value="0"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderFieldOptionDisabled()){?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><?php $_smarty_tpl->tpl_vars['IS_SUMMARY_VIEW_ENABLED'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryField(), null, 0);?><span class="summary switch <?php if ((!$_smarty_tpl->tpl_vars['IS_SUMMARY_VIEW_ENABLED']->value)){?> disabled <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryFieldOptionDisabled()){?> cursorPointerNotAllowed <?php }else{ ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_SUMMARY_VIEW_ENABLED']->value){?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_S_FIELD_TITLE']->value;?>
" <?php }else{ ?> title="<?php echo $_smarty_tpl->tpl_vars['S_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-key" data-name="summaryfield"data-enable-value="1" data-disable-value="0"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryFieldOptionDisabled()){?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><div class="defaultValue col-sm-12 <?php if (!$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()){?>disabled<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()){?> cursorPointerNotAllowed <?php }?>"><?php $_smarty_tpl->tpl_vars['DEFAULT_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDefaultFieldValueToViewInV7FieldsLayOut(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value){?><?php if (is_array($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value)){?><?php  $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->key => $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value){
$_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value = $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->key;
?><div class="row"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()){?> readonly="readonly" <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()){?> title="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" <?php }?>data-name="defaultValueField" height=14 width=14 /></span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value){?><?php $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME'] = new Smarty_variable(mb_strtoupper($_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value, 'UTF-8'), null, 0);?><span><?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php echo vtranslate("LBL_".($_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : </span><span data-defaultvalue-fieldname="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value;?>
" data-defaultvalue="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value;?>
</span><?php }else{ ?><?php echo vtranslate('LBL_DEFAULT_VALUE_NOT_SET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?></div><?php } ?><?php }else{ ?><div class="row"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()){?> readonly="readonly" <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()){?> title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
" <?php }?>data-name="defaultValueField" height=14 width=14 /></span>&nbsp;<span><?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : </span><span data-defaultvalue="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
</span></div><?php }?><?php }else{ ?><div class="row"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()){?> readonly="readonly" <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()){?> title="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" <?php }?>data-name="defaultValueField" height=14 width=14 /></span>&nbsp;<span><?php echo vtranslate('LBL_DEFAULT_VALUE_NOT_SET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div><?php }?></div></div><span class="col-sm-2 actions"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEditable()){?><a href="javascript:void(0)" class="editFieldDetails"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isCustomField()=='true'){?><a href="javascript:void(0)" class="deleteCustomField pull-right" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"data-one-one-relationship="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isOneToOneRelationField();?>
" data-relationship-field="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isRelationShipReponsibleField();?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isOneToOneRelationField()){?><?php $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->get('label'), null, 0);?><?php $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->getModuleName(), null, 0);?><?php $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->getName(), null, 0);?>data-relation-field-label="<?php echo $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_LABEL']->value;?>
"data-relation-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['ONE_ONE_RELATION_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['ONE_ONE_RELATION_MODULE_NAME']->value);?>
"data-current-field-label ="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
"data-current-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
"data-field-name="<?php echo $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_NAME']->value;?>
"<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isRelationShipReponsibleField()){?><?php $_smarty_tpl->tpl_vars['RELATION_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getRelationShipForThisField(), null, 0);?>data-relation-field-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"data-relation-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName(),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"data-current-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getParentModuleName(),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getParentModuleName());?>
"data-current-tab-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"<?php }?> ><i class="fa fa-trash" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a><?php }?></span></div></div></div></li><?php }?><?php } ?><?php if (count($_smarty_tpl->tpl_vars['FIELDS_LIST']->value)%2==0){?><?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isAddCustomFieldEnabled()){?><li class="row dummyRow"><span class="dragUiText col-sm-8"><?php echo vtranslate('LBL_ADD_NEW_FIELD_HERE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><span class="col-sm-4" style="margin-top: 7%;margin-left: -15%;"><button class="btn btn-default btn-sm addButton"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span></li><?php }?><?php }?></ul><ul name="<?php if ($_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE']->value){?>sortable2<?php }else{ ?>unSortable2<?php }?>" class="connectedSortable col-sm-6"><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fieldlist1']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fieldlist1']['index']++;
?><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fieldlist1']['index']%2!=0){?><li><div class="row border1px"><div class="col-sm-4"><div class="opacity editFields marginLeftZero" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"data-sequence="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('sequence');?>
" data-field-name="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name');?>
"><div class="row" ><?php $_smarty_tpl->tpl_vars['IS_MANDATORY'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(), null, 0);?><span class="col-sm-1">&nbsp;<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEditable()&&$_smarty_tpl->tpl_vars['IS_FIELDS_SORTABLE']->value){?><img src="<?php echo vimage_path('drag.png');?>
" class="cursorPointerMove" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"/><?php }?></span><div class="col-sm-9" style="word-wrap: break-word;"><div class="fieldLabelContainer row"><span class="fieldLabel"><b><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</b><?php if ($_smarty_tpl->tpl_vars['IS_MANDATORY']->value){?>&nbsp;<span class="redColor">*</span><?php }?></span><br><span class="pull-right" style="opacity:0.6;"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getFieldDataTypeLabel(),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div></div></div></div></div><div class="col-sm-8 fieldPropertyContainer"><div class="row " style="padding: 10px 0px;"><?php $_smarty_tpl->tpl_vars['IS_MANDATORY'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatory(), null, 0);?><div class="fieldProperties col-sm-10" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"><span class="mandatory switch text-capitalize <?php if ((!$_smarty_tpl->tpl_vars['IS_MANDATORY']->value)){?>disabled<?php }?> <?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatoryOptionDisabled()){?> cursorPointerNotAllowed <?php }else{ ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_MANDATORY']->value){?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_M_FIELD_TITLE']->value;?>
" <?php }else{ ?> title="<?php echo $_smarty_tpl->tpl_vars['M_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-exclamation-circle" data-name="mandatory"data-enable-value="M" data-disable-value="O"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMandatoryOptionDisabled()){?>readonly="readonly"<?php }?>></i>&nbsp;<?php echo vtranslate('LBL_PROP_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $_smarty_tpl->tpl_vars['IS_QUICK_EDIT_ENABLED'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateEnabled(), null, 0);?><span class="quickCreate switch <?php if ((!$_smarty_tpl->tpl_vars['IS_QUICK_EDIT_ENABLED']->value)){?>disabled<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateOptionDisabled()||$_smarty_tpl->tpl_vars['IS_MANDATORY']->value){?> cursorPointerNotAllowed <?php }else{ ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_QUICK_EDIT_ENABLED']->value){?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_Q_FIELD_TITLE']->value;?>
" <?php }else{ ?> title="<?php echo $_smarty_tpl->tpl_vars['Q_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-plus" data-name="quickcreate"data-enable-value="2" data-disable-value="1"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isQuickCreateOptionDisabled()||$_smarty_tpl->tpl_vars['IS_MANDATORY']->value){?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><?php $_smarty_tpl->tpl_vars['IS_MASS_EDIT_ENABLED'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditable(), null, 0);?><span class="massEdit switch <?php if ((!$_smarty_tpl->tpl_vars['IS_MASS_EDIT_ENABLED']->value)){?> disabled <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditOptionDisabled()){?> cursorPointerNotAllowed <?php }else{ ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_MASS_EDIT_ENABLED']->value){?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_M_E_FIELD_TITLE']->value;?>
" <?php }else{ ?> title="<?php echo $_smarty_tpl->tpl_vars['M_E_FIELD_TITLE']->value;?>
" <?php }?>><img src="<?php echo vimage_path('MassEdit.png');?>
" data-name="masseditable"data-enable-value="1" data-disable-value="2" title="<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isMassEditOptionDisabled()){?>readonly="readonly"<?php }?> height=14 width=14/>&nbsp;<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $_smarty_tpl->tpl_vars['IS_HEADER_FIELD'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderField(), null, 0);?><span class="header switch <?php if ((!$_smarty_tpl->tpl_vars['IS_HEADER_FIELD']->value)){?> disabled <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderFieldOptionDisabled()){?> cursorPointerNotAllowed <?php }else{ ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_HEADER_FIELD']->value){?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_H_FIELD_TITLE']->value;?>
" <?php }else{ ?> title="<?php echo $_smarty_tpl->tpl_vars['H_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-flag-o" data-name="headerfield"data-enable-value="1" data-disable-value="0"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isHeaderFieldOptionDisabled()){?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><?php $_smarty_tpl->tpl_vars['IS_SUMMARY_VIEW_ENABLED'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryField(), null, 0);?><span class="summary switch <?php if ((!$_smarty_tpl->tpl_vars['IS_SUMMARY_VIEW_ENABLED']->value)){?> disabled <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryFieldOptionDisabled()){?> cursorPointerNotAllowed <?php }else{ ?> cursorPointer <?php }?>"data-toggle="tooltip" <?php if ($_smarty_tpl->tpl_vars['IS_SUMMARY_VIEW_ENABLED']->value){?> title="<?php echo $_smarty_tpl->tpl_vars['NOT_S_FIELD_TITLE']->value;?>
" <?php }else{ ?> title="<?php echo $_smarty_tpl->tpl_vars['S_FIELD_TITLE']->value;?>
" <?php }?>><i class="fa fa-key" data-name="summaryfield"data-enable-value="1" data-disable-value="0"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isSummaryFieldOptionDisabled()){?>readonly="readonly"<?php }?>title="<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><div class="defaultValue col-sm-12 <?php if (!$_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()){?>disabled<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()){?> cursorPointerNotAllowed <?php }?>"><?php $_smarty_tpl->tpl_vars['DEFAULT_VALUE'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDefaultFieldValueToViewInV7FieldsLayOut(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value){?><?php if (is_array($_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value)){?><?php  $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->_loop = false;
 $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->key => $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value){
$_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->_loop = true;
 $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value = $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->key;
?><div class="row defaultValueContent"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()){?> readonly="readonly" <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()){?> title="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" <?php }?>data-name="defaultValueField" height=14 width=14 /></span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value){?><?php $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME'] = new Smarty_variable(mb_strtoupper($_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value, 'UTF-8'), null, 0);?><span><?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php echo vtranslate("LBL_".($_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value),$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : </span><span data-defaultvalue-fieldname="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_NAME']->value;?>
" data-defaultvalue="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['DEFAULT_FIELD_VALUE']->value;?>
</span><?php }else{ ?><?php echo vtranslate('LBL_DEFAULT_VALUE_NOT_SET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?></div><?php } ?><?php }else{ ?><div class="row defaultValueContent"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
" height=14 width=14<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()){?> readonly="readonly" <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()){?> title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
" <?php }?>></span>&nbsp;<span><?php echo vtranslate('LBL_DEFAULT_VALUE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
 : </span><span data-defaultvalue="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value);?>
</span></div><?php }?><?php }else{ ?><div class="row defaultValueContent"><span><img src="<?php echo vimage_path('DefaultValue.png');?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isDefaultValueOptionDisabled()){?> readonly="readonly" <?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->hasDefaultValue()){?> title="<?php echo $_smarty_tpl->tpl_vars['DEFAULT_VALUE']->value;?>
" <?php }?>data-name="defaultValueField" height=14 width=14 /></span>&nbsp;<span><?php echo vtranslate('LBL_DEFAULT_VALUE_NOT_SET',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></div><?php }?></div></div><span class="col-sm-2 actions"><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isEditable()){?><a href="javascript:void(0)" class="editFieldDetails"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a><?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isCustomField()=='true'){?><a href="javascript:void(0)" class="deleteCustomField pull-right" data-field-id="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('id');?>
"data-one-one-relationship="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isOneToOneRelationField();?>
" data-relationship-field="<?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isRelationShipReponsibleField();?>
"<?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isOneToOneRelationField()){?><?php $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->get('label'), null, 0);?><?php $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_MODULE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->getModuleName(), null, 0);?><?php $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getOneToOneRelationField()->getName(), null, 0);?>data-relation-field-label="<?php echo $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_LABEL']->value;?>
"data-relation-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['ONE_ONE_RELATION_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['ONE_ONE_RELATION_MODULE_NAME']->value);?>
"data-current-field-label ="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
"data-current-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
"data-field-name="<?php echo $_smarty_tpl->tpl_vars['ONE_ONE_RELATION_FIELD_NAME']->value;?>
"<?php }?><?php if ($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->isRelationShipReponsibleField()){?><?php $_smarty_tpl->tpl_vars['RELATION_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getRelationShipForThisField(), null, 0);?>data-relation-field-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"data-relation-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName(),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"data-current-module-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getParentModuleName(),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getParentModuleName());?>
"data-current-tab-label="<?php echo vtranslate($_smarty_tpl->tpl_vars['RELATION_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['RELATION_MODEL']->value->getRelationModuleName());?>
"<?php }?> ><i class="fa fa-trash" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a><?php }?></span></div></div></div></li><?php }?><?php } ?><?php if (count($_smarty_tpl->tpl_vars['FIELDS_LIST']->value)%2!=0){?><?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isAddCustomFieldEnabled()){?><li class="row dummyRow"><span class="dragUiText col-sm-8"><?php echo vtranslate('LBL_ADD_NEW_FIELD_HERE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><span class="col-sm-4" style="margin-top: 7%;margin-left: -15%;"><button class="btn btn-default btn-sm addButton"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span></li><?php }?><?php }?></ul></div></div><?php } ?></div></div></div><input type="hidden" class="inActiveFieldsArray" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['IN_ACTIVE_FIELDS']->value);?>
' /><input type="hidden" id="headerFieldsCount" value="<?php echo $_smarty_tpl->tpl_vars['HEADER_FIELDS_COUNT']->value;?>
"><input type="hidden" id="nameFields" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['SELECTED_MODULE_MODEL']->value->getNameFields());?>
'><input type="hidden" id="headerFieldsMeta" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['HEADER_FIELDS_META']->value);?>
'><div id="" class="newCustomBlockCopy hide marginBottom10px border1px blockSortable" data-block-id="" data-sequence=""><div class="layoutBlockHeader"><div class="col-sm-3 blockLabel padding10 marginLeftZero" style="word-break: break-all;"><img class="alignMiddle" src="<?php echo vimage_path('drag.png');?>
" />&nbsp;&nbsp;</div><div class="col-sm-9 padding10 marginLeftZero"><div class="blockActions" style="float: right !important;"><span><i class="fa fa-info-circle" title="<?php echo vtranslate('LBL_COLLAPSE_BLOCK_DETAIL_VIEW',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp; <?php echo vtranslate('LBL_COLLAPSE_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<input style="opacity: 0;" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->isHidden()){?> checked value='0' <?php }else{ ?> value='1' <?php }?> class ='cursorPointer' id="hiddenCollapseBlock" name=""data-on-text="<?php echo vtranslate('LBL_YES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-off-text="<?php echo vtranslate('LBL_NO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" data-on-color="primary" data-block-id="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('id');?>
"/></span>&nbsp;<button class="btn btn-default addButton addCustomField" type="button"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_CUSTOM_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<button class="inActiveFields addButton btn btn-default btn-sm"><?php echo vtranslate('LBL_SHOW_HIDDEN_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button>&nbsp;&nbsp;<button class="deleteCustomBlock addButton btn btn-default btn-sm"><?php echo vtranslate('LBL_DELETE_CUSTOM_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div></div><div class="blockFieldsList row blockFieldsSortable"><ul class="connectedSortable col-sm-6 ui-sortable"name="sortable1"><li class="row dummyRow"><span class="dragUiText col-sm-8"><?php echo vtranslate('LBL_ADD_NEW_FIELD_HERE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><span class="col-sm-4" style="margin-top: 7%;margin-left: -15%;"><button class="btn btn-default btn-sm addButton"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span></li></ul><ul class="connectedSortable col-sm-6 ui-sortable" name="sortable2"></ul></div></div><li class="newCustomFieldCopy hide"><div class="row border1px"><div class="col-sm-4"><div class="marginLeftZero" data-field-id="" data-sequence=""><div class="row"><span class="col-sm-1">&nbsp;<?php if ($_smarty_tpl->tpl_vars['IS_SORTABLE']->value){?><img src="<?php echo vimage_path('drag.png');?>
" class="dragImage" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"/><?php }?></span><div class="col-sm-9" style="word-wrap: break-word;"><div class="fieldLabelContainer row"><span class="fieldLabel"><b></b>&nbsp;</span><div><span class="pull-right fieldTypeLabel" style="opacity:0.6;"></span></div></div></div></div></div></div><div class="col-sm-8 fieldPropertyContainer"><div class="row " style="padding:10px 0px"><div class="fieldProperties col-sm-10" data-field-id=""><span class="mandatory switch text-capitalize"><i class="fa fa-exclamation-circle" data-name="mandatory"data-enable-value="M" data-disable-value="O"title="<?php echo vtranslate('LBL_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_PROP_MANDATORY',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="quickCreate switch"><i class="fa fa-plus" data-name="quickcreate"data-enable-value="2" data-disable-value="1"title="<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_QUICK_CREATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><span class="massEdit switch" ><img src="<?php echo vimage_path('MassEdit.png');?>
" data-name="masseditable"data-enable-value="1" data-disable-value="2" title="<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" height=14 width=14/>&nbsp;<?php echo vtranslate('LBL_MASS_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="header switch"><i class="fa fa-flag-o" data-name="headerfield"data-enable-value="1" data-disable-value="0"title="<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_HEADER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><span class="summary switch"><i class="fa fa-key" data-name="summaryfield"data-enable-value="1" data-disable-value="0"title="<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i>&nbsp;<?php echo vtranslate('LBL_KEY_FIELD',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><br><br><div class="defaultValue col-sm-12"></div></div><span class="col-sm-2 actions"><a href="javascript:void(0)" class="editFieldDetails"><i class="fa fa-pencil" title="<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a><a href="javascript:void(0)" class="deleteCustomField pull-right"><i class="fa fa-trash" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"></i></a></span></div></div></div></li><div class="modal-dialog modal-content addBlockModal hide"><?php ob_start();?><?php echo vtranslate('LBL_ADD_CUSTOM_BLOCK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php $_tmp11=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable($_tmp11, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<form class="form-horizontal addCustomBlockForm"><div class="modal-body"><div class="form-group"><label class="control-label fieldLabel col-sm-5"><span><?php echo vtranslate('LBL_BLOCK_NAME',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span><span class="redColor">*</span></label><div class="controls col-sm-6"><input type="text" name="label" class="col-sm-3 inputElement" data-rule-required='true' style='width: 75%'/></div></div><div class="form-group"><label class="control-label fieldLabel col-sm-5"><?php echo vtranslate('LBL_ADD_AFTER',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label><div class="controls col-sm-6"><select class="col-sm-9" name="beforeBlockId"><?php  $_smarty_tpl->tpl_vars['BLOCK_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK_MODEL']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_BLOCK_LABELS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK_MODEL']->key => $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value){
$_smarty_tpl->tpl_vars['BLOCK_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_ID']->value = $_smarty_tpl->tpl_vars['BLOCK_MODEL']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['BLOCK_ID']->value;?>
" data-label="<?php echo $_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('label');?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['SELECTED_MODULE_NAME']->value);?>
</option><?php } ?></select></div></div></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('ModalFooter.tpl','Vtiger'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div><div class="hide defaultValueIcon"><img src="<?php echo vimage_path('DefaultValue.png');?>
" height=14 width=14></div><?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['CLEAN_FIELD_MODEL']->value->getFieldInfo(), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('FieldCreate.tpl','Settings:LayoutEditor'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('FIELD_MODEL'=>$_smarty_tpl->tpl_vars['CLEAN_FIELD_MODEL']->value,'IS_FIELD_EDIT_MODE'=>false), 0);?>
<div class="modal-dialog inactiveFieldsModal hide"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h3><?php echo vtranslate('LBL_INACTIVE_FIELDS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3></div><div class="modal-content"><form class="form-horizontal inactiveFieldsForm"><div class="modal-body"><div class="inActiveList row"><div class="col-sm-1"></div><div class="list col-sm-10"></div><div class="col-sm-1"></div></div></div><div class="modal-footer"><div class="pull-right cancelLinkContainer"><a class="cancelLink" type="reset" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div><button class="btn btn-success" type="submit" name="reactivateButton"><strong><?php echo vtranslate('LBL_REACTIVATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</strong></button></div></form></div></div><div class="ps-scrollbar-y" style="height: 60px;"></div><?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value!='[]'){?><script type="text/javascript">var uimeta = (function() {var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;var newFieldInfo = <?php echo $_smarty_tpl->tpl_vars['NEW_FIELDS_INFO']->value;?>
;return {field: {get: function(name, property) {if(name && property === undefined) {return fieldInfo[name];}if(name && property) {return fieldInfo[name][property]}},isMandatory : function(name){if(fieldInfo[name]) {return fieldInfo[name].mandatory;}return false;},getType : function(name){if(fieldInfo[name]) {return fieldInfo[name].type}return false;},getNewFieldInfo : function() {if(newFieldInfo['newfieldinfo']){return newFieldInfo['newfieldinfo']}return false;}},};})();</script><?php }?>
<?php }} ?>