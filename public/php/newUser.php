<?php
  include "databaseConnect.php";
  include "functions.php";

  //Check if submitted
  if (isset($_POST['submitted'])) {
    $sql = "INSERT INTO CUSTOMERS (cEmail,cPassword,cAddress,cfName,clName)
    	VALUES('$_POST[email]','$_POST[password]','$_POST[address]','$_POST[firstName]','$_POST[lastName]')";

    //Display success or error message
    if(!mysqli_query($con,$sql)){
       echo "<h3 class='container text-error'>Cannot Create Account: Email Already in Use </h3><br>";
        mysqli_close($con);
      }
      else {
        echo "<h3 class='container text-success'>Success! Account Created. </h3><br>";
        mysqli_close($con);
      }
}

?>
<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>New Account</title>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">

<style>
</style>
 </head>
    <body>
      <div class="container">
        <div class="jumbotron">
      <h2>Add User</h2>
                        <form class="form-horizontal" method='post' action=''>

                          <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                            <input class="form-control" type="email"  name="email" required placeholder='example@example.com'>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="price" class="col-sm-2 control-label">Password</label>
                          <div class="col-sm-10">
                          <input class="form-control" type="password"  name="password" required placeholder='password'>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">First Name</label>
                        <div class="col-sm-10">
                        <input class="form-control" type="text" required name="firstName" placeholder='First Name'>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="title" class="col-sm-2 control-label">Last Name</label>
                      <div class="col-sm-10">
                      <input class="form-control" type="text"  required name="lastName" placeholder='Last Name'>
                    </div>
                  </div>

                <div class="form-group">
                  <label for="title" class="col-sm-2 control-label">Address</label>
                  <div class="col-sm-10">
                  <input class="form-control" type="text"  required name="address" placeholder='Address'>
                </div>
              </div>
                        <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <input type='submit' class="btn btn-info pull-right" value='Confirm' /><input type='hidden' value='1' name='submitted' />
                            </div>
                            <div class="col-sm-offset-0 col-sm-10">
                              <a class="btn btn-primary" href="../index.php">Home</a>
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
