<?php
 	include 'databaseinfo.php';

// //(DON'T UNCOMMENT THIS LINE: query to create the main client directory table in mysql
 	// $createClientsMain = $db->query("
 	// 	CREATE TABLE clientmain (firstName VARCHAR(1000) NOT NULL DEFAULT '',
	 // 	lastName VARCHAR(1000) NOT NULL DEFAULT '',
	 // 	phone VARCHAR(1000) DEFAULT '',
	 // 	email VARCHAR(1000) DEFAULT '',
	 // 	workplace VARCHAR(1000) DEFAULT '',
	 // 	chf1 VARCHAR(1000) DEFAULT '',
	 // 	chf2 VARCHAR(1000) DEFAULT '',
	 // 	lastMeeting VARCHAR(1000) DEFAULT '',
	 // 	nextMeeting VARCHAR(1000) DEFAULT '',
	 // 	lastPayment DECIMAL(64,2) DEFAULT '',
	 // 	nextPayment DECIMAL(64,2) DEFAULT '',
	 // 	principal DECIMAL(64,2) DEFAULT '',
	 // 	id int PRIMARY KEY NOT NULL AUTO_INCREMENT)") or die("Your clientsmain table couldn't be created: " . $db->error);

//(DON'T UNCOMMENT THIS LINE: query to create the Client's addition information table in mysql

 	// $createClientsMore =
 	// $db->query(
 	// "CREATE TABLE clientmore (
 	//  gender VARCHAR(1000) DEFAULT '',
 	//  age VARCHAR(1000) DEFAULT '',
 	//  race VARCHAR(1000) DEFAULT '',
 	//  income VARCHAR(1000) DEFAULT '',
 	//  address VARCHAR(1000) DEFAULT '',
 	//  city VARCHAR(1000) DEFAULT '',
 	//  state VARCHAR(1000) DEFAULT '',
 	//  id int NOT NULL,
 	//  CONSTRAINT fk_id
	 //    FOREIGN KEY (id)
	 //    REFERENCES clientmain (id)
	 //    ON DELETE CASCADE)
 	//  ")
 	//  or die("Your clientsmore table couldn't be created: " . $db->error);



?>

