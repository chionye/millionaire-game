<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/quipbuy/database/connect.php';

	$login_email = (isset($_POST['tp_email']))?sanitize($_POST['tp_email']):'';
	$login_pass = (isset($_POST['tp_pass']))?sanitize($_POST['tp_pass']):'';
	$remember_me = (isset($_POST['tp_remember_me']))?sanitize($_POST['tp_remember_me']):'';
	$required = ['tp_email','tp_pass'];
	$errors = [];
		$loginQ=$db->query("SELECT * FROM customers WHERE customer_email='{$login_email}'");
		$fetch = $loginQ->fetch_assoc();
		if((!$loginQ->num_rows > 0 && !empty($login_email)) || (!password_verify($login_pass, $fetch['customer_password']) && !empty($login_pass))){
			$errors[] = "Your email or password is incorrect.";
			
		}
		if(strlen($login_pass)<6 && !empty($login_pass)){
			$errors[] = 'Your password must be at least 6 characters';
		}

		if(!password_verify($login_pass, $fetch['customer_password'])){
			$errors[]='Incorect password';
		}

		if(!empty($errors)){
			echo display_errors($errors);
		}
		else{
			// if(!empty($remember_me)){
				// echo "Remember me = True";die();
				// setcookie($login_email);
			// }
			$user_id= $fetch['id'];
			tp_custLogin($user_id);
			echo "tp_form_validated";
		}
