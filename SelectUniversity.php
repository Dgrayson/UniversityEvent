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
	<title>Select University</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id = "container">
	<h2>Select University</h2>
	<hr />
	<form method="post" action="UniversityForm.php">
		<select name="universities">
			<?php

				$sql = "SELECT Name FROM University"; 
				$result = $connection->query($sql); 

				while($row = $result->fetch_assoc()){
					$name = $row['Name']; 
					echo '<option value = "'. $name .'">'. $name .'</option>';
				}
			?>
		</select>

		<input type="submit" name="edit">
	</form>

	<a href="SuperAdmin.php">Home</a>
	</div>
</body>
</html>