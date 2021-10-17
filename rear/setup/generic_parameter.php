<?php
		$page_title="";$_form=array();$_actions=array();$action_columns=array();$coldesc=array(); $category_source=array();$cls=array();
		require_once "../select_page.php"; 
		require_once "../get_param.php"; 
		require_once "../get_role_func.php"; 
		extract($_GET,EXTR_OVERWRITE);
		$dir="desc";$sort="";$sort_col=""; $source_count=0; $hierachy_count=0; $value_count=0; $group_count=0;$group_sum=0;$col="";$colD="";$order="";$required="";$Label="";
		$vt=extractForm($form);
		extract($vt);
		
		foreach($_actions as $k=> $v)
		{
			$action_columns[$k]=array();$action_coldesc[$k]=array(); $action_order[$k]=array();
			if(!empty($param[$v]))
			{
			  $xparam=explode("|",$param[$v]['_c']);
			  foreach($xparam as $k2 => $v2)
			  {
				  
				  $sparam=explode(",",$v2);
				  
				   $action_columns[$k][]=$sparam[0];
				  $action_coldesc[$k][]=$sparam[1];
				  $action_order[$k][]=$sparam[2];
				  if(isset($sparam[2]))$action_source[$k]=$sparam[2];
			  }
			  $action_page[$k]=$param[$v]['_page'];
			  $action_name[$k]=$param[$v]['page_title'];
			  $action_icon[$k]=$param[$v]['_icon'];
			  $action_type[$k]=$v;
			}	
			
		}
		
?>
<?php if(empty($ajax)) { ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $page_title ?></title>
<?php require_once('../subs/links.php'); ?>
</head>

<body> 
<div style="height:2rem;display:block"><div class="progress hide">
      <div class="indeterminate"></div>
  </div></div><?php } ?><div class="house" id="_<?php echo str_replace(' ','_',$page_title) ?>" >
<div class="upload" id="new_form" >
<form id="formData"  href="javascript:;" onSubmit="return(false)">
<?php require_once('generic_form.php') ?>
       <input name="<?php echo $primary_key ?>" id="<?php echo $primary_key ?>" value="<?php if(!empty($col_row[$primary_key])) echo $col_row[$primary_key]; ?>" type="hidden" class="uniqueId" />
            <input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />
            <input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />
			<input name="noreset" type="hidden" id="noreset" value="1" />
  <div class="flt">
  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <button class="btn-floating btn-large red" id="formSave">
      <img src="icons/save.svg" class="large material-icons" />
    </button>
  </div>
</div> </form></div>

 
<script language="javascript" type="text/javascript">
	var pageId='_<?php echo str_replace(' ','_',$page_title) ?>';
	$('#'+pageId).find('[id]').each(function()
	{
		var tmp=$(this).attr('id')+ pageId;
		$(this).attr({'id':tmp});
		$(this).attr({'data-pageid':pageId});
	})
		$('#'+pageId).find('[for]').each(function()
	{
		var tmp=$(this).attr('for')+ pageId;
		$(this).attr({'for':tmp});
	})
	formInitialize(pageId,2);
</script>
</div>
<?php if(empty($ajax)) { ?>

</body>
</html>
<?php } ?>