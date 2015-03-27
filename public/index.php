<?php
  include "php/functions.php";
  loggedIn();
?>

<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>Video Game Store</title>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/index.css">
<style>
</style>
 </head>
    <body>


<div class="container padder-left big-padder-top">
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
                            <button type="submit" class="btn btn-primary" formaction="php/newUser.php">Sign Up</a>
                          </div>
                        </form>
</div>


    </body>

    </html>
