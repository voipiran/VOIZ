<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr class="letra12">
        <td align="right" width="8%">{$date_from_shamsi.LABEL}:&nbsp;</td>
        <td align="left" width="13%">{$date_from_shamsi.INPUT}</td>
        <td align="right" width="7%">{$option_fil.LABEL}:&nbsp;</td>
        <td align="left" width="22%">{$option_fil.INPUT}&nbsp;{$value_fil.INPUT}</td>
        <td align="left"><input class="button" type="submit" name="show" value="{$SHOW}"></td>
    </tr>
    <tr class="letra12">
        <td align="right" width="5%">{$date_to_shamsi.LABEL}:&nbsp;</td>
        <td align="left">{$date_to_shamsi.INPUT}</td>
    </tr>
</table>
{literal}
<script type="text/javascript">
function popup_ventana(url_popup)
{
    var ancho = 750;
    var alto = 580;
    var winiz = (screen.width-ancho)/2;
    var winal = (screen.height-alto)/2;
    my_window = window.open(url_popup,"my_window","width="+ancho+",height="+alto+",top="+winal+",left="+winiz+",location=yes,status=yes,resizable=yes,scrollbars=yes,fullscreen=no,toolbar=yes");
    my_window.document.close();
}
</script>
{/literal}