<?php 

if (isset($_POST['sub'])){
	$id =  $_POST['id'];
	$name = $_POST['name'];
	$address	 = $_POST['address'];
	$phone = $_POST['phone'];

	$sql = $db->query("UPDATE customer SET ship_to_name = '$name', ship_to_address1 = '$address' WHERE cId = '$id'");
	if ($sql == true) {
		toasts('update successful');
	}else{
		$db->error;
	}
}
if (isset($_POST['change'])){
	$id =  $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$sql = $db->query("UPDATE customer SET customername = '$name', address='$address', city = '$city', state = '$state', country = '$country', telephone = '$phone', email = '$email' WHERE cId = '$id'");
	if ($sql == true) {
		toasts('update successful');
	}else{
		$db->error;
	}
	
}

if (isset($_POST['changemobile'])){
	$id =  $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];

	$sql = $db->query("UPDATE customer SET customername = '$name', address='$address', city = '$city', state = '$state', country = '$country', telephone = '$phone', email = '$email' WHERE cId = '$id'");
	if ($sql == true) {
		toasts('update successful');
	}else{
		$db->error;
	}
	
} 
?>