<?php
  include "databaseConnect.php";
  include "functions.php";
?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Video Games</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
 	</head>
  <body>


	<div class="container">
		<h1 class="header">VIDEO GAMES</h1>
			<table class='table table-bordered table-striped'> 
				<tr><th>Art</th><th>Title</th><th>Description</th><th>Price</th><th>Add to Cart</th><th>Edit</th></tr>
					<?php
						$query = "SELECT * FROM VIDEOGAMES";
						$result = mysqli_query($con, $query);

						while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
							echo "<tr>";
							echo "<td><img src='../img/{$row['cover_art']}'height='50' width='100'></td>";
							echo "<td><strong>{$row['title']}</strong></td>";
							echo "<td>{$row['description']}</td>";
							echo "<td>\${$row['price']}</td>";
							echo "<td><a class='btn btn-success' href='addToCart.php?serial_number={$row['serial_number']}' role='button'>Add to Cart</a><?td>";
							echo "<td><a class='btn btn-primary' href='editGames.php?serial_number={$row['serial_number']}' role='button'>Edit</a></td>";
							echo "</tr>"; 
						}

						mysql_close();
					?>
			</table>
		</div>
	</body>
</html>
