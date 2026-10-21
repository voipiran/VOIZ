{literal}
    <script type='text/javascript'>
        var themeName = 'elastixneo'; //nombre del tema
        $(document).ready(function () {
            $("#togglebookmark").click(function () {
                var imgBookmark = $("#togglebookmark").attr('src');
                if (/bookmarkon.png/.test(imgBookmark)) {
                    $("#togglebookmark").attr('src', "web/themes/" + themeName + "/images/bookmark.png");
                } else {
                    $("#togglebookmark").attr('src', "web/themes/" + themeName + "/images/bookmarkon.png");
                }
            });
            $("#export_button").hover(
                    function () {
                        $(this).addClass("exportBorder");
                    },
                    function () {
                        $(this).removeClass("exportBorder");
                        $(this).attr("aria-expanded", "false");
                        $(this).removeClass("exportBackground");
                        $(".letranodec").css("color", "#444444");
                        $("#subMenuExport").addClass("neo-display-none");
                    }
            );
            $("#neo-table-button-download-right").click(
                    function () {
                        if ($(this).attr("aria-expanded") == "false") {
                            var exportPosition = $('#export_button').position();
                            var top = exportPosition.top + 41;
                            var left = exportPosition.left - 3;
                            $("#subMenuExport").css('top', top + "px");
                            $("#subMenuExport").css('left', left + "px");
                            $(this).attr("aria-expanded", "true");
                            $(this).addClass("exportBackground");
                            $(".letranodec").css("color", "#FFFFFF");
                            $("#subMenuExport").removeClass("neo-display-none");
                        } else {
                            $(".letranodec").css("color", "#444444");
                            $("#subMenuExport").addClass("neo-display-none");
                            $(this).removeClass("exportBackground");
                            $(this).attr("aria-expanded", "false");
                        }
                    }
            );
			
            $("#subMenuExport").hover(
                    function () {
                        $(this).removeClass("neo-display-none");
                        $(".letranodec").css("color", "#FFFFFF");
                        $("#export_button").attr("aria-expanded", "true");
                        $("#export_button").addClass("exportBackground");
                    },
                    function () {
                        $(this).addClass("neo-display-none");
                        $(".letranodec").css("color", "#444444");
                        $("#export_button").removeClass("exportBackground");
                        $("#export_button").attr("aria-expanded", "false");
                    }
            );
            $('#header_open_sidebar, a.chat-close').click(function (e) {
                $('div.page-container').toggleClass('chat-visible');
                toggle_sidebar_menu(true);
                e.stopPropagation();
            });
        });
        function removeNeoDisplayOnMouseOut(ref) {
            $(ref).find('div').addClass('neo-display-none');
        }
        function removeNeoDisplayOnMouseOver(ref) {
            $(ref).find('div').removeClass('neo-display-none');
        }
        function setQueueDashboardUrl() {
            var xaddr = "https://" + window.location.hostname + ":9001/dashboard";
            $("#queue_dashboard_link").attr("href", xaddr);
        }
        function gotocrm() {
            var obj = $("#crm_link");
            var xaddr = "https://" + window.location.hostname + "/crm";
            $(obj).attr("href", xaddr);
        }
        function gotowebphone() {
            var obj = $("#webphone_link");
            var xaddr = "https://" + window.location.hostname + "/phone";
            $(obj).attr("href", xaddr);
        }
        $(document).ready(
                function ()
                {
                    setQueueDashboardUrl();
                    gotocrm();
                    gotowebphone();
                }
        );
    </script>
{/literal}
<input type="hidden" id="lblRegisterCm" value="{$lblRegisterCm}" />
<input type="hidden" id="lblRegisteredCm" value="{$lblRegisteredCm}" />
<input type="hidden" id="userMenuColor" value="{$MENU_COLOR}" />
<input type="hidden" id="lblSending_request" value="{$SEND_REQUEST}" />
<input type="hidden" id="toolTip_addBookmark" value="{$ADD_BOOKMARK}" />
<input type="hidden" id="toolTip_removeBookmark" value="{$REMOVE_BOOKMARK}" />
<input type="hidden" id="toolTip_addingBookmark" value="{$ADDING_BOOKMARK}" />
<input type="hidden" id="toolTip_removingBookmark" value="{$REMOVING_BOOKMARK}" />
<input type="hidden" id="toolTip_hideTab" value="{$HIDE_IZQTAB}" />
<input type="hidden" id="toolTip_showTab" value="{$SHOW_IZQTAB}" />
<input type="hidden" id="toolTip_hidingTab" value="{$HIDING_IZQTAB}" />
<input type="hidden" id="toolTip_showingTab" value="{$SHOWING_IZQTAB}" />
<input type="hidden" id="amount_char_label" value="{$AMOUNT_CHARACTERS}" />
<input type="hidden" id="save_note_label" value="{$MSG_SAVE_NOTE}" />
<input type="hidden" id="get_note_label" value="{$MSG_GET_NOTE}" />
<input type="hidden" id="issabel_theme_name" value="{$THEMENAME}" />
<input type="hidden" id="lbl_no_description" value="{$LBL_NO_STICKY}" />
<input type="hidden" id="version" value="{$VERSION}" />
<!-- inicio del menú tipo acordeon-->
<div class="sidebar-menu">
    <header class="logo-env">
        <!-- logo -->
        <div class="logo">
            <a href="#">
                <img src="{$WEBPATH}themes/{$THEMENAME}/images/logov.png" width="40" alt="" />
            </a>
        </div>
        <!-- logo collapse icon -->
        <div class="sidebar-collapse">
            <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                <i class="entypo-menu"></i>
            </a>
        </div>
        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>
    <ul id="main-menu" class="main-menu">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
        <!-- Search Bar -->
        <li id="search">
            <form method="get" action="">
                <input type="text" id="search_module_issabel" name="search_module_issabel" class="search-input" placeholder="{$MODULES_SEARCH}"/>
                <button type="submit">
                    <i class="entypo-search"></i>
                </button>
            </form>
        </li>
        <!--recorremos el arreglo del menu nivel primario-->
        {foreach from=$arrMainMenu key=idMenu item=menu name=menuMain}
            {if $idMenu eq $idMainMenuSelected}
                <li class="active opened active">
                {else}
                <li>
                {/if}
                <a href="index.php?menu={$idMenu}">
                    <i class="{$menu.icon}"></i>
                   <!--<span>{$idMenu}</span>-->
                   <!--<span>{$menu.description}</span>-->
                    <span>{$menu.Name}</span>
                </a>
                <ul>
                    <!--recorremos el arreglo del menu nivel secundario-->
                    {foreach from=$menu.children key=idSubMenu item=subMenu}
                        {if $idSubMenu eq $idSubMenuSelected}
                            <li class="active opened active">
                            {else}
                            <li>
                            {/if}
                            <a href="index.php?menu={$idSubMenu}">
                                <i class="{$subMenu.icon}"></i>
                                <!--<span>{$idSubMenu}</span>-->
                                <!--<span>{$subMenu.description}</span>-->
                                <span>{$subMenu.Name}</span>
                            </a>
                            {if $subMenu.children}
                                <ul>
                                    <!--recorremos el arreglo del menu de tercer nivel-->
                                    {foreach from=$subMenu.children key=idSubMenu2 item=subMenu2}
                                        <li>
                                            <a href="index.php?menu={$idSubMenu2}">
                                                <!--<span>{$idSubMenu2}</span>-->
                                                <!--<span>{$subMenu2.description}</span>-->
                                                <span>{$subMenu2.Name}</span>
                                            </a>
                                        </li>
                                    {/foreach}
                                </ul>
                            {/if}
                        </li>
                    {/foreach}
                </ul>
            </li>
        {/foreach}
        {$SHORTCUT}
    </ul>
</div>
<!-- fin del menú tipo acordeon-->
<!-- inicio del head principal-->
<div class="main-content">
    <div class="voiz-top-header" style="height:68px; padding:10px;">
        <!-- Profile Info and Notifications -->
        <span style='float:left; text-align:right; padding:0px 5px 0px 0px; width:175px;' class="col-md-6 col-sm-8 clearfix voiz-topbar-user">
            <ul style='' class="user-info pull-none-xsm">
                <!-- Profile Info -->
                <li class="profile-info dropdown pull-right"><!-- add class "pull-right" if you want to place this from right -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!--<img style="border:0px" src="index.php?menu=_issabelutils&action=getImage&ID={$USER_ID}&rawmode=yes" alt="" class="img-circle" width="44" />-->
                        <img style="border:0px" src="/themes/{$THEMENAME}/images/Icon-user.png" alt="" class="img-circle" width="44" />
                        {$USER_LOGIN}
                    </a>
                    <!-- Reverse Caret -->
                    <i style='font-size:15px;font-weight:bold;' class="fa fa-angle-down"></i>
                    <!-- Profile sub-links -->
                    <ul class="dropdown-menu">
                        <!-- Reverse Caret -->
                        <li class="caret"></li>
                        <!-- Profile sub-links -->
                        <li class="dropdown">
                            <a href="#" class="setadminpassword">
                                <i class="fa fa-user"></i>
                                {$CHANGE_PASSWORD}
                            </a>
                        </li>
                        <li class="dropdown">
                            <a {*data-toggle="dropdown"*} href="index.php?logout=yes" {*style="background-color: red"*}>
                                <i class="fa fa-sign-out"></i>
                                {$LOGOUT}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </span>
        <!-- Raw Links -->
        <span class="voiz-topbar-actions-container" style=' width:400px;'>
            <ul style="padding-top:12px;" class="list-inline links-list pull-right neo-topbar-notification">
                <!--li id="header_notification_bar" class="dropdown">
                    <a {*data-toggle="dropdown"*} class="" href="index.php?menu=addons">
                        <i class="fa fa-cubes"></i>
                    </a>
                </li-->
                <!-- notification dropdown start-->
                <!--li id="header_notification_bar" class="dropdown">
                    <a data-toggle="dropdown" class="" href="#">
                        <i class="fa fa-heartbeat"></i>
                    </a>
                </li-->
                <!-- <li id="header_notification_bar" class="profile-info dropdown"> -->
                 <!-- <a target="_blank" id="crm_link" class="" href=""> -->
                <!-- <img style="width:16px;" src="{$WEBPATH}themes/{$THEMENAME}/images/crm.png" /> -->
               <!-- </a> -->
              <!-- </li> -->
                <li id="header_notification_bar" class="profile-info dropdown top-bar-info"> <!-- voipiran msm -->
                    <a data-toggle="dropdown" class="" href="#">
                        <i class="fa fa-info-circle"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Reverse Caret -->
                        <li class="caret"></li>
                        <!-- Profile sub-links -->
                        <li><a href="#" class="register_link">{$Registered}</a></li>
                        <li><a href="#" id="viewDetailsRPMs"><i class="fa fa-cube"></i>{$VersionDetails}</a></li>
                        <li><a href="http://www.voipiran.io" target="_blank"><i class="fa fa-external-link"></i>VOIPIRAN Website</a></li>
                        <li><a href="#" id="dialogaboutissabel"><i class="fa fa-info-circle"></i>{$ABOUT_ISSABEL2}</a></li>
                    </ul>
                </li>
                {if $ISSABEL_PANELS}
                    <!-- SIDEBAR LIST -->
                    <li id="header_open_sidebar">
                        <a href="#" data-toggle="chat" data-collapse-sidebar="1"><i class="fa fa-th-list"></i></a>
                    </li>
                {/if}
                <!-- Call center dashboard -->
                <li id="header_notification_bar" class="profile-info dropdown top-bar-queue">
                    <a id="queue_dashboard_link" href="#" target="_blank" rel="noopener" title="مرکز تماس" aria-label="مرکز تماس">
                        <i class="fa fa-headphones" aria-hidden="true"></i>
                    </a>
                </li>
				
<!-- Webphone Button – باز شدن در تب جدید -->
<li class="profile-info dropdown top-bar-webphone">
    <a id="webphone_link" href="https://{$SERVER_NAME}/phone" target="_blank" rel="noopener">
        <i class="fa fa-phone"></i>
    </a>
</li>
				
            </ul>
        </span>
        <div class="logo voiz-topbar-logo">
            <a href="#">
                <img style="height:60px;" src="{$WEBPATH}themes/{$THEMENAME}/images/logo-light.png" alt="voiz" />
</a>
<!------ VOIPIRAN version ----->
<kbd>version {$VERSION}</kbd>
 
</div>
    </div>
    <!-- Breadcrumb 3 -->
    <ol class="breadcrumb bc-2">
        {foreach from=$BREADCRUMB item=value name=menu}
            {if $smarty.foreach.menu.first}
                <li>
                    <a href="/"> <i class="entypo-home"></i></a>
                    <a href="#"> {$value}</a>
                </li>
            {elseif $smarty.foreach.menu.last}
                <li class="active"><strong>{$value}</strong></li>
                    {else}
                <li><a href="#">{$value}</a></li>
                {/if}
            {/foreach}
        <li id="tenant-help">
            <a class="" href="#" onclick="popUp('help/?id_nodo={if !empty($idSubMenu2Selected)}{$idSubMenu2Selected}&name_nodo={$nameSubMenu2Selected}{else}{$idSubMenuSelected}&name_nodo={$nameSubMenuSelected}{/if}', '1000', '460')">
                <!--a href="https://www.voipiran.io" target="_bank"-->
                <i class="fa fa-support"></i>
            </a>
        </li>
        <li id="tenant-sticky" class="dropdown">
            <a id="togglestickynote1" href="#">
                <i class="fa fa-sticky-note"></i>
            </a>
        </li>
    </ol>
    <!-- contenido del modulo-->
    <div id="neo-contentbox">
        <div id="neo-contentbox-maincolumn">
            <input type="hidden" id="issabel_framework_module_id" value="{if empty($idSubMenu2Selected)}{$idSubMenuSelected}{else}{$idSubMenu2Selected}{/if}" />
            <input type="hidden" id="issabel_framework_webCommon" value="{$WEBCOMMON}" />
            <div class="neo-module-content">