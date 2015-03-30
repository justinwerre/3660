<?php
  //Redirects if not Logged in
  //Precondition: requires that the session has been started
  function checkUser() {
        if ( (!isset($_SESSION['email'])) || ($_SESSION['admin'] == 1)) {
            session_destroy();
            header("location:../index.php");
        }
    }

  //Redirects if not Logged in as admin
  //Precondition: requires that the session has been started
  function checkAdmin() {
    if (!(isset($_SESSION['admin'])) || ($_SESSION['admin'] != 1)) {
        session_destroy();
        header("location:../index.php");
    }
  }

  //Used for index.php, Check to see if already loggedin and redirect
  //Precondition: requires that the session has been started
  function loggedIn(){
    if((isset($_SESSION['admin'])) && ($_SESSION['admin'] == 1) ) {
      header("location:php/adminLanding.php");
    }
    else if ( (isset($_SESSSION['email'])) && ($_SESSION['admin'] != 1)){
      header("location:php/userLanding.php");
    }
  }

?>
