<?php 
include '../database/connect.php';
$output = "";
if (isset($_POST['send'])){
$id = $_COOKIE['uid'];
$name = $_POST['name'];
$sub = $_POST['subject'];
$mess = $_POST['message'];

$sql = $db->query("INSERT INTO message(s_name, r_name, subject, message, status, sid, rid)VALUES('$name', 'admin', '$sub', '$mess', 'unread', '$id', '0')");
if ($sql == true) {
	$output = 'ok';
	echo $output;
}else{
	$output = 'message not sent';
	echo $output;
}
}elseif(isset($_POST['go'])){
$name = $_POST['name'];
$sub = $_POST['subject'];
$mess = $_POST['message'];

$sql = $db->query("SELECT * FROM customer WHERE customername = '$name'");
if ($sql->num_rows > 0) {
$row = $sql->fetch_assoc();
$id = $row['cId'];
$sqli = $db->query("INSERT INTO message(s_name, r_name, subject, message, status, sid, rid)VALUES('admin', '$name', '$sub', '$mess', 'unread', '0', '$id')");
if ($sqli == true) {
	$output = 'ok';
	echo $output;
}else{
	$output = 'message not sent';
	echo $output;
}
}
}elseif(isset($_POST['cash'])){
$id = $_COOKIE['uid'];
$bank = $_POST['bank'];
$accnum = $_POST['accnum'];
$amount = $_POST['amount'];

$sql = $db->query("SELECT * FROM customer WHERE cId = '$id'");
if ($sql == true) {
	$row = $sql->fetch_assoc();
	$name = $row['customername'];
	$sub = "Cash Out Order";
	$mess = $name." has requested a cashout of ".$amount." using the following details ".$bank.", ".$accnum;
	$sql = $db->query("INSERT INTO message(s_name, r_name, subject, message, status, sid, rid)VALUES('$name', 'admin', '$sub', '$mess', 'unread', '$id', '0')");
if ($sql == true) {
	$output = 'ok';
	echo $output;
}else{
	$output = 'message not sent';
	echo $output;
}
}

}
?>