<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 10:53:43
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Import/ImportStepThree.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16616060205c46c4ff8c25c0-16910314%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89aa2bf0a0fdb5501bc3f63ad6aaa51a73a5cfef' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Import/ImportStepThree.tpl',
      1 => 1522233374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16616060205c46c4ff8c25c0-16910314',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'IMPORTABLE_FIELDS' => 0,
    'AVAILABLE_FIELDS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46c4ff8eb82',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46c4ff8eb82')) {function content_5c46c4ff8eb82($_smarty_tpl) {?>



<span>
    <h4><?php echo vtranslate('LBL_IMPORT_MAP_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4>
</span>
<hr>
<div id="savedMapsContainer"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Import_Saved_Maps.tpl",'Import'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div>
<div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Import_Mapping.tpl",'Import'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div>
<div class="form-inline" style="padding-bottom: 10%;">
    <input type="checkbox" name="save_map" id="save_map">&nbsp;&nbsp;<label for="save_map"><?php echo vtranslate('LBL_SAVE_AS_CUSTOM_MAPPING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>
    &nbsp;&nbsp;<input type="text" name="save_map_as" id="save_map_as" class = "form-control">
</div>
<?php if (!$_smarty_tpl->tpl_vars['IMPORTABLE_FIELDS']->value){?>
	<?php $_smarty_tpl->tpl_vars['IMPORTABLE_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['AVAILABLE_FIELDS']->value, null, 0);?>
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("Import_Default_Values_Widget.tpl",'Import'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('IMPORTABLE_FIELDS'=>$_smarty_tpl->tpl_vars['IMPORTABLE_FIELDS']->value), 0);?>
<?php }} ?>