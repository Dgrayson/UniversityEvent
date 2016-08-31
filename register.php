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
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form method="post" action="submitRegistration.php">
		Firstname:
			<input type = "textbox" name="fName">
		<br />
		<br />
		LastName: 
			<input type= "textbox" name="lName">
		<br />
		<br />
		Email:
			<input type="textbox" name="email">
		<br />
		<br />	
		Phone Number: 
			<input type="textbox" name="phone">
		<br />
		<br />	
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
		<br />
		<br />	
		<input type="submit" name="submit">
	</form>
</body>
</html>