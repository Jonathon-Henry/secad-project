<?php
	$mysqli = new mysqli('localhost', 'root', 'seedubuntu', 'secad');
	if ($mysqli->connect_error()){
		printf("Database connection failed : %s\n", $mysqli->connect_error);
	exit();
	}
	function changepassword($username, $password){
		global $mysqli;
		$prepared_sql = "UPDATE users SET password=password(?) WHERE username= ?;";
		echo "DEBUG>prepared_sql= $prepared_sql\n";
		if (!$stmt = $mysqli->prepare($prepared_sql)) return FALSE;
		$stmt->bind_param("ss", $newpassword, $username);
		if(!$stmt->execute()) return FALSE;
		return TRUE;
	}


	function sanitize_input($input){
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}

	function validateUsername($username){
		$username = sanitize_input($username);
		if (empty($username) or strlen($username) < 6){
			return FALSE;
		}
		return TRUE;
	}

	function validatePassword($password){
		$password = sanitize_input($password);
		if (empty($password) or
			!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$/", $password)){
			return FALSE;
		}
		return TRUE;
	}

	function addnewuser($username, $password){
		globlal $mysqli;
		$prepared_sql = "INSERT INTO users VALUES (?, password(?));";
		echo "DEBUG:databasse.php->addnewuser->prepared_sql= $prepared_sql\n";
		if (!$stmt = $mysqli-> prepare($prepared_sql)){
			return FALSE;
		}
		$stmt->bind_param("ss", $username, $password);
		if (!$stmt->execute()){
			return FALSE;
		}
		return TRUE;
	}



	//function to display posts on the page
	function getPosts($mysqli){
		$sql = "SELECT * FROM posts";
		$result = $mysqli->query($sql);
		
		/* 
		 * displaying the posts
		 * and giving the reply functionality to posts that arent from a specific user
		 */
		while ($row = $result->fetch_assoc()){
			$username = $row['username'];
			$sql2 = "SELECT * FROM users WHERE username='$username'";
			$result2 = $mysqli->query($sql2);
			if ($row2 = $result2->fetch_assoc()){
				echo "<div class='comment-box'><p>";
				echo $row2['username']."<br>";
				echo $row['date']."<br><br>";
				echo nl2br($row['message']);
				echo "</p>";

				

				if ($_SESSION['username'] == $row2['username'] or $row2['enabled'] == 1){
				echo "<form class='delete-form' method='POST' action='".deleteComments($mysqli)."'>
					<input type='hidden' name='PostId' value='".$row['PostId']."'>
					<button type='submit' name='postDelete'>Delete</button>
				</form>
				<form class='edit-form' method='POST' action='editPost.php'> 
					<input type='hidden' name='PostId' value='".$row['PostId']."'>
					<input type='hidden' name='username' value='".$row['username']."'>
					<input type='hidden' name='date' value='".$row['date']."'>
					<input type='hidden' name='message' value='".$row['message']."'>
					<button>Edit</button>
				</form>";

				}
			}
		}
	}//end getPosts()



	function editPost($mysqli){
		if(isset($_POST['postSubmit'])){
		$PostId = $_POST['PostId'];
		$username = $_POST['username'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		

		//create sql statement
		$sql = "UPDATE posts SET message='$message' WHERE PostId='$PostId'";

		$result = $mysqli->query($sql);
		header("Location: index.php");
		}
	}//end editPosts()



	function deletePost($mysqli){
		if(isset($_POST['postDelete'])){
		$PostId = $_POST['PostId'];
		

		//create sql statement
		$sql = "DELETE FROM posts WHERE PostId='$PostId'";

		$result = $mysqli->query($sql);
		header("Location: index.php");
		}
	}//end deletePost()




	function setPost($mysqli){
		if(isset($_POST['postSubmit'])){
		$username = $_POST['username'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		

		//create sql statement
			$sql = "INSERT INTO posts (username, date, message) VALUES ('$username', '$date', '$message')";

		$result = $mysqli->query($sql);
		}
	}//end setPost()





?>
