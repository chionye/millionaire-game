<?php
	if (isset($_POST['login_submit'])) {
	
	$login_email = $_POST['login_email'];
	$login_pass = $_POST['login_pass'];
	$remember_me = $_POST['remember_me'];

	$loginQ=$db->query("SELECT * FROM customers WHERE customer_email='{$login_email}'");
		$fetch = $loginQ->fetch_assoc();
		var_dump($fetch);
		if((!$loginQ->num_rows > 0 && !empty($login_email)) || (!password_verify($login_pass, $fetch['customer_password']) && !empty($login_pass))){
			echo $db->error;
		}else{
			header('location: /ammony/ammony/index.php');
		}
		}
?>