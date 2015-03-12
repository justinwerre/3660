<?php include "databaseConnect.php"; ?>
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
      <table class="table table-bordered">
        <?php 
          session_start();
          $query = "SELECT *
            FROM SHOPPINGCART
            INNER JOIN CUSTOMERS ON CUSTOMERS.cID = SHOPPINGCART.cID
            INNER JOIN VIDEOGAMES ON VIDEOGAMES.serial_number = SHOPPINGCART.serial_number
            WHERE SHOPPINGCART.cID = " . $_SESSION['ID'] . ";";
          $result = mysqli_query($con, $sql);// or die(mysql_error());
          var_dump($query);
          while($row = mysqli_fetch_array($result)){
            var_dump($row);
          }
              
          mysqli_close($con);
        ?>
      </table>
    </div>
  </body>
</html>
