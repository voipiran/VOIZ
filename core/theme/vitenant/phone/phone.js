'use strict';

/*
   Tutorial
   Single call phone prototype

   This is example of AudioCodes WebRTC API usage.
   The API is similar for Browser, Android and IPhone.
   For browser the API is implemented as wrapper of open source JsSIP library.
   GUI is simplified, and built in pure javascript (without framework).

   Implemented:

   - Persistent user account, user preferences, phone and server configuration in browser local storage.
   - SIP server registration.
   - Outgoing call.
   - Incoming call (answer, reject, redirect).
   - Incoming call desktop notification.
   - Hide/show local video view during open call (saved in user preferences)
   - Select video view size (saved in user preferences)
   - Mute audio, mute video.
   - Call hold/un-hold.
   - Send DTMF.
   - Redial last call.
   - Persistent call log history in browser indexed database.
   - Server connection keep-alive, detection connectivity failure.
   - Restore call after page reloading.
   - Use the previously connected server after page reloading.
   - Custom logger function.
   - Sound playing: incoming call ring, ringing-tone, busy-tone, terminated-tone, dtmf tones.
   - Support of Chrome WebAudio autoplay policy
   - Blind call transfer (transferor and transferee).
     (transferee code supports also receiving attended transfer REFER)
   - Incoming call custom header usage (Alert-Info example)
   - Incoming call with Replaces header
   - Receiving SIP NOTIFY in/out of dialog (in dialog NOTIFY talk example)
   - Sending/Receiving out of dialog SIP MESSAGE (text messages example)
   - Sending/receiving in dialog SIP INFO (JSON data example)
   - Answer with receive only video.
   - Start sending/receiving video in audio call. Stop sending video.
   - Sound customization using file config.js
   - Partial support iOS Safari
   - For outgoing call and 5xx response - switch to alternative SBC and re-call
   - Screen Sharing 
   - Added support of header: x-genesys-calluuid (Genesys server support example)
   - Added special support of Firefox incoming call notification permission request.
   - Restoration the previously connected server using X-AudioCodes-SBC-FQDN header.
   - Added DSCP network priority
   - Added stop receive video
   - Added service-worker incoming call notification.
   - Added SUBSCRIBE/NOTIFY dialog
   - Added setCodecFilter and printUsedCodecs() to check used codecs.
   - Added microphone, speaker, camera selection
   
   Igor Kolosov AudioCodes 2022
   Last edit: 20-Jun-2023
 */

// Global variables
let phone = new AudioCodesUA(); // phone API
let hasCamera = false; // If computer has camera.
let callLogDb = new CallLogDb(100); // last call logs indexeddb. Set max records number.
let messageDb = new MessageDb(100); // last incoming text messages. Set max records number.
let userAccount; // { user: '', password: '', displayName: '', authUser: ''}
let userPref; // User preferences (mostly GUI)
let phoneConfig; // Default from site setting, or custom if user is changed it.
let serverConfig; // Default from site setting, or custom if user is changed it.
let desktopNotification = { rsw: null, basic: null } // incoming call notification   
let activeCall = null; // not null, if exists active call
let transferCall = null; // transfer recipient outgoing call.
let audioPlayer = new AudioPlayer2(); // Play ring, ringback & busy tones.
let ac_log = console.log;  // Phone logger function.
let recallAfterSwitchingSbc = null; // Switching SBC and re-calling after initial INVITE 5xx response.
let serverLocalAddress; // set by optional REGISTER OK header: X-AudioCodes-SBC-FQDN
let screenSharingStream = null;
let keepAliveBeepJob = null;
let subscriber = null; // client subscribe dialog
let notifier = null;   // server subscribe dialog
let devices = new SelectDevices();
let remoteVideoDeviceId = '';

const videoSizesSeq = ['Micro', 'X Tiny', 'Tiny', 'X Small', 'Small', 'Medium', 'X Medium', 'Large', 'X Large', 'XX Large', 'Huge'];
const videoSizes = {
    'Default': { width: '', height: '' },
    'Micro': { width: '60px', height: '45px' },
    'X Tiny': { width: '90px', height: '70px' },
    'Tiny': { width: '120px', height: '90px' },
    'X Small': { width: '160px', height: '120px' },
    'Small': { width: '240px', height: '180px' },
    'Medium': { width: '320px', height: '240px' },
    'X Medium': { width: '400px', height: '300px' },
    'Large': { width: '480px', height: '360px' },
    'X Large': { width: '640px', height: '480px' },
    'XX Large': { width: '800px', height: '600px' },
    'Huge': { width: '960px', height: '720px' },
};

function documentIsReady() {
    // Load configurations
    serverConfig = DefaultServerConfig;
    phoneConfig = guiLoadPhoneConfig();
    userPref = guiLoadUserPref();
    devices.load(guiLoadSelectedDevices());

    // Set logger
    if (!serverConfig.logger) {
        setConsoleLoggers();
        startPhone();
    } else {
        setWebsocketLoggers(serverConfig.logger)
            .catch((e) => {
                setConsoleLoggers();
                ac_log('Cannot connect to logger server', e);
            })
            .finally(() => {
                startPhone();
            })
    }
}

function startPhone() {
    ac_log(`------ Date: ${new Date().toDateString()} -------`);
    ac_log(`AudioCodes WebRTC SDK. Single call phone prototype`);
    ac_log(`SDK: ${phone.version()}`);
    ac_log(`SIP: ${JsSIP.C.USER_AGENT}`);
    ac_log(`Browser: ${phone.getBrowserName()}  Internal name: ${phone.getBrowser()}|${phone.getOS()}`);

    if (navigator.connection) {
        let str = '';
        try {
            let nc = navigator.connection;
            if (nc.type) str += ' type=' + nc.type;
            if (nc.effectiveType) str += ' etype=' + nc.effectiveType;
            if (nc.downlink) str += ' downlink=' + nc.downlink + ' Mbps';
            if (nc.downlinkMax) str += ' downlinkMax=' + nc.downlinkMax + ' Mbps';
            if (nc.rtt) str += ' rtt=' + nc.rtt + ' ms';
        } catch (e) {
            str += ' [error]';
        }
        ac_log('Network connection:' + str);
    }

    devices.setDevices(true,
        [{ name: 'microphone', kind: 'audioinput' },
        { name: 'camera', kind: 'videoinput' },
        { name: 'speaker', kind: 'audiooutput' },
        { name: 'ringer', kind: 'audiooutput' }]);

    devices.enumerate(false)
        .then(() => {
            let str = 'devices: selected';
            for (let name of devices.names) {
                if (devices.getNumber(name) > 1) {
                    str += `\n${name}: "${devices.getSelected(name).label}"`;
                }
            }
            ac_log(str);

            /*
            // print devices list
            for (let name of devices.names) {
                let device = devices.getDevice(name);
                let str = `--- ${name} selected=${device.index}\n`;
                for (let ix = 0; ix < device.list.length; ix++)
                    str += `${ix}: ${JSON.stringify(device.list[ix])}\n`;
                ac_log(str);
            }
            */

            for (let name of devices.names)
                guiFillDeviceList(name);

            setDeviceIds();

            startPhone2()
        });
}

function startPhone2() {
    audioPlayer.init({ logger: ac_log });

    guiInit();

    // Set selected ring instead default.
    if (userPref.selectedRing) {
        ac_log('Set preferred ring for incoming call: ' + userPref.selectedRing);
        SoundConfig.downloadSounds[0] = { ring: userPref.selectedRing };
    }

    if (phoneConfig.useWebrtcTracer) {
        if (webrtcTracer) {
            ac_log('Used WebRTC tracer');
            webrtcTracer();
        } else {
            ac_log('"webrtcTracer" is undefined. Please add to HTML script: "tracer.js"');
        }
    }

    // Prepare audio data
    audioPlayer.downloadSounds('sounds/', SoundConfig.downloadSounds)
        .then(() => {
            let tones = Object.assign({}, SoundConfig.generateTones, audioPlayer.dtmfTones);
            return audioPlayer.generateTonesSuite(tones);
        })
        .then(() => {
            ac_log('audioPlayer: sounds are ready:', audioPlayer.sounds);
        });

    callLogDb.open()
        .then(() => {
            ac_log('call-log db: open');
            return callLogDb.load();
        })
        .then(() => {
            ac_log('call-log db: loaded', callLogDb.list.length);
            for (let entry of callLogDb.list) {
                guiAddLog(entry);
            }
        })
        .catch(e => {
            ac_log('call-log db open/load error', e);
        });

    messageDb.open()
        .then(() => {
            ac_log('message db: open');
            return messageDb.load();
        })
        .then(() => {
            ac_log('message db: loaded', messageDb.list.length);
            for (let entry of messageDb.list) {
                guiAddMessage(entry);
            }
        })
        .catch(e => {
            ac_log('message db open/load error', e);
        });
    // Check WebRTC support
    // Check available devices (microphone must exists, camera is optional)
    phone.checkAvailableDevices()
        .then((camera) => {
            hasCamera = camera;
            guiSetCamera();
            ac_log(`hasCamera=${hasCamera}`);
        })
        .catch((e) => {
            ac_log('Warning: missed micropone/speaker', e);
            throw e;
        })
        .then(() => {
            guiSetServerFields(serverConfig);

            // Account can be null, if was not saved in local storage before
            userAccount = DefaultUserConfig;
            if (userAccount) {
                //guiSetAcountFields(userAccount);
                initSipStack(userAccount);
            } else {
                throw 'Please set user, display-name and password, and optional authorization name.';
            }
        })
        .catch((e) => {
            ac_log('error', e);
            guiError(e);
            guiShowPanel('setting_panel');
        })
}

function createTimestamp(date = null) {
    if (date === null)
        date = new Date();
    let h = date.getHours();
    let m = date.getMinutes();
    let s = date.getSeconds();
    let ms = date.getMilliseconds();
    return ((h < 10) ? '0' + h : h) + ':' + ((m < 10) ? '0' + m : m) + ':' + ((s < 10) ? '0' + s : s) + '.' + ('00' + ms).slice(-3) + ' ';
}

function createDateTimestamp(date = null) {
    function lz(n) { return n < 10 ? '0' + n : '' + n; }
    if (date === null)
        date = new Date();
    let yr = date.getFullYear().toString();
    let mh = date.getMonth() + 1;
    let d = date.getDate();
    let h = date.getHours();
    let m = date.getMinutes();
    return yr + '-' + lz(mh) + '-' + lz(d) + ' ' + lz(h) + ':' + lz(m);
}

function setConsoleLoggers() {
    let useTimestamp = phoneConfig.addLoggerTimestamp;
    let useColor = ['chrome', 'firefox', 'safari'].includes(phone.getBrowser());

    ac_log = function () {
        let args = [].slice.call(arguments);
        let firstArg = [(useTimestamp ? createTimestamp() : '') + (useColor ? '%c' : '') + args[0]];
        if (useColor) firstArg = firstArg.concat(['color: BlueViolet;']);
        console.log.apply(console, firstArg.concat(args.slice(1)));
    };
    let js_log = function () {
        let args = [].slice.call(arguments);
        let firstArg = [(useTimestamp ? createTimestamp() : '') + args[0]];
        console.log.apply(console, firstArg.concat(args.slice(1)));
    };

    phone.setAcLogger(ac_log);
    phone.setJsSipLogger(js_log);
}

function setWebsocketLoggers(url) {
    return new Promise((resolve, reject) => {
        let ws = new WebSocket('wss://' + url, 'wslog');
        ws.onopen = () => { resolve(ws); }
        ws.onerror = (e) => { reject(e); }
    })
        .then(ws => {
            const log = function () {
                let args = [].slice.call(arguments);
                let msg = [createTimestamp() + args[0]].concat(args.slice(1)).join();
                if (ws.readyState === WebSocket.OPEN) {
                    ws.send(msg + '\n');
                } else {
                    console.log(msg);
                }
            };
            ac_log(`Sending log to "${url}"`);
            ac_log = log;
            phone.setAcLogger(log);
            phone.setJsSipLogger(log);
        })
}

function initSipStack(account) {
    // If page is reloaded, try reconnect previously connected SBC server
    let data = sessionStorage.getItem('phoneRestoreServer');
    if (data !== null) {
        sessionStorage.removeItem('phoneRestoreServer');
        if (phoneConfig.restoreServer) {
            let restoreServer = JSON.parse(data);
            let delay = Math.ceil(Math.abs(restoreServer.time - new Date().getTime()) / 1000);
            if (delay <= phoneConfig.restoreCallMaxDelay) {
                if (restoreServer.isLocal) {
                    serverConfig.addresses.unshift(restoreServer.address);
                }
                let ix = searchServerAddress(serverConfig.addresses, restoreServer.address);
                if (ix !== -1) {
                    ac_log('Page reloading, raise priority of previously connected server: "' + restoreServer.address + '"');
                    serverConfig.addresses[ix] = [restoreServer.address, 1000];
                } else {
                    ac_log('Cannot find previously connected server: ' + restoreServer.address + ' in configuration');
                }
            }
        }
    }

    // If an optional TURN server is used, set a username and password for it.
    //
    // Note: Please don't set TURN password in config.js, because everyone can read it !
    // Note: TURN server user name and password can be obtained via REST API request, or entered by user.
    // To keep this example simple, we'll assume that the TURN server is configured
    // to use the same user names and passwords as the SIP server.
    for (let server of serverConfig.iceServers) {
        if (typeof server === 'string')
            continue;
        let url = Array.isArray(server.urls) ? server.urls[0] : server.urls;
        if (url.startsWith('turn:')) {
            // Set TURN user name and password. Don't override if already set.
            if (server.username === undefined)
                server.username = (account.authUser !== '') ? account.authUser : account.user;
            if (server.credential === undefined)
                server.credential = account.password;
        }
    }

    phone.setServerConfig(serverConfig.addresses, serverConfig.domain, serverConfig.iceServers);
    phone.setAccount(account.user, account.displayName, account.password, account.authUser);

    // Setting phone options
    phone.setReconnectIntervals(phoneConfig.reconnectIntervalMin, phoneConfig.reconnectIntervalMax);
    phone.setRegisterExpires(phoneConfig.registerExpires);
    phone.setUseSessionTimer(phoneConfig.useSessionTimer);
    phone.setBrowsersConstraints(phoneConfig.constraints);
    phone.setWebSocketKeepAlive(phoneConfig.pingInterval, phoneConfig.pongTimeout, phoneConfig.timerThrottlingBestEffort, phoneConfig.pongReport, phoneConfig.pongDist);
    phone.setDtmfOptions(phoneConfig.dtmfUseWebRTC, phoneConfig.dtmfDuration, phoneConfig.dtmfInterToneGap);
    phone.setEnableAddVideo(phoneConfig.enableAddVideo);
    phone.setNetworkPriority(phoneConfig.networkPriority);
    phone.setCodecFilter(phoneConfig.codecFilter);
    phone.setNoAnswerTimeout(phoneConfig.noAnswerTimeout);

    // Set some strings to testing. Please don't use them in production.
    phone.setUserAgent(`AudioCodes WebRTC SDK. Single call phone prototype ${phone.version()} ${phone.getBrowserName()}`);
    phone.setRegisterExtraHeaders(['X-SBC: AudioCodes Mediant']);

    devices.addDeviceChangeListener((e) => {
        ac_log('Devices: device change event', e);
    });

    // Set phone API listeners
    phone.setListeners({
        loginStateChanged: function (isLogin, cause, response) {
            switch (cause) {
                case "connected":
                    // after this can be called 'login', but better use init(autoLogin=true)
                    ac_log('phone>>> loginStateChanged: connected');
                    break;
                case "disconnected":
                    ac_log('phone>>> loginStateChanged: disconnected');
                    guiError('SBC server: disconnected');
                    if (activeCall === null) // if no active call
                        guiShowPanel('setting_panel');
                    break;
                case "login failed":
                    ac_log('phone>>> loginStateChanged: login failed');
                    guiError('SBC server: login failed');
                    guiShowPanel('setting_panel');
                    break;
                case "login":
                    ac_log('phone>>> loginStateChanged: login');
                    serverLocalAddress = response.getHeader('X-AudioCodes-SBC-FQDN');

                    let url = serverLocalAddress ? serverLocalAddress : phone.getServerAddress();
                    if (url.startsWith('wss://'))
                        url = url.substring(6);
                    guiInfo(`"${phone.getAccount().user}" is logged in `);

                    let restoreData = sessionStorage.getItem('phoneRestoreCall');
                    if (restoreData !== null) {
                        sessionStorage.removeItem('phoneRestoreCall');
                    }
                    if (activeCall !== null && activeCall.isEstablished()) {
                        ac_log('Re-login done, active call exists (SBC might have switched over to secondary)');
                        guiShowPanel('call_established_panel');
                    } else if (restoreData !== null && phoneConfig.restoreCall && guiRestoreCall(restoreData)) {
                        ac_log('Call is restored after page reloading');
                    } else if (recallAfterSwitchingSbc !== null) {
                        ac_log('phone: switched SBC: re-call...');
                        guiMakeCallTo(recallAfterSwitchingSbc.callTo, recallAfterSwitchingSbc.videoOptions);
                        recallAfterSwitchingSbc = null;
                    } else {
                        guiShowPanel('dialer_panel');
                    }
                    break;
                case "logout":
                    ac_log('phone>>> loginStateChanged: logout');
                    guiInfo('SBC server: logout');
                    if (recallAfterSwitchingSbc !== null) {
                        ac_log('phone: switching SBC...');
                        break;
                    }
                    if (activeCall === null || !activeCall.isEstablished()) { // if no active call
                        guiShowPanel('setting_panel');
                        break;
                    }
            }
        },

        /*
         * Optional callback. Incoming re-INVITE request.
         * Called twice: the 1st incoming re-INVITE (start=true),
         * the 2nd after send OK (start=false)
         */
        callIncomingReinvite: function (call, start, request) {
            if (start) {
                // Check screen sharing optional SIP header
                call.data['screen-sharing-header'] = request.getHeader('x-screen-sharing');

                //-------------- X-Genesys-CallUUID ---------------
                let genesysId = request.getHeader('x-genesys-calluuid');
                if (genesysId) {
                    ac_log('Genesys UUID=' + genesysId);
                    if (genesysId !== call.data['_genesys_uuid']) {
                        call.data['_genesys_uuid'] = genesysId;
                        if (call.isLocalHold()) {
                            ac_log('Incoming re-INVITE: genesys ID changed & local hold.');
                            call.data['_genesys_uuid_changed'] = true;
                        }
                    }
                }
                //-------------- X-Genesys-CallUUID ---------------
                return;
            }
            //-------------- X-Genesys-CallUUID ---------------                
            if (call.data['_genesys_uuid_changed']) {
                call.data['_genesys_uuid_changed'] = false;
                ac_log('Incoming re-INVITE/Send OK genesys ID changed & local hold.=> unhold !');
                call.hold(false);
            }
            //------------- End of X-Genesys-CallUUID ------------

            ac_log('phone>>> call incoming reinvite, video current: ' + call.getVideoState() + ' enabled: ' + call.getEnabledVideoState());
            // Other side may start or stop send video.
            guiShowVideoControls(call);
            setEnableReceiveVideoButton();
            let remoteVideo = document.getElementById('remote_video');
            setVideoElementVisibility(remoteVideo, call.hasReceiveVideo());

            // Screen sharing. 
            // Here can be some GUI manipulations. (e.g. bigger video size)      
            let screenSharingHeader = call.data['screen-sharing-header'];
            if (call.hasReceiveVideo() && screenSharingHeader === 'on') {
                ac_log('phone: remote screen shown: on');
                guiInfo('remote screen shown: On');
            } else if (screenSharingHeader === 'off') {
                ac_log('remote screen shown: off');
                guiInfo('remote screen shown: Off');
            }
        },

        /*
         * Optional callback. Call transferor notification
         *
         * state=0  in progress (REFER accepted or NOTIFY 1xx)
         * state=-1 failed      (REFER rejected or NOTIFY with >= 300)
         * state=1  success     (NOTIFY 2xx)
         */
        transferorNotification: function (call, state) {
            switch (state) {
                case 0:
                    ac_log('phone>>> transferor: transfer in progress...');
                    guiWarning('call transfer in progress...');
                    break;

                case -1:
                    ac_log('phone>>> transferor: transfer failed');
                    guiHold(false); // un-hold active call
                    document.getElementById('blind_transfer_btn').disabled = false;
                    guiError('call transfer failed');
                    break;

                case 1:
                    ac_log('phone>>> transferor: transfer is successful');
                    guiInfo('call transfer is successful');
                    activeCall.data['terminated_transferred'] = true;
                    guiHangup(); // terminate active call
                    break;
            }
        },

        /*
         * Optional callback for call transferee
         * Accept or reject incoming REFER.
         */
        transfereeRefer: function (call, refer) {
            if (transferCall === null) {
                ac_log('phone>>> transferee incoming REFER: accepted');
                return true;
            } else {
                ac_log('phone>>> transferee incoming REFER: rejected, because other transfer in progress');
                return false;
            }
        },

        /*
         *  Optional callback for call transferee
         *  Created new outgoing call according the incoming REFER.
         *
         *  Note: Transferee uses 2 calls at the same time:
         *       call that receive REFER, and created new outgoing call
         */
        transfereeCreatedCall: function (call) {
            ac_log('phone>>> transferee created call', call);
            transferCall = call; // Used until call will be established

            guiInfo('call transferring to ' + call.data['_user']);

            // create new call log record
            let time = call.data['_create_time'].getTime();
            let logRecord = {
                id: callLogDb.createId(time),
                time: time,
                duration: -1,
                incoming: false,
                user: call.data['_user'],
                display_name: call.data['_display_name']
            };

            call.data['log_record'] = logRecord;
            guiAddLog(logRecord, 'call_log_ul');
            callLogDb.add(logRecord)
                .then(() => {
                    ac_log('call-log db: added');
                })
                .catch((e) => {status_line
                    ac_log('call-log db: add error', e);
                });
        },

        outgoingCallProgress: function (call, response) {
            ac_log('phone>>> outgoing call progress');
            if (call === transferCall)
                return;
            outStatus_call_progress('Ringing');            
            
            if (response.body) {
                call.data['outgoingCallProgress_played'] = true; // If the 18x respone includes SDP, the server plays sound
            } else if (!call.data['outgoingCallProgress_played']) {
                call.data['outgoingCallProgress_played'] = true; // To prevent duplicate playing.
                audioPlayer.play(SoundConfig.play.outgoingCallProgress);
            }
        },

        callTerminated: function (call, message, cause, redirectTo) {
            if (call.data['terminated_transferred'])
                cause = 'call transfer is successful';
            else if (call.data['terminated_replaced'])
                cause = 'call is replaced';
            ac_log(`phone>>> call terminated callback, cause=${cause}`);

            let logRecord = call.data['log_record'];

            // update call log duration
            if (call.wasAccepted()) { // sent or received SIP 2xx response
                logRecord.duration = call.duration();
                guiUpdateLog(logRecord);
                callLogDb.update(logRecord)
                    .then(() => {
                        ac_log('call-log db: updated');
                    })
                    .catch((e) => {
                        ac_log('call-log db: update error', e);
                    });
            }

            // print call log record to console
            let str = new Date(logRecord.time).toLocaleDateString('en-GB', {
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            str += logRecord.incoming ? ' in ' : ' out '
            str += logRecord.user;
            if (logRecord.display_name)
                str += ' "' + logRecord.display_name + '"';
            str += logRecord.duration >= 0 ? ' ' + logRecord.duration + ' sec' : ' failed';
            ac_log('Call log: ', str);

            if (call === transferCall) {
                ac_log('terminated transfer call');
                transferCall = null;
                return;
            }

            // Incoming call during active call or call that receive REFER.
            if (call !== activeCall) {
                ac_log('terminated no active call');
                return;
            }

            activeCall = null;

            // update GUI
            guiWarning('Call terminated: ' + cause);
            
            outStatus_call_user("");
            outStatus_call_progress("");
            updateIncoming_call_user("");
            updateCall_established_user("");
            
            guiShowPanel('dialer_panel');
            guiClearVideoView();
            guiNotificationClose();
            audioPlayer.stop();
            if (cause !== 'Redirected' && recallAfterSwitchingSbc === null) {
                if (call.isOutgoing() && !call.wasAccepted()) {
                    audioPlayer.play(SoundConfig.play.busy);
                } else {
                    audioPlayer.play(SoundConfig.play.disconnect);
                }
            }

            if (cause === 'Redirected') {
                ac_log('Redirect call to ' + redirectTo);
                guiMakeCallTo(redirectTo, call.hasEnabledSendVideo() ? phone.VIDEO : phone.AUDIO);
                return;
            }

            // 5xx response to initial outgoing INVITE
            if (call.isOutgoing() && !call.wasAccepted()) {
                let statusCode = (message && message.status_code) ? message.status_code : 0;
                if (statusCode >= 500 && statusCode < 600 && phoneConfig.switchSbcAtInvite5xx) {
                    if (phone.getNumberOfSBC() === 1) {
                        ac_log('phone: Cannot switch to other SBC, because set single SBC');
                    } else {
                        ac_log('phone: Outgoing call response 5xx. Switching SBC and re-call');
                        recallAfterSwitchingSbc = {
                            callTo: call.data['_user'],
                            videoOptions: call.hasEnabledSendVideo() ? phone.VIDEO : phone.AUDIO
                        };
                        phone.switchSBC();
                    }
                }
            }
        },

        callConfirmed: function (call, message, cause) {
            ac_log('phone>>> callConfirmed');
            // update call log duration
            let logRecord = call.data['log_record'];
            logRecord.duration = 0; // zero duration means call is established
            guiUpdateLog(logRecord);
            callLogDb.update(logRecord)
                .then(() => {
                    ac_log('call-log db: updated');
                })
                .catch((e) => {
                    ac_log('call-log db: update error', e);
                });

            //-------------- X-Genesys-CallUUID ---------------
            let genesysId = message !== null ? message.getHeader('x-genesys-calluuid') : undefined;
            if (genesysId) {
                ac_log('Genesys UUID=' + genesysId);
                call.data['_genesys_uuid'] = genesysId;
            }
            //-------------- End of X-Genesys-CallUUID --------

            //guiInfo('');
            if (call === transferCall) {
                guiInfo('call transferred')
                ac_log('transfer call is established. Set it as active call');
                activeCall = call;
                transferCall = null;

                // Set user name
                let user = call.data['_user'];
                let dn = call.data['_display_name']; // optional
                let caller = dn ? `"${dn}" ${user}` : user;
                updateCall_established_user(caller);
                
            }
            audioPlayer.stop();

            // Show/hide video controls and local video
            let remoteVideo = document.getElementById('remote_video');
            setVideoElementVisibility(remoteVideo, call.hasReceiveVideo());
            guiShowVideoControls(call);
            setEnableReceiveVideoButton();
            guiShowLocalVideo(call.hasSendVideo() && !userPref.hideLocalVideo);

            if (call.data['open_replaced']) {
                guiInfo('call is replaced');
            }

            let screenSharingBtn = document.getElementById('screen_sharing_btn');
            screenSharingBtn.value = 'Start screen sharing';
            screenSharingBtn.disabled = false;

            let sendVideoBtn = document.getElementById('send_video_btn');
            sendVideoBtn.value = call.hasEnabledSendVideo() ? 'Stop sending video' : 'Start sending video';
            sendVideoBtn.disabled = !hasCamera;

            // restore button values to initial state
            document.getElementById('hold_btn').value = 'Hold';
            document.getElementById('hold_btn').disabled = false;
            document.getElementById('mute_audio_btn').value = 'Mute';
            document.getElementById('mute_video_btn').value = 'Mute video';
            document.getElementById('blind_transfer_btn').disabled = false;

            // for restored call  restore hold or mute state if need.
            let restore = activeCall.data['restoreCall'];
            if (restore) {
                if (restore.hold !== '') {
                    if (restore.hold.includes('remote')) {
                        ac_log('Restore remote hold');
                        guiWarning('Remote HOLD');
                        activeCall.setRemoteHoldState();
                    }
                    if (restore.hold.includes('local')) {
                        ac_log('Restore local hold');
                        guiHold(true);
                    }
                } else if (restore.mute !== '') {
                    if (restore.mute.includes('audio')) {
                        ac_log('Restore mute audio');
                        guiMuteAudio();
                    }
                    if (restore.mute.includes('video')) {
                        ac_log('Restore mute video');
                        guiMuteVideo();
                    }
                }
                if (restore.screenSharing) {
                    ac_log('Restore screen sharing');
                    guiToggleScreenSharing();
                }
            }
            guiShowPanel('call_established_panel');
        },

        callShowStreams: function (call, localStream, remoteStream) {
            if (call === transferCall) {
                ac_log('phone>>> callShowStreams (transfer call)');
                return;
            }
            ac_log('phone>>> callShowStreams');

            audioPlayer.stop();

            printStreamsParameters();

            let remoteVideo = document.getElementById('remote_video');
            setRemoteVideoSinkId(remoteVideo)
                .catch((e) => {
                    ac_log(`Warning: remove video HTMLVideoElement.setSinkId(): "${e.message}" [Used default browser speaker]`, e);
                })
                .finally(() => {
                    remoteVideo.srcObject = remoteStream;
                });
        },

        incomingCall: function (call, invite, replacedCall, hasSDP) {
            ac_log('phone>>> incomingCall', call, invite, replacedCall, hasSDP);
            call.data['incoming_invite_hasSDP'] = hasSDP;

            // create new call log record
            let time = call.data['_create_time'].getTime();
            let logRecord = {
                id: callLogDb.createId(time),
                time: time,
                duration: -1,
                incoming: true,
                user: call.data['_user'],
                display_name: call.data['_display_name']
            };
            call.data['log_record'] = logRecord;
            guiAddLog(logRecord);
            callLogDb.add(logRecord)
                .then(() => {
                    ac_log('call-log db: added');
                })
                .catch((e) => {
                    ac_log('call-log db: add error', e);
                });

            // If received INVITE with Replaces header
            if (replacedCall !== null) {
                ac_log('phone: incomingCall, INVITE with Replaces');

                // close the replaced call.
                replacedCall.data['terminated_replaced'] = true;
                replacedCall.terminate();

                // auto answer to replaces call.
                activeCall = call;
                activeCall.data['open_replaced'] = true;

                let videoOption = replacedCall.hasVideo() ? phone.VIDEO : (replacedCall.hasReceiveVideo() ? phone.RECVONLY_VIDEO : phone.AUDIO);
                activeCall.answer(videoOption);
                return;
            }

            // Check if exists other active call
            if (activeCall !== null) {
                ac_log('Reject incoming call, because we during other call');
                call.reject();
                return;
            }

            // Incoming call
            guiInfo('Incoming Call');
            activeCall = call;

            // Can be used custom header in incoming INVITE
            // ------ begin of Alert-Info auto answer example ----
            // JsSIP parse Alert-Info as raw string. We use custom parser defined in utils.js
            let alertInfo = new AlertInfo(invite);
            ac_log(`alert-info header ${alertInfo.exists() ? ' exists' : 'does not exist'}`);
            if (alertInfo.hasAutoAnswer()) {
                ac_log(`alert-info delay=${alertInfo.getDelay()}`); // currently ignored
                ac_log('*** Used Alert-Info Auto answer ***');
                audioPlayer.play(SoundConfig.play.autoAnswer);

                let videoOption;
                if (activeCall.data['incoming_invite_hasSDP']) {
                    videoOption = activeCall.hasVideo() ? (hasCamera ? phone.VIDEO : phone.RECVONLY_VIDEO) : phone.AUDIO;
                } else {
                    videoOption = phoneConfig.audioAutoAnswerNoSdp ? phone.AUDIO : phone.VIDEO;
                }
                guiAnswerCall(videoOption);
                return;
            }
            //------ end of Alert-Info auto answer example ----

            //-------------- X-Genesys-CallUUID ---------------
            let genesysId = invite.getHeader('x-genesys-calluuid');
            if (genesysId) {
                ac_log('Genesys UUID=' + genesysId);
                call.data['_genesys_uuid'] = genesysId;
            }
            //------------ End of X-Genesys-CallUUID ----------

            audioPlayer.play(SoundConfig.play.incomingCall);

            // If set ringer deviceId, playing parallel in 'ringer' device.
            audioPlayer.playRing(SoundConfig.play.incomingCallRinger);

            let user = call.data['_user'];
            let dn = call.data['_display_name']; // optional
            let caller = dn ? `"${dn}" ${user}` : user;

            updateIncoming_call_user(caller);
            updateCall_established_user(caller);
            
            document.getElementById('accept_video_btn').disabled = !hasCamera || !call.hasVideo();
            document.getElementById('accept_recvonly_video_btn').disabled = !call.hasVideo();
            guiShowPanel('incoming_call_panel');
            guiNotificationShow(caller);
        },

        /*
         * Here isHold, and isRemote arguments described hold event.
         *
         * For example arguments can be isHold=false isRemote=true
         * It means that remote phone remove its hold.
         * But phone can still be in local hold.
         *
         * So recommended within the callback check
         * call.isRemoteHold() and call.isLocalHold().
         */
        callHoldStateChanged: function (call, isHold, isRemote) {
            if (call === transferCall) {
                ac_log('phone>>> callHoldStateChanged (transfer call)');
                return;
            }
            ac_log('phone>>> callHoldStateChanged');

            let remoteHold = call.isRemoteHold();
            let localHold = call.isLocalHold();
            if (remoteHold && localHold) {
                guiWarning('Remote & Local HOLD');
            } else if (remoteHold && !localHold) {
                guiWarning('Remote HOLD');
            } else if (!remoteHold && localHold) {
                guiWarning('Local HOLD');
            } else {
                guiInfo('Unhold done');
            }

            // Update hold button
            if (!isRemote) {
                document.getElementById('hold_btn').value = isHold ? 'Unhold' : 'Hold';
            }
            if (!localHold && isRemote && phoneConfig.avoidTwoWayHold) {
                document.getElementById('hold_btn').disabled = remoteHold;
            }
        },

        /*
         * Optional callback. Incoming SIP NOTIFY (in or out of dialog)
         * Can be used for any events.
         * Returns true - process the NOTIFY, false - use default JsSIP processing
         *
         * Here for example supported in dialog NOTIFY events: "talk" and "hold".
         */
        incomingNotify: function (call, eventName, from, contentType, body, request) {
            ac_log(`phone>>> incoming NOTIFY "${eventName}"`, call, from, contentType, body);
            if (call === null) { // out of dialog NOTIFY
                if (eventName === 'vq') { // voice quality event
                    let vq = getXVoiceQuality(request);
                    if (vq) {
                        ac_log(`NOTIFY: "X-VoiceQuality" header: score="${vq.score}", color="${vq.color}"`);
                    } else {
                        ac_log('NOTIFY: missing "X-VoiceQuality" header');
                    }
                    return true;
                } else {
                    return false;
                }
            }
            if (eventName !== 'talk' && eventName !== 'hold' && eventName !== 'dtmf')
                return false; // skip unsupported events
            if (activeCall === null)
                return false; // skip illegal state.

            if (eventName === 'talk') {
                if (!activeCall.isEstablished() && !activeCall.isOutgoing()) {
                    ac_log('incoming NOTIFY "talk": answer call');
                    audioPlayer.play(SoundConfig.play.autoAnswer);
                    let videoOption;
                    if (activeCall.data['incoming_invite_hasSDP']) {
                        videoOption = activeCall.hasVideo() ? (hasCamera ? phone.VIDEO : phone.RECVONLY_VIDEO) : phone.AUDIO;
                    } else {
                        videoOption = phoneConfig.audioAutoAnswerNoSdp ? phone.AUDIO : phone.VIDEO;
                    }
                    guiAnswerCall(videoOption);
                } else if (activeCall.isEstablished() && activeCall.isLocalHold()) {
                    ac_log('incoming NOTIFY "talk": un-hold call');
                    guiHold(false);
                } else {
                    ac_log('incoming NOTIFY "talk": ignored');
                }
            } else if (eventName === 'hold') {
                if (activeCall.isEstablished() && !activeCall.isLocalHold()) {
                    ac_log('incoming NOTIFY "hold": set call on hold');
                    guiHold(true);
                } else {
                    ac_log('incoming NOTIFY "hold": ignored');
                }
            } else if (eventName === 'dtmf') {
                ac_log('incoming NOTIFY "dtmf" body="' + body + '"');
                body = body.trim().toLowerCase();
                if (body.startsWith('signal=')) {
                    let str = body.substring(7);
                    for (let key of str) {
                        activeCall.sendDTMF(key);
                    }
                }
            }
            return true;
        },

        /*
         * Optional callback. Incoming SIP MESSAGE (out of dialog)
         */
        incomingMessage: function (call, from, contentType, body, request) {
            ac_log('phone>>> incoming MESSAGE', from, contentType, body);
            let time = new Date();
            let message = {
                id: callLogDb.createId(time),
                incoming: true,
                time: time,
                user: from.user,
                display_name: from.displayName,
                host: from.host,
                contentType: contentType,
                body: body
            };

            if (guiIsHidden('message_panel')) { // If message_panel is not used
                // visual message notification
                if (!userPref.newMessages)
                    userPref.newMessages = 0;
                userPref.newMessages++;
                guiStoreUserPref(userPref);
                let button = document.getElementById('message_btn');
                button.innerText = `Messages (${userPref.newMessages} new)`;
                button.classList.add('new_message');
            }
            audioPlayer.play(SoundConfig.play.incomingMessage);

            guiAddMessage(message);

            messageDb.add(message)
                .then(() => {
                    ac_log('message db: added');
                })
                .catch((e) => {
                    ac_log('message db: add error', e);
                });
        },

        /*
         * Optional callback. Incoming SIP INFO (in dialog)
         */
        incomingInfo: function (call, from, contentType, body, request) {
            ac_log('phone>>> incoming INFO', call, from, contentType, body);
        },

        /* 
         * Optional callback. Screen sharing is ended.
         * Called when:
         * 1. called method call.stopScreenSharing
         * 2. stopped by browser built-in screen-sharing pop up window.
         * 3. call with screen-sharing is terminated. Will be called before callTerminated()
         */
        callScreenSharingEnded: function (call, stream) {
            ac_log('phone>>> callScreenSharingEnded', call);
            // send video and screen sharing use the same video track, we use it for screen
            // sharing or for sending video.
            let screenSharingBtn = document.getElementById('screen_sharing_btn');
            let sendVideoBtn = document.getElementById('send_video_btn');
            screenSharingBtn.value = 'Start screen sharing';
            screenSharingBtn.disabled = false;
            sendVideoBtn.value = call.hasSendVideo() ? 'Stop sending video' : 'Start sending video';
            sendVideoBtn.disabled = !hasCamera;
            phone.closeScreenSharing(screenSharingStream);
            setEnableReceiveVideoButton();
            screenSharingStream = null;
        },

        /*
         * Optional callback. Incoming SUBSCRIBE (out of dialog)
         * return  0 - dialog successfully created.
         *        >0 - failure. Send response with the SIP code.
         */
        incomingSubscribe(subscribe, eventName, accepts) {
            // Check incoming SUBSCRIBE
            let ourEventName = document.querySelector('#subscribe_test_setting_form [name=event_name]').value.trim();
            let ourContentType = document.querySelector('#subscribe_test_setting_form [name=content_type]').value.trim();

            // Check event type
            if (!eventName || eventName !== ourEventName) {
                guiWarning(`receive SUBSCRIBE: Event: ${eventName} We support Event: ${ourEventName}`);
                return 489; // send SIP response 489 "Bad Event"
            }
            // Check if accept header includes our content-type
            if (!accepts || !accepts.some(v => v.includes(ourContentType))) {
                guiWarning(`receive SUBSCRIBE: Accept: ${accepts} We support Content-Type: ${ourContentType}`);
                return 406; // send SIP response 406 "Not Acceptable"
            }
            try {
                createNotifier(subscribe);
            } catch (e) {
                guiWarning('Cannot create server subscribe dialog');
                ac_log('Cannot create server subscribe dialog', e);
                return 400; // send SIP response 400 "Bad Request"
            }
            return 0; // Don't send SIP response, created dialog will send it.
        }
    });

    // Request permission to use desktop notification (for incoming call)
    if (window.Notification && Notification.permission === 'default') {
        if (phone.browser === 'firefox') {
            // Special for Firefox:
            // If  Notification.requestPermission() is not called from the user driven event,
            // the notification permission pop-up window will not be shown, and instead a special icon will be added to the address bar.
            // The pop-up window will be shown when you click this icon.
            // Another possibility: to show a special button and call the method Notification.requestPermission() when this button 
            // is pressed. In the case notification permission pop-up window will be shown.
            document.getElementById('notification_permission_btn').onclick = guiRequestNotificationPermission;
            guiShow('notification_permission_btn');
        } else {
            guiRequestNotificationPermission();
        }
    }

    // Use service worker to incoming call notification.
    if (phoneConfig.useServiceWorkerNotification)
        registerServiceWorker();

    // API modes and browser issues workarounds
    phone.setModes(phoneConfig.modes);

    guiInfo('Logging...');

    // Initialize SIP, establish connection to SBC.
    phone.init(true); // autoLogin=true, so after SBC connection is established, automatically send SIP REGISTER.
}

// Search server address in array of addresses
function searchServerAddress(addresses, searchAddress) {
    searchAddress = searchAddress.toLowerCase();
    for (let ix = 0; ix < addresses.length; ix++) {
        let data = addresses[ix]; // can be address or [address, priority]
        let address = data instanceof Array ? data[0] : data;
        if (address.toLowerCase() === searchAddress)
            return ix;
    }
    return -1;
}

function setVideoElementVisibility(videoElement, isVisible) {
    videoElement.style.display = 'block';
    if (isVisible) {
        let size = userPref.videoSize;
        if (size === 'Custom') {
            let isLocal = videoElement === document.getElementById('local_video');
            size = isLocal ? userPref.videoCustom.local.size : userPref.videoCustom.remote.size;
        }
        guiSetVideoSize(videoElement, size);
    } else {
        videoElement.style.width = videoElement.style.height = '0px';
    }
}

/*
   Print call information for debugging. Using SDK.
 */
async function printStreamsParameters() {
    if (activeCall === null) {
        ac_log('activeCall is null');
        return;
    }
    // Current video state set according answer SDP (hold answer will be ignored)
    ac_log('Video State current: ' + activeCall.getVideoState() + ' enabled: ' + activeCall.getEnabledVideoState());

    // WebRTC tracks
    let li = await phone.getWR().stream.getInfo(activeCall.getRTCLocalStream());
    let ri = await phone.getWR().stream.getInfo(activeCall.getRTCRemoteStream());
    ac_log(`Enabled Tracks: local ${li} remote ${ri}`)

    // WebRTC transceivers
    let ti = await phone.getWR().connection.getTransceiversInfo(activeCall.getRTCPeerConnection());
    ac_log(`Transceivers: ${ti}`);
}


/*
 Print call statistics for debugging. Using SDK
 */
function printCallStats() {
    if (activeCall === null) {
        ac_log('activeCall is null');
        return;
    }
    let conn = activeCall.getRTCPeerConnection();

    conn.getStats(null)
        .then(report => {
            report.forEach(now => {
                let str = now.type;
                str += ' {';
                let first = true;
                for (let key of Object.keys(now)) {
                    if (first) first = false;
                    else str += ',';
                    str += (key + '=' + now[key]);
                }
                str += '} \r\n';
                ac_log(str);
            });
        })
}

// Note: don't work immediatelly after call established,
// because getStats missed 'inbound-rtp', 'outbound-rtp', 'codec'
// Repeat after a few seconds
async function printUsedCodecs() {
    if (activeCall === null) {
        ac_log('activeCall is null');
        return;
    }
    let conn = activeCall.getRTCPeerConnection();

    let stats = await conn.getStats();
    let reports = {};
    stats.forEach(entry => {
        let type = entry.type;
        if (['inbound-rtp', 'outbound-rtp', 'codec'].includes(type)) {
            if (!reports[type])
                reports[type] = [];
            reports[type].push(Object.assign({}, entry));
        }
    });

    try {
        let audioIn = getCodec(reports, 'inbound-rtp', 'audio');
        let audioOut = getCodec(reports, 'outbound-rtp', 'audio');
        let videoIn = getCodec(reports, 'inbound-rtp', 'video');
        let videoOut = getCodec(reports, 'outbound-rtp', 'video');
        ac_log(`audio in: ${audioIn ? audioIn : '-'}`);
        ac_log(`audio out: ${audioOut ? audioOut : '-'}`);
        if (videoIn || videoOut) {
            ac_log(`video in: ${videoIn ? videoIn : '-'}`);
            ac_log(`video out: ${videoOut ? videoOut : '-'}`);
        }
    } catch (e) {
        ac_log('Cannot detect codec. Repeat after a few seconds', e);
    }
}

function getCodec(reports, report, mediaType) {
    let rtps = reports[report];
    if (!rtps)
        throw `Missed "${report}" stats`;
    let foundRtp = null;
    for (let rtp of rtps) {
        if (rtp.mediaType === mediaType) {
            foundRtp = rtp;
            break;
        }
    }
    if (!foundRtp)
        return undefined;
    let searchId = foundRtp.codecId;
    if (!searchId)
        return undefined;
    let codecs = reports['codec'];
    if (!codecs)
        throw 'Missed "codec" stats';
    for (let codec of codecs) {
        if (codec.id === searchId) {
            let name = codec.mimeType;
            name = name.substring(6).toUpperCase();
            if (codec.sdpFmtpLine)
                name += '#' + codec.sdpFmtpLine;
            return name;
        }
    }
    throw `Not found "codec" id=="${searchId}"`;
}

function onBeforeUnload() {
    guiNotificationClose(); // If was notification on desktop, remove it.

    if (phone === null || !phone.isInitialized())
        return;

    if (activeCall != null) {
        // If used restoreCall phone mode, save to local storage data
        // to restore the call after page reloading
        if (activeCall.isEstablished() && phoneConfig.restoreCall) {
            let data = {
                callTo: activeCall.data['_user'],
                video: activeCall.getVideoState(), // sendrecv, sendonly, recvonly, inactive
                replaces: activeCall.getReplacesHeader(),
                time: new Date().getTime(),
                hold: `${activeCall.isLocalHold() ? 'local' : ''}${activeCall.isRemoteHold() ? 'remote' : ''}`,
                mute: `${activeCall.isAudioMuted() ? 'audio' : ''}${activeCall.isVideoMuted() ? 'video' : ''}`
            }
            if (activeCall.isScreenSharing()) {
                data.screenSharing = true;
                data.video = activeCall.doesScreenSharingReplaceCamera() ? 'sendrecv' : 'inactive';
            }
            sessionStorage.setItem('phoneRestoreCall', JSON.stringify(data));
        } else {
            // Send SIP BYE
            activeCall.terminate();
        }
    }

    // Save connected server address to restore after page reloading
    let serverAddress = phone.getServerAddress();
    if (serverAddress !== null || serverLocalAddress !== undefined) {
        let data = {
            time: new Date().getTime(),
            address: serverLocalAddress ? 'wss:/' + serverLocalAddress.trim() : serverAddress,
            isLocal: serverLocalAddress !== undefined
        }
        sessionStorage.setItem('phoneRestoreServer', JSON.stringify(data));
    }

    // Send un-SUBSCRIBE if subscription dialog exists.
    if (subscriber !== null) {
        subscriber.terminate();
    }

    // Send final NOTIFY if notifier dialog exists.
    if (notifier !== null) {
        notifier.terminate();
    }

    // Send SIP unREGISTER
    phone.logout();
}

/*
 *  Simple GUI
 */
function guiInit() {
    window.addEventListener('beforeunload', onBeforeUnload);

    document.getElementById('send_video_btn').onclick = guiToggleSendVideo;
    if (phone.isScreenSharingSupported()) {
        document.getElementById('screen_sharing_btn').onclick = guiToggleScreenSharing;
    } else {
        ac_log('Warning: screen sharing is not supported');
        guiHide('screen_sharing_btn');
    }
    document.getElementById('enable_sound_btn').onclick = guiEnableSound;

    // pressing enter key leads to audio call.
    document.querySelector('#call_form [name=call_to]').addEventListener("keydown", function (ev) {
        if (ev.keyCode === 13) {
            ev.preventDefault();
            guiMakeCall(phone.AUDIO);
        }
    });

    document.getElementById('login_btn').onclick = function () {
        let user = document.querySelector('#setting [name=user]').value || '';
        let authUser = document.querySelector('#setting [name=auth_user]').value || '';
        let password = document.querySelector('#setting [name=password]').value || '';
        let displayName = document.querySelector('#setting [name=display_name]').value || '';

        user = user.trim();
        authUser = authUser.trim();
        password = password.trim();
        displayName = displayName.trim();

        let account = {
            user: user,
            authUser: authUser,
            password: password,
            displayName: displayName
        };
        guiStoreAccount(account);

        try {
            let domain = document.querySelector('#setting [name=sip_domain]').value;
            let addresses = document.querySelector('#setting [name=sip_addresses]').value;
            let iceServers = document.querySelector('#setting [name=ice_servers]').value;

            domain = domain.trim();
            addresses = addresses.trim();
            iceServers = iceServers.trim();

            if (iceServers === '')
                iceServers = '[]';

            let conf = {
                domain: domain,
                addresses: JSON.parse(addresses),
                iceServers: JSON.parse(iceServers)
            };
            guiStoreServerConfig(conf);

            // if user name was changed, clear call log and then reload page
            let sameUserAsWas = userAccount && 'user' in userAccount && userAccount.user === user;
            if (sameUserAsWas) {
                ac_log('user name is not changed');
                location.reload();
            } else {
                ac_log('user name is changed, clear the user databases');
                callLogDb.clear()
                    .then(() => {
                        return messageDb.clear();
                    })
                    .finally(() => {
                        location.reload();
                    })
            }
        } catch (e) {
            ac_log('Store settings error', e);
            guiError('Please fix settings');
        }
    }

    document.getElementById('info_btn').onclick = function () {
        printStreamsParameters();
        let conn = activeCall.getRTCPeerConnection();
        ac_log('connection', conn);
    }

    document.getElementById('stats_btn').onclick = function () {
        printCallStats();
    }

    document.getElementById('codecs_btn').onclick = function () {
        printUsedCodecs();
    }

    document.getElementById('blind_transfer_btn').onclick = function () {
        guiShowPanel('transfer_call_panel');
    }

    document.getElementById('do_transfer_btn').onclick = guiDoTransferCall;

    document.getElementById('settings_btn').onclick = function () {
        guiShowPanel('setting_panel');
    }

    document.getElementById('devices_btn').onclick = function () {
        devices.enumerate(true)
            .catch((e) => {
                ac_log('getUserMedia() exception', e);
            })
            .finally(() => {
                for (let name of devices.names)
                    guiFillDeviceList(name);

                guiShowPanel('devices_panel');
            });
    }

    document.getElementById('devices_exact_ckb').checked = userPref.devicesExact;

    document.getElementById('devices_done_btn').onclick = function () {
        // set selected in GUI devices.
        for (let name of devices.names) {
            let selectElement = document.querySelector(`#devices [name=${name}]`);
            let index = selectElement.selectedIndex;
            if (index !== -1) { // -1 indicates that no element is selected
                let n = selectElement.options[index].value;
                devices.setSelectedIndex(name, parseInt(n));
            }
        }

        let str = 'Devices done: selected';
        for (let name of devices.names) {
            if (devices.getNumber(name) > 1) {
                str += `\n${name}: "${devices.getSelected(name).label}"`;
            }
        }
        ac_log(str);

        /*
        // print device list
        for (let name of devices.names) {
            let device = devices.getDevice(name);
            let str = `--- ${name} selected=${device.index}\n`;
            for (let ix = 0; ix < device.list.length; ix++)
                str += `${ix}: ${JSON.stringify(device.list[ix])}\n`;
            ac_log(str);
        }
        */

        userPref.devicesExact = document.getElementById('devices_exact_ckb').checked;
        guiStoreUserPref(userPref);
        guiStoreSelectedDevices(devices.store());

        setDeviceIds();

        guiShowPanel('dialer_panel');
    }

    document.getElementById('call_log_btn').onclick = function () {
        guiEnableSound();
        guiShowPanel('call_log_panel');
    }

    document.getElementById('redial_last_call_btn').onclick = function () {
        guiRedialLastCall();
    }

    document.getElementById('call_log_return_btn').onclick = function () {
        guiShowPanel('dialer_panel');
    }

    document.getElementById('call_log_clear_btn').onclick = function () {
        guiClearLog();
        callLogDb.clear()
            .then(() => {
                ac_log('call-log db: cleared');
            })
            .catch(e => {
                ac_log('call-log db: clear error', e)
            });
    }

    document.getElementById('audio_call_btn').onclick = function () { guiMakeCall(phone.AUDIO); }
    document.getElementById('video_call_btn').onclick = function () { guiMakeCall(phone.VIDEO); }
    document.getElementById('accept_audio_btn').onclick = function () { guiAnswerCall(phone.AUDIO); }
    document.getElementById('accept_recvonly_video_btn').onclick = function () { guiAnswerCall(phone.RECVONLY_VIDEO); }
    document.getElementById('accept_video_btn').onclick = function () { guiAnswerCall(phone.VIDEO); }
    document.getElementById('reject_btn').onclick = guiRejectCall;
    document.getElementById('redirect_btn').onclick = guiRedirectCall;
    document.getElementById('do_redirect_btn').onclick = guiDoRedirectCall;
    document.getElementById('cancel_outgoing_call_btn').onclick = guiHangup;
    document.getElementById('hangup_btn').onclick = guiHangup;
    document.getElementById('hold_btn').onclick = guiToggleHold;
    document.getElementById('send_reinvite_btn').onclick = guiSendReInvite;
    document.getElementById('enable_receive_video_btn').onclick = guiEnableReceiveVideo;
    document.getElementById('send_info_btn').onclick = guiSendInfo;
    document.getElementById('mute_audio_btn').onclick = guiMuteAudio;
    document.getElementById('mute_video_btn').onclick = guiMuteVideo;
    document.getElementById('hide_local_video_ckb').onclick = guiToggleLocalVideo;
    document.getElementById('hide_local_video_ckb').checked = userPref.hideLocalVideo;
    document.getElementById('video_size_select').onchange = guiVideoSizeChanged;
    document.getElementById('keypad_btn').onclick = guiToggleDTMFKeyPad;
    document.getElementById('call_log_ul').onclick = guiClickOnCallLog;
    guiSetVideoSizeControl(userPref.videoSize);
    guiVideoSizeChanged(false);

    document.getElementById('message_btn').onclick = guiMessage;
    document.getElementById('send_message_btn').onclick = guiSendMessage;
    if (userPref.newMessages && userPref.newMessages > 0) {
        let button = document.getElementById('message_btn');
        button.innerText = `Messages (${userPref.newMessages} new)`;
        button.classList.add('new_message');
    }

    document.getElementById('message_return_btn').onclick = function () { guiShowPanel('dialer_panel'); }
    document.getElementById('message_clear_btn').onclick = function () {
        guiClearMessages();
        messageDb.clear()
            .then(() => {
                ac_log('message db: cleared');
            })
            .catch(e => {
                ac_log('message db: clear error', e)
            });
    }

    document.getElementById('subscribe_btn').onclick = guiSubscribePanel;
    document.getElementById('subscribe_return_btn').onclick = function () { guiInfo(''); guiShowPanel('dialer_panel'); }
    document.getElementById('send_init_subscribe_btn').onclick = guiSendInitSubscribe;
    document.getElementById('send_next_subscribe_btn').onclick = guiSendNextSubscribe;
    document.getElementById('send_unsubscribe_btn').onclick = guiSendUnsubscribe;
    document.getElementById('send_notify_btn').onclick = guiSendNotify;
    document.getElementById('send_final_notify_btn').onclick = guiSendFinalNotify;
    document.getElementById('send_initial_and_next_subscribe_btn').onclick = guiSendInitAndNextSubscribe;

    // For Chrome only
    if (phoneConfig.keepAliveBeep > 0 && phone.getBrowser() === 'chrome') {
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                ac_log('Phone: page is hidden: start sending keep alive beep');
                if (audioPlayer.isDisabled()) {
                    ac_log('Warning: cannot play keep alive beep, because sound is not enabled');
                    return;
                }
                keepAliveBeepJob = setInterval(() => {
                    audioPlayer.playShortSound(SoundConfig.play.keepAliveBeep);
                }, phoneConfig.keepAliveBeep * 1000);
            } else {
                ac_log('Phone: page is visible: stop sending keep alive beep');
                if (keepAliveBeepJob)
                    clearInterval(keepAliveBeepJob);
            }
        });
    }
}

/*
 * Support of Chrome Audio Policy.
 * Important: work only when called in GUI event callback (likes button click)
 */
function guiEnableSound() {
    if (!audioPlayer.isDisabled())
        return;
    ac_log('Let enable sound...');
    audioPlayer.enable()
        .then(() => {
            ac_log('Sound is enabled')
            guiHide('enable_sound_btn');
        })
        .catch((e) => {
            ac_log('Cannot enable sound', e);
        });
}

function guiSetCamera() {
    document.getElementById('video_call_btn').disabled = !hasCamera;
}

function guiAnswerCall(videoOption) {
    guiEnableSound();
    guiNotificationClose();

    // restore button values to initial state
    document.getElementById('hold_btn').value = 'Hold';
    document.getElementById('mute_audio_btn').value = 'Mute';
    document.getElementById('mute_video_btn').value = 'Mute video';

    guiShowPanel('call_established_panel');

    // Some values to testing. Please don't use in production.
    let extraHeaders = ['X-Greeting: You are welcome !']
    activeCall.answer(videoOption, extraHeaders);
}

// Find last outgoing call from call log history, and set it in dialer
function guiRedialLastCall() {
    guiEnableSound();
    let callTo = document.querySelector('#call_form [name=call_to]');
    for (let index = callLogDb.list.length - 1; index >= 0; index--) {
        let logRecord = callLogDb.list[index];
        if (!logRecord.incoming) {
            callTo.value = logRecord.user;
            break;
        }
    }
    callTo.focus();
}

// Try to restore call terminated by page reloading
function guiRestoreCall(restoreData) {
    let restore = JSON.parse(restoreData);
    let delay = Math.ceil(Math.abs(restore.time - new Date().getTime()) / 1000);
    if (delay > phoneConfig.restoreCallMaxDelay) {
        ac_log('No restore call, delay is too long (' + delay + ' seconds)');
        return false;
    }
    ac_log('Trying to restore call', restore);
    outStatus_call_user(restore.callTo);
    outStatus_call_progress('');            
    
    updateCall_established_user(restore.callTo);
    let videoOption = hasCamera && (restore.video === 'sendrecv' || restore.video === 'sendonly') ? phone.VIDEO : phone.AUDIO;
    guiMakeCallTo(restore.callTo, videoOption, ['Replaces: ' + restore.replaces], { 'restoreCall': restore });
    return true;
}

function guiMakeCall(videoOption) {
    guiEnableSound();
    if (activeCall !== null)
        throw 'Already exists active call';
    let callTo = document.querySelector('#call_form [name=call_to]').value.trim();
    if (callTo === '')
        return;
    document.querySelector('#call_form [name=call_to]').value = '';
    outStatus_call_user(callTo);
    outStatus_call_progress('');            
    updateCall_established_user(callTo);
    guiMakeCallTo(callTo, videoOption);
}

function guiMakeCallTo(callTo, videoOption, extraHeaders = null, extraData = null) {
    document.getElementById('local_video').style.display = 'block';
    document.getElementById('remote_video').style.display = 'block';

    guiInfo('Outbound call in progress');
    guiShowPanel('outgoing_call_panel');

    // Some extra headers to testing. Please don't use the test strings in production !
    if (!extraHeaders) {
        extraHeaders = ['X-Greeting: Nice to see you!'];
    }

    activeCall = phone.call(videoOption, callTo, extraHeaders);
    if (extraData !== null) {
        Object.assign(activeCall.data, extraData);
    }

    // create new call log record
    let time = activeCall.data['_create_time'].getTime();
    let logRecord = {
        id: callLogDb.createId(time),
        time: time,
        duration: -1,
        incoming: false,
        user: activeCall.data['_user'],
        display_name: activeCall.data['_display_name']
    };

    activeCall.data['log_record'] = logRecord;
    guiAddLog(logRecord, 'call_log_ul');
    callLogDb.add(logRecord)
        .then(() => {
            ac_log('call-log db: added');
        })
        .catch((e) => {
            ac_log('call-log db: add error', e);
        });
}

function guiRejectCall() {
    guiEnableSound();
    guiNotificationClose();
    if (activeCall !== null) {
        activeCall.reject();
        activeCall = null;
    }
    guiShowPanel('dialer_panel');
}

function guiRedirectCall() {
    guiEnableSound();
    audioPlayer.stop();
    guiNotificationClose();
    guiShowPanel('redirect_call_panel');
}

function guiDoRedirectCall() {
    let redirectTo = document.querySelector('#redirect_form [name=redirect_to]').value.trim();
    if (redirectTo === '') {
        guiRejectCall();
        return;
    }
    if (activeCall !== null) {
        activeCall.redirect(redirectTo);
        activeCall = null;
    }
    guiShowPanel('dialer_panel');
}

function guiDoTransferCall() {
    let transferTo = document.querySelector('#transfer_form [name=transfer_to]').value.trim();
    guiShowPanel('call_established_panel');
    if (transferTo !== '') {
        document.getElementById('blind_transfer_btn').disabled = true;
        blindTransfer(transferTo);
    }
}

async function blindTransfer(transferTo) {
    ac_log('blind transfer ' + transferTo);

    //  wait until active call be on hold
    while (activeCall !== null && !activeCall.isLocalHold()) {
        try {
            await guiHold(true);
        } catch (e) {
            await new Promise(resolve => setTimeout(resolve, 1000));
        }
    }
    if (activeCall === null)
        return;
    // To prevent user un-hold call during call transfer
    document.getElementById('hold_btn').disabled = true;

    // send REFER
    activeCall.sendRefer(transferTo);
}

function guiHangup() {
    guiEnableSound();
    guiNotificationClose();
    if (activeCall !== null) {
        activeCall.terminate();
        activeCall = null;
    }
    guiShowPanel('dialer_panel');
}

function guiClearVideoView() {
    document.getElementById('local_video').srcObject = null;
    document.getElementById('remote_video').srcObject = null;
}

/*
 * Start/Stop sending video
 */
function guiToggleSendVideo() {
    if (activeCall === null) {
        ac_log('send video: no active call');
        return;
    }
    //guiInfo('');
    let sendVideoBtn = document.getElementById('send_video_btn');
    if (!activeCall.hasEnabledSendVideo()) {
        sendVideoBtn.disabled = true;
        activeCall.startSendingVideo()
            .then(() => {
                sendVideoBtn.value = 'Stop sending video';
                guiShowVideoControls(activeCall);
                guiShowLocalVideo(!userPref.hideLocalVideo);
                let remoteVideo = document.getElementById('remote_video');
                setVideoElementVisibility(remoteVideo, activeCall.hasReceiveVideo());
                setEnableReceiveVideoButton();
            })
            .catch((e) => {
                ac_log('start sending video failure', e);
            })
            .finally(() => {
                sendVideoBtn.disabled = false;
            });
    } else {
        sendVideoBtn.disabled = true;
        activeCall.stopSendingVideo()
            .then(() => {
                sendVideoBtn.value = 'Start sending video';
                guiShowVideoControls(activeCall);
                guiShowLocalVideo(false);
                let remoteVideo = document.getElementById('remote_video');
                setVideoElementVisibility(remoteVideo, activeCall.hasReceiveVideo());
                setEnableReceiveVideoButton();
            })
            .catch((e) => {
                ac_log('stop sending video failure', e);
            })
            .finally(() => {
                sendVideoBtn.disabled = false;
            });
    }
}

function guiToggleHold() {
    if (activeCall === null) {
        ac_log('toggle hold: no active call');
        return;
    }
    guiHold(!activeCall.isLocalHold());
}

// Start/stop screen sharing. To screen sharing used the same video track as for sending video.
async function guiToggleScreenSharing() {
    if (activeCall === null) {
        ac_log('guiToggleScreenSharing: no active call');
        return;
    }
    let screenSharingBtn = document.getElementById('screen_sharing_btn');
    let sendVideoBtn = document.getElementById('send_video_btn');
    //guiInfo('');
    if (!activeCall.isScreenSharing()) {
        return Promise.resolve()
            .then(() => {
                if (screenSharingStream === null) {
                    return phone.openScreenSharing()
                        .then(stream => {
                            screenSharingStream = stream;
                        });
                }
            })
            .then(() => {
                screenSharingBtn.disabled = true;
                sendVideoBtn.value = 'Start sending video';
                sendVideoBtn.disabled = true;
                return activeCall.startScreenSharing(screenSharingStream);
            })
            .then(() => {
                screenSharingBtn.value = 'Stop screen sharing';
                sendVideoBtn.value = 'Start sending video';
                sendVideoBtn.disabled = true;
                setEnableReceiveVideoButton();
                // Optional check if other side receive the video.
                if (!activeCall.hasSendVideo()) {
                    ac_log('Warning: Currently other side does not accept the screen sharing video');
                    guiWarning('Currently other side does not accept the screen sharing video');
                }
            })
            .catch((e) => {
                sendVideoBtn.disabled = !hasCamera;
                ac_log('guiScreenSharing: error: ' + e);
            })
            .finally(() => {
                screenSharingBtn.disabled = false;
            });
    } else {
        // Note: GUI updated in callScreenSharingEnded callback
        return activeCall.stopScreenSharing();
    }
}

function guiSendReInvite() {
    if (activeCall === null) {
        ac_log('send re-INVITE: no active call');
        return;
    }
    activeCall.sendReInvite();
}

function setEnableReceiveVideoButton() {
    if (activeCall !== null)
        document.getElementById('enable_receive_video_btn').value = (activeCall.hasEnabledReceiveVideo() ? 'Disable' : 'Enable') + ' receive video';
}

function guiEnableReceiveVideo() {
    if (activeCall === null) {
        ac_log('enable receive video: no active call');
        return;
    }
    let receive = activeCall.hasEnabledReceiveVideo();
    let hasTransceiver = activeCall.enableReceiveVideo(!receive);
    setEnableReceiveVideoButton();
    if (hasTransceiver) {
        activeCall.sendReInvite({ showStreams: true });
    }
}

function guiSendInfo() {
    // Send data using in-dialog SIP INFO
    if (activeCall === null) {
        ac_log('send INFO: no active call');
        return;
    }
    let data = {
        location: 'Haifa',
        attractions: ['Bahai Gardens', 'Carmelite Monastery', 'Beaches', 'Hecht Museum']
    };
    activeCall.sendInfo(JSON.stringify(data), 'application/json');
}

function guiHold(hold) {
    ac_log('guiHold set ' + hold);
    document.getElementById('hold_btn').disabled = true;
    return activeCall.hold(hold)
        .catch(() => {
            ac_log('hold/unhold - failure');
        })
        .finally(() => {
            document.getElementById('hold_btn').disabled = false;
        });
}

function guiSendDTMF(key) {
    if (activeCall != null) {
        audioPlayer.play(Object.assign({ 'name': key }, SoundConfig.play.dtmf));
        activeCall.sendDTMF(key);
    }
}

function guiToggleDTMFKeyPad() {
    if (guiIsHidden('dtmf_keypad')) {
        ac_log('show DTMF keypad');
        document.getElementById('keypad_btn').value = 'Close keypad';
        guiShow('dtmf_keypad');
    } else {
        ac_log('hide DTMF keypad');
        document.getElementById('keypad_btn').value = 'Keypad';
        guiHide('dtmf_keypad');
    }
}

function guiMuteAudio() {
    let muted = activeCall.isAudioMuted();
    activeCall.muteAudio(!muted);
    document.getElementById('mute_audio_btn').value = !muted ? 'Unmute' : 'Mute';
}

function guiMuteVideo() {
    let muted = activeCall.isVideoMuted();
    activeCall.muteVideo(!muted);
    document.getElementById('mute_video_btn').value = !muted ? 'Unmute video' : 'Mute video';
}

function guiToggleLocalVideo() {
    let hide = userPref.hideLocalVideo = document.getElementById('hide_local_video_ckb').checked;
    userPref.hideLocalVideo = hide;
    guiStoreUserPref(userPref);
    guiShowLocalVideo(!hide);
}

function guiShowLocalVideo(show) {
    ac_log(`${show ? 'show' : 'hide'} local video`);
    if (activeCall === null) {
        ac_log('activeCall is null');
        return;
    }
    let localVideo = document.getElementById('local_video');
    localVideo.volume = 0.0;
    localVideo.mute = true;
    setVideoElementVisibility(localVideo, show);
    if (show) {
        localVideo.srcObject = activeCall.getRTCLocalStream();
    } else {
        localVideo.srcObject = null;
    }
}

function guiShowVideoControls(call) {
    let send = call.hasSendVideo();
    let receive = call.hasReceiveVideo();
    let videoControls = document.getElementById('video_controls_span');
    let muteVideoBtn = document.getElementById('mute_video_btn');
    videoControls.style.display = (send || receive) ? 'inline' : 'none';
    muteVideoBtn.disabled = !send;
}

// Video size. Preset or custom.
function guiSetVideoSizeControl(selectedSize) {
    let options = document.getElementById('video_size_select')
    // Set selected property in options
    for (let i = 0; i < options.length; i++) {
        let option = options[i];
        option.selected = (option.value === selectedSize);
    }
}

function guiVideoSizeChanged(save = true) {
    let size = document.getElementById('video_size_select').value;
    if (size === 'Reset Custom') {
        userPref.videoCustom = {
            local: {
                size: 'Tiny',
                top: 'auto',
                left: 'auto'
            },
            remote: {
                size: 'Small',
                top: 'auto',
                left: 'auto'
            }
        };
        size = 'Custom';
        guiSetVideoSizeControl(size);
    }

    let localVideo = document.getElementById('local_video');
    let remoteVideo = document.getElementById('remote_video');

    let isCustom = (size === 'Custom');
    guiSetVideoStyles(isCustom);
    guiUseMouse(isCustom);

    if (isCustom) {
        if (localVideo.style.height !== '0px') {
            let lpref = userPref.videoCustom.local;
            guiSetVideoSize(localVideo, lpref.size);
            guiSetVideoPos(localVideo, lpref.left, lpref.top);
        }

        let rpref = userPref.videoCustom.remote;
        guiSetVideoSize(remoteVideo, rpref.size);
        guiSetVideoPos(remoteVideo, rpref.left, rpref.top);
    } else {
        if (localVideo.style.height !== '0px') {
            guiSetVideoSize(localVideo, size);
        }
        guiSetVideoSize(remoteVideo, size);
    }

    if (save) {
        userPref.videoSize = size;
        guiStoreUserPref(userPref);
    }
}

function guiSetVideoSize(video, size) {
    let s = videoSizes[size];
    video.style.width = s.width;
    video.style.height = s.height;
    video.dataset.size = size; // used to mouse size changing
}

function guiSetVideoPos(video, left, top) {
    video.style.left = left;
    video.style.top = top;
}

// In custom mode, video controls can overlap one other.
function guiSetVideoStyles(isCustom) {
    let localVideo = document.getElementById('local_video');
    let remoteVideo = document.getElementById('remote_video');
    localVideo.style.position = isCustom ? 'absolute' : 'static';
    remoteVideo.style.position = isCustom ? 'absolute' : 'static';
    remoteVideo.style['z-index'] = isCustom ? -1 : 'auto';
    if (!isCustom) {
        localVideo.left = localVideo.top = remoteVideo.left = remoteVideo.top = 'auto';
    }
}

/*
 * In 'custom' size mode,let use mouse to drag video panel, and mouse wheel to change video panel size.
 */
let mousedata = { localVideo: null, video: null, x0: null, y0: null, left: null, top: null };

function guiUseMouse(use) {
    let localVideo = document.getElementById('local_video');
    let remoteVideo = document.getElementById('remote_video');
    document.removeEventListener('mousemove', eventMouseMove);
    document.removeEventListener('mouseup', eventMouseUp);
    localVideo.removeEventListener('wheel', eventMouseWheel, { passive: true });
    remoteVideo.removeEventListener('wheel', eventMouseWheel, { passive: true });
    localVideo.removeEventListener('mousedown', eventMouseDown);
    remoteVideo.removeEventListener('mousedown', eventMouseDown);
    if (!use)
        return;
    localVideo.addEventListener('wheel', eventMouseWheel, { passive: true });
    remoteVideo.addEventListener('wheel', eventMouseWheel, { passive: true });
    localVideo.addEventListener('mousedown', eventMouseDown);
    remoteVideo.addEventListener('mousedown', eventMouseDown);
    mousedata.localVideo = localVideo;
}

function eventMouseDown(e) {
    mousedata.video = e.currentTarget; // video used in mousemove and mouseup events.
    ac_log(`mousedown: start dragging ${mousedata.video === mousedata.localVideo ? 'local' : 'remote'} video`);
    document.addEventListener('mouseup', eventMouseUp);
    document.addEventListener('mousemove', eventMouseMove);
    mousedata.x0 = e.clientX; // save initial values
    mousedata.y0 = e.clientY;
    mousedata.left = mousedata.video.offsetLeft;
    mousedata.top = mousedata.video.offsetTop;
}

function eventMouseMove(e) {
    mousedata.video.style.left = (mousedata.left + e.clientX - mousedata.x0) + 'px';
    mousedata.video.style.top = (mousedata.top + e.clientY - mousedata.y0) + 'px';
}

function eventMouseUp() {
    ac_log('mouseup: stop dragging');
    document.removeEventListener('mousemove', eventMouseMove);
    document.removeEventListener('mouseup', eventMouseUp);
    let pref = (mousedata.video === mousedata.localVideo) ? userPref.videoCustom.local : userPref.videoCustom.remote;
    pref.left = mousedata.video.style.left;
    pref.top = mousedata.video.style.top;
    guiStoreUserPref(userPref);
}

function eventMouseWheel(e) {
    let video = e.currentTarget;
    let size = video.dataset.size;
    let increase = e.deltaY < 0;
    let newSize = changeVideoSize(increase, size);
    ac_log(`mousewheel: ${video === mousedata.localVideo ? 'local' : 'remote'} video: size: ${size} -> ${newSize}`);
    if (!newSize)
        return; // cannot change size anymore
    guiSetVideoSize(video, newSize);
    let pref = (video === mousedata.localVideo) ? userPref.videoCustom.local : userPref.videoCustom.remote;
    pref.size = newSize;
    guiStoreUserPref(userPref);
}

function changeVideoSize(increase, size) {
    let ix = videoSizesSeq.findIndex((str) => size === str);
    if (ix === -1) return null;
    ix += increase ? 1 : -1;
    return ix >= 0 && ix < videoSizesSeq.length ? videoSizesSeq[ix] : null;
}


//----------------- Local storage load/store ----------------------
function guiLoadAccount() { return storageLoadConfig('phoneAccount'); }

function guiStoreAccount(value) { storageSaveConfig('phoneAccount', value); }

function guiLoadServerConfig() { return storageLoadConfig('phoneServerConfig', DefaultServerConfig); }

function guiStoreServerConfig(value) { storageSaveConfig('phoneServerConfig', value, DefaultServerConfig); }

function guiLoadPhoneConfig() { return storageLoadConfig('phoneConfig', DefaultPhoneConfig, true, true); }

function guiLoadUserPref() { return storageLoadConfig('phoneUserPref', DefaultUserPref, false, false); }

function guiStoreUserPref(value) { storageSaveConfig('phoneUserPref', value, DefaultUserPref); }

function guiLoadSelectedDevices() { return storageLoadConfig('phoneSelectedDevices'); }

function guiStoreSelectedDevices(value) { storageSaveConfig('phoneSelectedDevices', value); }

//----------- set server and account fields in HTML ------------
function guiSetServerFields(server_config) {
    document.querySelector('#setting [name=sip_domain]').value = server_config.domain;
    document.querySelector('#setting [name=sip_addresses]').value = JSON.stringify(server_config.addresses);
    // An empty array seems strange to a non-programmer ;-)
    let ice = JSON.stringify(server_config.iceServers);
    if (ice === '[]')
        ice = '';
    document.querySelector('#setting [name=ice_servers]').value = ice;
}

function guiSetAcountFields(account) {
    document.querySelector('#setting [name=user]').value = account.user;
    document.querySelector('#setting [name=password]').value = account.password;
    document.querySelector('#setting [name=display_name]').value = account.displayName;
    document.querySelector('#setting [name=auth_user]').value = account.authUser;
}

//------------- Set status line --------------------
function guiError(text) { guiStatus(text, 'Pink'); }

function guiWarning(text) { guiStatus(text, 'Gold'); }

function guiInfo(text) { guiStatus(text, 'LightGrey'); }

function guiStatus(text, color) {
    let line = document.getElementById('status_line');
    line.setAttribute('style', `background-color: ${color}`);
    line.innerHTML = text;
}

function outStatus_call_user(text) {
    let line = document.getElementById('outgoing_call_user');
    line.setAttribute('style', `background-color: Gold`);
    line.innerHTML = text;
}

function outStatus_call_progress(text) {
    let line = document.getElementById('outgoing_call_progress');
    line.setAttribute('style', `background-color: Aquamarine`);
    line.innerHTML = text;
}

function updateCall_established_user(text) {
    let line = document.getElementById('outgoing_call_progress');
    line.setAttribute('style', `background-color: Aquamarine`);
    line.innerHTML = text;
}

function updateIncoming_call_user(text) {
    let line = document.getElementById('incoming_call_user');
    line.setAttribute('style', `background-color: Aquamarine`);
    line.innerHTML = text;
}



//--------------- Show or hide element -------
function guiShow(id) {
    document.getElementById(id).style.display = 'block';
}

function guiHide(id) {
    document.getElementById(id).style.display = 'none';
}

function guiIsHidden(id) {
    let elem = document.getElementById(id);
    // Instead  elem.style.display, because display set via CSS.
    let display = window.getComputedStyle(elem).getPropertyValue('display');
    return display === 'none';
}

//--------------- Show active panel and hide others  ----------------
function guiShowPanel(activePanel) {
    const panels = ['devices_panel', 'dialer_panel', 'call_log_panel',
        'outgoing_call_panel', 'incoming_call_panel', 'call_established_panel',
        'redirect_call_panel', 'transfer_call_panel', 'message_panel', 'subscribe_panel'
    ];
    for (let panel of panels) {
        if (panel === activePanel) {
            guiShow(panel);
        } else {
            guiHide(panel);
        }
    }
    // special settings for some panels.
    switch (activePanel) {
        case 'dialer_panel':
            if (!audioPlayer.isDisabled())
                guiHide('enable_sound_btn');
            break;
    }
}

//-------- Desktop notification (for incoming call) ---------
function registerServiceWorker() {
    if (!navigator.serviceWorker) {
        ac_log('phone: The browser does not support Service Worker');
        return;
    }
    return navigator.serviceWorker.register('../service-worker.js', { scope: '.' })
        .then(rsw => {
            if (typeof rsw.showNotification !== 'function' || typeof rsw.getNotifications !== 'function') {
                ac_log('phone: Warning: serviceWorker.showNotification() is not implemented !');
                rsw.unregister();
                return;
            }
            ac_log('phone: service worker registered');
            desktopNotification.rsw = rsw;
            navigator.serviceWorker.addEventListener('message', serviceWorkerAction);
        });
}

function serviceWorkerAction(e) {
    if (e.data.type === 'answer') {
        if (e.data.action === 'accept') {
            let videoOption;
            if (activeCall.data['incoming_invite_hasSDP']) {
                videoOption = activeCall.hasVideo() ? (hasCamera ? phone.VIDEO : phone.RECVONLY_VIDEO) : phone.AUDIO;
            } else {
                videoOption = phoneConfig.audioAutoAnswerNoSdp ? phone.AUDIO : phone.VIDEO;
            }
            guiAnswerCall(videoOption);
        } else if (e.data.action === 'reject') {
            guiRejectCall();
        }
    }
}

function guiRequestNotificationPermission() {
    guiHide('notification_permission_btn');
    Notification.requestPermission();
}

function guiNotificationShow(caller) {
    if (!window.Notification)
        return;
    if (Notification.permission !== "granted")
        return;
    if (desktopNotification.rsw) {
        guiNotificationShowSW(caller);
    } else {
        guiNotificationShowBasic(caller);
    }
}

function guiNotificationShowSW(caller) {
    let options = {
        image: 'images/in_green.png',
        actions: [
            { action: 'accept', title: 'Accept' /*, icon:'images/in_green.png' */ },
            { action: 'reject', title: 'Reject' /*, icon: 'images/in_red.png'*/ },
        ],
    }
    ac_log('show notification [service worker]');
    desktopNotification.rsw.showNotification("Calling " + caller, options);
}

function guiNotificationShowBasic(caller) {
    guiNotificationClose();
    try {
        const options = {
            image: 'images/in_green.png',
            requireInteraction: true
        }
        ac_log('show notification [basic]');
        desktopNotification.basic = new Notification("Calling " + caller, options);
        ac_log('desktopNotification created');
        desktopNotification.basic.onclick = function (event) {
            event.target.close();
            desktopNotification.basic = null;
        }
    } catch (e) {
        ac_log('cannot create Notification', e);
    }
}

function guiNotificationClose() {
    if (desktopNotification.rsw) {
        desktopNotification.rsw.getNotifications()
            .then(notifications => {
                for (let notification of notifications) {
                    ac_log('desktopNofification.close() [service worker]');
                    notification.close();
                }
            });
    } else {
        if (desktopNotification.basic) {
            desktopNotification.basic.close();
            desktopNotification.basic = null;
            ac_log('desktopNofification.close() [basic]');
        }
    }
}

/*
 * Work with some UL list.
 * Used for call log and text messages
 */
// Add li element to top (or to bottom). If need remove oldest element.
function guiListAdd(newLI, listId, maxSize, top = true) {
    let list = document.getElementById(listId);
    if (top) {
        list.insertBefore(newLI, list.childNodes[0]);
    } else {
        list.appendChild(newLI);
    }
    if (list.getElementsByTagName("LI").length > maxSize) {
        list.removeChild(top ? list.lastElementChild : list.childNodes[0]);
    }
}

// Search in list LI element by unique ID, and update it.
function guiListUpdate(newLI, id, listId) {
    let list = document.getElementById(listId);
    let oldLI = null;
    let elems = list.getElementsByTagName("LI");
    for (let i = 0; i < elems.length; i++) { // without "for of" to compatibility with Edge
        let li = elems[i];

        if (li.dataset.id === id) {
            oldLI = li;
            break;
        }
    }
    if (!oldLI) {
        return;
    }
    list.replaceChild(newLI, oldLI);
}

// Clear log list.
function guiListClear(listId) {
    let list = document.getElementById(listId);
    while (list.firstChild) {
        list.firstChild.remove();
    }
}

function guiListDelete(li) {
    li.parentNode.removeChild(li);
}

/* ---------------- Call log record ----------------
 * To keep call logs after page reload it saved in indexedDB.
 *
 * Log record:
 * 'id'       - fixed length string, build from time and sequence number.
 * 'time'     - call creation time (ms from 1970, date.getTime())
 * 'incoming' - call is incoming (true/false)
 * 'user'     - remote user name
 * 'display_name' - remote user display name
 * 'duration' time interval between call confirmation and hangup,
 *  has two special values: -1 or 0
 *
 *    at creation until confirmed, or when failed set to -1
 *    after call confirmed updated to 0
 *    after call ended updated to real value (sec)
 *
 * So you can separate failed call (-1) from established call with
 * unknown duration (0).
 * The unknown duration can be set, if phone page was reloaded during call.
 */
/* ---------------- Call log GUI---------------------*/
// Create LI for log record
function guiCreateLogLI(logRecord) {
    let str = new Date(logRecord.time).toLocaleDateString('en-GB', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
        hour12: false,
        hour: '2-digit',
        minute: '2-digit',
    });
    str += ' <b>' + logRecord.user;
    if (logRecord.display_name)
        str += ' "' + logRecord.display_name + '"';
    str += '</b> ';
    if (logRecord.duration >= 0)
        str += logRecord.duration + ' sec';
    let li = document.createElement('li');
    li.innerHTML = str;
    li.dataset.id = logRecord.id;
    // icon selected by class name.
    let className = `${logRecord.incoming ? 'in_' : 'out_'}${logRecord.duration >= 0 ? 'green' : 'red'}`;
    li.classList.add(className);
    return li;
}

function guiAddLog(logRecord) {
    guiListAdd(guiCreateLogLI(logRecord), 'call_log_ul', callLogDb.maxSize);
}

function guiUpdateLog(logRecord) {
    guiListUpdate(guiCreateLogLI(logRecord), logRecord.id, 'call_log_ul')
}

function guiClearLog() {
    guiListClear('call_log_ul');
}

// Get user from call log, and set it in dialer panel.
function guiClickOnCallLog(ev) {
    let target = ev.target;
    ac_log('clicked on call log:', target);
    if (target.nodeName !== 'LI')
        return;
    let id = target.dataset.id;
    let index = callLogDb.list.findIndex((r) => r.id === id);
    if (index === -1) // should not be.
        return;
    let logRecord = callLogDb.list[index];
    let callTo = document.querySelector('#call_form [name=call_to]');
    callTo.value = logRecord.user;
    guiShowPanel('dialer_panel');
    callTo.focus();
}

/* ---------------- Messages GUI---------------------*/
function guiMessage() {
    guiEnableSound();
    guiShowPanel('message_panel');

    // Clear new messages visual notification
    userPref.newMessages = 0;
    guiStoreUserPref(userPref);
    let button = document.getElementById('message_btn');
    button.innerText = 'Messages';
    button.classList.remove('new_message');
}

/* Create LI for message */
function guiCreateMessageLI(msg) {
    let li = document.createElement('li');
    li.innerHTML = `<tt>${createDateTimestamp(msg.time)}</tt> ${msg.incoming ? 'from ' : 'to '}<b>${msg.user}</b> <span class="${msg.incoming ? 'incoming_message' : 'outgoing_message'}">"${msg.body}"</span>`;
    return li;
}

function guiClearMessages() {
    guiListClear('message_ul');
}

function guiAddMessage(msg) {
    guiListAdd(guiCreateMessageLI(msg), 'message_ul', MessageDb.maxSize, false);
}

function guiSendMessage() {
    let sendTo = document.querySelector('#send_message_form [name=send_to]').value.trim();
    let textArea = document.querySelector('#send_message_form [name=message]');
    let text = textArea.value.trim();
    if (sendTo === '' || text === '')
        return;

    let time = new Date();
    let contentType = 'text/plain';

    phone.sendMessage(sendTo, text, contentType)
        .then((e) => {
            ac_log('message sent', e);

            guiInfo('Message sent');
            textArea.value = '';

            // split sendTo to user and optional host
            let ix = sendTo.indexOf('@');
            let user = ix === -1 ? sendTo : sendTo.substring(0, ix);
            let host = ix === -1 ? null : sendTo.substring(ix + 1);

            let message = {
                id: callLogDb.createId(time),
                incoming: false,
                time: time,
                user: user,
                display_name: null,
                host: host,
                contentType: contentType,
                body: text
            };

            guiAddMessage(message);

            messageDb.add(message)
                .then(() => {
                    ac_log('message db: added');
                })
                .catch((e) => {
                    ac_log('message db: add error', e);
                });
        })
        .catch((e) => {
            ac_log('message sending error', e);
            guiError('Cannot send message: ' + e.cause);
        });
}


//--------------- SUBSCRIBE/NOTIFY examples -------------------------------
function guiSubscribePanel() {
    guiEnableSound();
    guiInfo('');
    guiShowPanel('subscribe_panel');
    guiSubscribeButtons();
}

function guiSubscribeButtons() {
    document.getElementById('send_init_subscribe_btn').disabled = !!subscriber;
    document.getElementById('send_initial_and_next_subscribe_btn').disabled = !!subscriber;
    document.getElementById('send_next_subscribe_btn').disabled = !subscriber;
    document.getElementById('send_unsubscribe_btn').disabled = !subscriber;
    document.getElementById('send_notify_btn').disabled = !notifier;
    document.getElementById('send_final_notify_btn').disabled = !notifier;
}

//--------------- subscriber (client subscribe dialog)  -------------------

function guiSendInitSubscribe() {
    let user = document.querySelector('#subscribe_test_setting_form [name=user]').value.trim();
    let eventName = document.querySelector('#subscribe_test_setting_form [name=event_name]').value.trim();
    let accept = document.querySelector('#subscribe_test_setting_form [name=accept]').value.trim();
    let contentType = document.querySelector('#subscribe_test_setting_form [name=content_type]').value.trim();
    let expires = parseInt(document.querySelector('#subscribe_test_setting_form [name=expires]').value.trim());
    if (user === '') {
        guiWarning('Missed user name');
        return;
    }

    let target = user; // + '@' + serverConfig.domain;
    let params = null;

    /* 
       params is optional.
       Used if domain or from-user is different from used in REGISTER/INVITE

       let params = {
        to_uri: new JsSIP.URI('sip', user, serverConfig.domain),
        to_display_name: null,
        from_uri: new JsSIP.URI('sip', userAccount.user, serverConfig.domain),
        from_display_name: null,
    }
    */
    try {
        subscriber = phone.subscribe(
            target,
            eventName,
            accept, {
            expires,
            contentType,
            params
        });
    } catch (e) {
        ac_log('Error: cannot create subscriber', e);
        guiError('Cannot create subscriber');
    }

    /**
     * Active event
     * Received the first NOTIFY with Subscription-State: active
     */
    subscriber.on('active', () => {
        ac_log('subscriber>> active')
        guiInfo('subscriber: active');
    });

    /** 
     * Incoming NOTIFY with body event
     * If NOTIFY Subscription-State: terminated - the argument isFinal = true 
     */
    subscriber.on('notify', (isFinal, notify, body, contentType) => { // with not empty body
        ac_log(`subscriber>> receive ${isFinal ? 'final ' : ''}NOTIFY`, notify, body, contentType);
        guiInfo(`receive ${isFinal ? 'final ' : ''}notify`);
    });

    /**
     * Subscription terminated. 
     * 
     * Termination code converted to English text.
     * 
     * For terminationCode==RECEIVE_FINAL_NOTIFY may be set 
     * SubscriptionState header parameters:
     *   reason  (undefined or string)
     *   retryAfter (undefined or number)
     */
    subscriber.on('terminated', (terminationCode, reason, retryAfter) => {
        let terminationText = subscriberTerminationText(subscriber, terminationCode);
        ac_log(`subscriber>>: terminated (${terminationText})${reason ? (' reason="' + reason + '"') : ''}${retryAfter !== undefined ? (' retry-after=' + retryAfter) : ''}`);
        guiWarning(`subscriber: terminated (${terminationText})${reason ? (' reason="' + reason + '"') : ''}`);
        subscriber = null;
        if (retryAfter !== undefined) {
            ac_log(`You asked repeat subscription after ${retryAfter} seconds`);
        }
        guiSubscribeButtons();
    });

    /**
     * Subscribe dialog created (subscribe OK received)
     * Next after initial subscribe can be send only after the event
     * 
     * If you send sequence: initial subscribe and immediately next subscribe,
     * next subscribe should be enqueued and send after the event.
     * (See subscribe enqueue example in ACD phone prototype broadsoft_acd.js)
     */
    subscriber.on('dialogCreated', () => {
        ac_log('subscriber>>: dialogCreated');
    });

    if (expires > 0) {
        // normal subscribe
        subscriber.subscribe();
    } else {
        // fetch SUBSCRIBE (with expires: 0), see RFC 6665 4.4.3
        subscriber.terminate();
    }
    guiSubscribeButtons();
}


// Send next SUBSCRIBE (after initial)
function guiSendNextSubscribe() {
    if (subscriber === null || subscriber.state === subscriber.C.STATE_TERMINATED) {
        guiWarning('No subscriber');
        return;
    }
    let body = JSON.stringify({ text: "Next subscribe body" });
    subscriber.subscribe(body);
}

// After initial immediately send next subscribe.
// Next subscribe cannot be send before response to initial subscribe,
// so will be used enqueue & dequeue.
function guiSendInitAndNextSubscribe() {
    guiSendInitSubscribe();
    if (subscriber) {
        guiSendNextSubscribe();
        //guiSendUnsubscribe();
    }
}

// Send unSubscribe (SUBSCRIBE with expires: 0)
function guiSendUnsubscribe() {
    if (subscriber === null || subscriber.state === subscriber.C.STATE_TERMINATED) {
        guiWarning('No subscriber');
        return;
    }
    subscriber.terminate();
}

function subscriberTerminationText(subscriber, terminationCode) {
    if (!subscriber)
        return `subscriber terminated with code ${terminationCode}`;
    switch (terminationCode) {
        case subscriber.C.SUBSCRIBE_RESPONSE_TIMEOUT: return 'subscribe response timeout';
        case subscriber.C.SUBSCRIBE_TRANSPORT_ERROR: return 'subscribe transport error';
        case subscriber.C.SUBSCRIBE_NON_OK_RESPONSE: return 'subscribe non-OK response';
        case subscriber.C.SUBSCRIBE_BAD_OK_RESPONSE: return 'subscribe bad OK response (missed Contact)';
        case subscriber.C.SUBSCRIBE_FAILED_AUTHENTICATION: return 'subscribe failed authentication';
        case subscriber.C.UNSUBSCRIBE_TIMEOUT: return 'un-subscribe timeout';
        case subscriber.C.RECEIVE_FINAL_NOTIFY: return 'receive final notify';
        case subscriber.C.RECEIVE_BAD_NOTIFY: return 'receive bad notify';
        default: return 'unknown termination code: ' + terminationCode;
    }
}

//------------ notifier (server subscribe dialog)  ----------------------
//
// In clients, it is used less often than subscriber
// In this test, it is used to debug the subscriber
function createNotifier(subscribe) {
    guiSubscribeButtons();
    let contentType = document.querySelector('#subscribe_test_setting_form [name=content_type]').value.trim();
    let pending = true; // notifier can be created in 'active' or 'pending' state
    notifier = phone.notify(subscribe, contentType, { pending });
    let isFetchSubscribe = subscribe.getHeader('expires') === '0';

    // The event called for intitial and next subscribes.
    notifier.on('subscribe', (isUnsubscribe, subscribe, body, contentType) => {
        ac_log(`notifier>> receive ${isUnsubscribe ? 'un-' : ''}SUBSCRIBE`, subscribe, body, contentType, isUnsubscribe);
        guiInfo('receive subscribe');

        if (isUnsubscribe) {
            notifier.terminate(`Provide current system state (final notify)${isFetchSubscribe ? ' (fetch subscribe)' : ''}`);
        } else {
            if (notifier.state === notifier.C.STATE_PENDING) {
                notifier.notify(JSON.stringify({ text: 'Dialog state is pending. Do not provide system state' }));
            } else {
                notifier.notify(JSON.stringify({ text: 'Provide current system state' }));
            }
        }
    });

    /**
     * Notification terminated
     */
    notifier.on('terminated', (terminationCode, sendFinalNotify) => {
        let terminationText = notifierTerminationText(notifier, terminationCode);
        guiWarning(`notifier: terminated (${terminationText})`);

        // sendFinalNotify=true will be set for subscription timeout.
        // You have to send final NOTIFY in the case (with or without body)
        if (sendFinalNotify) {
            notifier.terminate(JSON.stringify({ text: 'Terminated state. Current data' }));
        }
        notifier = null;
        guiSubscribeButtons();
    });

    notifier.start();
    guiSubscribeButtons();
}

function guiSendNotify() {
    if (notifier === null || notifier.state === notifier.C.STATE_TERMINATED) {
        guiWarning('No notifier');
        return;
    }
    // Switch state from pending to active.
    if (notifier.state === notifier.C.STATE_PENDING) {
        ac_log('Switch state from "pending" to "active"');
        notifier.setActiveState();
    }

    // send NOTIFY with body
    let body = JSON.stringify({ text: 'current system state' });
    notifier.notify(body);
}

function guiSendFinalNotify() {
    if (notifier === null || notifier.state === notifier.C.STATE_TERMINATED) {
        guiWarning('No notifier');
        return;
    }
    // final notify
    // notifier.terminate('final state');

    // final notify with reason and retry-after
    notifier.terminate('final state', 'probation', 20);
}

function notifierTerminationText(notifier, terminationCode) {
    if (!notifier)
        return `notifier terminated with code ${terminationCode}`;
    switch (terminationCode) {
        case notifier.C.NOTIFY_RESPONSE_TIMEOUT: return 'notify response timeout';
        case notifier.C.NOTIFY_TRANSPORT_ERROR: return 'notify transport error';
        case notifier.C.NOTIFY_NON_OK_RESPONSE: return 'notify non-OK response';
        case notifier.C.NOTIFY_FAILED_AUTHENTICATION: return 'notify failed authentication';
        case notifier.C.SEND_FINAL_NOTIFY: return 'send final notify';
        case notifier.C.RECEIVE_UNSUBSCRIBE: return 'receive un-subscribe';
        case notifier.C.SUBSCRIPTION_EXPIRED: return 'subscription expired';
        default: return 'unknown termination code: ' + terminationCode;
    }
}
//---------------- end of SUBSCRIBE/NOTIFY examples ------------------

// Use device list in SelectDevices class instance to fill GUI select list.
function guiFillDeviceList(name) {
    let device = devices.getDevice(name); // name is one of 'microphone', 'speaker', 'camera', 'ringer'
    let selector = document.querySelector(`#devices [name=${name}]`);
    // Clear select push-down list
    while (selector.firstChild) {
        selector.removeChild(selector.firstChild);
    }
    if (device.incomplete) {
        selector.disabled = true;
        ac_log(`Warning: To device selection let enable ${name} usage`);
    } else {
        selector.disabled = false;
    }
    // Loop by device labels and add option elements.
    for (let ix = 0; ix < device.list.length; ix++) {
        let dev = device.list[ix]
        let option = document.createElement("option");
        option.text = dev.label;      // device name
        option.value = ix.toString(); // index in device list
        option.selected = (device.index === ix); // selected device
        selector.add(option);
    }
    document.getElementById(`${name}_dev`).style.display = (device.list.length > 1) ? 'block' : 'none';
}

// Set deviceId constraint for microphone and camera.
// Set deviceId for audioPlayer
function setDeviceIds() {
    let micId = devices.getSelected('microphone').deviceId;
    phone.setConstraint('audio', 'deviceId', userPref.devicesExact && micId ? { exact: micId } : micId);

    let camId = devices.getSelected('camera').deviceId;
    phone.setConstraint('video', 'deviceId', userPref.devicesExact && camId ? { exact: camId } : camId);

    let spkrId = devices.getSelected('speaker').deviceId;
    audioPlayer.setSpeakerId(spkrId);

    let ringId = devices.getSelected('ringer').deviceId
    audioPlayer.setRingerId(ringId);
}

// Set (or remove) deviceId as audio element sinkId for speaker
function setRemoteVideoSinkId(remoteVideo) {
    let deviceId = devices.getSelected('speaker').deviceId;
    if (deviceId === null)
        deviceId = ''; // remove sinkId
    if (remoteVideoDeviceId === deviceId) {
        ac_log('remote video: sinkId is already assigned');
        return Promise.resolve();
    }
    if (!remoteVideo.setSinkId) {
        return Promise.reject(new Error('setSinkId is not implemented'));
    }
    ac_log(`remove video: setSinkId "${deviceId}"`);
    remoteVideo.srcObject = null; // probably setSinkId check srcObject
    return remoteVideo.setSinkId(deviceId)
        .then(() => {
            ac_log('remote video: setSinkId completed');
            remoteVideoDeviceId = deviceId;
        });
}
