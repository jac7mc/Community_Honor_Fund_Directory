<DOCTYPE html>
<html>
<head>

<!-- JQuery Stuff -->
<script src="js/jquery.min.js"></script>
<!-- End JQUERY Stuff -->

<!-- Bootstrap stuff -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css"> 
<script src="js/bootstrap.min.js"></script> 
<!-- End of Bootstrap stuff -->




<!-- Kendo UI Stuff -->
	<link rel="stylesheet" href="css/kendo.common.min.css"/>
    <link rel="stylesheet" href="css/kendo.rtl.min.css"/>
    <link rel="stylesheet" href="css/kendo.silver.min.css"/>
    <link rel="stylesheet" href="css/kendo.mobile.all.min.css"/>
    <script src="js/kendo.ui.core.min.js"></script>

<!-- End of Kendo UI Stuff -->




    <link rel="stylesheet" type="text/css" href="directoryStyle.css"/>

	<div id="moreInfo"></div> <!-- Popup for when you click the "More Information" button for a row -->

	<div id="addClientWindow"></div> <!-- Popup for when you click the "Add Client" button-->

    <div id="editClientWindow"></div> <!-- Popup for when you click the "Add Client" button-->



<script type="text/javascript">

$( document ).ready(function() {



//Ajax request to get the json data of the mysql results from read.php and display it on the table
$.ajax({
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

});

    //what happens when you click the reset button
    function resetSearch() {
      //Ajax request to get the json data of the mysql results from read.php and display it on the table
$.ajax({
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

    function search(){
      var searchID = $('#input').val();
      $.ajax({
    url: "search.php?searchInput=" + searchID,
    dataType: 'json',
    success: function (response) {
        var trSEARCH = "";
        $.each(response, function (i, val) {
            trSEARCH += "<tr><td>" + val.lastName + ", " + val.firstName + "</td><td>" + val.phone + "</td><td>" + val.email + "</td><td>" + val.workplace + "</td><td>" + val.chf1 + "</td><td>" + val.chf2 + "</td><td>" + val.lastMeeting + "</td><td>" + val.nextMeeting + "</td><td>" + val.lastPayment + "</td><td>" + val.nextPayment + "</td><td>" + val.principal + "</td><td>" + "<div class='btn-group'> <button id='personal-" + val.id + "' type='button' class='btn-md' onClick='personalClick(" + val.id + ")'>More Information</button> <button id='edit-" + val.id + "' type='button' class='btn-md' onClick='editClick(" + val.id + ")'>Edit</button> <button id='delete-" + val.id + "' type='button' class='btn-md' onClick='deleteClick(" + val.id + ")'>Delete</button></div> </td>" +  "</tr>";

        });
        ($("#table tbody")).html(trSEARCH); //changes the contents of the table body to add the html rows filled in with the data from the JSON object
      },
  error:function(exception){alert(exception)}
});
    }


     function personalClick(id){ //function that handles when the "more information" button is clicked
		$("#moreInfo").kendoWindow({
            actions: ["Maximize", "Close"],
            title: "More Information",
            content: "moreInfo.php?id=" + id,
            visible: false //Don't show it just yet
        }).data("kendoWindow").center().open(); //Opens the popup window for editing and centers it

}

	$("#cancel").click(function(){
            // call 'close' method on nearest kendoWindow
            $(this).closest("[data-role=window]").kendoWindow("close");
          });

function editClick(id){ //function that handles when the "Edit" button is clicked
	$("#editClientWindow").kendoWindow({
            actions: ["Maximize", "Close"],
            title: "Edit a Client",
            content: "update.php?id=" + id,
            visible: false //Don't show it just yet
        }).data("kendoWindow").center().open(); //Opens the popup window for creating a client and centers it

}

function deleteClick(id){ //function that handles when the "Delete" button is clicked
    var deleteConfirm = confirm("Are you sure you want to delete this entry? This cannot be undone.");
    if (deleteConfirm == true) {

         $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processCreate.php
          type: "POST",
          url:"delete.php",
          data: {id: id},
          success:function(data) {
          }
       });

    } 
}

function createClick(){ //function that handles when the "Add Client" button is clicked
	$("#addClientWindow").kendoWindow({
            actions: ["Maximize", "Close"],
            title: "Add a Client",
            content: "create.php",
            visible: false //Don't show it just yet
        }).data("kendoWindow").center().open(); //Opens the popup window for creating a client and centers it
}


  </script>


<title>CHF Directory</title>

</head>

<body>
	<h1> Community Honor Fund Client Directory</h1>
	<br />

	<div id="editPopup"></div>


<div class="container-fluid">

<table class="table table-striped table-bordered table-condensed table-responsive" id="table" width="100%">
	  <thead>

	<tr height="30px"> 
		<td colspan="12">

	<div id="buttonLeft">
<input id="input" type="search"> <div class="btn-group"><button type="button" onClick="search()">Search</button> <button type="button" onClick='resetSearch()'>Reset</button> </div> 
	</div>

	<div id="buttonRight">
		<button type="button" id='addClient' onClick='createClick()'>Add Contact</button>
	</div>
		</td>

	</tr>

<tr>
<th> Client Name </th> 
<th> Phone </th> 
<th> Email </th> 
<th> Employment Location </th> 
<th> CHF Member Responsible #1 </th> 
<th> CHF Member Responsible #2</th> 
<th> Last Meeting Date </th>
<th> Next Meeting Date </th>
<th> Last Payment Amount </th>
<th> Next Payment Amount </th> 
<th> Principal Outstanding </th> 
<th> Actions </th>
	</tr>

</thead>


	<tbody>


<!-- <tr>
 <td> Chiang, Jeffrey  </td> 
 <td> 888-888-8888 </td> 
 <td> something@yahoo.com </td>
 <td> Community Honor Fund </td>
 <td> John Doe</td>
 <td> John Doe#2 </td> 
 <td> 11/23/14 </td>
 <td> 11/23/14 </td>
 <td> 999,999.99 </td> 
 <td> 0 </td> 
 <td> 1,000,000 </td> 
 <td> 
	<div class="btn-group">
			  <button id="personal" type="button" class="btn-md">More Information</button>
			  <button id="edit" type="button" class="btn-md">Edit</button>
			  <button id="delete" type="button" class="btn-md">Delete</button>
	</div>
		 </td>
  </tr> -->







</tbody>

</table>
</div>



</body>

</html>