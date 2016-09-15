<?php
session_start();

if (isset($_SESSION['registerUnsuccessful'])) {
	print $_SESSION['registerUnsuccessful'];
	unset($_SESSION['registerUnsuccessful']);
}

?>

<DOCTYPE html>
<html>
<head>

	<style> 
	
	input {
		height: 25;
	}

	</style>



<title>Create an Account</title>

</head>

<body>

	<br />
	 <font size="8">Enter the following information to register a new account!</font>
 	<br /><br />
 	<form action="processRegister.php" method="POST">

 		<font size="5"> <b>First Name: </b> </font> <input type = "text" name = "first" placeholder='First Name'> 
 		<br /> <br />

 		<font size="5"> <b>Last Name: </b> </font> <input type = "text" name = "last" placeholder='Last Name'> 
 		<br /> <br />


		<font size="5"> <b>Email: </b> </font> <input type = "email" name = "email" placeholder='Email'>
		<br /> <br />

		<font size="5"> <b>Password: </b> </font> <input type = "text" name = "password" placeholder='Password'>
		<br /><br />

		<input type = "submit" name = 'submit' value = "Create the User!" ;>


		 </form>







</body>

</html>