<?php 

	// Dont write CSS for this page
	
	require_once("base.php"); 

	if(session_status() == PHP_SESSION_NONE){
		session_start(); 
	}

	if(isset($_POST['create'])){
		$name = $_POST['name']; 
		$des = $_POST['description']; 
		$email1 = $_POST['email-1'];
		$email2 = $_POST['email-2'];
		$email3 = $_POST['email-3'];
		$email4 = $_POST['email-4'];
		$email5 = $_POST['email-5'];

		$adminID = $_SESSION['id']; 
		$uni = $_SESSION['university']; 

		$sql = "SELECT * from user where email in ('$email1', '$email2', '$email3', '$email4', '$email5')"; 
		$result = mysqli_query($connection, $sql); 
		$count = mysqli_num_rows($result); 

		if($count == 5){ 

			$sql = "INSERT INTO RSO (Name, Description, University_ID, AdminID) Values ('$name', '$des', '$uni', '$adminID')";

			if($connection->query($sql) == TRUE){
				echo "<script type='text/javascript'>alert('RSO Created');</script>";
			}
			else{
				echo "<script type='text/javascript'>alert('RSO Creation Failed');</script>"; 
				echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
			}

			$sql1 = "INSERT INTO RSO_STUDENTS (Student_Email, RSO_NAME) Values ('";
			$sql2 = "', '$name')"; 


			// 
			for($i = 1; $i <= 5; $i++){
				$query = $sql1 . $_POST['email-' . $i] . $sql2; 

				if($connection->query($query) == TRUE){
					echo "<script type='text/javascript'>alert('Event Created');</script>";
				}
				else{
					echo "<script type='text/javascript'>alert('Event Creation Failed');</script>"; 
					echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
				}
			}


			$query = "SELECT * FROM Admin WHERE userID = '$id'"; 

			$result = mysqli_query($connection, $query);
			$count = mysqli_num_rows($result); 
			$check = null; 

			$_SESSION['admin'] = true; 

			if($count == 1){
				$check = true; 
			}
			else
				$check = false;  

			if(!$check)
			{
				$adminInsert = "INSERT INTO Admin (useriD, University) Values ('$adminID', '$uni')";

				if($connection->query($adminInsert) == TRUE)
				{
					echo "<script type='text/javascript'>alert('You have become an admin');</script>";
				}
				else
				{
					echo "<script type='text/javascript'>alert('Event Creation Failed');</script>"; 
					echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
				}

				$email = $_SESSION['email']; 

				$sql = "INSERT INTO RSO_STUDENTS (Student_Email, RSO_NAME) Values ('$email', '$name')"; 

				if($connection->query($sql) == TRUE)
				{
					echo "<script type='text/javascript'>alert('You have become an admin');</script>";
				}
				else
				{
					echo "<script type='text/javascript'>alert('Event Creation Failed');</script>"; 
					echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
				}

				header('Location: Admin.php');
			}
		}
		else{
			echo "one or more of the enterd emails have not been found in the database" . $count; 
			include 'createRSO.php'; 
		}
	}

	if(isset($_POST['join'])){

		$email = $_SESSION['email']; 
		$rsoName = $_SESSION['rsoName']; 

		$sql = "INSERT INTO RSO_STUDENTS (Student_Email, RSO_NAME) Values ('$email', '$rsoName')"; 

		if($connection->query($sql) == TRUE){
			echo "<script type='text/javascript'>alert('Event Created');</script>";
		}
		else{
			echo "<script type='text/javascript'>alert('Event Creation Failed');</script>"; 
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}
	}

	if(isset($_POST['leave'])){

		$email = $_SESSION['email']; 
		$rsoName = $_SESSION['rsoName']; 

		$sql = "DELETE FROM RSO_STUDENTS WHERE Student_Email = '$email' AND RSO_NAME = '$rsoName'"; 

		if($connection->query($sql) == TRUE){
			echo "<script type='text/javascript'>alert('You have left the rso');</script>";
		}
		else{
			echo "<script type='text/javascript'>alert('Leave failed');</script>"; 
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}
	}

	mysqli_close($connection); 

	/*if($_SESSION['admin'] == true)
		header('Location: Admin.php');
	else
		header('Location: Student.php'); */

?>