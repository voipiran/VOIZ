#!/usr/bin/php -q
<?php

/*Check VOIZ Installation*/
if (!file_exists('/etc/voiz.conf')) {   
	die('KILL: ');
	}


  require('/var/lib/asterisk/agi-bin/phpagi.php');
  error_reporting(E_ALL);

 $agi = new AGI();
 $agi->answer();


	/*Get CallerID*/
  	$temp = $agi->get_variable("CALLERID(num)");
	$calleridNumber = $temp['data'];
	
	$temp = $agi->get_variable("CALLERID(name)");
	$calleridName = $temp['data'];
	
	/*UniqueID*/
	$temp = $agi->get_variable("UNIQUEID");
	$uniqueid = $temp['data'];
	
	/*Agent Number*/
	$temp = $agi->get_variable("CONNECTEDLINE(num)");
	$agentNumber = $temp['data'];
	
	/*Queue Number*/
	$temp = $agi->get_variable("QUEUENUM");
	$surveyLocation = $temp['data'];
	

/*Get Survey Number in range and for some counts*/
$x= 1;
$maxCount=4;
while($x <= $maxCount){
   /*Pol Number*/
   	$temp = $agi->get_data('/var/lib/asterisk/agi-bin/voipiranagi/survey-sounds/survey-get-number-karshenas', 12000, 1);  
   	$surveyValue = $temp['result'];
	
	if($surveyValue>0 && $surveyValue<6){
		break;
	}
	$x++;
	
	if($x == $maxCount){
		$agi->stream_file('pr/goodbye');
		$agi->Hangup();
		die('KILL: ');
	}
	$agi->stream_file('/var/lib/asterisk/agi-bin/voipiranagi/survey-sounds/survey-number-not-correct');
}

$agi->set_variable("CDR(accountcode)", "نظرسنجی#".$surveyLocation);
$agi->set_variable("CDR(userfield)", $surveyValue."#".$agentNumber);


		//Nazare shoma Sabt Gardid
		$agi->exec('Playback','/var/lib/asterisk/agi-bin/voipiranagi/survey-sounds/survey-thankyou');
		$agi->Hangup();


?>