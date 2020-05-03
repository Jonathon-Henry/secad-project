<?php
	$mysqli = new mysqli('localhost', 'scheetzj2', 'mysecretP4$$', 'secad');
	if ($mysqli->connect_error){
		printf("Database connection failed : %s\n", $mysqli->connect_error);
	exit();
	}
	function changepassword($username, $password){
		global $mysqli;
		$prepared_sql = "UPDATE users SET password=MD5(?) WHERE username= ?;";
		echo "DEBUG>prepared_sql= $prepared_sql\n";
		if (!$stmt = $mysqli->prepare($prepared_sql)) return FALSE;
		$stmt->bind_param("ss", $newpassword, $username);
		if(!$stmt->execute()) return FALSE;
		return TRUE;
	}

	function editpost($newtitle, $newcontent, $newdate, $postid){
		global $mysqli;
		$prepared_sql = "UPDATE posts SET title=?, content=?, newdate=? WHERE postid= ?;";
		echo "DEBUG>prepared_sql= $prepared_sql\n";
		if (!$stmt = $mysqli->prepare($prepared_sql)) return FALSE;
		$stmt->bind_param("ssss", $newtitle, $newcontent, $newdate, $postid);
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
		$prepared_sql = "INSERT INTO users VALUES (?, MD5(?));";
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
?>
