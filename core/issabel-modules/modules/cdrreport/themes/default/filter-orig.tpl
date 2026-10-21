
<a class="btn btn-primary" data-toggle="collapse" href="#filters" role="button" aria-haspopup="true" aria-expanded="false" aria-controls="filters">
{$FILTER_SHOW}
<span class="caret"></span>
</a>

<div class="collapse multi-collapse" id="filters">
</br>
<form id=formFilter method="POST" action="">
   <table width="99%" cellpadding="4" cellspacing="0" border="0" align="center">
      <tr class="letra12">
        <td width="7%" align="right">{$date_start.LABEL}:</td>
        <td width="10%" align="left" nowrap>{$date_start.INPUT}</td>
        <td width="11%" align="right">{$field_pattern.LABEL}: </td>
        <td width="14%" align="left" nowrap>{$field_name.INPUT}&nbsp;{$field_pattern.INPUT}</td>
        <td align="left"><input class="button" type="submit" name="filter" value="{$Filter}" /></td>
      </tr>
      <tr class="letra12">
        <td align="right">{$date_end.LABEL}:</td>
        <td align="left" nowrap>{$date_end.INPUT}</td>
        <td align="right">{$status.LABEL}: </td>
        <td align="left" nowrap>{$status.INPUT}</td>
      </tr>
      <tr class="letra12">
        <td align="right">{$limit.LABEL}: </td>
        <td align="left" nowrap>{$limit.INPUT}</td>
        <td align="right">{$ringgroup.LABEL}: </td>
        <td align="left" nowrap>{$ringgroup.INPUT}</td>
      </tr>
      <tr class="letra12">
        <td align="right" nowrap>{$timeInSecs.LABEL}: </td>
        <td  align="left" nowrap>{$timeInSecs.INPUT}</td>
      </tr>
   </table>
</form>
</div>
</br>
<script>
function timeInSecscheck()
{
  if (document.getElementsByName("chkoldtimeInSecs")[0].checked) {
    document.getElementById("timeInSecs").value="on";
  } else {
    document.getElementById("timeInSecs").value="off";
  }
}
</script>
