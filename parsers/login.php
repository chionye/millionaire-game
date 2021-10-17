<?php
	
	$login_email = (isset($_POST['login_email']) || isset($_POST['tp_email']))?sanitize($_POST['login_email']):'';
	$login_pass = (isset($_POST['login_pass']) || isset($_POST['tp_pass']))?sanitize($_POST['login_pass']):'';
	$remember_me = (isset($_POST['remember_me']) || isset($_POST['tp_remember_me']))?sanitize($_POST['remember_me']):'';
	$required = ['login_email','login_pass'];
	$errors = [];
	if(isset($_POST['login_submit'])){
		foreach($required as $field){
			if(empty($_POST[$field])){
				$errors[] = 'Your email and password must be provided';
				break;
			}
		}
		$loginQ=$db->query("SELECT * FROM customer WHERE email='{$login_email}' LIMIT 1"); 
		$fetch = $loginQ->fetch_assoc();
		if((!$loginQ->num_rows > 0 && !empty($login_email)) || (!password_verify($login_pass, $fetch['customer_password'])) && !empty($login_pass)){
			echo "Your email or password is incorrect.";
			
		}
		if(strlen($login_pass)<6 && !empty($login_pass)){
			echo 'Your password must be at least 6 characters';
		}

		if(strlen($login_pass) < 6 && !empty($login_pass)){
			echo 'Your password must be at least 6 characters';
		}

		// if(!password_verify($login_pass, $fetch['customer_password'])){
		// 	$errors[]='Incorect password';
		// }

		if(!empty($errors)){
			toasts($errors);
		}
		else{
			if (empty($remember_me)) {
				$remember_me = 'off';
			}
			// if(!empty($remember_me)){
				// echo "Remember me = True";
				// setcookie($user_id, $login_email,);
			// }
			$user_id= $fetch['cId'];
			custLogin($user_id, $remember_me);
		}
	}
	?>