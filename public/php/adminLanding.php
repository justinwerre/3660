<?php
  include "databaseConnect.php";
  include "functions.php";
  checkAdmin();
  if (isset($_SESSION['email'])) {
    $myEmail = $_SESSION['email'];
  }
?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Admin Landing</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">

<style>
</style>
 </head>
    <body>


<div class="container">
      <h1 class="header">Welcome <?echo $myEmail; ?></h1>
        <div class="btn-group" role="group" aria-label="...">
          <a href="listGames.php"> <button type="button" class="btn btn-default">Games</button></a>
            <a href="listUsers.php"> <button type="button" class="btn btn-default">Users</button></a>
              <a href="logout.php"> <button type="button" class="btn btn-default">Log Out</button></a>
        </div>

</div>

<table class="table table-bordered">

</table>


    </body>

    </html>
