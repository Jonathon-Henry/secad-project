
<?php
//	require 'session_auth.php';
	require 'database.php';
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
		<textarea class="title-bar" placeholder="give your post a title" name="titlePost"></textarea><br>
		<textarea placeholder="What's happening? write about it..." name="content"></textarea><br>
		<button class='homepage-button' type='submit' name='Post'> Write Post</button>
	</form>

	<br><br><br>


<?php
		$dbserver = "localhost";
		$dbusername = "secad-jhjs";
		$dbpassword = "root";
		$dbname = "secad";
		$date = date("Y-m-d H:i:s");
	

		

		//connect to db for post echoing
		$conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);



			$insertsql = "INSERT INTO posts (username, date, content, title) VALUES ('$username', '$date', 'some new content for testing', 'a new title')";
			$conn->query($insertsql);

		//query the database
		$sql = "SELECT * FROM posts";
		$result = $conn->query($sql);


		if ($result->num_rows > 0){
			//output the data 
			while ($row = $result->fetch_assoc()){
				if ($row["username"] == $_SESSION["username"]){ //if the post is from the same user that's
					echo "<div class='comment-box'><p><b>";									//logged in or if the user is a superuser
					echo $row["username"]."</b><br>";
					echo $row["title"];
					echo " | ";
					echo $row["date"]."<br>";
					echo $row["content"];
					echo "</p>";

					//delete post button
					echo "<form class='delete-form' method='POST' action='".deletePost($conn)."'>";
						echo "<input type='hidden' name='PostId' value='".$row['PostId']."'>";
						echo "<button type='submit' name='postDelete'>Delete</button>";
					echo "</form>";

					//edit post button
					echo "<form class='edit-form' method='POST' action='editPost.php'>";
						echo "<input='hidden' name='PostId' value='".$row['PostId']."'";
						echo "<input='hidden' name='username' value='".$row['username']."'>";
						echo "<input='hidden' name='date' value='".$row['date']."'>";
						echo "<input='hidden' name='content' value='".$row['content']."'>";
						echo "<button>Edit</button>";
					echo "</form>";

					//end of content in comment box
					echo "</div><br>";
				} else {
					echo "<div class='comment-box'><p><b>";
				echo $row["username"]."</b><br>";
				echo $row["title"];
				echo " | ";
				echo $row["date"]."<br>";
				echo $row["content"];
				echo "</p>"; 

				//else you can reply to a post because it is not yours
				echo "<form class='comment-form' method='POST' action='commentPost.php'>";
						echo "<input='hidden' name='PostId' value='".$row['PostId']."'";
						echo "<input='hidden' name='username' value='".$row['username']."'>";
						echo "<input='hidden' name='date' value='".$row['date']."'>";
						echo "<input='hidden' name='content' value='".$row['content']."'>";
						echo "<button>Comment</button>";
					echo "</form>";
				echo "</div><br>";
				}
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
