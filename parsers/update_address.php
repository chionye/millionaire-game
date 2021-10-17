<?php 
		if (isset($_POST['submit'])) {
		$id = $_POST['id'];
		$address = $_POST['address'];
		
		$sql = $db->query("UPDATE customer SET shipping_address = '$address' WHERE id = '$id'");
		if ($sql == true){
			toasts("Success");
		}else{
			echo $db->error;
		}
		}
?>