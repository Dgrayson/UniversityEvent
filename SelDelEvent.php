<?php
	require_once('base.php');

	if(session_status() == PHP_SESSION_NONE){
		session_start(); 
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Select Event</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div id = "container">
	<form method="post" action="CreateEvent.php">
		
		<h2>Delete Event</h2>

		<hr />

		<select name="events">
			<?php

				$sql = "SELECT Name FROM event"; 
				$result = $connection->query($sql); 

				while($row = $result->fetch_assoc()){
					$name = $row['Name']; 
					echo '<option value = "'. $name .'">'. $name .'</option>';
				}
			?>
		</select>

		<input type="submit" name="delete">
	</form>

	<?php 
		if ($_SESSION['admin'] == true)
			echo '<a href = "admin.php">Home</a>';
		else
			echo '<a href = "student.php">Home</a>';
	?>
	</div>
	
</body>
</html>