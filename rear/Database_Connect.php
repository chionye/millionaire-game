<?php
	date_default_timezone_set("UTC");
	$db = mysqli_connect("localhost","root","dreams","") ;

	if($db->connect_errno > 0){

    die('Unable to connect to database [' . $db->connect_error . ']');

}

	

	$_color=array("green","yellow darken-4","red","blue darken-3","cyan darken-3","teal darken-4");

	$_color_count=count($_color);

	

	/*if(isset($_COOKIE["ELIMS-Login"]))

	{

		$elims_id=$_COOKIE["ELIMS-Login"];

		if(!session_register($elims_id) && !isset($_exception))

		{header("Location:pushtop.php"); die();}

			

			



	} else if(!isset($_exception)) { header("Location:pushtop.php"); die(); }

	*/

	

?>