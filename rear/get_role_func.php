<?php
function get_page_module()
{
		

	$json["Setup"]["props"]='{"id":1,"icon":"settings"}';
	$json["Setup"]["subs"][]='{"id":1,"name":"Settings", "url":"setup/generic_parameter.php?pageType=organization"}';
	$json["Setup"]["subs"][]='{"id":2,"name":"Role", "url":"setup/generic_content.php?pageType=role"}';
	$json["Setup"]["subs"][]='{"id":3,"name":"Users", "url":"setup/generic_content.php?pageType=users"}';
	$json["Setup"]["subs"][]='{"id":4,"name":"Label", "url":"setup/generic_content.php?pageType=label"}';

	// Before was Blog
	$json["Categories"]["props"]='{"id":3,"icon":"widgets"}';
	$json["Categories"]["subs"][]='{"id":1,"name":"Parent categories", "url":"setup/generic_content.php?pageType=parent_categories"}';
	$json["Categories"]["subs"][]='{"id":2,"name":"Sub categories", "url":"setup/generic_content.php?pageType=sub_categories"}';
		
	// Before was Maintain
	$json["Brands"]["props"]='{"id":2,"icon":"publish"}';
	$json["Brands"]["subs"][]='{"id":1,"name":"Brands", "url":"setup/generic_content.php?pageType=brands"}';

	$json["Products"]["props"]='{"id":4,"icon":"person"}';
	$json["Products"]["subs"][]='{"id":1,"name":"Products", "url":"setup/generic_content.php?pageType=item"}';

	$json["Archive"]["props"]='{"id":5,"icon":"archive"}';
	$json["Archive"]["subs"][]='{"id":1,"name":"Archive", "url":"setup/generic_content.php?pageType=archive"}';


	$json["Order"]["props"]='{"id":6,"icon":"settings"}';
	$json["Order"]["subs"][]='{"id":1,"name":"unprocessed", "url":"setup/generic_content.php?pageType=change_password"}';
	$json["Order"]["subs"][]='{"id":2,"name":"processed", "url":"setup/generic_content.php?pageType=change_password"}';
	
	

	
	return json_encode($json);
}
function get_default_role()
{
	$d=array();
	$pages=json_decode(get_page_module(),true);
	foreach($pages as $k => $v)
	{
		$vp=json_decode($v['props'],true);
		$id=$vp['id'];
		foreach($v['subs'] as $k1=>$v1)
		{
			$sp=json_decode($v1,true);
			$d[]="$id:".$sp["id"];
		}
	}
	return implode(",",$d);
}
/*$json["Setup"]["props"]='{"id":1,"icon":"settings"}';
	$json["Setup"]["subs"][]='{"id":1,"name":"Settings", "url":"setup/generic_parameter.php?pageType=organization"}';
	$json["Setup"]["subs"][]='{"id":2,"name":"Role", "url":"setup/generic_content.php?pageType=role"}';
	$json["Setup"]["subs"][]='{"id":3,"name":"Users", "url":"setup/generic_content.php?pageType=users"}';
	$json["Setup"]["subs"][]='{"id":4,"name":"Pages", "url":"setup/generic_content.php?pageType=page"}';
	
	$json["Sections"]["props"]='{"id":2,"icon":"grid_on"}';
	$json["Sections"]["subs"][]='{"id":2,"name":"Group Labels", "url":"setup/generic_setup.php?pageType=label"}';
	$json["Sections"]["subs"][]='{"id":1,"name":"Insight Categories", "url":"setup/generic_content.php?pageType=category"}';
	$json["Sections"]["subs"][]='{"id":3,"name":"Insights", "url":"setup/generic_content.php?pageType=article"}';
	$json["Sections"]["subs"][]='{"id":4,"name":"Business", "url":"setup/generic_content.php?pageType=business"}';
	$json["Sections"]["subs"][]='{"id":5,"name":"Industries", "url":"setup/generic_content.php?pageType=industry"}';
	$json["Sections"]["subs"][]='{"id":6,"name":"Products", "url":"setup/generic_content.php?pageType=product"}';
	
	$json["Sub Pages"]["props"]='{"id":3,"icon":"panorama_horizontal"}';
	$json["Sub Pages"]["subs"][]='{"id":1,"name":"News ", "url":"setup/generic_content.php?pageType=news"}';
	$json["Sub Pages"]["subs"][]='{"id":2,"name":"Case Study", "url":"setup/generic_content.php?pageType=caseStudy"}';
	$json["Sub Pages"]["subs"][]='{"id":3,"name":"Career", "url":"setup/generic_content.php?pageType=career"}';	
	$json["Sub Pages"]["subs"][]='{"id":4,"name":"About Us", "url":"setup/generic_content.php?pageType=about"}';*/
?>
