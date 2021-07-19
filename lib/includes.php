<?php
	include_once("sessions.php");
	include_once("settings.php");
	include_once("classes.php");
	include_once("vendor/autoload.php");
	
    MercadoPago\SDK::setClientId(clientID);
    MercadoPago\SDK::setClientSecret(clientSecret);
?>