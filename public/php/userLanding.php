<?php
  include "databaseConnect.php";
  include "functions.php";
  session_start();

  checkUser();
  //Set Values
  if (isset($_SESSION["email"])) {
    $myEmail = $_SESSION["email"];
  }

  if (isset($_SESSION["ID"])){
    $cID = $_SESSION["ID"];
  }
?>

<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Welcome</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">

<style>
</style>
 </head>
    <body>



      <nav class="navbar navbar-inverse navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?echo $myEmail; ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="listGames.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Video Games</a></li>
            <li class="active"><a href="userLanding.php"><span class="sr-only">(current)</span><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Purchased</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="shoppingCart.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Shopping Cart</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Account<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="editAccount.php"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Edit Account</a></li>
                <li class="divider"></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
      <h1 class="header">Welcome <?echo $myEmail; ?></h1>
        <?php
        //PLACE HOLDER FOR PURCHASED
        $query = "SELECT VIDEOGAMES.title, VIDEOGAMES.cover_art,
        VIDEOGAMES.ESRB_rating, VIDEOGAMES.description, PURCHASES.pDate
        FROM VIDEOGAMES, ORDERED, PURCHASES
        WHERE $cID = PURCHASES.cID AND PURCHASES.pID = ORDERED.pID
        AND ORDERED.serial_number = VIDEOGAMES.serial_number";

        $result = mysqli_query($con, $query);

        echo "<table id=\"listAll\" class=\"table table-bordered table-striped\">"; // start a table tag in the HTML
        echo "<tr><th>Album Art</th>
              <th>Title</th>
              <th>ESRB_rating</th>
              <th>Description</th>
              <th>Date Purchased</th>
              <th>Download</th>
              </tr>";
        while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results

            echo "<tr><td> <img src=\"../img/".$row['cover_art']."\" height=\"50\" width=\"100\">";
            echo "</td><td>".  $row['title'];
            echo "</td><td>".  $row['ESRB_rating'];
            echo "</td><td>".  $row['description'];
            echo "</td><td>". $row['pDate'];
            echo "</td><td> <a class=\"btn btn-info\" href=\"\" role=\"button\"><span class=\"glyphicon glyphicon-save\" aria-hidden=\"true\"></span> Download</a>";
            echo "</td></tr>";


        }
        echo "</table>";

        $con->close();
        ?>

    </div>





    </body>
    <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    </html>
