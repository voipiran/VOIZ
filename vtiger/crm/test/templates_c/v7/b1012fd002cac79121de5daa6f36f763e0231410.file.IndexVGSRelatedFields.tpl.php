<?php /* Smarty version Smarty-3.1.7, created on 2018-04-16 12:00:05
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/VGSRelatedFields/IndexVGSRelatedFields.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19312046975ad450fd980ff3-04058018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1012fd002cac79121de5daa6f36f763e0231410' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/VGSRelatedFields/IndexVGSRelatedFields.tpl',
      1 => 1523863795,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19312046975ad450fd980ff3-04058018',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'ENTITY_MODULES' => 0,
    'MODULE1' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ad450fda41b2',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ad450fda41b2')) {function content_5ad450fda41b2($_smarty_tpl) {?>

<div class="class="col-sm-12 col-xs-12">
<div style="width: 65%;margin: auto;margin-top: 2em;padding: 2em;">
    <h3 style="padding-bottom: 1em;text-align: center"><?php echo vtranslate('vgs_fieldrelatedmodule',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3>
   
    <div>
        <h4 style="margin-top: 2em;margin-bottom: 0.5em;"><?php echo vtranslate('add_new_related_field',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4>
        <p><?php echo vtranslate('add_new_related_field_explain',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</p>
        <table class="table table-bordered table-condensed themeTableColor" style="margin-top: 1em;">
            <thead>
                <tr class="blockHeader">
                    <th colspan="4" class="mediumWidthType"><span class="alignMiddle"><?php echo vtranslate('add_new_related_field',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="50%" colspan="2"><label class="muted pull-right marginRight10px"><?php echo vtranslate('module1',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td>
                    <td colspan="2" style="border-left: none;">
                        <select style="width:100%;" name="module1" id="module1">
                            <option value="-">--</option>
                            <?php  $_smarty_tpl->tpl_vars['MODULE1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE1']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ENTITY_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE1']->key => $_smarty_tpl->tpl_vars['MODULE1']->value){
$_smarty_tpl->tpl_vars['MODULE1']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['MODULE1']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE1']->value);?>
</option>
                            <?php } ?>
                        </select>    
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2"><label class="muted pull-right marginRight10px"><?php echo vtranslate('block',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td>
                    <td colspan="2" style="border-left: none;">
                        <select style="width:100%;" name="block" id="block">
                            <option value="-">--</option>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2"><label class="muted pull-right marginRight10px"> <?php echo vtranslate('fields_label',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td>
                    <td colspan="2" style="border-left: none;">
                        <input type="text" id="field_label">
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2"><label class="muted pull-right marginRight10px"><?php echo vtranslate('module2',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td>
                    <td colspan="2" style="border-left: none;">
                        <select style="width:100%;" name="module2" id="module2">
                            <option value="-">--</option>
                            <?php  $_smarty_tpl->tpl_vars['MODULE1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE1']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ENTITY_MODULES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE1']->key => $_smarty_tpl->tpl_vars['MODULE1']->value){
$_smarty_tpl->tpl_vars['MODULE1']->_loop = true;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['MODULE1']->value;?>
"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE1']->value);?>
</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td width="25%"><label class="muted pull-right marginRight10px"><?php echo vtranslate('add_related_list',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td>
                    <td style="border-left: none;">
                        <select style="width:100%;" name="add_related_list" id="add_related">
                            <option value="-">--</option>
                            <option value="yes"><?php echo vtranslate('yes',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
                            <option value="no"><?php echo vtranslate('no',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option>
                        </select>
                    </td>
                    <td width="25%"><label class="muted pull-right marginRight10px"><?php echo vtranslate('related_list_label',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td>
                    <td style="border-left: none;">
                       <input type="text" id="related_list_label">
                    </td>
                </tr>

            </tbody>
        </table>
        <button class="btn pull-right" style="margin-bottom: 0.5em;" id="add_related_field"><?php echo vtranslate('save',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>

    </div>
</div>
</div>
<?php }} ?>