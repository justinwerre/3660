<?php
  include "databaseConnect.php";
  include "functions.php";
  session_start();
  if ((isset($_SESSION['admin'])) && ($_SESSION['admin'] == 1)) {
      $isAdmin = 1;
  }
  else {
    $isAdmin = 0;
  }

?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Video Games</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">

<style>
</style>
 </head>
    <body>


<div class="container">
      <h1 class="header">VIDEO GAMES</h1>

      <?php
      if($isAdmin == 1){
        echo "<a class='btn btn-info pull-right' href='shoppingCart.php' role='button'><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span> Add Game</a>";
      }
      else {
        echo "<a class='btn btn-info pull-right' href='shoppingCart.php' role='button'><span class=\"glyphicon glyphicon-shopping-cart\" aria-hidden=\"true\"></span> Shopping Cart</a>";
      }
          $query = "SELECT * FROM VIDEOGAMES";
          $result = mysqli_query($con, $query);

          echo "<table class=\"table table-bordered table-striped\">"; // start a table tag in the HTML
          echo "<tr><th>Art</th>";
          echo "<th>Title</th>";
          echo "<th>Description</th>";
          echo "<th>Price</th>";

          if($isAdmin == 1){
            echo "<th>Edit</th>";
            echo "<th>Delete</th></tr>";
            }
            else echo "<th>Add to Cart</th></tr>";
          while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results

          echo "<tr>";
          echo "<td>" . "<img src=\"../img/".$row['cover_art']."\" height=\"50\" width=\"100\">" ."</td>";
          echo "<td>"."<strong>".$row['title'] ."</strong>" . "</td>";
          echo "<td>". $row['description'] ."</td>";
          echo "<td>" . "$".$row['price'] ."</td>";
          if($isAdmin == 1) {
            echo "<td>"."<a class=\"btn btn-primary\" href=\"editGames.php?serial_number={$row['serial_number']}\" role=\"button\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span> Edit</a>";
            echo "</td>";
            echo "<td>"."<a class=\"btn btn-danger\" href=\"deleteGames.php?serial_number={$row['serial_number']}\" role=\"button\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span> Delete</a>";
            echo "</td>";
          }
          else {
            echo "<td><a class='btn btn-success' href='addToCart.php?serial_number={$row['serial_number']}' role='button'>Add to Cart</a>";
          }
          echo "</td></tr>";
          }
          echo "</table>";

          mysql_close();
      ?>
      <a href="adminLanding.php"<button type="button" class="btn btn-info">Back</button></a>
</div>


    </body>

    </html>
