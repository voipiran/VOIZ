<input type="hidden" name="idCard" id="idCard" value="" />
<div style="text-align:center; margin-top:10px;">
     <label id="port_desc">{$CARD} # {$ID}: {$TIPO} {$ADICIONAL}</label>
</div>
<div id="config_echo_div" style="margin-top:5px;"> </div>
<div class="viewButton" style="display:none">
     <input class="button" type="button" id="save_edit" onclick="saveEdit();" name="save_edit" value="{$SAVE}" style="cursor:pointer" />
     <input class="button" type="button" id="cancel" name="cancel" value="{$CANCEL}" style="cursor:pointer" onclick="hideModalPopUP();"/>
     <div class="loading" style="float: right; position: relative; top: 0px; left:-30px"></div>
     <div class="message" style="text-align:center; font-size:14px; font-weight:bold; float: right; position: relative; top: 5px; left:-55px"></div>
</div>
