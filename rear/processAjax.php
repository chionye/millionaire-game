<?php
//Send some headers to keep the user's browser from caching the response.
//die('here');
$_exception=1;
$sort_col="";$sort_col2=""; $ncount;

require_once __DIR__."/../database/connect.php";
require_once "table_func.php";
require_once "get_page_func.php";
require_once "select_page.php";
require_once "get_param.php";

//Create the XML response.
//Check to ensure the user is in a chat room.
//print_r($_POST);
$json=array();
if(isset($new))
{
	 $table_fields=getFields($table);
	 $col=""; $val =""; $ct=0;
	foreach($_GET as $k => $v)
	{
		if(array_search(strtolower($k),$table_fields) !==false)
		{
		  $col[]="`{$k}`='{$v}'";
		}
	}
	foreach($_POST as $k => $v)
	{
		if(array_search(strtolower($k),$table_fields) !==false)
		{
			$col[]="`{$k}`='{$v}'";
		}
	}
	if(!empty($newcol))
	{
		$col[]="`$newcol`='$new'";
	}
	if(!empty($fixed))
	{
		$col[]="$fixed";
	}	
		$colstr=implode(',',$col);
		if(!empty($extras)) $colstr.=','.$extras;
	  $sql = "insert into $table set $colstr";
	  $db->query($sql) or die($db->error.$sql);
	  $sql = "select $primary_key  from $table order by $primary_key desc limit 1";
	  $res=$db->query($sql) or die($db->error.$sql);
	  if($rw=$res->fetch_row()) $json=$rw[0] ; else $json=0;
}else if(isset($_edit))
{
	if(!empty($_COOKIE['Generic-AccessLevel']) && $_COOKIE['Generic-AccessLevel']>=2)
	{
		 $table_fields=getFields($table);
		 $col=""; $val =""; $ct=0;
		foreach($_GET as $k => $v)
		{
			if(array_search(strtolower($k),$table_fields) !==false)
			{
				$col[]="`{$k}`='{$v}'";
			}
		}
		foreach($_POST as $k => $v)
		{
			if(array_search(strtolower($k),$table_fields) !==false)
			{
				$col[]="`{$k}`='{$v}'";
			}
		}	
			$colstr=implode(',',$col);
		  $sql = "update $table set $colstr where $primary_key='$edit'";
		  $db->query($sql) or die($db->error.$sql);
		  $json=$edit;
	}else $json=0;
} else if(isset($id))
{
	$sql = "SELECT * FROM $table where $primary_key = '$id'";
		//echo $sql;
	  $result = $db->query($sql) or die($db->error.$sql);
	  //Loop through each message and create an XML message node for each.
	  
	  while($row = $result->fetch_assoc()) 
	  {
	  	$nr=array();
		foreach($row as $k => $v)
		{
			if(empty($v)) continue;
			$k1=strtolower($k);
			$nr[$k1]=$v;
		}
		$json[]=$nr;
	  }
}else if(isset($delIds))
{
	if(!empty($_COOKIE['Generic-AccessLevel']) && $_COOKIE['Generic-AccessLevel']==3)
	{
		$query="delete from $table where $primary_key in ($delIds)";
		$result = $db->query($query) or die($db->error);
		$json=1;
	}else $json=0;
}
else if(isset($voidIds))
{
	if(!empty($_COOKIE['Generic-AccessLevel']) && $_COOKIE['Generic-AccessLevel']==3 && !empty($voidIds))
	{
		$trans_no=time().rand(5,50);
		$query="insert into $table (memo ,	ref ,method ,`date`,`date_due`,c_type,cid ,cref ,customer ,address,city,state,zipcode,country,telephone,email,customerPO,quantity,gl_quantity,subdivision,it_id,it_type,itemid,description,rate,amount_due,amount_paid,applied_credit,net_due,amount,discount,gl_amount,wharehouse,wharehouse_name,sign,account_id,account,account_name,account_type,glaccount_id,glaccount,glaccount_name,glaccount_type,trans_no,s_no,trans_type,type,prepayment,sub,approved,user,clientid) select memo ,	concat(ref,' - V') ,method ,`date`,`date_due`,c_type,cid ,cref ,customer ,address,city,state,zipcode,country,telephone,email,customerPO,-quantity,-gl_quantity,subdivision,it_id,it_type,itemid,description,rate,-amount_due,-amount_paid,-applied_credit,-net_due,-amount,discount,-gl_amount,wharehouse,wharehouse_name,sign,account_id,account,account_name,account_type,glaccount_id,glaccount,glaccount_name,glaccount_type,'$trans_no',s_no,trans_type,type,prepayment,sub,approved,user,clientid from $table where $primary_key in ($voidIds)";
		$result = $db->query($query) or die($db->error);
		$json=1;
	}else $json=0;
}
else if(isset($table))
{
	//die('ewwwwooo');
	$coldesc=array();$column=array();$element=array();$tabs = array();
	if(!isset($table_fields)) $table_fields=getFields($table);
	$cp = $display_fields;
	foreach($cp as $k=> $v2)
	{
		$column[$k]=$v2['column'];
		$coldesc[$k]=!empty($v2['description']) ? $v2['description'] : '';
		$element[$k]=!empty($v2['component']) ? $v2['component'] : '';
		$actions[$k]=!empty($v2['action']) ? $v2['action'] : '';
		$source[$k]=!empty($v2['source']) ? $v2['source'] : '';
		if(isset($v2['table'])){$tabs[$k] = $v2['table']; }
	}
	$json["desc"]=$coldesc;
	$json["col"]=$column;
	$json["fmt"]=$element;
	$json["ord"]=$actions;
	$json["ext"] = array();
	if(isset($extension)){
		$ext = $extension;
		foreach($ext as $k => $f){
			$v = isset($param[$f]) ? $param[$f] : 0;
			if(!$v)continue;
			unset($v['form']);
			$v['pageTitle'] = '_'.str_replace(' ','_',$page_title);
			$v['name'] =$f;
			$v['formId'] = "newExtForm$k"."_"."$f"."_"."$page_title";
			$json["ext"][] = $v;
		}
	}
	$col=""; $val =""; $ct=0;
	foreach($column as $k => $v)
	{
		if(array_search(strtolower($v),$table_fields) !==false)
		{
		  if($ct)
		  {
		  		$col .=",";
			  if(!empty($search))$val .=" or ";
		  }
		  $col .="`{$v}`";
		  if(!empty($search))$val .="$v like '%{$search}%'";
		  if($sort_col=="") $sort_col=$v;
		  $sort_col2 .= ", `{$v}`"; 
		  $ct++;
		}
	}
	$text="";
	if(!empty($condition))
	{
		$cnd=explode("|",$condition);
		 $combine="and";
		foreach($cnd as $k => $v)
		{
			$tx=explode(",",$v);
			if(empty($tx[1])) continue;
			if($text !="") $text .=" $combine "; 
			if(isset($tx[2]) && $tx[2]=="negate")
		   {
			   $text .=$tx[0]. "<>'". $tx[1]. "'";
		   }else if(isset($tx[2]) && $tx[2]=="null")
		   {
			   $text .=$tx[0]. " is null ";
		   }else if(isset($tx[2]) && $tx[2]=="not")
		   {
			   $text .=$tx[0]. " not like '". $tx[1]. "'";
		   } else if(isset($tx[2]) && $tx[2]=="start")
		   {
			   $text .=$tx[0]. " like '". $tx[1]. "%'";
		   } else if(isset($tx[2]) && $tx[2]=="end")
		   {
			   $text .=$tx[0]. " like '%". $tx[1]. "'";
		   } else if(isset($tx[2]) && $tx[2]=="contain")
		   {
			   $text .=$tx[0]. " like '%". $tx[1]. "%'";
		   }else if(isset($tx[2]) && $tx[2]=="greater")
		   {
			   $text .=$tx[0]. " > '". $tx[1]. "'";
		   }else if(isset($tx[2]) && $tx[2]=="less")
		   {
			   $text .=$tx[0]. " <'". $tx[1]. "'";
		   }else if(isset($tx[2]) && $tx[2]=="date")
		   {
			   $text .=getDateValue($tx[1],$tx[0]);
		   }
		   else {
		   	 $text .=$tx[0]. "='". $tx[1]. "'";
			}
		
		}
	}
	if(!empty($retrieve_filter))
	{
		if($text !="" ) $text .=" and ";
		$text .=str_replace(',',' and ',$retrieve_filter);
	}
	if(isset($dateRange))
	{
		if($text !="" && $dateRange !="All Time" ) $text .=" and "; 
		 $text .=getDateValue($dateRange,$dateColumn);
	}
	if(isset($page) && isset($limit)) 
	{	
		$lt=($page - 1) *$limit;
		if($lt <0) $lt=0;
		$limit_query= " LIMIT $lt , $limit ";
		
	}else if(isset($limit))
	{
		$limit_query= "LIMIT $limit ";
	} else $limit_query= "";
	
	if(!empty($val)) $val = "where ($val) ";
	if(!empty($val) && !empty($text)) $val .= "and $text";  else if(empty($val) && !empty($text)) $val = "where $text"; 
	if(!empty($primary_key) && !empty($pkey)) $val ="where $primary_key='$pkey'";
	if(!empty($col))
	{		  
	  if(!empty($primary_key)) $col= "$primary_key , $col";
	  $sql = "SELECT $col FROM $table $val order by $sort_col $sort_col2 $limit_query";
	  
	//die($sql);
		
	  $result = $db->query($sql) or die($db->error.$sql);
	  //Loop through each message and create an XML message node for each.
	  
	  while($row = $result->fetch_row()) 
	  {
	  	$r=array();
		$r["i"]=$row[0];
	  	for($k=1;$k<count($row);$k++)
		{
			if($actions[$k-1]=='select') $row[$k]= getDataValue($row[$k],$source[$k-1]);
			else if($actions[$k-1]=='date') {$date = new DateTime($row[$k]);$row[$k] = $date->format('F jS, Y');}
			$r["c"][]=$row[$k];
		}
		
		foreach($tabs as $k => $v){
			$query1="select {$actions[$k]}({$column[$k]}) as {$column[$k]} from $v where {$column[$k]}='{$row[0]}' ";
			//echo $query1;
			$result1=$db->query($query1) or die($db->error.$query1);
			while($row1=$result1->fetch_assoc()){
				$r["c"][] = $row1[$column[$k]];
			}
			$result1->free();
		}
		$json["row"][]=$r;
	}
		$g = "SELECT count($primary_key) as count FROM $table $val";
		$result2 = $db->query($g) or die($db->error." ($g)");
		while($rwo = $result2->fetch_assoc()){
			$json["total"]=intval($rwo['count']);
		}
	  $result->free();
	}
}
echo json_encode($json);
//echo json_encode($tabs);
$db->close();
?>