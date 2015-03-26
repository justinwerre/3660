<?php
  include "databaseConnect.php";
  include "functions.php";
  checkAdmin();
?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Customers</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">

<style>
</style>
 </head>
    <body>


<div class="container">
      <h1 class="header">Customers</h1>
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
      <a href="adminLanding.php"<button type="button" class="btn btn-info">Back</button></a>
</div>


    </body>
    <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
    $(document).ready( function() {
     $('#listAll').dataTable();
    });
    </script>
    </html>
