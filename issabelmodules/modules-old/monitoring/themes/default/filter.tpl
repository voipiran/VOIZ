<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/libs/JalaliJSCalendar/jalali.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/run.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/calendar.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/calendar-setup.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/lang/calendar-fa.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="/libs/JalaliJSCalendar/skins/aqua/theme.css" title="Aqua" />

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr class="letra12">
        <td align="right">تاریخ شروع:</td>
        <td width="20%" align="right" nowrap><div class="example">

                <input id="date_start" type="text" name="date_start" value="{php}echo $_SESSION['date_start'];{/php}"/>&nbsp;
                <img id="date_btn_1" src="/libs/JalaliJSCalendar/examples/cal.png" style="vertical-align: top;" />
                <script type="text/javascript">
                    {literal} Calendar.setup({inputField: "date_start", button: "date_btn_1",
                        ifFormat: "%Y-%m-%d", // format of the input field
                        dateType: 'jalali',
                        showOthers: true,
                        weekNumbers: true
                    }); {/literal} 
                    </script>

                </div></td>
            <td align="right">تاریخ پایان:</td>
            <td width="20%" align="right" nowrap><div class="example">

                    <input id="date_end" type="text" name="date_end" value="{php}echo $_SESSION['date_end'];{/php}"/>&nbsp;
                    <img id="date_btn_10" src="/libs/JalaliJSCalendar/examples/cal.png" style="vertical-align: top;" />
                    <script type="text/javascript">
                        {literal} Calendar.setup({inputField: "date_end", button: "date_btn_10",
                            ifFormat: "%Y-%m-%d", // format of the input field
                            dateType: 'jalali',
                            showOthers: true,
                            weekNumbers: true
                        }); {/literal} 
                        </script>

                    </div></td>
                <td align="right">{$filter_field.LABEL}:</td>
                <td align="right">{$filter_field.INPUT}&nbsp;{$filter_value.INPUT}
                    <select id="filter_value_recordingfile" name="filter_value_recordingfile" size="1" style="display:none">
                        <option value="incoming" {$SELECTED_1} >{$INCOMING}</option>
                        <option value="outgoing" {$SELECTED_2} >{$OUTGOING}</option>
                        <option value="queue" {$SELECTED_3} >{$QUEUE}</option>
                        <option value="group" {$SELECTED_4} >{$GROUP}</option>
                    </select>
                </td>
                <td align="right"><input class="button" type="submit" name="show" value="{$SHOW}" /></td>
            </tr>
        </table>
