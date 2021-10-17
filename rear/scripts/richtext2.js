var defaultTitle='Write the title here' ;
var defaultBody='Write the main content here';
var defaultClass='grey-text text-lighten-1';

$.fn.extend({
		richtext:function(callback) {
			
			
			
			var menus =new Array(["visibility","Show Toolbar"],["save","Save to draft"],["publish","Publish"]);

			var color=new Array('yellow darken-1','green','blue','purple','lime','orange','indigo','teal','amber');
			//var control_name = {'code':''}
			var edit_control={'fontname':'fontname.jpg','fontsize':'fontsize.jpg','code':'code','fontcolor':'fontcolor.jpg','bold':'format_bold','underline':'format_underlined','italic':'format_italic','justifyleft':'format_align_left','justifycenter':'format_align_center','justifyright':'format_align_right','indent':'format_indent_increase','outdent':'format_indent_decrease','selectall':'selectall.jpg','delete':'delete','inserthorzontalrule':'inserthorizontalrule.jpg','insertimage':'insertimage.jpg','insertorderedlist':'format_list_numbered','insertunorderedlist':'format_list_bulleted','removeformat':'format_clear','strikethrough':'strikethrough.jpg','subscript':'subscript.jpg','superscript':'superscript.jpg','undo':'undo.jpg','redo':'redo.jpg','createlink':'insert_link','unlink':'unlink.jpg','imageinsert':'wallpaper'};
			var mini=new Array("bold","italic","justifyright","justifyleft","justifycenter","createlink");
			var side_mini = new Array("imageinsert","insertunorderedlist","insertorderedlist","indent","outdent","code",);
		 
			var v=$(this).find('.richtext-title').addClass('input3').attr({'id':'richtext-title','contentEditable':'true'}).each(function(i,a){
				if($(this).html().trim()=="") {$(this).html(defaultTitle); $(this).addClass(defaultClass); disableSave()} $(this).focus();
			})
			.keyup(function(){$('.richtext #_tmp').remove();if($(this).html().trim()=="" || $(this).html().trim()=="<br>") {$(this).html(defaultTitle); $(this).addClass(defaultClass); disableSave()}})
			.keydown(function(e){
				if(e.which==13){
					e.preventDefault();	$(this).next().focus(); return;	
				}
				$('.richtext #_tmp').remove();
				if($(this).html().trim()==defaultTitle){
					$(this).html('');$(this).removeClass(defaultClass); enableSave();
				}
				})
			.focus(function(){
			 DisableTools();
			 window.setTimeout(function() {
			var sel, range;
			if (window.getSelection && document.createRange) {
				range = document.createRange();
				range.selectNodeContents(this);
				range.collapse(true);
				sel = window.getSelection();
				sel.removeAllRanges();
				sel.addRange(range);
			} else if (document.body.createTextRange) {
				range = document.body.createTextRange();
				range.moveToElementText(this);
				range.collapse(true);
				range.select();
			}
		}, 1);})
		
			
			$(this).find('.richtext-body').addClass('input3').attr({'id':'richtext-body','contentEditable':'true'}).each(function(i,a){

				$(this).find('img').dblclick(function(){ openImage(this) })
				if($(this).html().trim()=="") {$(this).html(defaultBody); $(this).addClass(defaultClass)}
				// create the floating action buttons
					  
				
				if($('.richtext .btn_d').length > 0){
					$('.richtext .btn_d').remove();
				}
					//if($('.richtext .btn_d').length < 1){
						var btn_div=$('<div>').appendTo($(this).parent()).addClass("fixed-action-btn btn_d").attr({});
					  var Btn = $('<a>').appendTo(btn_div).addClass("btn-floating btn-large red").html('<i class="large material-icons">add</i>');
					  var btn_ul=$('<ul>').appendTo(btn_div);
					  for(var i=0; i< menus.length;i++)
					  {
						  var btn_li=$('<li>').appendTo(btn_ul);
							var cn =$('<div>').appendTo(btn_ul).attr({'id':menus[i][1]}).css({'position':'relative'});
								  //cn.style.position ="relative"
							var btn_a=$('<a>').appendTo(cn).addClass("tooltipped btn-floating "+color[i]).attr({'data-position':"left", 'data-delay':"50", 'data-tooltip':menus[i][1],'id':menus[i][0],'name':menus[i][1]}).click(function(){

							if($(this).prop('data-disabled') !=undefined && $(this).prop('data-disabled')==1)return 0;

						if($(this).text()=='publish'){
						var title =$("#richtext-title").html();
						  if(title==defaultTitle || title.trim()=="")
						  {
							  Materialize.toast('Please give this content a title before publishing!', 4000);
						  }else callback(1)
							}else if($(this).text()=='save'){
						var title =$("#richtext-title").html();
						  if(title==defaultTitle || title.trim()=="")
						  {
							  Materialize.toast('Please give this content a title before saving!', 4000);
						  }else callback(0)
							}else if($(this).text()=='wallpaper')
							{

								$(this).attr({'data-href':defaultPage,'data-path':defaultPath,'data-edit':'1'})
								uploadModal(this,function(a,img,ty)
									{
										var imgii= returnObj(ty,img);
										var rb=$('#richtext-body').focus();
										if($(rb).html().trim()==defaultBody){ $(rb).html('');$(rb).removeClass(defaultClass)}
											//console.log(imgii);
										document.execCommand("insertHTML",'',imgii.outerHTML);
										//$('#richtext-body #_tmp').replaceWith($(imgii));

									})

							}else if($(this).text()=='visibility')
							{
								var p=$('.richtext #_tmp').position();
								y = p.top -70+'px';
								x =p.left+'px';
								$('#edit-tools').css({'top':y,'left':x}).fadeIn();
								$('.richtext #_tmp').remove();
							}

							})
								  li =$('<img>').attr({src:'icons/'+menus[i][0]+'.svg'}).appendTo(btn_a).addClass("material-icons");
					  }
					//}
				
					 //$('.tooltipped').tooltip({delay: 50});
				
					if($('#edit-tools-h').length < 1){
						var eh = $('<div>').addClass('').attr({'id':'edit-tools-h','contentEditable':'false'}).css({'position':'fixed','padding':'5px','radius':'5px','width':'40px','height':'auto','transition':'all 0.5s','-webkit-transition':'all 0.5s'}).hide().appendTo($(document.body));
						
						for(i in side_mini)
						 {
							var v=side_mini[i]
							var anc = $('<a>').addClass('grey-text text-darken-2').attr({'title':v,'href':'javascript:;','data-id':v}).appendTo($(eh)).html('<i class="small material-icons">'+edit_control[v]+'</i>').click(
								function(){
									var fn=$(this).attr('data-id'); 
									if(fn=='imageinsert'){
										console.log(defaultPage);
										$(this).attr({'data-href':defaultPage,'data-path':defaultPath,'data-edit':'1'})
										uploadModal(this,function(a,img,ty)
											{
												var imgii= returnObj(ty,img);
												var rb=$('#richtext-body').focus();
												if($(rb).html().trim()==defaultBody){
													$(rb).html('');$(rb).removeClass(defaultClass)
												}
													//console.log(imgii.outerHTML);
												//document.execCommand("insertHTML",'',imgii.outerHTML);
												$('#richtext-body #_tmp').replaceWith($(imgii));

											})
									}else{
										if(navigator.appName=='Microsoft Internet Explorer')
											{
												if(fn=='code'){
													document.execCommand('backColor',"","#e0f7fa");
													document.execCommand('fontName',"","monospace");
													document.execCommand('indent',"",null);

												}else{
													document.execCommand(fn,"",null);
												}

											}
											else{
												if(fn=='code'){
													document.execCommand('backColor',"","#e0f7fa");
													document.execCommand('fontName',"","monospace");
													document.execCommand('indent',"",null);
												}else{
													document.execCommand(fn,"",null);
												}
											} 
									}
								}
							);
							 
							 if(v=="imageinsert"){
								 $(anc).mouseover(function(){
								$('.richtext #_tmp').remove();
								document.execCommand('insertHTML',false,'<img id="_tmp"/>'); 
							})
							 }
						 }
						//$('.tooltipped').tooltip({delay: 50});
					}
					
					if($('#edit-tools').length < 1){
						$('#edit-tools').remove();
						var edit_tools = $('<div>').addClass('z-depth-2').attr({'id':'edit-tools','contentEdittable':'false'}).css({'color':'#FFF','width':'auto','background-color':'#fff','position':'fixed','padding':'5px','radius':'5px'}).hide().appendTo($(document.body)); 
					 for(i in mini)
					 {
						var v=mini[i]
						$('<a>').attr({'href':'javascript:;','data-id':v}).appendTo($(edit_tools)).html('<i class="small material-icons">'+edit_control[v]+'</i>').click( function(){ var fn=$(this).attr('data-id'); 
						if(fn=='createlink'){
						}else{
							if(navigator.appName=='Microsoft Internet Explorer')
								{
									if(fn=='code'){
										document.execCommand('backColor',"","#e0f7fa");
										document.execCommand('fontName',"","monospace");
										document.execCommand('indent',"",null);

									}else{
										document.execCommand(fn,"",null);
									}

								}
								else{
									if(fn=='code'){
										document.execCommand('backColor',"","#e0f7fa");
										document.execCommand('fontName',"","monospace");
										document.execCommand('indent',"",null);
									}else{
										document.execCommand(fn,"",null);
									}
								} 
							}
						});
					 }
					}
				$('.tooltipped').tooltip({delay: 50});



			}).focus(function(){
				enableTools();
			})
			.keyup(function(e){
				if($(this).html().trim()=="" || $(this).html().trim()=="<br>") {
					
					$(this).html(defaultBody); $(this).addClass(defaultClass)
				}

				showTools(e);


			})
			.keydown(function(e){
				if($(this).html().trim()==defaultBody){
					$(this).html('');$(this).removeClass(defaultClass)
				}; 

			})
			.mouseup(function(e){
				showTools(e);
				w = parseFloat($('.richtext').css('width')) + 10;
				//w = w-200;
				$('#edit-tools-h').css({'z-index':'20000','top':e.clientY+-70+'px','right':w+'px'}).fadeIn();
				
				//console.log(e);
			})
			.blur(function(){
				if(window.getSelection() ==''){
					$('#edit-tools').fadeOut();
					$('#edit-tools-h').fadeOut();
				}

			})
		//end attach reactid;
		
		DisableTools();
		if($('#richtext-title').html().trim()==defaultTitle)disableSave();
		function showTools(e)
		{
			if(window.getSelection() !='')
			{
				//console.log(window.getSelection().anchorOffset);
				y = e.clientY+'px';
				x =e.clientX+'px';
				
				$('#edit-tools').css({'z-index':'20000','top':e.clientY+-70+'px','left':e.clientX+-20+'px'}).fadeIn();
			}else $('#edit-tools').fadeOut();
		}
		function DisableTools()
		{
			$('#wallpaper').addClass('disabled').prop({'data-disabled':1});$('#visibility').addClass('disabled').prop({'data-disabled':1});
		}
		function enableTools()
		{
			$('#wallpaper').prop({'data-disabled':2}).removeClass('disabled');$('#visibility').prop({'data-disabled':2}).removeClass('disabled');
		}
		function disableSave()
		{
			$('#publish').addClass('disabled').prop({'data-disabled':1});$('#save').addClass('disabled').prop({'data-disabled':1});
		}
		function enableSave()
		{
			$('#publish').removeClass('disabled').prop({'data-disabled':0});$('#save').removeClass('disabled').prop({'data-disabled':0});
		}	
		}
	})
	

function returnObj(ty,img)
{
	if(ty=='picture')
	{
		var imgi =$('<img>').attr({'ondblclick':'openImage(this,"'+ty+'")'}).attr(img).css({'margin':img.margin});
		var imgii = $('<p>').append(imgi).get(0);
		
	}else if(ty == 'pdf'){
		var imgii=$('<div>').attr({'ondblclick':'openImage(this,"'+ty+'")'}).addClass('card-panel hoverable');
		var cd_img = $('<div>').addClass('card-image').css({'height':'100px','overflow':'hidden'}).appendTo(imgii);
		var cd_img1 = $('<img>').addClass('material-icons large').attr({src:'icons/picture_as_pdf.svg'}).appendTo(cd_img);
		var cd_name = $('<div>').attr({'data-src':img.src}).addClass('card-action truncate').html('PDF').appendTo(imgii);
	}else if(ty=='audio')
	{
		var imgii=$('<div>').attr({'ondblclick':'openImage(this,"'+ty+'")'}).addClass('').css({'padding':'10px','width':img.width,'margin':img.margin,'align':img.align})
	
		var name =$('<div>').appendTo(imgii).addClass("card-action truncate");
		var ing = $('<audio>').appendTo(name).attr({'controls':'controls','width':'100%','height':'100%','id':'audio_control'}).css({'width':'100%'});
		var src = $('<source>').appendTo(ing).attr({'src':img.src});
	}else if(ty=='video')
	{
		var imgii=$('<div>').attr({'ondblclick':'openImage(this,"'+ty+'")'}).addClass('').css({'padding':'10px','width':img.width,'margin':img.margin,'align':img.align})
	
		var name =$('<div>').appendTo(imgii).addClass("card-action truncate");
		var ing = $('<video>').appendTo(name).attr({'controls':'controls','width':'100%','height':'100%','id':'video_control'}).css({'width':'100%'});
		var src = $('<source>').appendTo(ing).attr({'src':img.src});
	}
	return imgii;
}