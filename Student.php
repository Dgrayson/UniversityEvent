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

	<h2>Welcome Back</h2>
	<br />
	<br />

	What would you like to do?
	<br />
	<br />

	<ul class="navbar">
	<li><a href = "ViewRSO.php">View RSO's</a>
	<br />
	<br />
	<li><a href = "CreateEvent.php">Create Event</a>
	<br />
	<br />
	<li><a href = "viewEvent.php">View Events</a>
	<br />
	<br />
	<li><a href = "login.php">Logout</a>
	</ul>
</body>
</html>