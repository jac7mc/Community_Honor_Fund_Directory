
<div id='replaced'>




<?php

include 'databaseinfo.php'; //database information to access MySQL

	$id = $_POST["id"]; //get the unique id of the record that each person has in the mysql table

	$query = "select * from clientmore where clientmore.id= '$id'"; //get the record where the id is the one of the person we need
    $result = $db->query($query) or die("Your query couldn't be done: " . $db->error);
    $data = $result->fetch_array(); 
    	$gender = $data['gender'];
    	$age = $data['age'];
    	$race = $data['race'];
    	$income = $data['income'];
    	$address = $data['address'];
    	$city = $data['city'];
    	$state = $data['state'];

    $query = "select * from clientmain where clientmain.id= '$id'"; //get the record where the id is the one of the person we need
    $result = $db->query($query) or die("Your query couldn't be done: " . $db->error);
    $data = $result->fetch_array(); 
    	$lastName = $data['lastName']; //assign the value to the lastName variable
    	$firstName = $data['firstName'];
    	$name = $lastName . ', ' . $firstName; //puts the client's name in the form last name, first name
      $firstLastName = $firstName . ' ' . $lastName; //puts the client's name in the form first name, last name

echo "<form id=‘form’ enctype=‘multipart/form-data’>";
echo "<label>Client Name:  </label> <input type='text' id='name' value='" . $name . "' readonly> </br> </br>";
echo "<label>Gender:  </label> <input type='text' id='gender' value='" . $gender . "'> </br> </br>";
echo "<label>Age:  </label> <input type='text' id='age' value='" . $age . "'> </br> </br>";
echo "<label>Race:  </label> <input type='text' id='race' value='" . $race . "'> </br> </br>";
echo "<label>Income:  </label> <input type='text' id='income' value='" . $income . "'>  </br> </br>";
echo "<label>Address:  </label> <input type='text' id='address' value='" . $address . "'> </br> </br>";
echo "<label>City:  </label> <input type='text' id='city' value='" . $city . "'> </br> </br>";
echo "<label>State:  </label> <input type='text' id='state' value='" . $state . "'> </br> </br>";

echo "</form>";

echo "<div id='floatRight'>";
echo "<button type='button' onClick='submit()'>Submit Changes</button> <button id='cancel' type='button' class='btn-md'>Cancel</button>";
echo "<div id='floatRight'>";


?>


<script type="text/javascript">
    $( document ).ready(function() {


    $("#cancel").click(function(){
                // call 'close' method on nearest kendoWindow
                $(this).closest("[data-role=window]").kendoWindow("close");
              })



    }); //end the document.ready function

  function submit() { //What happens when the "Submit Changes" button is clicked

    window.parent.$("#moreInfo").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked




    $.ajax({ 
          type: "POST",
          url:"processMoreInfo.php",
          data: {id: <?php echo $id; ?>, gender: $("#gender").val(), age: $("#age").val(), race: $("#race").val(), income: $("#income").val(), address: $("#address").val(), city: $("#city").val(), state: $("#state").val()},
          success:function(data) {
                alert('You have updated <?php echo $firstLastName; echo "\'" ?>s personal information!');
            },
          error: function() {
            alert('Sorry, we were not able to <?php echo $firstLastName; echo "\'" ?>s personal information.');
          }

       });




  




  }
  </script>


</div>

