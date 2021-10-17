<?php
function getUsername($id)
{
	require "../database/connect.php";
	$query="select username from users where id='$id'";
	$function_result=$db->query($query) or die($db->error);
	list($function_user_name)=$function_result->fetch_row();
	return $function_user_name;
}	
	if(isset($_COOKIE["Generic-Login"]))
	{
	  $id=$_COOKIE["Generic-Login"];
	  require_once "../database/connect.php";
	  $users_count=0; $check=array();
	  $query="select name,roledesc from users as t1 inner join roles as t2 on t2.roleid=t1.roleid where t1.id='$id'";
	  $result=$db->query($query) or die($db->error);
	  if($row=$result->fetch_assoc())
	  {
		  $login_name=$row["name"];
		  if(!empty($row["roledesc"]))
		  {
			  $ck=explode(",",$row["roledesc"]);
			  foreach($ck as $k => $v)
			  {
				if(empty($v)) continue;
				$p=explode(':',$v);
				if(!empty($p[1]))$check[$p[0]][$p[1]]=1;
			  }
		  }
	  }else { header("Location:index.php?msg=Access Denied"); die(); }
	  $result->free();
	} else { header("Location:index.php"); die(); }
?>