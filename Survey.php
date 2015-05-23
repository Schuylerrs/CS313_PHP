<?php
	if(isset($_COOKIE["voted"]))
  	{
		if ($_COOKIE["voted"] == true)
		{
			header("Location: Results.php"); /* Redirect browser */
			exit();
		}
	}
?>
<html>
	<head>
		<title>
			Survey
		</title>
		<link rel="stylesheet" href="style.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<link rel="shortcut icon" href="http://php-schuylerrs.rhcloud.com/favicon.ico">
		<script>
			function onLoad()
			{
				var nav = document.getElementById("navSurvey");
				nav.className = "active";
			}
		</script>
		<link rel="shortcut icon" href="http://php-schuylerrs.rhcloud.com/favicon.ico">
	</head>
	<body onload="onLoad();">
		<?php include("nav.html"); ?>
		<div class="jumbotron">
			<h1>Survey!</h1>
		</div>
		<form action="Results.php">
		    <div class="jumbotron update">
		      <h2>Question 1: What is your favorite fruit?</h2>
		      <p><input type="radio" name="fruit" value="Mango"> Mango</p>
  		      <p><input type="radio" name="fruit" value="Apple"> Apple</p>
  		      <p><input type="radio" name="fruit" value="Watermellon"> Watermellon</p>
		      <p><input type="radio" name="fruit" value="Orange"> Orange</p>
		      <p><input type="radio" name="fruit" value="Banana"> Banana</p>
  		      <p><input type="radio" name="fruit" value="Strawberry"> Strawberry</p>
  		      <p><input type="radio" name="fruit" value="Grapes"> Grapes</p>
		      <p><input type="radio" name="fruit" value="Rambutan"><a href="http://en.wikipedia.org/wiki/Rambutan"> Rambutan</a></p>
		    </div>
		    
		    <div class="jumbotron update">
		      <h2>Question 2: What is the answer?</h2>
  		      <p><input type="radio" name="answer" value="42"> 42</p>
  		      <p><input type="radio" name="answer" value="Violence"> Violence</p>
  		      <p><input type="radio" name="answer" value="Love"> Love</p>
		      <p><input type="radio" name="answer" value="Google"> Google</p>
		      <p><input type="radio" name="answer" value="God"> God</p>
		    </div>

		    <div class="jumbotron update">
		      <h2>Question 3: What is the airspeed velocity of an unladen swallow?</h2>
  		      <p><input type="radio" name="speed" value="24 mph"> 24 mph</p>
  		      <p><input type="radio" name="speed" value="11 m/sec"> 11 m/sec</p>
		      <p><input type="radio" name="speed" value="42"> 42</p>
		      <p><input type="radio" name="speed" value="African or European?"> African or European?</p>		      
		    </div>

		    <div class="jumbotron update">
		      <h2>Question 4: Which OS is the best?</h2>
		      <p><input type="radio" name="OS" value="Windows"> Windows</p>
  		      <p><input type="radio" name="OS" value="Linux"> Linux</p>
  		      <p><input type="radio" name="OS" value="Mac"> Mac</p>
		      <p><input type="radio" name="OS" value="Other"> Other</p>
		    </div>
		    <div class="jumbotron update">
		    	<h2> Submit to see results</h2>
			    <input type="submit" class="btn btn-primary btn-lg"></input>
			    <input type="reset" class="btn btn-primary btn-lg"></input>
		    </div>
	    </form>    
	</body>
</html>
