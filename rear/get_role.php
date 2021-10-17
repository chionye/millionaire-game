<?php

function getUsername($id)

{

	require "../database/connect.php";

	$query="select username from users where userid='$id'";

	$function_result=$db->query($query) or die($db->error);

	list($function_user_name)=$function_result->fetch_row();

	return $function_user_name;

}	

	if(isset($_COOKIE["Generic-Login"]))

	{

	  $id=$_COOKIE["Generic-Login"];

	  require_once "../database/connect.php";

	  $users_count=0;

	  $query="select concat(surname,' ',firstname) as name,(select roledesc from roles as t2 where t2.roleid=t1.roleid) as role from users as t1 where userid='$id'";

	  $result=$db->query($query) or die($db->error);

	  while ($row=$result->fetch_assoc())

	  {

		  $login_name=$row["name"];

		  $check="@".$row["role"];

	  }

	  $result->free();

	} else { header("Location:pushtop.php"); die(); }



?>