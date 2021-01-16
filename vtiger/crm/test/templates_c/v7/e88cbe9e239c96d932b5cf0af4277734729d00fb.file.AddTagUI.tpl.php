<?php /* Smarty version Smarty-3.1.7, created on 2020-11-26 13:25:22
         compiled from "/var/www/html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/AddTagUI.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14397002435fbf7b8a8664f1-05274685%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e88cbe9e239c96d932b5cf0af4277734729d00fb' => 
    array (
      0 => '/var/www/html/crm/includes/runtime/../../layouts/v7/modules/Vtiger/AddTagUI.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14397002435fbf7b8a8664f1-05274685',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'RECORD_NAME' => 0,
    'TAGS_LIST' => 0,
    'ALL_USER_TAGS' => 0,
    'TAG_MODEL' => 0,
    'QUALIFIED_MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5fbf7b8a90d01',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fbf7b8a90d01')) {function content_5fbf7b8a90d01($_smarty_tpl) {?>
<div class="showAllTagContainer hide"><div class="modal-dialog modal-lg"><div class="modal-content"><form class="detailShowAllModal"><?php ob_start();?><?php echo vtranslate('LBL_ADD_OR_SELECT_TAG',$_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['RECORD_NAME']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["TITLE"] = new Smarty_variable($_tmp1, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<div class="modal-body"><div class="row"><div class="col-lg-6 selectTagContainer"><div class="form-group"><label class="control-label"><?php echo vtranslate('LBL_CURRENT_TAGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="currentTagScroll"><div class="currentTag multiLevelTagList form-control"><span class="noTagsPlaceHolder" style="padding:3px;display:none;border:1px solid transparent;color:#999"><?php echo vtranslate('LBL_NO_TAG_EXISTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><?php  $_smarty_tpl->tpl_vars['TAG_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['TAG_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['TAGS_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['TAG_MODEL']->key => $_smarty_tpl->tpl_vars['TAG_MODEL']->value){
$_smarty_tpl->tpl_vars['TAG_MODEL']->_loop = true;
?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php } ?></div></div></div><div class="form-group"><label class="control-label"><?php echo vtranslate('LBL_SELECT_FROM_AVAIL_TAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div class="dropdown"><input class="form-control currentTagSelector dropdown-toggle" data-toggle="dropdown" placeholder="<?php echo vtranslate('LBL_SELECT_EXISTING_TAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" /><div class="dropdown-menu currentTagMenu"><div class="scrollable" style="max-height:300px"><ul style="padding-left:0px;"><?php  $_smarty_tpl->tpl_vars['TAG_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['TAG_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALL_USER_TAGS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['TAG_MODEL']->key => $_smarty_tpl->tpl_vars['TAG_MODEL']->value){
$_smarty_tpl->tpl_vars['TAG_MODEL']->_loop = true;
?><?php if (array_key_exists($_smarty_tpl->tpl_vars['TAG_MODEL']->value->getId(),$_smarty_tpl->tpl_vars['TAGS_LIST']->value)){?><?php continue 1?><?php }?><li class="tag-item list-group-item"><a style="margin-left:0px;"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NO_DELETE'=>true,'NO_EDIT'=>true), 0);?>
</a></li><?php } ?><li class="dummyExistingTagElement tag-item list-group-item hide"><a style="margin-left:0px;"><?php $_smarty_tpl->tpl_vars['TAG_MODEL'] = new Smarty_variable(Vtiger_Tag_Model::getCleanInstance(), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Tag.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('NO_DELETE'=>true,'NO_EDIT'=>true), 0);?>
</a></li><li class="tag-item list-group-item"><span class="noTagExistsPlaceHolder" style="padding:3px;color:#999"><?php echo vtranslate('LBL_NO_TAG_EXISTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></li></ul></div></div></div></div></div><div class=" col-lg-6 selectTagContainerborder"><div class="form-group"><label class="control-label"><?php echo vtranslate('LBL_CREATE_NEW_TAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label><div><input name="createNewTag" value="" class="form-control" placeholder="<?php echo vtranslate('LBL_ENTER_TAG_NAME',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/></div></div><div class="form-group"><div><div class="checkbox"><label><input type="hidden" name="visibility" value="<?php echo Vtiger_Tag_Model::PRIVATE_TYPE;?>
"/><input type="checkbox" name="visibility" value="<?php echo Vtiger_Tag_Model::PUBLIC_TYPE;?>
" />&nbsp; <?php echo vtranslate('LBL_SHARE_TAGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></div><div class="pull-right"></div></div></div><div class="form-group"><div class=" vt-default-callout vt-info-callout tagInfoblock"><h5 class="vt-callout-header"><span class="fa fa-info-circle"></span>&nbsp; Info </h5><div><?php echo vtranslate('LBL_TAG_SEPARATOR_DESC',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div><br><div><?php echo vtranslate('LBL_SHARED_TAGS_ACCESS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><br><div><?php echo vtranslate('LBL_GOTO_TAGS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</div></div></div></div></div></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalFooter.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div></div></div><?php }} ?>