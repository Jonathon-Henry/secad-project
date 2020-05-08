<!DOCTYPE html>
<html lang="en">
<head>
  <!--<link rel="stylesheet" type="text/css" href="style.css">-->
  <meta charset="utf-8">
  <title>Sign Up For A New Account! - MiniFaceboook</title>
</head>
<body>
      	<h2>Sign up for a new MiniFacebook Accoount</h2>

      	<h4>By Jacob Scheetz & Jonathon Henry</h4>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  //some code here
  echo "Current time: " . date("Y-m-d h:i:sa")
?>
          <form action="addnewuser.php" method="POST" class="form login">
                Username:
                <input type="text" class="text_field" name="username" required
                	pattern="^[\w.-]+@[\w-]+(.[\w-]+)*$" title="Please enter a valid email as username"
                	placeholder="Your email address here"
                	onchange="this.setCustomValidity(this.validity.patternMismatch?this.title: '');"
                  onvalid="this.setCustomValidity('');"/> <br>
                Password:
                <input type="password" class="text_field" name="password" required
                			placeholder="Your password"
                			pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$"
                			title="Password must contain at least 8 characters with 1 special symbol !@#$%^& 1 number, 1 lowercase letter and 1 UPPERCASE letter"
                			onchange="this.setCustomValidity(this.validity.patternMismatch?this.title: '');"
                      onvalid="this.setCustomValidity('');"/> <br>

                Retype Password:
                <input type="password" class="text_field" name="repassword"
                		placeholder="retype your password" required
                		title="Password does not match"
                		onkeyup="this.setCustomValidity(this.value === document.forms[0].password.value?'':this.title);"
                    onvalid="this.setCustomValidity('');"/>
                <button class="button" type="submit">
                  Sign Up
                </button>
          </form>

</body>
</html>
