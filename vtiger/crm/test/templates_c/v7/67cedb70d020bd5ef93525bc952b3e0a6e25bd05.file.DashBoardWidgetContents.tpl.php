<?php /* Smarty version Smarty-3.1.7, created on 2019-01-12 13:53:43
         compiled from "/var/www/html/includes/runtime/../../layouts/v7/modules/Reports/dashboards/DashBoardWidgetContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19355128655c39c02f6a6492-83731471%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67cedb70d020bd5ef93525bc952b3e0a6e25bd05' => 
    array (
      0 => '/var/www/html/includes/runtime/../../layouts/v7/modules/Reports/dashboards/DashBoardWidgetContents.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19355128655c39c02f6a6492-83731471',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'DATA' => 0,
    'YAXIS_FIELD_TYPE' => 0,
    'CHART_DATA' => 0,
    'CHART_VALUES' => 0,
    'CHART_TYPE' => 0,
    'CLICK_THROUGH' => 0,
    'CLASS_NAME' => 0,
    'RECORD_ID' => 0,
    'WIDGET_ID' => 0,
    'MODULE' => 0,
    'PRIMARY_MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c39c02f707a0',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c39c02f707a0')) {function content_5c39c02f707a0($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['CHART_DATA'] = new Smarty_variable(ZEND_JSON::decode($_smarty_tpl->tpl_vars['DATA']->value), null, 0);?>
<input class="yAxisFieldType" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['YAXIS_FIELD_TYPE']->value;?>
" />
<?php $_smarty_tpl->tpl_vars['CHART_VALUES'] = new Smarty_variable($_smarty_tpl->tpl_vars['CHART_DATA']->value['values'], null, 0);?>
<?php if (!empty($_smarty_tpl->tpl_vars['CHART_VALUES']->value)){?>
    <input type='hidden' name='charttype' value="<?php echo $_smarty_tpl->tpl_vars['CHART_TYPE']->value;?>
" />
    <input type='hidden' class="widgetData" name='data' value='<?php echo $_smarty_tpl->tpl_vars['DATA']->value;?>
' /> 
    <input type='hidden' name='clickthrough' value="<?php echo $_smarty_tpl->tpl_vars['CLICK_THROUGH']->value;?>
" />
    <div style="margin:0px 10px;">
        <div>
            <div name='chartcontent' class="widgetChartContainer" style="height:245px;min-width:300px; margin: 0 auto">
            <br>
            </div>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['CHART_TYPE']->value=='pieChart'){?>
            <?php $_smarty_tpl->tpl_vars['CLASS_NAME'] = new Smarty_variable('Report_Piechart_Js', null, 0);?>
        <?php }elseif($_smarty_tpl->tpl_vars['CHART_TYPE']->value=='verticalbarChart'){?>
            <?php $_smarty_tpl->tpl_vars['CLASS_NAME'] = new Smarty_variable('Report_Verticalbarchart_Js', null, 0);?>
        <?php }elseif($_smarty_tpl->tpl_vars['CHART_TYPE']->value=='horizontalbarChart'){?>
            <?php $_smarty_tpl->tpl_vars['CLASS_NAME'] = new Smarty_variable('Report_Horizontalbarchart_Js', null, 0);?>
        <?php }else{ ?>
            <?php $_smarty_tpl->tpl_vars['CLASS_NAME'] = new Smarty_variable('Report_Linechart_Js', null, 0);?>
        <?php }?>
        <script type="text/javascript">
            <?php echo $_smarty_tpl->tpl_vars['CLASS_NAME']->value;?>
('Vtiger_ChartReportWidget_<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['WIDGET_ID']->value;?>
_Widget_Js',{},{ 
                init : function() {
                        this._super(jQuery("#<?php echo $_smarty_tpl->tpl_vars['RECORD_ID']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['WIDGET_ID']->value;?>
"));
                    }
            }); 
        </script>
        <div class="noClickThroughMsg">
            <?php if ($_smarty_tpl->tpl_vars['CLICK_THROUGH']->value!='true'){?>
                <div class='row' style="padding:1px">
                    <span class='col-lg-2 offset3'> &nbsp;</span>
                    <span class='span alert-info'>
                        <i class="icon-info-sign"></i>
                        <?php echo vtranslate('LBL_CLICK_THROUGH_NOT_AVAILABLE',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                    </span>
                </div>
                <br><br>
            <?php }?>
        </div>
    </div>
<?php }else{ ?>
	<span class="noDataMsg" style="position: relative; top: 115.5px; left: 119px;">
		<?php echo vtranslate('LBL_NO');?>
 <?php echo vtranslate($_smarty_tpl->tpl_vars['PRIMARY_MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_MATCHED_THIS_CRITERIA');?>

	</span>
<?php }?><?php }} ?>