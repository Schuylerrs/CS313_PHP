<?php
  if(isset($_COOKIE["voted"]) == false)
  {
    setcookie("voted", "false", time() + 60 * 60 * 24);
  }
  
  if($_COOKIE["voted"] == false)
  {
    if (filesize("q1.txt") == 0)
    {
      $file = fopen("q1.txt", "w");
      $data = array(
        "Mango" => 2,
        "Apple" => 1,
        "Watermellon" => 0,
        "Orange" => 0,
        "Banana" => 0,
        "Strawberry" => 0,
        "Grapes" => 0,
        "Rambutan" => 2);
      $serial = serialize($data);
      fwrite($file, $serial);
      fclose($file);
    }

    if(isset($_GET["fruit"]))
    {
      $raw = file_get_contents("q1.txt");
      $data = unserialize($raw);
      $data[$_GET["fruit"]]++;
      $serial = serialize($data);
      $file = fopen("q1.txt", "w");
      fwrite($file, $serial);
      fclose($file);
    }

    if (filesize("q2.txt") == 0)
    {
      $file = fopen("q2.txt", "w");
      $data = array(
        "42" => 3,
        "Violence" => 0,
        "Love" => 0,
        "Google" => 1,
        "God" => 1);
      $serial = serialize($data);
      fwrite($file, $serial);
      fclose($file);
    }

    if(isset($_GET["answer"]))
    {
      $raw = file_get_contents("q2.txt");
      $data = unserialize($raw);
      $data[$_GET["answer"]]++;
      $serial = serialize($data);
      $file = fopen("q2.txt", "w");
      fwrite($file, $serial);
      fclose($file);
    }

    if (filesize("q3.txt") == 0)
    {
      $file = fopen("q3.txt", "w");
      $data = array(
        "24 mph" => 1,
        "11 meters/sec" => 1,
        "African or European?" => 3,
        "42" => 0);
      $serial = serialize($data);
      fwrite($file, $serial);
      fclose($file);
    }

    if(isset($_GET["speed"]))
    {
      $raw = file_get_contents("q3.txt");
      $data = unserialize($raw);
      $data[$_GET["speed"]]++;
      $serial = serialize($data);
      $file = fopen("q3.txt", "w");
      fwrite($file, $serial);
      fclose($file);
    }

    if (filesize("q4.txt") == 0)
    {
      $file = fopen("q4.txt", "w");
      $data = array(
        "Windows" => 3,
        "Linux" => 1,
        "Mac" => 1,
        "Other" => 0);
      $serial = serialize($data);
      fwrite($file, $serial);
      fclose($file);
    }

    if(isset($_GET["OS"]))
    {
      $raw = file_get_contents("q4.txt");
      $data = unserialize($raw);
      $data[$_GET["OS"]]++;
      $serial = serialize($data);
      $file = fopen("q4.txt", "w");
      fwrite($file, $serial);
      fclose($file);
    } 
  }

  if(isset($_GET["fruit"]) || isset($_GET["answer"]) || isset($_GET["speed"]) || isset($_GET["OS"]))
  {
    $_COOKIE["voted"] = true;
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Survey Results</title>
    <link rel="stylesheet" href="style.css">
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
      <script src="imageChange.js"></script>
      <link rel="shortcut icon" href="http://php-schuylerrs.rhcloud.com/favicon.ico">
    <script src="canvasjs.min.js"> </script>
    <script>
        window.onload = function () 
        {
          var chart1 = new CanvasJS.Chart("chartContainer", {
            theme: "theme2",//theme1
            title:{
              text: ""              
            },
            animationEnabled: false,   // change to true
            data: [              
              {
                // Change type to "bar", "splineArea", "area", "spline", "pie",etc.
                type: "column",
                dataPoints: [
                  <?php
                    $read = file_get_contents("q1.txt");
                    $newData = unserialize($read);
                    $copy = $newData;
                    foreach ($newData as $key => $value) 
                    {
                      echo "{ label: \"" . $key . "\", y: " . $value . "},";
                    }
                  ?>
                ]
              }
            ]
          });
          chart1.render();

          var chart2 = new CanvasJS.Chart("chartQ2", {
            theme: "theme2",//theme1
            title:{
              text: ""              
            },
            animationEnabled: false,   // change to true
            data: [              
              {
                // Change type to "bar", "splineArea", "area", "spline", "pie",etc.
                type: "column",
                dataPoints: [
                  <?php
                    $read = file_get_contents("q2.txt");
                    $newData = unserialize($read);
                    $copy = $newData;
                    foreach ($newData as $key => $value) 
                    {
                      echo "{ label: \"" . $key . "\", y: " . $value . "},";
                    }
                  ?>
                ]
              }
            ]
          });
          chart2.render();
                    
          var chart3 = new CanvasJS.Chart("chartQ3", {
            theme: "theme2",//theme1
            title:{
              text: ""              
            },
            animationEnabled: false,   // change to true
            data: [              
              {
                type: "bar",
                dataPoints: [
                  <?php
                    $read = file_get_contents("q3.txt");
                    $newData = unserialize($read);
                    foreach ($newData as $key => $value) 
                    {
                      echo "{ label: \"" . $key . "\", y: " . $value . "},";
                    }
                  ?>
                ]
              }
            ]
          });
          chart3.render();

          var chart4 = new CanvasJS.Chart("chartQ4", {
            theme: "theme2",//theme1
            title:{
              text: ""              
            },
            animationEnabled: false,   // change to true
            data: [              
              {
                // Change type to "bar", "splineArea", "area", "spline", "pie",etc.
                type: "column",
                dataPoints: [
                  <?php
                    $read = file_get_contents("q4.txt");
                    $newData = unserialize($read);
                    $copy = $newData;
                    foreach ($newData as $key => $value) 
                    {
                      echo "{ label: \"" . $key . "\", y: " . $value . "},";
                    }
                  ?>
                ]
              }
            ]
          });
          chart4.render();
        }
  </script>
  </head>
  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://php-schuylerrs.rhcloud.com/">Schuyler's CS313</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li ><a href="http://php-schuylerrs.rhcloud.com/"> Home </a></li>
            <li ><a href="http://php-schuylerrs.rhcloud.com/Assignments.html">Assignments</a></li>
            <li class="active"><a href="http://php-schuylerrs.rhcloud.com/Survey.php"> Survey <span class="sr-only">(current)</span></a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="jumbotron">
      <h1>Results!</h1>
    </div>

    <div class="jumbotron update">
      <h2>Question 1: What is your favorite fruit?</h2>
      <div id="chartContainer" style="height: 400px; width: 50%; border-style: solid; border-width: 3px; border-color: black">There should be stuff here</div>
    </div>
    
    <div class="jumbotron update">
      <h2>Question 2: What is the answer?</h2>
      <div id="chartQ2" style="height: 400px; width: 50%;">There should be stuff here</div>
    </div>

    <div class="jumbotron update">
      <h2>Question 3: What is the airspeed velocity of an unladen swallow?</h2>
      <div id="chartQ3" style="height: 400px; width: 50%;">There should be stuff here</div>
    </div>

    <div class="jumbotron update">
      <h2>Question 4: Which OS is the best?</h2>
      <div id="chartQ4" style="height: 400px; width: 50%;">There should be stuff here</div>
    </div>


  </body>
</html>