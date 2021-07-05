<style>
    td{
        text-align:right;
    }
</style>

<input type='hidden' name='id' value='{$ID}' />
<input type='hidden' name='type' value='{$TYPE}' />

<table width="99%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td align="left">
            {if $Show}
                <input class="button" type="submit" name="save" value="{$SAVE}">&nbsp;&nbsp;&nbsp;&nbsp;
            {elseif $Edit}
                <input class="button" type="submit" name="edit" value="{$EDIT}">&nbsp;&nbsp;&nbsp;&nbsp;
            {elseif $Commit}
                <input class="button" type="submit" name="commit" value="{$SAVE}">&nbsp;&nbsp;&nbsp;&nbsp;
            {/if}
            <input class="button" type="submit" name="cancel" value="{$CANCEL}">
        </td>
	{if ($mode ne 'view') and ($TYPE ne 'internal') }
	    <td align="right" nowrap><span class="letra12"><span  class="required">*</span> {$REQUIRED_FIELD}</span></td>
	{/if}
    </tr>
    <tr>
        <td  colspan='2'>
            <table width="100%" cellpadding="4" cellspacing="0" border="0" class="tabForm">
                <tr class="letra12" {$style_address_options}>
                    <td colspan='2'>
                        <input type="radio" name="address_book_options" id="new_contact" value="new_contact" {$check_new_contact} onclick="Activate_Option_Address_Book()" />
                        {$new_contact} &nbsp;&nbsp;&nbsp;
                        <input type="radio" name="address_book_options" id="address_from_csv" value="address_from_csv" {$check_csv} onclick="Activate_Option_Address_Book()" />
                        {$address_from_csv}
                    </td>
                </tr>
                <tr id="tr_new_contact">
                    <td width="310px" align="center">
            {if $ShowImg}
                        <img alt="image" src="index.php?menu={$MODULE_NAME}&action=getImage&type={$TYPE}&idPhoto={$idPhoto}&thumbnail=no&rawmode=yes"/>
            {else}
                        <img alt="image" src="modules/{$MODULE_NAME}/images/Icon-user.png"/>
            {/if}
                    </td>
                    <td>
                        <table class="letra12" width="100%" cellpadding="4" cellspacing="0"  border="0">                            
                            <tr>
                                <td align="left" width="25%"><b>{$name.LABEL}: {if ($mode ne 'view') and ($TYPE ne 'internal') }<span  class="required">*</span>{/if}</b></td>
                                <td class="required" align="left">{$name.INPUT}</td>
                            </tr>
                            {if $TYPE eq 'external'}
                                <tr>
                                    <td align="left" width="25%"><b>{$last_name.LABEL}: {if $mode ne 'view'}<span  class="required">*</span>{/if}</b></td>
                                    <td class="required" align="left">{$last_name.INPUT}</td>
                                </tr>
                            {/if}
                            <tr id='tr_phone'>
                                <td align="left" width="25%"><b>{$work_phone.LABEL}: {if ($mode ne 'view') and ($TYPE ne 'internal') }<span id="span_phone" class="required">*</span>{/if}</b></td>
                                <td class="required" align="left">{$work_phone.INPUT}</td>             
                            </tr>       
                            {if $TYPE eq 'internal'}
                                <tr>
                                    <td align="left" width="25%"><b>{$department.LABEL}: </b></td>
                                    <td class="required" align="left">{$department.INPUT}</td>
                                </tr>
                            {/if}
                            <tr id='tr_phone'>
                                <td align="left" width="25%"><b>{$cell_phone.LABEL}: </b></td>
                                <td align="left">{$cell_phone.INPUT}</td>
                            </tr>
                            <tr id='tr_phone'>
                                <td align="left" width="25%"><b>{$home_phone.LABEL}: </b></td>
                                <td align="left">{$home_phone.INPUT}</td>
                            </tr>
                            <tr id='tr_phone'>
                                <td align="left" width="25%"><b>{$fax1.LABEL}: </b></td>
                                <td align="left">{$fax1.INPUT}</td>
                            </tr>
                            <tr id='tr_phone'>
                                <td align="left" width="25%"><b>{$fax2.LABEL}: </b></td>
                                <td align="left">{$fax2.INPUT}</td>
                            </tr>
                            <tr>
                                <td align="left"><b>{$email.LABEL}: </b></td>
                                <td align="left">{$email.INPUT}</td>
                            </tr>
                            {if $TYPE eq 'internal'}
                                <tr>
                                    <td align="left" width="25%"><b>{$im.LABEL}: </b></td>
                                    <td class="required" align="left">{$im.INPUT}</td>
                                </tr>
                            {/if}
                            <tr>
                                <td align="left"><b>{$province.LABEL}: </b></td>
                                <td align="left">{$province.INPUT}</td>
                            </tr>
                            <tr>
                                <td align="left"><b>{$city.LABEL}: </b></td>
                                <td align="left">{$city.INPUT}</td>
                            </tr>
                            <tr>
                                <td align="left"><b>{$address.LABEL}: </b></td>
                                <td align="left">{$address.INPUT}</td>
                            </tr>
                            <tr>
                                <td align="left"><b>{$company.LABEL}: </b></td>
                                <td align="left">{$company.INPUT}</td>
                            </tr>
                            <tr>
                                <td align="left"><b>{$company_contact.LABEL}: </b></td>
                                <td align="left">{$company_contact.INPUT}</td>
                            </tr>
                            <tr>
                                <td align="left"><b>{$contact_rol.LABEL}: </b></td>
                                <td align="left">{$contact_rol.INPUT}</td>
                            </tr>
                            <tr>
                                <td align="left"><b>{$notes.LABEL}: </b></td>
                                <td align="left">{$notes.INPUT}</td>
                            </tr>
                    {if ($EditW or $Commit or $Show)}
                            <tr>
                                <td align="left"><b>{$picture.LABEL}: </b></td>
                                <td align="left">{$picture.INPUT}</td>
                            </tr>
                            {if $TYPE eq 'external'}
                                <tr>
                                    <td align="right">
                                        <input type="radio" name="address_book_status" id="isPrivate" value="isPrivate" {$check_isPrivate} />
                                        {$private_contact} &nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td align="left">
                                        &nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="address_book_status" id="isPublic" value="isPublic" {$check_isPublic} />
                                        {$public_contact}
                                    </td>
                                </tr> 
                            {/if}
                    {/if}
                        </table>
                    </td>
                </tr>
                <tr id="tr_from_csv">
                    <td>{$label_file}&nbsp;(file.csv):{if $mode ne 'view'}<span  class="required">*</span>{/if}</td>
                    <td><input type='file' id='userfile' name='userfile'></td>
                    <td><a href="?menu={$MODULE_NAME}&amp;action=download_csv&amp;rawmode=yes" name="link_download">{$DOWNLOAD}</a></td>
                </tr>
            </table>
            <table id="table_from_csv" width="100%" cellpadding="4" cellspacing="0" border="0" class="tabForm">
                <tr>
                    <td colspan='3'>{$HeaderFile}</td>
                </tr>
                <tr>
                    <td colspan='3'>{$AboutContacts}</td>
                </tr>
            </table>
        </td>

    </tr>
</table>

{literal}
    <script type="text/javascript">
        Activate_Option_Address_Book();

        function Activate_Option_Address_Book()
        {
            var new_contact = document.getElementById('new_contact');
            var address_from_csv = document.getElementById('address_from_csv');
            if(new_contact.checked==true)
            {
                document.getElementById('tr_new_contact').style.display = '';
                document.getElementById('tr_from_csv').style.display = 'none';
                document.getElementById('table_from_csv').style.display = 'none';
            }
            else
            {
                document.getElementById('tr_new_contact').style.display = 'none';
                document.getElementById('tr_from_csv').style.display = '';
                document.getElementById('table_from_csv').style.display = '';
            }
        }
    </script>
{/literal}
