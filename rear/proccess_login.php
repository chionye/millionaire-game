<?php
	$_exception=1; 
	if(isset($_POST["username"]))
	{
		
		require_once "../database/connect.php";
		extract($_POST, EXTR_OVERWRITE);
		$query="select id, name, roleid,accesslevel from users where username = '$username' and password='$password'";
			
		$result=$db->query($query) or die($db->error);
			if($row=$result->fetch_assoc()){
				setcookie("Generic-Login", $row['id'], time()+36000); 
				setcookie("Generic-Login_Name", $row['name'], time()+36000); 
				setcookie("Generic-RoleId", $row['roleid'], time()+36000); 
				setcookie("Generic-AccessLevel", $row['accesslevel'], time()+36000); 
				$userid=$row['id'];
				//$db->query("insert into accesslog values ('$userid',now(),'D','Logged in')") or die($db->error);
				//session_start();
  				//session_register('userid'); 
				header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
				header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
				header("Location:default.php");
				die();
			} else {
				$msg= "Username or password is incorrect";
				header( "Location:index.php?msg=$msg");	
				die();
			}
			$result->free();
			$db->close();
	
	}  else header( "Location:index.php");
	
?>