<?php

	require_once "../database/connect.php";
	require_once "get_company_info.php";
	require_once "get_last.php";
	require_once "get_default_account.php";
	require_once "table_func.php";
	require_once "sms_functions.php";
	require_once "updater.php";

	$curl = curl_init();
	$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
	if(!$reference){
	  die('No reference supplied');
	}
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		curl_setopt($curl, CURLOPT_CAINFO, 'C:/wamp64/www/ammony/includes/paystack/cacert.pem');
	}
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_HTTPHEADER => [
	    "accept: application/json",
	    "authorization: Bearer sk_test_552f2141816852268c1a50b0f116ecfa282db5d2", // Bearer sk_test_36658e3260b1d1668b563e6d8268e46ad6da3273+
	    "cache-control: no-cache"
	  ],
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	if($err){
	    // there was an error contacting the Paystack API
	  die('Curl returned error: ' . $err);
	}
	$tranx = json_decode($response);
	if(!$tranx->status){
	  // there was an error from the API
	  die('API returned error: ' . $tranx->message);
	}
	
	if('success' == $tranx->data->status){
		  // transaction was successful...
		  // please check other things like whether you already gave value for this ref
		  // if the email matches the customer who owns the product etc
		  // Give value

		extract($_SESSION['user'.$user_id], EXTR_OVERWRITE);

		foreach( $_SESSION['user'.$user_id] as $k=> $v){
			$_POST[$k]=$v;
		}
		$_SESSION['user'.$user_id]['reference']=$reference;

						// ____________________ val redirect __________
				 // $_SESSION['user'.$user_id] = array();
				
				header('Location: ../thankYou.php?ref='.$reference);


		}

?>