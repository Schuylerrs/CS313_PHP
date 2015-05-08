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
	</head>
	<body>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="http://php-schuylerrs.rhcloud.com/">Schuyler's CS313</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><a href="http://php-schuylerrs.rhcloud.com/"> Home </a></li>
		        <li ><a href="http://php-schuylerrs.rhcloud.com/Assignments.html">Assignments</a></li>
		        <li class="active"><a href="http://php-schuylerrs.rhcloud.com/Survey.php"> Survey <span class="sr-only">(current)</span></a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
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
		      <p><input type="radio" name="fruit" value="Rambutan"> Rambutan</p>
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
