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
	<title>View RSO</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="container">
		<form method="post" action="rsoPage.php">
			<h2>Select RSO</h2>
			<hr />
			<select name="rsos">
				<?php
					$uni = $_SESSION['university']; 
					$sql = "SELECT Name FROM RSO WHERE University_ID = '$uni'"; 
					$result = $connection->query($sql); 
					$count = mysqli_num_rows($result); 

					while($row = $result->fetch_assoc()){
						$name = $row['Name']; 
						$_SESSION['rsoName'] = $name; 
						echo '<option value = "'. $name .'">'. $name .'</option>';
					}
				?>
			</select>

			<input type="submit" name="view">
		</form>

		<form method="post" action = "createRso.php">
			<input type="submit" name = "create" value = "Create">
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