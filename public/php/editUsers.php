<?php
  include "databaseConnect.php";
  include "functions.php";

  //Check to make sure, Serial number is passed
  if (isset($_GET['cID']) ) {
  	$cID = (int) $_GET['cID'];
  }

  //If Page is submitted check
  if (isset($_POST['submitted'])) {
  	foreach($_POST AS $key => $value) {
  		$_POST[$key] = mysqli_real_escape_string($con,$value);
    }

  //Create the Query
  $sql = "UPDATE `CUSTOMERS` SET
  `cEmail` =  '{$_POST['email']}' ,
  `cPassword` =  '{$_POST['password']}' ,
  `cfName` =  '{$_POST['firstName']}',
  `clName` =  '{$_POST['lastName']}' ,
  `cAddress` =  '{$_POST['address']}' ,
  `cUserType` =  '{$_POST['UserType']}'
  WHERE `cID` = '$cID' ";

  mysqli_query($con,$sql) or die(mysqli_error($con));

  //Grab Title
  if(isset($_POST['cEmail'])) {
    $userEmail = $_POST['cEmail'];
  }
  else {
    $userEmail = $row['cEmail'];
  }
  //Output yes or No
  echo (mysqli_affected_rows($con)) ? "<h3 class='container text-success'>Edited $gameTitle. </h3><br />" : "<h3 class='container text-error'>No changes made. </h3><br />";
}

$row = mysqli_fetch_array ( mysqli_query($con,"SELECT * FROM `CUSTOMERS` WHERE `cID` = '$cID' "));
  mysqli_close($con);




?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Edit VideoGames</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">

<style>
</style>
 </head>
    <body>


      <div class="container">
        <div class="jumbotron">
      <h2>Editing <?echo $row['cfName'] ." ". $row['clName'] .":"; ?></h2>
                        <form class="form-horizontal" method='post' action=''>

                          <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                            <input class="form-control" type="email" name="email" value='<?= stripslashes($row['cEmail']) ?>'>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="price" class="col-sm-2 control-label">Password</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="password" name="password" value='<?= stripslashes($row['cPassword']) ?>'>
                        </div>
                      </div>



                      <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                        <input class="form-control" type="text" name="firstName" value='<?= stripslashes($row['cfName']) ?>'>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Last Name</label>
                      <div class="col-sm-10">
                      <input class="form-control" type="text" name="lastName" value='<?= stripslashes($row['clName']) ?>'>
                    </div>
                  </div>

                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text" name="address" value='<?= stripslashes($row['cAddress']) ?>'>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">User Type</label>
                <div class="col-sm-10">
              <select class="form-control" id='UserType' required name='UserType'>
                      <option value="1"  <?php if($row['cUserType']=="1") echo "selected";?>>Admin</option>
                      <option value="0"  <?php if($row['cUserType']=="0") echo "selected";?>>User</option>
              </select>
                </div>
              </div>

                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <input type='submit' class="btn btn-info" value='Edit User' /><input type='hidden' value='1' name='submitted' />
                            </div>
                            <div class="col-sm-offset-0 col-sm-10">
                              <button class="btn btn-danger" formaction="../php/listUsers.php">Back</a>
                              </div>
                          </div>
                        </form>
                      </div>
                    </div>


      <table class="table table-bordered"> </table>


      </body>
    </html>
