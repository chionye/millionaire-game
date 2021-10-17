<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'quipbuy/database/connect.php';
	$product_id = (int)sanitize($_POST['product_id']);
	$quantity = (int)sanitize($_POST['quantity']);
	$available = (int)sanitize($_POST['product_available']);

	$items = [];
	$items[] = [
		'id'=>$product_id,
		'quantity'=>$quantity
	];
	$domain = ($_SERVER['HTTP_HOST'] != 'localhost')? $_SERVER['HTTP_HOST']:false;

	if($cart_id !=''){
		$cartQ = $db->query("SELECT * FROM cart WHERE id='{$cart_id}'");
		$cart_fetch = $cartQ->fetch_assoc();
		$previous_items = json_decode($cart_fetch['items'],true);
		$item_match = 0;
		$new_items = [];
		foreach($previous_items as $pitem){
			if($items[0]['id'] == $pitem['id']){
				$pitem['quantity'] = $pitem['quantity'] + $items[0]['quantity'];
				if($pitem['quantity'] > $available){
					$pitem['quantity'] = $available;
				}
				$item_match = 1;
			}
			$new_items[] = $pitem;
		}
		if($item_match != 1){
			$new_items = array_merge($items, $previous_items);
		}
		$items_json = json_encode($new_items);
		$cart_expire = date("Y-m-d H:i:s", strtotime('+30 days'));
		if(isset($user_id)){
			$user_id = $user_id;
			$db->query("UPDATE cart SET items='{$items_json}', expire_date='{$cart_expire}', customer='{$user_id}' WHERE id='{$cart_id}'");
		}
		else{
			$db->query("UPDATE cart SET items='{$items_json}', expire_date='{$cart_expire}' WHERE id='{$cart_id}'");
		}
		setcookie(CART_COOKIE,'',1,'/',$domain,false);
		setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
	}
	else{
		$items = json_encode($items);
		$cart_expire = date('Y-m-d H:i:s',strtotime('+30 days'));
		$db->query("INSERT INTO cart (items,expire_date)VALUES('$items','$cart_expire')");
		$cart_id = $db->insert_id;
		setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
	}