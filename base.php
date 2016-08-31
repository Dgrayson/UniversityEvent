<?php

	// Dont write CSS for this page
	
	session_start(); 

	define("SERVER_NAME", "localhost:3306"); 
	define("USERNAME", "root"); 
	define("PASSWORD", "");
	define("DB_NAME", "eventmanager");

	$connection = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DB_NAME); 

	if(!$connection){
		die("Connection failed!"); 
	}
?>