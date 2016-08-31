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
	<title>Create RSO</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="container">
		<form method="post" action = "RSO.php">

			<h2>Create RSO</h2>

			<hr />

			Name: 
				<input type = "textbox" name = "name">

			<br />
			<br />

			Description: 
				<input type="textArea" name = "description" rows = "4" cols = "30">

			<br />
			<br />

			Student Emails: 

			<br />
			<br />

			Email 1: 
				<input type = "textbox" name = "email-1">

			<br />
			<br />

			Email 2: 
				<input type = "textbox" name = "email-2">

			<br />
			<br />

			Email 3: 
				<input type = "textbox" name = "email-3">

			<br />
			<br />

			Email 4: 
				<input type = "textbox" name = "email-4">

			<br />
			<br />

			Email 5: 
				<input type = "textbox" name = "email-5">


			<br />
			<br />

			<input type = "submit" name="create" value="Create">

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