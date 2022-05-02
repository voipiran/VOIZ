<!DOCTYPE html>

<html>

<head>
	<title>VOIPIRAN WebPhone</title>
	<link rel="stylesheet" href="<?= $layout ?>" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			overflow: hidden;
			background: #323641;
		}
	</style>
</head>

<body>
	<!-- Container -->
	<div id="container" class="wephone-container">

		<!-- Main -->
		<div id="main">
			<!-- Video element to handle audio -->
			<audio autoplay width='0' height='0' id="audio"></audio>

			<!-- Logo -->
			<section id="logo">
				<img id="logo_img" src="images/voipiran_logo.png">
			</section>
			<!-- End Logo -->

			<!-- ----------- VOIPIRAN - Start Registered User ------- -->
			<section id="reg_name">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 172 172" style=" fill:#000000;">
					<g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
						<path d="M0,172v-172h172v172z" fill="none"></path>
						<g fill="#ffffff">
							<path d="M89.01,11.7175c-12.65812,0.22844 -21.90312,4.00438 -27.52,11.395c-6.65156,8.76125 -7.86094,22.10469 -3.655,39.56c-1.54531,1.89469 -2.71437,4.77031 -2.2575,8.6c0.90031,7.55188 3.92375,10.68281 6.3425,11.9325c1.16906,5.96625 4.46125,12.64469 7.6325,15.8025v1.6125c0.01344,2.27094 -0.02687,4.42094 -0.1075,6.665c1.80063,3.7625 7.51156,9.675 19.995,9.675c12.5775,0 18.43625,-6.03344 20.1025,-10.2125c-0.06719,-2.06937 -0.01344,-4.03125 0,-6.1275v-1.6125c3.07719,-3.14437 6.24844,-9.83625 7.4175,-15.8025c2.48594,-1.23625 5.42875,-4.35375 6.3425,-11.9325c0.45688,-3.74906 -0.645,-6.59781 -2.15,-8.4925c2.00219,-6.81281 6.08719,-24.55031 -0.9675,-35.905c-2.95625,-4.75687 -7.43094,-7.75344 -13.33,-8.9225c-3.25187,-4.09844 -9.48687,-6.235 -17.845,-6.235zM112.66,114.7025c-4.34031,5.01219 -12.01312,9.1375 -23.22,9.1375c-11.40844,0 -18.86625,-4.1925 -23.1125,-9.03c-3.27875,2.75469 -8.51937,4.82406 -14.2975,7.095c-13.4375,5.28094 -30.14031,11.81156 -31.39,32.68l-0.215,3.655h138.03l-0.215,-3.655c-1.24969,-20.86844 -17.88531,-27.39906 -31.2825,-32.68c-5.805,-2.29781 -11.03219,-4.4075 -14.2975,-7.2025z"></path>
						</g>
					</g>
				</svg>
				<span class="name"><?= $name ?> - <?= $auth_user ?></span>
			</section>
			<!-- ----------- VOIPIRAN - End Registered User ------- -->

			<!-- ----------- VOIPIRAN - Start hangout Button ------- -->
			<section id="hangoutButton">
				<img src="images/decline.png">
			</section>
			<!-- ----------- VOIPIRAN - End Hangout Button ------- -->

			<!-- Controls -->
			<section id="controls">
				<section id="registration_control">
					<input type="text" value="" id="reg_status" readonly>
					<button class="button" id="register"><img id="reg_icon" src="images/wp_register_inactive.gif" alt="register"></button>
					<button class="button" id="unregister"><img id="unreg_icon" src="images/wp_unregister_inactive.gif" alt="register"></button>
				</section>
				<section id="dial_control">
					<input type="text" name="digits" value="<?php echo $dial_number ?>" id="digits" />
					<button class="button" id="dial"><img id="dial_icon" src="images/wp_dial.gif" alt="register"></button>
				</section>
				<section id="audio_control">
					<button class="button" id="mic_mute"><img id="mute_icon" src="images/wp_mic_on.gif" alt="mute"></button>
					<button class="button" id="vol_up"><img id="vol_up_icon" src="images/wp_speaker_up.gif" alt="register"></button>
					<button class="button" id="vol_down"><img id="vol_down_icon" src="images/wp_speaker_down.gif" alt="register"></button>
				</section>
			</section>
			<!-- End Controls -->

			<!-- Dialpad -->
			<section id="dialpad">
				<section id="dial_row1">
					<button class="dialpad_button" id="one">1</button>
					<button class="dialpad_button" id="two">2</button>
					<button class="dialpad_button" id="three">3</button>
				</section>
				<section id="dial_row2">
					<button class="dialpad_button" id="four">4</button>
					<button class="dialpad_button" id="five">5</button>
					<button class="dialpad_button" id="six">6</button>
				</section>
				<section id="dial_row3">
					<button class="dialpad_button" id="seven">7</button>
					<button class="dialpad_button" id="eight">8</button>
					<button class="dialpad_button" id="nine">9</button>
				</section>
				<section id="dial_row4">
					<button class="dialpad_button" id="star">*</button>
					<button class="dialpad_button" id="zero">0</button>
					<button class="dialpad_button" id="pound">#</button>
				</section>
				<section id="dial_dtmf">
					<input type="text" name="dtmf_digits" value="" id="dtmf_digits" />
					<button class="button" id="send_dtmf">Send</button>
				</section>
			</section>
			<!-- End Dialpad -->

		</div>
		<!-- End Main -->

	</div>
	<!-- End Container -->

	<!-- Debug Output -->
	<pre id="debug"></pre>

	<!-- variables to pass vici_phone.js -->
	<script>
		// SIP configuration variables
		var cid_name = '<?php echo $cid_name; ?>';
		var sip_uri = '<?php echo $sip_uri; ?>';
		var auth_user = '<?php echo $auth_user; ?>';
		var password = '<?php echo $password; ?>';
		var ws_server = '<?php echo $ws_server; ?>';

		// whether debug should be enabled
		var debug_enabled = '<?php echo $debug_enabled; ?>';

		// display restriction options
		var hide_dialpad = '<?php echo $hide_dialpad; ?>';
		var hide_dialbox = '<?php echo $hide_dialbox; ?>';
		var hide_mute = '<?php echo $hide_mute; ?>';
		var hide_volume = '<?php echo $hide_volume; ?>';

		// behavior options
		var auto_answer = '<?php echo $auto_answer; ?>';
		var auto_dial_out = '<?php echo $auto_dial_out; ?>';
		var auto_login = '<?php echo $auto_login; ?>';

		// language support
		var language = '<?php echo $language; ?>';
	</script>

	<script src="js/sweetalert2@9.js"></script>
	<script>
		// -------- VOIPIRAN Start show loading modal --------
		Swal.fire({
			text: "loading...",
			onBeforeOpen: () => {
				Swal.showLoading();
			},
		});
		// -------- VOIPIRAN End show loading modal --------
	</script>


	<!-- WebRTC adapter -->
	<!-- <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script> -->

	<!-- Voipiran Offline Version  -->
	<script src="js/adapter.js"></script>


	<!-- SIP.js library, included from CDN. If you need it offline, uncomment the next line -->
	<script src="js/sip.js"></script>

	<!-- SIP.js library offline version -->
	<!-- script src="js/sip-0.15.11.min.js"></script -->

	<!-- Translations file -->
	<script src="js/translations.js"></script>

	<!-- Our Java Script Code -->
	<script src="js/vici_phone.js"></script>
</body>

</html>