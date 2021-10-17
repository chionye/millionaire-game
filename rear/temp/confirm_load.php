<?php
function findHeader($ar,$key)
{
	$selected="None";
	if(count($ar) ==0) return $selected;
	foreach($ar as $k=>$v)
	{
		$a[$k]=0;
		similar_text(strtolower($v),strtolower($key),$a[$k]);	
	}
	$f=max($a); $fk=array_search($f,$a);
	if( $f>80) 
	{
		$selected=$ar[$fk];
	}
	return $selected;
}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="javascript" type="text/javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script language="javascript" type="text/javascript" src="scripts/materialize.js"></script>
<script language="javascript" type="text/javascript"  >
	$(document).ready(function() {
    	//$('select').material_select();
	
	});
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	padding-left: 0px;
}
-->
</style>
<link href="css/view_css2.css" rel="stylesheet" type="text/css" />
<link href="css/materialize.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>

<body>

<div class="indigo"><div class="row indigo topBanner"><div class="col s12 white-text "><h4 class="row ">Load <?php echo $_page_title ?></h4></div></div></div>
  <div>
    <form action="process_load.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <input name="filename" type="hidden" id="filename" value="<?php echo $filename ?>" />
	  <input name="realfile" type="hidden" id="realfile" value="<?php echo $realfile ?>" />
	 <input name="link_submitsheet" type="hidden" id="link_submitsheet" value="1" />
	  <?php foreach($_POST as $k => $v) { ?>
      <input name="<?php echo $k ?>" type="hidden" value="<?php echo $v ?>" />
     <?php } ?>
	 	  <?php foreach($_GET as $k => $v) { ?>
      <input name="<?php echo $k ?>" type="hidden" value="<?php echo $v ?>" />
     <?php } ?>
	 <input name="referer" type="hidden" id="link_submitsheet" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
<table class="striped">
      <thead>
        <th>&nbsp;</th>
        <?php for($j=0;$j<count($t[0]);$j++){ ?><th>
          <select name="s<?php echo $j ?>" id="select<?php echo $j ?>" class="browser-default">
            <option value="">None</option>
            <?php foreach($coldesc as $k => $v ) { ?>
				<option <?php if(findHeader($coldesc,$t[0][$j])==$v){echo 'selected="selected"'; } ?> value="<?php echo $k ?>"><?php echo $v ?></option>
			<?php } ?>
          </select><label for="select<?php echo $j ?>"></label>
        </th><?php } ?>
	  </thead>
      <tbody>
	  <?php for($i=0;$i<$count;$i++){ ?>
     <tr>
       <td>
         <input name="rcbox<?php echo $i?>" type="checkbox" id="checkbox<?php echo $i?>" title="uncheck to deselect" checked="checked" value="<?php echo $i?>" /><label for="checkbox<?php echo $i?>"></label>
       </td>
        <?php for($j=0;$j<count($t[$i]);$j++){ ?><td><?php echo $t[$i][$j] ?> </td> <?php } ?>
	  </tr> 
	  <?php } ?></tbody>   
    </table>
   <div class="flt">
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <button data-position="left" data-delay="50" data-tooltip="Save" class="tooltipped btn-floating btn-large red " type="submit" name="action">
      <i class="large material-icons" id="formSave" >save</i>    </button>
    <ul>
	     <li><a data-position="left" data-delay="50" data-tooltip="Close" class="tooltipped btn-floating blue" id="close"><i class="material-icons">close</i></a></li>
      <li><a class="btn-floating green" id="formReset"><i class="material-icons">replay</i></a></li>
    </ul>
  </div>
</div>
    </form>
    <p>&nbsp;</p>
</div>
</body>
</html>
