<?php 
  include "databaseConnect.php"; 
  session_start();
  $customer_id = $_SESSION['ID'];

  // select the games the user wishes to buy
  $query = "SELECT SHOPPINGCART.serial_number, VIDEOGAMES.price
          FROM SHOPPINGCART
          INNER JOIN CUSTOMERS ON CUSTOMERS.cID = SHOPPINGCART.cID
          INNER JOIN VIDEOGAMES ON VIDEOGAMES.serial_number = SHOPPINGCART.serial_number
          WHERE SHOPPINGCART.cID = {$customer_id};";
  $cart = $con->query($query);
  var_dump($con);
  var_dump($cart);
  $today = date("Y-m-d");

  // create a purchase record
  $query = "INSERT INTO PURCHASES(cID, pDate)
            VALUES ({$customer_id}, '{$today}');";
  $t = $con->query($query);
  $purchaseId = $con->insert_id;

  // add the games to the purchase record
  while($row = $cart->fetch_assoc()){
    $query = "INSERT INTO ORDERED(pID, serial_number, price)
              VALUES ({$purchaseId}, {$row['serial_number']}, {$row['price']})";
    $con->query($query);
  }

  // delete the shopping cart
  $query = "DELETE FROM SHOPPINGCART
            WHERE cID = {$customer_id};";
  $con->query($query);

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
    <div class="container">
      <h1 class="header">Shopping Cart</h1>
      <table class="table table-bordered table-striped">
      </table>
			<a class='btn btn-success pull-right' href='checkout.php'>Checkout</a>
			<a class='btn btn-primary' href="listGames.php">Continue Shopping</a>
    </div>
  </body>
</html>
