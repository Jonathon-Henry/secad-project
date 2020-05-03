<?php
  #require "session_auth.php";
  $rand= bin2hex(openssl_random_pseudo_bytes(16));
  $_SESSION["nocsrftoken"] = $rand;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login page - SecAD</title>
</head>
<body>
      	<h1>Change Post, MiniFacebook</h1>

<?php
  $postid = $_REQUEST["postid"];
  $username = $_REQUEST["username"];
  echo "Current time: " . date("Y-m-d h:i:sa");

  $prepared_sql = "SELECT title, content, date FROM posts WHERE postid=$postid";

	//create prepared statement from the string
	if(!$stmt = $mysqli->prepare($prepared_sql))
		echo "Prepared SQL Statement Error";

	//execute the statement
	if(!$stmt->execute())
		echo "Execute error";

	//Bind the results to variables
	$title = NULL; $content = NULL; $date=NULL;
	if(!$stmt->bind_result($title, $content, $date))
		echo "Binding failed ";

  if ($stmt->fetch()){
  echo htmlentities($title) . ", " . htmlentities($content) . ", " .
    htmlentities($date) . "<br>";
  }
?>
          <form action="changepost.php" method="POST" class="form login">
                <input type="hidden" name="postid" value="<?php echo $postid; ?>" />
                <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
                <input type="hidden" name="newdate" value="<?php echo date('Y-m-d h:i:sa'); ?>" />
                <input type="hidden" name="username" value="<?php echo $username; ?>" />
                Edit post title: <input class="text_field" name="newtitle" value="<?php echo $title; ?>" /> <br>
                Edit post content: <input class="text_field" name="newcontent" value="<?php echo $content; ?>" /> <br>
                <button class="button" type="submit">
                  Edit post
                </button>
          </form>
          <form action="deletepost.php" method="POST" class="form login">
                <input type="hidden" name="username" value="<?php echo $username; ?>" />
                <input type="hidden" name="postid" value="<?php echo $postid; ?>" />
                <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
                <button class="button" type="submit">
                  Delete post
                </button>
          </form>

</body>
</html>
