<?php
include '../database/connect.php';
$id = $_COOKIE['uid'];
$output = '';
$check = "";
$ar = [];
$r = [];
if(is_array($_FILES)) {
	if(is_uploaded_file($_FILES['customFile']['tmp_name']) && is_uploaded_file($_FILES['inpfile']['tmp_name'])) {
		//print_r($_FILES);
		$type = $_FILES['customFile']['type'];
		$type1 = $_FILES['inpfile']['name'];
		$ex = explode("/", $type);
		$ex1 = explode(".", $type1);
		$tr = count($ex1) - 1;
		$trueext = $ex[1];
		$trueext1 = $ex1[$tr];
		$arr = array('jpg', 'png','jpeg','jfif');
		$arr1 = array('doc', 'docx','pdf');
		for ($i=0; $i < 4; $i++) { 
			if ($trueext == $arr[$i]) {
				$check = "ok";
				break;
			}
		}
		for ($j=0; $j < 3; $j++) { 
			if ($trueext1 == $arr1[$j]) {
				$check1 = "ok";
				break;
			}
		}
		if ($check == "ok" && $check1 == "ok") {
			$sourcePath = $_FILES['customFile']['tmp_name'];
			$sourcePath1 = $_FILES['inpfile']['tmp_name'];
			$targetPath = "img/".$_FILES['customFile']['name'];
			$targetPath1 = "docs/".$_FILES['inpfile']['name'];
			if(move_uploaded_file($sourcePath,$targetPath)) {
				if (move_uploaded_file($sourcePath1,$targetPath1)) {
					$ar['src'] = $targetPath;
					$r['src'] = $targetPath1;
					$enc = json_encode($ar);
					$enc1 = json_encode($r);
					$update = $db->query("INSERT INTO content (title, image, genre, author, book) VALUES('', '$enc', '', '', '$enc1')");
					if ($update == true) {
						$output = 'ok';
						echo $output;
					}else{
						echo $db->error; 
					}	
				}
			}
		}else{
			$output = 'file is not a picture or document';
			echo $output;
		}
	}
}
?>