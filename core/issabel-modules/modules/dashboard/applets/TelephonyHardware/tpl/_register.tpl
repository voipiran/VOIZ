<div id="telephonyhardware_form">
{$hwd.INPUT}
{if $mode != 'view'}
<div style="text-align:center; width:100%; margin-top:5px;">
	<div class="message" style="color:red; font-size: 11px">{$MSG_UNREGISTERED}</div>
</div>
{/if}
<div class="loading">
<img src='images/loading.gif' height='20px' />
</div>
<table style="margin-top:5px">
	<tr>
		<td><label style="font-size: 12px; font-weight:bold;">{$vendor.LABEL}:</label></td>
		<td id="lman">{$vendor.INPUT}</td>
	</tr>
	<tr>
		<td><label style="font-size: 12px; font-weight:bold;">{$num_serie.LABEL}:</label></td>
		<td id="lser">{$num_serie.INPUT}</td>
	</tr>
</table>
{if $mode != 'view'}
<div class="viewButton" style="margin-top:5px;">
     <input type="button" value="{$SAVE}" class="boton" onclick="telephonyhardware_registersave();" style="cursor:pointer" />
     <input class="boton" type="button" id="cancel" name="cancel" value="{$CANCEL}" style="cursor:pointer" onclick="hideModalPopUP();"/>
</div>
{/if}
</div>