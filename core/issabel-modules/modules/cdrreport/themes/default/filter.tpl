<a class="btn btn-primary" data-toggle="collapse" href="#filters" role="button" aria-haspopup="true" aria-expanded="false" aria-controls="filters">
  {$FILTER_SHOW}
  <span class="caret"></span>
</a>
<div class="collapse multi-collapse" id="filters">
  <form id="formFilter" method="POST" action="" class="p-3">
    <table class="table table-bordered" style="width: 100%; margin: 0 auto;">
      <tbody>
        <tr class="letra12">
          <td style="width: 10%; text-align: right;">{$date_start.LABEL}:</td>
          <td style="width: 15%; text-align: left;">{$date_start.INPUT}</td>
          <td style="width: 15%; text-align: right;">{$field_pattern.LABEL}:</td>
          <td style="width: 20%; text-align: left;">{$field_name.INPUT}&nbsp;{$field_pattern.INPUT}</td>
          <td style="width: 20%; text-align: left;"><input class="btn btn-secondary btn-sm" type="submit" name="filter" value="{$Filter}" /></td>
        </tr>
        <tr class="letra12">
          <td style="text-align: right;">{$date_end.LABEL}:</td>
          <td style="text-align: left;">{$date_end.INPUT}</td>
          <td style="text-align: right;">{$status.LABEL}:</td>
          <td style="text-align: left;">{$status.INPUT}</td>
          <td></td>
        </tr>
        <tr class="letra12">
          <td style="text-align: right;">{$limit.LABEL}:</td>
          <td style="text-align: left;">{$limit.INPUT}</td>
          <td style="text-align: right;">{$ringgroup.LABEL}:</td>
          <td style="text-align: left;">{$ringgroup.INPUT}</td>
          <td></td>
        </tr>
        <tr class="letra12">
          <td style="text-align: right;">{$timeInSecs.LABEL}:</td>
          <td style="text-align: left;">{$timeInSecs.INPUT}</td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>

<script>
function timeInSecscheck() {
  if (document.getElementsByName("chkoldtimeInSecs")[0].checked) {
    document.getElementById("timeInSecs").value = "on";
  } else {
    document.getElementById("timeInSecs").value = "off";
  }
}
</script>