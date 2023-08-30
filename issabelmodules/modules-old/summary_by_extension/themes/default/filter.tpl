<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/libs/JalaliJSCalendar/jalali.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/run.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/calendar.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/calendar-setup.js"></script>
<script type="text/javascript" src="/libs/JalaliJSCalendar/lang/calendar-fa.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="/libs/JalaliJSCalendar/skins/aqua/theme.css" title="Aqua" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr class="letra12">
        <td align="right" width="8%">{$date_from.LABEL}:&nbsp;</td>
        <td align="right" width="22%"><div class="example">

                <input id="date_start" type="text" name="date_from" value="{php}echo $_SESSION['date_from'];{/php}"/>&nbsp;
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
            <td align="right" width="7%">{$option_fil.LABEL}:&nbsp;</td>
            <td align="right" width="22%">{$option_fil.INPUT}&nbsp;{$value_fil.INPUT}</td>
            <td align="right"><input class="button" type="submit" name="show" value="{$SHOW}"></td>
        </tr>
        <tr class="letra12">
            <td align="right" width="5%">{$date_to.LABEL}:&nbsp;</td>
            <td align="right" width="22%"><div class="example">

                    <input id="date_end" type="text" name="date_to" value="{php}echo $_SESSION['date_to'];{/php}"/>&nbsp;
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
            </tr>
        </table>

        {literal}
            <script type= "text/javascript">

                function popup_ventana(url_popup)
                {
                    var ancho = 750;
                    var alto = 580;
                    var winiz = (screen.width - ancho) / 2;
                    var winal = (screen.height - alto) / 2;
                    my_window = window.open(url_popup, "my_window", "width=" + ancho + ",height=" + alto + ",top=" + winal + ",left=" + winiz + ",location=yes,status=yes,resizable=yes,scrollbars=yes,fullscreen=no,toolbar=yes");
                    my_window.document.close();
                }
            </script>
        {/literal}
