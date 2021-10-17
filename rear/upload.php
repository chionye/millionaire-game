<?php 
require_once "../database/connect.php";
require_once "fileserver.php";
require_once "HTML_functions.php";
extract($_POST, EXTR_OVERWRITE);

$datatypes = [
	'picture'=>['','gif','jpg','bmp','jpeg','png'],
	'audio'=>['','mp3','wma','m4a','ogg'],
	'document'=>['','doc','docx','txt','pdf','xls','xlsx'],
	'video'=>['','mp4','avi','3pg','mkv','wmv'],
	'pdf'=>['','pdf'],
	'archive'=>['','zip','7z','rar','exe']
];
if(isset($switch) ){
	//echo 'here0';
	switch($switch){
		case 1:
			$return = array();
			//echo 'here1';
			$q = "select * from company_logos  where TRIM(tag) != '' order by name desc";
			$con = $db->query($q) or die($db->error);
			//echo 'here2';
			if($con->num_rows > 0){
				//echo 'here3';
				while($row =  $con->fetch_assoc()){
					$image = $row['name'];
					if(stripos($image,'../') == false ){
						$image = '../'.$image;
					}
					$r[0] = $image;
					$r[1] = $image;
					$r[2] = $row['tag'];
					$r[3] = getFileFormat($image);
					$return[]=utf8ize($r);
				}
				//echo 'here4';
			}
		echo json_encode($return);
		break;
	}
	//echo 'here7';
die();
}
//echo 'here8';


function returnUploadFolder($ms)

{

	if($ms=="jpg"||$ms ="png"|| $ms ="gif") return "content/pictures/";

	else return "content/userdata/";

}

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        echo 'error';
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            //self::deleteDir($file);
			deleteDir($file);
        } else {
            unlink($file);
        }
    }
    if(rmdir($dirPath)) return 1; else return 0;
}

extract($_COOKIE,EXTR_OVERWRITE);	

 if(isset($_FILES["file_upload"])) {  
 	$filename =str_replace(' ','_',$_FILES["file_upload"]["name"]);
	$ext =pathinfo($filename,PATHINFO_EXTENSION);
	$icon = returnIcon($filename,$folder);
	if($_FILES["file_upload"]["size"] < 100045766666666){
		if(!is_dir($folder)){
			if(!mkdir($folder,0755,true)){
				die('cant create folder');
			}
		}
		//strict filetype upload
		if(isset($getype) and !empty($getype)){
			$arrtype = $datatypes[$getype];
			$extx = getFileFormat($filename);
			//echo($extx);
			if(array_search($extx, $arrtype) == false){
				$nogo = true;
				die('20');
			}
		}
		$filename=renameIfExists($filename,$folder);
		if(move_uploaded_file($_FILES["file_upload"]["tmp_name"],"$folder".$filename)){
			list($orig_width, $orig_height) = getimagesize($folder.$filename);
			if($orig_width > 200 or $orig_height > 200){
				if(checkPictureFormat($filename)){
					if(!is_dir($folder."tbn")){
						mkdir($folder."tbn",0755);
					}
					$icon=$folder."tbn/".$filename;

					if(!is_file($icon)){
						resizePicture($folder.$filename, $icon, 128, 128);
					}
					if(!empty($width) && !empty($height)){
						resizePicture($folder.$filename, $folder.$filename, $width, $height);
					}
				}
			}
			$_rsp[0] ="$folder".$filename;
			$_rsp[1] =$icon;
			$_rsp[2] =basename($filename);
			$_rsp[3] =$ext;
			echo json_encode($_rsp);	
		} else echo 0;
	}else echo -1;
} else if(!empty($url_file)){
		$dir=$folder;
		$ext=getFileFormat($url_file);
		$icon=returnIcon($url_file,$dir);
		if($icon !=false){

			$bs=basename($url_file);

			echo $bs;

			echo $dir;

			$filenmae="lop.kop";//$filename=renameIfExists($bs,$dir);

			$f=getRemoteFiles($url_file);

			if($f !=false)

			{

				$savefile = fopen($dir . $filename, 'w');

				fwrite($savefile, $f);

				fclose($savefile);

				if(!is_dir($dir."tbn"))

				{

					mkdir($dir."tbn",0755);

				}

				$thumbnail=$dir."tbn/".$filename;

				if(!is_file($thumbnail))

				{

					resizePicture($dir . $filename,$thumbnail, 128, 128);

				}

			$name[0] =$dir.$filename;

			$name[1] =$thumbnail;

			$name[2] =basename($filename);

			$name[3] =$ext;

			echo json_encode($name);

		} else echo 0;

	} else echo -1;

		

}

else if(!empty($url_anchor))

{

	

		$f=getRemoteFiles($url_anchor);

		if($f !=false)

		{

			$title=get_tag($f,'title');

			$r["i"] =$url_anchor;

			$r["c"][]=array("v"=>$title);

			

			echo json_encode($r);

		} else echo 0;

	

		

}	 
else if(!empty($moveFolder))
{
	$new_name= $dropFolder."/".basename($moveFolder);
	
	$query = "UPDATE course_tree SET res_description = replace(res_description,'$moveFolder','$new_name') WHERE res_type='html'";
	if($db->query($query))
	{
		echo rename($moveFolder,$new_name);
		die();
	}

}


else if(!empty($delPath))
{
	switch ($type)
	{
		case 1: 
			echo unlink($delPath);
		break;
		case 0: 
			echo deleteDir($delPath);
		break;
	}
}
else if(!empty($folderName))
{
	$count=0;
	 mkdir($ucPath.$folderName,0755);
	 $in[$count][0]= $ucPath.$folderName;
	$in[$count][2]=$folderName;
	$in[$count][3]= -1;
	echo json_encode($in);
					
}else if(!empty($newPath))
{
	echo rename($oldPath,$newPath);
	die();
}
else{
	//$folder = '../asset/'.basename($folder).'/';
	/*echo $folder;
	echo __DIR__;*/
	if(!is_dir($folder)){
		mkdir($folder, 0777, true);
	}
	$ar=getLocalFiles($folder);
	
	if(isset($getype) and !empty($getype)){
		$search = $ar;
		$ar = [];
		$arrtype = $datatypes[$getype];
		foreach($search as $c => $item){
			$extx = strtolower(trim($item[3]));
			if(array_search($extx, $arrtype) == false and $extx != '-1'){
				continue;
			}
			$ar[] = $item; 
		}
		//$ar[] = ['../'.$folder,'Back','..','-1'];
	}
    echo json_encode($ar);
}

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = trim(utf8ize($v));
        }
    } else if (is_string ($d)) {
        return  trim(utf8_encode($d));
    }
    return $d;
}
?>

