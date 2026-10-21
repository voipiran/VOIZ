
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
    <tr class="letra12">
        {if $mode eq 'input'}
        <td align="left">
            <input class="button" type="submit" name="save_new" value="{$SAVE}">&nbsp;&nbsp;
            <input class="button" type="submit" name="cancel" value="{$CANCEL}">
        </td>
        {elseif $mode eq 'view'}
        <td align="left">
            <input class="button" type="submit" name="cancel" value="{$CANCEL}">
        </td>
        {elseif $mode eq 'edit'}
        <td align="left">
            <input class="button" type="submit" name="save_edit" value="{$EDIT}">&nbsp;&nbsp;
            <input class="button" type="submit" name="cancel" value="{$CANCEL}">
        </td>
        {/if}
        <td align="right" nowrap><span class="letra12"><span  class="required">*</span> {$REQUIRED_FIELD}</span></td>
    </tr>
</table>
<table class="tabForm" style="font-size: 16px;" width="100%" >
    <input type="hidden" name="idCard" value="{$DESC_ID}" />

    <label id="port_desc">{$CARD} # {$ID}: {$TIPO} {$ADICIONAL}</label>
    <div id="form" style='background-color:yellow'>
    <!--<table border="0" width="40%" cellspacing="0" style="border:1px solid black">-->
        {foreach key=key item=echocancel name=arrPortsEchoInfo from=$arrPortsEcho}
        <tr class="letra12">
            <td> </td>
            <td> </td>
            <td width="10%" align="left"><b>{$key}</b>  {$echocancel.name_port}: </td>
            <td width="50%" align="left">
                <select id='typeecho_{$key}' name='typeecho_{$key}'>
                    {html_options options=$type_echo_names selected=$echocancel.type_echo}
                </select>
            </td>
            <input type="hidden" value="{$echocancel.type_echo}" name="tmpTypeEcho{$key}" />
        </tr>
        {/foreach}
    <!--</table>-->
    </div>
</table>
<input class="button" type="hidden" name="id" value="{$ID}" />
