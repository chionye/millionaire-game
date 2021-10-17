<?php
	require_once __DIR__."/../database/connect.php";
	require_once "param_page.php";
	require_once "get_page_func.php";
	
	function sources($pageType){
		if($pageType=="period")
		{
			$v=getDatePeriod();
			foreach($v as $k=> $v1){ $v2[$v1]=$v1;}
			$array =  $v2;
		}else if($pageType=="active")$array = array("Inactive","Active");
		else if($pageType=="publish")$array =  array("Draft","Publish");
		else if($pageType=="accessLevel")$array =  array("View Access","Creation Access","Modification Access","Full Access");
		else if($pageType=="term")$array =  array("1"=>"First Term","2"=>"Second Term","3"=>"Third Term");
		else if($pageType=="gender")$array =  array('m'=>'Male','f'=>"Female");
		else if($pageType=="condition")$array =  array("Poor","Fair","Good","Excellent");
		else if($pageType=="bool")$array =  array("No","Yes");
		else if($pageType=="session"){
			$y = date("Y")+1; $range = $y - 20;$one = 1;
			for($y; $y >= $range; $y--){
				$c =$y-$one;
				$session = "$c".'/'."$y";
				$date["$session"] = "$session";
			}
			$array =  $date;
		}else $array = false;
		return($array);
	}
	
	function loadParam($pageType)
	{
		global $param, $db; 
		if(!empty($pageType))
		{
			if(!empty($param[$pageType])) extract($param[$pageType],EXTR_OVERWRITE);
			else return 0;
		
		}else return 0;
		
		$cp = $display_fields;
		foreach($cp as $k=> $v2)
		{
			$column[$k]=$v2['column'];
			$coldesc[$k]=!empty($v2['description']) ? $v2['description'] : '';
			$element[$k]=!empty($v2['component']) ? $v2['component'] : '';
			$actions[$k]=!empty($v2['action']) ? $v2['action'] : '';
			$source[$k]=!empty($v2['source']) ? $v2['source'] : '';
			
		}
		$col=implode(',',$column);
		if(empty($sort_col))$sort_col=$column[0];
		if(!empty($retrieve_filter)) $ft="where $retrieve_filter "; else $ft="";
		$query="select $primary_key,$col from $table $ft order by $sort_col";
		$result=$db->query($query) or die($db->error.$query);
		while($row=$result->fetch_assoc())
		{
			$id=$row["$primary_key"];
			
			$data["$id"]=$row;
		}
		return $data;
	}
	function loadData($p)
	{
		$where = "";
		if(gettype($p) == 'array'){
			extract($p, EXTR_OVERWRITE);
		}else $pageType=$p;
		$data = sources($pageType);
		if($data != false){
			return($data);
		}
		global $param, $db;
		if(!empty($pageType))
		{
			if(!empty($param[$pageType])) extract($param[$pageType],EXTR_OVERWRITE);
			else return 0;
		
		}else return 0;
		
		
		
		$p=$display_fields;
		$p1=$p[0];
		$name=$p1['column'];
		if(isset($column))$name=$column;
		if(!empty($retrieve_filter)) $ft="where $retrieve_filter"; else $ft="";
		if(!empty($where) && !empty($ft)) $ft=$ft.$where; else if(empty($ft) && !empty($where))$ft="WHERE ".str_replace("AND",'',$where);
		$query="select $primary_key,$name from $table $ft order by $name";
		//die($query);
		$result=$db->query($query) or die($db->error);
		while($row=$result->fetch_assoc())
		{
			$id=$row["$primary_key"];
			$data["$id"]=$row["$name"];				
		}
		return $data;
	}
	function getData($pageType)
	{
		
		global $param, $db;
		if(!empty($pageType))
		{
			if(!empty($param[$pageType])) extract($param[$pageType],EXTR_OVERWRITE);
			else return '';
		
		}else return '';
		
		$p=explode("|",$c);
		$p1=explode(",",$p[0]);
		$name=$p1[0];
		$data='';
		if(!empty($retrieve_filter)) $f="where $retrieve_filter"; else $f='';
		$query="select $primary_key,$name from $t $f order by $name";
		$result=$db->query($query) or die($db->error);
		if($row=$result->fetch_assoc())
		{
			$id=$row["$primary_key"];
			$data=$row["$name"];
		}
		return $data;
	}
	function getDataValue($d,$pageType)
	{
		$array = sources($pageType);
		if($array != false){
			$data = $array[$d];
			return($data);
		}
		global $param, $db;
		if(!empty($pageType))
		{
			if(!empty($param[$pageType])) extract($param[$pageType],EXTR_OVERWRITE);
			else return '';
		
		}else return '';
		
		$retrieve_filter = isset($retrieve_filter) ? 'and '.$retrieve_filter : '';
		$name=$display_fields[0]['column'];
		$data='';
		$f="where $primary_key='$d'"; 
		if(!empty($filter)) $f .=" and $filter";
		$query="select $primary_key, $name from $table $f $retrieve_filter";
		//return $query;
		$result=$db->query($query) or die($db->error);
		if($row=$result->fetch_assoc())
		{
			$id=$row["$primary_key"];
			$data=$row["$name"];
		}
		return $data;
	}

function extractForm($form){
	$data=array();
	//echo json_encode($form).'<br><br><br>';
	$vs=!empty($form['sections']) ? $form['sections'] : array();
	foreach($vs as $kt1 => $v1){
		if(empty($v1['position']))continue;
		$positions = explode(' ',trim($v1['position']));
		$k0 = isset($positions[1]) ? trim($positions[1]) : '0';
		$k = trim($positions[0]);
		$k1=!empty($v1['section_title']) ? $v1['section_title'] : '';
		$vf=!empty($v1['section_elements']) ? $v1['section_elements'] : array();
		foreach($vf as $k2 => $v2){	
			if(!empty($v2['column'])){
				$data['columns'][$k0][$k][$k1][]=$v2['column'];
				$data['coldesc'][$k0][$k][$k1][]=!empty($v2['description']) ? $v2['description'] : '';
				$data['required'][$k0][$k][$k1][]=!empty($v2['required']) ? $v2['required'] : '';
				$data['disabled'][$k0][$k][$k1][]=!empty($v2['disabled']) ? $v2['disabled'] : false;
				$data['order'][$k0][$k][$k1][]=!empty($v2['type']) ? $v2['type'] : '';
				$data['src'][$k0][$k][$k1][]=!empty($v2['source']) ? $v2['source'] : '';
				$data['cls'][$k0][$k][$k1][]=!empty($v2['class']) ? $v2['class'] : '';
				//if($v2['type'] == 'select'){
					$data['empty'][$k0][$k][$k1][]=!empty($v2['empty']) ? $v2['empty'] : '';
					$data['onChange'][$k0][$k][$k1][]=!empty($v2['onChange']) ? $v2['onChange'] : '';
					$data['target'][$k0][$k][$k1][]=!empty($v2['target']) ? $v2['target'] : '';
				//}
				$data['col'][]=$v2['column'];
				$data['desc'][]=$v2['description'];
			}
		}
	}
	//echo json_encode($data);
	//die();
	return $data;
}
if(isset($_POST['heirachy_select'])){
	extract($_POST, EXTR_OVERWRITE);
	$arr_data = ['where'=>" AND $filter='$value'", 'pageType'=>$source];
	$data = loadData($arr_data);
	$data = !$data ? [] : $data;
	echo json_encode($data);
	
}

if(isset($_GET['reload_select'])){
	$result = [];
	//print($_POST);
	foreach($_POST as $id => $arr){
		if(isset($arr['filter'])){
			$arr_data = ['where'=>"AND {$arr['filter']}='{$arr['value']}'", 'pageType'=>$arr['source']];
		}else if(isset($arr['column'])){
			$arr_data = ['column'=>$arr['column'], 'pageType'=>$arr['source']];
		}else{$arr_data = $arr['source'];}
		$data = loadData($arr_data);
		$data = !$data ? [] : $data;
		$result[$id]=$data;
	}
	echo json_encode($result);
}


function jsonRe_encode($arr){
	if(gettype($arr) =="array"){
		$jj = "";
		foreach($arr as $k => $v){
			$jn = "";
			$n = empty($v['name'])? '':$v['name'];
			$c = empty($v['column'])? '':$v['column'];
			$s = empty($v['source'])? '':$v['source'];
			$v = empty($v['value'])? '':$v['value'];
			$jn = $c.','.$n.','.$s.','.$v.'|';
			$jj .= $jn; 
		}
		return(substr($jj,0,-1));
	}else return(0);
}
?>