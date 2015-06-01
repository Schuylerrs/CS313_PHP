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
      echo "host:$dbHost:$dbPort dbName:$dbName user:$dbUser password:$dbPassword<br >\n";

      return $db;
    }

  require 'password.php';

  $db = loadDatabase();

  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $Email = $_POST['Email'];
  $Username = $_POST['Username'];
  $Password = $_POST['Password'];

  $query = 'INSERT INTO users(First_Name, Last_Name, Email, Username, Password) VALUES(:fName, :lName, :Email, :Username, :Password)';

  $statement = $db->prepare($query);

  $statement->bindParam(':fName', $fName);
  $statement->bindParam(':lName', $lName);
  $statement->bindParam(':Email', $Email);
  $statement->bindParam(':Username', $Username);
  $statement->bindParam(':Password', password_hash($Password, PASSWORD_DEFAULT));

  $statement->execute();

  header('Location: SignIn.php');
  exit();
?>