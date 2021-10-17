<?php
include 'database/connect.php';
$output = "";
if (isset($_POST['register'])) {
	$full_name = (isset($_POST['name']))? sanitize($_POST['name']): '';
	$reg_email = (isset($_POST['email']))? sanitize($_POST['email']): '';
	$phone_number = (isset($_POST['phone']))? sanitize($_POST['phone']): '';
	$reg_password = (isset($_POST['pass']))? sanitize($_POST['pass']): '';
	$reg_password2 = (isset($_POST['pass2']))? sanitize($_POST['pass2']): '';
	$referrer = (isset($_POST['ref']))? sanitize($_POST['ref']):'';
	//$required = ["name"=> $full_name, "First-password"=>$reg_password,"email"=>$reg_email,"second-password"=>$reg_password2];
	$email_fetch = $db->query("SELECT * FROM customer WHERE email='{$reg_email}'");
	if($email_fetch->num_rows > 0){
		$output = "account already exists";
		echo $output;
	}else{
		if($full_name =='' && $reg_email == '' && $phone_number == '' && $reg_password == '' &&  $reg_password2 == ''){
			$output = "field cannot be empty";
			echo $output;
		}else{	
			if(!filter_var($reg_email, FILTER_VALIDATE_EMAIL)){
				$output = "not a valid email";
				echo $output;
			}else{
				if(strlen($reg_password) < 6){
					$output = $reg_password.' Your password must be up to six characters or more ';
					echo $output;
				}
				if(strlen($reg_password2) < 6){
					$output = $reg_password2.' Your Confirm password must be up to six characters or more';
					echo $output;
				}else{	
					if($reg_password != $reg_password2){
						$output = "passwords do not match";
						echo $output;
					}else{
						$hashed = password_hash($reg_password, PASSWORD_DEFAULT);
						$regQ = $db->query("INSERT INTO customer (transcid, customerid, customername, contact, address, address2, city, state, zipcode, country, telephone, telephone1, email, website, fax, sales_tax_code, latlng, customer_since, wid, warehouse, ship_to_name, ship_to_address1, ship_to_address2, ship_to_city, ship_to_state, ship_to_zipcode, ship_to_country, ship_to_sales_tax_code, publish, type, inactive, prospect, picture, referal, sales_representative_id, gl_sales_account, ship_via, pricing_level, use_standard_terms, cod_terms, prepaid_terms, terms_type, due_days, discount_days, discount_percent, credit_limit, charge_finance_charges, due_month_end_terms, cardholder_name, credit_card_address1, credit_card_address2, credit_card_city, credit_card_state, credit_card_zip_code, credit_card_country, credit_card_number, credit_card_expiration_date, current_balance, punit, created_by, clientid, customer_password, last_login) VALUES (NULL,NULL, '$full_name', NULL, NULL, NULL, NULL,NULL,'',NULL, '$phone_number',NULL,'$reg_email',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$full_name',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$hashed','')");
						if($regQ == true){
							$sub = $db->query("INSERT INTO subscribers (email) VALUES ('$reg_email')");
							if ($sub == true) {
								$sql = $db->query("SELECT * FROM customer WHERE email = '$reg_email'");
								if ($sql->num_rows > 0) {
									$row = $sql->fetch_assoc();
									$id = $row['cId'];
									$name = $row['customername'];
									$fname = explode(' ', $name);
									$names = !empty($fname[0])?$fname[0]:$fname[1];
									$ref = $names.''.$id;
									$sql = $db->query("UPDATE customer set transcid = '$ref' WHERE email = '$reg_email'");
									if (empty($referrer)) {
										$cookiename = "uid";
										setcookie($cookiename, $id, time() + (60*60*24*30), "/");
										$output = "ok";
										echo $output;
									}else{
										$sql = $db->query("SELECT * FROM customer WHERE transcid = '$referrer'");
										if ($sql->num_rows > 0) {
											$sql = $db->query("INSERT INTO referals(newCustomer_id, ref_id,ref_bonus, status) VALUES('$id','$referrer',0, 'pending')");
											if ($sql) {
												$cookiename = "uid";
												setcookie($cookiename, $id, time() + (60*60*24*30), "/");
												$output = "ok";
												echo $output;
											}else{
												$output = $db->error;
												echo $output;
											}
										}else{
											$sql = $db->query("DELETE FROM customer WHERE cId = '$id'");
											$output = "you entered a wrong referrer id";
											echo $output;
										}
									}
								}
							}
						}else{
							$output = $db->error;
							echo $output;
						}
					}
				}
			}
		}
	}
}
if (isset($_POST['update'])) {
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$id = $_COOKIE['uid'];

	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		$sql = $db->query("UPDATE customer SET telephone = '$phone', email = '$email' WHERE cId = '$id'");
		if ($sql == true) {
			$output = "ok";
			echo $output;
		}else{
			$output = "update failed";
			echo $output;
		}
	}else{
		$output = "Email invalid";
		echo $output;
	}
}

if(isset($_POST['changepass'])){
	$pass1 = $_POST['pass'];
	$pass2 = $_POST['pass2'];
	$id = $_COOKIE['uid'];
	if (strlen($pass1) < 6 || strlen($pass2) < 6){
		$output = "password must be more than 5 characters";
		echo $output;
	}else{
		if($pass1 != $pass2){
			$output = "passwords do not match";
			echo $output;
		}else{
			$hashed = password_hash($pass1, PASSWORD_DEFAULT);
			$sql = $db->query("UPDATE customer SET customer_password = '$hashed' WHERE cId = '$id'");
			if ($sql == true) {
				$output = "ok";
				echo $output;
			}else{
				$output = "update failed";
				echo $output;
			}

		}
	}
}
if (isset($_POST['update_user'])) {
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$package = $_POST['package'];
	$balance = $_POST['balance'];
	$id = $_POST['id'];
	$ref = $_POST['ref'];

	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		$sql = $db->query("UPDATE customer SET customername = '$name', email = '$email', telephone = '$phone', type = '$package', current_balance = '$balance', clientid='$ref' WHERE cId = '$id'");
		if ($sql == true) {
			$output = "ok";
			echo $output;
		}else{
			$output = "update failed";
			echo $output;
		}
	}else{
		$output = "Email invalid";
		echo $output;
	}
}


?>
