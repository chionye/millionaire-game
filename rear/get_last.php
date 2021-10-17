<?php

function getlast($type)

{

	//require "../database/connect.php";
	global $db;
	 $function_verge_name=0;

	$query="select  number from file_count where type='$type' limit 1";

	$function_result=$db->query($query) or die($db->error);

	list($func)=$function_result->fetch_row();

	if(empty($func))

	{

		$db->query("insert into file_count set number=1, type='$type'") or die($db->error);

	}else $db->query("update file_count set number=number +1 where type='$type'") or die($db->error);

	

	return $func +1;

}

?>