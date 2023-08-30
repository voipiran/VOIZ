<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/libs/JalaliJSCalendar/jalali.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/run.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/calendar.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/calendar-setup.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/lang/calendar-fa.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="/libs/JalaliJSCalendar/skins/aqua/theme.css" title="Aqua" />

    <table width="99%" cellpadding="4" cellspacing="0" border="0" align="center">
      <tr class="letra12">
	  
	  
        <td width="7%" align="right">{$date_start.LABEL}:</td>
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
		
		
        <td width="11%" align="right">{$field_pattern.LABEL}: </td>
        <td width="14%" align="right" nowrap>{$field_name.INPUT}&nbsp;{$field_pattern.INPUT}</td>
        <td align="right"><input class="button" type="submit" name="filter" value="{$Filter}" /></td>
      </tr>
      <tr class="letra12">
	  
	  
            <td align="right">{$date_end.LABEL}:</td>
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
		
		
		
		
        <td align="right">{$status.LABEL}: </td>
        <td align="left" nowrap>{$status.INPUT}</td>
      </tr>
      <tr class="letra12">
        <td /td>
        <td /td>
        <td align="right">{$ringgroup.LABEL}: </td>
        <td align="left" nowrap>{$ringgroup.INPUT}</td>
      </tr>
   </table>


