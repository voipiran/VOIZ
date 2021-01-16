<?php /* Smarty version Smarty-3.1.7, created on 2019-03-25 12:18:04
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/MergeRecords.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13633642975c9887b451b808-67482780%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e9c0ee6c52091c1b7b2c6e95b8f3ad58e72ca64' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Vtiger/MergeRecords.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13633642975c9887b451b808-67482780',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'TITLE' => 0,
    'RECORDS' => 0,
    'RECORDMODELS' => 0,
    'RECORD' => 0,
    'FIELDS' => 0,
    'FIELD' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c9887b45f185',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c9887b45f185')) {function content_5c9887b45f185($_smarty_tpl) {?>



<div class="fc-overlay-modal">
    <form class="form-horizontal" name="massMerge" method="post" action="index.php">
        <div class="overlayHeader">
            <?php ob_start();?><?php echo vtranslate('LBL_MERGE_RECORDS_IN',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo (($_tmp1).(' > ')).($_tmp2);?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['TITLE'] = new Smarty_variable($_tmp3, null, 0);?>
            <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['TITLE']->value), 0);?>

        </div>
        <div class="overlayBody">
            <div class="container-fluid modal-body">
                <div class="row">
                    <div class="col-lg-12">
                            <input type="hidden" name=module value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" />
                            <input type="hidden" name="action" value="ProcessDuplicates" />
                            <input type="hidden" name="records" value=<?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['RECORDS']->value);?>
 />
                            <div class="well well-sm" style="margin-bottom:8px">
                                <?php echo vtranslate('LBL_MERGE_RECORDS_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                            </div>
                            <div class="datacontent">
                                <table class="table table-bordered">
                                    <thead class='listViewHeaders'>
                                    <th>
                                        <?php echo vtranslate('LBL_FIELDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                    </th>
                                    <?php  $_smarty_tpl->tpl_vars['RECORD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RECORD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECORDMODELS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['recordList']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['RECORD']->key => $_smarty_tpl->tpl_vars['RECORD']->value){
$_smarty_tpl->tpl_vars['RECORD']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['recordList']['index']++;
?>
                                        <th>
                                            <div class="checkbox">
                                                <label>
                                                <input <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['recordList']['index']==0){?>checked<?php }?> type=radio value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
" name="primaryRecord"/>
                                                &nbsp; <?php echo vtranslate('LBL_RECORD');?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDetailViewUrl();?>
" target="_blank" style="color: #15c;">#<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
</a>
                                                </label>
                                            </div>
                                        </th>
                                    <?php } ?>
                                    </thead>
                                    <?php  $_smarty_tpl->tpl_vars['FIELD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FIELDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD']->key => $_smarty_tpl->tpl_vars['FIELD']->value){
$_smarty_tpl->tpl_vars['FIELD']->_loop = true;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['FIELD']->value->isEditable()){?>
                                        <tr>
                                            <td>
                                                <?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD']->value->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                            </td>
                                            <?php  $_smarty_tpl->tpl_vars['RECORD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RECORD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECORDMODELS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['recordList']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['RECORD']->key => $_smarty_tpl->tpl_vars['RECORD']->value){
$_smarty_tpl->tpl_vars['RECORD']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['recordList']['index']++;
?>
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['recordList']['index']==0){?>checked="checked"<?php }?> type=radio name="<?php echo $_smarty_tpl->tpl_vars['FIELD']->value->getName();?>
"
                                                            data-id="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get($_smarty_tpl->tpl_vars['FIELD']->value->getName());?>
"/>
                                                             &nbsp; <?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getDisplayValue($_smarty_tpl->tpl_vars['FIELD']->value->getName());?>

                                                        </label>
                                                   </div>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <?php }?>
                                    <?php } ?>
                                </table>
                             </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlayFooter">
            <?php $_smarty_tpl->tpl_vars['BUTTON_NAME'] = new Smarty_variable(vtranslate('LBL_MERGE',$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?>
            <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalFooter.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>
    </form>
</div>
<?php }} ?>