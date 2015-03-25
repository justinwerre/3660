<?php
  include "php/functions.php";
  loggedIn();
?>

<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Video Game Store</title>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<style>
  .padder{
    padding-bottom:10px;
  }
  .padder-top{
    padding-top:200px;
  }
  .padder-left{
    padding-left:75px;
  }
  .makeCenter {
    margin-left: auto;
    margin-right: auto;
    width: 70%;
  }


  .resizeBox{
    width:450px;

  }
</style>
 </head>
    <body>


<div class="container padder-left padder-top">
    <div class="">
      <h1 class="header makeCenter">VIDEO GAME STORE</h1>
    </div>

                        <form class="form-horizontal makeCenter" method='post' action='php/checklogin.php'>
                          <div class="form-group">
                            <label for="emailInput" class="col-sm-2 control-label">Email address</label>
                            <div class="col-sm-10">
                            <input class="form-control resizeBox" type="email" name="email" placeholder="Email Address">
                          </div>
                        </div>
                          <div class="form-group ">
                            <label for="passwordInput" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                            <input class="form-control resizeBox" type="password" name="pwd" placeholder="Password">
                          </div>
                        </div>
                        <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" formaction="php/checklogin.php">Login</button>
                            <button type="submit" class="btn btn-primary" formaction="html/newUser.html">Sign Up</a>
                          </div>
                        </form>
</div>


    </body>

    </html>
