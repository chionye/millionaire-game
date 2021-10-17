<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/ammony/database/connect.php';

	$mode = sanitize($_POST['mode']);
	$edit_id = (int)sanitize($_POST['edit_id']);
	$item_size = (int)sanitize($_POST['item_size']);
	$updated= array();
	$domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']: false);
	if(isset($_COOKIE['CART_COOKIE'])){
		$cart_items = json_decode($_COOKIE['CART_COOKIE'],true);
		if($mode == 'addone'){
			$add = 1;
			$addon = $cart_items[$edit_id]+1;
			if($addon > $item_size){
				echo "more_than_stored";
			}else{
				$cart_items[$edit_id]++;
			}
		}else if($mode == 'removeone'){
			$minus = $cart_items[$edit_id]-1;
			if($minus < 1){
				echo "lesser";
			}else{
				$cart_items[$edit_id]--;
			}
		}
		$cart_items=json_encode($cart_items);
		setcookie('CART_COOKIE', $cart_items, CART_COOKIE_EXPIRE, '/', $domain);
	}









































// $db->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE id='{$cart_id}'");
// 		setcookie(CART_COOKIE,'',1,"/",$domain,false);
// 		setcookie(CART_COOKIE,$cart_id, CART_COOKIE_EXPIRE,"/",$domain, false);

