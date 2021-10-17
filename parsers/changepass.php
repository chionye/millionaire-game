<?php 
if (isset($_POST['change'])) {
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	if ($pass1 != $pass2) {
		echo "passwords do not match";
	}else{
		if (strlen($pass1) < 6) {
			echo "passwords must be more than 5 characters";
		}else{
			$sql = $db->query("UPDATE customer SET customer_password = '$pass1' WHERE email = '$email'") or die($db->error);
			if ($sql == true) {
				$loginQ=$db->query("SELECT * FROM customer WHERE customer_password='$pass1' AND email = '$email'"); 
				$fetch = $loginQ->fetch_assoc();
				$user_id = $fetch ['cId'];
				if (empty($remember_me)) {
				$remember_me = 'off';
			}
				$_SESSION['SBUser'] = $user_id;
				$date = date("Y-m-d H:i:s");
				$db->query("UPDATE customer SET last_login='$date' WHERE cId='$user_id'");
				header('refresh:5; url=index.php');
				echo "password changed successfully, you are now being logged in";
				//custLogin($user_id, $remember_me);
			}
		}
	}
}
?>