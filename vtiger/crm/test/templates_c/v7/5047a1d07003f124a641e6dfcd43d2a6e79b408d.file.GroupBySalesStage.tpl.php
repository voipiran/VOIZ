<?php /* Smarty version Smarty-3.1.7, created on 2018-12-10 07:15:23
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Potentials/dashboards/GroupBySalesStage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4337990845c0de153517506-13939908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5047a1d07003f124a641e6dfcd43d2a6e79b408d' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Potentials/dashboards/GroupBySalesStage.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4337990845c0de153517506-13939908',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'STYLES' => 0,
    'cssModel' => 0,
    'SCRIPTS' => 0,
    'jsModel' => 0,
    'WIDGET' => 0,
    'MODULE_NAME' => 0,
    'CURRENTUSER' => 0,
    'ALL_ACTIVEUSER_LIST' => 0,
    'OWNER_ID' => 0,
    'OWNER_NAME' => 0,
    'ALL_ACTIVEGROUP_LIST' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c0de1536891d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c0de1536891d')) {function content_5c0de1536891d($_smarty_tpl) {?>
<script type="text/javascript">
	Vtiger_Funnel_Widget_Js('Vtiger_GroupedBySalesStage_Widget_Js',{},{});
</script>
<?php  $_smarty_tpl->tpl_vars['cssModel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cssModel']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['STYLES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cssModel']->key => $_smarty_tpl->tpl_vars['cssModel']->value){
$_smarty_tpl->tpl_vars['cssModel']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['cssModel']->key;
?>
	<link rel="<?php echo $_smarty_tpl->tpl_vars['cssModel']->value->getRel();?>
" href="<?php echo $_smarty_tpl->tpl_vars['cssModel']->value->getHref();?>
" type="<?php echo $_smarty_tpl->tpl_vars['cssModel']->value->getType();?>
" media="<?php echo $_smarty_tpl->tpl_vars['cssModel']->value->getMedia();?>
" />
<?php } ?>
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

<div class="dashboardWidgetHeader">
    <div class="title clearfix">
        <div class="col-lg-4 dashboardTitle" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['WIDGET']->value->getTitle(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
"><b><?php echo vtranslate($_smarty_tpl->tpl_vars['WIDGET']->value->getTitle(),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</b></div>
        
        <div class="userList col-lg-5">
            <div>
                <select class="widgetFilter select2" id="owner" name="owner" style='width:30%;margin-bottom:0px'>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['CURRENTUSER']->value->getId();?>
" ><?php echo vtranslate('LBL_MINE');?>
</option>
                    <option value="all"><?php echo vtranslate('LBL_ALL');?>
</option>
                    <?php $_smarty_tpl->tpl_vars['ALL_ACTIVEUSER_LIST'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENTUSER']->value->getAccessibleUsers(), null, 0);?>
                    <?php if (count($_smarty_tpl->tpl_vars['ALL_ACTIVEUSER_LIST']->value)>1){?>
                        <optgroup label="<?php echo vtranslate('LBL_USERS');?>
">
                            <?php  $_smarty_tpl->tpl_vars['OWNER_NAME'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['OWNER_NAME']->_loop = false;
 $_smarty_tpl->tpl_vars['OWNER_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_ACTIVEUSER_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_NAME']->key => $_smarty_tpl->tpl_vars['OWNER_NAME']->value){
$_smarty_tpl->tpl_vars['OWNER_NAME']->_loop = true;
 $_smarty_tpl->tpl_vars['OWNER_ID']->value = $_smarty_tpl->tpl_vars['OWNER_NAME']->key;
?>
                                <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['CURRENTUSER']->value->getId();?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['OWNER_ID']->value!=$_tmp1){?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
</option>
                                <?php }?>
                            <?php } ?>
                        </optgroup>
                    <?php }?>
                    <?php $_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENTUSER']->value->getAccessibleGroups(), null, 0);?>
                    <?php if (!empty($_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST']->value)){?>
                        <optgroup label="<?php echo vtranslate('LBL_GROUPS');?>
">
                            <?php  $_smarty_tpl->tpl_vars['OWNER_NAME'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['OWNER_NAME']->_loop = false;
 $_smarty_tpl->tpl_vars['OWNER_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ALL_ACTIVEGROUP_LIST']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['OWNER_NAME']->key => $_smarty_tpl->tpl_vars['OWNER_NAME']->value){
$_smarty_tpl->tpl_vars['OWNER_NAME']->_loop = true;
 $_smarty_tpl->tpl_vars['OWNER_ID']->value = $_smarty_tpl->tpl_vars['OWNER_NAME']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['OWNER_ID']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['OWNER_NAME']->value;?>
</option>
                            <?php } ?>
                        </optgroup>
                    <?php }?>
                </select>
            </div>
    </div>

    </div>
</div>
<div class="dashboardWidgetContent">
	<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("dashboards/DashBoardWidgetContents.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<div class="widgeticons dashBoardWidgetFooter">
    <div class="filterContainer">
		<div class="row">
			<span class="col-lg-5">
				<span class="pull-right">
					<?php echo vtranslate('Expected Close Date',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 &nbsp; <?php echo vtranslate('LBL_BETWEEN',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>

				</span>
			</span>
			<span class="col-lg-7">
                <div class="input-daterange input-group dateRange widgetFilter" id="datepicker" name="expectedclosedate">
                    <input type="text" class="input-sm form-control" name="start" style="height:30px;"/>
                    <span class="input-group-addon">to</span>
                    <input type="text" class="input-sm form-control" name="end" style="height:30px;"/>
                </div>
			</span>
		</div>
	</div>
    <div class="footerIcons pull-right">
        <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("dashboards/DashboardFooterIcons.tpl",$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('SETTING_EXIST'=>true), 0);?>

    </div>
</div><?php }} ?>