<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Issabel</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/bootstrap.css">
    <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-core.css">
    <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-theme.css">
    <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/neon-forms.css">
    <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/font-awesome-animation.min.css">
    <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/custom.css">

    <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/styles.css" />
    <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/widgets.css" />
    <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/help.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="{$WEBPATH}themes/{$THEMENAME}/header.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="{$WEBPATH}themes/{$THEMENAME}/content.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="{$WEBPATH}themes/{$THEMENAME}/applet.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="{$WEBPATH}libs/js/sticky_note/sticky_note.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="{$WEBPATH}themes/{$THEMENAME}/table.css" />
    <link rel="stylesheet" media="screen" type="text/css" href="{$WEBPATH}themes/{$THEMENAME}/rightbar.css" />
    <link rel="stylesheet" href="{$WEBPATH}themes/{$THEMENAME}/css/purple.css">

    {$HEADER_LIBS_JQUERY}
    <script src="libs/js/base.js"></script>
    <script src="libs/js/sticky_note/sticky_note.js"></script>
    <script src="libs/js/iframe.js"></script>

    {$HEADER}
    {$HEADER_MODULES}
    </head>
    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="mainBody page-body" {$BODYPARAMS}>
    <div class="page-container">

        {$MENU} <!-- Viene del tpl menu.tlp-->
                    {if !empty($mb_message)}
                    <div class="div_msg_errors" id="message_error">
                    {if !empty($mb_title)}
                        <div class="div_msg_errors_title">
                            <b style="color:red;">&nbsp;{$mb_title}</b>
                        </div>
                    {/if}
                        <div class="div_msg_errors_dismiss"><i class="fa fa-lg fa-remove" onclick="hide_message_error();"></i></div>
                        <div class="div_msg_errors_content" {if empty($mb_title)}style="margin-left: 0;"{/if}>{$mb_message}</div>
                    </div>
                    {/if}
                    {$CONTENT}
                </div>
            </div>
        </div><!-- neo-contentbox -->

        <!-- Footer -->
        <footer class="main" style="margin-left:16px;">
            <a href="http://www.issabel.org" style="color: #444; text-decoration: none;" target='_blank'>Issabel</a> {$ISSABEL_LICENSED} <a href="http://www.opensource.org/licenses/gpl-license.php" target='_blank' style="color: #445; text-decoration: none;" >GPL</a>. 2006 - {$currentyear}.
        </footer>

        {*<br />*}
        </div><!-- main-content -->

        <div id="neo-sticky-note">
            <div id="neo-sticky-note-text"></div>
            <div id="neo-sticky-note-text-edit">
                <textarea id="neo-sticky-note-textarea"></textarea>
                <div id="neo-sticky-note-text-char-count"></div>
                <input type="button" value="{$SAVE_NOTE}" id="neo-submit-button" />
                <div id="auto-popup">AutoPopUp <input type="checkbox" id="neo-sticky-note-auto-popup" value="1" /></div>
            </div>
            <div id="neo-sticky-note-text-edit-delete"></div>
        </div>
{* SE GENERA EL AUTO POPUP SI ESTA ACTIVADO *}
{if $AUTO_POPUP eq '1'}{literal}
<script type='text/javascript'>
$(document).ready(function(e) {
    $("#neo-sticky-note-auto-popup").prop('checked', true);
    $('#togglestickynote1').click();
});
</script>
{/literal}{/if}

        <!-- Neo Progress Bar -->
        <div class="neo-modal-issabel-popup-box">
            <div class="neo-modal-issabel-popup-title"></div>
            <div class="neo-modal-issabel-popup-close"></div>
            <div class="neo-modal-issabel-popup-content"></div>
        </div>
        <div class="neo-modal-issabel-popup-blockmask"></div>
{if $ISSABEL_PANELS}
        <div id="chat" class="fixed">
            <div class="chat-inner">
                <h2 class="chat-header">
                    <a href="#" class="chat-close"><i class="entypo-cancel"></i></a>
                    <i class="entypo-users"></i>
                    {* TODO: i18n *}
                    <span id="panel-header-text">{$LBL_ISSABEL_PANELS_SIDEBAR|escape:html}</span>
                </h2>
                <div id="issabel-panels" class="panel-group joined">
                    {foreach from=$ISSABEL_PANELS key=panelname item=paneldata name=issabelpanel}
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#issabel-panels" href="#issabel-panel-{$panelname}">
                                    {if $paneldata.iconclass}
                                    <i class="{$paneldata.iconclass}"></i>
                                    {elseif $paneldata.icon}
                                    <div style="display: inline-block; min-width: 15px; min-height: 15px; padding-right: 5px;">
                                    <img alt="" src="{$paneldata.icon}" width="15" />
                                    </div>
                                    {else}
                                    <i class="fa fa-file-o"></i>
                                    {/if}
                                    <span>{$paneldata.title|escape:html}</span>
                                </a>
                            </h4>
                        </div>
                        <div id="issabel-panel-{$panelname}" class="panel-collapse collapse{if $smarty.foreach.issabelpanel.first} in{/if}">
                            <div class="panel-body">{$paneldata.content}</div>
                        </div>
                    </div>
                    {/foreach}
                </div>
            </div>
        </div>
{/if}
        <!-- Bottom Scripts -->
        <script src="{$WEBPATH}themes/{$THEMENAME}/js/gsap/main-gsap.js"></script>
        <script src="{$WEBPATH}themes/{$THEMENAME}/js/bootstrap.js"></script>
        <script src="{$WEBPATH}themes/{$THEMENAME}/js/joinable.js"></script>
        <script src="{$WEBPATH}themes/{$THEMENAME}/js/resizeable.js"></script>
        <script src="{$WEBPATH}themes/{$THEMENAME}/js/neon-api.js"></script>
        <script src="{$WEBPATH}themes/{$THEMENAME}/js/jquery.validate.min.js"></script>
        <script src="{$WEBPATH}themes/{$THEMENAME}/js/neon-login.js"></script>
        <script src="{$WEBPATH}themes/{$THEMENAME}/js/neon-custom.js"></script>
        <script src="{$WEBPATH}themes/{$THEMENAME}/js/neon-demo.js"></script>
    </div>
</body>
</html>
