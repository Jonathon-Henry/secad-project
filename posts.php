<?php
	require 'database.php';
	 //template for retrieving posts from the database


	//using prepared sql statements
	$prepared_sql = "SELECT title, content, date, postid FROM posts";

	//create prepared statement from the string
	if(!$stmt = $mysqli->prepare($prepared_sql))
		echo "Prepared SQL Statement Error";


	//execute the statement
	if(!$stmt->execute())
		echo "Execute error";

	//Bind the results to variables
	$title = NULL; $content = NULL; $date=NULL; $postid=NULL;
	if(!$stmt->bind_result($title, $content, $date, $postid))
		echo "Binding failed ";

	//Display the data from the variables (Should have HTML tags to provide a good presentation)
	while($stmt->fetch()){
		echo htmlentities($title) . ", " . htmlentities($content) . ", " .
		htmlentities($date) . "<br>";
		echo '<form action="changepostform.php" method="POST" class="form login">
					<input type="hidden" name="postid" value="<?php echo htmlentities($postid); ?>" /> <br>
					<input type="hidden" name="username" value="<?php echo $_SESSION(["username"]); ?>" />
					<button class="button" type="submit">
						Edit or Delete post
					</button>
		</form>';
	}

?>
