<?php 
 	include 'databaseinfo.php';


 	//get all the rows in the mysql database
 	$query = "select * from clientmain ORDER BY lastName, firstName, phone, email";
 	$result = $db->query($query) or die("Your query couldn't be done: " . $db->error);
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



    // echo $jsonArray["lastMeeting"];

	// $jsonArray["lastMeeting"] = date("d-m-Y", strtotime($jsonArray["lastMeeting"]));


	// $jsonArray["nextMeeting"] = date("d-m-Y", strtotime($jsonArray["nextMeeting"])); 




    echo json_encode($jsonArray);




 	

	



	

?>


