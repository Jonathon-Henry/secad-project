<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <title>Login MiniFacebook</title>
</head>
<body>
      	<h1>Login for MiniFacebook, By Jacob Scheetz & Jonathon Henry</h1>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  //some code here
  echo "Current time: " . date("Y-m-d h:i:sa")
?>
          <form action="index.php" method="POST" class="form login">
                Username:<input type="text" class="text_field" name="username" /> <br>
                Password: <input type="password" class="text_field" name="password" /> <br>
                <button class="button" type="submit">
                  Login
                </button>
          </form>
          <p> Don't have an account? click below to get signed up!</p>
          <a href= 'registrationform.php'>
          <button type='submit' action='registrationform.php'>Register</button>

</body>
</html>
