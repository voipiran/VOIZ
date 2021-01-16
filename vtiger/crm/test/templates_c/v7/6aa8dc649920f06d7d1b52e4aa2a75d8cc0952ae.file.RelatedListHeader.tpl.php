<?php /* Smarty version Smarty-3.1.7, created on 2018-11-21 10:11:01
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/partials/RelatedListHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12684437615bf4fdfdf11f13-51784919%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6aa8dc649920f06d7d1b52e4aa2a75d8cc0952ae' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/partials/RelatedListHeader.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12684437615bf4fdfdf11f13-51784919',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RELATED_LIST_LINKS' => 0,
    'RELATED_LINK' => 0,
    'DROPDOWNS' => 0,
    'RELATED_MODULE_NAME' => 0,
    'DROPDOWN' => 0,
    'IS_SELECT_BUTTON' => 0,
    'IS_CREATE_PERMITTED' => 0,
    'RELATION_FIELD' => 0,
    'SELECTED_MENU_CATEGORY' => 0,
    'PAGING' => 0,
    'RELATED_RECORDS' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bf4fdfe059a6',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bf4fdfe059a6')) {function content_5bf4fdfe059a6($_smarty_tpl) {?>

<div class="relatedHeader"><div class="btn-toolbar row"><div class="col-lg-6 col-md-6 col-sm-6 btn-toolbar"><?php  $_smarty_tpl->tpl_vars['RELATED_LINK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_LINK']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RELATED_LIST_LINKS']->value['LISTVIEWBASIC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_LINK']->key => $_smarty_tpl->tpl_vars['RELATED_LINK']->value){
$_smarty_tpl->tpl_vars['RELATED_LINK']->_loop = true;
?><div class="btn-group"><?php $_smarty_tpl->tpl_vars['DROPDOWNS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkdropdowns'), null, 0);?><?php if (count($_smarty_tpl->tpl_vars['DROPDOWNS']->value)>0){?><a class="btn dropdown-toggle" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200" data-close-others="false" style="width:20px;height:18px;"><img title="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
" alt="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
" src="<?php echo vimage_path(($_smarty_tpl->tpl_vars['RELATED_LINK']->value->getIcon()));?>
"></a><ul class="dropdown-menu"><?php  $_smarty_tpl->tpl_vars['DROPDOWN'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DROPDOWN']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DROPDOWNS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DROPDOWN']->key => $_smarty_tpl->tpl_vars['DROPDOWN']->value){
$_smarty_tpl->tpl_vars['DROPDOWN']->_loop = true;
?><li><a id="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
_relatedlistView_add_<?php echo Vtiger_Util_Helper::replaceSpaceWithUnderScores($_smarty_tpl->tpl_vars['DROPDOWN']->value['label']);?>
" class="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linkclass');?>
" href='javascript:void(0)' data-documentType="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['type'];?>
" data-url="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['url'];?>
" data-name="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" data-firsttime="<?php echo $_smarty_tpl->tpl_vars['DROPDOWN']->value['firsttime'];?>
"><i class="icon-plus"></i>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['DROPDOWN']->value['label'],$_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value);?>
</a></li><?php } ?></ul><?php }else{ ?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_selectRelation');?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['IS_SELECT_BUTTON'] = new Smarty_variable($_tmp1, null, 0);?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('linklabel');?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['LINK_LABEL'] = new Smarty_variable($_tmp2, null, 0);?><?php if ($_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_linklabel')==='_add_event'){?><?php $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME'] = new Smarty_variable('Events', null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_linklabel')==='_add_task'){?><?php $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME'] = new Smarty_variable('Calendar', null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value||$_smarty_tpl->tpl_vars['IS_CREATE_PERMITTED']->value){?><button type="button" module="<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE_NAME']->value;?>
" class="btn btn-default<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value==true){?> selectRelation<?php }else{ ?> addButton" name="addButton<?php }?>"<?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value==true){?> data-moduleName="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->get('_module')->get('name');?>
" <?php }?><?php if (($_smarty_tpl->tpl_vars['RELATED_LINK']->value->isPageLoadLink())){?><?php if ($_smarty_tpl->tpl_vars['RELATION_FIELD']->value){?> data-name="<?php echo $_smarty_tpl->tpl_vars['RELATION_FIELD']->value->getName();?>
" <?php }?>data-url="<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getUrl();?>
<?php if ($_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value){?>&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
<?php }?>"<?php }?>><?php if ($_smarty_tpl->tpl_vars['IS_SELECT_BUTTON']->value==false){?><i class="fa fa-plus"></i>&nbsp;<?php }?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['RELATED_LINK']->value->getLabel();?>
</button><?php }?><?php }?></div><?php } ?>&nbsp;</div><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_ACTION'] = new Smarty_variable('relatedViewActions', null, 0);?><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_PAGING_INPUT'] = new Smarty_variable('relatedViewPagingInput', null, 0);?><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_PAGING_INPUT_SUBMIT'] = new Smarty_variable('relatedViewPagingInputSubmit', null, 0);?><?php $_smarty_tpl->tpl_vars['CLASS_VIEW_BASIC_ACTION'] = new Smarty_variable('relatedViewBasicAction', null, 0);?><?php $_smarty_tpl->tpl_vars['PAGING_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['PAGING']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['RECORD_COUNT'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['RELATED_RECORDS']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['PAGE_NUMBER'] = new Smarty_variable($_smarty_tpl->tpl_vars['PAGING']->value->get('page'), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Pagination.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('SHOWPAGEJUMP'=>true), 0);?>
</div></div><?php }} ?>