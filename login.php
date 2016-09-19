<?php
session_start();

if (isset($_SESSION['registerSuccessful'])) { //Displays the message for when a new account has been registered
	print $_SESSION['registerSuccessful'];
	unset($_SESSION['registerSuccessful']);
}

if (isset($_SESSION['loginError'])) { //Displays the message for when the user wasn't able to login b/c they entered the wrong email or password
	print $_SESSION['loginError'];
	unset($_SESSION['loginError']);
}

if (isset($_SESSION['sentPassword'])) { //Displays the message for when the person's password was send to their email
	print $_SESSION['sentPassword'];
	unset($_SESSION['sentPassword']);
}

if (isset($_SESSION['login'])) {

	if ($_SESSION['userType'] == 'admin') {
		header("Location: successfulAdminLogin.php"); //redirect to the admin successful login page

	}

	if ($_SESSION['userType'] == 'user') {
		header("Location: successfulUserLogin.php"); //redirect to the user successful login page

	}


}


?>

<!DOCTYPE html>
<html>
 <head>


  <link rel="stylesheet" type="text/css" href="loginStyle.css"/>


<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">





</script>

  <title>Login</title>
 </head>
 <body>


<!--  		<h1 align="center"> <font size="20"> Directory Login</font></h1>
 -->

 		

<div id="picture">

 <img class="aligned" src="CHF_logo.png" alt="Community Honor Fund">
 <br />  <br />


</div>

    	  <div class="modal-dialog">
				<div class="loginmodal-container">
					<h1>Login to Your Account</h1><br>
				  <form action="processlogin.php" method="POST">
					<input type="email" name="email" placeholder="Email">
					<input type="password" name="password" placeholder="Password">
					<input type="submit" name="submit" class="login loginmodal-submit" value="Login">
				  </form>
					
				  <div class="login-help">
					<a href="register.php">Register</a> - <a href="forgotPassword.php">Forgot Password</a>
				  </div>
				</div>
			</div>

 	<br />
 	<!-- <form align="left" action="processlogin.php" method="POST"> -->
		<!-- <input type = "email" name = "email" placeholder='Email'> -->

		<!-- <input type = "password" name = "password" placeholder='Password'> -->
		
		<!-- <input type = "submit" name = 'submit' value = "Login"> </form> -->
	
	<!-- <br /> </br> -->
	

<!-- <button type="button" onclick="location.href='forgotPassword.php';">Forgot Password</button> -->

<!-- <button type="button" onclick="location.href='register.php';">Create an Account</button> -->

<!-- <br /> -->

<!-- <br /> -->


<!-- <div class="sideToSide">

	<form action="forgotPassword.php" method="POST">
		<input type = "submit" name = 'submit' value = "Forgot Password"> </form>
	
	
	<form action="createMaker.php" method="POST">
		<input type = "submit" name = 'create' value = "Create an Account"> </form>

</div> -->


</body>
</html>