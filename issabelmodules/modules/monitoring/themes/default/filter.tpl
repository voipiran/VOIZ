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
          <td style="width: 10%; text-align: right;">{$date_end.LABEL}:</td>
          <td style="width: 15%; text-align: left;">{$date_end.INPUT}</td>
          <td style="width: 15%; text-align: right;">{$filter_field.LABEL}:</td>
          <td style="width: 20%; text-align: left;">{$filter_field.INPUT}&nbsp;{$filter_value.INPUT}
            <select id="filter_value_recordingfile" name="filter_value_recordingfile" size="1" style="display: none;">
              <option value="incoming" {$SELECTED_1}>{$INCOMING}</option>
              <option value="outgoing" {$SELECTED_2}>{$OUTGOING}</option>
              <option value="queue" {$SELECTED_3}>{$QUEUE}</option>
              <option value="group" {$SELECTED_4}>{$GROUP}</option>
            </select>
          </td>
          <td style="width: 15%; text-align: right;"><input class="btn btn-secondary btn-sm" type="submit" name="show" value="{$SHOW}" /></td>
        </tr>
        <tr class="letra12">
          <td style="text-align: right;">{$limit.LABEL}:</td>
          <td style="text-align: left;">{$limit.INPUT}</td>
          <td colspan="5"></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>