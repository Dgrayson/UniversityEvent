<?php 
	require_once('base.php'); 

	if(session_status() == PHP_SESSION_NONE){
		session_start(); 
	}

	$varName = "";
	$varDes = ""; 
	$varDateTime = ""; 
	$varEmail = ""; 
	$varPhone = ""; 

	if(isset($_POST['edit'])  || isset($_POST['delete'])){
		$name = $_POST['events']; 
		$sql = "SELECT * FROM Event WHERE name = '$name'"; 
		$result = $connection->query($sql); 

		$event = $result->fetch_assoc(); 

		$varName = $event['Name']; 
		$varDes = $event['Description']; 
		
		$varEmail = $event['contact_email']; 
		$varPhone = $event['contact_phone'];

		$varDateTime = strftime('%Y-%m-%dT%H:%M:%S', strtotime($event['DateTime']));
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>
	<?php
		if(isset($_POST['delete']))
			echo "Delete Event";
		else
			echo "Create Event";
	?></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="container">
	<form method="post" action="submitEvent.php">

		<h2>Create Event</h2>

		<hr />
		
		Event Name: 
			<input type = "textbox" name = "eventName" <?php if(strlen($varName) > 0) {echo 'value = "'. $varName . '"'; }?>>

		<br />
		<br />

		Event Description:	
			<textarea rows = "5" cols = "30" name="description" <?php if(strlen($varDes) > 0) echo 'value = "'. $varDes . '"'; ?>></textarea>


		<br />
		<br />

		Date/Time: 
			<input type="datetime-local" name = "e-dateTime" <?php if(strlen($varDateTime) > 0) echo 'value = "'. $varDateTime . '"'; ?>>

		<br />
		<br />

		Contact Phone: 
			<input type = "textbox" name = "eventPhone" <?php if(strlen($varPhone) > 0) echo 'value = "'. $varPhone . '"'; ?>>

		<br />
		<br />

		<!--<?php if($_SESSION['failedEmail'] == true) echo "<span style='color: red';>Invalid email Address</span> <br /><br />"; ?>	-->

		Contact Email: 
			<input type = "textbox" name = "eventEmail" <?php if(strlen($varEmail) > 0) echo 'value = "'. $varEmail . '"'; ?>>

		<br />
		<br />

		Address: 
			<input type = "textbox" name = "address">

		<br />
		<br />

		Category:

			<select name="category">
				<option value="Public">Public</option>
				<option value="Private">Private</option>
				<?php if ($_SESSION['admin'] == true) echo '<option value="RSO">RSO</option>'; ?>
			</select> 

			<br />
			<br />

			<?php 
				if ($_SESSION['admin'] == true){
					
					$id = $_SESSION['id'];

					echo 'RSO: ';  

					echo '<select name="rsort(array)">'; 

					$sql = "SELECT Name FROM RSO WHERE AdminID = '$id'"; 
					$result = $connection->query($sql); 

					while($row = $result->fetch_assoc()){
						$name = $row['Name']; 
						echo '<option value = "'. $name .'">'. $name .'</option>';
					}	

					echo '</select>';
				}
			?>

		<br />
		<br />

		<input type = "submit" name = "submit" value = "submit">
		<input type = "submit" name = "update" value = "update">
		<input type = "submit" name = "delete" value = "delete">

		<br /> 
		<br />
		<?php 
			if ($_SESSION['admin'] == true)
				echo '<a href = "admin.php">Home</a>';
			else
				echo '<a href = "student.php">Home</a>';
		?>
	</form>
	</div>
</body>
</html>