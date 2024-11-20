<?php
	$db_host = 'localhost';
	$db_name = 'quiz';
	$db_user = 'root';
	$db_pass = 'root';
	$conn = new mysqli($db_host,$db_user,$db_pass,$db_name);
	if($conn->connect_error){
		printf("Connect failed: %s\n",$conn->connect_error);
		exit;
	}
?>
