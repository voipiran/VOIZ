{section name=columnNum loop=$numColumns start=0 step=1}"{$header[$smarty.section.columnNum.index].name}",{/section}

{foreach from=$arrData key=k item=data name=filas}{section name=columnNum loop=$numColumns start=0 step=1}"{$data[$smarty.section.columnNum.index]}",{/section}

{/foreach}
