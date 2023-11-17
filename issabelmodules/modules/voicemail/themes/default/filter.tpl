
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mb-">
                {$date_start.INPUT}
                <label class="form-label">{$date_start_shamsi.LABEL}</label>
                <div style="display: inline-block; margin-bottom: 10px;">{$date_start_shamsi.INPUT}</div>
            </div>
            <div class="col-md-4">
                {$date_end.INPUT}
                <label class="form-label">{$date_end_shamsi.LABEL}</label>
                <div style="display: inline-block; margin-bottom: 10px;"> {$date_end_shamsi.INPUT}</div>
            </div>
            <div class="col-md-2">
                <input class="button" type="submit" name="filter" value="{$Filter}" />
            </div>
        </div>
    </div>

<script>
$("#idformgrid").on("submit", function() {
    var gDateStart = $("#date_start_shamsipic").attr("data-gdate");
    var gDateEnd = $("#date_end_shamsipic").attr("data-gdate");
    console.log("gDateStart: " + gDateStart + " | gDateEnd: " + gDateEnd);
    $('input[name="date_start"]').val(gDateStart);
    $('input[name="date_end"]').val(gDateEnd);
});
</script>
