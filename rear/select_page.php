<?php
	date_default_timezone_set("UTC"); 
	require_once "param_page.php";

	extract($_GET, EXTR_OVERWRITE);

	extract($_POST, EXTR_OVERWRITE);

	//print_r($_POST);

	if(isset($pageType))

	{	$pageType=trim($pageType);

		if(isset($param[$pageType])) extract($param[$pageType],EXTR_OVERWRITE);

	

	}

		//echo $delIds .'pppp';







?>