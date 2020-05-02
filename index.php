
<?php

	$lifetime = 15 * 60;
	$path = "/lab6";
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
	<a href="changepasswordform.php">
		Change password</a>
	<h2> Welcome <?php echo htmlentities($_POST['username']); ?> !</h2>
<?php
  	function securechecklogin($username, $password) {
		$mysqli = new mysqli('localhost',
							  'scheetzj2' /*Database username*/,  
							  'mysecretP4$$'  /*Database password*/,                                    			
							  'secad' /*Database name*/);
		if($mysqli->connect_errno){
			printf("Database connection failed: %s\n", $mysqli->connect_error);
			exit();
		}
		$prepared_sql = "SELECT * FROM users WHERE username=? " . 
						" AND password = password(?)"; 
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



<?php
	date_default_timezone_set('America/New_York');
?>

<html> 

<body>
<!-- show post here-->


<!-- comment section here --> 
<?php
echo "<form> 
	<input type='hidden' name='username' value='username'>
	<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
	<textarea name='message'></textarea>
	<button type='submit' name='submit'> Comment </button>
</form>";
?>

</body>

</html>


