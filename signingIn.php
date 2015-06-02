<?php
	header('Content-Type: text/html; charset=UTF-8');
	session_start();
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_name('sid');
    session_start();
    $_SESSION['FailedLogin'] = 0;
    echo "new session <br/>";
	}

	$username = $_POST['Username'];
	$password = $_POST['Password'];
	//echo $username . "<br/>";
	//echo $password . "<br/>";
    
  function loadDatabase()
  {

    $dbHost = "";
    $dbPort = "";
    $dbUser = "";
    $dbPassword = "";
    $db = null;
    $dbName = "dailyhealth";

    $openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');

    if ($openShiftVar === null || $openShiftVar == "")
    {
      // Not in the openshift environment
      echo "Using local credentials: "; 
    	$dbUser = "php";
    	$dbPassword = "php-pass";

	    $db = new PDO("mysql:host=127.0.0.1;dbname=dailyhealth", $dbUser, $dbPassword);
    }
    else 
    { 
      // In the openshift environment
      echo "Using openshift credentials: ";

      $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
      $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT'); 
      $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
      $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');

      $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    } 
    //echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";

    return $db;
  }

    $db = loadDatabase();
    echo "Database loaded <br/>";
    foreach ($db->query("SELECT * FROM users WHERE username='$username'") as $user)
    {
      echo "Query run <br/>";
    	if (password_verify($password, $user['Password']))
    	{
    		echo "Password correct";
    		$_SESSION["displayName"] = $user['First_Name'];
    		$_SESSION["id"] = $user['id'];
    		$_SESSION['FailedLogin'] = 0;
    		header('Location: DailyHealth.php');
    		exit();
    	}
    	else
    	{
        echo "Failed Logins (Bad Password): " . $_SESSION['FailedLogin'];
    		$_SESSION['FailedLogin'] += 1;
    		header('Location: ' . $_SERVER['HTTP_REFERER']);
    		exit();
    	}
    }

	$_SESSION['FailedLogin'] += 1;
	echo "Failed Logins (No user): " . $_SESSION['FailedLogin'];
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit();
?>