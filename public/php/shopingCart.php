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
      <h1 class="header">VIDEO GAMES</h1>
      <table class="table table-bordered">
        <?php 
          $query = "SELECT *
            FROM SHOPPINGCART AS S
            INNER JOIN CUSTOMERS AS C ON C.cID = S.cID
            INNER JOIN VIDEOGAMES AS G ON G.serial_number = S.serial_number
            WHERE":
        ?>
      </table>
    </div>
  </body>
</html>
