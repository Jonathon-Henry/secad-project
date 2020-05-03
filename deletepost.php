
<?php
	require "session_auth.php";
	require 'database.php';
	$postid = $_REQUEST["postid"];
	$username = $_REQUEST["username"];
	$nocsrftoken = $POST["nocsrftoken"];
	if (isset($postid) && isset($username)){
		echo "DEBUG:deletepost.php->Got: postid=$postid; username=$username\n<br>";
	} else {
		echo "no postid to delete";
		exit();
	}

	if (!isset($nocsrftoken) or ($nocsrftoken!=$_SESSION['nocsrftoken'])){
		echo "<script>alert('Cross-site request forgery is detected!');</script>";
		header("Refresh:0; url=logout.php");
		die();
	} else {
		if ($username!=$_SESSION["username"]) {
			echo "<script>alert('Cannot delete others posts!');</script>";
			header("Refresh:0; url=logout.php");
			die();
		} else {
		if (!"DELETE FROM posts WHERE postid=$postid;"->execute())
			echo "Delete error.";
	}


?>
<a href="index.php">Home</a> | <a href="logout.php">Logout</a>
