<?php


require_once __DIR__."/../database/connect.php";
$coldesc = [];
$query = "SELECT * FROM subject ORDER  BY name DESC";
$all = $db->query($query) or die($db->error);
while($row = $all->fetch_assoc()){
	$coldesc[] = $row['name'];
	$table_field[] = $row;
}
$coldesc[] = 'S/N'; $table_field[] = array('code'=>'00');
$coldesc[] = 'Name of Pupil'; $table_field[] = array('code'=>'00');
$coldesc[] = 'Exam No'; $table_field[] = array('code'=>'00');
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
		<?php if($ext !== 'xlsx' || !isset($tabledata)) { echo json_encode($colspan)?>
		<h3 class="col s12 center-align">Only a ('.xlsx') file is allowed here</h3>
		<?php } else {?>
<table class="bordered">
	<thead>
		
		<!--<th>&nbsp;</th>
		<th>
			<select name="s1">
				<option value="exam_no" selected>Exam No</option>
			</select>
		</th>
		<th>
			<select name="s2">
				<option value="student_name" selected>Name</option>
			</select>
		</th>-->
		<!--Header Select-->
		<tr>
			<th>&nbsp;</th>
			<?php for($i=0; $i<count($tabledata[0]); $i++){
				if($colspan[$i] != 0){ ?>
					<th colspan="<?=$colspan[$i]?>" >
					  <select name="s<?php echo $i ?>" id="select<?php echo $i ?>" class="browser-default headd" required>
						<option value=""></option><option value="0~none">None</option>
						<?php foreach($coldesc as $k => $v ) { ?>
							<option data-id="<?=$k?>" <?php if(findHeader($coldesc, $tabledata[0][$i])==$v){?>selected="selected" <?php }?> value="<?php echo $table_field[$k]['code'].'~'.$v ?>"><?php echo $v ?></option>
						<?php } ?>
					  </select><label for="select<?php echo $i ?>"></label>
					</th>
				<?php } 
			} ?>
		</tr>
		
	</thead>
  <!--TAble body subject row-->
<tbody>
	<!--Per row-->
	<?php for($i=0;$i<count($tabledata);$i++){ ?>
		<tr <?php if($i == 1){?>height="110"<?php }?>><!--Effect 2nd row-->
			<td><!--First td for this row-->
				<?php if($i > 1){?> <!--Create checkboxes from 3rd row-->
					<input name="rcbox<?php echo $i?>" type="checkbox" id="checkbox<?php echo $i?>" title="uncheck to deselect" <?php if(!empty($tabledata[$i][0]) && !empty($tabledata[$i][1])) {?> checked="checked"<?php }?>value="<?php echo $i?>" />
					<label for="checkbox<?php echo $i?>"></label>
				<?php }?>
			</td>
			<!--Loop tru tds-->
			<?php for($td=0; $td<count($tabledata[$i]); $td++){
				if($i == 0){//first row, search : match subjects
					if($colspan[$td] != 0){ ?>
						<td colspan="<?=$colspan[$td]?>">
							<?php echo $tabledata[$i][$td] ?>
						</td> 
					<?php }
				}else{?>
					<td><?php echo $tabledata[$i][$td] ?> </td> 
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
	$('#'+page_id+' select.headd').each(function(){
		var cur = $(this).find('option[selected=selected]').attr('data-id') || null;
		var text = $(this).find('option[selected=selected]').val() || null;
		$(this).attr({'data-cur':cur});
		$(this).find('option[selected=selected]').each(function(){
			var text = $(this).text(); var da_id = $(this).attr('data-id');
			$('select.headd').each(function(){
				$(this).find('option[data-id='+da_id+']').attr({disabled:'disabled'});
			});
		});
		$(this).find('option[data-id='+cur+']').removeAttr('disabled');
	});
	$('#'+page_id+' select.headd').change(function(){
		var  $this = $(this), value = $this.val().split('~')[1], da_id, cur = $this.attr('data-cur') || null, text;
		$this.find('option').each(function(){
			if($(this).text().toLowerCase() == value.toLowerCase()){
				da_id = $(this).attr('data-id') || null;
				if(da_id !== null){$(this).attr({selected:'selected'}).removeAttr('disabled');}

				text = $(this).val() || null;
				$('select.headd').each(function(){
					$(this).find('option[data-id='+da_id+']').attr({disabled:'disabled'});
					$(this).find('option[data-id='+cur+']').removeAttr('disabled');
				});
			}
		});
		$this.find('option[selected=selected]:not(option[data-id='+da_id+'])').removeAttr('selected');
		$this.attr({'data-cur':da_id});
		$(this).find('option[data-id='+da_id+']').removeAttr('disabled');
	});
	<?php if(!empty($filter_dialog)) { ?> $('#filter_dialog'+page_id).openModal(); <?php } ?>
</script>
	<?php if(empty($ajax)) {?>
</body>
</html>
<?php }?>