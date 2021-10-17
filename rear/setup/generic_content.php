<?php 
$page_title="";$action_columns=array();$coldesc=array(); $empty=array(); $onChange=array(); $category=array();$cls=array();$actions=array();$extension = array();

require_once "../select_page.php"; 
require_once "../get_param.php"; 
require_once "../get_role_func.php"; 
extract($_GET,	EXTR_OVERWRITE);
$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col="";$colD="";$order="";$required="";$Label="";
$vt=extractForm($form);
extract($vt);
?>
<?php if(empty($ajax)) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<title>Upload Resources</title>

</head>
<body><div style="height:2rem;display:block"><div class="progress hide">
      <div class="indeterminate"></div>
  </div></div><?php } ?>
  <div class="house" id="_<?php echo str_replace(' ','_',$page_title); ?>">
	  <?php require_once('content.php'); ?>
</div>
	  

<?php if(empty($ajax)) { ?>
</html>
<?php } ?>