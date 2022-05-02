<?php
	// set the VICIphone variables
	$layout = "default.css";
	$cid_name = "100";
	$sip_uri = "100@192.168.0.100";
	$auth_user = "100";
	$password = "1234";
	$ws_server = "wss://yourdialerurl.com/8089";
	$debug_enabled = "true";
	$hide_dialpad = false;
	$hide_dialbox = false;
	$hide_mute = false;
	$hide_volume = false;
	$auto_answer= "true";
	
	// call the template
	require_once('vp_template.php');
?>
