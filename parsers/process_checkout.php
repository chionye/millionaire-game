<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'quipbuy/database/connect.php';
	$fname = sanitize($_POST['fname']);
	$address1 = sanitize($_POST['address1']);
	$address2 = sanitize($_POST['address2']);
	$city = sanitize($_POST['city']);
	$state = sanitize($_POST['state']);
	$phone = sanitize($_POST['phone']);
	$country = sanitize($_POST['country']);
	$errors = [];
	$required = array('fname'=>'Full name','address1'=>'Address','city'=>'City',
		'state'=>'State','phone'=>'Phone number','country'=>'Country');

	foreach ($required as $f=>$d){
		if(empty($_POST[$f])){
			$errors[] = $d.' is required';//"All fields with asterics(*) is required";
			// break;
		}
	}
	if(!empty($errors)){
		echo display_errors($errors);
	}else{
		$db->query("UPDATE customers SET customer_address1='$address1', customer_address2='$address2', customer_city='$city', customer_state='$state', customer_country='$country' WHERE id='{$user_id}'");
		echo "passed";
	}