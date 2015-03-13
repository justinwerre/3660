<?php
	include 'databaseConnect.php';
	session_start();
	$serial_number = $_GET['serial_number'];
	$id = $_SESSION['ID'];
	
	//first we want to make sure the game isn't already in the shopping cart
	$query = "SELECT *
						FROM SHOPPINGCART
						WHERE cID = $id
						AND serial_number = $serial_number;";
	$result = $con->query($query);

	// if its not in the shopping cart already, add it to it.
	if(0 == $result->num_rows){
		$query = "INSERT INTO SHOPPINGCART(cID, serial_number)
							values ($id, $serial_number);";
		$result = $con->query($query);
		
		if(! $result){
			echo "<h1>There was a problem adding your item to the shopping cart</h1>";
			echo "<a href='shoppingCart.php'>Goto shopping cart</a>";
			die();
		}
	}

	$con->close();
	header("location:shoppingCart.php");
?>