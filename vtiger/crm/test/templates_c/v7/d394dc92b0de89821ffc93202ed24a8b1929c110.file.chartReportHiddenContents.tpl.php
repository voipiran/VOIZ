<?php /* Smarty version Smarty-3.1.7, created on 2018-11-26 14:13:17
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/chartReportHiddenContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15304949695bfbce45ae5871-88766469%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd394dc92b0de89821ffc93202ed24a8b1929c110' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/chartReportHiddenContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15304949695bfbce45ae5871-88766469',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'PRIMARY_MODULE_FIELDS' => 0,
    'PRIMARY_MODULE' => 0,
    'PRIMARY_MODULE_NAME' => 0,
    'BLOCK_LABEL' => 0,
    'BLOCK' => 0,
    'FIELD_KEY' => 0,
    'FIELD_INFO' => 0,
    'FIELD_LABEL' => 0,
    'SECONDARY_MODULE_FIELDS' => 0,
    'SECONDARY_MODULE' => 0,
    'SECONDARY_MODULE_NAME' => 0,
    'CALCULATION_FIELDS' => 0,
    'CALCULATION_FIELDS_MODULE_LABEL' => 0,
    'CALCULATION_FIELDS_MODULE' => 0,
    'CALCULATION_FIELD_KEY' => 0,
    'CALCULATION_FIELD_TRANSLATED_LABEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfbce45c48b2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfbce45c48b2')) {function content_5bfbce45c48b2($_smarty_tpl) {?>
<select id="groupbyfield_element">
    <option value=""><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
    <?php  $_smarty_tpl->tpl_vars['PRIMARY_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PRIMARY_MODULE_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->key => $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value){
$_smarty_tpl->tpl_vars['PRIMARY_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value = $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->key;
?>
        <?php  $_smarty_tpl->tpl_vars['BLOCK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK']->key => $_smarty_tpl->tpl_vars['BLOCK']->value){
$_smarty_tpl->tpl_vars['BLOCK']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK']->key;
?>
            <optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
-<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
'>
                <?php  $_smarty_tpl->tpl_vars['FIELD_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_LABEL']->key => $_smarty_tpl->tpl_vars['FIELD_LABEL']->value){
$_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_KEY']->value = $_smarty_tpl->tpl_vars['FIELD_LABEL']->key;
?>
                    <?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable(explode(':',$_smarty_tpl->tpl_vars['FIELD_KEY']->value), null, 0);?>
                    <?php if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value[4]=='D'||$_smarty_tpl->tpl_vars['FIELD_INFO']->value[4]=='DT'){?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
:Y"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
 (<?php echo vtranslate('LBL_YEAR',$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
)</option>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
:MY"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
 (<?php echo vtranslate('LBL_MONTH',$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
)</option>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['FIELD_INFO']->value[4]!='I'&&$_smarty_tpl->tpl_vars['FIELD_INFO']->value[4]!='N'&&$_smarty_tpl->tpl_vars['FIELD_INFO']->value[4]!='NN'){?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['PRIMARY_MODULE_NAME']->value);?>
</option>
                    <?php }?>
                <?php } ?>
            </optgroup>
        <?php } ?>
    <?php } ?>
    <?php  $_smarty_tpl->tpl_vars['SECONDARY_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SECONDARY_MODULE_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->key => $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->value){
$_smarty_tpl->tpl_vars['SECONDARY_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value = $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->key;
?>
        <?php  $_smarty_tpl->tpl_vars['BLOCK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['BLOCK']->_loop = false;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SECONDARY_MODULE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['BLOCK']->key => $_smarty_tpl->tpl_vars['BLOCK']->value){
$_smarty_tpl->tpl_vars['BLOCK']->_loop = true;
 $_smarty_tpl->tpl_vars['BLOCK_LABEL']->value = $_smarty_tpl->tpl_vars['BLOCK']->key;
?>
            <optgroup label='<?php echo vtranslate($_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
-<?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
'>
                <?php  $_smarty_tpl->tpl_vars['FIELD_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['BLOCK']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_LABEL']->key => $_smarty_tpl->tpl_vars['FIELD_LABEL']->value){
$_smarty_tpl->tpl_vars['FIELD_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_KEY']->value = $_smarty_tpl->tpl_vars['FIELD_LABEL']->key;
?>
                    <?php $_smarty_tpl->tpl_vars['FIELD_INFO'] = new Smarty_variable(explode(':',$_smarty_tpl->tpl_vars['FIELD_KEY']->value), null, 0);?>
                    <?php if ($_smarty_tpl->tpl_vars['FIELD_INFO']->value[4]=='D'||$_smarty_tpl->tpl_vars['FIELD_INFO']->value[4]=='DT'){?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
:Y"><?php echo vtranslate($_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
 (<?php echo vtranslate('LBL_YEAR',$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
)</option>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
:MY"><?php echo vtranslate($_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
 (<?php echo vtranslate('LBL_MONTH',$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
)</option>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
</option>
                    <?php }elseif($_smarty_tpl->tpl_vars['FIELD_INFO']->value[4]!='I'&&$_smarty_tpl->tpl_vars['FIELD_INFO']->value[4]!='N'&&$_smarty_tpl->tpl_vars['FIELD_INFO']->value[4]!='NN'){?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['FIELD_KEY']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_LABEL']->value,$_smarty_tpl->tpl_vars['SECONDARY_MODULE_NAME']->value);?>
</option>
                    <?php }?>
                <?php } ?>
            </optgroup>
        <?php } ?>
    <?php } ?>
</select>

<select id="datafields_element">
    <option value='count(*)'><?php echo vtranslate('LBL_RECORD_COUNT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
    <?php  $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->_loop = false;
 $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CALCULATION_FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->key => $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->value){
$_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->_loop = true;
 $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL']->value = $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->key;
?>
        <optgroup label="<?php echo vtranslate($_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL']->value,$_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE_LABEL']->value);?>
">
            <?php  $_smarty_tpl->tpl_vars['CALCULATION_FIELD_TRANSLATED_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CALCULATION_FIELD_TRANSLATED_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEY'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CALCULATION_FIELDS_MODULE']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CALCULATION_FIELD_TRANSLATED_LABEL']->key => $_smarty_tpl->tpl_vars['CALCULATION_FIELD_TRANSLATED_LABEL']->value){
$_smarty_tpl->tpl_vars['CALCULATION_FIELD_TRANSLATED_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEY']->value = $_smarty_tpl->tpl_vars['CALCULATION_FIELD_TRANSLATED_LABEL']->key;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['CALCULATION_FIELD_KEY']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['CALCULATION_FIELD_TRANSLATED_LABEL']->value;?>
</option>
            <?php } ?>
        </optgroup>
    <?php } ?>
</select><?php }} ?>