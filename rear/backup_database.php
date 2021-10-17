<?php 
	require_once "../database/connect.php";
	require_once "backup_functions.php";
	extract($_POST, EXTR_OVERWRITE);
	$dir = "../database/backups/";
	if(!is_dir($dir)){
		mkdir($dir,true,0755);
	}
	$file=$dir."DataBackup".time().".sql";
	$handle=fopen($file,"w+");
	if($handle){
		$text=backupDatabase($db);
		if(fwrite($handle, $text, strlen($text)))
		{
			fclose($handle);
			$asset = '../asset/';
			$zipfile = str_replace('.sql','',$file).'.zip';
			zipDir($asset, $zipfile);
			$target_url = 'http://www.enugucathsec2.org/rear/backup_restore_database.php';
			//$target_url = 'http://localhost/enugu_diocese/rear/backup_restore_database.php';
			$headers = array("Content-Type" => "multipart/form-data");
			$post = array(
				'sqlFile' => makeCurlFile($file),
				'zipFile' => makeCurlFile($zipfile)
			);
			$ch = curl_init($target_url);
			curl_setopt($ch, CURLOPT_POST,1);
			curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			$result = curl_exec($ch);
			if (curl_errno($ch)) {
			   $result = curl_error($ch);
			}
			curl_close ($ch);
			unlink($zipfile);
			echo($result);
		}
	}	


$db->close();	


function makeCurlFile($file){
	$file = realpath($file);
	$mime = mime_content_type($file);
	$info = pathinfo($file);
	$name = $info['basename'];
	$output = new CURLFile($file, $mime, $name);
	return $output;
}
?>
