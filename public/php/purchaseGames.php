<?php 
  include "databaseConnect.php"; 
  session_start();
  $customer_id = $_SESSION['ID'];
  
  if (isset($_SESSION["email"])) {
    $myEmail = $_SESSION["email"];
  }
  $success = true;

  // select the games the user wishes to buy
  $query = "SELECT SHOPPINGCART.serial_number, VIDEOGAMES.price
          FROM SHOPPINGCART
          INNER JOIN CUSTOMERS ON CUSTOMERS.cID = SHOPPINGCART.cID
          INNER JOIN VIDEOGAMES ON VIDEOGAMES.serial_number = SHOPPINGCART.serial_number
          WHERE SHOPPINGCART.cID = {$customer_id};";
  $cart = $con->query($query);

  // make sure there are items in the cart for the user to purchase
  if( $cart->num_rows ){
    $today = date("Y-m-d");

    // create a purchase record
    $query = "INSERT INTO PURCHASES(cID, pDate)
              VALUES ({$customer_id}, '{$today}');";
    $t = $con->query($query);
    
    // make sure the purchase header got created
    if( true == $t ){
      $purchaseId = $con->insert_id;

      // add the games to the purchase record
      while($row = $cart->fetch_assoc()){
        $query = "INSERT INTO ORDERED(pID, serial_number, price)
                  VALUES ({$purchaseId}, {$row['serial_number']}, {$row['price']})";
        if ( false == $con->query($query) ){
          $success = false;
          break;
        }
      }

      // make sure all the games were added to the purchase order
      if ( true == $success ){
        // delete the shopping cart
        $query = "DELETE FROM SHOPPINGCART
                  WHERE cID = {$customer_id};";

        // make sure that the shopping cart got cleared out
        if( false == $con->query($query) )
          $success = false;
      }
    }else{
      $success = false;
    }
  }

  $con->close();
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
      <?php if ( 0 == $cart->num_rows ): ?>
        <h1 class="header">Error with Purchase</h1>
        <p>Your shopping cart was empty. Please add some games to it and try again.</p>
      <?php elseif ( $success ): ?>
        <h1 class="header">Purchase Successful</h1>
      <?php else: ?>
        <h1>Oops</h1>
        <p>There was a problem while processing your order, please try agian.</p>
      <?php endif ?>
      <a class='btn btn-success pull-right' href='userLanding.php'>Library</a>
      <a class='btn btn-primary' href="listGames.php">Continue Shopping</a>
    </div>
  </body>
  <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.js"></script>
</html>
