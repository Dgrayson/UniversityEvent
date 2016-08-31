<?php 
	
	// Dont write CSS for this page

	require_once('base.php'); 
	
	if(session_status() == PHP_SESSION_NONE){
		session_start(); 
	}

	$sql = ""; 
	$eventName; 
	$eventDes; 

	if(isset($_POST['submit'])){

		$rso = ""; 
		$eventName = $_POST['eventName']; 
		$eventDes = $_POST['description']; 
		$dateTime = $_POST['e-dateTime'];  
		$phone = $_POST['eventPhone']; 
		$email = $_POST['eventEmail']; 
		$category = $_POST['category']; 
		$userID = $_SESSION['id']; 
		$uni = $_SESSION['university']; 

		$email = filter_var($email, FILTER_VALIDATE_EMAIL); 

		if(!$email){

			$_SESSION['failedEmail'] = true; 
			
			include 'CreateEvent.php'; 
			exit; 
		}

		$_SESSION['failedEmail'] = false;
		$email = $_POST['eventEmail']; 

		/*$sql = "SELECT event.name FROM event locaion where event.DateTime = '$dateTime' AND event.university = '$uni' AND location.uni = '$uni'";

		$result = mysqli_query($connection, $sql); 
		$count = mysqli_num_rows($result);

		if($count > 0){
			echo 'Cannot have an event at the same time at the same location'; 

			include 'CreateEvent.php'; 
			exit; 
		}*/

		if(isset($_POST['rso']) && $category = 'RSO'){
			$rso = $_POST['rso']; 
		}
		else
			$rso = null; 

		$sql = "INSERT INTO Event (Name, Description, DateTime, Category, Contact_phone, Contact_email, creatorID, rso_name, university) Values ('$eventName', '$eventDes', '$dateTime', '$category', '$phone', '$email', '$userID', '$rso', '$uni')"; 

		if($connection->query($sql) == TRUE){
			echo "<script type='text/javascript'>alert('Event Created');</script>";
		}
		else{
			echo "<script type='text/javascript'>alert('Event Creation Failed');</script>"; 
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}

		$address = $_POST['address']; 
		$lng = "";
		$lat = "";

        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $lat = $output->results[0]->geometry->location->lat;
        $lng = $output->results[0]->geometry->location->lng;


		$sql = "INSERT INTO location (Name, address, lat, lng, uni) Values ('$eventName', '$address', $lat, $lng, '$uni')"; 

		if($connection->query($sql) == TRUE){
			echo "<script type='text/javascript'>alert('Location Created');</script>";
		}
		else{
			echo "<script type='text/javascript'>alert('Locatoin Creation Failed');</script>"; 
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}
	}

	if(isset($_POST['update'])){

		$eventName = $_POST['eventName']; 
		$eventDes = $_POST['description']; 
		$dateTime = $_POST['e-dateTime'];  
		$phone = $_POST['eventPhone']; 
		$email = $_POST['eventEmail']; 
		$category = $_POST['category']; 
		$userID = $_SESSION['id']; 

		$sql = "UPDATE Event SET 
			Description = '" . $eventDes ."', 
			DateTime = '" . $dateTime ."', 
			Category = '" . $category ."', 
			Contact_phone = '" . $phone ."', 
			Contact_email = '" . $email ."', 
			WHERE Name = '" . $eventName . "'";

		if($connection->query($sql) == TRUE){
			echo "<script type='text/javascript'>alert('Event Updated');</script>";
		}
		else{
			echo "<script type='text/javascript'>alert('Event Update Failed');</script>"; 
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}
	}

	if(isset($_POST['delete']))
	{
		 
		$eventName = $_POST['eventName']; 

		$sql = "DELETE FROM University WHERE name = '$eventName'"; 

		if($connection->query($sql) == TRUE){
			echo "<script type='text/javascript'>alert('Event Delete Successful');</script>";
		}else{
			echo "<script type='text/javascript'>alert('Event Delete Failed');</script>";
			echo "Error " . $sql . "<br>" . "Error: " . mysqli_error($connection) . "<br>";
		}
	}

	mysqli_close($connection); 

	if($_SESSION['admin'] == true)
		header('Location: Admin.php');
	else
		header('Location: Student.php');
?>