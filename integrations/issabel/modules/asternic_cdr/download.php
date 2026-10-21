<?php
if(!isset($_REQUEST['file'])) {
    die("No filename specified");
}

$filename2 = $_REQUEST['file'];
$filename2 = preg_replace("/\.\./","",$filename2);
$filename2 = preg_replace("/%2e/","",$filename2);
$filename2 = preg_replace("/\/\*/","/",$filename2);

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression')) {
    ini_set('zlib.output_compression', 'Off');
}

if(!preg_match("/^\/var\/spool\/asterisk\/monitor/",$filename2)) {
    $filename2 = "/var/spool/asterisk/monitor/".$filename2;
}

if( $filename2 == "" ) {
    header("HTTP/1.0 404 Not Found");
    echo "ERROR: download file NOT SPECIFIED. USE download.php?file=filepath";
    die();
} elseif ( ! file_exists( $filename2 ) ) {
    header("HTTP/1.0 404 Not Found");
    echo "ERROR: File $filename2 not found. USE download.php?file=filepath";
    die();
}

header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false); // required for certain browsers
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".basename($filename2)."\";" );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($filename2));
readfile("$filename2");
exit();
?>
