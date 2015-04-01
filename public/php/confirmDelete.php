<?php
  include "databaseConnect.php";
  include "functions.php";
  session_start();
  checkAdmin();

  if (isset($_SESSION["email"])) {
    $myEmail = $_SESSION["email"];
  }

  if (isset($_SESSION["ID"])){
    $cID = $_SESSION["ID"];
  }

  //Check to make sure, Serial number is passed
  if (isset($_GET['serial_number']) ) {
  	$serial_number = $_GET['serial_number'];
  }

  //If Page is submitted check
  if (isset($_POST['submitted'])) {
  	foreach($_POST AS $key => $value) {
  		$_POST[$key] = mysqli_real_escape_string($con,$value);
    }
  }

  $query = "SELECT title
            FROM VIDEOGAMES
            WHERE serial_number = $serial_number;";
  $result = $con->query( $query );
  $row = $result->fetch_assoc();

?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>delete VideoGame</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">

<style>
</style>
 </head>
    <body>
      <nav class="navbar navbar-inverse navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?echo $myEmail; ?></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="listGames.php"><span class="sr-only">(current)</span><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Video Games</a></li>
            <li><a href="adminLanding.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Account<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      </nav>

      <div class="container">
        <div class="jumbotron">
          <h2>Are you sure you want to delete <?php echo $row['title']; ?> ?</h2>
            <a class="btn btn-primary" href="listGames.php">Cancel</a>
            <a class="btn btn-danger" href="deleteGame.php?serialNumber=<?php echo $serial_number; ?>">Delete</a>
        </div>
    </div>

  </body>
      <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.js"></script>
</html>
