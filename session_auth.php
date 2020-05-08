<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	$lifetime = 15 * 60;
	$path = "/minifacebook";
	$domain = "localhost";
	$secure = TRUE;
	$httponly = TRUE;
	session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
	session_start();


	//check the session
	if (!isset($_SESSION["logged"]) or $_SESSION["logged"] != TRUE){
		//the session is not authenicated
		echo "<script>alert('you have to login first!');</script>";
		session_destroy();
		header("Refresh:0; url=form.php");
		die();
	}

	if ($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]){
		//it is a session hijacking attack since it comes from a different browser
		echo "<script>alert('session hijacking attacj is detected!');</script>";
		session_destroy();
		header("Refresh:0; url=form.php");
		die();
	}
?>
