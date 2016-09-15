  <DOCTYPE html>
<html>
<head>



  <script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">

  $(function() {

  	$.ajax({
  url: "directory.html",
  
})
  .done(function( stuff ) {
    $( "#table" ).html( stuff );
  });
	

});

  </script>

</head>

<body>

<div id="table"> </div>

</body>
