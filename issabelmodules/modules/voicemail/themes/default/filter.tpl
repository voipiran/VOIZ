<table class="table table-bordered" style="width: 100%; margin: 0 auto; padding: 5px;">
  <tbody>
    <tr class="letra12">
      <td style="width: 10%; text-align: right;">{$date_start.LABEL}:</td>
      <td style="width: 15%; text-align: left;">{$date_start.INPUT}</td>
      <td style="width: 10%; text-align: right;">{$date_end.LABEL}:</td>
      <td style="width: 15%; text-align: left;">{$date_end.INPUT}</td>
      <td style="width: 20%; text-align: left;"><input class="btn btn-secondary btn-sm" type="submit" name="filter" value="{$Filter}"></td>
    </tr>
  </tbody>
</table>
<div class="mt-2 text-right pr-3">
  <a href="javascript:seleccionar_checkbox(1)" class="btn btn-info btn-sm">Marcar todos</a> |
  <a href="javascript:seleccionar_checkbox(0)" class="btn btn-info btn-sm">Desmarcar Todos</a>
</div>