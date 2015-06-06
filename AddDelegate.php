<?php 
	include("getDb.php");
	session_start();

	$db = loadDatabase();
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$viewId = $_SESSION['id'];
	$access = "both";
	$statement = $db->prepare('INSERT INTO permission(User_Id, Delegate_Id, Access) VALUES(:user, :delegate, :access)');
	$statement->bindParam(':user', $_SESSION['id']);	
	$statement->bindParam(':delegate', $_POST['Delegate']);
	$statement->bindParam(':access', $access);
	$statement->execute();

	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit();
?>