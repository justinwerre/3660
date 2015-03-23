<?php
  include "databaseConnect.php";
  include "functions.php";
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
      <h1 class="header">Welcome</h1>
        <a href="listGames.php">List Games </a>
        <a href="listUsers.php">List Users </a>
        <a href="<?session_destroy(); ?>">Log Out</a>
</div>


<table class="table table-bordered">

</table>


    </body>

    </html>
