<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
  <td>
    <table width="100%" cellpadding="4" cellspacing="0" border="0">
      <tr>
        <td align="left">
          <input class="button" type="submit" name="save" value="{$APPLY_CHANGES}">
          <input class="button" type="submit" name="cancel" value="{$CANCEL}"></td>
        <td align="right" nowrap><span class="letra12"><span  class="required">*</span> {$REQUIRED_FIELD}</span></td>
     </tr>
   </table>
  </td>
</tr>
<tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabForm">
                <tr>

                    <td width="15%" align="right">{$name_company.LABEL}:</td>
                    <td width="20%">{$name_company.INPUT}</td>	
                    <td>&nbsp;</td>
                </tr>
                <tr>

                    <td width="15%" align="right">{$fax_company.LABEL}:</td>
                    <td width="20%">{$fax_company.INPUT}</td>
                    <td>&nbsp;</td>	
                </tr>

            </table>
        </td>
    </tr>
</table>
<input type='hidden' name='id' value='{$id_fax}'/>
