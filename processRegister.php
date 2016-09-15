<?php
session_start();

?>

<!DOCTYPE html>
<html>
 <head>
 
  <title>Register Account</title>
 
</head>


 <body>
 	<?php
 	include 'databaseinfo.php';

 	$firstname = $_POST['first'];
 	$lastname = $_POST['last'];
 	$email = $_POST['email'];
 	$password = $_POST['password'];


 	$query = "select * from login where login.email= '$email'"; //see if the user name and password were foudn in the table
 	  	$result = $db->query($query);
 	  	$rows = $result->num_rows;

 	  	if ($rows < 1) { //Checks to see if the email that was entered was already registered, if not:
 	  		$insertQuery = "INSERT INTO login(firstName, lastName, email, password, authorization) VALUES ('$firstname', '$lastname', '$email', '$password', 'user')" or die("Your register query couldn't be done: " . $db->error);
			$insertedResult = $db->query($insertQuery);

			$_SESSION['registerSuccessful'] = "Your account has been successfully registered with the Community Honor Fund!";

 	  		header("Location: login.php");

 	  	}

 	  	else {
 	  		$_SESSION['registerUnsuccessful'] = "There is an account that is already registered under the email you entered. Please enter a new email!"; //Notification that the user's login was unsuccessful b/c they already registered with that email
 	  		header("Location: register.php");
 	  	}


?>
 	</body>


</html>