<?php
	$mysqli = new mysqli('localhost', 'scheetzj2', 'mysecretP4$$', 'secad');
	if ($mysqli->connect_error){
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
?>