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
  $row = mysqli_fetch_assoc($result);
  if ($count == 1) {
      session_start();
      $_SESSION["email"] = $_POST['email'];
      $_SESSION["ID"] = $row['cID'];
      if($row['cUserType'] == "1"){
        $_SESSION["admin"] = "1";
        header("location:adminLanding.php");
      }
      else{
        $_SESSION["admin"] = "0";
        header("location:listGames.php");
      }

  } else {
    echo "User Doesn't Exist";
    echo "<br>";
    echo "<a href=\"../html/newUser.html\">Click here to Sign up</a>";
      //header("location:incorrect.html");
  }

?>
