<DOCTYPE html>
<html>
<head>


<!-- Bootstrap stuff -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<!-- End of Bootstrap stuff -->

<!-- custom-made stylesheet -->
    <link rel="stylesheet" type="text/css" href="directoryStyle.css"/>



<script type="text/javascript">

function cancel() {
     window.parent.$("#moreInfo").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked

}



function edit(id) { //Occurs when the "Edit Information" button is pushed and replaces the current form (which cannot be editted) with another form from editMoreInfo.php using ajax
        $.ajax({
          type: "POST",
          url:"editMoreInfo.php",
          data: {id: id},
          dataType: 'html',
          success:function(data) {
            $("#replaced").html(data);
          }
       });
    }

</script>

<style type="text/css">
    label{
        display: inline-block;
        float: left;
        clear: left;
        width: 100px;
        text-align: right;
    }

    #floatRight{
        float: right;
    }

    </style>


    <?php
 		include 'databaseinfo.php'; //database information to access MySQL

if (isset($_GET["id"])) { //Check if the get variable is empty and if not, do this

	$id = $_GET["id"]; //get the unique id of the record that each person has in the mysql table

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
    	$name = $lastName . ', ' . $firstName;

}
    ?>

    <div id='replaced'>

<form id="form" enctype="multipart/form-data">
    <label>Client Name  </label> <input type="text" id="name" value='<?php echo $name ?>' readonly> </br> </br>
    <label>Gender  </label> <input type="text" id="gender" value='<?php echo $gender ?>' readonly> </br> </br>
	<label>Age  </label> <input type="text" id="age" value='<?php echo $age ?>' readonly> </br> </br>
    <label>Race  </label> <input type="text" id="race" value='<?php echo $race ?>' readonly> </br> </br>
    <label>Income  </label> <input type="text" id="income" value='<?php echo $income ?>' readonly>  </br> </br>
    <label>Address  </label> <input type="text" id="address" value='<?php echo $address ?>' readonly> </br> </br>
    <label>City  </label> <input type="text" id="city" value='<?php echo $city ?>' readonly> </br> </br>
    <label>State  </label> <input type="text" id="state" value='<?php echo $state ?>' readonly> </br> </br>
    </form>


    <div id='floatRight'>
                <button id="editPersonal" type="button" class="btn-md" onClick='edit(<?php echo $id ?>)'>Edit Information</button>

                <button id="cancel" type="button" class="btn-md" onClick="cancel()">Cancel</button>

        </div>


</div>
