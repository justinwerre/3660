<?php
  include "databaseConnect.php";
  include "functions.php";
  session_start();
  checkAdmin();

  //Set Values
  if (isset($_SESSION["email"])) {
    $myEmail = $_SESSION["email"];
  }

  if (isset($_SESSION["ID"])){
    $cID = $_SESSION["ID"];
  }

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
  `cUserType` =  '{$_POST['UserType']}',
  `cActive` =  '{$_POST['userActive']}'
  WHERE `cID` = '$cID' ";

  mysqli_query($con,$sql) or die(mysqli_error($con));

  //Output yes or No
  echo (mysqli_affected_rows($con)) ? "<h3 class='container text-success'> Changes were saved </h3><br />" : "<h3 class='container text-error'>No changes were made </h3><br />";
}

$row = mysqli_fetch_array ( mysqli_query($con,"SELECT * FROM `CUSTOMERS` WHERE `cID` = '$cID' "));
  mysqli_close($con);




?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Edit Users</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">

<style>
</style>
 </head>
    <body>
                <nav class="navbar navbar-inverse navbar-default">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?echo $myEmail; ?></a>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li><a href="listGames.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Video Games</a></li>
                      <li class="active"><span class="sr-only">(current)</span><a href="adminLanding.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Account<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
                </nav>


      <div class="container">
        <div class="jumbotron">
      <h2>Editing <?echo $row['cfName'] ." ". $row['clName'] .":"; ?></h2>
                        <form class="form-horizontal" method='post' action=''>

                          <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                            <input class="form-control" type="email" required name="email" value='<?= stripslashes($row['cEmail']) ?>'>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="price" class="col-sm-2 control-label">Password</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="password" required name="password" value='<?= stripslashes($row['cPassword']) ?>'>
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
                <label for="title" class="col-sm-2 control-label">Account Active</label>
                <div class="col-sm-10">
                  <select class="form-control" id='userActive' required name='userActive'>
                          <option value="1"  <?php if($row['cActive']=="1") echo "selected";?>>Yes</option>
                          <option value="0"  <?php if($row['cEmail'] == $_SESSION['email']){ echo "disabled=\"disabled\" ". " ";} if($row['cActive']=="0") echo "selected";?>>No</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="" class="col-sm-2 control-label">User Type</label>
                <div class="col-sm-10">
              <select class="form-control" id='UserType' required name='UserType'>
                      <option value="1"  <?php if($row['cUserType']=="1") echo "selected";?>>Admin</option>
                      <option value="0"  <?php if($row['cEmail'] == $_SESSION['email']){ echo "disabled=\"disabled\" ". " ";} if($row['cUserType']=="0") echo "selected";?>>User</option>
              </select>
                </div>
              </div>


                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <input type='submit' class="btn btn-info pull-right" value='Confirm' /><input type='hidden' value='1' name='submitted' />
                            </div>
                            <div class="col-sm-offset-0 col-sm-10">
                              <button class="btn btn-primary" formaction="../php/adminLanding.php">Back</a>
                              </div>
                          </div>
                        </form>
                      </div>
                    </div>


      <table class="table table-bordered"> </table>


      </body>
      <script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
      <script type="text/javascript" src="../js/bootstrap.js"></script>
    </html>
