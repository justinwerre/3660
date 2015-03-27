<?php
  include "databaseConnect.php";
  include "functions.php";
  checkUser();
  if (isset($_SESSION["email"])) {
    $myEmail = $_SESSION["email"];
  }
?>
<!DOCTYPE html>

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
      <h1 class="header">Shopping Cart</h1>
      <table class="table table-bordered table-striped">
        <?php
          session_start();
          $query = "SELECT VIDEOGAMES.title, VIDEOGAMES.description, VIDEOGAMES.ESRB_rating, VIDEOGAMES.price, SHOPPINGCART.serial_number
            FROM SHOPPINGCART
            INNER JOIN CUSTOMERS ON CUSTOMERS.cID = SHOPPINGCART.cID
            INNER JOIN VIDEOGAMES ON VIDEOGAMES.serial_number = SHOPPINGCART.serial_number
            WHERE SHOPPINGCART.cID = " . $_SESSION['ID'] . ";";
          $result = $con->query($query);

          while($row = $result->fetch_assoc()){
						echo "<tr>";
						echo "<td>{$row['title']}</td>";
						echo "<td>{$row['description']}</td>";
						echo "<td>{$row['ESRB_rating']}</td>";
						echo "<td>{$row['price']}</td>";
						echo "<td><a class='btn btn-danger' href='shoppingCartRemove.php/?serial_number={$row['serial_number']}' role='button'>Remove</a></td>";
						echo "</tr>";
          }

          $con->close();
        ?>
      </table>
			<a class='btn btn-success pull-right' href='checkout.php'>Checkout</a>
			<a class='btn btn-primary' href="listGames.php">Continue Shopping</a>
    </div>
  </body>
  <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
</html>
