<?php 
	
	require_once('base.php'); 

	if(session_status() == PHP_SESSION_NONE){
		session_start(); 
	}

	$sql = ""; 
	$uniName = ""; 
	$uniDes = ""; 
	$numStudents = 0; 


	if(isset($_POST['submit'])){

		$uniName = $_POST['uniName']; 
		$uniDes = $_POST['uniDes']; 
		$numStudents = (int)$_POST['numStudents']; 
		$sql = "INSERT INTO University (Name, Description, numStudents) Values ('$uniName', '$uniDes', ".$numStudents.")";

		if($connection->query($sql) == TRUE){
			echo "<script type='text/javascript'>alert('University Created');</script>";
		}else{
			echo "<script type='text/javascript'>alert('University Creation Failed');</script>";
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}
	}

	if(isset($_POST['update'])){

		$uniName = $_POST['uniName']; 
		$uniDes = $_POST['uniDes']; 
		$numStudents = (int)$_POST['numStudents']; 

		$sql = "UPDATE University  SET 
			Description = '". $uniDes ."', 
			numStudents = ". $numStudents . "
			WHERE Name = '". $uniName ."'"; 

		if($connection->query($sql) == TRUE){
			echo "<script type='text/javascript'>alert('University Updated');</script>";
		}else{
			echo "<script type='text/javascript'>alert('University Update Failed');</script>";
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}
	}

	if(isset($_POST['delete'])){

		$uniName = $_POST['uniName']; 

		$sql = "DELETE FROM University WHERE name = '$uniName'"; 

		if($connection->query($sql) == TRUE){
			echo "<script type='text/javascript'>alert('University Delete Successful');</script>";
		}else{
			echo "<script type='text/javascript'>alert('University Delete Failed');</script>";
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}
	}

	mysqli_close($connection); 

	header('Location: SuperAdmin.php'); 
?>