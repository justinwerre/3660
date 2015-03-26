<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $database = "3660Project";
    $con = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
    }
  ?>
