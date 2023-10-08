<link rel="stylesheet" media="screen" type="text/css" href="modules/{$module_name}/applets/HardDrives/tpl/css/styles.css" />
<script type='text/javascript' src='modules/{$module_name}/applets/HardDrives/js/javascript.js'></script>
{foreach from=$part item=particion}
<div>
    <div id="dashboard-applet-hd-usage" style="width:160px; height:160px;"></div>
    <script>
        {literal}
        var ram = new JustGage({
          id: "dashboard-applet-hd-usage", {/literal}
          value: {$particion.porcentaje_usado}, {literal}
          min: 0,
          max: 100,
          donut: true,
          startAnimationType : 'bounce',
          shadowSize: 0,
          shadowVerticalOffset: 0,
          valueFontColor: '#666666',
          levelColors : ['#3184d5'],
          gaugeColor : '#6e407e',
          label: "%"
        }); {/literal}
    </script>
    <div class="neo-applet-hd-innerbox">
      <div class="neo-applet-hd-innerbox-top">
       <img src="modules/{$module_name}/applets/HardDrives/images/light_usedspace.png" width="13" height="11" alt="used" /> {$particion.formato_porcentaje_usado}% {$LABEL_PERCENT_USED} &nbsp;&nbsp;<img src="modules/{$module_name}/applets/HardDrives/images/light_freespace.png" width="13" height="11" alt="used" /> {$particion.formato_porcentaje_libre}% {$LABEL_PERCENT_AVAILABLE}
      </div>
      <div class="neo-applet-hd-innerbox-bottom">
        <div><strong>{$LABEL_DISK_CAPACITY}:</strong> {$particion.sTotalGB}GB</div>
        <div><strong>{$LABEL_MOUNTPOINT}:</strong> {$particion.punto_montaje}</div>
        <div><strong>{$LABEL_DISK_VENDOR}:</strong> {$particion.sModelo}</div>
      </div>
    </div>
</div>
{/foreach}

<div class="neo-divisor"></div>
<div id="harddrives_dirspacereport">
<p>{$TEXT_WARNING_DIRSPACEREPORT}</p>
<button class="submit" id="harddrives_dirspacereport_fetch" >{$FETCH_DIRSPACEREPORT}</button>
</div>