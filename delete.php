<?php
	include 'databaseinfo.php'; //database information to access MySQL

	$id = $_POST['id'];



	$clientMainQuery = "DELETE FROM clientmain
		WHERE id= '$id'";

	$result = $db->query($clientMainQuery) or die("Your main client query couldn't be done: " . $db->error);

	$clientMoreQuery = "DELETE FROM clientmore
		WHERE id= '$id'";

	$result = $db->query($clientMoreQuery) or die("Your main client query couldn't be done: " . $db->error);



?>

<script type="text/javascript">


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


</script>