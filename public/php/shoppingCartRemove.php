<?php
	include "databaseConnect.php";
	session_start();
	$serial_number = $_GET['serial_number'];
	$customer_id = $_SESSION['ID'];	

	$query = "DELETE FROM SHOPPINGCART
						WHERE serial_number = {$serial_number}
						and cID = {$customer_id};";
	
	$result = $con->query($query);

	if( $con->affected_rows ){
		header('location:/php/shoppingcart.php');
	}else{
		echo "<h1>Could not delete item from shopping cart</h1>";
		echo "<a href='shoppingcart.php'>Return to shopping cart</a>";
	}
?>