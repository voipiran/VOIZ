<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/libs/JalaliJSCalendar/jalali.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/run.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/calendar.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/calendar-setup.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/lang/calendar-fa.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="/libs/JalaliJSCalendar/skins/aqua/theme.css" title="Aqua" />
<table width="100%" border="0" cellspacing="0" cellpadding="4">
    <tr>
        <td width="12%" align="right">{$name_company.LABEL}:</td>
        <td width="10%"align="left">{$name_company.INPUT}</td>
        <td width="12%" align="right">{$date_fax.LABEL}:</td>
        <td width="21%" align="left">
            <div class="example">

                <input id="date_start" type="text" name="date_fax" value="{php}echo $_SESSION['date_fax'];{/php}"/>&nbsp;
                <img id="date_btn_1" src="/libs/JalaliJSCalendar/examples/cal.png" style="vertical-align: top;" />
                <script type="text/javascript">
                    {literal} Calendar.setup({inputField: "date_start", button: "date_btn_1",
                        ifFormat: "%Y-%m-%d", // format of the input field
                        dateType: 'jalali',
                        showOthers: true,
                        weekNumbers: true
                    }); {/literal} 
                    </script>

                </div>
            </td>
        </tr>
        <tr>
            <td align="right">{$fax_company.LABEL}:</td>
            <td align="left">{$fax_company.INPUT}</td>
            <td align="right">{$filter.LABEL}</td> 
            <td align="left">{$filter.INPUT}</td>
            <td align="left">
                <input class="button" type="submit" name="buscar" value="{$SEARCH}" />
            </td>
        </tr>
    </table>
