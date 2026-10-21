<?php

$root = $_SERVER["DOCUMENT_ROOT"];
require_once("$root/libs/SOAPhandler.class.php");
require_once("SOAP_CDR.class.php");

$SOAPhandler = new SOAPhandler("SOAP_CDR");

if($SOAPhandler->exportWSDL()){
    if($SOAPhandler->authentication())
        $SOAPhandler->execute();
}

$error = $SOAPhandler->getError();
if($error) echo $error;
?>
