<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sign Up For A New Account! - MiniFaceboook</title>
</head>
<body>
      	<h2>Sign up for a new MiniFacebook Accoount</h2>

      	<h4>By Jacob Scheetz & Johnathan Henry</h4>

<?php
  //some code here
  echo "Current time: " . date("Y-m-d h:i:sa")
?>
          <form action="addnewuser.php" method="POST" class="form login">
                Username:
                <input type="text" class="text_field" name="username" required
                	pattern="^[\w.-]+@[\w-]+(.[\w-]+)*$" title="Please enter a valid email as username"
                	placeholder="Your email address here"
                	onchange="this.setCustomValidity(this.validity.patternMismatch?this.title: '');"/> <br>
                Password: 
                <input type="password" class="text_field" name="password" required
                			placeholder="Your password"
                			pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$"
                			title="Password must contain at least 8 characters with 1 special symbol !@#$%^& 1 number, 1 lowercase letter and 1 UPPERCASE letter"
                			onchange="this.setCustomValidity(this.validity.patternMismatch?this.title: '');"
                			onkeyup="document.forms[0].repassword.pattern = RegExp(this.value);"/> <br>

                Retype Password:
                <input type="password" class="text_field" name="repassword"
                		placeholder="retype your password" required
                		title="Password does not match"
                		onkeyup="this.setCustomValidity(this.validity.patternMismatch?this.title: '');"/>
                <button class="button" type="submit">
                  Sign Up
                </button>
          </form>

</body>
</html>

