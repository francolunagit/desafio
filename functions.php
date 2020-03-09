<?php
require('apiclient.php');
function get_AirlinesDisplayName(){
	$jsonAirlines = httpGet("https://beta.id90travel.com/airlines");
	$arrayAirlines = json_decode($jsonAirlines, true);
		$airlines = $arrayAirlines;
		foreach($airlines as $airline){
		$salida.= '<option>'.$airline['display_name'].'</option>';      
		}
		return $salida;
}
function is_logged(){
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		$now = time();
		if($now > $_SESSION['expire']) {
			session_destroy();
			session_start();
			$_SESSION['error']="La sesión ha caducado";
			header('Location: login.php');		
			exit;
		}else{
			return true;
		}
	} else {
	   header('Location: login.php');
	exit;
	}
}
?>