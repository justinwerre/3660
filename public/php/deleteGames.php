<?php
  include "databaseConnect.php";
  include "functions.php";
  checkAdmin();

  if (isset($_SESSION["email"])) {
    $myEmail = $_SESSION["email"];
  }

  if (isset($_SESSION["ID"])){
    $cID = $_SESSION["ID"];
  }

  //Check to make sure, Serial number is passed
  if (isset($_GET['serial_number']) ) {
  	$serial_number = (int) $_GET['serial_number'];
  }

  //If Page is submitted check
  if (isset($_POST['submitted'])) {
  	foreach($_POST AS $key => $value) {
  		$_POST[$key] = mysqli_real_escape_string($con,$value);
    }

  //Create the Query
  //$sql = "DELETE FROM VIDEOGAMES INNER JOIN ORDERED ON VIDEOGAMES.serial_number = ORDERED.serial_number";
  $sql = "DELETE FROM ORDERED WHERE ORDERED.serial_number = $serial_number";
  mysqli_query($con,$sql) or die(mysqli_error($con));
  var_dump($con);

  //Output yes or No
  echo (mysqli_affected_rows($con)) ? "<h3 class='container text-success'>Delete was a Success</h3><br />" : "<h3 class='container text-error'>No changes were made. </h3><br />";
}
?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Edit VideoGames</title>

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
          <h2>Confirm Delete <?php echo $gameTitle; ?> </h2>
          <form class="form-horizontal" method='post' action=''>
            <a class="btn btn-primary" href="listGames.php">Cancel</a>
            <input type='submit' class="btn btn-danger" value='Confirm' /><input type='hidden' value='1' name='submitted' />
          </form>
        </div>
    </div>

  </body>
      <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.js"></script>
</html>
