<?php
//Logout User and Destroy Session
session_start();
if (isset($_SESSION['ID'])) {
    unset($_SESSION['ID']);
}
if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
}
if (isset($_SESSION['email'])) {
    unset($_SESSION['email']);
}
  session_destroy();
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Logged Out</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-responsive.css" rel="stylesheet">
    </head>
    <body>

        <div class="container">
            <div class="row">
                        <h1>Success!</h1>
                        <h3>You have been logged out!</h3>
                            <div class="control-group">
                                <label class="control-label" for="input01"></label>
                                <div class="controls">
                                    <a class="btn btn-info" href="../index.php">Home</a>
                                </div>
                            </div>
            </div>
        </div>
</body>
</html>
