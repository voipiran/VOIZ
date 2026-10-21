<link rel="stylesheet" media="screen" type="text/css" href="modules/{$module_name}/applets/SystemResources/tpl/css/styles.css" />
<script type='text/javascript' src='modules/{$module_name}/applets/SystemResources/js/javascript.js'></script>
<div style='height:165px; position:relative; text-align:center;'>
    <div style='text-align:left; position: relative; border-bottom:1px solid #222; margin-top:-5px; margin-bottom:5px;' id='lastlogin'>
        {$lastlogin}
    </div>
    <div class='system-resources-gauges'>
        <div class='system-resources-gauge' id='cpugauge'>
            <div id="dashboard-applet-cpugauge" style="width:140px; height:140px"></div>
            <input type="hidden" name="cpugauge_value" id="cpugauge_value" value="{$cpugauge.fraction}" />
            <input type="hidden" name="cpugauge_label" id="cpugauge_label" value="{$LABEL_CPU|escape:html}" />
        </div>
        <div class='system-resources-gauge' id='memgauge'>
            <div id="dashboard-applet-memgauge" style="width:140px; height:140px"></div>
            <input type="hidden" name="memgauge_value" id="memgauge_value" value="{$memgauge.fraction}" />
            <input type="hidden" name="memgauge_label" id="memgauge_label" value="{$LABEL_RAM|escape:html}" />
        </div>
        <div class='system-resources-gauge' id='swapgauge'>
            <div id="dashboard-applet-swapgauge" style="width:140px; height:140px"></div>
            <input type="hidden" name="swapgauge_value" id="swapgauge_value" value="{$swapgauge.fraction}" />
            <input type="hidden" name="swapgauge_label" id="swapgauge_label" value="{$LABEL_SWAP|escape:html}" />
        </div>
    </div>
</div>
<div class='neo-divisor'></div>
<div class=neo-applet-tline>
    <div class='neo-applet-titem'><strong>{$LABEL_CPUINFO}:</strong></div>
    <div class='neo-applet-tdesc'>{$cpu_info}</div>
</div>
<div class=neo-applet-tline>
    <div class='neo-applet-titem'><strong>{$LABEL_UPTIME}:</strong></div>
    <div class='neo-applet-tdesc'>{$uptime}</div>
</div>
<div class='neo-applet-tline'>
    <div class='neo-applet-titem'><strong>{$LABEL_CPUSPEED}:</strong></div>
    <div class='neo-applet-tdesc'>{$speed}</div>
</div>
<div class='neo-applet-tline'>
    <div class='neo-applet-titem'><strong>{$LABEL_MEMORYUSE}:</strong></div>
    <div class='neo-applet-tdesc'>RAM: {$memtotal} SWAP: {$swaptotal}</div>
</div>
