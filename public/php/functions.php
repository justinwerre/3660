<?php
  function checkUser() {
        session_start();
        if ( (!isset($_SESSION['email'])) || ($_SESSION['admin'] == 1)) {
            session_destroy();
            header("location:../index.php");
        }
    }


  function checkAdmin() {
    session_start();
    if (!(isset($_SESSION['admin'])) || ($_SESSION['admin'] != 1)) {
        header("location:../index.php");
    }
  }

  function loggedIn(){
    session_start();
    if((isset($_SESSION['admin'])) && ($_SESSION['admin'] == 1) ) {
      header("location:php/adminLanding.php");
    }
    else if ( (isset($_SESSSION['email'])) && ($_SESSION['admin'] != 1)){
      header("location:php/userLanding.php");
    }
  }

?>
