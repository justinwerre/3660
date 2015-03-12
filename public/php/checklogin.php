<?php
  include 'functions.php';
  include "databaseConnect.php";

  $tableName = 'CUSTOMERS';

    $userEmail = $_POST['email'];
    $userPass = $_POST['pwd'];

  //$hashed_pass = md5($userPass);

  $sql = "SELECT * FROM CUSTOMERS WHERE cEmail='$userEmail' and cPassword='$userPass'";

  $result = mysqli_query($con, $sql) or die(mysql_error());
  $count = mysqli_num_rows($result);
  $row = mysqli_fetch_row($result);
  if ($count == 1) {
      echo "Logged In as: " . $userEmail;
      //session_start();
      //$_SESSION["email"] = $_POST['email'];
      //$_SESSION["admin"] = 1;
      //header("location:adminpanel.php");
  } else {
    echo "Doesn't Exist";
      //header("location:incorrect.html");
  }

?>
