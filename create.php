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

$( document ).ready(function() {


    $("#cancel").click(function(){
                // call 'close' method on nearest kendoWindow
         window.parent.$("#addClientWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked
              })





}); //end the document.ready function

    function cancel() {
         window.parent.$("#addClientWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked

    }

    function submit(inputDate) { //Occurs when the "Edit Information" button is pushed and replaces the current form (which cannot be editted) with another form from editMoreInfo.php using ajax
        var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ;
        if(!(date_regex.test(inputDate)))
        {
            ($("#meetingDate")).css("borderColor", "red");
            ($("#dateWarning")).html("Not in the proper format").css('color', 'red');
        return false;
}


        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();

    window.parent.$("#addClientWindow").data("kendoWindow").close(); //Closest the Kendo Window after Ok in the alert box is clicked


        $.ajax({ //submits the values that were entered into the JavaScript form above by the user to be processed by processCreate.php
          type: "POST",
          url:"processCreate.php",
          data: {firstName: $("#firstName").val(), lastName: $("#lastName").val(), gender: $("#gender").val(), age: $("#age").val(), race: $("#race").val(), income: $("#income").val(), address: $("#address").val(), city: $("#city").val(), state: $("#state").val(), email: $("#email").val(), phone: $("#phone").val(), workplace: $("#workplace").val(), principal: $("#principal").val(), chf1First: $("#chf1First").val(), chf1Last: $("#chf1Last").val(), chf2First: $("#chf2First").val(), chf2Last: $("#chf2Last").val(), payment: $("#payment").val(), meetingDate: $("#meetingDate").val()},
          dataType: 'html',
          success:function(data) {
                alert('You have added ' + firstName + ' ' + lastName + '\'s information to the directory!');
          }
       });

       setTimeout(updateTable, 1000); //Allows the database time to process the update

    }

    function updateTable(){
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

    function next(inputFirst, inputLast, inputEmail, phoneInput) {


        ($("#firstWarning")).html(""); //Makes the warning that "The field is empty" disappear
        ($("#firstName")).css("borderColor", ""); //Makes the red border color disappear

        ($("#lastWarning")).html("");
        ($("#lastName")).css("borderColor", "");

        ($("#emailWarning")).html("");
        ($("#email")).css("borderColor", "");

        ($("#phoneWarning")).html("");
        ($("#phone")).css("borderColor", "");

        ($("#dateWarning")).html("");
        ($("#meetingDate")).css("borderColor", "");

        var phone = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

        var emailRegex = /\S+@\S+\.\S+/;

            if(inputFirst == null || inputLast == null || inputFirst == "" || inputLast == "" || !(phone.test(phoneInput)) || !(emailRegex.test(inputEmail)))
                {
                    if (inputFirst == null || inputFirst == "") {
                        ($("#firstName")).css("borderColor", "red");
                        ($("#firstWarning")).html("You can't leave this empty").css('color', 'red');
                    }

                    if (inputLast == null || inputLast == "") {
                        ($("#lastName")).css("borderColor", "red");
                        ($("#lastWarning")).html("You can't leave this empty").css('color', 'red');
                    }

                    if (!(phone.test(phoneInput)))
                        {

                        ($("#phone")).css("borderColor", "red");
                        ($("#phoneWarning")).html("Not in the proper format").css('color', 'red');

                        }

                    if (!(emailRegex.test(inputEmail)))
                    {
                        ($("#email")).css("borderColor", "red");
                        ($("#emailWarning")).html("Not a valid email").css('color', 'red');

                    }



                    return false;
            }


        $('#firstForm').hide(); //Makes the first form hidden so the second form can appear

        $('#nextForm').css("display", ""); //Makes the first form hidden so the second form can appear

    }



</script>

<style type="text/css">
    label{
        display: inline-block;
        float: left;
        clear: left;
        width: 100px;
        text-align: right;
        font-weight:bold;
    }

    label2{
        display: inline-block;
        float: left;
        clear: left;
        width: 120px;
        text-align: right;
        font-weight:bold;

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


<body>

<div id='firstForm'>

    <windowTitle>Personal Information</windowTitle>
    <form enctype="multipart/form-data">


        <label>First Name*  </label> <input type="text" id="firstName"> </br> <div id='firstWarning'> </div> </br>
        <label>Last Name*  </label> <input type="text" id="lastName"> </br> <div id='lastWarning'> </div> </br>
        <label>Gender  </label> <input type="text" id="gender"> </br> </br>
    	<label>Age  </label> <input type="text" id="age"> </br> </br>
        <label>Race  </label> <input type="text" id="race"> </br> </br>
        <label>Income  </label> <input type="text" id="income">  </br> </br>
        <label>Address  </label> <input type="text" id="address"> </br> </br>
        <label>City  </label> <input type="text" id="city"> </br> </br>
        <label>State  </label> <input type="text" id="state"> </br> </br>
        <label>Email  </label> <input type="text" id="email"> </br> <div id='emailWarning'> </div> </br>
        <label>Phone  </label> <input type="text" id="phone" placeholder="XXX-XXX-XXXX"> </br> <div id='phoneWarning'> </div> </br>
        <label>Employment Location  </label> <input type="text" id="workplace"> </br> </br>
    </form>

        <div id='floatRight'>
                        <button id="next" type="button" class="btn-md" onClick="next( $('#firstName').val(), $('#lastName').val(), $('#email').val(), $('#phone').val())">Next</button>

                        <button id="cancel" type="button" class="btn-md">Cancel</button>

        </div>
</div>



<div id='nextForm' style='display: none;'>

    <windowTitle>Loan Information </windowTitle> <br />

    <form enctype="multipart/form-data">


        <label2>Principal Outstanding  </label2> <input type="text" id="principal"> </br> </br>
        <label2>CHF Member Responsible #1  </label2> <input type="text" id="chf1First" placeholder='First Name'> <input type="text" id="chf1Last" placeholder='Last Name'></br> </br>
        <label2>CHF Member Responsible #2  </label2> <input type="text" id="chf2First" placeholder='First Name'> <input type="text" id="chf2Last" placeholder='Last Name'> </br> </br>
        <label2>Next Payment Amount  </label2> <input type="text" id="payment"> </br> </br>
        <label2>Next Meeting Date  </label2> <input type="text" id="meetingDate" placeholder= "MM/DD/YYYY"> </br> <div id='dateWarning'> </div> </br>
    </form>


        <div id='floatRight'>
                    <button id="submit" type="button" class="btn-md" onClick="submit($('#meetingDate').val())">Submit</button>

                    <button id="cancel" type="button" class="btn-md" onClick="cancel()">Cancel</button>

        </div>

</div>


</body>
