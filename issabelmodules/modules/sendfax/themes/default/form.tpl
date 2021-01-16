
<table class="confdir" width="100%" border="0" cellspacing="0" cellpadding="4" align="center">

<div class="alert info">
  <p style="font-family:tahoma; font-size:13px;" class="info" dir="rtl"><strong>توجه!</strong> برای ارسال فکس به یک شماره بر روی آی وی آر کافی است پس از شماره تلفن مقصد و درج ,,,, عدد مورد نظر را قرار دهید. مثلا با   <strong> 6,,,,43333000 </strong> می توانید به عدد 6 بر روی شماره تلفن درج شده ارسال فکس کنید.
</p>
</div>

    <tr class="letra12">
        {if $mode eq 'input'}
        <td align="left">
            <input class="button" type="submit" name="save_new" value="{$SEND}">&nbsp;&nbsp;
            <input class="button" type="submit" name="cancel" value="{$CANCEL}">
        </td>
	<td align="center"><div id="statusFax" style="font-size:13px;color:red;"></div><div id="success_fax" style="display:none; color: blue; text-transform:uppercase;">{$SEND_FAX_SUCCESS}</div><div id="sending_fax" style="display:block; color: red;">{$SENDING_FAX}</div></td>
        {elseif $mode eq 'view'}
        <td align="left">
            <input class="button" type="submit" name="cancel" value="{$CANCEL}">
        </td>
        {elseif $mode eq 'edit'}
        <td align="left">
            <input class="button" type="submit" name="save_edit" value="{$EDIT}">&nbsp;&nbsp;
            <input class="button" type="submit" name="cancel" value="{$CANCEL}">
        </td>
        {/if}
        <td align="right" nowrap><span class="letra12"><span  class="required">*</span> {$REQUIRED_FIELD}</span></td>
    </tr>
</table>
<table class="tabForm" style="font-size: 16px;" width="100%" >
    <tr class="letra12">
        <td align="right" width="180"><b>{$from.LABEL}: <span  class="required">*</span></b></td>
        <td>{$from.INPUT}</td>
    </tr>

    <tr class="letra12">
        <td align="right" width="180"><b>{$to.LABEL}: <span  class="required">*</span></b></td>
        <td dir="ltr" align="right">{$to.INPUT}</td>
    </tr>

    <tr class="letra12">
        <td colspan='2' width="180">
            <input type="radio" name="option_fax" id="fax_by_text" value="by_textArea" {$check_text} onclick="Activate_Option_Fax()" />
            {$text_area} &nbsp;&nbsp;&nbsp;
            <input type="radio" name="option_fax" id="fax_by_file" value="by_file" {$check_file} onclick="Activate_Option_Fax()" />
            {$file_upload}
        </td>
    </tr>

    <tr class="letra12" id='text_option'>
        <td align="right"><b>{$body.LABEL}: <span class="required">*</span></b></td>
        <!--<td align="left">{$body.INPUT}</td>-->
        <td align="right"><textarea name='body' cols='80' rows='12'></textarea></td>
    </tr>
    
    <tr class="letra12" id='upload_option'>
        <td align="right"><b>{$record_Label}</b></td>
        <td align="right">
            <input name="file_record" id="file_record" type="file" value="{$file_record_name}" size='30' />&nbsp;&nbsp;<span style='font-size: 11px; margin-left:15px;'><b>{$type_files}</b>pdf, tiff, txt</span>
        </td>
    </tr>

</table>
<input class="button" type="hidden" name="id" value="{$ID}" />
<input type='hidden' name='filename' value='{$filename}' />
<input type='hidden' name='jobid' id='jobid' value='{$JOBID}' />
{literal}
    <script type="text/javascript">
        Activate_Option_Fax();

        function Activate_Option_Fax()
        {
            var fax_by_text = document.getElementById('fax_by_text');
            var fax_by_file = document.getElementById('fax_by_file');
            if(fax_by_text.checked==true)
            {
                document.getElementById('text_option').style.display = '';
                document.getElementById('upload_option').style.display = 'none';
            }
            else
            {
                document.getElementById('text_option').style.display = 'none';
                document.getElementById('upload_option').style.display = '';
            }
        }
    </script>
{/literal}
