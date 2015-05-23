<?php
	session_start();
?>
<html>
	<head>
		<title>
			Daily Health
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
						nav.innerHTML = \"Signed In As: " . $_SESSION['displayName'] . "\";					
					}";
				}
			?>
		</script>
		<link rel="shortcut icon" href="http://php-schuylerrs.rhcloud.com/favicon.ico">
	</head>
	<body onload="onLoad();">
		<?php include("nav.html"); ?>
		<div class="jumbotron">
			<h1>Your Stats</h1>
		</div>

		<div class="row">
	  		<div class="jumbotron">
	  			<h2>Stats</h2>
			</div>	  		
		</div>

		<div class="row">
	  		<div class="jumbotron">
	  			<h2>Goals</h2>
			</div>	  		
		</div>

		<div class="row">
	  		<div class="jumbotron">
	  			<h2>View Other User</h2>
			</div>	  		
		</div>
		
	</body>
</html>
