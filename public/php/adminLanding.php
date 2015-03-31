<?php
  include "databaseConnect.php";
  include "functions.php";
  session_start();
  checkAdmin();

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
        <title>Admin Landing</title>

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
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#"><?echo $myEmail; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="listGames.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Video Games</a></li>
                <li class="active"><span class="sr-only">(current)</span><a href="adminLanding.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Account<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          </nav>

<div class="container">
      <h1 class="header">Welcome <?echo $myEmail; ?></h1>
      <a class="btn btn-info pull-right" href="addUsers.php" role="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New User</a>
      <?php
          $query = "SELECT * FROM CUSTOMERS";
          $result = mysqli_query($con, $query);

          echo "<div class=\"padder-top\">
                <table id=\"listAll\" class=\"table table-bordered table-striped\" cellspacing=\"0\" width=\"100%\">
                <thead>
                <tr><th>Email Address</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Active </th>
                <th>User Type</th>
                <th>Edit</th>
                <th>Empty Cart</th>
                </tr>
                </thead>
                <tbody>";

          while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
            echo "<tr><td>" .  $row['cEmail'].
                 "</td><td>".  $row['cfName'].
                 "</td><td>".  $row['clName'].
                 "</td><td>".  $row['cAddress'].
                 "</td><td>";

                 if ($row['cActive'] == 1) echo "Yes";
                    else echo "<b>No</b>";
                 echo "</td><td>";


                 //In the table display the UserType
                 if($row['cUserType']=="1") echo "Admin";
                 else if ($row['cUserType']=="0") echo "User";

            echo "</td><td> <a class=\"btn btn-primary\" href=\"editUsers.php?cID={$row['cID']}\" role=\"button\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span> Edit</a>";
            echo "</td><td> <a class=\"btn btn-danger\" href=\"deleteCart.php?cID={$row['cID']}\" role=\"button\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span> Empty Cart</a>";
            echo "</td></tr>";
          }
          echo "</tbody>
                </table>
                </div>";

          $con->close();
      ?>
</div>

<table class="table table-bordered">

</table>


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
