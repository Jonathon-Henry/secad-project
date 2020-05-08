
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	require "session_auth.php";
	require 'database.php';
	$username= $_REQUEST["username"];
	$newpassword = $_REQUEST["newpassword"];
	$nocsrftoken = $POST["nocsrftoken"];
	if (isset($username) AND isset($newpassword)){
		echo "DEBUG:changepassword.php->Got: username=$username;newpassword=$newpassword\n<br>";
	} else {
		echo "no provided username/password to change";
		exit();
	} else {
		echo "No provided username/password to change";
		exit();
	}
	if (!isset($nocsrftoken) or ($nocsrftoken!=$_SESSION['nocsrftoken'])){
		echo "<script>alert('Cross-site request forgery is detected!');</script>";
		header("Refresh:0; url=logout.php");
		die();
	}
?>
<a href="index.php">Home</a> | <a href="logout.php">Logout</a>
