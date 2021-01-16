<link rel="stylesheet" media="screen" type="text/css" href="modules/{$module_name}/applets/ProcessesStatus/tpl/css/styles.css" />
<script type='text/javascript' src='modules/{$module_name}/applets/ProcessesStatus/js/javascript.js'></script>
{* Plantilla posicionable *}
<div class="neo-applet-processes-menu">
<input type="hidden" id="neo_applet_selected_process" value="" />
<div id="neo-applet-processes-controles">
<input type="button" class="neo_applet_process" name="processcontrol_stop" id="neo_applet_process_stop" value="{$sMsgStop}" />
<input type="button" class="neo_applet_process" name="processcontrol_start" id="neo_applet_process_start" value="{$sMsgStart}" />
<input type="button" class="neo_applet_process" name="processcontrol_restart" id="neo_applet_process_restart" value="{$sMsgRestart}" />
<input type="button" class="neo_applet_process" name="processcontrol_activate" id="neo_applet_process_activate" value="{$sMsgActivate}" />
<input type="button" class="neo_applet_process" name="processcontrol_deactivate" id="neo_applet_process_deactivate" value="{$sMsgDeactivate}" />
</div>
<img id="neo-applet-processes-processing" src="modules/{$module_name}/applets/ProcessesStatus/images/loading.gif" style="display: none;" alt="" />
</div>
{foreach from=$services item=infoServicio key=sServicio}
<div class="neo-applet-processes-row">
    <div class="neo-applet-processes-row-icon"><img src="modules/{$module_name}/applets/ProcessesStatus/images/{$infoServicio.icon}" width="32" height="28" alt="{$sServicio}" /></div>
    <div class="neo-applet-processes-row-name">{$infoServicio.name_service}</div>
    <div class="neo-applet-processes-row-menu">
        <input type="hidden" name="key-servicio" id="key-servicio" value="{$sServicio}" />
        <input type="hidden" name="status-servicio" id="status-servicio" value="{$infoServicio.status_service}" />
        <input type="hidden" name="activate-process" id="activate-process" value="{$infoServicio.activate}" />
        <img src="modules/{$module_name}/applets/ProcessesStatus/images/{$infoServicio.status_service_icon}" style="cursor:{$infoServicio.pointer_style};" width="15" height="15" alt="menu" />
    </div>
    <div class="neo-applet-processes-row-status-msg" style="color: {$infoServicio.status_color}">{$infoServicio.status_desc}</div>
    <div class="neo-applet-processes-row-status-icon"></div>
</div>
{/foreach}
