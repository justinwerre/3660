<?php
  include "databaseConnect.php";
  $password = $_POST['pwd'];
  //$hashedPassword = md5($password);

//Insert into database
if (empty($_POST['email']) || empty($_POST['pwd'])) {
  echo"<h1> Can't have Blank Fields</h1>";
  header("location:index.html");
}
else {


$sql = "INSERT INTO CUSTOMERS (cEmail,cPassword,cAddress,cfName,clName)
	VALUES('$_POST[email]','$password','$_POST[address]','$_POST[fName]','$_POST[lName]')";
//If can't throw an error
if (!mysqli_query($con, $sql)){
    echo "<h1>Error adding User: Email Taken<h1>";
    mysqli_close($con);
}
//else direct to confirmation
else {
  echo "Shit worked";
  mysqli_close($con);
  /*
    mysqli_close($con);
    session_start();
    $_SESSION['email'] = $_POST['user_email'];
    $_SESSION['pwd'] = $password;
    //$_SESSION['name'] = $_POST['user_name'];
    header("location:created.php");
    */
}
}
?>
