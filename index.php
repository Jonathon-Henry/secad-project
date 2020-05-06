
<?php

	$lifetime = 15 * 60;
	$path = "/minifacebook";
	$domain = "192.168.56.101";
	$secure = TRUE;
	$httponly = TRUE;
	session_set_cookie_params($lifetime, $path, $domain, $secure, $httponly);
	session_start(); 

	if (isset($_POST["username"]) and isset($_POST["password"])){
		if (securechecklogin($_POST["username"],$_POST["password"])) {
			$_SESSION["logged"] = TRUE;
			$_SESSION["username"] = $_POST["username"];
			$_SESSION["browser"] = $_SERVER["HTTP_USER_AGENT"];
	} else{
		echo "<script>alert('Invalid username/password');</script>";
		unset($_SESSION["logged"]);
		header("Refresh:0; url=form.php");
		die();

		}
	}
	if (!isset($_SESSION["logged"]) or $_SESSION["logged"] != TRUE){
		echo "<script>alert('you have not logged in yet. Please login first');</script>";
		header("Refresh:0; url=form.php");
		die();
	}
	if ($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]){
		echo "<script>alert('Session hijacking detected, please login again');</script>";
		header("Refresh:0; url=form.php");
		die();
	}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./style.css">
	<title> Minifacebook Homepage </title>
</head>
<body>

	<a href="changepasswordform.php">
		<button class='homepage-button' type='submit' action='changepasswordform.php'>Change Password</button></a>
	<h1> 
		Welcome, <?php echo htmlentities($_POST['username']); ?>!
	</h1>
	<div><b><font size="+3">
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		<br>
		~~~~~~~~| MiniFacebook Homepage |~~~~~~~~
		<br>
		~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		</font>
		</b>	
	</div>
	<h2>Write a Post</h2>
	<!--- text area under here to write post, clicking the Post button should submit it via getPosts() function-->
	<form method="POST" action='index.php'>
		<input type="hidden" name="username" value='<?php $_SESSION["username"]?>'>
		<input type="hidden" name="date" value='<?php date("Y-m-d h:i:sa") ?>'>
		<textarea placeholder="What's happening? write about it..." name="message"></textarea><br>
		<button class='homepage-button' type='submit' name='writePost' action='index.php'> Write Post</button>
	</form>

	<br><br><br>


<?php 
		//$mysqli = new mysqli('localhost',
							  //'root' /*Database username*/,  
							 // 'seedubuntu'  /*Database password*/,                                    			
							  //'secad' /*Database name*/);
		//if($mysqli->connect_errno){
			//printf("Database connection failed: %s\n", $mysqli->connect_error);
			//exit();

  	$prepared_sql = "SELECT * FROM users;";
  	if(!$stmt = $mysqli->prepare($prepared_sql))
		echo "Prepared SQL Statement Error: ".mysql_error();

	if(!$stmt->execute())
		echo "Execute error";

  	$username = NULL; $email = NULL; $phone =NULL;
	if(!$stmt->bind_result($username, $email, $phone))
		echo "Binding failed ";

	while($stmt->fetch()){
		echo htmlentities($username);
	}
?>





			
			



</body>
</html>



<?php


  	function securechecklogin($username, $password) {
		$mysqli = new mysqli('localhost',
							  'root' /*Database username*/,  
							  'seedubuntu'  /*Database password*/,                                    			
							  'secad' /*Database name*/);
		if($mysqli->connect_errno){
			printf("Database connection failed: %s\n", $mysqli->connect_error);
			exit();
		}
		$prepared_sql = "SELECT * FROM users WHERE username=? AND password = password(?)"; 
		if(!$stmt = $mysqli->prepare($prepared_sql))	
			echo "Prepared Statement Error";
		$stmt->bind_param("ss",$username,$password);			
		if(!$stmt->execute()) echo "Execute Error";
		if(!$stmt->store_result()) echo "Store result error";
		$result = $stmt;
		if($result->num_rows ==1)
			return TRUE;
		return FALSE;
  	}

 

?>





