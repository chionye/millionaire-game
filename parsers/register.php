<?php
	$full_name = (isset($_POST['full_name']))? sanitize($_POST['full_name']): '';
	$reg_address = (isset($_POST['reg_address']))? sanitize($_POST['reg_address']): '';
	$reg_email = (isset($_POST['reg_email']))? sanitize($_POST['reg_email']): '';
	$phone_number = (isset($_POST['phone_number']))? sanitize($_POST['phone_number']): '';
	$reg_password = (isset($_POST['reg_password']))? sanitize($_POST['reg_password']): '';
	$city = (isset($_POST['city']))? sanitize($_POST['city']): '';
	$state = (isset($_POST['state']))? sanitize($_POST['state']): '';
	$country = (isset($_POST['country']))? sanitize($_POST['country']): '';
	$reg_password2 = (isset($_POST['reg_password2']))? sanitize($_POST['reg_password2']): '';
	$errors = [];
	$required = ['full_name','reg_email','reg_password','reg_password2', 'reg_address', 'city', 'state', 'country'];
	if(isset($_POST['reg_submit'])){
		$email_fetch = $db->query("SELECT * FROM customer WHERE email='{$reg_email}'");
		if($email_fetch->num_rows > 0){
			$errors[] = 'Email already exists. Login or use another';
		}
		foreach($required as $field){
			if(empty($_POST[$field])){
				$errors[] = 'You must fill out all fiels.';
				break;
			}
		}
		if(!filter_var($reg_email, FILTER_VALIDATE_EMAIL)){
			$errors[] = 'You must enter a valid email.';
		}
		if(strlen($reg_password) < 6){
			$errors[] = 'Your password must be up to six characters or more';
		}
		if(strlen($reg_password2) < 6){
			$errors[] = 'Your Confirm password must be up to six characters or more';
		}
		if($reg_password !== $reg_password2){
			$errors[] = "Your two passwords do not match";
		}

		if(!empty($errors)){
			echo display_errors($errors);
		}
		else{
			$hashed = md5($reg_password);
			$regQ = $db->query("INSERT INTO customer (transcid, customerid, customername, contact, address, address2, city, state, zipcode, country, telephone, telephone1, email, website, fax, sales_tax_code, latlng, customer_since, wid, warehouse, ship_to_name, ship_to_address1, ship_to_address2, ship_to_city, ship_to_state, ship_to_zipcode, ship_to_country, ship_to_sales_tax_code, publish, type, inactive, prospect, picture, referal, sales_representative_id, gl_sales_account, ship_via, pricing_level, use_standard_terms, cod_terms, prepaid_terms, terms_type, due_days, discount_days, discount_percent, credit_limit, charge_finance_charges, due_month_end_terms, cardholder_name, credit_card_address1, credit_card_address2, credit_card_city, credit_card_state, credit_card_zip_code, credit_card_country, credit_card_number, credit_card_expiration_date, current_balance, punit, created_by, clientid, customer_password) VALUES (NULL,NULL, '$full_name', NULL, '$reg_address', NULL, '$city','$state','','$country', '$phone_number',NULL,'$reg_email',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$full_name','$reg_address',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$hashed')");
			if($regQ){
				sub($reg_email);
			}else{
				echo $db->error;
			}
		}
	}
	?>