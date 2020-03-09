<?php
include 'apiclient.php';
session_start();
	$url="https://beta.id90travel.com/session.json";
	$airline=$_POST['airline'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$remember_me=$_POST['remember_me']=='on' ? 1: 0;
	$parameters = array(
			   "session[airline]" => $airline,
			   "session[username]" => $username,
			   "session[password]" => $password,
			   "session[remember_me]" => $remember_me
			);
	$result=httpPost($url,$parameters);
	$resultCode=$result["code"];
	switch($resultCode){
		case 200:
			
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $username;
			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (15 * 60);
			header('Location: formsearch.php');
			exit();
			break;
		case 401: 
			$_SESSION['error']="Usuario/contraseña incorrectos";
			header('Location: login.php');
			exit();
			break;
		default:
			echo "Codigo de respuesta no codificado";
			break;
	}		
?>
