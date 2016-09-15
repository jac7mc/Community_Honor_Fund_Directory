<?php
session_start();

if (!isset($_SESSION['login'])) { //check if the person is currently logged in and if they aren't, redirect to login page
	header("Location: login.php"); 

}

if ($_SESSION['userType'] != 'user') {
	header("Location: login.php"); 

}

?>

<h1>Welcome User! <h1>