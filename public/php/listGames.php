<?php
  include "databaseConnect.php";
  include "functions.php";
  $isAdmin = 1;
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
          $query = "SELECT * FROM VIDEOGAMES";
          $result = mysqli_query($con, $query);

          echo "<table class=\"table table-bordered table-striped\">"; // start a table tag in the HTML
          echo "<tr><th>Art</th>";
          echo "<th>Title</th>";
          echo "<th>Description</th>";
          echo "<th>Price</th>";
          if($isAdmin == 1) echo "<th>Edit</th></tr>";
          else echo "<th>Add to Cart</th></tr>";
          while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results

          echo "<tr><td>". "<img src=\"../img/".$row['cover_art']."\" height=\"50\" width=\"100\">"."
          </td><td>" . "<strong>".$row['title'] ."</strong>"."</td><td>" .
            $row['description'] . "</td><td>" . "$".$row['price'] .
            "</td><td>" . "<a class=\"btn btn-primary\" href=\"editGames.php?serial_number={$row['serial_number']}\" role=\"button\">Edit</a>" .
            "</td></tr>";
          }
          echo "</table>";

          mysql_close();
      ?>
</div>


<table class="table table-bordered">

</table>


    </body>

    </html>