<?php

	date_default_timezone_set('America/Los_Angeles');
	require ('database.php');

?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="utf-8">
	<title>Minifacebook Homepage</title>
</head>
<body>



	<?php
	$PostId = $_POST['PostId'];
	$username = $_POST['username'];
	$date = $_POST['date'];
	$message = $_POST['message'];
	
	echo "<form method='POST' action='".editComments($mysqli)."'>
		<input type='hidden' name='PostId' value='".$PostId."'>
		<input type='hidden' name='username' value='".$username."'>
		<input type='hidden' name='date' value='".$date."'>
		<textarea name='message'>".$message."</textarea><br>
		<button type='submit' name='postSubmit'>Edit</button>
	</form>";


	?>


</body>
</html>