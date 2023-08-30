
<a class="btn btn-primary" data-toggle="collapse" href="#filters" role="button" aria-haspopup="true" aria-expanded="false" aria-controls="filters">
{$FILTER_SHOW}
<span class="caret"></span>
</a>
 


<div class="collapse multi-collapse" id="filters" style="font-family:iransans;">
</br>
<form id=formFilter method="POST" action="">

   <table width="99%" cellpadding="4" cellspacing="0" border="0" align="center">
      <tr class="letra12">
        <td width="7%" align="left">{$date_start.LABEL}:&nbsp;</td>
        <td width="10%" align="left" nowrap>{$date_start.INPUT}</td>
		
        <td width="11%" align="left">{$field_pattern.LABEL}:&nbsp;</td>
        <td width="14%" align="left" nowrap>{$field_name.INPUT}&nbsp;{$field_pattern.INPUT}</td>
        
		<td align="left"><input class="button" type="submit" name="filter" value="{$Filter}" /></td>
      </tr>
      <tr class="letra12">
        <td align="left">{$date_end.LABEL}:&nbsp;</td>
        <td align="left" nowrap>{$date_end.INPUT}</td>
		
        <td align="left">{$status.LABEL}:&nbsp;</td>
        <td align="right" nowrap>{$status.INPUT}</td>
      </tr>
      <tr class="letra12">
        <td align="left">{$limit.LABEL}:&nbsp;</td>
        <td align="right" nowrap>{$limit.INPUT}</td>
        <td align="left">{$ringgroup.LABEL}:&nbsp;</td>
        <td align="right" nowrap>{$ringgroup.INPUT}</td>
      </tr>
   </table>
</form>
</div>
</br>	
