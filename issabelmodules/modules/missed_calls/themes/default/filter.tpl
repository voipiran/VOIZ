<table class="table table-bordered" style="width: 55%; margin: 0 auto; padding: 5px;">
  <tbody>
    <tr class="letra12">
      <td style="width: 15%; text-align: right;">{$date_start.LABEL}: <span class="required" style="color: red;">*</span></td>
      <td style="width: 20%; text-align: center;">{$date_start.INPUT}</td>
      <td style="width: 65%; text-align: right;">
        {$filter_field.LABEL}:&nbsp;{$filter_field.INPUT}&nbsp;{$filter_value.INPUT}
        <input class="btn btn-secondary btn-sm" type="submit" name="show" value="{$SHOW}" />
      </td>
    </tr>
    <tr class="letra12">
      <td style="width: 15%; text-align: right;">{$date_end.LABEL}: <span class="required" style="color: red;">*</span></td>
      <td style="width: 20%; text-align: center;">{$date_end.INPUT}</td>
      <td></td>
    </tr>
  </tbody>
</table>