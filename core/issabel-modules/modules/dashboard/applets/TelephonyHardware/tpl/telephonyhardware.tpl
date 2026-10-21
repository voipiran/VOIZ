<link rel="stylesheet" media="screen" type="text/css" href="modules/{$module_name}/applets/TelephonyHardware/tpl/css/styles.css" />
<script type='text/javascript' src='modules/{$module_name}/applets/TelephonyHardware/js/javascript.js'></script>
<div class='tabFormTable'>
{foreach from=$telephonycards item=cardinfo}
<div class='services'>{$cardinfo.index}.-&nbsp;{$cardinfo.card} ({$cardinfo.vendor}): &nbsp;&nbsp; </div>
<div align='center' style='background-color:{if $cardinfo.num_serie}#10ED00{else}#FF0000{/if};' class='status' >
<a class='telephonyhardware_editregister' id='{$cardinfo.hwd|escape:html}'>{if $cardinfo.num_serie}{$LABEL_REGISTERED}{else}{$LABEL_UNREGISTERED}{/if}</a>
</div>
{foreachelse}
<br /><div align='center' style='color:red;'><strong>{$LABEL_CARD_NOT_FOUND}</strong></div>
{/foreach}
</div>
<div id='layerCM' style='position:relative'>
    <div class='layer_handle' id='closeCM'></div>
    <div id='layerCM_content'></div>
</div>