<?php /* Smarty version Smarty-3.1.7, created on 2018-09-22 15:52:58
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Webforms/EditView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1474978255ba63422134424-98616417%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0b9c102a1b864dbac4b283ad344c19b3e69c663' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Settings/Webforms/EditView.tpl',
      1 => 1522233382,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1474978255ba63422134424-98616417',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'RECORD_ID' => 0,
    'SINGLE_MODULE_NAME' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'USER_MODEL' => 0,
    'IS_PARENT_EXISTS' => 0,
    'SPLITTED_MODULE' => 0,
    'IS_RELATION_OPERATION' => 0,
    'SOURCE_MODULE' => 0,
    'SOURCE_RECORD' => 0,
    'RETURN_VIEW' => 0,
    'RETURN_MODULE' => 0,
    'RETURN_RECORD' => 0,
    'RETURN_RELATED_TAB' => 0,
    'RETURN_RELATED_MODULE' => 0,
    'RETURN_PAGE' => 0,
    'RETURN_VIEW_NAME' => 0,
    'RETURN_SEARCH_PARAMS' => 0,
    'RETURN_SEARCH_KEY' => 0,
    'RETURN_SEARCH_VALUE' => 0,
    'RETURN_SEARCH_OPERATOR' => 0,
    'RETURN_SORTBY' => 0,
    'RETURN_ORDERBY' => 0,
    'RETURN_MODE' => 0,
    'RETURN_RELATION_ID' => 0,
    'QUALIFIED_MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5ba634222e555',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ba634222e555')) {function content_5ba634222e555($_smarty_tpl) {?>
      <div class="editViewPageDiv">
          <div class="col-lg-12 col-md-12 col-lg-pull-0">
         <form class="form-horizontal" id="EditView" name="edit" method="post" action="index.php" enctype="multipart/form-data">
            <div class="editViewHeader">
                     <?php $_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME'] = new Smarty_variable(('SINGLE_').($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?>
                     <?php if ($_smarty_tpl->tpl_vars['RECORD_ID']->value!=''){?>
                        <h3 class="editHeader" style="margin-top:5px;" title="<?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getRecordName();?>
"><?php echo vtranslate('LBL_EDITING',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 - <?php echo $_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getRecordName();?>
</h3>
                     <?php }else{ ?>
                        <h3 class="editHeader" style="margin-top:5px;"><?php echo vtranslate('LBL_CREATING_NEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['SINGLE_MODULE_NAME']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3>
                     <?php }?>
               </div>
            <div class="editViewBody">
               <div class="editViewContents">
                  <?php $_smarty_tpl->tpl_vars['WIDTHTYPE'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('rowheight'), null, 0);?>
                  <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['QUALIFIED_MODULE_NAME'] = new Smarty_variable($_tmp1, null, 0);?>
                  <?php $_smarty_tpl->tpl_vars['IS_PARENT_EXISTS'] = new Smarty_variable(strpos($_smarty_tpl->tpl_vars['MODULE']->value,":"), null, 0);?>
                  <?php if ($_smarty_tpl->tpl_vars['IS_PARENT_EXISTS']->value){?>
                     <?php $_smarty_tpl->tpl_vars['SPLITTED_MODULE'] = new Smarty_variable(explode(":",$_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?>
                     <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['SPLITTED_MODULE']->value[1];?>
" />
                     <input type="hidden" name="parent" value="<?php echo $_smarty_tpl->tpl_vars['SPLITTED_MODULE']->value[0];?>
" />
                  <?php }else{ ?>
                     <input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" />
                  <?php }?>
                  <input type="hidden" name="action" value="Save" />
                  <input type="hidden" name="record" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
" />
                  <input type="hidden" name="defaultCallDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('callduration');?>
" />
                  <input type="hidden" name="defaultOtherEventDuration" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('othereventduration');?>
" />
                  <?php if ($_smarty_tpl->tpl_vars['IS_RELATION_OPERATION']->value){?>
                     <input type="hidden" name="sourceModule" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
" />
                     <input type="hidden" name="sourceRecord" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_RECORD']->value;?>
" />
                     <input type="hidden" name="relationOperation" value="<?php echo $_smarty_tpl->tpl_vars['IS_RELATION_OPERATION']->value;?>
" />
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['RETURN_VIEW']->value){?>
                     <input type="hidden" name="returnmodule" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_MODULE']->value;?>
" />
                     <input type="hidden" name="returnview" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_VIEW']->value;?>
" />
                     <input type="hidden" name="returnrecord" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_RECORD']->value;?>
" />
                     <input type="hidden" name="returntab_label" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_RELATED_TAB']->value;?>
" />
                     <input type="hidden" name="returnrelatedModule" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_RELATED_MODULE']->value;?>
" />
                     <input type="hidden" name="returnpage" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_PAGE']->value;?>
" />
                     <input type="hidden" name="returnviewname" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_VIEW_NAME']->value;?>
" />
                     <input type="hidden" name="returnsearch_params" value='<?php echo Vtiger_Functions::jsonEncode($_smarty_tpl->tpl_vars['RETURN_SEARCH_PARAMS']->value);?>
' />
                     <input type="hidden" name="returnsearch_key" value=<?php echo $_smarty_tpl->tpl_vars['RETURN_SEARCH_KEY']->value;?>
 />
                     <input type="hidden" name="returnsearch_value" value=<?php echo $_smarty_tpl->tpl_vars['RETURN_SEARCH_VALUE']->value;?>
 />
                     <input type="hidden" name="returnoperator" value=<?php echo $_smarty_tpl->tpl_vars['RETURN_SEARCH_OPERATOR']->value;?>
 />
                     <input type="hidden" name="returnsortorder" value=<?php echo $_smarty_tpl->tpl_vars['RETURN_SORTBY']->value;?>
 />
                     <input type="hidden" name="returnorderby" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_ORDERBY']->value;?>
" />
                     <input type="hidden" name="returnmode" value=<?php echo $_smarty_tpl->tpl_vars['RETURN_MODE']->value;?>
 />
                     <input type="hidden" name="returnrelationId" value="<?php echo $_smarty_tpl->tpl_vars['RETURN_RELATION_ID']->value;?>
" />
                  <?php }?>
                  <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("partials/EditViewContents.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                  <div class="targetFieldsTableContainer">
                     <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("FieldsEditView.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                  </div>
               </div>
            </div>
            <div class='modal-overlay-footer clearfix'>
                <div class="row clearfix">
                    <div class='textAlignCenter col-lg-12 col-md-12 col-sm-12 '>
                        <button type='submit' class='btn btn-success saveButton' ><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button>&nbsp;&nbsp;
                        <a class='cancelLink' href="javascript:history.back()" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a>
                    </div>
                </div>
            </div>
         </form>
          </div>
      </div>
</div>
<?php }} ?>