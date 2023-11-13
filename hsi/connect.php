<!-- Connection to Database -->
<?php
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "hsi";
	
	// Create a connection
	$connect = new mysqli($hostname, $username, $password, $database);
	
	// Check connection
	if ($connect->connect_error) {
		die("Connection failed: " . $connect->connect_error);
	}
?>