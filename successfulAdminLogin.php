<?php
session_start();

if (!isset($_SESSION['login'])) { //check if the person is currently logged in and if they aren't, redirect to login page
	header("Location: login.php"); 

}

if ($_SESSION['userType'] != 'admin') {
	header("Location: login.php"); 

}

?>


<!DOCTYPE html>
<html>
 <head>

 <title>Community Honor Fund</title>
 </head>
 <body>

<h1 align="center">Welcome Admin! </h1>


<a href="directory.html">Directory</a>



</body>
</html>
