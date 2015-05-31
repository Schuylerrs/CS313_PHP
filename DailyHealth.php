<?php 
	include("getDb.php");
	session_start();
	if (!isset($_SESSION['id']))
	{
		header('Location: SignIn.php');
	}

	$db = loadDatabase();
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	if (isset($_POST['viewId']))
	{
		$viewId = $_POST['viewId'];
		$viewName = "TEMP";
	}
	else
	{
		$viewId = $_SESSION['id'];
		$viewName = "Your";
	}

	$statement = $db->prepare('SELECT Date, Weight, Hours_Cardio, Hours_Sleep, Calories FROM daily_stats WHERE User_Id = :id');
	$statement->bindParam(':id', $viewId);	
	$statement->execute();
?>

<html>
	<head>
		<title>
			Daily Health
		</title>
      <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		    <link rel="stylesheet" href="style.css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="imageChange.js"></script>
      <link rel="shortcut icon" href="http://php-schuylerrs.rhcloud.com/favicon.ico">
      <script src="canvasjs.min.js"> </script>
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

			    var hours = new CanvasJS.Chart("sleepAndCardio",
			    {
		      		title:
		      		{
			        	text: "Sleep and Cardio"
			    	},
				    axisX:
				    {
				        title: "Date",
				        valueFormatString: "MMM DD",
				        gridThickness: 2
				    },
				    axisY: 
				    {
				        title: "Hours"
				    },
				    data: [
				    {        
				        type: "line",
				        lineThickness: 2,
				        showInLegend: true,
				        xValueType: "dateTime",
				        legendText: "Sleep",
				        dataPoints: [//array
				        <?php
				        	$count = 1;
				        	$row = $statement->fetch(PDO::FETCH_ASSOC);
				        	echo "{ x: new Date(" . $row['Date'] . "), y: " . $row['Hours_Sleep'] . "}";
				        	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
				        	{
					        	echo ",{ x: new Date(" . $row['Date'] . "), y: " . $row['Hours_Sleep'] . "}";			        		
				        	}
				        ?>
				        ]
				    },
				    {        
				        type: "line",
				        lineThickness: 2,
				        showInLegend: true,
				        xValueType: "dateTime",
				        legendText: "Cardio",
				        dataPoints: [//array
				        <?php
				        	$statement->execute();
				        	$count = 1;
				        	$row = $statement->fetch(PDO::FETCH_ASSOC);
				        	echo "{ x: new Date(" . $row['Date'] . "), y: " . $row['Hours_Cardio'] . "}";
				        	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
				        	{
					        	echo ",{ x: new Date(" . $row['Date'] . "), y: " . $row['Hours_Cardio'] . "}";			        		
				        	}
				        ?>
				        ]
				    }
				    ]
				});
					
			    var weight = new CanvasJS.Chart("weight",
			    {
		      		title:
		      		{
			        	text: "Weight"
			    	},
				    axisX:
				    {
				        title: "Date",
				        valueFormatString: "MMM DD",
				        gridThickness: 2
				    },
				    axisY: 
				    {
				        title: "Hours"
				    },
				    data: [
				    {        
				        type: "line",
				        lineThickness: 2,
				        showInLegend: true,
				        xValueType: "dateTime",
				        legendText: "Weight",
				        dataPoints: [//array
				        <?php
			        		$statement->execute();
				        	$row = $statement->fetch(PDO::FETCH_ASSOC);
				        	echo "{ x: new Date(" . $row['Date'] . "), y: " . $row['Weight'] . "}";
				        	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
				        	{
					        	echo ",{ x: new Date(" . $row['Date'] . "), y: " . $row['Weight'] . "}";			        		
				        	}
				        ?>
				        ]
				    }
				    ]
				});

			    var calories = new CanvasJS.Chart("calories",
			    {
		      		title:
		      		{
			        	text: "Calories"
			    	},
				    axisX:
				    {
				        title: "Date",
				        valueFormatString: "MMM DD",
				        gridThickness: 2
				    },
				    axisY: 
				    {
				        title: "Calories"
				    },
				    data: [
				    {        
				        type: "line",
				        lineThickness: 2,
				        showInLegend: true,
				        xValueType: "dateTime",
				        legendText: "Calories",
				        dataPoints: [//array
				        <?php
			        		$statement->execute();
				        	$row = $statement->fetch(PDO::FETCH_ASSOC);
				        	if ($row['Calories'] != null)
				        	{
					        	echo "{ x: new Date(" . $row['Date'] . "), y: " . $row['Calories'] . "}";			        		
				        	}

				        	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
				        	{
					        	if ($row['Calories'] != null)
					        	{
						        	echo ",{ x: new Date(" . $row['Date'] . "), y: " . $row['Calories'] . "}";			        		
				        		}
				        	}
				        ?>
				        ]
				    }
				    ]
				});
				
				calories.render();
			    hours.render();
			    weight.render();
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

	    	function validateData()
			{
			  	var sleepHours = document.getElementById("sleepHours");
			  	var cardioHours = document.getElementById("cardioHours");
			  	var weightInput = document.getElementById("weightInput");

			  	var valid = true;
			  	
			  	if (sleepHours.value == "")
			  	{
			  		document.getElementById("sleepWarn").style.display = "block";
			  		valid = false;
			  	}
			  	else
			  	{
			  		document.getElementById("sleepWarn").style.display = "none";	
			  	}

			  	if (cardioHours.value == '')
			  	{
			  		document.getElementById("cardioWarn").style.display = "block";
			  		valid = false;
			  	}
			  	else
			  	{
			  		document.getElementById("cardioWarn").style.display = "none";	
			  	}

			  	if (weightInput.value == '')
			  	{
			  		document.getElementById("weightWarn").style.display = "block";
			  		valid = false;
			  	}
			  	else
			  	{
			  		document.getElementById("weightWarn").style.display = "none";	
			  	}

			  	return valid;
			}	  
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
	  			<div id="sleepAndCardio" style="height: 600px; width: 90%;"></div> <br/>
	  			<div id="weight" style="height: 600px; width: 90%;"></div> <br/>
	  			<div id="calories" style="height: 600px; width: 90%;"></div> <br/>
	  			<form action="AddData.php" method="get" onsubmit="return validateData()"
	  			<?php if($viewId != $_SESSION['id']) {echo "style='display: none'";} ?>>
	  				
	  				<h2>Input Today's Data</h2>
	  				<span class="warning" id="sleepWarn"> Must provide a value for sleep </span>
	  				<span class="warning" id="cardioWarn"> Must provide a value for cardio </span>
	  				<span class="warning" id="weightWarn"> Must provide a value for weight </span>

	  				<table>
						<tr>
							<td>
								<span> Sleep: </span>
							</td>
							<td>
				  				<input id="sleepHours" name="sleep" step="0.25" min="0.0" max="24.0" type="number" value="0"></input>
				  			</td>
						</tr>
						<tr>
							<td>
								<span> Cardio: </span>
							</td>
							<td>
				  				<input id="cardioHours" name="cardio" step="0.25" min="0.0" max="24.0" type="number" value="0"></input>
				  			</td>
						</tr>
						<tr>
							<td>
								<span> Weight: </span>
							</td>
							<td>
				  				<input id="weightInput" name="weight" step="0.25" min="0.0" max="1000.0" type="number"></input>
				  			</td>
						</tr>
						<tr>
							<td>
								<span> Calories: </span>
							</td>
							<td>
				  				<input id="CaloriesInput" name="calories" step="1" min="0.0" max="20000.0" type="number" placeholder="2000"></input>
				  			</td>
						</tr>
					</table>
					<button type="submit"> Submit </button>
	  			</form>
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
