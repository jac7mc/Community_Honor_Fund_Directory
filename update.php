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
     window.parent.$("#editClientWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked

}

	function next() {
	        $('#firstForm').hide(); //Makes the first form hidden so the second form can appear

	        $('#nextForm').show(); //Makes the first form hidden so the second form can appear

	    }

    function submit() { //Occurs when the "Edit Information" button is pushed and replaces the current form (which cannot be editted) with another form from editMoreInfo.php using ajax
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();

    window.parent.$("#editClientWindow").data("kendoWindow").close(); //Closes the Kendo Window after Ok in the alert box is clicked


        $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processCreate.php
          type: "POST",
          url:"processUpdate.php",
          data: {id: <?php echo $_GET["id"]?>, firstName: $("#firstName").val(), lastName: $("#lastName").val(), phone: $("#phone").val(), email: $("#email").val(), workplace: $("#workplace").val(), chf1First: $("#chf1First").val(), chf1Last: $("#chf1Last").val(), chf2First: $("#chf2First").val(), chf2Last: $("#chf2Last").val(), lastMeeting: $("#lastMeeting").val(), nextMeeting: $("#nextMeeting").val(), lastPayment: $("#lastPayment").val(), nextPayment: $("#nextPayment").val(), principal: $("#principal").val()},
          dataType: 'html',
          success:function(data) {
                alert('You have updated ' + firstName + ' ' + lastName + '\'s information in the directory!');
  	            ($("#test")).html(data); //changes the contents of the table body to add the html rows filled in with the data from the JSON object

          }
       });

       setTimeout(updateTable, 1000); //Allows the database time to process the update


    }

    function updateTable() {
      $.ajax({ //makes the directory update with the newest row
          url: 'read.php',
          dataType: 'json',
          success: function (response) {
          var trHTML = "";
          $.each(response, function (i, val) {
              trHTML += "<tr><td>" + val.lastName + ", " + val.firstName + "</td><td>" + val.phone + "</td><td>" + val.email + "</td><td>" + val.workplace + "</td><td>" + val.chf1 + "</td><td>" + val.chf2 + "</td><td>" + val.lastMeeting + "</td><td>" + val.nextMeeting + "</td><td>" + val.lastPayment + "</td><td>" + val.nextPayment + "</td><td>" + val.principal + "</td><td>" + "<div class='btn-group'> <button id='personal-" + val.id + "' type='button' class='btn-md' onClick='personalClick(" + val.id + ")'>More Information</button> <button id='edit-" + val.id + "' type='button' class='btn-md' onClick='editClick(" + val.id + ")'>Edit</button> <button id='delete-" + val.id + "' type='button' class='btn-md' onClick='deleteClick(" + val.id + ")'>Delete</button></div> </td>" +  "</tr>";

          });
          ($("#table tbody")).html(trHTML); //changes the contents of the table body to add the html rows filled in with the data from the JSON object
      },
  error:function(exception){alert(exception)}
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

    label2{
        display: inline-block;
        float: left;
        clear: left;
        width: 200px;
        text-align: right;

    }

    windowTitle{
        display: block;
        font-size: 2em;
        font-weight: bold;
    }

    #floatRight{
        float: right;
    }

    </style>

</head>

</head>

  <?php
 		include 'databaseinfo.php'; //database information to access MySQL

if (isset($_GET["id"])) { //Check if the get variable is empty and if not, do this

	$id = $_GET["id"]; //get the unique id of the record that each person has in the mysql table

	$query = "select * from clientmain where clientmain.id= '$id'"; //get the record where the id is the one of the person we need
    $result = $db->query($query) or die("Your query couldn't be done: " . $db->error);
    $data = $result->fetch_array();
    	$firstName = $data['firstName'];
    	$lastName = $data['lastName'];
	   	$phone = $data['phone'];
	   	$email = $data['email'];
	   	$workplace = $data['workplace'];

	   	$chf1 = $data['chf1'];
        $chf1Info = explode(",", $chf1);
        $chf1First = ltrim($chf1Info[1]);
        $chf1Last = $chf1Info[0];

	   	$chf2 = $data['chf2'];
        $chf2Info = explode(",", $chf2);
        $chf2First = ltrim($chf2Info[1]);
        $chf2Last = $chf2Info[0];


	   	$lastMeeting = $data['lastMeeting'];
        $lastMeeting = date("d-m-Y", strtotime($lastMeeting));
        if ($lastMeeting == "01-01-1970") {
            $lastMeeting = "";
        }


	   	$nextMeeting = $data['nextMeeting'];
        $nextMeeting = date("d-m-Y", strtotime($nextMeeting));
        if ($nextMeeting == "01-01-1970") {
            $nextMeeting = "";
        }



	   	$lastPayment = $data['lastPayment'];
	   	$nextPayment = $data['nextPayment'];
	   	$principal = $data['principal'];

    	$name = $lastName . ', ' . $firstName;

}
    ?>

<div id='firstForm'>

    <windowTitle>Personal Information</windowTitle>
    <form enctype="multipart/form-data">


        <label>First Name*  </label> <input type="text" id="firstName" value='<?php echo $firstName ?>'> </br> </br>
        <label>Last Name*  </label> <input type="text" id="lastName" value='<?php echo $lastName ?>'> </br> </br>
        <label>Phone  </label> <input type="text" id="phone" value='<?php echo $phone ?>'> </br> </br>
    	<label>Email  </label> <input type="text" id="email" value='<?php echo $email ?>'> </br> </br>
        <label>Employment Location  </label> <input type="text" id="workplace" value='<?php echo $workplace ?>'> </br> </br>

    </form>

        <div id='floatRight'>
                        <button id="next" type="button" class="btn-md" onClick="next()">Next</button>

                        <button id="cancel" type="button" class="btn-md" onClick="cancel()">Cancel</button>

        </div>
</div>

<div id='nextForm' style='display: none;'>

    <windowTitle>Loan Information </windowTitle> <br />

    <form enctype="multipart/form-data">
        <label2>Principal Outstanding  </label2> <input type="text" id="principal" value='<?php echo $principal ?>'> </br> </br>
        <label2>CHF Member Responsible #1  </label2> <input type="text" id="chf1First" value='<?php echo $chf1First ?>'> <input type="text" id="chf1Last" value='<?php echo $chf1Last ?>'> </br> </br>
        <label2>CHF Member Responsible #2  </label2> <input type="text" id="chf2First" value='<?php echo $chf2First ?>'> <input type="text" id="chf2Last" value='<?php echo $chf2Last ?>'> </br> </br>
        <label2>Last Payment Amount  </label2> <input type="text" id="lastPayment" value='<?php echo $lastPayment ?>'> </br> </br>
        <label2>Next Payment Amount  </label2> <input type="text" id="nextPayment" value='<?php echo $nextPayment ?>'> </br> </br>
        <label2>Last Meeting Date  </label2> <input type="text" id="lastMeeting" value='<?php echo $lastMeeting ?>'> </br> </br>
        <label2>Next Meeting Date  </label2> <input type="text" id="nextMeeting" value='<?php echo $nextMeeting ?>'> </br> </br>
    </form>

        <div id='floatRight'>
                    <button id="submit" type="button" class="btn-md" onClick="submit()">Submit</button>

                    <button id="cancel" type="button" class="btn-md" onClick="cancel()">Cancel</button>

        </div>

</div>
