<!--For modal forms-->
		<?php if(isset($ModalForm) && $ModalForm == true) {?>
			<div class="modal modal-fixed-footer" id="new_form" >
				<form id="formData"  href="javascript:;" onSubmit="return(false)">
					<div class="form-title" id="form_title"></div>
					<div class="modal-content black-text">
						<!--<h4><?php //echo "New ".$page_title; ?></h4>-->
						<?php require_once('generic_form.php') ?> 
					</div>
					<div class="modal-footer">
						<button class="waves-effect waves-green btn" <?php if(isset($formAction)) {?> onClick="<?=$formAction?>"<?php } else{?> id="formSave" <?php }?> >SUBMIT</button>
						<a class=" modal-action modal-close waves-effect waves-green btn-flat">CLOSE</a>
					</div>
					<input name="<?php echo $primary_key ?>" type="text" id="<?php echo $primary_key ?>" value="" style="display:none" class="uniqueId" />
					<input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />
					<input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />
					<input name="modal" type="hidden" id="modal" value="1" />
					<?php if(isset($filter_dialog) && !empty($filter_dialog)) { ?> 
						<input  type="hidden"  id='_linkInput'  name="<?php echo $filter_dialog["column"] ?>" />
					<?php } ?>
				</form>
			</div>
		<?php }else { ?> 
	  		<!--For Swipe forms-->
		   <div class="row" id="new_form" style="display:none"> 
				<form id="formData"  href="javascript:;" onSubmit="return(false)">
					<div class="form-title" id="form_title"></div>
				 <?php require_once('generic_form.php') ?>
				   <input name="<?php echo $primary_key ?>" type="text" id="<?php echo $primary_key ?>" value="" style="display:none" class="uniqueId" />
					<input name="pageType" type="hidden" id="page_type" value="<?php echo $pageType ?>" />
					<input name="page_title" type="hidden" id="page_title" value="<?php echo $page_title ?>" />
					<?php if(isset($filter_dialog) && !empty($filter_dialog)) { ?> 
						<input  type="hidden"  id='_linkInput'  name="<?php echo $filter_dialog["column"] ?>" />
					<?php } ?>
					<a class="btn-floating btn-large red prevPage" data-position="left" data-delay="50" data-tooltip="Previous Page">
					   <img src="icons/chevron_left.svg" class="large material-icons" >
					</a> 
					<div class="flt">
					  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
						<button <?php if(isset($_id)) {?> data-modal="<?=$_id ?>" <?php }?> class="btn-floating btn-large red " id="formSave">
						  <img src="icons/save.svg" class="large material-icons" >
						</button>
						<ul>
							 <li><a data-position="left" data-delay="50" data-tooltip="Close Window" class="tooltipped btn-floating blue" id="close"> <img src="icons/reply.svg" class="material-icons" ></a></li>
							 <li><a data-position="left" data-delay="50" data-tooltip="Reset" class="tooltipped btn-floating green" id="formReset"> <img src="icons/clear.svg" class="material-icons" /></a></li>

						</ul>
					  </div>
					</div>
				</form>
			</div>
		<?php }?>
  	<!--List page-->
	<div class="open_diplay_box" id="open_form"  >
		<div class="upload_bar" id="upload_bar">
			<?php if(isset($filter_dialog) && !empty($filter_dialog)) { ?>  
				<div class="top-control row">
					<a href="javascript:;" class="col s2" id="_backTop" top="_<?php echo $param[$filter_dialog["source"]]['page_title'] ?>">
						<img src="icons/reply_black.svg" class="material-icons" />
						<span style="font-size: 24px">Back</span>
					</a>
					<div class="right-align col s10">
						<h5 id="_linkTitle"></h5>
					</div>
			</div> <?php } ?>
			<div class="top-control"> 
				<div class="input-field col s3">
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
				<div id="_filterList" class="_filterList">
					<?php foreach($category as $k => $f) { if(isset($f['type']) && $f['type'] == 'period') {?>
						<div class='input-field col s3 right'>
							<input class="dateFilter" type="text"  id='<?php echo $category_column[$k] ?>' size="50" name="<?php echo $category_column[$k] ?>" />
							<?php if(isset($filter_dialog) && !empty($filter_dialog)) { ?> <input class="filterValue" type="hidden"  id='_linkFilter'  name="<?php echo $filter_dialog["column"] ?>" /><?php } ?>
							<label class="cat" for='<?php echo $category_column[$k] ?>'>Date Range </label>
						</div>
					<?php } else $jn[]=$f; }?>
					<?php if(!empty($jn)) {?>
						<div class="input-field col s3 right">
							<?php if(isset($filter_dialog) && !empty($filter_dialog)) { ?> <input class="filterValue"  id='_linkFilter' type="checkbox" checked  hidden name="<?php echo $filter_dialog["column"] ?>" /><?php } ?>
							<input type="text" id='_filter' size="50" class="filter" data-value="<?php echo jsonRe_encode($jn)?>"  />
							<label for="_filter">Filter By</label>
						</div>
					<?php } ?>
				</div>
				
			</div>
		</div>
		<div class="list_cont">
			<div id="dialog_display" class="open_select-div collection with-header" <?php if(isset($ModalForm) && $ModalForm == true) {?> data-open="modal" <?php } ?>></div>
			<div class="reloadPage" id="reloadPage"><img class="material-icons" src="icons/refresh.svg"></div>
		</div>
		<div class="pagination"><div id="pagination"></div><input id="active_page" type="hidden" name="page" /></div>
		<?php if(!isset($listFAB) || $listFAB != false || gettype($listFAB) == 'array'){ 
			$actionIsArray = false;
			if(isset($listFAB) && gettype($listFAB) == 'array')$actionIsArray = true;?>
			<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
				<a class="btn-floating btn-large red <?php if(($actionIsArray && in_array("add", $listFAB)) || !isset($listFAB)){?>tooltipped"   data-position="left" data-delay="50" data-tooltip="Add New <?php echo $page_title; ?>"  <?php if(isset($ModalForm)&& $ModalForm == true) {echo 'id="newFloat"'; }else{echo 'id="new"';}?> >
					
				  	<img src="icons/add.svg" class="large material-icons"  /> <?php }else{?> "><img src="icons/ic_grid_off.svg" class="large material-icons"  /> <?php }?>
				</a>
				<ul>
					<?php foreach($actions as $k => $v) { if(!empty($param[$v])){ $act=$param[$v];?>
						<li>
							<a href="#actionpanel<?php echo $k.'_'.$page_title ?>" data-position="left" data-delay="50" data-tooltip="<?php echo $act['page_title'] ?>" class="tooltipped btn-floating <?php echo $_color[$k]; ?> modal-trigger">
								<img src="icons/<?php echo $act['icon'] ?>.svg" class="material-icons" />
							</a>
						</li>
					<?php } }?>
					<?php if(($actionIsArray && in_array("delete", $listFAB)) || !isset($listFAB)){?> 
						<li>
							<a class="btn-floating blue blue-darken-3 tooltipped" id="_multiDelete" data-position="left" data-delay="50" data-tooltip="Delete from <?php echo $page_title; ?>">
								<img src="icons/delete.svg" class="material-icons" />
							</a>
						</li>
					<?php } ?>
				</ul>
		  </div>
		<?php }?>
 	</div>
	<?php foreach($actions as $k=> $v) { if(!empty($param[$v])){ $act=$param[$v];?>
		<form action="<?php echo $act['process_url'] ?>" method="post" name="form2" id="fm_action_<?php echo $k ?>"  data-submit="<?php if(isset($act['submit']))echo 1; else echo '0' ?>" enctype="multipart/form-data" onSubmit="return(false)">
			<div class="modal modal-fixed-footer" id="
			">
				<div class="modal-content">
					<?php $vt=extractForm($act['form']); extract($vt); require('generic_form.php'); ?>
				</div>
				<div class="modal-footer">
					<button href="#fm_action_<?php echo $k ?>" class="waves-effect waves-green btn action-btn">Ok</button>   
					<a class="modal-action modal-close waves-effect waves-green btn-flat">CANCEL</a>
					   <input name="filter_checkbox" class="filter_checkbox" type="hidden" />
				   </div>
			</div>
	  	</form>
    <?php } }

    // I commented it to stop extension count error  
/*	  if(count($extension > 0)){ $ext_c = 1;
		  foreach($extension as $k=> $v) { if(!empty($param[$v])){ $ext=$param[$v]; $tep_id = $k.'_'.$v; ?>
			<?php $vt=extractForm($ext['form']);  ?>
			<?php if(isset($ext['ModalForm']) && $ext['ModalForm'] == true) {?>
	  		<div class="modal modal-fixed-footer" id="newExtForm<?=$tep_id ?>">
				<form action="<?php echo $ext['process_url'] ?>" id="<!-- <!-- extForm<?=$tep_id?> --> -->" onSubmit="return(false)">
					<div class="modal-content">
						<?php extract($vt); require('generic_form.php');?>
					</div>
					<div class="modal-footer">
						<button href="#extForm<?=$tep_id?>" class="waves-effect waves-green btn action-btn">Ok</button>   
						<a class="modal-action modal-close waves-effect waves-green btn-flat">CANCEL</a>
						<input name="filter_checkbox" class="filter_checkbox" type="hidden" />
					</div>
	  			</form>
			</div>
			<?php } else{?>
			 <div id="newExtForm<?=$tep_id?>" style="display:none">
				<form id="extForm<?=$tep_id?>" href="javascript:;" onSubmit="return(false)">
					<?php extract($vt); require('generic_form.php');?>
					<div class="flt">
					  <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
						<button <?php if(isset($_id)) {?> data-modal="<?=$_id ?>" <?php }?> class="btn-floating btn-large red " id="formSave" href="#extForm<?=$tep_id?>">
						  <img src="icons/save.svg" class="large material-icons" >
						</button>
						<ul>
							 <li><a data-position="left" data-delay="50" data-tooltip="Close Window" class="tooltipped btn-floating blue" id="close"> <img src="icons/reply.svg" class="material-icons" ></a></li>
							 <li><a data-position="left" data-delay="50" data-tooltip="Reset" class="tooltipped btn-floating green" id="formReset"> <img src="icons/clear.svg" class="material-icons" /></a></li>

						</ul>
					  </div>
					</div>
				</form>
			</div>
			<?php }?> 
	  	</form> 
    <?php } $ext_c++; } } 
*/
    ?>
	<script language="javascript" type="text/javascript">
		var pageId='_<?php echo str_replace(' ','_',$page_title); ?>';
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

		formInitialize(pageId);
	</script>