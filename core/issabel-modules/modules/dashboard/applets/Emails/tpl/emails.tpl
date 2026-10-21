{foreach from=$mails item=mail}
<b>
<font color='#000080' size='1'>{$mail.date}</font>&nbsp;&nbsp;&nbsp;
<font size='1'>From: {$mail.from|truncate:50:"..."}</font>&nbsp;&nbsp;&nbsp;
<font size='1'>Subject: {$mail.subject|truncate:30:"..."}</font><br/>
</b>
{foreachelse}
{$NO_EMAILS}
{/foreach}
