<link rel="stylesheet" media="screen" type="text/css" href="modules/{$module_name}/applets/ProcessesStatus/tpl/css/styles.css" />
<script type='text/javascript' src='modules/{$module_name}/applets/ProcessesStatus/js/javascript.js'></script>

<style>
    /* فقط داخل اپلت RTL و فونت فارسی */
    .neo-applet-processes-menu,
    .neo-applet-processes-row,
    .neo-applet-processes-row * {
        direction: rtl !important;
        text-align: right !important;
        font-family: 'IRANSans', 'Noto Sans', sans-serif !important;
        font-size: 14px !important;
    }

    /* باکس اصلی اپلت */
    .neo-applet-processes-menu {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
        box-shadow: 0 8px 28px rgba(0, 0, 0, 0.07);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* دکمه‌های کنترل */
    .neo_applet_process {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 8px 16px;
        margin-left: 8px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .neo_applet_process:hover {
        background: linear-gradient(135deg, #5a6fd8, #6a4190);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    /* ردیف‌های سرویس */
    .neo-applet-processes-row {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px dashed #e2e8f0;
        transition: background 0.2s ease;
        border-radius: 10px;
        margin: 4px 0;
    }
    .neo-applet-processes-row:hover {
        background: #f8f9fc;
    }
    .neo-applet-processes-row:last-child {
        border-bottom: none;
    }

    /* آیکون سرویس */
    .neo-applet-processes-row-icon {
        margin-left: 16px;
        flex-shrink: 0;
    }
    .neo-applet-processes-row-icon img {
        width: 32px;
        height: 28px;
    }

    /* نام سرویس */
    .neo-applet-processes-row-name {
        flex: 1;
        font-weight: 500;
        color: #1a202c;
        min-width: 140px;
    }

    /* منوی وضعیت */
    .neo-applet-processes-row-menu {
        margin-left: 12px;
        position: relative;
    }
    .neo-applet-processes-row-menu img {
        width: 15px;
        height: 15px;
        cursor: pointer;
    }

    /* پیام وضعیت */
    .neo-applet-processes-row-status-msg {
        margin-left: 16px;
        font-size: 13px;
        font-weight: 500;
        min-width: 100px;
        text-align: center;
    }

    /* آیکون وضعیت (خالی در اصل) */
    .neo-applet-processes-row-status-icon {
        width: 20px;
        margin-left: 8px;
    }

    /* لودینگ */
    #neo-applet-processes-processing {
        margin-right: 12px;
        vertical-align: middle;
    }

    /* ریسپانسیو */
    @media (max-width: 768px) {
        .neo-applet-processes-row {
            flex-wrap: wrap;
            padding: 12px;
        }
        .neo-applet-processes-row-name {
            flex: 100%;
            margin-bottom: 8px;
            text-align: center;
        }
        .neo-applet-processes-row-menu,
        .neo-applet-processes-row-status-msg {
            margin: 4px auto;
        }
    }
</style>

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
    <div class="neo-applet-processes-row-icon">
        <img src="modules/{$module_name}/applets/ProcessesStatus/images/{$infoServicio.icon}" width="32" height="28" alt="{$sServicio}" />
    </div>
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