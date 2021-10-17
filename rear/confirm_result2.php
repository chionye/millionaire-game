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
require_once('../database/connect.php');
$coldesc = [];
$query = "SELECT * FROM subject ORDER  BY name DESC";
$all = $db->query($query) or die($db->error);
while($row = $all->fetch_assoc()){
	$coldesc[] = $row['name'];
	$table_field[] = $row;
}
?>
	<?php if(empty($ajax)) {?>
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

<link href="css/view_css2.css" rel="stylesheet" type="text/css" />
<link href="css/materialize.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
</head>

<body>
	
<div class="indigo"><div class="row indigo topBanner"><div class="col s12 white-text "><h4 class="row ">Load <?php echo $_page_title ?></h4></div></div></div><?php } ?>
	<style>body{overflow: hidden}</style>
	<div class="confirm_result">
  <div class="process_load_table_container">
    <form action="process_result.php" method="post" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return(false)">
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
		<?php if($ext !== 'xlsx' || !isset($t)) { echo $data;?>
		<h3 class="col s12 center-align">Only a ('.xlsx') file is allowed here</h3>
		<?php } else {?>
	<table class="bordered">
      <thead>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>
			<select name="s1">
				<option value="exam_no" selected>Exam No</option>
			</select>
		</th>
		<th>
			<select name="s2">
				<option value="student_name" selected>Name</option>
			</select>
		</th>
		<!--Header Select-->
        <?php for($j=3;$j<count($t[0]);$j++){if(!empty($t[0][$j])){ ?>
		  <th <?php if(arraysearch_match($coldesc, $t[0][$j]))echo 'colspan="3"' ?>>
			<?php if($j != 0){ ?>
          <select name="s<?php echo $j ?>" id="select<?php echo $j ?>" class="browser-default" required>
            <option value="">None</option>
            <?php foreach($coldesc as $k => $v ) { ?>
				<option <?php if(findHeader($coldesc, $t[0][$j])==$v){echo 'selected="selected"'; } ?> value="<?php echo $table_field[$k]['code'].'~'.$v ?>"><?php echo $v ?></option>
			<?php } ?>
          </select><label for="select<?php echo $j ?>"></label>
			<?php } ?>
        </th><?php } } ?>
	  </thead>
	  <!--TAble body subject row-->
	<tbody>
		<!--Per row-->
		<?php for($i=0;$i<count($t);$i++){ ?>
			<tr <?php if($i == 1){?>height="110"<?php }?>><!--Effect 2nd row-->
				<td><!--First td for this row-->
					<?php if($i > 1){?> <!--Create checkboxes from 3rd row-->
						<input name="rcbox<?php echo $i?>" type="checkbox" id="checkbox<?php echo $i?>" title="uncheck to deselect" checked="checked" value="<?php echo $i?>" />
						<label for="checkbox<?php echo $i?>"></label>
					<?php }?>
			   	</td>
				<!--Loop tru tds-->
				<?php for($td=0; $td<count($t[$i]); $td++){
					if($i == 0){//first row, search : match subjects
						if(!empty($t[0][$td])){ ?>
							<td <?php if(arraysearch_match($coldesc, $t[0][$td]))echo 'colspan="3"' ?>>
								<?php echo $t[$i][$td] ?>
							</td> 
						<?php }
					}else{?>
						<td><?php echo $t[$i][$td] ?> </td> 
					<?php } 
				} ?>
			</tr> 
		<?php } ?>
	</tbody>   
    </table>
<?php }?>
   <div class="flt">
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <button data-position="left" data-delay="50" data-tooltip="Save" class="tooltipped btn-floating btn-large red " type="submit" name="action" id="loadSave" >
      <i class="large material-icons" onClick="">save</i></button>
    <ul>
	     <li><a data-position="left" data-delay="50" data-tooltip="Close" class="tooltipped btn-floating blue" id="loadclose"><i class="material-icons">reply</i></a></li>
    </ul>
  </div>
</div>
    </form>
    <p>&nbsp;</p>
</div></div>
	<script language="javascript" type="text/javascript">
	var page_id='confirm_load_<?php echo str_replace(' ','_',$_GET['pageTitle']) ?>';
	$('#'+page_id).find('[id]').each(function()
	{
		var tmp=$(this).attr('id')+ page_id;
		$(this).attr({'id':tmp});
		$(this).attr({'data-pageid':page_id});
	})
		$('#'+page_id).find('[for]').each(function()
	{
		var tmp=$(this).attr('for')+ page_id;
		$(this).attr({'for':tmp});
	})
	formInitialize(page_id);
	
	<?php if(!empty($filter_dialog)) { ?> $('#filter_dialog'+page_id).openModal(); <?php } ?>
</script>
	<?php if(empty($ajax)) {?>
</body>
</html>
<?php }?>