<?php
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
    	$dbUser = "php";
    	$dbPassword = "php-pass";

	    $db = new PDO("mysql:host=127.0.0.1;dbname=dailyhealth", $dbUser, $dbPassword);
    }
    else 
    { 
      // In the openshift environment
      $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
      $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT'); 
      $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
      $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');

      $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    } 
    
    return $db;
  }
?>