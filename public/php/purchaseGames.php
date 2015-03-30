<?php 
  include "databaseConnect.php"; 
  session_start();
  $customer_id = $_SESSION['ID'];
  $success = true;
  $con->begin_transaction();

    // select the games the user wishes to buy
    $query = "SELECT SHOPPINGCART.serial_number, VIDEOGAMES.price
            FROM SHOPPINGCART
            INNER JOIN CUSTOMERS ON CUSTOMERS.cID = SHOPPINGCART.cID
            INNER JOIN VIDEOGAMES ON VIDEOGAMES.serial_number = SHOPPINGCART.serial_number
            WHERE SHOPPINGCART.cID = {$customer_id};";
    $cart = $con->query($query);
    if( false == $cart)
      $success = false;
    $today = date("Y-m-d");

    // create a purchase record
    $query = "INSERT INTO PURCHASES(cID, pDate)
              VALUES ({$customer_id}, '{$today}');";
    $t = $con->query($query);
    if( false == $t )
      $success = false;
    $purchaseId = $con->insert_id;

    // add the games to the purchase record
    while($row = $cart->fetch_assoc()){
      $query = "INSERT INTO ORDERED(pID, serial_number, price)
                VALUES ({$purchaseId}, {$row['serial_number']}, {$row['price']})";
      if ( false == $con->query($query) )
        $success = false;
    }

    // delete the shopping cart
    $query = "DELETE FROM SHOPPINGCART
              WHERE cID = {$customer_id};";
    if( flase == $con->query($query) )
      $success = false;

  if( $success ){
    $con->commit();
  }else{
    $con->rollback();
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
    <div class="container">
        <?php if ($success): ?>
          <h1 class="header">Purchase Successful</h1>
          <a class='btn btn-success pull-right' href=''>Library</a>
          <a class='btn btn-primary' href="listGames.php">Continue Shopping</a>
        <?php endif ?>
    </div>
  </body>
</html>
