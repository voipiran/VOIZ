<?php /* Smarty version Smarty-3.1.7, created on 2019-02-06 12:55:07
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Leads/LeadMappingEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2545837135c5aa7f3825cd5-90785567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '883a16aff5f54d57aaeaa65bf77858ffaac737f7' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Settings/Leads/LeadMappingEdit.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2545837135c5aa7f3825cd5-90785567',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RESTRICTED_FIELD_IDS_LIST' => 0,
    'QUALIFIED_MODULE' => 0,
    'MODULE_MODEL' => 0,
    'LABEL' => 0,
    'MAPPING_ARRAY' => 0,
    'LINK_MODEL' => 0,
    'MODULE' => 0,
    'MAPPING_ID' => 0,
    'LEADS_MODULE_MODEL' => 0,
    'FIELDS_INFO' => 0,
    'FIELD_TYPE' => 0,
    'FIELD_ID' => 0,
    'FIELD_OBJECT' => 0,
    'ACCOUNTS_MODULE_MODEL' => 0,
    'CONTACTS_MODULE_MODEL' => 0,
    'POTENTIALS_MODULE_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c5aa7f3ad44a',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c5aa7f3ad44a')) {function content_5c5aa7f3ad44a($_smarty_tpl) {?>

<div class="leadsFieldMappingEditPageDiv"><div class="col-sm-12 col-xs-12"><div class="editViewContainer "><form id="leadsMapping" method="POST"><div class="editViewBody "><div class="editViewContents table-container" ><input type="hidden" id="restrictedFieldsList" value=<?php echo ZEND_JSON::encode($_smarty_tpl->tpl_vars['RESTRICTED_FIELD_IDS_LIST']->value);?>
 /><table class="table listview-table-norecords" width="100%" id="convertLeadMapping"><tbody><tr><th width="7%"></th><th width="15%"><?php echo vtranslate('LBL_FIELD_LABEL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th width="15%"><?php echo vtranslate('LBL_FIELD_TYPE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><th colspan="3" width="70%"><?php echo vtranslate('LBL_MAPPING_WITH_OTHER_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th></tr><tr><th width="7%"><?php echo vtranslate('LBL_ACTIONS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</th><?php  $_smarty_tpl->tpl_vars['LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getHeaders(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LABEL']->key => $_smarty_tpl->tpl_vars['LABEL']->value){
$_smarty_tpl->tpl_vars['LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['LABEL']->key;
?><th width="15%"><?php echo vtranslate($_smarty_tpl->tpl_vars['LABEL']->value,$_smarty_tpl->tpl_vars['LABEL']->value);?>
</th><?php } ?></tr><?php  $_smarty_tpl->tpl_vars['MAPPING_ARRAY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MAPPING_ARRAY']->_loop = false;
 $_smarty_tpl->tpl_vars['MAPPING_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMapping(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["mappingLoop"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['MAPPING_ARRAY']->key => $_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value){
$_smarty_tpl->tpl_vars['MAPPING_ARRAY']->_loop = true;
 $_smarty_tpl->tpl_vars['MAPPING_ID']->value = $_smarty_tpl->tpl_vars['MAPPING_ARRAY']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["mappingLoop"]['iteration']++;
?><tr class="listViewEntries" sequence-number="<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['mappingLoop']['iteration'];?>
"><td width="7%"><?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['editable']==1){?><?php  $_smarty_tpl->tpl_vars['LINK_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LINK_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMappingLinks(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LINK_MODEL']->key => $_smarty_tpl->tpl_vars['LINK_MODEL']->value){
$_smarty_tpl->tpl_vars['LINK_MODEL']->_loop = true;
?><div class="table-actions"><span class="actionImages"><i title="<?php echo vtranslate($_smarty_tpl->tpl_vars['LINK_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-trash deleteMapping"></i></span></div><?php } ?><?php }?></td><td width="10%"><input type="hidden" name="mapping[<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['mappingLoop']['iteration'];?>
][mappingId]" value="<?php echo $_smarty_tpl->tpl_vars['MAPPING_ID']->value;?>
"/><select class="leadsFields select2 col-sm-12" name="mapping[<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['mappingLoop']['iteration'];?>
][lead]" <?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['editable']==0){?> disabled <?php }?>><?php  $_smarty_tpl->tpl_vars['FIELDS_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS_INFO']->key => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value){
$_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_TYPE']->value = $_smarty_tpl->tpl_vars['FIELDS_INFO']->key;
?><?php  $_smarty_tpl->tpl_vars['FIELD_OBJECT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_INFO']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value){
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_ID']->value = $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key;
?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_ID']->value==$_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Leads']['id']){?> selected <?php }?> label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getName());?>
</option><?php } ?><?php } ?></select></td><td width="10%" class="selectedFieldDataType"><?php echo vtranslate($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Leads']['fieldDataType'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</td><td width="10%"><select class="accountsFields select2 col-sm-12" name="mapping[<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['mappingLoop']['iteration'];?>
][account]" <?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['editable']==0){?> disabled <?php }?>><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['FIELDS_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS_INFO']->key => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value){
$_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_TYPE']->value = $_smarty_tpl->tpl_vars['FIELDS_INFO']->key;
?><?php  $_smarty_tpl->tpl_vars['FIELD_OBJECT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_INFO']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value){
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_ID']->value = $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key;
?><?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Leads']['fieldDataType']==$_smarty_tpl->tpl_vars['FIELD_TYPE']->value){?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_ID']->value==$_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Accounts']['id']){?> selected <?php }?> label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getName());?>
</option><?php }?><?php } ?><?php } ?></select></td><td width="10%"><select class="contactFields select2 col-sm-12" name="mapping[<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['mappingLoop']['iteration'];?>
][contact]" <?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['editable']==0){?> disabled <?php }?>><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['FIELDS_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS_INFO']->key => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value){
$_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_TYPE']->value = $_smarty_tpl->tpl_vars['FIELDS_INFO']->key;
?><?php  $_smarty_tpl->tpl_vars['FIELD_OBJECT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_INFO']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value){
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_ID']->value = $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key;
?><?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Leads']['fieldDataType']==$_smarty_tpl->tpl_vars['FIELD_TYPE']->value){?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_ID']->value==$_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Contacts']['id']){?> selected <?php }?> label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getName());?>
</option><?php }?><?php } ?><?php } ?></select></td><td width="10%"><select class="potentialFields select2 col-sm-12" name="mapping[<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['mappingLoop']['iteration'];?>
][potential]" <?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['editable']==0){?> disabled <?php }?>><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['FIELDS_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS_INFO']->key => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value){
$_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_TYPE']->value = $_smarty_tpl->tpl_vars['FIELDS_INFO']->key;
?><?php  $_smarty_tpl->tpl_vars['FIELD_OBJECT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_INFO']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value){
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_ID']->value = $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key;
?><?php if ($_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Leads']['fieldDataType']==$_smarty_tpl->tpl_vars['FIELD_TYPE']->value){?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['FIELD_ID']->value==$_smarty_tpl->tpl_vars['MAPPING_ARRAY']->value['Potentials']['id']){?> selected <?php }?> label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getName());?>
</option><?php }?><?php } ?><?php } ?></select></td></tr><?php } ?><tr class="hide newMapping listViewEntries"><td width="5%"><?php  $_smarty_tpl->tpl_vars['LINK_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LINK_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getMappingLinks(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LINK_MODEL']->key => $_smarty_tpl->tpl_vars['LINK_MODEL']->value){
$_smarty_tpl->tpl_vars['LINK_MODEL']->_loop = true;
?><div class="table-actions"><span class="actionImages"><i title="<?php echo vtranslate($_smarty_tpl->tpl_vars['LINK_MODEL']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
" class="fa fa-trash deleteMapping"></i></span></div><?php } ?></td><td width="10%"><select class="leadsFields newSelect col-sm-12"><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['FIELDS_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS_INFO']->key => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value){
$_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_TYPE']->value = $_smarty_tpl->tpl_vars['FIELDS_INFO']->key;
?><?php  $_smarty_tpl->tpl_vars['FIELD_OBJECT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_INFO']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value){
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_ID']->value = $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key;
?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['LEADS_MODULE_MODEL']->value->getName());?>
</option><?php } ?><?php } ?></select></td><td width="10%" class="selectedFieldDataType"></td><td width="10%"><select class="accountsFields newSelect col-sm-12"><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['FIELDS_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS_INFO']->key => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value){
$_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_TYPE']->value = $_smarty_tpl->tpl_vars['FIELDS_INFO']->key;
?><?php  $_smarty_tpl->tpl_vars['FIELD_OBJECT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_INFO']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value){
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_ID']->value = $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key;
?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['ACCOUNTS_MODULE_MODEL']->value->getName());?>
</option><?php } ?><?php } ?></select></td><td width="10%"><select class="contactFields newSelect col-sm-12"><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['FIELDS_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS_INFO']->key => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value){
$_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_TYPE']->value = $_smarty_tpl->tpl_vars['FIELDS_INFO']->key;
?><?php  $_smarty_tpl->tpl_vars['FIELD_OBJECT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_INFO']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value){
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_ID']->value = $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key;
?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['CONTACTS_MODULE_MODEL']->value->getName());?>
</option><?php } ?><?php } ?></select></td><td width="10%"><select class="potentialFields newSelect col-sm-12"><option data-type="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" label="<?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
" value="0"><?php echo vtranslate('LBL_NONE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['FIELDS_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_TYPE'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getFields(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELDS_INFO']->key => $_smarty_tpl->tpl_vars['FIELDS_INFO']->value){
$_smarty_tpl->tpl_vars['FIELDS_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_TYPE']->value = $_smarty_tpl->tpl_vars['FIELDS_INFO']->key;
?><?php  $_smarty_tpl->tpl_vars['FIELD_OBJECT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = false;
 $_smarty_tpl->tpl_vars['FIELD_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['FIELDS_INFO']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key => $_smarty_tpl->tpl_vars['FIELD_OBJECT']->value){
$_smarty_tpl->tpl_vars['FIELD_OBJECT']->_loop = true;
 $_smarty_tpl->tpl_vars['FIELD_ID']->value = $_smarty_tpl->tpl_vars['FIELD_OBJECT']->key;
?><option data-type="<?php echo $_smarty_tpl->tpl_vars['FIELD_TYPE']->value;?>
" label="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getName());?>
" value="<?php echo $_smarty_tpl->tpl_vars['FIELD_ID']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_OBJECT']->value->get('label'),$_smarty_tpl->tpl_vars['POTENTIALS_MODULE_MODEL']->value->getName());?>
</option><?php } ?><?php } ?></select></td></tr></tbody></table><div class="row"><span class="col-sm-4"><button id="addMapping" class="btn addButton module-buttons" type="button" style="margin-left: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo vtranslate('LBL_ADD_MAPPING',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span></div></div><div class='modal-overlay-footer clearfix'><div class="row clearfix"><div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '><button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;<a class="cancelLink" type="reset" href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDetailViewUrl();?>
"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div></div></div></div></form></div></div></div><?php }} ?>