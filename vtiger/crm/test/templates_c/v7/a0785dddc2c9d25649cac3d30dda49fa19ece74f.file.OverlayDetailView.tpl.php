<?php /* Smarty version Smarty-3.1.7, created on 2018-11-27 16:42:37
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/OverlayDetailView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15629449235bfd42c5d72a83-27526575%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0785dddc2c9d25649cac3d30dda49fa19ece74f' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Vtiger/OverlayDetailView.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15629449235bfd42c5d72a83-27526575',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SCRIPTS' => 0,
    'jsModel' => 0,
    'RECORD' => 0,
    'FIELDS_INFO' => 0,
    'MODULE_NAME' => 0,
    'MODULE_MODEL' => 0,
    'SELECTED_MENU_CATEGORY' => 0,
    'DETAILVIEW_LINKS' => 0,
    'DETAIL_VIEW_BASIC_LINK' => 0,
    'RECORD_STRUCTURE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfd42c5e03b8',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfd42c5e03b8')) {function content_5bfd42c5e03b8($_smarty_tpl) {?>

<?php  $_smarty_tpl->tpl_vars['jsModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['jsModel']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['SCRIPTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['jsModel']->key => $_smarty_tpl->tpl_vars['jsModel']->value){
$_smarty_tpl->tpl_vars['jsModel']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['jsModel']->key;
?>
    <script type="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getType();?>
" src="<?php echo $_smarty_tpl->tpl_vars['jsModel']->value->getSrc();?>
"></script>
<?php } ?>

<input type="hidden" id="recordId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getId();?>
"/>
<?php if ($_smarty_tpl->tpl_vars['FIELDS_INFO']->value!=null){?>
    <script type="text/javascript">
        var related_uimeta = (function() {
            var fieldInfo = <?php echo $_smarty_tpl->tpl_vars['FIELDS_INFO']->value;?>
;
            return {
                field: {
                    get: function(name, property) {
                        if (name && property === undefined) {
                            return fieldInfo[name];
                        }
                        if (name && property) {
                            return fieldInfo[name][property]
                        }
                    },
                    isMandatory: function(name) {
                        if (fieldInfo[name]) {
                            return fieldInfo[name].mandatory;
                        }
                        return false;
                    },
                    getType: function(name) {
                        if (fieldInfo[name]) {
                            return fieldInfo[name].type
                        }
                        return false;
                    }
                },
            };
        })();
    </script>
<?php }?>

<div class='fc-overlay-modal overlayDetail'>
    <div class = "modal-content">
        <div class="overlayDetailHeader col-lg-12 col-md-12 col-sm-12" style="z-index:1;">
            <div class="col-lg-10 col-md-10 col-sm-10" style = "padding-left:0px;">
                <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("DetailViewHeaderTitle.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('MODULE_MODEL'=>$_smarty_tpl->tpl_vars['MODULE_MODEL']->value,'RECORD'=>$_smarty_tpl->tpl_vars['RECORD']->value), 0);?>

            </div>
            <div class = "col-lg-2 col-md-2 col-sm-2">
                <div class="clearfix">
                    <div class = "btn-group">
                        <button class="btn btn-default fullDetailsButton" onclick="window.location.href = '<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getFullDetailViewUrl();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
'"><?php echo vtranslate('LBL_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button>
						<?php  $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['DETAILVIEW_LINKS']->value['DETAILVIEWBASIC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->key => $_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value){
$_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->_loop = true;
?>
							<?php if ($_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value&&$_smarty_tpl->tpl_vars['DETAIL_VIEW_BASIC_LINK']->value->getLabel()=='LBL_EDIT'){?>
								<button class="btn btn-default editRelatedRecord" value = "<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getEditViewUrl();?>
"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</button>
							<?php }?>
						<?php } ?>
                    </div> 
                    <div class="pull-right " >
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                            <span aria-hidden="true" class='fa fa-close'></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal-body'>
            <div class = "detailViewContainer">      
                <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('DetailViewFullContents.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0);?>

            </div>
        </div>
    </div>
</div><?php }} ?>