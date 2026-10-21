<div id="controlPanelApplication">

<script type="text/x-handlebars" data-template-name="desktop">
<div style="float: right;margin-left:14px;margin-right:26px">
<div class="statusbar">
<!-- TODO: i18n -->
{literal}
{{#if connected}}
<span style="color: green; font-weight: bold;">Connected</span>
{{else}}
<span style="color: red; font-weight: bold;">Connecting...</span>
{{/if}}
{/literal}
</div>
{literal}{{#view App.BaseSortableView }}{/literal}

{* La lista de las extensiones no asignadas a alguna de las áreas *}
{literal}
{{#view App.PBXPanelView controllerBinding="extensions" }}
	{/literal}{$AREA_DESCR_EXTENSION}{literal}
	{{#if finishedloading}}
	{{#view App.SortablePanelView }}
		{{#each }}
		{{view App.ExtensionView }}
		{{else}}
		<br/>
		{{/each}}
	{{/view}}
	{{else}}
	<img class="icon" src="modules/{/literal}{$module_name}{literal}/images/loading.gif"/>
	{{/if}}
{{/view}}
{/literal}

{* La lista de las troncales DAHDI *}
{literal}
{{#view App.PBXPanelView controllerBinding="dahdi" }}
    {/literal}{$AREA_DESCR_TRUNKS}{literal}
    {{#if finishedloading}}
	<div>
		{{#each }}
		{{view App.DAHDISpanView }}
		{{else}}
		<br/>
		{{/each}}
    </div>
    {{else}}
    <img class="icon" src="modules/{/literal}{$module_name}{literal}/images/loading.gif"/>
    {{/if}}
{{/view}}
{/literal}

{* La lista de las troncales VoIP *}
{literal}
{{#view App.PBXPanelView controllerBinding="iptrunks" }}
	{/literal}{$AREA_DESCR_TRUNKSSIP}{literal}
	{{#if finishedloading}}
	<div>
		{{#each }}
		{{view App.IPTrunkView }}
		{{else}}
		<br/>
		{{/each}}
	</div>
    {{else}}
    <img class="icon" src="modules/{/literal}{$module_name}{literal}/images/loading.gif"/>
    {{/if}}
{{/view}}
{/literal}

{literal}{{/view}}{/literal}{* App.BaseSortableView *}
</div>


{literal}{{#view App.FAQView }}{/literal}
{literal}{{#view App.BaseSortableView }}{/literal}

{* La lista de las extensiones asignadas al área 1 *}
{literal}
{{#view App.PBXPanelView controllerBinding="area1" }}
	{{view App.EditableTitleView }}
	<dd>
	{{#if finishedloading}}
	{{#view App.SortablePanelView }}
		{{#each }}
		{{view App.ExtensionView}}
		{{else}}
		<br/>
		{{/each}}
	{{/view}}
    {{else}}
    <img class="icon" src="modules/{/literal}{$module_name}{literal}/images/loading.gif"/>
    {{/if}}
	</dd>
{{/view}}
{/literal}


{* La lista de las extensiones asignadas al área 2 *}
{literal}
{{#view App.PBXPanelView controllerBinding="area2" }}
	{{view App.EditableTitleView }}
	<dd>
	{{#if finishedloading}}
	{{#view App.SortablePanelView }}
		{{#each }}
		{{view App.ExtensionView}}
		{{else}}
		<br/>
		{{/each}}
	{{/view}}
    {{else}}
    <img class="icon" src="modules/{/literal}{$module_name}{literal}/images/loading.gif"/>
    {{/if}}
	</dd>
{{/view}}
{/literal}

{* La lista de las extensiones asignadas al área 3 *}
{literal}
{{#view App.PBXPanelView controllerBinding="area3" }}
	{{view App.EditableTitleView }}
	<dd>
	{{#if finishedloading}}
	{{#view App.SortablePanelView }}
		{{#each }}
		{{view App.ExtensionView}}
		{{else}}
		<br/>
		{{/each}}
	{{/view}}
    {{else}}
    <img class="icon" src="modules/{/literal}{$module_name}{literal}/images/loading.gif"/>
    {{/if}}
	</dd>
{{/view}}
{/literal}

{* La lista de las conferencias *}
{literal}
{{#view App.PBXPanelView controllerBinding="conferences" }}
	<dt>{{description}}</dt>
	<dd>
	{{#if finishedloading}}
	<div>
		{{#each }}
		{{view App.ConferenceView}}
		{{else}}
		<br/>
		{{/each}}
	</div>
    {{else}}
    <img class="icon" src="modules/{/literal}{$module_name}{literal}/images/loading.gif"/>
    {{/if}}
	</dd>
{{/view}}
{/literal}

{* La lista de los parqueos *}
{literal}
{{#view App.PBXPanelView controllerBinding="parkinglots" }}
	<dt>{{description}}</dt>
	<dd>
	{{#if finishedloading}}
	<div>
		{{#each }}
		{{view App.ParkinglotView}}
		{{else}}
		<br/>
		{{/each}}
	</div>
    {{else}}
    <img class="icon" src="modules/{/literal}{$module_name}{literal}/images/loading.gif"/>
    {{/if}}
	</dd>
{{/view}}
{/literal}

{* La lista de las colas *}
{literal}
{{#view App.PBXPanelView controllerBinding="queues" }}
	<dt>{{description}}</dt>
	<dd>
	{{#if finishedloading}}
	<div>
		{{#each }}
		{{view App.QueueView}}
		{{else}}
		<br/>
		{{/each}}
	</div>
    {{else}}
    <img class="icon" src="modules/{/literal}{$module_name}{literal}/images/loading.gif"/>
    {{/if}}
	</dd>
{{/view}}
{/literal}

{literal}{{/view }}{/literal} {* App.BaseSortableView *}
{literal}{{/view}}{/literal} {* App.FAQView *}
</script><!-- data-template-name="desktop"  -->

<script type="text/x-handlebars" data-template-name="extension">
<div style="float:left; border: black solid 0px;">
	<a class="pbxtooltip" href="#">
	<img src="modules/{$module_name}/images/info.png"/>
	<div>
		{literal}
		{{extension}}: {{channel}} - {{description}} {{#if registered}}({{ip}}){{/if}}<br/>
		{{#if active }}
		<ul>
	    {{#each active}}
	    <li>{{formatSince}}: {{remoteExten}}</li>
	    {{/each}}
	    </ul>
	    {{/if}}
		{/literal}
	</div>
	</a>
</div>
<div style="float:left; width:115px; text-align:left; padding-left:4px;">
	{literal}
	<b>{{extension}}:</b> {{view.truncatedDescription}}<br/>
	{{#each active}}
	<span class="monitor">{{formatSince}}: {{remoteExten}}</span><br/>
	{{/each}}
	{/literal}
</div>
{literal}
<div style="float: right; border: black solid 0px;">
	{{view App.DraggablePhoneIconView iconBinding="view.extensionIcon" }}
</div>
{{#if unreadMail }}
<div style="float: right; border: black solid 0px;">
	<a class="pbxtooltip" href="#" {{action "dialvoicemail" this on="doubleClick"}}>
		<img class="icon" src="modules/{/literal}{$module_name}{literal}/images/mail.png"/>
		<div>{/literal}{$LBL_NEW}{literal}: {{NewMessages}}, {/literal}{$LBL_OLD}{literal}: {{OldMessages}}</div>
    </a>
</div>
{{/if}}
{/literal}
</script>


<script type="text/x-handlebars" data-template-name="iptrunk">
<div style="float:left; border: black solid 0px;">
    <a class="pbxtooltip" href="#">
    <img src="modules/{$module_name}/images/info.png"/>
    <div>
        {literal}
        {{channel}} {{#if registered}}({{ip}}){{/if}}<br/>
        {{#if active}}
        <ul>
	    {{#each active}}
	    <li>{{formatSince}}: {{CallerIDNum}}</li>
	    {{/each}}
	    </ul>
	    {{/if}}
        {/literal}
    </div>
    </a>
</div>
<div style="float:left; width:115px; text-align:left; padding-left:4px;">
    {literal}
    <b>{{view.truncatedDescription}}</b><br/>
    {{#each active}}
    <span class="monitor">{{formatSince}}: {{CallerIDNum}}</span><br/>
    {{/each}}
    {/literal}
</div>
{literal}
<div style="float: right; border: black solid 0px;">
    <img class="icon" src="modules/{/literal}{$module_name}{literal}/images/icon_trunk2.png"/>
</div>
{/literal}
</script>


<script type="text/x-handlebars" data-template-name="dahdispan">
<div style="float:left; border: black solid 0px;">
    <a class="pbxtooltip" href="#">
    <img src="modules/{$module_name}/images/info.png"/>
    <div>
        {literal}
        DAHDI/{{span}}: {{formatChanRange}}<br/>

        <!-- Mostrar los números de los canales en la alarma -->
        {{#each chan}}<span {{bindAttr style="alarmstyle"}}>{{chan}}</span>{{/each}}
        
        <!-- Mostrar las llamadas activas no clasificadas en un canal canal -->
        {{#if active}}
        <ul>
        {{#each active}}
        <li>{{formatSince}}: {{CallerIDNum}}</li>
        {{/each}}
        </ul>
        {{/if}}

        <!-- Mostrar las llamadas activas en cada canal -->
        <ul>
        {{#each chan}}
            {{#if active }}
	            <li>{{chan}}:
	            {{#each active}}
	                {{formatSince}}: {{CallerIDNum}}
	            {{else}}
	                (idle)
	            {{/each}}
	            </li>
            {{/if}}
        {{/each}}
        </ul>
        {/literal}
    </div>
    </a>
</div>
<div style="float:left; width:135px; text-align:left; padding-left:4px;">
    {literal}
    <b>DAHDI/{{span}}:</b> {{formatChanRange}}<br/>
    {/literal}
</div>
<div style="float: right; border: black solid 0px;">
    <img class="icon" src="modules/{$module_name}/images/icon_trunk2.png"/>
</div>
</script>


<script type="text/x-handlebars" data-template-name="queue">
<div style="float:left; border: black solid 0px;">
	<a class="pbxtooltip" href="#">
	<img src="modules/{$module_name}/images/info.png"/>
	<div>
		{literal}
		{{extension}}: {{description}}<br/>
		{{#if members}}
		{/literal}{$LBL_QUEUE_MEMBERS}{literal}:<br/>
		<ul>
		{{#each members}}<li>{{shortchannel}}</li>{{/each}}
		</ul>
		{{else}}
		{/literal}{$LBL_QUEUE_NO_MEMBERS}{literal}
		{{/if}}
		<br/>
		{{#if callers}}
		{/literal}{$LBL_QUEUE_CALLERS}{literal}:<br/>
		<ul>
		{{#each callers}}
		<li>{{CallerIDName}} &lt;{{CallerIDNum}}&gt;</li>
		{{/each}}
		</ul>
		{{else}}
		{/literal}{$LBL_QUEUE_NO_CALLERS}{literal}
		{{/if}}
		{/literal}
	</div>
	</a>
</div>
<div style="float:left; width:135px; text-align:left; padding-left:4px;">
	{literal}
	<b>{{extension}}:</b> {{view.truncatedDescription}}<br/>
	{{#if callers }}
	<span class="monitor">{{callers.length}}</span><br/>
	{{/if}}
	{/literal}
</div>
<div style="float: right; border: black solid 0px;">
    {literal}{{view App.DroppableIconView icon="{/literal}modules/{$module_name}/images/queue.png{literal}" }}{/literal}
</div>
</script>


<script type="text/x-handlebars" data-template-name="conference">
<div style="float:left; border: black solid 0px;">
	<a class="pbxtooltip" href="#">
	<img src="modules/{$module_name}/images/info.png"/>
	<div>
		{literal}
		{{extension}}: {{description}}<br/>
		{{#if callers}}
		{/literal}{$LBL_QUEUE_CALLERS}{literal}:<br/>
		<ul>
		{{#each callers}}
		<li>{{CallerIDName}} &lt;{{CallerIDNum}}&gt;</li>
		{{/each}}
		</ul>
		{{else}}
		{/literal}{$LBL_QUEUE_NO_CALLERS}{literal}
		{{/if}}
		{/literal}
	</div>
	</a>
</div>
<div style="float:left; width:135px; text-align:left; padding-left:4px;">
	{literal}
	<b>{{extension}}:</b> {{view.truncatedDescription}}<br/>
	{{#if callers }}
	<span class="monitor">{/literal}{$LBL_CONF_PARTICIPANTS}{literal}: {{callers.length}} - {{formatSince}}</span><br/>
	{{/if}}
	{/literal}
</div>
<div style="float: right; border: black solid 0px;">
    {literal}{{view App.DroppableIconView icon="{/literal}modules/{$module_name}/images/conference.png{literal}" }}{/literal}
</div>
</script>


<script type="text/x-handlebars" data-template-name="parkinglot">
<div style="float:left; border: black solid 0px;">
	<a class="pbxtooltip" href="#">
	<img src="modules/{$module_name}/images/info.png"/>
	<div>
		{literal}
		{{extension}}
		{/literal}
	</div>
	</a>
</div>
<div style="float:left; width:135px; text-align:left; padding-left:4px;">
	{literal}
	<b>{/literal}{$LBL_PARKED}{literal} ({{extension}})</b><br/>
	{{#if shortchannel }}
	<span class="monitor">{{shortchannel}}: {{formatTimeout}}</span><br/>
	{{/if}}
	{/literal}
</div>
<div style="float: right; border: black solid 0px;">
	{literal}{{view App.DroppableIconView icon="{/literal}modules/{$module_name}/images/parking.png{literal}" }}{/literal}
</div>
</script>


<script type="text/x-handlebars" data-template-name="editable-title">
{literal}
{{#if editing }}
{{view Ember.TextField valueBinding="description" }}
<button {{action "save" bubbles=false }}>{/literal}{$LBL_SAVE_NAME}{literal}</button>
{{else}}
{{description}} -- {{length}} ext
<span class="paneledittitle" {{action "edit" bubbles=false }}>[{/literal}{$LBL_EDIT_NAME}{literal}]</span>
{{/if}}
{/literal}
</script>

</div>
<script type="text/javascript">
var arrLang_main = {$ARRLANG_MAIN};
var var_init = {$VAR_INIT}
</script>
