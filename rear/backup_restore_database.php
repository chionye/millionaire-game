<?php 
	require_once ("../database/connect.php");
	require_once ("backup_functions.php");
	extract($_POST, EXTR_OVERWRITE);
	$dir = "../database/backups/";
	$asset = '../asset/';
	if(!is_dir($dir)){
		mkdir($dir,true,0755);
	}
	if(isset($_FILES)){
		foreach($_FILES as $posted => $file){
			$name = $_FILES[$posted]["name"];
			$filename = $dir.$name;
			if(move_uploaded_file($_FILES[$posted]["tmp_name"], $filename)){
				switch($posted){
					case 'sqlFile':
						runQuery($filename);
					break;
					case 'zipFile':
						emptyDir($asset);
						extractZip($filename, $asset);
					break;
				}
			}
		}
		emptyDir($dir);
	}
	echo 'done';
?>
