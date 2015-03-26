<?php
  include "databaseConnect.php";
  $password = $_POST['pwd'];

//Insert into database
if (empty($_POST['email']) || empty($_POST['pwd'])) {
  echo"<h1> Can't have Blank Fields</h1>";
  header("location:index.php");
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
//Need to 'beautify' later
else {
  echo "User Created!";
  mysqli_close($con);

  }
}
?>
