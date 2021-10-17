<?php
include 'database/connect.php';
$id = $_COOKIE['uid'];
$output = '';
$check = "";
function getFullURL(){
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $link = "https";
    else
        $link = "http";
    $link .= "://";
    $link .= $_SERVER['HTTP_HOST'] == 'localhost/'?$_SERVER['HTTP_HOST']."quizzy/":$_SERVER['HTTP_HOST'];
    return $link;
  }
if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['customFile']['tmp_name'])) {
$type = $_FILES['image']['type'];
$ex = explode("/", $type);
$trueext = $ex[1];
$arr = array('jpg', 'png','jpeg','jfif');
for ($i=0; $i < 4; $i++) { 
if ($trueext == $arr[$i]) {
	$check = "ok";
	break;
	}
}
if ($check == "ok") {
$sourcePath = $_FILES['image']['tmp_name'];
$link = getFullURL();
$targetPath = "images/uploads/profile-".$id.".".$trueext;
if(move_uploaded_file($sourcePath,$targetPath)) {
$targetPath = $link."/".$targetPath;
$update = $db->query("update customer set picture = '$targetPath' where cId = '$id'");
if ($update) {
$output = 'ok';
echo $output;
}else{
   echo $db->error; 
}	
}
}else{
$output = 'file is not a picture';
echo $output;
}
}
}
?>