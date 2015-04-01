<?php
  include "databaseConnect.php";
  include "functions.php";
  session_start();

  //Set Values
  if (isset($_SESSION["email"])) {
    $myEmail = $_SESSION["email"];
  }

  if (isset($_SESSION["ID"])){
    $cID = $_SESSION["ID"];
  }

  //If logged in as admin, Display page accordingly
  if ((isset($_SESSION['admin'])) && ($_SESSION['admin'] == 1)) {
      $isAdmin = 1;
      checkAdmin();
  }
  else {
    $isAdmin = 0;
    checkUser();
  }
?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Video Games</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">

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
          <li class="active"><span class="sr-only">(current)</span><a href="listGames.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Video Games</a></li>
          <?php if ($isAdmin == 0) {echo "<li><a href=\"userLanding.php\"><span class=\"glyphicon glyphicon-th-list\" aria-hidden=\"true\"></span> Purchased</a></li>";}
            else if ($isAdmin == 1) {echo "<li><a href=\"adminLanding.php\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span> Users</a></li>";}
           ?>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <?php if ($isAdmin == 0) {echo "<li><a href=\"shoppingCart.php\"><span class=\"glyphicon glyphicon-shopping-cart\" aria-hidden=\"true\"></span> Shopping Cart</a></li>";} ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Account<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <?php if ($isAdmin == 0) {echo "<li><a href=\"editAccount.php\"><span class=\"glyphicon glyphicon-menu-hamburger\" aria-hidden=\"true\"></span> Edit Account</a></li>
              <li class=\"divider\"></li>";}?>

              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>


<div class="container">
      <h1 class="header">VIDEO GAMES</h1>

<?php
      if($isAdmin == 1){
        echo "<a class='btn btn-info pull-right' href='addGames.php' role='button'><span class=\"glyphicon glyphicon-plus\" aria-hidden=\"true\"></span> Add Game</a>";
      }
          $twoQuery = "SELECT ORDERED.serial_number FROM ORDERED, PURCHASES WHERE ORDERED.pID = PURCHASES.pID and PURCHASES.cID = $cID";
          $twoResult = mysqli_query($con, $twoQuery);

          $query = "SELECT * FROM VIDEOGAMES";
          $result = mysqli_query($con, $query);
          echo "<div class=\"padder-top\">
                <table id=\"listAll\" class=\"table table-bordered table-striped\" cellspacing=\"0\" width=\"100%\">
                <thead>
                <tr><th>Art</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>";

          if($isAdmin == 1){
            echo "<th>Enabled</th>
                  <th>Edit</th>
                  <th>Delete</th></tr>";
            }
          else echo "<th>Add to Cart</th></tr>";

          echo "</thead>
                <tbody>";
          while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
            //Check if game is
              echo "<tr>";
              echo "<td>"   . "<img src=\"../img/".$row['cover_art']."\" height=\"50\" width=\"100\">" ."</td>";
              echo "<td>"   . "<strong>".$row['title'] ."</strong>" . "</td>";
              echo "<td>"   . $row['description'] ."</td>";
              echo "<td>"   . "$".$row['price'] ."</td>";


              if($isAdmin == 1) {
                echo "<td>";
                  if ($row['enabled'] == 1) echo "Yes";
                  else echo "<b>No</b>";
                echo "</td>";
                echo "<td>"."<a class=\"btn btn-primary\" href=\"editGames.php?serial_number={$row['serial_number']}\" role=\"button\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span> Edit</a>";
                echo "</td>";
                echo "<td>"."<a class=\"btn btn-danger\" href=\"deleteGames.php?serial_number={$row['serial_number']}\" role=\"button\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span> Delete</a>";
                echo "</td>";
              }
              else {
                //If game is disabled disable purchase
                if($row['enabled'] == 0) echo "<td><a class='btn btn-warning' disabled=\"disabled\" href='addToCart.php?serial_number={$row['serial_number']}' role='button'>Not Available</a>";
                else if ($row['enabled'] == 1){
                  //check to see if the game has already been purchased
                  if( checkLibrary( $con, $cID, $row['serial_number'] ) ){
                    echo "<td><a class='btn btn-info' disabled=\"disabled\" href='addToCart.php?serial_number={$row['serial_number']}' role='button'>In Library</a>";
                  //If game is enabled, then check if its in cart
                  }else if (checkCart($con, $cID, $row['serial_number'])){
                    echo "<td><a class='btn btn-primary' disabled=\"disabled\" href='addToCart.php?serial_number={$row['serial_number']}' role='button'>In Cart</a>";
                  }
                  else
                  //checkPurchased($con, $cID, $row['serial_number']);
                  //Else game can be purchased
                  echo "<td><a class='btn btn-success' href='addToCart.php?serial_number={$row['serial_number']}' role='button'>Add to Cart</a>";
                }
              }
              echo "</td></tr>";
            }

          echo "</tbody>";
          echo "</table>";
          echo "</div>";

      if($isAdmin == 1 ){
        echo "<a href=\"adminLanding.php\"<button type=\"button\" class=\"btn btn-primary\">Home</button></a>";
      }
      else echo "<a href=\"userLanding.php\"<button type=\"button\" class=\"btn btn-primary\">Home</button></a>";
          $con->close();
      ?>
</div>


    </body>
    <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript">
    $(document).ready( function() {
     $('#listAll').dataTable();
    });
    </script>


    </html>
