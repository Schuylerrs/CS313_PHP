<?php
    session_start();
?>
<html>
	<head>
		<title>
			Index
		</title>
		<link rel="stylesheet" href="style.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="apple-touch-icon-57x57.png" />
		<!-- For tab icon -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon-precomposed" sizes="60x60" href="apple-touch-icon-60x60.png" />
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="apple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="apple-touch-icon-152x152.png" />
		<link rel="icon" type="image/png" href="favicon-196x196.png" sizes="196x196" />
		<link rel="icon" type="image/png" href="favicon-96x96.png" sizes="96x96" />
		<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
		<link rel="icon" type="image/png" href="favicon-128.png" sizes="128x128" />
		<meta name="application-name" content="&nbsp;"/>
		<meta name="msapplication-TileColor" content="#FFFFFF" />
		<meta name="msapplication-TileImage" content="mstile-144x144.png" />
		<meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
		<meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
		<meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
		<meta name="msapplication-square310x310logo" content="mstile-310x310.png" />
		<!-- For tab icon -->
		<script>
			function onLoad()
			{
				var nav = document.getElementById("navAssign");
				nav.className = "active";
	    	    <?php
		            if (isset($_SESSION['id']))
		            {
		              echo "updateSignInName();";           
		            }
	          	?>
	        }

	      <?php
	        if (isset($_SESSION['id']))
	        {
	          echo "function updateSignInName()
	          {
	            var nav = document.getElementById(\"navSignIn\");
	            nav.innerHTML = \"Signed In As: " . $_SESSION['displayName'] . " <a href='signout.php'>Sign Out </a>\";         
	          }";
	        }
	      ?>
		</script>
		<link rel="shortcut icon" href="http://php-schuylerrs.rhcloud.com/favicon.ico">
	</head>
	<body onload="onLoad();">
		<?php include("nav.html"); ?>
		<div class="jumbotron">
			<h1>Assignments</h1>
		</div>

		<div class="jumbotron update">
			<h1>Daily Health</h1>
			<p>5/30/2015 </p>
			<p> I have added the ability to create a user and to Input data into the database <br/></p>
			<p><a class="btn btn-primary btn-lg" href="DailyHealth.php" role="button">Daily Health</a></p>
		</div>

		<div class="jumbotron update">
			<h1>Daily Health</h1>
			<p>5/23/2015 </p>
			<p> I have added the inital Daily Health Page as well as a login <br/></p>
			<p><a class="btn btn-primary btn-lg" href="DailyHealth.php" role="button">Daily Health</a></p>
		</div>

		<div class="jumbotron update">
			<h1>Survey</h1>
			<p>5/7/2015 </p>
			<p> I have added a survey to my webpage <br/></p>
			<p><a class="btn btn-primary btn-lg" href="Survey.php" role="button">Survey</a></p>
			<p>The results uses a library called CanvasJS. For more information about that go here:</p>
			<p><a class="btn btn-primary btn-lg" href="http://canvasjs.com/" role="button">CanvasJS</a></p>
		</div>

		<div class="jumbotron update">
			<h1>Home Page</h1>
			<p>5/2/2015 </p>
			<p> This page has been moved from Home to Assignment <br/> New assignemtns will be added to this list as they come up. <br/> Click here to go to my home page or click on the link in the nav bar</p>
			<p><a class="btn btn-primary btn-lg" href="Index.html" role="button">Home</a></p>
		</div>
		<div class="jumbotron update">
			<h1>Group Assignment</h1>
			<p>4/22/2015 </p>
			<p>Here is our group assignment from class</p>
			<p><a class="btn btn-primary btn-lg" href="TeamActivity0.html" role="button">Group Assignment</a></p>
		</div>
		<div class="jumbotron update">
			<h1>Hello World!</h1>
			<p>4/21/2015 </p>
			<p>My webpage is born! I am using Bootstrap to make this page. <br/> It's pretty cool!</p>
			<p><a class="btn btn-primary btn-lg" href="http://getbootstrap.com/getting-started/" role="button">Learn more</a></p>
		</div>
	</body>
</html>
