<?php

include_once("libs/misc.lib.php");
//include_once("configs/default.conf.php");
include_once("libs/paloSantoACL.class.php");
include_once("libs/paloSantoDB.class.php");

session_name("issabelSession");
session_start();

/*Check the System is VOIZ on NOT*/
if (!file_exists('/etc/voiz.conf')) {   
	die('KILL: ');
	}

$pDB  = new paloDB($arrConf["issabel_dsn"]["acl"]);
$pACL = new paloACL($pDB);

if(isset($_SESSION["issabel_user"])) {
    $issabel_user = $_SESSION["issabel_user"];
} else {
    $issabel_user = "";
}
//echo $_SESSION["issabel_user"];
		if( isset($issabel_user) ){
			$web_user = $issabel_user;
			//Get EXT from db
			$user_ext = "";
			$user_id = "";
			$conn2 = new PDO('sqlite:/var/www/db/acl.db', '', '');
			$query2 =  "SELECT id,extension FROM acl_user WHERE name == '$web_user'";
			$queryData2 = $conn2->query($query2);
			$row2 = $queryData2->fetchColumn();
			if($row2 >0){
				foreach ($conn2->query($query2) as $row2)
				{
						$user_ext = $row2['extension'];
						$user_id = $row2['id'];
				}
			}
		}

###Fetch DB root PASSWORD
//$rootpw=$(sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf);
$rootpw = trim(shell_exec("sed -ne 's/.*mysqlrootpwd=//gp' /etc/issabel.conf"));

    $servername = "localhost";
    $username = "root";
    $password = $rootpw;
    $dbname = "asterisk";

/*CONNECT TO ASTERISK DB AND GET EXT PASSWORD*/
$query = "SELECT * FROM sip WHERE keyword='secret' and id='$user_ext' LIMIT 0,1";
 $con = mysql_connect($servername,$username,$password);
		if (!$con)
		{
		die('Could not connect: ' . mysql_error());
		}
	$name = mysql_db_query($dbname,$query,$con);
	$row = mysql_fetch_array($name);
	$ext_password= $row[data];
	//echo "extPassword:".$ext_password;
	mysql_close($con);


// default VICIphone variables
$layout = "css/default.css";
$cid_name = $user_ext;
$sip_uri = $user_ext."@".$_SERVER['SERVER_ADDR'];
$auth_user = $user_ext;
$password = $ext_password;
$ws_server = "wss://".$_SERVER['SERVER_ADDR'].":8089/ws";
$debug_enabled = true;
$hide_dialpad = false;
$hide_dialbox = false;
$hide_mute = false;
$hide_volume = false;
$auto_answer= false;
$dial_number = '';
$auto_dial_out = false;
$auto_login = true;
$debug_enabled = false;
$language = 'en';

// get / post data retrieval
$layout 		= get_post( "layout", $layout );
$cid_name 		= get_post( "cid_name", $cid_name ) ;
$sip_uri 		= get_post( "sip_uri", $sip_uri ) ;
$auth_user 		= get_post( "auth_user", $auth_user ) ;
$password 		= get_post( "password", $password ) ;
$ws_server 		= get_post( "ws_server", $ws_server ) ;
$debug_enabled 	= get_post( "debug_enabled", $debug_enabled ) ;
$hide_dialpad 	= get_post( "hide_dialpad", $hide_dialpad) ;
$hide_dialbox 	= get_post( "hide_dialbox", $hide_dialbox ) ;
$hide_mute 		= get_post( "hide_mute", $hide_mute ) ;
$hide_volume 	= get_post( "hide_volume", $hide_volume ) ;
$auto_answer	= get_post( "auto_answer", $auto_answer ) ;
$auto_dial_out	= get_post( "auto_dial_out", $auto_dial_out ) ;
$auto_login		= get_post( "auto_login", $auto_login ) ;
$dial_number	= get_post( "dial_number", $dial_number ) ;
$language		= get_post( "language", $language ) ;


// call the template
require_once('vp_template.php');

function get_post( $string, $variable ) {
	if (isset($_GET[$string])) {
		$variable = $_GET[$string];
	} elseif (isset($_POST[$string])) {
		$variable = $_POST[$string];
	}

	return $variable;
}
?>