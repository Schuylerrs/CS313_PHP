<?php 
	include("getDb.php");
	session_start();

	$db = loadDatabase();
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$viewId = $_SESSION['id'];

	$statement = $db->prepare('INSERT INTO daily_stats(User_Id, Date, Weight, Hours_Cardio, Hours_Sleep, Calories) VALUES(:id, :date, :weight, :cardio, :sleep, :calories)');
	$day = getdate();
	$date = $day['year'] . "-" . $day['mon'] . "-" . $day['mday'];

	$statement->bindParam(':id', $viewId);
	$statement->bindParam(':date', $date);
	$statement->bindParam(':weight', $_GET['weight']);
	$statement->bindParam(':cardio', $_GET['cardio']);
	$statement->bindParam(':sleep', $_GET['sleep']);
	$statement->bindParam(':calories', $_GET['calories']);			

	$statement->execute();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit();
?>
