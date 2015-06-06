<?php 
	include("getDb.php");
	session_start();

	$db = loadDatabase();
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$statement = $db->prepare("SELECT * FROM goal WHERE User_Id = :id");
	$statement->bindParam(':id', $_SESSION['id']);	
	$statement->execute();
	$goals = $statement->fetch(PDO::FETCH_ASSOC);

	if ($goals)
	{
		$statement = $db->prepare('DELETE FROM goal WHERE User_Id = :user');
		$statement->bindParam(':user', $_SESSION['id']);	
		$statement->execute();
	}

	$statement = $db->prepare('INSERT INTO goal(User_Id, Sleep_Goal, Cardio_Goal, Weight_Goal, Calories_Goal) VALUES(:id, :sleep, :cardio, :weight, :calories)');

	$statement->bindParam(':id', $_SESSION['id']);
	$statement->bindParam(':sleep', $_POST['sleep']);
	$statement->bindParam(':cardio', $_POST['cardio']);
	$statement->bindParam(':weight', $_POST['weight']);
	$statement->bindParam(':calories', $_POST['calories']);
	$statement->execute();

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit();
?>