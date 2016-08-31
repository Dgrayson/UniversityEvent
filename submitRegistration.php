<?php 

	// Dont write CSS for this page
	
	require_once('base.php'); 

	if(session_status() == PHP_SESSION_NONE){
		session_start(); 
	}
	
	if(isset($_POST['submit'])){

		$fname = $_POST['fName']; 
		$lname = $_POST['lName']; 
		$email = $_POST['email']; 
		$phone = $_POST['phone']; 
		$id = uniqid(); 
		$pass = genPassword(); 

		$email = filter_var($email, FILTER_VALIDATE_EMAIL); 

		if(!$email){
			echo "Invalid email Address";
			include 'register.php'; 
			exit; 
		}

		$email = $_POST['email'];

		$uni = $_POST['universities']; 

		$sql = "INSERT INTO USER (ID, firstname, lastname, password, email, phone) Values ('$id', '$fname', '$lname', '$pass', '$email' , '$phone')";
		
		$sql2 = "INSERT INTO Student (userID, University) Values ('$id', '$uni')"; 


		if($connection->query($sql) == TRUE){
			echo "<script type='text/javascript'>alert('User Created');</script>";
		}else{
			echo "<script type='text/javascript'>alert('User Creation Failed');</script>";
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}


		if($connection->query($sql2) == TRUE){
			echo "<script type='text/javascript'>alert('Student Created');</script>";
		}else{
			echo "<script type='text/javascript'>alert('Student Creation Failed');</script>";
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}

		//echo "User creaed use this password to login. <br /><br /> Password: ". $pass ." <br /> <br /><a href = 'login.php'>Return to Login</a>";
	}

	function genPassword(){
		$result = ""; 

		$chars = 'bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ123456789';
		$count = mb_strlen($chars); 

		for($i = 0; $i < 8; $i++){
			$index = rand(0, $count -1); 
			$result .= mb_substr($chars, $index, 1); 
		}
		return $result; 
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="container">
		<?php
			echo "User created use this password to login. <br /><br /> Password: ". $pass ." <br /> <br /><a href = 'login.php'>Return to Login</a>";
		?>
	</div>
</body>
</html>