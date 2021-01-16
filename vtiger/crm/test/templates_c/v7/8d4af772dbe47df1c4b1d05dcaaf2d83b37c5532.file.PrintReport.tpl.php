<?php /* Smarty version Smarty-3.1.7, created on 2018-11-26 14:06:08
         compiled from "/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/PrintReport.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6385908405bfbcc9892d8e5-53382938%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d4af772dbe47df1c4b1d05dcaaf2d83b37c5532' => 
    array (
      0 => '/var/www/webroot/ROOT/includes/runtime/../../layouts/v7/modules/Reports/PrintReport.tpl',
      1 => 1520602870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6385908405bfbcc9892d8e5-53382938',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'REPORT_NAME' => 0,
    'ROW' => 0,
    'PRINT_DATA' => 0,
    'TOTAL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5bfbcc989758f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5bfbcc989758f')) {function content_5bfbcc989758f($_smarty_tpl) {?>



<script type="text/javascript" src="libraries/jquery/jquery.min.js"></script>
<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo vtranslate('LBL_PRINT_REPORT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</title>
        <style type="text/css" media="print,screen">
            
                .printReport{
                    width:100%;
                    border:1px solid #000000;
                    border-collapse:collapse;
                }
                .printReport tbody td{
                    border:1px dotted #000000;
                    text-align:left;
                }
                .printReport thead th{
                    border-bottom:2px solid #000000;
                    border-left:1px solid #000000;
                    border-top:1px solid #000000;
                    border-right:1px solid #000000;
                }
                thead {
                    display:table-header-group;
                }
                tbody {
                    display:table-row-group;
                }
            
        </style>
    </head>
    <body marginheight="0" marginwidth="0" leftmargin="0" topmargin="0" style="text-align:center;" onLoad="JavaScript:window.print()">
        <table width="80%" border="0" cellpadding="5" cellspacing="0" align="center">
            <tr class="reportPrintHeader">
                <td align="left" valign="top" style="border:0px solid #000000;">
                    <h2><?php echo $_smarty_tpl->tpl_vars['REPORT_NAME']->value;?>
</h2>
                    <font  color="#666666"><div id="report_info"></div></font>
                </td>
                <td align="right" style="border:0px solid #000000;" valign="top">
                    <h3 style="color:#CCCCCC"><?php echo $_smarty_tpl->tpl_vars['ROW']->value;?>
 <?php echo vtranslate('LBL_RECORDS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h3>
                </td>
            </tr>
            <tr>
                <td style="border:0px solid #000000;" colspan="2">
                    <table width="100%" border="0" cellpadding="5" cellspacing="0" align="center" class="printReport reportPrintData" >
                        <?php echo $_smarty_tpl->tpl_vars['PRINT_DATA']->value;?>

                    </table>
                </td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td colspan="2">
                    <?php echo $_smarty_tpl->tpl_vars['TOTAL']->value;?>

                </td>
            </tr>
        </table>
    </body>
    <script>
        
            jQuery(document).ready(function () {
                var splitted = false;
                // chrome and safari doesn't support table-header-group option
                if (jQuery.browser.webkit) {
                    function splitTable(table, maxHeight) {
                        var header = table.children("thead");
                        if (!header.length)
                            return;

                        var headerHeight = header.outerHeight();
                        var header = header.detach();

                        var splitIndices = [0];
                        var rows = table.children("tbody").children();

                        maxHeight -= headerHeight;
                        var currHeight = 0;
                        var reportHeader = jQuery('.reportPrintHeader');
                        if (reportHeader.length > 0) {
                            currHeight = reportHeader.outerHeight();
                        }
                        rows.each(function (i, row) {
                            currHeight += $(rows[i]).outerHeight();
                            if (currHeight > maxHeight) {
                                splitIndices.push(i);
                                currHeight = $(rows[i]).outerHeight();
                            }
                        });
                        splitIndices.push(undefined);

                        table = table.replaceWith('<div id="_split_table_wrapper"></div>');
                        table.empty();

                        for (var i = 0; i < splitIndices.length - 1; i++) {
                            var newTable = table.clone();
                            header.clone().appendTo(newTable);
                            $('<tbody />').appendTo(newTable);
                            rows.slice(splitIndices[i], splitIndices[i + 1]).appendTo(newTable.children('tbody'));
                            newTable.appendTo("#_split_table_wrapper");
                            if (splitIndices[i + 1] !== undefined) {
                                $('<div style="page-break-after: always; margin:0; padding:0; border: none;"></div>').appendTo("#_split_table_wrapper");
                            }
                        }
                    }

                    if (window.matchMedia) {
                        var mediaQueryList = window.matchMedia('print');
                        mediaQueryList.addListener(function (mql) {
                            if (mql.matches && splitted == 0) {
                                var height = window.screen.availHeight;
                                $(function () {
                                    splitTable($(".reportPrintData"), height);
                                })
                                splitted = 1;
                            }
                        });
                    }
                }
            });
        
    </script>
</html>
<?php }} ?>