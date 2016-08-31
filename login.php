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
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="container">
	<h2>Login</h2>
	<hr />
	<form method="post" action="checkLogin.php">
		E-mail: 
		<input type="text" name="email"> <br /><br />

		Password: 
		<input type="password" name="password"> <br /><br />

		<input type="submit" name="submit" value="Login"> <br /><br />
	</form>

	<form method="post" action="register.php">
		<input type="submit" name="register" value="register">		
	</form>
	</div>
</body>
</html>