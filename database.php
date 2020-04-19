<?php
	$mysqli = new mysqli('localhost', 'admin', 'P4$$w0rd', 'secad');
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
?>