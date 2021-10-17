<?php
session_start();
	//$user_id = "";
if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$db = mysqli_connect("localhost","root","", "quiz") or die ("couldn't connect to database");
}else{
	$db = mysqli_connect("localhost","dndcxvbe_user","dnd@2020?","dndcxvbe_db") ;
}


$cart_items = '';
if(isset($_COOKIE['myShoppingCart'])){
	$cart_items = $_COOKIE['myShoppingCart'];
}
$_color=array("green","yellow darken-4","red","blue darken-3","cyan darken-3","teal darken-4");
$_color_count=count($_color);

if(isset($_SESSION['success_flash'])){
	$smsg = '<div class="bg-success"><p class="text-white text-center">'.$_SESSION['success_flash'].'</p></div>';
	unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])){
	$smsg = '<div class="bg-warning"><p class="text-white text-center">'.$_SESSION['error_flash'].'</p></div>';
	unset($_SESSION['error_flash']);
}

if(isset($_SESSION['SBUser'])){
	$user_id = $_SESSION['SBUser'];
}

	// function s_msg($message=''){
	// 	$_SESSION['success_flash']=$message;
	// 	$s = $_SESSION['success_flash'];
	// 	return $s;
	// }
function toasts($value = ''){
	echo "<div class='alert alert-success alert-dismissible'>";
	echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
	echo "<strong>".$value."</strong>";
	echo "</div>";
}
	// function e_msg($message=''){
	// 	$_SESSION['error_flash'] = $message;
	// 	$v = $_SESSION['error_flash'];
	// 	return $v;
	// }
if(isset($_COOKIE['uid'])){
	$user_id = $_COOKIE['uid'];
	$uQ = $db->query("SELECT * FROM customer WHERE cId='{$user_id}'");
	$user_data = $uQ->fetch_assoc();
	$username = $user_data['customername'];
	$fn = explode(' ', trim($user_data['customername']));
	$user_data['first'] = $fn[0];
	if(empty($fn[1])){
		$fn[1] = $fn[0];
	}
	$user_data['last'] = $fn[1];
}
if(isset($_COOKIE['admin'])){
	$user_id = $_COOKIE['admin'];
	$uQ = $db->query("SELECT * FROM admin WHERE cId='{$user_id}'");
	$user_data = $uQ->fetch_assoc();
	$adminname = $user_data['customername'];
	$fn = explode(' ', trim($user_data['customername']));
	$user_data['first'] = $fn[0];
	if(empty($fn[1])){
		$fn[1] = $fn[0];
	}
	$user_data['last'] = $fn[1];
}
include 'helpers.php';