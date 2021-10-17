
	<?php 
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$db = mysqli_connect("localhost","root","", "quiz") or die ("couldn't connect to database");
}else{
	$db = mysqli_connect("localhost","dndcxvbe_user","dnd@2020?","dndcxvbe_db") ;
}
	$sql = $db->query("select terms_type from admin where cId = '1'")->fetch_assoc(); 
				    $msg = $sql['terms_type'];
				?>
				<?=$msg?>