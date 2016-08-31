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
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<h1>Welcome Back</h1>

	<br />

	What would you like to do?
	
	<br />
	<br />

	<ul class="navbar">
	<li><a href="UniversityForm.php">Create University</a><br /><br /></li>

	<li><a href="SelectUniversity.php">Edit University</a><br /><br /></li>

	<li><a href="SelDelUni.php">Delete University</a><br /><br /></li>
	
	<li><a href = "login.php">Logout</a></li>
	</ul>
	<
</body>
</html>