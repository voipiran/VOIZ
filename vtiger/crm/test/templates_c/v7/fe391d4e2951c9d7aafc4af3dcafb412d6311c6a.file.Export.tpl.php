<?php /* Smarty version Smarty-3.1.7, created on 2018-11-27 14:46:04
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/Export.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3988483855bfd27743f2d12-37688940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fe391d4e2951c9d7aafc4af3dcafb412d6311c6a' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/Export.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3988483855bfd27743f2d12-37688940',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SOURCE_MODULE' => 0,
    'VIEWID' => 0,
    'SELECTED_IDS' => 0,
    'EXCLUDED_IDS' => 0,
    'PAGE' => 0,
    'SEARCH_KEY' => 0,
    'OPERATOR' => 0,
    'ALPHABET_VALUE' => 0,
    'SEARCH_PARAMS' => 0,
    'ORDER_BY' => 0,
    'SORT_ORDER' => 0,
    'TAG_PARAMS' => 0,
    'FOLDER_ID' => 0,
    'FOLDER_VALUE' => 0,
    'MODULE' => 0,
    'TITLE' => 0,
    'MULTI_CURRENCY' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfd27744abf6',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfd27744abf6')) {function content_5bfd27744abf6($_smarty_tpl) {?>



<div class="fc-overlay-modal modal-content"><form id="exportForm" class="form-horizontal" method="post" action="index.php"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><input type="hidden" name="source_module" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" /><input type="hidden" name="action" value="ExportData" /><input type="hidden" name="viewname" value="<?php echo $_smarty_tpl->tpl_vars['VIEWID']->value;?>
" /><input type="hidden" name="selected_ids" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SELECTED_IDS']->value);?>
><input type="hidden" name="excluded_ids" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['EXCLUDED_IDS']->value);?>
><input type="hidden" id="page" name="page" value="<?php echo $_smarty_tpl->tpl_vars['PAGE']->value;?>
" /><input type="hidden" name="search_key" value= "<?php echo $_smarty_tpl->tpl_vars['SEARCH_KEY']->value;?>
" /><input type="hidden" name="operator" value="<?php echo $_smarty_tpl->tpl_vars['OPERATOR']->value;?>
" /><input type="hidden" name="search_value" value="<?php echo $_smarty_tpl->tpl_vars['ALPHABET_VALUE']->value;?>
" /><input type="hidden" name="search_params" value='<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['SEARCH_PARAMS']->value);?>
' /><input type="hidden" name="orderby" value="<?php echo $_smarty_tpl->tpl_vars['ORDER_BY']->value;?>
" /><input type="hidden" name="sortorder" value="<?php echo $_smarty_tpl->tpl_vars['SORT_ORDER']->value;?>
" /><input type="hidden" name="tag_params" value='<?php echo Zend_JSON::encode($_smarty_tpl->tpl_vars['TAG_PARAMS']->value);?>
' /><?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value=='Documents'){?><input type="hidden" name="folder_id" value="<?php echo $_smarty_tpl->tpl_vars['FOLDER_ID']->value;?>
"/><input type="hidden" name="folder_value" value="<?php echo $_smarty_tpl->tpl_vars['FOLDER_VALUE']->value;?>
"/><?php }?><div class="overlayHeader"><?php ob_start();?><?php echo vtranslate('LBL_EXPORT_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['TITLE'] = new Smarty_variable($_tmp1, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0);?>
</div><div class="modal-body" style="margin-bottom:250px"><div class="datacontent row"><div class="col-lg-3"></div><div class="col-lg-6"><div class="well exportContents"><?php if ($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value=='Calendar'){?><br><div><b><?php echo vtranslate('LBL_EXPORT_FORMAT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></div><br><div style="margin-left: 50px;"><div><input type="radio" name="type" value="csv" id="csv" onchange="Calendar_Edit_Js.handleFileTypeChange();" checked="checked" /><label style="font-weight:normal" for="csv">&nbsp;&nbsp;<?php echo vtranslate('csv',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><div><input type="radio" name="type" value="ics" id="ics" onchange="Calendar_Edit_Js.handleFileTypeChange();"/><label style="font-weight:normal" for="ics">&nbsp;&nbsp;<?php echo vtranslate('ics',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div></div><?php }?><br><div><b><?php echo vtranslate('LBL_EXPORT_DATA',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</b></div><br><div style="margin-left: 50px;"><div><input type="radio" name="mode" value="ExportSelectedRecords" id="group1" <?php if (!empty($_smarty_tpl->tpl_vars['SELECTED_IDS']->value)){?> checked="checked" <?php }else{ ?> disabled="disabled"<?php }?> style="margin:2px 0 -4px" /><label style="font-weight:normal" for="group1">&nbsp;&nbsp;<?php echo vtranslate('LBL_EXPORT_SELECTED_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><?php if (empty($_smarty_tpl->tpl_vars['SELECTED_IDS']->value)){?>&nbsp; <span style="color:red"><?php echo vtranslate('LBL_NO_RECORD_SELECTED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><?php }?><input type="hidden" class="isSelectedRecords" value="<?php if ($_smarty_tpl->tpl_vars['SELECTED_IDS']->value){?>1<?php }else{ ?>0<?php }?>" ></div><br><div><input type="radio" name="mode" value="ExportCurrentPage" id="group2" style="margin:2px 0 -4px" /><label style="font-weight:normal" for="group2">&nbsp;&nbsp;<?php echo vtranslate('LBL_EXPORT_DATA_IN_CURRENT_PAGE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><br><div><input type="radio" name="mode" value="ExportAllData" id="group3" <?php if (empty($_smarty_tpl->tpl_vars['SELECTED_IDS']->value)){?> checked="checked" <?php }?> style="margin:2px 0 -4px" /><label style="font-weight:normal" for="group3">&nbsp;&nbsp;<?php echo vtranslate('LBL_EXPORT_ALL_DATA',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><?php if ($_smarty_tpl->tpl_vars['MULTI_CURRENCY']->value){?><br><div class="row"><div class="col-lg-8 col-md-8 col-lg-pull-0"><strong><?php echo vtranslate('LBL_EXPORT_LINEITEM_CURRENCY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:&nbsp;</strong><i style="position:relative;top:4px;" class="icon-question-sign" data-toggle="tooltip" title="<?php echo vtranslate('LBL_EXPORT_CURRENCY_TOOLTIP_TEXT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></div></div><br><div class="row"><div class="col-lg-1 col-md-1 col-lg-pull-0"><input type="radio" name="selected_currency" value="UserCurrency" checked="checked"/></div><div> <?php echo vtranslate('LBL_EXPORT_USER_CURRENCY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</div></div><br><div class="row"><div class="col-lg-1 col-md-1 col-lg-pull-0"><input type="radio" name="selected_currency" value="RecordCurrency"/></div><div><?php echo vtranslate('LBL_EXPORT_RECORD_CURRENCY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;</div></div><?php }?></div><br></div></div><div class="col-lg-3"></div></div></div><div class="modal-overlay-footer clearfix"><div class="row clearfix"><div class=" textAlignCenter col-lg-12 col-md-12 col-sm-12 "><div><button type="submit" class="btn btn-success btn-lg"><?php echo vtranslate('LBL_EXPORT','Vtiger');?>
&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['SOURCE_MODULE']->value,$_smarty_tpl->tpl_vars['SOURCE_MODULE']->value);?>
</button>&nbsp;&nbsp;&nbsp;<a class="cancelLink" data-dismiss="modal" href="#"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></div></form></div><?php }} ?>