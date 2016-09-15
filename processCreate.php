<?php
	include 'databaseinfo.php'; //database information to access MySQL

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];

	$gender = $_POST['gender'];
    
   	$age = $_POST['age'];
  	
    $race = $_POST['race'];
   	
    $income = $_POST['income'];
   	
    $address = $_POST['address'];
  	
    $city = $_POST['city'];
   	
    $state = $_POST['state'];
    
    
    $email = $_POST['email'];
    
    $phone = $_POST['phone'];
    
    $workplace = $_POST['workplace'];
    
    $principal = $_POST['principal'];
    

    $chf1First = $_POST['chf1First'];

    $chf1Last = $_POST['chf1Last'];

    $chf1 = $chf1Last . ", " . $chf1First;

    
    $chf2First = $_POST['chf2First'];

    $chf2Last = $_POST['chf2Last'];

    $chf2 = $chf2Last . ", " . $chf2First;

    
    $payment = $_POST['payment'];
    
    $meetingDate = $_POST['meetingDate'];

    $dateConverted = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$meetingDate)));

    



   	$clientMainQuery = "INSERT INTO clientmain (firstName, lastName, phone, email, workplace, chf1, chf2, nextMeeting, nextPayment, principal)
        VALUES('$firstName', '$lastName','$phone', '$email', '$workplace', '$chf1', '$chf2', '$dateConverted', '$payment', '$principal')";
	$result = $db->query($clientMainQuery) or die("Your main client query couldn't be done: " . $db->error);

    $id = $db->insert_id;

    $clientMoreQuery = "INSERT INTO clientmore (gender, age, race, income, address, city, state, id)
        VALUES('$gender', '$age', '$race', '$income', '$address', '$city', '$state', '$id')";

        $result = $db->query($clientMoreQuery) or die("Your personal information query couldn't be done: " . $db->error);
    



?>