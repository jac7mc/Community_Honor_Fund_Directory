<?php 
 	include 'databaseinfo.php';

	$searchInput = $_GET['searchInput'];
 	// echo $searchInput;
 	$firstName = $searchInput;
 	$lastName = $searchInput;
 	$querySearch = "";
    if (ctype_space($searchInput) == TRUE) { //There is a space in the input, meaning first word is first name and second word is last name
		$input = explode(" ", $searchInput);
    	$firstName = $input[0];
    	$lastName = $input[1];

    }


 	//get all the rows in the mysql database
 	$querySearch = "select * from clientmain WHERE firstName LIKE '%$firstName%' OR lastName LIKE '%$lastName%' ORDER BY lastName, firstName, phone, email";
 	$result = $db->query($querySearch) or die("Your query couldn't be done: " . $db->error);
 	$rows = $result->num_rows; //number of rows there are

 	$jsonArray = array();
 	      	header('Content-Type: application/json'); // This line will make your ajax be okay with the json response

 	
 	while($row = mysqli_fetch_assoc($result)) { //Returns an associative array of strings representing fetched row in the result set with each key being the name of the field
 		foreach ($row as $key => $value) {
 			if ($key == "lastMeeting") {
 				$row["lastMeeting"] = date("d-m-Y", strtotime($row["lastMeeting"]));
 				if ($row["lastMeeting"] == "01-01-1970") {
 					$row["lastMeeting"] = "";
 				}
 			}

 			if ($key == "nextMeeting") {
 				$row["nextMeeting"] = date("d-m-Y", strtotime($row["nextMeeting"]));
 				if ($row["nextMeeting"] == "01-01-1970") {
 					$row["nextMeeting"] = "";
 				}
 			}

 		}
        $jsonArray[] = $row;
        

    }

    echo json_encode($jsonArray);
	
?>


