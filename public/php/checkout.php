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
      <h1 class="header">Confirm Purchase</h1>
      <table class="table table-bordered table-striped">
        <?php 
          session_start();
          $query = "SELECT VIDEOGAMES.title, VIDEOGAMES.description, VIDEOGAMES.ESRB_rating, VIDEOGAMES.price, SHOPPINGCART.serial_number
            FROM SHOPPINGCART
            INNER JOIN CUSTOMERS ON CUSTOMERS.cID = SHOPPINGCART.cID
            INNER JOIN VIDEOGAMES ON VIDEOGAMES.serial_number = SHOPPINGCART.serial_number
            WHERE SHOPPINGCART.cID = " . $_SESSION['ID'] . ";";
          $result = $con->query($query);
          $total = 0;
					
          while($row = $result->fetch_assoc()){
						echo "<tr>";
						echo "<td>{$row['title']}</td>";
						echo "<td>{$row['description']}</td>";
						echo "<td>{$row['ESRB_rating']}</td>";
						echo "<td>{$row['price']}</td>";
						echo "</tr>";
            $total += $row['price'];
          }
          echo "<tr><td colspan=3>Total</td><td>$total</td></tr>";
              
          $con->close();
        ?>
      </table>
      <a class="btn btn-danger" href="shoppingCart.php">Cancel</a>
      <a class="btn btn-primary" href="listGames.php">Continue shopping</a>
			<a class='btn btn-success pull-right' href='purchaseGames.php'>Purchase</a>
    </div>
  </body>
</html>
