<style>
    td{
        text-align: right;
    }
</style>
<table width="99%" border="0" cellspacing="0" cellpadding="4" align="center">
    <tr>
        <td align="left" width="30%">
            <input class="button" type="submit" name="save" value="{$SAVE}" type="submit">
            <input class="button" type="submit" name="cancel" value="{$CANCEL}" type="submit">
        </td>
        <td align="right" nowrap>
            <span class="letra12"><span  class="required">*</span>{$REQUIRED_FIELD}</span>
        </td>
    </tr>
</table>
<table class="tabForm" style="font-size: 16px;" width="100%" border="0">
    <tr class="letra12">
        <td align="left">{$status.LABEL}</td>
        <td align="left">{$status.INPUT}</td>
    </tr>
    <tr class="letra12">
        <td width="16%" align="left">{$email.LABEL}<span  class="required">*</span></td>
        <td align="left">{$email.INPUT}</td>
    </tr>
    <tr class="letra12">
        <td align="left">{$pager_email.LABEL}</td>
        <td align="left">{$pager_email.INPUT}</td>
    </tr>
    <tr class="letra12">
        <td align="left">{$password.LABEL}<span  class="required">*</span></td>
        <td align="left">{$password.INPUT}</td>
    </tr>
    <tr class="letra12">
        <td align="left">{$password_confir.LABEL}<span  class="required">*</span></td>
        <td align="left">{$password_confir.INPUT}</td>
    </tr>
    <tr class="letra12">
        <td align="left">{$email_attach.LABEL}:</td>
        <td align="left">{$email_attach.INPUT}</td>
    </tr>
    <tr class="letra12">
        <td align="left">{$play_cid.LABEL}:</td>
        <td align="left">{$play_cid.INPUT}</td>
    </tr>
    <tr class="letra12">
        <td align="left">{$play_envelope.LABEL}:</td>
        <td align="left">{$play_envelope.INPUT}</td>
    </tr>
    <tr class="letra12">
        <td align="left">{$delete_vmail.LABEL}:</td>
        <td align="left">{$delete_vmail.INPUT}</td>
    </tr>
</table>