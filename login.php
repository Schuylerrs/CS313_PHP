<html>
	<head>
		<title>
			Daily Health Login
		</title>
		<link rel="stylesheet" href="style.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script>
			function onLoad()
			{
				var nav = document.getElementById("navDailyHealth");
				nav.className = "active";
			}
		</script>
		<link rel="shortcut icon" href="http://php-schuylerrs.rhcloud.com/favicon.ico">
	</head>
	<body onload="onLoad();">
		<?php include("nav.html"); ?>

		<div class="jumbotron">
			<h1>Home</h1>
		</div>

		<div class="row">
	  		<div class="col-md-6">
		  		<div class="jumbotron">

		  		</div>
	  		</div>
		  	<div class="col-md-6"><img class="rounded hover" src="http://php-schuylerrs.rhcloud.com/FirstDate.jpg"></img></div>
		</div>
	</body>
</html>