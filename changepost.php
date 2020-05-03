
<?php

	require "session_auth.php";
	require 'database.php';
	$nocsrftoken = sanitize_input($POST["nocsrftoken"]);
	$newcontent = sanitize_input($_REQUEST["newcontent"]);
	$newtitle = sanitize_input($_REQUEST["newtitle"];
	$postid = sanitize_input($_REQUEST["postid"];
	$newdate = sanitize_input($_REQUEST["newdate"];
	$username = sanitize_input($_REQUEST["username"];
	if (isset($postid)){
		echo "DEBUG:changepost.php->Got: postid=$postid;\n<br>";
	} else {
		echo "postid doesn't exist";
		exit();
	}

	if (!isset($nocsrftoken) or ($nocsrftoken!=$_SESSION['nocsrftoken'])){
		echo "<script>alert('Cross-site request forgery is detected!');</script>";
		header("Refresh:0; url=logout.php");
		die();
	}
	if ($username!=$_SESSION["username"]) {
		echo "<script>alert('Cannot edit others' posts!');</script>";
		header("Refresh:0; url=logout.php");
		die();
	}
	editpost($newtitle, $newcontent, $newdate, $postid);
?>
<a href="index.php">Home</a> | <a href="logout.php">Logout</a>
