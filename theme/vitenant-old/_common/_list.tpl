<form class="issabel-standard-formgrid" id="idformgrid" method="POST" style="margin-bottom:0;" action="{$url}">
{* Botón invisible al inicio del form que impide que el primer botón visible del filtro, frecuentemente Borrar, sea default *}
<input type="submit" name="" value="" style="height: 0; min-height: 0; font-size: 0; width: 0; border: none; outline: none; padding: 0px; margin: 0px; box-sizing: border-box; float: left;" />
    <div class="neo-table-header-row">
        {foreach from=$arrActions key=k item=accion name=actions}
            {if $accion.type eq 'link'}
                <a href="{$accion.task}" class="x-neo-table-action" {if !empty($accion.onclick)} onclick="{$accion.onclick}" {/if} >
                    <div class="neo-table-header-row-filter">
                    <button type="button" name="{$accion.task}" value="{$accion.alt}" class="neo-table-toolbar-button" {if !empty($accion.ocolor)} style="background-color:#{$accion.ocolor}; border:1px solid #{$accion.ocolor};" {/if}>
                       {if !empty($accion.iconclass)}<i class="{$accion.iconclass}"></i> {elseif !empty($accion.icon)}<img border="0" src="{$accion.icon}" align="absmiddle"  />{/if}{$accion.alt}
                    </button>
                    </div>
                </a>
            {elseif $accion.type eq 'button'}
                <div class="neo-table-header-row-filter">
                    <button type="button" name="{$accion.task}" value="{$accion.alt}" {if !empty($accion.onclick)} onclick="{$accion.onclick}" {/if} class="neo-table-toolbar-button" {if !empty($accion.ocolor)} style="background-color:#{$accion.ocolor}; border:1px solid #{$accion.ocolor};" {/if}>
                       {if !empty($accion.iconclass)}<i class="{$accion.iconclass}"></i> {elseif !empty($accion.icon)}<img border="0" src="{$accion.icon}" align="absmiddle"  />{/if}{$accion.alt}
                    </button>
                </div>
            {elseif $accion.type eq 'submit'}
                <div class="neo-table-header-row-filter">
                    <button type="submit" name="{$accion.task}" value="{$accion.alt}" {if !empty($accion.onclick)} onclick="{$accion.onclick}" {/if} class="neo-table-toolbar-button" {if !empty($accion.ocolor)} style="background-color:#{$accion.ocolor}; border:1px solid #{$accion.ocolor};" {/if}>
                       {if !empty($accion.iconclass)}<i class="{$accion.iconclass}"></i> {elseif !empty($accion.icon)}<img border="0" src="{$accion.icon}" align="absmiddle"  />{/if}{$accion.alt}
                    </button>
                </div>
            {elseif $accion.type eq 'text'}
                <div class="neo-table-header-row-filter" style="cursor:default">
                    <input type="text"   id="{$accion.name}" name="{$accion.name}" value="{$accion.value}" {if !empty($accion.onkeypress)} onkeypress="{$accion.onkeypress}" {/if} style="height:22px" />
                    <input type="submit" name="{$accion.task}" value="{$accion.alt}" class="neo-table-action" />
                </div>
            {elseif $accion.type eq 'combo'}
                <div class="neo-table-header-row-filter" style="cursor:default">
                    <select name="{$accion.name}" id="{$accion.name}" {if !empty($accion.onchange)} onchange="{$accion.onchange}" {/if}>
                        {if !empty($accion.selected)}
                            {html_options options=$accion.arrOptions selected=$accion.selected}
                        {else}
                            {html_options options=$accion.arrOptions}
                        {/if}
                    </select>
                    {if !empty($accion.task)}
                        <input type="submit" name="{$accion.task}" value="{$accion.alt}" class="neo-table-action" />
                    {/if}
                </div>
            {elseif $accion.type eq 'html'}
                <div class="neo-table-header-row-filter">
                    {$accion.html}
                </div>
            {/if}
        {/foreach}

        {if !empty($contentFilter)}
            <button type='button' class="neo-table-button-filter-left">
                {if $AS_OPTION eq 0} <i class='fa fa-filter'></i> {/if}
                {if $AS_OPTION} {$MORE_OPTIONS} {else} {$FILTER_GRID_SHOW} {/if}
            </button>
            <button type='button' class='neo-table-button-filter-right' id="neo-table-filter-button-arrow">
               <i class='fa fa-caret-down'></i>
            </button>
        {/if}

        {if $enableExport==true}
            <button type="button" class="neo-table-button-filter-left" id="export_button">
                <i class='fa fa-download'></i> {$DOWNLOAD_GRID}
            </button>
            <button type='button' class='neo-table-button-filter-right' id="neo-table-button-download-right">
               <i class='fa fa-caret-down'></i>
            </button>

            <div id="subMenuExport" class="subMenu neo-display-none" role="menu" aria-haspopup="true" aria-activedescendant="">
                 <div class="items">
                    <a href="{$url}&exportcsv=yes&rawmode=yes">
			<div class="menuItem" role="menuitem" id="CSV" aria-disabled="false">
			    <div>
				<i style="color:#99c" class="fa fa-file-text-o"></i>&nbsp;&nbsp;CSV
			    </div>
			</div>
		    </a>
		    <a href="{$url}&exportspreadsheet=yes&rawmode=yes">
			<div class="menuItem" role="menuitem" id="Spread_Sheet" aria-disabled="false">
			    <div>
				<i style="color:green;" class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Spreadsheet
			    </div>
			</div>
		    </a>
		    <a href="{$url}&exportpdf=yes&rawmode=yes">
			<div class="menuItem" role="menuitem" id="PDF" aria-disabled="false">
			    <div>
				<i style="color:red;" class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;PDF
			    </div>
			</div>
		    </a>
                </div>
            </div>
        {/if}

        <div class="neo-table-header-row-navigation">
            {if $pagingShow and $numPage>1}
                {if $start<=1}
                    <i class="fa fa-step-backward" style="color:#ccc;"></i>&nbsp;<i class="fa fa-backward" style="color:#ccc"></i>
                {else}
                    <a href="{$url}&nav=start&start={$start}" class="fa fa-step-backward neo-navigation-arrow-active" alt='{$lblStart}'></a>
                    <a href="{$url}&nav=previous&start={$start}" class="fa fa-backward neo-navigation-arrow-active" alt='{$lblPrevious}'></a>
                {/if}
                &nbsp;{$lblPage}&nbsp;
                <input type="text"  value="{$currentPage}" size="2" align="absmiddle" name="page" id="pageup" />&nbsp;{$lblof}&nbsp;{$numPage}
                <input type="hidden" value="bypage" name="nav" />
                {if $end==$total}
                    <i class="fa fa-forward" style="color:#ccc;"></i>&nbsp;<i class="fa fa-step-forward" style="color:#ccc"></i>
                {else}
                    <a href="{$url}&nav=next&start={$start}" class="fa fa-forward neo-navigation-arrow-active" alt='{$lblNext}'></a>
                    <a href="{$url}&nav=end&start={$start}" class="fa fa-step-forward neo-navigation-arrow-active" alt='{$lblEnd}'></a>
                {/if}
            {/if}
        </div>
    </div>

    {if !empty($contentFilter)}
        <div id="neo-table-header-filterrow" class="neo-display-none">
            {$contentFilter}
        </div>
    {/if}

    {if !empty($arrFiltersControl)}
        <div class="neo-table-filter-controls">
            {foreach from=$arrFiltersControl key=k item=filterc name=filtersctrl}
                <span class="neo-filter-control"><i>{$filterc.msg}</i>&nbsp;
				{if $filterc.defaultFilter eq no}
					<a href="{$url}&name_delete_filters={$filterc.filters}" style="color:#ccc;text-decoration:none;"><i class="fa fa-remove"></i></a>
				{/if}
				</span>
            {/foreach}
        </div>
    {/if}

    {*<div class="neo-table-ref-table">*}
        <table class="issabel-standard-table" align="center" width="100%" >
        <thead>
            <tr>
                {section name=columnNum loop=$numColumns start=0 step=1}
                <th>{$header[$smarty.section.columnNum.index].name}&nbsp;</th>
                {/section}
            </tr>
        </thead>
        <tbody>
            {if $numData > 0}
                {foreach from=$arrData key=k item=data name=filas}
                {if $data.ctrl eq 'separator_line'}
                    <tr>
                        {if $data.start > 0}
                            <td colspan="{$data.start}"></td>
                        {/if}
                        {assign var="data_start" value="`$data.start`"}
                        <td colspan="{$numColumns-$data.start}" style='background-color:#AAAAAA;height:1px;'></td>
                    </tr>
                {else}
                    <tr>
                        {if $smarty.foreach.filas.last}
                            {section name=columnNum loop=$numColumns start=0 step=1}
                                <td class="table_data_last_row">{if $data[$smarty.section.columnNum.index] eq ''}&nbsp;{/if}{$data[$smarty.section.columnNum.index]}</td>
                            {/section}
                        {else}
                            {section name=columnNum loop=$numColumns start=0 step=1}
                                <td class="table_data">{if $data[$smarty.section.columnNum.index] eq ''}&nbsp;{/if}{$data[$smarty.section.columnNum.index]}</td>
                            {/section}
                        {/if}
                    </tr>
                {/if}
                {/foreach}
            {else}
                <tr>
                    <td class="table_data" colspan="{$numColumns}" align="center">{$NO_DATA_FOUND}</td>
                </tr>
            {/if}
        </tbody>
            {if $numData > 3}
        <tfoot>
                <tr>
                    {section name=columnNum loop=$numColumns start=0 step=1}
                    <th>{$header[$smarty.section.columnNum.index].name}&nbsp;</th>
                    {/section}
                </tr>
        </tfoot>
            {/if}
        </table>
    {*</div>*}

    {if $numData > 3 and $numPage > 1}
        <div class="neo-table-footer-row">
            <div class="neo-table-header-row-navigation">
            {if $pagingShow and $numPage>1}
                {if $start<=1}
                    <i class="fa fa-step-backward" style="color:#ccc;"></i>&nbsp;<i class="fa fa-backward" style="color:#ccc"></i>
                {else}
                    <a href="{$url}&nav=start&start={$start}" class="fa fa-step-backward neo-navigation-arrow-active" alt='{$lblStart}'></a>
                    <a href="{$url}&nav=previous&start={$start}" class="fa fa-backward neo-navigation-arrow-active" alt='{$lblPrevious}'></a>
                {/if}
                &nbsp;{$lblPage}&nbsp;
                <input type="text"  value="{$currentPage}" size="2" align="absmiddle" name="page" id="pagedown" />&nbsp;{$lblof}&nbsp;{$numPage}
                <input type="hidden" value="bypage" name="nav" />
                {if $end==$total}
                    <i class="fa fa-forward" style="color:#ccc;"></i>&nbsp;<i class="fa fa-step-forward" style="color:#ccc"></i>
                {else}
                    <a href="{$url}&nav=next&start={$start}" class="fa fa-forward neo-navigation-arrow-active" alt='{$lblNext}'></a>
                    <a href="{$url}&nav=end&start={$start}" class="fa fa-step-forward neo-navigation-arrow-active" alt='{$lblEnd}'></a>
                {/if}
            {/if}
            </div>
        </div>
    {/if}
</form>

<div class='modal' id='gridModal' tabindex='-1' role='dialog'>
  <div class='modal-dialog {$modalClass}' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title'>{#modalTitle#}</h5>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body' id='gridModalContent'>
        {$modalContent}
      </div>
    </div>
  </div>
</div>

{literal}
<script type="text/Javascript">
$(document).ready(function() {
    // Sincronizar los dos cuadros de texto de navegación al escribir
    $("[id^=page]").keyup(function(event) {
        var id  = $(this).attr("id");
        var val = $(this).val();

        if(id == "pageup")
            $("#pagedown").val(val);
        else if(id == "pagedown")
            $("#pageup").val(val);
    });

    $("#neo-table-filter-button-arrow").click(function() {
{/literal}
    {if $AS_OPTION}
        var filter_show = "{$MORE_OPTIONS}";
        var filter_hide = "{$MORE_OPTIONS}";
    {else}
        var filter_show = "{$FILTER_GRID_SHOW}";
        var filter_hide = "{$FILTER_GRID_HIDE}";
    {/if}
{literal}

        if($("#neo-table-header-filterrow").data("neo-table-header-filterrow-status")=="visible") {
            $("#neo-table-header-filterrow").addClass("neo-display-none");
            $("#neo-table-label-filter").text(filter_show);
            $("#neo-table-filter-button-arrow i").removeClass("fa-caret-up");
            $("#neo-table-filter-button-arrow i").addClass("fa-caret-down");
            $("#neo-table-header-filterrow").data("neo-table-header-filterrow-status", "hidden");
        } else {
            $("#neo-table-header-filterrow").removeClass("neo-display-none");
            $("#neo-table-label-filter").text(filter_hide);
            $("#neo-table-filter-button-arrow i").removeClass("fa-caret-down");
            $("#neo-table-filter-button-arrow i").addClass("fa-caret-up");
            $("#neo-table-header-filterrow").data("neo-table-header-filterrow-status", "visible");
        }
    });

    $('form.issabel-standard-formgrid>table.issabel-standard-table').each(function() {
        var wt = $(this).find('thead>tr').width();
        $(this).find('thead>tr>th').each(function () {
            var wc = $(this).width();
            var pc = 100.0 * wc / wt;
            $(this).width(pc + "%");
        });
        $(this).colResizable({
            liveDrag:   true,
            marginLeft: "0px"
        });
    });
});
{/literal}

{$customJS}

{literal}
</script>
{/literal}

