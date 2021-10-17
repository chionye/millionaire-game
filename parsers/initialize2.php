<?php
	require_once '../database/connect.php';
	include '../paystack/src/Paystack.php';
	include '../paystack/src/autoload.php';
//if ($_SERVER['REQUEST_URI'] == 'fund.php') {
 if (isset($_GET['package'])) {
 if ($_GET['package'] == 'silver') {
	$amount = 1000;
}elseif ($_GET['package'] == 'gold') {
	$amount = 1500;
}elseif ($_GET['package'] == 'diamond') {
	$amount = 2000;
}else{
	echo "<script>window.location.replace('fund.php')</script>";
}	
	$type = $_GET['package']." package";
 	$gs=json_decode(get_cust());
    //$citems=json_decode(display_cart()); 
        //dnd($citems);
    $email = $gs->cout_email;
    $cid = $gs->cout_tid;
    $stack_amount = (int)$amount.'00';  // N30000 the amount in kobo. This value is actually NGN 300
    $fname = $gs->cout_fname;
    $telephone = $gs->cout_phone;
    // echo $cid;die();
//	echo $stack_amount;
//	die();
	// $str = '';
	$sign = -1;
	$cartStrings = '';
	$itemArray=[];
	$it_id = '';
	$tracker=0;
	$count = 1;
	// foreach( as $ct){
	// 	$count++;
	// }
	

	$sub_total = $tracker*$citems->sub_total;
	//$cartStrings = rtrim($cartStrings,', ');
	$curl = curl_init();
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		curl_setopt($curl, CURLOPT_CAINFO, 'C:/wamp64/www/ammony/includes/paystack/cacert.pem');
	}
	// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
	// url to go to after payment
	$callback_url = '../rear/processTrans.php';  // http://127.0.0.1/ quipbuy/rear/processTrans.php
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => "POST",	
		CURLOPT_POSTFIELDS => json_encode([
		    'amount'=>$stack_amount,
		    'email'=>$email,
		    'callback_url'=>$callback_url,
		    "metadata" => [
			 	"cust_id"=>$cid,
			 	"custom_fields"=>[
				    [
				      "display_name"=>'Name',
				      "variable_name"=>'cout_name',
				      "value"=>$fname
				    ],
				    [
				      "display_name"=>'Phone Number',
				      "variable_name"=>'cout_phone',
				      "value"=>$telephone
				    ],
				    [
				      "display_name"=>"Cart Items",
				      "variable_name"=>"cart_items",
				      "value"=>$type
				    ]
			    ]
			]
		]),
		CURLOPT_HTTPHEADER => [
	    	"authorization: Bearer sk_test_552f2141816852268c1a50b0f116ecfa282db5d2", // Bearer PAYSTACK_PUBLIC, //replace this with your own test key
	    	"content-type: application/json",
	    	"cache-control: no-cache"
		],
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	if($err){
	  die('Curl returned error: ' . $err);
	}
	$tranx = json_decode($response);
	//print_r($tranx); die();
	if(!$tranx->status){
	  print_r('API returned error: ' . $tranx->message);
	  die();
	}else{
		$cartArray = array(
			'customer' => $fname, 
			'cid' => $cid, 
			'sign' => $sign,
			'telephone' => $telephone,
			'count' => $count,
			'email' => $email,
			'address' => $address,
			'amount' => $stack_amount
			
		);

		foreach($itemArray as $k=>$v)
		{
			$cartArray[$k]=$v;
		}
		// echo $count;die();
		$_SESSION["user".$user_id] = $cartArray;
		//print_r($_SESSION); die();
	    header('Location: ' . $tranx->data->authorization_url);
	}
	}else{
		echo "<script>window.location.replace('../fund.php')</script>";
	}