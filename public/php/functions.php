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

  //Used for checking if an item is already in a User's cart
  //Precondition: user must not have purchased an item and an item must be in the cart.
  function checkCart($con, $cID, $serial_number){
    $result = mysqli_query($con, "SELECT * FROM SHOPPINGCART
      WHERE SHOPPINGCART.cID = $cID AND SHOPPINGCART.serial_number = $serial_number");

    $num_rows = mysqli_num_rows( $result);

    if($num_rows >= 1) {
      return true;
    }
    else {
      return false;
    }
  }

  // used for checking if an item has already been purchased by the user
  // returns true if the user owns the game already, false other wise.
  function checkLibrary( $con, $cID, $serial_number ){
    $query = "SELECT *
              FROM PURCHASES
              INNER JOIN ORDERED ON PURCHASES.pID = ORDERED.pID
              WHERE PURCHASES.cID = {$cID}
              AND ORDERED.serial_number = {$serial_number};";
    $query_result = $con->query( $query );

    if( $query_result->num_rows ){
      // The user already owns the game; return true
      $result = true;
    }else{
      // The user doesn't own the game; return false
      $result = false;
    }

    return $result;
  }


?>
