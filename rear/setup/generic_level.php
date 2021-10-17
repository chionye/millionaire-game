<?php
		$page_title="";$form=array();$actions=array();$action_columns=array();$coldesc=array();$category=array(); $extension=array(); 
		require_once "../select_page.php"; 
		require_once "../get_param.php"; 
		require_once "../get_role_func.php"; 
		extract($_GET,EXTR_OVERWRITE);
		$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col="";$colD="";$order="";$required="";$Label="";

		$vt=extractForm($form);
		extract($vt);
		foreach($actions as $k=> $v)
		{
			$action_forms[$k]=extractForm($param[$v]['form']);
		}

?>
<?php if(empty($ajax)) { ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $page_title ?></title>
<?php require_once('../subs/links.php') ?>
</head>

<body> 
<div style="height:2rem;display:block"><div class="progress hide">
      <div class="indeterminate"></div>
  </div></div><?php } ?>
	<div class="house" id="_<?php echo str_replace(' ','_',$page_title) ?>" style="display:none">
	<?php require_once('content.php') ?>
	</div>
	
	<!-----------------------------------------------------------------------------Generic level first page  ----------->
	
<?php if(!empty($filter_dialog)) { 
	$parentType=$pageType; $parent_title='_'.str_replace(' ','_',$page_title); $pageType=$filter_dialog["source"];  if(isset($pageType)){
		$pageType=trim($pageType);
		if(isset($param[$pageType])) extract($param[$pageType],EXTR_OVERWRITE);
	}?>
	<div class="house" id="_<?php echo str_replace(' ','_',$parent_title."_".$page_title) ?>"> <div  id="filter_dialog"> <div class="upload_bar" id="upload_bar">
      <div class="top-control row"> 
        
            <!--<div class="col s12">Select <?php echo $page_title ?></div>-->
           <div class="input-field col s3"> 
			   <input name="toplevel" type="hidden" id="_toplevel" value="<?php echo $parent_title ?>" /> 
			   <input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />
			   <input name="<?=$pageType?>" type="hidden" id="hierachy" value="<?=$filter_dialog["column"] ?>" />
            	<input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />
			   <input name="search" type="text"  id='_searchBox' size="50" value="" />
			   <label for="_searchBox">Search <?php echo $page_title ?></label>
			   <img src="icons/search.svg" class="search prefix material-icons" />
		  </div>
		  <div class="input-field col s2">
					<select name="range" id='_rangeBox'>
						<option value="">Number of items</option><option value="25">25 Items</option>
						<option value="50">50 Items</option><option value="100">100 Items</option>
						<option value="150">150 Items</option><option value="200">200 Items</option>
					</select>
				</div>
		  <!--<div id="_filterList" >
			<?php if(isset($filter_dialog) && !empty($filter_dialog)) { ?> <input class="filterValue" type="hidden"  id='_linkFilter'  name="<?php echo $filter_dialog["column"] ?>" /><?php } ?>
			<?php foreach($category as $k => $f) { if(isset($f['type']) && $f['type'] == 'period') {?><div class='input-field col s3 right'> <input class="dateFilter" type="text"  id='<?php echo $category_column[$k] ?>' size="50" name="<?php echo $category_column[$k] ?>" /><label class="cat" for='<?php echo $category_column[$k] ?>'>Date Range </label></div><?php } else $jn[]=$f; }?><?php if(!empty($jn)) {?><div class="input-field col s3 right"><input name="search" type="text"  id='_filter' size="50" class="filter" data-value="<?php echo jsonRe_encode($jn)?>"  /><label for="_filter">Filter By</label></div><?php } ?>
		</div>-->
		  
       </div>

  </div>
	<div class="list_cont">
		<div id="dialog_display" class="open_select-div collection with-header" ></div>
		<div class="reloadPage" id="reloadPage"><img class="material-icons" src="icons/refresh.svg"></div>
	</div>
	<div class="pagination"><div id="pagination"></div><input id="active_page" type="hidden" name="page" /></div>
  </div></div>  </div>
  <script language="javascript" type="text/javascript">
	var firstpage='_<?php echo str_replace(' ','_',$parent_title."_".$page_title) ?>';
	$('#'+firstpage).find('[id]').each(function()
	{
		var tmp=$(this).attr('id')+ firstpage;
		$(this).attr({'id':tmp});
		$(this).attr({'data-pageid':firstpage});
	})
		$('#'+firstpage).find('[for]').each(function()
	{
		var tmp=$(this).attr('for')+ firstpage;
		$(this).attr({'for':tmp});
	})
	formInitialize(firstpage);
	$('#_backTop'+pageId).click(function(){
		var pg = $(this).data('pageid');
		var top = $(this).attr('top');
		$('#'+pg).swapDiv($('#_'+pg+top)); 
	})
</script>
  
  <?php } ?>
<?php if(empty($ajax)) { ?>

</body>
</html>
<?php } ?>