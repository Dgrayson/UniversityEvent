<?php
	
	// Dont write CSS for this page

	require_once('base.php'); 
	

	if(session_status() == PHP_SESSION_NONE){
		session_start(); 
	}

	if(isset($_POST['submit'])){

		$email = $_POST['email']; 
		$password = $_POST['password']; 

		$sql = "SELECT * FROM User WHERE email = '" . $email . "' and password = '" . $password ."'";

		$result = mysqli_query($connection, $sql);
		mysqli_store_result($connection); 
		$count = mysqli_num_rows($result);  

		if($count == 1){
 
			$user = mysqli_fetch_array($result); 

			$_SESSION['email'] = $email; 
			$_SESSION['password'] = $password; 
			$_SESSION['id'] = $user['ID']; 
			$_SESSION['fname'] = $user['firstname'];
			$_SESSION['lname'] = $user['lastname']; 


			$id = $user['ID']; 

			$query1 = "SELECT * FROM SuperAdmin WHERE userID = '$id'"; 
			$query2 = "SELECT * FROM Admin WHERE userID = '$id'"; 
			$query3 = "SELECT * FROM Student WHERE userID = '$id'"; 

			$result = mysqli_query($connection, $query1);
			$count1 = mysqli_num_rows($result); 

			$result = mysqli_query($connection, $query2);
			$count2 = mysqli_num_rows($result); 

			$result = mysqli_query($connection, $query3);
			$count3 = mysqli_num_rows($result); 

			if($count1 == 1){
				header("Location: SuperAdmin.php"); 
			}
			else if($count2 == 1){

				$query = "SELECT * FROM Admin where userID = '$id'"; 

				$result = mysqli_query($connection, $query); 

				$admin = mysqli_fetch_array($result); 

				$_SESSION['admin'] =true; 
				$_SESSION['university'] = $admin['University'];
				header("Location: Admin.php"); 
			}
			else if($count3 = 1){

				$query = "SELECT * FROM Student where userID = '$id'"; 

				$result = mysqli_query($connection, $query); 

				$student = mysqli_fetch_array($result); 

				$_SESSION['admin'] = false; 
				$_SESSION['university'] = $student['University'];
				header("Location: Student.php"); 
			}
		}
		else{
			echo "Wrong username or password"; 
			include "login.php"; 
		}
	}
?>