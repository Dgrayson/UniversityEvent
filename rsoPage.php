<?php 

	require_once('base.php');

	if(session_status() == PHP_SESSION_NONE){
		session_start(); 
	}

	$name = $_SESSION['rsoName'];

	if(isset($_POST['view'])){

		$name = $_POST['rsos']; 

		$sql = "SELECT * FROM rso WHERE Name = '$name'"; 
		$result = $connection->query($sql); 

		$result = $connection->query($sql);

		$rso = $result->fetch_assoc();

		$name = $rso['Name']; 
		$des = $rso['Description']; 
		$uni = $rso['University_ID']; 
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>RSO</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
	<div id="container">
		<form method="post" action="RSO.php">
		<h2>
			<?php echo $name; ?>
		</h2>
		<hr />
		
			<?php echo $_SESSION['rsoName']; ?>

		  <?php echo $des; ?> 
		  <br />
		  <br />

		  <?php  

		  	$email = $_SESSION['email'];
		  	$rsoname = $_SESSION['rsoName']; 

		  	$query = "SELECT * FROM RSO_STUDENTS WHERE Student_Email = '" . $email . "' AND RSO_NAME = '". $rsoname ."'";

		  	$result = mysqli_query($connection, $query);
			$count = mysqli_num_rows($result); 

			if($count == 1)
				echo '<input type = "submit" name = "leave" value = "leave">';
			else 
				echo '<input type = "submit" name = "join" value = "join">';
		  ?>


		 
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