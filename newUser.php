<html>
	<head>
		<title>
			Create User
		</title>
		<link rel="stylesheet" href="style.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<style type="text/css">
			      .warning 
			      {
			        color: red;
			        display: none;
			      }
		</style>
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
			            nav.innerHTML = \"Signed In As: " . $_SESSION['displayName'] . " <a href='signout.php'>Sign Out </a>\";         
			          }";
        		}
	      ?>

		    function validateForm()
		    {
	    	  	var password = document.getElementById("password");
	    	  	var confirm = document.getElementById("confirm");
	    	  	var username = document.getElementById("username");
	    	  	var email = document.getElementById("email");
	    	  	var fName = document.getElementById("fName");
	    	  	var lName = document.getElementById("lName");

	    	  	var valid = true;
	    	  	
	    	  	if (confirm.value != password.value)
	    	  	{
	    	  		document.getElementById("passwordError").style.display = "block";
	    	  		valid = false;
	    	  	}
	    	  	else
	    	  	{
	    	  		document.getElementById("passwordError").style.display = "none";	
	    	  	}

	    	  	if (confirm.value == '' ||  password.value == '')
	    	  	{
	    	  		document.getElementById("passwordEmptyError").style.display = "block";
	    	  		valid = false;
	    	  	}
	    	  	else
	    	  	{
	    	  		document.getElementById("passwordEmptyError").style.display = "none";	
	    	  	}

	    	  	if (fName.value == '' || lName.value == '')
	    	  	{
	    	  		document.getElementById("nameError").style.display = "block";
	    	  		valid = false;
	    	  	}
	    	  	else
	    	  	{
	    	  		document.getElementById("nameError").style.display = "none";	
	    	  	}

				if (!validateEmail(email.value))
	    	  	{
	    	  		document.getElementById("emailError").style.display = "block";
	    	  		valid = false;
	    	  	}
	    	  	else
	    	  	{
	    	  		document.getElementById("emailError").style.display = "none";	
	    	  	}	    	  	

				if (username.value == '')
	    	  	{
	    	  		document.getElementById("usernameError").style.display = "block";
	    	  		valid = false;
	    	  	}
	    	  	else
	    	  	{
	    	  		document.getElementById("usernameError").style.display = "none";	
	    	  	}	

	    	  	return valid;
		    }
			
			function validateEmail(email) 
			{
			    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    		return re.test(email);
			}
		</script>
		<link rel="shortcut icon" href="http://php-schuylerrs.rhcloud.com/favicon.ico">
	</head>
	<body onload="onLoad();">
		<?php include("nav.html"); ?>
		<div class="jumbotron">
			<h1>New User</h1>
		</div>

  		<div class="jumbotron">
  			<form action="makeUser.php" onsubmit="return validateForm()" method="post">
  				<span class="warning" id="nameError"> First and last name cannot be blank </span>
				<table>
					<tr>
						<td>
							<span> First Name: </span>
						</td>
						<td>
							<input type="text" name="fName" id="fName"><br/>
			  			</td>
						<td>
							<span> Last Name: </span>
						</td>
						<td>
							<input type="text" name="lName" id="lName"><br/>
			  			</td>
					</tr>
				</table>
				<br/>
  				<span class="warning" id="emailError"> Invalid Email Address </span>
				<table>
					<tr>
						<td>
							<span> Email Address: </span>
						</td>
						<td>
							<input type="text" name="Email" id="email"><br/>
			  			</td>
					</tr>
	  				<span class="warning" id="usernameError"> Must enter a username </span>
					<tr>
						<td>
							<span> Username: </span>
						</td>
						<td>
							<input type="text" name="Username" id="username"><br/>
			  			</td>
					</tr>
				</table>
				<br/>
				<table>
	  				<span class="warning" id="passwordError"> Passwords Do Not Match </span>
	  				<span class="warning" id="passwordEmptyError"> Password is empty </span>
					<tr>
			  			<td>
				  			<span> Password: </span>
			  			</td>
			  			<td>
			  				<input type="Password" name="Password" id="password"><br/>
			  			</td>
		  			</tr>
					<tr>
			  			<td>
				  			<span> Confirm Password: </span>
			  			</td>
			  			<td>
			  				<input type="Password" id="confirm"><br/>
			  			</td>
		  			</tr>
	  			</table>
	  			<button type="Submit"> Submit </button>
  			</form>
		</div>	  				
	</body>
</html>
