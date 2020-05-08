
<?php
//	require 'session_auth.php';
//	require 'database.php';
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
$username = $_POST["username"];
$password = $_POST["password"];


	if (isset($username) and isset($password)){
		if (securechecklogin($username,$password)) {
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
		<textarea placeholder="What's happening? write about it..." name="content"></textarea><br>
		<button class='homepage-button' type='submit' name='writePost' action='index.php'> Write Post</button>
	</form>

	<br><br><br>


<?php
		$dbserver = "localhost";
		$dbusername = "secad-jhjs";
		$dbpassword = "root";
		$dbname = "secad";
		

		//connect to db for post echoing
		$conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);

		$insertsql = "INSERT INTO posts (username, date, content, title) VALUES ('admin', '2020-12-05 12:39:16', 'this is a test', 'test')";
		$conn->query($insertsql);

		//query the database
		$sql = "SELECT * FROM posts";
		$result = $conn->query($sql);

		if ($result->num_rows > 0){
			//output the data 
			while ($row = $result->fetch_assoc()){
				echo "<div class='comment-box'><p>";
				echo $row["username"]."<br>";
				echo $row["title"];
				echo $row["date"];
				echo $row["content"];
			}
		} else {
			echo "0 results";
		}
		$conn->close();



?>










</body>
</html>



<?php


  	function securechecklogin($username, $password) {
		$mysqli = new mysqli('localhost',
							  'secad-jhjs' /*Database username*/,
							  'root'  /*Database password*/,
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
