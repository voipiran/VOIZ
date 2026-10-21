//
// WebRTC tracer (logging tool)
// For Chrome,Firefox and Safari;
//
// Igor Kolosov AudioCodes Ltd 2020
// Last edit 29-Mar-2020
webrtcTracer = function (showCaller=false) {
    function detectBrowser() {
        if (navigator.mozGetUserMedia) return 'firefox'
        if (navigator.webkitGetUserMedia) return 'chrome';
        if (window.safari !== undefined) return 'safari';
        return 'other';
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

    function caller(withfn) {
        let browser = detectBrowser();
        let st = (new Error()).stack.split('\n');
        let s = st[browser === 'chrome' ? 4 : 3];
        let i = s.lastIndexOf('/');
        let loc = s.substring(i+1);
        i = loc.lastIndexOf(':');
        loc = loc.substring(0, i);
        let func = '';
        if( browser === 'chrome'){
            func = s.trim().split(' ')[1] + '() ';
            if (func.startsWith('https://'))
                func = '';
        } else if(browser === 'firefox' || browser === 'safari'){
            i = s.indexOf('@');
            if( i !== -1 ){
                func = s.substring(0, i) + '() ';
            }
        }
        return (withfn ? func : '') + loc;
    }

    const tlog = function (...args) {
        console.log.apply(console, ['%c' + createTimestamp() + '[webrtc] ' + args[0] +
        (showCaller ? ('\n{' + caller(true) + '}') : ''), 'background:MediumSpringGreen;color:black;',].concat(args.slice(1)));
    }

    if (navigator.mediaDevices.getUserMedia) {
        const origGetUserMedia = navigator.mediaDevices.getUserMedia.bind(navigator.mediaDevices);
        navigator.mediaDevices.getUserMedia = function (...args) {
            tlog('getUserMedia', ...args);
            return origGetUserMedia(...args);
        };
    }

    // RTCPeerConnection
    const origConnectionSetLocalDescription = window.RTCPeerConnection.prototype.setLocalDescription;
    window.RTCPeerConnection.prototype.setLocalDescription = function (...args) {
        tlog('connection setLocalDescription', ...args);
        return origConnectionSetLocalDescription.apply(this, args);
    }

    const origConnectionSetRemoteDescription = window.RTCPeerConnection.prototype.setRemoteDescription;
    window.RTCPeerConnection.prototype.setRemoteDescription = function (...args) {
        tlog('connection setRemoteDescription', ...args);
        return origConnectionSetRemoteDescription.apply(this, args);
    }

    const origConnectionCreateOffer = window.RTCPeerConnection.prototype.createOffer;
    window.RTCPeerConnection.prototype.createOffer = function (...args) {
        tlog('connection createOffer', ...args);
        return origConnectionCreateOffer.apply(this, args);
    }

    const origConnectionCreateAnswer = window.RTCPeerConnection.prototype.createAnswer;
    window.RTCPeerConnection.prototype.createAnswer = function (...args) {
        tlog('connection createAnswer', ...args);
        return origConnectionCreateAnswer.apply(this, args);
    }

    const origConnectionAddTrack = window.RTCPeerConnection.prototype.addTrack;
    window.RTCPeerConnection.prototype.addTrack = function (...args) {
        tlog('connection addTrack', ...args);
        return origConnectionAddTrack.apply(this, args);
    }

    const origConnectionRemoveTrack = window.RTCPeerConnection.prototype.removeTrack;
    window.RTCPeerConnection.prototype.removeTrack = function (...args) {
        tlog('connection removeTrack', ...args);
        return origConnectionRemoveTrack.apply(this, args);
    }

    const origConnectionGetSenders = window.RTCPeerConnection.prototype.getSenders;
    window.RTCPeerConnection.prototype.getSenders = function (...args) {
        let result = origConnectionGetSenders.apply(this, args);
        tlog('connection getSenders', result);
        return result;
    }

    const origConnectionGetReceivers = window.RTCPeerConnection.prototype.getReceivers;
    window.RTCPeerConnection.prototype.getReceivers = function (...args) {
        let result = origConnectionGetReceivers.apply(this, args);
        tlog('connection getReceivers', result);
        return result;
    }

    const origConnectionGetTransceivers = window.RTCPeerConnection.prototype.getTransceivers;
    window.RTCPeerConnection.prototype.getTransceivers = function (...args) {
        let result = origConnectionGetTransceivers.apply(this, args);
        //tlog('connection getTransceivers', result);
        return result;
    }


    const origConnectionIceGatheringState = Object.getOwnPropertyDescriptor(
        window.RTCPeerConnection.prototype, 'iceGatheringState');
    Object.defineProperty(window.RTCPeerConnection.prototype, 'iceGatheringState', {
        get() {
            let value = origConnectionIceGatheringState.get.call(this);
            tlog('connection iceGatheringState: "' + value + '"');
            return value;
        }
    });

    const origConnectionIceConnectionState = Object.getOwnPropertyDescriptor(
        window.RTCPeerConnection.prototype, 'iceConnectionState');
    Object.defineProperty(window.RTCPeerConnection.prototype, 'iceConnectionState', {
        get() {
            let value = origConnectionIceConnectionState.get.call(this);
            tlog('connection iceConnectionState: "' + value + '"');
            return value;
        }
    });

    const origConnectionAddEventListener = window.RTCPeerConnection.prototype.addEventListener;
    window.RTCPeerConnection.prototype.addEventListener = function (...args) {
        tlog('connection addEventListener ' + args[0]);
        return origConnectionAddEventListener.apply(this, args);
    }

    const origConnectionRemoveEventListener = window.RTCPeerConnection.prototype.removeEventListener;
    window.RTCPeerConnection.prototype.removeEventListener = function (...args) {
        tlog('connection removeEventListener ' + args[0]);
        return origConnectionRemoveEventListener.apply(this, args);
    }

    // MediaStream
    const origStreamGetTracks = window.MediaStream.prototype.getTracks;
    window.MediaStream.prototype.getTracks = function (...args) {
        let result = origStreamGetTracks.apply(this, args);
        //tlog('stream getTracks():', result);
        return result;
    }

    const origStreamGetAudioTracks = window.MediaStream.prototype.getAudioTracks;
    window.MediaStream.prototype.getAudioTracks = function (...args) {
        let result = origStreamGetAudioTracks.apply(this, args);
        //tlog('stream getAudioTracks():', result);
        return result;
    }

    const origStreamGetVideoTracks = window.MediaStream.prototype.getVideoTracks;
    window.MediaStream.prototype.getVideoTracks = function (...args) {
        let result = origStreamGetVideoTracks.apply(this, args);
        //tlog('stream getVideoTracks():', result);
        return result;
    }

    const origStreamRemoveTrack = window.MediaStream.prototype.removeTrack;
    window.MediaStream.prototype.removeTrack = function (...args) {
        tlog(`stream removeTrack ${args[0].kind}`);
        return origStreamRemoveTrack.apply(this, args);
    }

    // Media Stream Track
    const origTrackStop = window.MediaStreamTrack.prototype.stop;
    window.MediaStreamTrack.prototype.stop = function (...args) {
        tlog(`${this.kind} track stop()`);
        return origTrackStop.apply(this, ...args);
    }

    const origTrackEnabled = Object.getOwnPropertyDescriptor(
        window.MediaStreamTrack.prototype, 'enabled');
    const origTrackKind = Object.getOwnPropertyDescriptor(
        window.MediaStreamTrack.prototype, 'kind');

    Object.defineProperty(window.MediaStreamTrack.prototype, 'enabled', {
        get() {
            let kind = origTrackKind.get.call(this);
            let enabled = origTrackEnabled.get.call(this);
            //tlog(`${kind} track enabled: ${enabled}`);
            return enabled;
        },
        set(value) {
            let kind = origTrackKind.get.call(this);
            tlog(`${kind} track set enabled=${value}`);
            origTrackEnabled.set.call(this, value);
        }
    });
};