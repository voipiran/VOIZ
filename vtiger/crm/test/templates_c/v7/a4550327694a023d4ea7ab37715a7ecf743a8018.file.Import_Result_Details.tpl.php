<?php /* Smarty version Smarty-3.1.7, created on 2019-01-22 11:01:36
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Import/Import_Result_Details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:989499415c46c6d80b0ba0-05725158%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4550327694a023d4ea7ab37715a7ecf743a8018' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Import/Import_Result_Details.tpl',
      1 => 1522233374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '989499415c46c6d80b0ba0-05725158',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'IMPORT_RESULT' => 0,
    'FOR_MODULE' => 0,
    'OWNER_ID' => 0,
    'INVENTORY_MODULES' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c46c6d812fd6',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c46c6d812fd6')) {function content_5c46c6d812fd6($_smarty_tpl) {?>

<table width="100%" class="table table-borderless">
	<tr>
		<td class = "greenColor"><?php echo vtranslate('LBL_TOTAL_RECORDS_IMPORTED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
		<td width="10%">:</td>
		<td class = "greenColor" width="30%"><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['IMPORTED'];?>
 / <?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['TOTAL'];?>
</td>
	</tr>
	<tr>
		<td class = "greenColor" width="20%"><?php echo vtranslate('LBL_NUMBER_OF_RECORDS_CREATED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
		<td width="1%">:</td>
		<td  class = "greenColor" width="60%"><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['CREATED'];?>

			<?php if ($_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['CREATED']!='0'){?>
				<?php if ($_smarty_tpl->tpl_vars['FOR_MODULE']->value!='Users'){?>
					&nbsp;&nbsp;&nbsp;&nbsp;<a class="cursorPointer" onclick="return Vtiger_Import_Js.showLastImportedRecords('index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&for_module=<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
&view=List&start=1&foruser=<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
&_showContents=0')"><?php echo vtranslate('LBL_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
				<?php }?>
			<?php }?>
		</td>

	</tr>
	<?php if (in_array($_smarty_tpl->tpl_vars['FOR_MODULE']->value,$_smarty_tpl->tpl_vars['INVENTORY_MODULES']->value)==false){?>
		<tr>
			<td><?php echo vtranslate('LBL_NUMBER_OF_RECORDS_UPDATED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
			<td width="10%">:</td>
			<td width="30%"><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['UPDATED'];?>
</td>
		</tr>
		<tr>
			<td><?php echo vtranslate('LBL_NUMBER_OF_RECORDS_SKIPPED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
			<td width="10%">:</td>
			<td width="30%"><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['SKIPPED'];?>

				<?php if ($_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['SKIPPED']!='0'){?>
					&nbsp;&nbsp;&nbsp;&nbsp;<a class="cursorPointer" onclick="return Vtiger_Import_Js.showSkippedRecords('index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=List&mode=getImportDetails&type=skipped&start=1&foruser=<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
&_showContents=0&for_module=<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
')"><?php echo vtranslate('LBL_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
				<?php }?>
			</td>
		</tr>
		<tr>
			<td><?php echo vtranslate('LBL_NUMBER_OF_RECORDS_MERGED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td>
			<td width="10%">:</td>
			<td width="10%"><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['MERGED'];?>
</td>
		</tr>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['FAILED']!='0'){?>
		<tr>
			<td><font color = "red"><?php echo vtranslate('LBL_TOTAL_RECORDS_FAILED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</font></td>
			<td width="10%">:</td>
			<td width="30%"><font color = "red"><?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['FAILED'];?>
 / <?php echo $_smarty_tpl->tpl_vars['IMPORT_RESULT']->value['TOTAL'];?>
</font>
				&nbsp;&nbsp;&nbsp;&nbsp;<a class="cursorPointer" onclick="return Vtiger_Import_Js.showFailedImportRecords('index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
&view=List&mode=getImportDetails&type=failed&start=1&foruser=<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
&_showContents=0&for_module=<?php echo $_smarty_tpl->tpl_vars['FOR_MODULE']->value;?>
')"><?php echo vtranslate('LBL_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
			</td>
		</tr>
	<?php }?>
</table><?php }} ?>