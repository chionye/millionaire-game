<?php 
$mod_launch= 0;
foreach($coldesc as $_k0 => $v0) { ?>
<div class="page">
<?php
	foreach($v0 as $_k => $v) {
	if($_k == 'modal'){
		$mod_launch=1;
		$_id='mod'.rand(); 
	}?>
	<div <?php if($_k == 'modal') echo 'class="modal" id="'.$_id.'"';else echo 'class="'.trim(explode(' ', $_k)[0]).'desc"' ?>> 
 		<?php foreach( $v as $_k1 => $v1) { ?>
  			<div class="row "><div class="col s12 "><div class="row card hoverable">
     		<div class="card-content" >
     		<?php if(!empty($_k1)) {?>
     			<div class="card-title black-text"><?php echo $_k1; ?></div> 
			<?php } ?>
			<?php foreach($v1 as $_k2=>$v2) {  ?>
         		<?php if($order[$_k0][$_k][$_k1][$_k2]=="text" ||$order[$_k0][$_k][$_k1][$_k2]=="url" || $order[$_k0][$_k][$_k1][$_k2]=="password" || $order[$_k0][$_k][$_k1][$_k2]=="date" || $order[$_k0][$_k][$_k1][$_k2]=="email" || $order[$_k0][$_k][$_k1][$_k2]=="number" || $order[$_k0][$_k][$_k1][$_k2] == "input" ||$order[$_k0][$_k][$_k1][$_k2]=="hidden") { if($order[$_k0][$_k][$_k1][$_k2] == "input"){$order[$_k0][$_k][$_k1][$_k2]="text";}?>
				 	<div class="input-field <?php echo $cls[$_k0][$_k][$_k1][$_k2] ?>">
					<input <?php if($disabled[$_k0][$_k][$_k1][$_k2]==true) { ?> disabled="disabled" <?php } ?> name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" <?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?> required="required" <?php } ?> class="validate nB " type="<?=$order[$_k0][$_k][$_k1][$_k2]?>" value=""/><label class="active" for="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"><?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?>*<?php }?><?php echo $v2; ?></label></div>
				<?php } else if($order[$_k0][$_k][$_k1][$_k2]=="content") { ?>
				 	<div style="padding-bottom: 20px" class="<?php echo $cls[$_k0][$_k][$_k1][$_k2] ?>"><?php echo $v2; ?></div>
				<?php }
					else if($order[$_k0][$_k][$_k1][$_k2]=="file") { ?>						
					<div class="file-field input-field left <?php echo $cls[$_k0][$_k][$_k1][$_k2] ?>">
					  <div class="btn" style="height: 2.7rem;line-height: 2.7rem;">
						<span>File</span>
						<input name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" <?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?> required="required" <?php } ?> class="validate nB " type="file" onChange="$(this).closest('.file-field').find('.file-path').val($(this).val())"/>
					  </div>
					  <div class="file-path-wrapper">
						<input class="file-path validate" disabled type="text" placeholder="<?php echo $v2; ?>">
					  </div>
					</div>
				<?php }
				else if($order[$_k0][$_k][$_k1][$_k2]=="select") { ?>
		<div class="input-field <?php echo $cls[$_k0][$_k][$_k1][$_k2] ?>">
		
		<select data-empty="<?=$empty[$_k0][$_k][$_k1][$_k2]?>" data-source="<?php if(gettype($src[$_k0][$_k][$_k1][$_k2]) == 'array'){echo $src[$_k0][$_k][$_k1][$_k2]['pageType'];}else echo $src[$_k0][$_k][$_k1][$_k2]?>" name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" <?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?> required="required" <?php } ?> <?php if($disabled[$_k0][$_k][$_k1][$_k2]==true) { ?> disabled="disabled" <?php } ?> <?php if(!empty($onChange[$_k0][$_k][$_k1][$_k2])){$_sel = $onChange[$_k0][$_k][$_k1][$_k2]; $_selFunc = empty($_sel['function']) ? 'heirachy_select(this)':$_sel['function']; ?>onChange="<?=$_selFunc?>" data-target="<?=$_sel['name']?>" data-target_source="<?=$_sel['source']?>" data-target_filter="<?=$_sel['filter']?>" <?php } ?> <?php if(gettype($src[$_k0][$_k][$_k1][$_k2]) == 'array'){?> data-column="<?=$src[$_k0][$_k][$_k1][$_k2]['column']?>"<?php }?> >
		
		  <?php if($empty[$_k0][$_k][$_k1][$_k2]!==false){?><option value="" > Select </option> <?php }?>
          <?php $data=loadData($src[$_k0][$_k][$_k1][$_k2]); foreach($data as $_k3=> $v3) { if(!empty($v3)){?>
          <option data-value="<?=$_k3?>" value="<?=$_k3 ?>" > <?php echo $v3 ?> </option>
          <?php  }} ?>  
		</select><label for="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"><?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?>*<?php }?><?php echo $v2; ?></label></div>
		<?php } 
		else if($order[$_k0][$_k][$_k1][$_k2]=="select_") { ?>
		<div class="input-field <?php echo $cls[$_k0][$_k][$_k1][$_k2] ?> ">
		<select class="get_ext" <?=$src[$_k0][$_k][$_k1][$_k2]?> name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" <?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?> required="required"  class="required" <?php } ?> <?php if($disabled[$_k0][$_k][$_k1][$_k2]==true) { ?> disabled="disabled" <?php } ?>>
            
		</select><label for="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"><?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?>*<?php }?><?php echo $v2; ?></label></div>
		<?php } 
		
		
		else if($order[$_k0][$_k][$_k1][$_k2]=="switch") { ?>
		<div class="input-field <?php echo $cls[$_k0][$_k][$_k1][$_k2] ?>">
		 <?php $data=loadData($src[$_k0][$_k][$_k1][$_k2]); foreach($data as $_k3=> $v3) { $_ky[]=$_k3; $vy[]=$v3; } ?>
		 <label for="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" class="active"><?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?>*<?php }?></label>
		 
		 <div class="switch" style="height:50px">
			<label>
			<?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?>*<?php }?> <?php  echo $vy[0]; ?>
		<input type='checkbox' name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" <?php if($required[$_k0][$_k][$_k1][$_k2]==true) echo "required='required'" ?>>
       	  <span class="lever"></span>
      			<?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?>*<?php }?><?php  echo $vy[1]; ?>
      			
    		</label>
  		</div></div>
  		
		<?php } else if($order[$_k0][$_k][$_k1][$_k2]=="comboBox") { ?>
		<div class="input-field <?php echo $cls[$_k0][$_k][$_k1][$_k2] ?>">
		<input type='text' name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" class="combo capitalize <?php if($required[$_k0][$_k][$_k1][$_k2]==true) echo "required" ?>" data-type="<?php echo $src[$_k0][$_k][$_k1][$_k2]; ?>" data-create="1" >
       	  <label for="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"><?php echo $v2; ?></label></div>
		<?php   } else if($order[$_k0][$_k][$_k1][$_k2]=="unique") { ?>
		<div class="input-field <?php echo $cls[$_k0][$_k][$_k1][$_k2] ?>">		
		  <input name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" type="text" class="capitalize unique" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"  <?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?> required="required" <?php } ?> data-type="<?php echo $pageType; ?>"  /><label class="active" for="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"><?php echo $v2; ?></label></div>
		  <?php } else if($order[$_k0][$_k][$_k1][$_k2]=="textarea") { ?>
		<div class="input-field <?php echo $cls[$_k0][$_k][$_k1][$_k2] ?>">		
		  <textarea name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" class=" materialize-textarea" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"  <?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?> required <?php } ?> /></textarea><label class="active" for="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"><?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?>*<?php }?><?php echo $v2; ?></label></div>
		  <?php } else if($order[$_k0][$_k][$_k1][$_k2]=="checkbox") { ?>
		  <input name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" value="" type="hidden" />
        <?php for($i=0;$i<${$source[$source_count]."count"};$i++) { ?>
        <label><input  type="checkbox" value="<?php echo  ${$source[$source_count]."_id"}[$i] ?>" onClick="changeCheckbox(this,'<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>')" /> <?php echo ${$source[$source_count]."_name"}[$i] ?> </label>
        <?php  } } else if($order[$_k0][$_k][$_k1][$_k2]=="jvdate") { ?>
		<div class="input-field <?php echo $cls[$_k0][$_k][$_k1][$_k2] ?>">
        <input name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" <?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?> required="required" <?php } ?> class="date validate nB" type="date"/><label class="active" for="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"><?php echo $v2; ?></label></div>
        <?php   } else if($order[$_k0][$_k][$_k1][$_k2]=="roles") {
			$pages=json_decode(get_page_module(),true);?>
			<div class="input-field <?php echo $cls[$_k0][$_k][$_k1][$_k2] ?> role">
				<input type="hidden" name='<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>' />
        		<ul class="collection">
				  <?php foreach($pages as $_k => $v ) { $vp=json_decode($v['props'],true);?>
					<li>
					  <div class="collection-header ">
						  <input id='<?php echo str_replace(':','_',$vp['id']) ?>' value='<?php echo $vp['id'] ?>' type="checkbox" class="rlAll keep">
						  <label for='<?php echo $vp['id'] ?>' class="collection-header"><?php echo $_k ?></label>
					  </div>
					  <div class="collection-item">
						  <p class="collection"><?php foreach($v['subs'] as $_k1=> $v1){ $sp=json_decode($v1,true); ?><div class="collection-item"><input class='keep cbr<?php echo $vp['id'] ?>' type="checkbox" id="<?php echo $vp['id'].'_'.$sp['id'] ?>" value="<?php echo $vp['id'].':'.$sp['id'] ?>"><label class="" for="<?php echo $vp['id'].'_'.$sp['id'] ?>"  ><?php echo $sp['name']; ?></label></div><?php } ?></p></div>
					</li> <?php } ?>

				  </ul>
			</div>
        <?php  }else if($order[$_k0][$_k][$_k1][$_k2]=="displaypicture") { ?>
		 <div class="displaypicture <?= $cls[$_k0][$_k][$_k1][$_k2]?>" data-name="<?=$v2?>" ><img name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" src=""></div>
		<?php } else if($order[$_k0][$_k][$_k1][$_k2]=="description") { ?>
		 <div class="description-container <?php if($required[$_k0][$_k][$_k1][$_k2]==true) echo "required" ?>" data-name="<?=$v2?>" name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"></div>
		<?php }else if($order[$_k0][$_k][$_k1][$_k2]=="items") { ?>
		 <div class="items-container <?php if($required[$_k0][$_k][$_k1][$_k2]==true) echo "required ";echo $cls[$_k0][$_k][$_k1][$_k2] ?>" data-desc="<?=$v2?>" name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" ></div>
		<?php }else if($order[$_k0][$_k][$_k1][$_k2]=="generic-slider") { ?>
		 <div class="slider-container <?php if($required[$_k0][$_k][$_k1][$_k2]==true) echo "required" ?>" data-name="<?=$v2?>" name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"></div>
		<?php } else if($order[$_k0][$_k][$_k1][$_k2]=="richtext-body") { ?>
		<div class="richtext-body contentEdittable" style="font-size:22px" name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"></div>
		<?php } else if($order[$_k0][$_k][$_k1][$_k2]=="picture") { ?>
		<div class="input-field col 12">
		<a href="javascript:;" class="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" data-display="picture"  id="uploadPic" data-href="upload_v2_0.php" data-path="../asset/" ><img src="<?php if(isset($col_row[$columns[$_k0][$_k][$_k1][$_k2]]))echo $col_row[$columns[$_k0][$_k][$_k1][$_k2]];else echo 'images/default.png';?>" style="width: 100%;" class='form_pic' data-name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>"><div class="white black-text center-align valign-wrapper" style="position: absolute; right: 0px; top: 0px; opacity: 0.8; margin-top: 20px;"><img class="material-icons black-text medium valign" src="icons/photo_camera.svg"><span class="valign"> Click to change picture </span></div></a>
        <input name="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" id="<?php echo $columns[$_k0][$_k][$_k1][$_k2]; ?>" <?php if($required[$_k0][$_k][$_k1][$_k2]==true) { ?> required="required" <?php } ?> hidden="hidden" type="text" value="<?php if(isset($col_row[$columns[$_k0][$_k][$_k1][$_k2]]))echo $col_row[$columns[$_k0][$_k][$_k1][$_k2]];?>"/></div>
        <?php  } ?> 
	  <?php  } ?></div></div></div></div><?php  }?><?php if($_k=='modal'){?> <div class="modal-footer"> 
	  	<a  class="modal-action blue btn" id='saveModal' >Submit</a>
		  <a class="modal-action modal-close btn-flat ">Back</a>
		 
    </div> <?php }?></div>
    
    <?php } ?>
    </div>
    <?php }?>
	  
