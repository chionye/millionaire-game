<?php 
	include_once 'database/connect.php';
if (isset($_POST['signup'])) {

	$full_name = $_POST['full_name'];
	$reg_address = $_POST['reg_address'];
	$reg_email = $_POST['reg_email'];
	$phone_number = $_POST['phone_number'];
	$reg_password = $_POST['reg_password'];
	$reg_password2 = $_POST['reg_password2'];

	if($reg_password !== $reg_password2){
			echo "Your two passwords do not match";
	}
	$hashed = password_hash($reg_password, PASSWORD_DEFAULT);
			$regQ = $db->query("INSERT INTO customers (customer_name, customer_email, customer_password, customer_phone_number,customer_address, shipping_address)VALUES('$full_name','$reg_email','$hashed','$phone_number','$reg_address','$reg_address')");
	if ($regQ == true) {
		header('location: /ammony/ammony/index.php');
	}else{
		echo $db->error;
	}
}
?>