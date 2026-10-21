<table width="99%" border="0" cellspacing="0" cellpadding="4" align="center" style="background-color:#98FB98">
    <tr height="50px" class="letra12">
            <td width="13%" align="left" valign="center">{$Phone_Directory}:&nbsp; &nbsp;</td>
            <td width="15%" align="right" valign="center">
                <select name="select_directory_type" onchange='submit();'>
                    <option value="external" {$external_sel}>{$External}</option>
					<option value="internal" {$internal_sel}>{$Internal}</option>
                </select>
            </td>
            <!--td align="right">{$field.LABEL}:&nbsp; &nbsp;</td-->
            <td align="left" valign="center" nowrap>
			{$field.LABEL}:&nbsp; {$field.INPUT}{$pattern.INPUT}&nbsp;&nbsp;
			</td>
			
			<td align="right" valign="center" nowrap>
                <input class="button" type="submit" name="report" value="{$SHOW}">
            </td>
    </tr>
</table>


