<?php
	include 'databaseinfo.php'; //database information to access MySQL

	$id = $_POST['id'];

	$firstName = $_POST['firstName'];

	$lastName = $_POST['lastName'];
	
	$phone = $_POST['phone'];

	$email = $_POST['email'];
	
	$workplace = $_POST['workplace'];
		
	$chf1First = $_POST['chf1First'];

	$chf1Last = $_POST['chf1Last'];
		

	$chf2First = $_POST['chf2First'];

    $chf1 = $chf1Last . ", " . $chf1First;
	$chf2Last = $_POST['chf2Last'];
		
    $chf2 = $chf2Last . ", " . $chf2First;
	
	$lastMeeting = $_POST['lastMeeting'];

    $lastMeeting = date("Y-m-d H:i:s",strtotime($lastMeeting));

	$nextMeeting = $_POST['nextMeeting'];

    $nextMeeting = date("Y-m-d H:i:s",strtotime($nextMeeting));

	
	$lastPayment = $_POST['lastPayment'];
	
	$nextPayment = $_POST['nextPayment'];
	
	$principal = $_POST['principal'];

	$clientMainQuery = "UPDATE clientmain
		SET firstName='$firstName', lastName='$lastName', phone='$phone', email='$email', workplace='$workplace', chf1='$chf1', chf2='$chf2', lastMeeting= '$lastMeeting', nextMeeting='$nextMeeting', lastPayment= '$lastPayment', nextPayment='$nextPayment', principal='$principal'
		WHERE id= '$id'";
	$result = $db->query($clientMainQuery) or die("Your main client query couldn't be done: " . $db->error);


?>