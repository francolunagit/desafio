<?php
include 'functions.php';
session_start();
if (is_logged()){
	header('Location: formsearch.php');
	exit();
}

?>