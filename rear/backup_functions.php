<?php
function archiveDirectory(&$zip, $dir)
{
	$files=array();
	// Open a known directory, and proceed to read its contents
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				$files[]=$file;
			}
			closedir($dh);
			for($i=0;$i<count($files);$i++)
			{
				if($files[$i]=="." || $files[$i]==".." || $files[$i]=="...") continue;
				$directory=$dir."/".$files[$i];
				$filename=substr($directory,2);
				if(is_dir($dir."/". $files[$i])){archiveDirectory($zip,$directory);}
				else $zip->addFile($directory,$filename);
			}
		}
	}
}
function archiveArray(&$zip,&$files)
{
	for($i=0;$i<count($files);$i++)
	{
		if(!file_exists($files[$i]))continue;
		if($files[$i]=="." || $files[$i]==".." || $files[$i]=="...") continue;
		$directory=$files[$i];
		$filename=substr($directory,2);
		if(is_dir( $files[$i])){archiveDirectory($zip,$directory);}
		else $zip->addFile($directory,$filename);
	}
}

function backupDatabase($db)
{
	$number=0;$text="";
	$t_result=$db->query("show tables");
	while(list($table)=$t_result->fetch_array()){
		$d_count=0;$number=0;
		$text .="drop table if exists $table;~% ";
		$text .="create table $table (";
		$d_result=$db->query("describe $table") or die($db->error);
		while($d_line=$d_result->fetch_assoc())
		{
			if($d_count) $text .=",";
			$text .=$d_line["Field"]." ".$d_line["Type"];
			if($d_line["Null"] !="YES")$text .=" not null";
			$text .=" ".$d_line["Extra"]."";
			if($d_line["Key"]!="")$text .=", primary key(".$d_line["Field"].")";
			$d_count++;
		}
		$text .=");~%";
		$query="select * from $table";
		$result=$db->query($query) or die($db->error);
		while($line=$result->fetch_assoc())
		{
			
			if($number !=0) $text .=","; else $text .="insert into $table values ";
			$val_count=0;
			$text .="(";
			foreach($line as $val)
			{
				if($val_count !=0) $text .=",";
				$val=$db->real_escape_string($val);
				if(empty($val)) {$text .="NULL"; }
				else $text .="'$val'";
				$val_count++;
			}
			$text .= ")";
			$number++;
		}
		if($number !=0)$text .=";~%";
		
	}
	$t_result->free_result();
	return $text;
}


function backupTable($db, $table)
{
	$text="";
	$d_count=0;$number=0;
	$text .="drop table if exists $table;~% ";
	$text .="create table $table (";
	$d_result=$db->query("describe $table") or die($db->error);
	
	while($d_line=$d_result->fetch_assoc())
	{
		if($d_count) $text .=",";
		$text .=$d_line["Field"]." ".$d_line["Type"];
		if($d_line["Null"] !="YES")$text .=" not null";
		$text .=" ".$d_line["Extra"]."";
		if($d_line["Key"]!="")$text .=", primary key(".$d_line["Field"].")";
		$d_count++;
	}
	$text .=");~%";
	$query="select * from $table order by id";
	$result=$db->query($query) or die($db->error);
	while($line=$result->fetch_assoc())
	{
		
		if($number !=0) $text .=","; else $text .="insert into $table values ";
		$val_count=0;
		$text .="(";
		foreach($line as $val)
		{
			if($val_count !=0) $text .=",";
			$val=$db->real_escape_string();
			$text .="'$val'";
			$val_count++;
		}
		$text .= ")";
		$number++;
	}
	if($number !=0)$text .=";~%";
	return $text;
}
function backupFields($db, $table,$fields)
{
	$text="";
	$d_count=0;$number=0;
	$text .="drop table if exists $table;~% ";
	$text .="create table $table (";
	$d_result=$db->query("describe $table") or die($db->error);
	while($d_line=$d_result->fetch_assoc())
	{
		if(!array_keys($fields,$d_line["Field"]))continue;
		if($d_count) $text .=",";
		$text .=$d_line["Field"]." ".$d_line["Type"];
		if($d_line["Null"] !="YES")$text .=" not null";
		$text .=" ".$d_line["Extra"]."";
		if($d_line["Key"]!="")$text .=", primary key(".$d_line["Field"].")";
		$d_count++;
	}
	$text .=");~%";
	$query="select ";
	$field_count=0;
	for($i=0;$i<count($fields);$i++)
	{
		if($field_count)$query .=",";
		$query .=$fields[$i];
		$field_count++;
	}
	$query .=" from $table order by id";
	$result=$db->query($query) or die($db->error);
	while($line=$result->fetch_assoc())
	{
		
		if($number !=0) $text .=","; else $text .="insert into $table values ";
		$val_count=0;
		$text .="(";
		foreach($line as $val)
		{
			if($val_count !=0) $text .=",";
			$val=$db->real_escape_string($val);
			$text .="'$val'";
			$val_count++;
		}
		$text .= ")";
		$number++;
	}
	if($number !=0)$text .=";~%";
	return $text;
}

function getBackupPics($db,$table)
{
	$query="select picture_ref from $table where picture_ref <> '' order by id ";
	$result=$db->query($query) or die($db->error);
	while($line=$result->fetch_assoc())
	{ 
		$files[]="./Pictures/".$line["picture_ref"];
	}
	return $files;
}

function runQuery($file){
	global $db;
	if(file_exists($file)){
		$handle=fopen($file,"r");
		if($handle)
		{
			$query = fread($handle, filesize($file));
			fclose($handle);
		}
		$query_set=explode(";~%",$query);
		$num=count($query_set)-1;
		for($i=0;$i<$num;$i++)
		{
			$db->query($query_set[$i]) or die($db->error);
		}
	}
}

function _writeFile($file, $data){
	$dir = dirname($file);
	if(!is_dir($dir)){
		mkdir($dir, 0755, true);
	}
	if($handle = fopen($file, "w+")){
		if(fwrite($handle, $data)){
			fclose($handle);
			return(true);
		}else return(false);
	}else return(false);
}

function getSync($db, $table)
{
	$text="";
	$query="select query from $table";
	$result=$db->query($query) or die($db->error);
	while($row=$result->fetch_assoc())
	{
		$text .=$row["query"].";";
	}
	return $text;
}
function runQueryText($sql)
{
	$query = $sql;
	$query_set=explode(";~%",$query);
	$num=count($query_set)-1;
	for($i=0;$i<$num;$i++)
	{
		$db->query($query_set[$i]) or die($db->error);
	}
}

function zipDir($source, $destination){
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            //$file = realpath($file);

            if (is_dir($file) === true){
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

function extractZip($zipFile, $extract_to){
	$zip = new ZipArchive;
	if(!is_dir($extract_to)){mkdir($extract_to,true, 0755);}
	$res = $zip->open($zipFile);
	if ($res === TRUE) {
	  	$zip->extractTo($extract_to);
	  	$zip->close();
		return true;
	} else {
	  return false;
	}
}

function emptyDir($dir){
	if(is_dir($dir)){
		$di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
		$ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
		foreach ( $ri as $file ) {
			//$file = $file->getRealPath();
			$file->isDir() ?  rmdir($file) : unlink($file);
		}
		return true;
	}
}
?>