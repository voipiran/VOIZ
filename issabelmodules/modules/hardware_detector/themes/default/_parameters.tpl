<input type="hidden" name="idCard" id="idCard" value="" />
<table class="tabForm" style="font-size: 16px; margin-left:-10px;" border="0" >
   <tr>
     <td align="center">
          <label id="port_desc_span">{$CARD} # {$ID}: {$TIPO} {$ADICIONAL}</label>
          <div id="config_span_div">
             <table align="center" width="100%">
                <tr align="left">
                    <td><label style='font-size: 12px; font-weight:bold'>{$Timing_source}:</label></td>
                    <td><input type="text" size="3" class="input" id="tmsource" name="tmsource" title="{$Timing_source_title|escape:html}" /></td>
                </tr>
                <tr align="left">
                    <td><label style='font-size: 12px; font-weight:bold'>{$Line_build_out}:</label></td>
                    <td><select id='lnbuildout' name='lnbuildout'>
                    {html_options options=$type_lnbuildout}
                    </select></td>
                </tr>
                <tr id="switch_pri_media" align="left">
                    <td><label style='font-size: 12px; font-weight:bold'>{$Media}:</label></td>
                    <td><select id='media_pri' name='media_pri'>
                    {html_options options=$type_media}
                    </select></td>
                </tr>
                <tr align="left">
                    <td><label style='font-size: 12px; font-weight:bold'>{$Framing}:</label></td>
                    <td><select id='framing' name='framing'>
                    {html_options options=$type_framing}
                    </select></td>
                </tr>
                <tr align="left">
                    <td><label style='font-size: 12px; font-weight:bold'>{$Coding}:</label></td>
                    <td><select id='coding' name='coding'>
                    {html_options options=$type_coding}
                    </select></td>
                </tr>
                <tr id="switch_crc" align="left">
                    <td><label style='font-size: 12px; font-weight:bold'>{$CRC}:</label></td>
                    <td><select id='crc' name='crc'>
                    {html_options options=$type_crc}
                    </select></td>
                </tr>
              </table>
           </div>
     </td>
   </tr>
</table>
<div class="letra12 viewButton" style="display: none;">
               <input class="button" type="button" id="save_span" name="save_span" value="{$SAVE}" onclick="saveSpan();" style="cursor:pointer" />&nbsp;&nbsp;
               <input class="button" type="button" id="cancel" name="cancel" value="{$CANCEL}" onclick="hideModalPopUP();" style="cursor:pointer"/>
 	       <div class="loading" style="float: right; position: relative; top: 0px; left:-70px"></div>
	       <div class="message" style="text-align:left; font-size:14px; font-weight:bold; float: right; position: relative; left: 5px; top:5px; width:65%"></div>	
</div>
