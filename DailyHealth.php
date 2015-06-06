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
		
		$statement = $db->prepare('SELECT First_Name, Last_Name FROM users WHERE id = :id');
		$statement->bindParam(':id', $viewId);	
		$statement->execute();
		$row = $statement->fetch(PDO::FETCH_ASSOC);

		$viewName = $row["First_Name"] . " " . $row["Last_Name"] . "'s";
	}
	else
	{
		$viewId = $_SESSION['id'];
		$viewName = "Your";
	}

	$statement = $db->prepare('SELECT * FROM goal WHERE User_Id = :id');
	$statement->bindParam(':id', $viewId);	
	$statement->execute();
	$goals = $statement->fetch(PDO::FETCH_ASSOC);

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
				        interval: 4
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
				        	$row = $statement->fetch(PDO::FETCH_ASSOC);
				        	
				        	$date = explode("-", $row['Date']);
				        	echo "{ x: new Date(" . $date[0] . ", " . $date[1] . ", " . $date[2] . "), y: " . $row['Hours_Sleep'] . "}";
				        	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
				        	{
					        	$date = explode("-", $row['Date']);
					        	echo ",{ x: new Date(" . $date[0] . ", " . $date[1] . ", " . $date[2] . "), y: " . $row['Hours_Sleep'] . "}";
				        		$lastDate = $date[0] . ", " . $date[1] . ", " . $date[2];
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
				        	$row = $statement->fetch(PDO::FETCH_ASSOC);

				        	$date = explode("-", $row['Date']);
				        	echo "{ x: new Date(" . $date[0] . ", " . $date[1] . ", " . $date[2] . "), y: " . $row['Hours_Cardio'] . "}";
				        	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
				        	{
					        	$date = explode("-", $row['Date']);
					        	echo ",{ x: new Date(" . $date[0] . ", " . $date[1] . ", " . $date[2] . "), y: " . $row['Hours_Cardio'] . "}";
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
				        valueFormatString: "MMM DD"
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
				        	$date = explode("-", $row['Date']);
				        	$lastDate = $date[0] . ", " . $date[1] . ", " . $date[2];
				        	echo "{ x: new Date(" . $lastDate . "), y: " . $row['Weight'] . "}";
				        	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
				        	{
					        	$date = explode("-", $row['Date']);
					        	$lastDate = $date[0] . ", " . $date[1] . ", " . $date[2];
					        	echo ",{ x: new Date(" . $lastDate . "), y: " . $row['Weight'] . "}";
				        	}
				        ?>
				        ]
				    }
			        <?php
			        	if ($goals['Weight_Goal'])
			        	{
						    echo ", {";        
						    echo "type: \"area\",";
						    echo "lineThickness: 2,";
						    echo "showInLegend: true,";
						    echo "xValueType: \"dateTime\",";
						    echo "legendText: \"Sleep Goal\",";
						    echo "dataPoints: [";
						        	$statement->execute();
						        	$row = $statement->fetch(PDO::FETCH_ASSOC);
						        	
						        	$date = explode("-", $row['Date']);
						        	echo "{ x: new Date(" . $date[0] . ", " . $date[1] . ", " . $date[2] . "), y: " . $goals['Weight_Goal'] . "}, ";
						        	echo "{ x: new Date(" . $lastDate . "), y: " . $goals['Weight_Goal'] . "}";
						    echo "] }";			        		
			        	}
		        	?>
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
				        valueFormatString: "MMM DD"
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
				        	$count = 0;

				        	if ($row['Calories'] != null)
				        	{
				        		$count++;
					        	$date = explode("-", $row['Date']);
					        	echo "{ x: new Date(" . $date[0] . ", " . $date[1] . ", " . $date[2] . "), y: " . $row['Calories'] . "}";			        		
				        	}

				        	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
				        	{
					        	if ($row['Calories'] != null)
					        	{
						        	$date = explode("-", $row['Date']);
						        	if ($count > 0)
						        	{
						        		echo ",";
						        	}
						        	$count++;
						        	echo "{ x: new Date(" . $date[0] . ", " . $date[1] . ", " . $date[2] . "), y: " . $row['Calories'] . "}";			        		
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

			function validateGoalData()
			{
			  	var sleepHours = document.getElementById("sleepHoursGoal");
			  	var cardioHours = document.getElementById("cardioHoursGoal");
			  	var weightInput = document.getElementById("weightInputGoal");

			  	var valid = true;
			  	
			  	if (sleepHours.value == "")
			  	{
			  		document.getElementById("sleepWarnGoal").style.display = "block";
			  		valid = false;
			  	}
			  	else
			  	{
			  		document.getElementById("sleepWarnGoal").style.display = "none";	
			  	}

			  	if (cardioHours.value == '')
			  	{
			  		document.getElementById("cardioWarnGoal").style.display = "block";
			  		valid = false;
			  	}
			  	else
			  	{
			  		document.getElementById("cardioWarnGoal").style.display = "none";	
			  	}

			  	if (weightInput.value == '')
			  	{
			  		document.getElementById("weightWarnGoal").style.display = "block";
			  		valid = false;
			  	}
			  	else
			  	{
			  		document.getElementById("weightWarnGoal").style.display = "none";	
			  	}

			  	return valid;
			}	  
		</script>
		<link rel="shortcut icon" href="http://php-schuylerrs.rhcloud.com/favicon.ico">
	</head>
	<body onload="onLoad();">
		<?php include("nav.html"); ?>

		<div class="jumbotron">
			<h1><?php echo $viewName ?> Stats</h1>
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
	  			<h3 <?php if($viewId != $_SESSION['id']) {echo "style='display: none'";} ?>>Change Goals</h3>
	  			
	  			<span class="warning" id="sleepWarnGoal"> Must provide a value for sleep </span>
  				<span class="warning" id="cardioWarnGoal"> Must provide a value for cardio </span>
  				<span class="warning" id="weightWarnGoal"> Must provide a value for weight </span>

	  			<form action="SetGoal.php" method="post" onsubmit="return validateGoalData()">
	  				<table>
						<tr>
							<td>
								<span> Sleep: </span>
							</td>
							<td>
				  				<input id="sleepHoursGoal" name="sleep" step="0.25" min="0.0" max="24.0" type="number" value=<?php echo "'" . $goals['Sleep_Goal'] . "'"; ?><?php if($viewId != $_SESSION['id']) {echo "disabled";} ?>></input>
				  			</td>
						</tr>
						<tr>
							<td>
								<span> Cardio: </span>
							</td>
							<td>
				  				<input id="cardioHoursGoal" name="cardio" step="0.25" min="0.0" max="24.0" type="number" value=<?php echo "'" . $goals['Cardio_Goal'] . "'"; ?> <?php if($viewId != $_SESSION['id']) {echo "disabled";} ?>></input>
				  			</td>
						</tr>
						<tr>
							<td>
								<span> Weight: </span>
							</td>
							<td>
				  				<input id="weightInputGoal" name="weight" step="0.25" min="0.0" max="1000.0" type="number" value=<?php echo "'" . $goals['Weight_Goal'] . "'"; ?> <?php if($viewId != $_SESSION['id']) {echo "disabled";} ?>></input>
				  			</td>
						</tr>
						<tr>
							<td>
								<span> Calories: </span>
							</td>
							<td>
				  				<input id="CaloriesInputGoal" name="calories" step="1" min="0.0" max="20000.0" type="number" placeholder="2000" value=<?php echo "'" . $goals['Calories_Goal'] . "'"; ?> <?php if($viewId != $_SESSION['id']) {echo "disabled";} ?>></input>
				  			</td>
						</tr>
					</table>
					<button type="submit" <?php if($viewId != $_SESSION['id']) {echo "style='display: none'";} ?>> Submit </button>
	  			</form>
			</div>	  		
		</div>

		<div class="row">
	  		<div class="jumbotron">
	  			<h2>View Other User</h2>
  				<form action="DailyHealth.php" method="post"> 
		  			<select name="viewId">
			  			<?php
		  					$statement = $db->prepare('SELECT First_Name, Last_Name, id FROM users u JOIN permission p ON p.User_Id = u.id WHERE p.Delegate_Id = :id;');
							$statement->bindParam(':id', $_SESSION['id']);	
							$statement->execute();

							echo "<option value=\"" . $_SESSION['id'] . "\"> Your Profile </option>";							

							while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			        		{
								echo "<option value=\"" . $row['id'] . "\"> " . $row['First_Name'] . " " . $row['Last_Name'] . " </option>";
							}

			  			?>
		  			</select>
		  			<button type="submit"> Open </button>
	  			</form>
	  			<h2>Let Others See Your Profile</h2>
  				<form action="AddDelegate.php" method="post"> 
		  			<select name="Delegate">
			  			<?php
		  					$statement = $db->prepare('SELECT First_Name, Last_Name, id FROM users WHERE id != :id AND id NOT IN (SELECT Delegate_Id FROM permission WHERE User_Id = :id);');
							$statement->bindParam(':id', $_SESSION['id']);	
							$statement->execute();

							while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			        		{
								echo "<option value=\"" . $row['id'] . "\"> " . $row['First_Name'] . " " . $row['Last_Name'] . " </option>";
							}
			  			?>
		  			</select>
		  			<button type="submit"> Add </button>
	  			</form>
	  			<h2>Remove Permissions</h2>
  				<form action="RemoveDelegate.php" method="post"> 
		  			<select name="Delegate">
			  			<?php
		  					$statement = $db->prepare('SELECT First_Name, Last_Name, id FROM users u JOIN permission p ON p.Delegate_Id = u.id WHERE p.User_Id = :id;');
							$statement->bindParam(':id', $_SESSION['id']);	
							$statement->execute();

							while ($row = $statement->fetch(PDO::FETCH_ASSOC))
			        		{
								echo "<option value=\"" . $row['id'] . "\"> " . $row['First_Name'] . " " . $row['Last_Name'] . " </option>";
							}
			  			?>
		  			</select>
		  			<button type="submit"> Remove </button>
	  			</form>

			</div>	  		
		</div>
		
	</body>
</html>
