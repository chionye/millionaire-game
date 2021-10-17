<?php 
	include 'database/connect.php';
	$pass = "email@admin";
	$hash = password_hash($pass, PASSWORD_DEFAULT);
echo $hash;
 ?>
