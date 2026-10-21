<table width="80%" cellspacing="0" id="applet_grid" align="center" dir="rtl">
<tr>
    <td class="appletcolumn" id="applet_col_1">
        {foreach from=$applet_col_1 item=applet}
        <div class='appletwindow' id='portlet-{$applet.code}'>
            <div class='appletwindow_topbar'>
                <div class='appletwindow_title' width='80%'><!-- <img src='modules/{$module_name}/applets/{$applet.applet}/images/{$applet.icon}' align='absmiddle' />&nbsp;-->{$applet.name}</div>
                <div class='appletwindow_widgets' align='right' width='10%'>
                    <a class='appletrefresh'>
                        <i class="fa fa-refresh" style="color:#aaa"></i>
                    </a>
                </div>
            </div>
            <div class='appletwindow_content' id='{$applet.code}'>
                <div class='appletwindow_wait'><img src='/themes/tenant/images/issabel_logo_pattern.png' class="imageSpin"></div>
                <div class='appletwindow_fullcontent'></div>
            </div>
        </div>
        {/foreach}
    </td>
    <td class="appletcolumn" id="applet_col_2">
        {foreach from=$applet_col_2 item=applet}
        <div class='appletwindow' id='portlet-{$applet.code}'>
            <div class='appletwindow_topbar'>
                <div class='appletwindow_title' width='80%'><!-- <img src='modules/{$module_name}/applets/{$applet.applet}/images/{$applet.icon}' align='absmiddle' />&nbsp;-->{$applet.name}</div>
                <div class='appletwindow_widgets' align='right' width='10%'>
                    <a class='appletrefresh'>
                        <i class="fa fa-refresh" style="color:#aaa"></i>
                    </a>
                </div>
            </div>
            <div class='appletwindow_content' id='{$applet.code}'>
                <div class='appletwindow_wait'><img src='/themes/tenant/images/issabel_logo_pattern.png' class="imageSpin"></div>
                <div class='appletwindow_fullcontent'></div>
            </div>
        </div>
        {/foreach}
    </td>
</tr>
</table>
