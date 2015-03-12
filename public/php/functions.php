<?php
  function listGames($con) {

    $query = "SELECT * FROM VIDEOGAMES";
    $result = mysqli_query($con, $query);

    echo "<table class=\"table table-bordered table-striped\">"; // start a table tag in the HTML
    echo "<tr><th>Art</th><th>Title</th><th>Description</th><th>Price</th><th>Purchase</th></tr>";
    while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results

    echo "<tr><td>". "<img src=\"../img/".$row['cover_art']."\" height=\"50\" width=\"100\">"."</td><td>" . "<strong>".$row['title'] ."</strong>"."</td><td>" . $row['description'] . "</td><td>" . "$".$row['price'] ."</td><td>" . "<a class=\"btn btn-primary\" href=\"#\" role=\"button\">Add to Cart</a>" ."</td></tr>";  //$row['index'] the index here is a field name
    }

    echo "</table>"; //Close the table in HTML

    mysql_close();


  }

?>
