<?php
  include "databaseConnect.php";
  include "functions.php";

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

      <?php listGames($con);
      ?>
</div>


<table class="table table-bordered">

</table>


    </body>

    </html>
