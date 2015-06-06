<?php 
	include("getDb.php");
	session_start();

	$db = loadDatabase();
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$viewId = $_SESSION['id'];

	$statement = $db->prepare('DELETE FROM permission WHERE User_Id = :user AND Delegate_Id = :delegate');
	$statement->bindParam(':user', $_SESSION['id']);	
	$statement->bindParam(':delegate', $_POST['Delegate']);
	$statement->execute();

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit();
?>
