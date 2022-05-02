/*
*******************************************************************************
*
*    JavaScript File for the Vicidial WebRTC Phone
*
*    Copyright (C) 2016  Michael Cargile
*    Version 1.0.0
*
*    This program is free software: you can redistribute it and/or modify
*    it under the terms of the GNU Affero General Public License as
*    published by the Free Software Foundation, either version 3 of the
*    License, or (at your option) any later version.
*
*    This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*    GNU Affero General Public License for more details.
*
*    You should have received a copy of the GNU Affero General Public License
*    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
*******************************************************************************
*/

/* =================== VoipIran ===================== --> */
let voipIranRegiterButton = document.getElementById("register");
let voipIranUnRegiterButton = document.getElementById("unregister");
let voipIranRegStatus = document.getElementById("reg_status");
let voipIranDialCall = document.getElementById("dial");
// let voipIranBtnToggle = parent.document.getElementById("btnToggle");
// let voipIranVici = parent.document.getElementById("vici");

var debug = debug_enabled;

function debug_out( string ) {
        // chekc if debug is enabled
        if ( debug ) {
                // format the date string
                var date;
                date = new Date();
                date = date.getFullYear() + '-' +
                    ('00' + (date.getMonth()+1)).slice(-2) + '-' +
                    ('00' + date.getDate()).slice(-2) + ' ' +
                    ('00' + date.getHours()).slice(-2) + ':' +
                    ('00' + date.getMinutes()).slice(-2) + ':' +
                    ('00' + date.getSeconds()).slice(-2);

                // add the debug string to the debug element
                uiElements.debug.innerHTML = uiElements.debug.innerHTML + date + ' => ' + string + '<br>';
        }
}

// Array of the various UI elements
var uiElements = {
	container:		document.getElementById('container'),
	main:			document.getElementById('main'),
	audio:			document.getElementById('audio'),
	logo:			document.getElementById('logo'),
	controls:		document.getElementById('controls'),
	registration_control:	document.getElementById('registration_control'),
	reg_status:		document.getElementById('reg_status'),
	register:		document.getElementById('register'),
	unregister:		document.getElementById('unregister'),
	dial_control:		document.getElementById('dial_control'),
	digits:			document.getElementById('digits'),
	dial:			document.getElementById('dial'),
	audio_control:		document.getElementById('audio_control'),
	mic_mute:		document.getElementById('mic_mute'),
	vol_up:			document.getElementById('vol_up'),
	vol_down:		document.getElementById('vol_down'),
	dialpad:		document.getElementById('dialpad'),
	one:			document.getElementById('one'),
	two:			document.getElementById('two'),
	three:			document.getElementById('three'),
	four:			document.getElementById('four'),
	five:			document.getElementById('five'),
	six:			document.getElementById('six'),
	seven:			document.getElementById('seven'),
	eight:			document.getElementById('eight'),
	nine:			document.getElementById('nine'),
	star:			document.getElementById('star'),
	zero:			document.getElementById('zero'),
	pound:			document.getElementById('pound'),
	dial_dtmf:		document.getElementById('dial_dtmf'),
	dtmf_digits:		document.getElementById('dtmf_digits'),
	send_dtmf:		document.getElementById('send_dtmf'),
	debug:			document.getElementById('debug'),
	reg_icon:		document.getElementById('reg_icon'),
	unreg_icon:		document.getElementById('unreg_icon'),
	dial_icon:		document.getElementById('dial_icon'),
	hangup_icon:		document.getElementById('hangup_icon'),
	mute_icon:		document.getElementById('mute_icon'),
	vol_up_icon:		document.getElementById('vol_up_icon'),
	vol_down_icon:		document.getElementById('vol_down_icon')
	  // --- add hangoutButton VOIPIRAN  -------
  //hangoutButton: document.getElementById('hangoutButton'),
}

var ua;
var my_session = false;
var incall = false;
var ringing = false;
var muted = false;
var mediaStream;
var mediaConstraints;
var ua_config = {
	
	userAgentString: 'VOIPRAN Webphone 1.0-rc1',
	traceSip: true,
	register: true,
	hackIpInContact: true,
	  hackViaTcp: true,
	hackWssInTransport: true,

	displayName: cid_name,
	uri: sip_uri,
	authorizationUser: auth_user,
	password: password,
	wsServers: ws_server,
	rtcpMuxPolicy: "negotiate"
	//rtcpMuxPolicy: 'require'
}

// We define initial status
//uiElements.reg_status.value = get_translation("unregistered");

debug_out ( '<br />displayName: ' + cid_name + "<br />uri: " + sip_uri + "<br />authorizationUser: " + auth_user + "<br />password: " + password + "<br />wsServers: " + ws_server );

var sip_server = ua_config.uri.replace(/^.*@/,'');

// setup the ringing audio file
ringAudio = new Audio('sounds/ringing.mp3'); 
endAudio = new Audio("sounds/endRinging.mp3");
ringAudio.addEventListener('ended', function() {
    this.currentTime = 0;
    this.play();
}, false);

// setup the dtmf tone audio files
dtmf0Audio = new Audio("sounds/0.wav");
dtmf1Audio = new Audio("sounds/1.wav");
dtmf2Audio = new Audio("sounds/2.wav");
dtmf3Audio = new Audio("sounds/3.wav");
dtmf4Audio = new Audio("sounds/4.wav");
dtmf5Audio = new Audio("sounds/5.wav");
dtmf6Audio = new Audio("sounds/6.wav");
dtmf7Audio = new Audio("sounds/7.wav");
dtmf8Audio = new Audio("sounds/8.wav");
dtmf9Audio = new Audio("sounds/9.wav");
dtmfHashAudio = new Audio("sounds/hash.wav");
dtmfStarAudio = new Audio("sounds/star.wav");

// adjust the dtmf tone volume
dtmf0Audio.volume = dtmf1Audio.volume = dtmf2Audio.volume = dtmf3Audio.volume = dtmf4Audio.volume = dtmf5Audio.volume = dtmf6Audio.volume = dtmf7Audio.volume = dtmf8Audio.volume = dtmf9Audio.volume = dtmfHashAudio.volume = dtmfStarAudio.volume = 0.15;

processDisplaySettings();

//initialize();

/************************************

  Beginning of functions

*************************************/

function debug_out(string) {
  // check if debug is enabled. If it isn't, end without doing anything
  if (!debug) return false;

  // format the date string
  var date;
  date = new Date();
  date = date.getFullYear() + "-" + ("00" + (date.getMonth() + 1)).slice(-2) + "-" + ("00" + date.getDate()).slice(-2) + " " + ("00" + date.getHours()).slice(-2) + ":" + ("00" + date.getMinutes()).slice(-2) + ":" + ("00" + date.getSeconds()).slice(-2);

  // add the debug string to the debug element
  uiElements.debug.innerHTML = uiElements.debug.innerHTML + date + " => " + string + "<br>";
}
function startBlink( ) {
//	uiElements.reg_status.style.backgroundImage = "url('images/reg_status_blink.gif')";
  voipIranRegiterButton.classList.add("alertCall");
  voipIranRegStatus.classList.add("alertCall");
  // voipIranBtnToggle.classList.add("alertCall");
  // voipIranVici.classList.add("alertCall");
  voipIranDialCall.style.background = "green";																
}

function stopBlink( ) {
  uiElements.reg_status.style.backgroundImage = "";
  voipIranRegiterButton.classList.remove("alertCall");
  voipIranRegStatus.classList.remove("alertCall");
  // voipIranBtnToggle.classList.remove("alertCall");
  // voipIranVici.classList.remove("alertCall");

  // if hangup  outgoingCall
  voipIranRegiterButton.classList.remove("alertCallOutGoing");
  voipIranRegStatus.classList.remove("alertCallOutGoing");
  // voipIranBtnToggle.classList.remove("alertCallOutGoing");
  // voipIranVici.classList.remove("alertCallOutGoing");
  // voipIranDialCall.style.background = '#434552';													  
 //       uiElements.reg_status.style.backgroundImage = "";
}
/*
// Functions
function dialPadPressed( digit, my_session ) {
	// only work if the dialpad is not hidden
	if ( !hide_dialpad ) {
		// check if the my_session is not there
		if ( my_session == false ) {
			debug_out( 'Adding key press ' + digit + ' to dial digits' );
			uiElements.digits.value = uiElements.digits.value + digit;
		} else {
	                debug_out( 'Sending DTMF ' +  digit );
			my_session.dtmf( digit );
		}
	}
}

*/


function dialPadPressed(digit, my_session) {
  // only work if the dialpad is not hidden
  if (hide_dialpad) return false;

  switch (digit) {
    case "0":
      dtmf0Audio.play();
      break;
    case "1":
      dtmf1Audio.play();
      break;
    case "2":
      dtmf2Audio.play();
      break;
    case "3":
      dtmf3Audio.play();
      break;
    case "4":
      dtmf4Audio.play();
      break;
    case "5":
      dtmf5Audio.play();
      break;
    case "6":
      dtmf6Audio.play();
      break;
    case "7":
      dtmf7Audio.play();
      break;
    case "8":
      dtmf8Audio.play();
      break;
    case "9":
      dtmf9Audio.play();
      break;
    case "*":
      dtmfStarAudio.play();
      break;
    case "#":
      dtmfHashAudio.play();
      break;
  }

  // check if the my_session is not there
  if (my_session == false) {
    debug_out("Adding key press " + digit + " to dial digits");
		  
    uiElements.digits.value = uiElements.digits.value + digit;
  } else {
    debug_out("Sending DTMF " + digit);
    my_session.dtmf(digit);
									 
   
  }
}

/*
function sendButton( my_session ) {
	// only work if the dialpad is not hidden
        if ( !hide_dialpad ) {
		// check if the my_session is not there
		if ( my_session == false ) {
			// TODO give some type of error
		} else {
			var digits = uiElements.dtmf_digits.value;
	                debug_out( 'Sending DTMF ' +  digits );
			my_session.dtmf( digits );
			uiElements.dtmf_digits.value = '';
		}
	}
}
*/


function sendButton(my_session) {
  // only work if the dialpad is not hidden
  if (hide_dialpad) return false;

  // check if the my_session is not there
  if (my_session == false) {
    // TODO give some type of error
  } else {
    var digits = uiElements.dtmf_digits.value;
    debug_out("Sending DTMF " + digits);
    my_session.dtmf(digits);
    // ========= VOIPIRAN TRANSFER =====================
    my_session.refer(digits);
    // ========= VOIPIRAN TRANSFER =====================
    uiElements.dtmf_digits.value = "";
  }
}




function registerButton( ua ) {
	debug_out( 'Register Button Pressed' );
	ua.register();
}

function unregisterButton( ua ) {
	debug_out( 'Un-Register Button Pressed' );
	ua.unregister();

// VOIPIRAN HangoutButton Press
function voipiranHangupCall(state = null) {
  debug_out("Hangup Button Pressed");
  uiElements.dial_icon.src = "images/wp_dial.gif";
  voipIranDialCall.style.background = "green";
  uiElements.reg_status.value = get_translation("registered");
  uiElements.digits.value = "";
  setRinging(false);
  setCallButtonStatus(false);
  hangupCall();
  if (!state) {
    my_session.reject();
  }

  my_session = false;
  Swal.fire({
    text: "Call Disconnected!",
    icon: "success",
    timer: 1500,
    showConfirmButton: false,
  });
  return false;
}					
}

function dialButton() {
	// check if in a call
	if ( incall ) {
		// we are so they hung up the call
		debug_out( 'Hangup Button Pressed' );
		voipIranDialCall.style.background = "green";
		uiElements.dial_icon.src = 'images/wp_dial.gif';

		hangupCall();
		
	} else {
		// we are not
		
		// check if ringing
		if ( ringing ) {
			// we are ringing
			// stop the ringing
			    voipIranDialCall.style.background = "#ff0000";
			ringing = false;
			stopBlink();
	                ringAudio.pause();
	                ringAudio.currentTime = 0;

			incall = true;
			debug_out( 'Answered Call' );
	    //=======  VOIPIRAN Start set background dial button red ==========
    voipIranDialCall.style.background = "#ff0000";
    //=======  VOIPIRAN End set background dial button red ==========
			uiElements.dial_icon.src = 'images/wp_hangup.gif';

			var options = {
				media: {
					constraints: {
						audio: true,
						video: false
					},
					render: {
						remote: uiElements.audio
					},
					stream: mediaStream
				}
			}

			my_session.accept(options);

		} else {
			// not in a call and the phone is not ringing
			debug_out( 'Dial Button Pressed' );
			// made sure the dial box is not hidden
			if ( !hide_dialbox ) {
				uiElements.dial_icon.src = 'images/wp_hangup.gif';
      //=======  VOIPIRAN Start set background dial button red ==========
      voipIranDialCall.style.background = "#ff0000";
      //=======  VOIPIRAN End set background dial button red ==========
				dialNumber();
			}
		}
	}
}

function muteButton() {
	// only work if the button is not hidden
	if ( !hide_mute ) {
		// check if in a call
		if ( incall ) {
			if ( muted ) {
				// call is currently muted
				// unmute it
				muted = false;
				my_session.unmute();
				debug_out( 'Un-Mute Button Pressed' );
				uiElements.mute_icon.src = 'images/wp_mic_on.gif';
			} else {
				// call is not muted
				// mute it
				muted = true;
				my_session.mute();
				debug_out( 'Mute Button Pressed' );
				uiElements.mute_icon.src = 'images/wp_mic_off.gif';
			}
		} else {
			debug_out( 'Mute Button Pressed But Not In Call' );
			uiElements.mute_icon.src = 'images/wp_mic_on.gif';
			muted = false;
		}
	}
}

function volumeUpButton() {
	// only work if the volume buttons are not hidden
	if ( !hide_volume ) {
		debug_out( 'Volume Up Button Pressed' );
		volume = uiElements.audio.volume;
		debug_out( 'Current Volume = ' + Math.round(volume * 100) + '%');
		if ( volume >= 1.0 ) {
			debug_out( 'Volume is maxed' );
		} else {
			volume = volume + 0.1;
		}
		if ( volume < 0 ) { volume = 0; }
		if ( volume > 1 ) { volume = 1; }
		debug_out( 'New Volume = ' + Math.round(volume * 100) + '%' );
		uiElements.audio.volume = volume;
	}
}

function volumeDownButton() {
	// only work if the volume buttons are not hidden
        if ( !hide_volume ) {
	        debug_out( 'Volume Down Button Pressed' );
	        volume = uiElements.audio.volume;
	        debug_out( 'Current Volume = ' + Math.round(volume * 100) + '%');
	        if ( volume <= 0 ) {
	                debug_out( 'Volume is already 0' );
	        } else {
	                volume = volume - 0.1;
	        }
	        if ( volume < 0 ) { volume = 0; }
		if ( volume > 1 ) { volume = 1; }
		debug_out( 'New Volume = ' + Math.round(volume * 100) + '%');
	        uiElements.audio.volume = volume;
	}
}

function hangupCall() {
	// check if in a call
	if ( incall ) {
		my_session.terminate();
		my_session = false;
		incall = false;
  // -------------------- VOIPIRAN --------------------
  endAudio.pause();
  endAudio.currentTime = 0;	  
        	ringAudio.pause();
	        ringAudio.currentTime = 0;
		if ( ua.isRegistered() ) {
	                uiElements.reg_status.value = 'Registered';
	                uiElements.reg_icon.src = 'images/wp_register_active.gif';
     /* =================== VoipIran ===================== --> */
    voipIranUnRegiterButton.style.display = "none";
    voipIranRegiterButton.style.display = "block";
    /* =================== VoipIran ===================== --> */
	                uiElements.unreg_icon.src = 'images/wp_unregister_inactive.gif';
	                uiElements.dial_icon.src = 'images/wp_dial.gif';
	        
	//=======  VOIPIRAN Start set background dial button green ==========
    voipIranDialCall.style.background = "green";
    //=======  VOIPIRAN End set background dial button green ==========
			} else {
	                uiElements.reg_status.value = 'Unregistered';
	                uiElements.reg_icon.src = 'images/wp_register_inactive.gif';
	                uiElements.unreg_icon.src = 'images/wp_unregister_active.gif';
      setRegisterStatus("unregistered");
    /* =================== VoipIran ===================== --> */
    voipIranRegiterButton.style.display = "none";
    /* =================== VoipIran ===================== --> */
	                uiElements.dial_icon.src = 'images/wp_dial.gif';
		}        		
	} else {
		debug_out( 'Attempt to hang up non-existant call' );
	}
}

function dialNumber() {
	// check if currently in a call
	if ( incall ) {
		debug_out( 'Already in a call' );
        } else {
		var uri = uiElements.digits.value + '@' + sip_server;
		var options = {
			media: {
				constraints: {
                                	audio: true,
                                        video: false
                                },
                                render: {
                                	remote: uiElements.audio
                                },
				stream: mediaStream
			}
		};
		my_session = ua.invite( uri, options );
		incall = true;
		 //setRegisterStatus(get_translation("attempting") + " " + uiElements.digits.value);
		uiElements.reg_status.value = 'Attempting'+ ' ' + uiElements.digits.value;

		caller = uiElements.digits.value;

		// assign event handlers to the session
	        my_session.on('accepted', function() { handleAccepted() } );
	        my_session.on('bye', function( request ) { handleBye( request ) } );
        	my_session.on('failed', function( response, cause ) { handleFailed( response, cause ) } );
	        my_session.on('refer', function() { handleInboundRefer() } );
		my_session.on('progress', function( progress ) { handleProgress( progress ) } );

		uiElements.digits.value = '';
        }
}

function handleProgress( progress ) {
	debug_out( 'Their end is ringing' + ' ' + progress );

	uiElements.reg_status.value = 'Ringing' + ' ' + caller;

	// start ringing
        ringAudio.play();
		  // ------- VOIPIRAN Start SET background red when ringing ------------
  uiElements.dial_icon.src = "images/wp_hangup.gif";
  voipIranDialCall.style.background = "#ff0000";
  startBlink("outGoingCall");
  // ------- VOIPIRAN End SET background red when ringing ------------
	//startBlink();

}


function handleInvite( session ) {
	my_session = session;

	// check if we are in a call already
        if ( incall ) {
		// we are so reject it
                debug_out( 'Recieved INVITE while in a call. Rejecting.' );
                var options = {
                        statusCode: 486,
                        reasonPhrase: "Busy Here"
                };
                my_session.reject(options);
        } else {
		// we are not so good to process it

		// add session event listeners
	        my_session.on('accepted', function() { handleAccepted() } );
	        my_session.on('bye', function( request ) { handleBye( request ) } );
	        my_session.on('failed', function( response, cause ) { handleFailed( response, cause ) } );
	        my_session.on('refer', function() { handleInboundRefer() } );

		var remoteUri = session.remoteIdentity.uri.toString();
	        var displayName = session.remoteIdentity.displayName;
	        var regEx1 = /sip:/;
	        var regEx2 = /@.*$/;
	        var extension = remoteUri.replace( regEx1 , '' );
		extension = extension.replace( regEx2 , '' );
		caller = extension;

		debug_out( 'Got Invite from <' + extension + '> "' + displayName + '"');
	        uiElements.reg_status.value = extension + ' - ' + displayName;

		// if auto answer is set answer the call
		if ( auto_answer ) {
			incall = true;
	                debug_out( 'Auto-Answered Call' );
	                uiElements.dial_icon.src = 'images/wp_hangup.gif';


	                var options = {
				media: {
	                        	constraints: {
	                                	audio: true,
	                                        video: false
	                                },
	                                render: {
	                                        remote: uiElements.audio
	                                },
	                                stream: mediaStream
	                        }
	        	}
	                my_session.accept(options);
		} else {
			// auto answer not enabled 
			// ring the phone
			ringing = true;
      //=======  VOIPIRAN Start set background dial button red ==========
      voipIranDialCall.style.background = "#ff0000";
      //=======  VOIPIRAN End set background dial button red ==========
			// start ringing
			ringAudio.play();
			startBlink();
		}
	}
}



function handleTrackAdded(my_session) {
  // We need to check the peer connection to determine which track was added
  var pc = my_session.sessionDescriptionHandler.peerConnection;

  // Gets remote tracks
  var remoteStream = new MediaStream();
  pc.getReceivers().forEach(function (receiver) {
    remoteStream.addTrack(receiver.track);
  });
  uiElements.audio.srcObject = remoteStream;
  uiElements.audio.play();
}

function handleAccepted() {
	debug_out( 'Session Accepted Event Fired' );
	
	//=======  VOIPIRAN Start set background dial button red ==========
    voipIranDialCall.style.background = "#ff0000";
    //=======  VOIPIRAN End set background dial button red ==========
	
	uiElements.reg_status.value = 'Incall' + ' ' + caller;
	
	// They answered stop ringing
        ringAudio.pause();
	ringAudio.currentTime = 0;
	stopBlink();
}

function handleBye( request ) {
	debug_out( 'Session Bye Event Fired |' + request  );
	if ( ua.isRegistered() ) {
                uiElements.reg_status.value = 'Registered';
                uiElements.reg_icon.src = 'images/wp_register_active.gif';
                uiElements.unreg_icon.src = 'images/wp_unregister_inactive.gif';
		uiElements.dial_icon.src = 'images/wp_dial.gif';
        } else {
                uiElements.reg_status.value = 'Unregistered';
                uiElements.reg_icon.src = 'images/wp_register_inactive.gif';
        	uiElements.unreg_icon.src = 'images/wp_unregister_active.gif';
		uiElements.dial_icon.src = 'images/wp_dial.gif';		
        }
        my_session = false;
	incall = false;
}

function handleFailed( response, cause ) {
	debug_out( 'Session Failed Event Fired | ' + response + ' | ' + cause );
  debug_out("Session Bye Event Fired |" + request);
  // ================= VOIPIRAN STOP TIMER ===================
  stopTimer(intervalId);
  // ================= VOIPIRAN STOP TIMER ===================
	if ( cause == 'Canceled' ) {
		// stop ringing
		ringing = false;
		stopBlink();
		ringAudio.pause();
		ringAudio.currentTime = 0;
		// check if we are registered and adjust the display accordingly
		if ( ua.isRegistered() ) {
			uiElements.reg_status.value = 'Registered';
		        uiElements.reg_icon.src = 'images/wp_register_active.gif';
		        uiElements.unreg_icon.src = 'images/wp_unregister_inactive.gif';
		} else {
		        uiElements.reg_status.value = 'Unregistered';
		        uiElements.reg_icon.src = 'images/wp_register_inactive.gif';
		        uiElements.unreg_icon.src = 'images/wp_unregister_active.gif';			
		}
		my_session = false;
		return;
	}
	if (( cause == 'WebRTC Error' ) || ( cause == 'WebRTC not supported') || ( cause == 'WebRTC not supported' )) {
		// stop ringing
                ringing = false;
                ringAudio.pause();
                ringAudio.currentTime = 0;
                // check if we are registered and adjust the display accordingly
                if ( ua.isRegistered() ) {
                        uiElements.reg_status.value = 'Registered';
                        uiElements.reg_icon.src = 'images/wp_register_active.gif';
                        uiElements.unreg_icon.src = 'images/wp_unregister_inactive.gif';
                } else {
                        uiElements.reg_status.value = 'Unregistered';
                        uiElements.reg_icon.src = 'images/wp_register_inactive.gif';
                        uiElements.unreg_icon.src = 'images/wp_unregister_active.gif';
                }
                my_session = false;

		WebRTCError();

                return;
	}
	return;
}

function handleInboundRefer() {
	debug_out( 'Session Refer Event Fired' );
}

function WebRTCError() {
	alert( 'Something went wrong with WebRTC. Either your browser does not support the necessary WebRTC functions, you did not allow your browser to access the microphone, or there is a configuration issue. Please check your browsers error console for more details. For a list of compatible browsers please vist http://webrtc.org/');
}

function initialize() {
// Initialization
// Dial pad keys 
	uiElements.one.addEventListener("click", function() { dialPadPressed('1',my_session) } );
	uiElements.two.addEventListener("click", function() { dialPadPressed('2',my_session) } );
	uiElements.three.addEventListener("click", function() { dialPadPressed('3',my_session) } );
	uiElements.four.addEventListener("click", function() { dialPadPressed('4',my_session) } );
	uiElements.five.addEventListener("click", function() { dialPadPressed('5',my_session) } );
	uiElements.six.addEventListener("click", function() { dialPadPressed('6',my_session) } );
	uiElements.seven.addEventListener("click", function() { dialPadPressed('7',my_session) } );
	uiElements.eight.addEventListener("click", function() { dialPadPressed('8',my_session) } );
	uiElements.nine.addEventListener("click", function() { dialPadPressed('9',my_session) } );
	uiElements.zero.addEventListener("click", function() { dialPadPressed('0',my_session) } );
	uiElements.star.addEventListener("click", function() { dialPadPressed('*',my_session) } );
	uiElements.pound.addEventListener("click", function() { dialPadPressed('#',my_session) } );
	
	// Send DTMF button
	uiElements.send_dtmf.addEventListener("click", function() { sendButton(my_session) } );
	
	// Dial Button
	uiElements.dial.addEventListener("click", function() { dialButton() } );
	
	// Mute	 Button
	uiElements.mic_mute.addEventListener("click", function() { muteButton() } );

	// Volume Buttons
	uiElements.vol_up.addEventListener("click", function() { volumeUpButton() } );
	uiElements.vol_down.addEventListener("click", function() { volumeDownButton() } );

	// Register Button
	uiElements.register.addEventListener("click", function() { registerButton( ua ) } );
	
	// Unregister Button
	uiElements.unregister.addEventListener("click", function() { unregisterButton( ua ) } );

	uiElements.reg_status.value = 'Connecting...';

	// create the User Agent
	ua = new SIP.UA(ua_config);

	// assign event handlers
	ua.on('connected', function () {
		uiElements.reg_status.value = 'Unregistered';
		uiElements.reg_icon.src = 'images/wp_register_inactive.gif';
		uiElements.unreg_icon.src = 'images/wp_unregister_active.gif';
    setRegisterStatus("connected");
    /* =================== VoipIran ===================== --> */
    voipIranRegiterButton.style.display = "none";
    /* =================== VoipIran ===================== --> */
	});
	
	ua.on('registered', function () {
		uiElements.reg_status.value = 'Registered';
		uiElements.reg_icon.src = 'images/wp_register_active.gif';
	        uiElements.unreg_icon.src = 'images/wp_unregister_inactive.gif';
    setRegisterStatus("registered");
    /* =================== VoipIran ===================== --> */
    voipIranUnRegiterButton.style.display = "none";
    voipIranRegiterButton.style.display = "block";
    /* =================== VoipIran ===================== --> */
	});

	ua.on('unregistered', function () {
		uiElements.reg_status.value = 'Unregistered';
		uiElements.reg_icon.src = 'images/wp_register_inactive.gif';
	        uiElements.unreg_icon.src = 'images/wp_unregister_active.gif';
    setRegisterStatus("unregistered");
    /* =================== VoipIran ===================== --> */
    voipIranRegiterButton.style.display = "none";
    /* =================== VoipIran ===================== --> */
	});

	ua.on('disconnected', function () {
	        uiElements.reg_status.value = 'Disconnected';
		uiElements.reg_icon.src = 'images/wp_register_inactive.gif';
	        uiElements.unreg_icon.src = 'images/wp_unregister_inactive.gif';
	});

	ua.on('registrationFailed', function () {
	        uiElements.reg_status.value = 'Reg. Failed';
		uiElements.reg_icon.src = 'images/wp_register_inactive.gif';
	        uiElements.unreg_icon.src = 'images/wp_unregister_active.gif';
	});

	ua.on('invite', function (session) {
		handleInvite( session );
	});

	// get a media stream so users are not constantly prompted
	mediaConstraints = {
	        audio: true,
        	video: false
	};
	function getUserMediaSuccess (stream) {
	        console.log('getUserMedia succeeded', stream)
	        mediaStream = stream;
	}
	function getUserMediaFailure (e) {
	        console.error('getUserMedia failed:', e);
	}
	SIP.WebRTC.isSupported();
	SIP.WebRTC.getUserMedia(mediaConstraints, getUserMediaSuccess, getUserMediaFailure);
};

function processDisplaySettings() {
	if ( hide_dialpad ) {
		uiElements.dialpad.setAttribute("hidden", true);
		uiElements.main.style.width = '265px';
	}
	if ( hide_dialbox ) {
		uiElements.digits.setAttribute("hidden", true);
	}
	if ( hide_mute ) {
		uiElements.mic_mute.setAttribute("hidden", true);
	}
	if ( hide_volume ) {
		uiElements.vol_down.setAttribute("hidden", true);
		uiElements.vol_up.setAttribute("hidden", true);
	}
}

processDisplaySettings();

if ( !SIP.WebRTC.isSupported() ) {
	WebRTCError();
} else {
	initialize();
 function processDisplaySettings() {
  if (hide_dialpad) {
    uiElements.dialpad.setAttribute("hidden", true);
  }
  if (hide_dialbox) {
    uiElements.digits.setAttribute("hidden", true);
  }
  if (hide_mute) {
    uiElements.mic_mute.setAttribute("hidden", true);
  }
  if (hide_volume) {
    uiElements.vol_down.setAttribute("hidden", true);
    uiElements.vol_up.setAttribute("hidden", true);
  }
}  
}

function setRinging(ringing_status) {
  if (ringing_status) {
    ringing = true;
    startBlink();
    ringAudio.play();
  } else {
    ringing = false;
    stopBlink();
    ringAudio.pause();
    ringAudio.currentTime = 0;
  }
}													   

/*
	Hardcoded messages. Can be translated by loading translations.js
*/
function get_translation(text) {
  console.log("-------------------- get translation ---------------------");
  // Default language. This can be overriden by defining the 'language' variable before loading this file
  if (typeof language == "undefined" || language.length == 0) language = "en";

  if (typeof vici_translations == "undefined") {
    vici_translations = {
      en: {
        registered: "Ready to Dial",
        unregistered: "Unregistered",
        connecting: "Connecting...",
        disconnected: "Disconnected",
        connected: "Connected",
        register_failed: "Reg. failed",
        incall: "Incall",
        ringing: "Ringing",
        attempting: "Attempting",
        send: "Send",
        webrtc_error:
          "Something went wrong with WebRTC. Either your browser does not support the necessary WebRTC functions, you did not allow your browser to access the microphone, or there is a configuration issue. Please check your browsers error console for more details. For a list of compatible browsers please vist http://webrtc.org/",
      },
    };
  }
  // If selected language doesn't exist, fallback to english
  if (typeof vici_translations[language] == "undefined") vici_translations[language] = vici_translations["en"];

  return vici_translations[language][text];
}

// ===================== Start VoipIran Development ==========================
// request permission on page load
document.addEventListener("DOMContentLoaded", function () {
  if (!Notification) {
    alert("Desktop notifications not available in your browser. Try Chromium.");
    return;
  }

  if (Notification.permission !== "granted") Notification.requestPermission();
});

function notifyMe() {
  if (Notification.permission !== "granted") Notification.requestPermission();
  else {
    var notification = new Notification("Webphone Ringing...", {
      icon: "images/ringing.png",
      body: "Incoming Call : " + uiElements.reg_status.value,
    });

    notification.addEventListener("click", function (event) {
      // window.opener.doSome();
    });

    notification.onclick = function () {
      // window.opener.doSome();
      //   openFullscreen();
      // alert('pick up...');
      //   window.open("http://stackoverflow.com/a/13328397/1269037");
    };
  }
  // =====================  focus the VOIPIRA Webphone On Top ===================
  // window.opener.doSome();
}

// temporary disabled
var elem = document.documentElement;

function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) {
    /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) {
    /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) {
    /* IE/Edge */
    elem.msRequestFullscreen();
  }
}

function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen();
  }
}
// temporary disabled

// set Digits input call On Enter key
document.getElementById("digits").addEventListener("keyup", function (event) {
  event.preventDefault();
  if (event.keyCode === 13) {
    dialButton();
  }
});

// set default background color of Dial Button Green
voipIranDialCall.style.background = "green";

// initial clock timer
let minutes = 0,
  seconds = 0,
  timerLabel;
var totalSeconds = 0;
let intervalId;

function setTime() {
  ++totalSeconds;
  seconds = pad(totalSeconds % 60);
  minutes = pad(parseInt(totalSeconds / 60));
  timerLabel = minutes + ":" + seconds;
  // uiElements.digits.value = timerLabel;
  // uiElements.dial.value = timerLabel;
  uiElements.reg_status.value = timerLabel + " speaking";
}

function pad(val) {
  var valString = val + "";
  if (valString.length < 2) {
    return "0" + valString;
  } else {
    return valString;
  }
}

function startTimer() {
  intervalId = setInterval(setTime, 1000);
}

function stopTimer(id) {
  minutes = 0;
  seconds = 0;
  totalSeconds = 0;
  timerLabel = null;
  uiElements.digits.value = null;
  console.log("VOIPIRAN DISABLE InterVal ID -------- IS " + id);
  clearInterval(id);
}

// dont let resize the window
var size = [window.outerWidth, window.outerHeight];
window.addEventListener("resize", function () {
  window.resizeTo(size[0], size[1]);
});

// Close loading modal
setTimeout(() => {
  Swal.close();
}, 1500);

// Voipiran hangupCall Event
uiElements.hangoutButton.addEventListener("click", function () {
  voipiranHangupCall();
});

// ---------- Start implement backSpace ----------
document.addEventListener("keydown", KeyCheck);  //or however you are calling your method
function KeyCheck(event)
{
   var KeyID = event.keyCode;
   switch(KeyID)
   {
      case 8:
        VoipIranBackSpace();
      break; 
      case 13: 
        dialButton();
      break;
      case 46:
        // Swal.fire('',"delete",'success');
      break;
      case 96: 
        dialPadPressed(0,false);
      break;
      case 97: 
        dialPadPressed(1,false);
      break;
      case 98: 
        dialPadPressed(2,false);
      break;
      case 99: 
        dialPadPressed(3,false);
      break;
      case 100: 
        dialPadPressed(4,false);
      break;
      case 101: 
        dialPadPressed(5,false);
      break;
      case 102: 
        dialPadPressed(6,false);
      break;
      case 103: 
        dialPadPressed(7,false);
      break;
      case 104: 
        dialPadPressed(8,false);
      break;
      case 105: 
        dialPadPressed(9,false);
      break;
      default:
        // Swal.fire('','keyid '+KeyID,'success');
      break;
   }
}	  
function VoipIranBackSpace() {
  var value = uiElements.digits.value;
  uiElements.digits.value = value.substr(0, value.length - 1);
}							  