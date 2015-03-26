<?php
  include 'functions.php';
  include "databaseConnect.php";

  //Grab Values
  $tableName = 'CUSTOMERS';
  $userEmail = $_POST['email'];
  $userPass = $_POST['pwd'];

  $sql = "SELECT * FROM CUSTOMERS WHERE cEmail='$userEmail' and cPassword='$userPass' and cActive ='1';";
  
  $result = mysqli_query($con, $sql)or die(mysql_error());
  $count = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);

  //If found and Account is active start Session
  if ($count == 1) {

      session_start();
      $_SESSION["email"] = $_POST['email'];
      $_SESSION["ID"] = $row['cID'];

      if($row['cUserType'] == 1){
        $_SESSION["admin"] = 1;
        header("location:adminLanding.php");
      }
      else{
        $_SESSION["admin"] = 0;
        header("location:userLanding.php");
      }
  }

?>

<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Error</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/index.css">
<style>
</style>
 </head>
    <body>


<div class="container padder-left padder-top makeCenter">
    <div class="">
      <h1 class="header"><i>Sorry...</i></h1>
    </div>
      <h3>The Username or Password is Incorrect</h3>

                            <a type="submit" class="btn btn-info" href="../index.php">Try again</a>
                            <a type="submit" class="btn btn-primary" href="../html/newUser.html">Sign Up</a>

</div>


    </body>

    </html>
