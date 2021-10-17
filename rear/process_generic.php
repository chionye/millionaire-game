<?php
$source_count=0; $extras="";$fixed_values = '';
require_once __DIR__."/../database/connect.php";
require_once "table_func.php";
require_once "select_page.php";

adv_extract($_POST); 
if(!empty($extra_values)) $extra_values =",".$extra_values; else $extra_values='';			
if(!empty($fixed_values)) {$fixed_values =$extra_values.",".$fixed_values;}			
if(!empty(${$primary_key})) {
if(!empty($_COOKIE['Generic-AccessLevel']) && $_COOKIE['Generic-AccessLevel']>=2)
	{	 
	  $table_fields=getFields($table);
		
			$col=""; $val =""; $c=0;
			foreach($_POST as $k => $v)
			{
 				if(array_search(strtolower($k),$table_fields) !==false)
				{
				  if($c)
				  {
					  $col .=",";
					  $val .=",";
				  }
				  $v=$db->real_escape_string($v);
				  $col .="$k='{$v}'";
				  $value[]=$v;
				  $key[]=$k;
				  $c++;
				}
			}
			
			$query="update $table set $col $extra_values where $primary_key='${$primary_key}'";
			$db->query($query) or die($db->error);
			$id=${$primary_key};
	}else $id=0;
} else
{if(!empty($_COOKIE['Generic-AccessLevel']) && $_COOKIE['Generic-AccessLevel']>=1)
	{	 
	  $table_fields=getFields($table);	
			$col=""; $val =""; $c=0;
			foreach($_POST as $k => $v)
			{
 				if(array_search(strtolower($k),$table_fields) !==false && strtolower($k) !=strtolower($primary_key))
				{
				  if($c)
				  {
					  $col .=",";
					  $val .=",";
				  }
				  $col .="$k";
				  $val .="'".$db->real_escape_string($v)."'";
				  $col2[] ="$k="."'".$db->real_escape_string($v)."'";
				  $value[]=$v;
				  $key[]=$k;
				  $c++;
				}
			}
			$colstr=implode(",",$col2);
			
			if(!empty($transcid))
			{
				$query="insert into $table set transcid=concat(unix_timestamp(),round((rand() * 100) * (rand() * 100) )),$colstr $fixed_values";
			} else $query="insert into $table set $colstr $fixed_values";
			//die($query);
			$db->query($query) or die($db->error);
			
			$result=$db->query("select $primary_key from $table order by $primary_key desc limit 1 ") or die($db->error);
			$row=$result->fetch_row();
			$id=$row[0];
			
			
	}else $id=0;		
	
}
	
echo $id;
?>