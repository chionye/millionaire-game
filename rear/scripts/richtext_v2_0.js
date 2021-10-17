var defaultTitle='Write the title here' ;
var defaultBody='Write the main content here';
var defaultClass='grey-text text-lighten-1';
$.fn.extend({
		richtextTitle:function() {
			var v=$(this).css({'padding':'0 40px'}).attr({'contentEditable':'true','data-default':defaultTitle}).each(function(i,a){
				if($(this).html().trim()=="") {$(this).html(defaultTitle); $(this).addClass(defaultClass);} $(this).focus();
			})
			.keyup(function(){$('.richtext #_tmp').remove();if($(this).html().trim()=="" || $(this).html().trim()=="<br>") {$(this).html(defaultTitle); $(this).addClass(defaultClass); }})
			.keydown(function(e){
				if(e.which==13){
					e.preventDefault();	$(this).next().focus(); return;	
				}
				$('.richtext #_tmp').remove();
				if($(this).html().trim()==defaultTitle){
					$(this).html('');$(this).removeClass(defaultClass); 
				}
				})
			.focus(function(){
			})
		
			
		}
})
$.fn.extend({
		richtextBody:function(callback) {
			
			var menus =new Array(["visibility","Show Toolbar"],["save","Save to draft"],["publish","Publish"]);
			var color=new Array('yellow darken-1','green','blue','purple','lime','orange','indigo','teal','amber');
			//var control_name = {'code':''}
			var edit_control={'fontname':'fontname.jpg','fontsize':'fontsize.jpg','code':'code','fontcolor':'fontcolor.jpg','bold':'format_bold','underline':'format_underlined','italic':'format_italic','justifyleft':'format_align_left','justifycenter':'format_align_center','justifyright':'format_align_right','indent':'format_indent_increase','outdent':'format_indent_decrease','selectall':'selectall.jpg','delete':'delete','inserthorzontalrule':'inserthorizontalrule.jpg','insertimage':'insertimage.jpg','insertorderedlist':'format_list_numbered','insertunorderedlist':'format_list_bulleted','removeformat':'format_clear','strikethrough':'strikethrough.jpg','subscript':'subscript.jpg','superscript':'superscript.jpg','undo':'undo.jpg','redo':'redo.jpg','createlink':'insert_link','unlink':'unlink.jpg','attachment':'attachment'};
			
			var mini=new Array("bold","italic","justifyright","justifyleft","justifycenter","createlink");
			var side_mini = new Array("attachment","insertunorderedlist","insertorderedlist","indent","outdent","code");
		 
			var rchBody	=$(this);
			rchBody.closest('.card').removeClass('card').addClass('container z-depth-1');
			$(this).css({'padding':'0 40px'}).attr({'contentEditable':'true','data-default':defaultBody}).each(function(i,a){
				if(typeof(callback) === 'function'){
					callback(this);
				}
				$(this).find('img').dblclick(function(){ openImage(this) })
				if($(this).html().trim()=="") {$(this).html(defaultBody); $(this).addClass(defaultClass)}
				
					if($('#edit-tools-h').length < 1){
						var eh = $('<div>').addClass('').attr({'id':'edit-tools-h','contentEditable':'false'}).css({'position':'absolute','padding':'5px','radius':'5px','width':'40px','height':'auto','left':'10px','z-index':'1','right':'unset','transition':'all 0.5s','-webkit-transition':'all 0.5s'}).hide().appendTo($(this).parent());
						
						for(i in side_mini)
						 {
							var v = side_mini[i];
							var anc = $('<a>').addClass('grey-text text-darken-2').attr({'href':'javascript:;','data-id':v,title:edit_control[v]}).appendTo($(eh)).append($('<img>').addClass('material-icons').attr({src:'icons/'+edit_control[v]+'.svg'})).click(
								function(){
									rchBody.find('#_tmp').remove();
									document.execCommand('insertHTML',false,'<img id="_tmp"/>');
									var fn=$(this).attr('data-id'); 
									if(fn=='attachment'){
										$(this).attr({'data-href':defaultPage,'data-display':'all','data-path':'../asset/','data-edit':'1'});
										$(this).uploadDialog({
											callback: function(a,data){
												replace_el(rchBody, a ,data);
											},
											onDrag: ''
										});
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
							 
					 }
						//$('.tooltipped').tooltip({delay: 50});
					}
					
					if($('#edit-tools').length < 1){
						$('#edit-tools').remove();
						var edit_tools = $('<div>').addClass('z-depth-2').attr({'id':'edit-tools','contentEdittable':'false'}).css({'color':'#FFF','width':'auto','background-color':'#fff','position':'fixed','padding':'5px','radius':'5px'}).hide().appendTo($(document.body)); 
					 for(i in mini)
					 {
						var v=mini[i]
						$('<a>').attr({'href':'javascript:;','data-id':v}).appendTo($(edit_tools)).append($('<img>').addClass('material-icons').attr({src:'icons/'+edit_control[v]+'.svg'})).click( function(){ var fn=$(this).attr('data-id'); 
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
	

function getDataDiv(ty,img){	
	if(ty=='picture')	{
		var ar = ['height', 'width'], immm = {};
		for(var i in img){var ii = i; if($.inArray(i, ar) != -1){ii = 'data-'+i;} immm[ii] = img[i];}
		var imgi = $('<img>').dblclick(function(){
			var aa = $(this);
			aa.parent().attr({id:'_tmp'});
			var attr = attrToObj(this.attributes);
			$(this).modify_resource({
				callback: function(a,data){
					replace_el(aa.closest('.richtext-body'), a , data);
				},
				data : attr
			})
		}).attr(immm).css({'margin':img.margin,width:'100%',height:'100%'});
		var imgii = $('<div>').append(imgi);
		imgii.resizable();
	}else if(ty == 'pdf' || ty == 'document' || ty == 'archive'){
		var imgii=$('<div>').dblclick(function(){
			var attr = attrToObj(this.attributes);
			var aa = $(this);
			aa.attr({id:'_tmp'});
			$(this).attr({'data-display':ty});
			$(this).modify_resource({
				callback: function(a,data){
					replace_el(aa.closest('.richtext-body'), a , data);
				},
				data : attr
			})
		});
		var cd_img = $('<a>').css({'background-color':'teal',padding:'5px 15px 6px',color:'white','border-radius': '3px','margin': '3px',float: 'left'}).addClass('richtext-anchor').attr({href:img.src,title:img.title,download:true,contentEditable:false}).text('Download '+img.title).appendTo(imgii);
	}else if(ty=='audio' || ty=='video'){
		var imgii=$('<div>').dblclick(function(){
			var attr = attrToObj(this.attributes);
			var aa = $(this);
			aa.attr({id:'_tmp'});
			$(this).attr({'data-display':ty});
			$(this).modify_resource({
				callback: function(a,data){
					replace_el(aa.closest('.richtext-body'), a , data);
				},
				data : attr
			})
		}).addClass('').css({'padding':'10px','width':img.width,'margin':img.margin,'align':img.align})
	
		var name =$('<div>').appendTo(imgii).addClass("card-action truncate");
		var ing = $('<'+ty+'>').appendTo(name).attr({'controls':'controls','width':'100%','height':'100%','id':ty+'_control'}).css({'width':'100%'});
		var src = $('<source>').addClass('richtext-anchor').appendTo(ing).attr({'src':img.src});
	}
	return imgii;
}

function replace_el(rchBody, el, data){
	data['data-edit'] = 1;
	var imgii= getDataDiv(data.type, data);
	var rb=rchBody.focus();
	if($(rb).html().trim()==defaultBody){
		$(rb).html('');$(rb).removeClass(defaultClass);
	}
	rchBody.find('#_tmp').replaceWith($(imgii));
}

function attrToObj(attr){
	var obj = {};
	$.each(attr, function(i,v) {
		if(v.specified) {
		 obj[v.name] = v.value;
		}
  	});
	return obj;
}