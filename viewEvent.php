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

	<div id="container">
		<form method="post" action="Event.php">
			<h2>View Event</h2>
			<hr />
			<select name="events">
				<?php

					$uni = $_SESSION['university']; 
					$email = $_SESSION['email'];

					$sql = "SELECT Name FROM event WHERE category = 'Public'"; 
					$result = $connection->query($sql); 

					while($row = $result->fetch_assoc()){
						$name = $row['Name']; 
						echo '<option value = "'. $name .'">'. $name .'</option>';
					}

					$sql = "SELECT Name FROM event WHERE category = 'Private' AND university = '".$uni."'"; 
					$result = $connection->query($sql); 

					while($row = $result->fetch_assoc()){
						$name = $row['Name']; 
						echo '<option value = "'. $name .'">'. $name .'</option>';
					}

					
					$sql = "SELECT DISTINCT event.Name FROM event, rso, rso_students 
							WHERE event.category = 'RSO' 
							AND rso.University_ID = '$uni' 
							AND rso_students.Student_Email = '$email'";
					
					$result = $connection->query($sql);
					$count = mysqli_num_rows($result); 

					

					if($connection->query($sql) == TRUE){
					//echo "<script type='text/javascript'>alert('Rating added');</script>";
					}
					else{
						echo "<script type='text/javascript'>alert('rating failed');</script>"; 
						echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
					}


					while($row = $result->fetch_assoc()){
						$name = $row['Name']; 
						echo '<option value = "'. $name .'">'. $name .'</option>';
					}

				?>
			</select>



			<input type="submit" name="view" value = "View Event">
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