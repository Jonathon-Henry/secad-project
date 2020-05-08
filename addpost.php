
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	require "session_auth.php";
	require "database.php";
	$nocsrftoken = sanitize_input($POST["nocsrftoken"]);
	$newcontent = sanitize_input($_REQUEST["content"]);
	$newtitle = sanitize_input($_REQUEST["title"];
	//$postid = sanitize_input($_REQUEST["postid"];
	$newdate = sanitize_input($_REQUEST["date"];
	$username = sanitize_input($_REQUEST["username"];

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
