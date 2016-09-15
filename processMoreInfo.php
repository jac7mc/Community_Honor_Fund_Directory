<?php
	include 'databaseinfo.php'; //database information to access MySQL

	$id = $_POST["id"]; //get the unique id of the record that each person has in the mysql table

		$gender = $_POST['gender'];
    	$age = $_POST['age'];
    	$race = $_POST['race'];
    	$income = $_POST['income'];
    	$address = $_POST['address'];
    	$city = $_POST['city'];
    	$state = $_POST['state'];

    	$query = "UPDATE clientmore SET gender='$gender',age='$age', race='$race', income='$income', address='$address', city='$city', state='$state' WHERE id='$id'";
	$result = $db->query($query) or die("Your query couldn't be done: " . $db->error);

?>