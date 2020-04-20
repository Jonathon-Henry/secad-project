<?php 
	require "database.php";
	$username = sanitize_input($_POST["username"]);
	$password = sanitize_input($_POST["password"]);
	if (!validateUsername($username) or !validatePassword($password)){
		echo "<script>alert('Please enter valid username/password!');</script>";
		header("Refresh:0; url=registrationform.php");
		die();
	}
	echo "DEBUG: addnewuser.php> username= $username; password= $password";
	if (addnewuser($username, $password)){
		echo "DEBUG: addnewuser.php> $username is added";
		echo "<script>alert('Your new account is successfully registered. Please login!);</script>";
		header("Refresh:0; url=form.php");
	} else{
		echo "DEBUG:addnewuser.php> $username cannot be added";
		echo "<script> alert('Something was wrong with your registration. Please try again!');</script>";
		header("Refresh:0; url=registrationform.php");
	}

?>