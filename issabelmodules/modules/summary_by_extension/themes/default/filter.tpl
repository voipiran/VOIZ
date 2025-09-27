<table class="table table-bordered" style="width: 100%; margin: 0 auto; padding: 5px;">
  <tbody>
    <tr class="letra12">
      <td style="width: 10%; text-align: right;">{$date_from.LABEL}:</td>
      <td style="width: 15%; text-align: left;">{$date_from.INPUT}</td>
      <td style="width: 10%; text-align: right;">{$option_fil.LABEL}:</td>
      <td style="width: 25%; text-align: left;">{$option_fil.INPUT}&nbsp;{$value_fil.INPUT}</td>
      <td style="width: 20%; text-align: left;"><input class="btn btn-secondary btn-sm" type="submit" name="show" value="{$SHOW}"></td>
    </tr>
    <tr class="letra12">
      <td style="width: 10%; text-align: right;">{$date_to.LABEL}:</td>
      <td style="width: 15%; text-align: left;">{$date_to.INPUT}</td>
      <td colspan="3"></td>
    </tr>
  </tbody>
</table>

{literal}
<script type="text/javascript">
function popup_ventana(url_popup) {
  var ancho = 750;
  var alto = 580;
  var winiz = (screen.width - ancho) / 2;
  var winal = (screen.height - alto) / 2;
  my_window = window.open(url_popup, "my_window", "width=" + ancho + ",height=" + alto + ",top=" + winal + ",left=" + winiz + ",location=yes,status=yes,resizable=yes,scrollbars=yes,fullscreen=no,toolbar=yes");
  my_window.document.close();
}
</script>
{/literal}