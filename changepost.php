
<?php

	require "session_auth.php";
	require 'database.php';
	$nocsrftoken = sanitize_input($POST["nocsrftoken"]);
	$newcontent = sanitize_input($_REQUEST["newcontent"]);
	$newtitle = sanitize_input($_REQUEST["newtitle"];
	$postid = sanitize_input($_REQUEST["postid"];
	$newdate = sanitize_input($_REQUEST["newdate"];
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
