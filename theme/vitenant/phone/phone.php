<?php
include "helper.php";
$extension = sqliteExtensionFind($_COOKIE['issaUser']);
if(!$extension)
    exit;
$password = getAsteriskExtensionPassword($extension);
?>  
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="phone.css">
    <link rel="icon" href="images/favicon.png">
	    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">

    <script defer src="js/ac_webrtc.min.js"></script>
    <script defer src="js/utils.js"></script>
    <script defer src="js/tracer.js"></script>
    <script defer src="config.js"></script>
    <script defer src="phone.js"></script>
</head>

<body onload="documentIsReady()" style="background-color:#373e4a;">
    
    <script>
        const serverName = "<?php echo $_SERVER['SERVER_NAME']; ?>";
        
        let DefaultServerConfig = {
            domain: serverName,
            addresses: ['wss://' + serverName + ':8089/ws'],
            iceServers: [],
            version: '10-Sep-2023'
        }        
        
        let DefaultUserConfig = {
            user: "<?php echo $extension; ?>",
            authUser: "<?php echo $extension; ?>",
            password:"<?php echo $password; ?>",
            displayName: "<?php echo $extension; ?>"
        }
        
        //Check that browser is not IE

        var ua = window.navigator.userAgent;
        if (ua.indexOf('MSIE ') > 0 || ua.indexOf('Trident/') > 0) {
            alert("Internet Explorer is not supported. Please use Chrome or Firefox");
        }
    </script>

    <!--
        HTML components of simple GUI
    -->
    <div> 
        <button class="badge bg-primary" id="devices_btn" title="Select microphone, speaker, camera">تجهیزات</button>

        <span class="badge bg-primary" id="status_line"> </span>
        <span class="badge bg-warning" id="outgoing_call_user"> </span>
        <span class="badge bg-success" id="outgoing_call_progress"> </span>
        <span class="badge bg-info" id="call_established_user"> </span>
        <span class="badge bg-danger" id="incoming_call_user"> </span>
        
        <span id="dialer_panel" class="panel">
            <button style="display: none;" id="settings_btn" title="Settings">تنظیمات</button>
            <button style="display: none;" id="call_log_btn" title="Call log">لاگ تماس</button>
            <button  style="display: none;"  class="btn btn-sm btn-secondary" id="redial_last_call_btn" title="Redial last call">تکرار تماس</button>
            <button style="display: none;" id="message_btn" title="View/Send Messages">پیام ها</button>
            <button style="display: none;" id="subscribe_btn" title="Subscribe/Notify dialog test">Subscribe</button>
            <button class="btn btn-sm btn-secondary" id="enable_sound_btn" title="Press to enable sound">فعال سازی صدا</button>
            <button class="btn btn-sm btn-secondary" id="notification_permission_btn" title="Press to set notification permission">Enable incoming call Notification</button>
                <form id="call_form" onsubmit="event.preventDefault()">
                    <table>
                        <tr>
                            <td>
                                <input class="form-control form-control-sm" type="text" name="call_to">
                            </td>
                            <td>
                                <input class="btn btn-sm btn-primary" id="audio_call_btn" type="button" value="شروع تماس">
                            </td>
                            <td>
                                <input style="display: none;" id="video_call_btn" type="button" value="Video">
                            </td>
                        </tr>
                    </table>
                </form>
        </span>
    </div>            


    <!-- All panels are hidden, except one  -->
    <div id="panels" style="color: #ffffff;">
        <div id="setting_panel" class="panel" style="display: none;">
            <form id="setting" onsubmit="event.preventDefault()">
                <fieldset>
                    <legend>سرور</legend>
                    <input class="server" type="text" name="sip_domain" size="30" placeholder="SIP domain name"
                        autocomplete="server domain" title="SIP domain name" required>
                    <input class="server" type="text" name="sip_addresses" size="30" placeholder="SIP server addresses"
                        autocomplete="server address" title="SIP server addresses" required>
                    <input class="server" type="text" name="ice_servers" size="30"
                        placeholder="optional STUN/TURN servers" autocomplete="server ices"
                        title="Optional STUN/TURN servers.">
                </fieldset>

                <fieldset>
                    <legend>اکانت</legend>
                    <input class="account" type="text" name="user" size="30" placeholder="user name" title="User name"
                        autocomplete="account name" required>
                    <input class="account" type="text" name="display_name" size="30" placeholder="display name"
                        title="Optional display name" autocomplete="account display-name">
                    <input class="account" type="password" name="password" size="30" placeholder="password"
                        title="User password" autocomplete="account password" required>
                    <input class="account" type="text" name="auth_user" size="30"
                        placeholder="optional authorization name" title="Optional authorization name"
                        autocomplete="account auth-name">
                </fieldset>

            </form>
            <button id="login_btn" title="Login">ورود</button>
        </div>

        <div id="devices_panel" class="panel">
                <button class="badge bg-secondary" id="devices_done_btn">ذخیره</button>
                <span class="badge bg-secondary" >Exact</span><input type="checkbox" title="Constraint deviceId: {exact: 'xxx'}" id="devices_exact_ckb">
                <div id="devices">
                    <table class="badge bg-secondary">
                    <thead>
                        <tr>
                          <th>میکروفن</th>
                          <th>اسپیکر</th>
                          <th>دوربین</th>
                          <th>زنگ</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td>
                                <dev id="microphone_dev">
                                    <select  style="width: 120px;" name="microphone"></select>
                                </dev>
                            </td>
                            <td>
                                <dev id="speaker_dev">
                                    <select style="width: 120px;" name="speaker"></select>
                                </dev>
                            </td>                        
                            <td>
                                <dev id="camera_dev">
                                    <select style="width: 120px;" name="camera"></select>
                                </dev>
                            </td>
                            <td>
                                <dev id="ringer_dev">
                                    <select style="width: 120px;" name="ringer"></select>
                                </dev>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
        </div>        


        <div id="call_log_panel" class="panel">
            <button id="call_log_return_btn" title="returns to dialer">Dialer</button>
            <button id="call_log_clear_btn" title="Clear call log">Clear log</button>
            <fieldset>
                <legend>لاگ تماس</legend>
                <ul id="call_log_ul">
                </ul>
            </fieldset>
        </div>

        <div id="outgoing_call_panel" class="panel">
            <fieldset>
                <input class="btn btn-sm btn-danger" id="cancel_outgoing_call_btn" type="button" value="انصراف">
            </fieldset>
        </div>

        <div id="incoming_call_panel" class="panel">
            <fieldset>
                <input  class="btn btn-sm btn-secondary" id="accept_audio_btn" type="button" value="پاسخ">
                <input style="display: none;" id="accept_recvonly_video_btn" type="button" value="قبول تماس ویدئویی">
                <input style="display: none;" id="accept_video_btn" type="button" value="قبول ویدئو">
                <input  class="btn btn-sm btn-danger" id="reject_btn" type="button" value="رد تماس">
                <input  class="btn btn-sm btn-secondary" id="redirect_btn" type="button" value="انقال"><br>
            </fieldset>
        </div>

        <div id="redirect_call_panel" class="panel">
            <fieldset class="badge bg-secondary">
                <legend>Redirect</legend>
                <form id="redirect_form" onsubmit="event.preventDefault()">
                    <input type="text" class="input" name="redirect_to">
                    <input id="do_redirect_btn" type="button" value="Done">
                </form>
            </fieldset>
        </div>

        <div id="transfer_call_panel" class="panel">
            <fieldset class="badge bg-secondary">
                <legend>Blind Transfer</legend>
                <form id="transfer_form" onsubmit="event.preventDefault()">
                    <input type="text" class="input" name="transfer_to">
                    <input id="do_transfer_btn" type="button" value="ذخیره">
                </form>
            </fieldset>
        </div>

        <div id="call_established_panel" class="panel">
            <div>
                <fieldset>
                    <input  class="btn btn-sm btn-secondary" id="hangup_btn" type="button" value="پایان مکالمه" title="Terminate the call">
                    <input  class="btn btn-sm btn-warning" id="mute_audio_btn" type="button" value="قطع صدا" title="Mute/Unmute microphone">
                    <input style="display: none;"  id="info_btn" type="button" value="Info" title="Print to console call information [for debugging]">
                    <input style="display: none;"  id="stats_btn" type="button" value="Stats" title="Print to console call statistics [for debugging]">
                    <input style="display: none;"  id="codecs_btn" type="button" value="Codecs" title="Print to console selected codecs [for debugging]">
                    <input style="display: none;"  id="send_reinvite_btn" type="button" value="Send re-INVITE" title="Send SIP re-INVITE message [for debugging]">
                    <input style="display: none;"  id="send_info_btn" type="button" value="Send INFO" title="Send SIP INFO">
                    <input  class="btn btn-sm btn-secondary" id="blind_transfer_btn" type="button" value="انتقال" title="Call blind transfer - asks the other side to call someone">
                    <input style="display: none;"  id="send_video_btn" type="button" value="شروع ارسال ویدئو" title="Start/stop sending video">
                    <input style="display: none;"  id="screen_sharing_btn" type="button" value="شروع اشتراک دسکتاپ" title="Start/stop screen sharing">
                    <input style="display: none;"  id="enable_receive_video_btn" type="button" value="Enable receive video" title="Enable/Disable receive video">
                    <span style="display: none;"  id="video_controls_span">
                        <input id="mute_video_btn" type="button" value="Mute video" title="Mute/unmute web camera">
                        <span>Hide local video</span><input type="checkbox" id="hide_local_video_ckb">
                        <span>Video size</span>
                        <select id="video_size_select">
                            <option value="Default">Default</option>
                            <option value="Micro">Micro</option>
                            <option value="X Tiny">X Tiny</option>
                            <option value="Tiny">Tiny</option>
                            <option value="X Small">X Small</option>
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="X Medium">X Medium</option>
                            <option value="Large">Large</option>
                            <option value="X Large">X Large</option>
                            <option value="XX Large">XX Large</option>
                            <option value="Huge">Huge</option>
                            <option value="Custom">Custom</option>
                            <option value="Reset Custom">Reset Custom</option>
                        </select>
                    </span>
                    <input  class="btn btn-sm btn-secondary" id="hold_btn" type="button" value="انتظار مکالمه" title="Hold/Unhold the call">
                    <input  class="btn btn-sm btn-secondary" id="keypad_btn" type="button" value="شماره گیر" title="Open/Close key panel">
                </fieldset>
            </div>
            <div id="dtmf_keypad">
                <table id="keypad_table" cellspacing="3">
                    <tr>
                        <td onclick="guiSendDTMF('1')">1</td>
                        <td onclick="guiSendDTMF('2')">2</td>
                        <td onclick="guiSendDTMF('3')">3</td>
                        <td onclick="guiSendDTMF('4')">4</td>
                        <td onclick="guiSendDTMF('5')">5</td>
                        <td onclick="guiSendDTMF('6')">6</td>
                        <td onclick="guiSendDTMF('7')">7</td>
                        <td onclick="guiSendDTMF('8')">8</td>
                        <td onclick="guiSendDTMF('9')">9</td>
                        <td onclick="guiSendDTMF('*')">*</td>
                        <td onclick="guiSendDTMF('0')">0</td>
                        <td onclick="guiSendDTMF('#')">#</td>
                    </tr>
                    <!-- Note: A B C D can be used, e.g. guiSendDTMF('A') -->
                </table>
            </div>
        </div>

        <div id="message_panel" class="panel" style="display: none;">
            <button id="message_return_btn" title="returns to dialer">Dialer</button>
            <fieldset>
                <legend>ارسال پیام</legend>
                <form id="send_message_form" onsubmit="event.preventDefault()">
                    to:<input type="text" class="input" name="send_to">
                    <br>
                    <textarea rows="3" cols="30" name="message"></textarea>
                    <br>
                    <input id="send_message_btn" type="button" value="تماس">
                </form>
            </fieldset>

            <fieldset>
                <legend>پیام ها</legend>
                <button id="message_clear_btn" title="clear all messages">Clear</button>
                <ul id="message_ul">
                </ul>
            </fieldset>
        </div>

        <div id="subscribe_panel" class="panel" style="display: none;">
            <button id="subscribe_return_btn" title="returns to dialer">Dialer</button>
            <fieldset>
                <legend>تنظیمات</legend>
                <form id="subscribe_test_setting_form" onsubmit="event.preventDefault()">
                    to user:<input type="text" class="input" name="user" size="6">
                    event:<input type="text" class="input" name="event_name" size="6" value="test"><br>
                    accept:<input type="text" class="input" name="accept" size="12" value="text/json,text/plain">
                    content-type:<input type="text" class="input" name="content_type" size="6" value="text/json"><br>
                    expires:<input type="text" class="input" name="expires" size="4" class="mark_invalid" pattern="^\d+$" value="3600"><br>
                </form>
            </fieldset>

            <fieldset>
                <legend>subscribe</legend>
                <form id="send_subscribe_form" onsubmit="event.preventDefault()">
                    <button id="send_init_subscribe_btn" title="Send initial SUBSCRIBE">subscribe</button><br>
                    <button id="send_initial_and_next_subscribe_btn" title="Send initial & next subscribe">subscribe & next</button>
                    <button id="send_next_subscribe_btn" title="Send next SUBSCRIBE">next subscribe</button><br>
                    <button id="send_unsubscribe_btn" title="Send un-SUBSCRIBE">un-subscribe</button>
                </form>
            </fieldset>
            <fieldset>
                <legend>notify</legend>
                <form id="send_notify_form" onsubmit="event.preventDefault()">
                    <button id="send_notify_btn" title="send NOTIFY">notify</button><br>
                    <button id="send_final_notify_btn" title="Send final NOTIFY">final notify</button>
                </form>
            </fieldset>
        </div>
    </div>

    <div id="video_view" style="display: none;">
        <video id="local_video" autoplay playsinline></video>
        <video id="remote_video" autoplay playsinline></video>
    </div>
</body>

</html>