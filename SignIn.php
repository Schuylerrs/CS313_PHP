<?php
    session_start();
?>
<html>
	<head>
		<title>
			Daily Health Sign In
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
		<?php include("nav.html"); ?>
		<form action="signingin.php" method="post">
			<div class="jumbotron update">
				<h1>Sign In</h1>
				<?php 
					if (session_status() != PHP_SESSION_NONE) 
					{
						if ($_SESSION['FailedLogin'] > 0)
						{
							echo "<span style='color:red'>Sign In Failed</span><br/>";
						}
					}
				?>
				<table>
					<tr>
						<td>
							<span> Username: </span>
						</td>
						<td>
							<input type="text" name="Username"><br/>
			  			</td>
					</tr>
					<tr>
			  			<td>
				  			<span> Password: </span>
			  			</td>
			  			<td>
			  				<input type="Password" name="Password"><br/>
			  			</td>
		  			</tr>
	  			</table>
	  			<br/>
	  			<button type="Submit"> Sign In </button>
	  			<button type="button"> New User </button>
			</div>
		</form>
	</body>
</html>