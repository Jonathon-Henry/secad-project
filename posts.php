<?php 
	require 'database.php';
	 //template for retrieving posts from the database


	//using prepared sql statements 
	$prepared_sql = "SELECT title, content, date FROM posts";

	//create prepared statement from the string 
	if (!$stmt = $mysqli->prepare($prepared_sql))
		echo "Prepared SQL Statement Error";

	//execute the statement
	


?> 