<?php 
	require_once('base.php'); 

	if(session_status() == PHP_SESSION_NONE){
		session_start(); 
	}

	$varName = ""; 
	$varDes = ""; 
	$varNum = "";

	if(isset($_POST['edit']) || isset($_POST['delete'])){
		
		$name = $_POST['universities'];
		$sql = "SELECT * FROM University WHERE name = '$name'"; 
		$result = $connection->query($sql); 

		$uni = $result->fetch_assoc();  

		$varName = $uni['Name']; 
		$varDes = $uni['Description']; 
		$varNum = $uni['numStudents']; 
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create University</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="container">
	<form method="post" action="University.php">

		<h2>Create University</h2>

		<hr />
		
		University Name: 
			<input type = "textbox" name = "uniName" <?php if(strlen($varName) > 0) echo 'value = "'. $varName . '"'; ?>>

		<br />
		<br />

		University Description:
			<input type = "textArea" name = "uniDes" <?php if(strlen($varDes) > 0) echo 'value = "'. $varDes . '"'; ?>>
		<br />
		<br />
		Number of Students: 
			<input type = "textbox" name = "numStudents" <?php if(strlen($varNum) > 0) echo 'value = "'. $varNum . '"'; ?>>
		<br />
		<br />
		<input type = "submit" name = "submit" value = "submit">
		<input type = "submit" name = "update" value = "update">
		<input type = "submit" name = "delete" value = "delete">
	</form>

	<br />

	<a href="SuperAdmin.php">Home</a>
	</div>
</body>
</html>