<style>
  td{
    direction:ltr;
    text-align:left;
  }
  table{
    direction : ltr;
  }
  
  /* all headers color  */
  #nav ul li{
    background:  #8bc34a;
    /*padding : 0 4px 0 0 ; */
  }
  /* active header color  */
  #nav ul li a.current{
    color : white;
    background : #535454;
  }

  #nav ul li a{
    padding-right: 10px;
  }
</style>

<table cellspacing="0" cellpadding="0" border="0" width="100%" >
  <tr>
    <td valign="top" width="220" style="text-align:left;direction:rtl;">
      <div id="nav">
        <div id="nav-setup" class="tabs-container">

          <ul>
            {foreach name=outer key=category item=menucategory from=$leftmenu}
                <li class="category category-header">{$category}</li>
                {foreach name=inner item=menuitem from=$menucategory}
                    <li><a href="/?menu=pbxconfig&amp;type=setup&amp;display={$menuitem.urlkey}"  >{$menuitem.name}</a></li>
                {/foreach}
            {/foreach}

            <li>{$Option}</li>
            <li style="float:left;border-right:0px"><a href="/admin/" target="_blank">{$Unembedded_IssabelPBX}</a></li>
            <div style="height:0px">
                <a href="#" class="info"><span style='margin-left:0.2cm; margin-top:-1.8cm; width:303px'>{$INFO}</span></a>
            </div>

          </ul>
        </div>{* div id="nav-setup" *}
      </div>{* div id="nav" *}
      <br /> <br /> <br /> <br />
    </td>
    <td id="content_pbx" valign="top" >{$htmlFPBX}</td>
  </tr>
  {if $isissabelpbx == "0"}
  <tr>
    <td></td>
    <td valign="bottom">
      <div align="center">
      </div>
    </td>
  </tr>
  {/if}
</table>
