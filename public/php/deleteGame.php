<?php
	include "databaseConnect.php";
  include "functions.php";
  session_start();
  checkAdmin();
  $serial_number = $_GET['serialNumber'];

  // needed for the navigation bar
  if (isset($_SESSION["email"])) {
    $myEmail = $_SESSION["email"];
  }

  $query = "DELETE FROM VIDEOGAMES
  					WHERE serial_number = $serial_number;";

  $result = $con->query( $query );
  $con->close();
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Video Games</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
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
            <li><a href="listGames.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Video Games</a></li>
            <li><a href="userLanding.php"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Purchased</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="shoppingCart.php"><span class="sr-only">(current)</span><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Shopping Cart</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Account<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="editAccount.php"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Edit Account</a></li>
                <li class="divider"></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <?php if ( $result ): ?>
        <h1 class="header">The game has been successfully deleted.</h1>
      <?php else: ?>
        <h1>Oops</h1>
        <p>There was a problem while processing your request, please try agian.</p>
      <?php endif ?>
      <a class='btn btn-success pull-right' href='listGames.php'>Manage Games</a>
    </div>
  </body>
  <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
</html>
