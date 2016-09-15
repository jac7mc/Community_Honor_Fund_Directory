<?php
session_start();

?>

<!DOCTYPE html>
<html>
 <head>
 
  <title>Processing</title>
 
</head>


 <body>
 	<?php
 	include 'databaseinfo.php';

 	 	$user = trim($_POST['email']);
 	  	$password = trim($_POST['password']);


 	  	$query = "select * from login where login.email= '$user' and login.password = '$password'"; //see if the user name and password were foudn in the table
 	  	$result = $db->query($query);
 	  	$rows = $result->num_rows;


 	  	if ($rows < 1){ //there were no rows found with this email and password
 			$_SESSION['loginError'] = "The email or password that you used to login were not found in our server. Please try again. <br />";
 			if (isset($_SESSION['login'])) {
	 			 	unset($_SESSION['login']);
	 			}

	 		header("Location: login.php"); //redirect to the login page
	 	}

	 	else { //move to the options menu!
 			$_SESSION['login']= TRUE;
 			$data = $result->fetch_array(); 
 			$_SESSION['userType'] = $data['authorization']; //get the logged in user's permission type (user vs admin)
 			echo $_SESSION['userType'];

 			$userType = $_SESSION['userType'];

 			if ($userType == 'user') {
 				header("Location: successfulUserLogin.php"); //redirect to the successful login page

 			}

 			if ($userType == 'admin'){
 				header("Location: successfulAdminLogin.php"); //redirect to the successful login page

 			}


 			 

 		}




 	?>

 	</body>

 </html>