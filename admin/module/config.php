<?php 
	$hostname = 'localhost';
	$Username = 'root';
	$password = '';
	$database = 'netflix';

	$con_db = new mysqli($hostname,$Username,$password,$database);
	$con_db->set_charset('utf8');
	include 'function.php';

 ?>