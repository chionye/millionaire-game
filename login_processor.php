<?php
include 'database/connect.php';
if(isset($_POST['log'])){
	$login_email = (isset($_POST['email']))?sanitize($_POST['email']):'';
	$login_pass = (isset($_POST['pass']))?sanitize($_POST['pass']):'';
	$required = ['email','pass'];
	$output = "ok";
	foreach($required as $field){
		if(empty($_POST[$field])){
			$output = 'Your email and password must be provided';
			echo $output;
			break;
		}
	}
	if($output == "ok"){
		$loginQ=$db->query("SELECT * FROM customer WHERE email='{$login_email}'"); 
		$fetch = $loginQ->fetch_assoc();
		if((!$loginQ->num_rows > 0 && !empty($login_email)) || (!password_verify($login_pass, $fetch['customer_password'])) && !empty($login_pass)){
			$output = "Your email or password is incorrect";
			echo $output;
		}else{
			$user_id= $fetch['cId'];
			$name= $fetch['customername'];
			$date = date("Y-m-d H:i:s");
			$sql = $db->query("UPDATE customer SET last_login='$date' WHERE cId='$user_id'");
			if ($sql == true) {
				$cookiename = "uid";
				setcookie($cookiename, $user_id, time() + (60*60*24*30), "/");
				$output = "ok";
				echo $output;
			}else{
				$output = "Login failed";
				echo $output;
			}

		}
	}
}
if (isset($_POST['admin'])) {
	$login_email = (isset($_POST['email']))?sanitize($_POST['email']):'';
	$login_pass = (isset($_POST['pass']))?sanitize($_POST['pass']):'';
	$required = ['email','pass'];
	$output = "ok";
	foreach($required as $field){
		if(empty($_POST[$field])){
			$output = 'Your email and password must be provided';
			echo $output;
			break;
		}
	}
	if($output == "ok"){
		$loginQ=$db->query("SELECT * FROM admin WHERE customerid='{$login_email}'"); 
		$fetch = $loginQ->fetch_assoc();
		if((!$loginQ->num_rows > 0 && !empty($login_email)) || (!password_verify($login_pass, $fetch['customer_password'])) && !empty($login_pass)){
			$output = "Your email or password is incorrect";
			echo $output;
		}else{
			$user_id= $fetch['cId'];
			$name= $fetch['customername'];
			$date = date("Y-m-d H:i:s");
			$sql = $db->query("UPDATE admin SET last_login='$date' WHERE cId='$user_id'");
			if ($sql == true) {
				$cookiename = "admin";
				setcookie($cookiename, $user_id, time() + (60*60*24*30), "/");
				$output = "ok";
				echo $output;
			}else{
				$output = $db->error;
				echo $output;
			}

		}
	}
}
?>