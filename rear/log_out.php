<?php

	if(isset($_COOKIE["Generic-Login"]))

	{

					require_once "../database/connect.php";

					$userid=$_COOKIE["Generic-Login"];

					//$db->query("insert into accesslog values ('$userid',now(),'D','Logged Out')") or die($db->error);


					setcookie("Generic-Login", '', time()-3600); 

					//if(session_is_registered('username')){

					session_unset();

					session_destroy();

//} 

	}

				header("Location:index.php");	







?>