<?php /* Smarty version Smarty-3.1.7, created on 2018-11-27 14:46:37
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Rss/RssWidgetContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8327436185bfd2795e4e3b5-18360939%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'caa90c489a863e4307bcf729f5ad0fd684a081f8' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Rss/RssWidgetContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8327436185bfd2795e4e3b5-18360939',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUICK_LINKS' => 0,
    'SIDEBARWIDGET' => 0,
    'MODULE' => 0,
    'RSS_MODULE_MODEL' => 0,
    'RSS_SOURCES' => 0,
    'recordsModel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfd2795e89fc',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfd2795e89fc')) {function content_5bfd2795e89fc($_smarty_tpl) {?>



<div class="sidebar-menu quickWidgetContainer">
    <?php $_smarty_tpl->tpl_vars['val'] = new Smarty_variable(1, null, 0);?>
    <?php  $_smarty_tpl->tpl_vars['SIDEBARWIDGET'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SIDEBARWIDGET']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['QUICK_LINKS']->value['SIDEBARWIDGET']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SIDEBARWIDGET']->key => $_smarty_tpl->tpl_vars['SIDEBARWIDGET']->value){
$_smarty_tpl->tpl_vars['SIDEBARWIDGET']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['SIDEBARWIDGET']->key;
?>
    <div class="module-filters">    
        <div class="sidebar-container lists-menu-container">
            <div class="sidebar-header clearfix">
                <h5 class="pull-left"><?php echo vtranslate($_smarty_tpl->tpl_vars['SIDEBARWIDGET']->value->getLabel(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5>
                <button class="btn btn-default pull-right sidebar-btn rssAddButton" title="<?php echo vtranslate('LBL_FEED_SOURCE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </button>
            </div>
            <hr>
            <div class="menu-scroller mCustomScrollBox" data-mcs-theme="dark">
                <div class="mCustomScrollBox mCS-light-2 mCSB_inside" tabindex="0">
                    <div class="mCSB_container" style="position:relative; top:0; left:0;">
                        <div class="list-menu-content">
                            <ul class="lists-menu widgetContainer" data-url="<?php echo $_smarty_tpl->tpl_vars['SIDEBARWIDGET']->value->getUrl();?>
">
                                <?php $_smarty_tpl->tpl_vars["RSS_MODULE_MODEL"] = new Smarty_variable(Vtiger_Module_Model::getInstance($_smarty_tpl->tpl_vars['MODULE']->value), null, 0);?>
                                <?php $_smarty_tpl->tpl_vars["RSS_SOURCES"] = new Smarty_variable($_smarty_tpl->tpl_vars['RSS_MODULE_MODEL']->value->getRssSources(), null, 0);?>
                                <?php  $_smarty_tpl->tpl_vars['recordsModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['recordsModel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RSS_SOURCES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['recordsModel']->key => $_smarty_tpl->tpl_vars['recordsModel']->value){
$_smarty_tpl->tpl_vars['recordsModel']->_loop = true;
?>
                                    <li>
                                        <a href="#" class="rssLink filter-name" data-id=<?php echo $_smarty_tpl->tpl_vars['recordsModel']->value->getId();?>
 data-url="<?php echo $_smarty_tpl->tpl_vars['recordsModel']->value->get('rssurl');?>
" title="<?php echo decode_html($_smarty_tpl->tpl_vars['recordsModel']->value->getName());?>
"><?php echo decode_html($_smarty_tpl->tpl_vars['recordsModel']->value->getName());?>
</a>
                                    </li>
                                    <?php }
if (!$_smarty_tpl->tpl_vars['recordsModel']->_loop) {
?>
                                        <li class="noRssFeeds" style="text-align:center"><?php echo vtranslate('LBL_NO_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                        </li>
                                    <?php } ?>

                             </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     <?php } ?>
</div>
</div>

<?php }} ?>