<?php /* Smarty version Smarty-3.1.7, created on 2018-12-10 07:18:59
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Import/ImportStepOne.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1709994235c0de22b944320-45034794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef62b82254dbd74e81309b2d2167bf74d12dabb7' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Import/ImportStepOne.tpl',
      1 => 1522233374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1709994235c0de22b944320-45034794',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'FORMAT' => 0,
    'MODULE' => 0,
    'IMPORT_UPLOAD_SIZE' => 0,
    'IMPORT_UPLOAD_SIZE_MB' => 0,
    'SUPPORTED_FILE_ENCODING' => 0,
    '_FILE_ENCODING' => 0,
    '_FILE_ENCODING_LABEL' => 0,
    'SUPPORTED_DELIMITERS' => 0,
    '_DELIMITER' => 0,
    '_DELIMITER_LABEL' => 0,
    'MULTI_CURRENCY' => 0,
    'CURRENCIES' => 0,
    'CURRENCY' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c0de22ba546c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c0de22ba546c')) {function content_5c0de22ba546c($_smarty_tpl) {?>

<div class ="importBlockContainer show" id = "uploadFileContainer">
    <table class = "table table-borderless" cellpadding = "30" >
        <span>
			<?php if ($_smarty_tpl->tpl_vars['FORMAT']->value=='vcf'){?>
				<h4>&nbsp;&nbsp;&nbsp;<?php echo vtranslate('LBL_IMPORT_FROM_VCF_FILE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4>
			<?php }elseif($_smarty_tpl->tpl_vars['FORMAT']->value=='ics'){?>
				<h4>&nbsp;&nbsp;&nbsp;<?php echo vtranslate('LBL_IMPORT_FROM_ICS_FILE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4>
			<?php }else{ ?>
				<h4>&nbsp;&nbsp;&nbsp;<?php echo vtranslate('LBL_IMPORT_FROM_CSV_FILE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4>
			<?php }?>
        </span>
        <hr>
        <tr id="file_type_container" style="height:50px">
			<?php if ($_smarty_tpl->tpl_vars['FORMAT']->value=='vcf'){?>
				<td><?php echo vtranslate('LBL_SELECT_VCF_FILE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
			<?php }elseif($_smarty_tpl->tpl_vars['FORMAT']->value=='ics'){?>
				<td><?php echo vtranslate('LBL_SELECT_ICS_FILE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
			<?php }else{ ?>
				<td><?php echo vtranslate('LBL_SELECT_CSV_FILE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
			<?php }?>
            <td data-import-upload-size="<?php echo $_smarty_tpl->tpl_vars['IMPORT_UPLOAD_SIZE']->value;?>
" data-import-upload-size-mb="<?php echo $_smarty_tpl->tpl_vars['IMPORT_UPLOAD_SIZE_MB']->value;?>
">
                <div>
                    <input type="hidden" id="type" name="type" value="csv" />
                    <input type="hidden" name="is_scheduled" value="1" />
                    <div class="fileUploadBtn btn btn-primary">
                        <span><i class="fa fa-laptop"></i> <?php echo vtranslate('Select from My Computer',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span>
                        <input type="file" name="import_file" id="import_file" onchange="Vtiger_Import_Js.checkFileType(event)" data-file-formats="<?php if ($_smarty_tpl->tpl_vars['FORMAT']->value==''){?>csv<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['FORMAT']->value;?>
<?php }?>" />
                    </div>
                    <div id="importFileDetails" class="padding10"></div>
                </div>
            </td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['FORMAT']->value=='csv'){?>
            <tr id="has_header_container" style="height:50px">
                <td><?php echo vtranslate('LBL_HAS_HEADER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
                <td>
                    <input type="checkbox" id="has_header" name="has_header" checked />
                </td>
            </tr>
        <?php }?>
		<?php if ($_smarty_tpl->tpl_vars['FORMAT']->value!='ics'){?>
			<tr id="file_encoding_container" style="height:50px">
				<td><?php echo vtranslate('LBL_CHARACTER_ENCODING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
				<td>
					<select name="file_encoding" id="file_encoding" class="select2">
						<?php  $_smarty_tpl->tpl_vars['_FILE_ENCODING_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_FILE_ENCODING_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['_FILE_ENCODING'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SUPPORTED_FILE_ENCODING']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['_FILE_ENCODING_LABEL']->key => $_smarty_tpl->tpl_vars['_FILE_ENCODING_LABEL']->value){
$_smarty_tpl->tpl_vars['_FILE_ENCODING_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['_FILE_ENCODING']->value = $_smarty_tpl->tpl_vars['_FILE_ENCODING_LABEL']->key;
?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['_FILE_ENCODING']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['_FILE_ENCODING_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
						<?php } ?>
					</select>
				</td>
			</tr>
		<?php }?>
        <?php if ($_smarty_tpl->tpl_vars['FORMAT']->value=='csv'){?>
            <tr id="delimiter_container" style="height:50px">
                <td><?php echo vtranslate('LBL_DELIMITER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
                <td>
                    <?php  $_smarty_tpl->tpl_vars['_DELIMITER_LABEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['_DELIMITER_LABEL']->_loop = false;
 $_smarty_tpl->tpl_vars['_DELIMITER'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SUPPORTED_DELIMITERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['delimiters']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['_DELIMITER_LABEL']->key => $_smarty_tpl->tpl_vars['_DELIMITER_LABEL']->value){
$_smarty_tpl->tpl_vars['_DELIMITER_LABEL']->_loop = true;
 $_smarty_tpl->tpl_vars['_DELIMITER']->value = $_smarty_tpl->tpl_vars['_DELIMITER_LABEL']->key;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['delimiters']['index']++;
?>
                        &nbsp;&nbsp;<label class="radio-group"><input type="radio" name="delimiter" value="<?php echo $_smarty_tpl->tpl_vars['_DELIMITER']->value;?>
" <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['delimiters']['index']==0){?> checked="true" <?php }?> style="margin-bottom: -2px;">&nbsp;&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['_DELIMITER_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>
                    <?php } ?>
                </td>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['MULTI_CURRENCY']->value){?>
                <tr id="lineitem_currency_container" style="height:50px">
                    <td><?php echo vtranslate('LBL_IMPORT_LINEITEMS_CURRENCY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
                    <td>
                        <select name="lineitem_currency" id="lineitem_currency" class = "select2">
                            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>
                            <?php  $_smarty_tpl->tpl_vars['CURRENCY'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['CURRENCY']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CURRENCIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['CURRENCY']->key => $_smarty_tpl->tpl_vars['CURRENCY']->value){
$_smarty_tpl->tpl_vars['CURRENCY']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['CURRENCY']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['CURRENCY']->value['currency_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['CURRENCY']->value['currencycode'];?>
</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            <?php }?>
        <?php }?>
    </table>
</div>
<?php }} ?>