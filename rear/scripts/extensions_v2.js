// JavaScript Document
var _date=new Date();
var _today=_date.getFullYear()+'-'+(_date.getMonth()+1)+'-'+_date.getDate();
function emptyState(currPage)
{
	var ehd=$('<div>').addClass('center').appendTo(currPage).css({'width':'100%','padding':'5%'}).attr('data-empty','empty');
	var eText='No result found';
	$('<i>').addClass('material-icons  grey-text').html('warning').appendTo(ehd);
	$('<span>').html(eText).addClass(' grey-text').appendTo(ehd).css({'font-size':'1.5rem','margin':'10%'})
	$(ehd).show();
	return ehd;
}
function numberFormat(_number, _sep) {
	_number +='';
    _number = typeof _number != "undefined" && _number > 0 ? _number : "";
    _number = _number.replace(new RegExp("^(\\d{" + (_number.length%3? _number.length%3:0) + "})(\\d{3})", "g"), "$1 $2").replace(/(\d{3})+?/gi, "$1 ").trim();
    if(typeof _sep != "undefined" && _sep != " ") {
        _number = _number.replace(/\s/g, _sep);
    }
    return _number;
}
function getCookie(cname) 
{
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}
$.fn.extend(
{
	createJournalRow: function(f,p,i)
	{
		var rw=$('<div>').appendTo($(this)).addClass('row l-row');
		for(k in f)
		{
			var inp=$('<input>').addClass('input-field col '+f[k].c).appendTo(rw).val(f[k].v).attr({'type':'text','placeholder':f[k].d,'name':f[k].n+i});
			if(f[k].t!=undefined)
			{
				if(f[k].t=='ac')
				{
					//$('<div>').after($(inp)).append($(inp));
					$(inp).addClass('combo').attr({'data-type':'accounts'}).comboInit();
				}else if(f[k].t=='am')
				{
					$(inp).keyup(function() { balance(p); } )
				}
			}
		}
		$('<a>').attr({'href':'javascript:;'}).html('<i class="material-icons">clear</i>').appendTo(rw).click(function(){$(this).parent().remove(); balance(p);});
		balance(p);
	}
})

$.fn.extend(
{
	createItemRow: function(f,p)
	{
		if(f.i==undefined) return 0; else var i=f.i;
		if($(this).attr('data-account') !=undefined) {var dl=3; var al=2} else {var dl=4; var al=3}
		var rw=$('<div>').appendTo($(this)).addClass('row l-row');
	if(f.itemid !=undefined)$('<input>').appendTo(rw).val(f.itemid).attr({'type':'text','name':'itemid'+i}).hide();
	if(f.it_id !=undefined)$('<input>').appendTo(rw).val(f.it_id).attr({'type':'text','name':'it_id'+i}).hide();
	if(f.old_discount !=undefined)$('<input>').appendTo(rw).val(f.old_discount).attr({'type':'text','name':'old_discount'+i}).hide();
	if(f.old_amount !=undefined)$('<input>').appendTo(rw).val(f.old_amount).attr({'type':'text','name':'old_amount'+i}).hide();
	if(f.in_id !=undefined)$('<input>').appendTo(rw).val(f.in_id).attr({'type':'text','name':'in_id'+i}).hide();
	if(f.tid !=undefined)$('<input>').appendTo(rw).attr({'type':'text','name':'tid'+i}).hide().val(f.tid);
	if(f.desc !=undefined)$('<input>').addClass('input-field col s'+dl).appendTo(rw).val(f.desc).attr({'type':'text','placeholder':'Description','name':'description'+i});
	if(f.invoice !=undefined)$('<input>').addClass('input-field col s3').appendTo(rw).val(f.invoice).attr({'type':'text','placeholder':'Invoice','name':'invoice'+i,'readonly':true});
	if(f.date !=undefined)$('<input>').addClass('input-field col s12 m2').appendTo(rw).val(f.date).attr({'type':'text','placeholder':'Date','name':'date'+i,'readonly':true});
	if($(this).attr('data-account') !=undefined){if(f.account !=undefined){var acn=$('<div>').addClass('col s12 m2').css({'padding':'0px','margin-top':'-1px'}).appendTo(rw);$('<input>').addClass('combo').appendTo(acn).val(f.account).attr({'type':'text','placeholder':'Account','name':'account'+i,'data-type':'accounts'}).comboInit();} }
	if(f.qty !=undefined)$('<input>').addClass('input-field col s2 m2').appendTo(rw).val(f.qty).attr({'type':'number','placeholder':'Qty','name':'quantity'+i}).keyup(function()
	{ var rt =$(this).next(); var am = $(rt).next();
		var amt=parseFloat($(this).val()) * parseFloat($(rt).val());
		$(am).val(amt);sum(p);
	});
	
	if(f.rate !=undefined)$('<input>').addClass('input-field col s2 m2').appendTo(rw).val(f.rate).attr({'type':'number','placeholder':'Rate','name':'rate'+i}).keyup(function()
	{ var qt =$(this).prev(); var am = $(this).next();
		var amt=parseFloat($(this).val()) * parseFloat($(qt).val());
		$(am).val(amt);sum(p);
	});
	if(f.amountdue !=undefined)$('<input>').addClass('input-field col s2').appendTo(rw).val(f.amountdue).attr({'type':'number','placeholder':'Amount','name':'amountdue'+i,'readonly':true})

	if(f.discount !=undefined)$('<input>').addClass('input-field discount col s2 m2').appendTo(rw).val(f.discount).attr({'type':'number','placeholder':'Discount','name':'discount'+i}).keyup(function()
	{  
		
		var amd =$(this).prev(); var amt = $(this).next();
		if($(this).val()=='') $(this).val(0);
		if(parseFloat($(this).val())>parseFloat($(amd).val())) $(this).val($(amd).val());
		$(amt).val(parseFloat($(amd).val())
			-parseFloat($(this).val()))
		sum(p);
	});
	
	if(f.rate !=undefined && f.qty !=undefined)
	{
		var am=f.rate * f.qty;
		$('<input>').addClass('input-field amount col s'+al).appendTo(rw).val(am).attr({'type':'number','placeholder':'Amount','name':'amount'+i}).keyup(function()
		{ var rt =$(this).prev(); var qt = $(rt).prev();
			var qty= (parseFloat($(qt).val()) ==0) ? 1: parseFloat($(qt).val()) ;
			
			var amt=parseFloat($(this).val()) / qty ;
			$(rt).val(amt);sum(p);
		});
	}
	if(f.amountdue !=undefined && f.discount !=undefined)
	{
		var am=f.amountpaid==undefined ? f.amountdue - f.discount: f.amountpaid;
		$('<input>').addClass('input-field amount col s2').appendTo(rw).val(am).attr({'type':'number','placeholder':'Amount','name':'amount_paid'+i}).keyup(function()
		{ var ds =$(this).prev(); var amd = $(ds).prev();
			if(parseFloat($(this).val()) > parseFloat($(amd).val())
			-parseFloat($(ds).val())) $(this).val(parseFloat($(amd).val())
			-parseFloat($(ds).val()))
			sum(p);
		});
	}
	
	$('<a>').attr({'href':'javascript:;'}).html('<i class="material-icons">clear</i>').appendTo(rw).click(function(){$(this).parent().remove(); sum(p);});
	$(rw).appear();

	}
});
$.fn.extend(
{
	createSoldItemRow: function(f,p)
	{
		var nD=$("<a>").addClass("collection-item").css({'float':'left','width':'100%'}).appendTo($(this)).attr({'href':'javascript:;'}).click(function(){
			$('#_item_display'+p).createItemRow(f,p);
		});
		var nDiv=$('<div>').css({'float':'left','width':'100%'}).appendTo(nD);
		$.each(f, function(j, col)
		{
			var vt="";
			if(j=="qty")
			{ 
				nDiv.append($("<span></span>").text(col + " ")).css({'font-size':'12px'});
			} else if (j=="rate")
			{
				nDiv.append($("<span></span>").text(col + " ").css({'float':'right','font-weight':'bold','font-size':'12px'}));
			} else if (j=="amount")
			{
				nDiv.append($("<span></span>").text(col + " ").css({'float':'right','font-weight':'bold','font-size':'12px'}));
			}else if (j=="d")
			{
				nDiv.append($("<div>").html(col + " "));
			}else if (j=="desc")
			{
				nDiv.prepend($("<h6 >").css({'margin-top':'0px'}).html(col + " "));
			}else if (col.f=="a")
			{
				nDiv.append(col.v+ " ");
				vt+=col.v;
				nDiv.prop("dName",vt)
			}
		});
	}

});
$.fn.extend(
{
	noref:function(callback)
	{
		$(this).off('click');
		$(this).on('click',function(){
				var thisObj=$(this);
		if($(this).attr('data-active')==undefined)
		{
			this.pid=$(this).attr('href');
			
			$(this).attr({'href':'javascript:;'})
			$('.progress').removeClass('hide');
			var nId=new Date().getTime();
			var nDiv=$("<div></div>").hide().attr({'id':nId});
			var crr=$(this);
			if(this.pid.indexOf('?')==-1) var url=this.pid+'?ajax=1';
			else var url=this.pid+'&ajax=1';
			$(nDiv).load(url,function(responseTxt, statusTxt, xhr)
				{
					$('.progress').addClass('hide');
					if(statusTxt == "success")
						
						$(crr).attr({'data-active':nId})
						$("#default_div").append(nDiv);
						$(".active-div:first").swapDiv($(nDiv));
						$(".active-div").removeClass("active-div");
						$(nDiv).addClass("active-div");
						if(callback){ callback(); }
					if(statusTxt == "error")
						Materialize.toast('Connection Error', 4000);
				});
		}
			else
			{
				var nd=$(this).attr('data-active');
				$(".active-div:first").swapDiv($('#'+nd));	
				$(".active-div").removeClass("active-div");
				$($('#'+nd)).addClass("active-div");
				console.log('buns');
				//if(callback){ callback(); }
			}
		})
		
		/*$(this).click(function(){
		var thisObj=$(this);
		if($(this).attr('data-active')==undefined)
		{
			this.pid=$(this).attr('href');
			
			$(this).attr({'href':'javascript:;'})
			$('.progress').removeClass('hide');
			var nId=new Date().getTime();
			var nDiv=$("<div></div>").hide().attr({'id':nId});
			var crr=$(this);
			if(this.pid.indexOf('?')==-1) var url=this.pid+'?ajax=1';
			else var url=this.pid+'&ajax=1';
			$(nDiv).load(url,function(responseTxt, statusTxt, xhr)
				{
					$('.progress').addClass('hide');
					if(statusTxt == "success")
						
						$(crr).attr({'data-active':nId})
						$("#default_div").append(nDiv);
						$(".active-div:first").swapDiv($(nDiv));
						$(".active-div").removeClass("active-div");
						$(nDiv).addClass("active-div");
					if(statusTxt == "error")
						Materialize.toast('Connection Error', 4000);
				});
		}
			else
			{
				var nd=$(this).attr('data-active');
				$(".active-div:first").swapDiv($('#'+nd));	
				$(".active-div").removeClass("active-div");
				$($('#'+nd)).addClass("active-div");
			}
		});*/
	}
})
$.fn.extend(
{
	createRow: function(field)
	{
		var num=Math.floor(12/order.length);
		var nDiv=$('<div>').addClass('row col s10').appendTo($(this));
		$.each(field.c, function(j, col)
		{
			var vt="";
			if(order[j]=="text")
			{ 
				nDiv.append(col+" ");
			} else if (order[j]=="span")
			{
				nDiv.append($("<span></span>").text(col + " ").addClass('col s'+num).css({'font-size':'11px','font-style':'italic'}));
			} else if (order[j]=="rightSpan")
			{
				nDiv.append($("<span></span>").text(col + " ").css({'float':'right','font-weight':'bold','font-size':'12px'}));
			}else if (order[j]=="d")
			{
				nDiv.append($("<div>").html(col + " "));
			}else if (order[j]=="boldSpan")
			{
				nDiv.append($("<div>").addClass('col s'+num).css({'margin-top':'0px','font-weight':'bold'}).html(col + " "));
			}else if (order[j]=="a")
			{
				nDiv.append(col+ " ");
				vt+=col;
				nDiv.prop("dName",vt)
			}
		});
	}

});
$.fn.extend(
{
	createSetupRow: function(field)
	{
		var nDiv=$('<div>').css({'float':'left'}).appendTo($(this));
		$.each(field.c, function(j, col)
		{
			var vt="";
			
				nDiv.append($("<div>").html(col.v + " "));
		});
	}

});

$.fn.extend(
{
	myDropOptions: function(v){
		
		var nDiv=$(this);
		$(this).css({'position':'relative'})
		var uc_optn = $('<div>').addClass('uploadOptn').css({'position':'absolute','top':'5px','right':'5px','z-index':'10'}).appendTo(nDiv).click(
		function(){
			$(this).parent().children('.ed_del').show(300);
			
			})
	 	var uc_i = $('<i>').addClass('material-icons indigo-text text-darken-1 pointer').html('more_vert').appendTo(uc_optn)
		
		var ed2 = $('<span>').addClass('row')
		var ed2i = $('<i>').addClass('material-icons grey-text left pointer').html('mode_edit').appendTo(ed2);
		var ed2p = $('<p>').addClass('uc_arng').html('Edit').appendTo(ed2);
			
		var ed3 = $('<span>').addClass('row')
		var ed3i = $('<i>').addClass('material-icons grey-text left').html('delete').appendTo(ed3);
		var ed3p = $('<p>').addClass('uc_arng').html('Delete').appendTo(ed3);
		if(v){
			if(v.del){ed3.on('click',v.del)}
			if(v.edit){ed2.on('click',v.edit)}
		}
		
		var uc_dv = $('<ul>').css({'top':'25px','right':'5px'}).addClass('ed_del').append(ed2).append(ed3).appendTo(nDiv);
		
	}
}
)


$.fn.extend(
{
	uploadOptn: function(c, f)
	{
		var nDiv=$(this);
		$(this).css({'position':'relative'})
		var uc_optn = $('<div>').addClass('uploadOptn').css({'position':'absolute','top':'-6px','right':'-6px','z-index':'10'}).appendTo(nDiv).click(
		function(){
			$(this).parent().children('.ed_del').show(300);
			
			})
	 	var uc_i = $('<i>').addClass('material-icons grey-text text-darken-1').html('arrow_drop_down_circle').appendTo(uc_optn)
		
		var ed2 = $('<span>').addClass('row').click(
			function()
			{
				
				$(this).parent().hide(300)
				var point = $(this).closest('a');
				var ref = $(this).closest('.ui-draggable');
				var ref2 = $(this).closest('#ui_folda')
				//ref2.removeClass('ui-droppable').droppable('destroy')
				
				var edit = point.find('.card-action').attr({'contenteditable':'true'}).addClass('grey-text').css({'cursor':'auto'}).focus();
				
				
				var panel1 = ref2.find('.card-panel')
				$(panel1).off("click",loadContents)
				var panel2 = ref.find('.card-panel')
				$(panel2).off("click",configure)
				edit.keyup(function(e){
					
						
						if(e.keyCode==13)
						{
							$(this).closest('#ui_folda').addClass('ui-droppable')
							//$(this).removeAttr('contenteditable').removeClass('grey-text').css({'cursor':'unset'});
							$(this).attr({'contenteditable':'false'}).removeClass('grey-text')
							var new_name = $(this).text();
							var ref = $(this).closest('a')
							var old = ref.attr('data-src');
							var ext = old.slice(old.lastIndexOf('.'))
							var inc_pth = old.slice(0,old.lastIndexOf(ref.attr('data-name')));
							var type = ref.attr('data-type');
							if(type == undefined)
							var new_pth = inc_pth+new_name; else var new_pth = inc_pth+new_name+ext;
							console.log('inc_pth: '+new_pth)
							
							var urlsend=$('#upload_modal').attr('data-href');
							$('#upload_modal .progress').removeClass('hide')
							
							$.post(urlsend,{'newPath':new_pth,'oldPath':old},function(response)
								{
									$('#upload_modal .progress').addClass('hide')
									
									if(type == undefined)
									{
										ref.find('.card-panel').on("click",loadContents)
									}else{
										ref.find('.card-panel').on("click",configure)
									}
									
									console.log(response)
									if(response==1)
									{
										ref.attr({'data-src':new_pth})
									}
								}
							)
							
						}
					})
				
			
			}
		)
		var ed2i = $('<i>').addClass('material-icons grey-text left').html('mode_edit').appendTo(ed2);
		var ed2p = $('<p>').addClass('uc_arng').html('Edit').appendTo(ed2);
			
		var ed3 = $('<span>').addClass('row').click(
			function(){
				$('#upload_modal .progress').removeClass('hide')
				var urlsend=$('#upload_modal').attr('data-href');
				var ref = $(this).closest('a')
				var src = ref.attr('data-src');
				var type = ref.attr('data-type');
				if(type == undefined)typ = 0; else typ = 1;
				$(this).questionBox('Are you sure you want to delete',
				  function(){
					$.post(urlsend,{'type':typ,'delPath':src},function(response)
						{
							$('#upload_modal .progress').addClass('hide')
							console.log(response)
							if(response==1)
							{
								ref.addClass('go_out')
								setTimeout(function(){
									ref.remove()
									},800)
							}
						}
					)
				  }
				)
					
			})
		var ed3i = $('<i>').addClass('material-icons grey-text left').html('delete').appendTo(ed3);
		var ed3p = $('<p>').addClass('uc_arng').html('Delete').appendTo(ed3);
		
		var uc_dv = $('<ul>').addClass('ed_del').append(ed2).append(ed3).appendTo(nDiv)
		
		
		
	}
});

$.fn.extend(
{
	closeModalBox: function(a)
	{
		//alert($(this).attr('id'));
		if(a){colo = a.colo;}else{colo = 'white';}
		var id = $(this).attr('id');
		var close_icon = $('<i>').css({'position':'fixed','top':'0','left':'0','z-index':'10','cursor':'pointer'}).addClass('material-icons '+colo+'-text medium ').html('arrow_back').appendTo($(this)).click(function(){
		  	$('#'+id).closeModal();
			//$('#c'+p_id+'>li>.collapsible-body>ul')
		  });
	}
})

$.fn.extend(
{
	dropDownInput: function(x,s,f)
	{
		$(this).parent().css({'position':'relative'});
		id = Math.round(Math.random()*1000);
		var inv = (x==1)?'rotate-input':'';
		var refresh_fm = $('<div>').addClass('uc_dropf '+inv).appendTo($(this).parent());
		var refresh_inp =  $('<div>').addClass('input-field').appendTo(refresh_fm)//Math.round(Math.random()*1000)
		refresh_inp.InputDescription(s);
		var re_input = $('<input>').addClass('input3').attr({'type':'text','id':'search_pic'+id}).keyup(f).appendTo(refresh_inp);
		$(this).click(function(){
						$(this).parent().children('.uc_dropf').slideDown(300)
					});
		//var re_input_label = $('<label>').attr({'for':'search_pic'+id,'id':'search_label','class':'active'}).html(s).appendTo(refresh_inp);
	}
});
$.fn.extend(
{
	ucEmpty2:function(a){
		a.icon = (a.icon)?a.icon:'thumb_down';
		var dv = $('<div>').addClass('row uc_empty').css({'width':'80%'}).appendTo(this);
		var icon = $('<i>').addClass('material-icons purple-text').css({'font-size':'200px','margin':'50px 0'}).html(a.icon).appendTo(dv);
		var stmt = $('<h4>').html(a.first_text).css({'margin-top':'50px'}).prependTo(dv);
		var stmt2 = $('<h5>').html(a.second_text).css({'margin-bottom':'50px'}).appendTo(dv);
		if(a.vibrate_div){
			var actn = $(a.vibrate_div);
			 actn.addClass('bounce_once');
			 setTimeout(function(){
				actn.removeClass("bounce_once");
			},5000);
		}
	}
})
$.fn.extend(
{
	ucEmpty: function(c,f,btn_type,t)
	{
		var nDiv=$(this);
		var dv = $('<div>').addClass('row uc_empty').appendTo(nDiv);
		var icon = $('<i>').addClass('material-icons pink-text').html('hourglass_empty').appendTo(dv);
		var stmt = $('<h6>').html(c).appendTo(dv);
		if(btn_type == 1){
		   if($(".fixed-action-btn").length > 0)
		   {
			   var actn = $('.fixed-action-btn');
			   var ac = $('<div>').addClass('uc_instructs').html(f).appendTo(actn).show(800);
			   actn.addClass('bounce_once');
			   setTimeout(function(){
				  actn.removeClass("bounce_once");
				  ac.hide(800);
			  },5000);
			}
		}else if(btn_type == 0)
		{
			//<a class="waves-effect waves-light btn">button</a>
			var anc = $('<a>').attr({'href':'javascript:;'}).css({'text-transform':'unset','margin-top':'10px'}).addClass('waves-effect waves-light btn red').html('Create '+t).appendTo(dv);
			switch(t)
			{
				case 'html':
					$(anc).on('click',createRichtext);
				break;
				case 'quiz':
				case 'survey':
					$(anc).attr({'typ':t}).on('click',createQuiz);
				break;
				case 'assignment':
					$(anc).on('click',createAssign);
				break;
			}
			
		}
	}
});

$.fn.extend(
{
	ucOptions: function(s,t,u,v)
	{	
		
		if(s==undefined || s==0)
		{
			var y = $('<div>').addClass('right row uc_optns');
			var m = $('<div>').addClass('col s8').appendTo(y);
			var may = $('<div>').addClass('switch').appendTo(m);
			var mu = $('<input>').attr({'type':'checkbox'}).on('change',course_tree.changePublish);
			//if(t==null )alert('null')
			if(t==undefined || t==0 || t==null)var g=0; else $(mu).attr({'checked':''});
			var sic = $('<span>').addClass('lever');
			var bach = $('<label>').append(mu).append(sic).appendTo(may);
			var c = $('<div>').addClass('col s4').appendTo(y);
			var span1 = $('<span>').appendTo(c);
			var ii = $('<i>').addClass('material-icons  waves-effect uc_vert').attr('onclick','course_tree.showOptions(this)').html('more_vert').appendTo(span1);
		
		var edit_icon = $('<i>').addClass('material-icons grey-text left').html('mode_edit');
		var edit_p = $('<p>').addClass('uc_arng').html('Edit')
		
		switch(u)
		{
			case 'html':
				var edit = $('<span>').addClass('row').on('click',createRichtext);
			break;
			case 'assign':
				var edit = $('<span>').addClass('row').on('click',createAssign);
			break;
			case 'survey':
			case 'quiz':
				var p1 = y.closest('.collection-item').children('.no_redirect');
				var edit = $('<span>').addClass('row').attr({'title':p1.attr('title'),'desc':p1.attr('desc'),'duratn':p1.attr('duratn'),'unit':p1.attr('unit'),'skip':p1.attr('skip')}).click(function(){ quizModal(this) });
			break;
			
			default:
				var edit = $('<span>').addClass('row').attr({'onclick':'course_tree.edit_course(this)'});
			break;
		}
		
		edit.append(edit_icon).append(edit_p);
		
		var del_icon = $('<i>').addClass('material-icons grey-text left').html('delete');
		var del_p = $('<p>').addClass('uc_arng').html('Delete')
		var del = $('<span>').addClass('row').attr({'onclick':'course_tree.cancel_createFolder(this)'}).append(del_icon).append(del_p)
		
		var ul = $('<ul>').addClass('ed_del').append(edit).append(del).appendTo(span1);
		$(this).append(y);
			
		}else
		{
			
			var eddel1 = $('<i>').addClass('material-icons waves-effect no_vert_align').attr({'onclick':'course_tree.showOptions(this)'}).html('more_vert');
			var ed_del = $('<span>').append(eddel1).addClass('add_icon2').prependTo($(this));
			
			//console.log(u)
			switch(u)
			{
				case 'html':
					var ed2 = $('<span>').addClass('row').on('click',createRichtext);
				break;
				case 'assignment':
					var ed22 = $('<span>').addClass('row').on('click',createAssign);
				break;
				case 'survey':
				case 'quiz':
					var p1 = ed_del.closest('.collection-item').children('.redy');
					var ed2 = $('<span>').addClass('row').attr({'title':p1.attr('title'),'desc':p1.attr('desc'),'duratn':p1.attr('duratn'),'unit':p1.attr('unit'),'skip':p1.attr('skip')}).click(function(){ quizModal(this) });
					
				break;
				case 'defined_fn':
				break;
				default:
					var ed2 = $('<span>').addClass('row').attr({'onclick':'course_tree.edit_course(this)'});
				break;
			}
			
			
			var ed2i = $('<i>').addClass('material-icons grey-text left').html('mode_edit').appendTo(ed2);
			var ed2p = $('<p>').addClass('uc_arng').html('Edit').appendTo(ed2);
			
			
			var ed3 = $('<span>').addClass('row').on('click',v)
			var ed3i = $('<i>').addClass('material-icons grey-text left').html('delete').appendTo(ed3);
			var ed3p = $('<p>').addClass('uc_arng').html('Delete').appendTo(ed3).on('click',course_tree.folder_remove)
			
			$('<ul>').addClass('ed_del').append(ed2).append(ed3).appendTo(ed_del);
			
		}

	}
});

$.fn.extend({
	createFolderRow:function(a)
	{
				var nf = $('<ul>').slideDown(300).addClass('collapsible margLeft10 arrange_icon').attr({'data-parent':a.parent,'data-path':a.path,'data-id':a.id,'id':'c'+a.id}).appendTo($(this));
					var nf1 = $('<li>').appendTo(nf);
					var sp1 = $('<span>').html(a.name).attr({'onclick':'course_tree.openclose(this)'}).addClass('open-cloze');
					var nf2 = $('<a>').append(sp1).addClass('collapsible-header waves-effect my_trans  active').appendTo(nf1);
					var nf3 = $('<i>').html('folder_open').addClass('material-icons tiny foldam ').attr({'onclick':'course_tree.openclose(this)'}).prependTo(nf2);
					var nf4 = $('<div>').addClass('collapsible-body').appendTo(nf1);	
					var ul1 = $('<ul>').appendTo(nf4);
					$('<i>').html('add').attr({'onclick':'course_tree.createFolder(this)','data-id':''}).addClass('material-icons blue-text pointer add_icon ').prependTo($(nf1));
					$(nf1).ucOptions(1);
					return nf;
	}

});

$.fn.extend({
	createTOC:function(a)
	{
		var nf = $('<ul>').addClass('collapsible margLeft10 arrange_icon').attr({'data-id':a.id,'id':'c'+a.id}).appendTo($(this));
		var nf1 = $('<li>').attr({'data-id':a.id,'data-name':a.name,'data-creatn':a.creation_type,'data-type':a.type,'data-src':a.linkd,'data-path':a.pathl}).appendTo(nf);
		if(a.type =='html' || a.type == 'quiz' || a.type == 'survey')
		{
			$(nf1).attr({'data-desc':'description'})
		}else
		{
			$(nf1).attr({'data-desc':a.res_description})
		}
		nf1.off('click',course_tree.myPlayContents);
		nf1.on('click',course_tree.myPlayContents);
		var sp1 = $('<span>').html(a.name).attr({'title':a.name,'class':'truncate'});
		var nf2 = $('<a>').append(sp1).addClass('collapsible-header waves-effect my_trans ').appendTo(nf1)//.setIcon({'icon':a.creation_type});
		var after = (a.creation_type == 'file')?'no_after':'';
		$('<i>').html(course_tree.setIcon({'format':a.creation_type,'icon':a.type})).addClass('material-icons tiny foldam '+after).prependTo(nf2);
		var nf4 = $('<div>').addClass('collapsible-body').appendTo(nf1);	
		var ul1 = $('<ul>').addClass('left_rule cos_toc1').appendTo(nf4);
		//nf.collapsible(); //new
		return nf;
	}
})

$.fn.extend({
	createFolderContents:function(a){
		var colos = new Array('purple','pink','indigo','blue','yellow','cyan','red','green','teal','brown');
		var colo = a.id.toString().split('').pop();
		var no_red = $('<a>').addClass('no_redirect redy').html(a.name).attr({'href':'javascript:;','data-id':a.id}).off("click",course_tree.sub_contents_handler).on("click",course_tree.sub_contents_handler);
		var inc=$('<i>').addClass('material-icons circle '+colos[colo]).html(course_tree.setIcon({'format':a.creation_type,'icon':a.type}));
		var li = $('<li>').appendTo($(this)).attr({'data-id':a.id,'data-creatn':a.creation_type,'data-type':a.type}).addClass('collection-item avatar').append(inc).append(no_red);
	}
})

$.fn.extend({
		initanchor2: function()
		{
			$(this).click(function(){
					console.log($(this).closest('.active-div').children().attr('id'));
					var id = parseInt($(this).attr('data-id'), 10);
					var lead = $(this).attr('data-path');
					course_tree.displayContent(id,lead);
				})
		}
	})
$.fn.extend(
{
	createNav: function(f,p)
	{
		var nDiv=$(this);
		$.each(f,function(i,v)
		{
			if(i>0)var inc=$('<span>').append($('<i>').addClass('material-icons').html('navigate_next'));
			var anc = $('<a>').addClass('no_shift grey-text text-darken-4').html(v.name).attr({'data-id':v.id,'href':'javascript:;','data-path':v.path2});
			var cosp = $('<div>').appendTo($(nDiv)).addClass('cos_p1').append(inc).append(anc);
			$(anc).initanchor2();
		});
	}
});
$.fn.extend({
		initanchor: function()
		{
			$(this).on('click',course_tree.initiatorExt);
		}
	})
$.fn.extend(
{
	createContents: function(f,p)
	{
		var colos = new Array('purple','pink','indigo','blue','yellow','cyan','red','green','teal','brown');
		var nDiv=$(this);
		$.each(f,function(i,v)
		{
			var colo = v.id.toString().split('').pop();
			var burl = '';
			
			var no_red = $('<a>').addClass('no_redirect redy').html(v.name).attr({'href':'javascript:;','data-id':v.id,'data-path':v.pathl});

			if(v.type)
			{
				var icn = 'attach_file';
				$(no_red).attr({'onclick':'course_tree.edit_course(this)'})
				
				switch(v.type)
				{
					case 'pdf': icn = 'picture_as_pdf'; break;
					case 'audio': icn = 'audiotrack'; break;
					case 'video': icn = 'video_library'; break;
					case 'html' : icn = 'subject'; $(no_red).removeAttr('onclick').on("click",createRichtext); break;//http
					case 'picture': 
						icn = ''; 
						burl = 'url('+encodeURI(v.linkd)+')';
						break;
					case 'assign': icn = 'assignment_returned'; $(no_red).removeAttr('onclick').on("click",createAssign); break;
					case 'quiz':
						//console.log(v.duration+','+v.type)
						 icn = 'assignment'; 
						 $(no_red).removeAttr('onclick').attr({'title':v.name,'duratn':v.duration,'unit':v.duration_unit,'skip':v.skippable}).click(function(){ quizModal(this) })
					
					break;
					case 'survey':
						 icn = 'chrome_reader_mode'; 
						 $(no_red).removeAttr('onclick').attr({'title':v.name,'duratn':v.duration,'unit':v.duration_unit,'skip':v.skippable,'qType':'survey'}).click(function(){ quizModal(this) })
					
					break;
				}
			}else{var icn = 'folder';$(no_red).initanchor();}
			
			var inc=$('<i>').addClass('material-icons circle '+colos[colo]).css({'background-image':burl}).html(icn);
			var li = $('<li>').slideDown(400).appendTo($(nDiv)).attr({'data-id':v.id,'data-creatn':v.creation_type,'data-type':v.type,'data-src':v.linkd,'data-path':v.pathl,'data-assignType':v.assign_type,'data-skippable':v.skippable}).addClass('collection-item avatar').append(inc).append(no_red);
			
			if(v.type =='html' || v.type == 'quiz' || v.type == 'survey')
			{
				$(li).attr({'data-desc':'description'})
			}else
			{
				$(li).attr({'data-desc':v.res_description})
			}
			
			$(li).ucOptions(0,v.publish,v.type);
		});
	}
});

$.fn.extend(
{
	InputDescription: function(t,l){
		$(this).children('.input_desc').html('');
		span = $('<span>').addClass('input_desc').css({'font-size':'smaller','color':'grey','display':'inherit','margin-left':l}).html(t).appendTo($(this));
		$(this).children("input,textarea").css({'margin-bottom':'5px'})
	}
	
})

$.fn.extend(
{
	ucNewRole: function(f,p)
	{
		var Div = $(this);
		
	}
});

$.fn.extend({
	loader: function(){
		var loader = $('<div>').css({'margin':'auto'}).addClass('preloader-wrapper big active').append($('<div>').addClass('spinner-layer spinner-blue-only').append($('<div>').addClass('circle-clipper left').append($('<div>').addClass('circle'))).append($('<div>').addClass('gap-patch').append($('<div>').addClass('circle'))).append($('<div>').addClass('circle-clipper right').append($('<div>').addClass('circle'))));
		
		//var loading = $('<div>').css({'display':'flex','align-content':'center'}).append(loader);
		var loading = $('<h1>').addClass('black-text').html('WAITING...');
		$(this).append(loading);
	}
});

$.fn.extend({
	uc_loader: function(){
		var loader = $('<div>').css({'margin':'auto'}).addClass('preloader-wrapper big active').append($('<div>').addClass('spinner-layer spinner-blue-only').append($('<div>').addClass('circle-clipper left').append($('<div>').addClass('circle'))).append($('<div>').addClass('gap-patch').append($('<div>').addClass('circle'))).append($('<div>').addClass('circle-clipper right').append($('<div>').addClass('circle'))));
		
		var loading = $('<div>').css({'display':'flex','align-content':'center'}).append(loader);
		$(this).append(loading);
	}
});

$.fn.extend({
	loader2: function(a){
		var r; var t;
		if(a){
			r = (a.right)?a.right:'20px';
			t = (a.top)?a.top:'20px';
		}else{
			r = t = '20px';
		}
			
		$(this).addClass('pos_relative');
		var loader = $('<div>').css({'margin':'auto'}).addClass('preloader-wrapper big active').append($('<div>').addClass('spinner-layer spinner-red-only').append($('<div>').addClass('circle-clipper left').append($('<div>').addClass('circle'))).append($('<div>').addClass('gap-patch').append($('<div>').addClass('circle'))).append($('<div>').addClass('circle-clipper right').append($('<div>').addClass('circle'))));
		var abs = $('<div>').css({'right':r,'top':t,'z-index':10010}).addClass('fixed lms_loader2').append(loader);
		
		$(this).append(abs);
		return abs;
	}
});
$.fn.extend({
	removeMe: function(){
		var p = $(this).parent();
		p.removeClass('pos_relative');
		$(this).remove();
	}
})

$.fn.extend({
		appear: function() 
		{
			$(this).css({'margin-top':'10px','opacity':0}).animate({'margin-top':'0px','opacity':100},'fast');
		}});
$.fn.extend({
		swap: function(a) 
		{
			$(this).animate({'margin-left':'-5px','opacity':0},'fast',function(){$(this).hide();$(a).css({'margin-left':'5px','opacity':0}).show().animate({'margin-left':'0px','opacity':100},'fast')});
		}
		
});
$.fn.extend({
		swapDiv: function(a) 
		{
			$(this).animate({"marginLeft":"-5%","opacity":0},"fast",function(){ $(this).hide();$(a).show().css({'opacity':0,'margin-left':'-5%'}).animate({"marginLeft":"0%","opacity":100})});
		}
});

$.fn.extend({
		completeSwap: function(a) 
		{
			$(this).css({'position':'absolute'})
			$(a).css({'position':'absolute'})
			$(a).show().css({'left':'120%'}).animate({"left":"0%"},800,"linear",function(){ $(a).css({'position':'relative'}) });
			$(this).animate({"left":"-120%"},800,"linear",function(){ $(this).css({'position':'relative'}).hide();});
			
		}
});
$.fn.extend({
		completeSwap2: function(a) 
		{
			//$(a).show();
			$(this).css({'position':'absolute'})
			$(a).css({'position':'absolute'})
			$(a).show().css({'left':'-120%'}).animate({"left":"0%"},800,"linear",function(){ $(a).css({'position':'relative'}) });
			$(this).animate({"left":"120%"},800,"linear",function(){ $(this).css({'position':'relative'}).hide();});
			
		}
});

$.fn.extend({
		registrationSwap: function(a,d) 
		{
			if(!d){d='';}
			
			var transit = {
				'-moz-transition':'-moz-transform 0.8s linear 0s, opacity 0.8s linear 0s',
				'-ms-transition':'-ms-transform 0.8s linear 0s, opacity 0.8s linear 0s',
				'-webkit-transition':'-webkit-transform 0.8s linear 0s, opacity 0.8s linear 0s',
				'-o-transition':'-o-transform 0.8s linear 0s, opacity 0.8s linear 0s',
				'transition':'transform 0.8s linear 0s, opacity 0.8s linear 0s',
				}
			var absolute = {'position':'absolute'}
			
			var activ = {
					'-webkit-transform': 'rotateY(0deg)',
					'-moz-transform': 'rotateY(0deg)',
					'-ms-transform': 'rotateY(0deg)',
					'-o-transform': 'rotateY(0deg)',
					'transform': 'rotateY(0deg)',
					'opacity': '1'
				}
				
			var no_activ = {
					'-webkit-transform': 'rotateY(89.999deg)',
					'-moz-transform': 'rotateY(89.999deg)',
					'-ms-transform': 'rotateY(89.999deg)',
					'-o-transform': 'rotateY(89.999deg)',
					'transform': 'rotateY(89.999deg)',
					'opacity': '0'
				}
			var origin0 = {
					'-webkit-transform-origin': '0 0',
					'-moz-transform-origin': '0 0',
					'-ms-transform-origin': '0 0',
					'-o-transform-origin': '0 0',
					'transform-origin': '0 0',
				}
			var origin100 = {
					'-webkit-transform-origin': '100% 0',
					'-moz-transform-origin': '100% 0',
					'-ms-transform-origin': '100% 0',
					'-o-transform-origin': '100% 0',
					'transform-origin': '100% 0',
				}
				
			$(this).css(absolute).show(1);
			$(a).css(absolute).show(1);
			
			if(d=='back'){
				console.log('largerback');
				/*$(this).removeClass('active_reg_stage origin0').addClass('noactive_reg_stage origin100');
				$(a).removeClass('noactive_reg_stage origin100').addClass('active_reg_stage origin0');*/
				
				$(this).css(origin0);
				$(a).css(origin100);
				$(this).css(transit);
				$(a).css(transit);
				$(this).css(no_activ).css(origin100);
				$(a).css(activ).css(origin0);
				
			}else{
				console.log('ahead ahead');
				//$(this).removeClass('active_reg_stage origin100').addClass('noactive_reg_stage origin0');
				//$(a).removeClass('noactive_reg_stage origin0').addClass('active_reg_stage origin100');
				
				$(this).css(origin100);
				$(a).css(origin0);
				$(this).css(transit);
				$(a).css(transit);
				$(this).css(no_activ).css(origin0);
				$(a).css(activ).css(origin100);
			}
		}
/*
.active_reg_stage{
transform:rotateY(0deg);
}
.noactive_reg_stage{
transform:rotateY(89.999deg);
opacity:0;
}

.origin0{
	transform-origin:0 0;
	-webkit-transform-origin:0 0;
}
.origin100{
	transform-origin:100% 0;
	-webkit-transform-origin:100% 0;
}
*/
});

$.fn.extend({
	questionBox:function(q,f,h){
		if(h==undefined) h='250px';
		if($('#_question_dialog').get(0)==null)
		{
			var div=$('<div>').addClass('modal mini modal-fixed-footer').appendTo($(document.body)).attr({"id":"_question_dialog"}).hide().css({'height':'300px !important'});
				
				var cntr =$('<div>').addClass("modal-content col l6 m6 s12 center").appendTo(div)
				$('<i>').html('warning').addClass('large material-icons left').appendTo(cntr).css({'margin':'20px'});
				$('<div>').appendTo(cntr).attr({"id":"_question_text"}).css({'margin-top':'16px','font-size':'16px'});
				var mod_ft=$('<div>').addClass('modal-footer').appendTo(div);
				var mod_fta=$('<a>').addClass('modal-action modal-close waves-effect waves-blue btn').attr({'href':'javascript:;','id':'_question_action'}).html('OK').appendTo(mod_ft);
				var mod_fta=$('<a>').addClass('modal-action modal-close waves-effect waves-blue btn-flat').attr({'href':'javascript:;'}).html('CANCEL').appendTo(mod_ft);
		}
		$('#_question_action').off('click');
		$('#_question_action').click(f);
		$('#_question_text').html(q)
		$('#_question_dialog').openModal({
		  dismissible: true, // Modal can be dismissed by clicking outside of the modal
		  opacity: .5, // Opacity of modal background
		  in_duration: 300, // Transition in duration
		  out_duration: 200, // Transition out duration
		  ready: function() { $('#_question_dialog').css({'height':h}) } // Callback for Modal open
	
		});
	}
});

$.fn.extend({
	printDiv:function(q,f,h)
	{
		var header="<html><head><link href='css/materialize.css' type='text/css' rel='stylesheet'><link href='css/print.css' type='text/css' rel='stylesheet'></head><body class='white'>";
		var footer="</body></html>";
		var title=$('<h4>').html($('#_logo').html()).addClass('row center');
		var sb1=$('<div>').html($('#_address').html()).addClass('col s12');
		var sb2=$('<h5>').html($(this).attr('data-type').replace(/_/g,' ')).addClass('col s12 tname rowline');

		var subtitle=$('<div>').addClass('row ').append(sb1,sb2);
		var v=render(this);
		//alert(title.html());
		$(v).prepend(subtitle).prepend(title);
		var ft=$('<div>').addClass('row').append($('<div>').addClass('col s4 offset-s1 bline').html('Customer Sign')).append($('<div>').addClass('col s4 offset-s1 bline').html('Sign/stamp'));
		$(v).append(ft);
		var page=header + v.html() + footer
		if($('#printID')[0] !=null) var p=$('#printID');
		else{
			//var p=$("<iframe>").attr({"height":"0px","width":"0px","id":'printID'}).hide().appendTo($this);
			var p=$("<iframe>").attr({"height":"0px","width":"0px","id":'printID'}).hide().appendTo($(this));
		} 
		var iframe=$(p)[0];
		windowToWriteTo = (iframe.contentWindow || iframe.contentDocument);
            if (windowToWriteTo.document)
                documentToWriteTo = windowToWriteTo.document;
            iframe = document.frames ? document.frames['printID'] : document.getElementById('printID');
       
        documentToWriteTo.open();
        documentToWriteTo.write(page);
        documentToWriteTo.close();
		windowToWriteTo.print();
		//$(p).remove();
	}
});

function render(a,b)
{
	var k=$(a).prop('nodeName').toLowerCase();
	if(k=="input" || k=="select")
	{
		
		var n=$('<div>');
		if($(a)[0].type!="hidden") $(n).text($(a).val());
	}else{
		if(k=='i') return 0;
		var n=$('<'+k+'>');
		if($(a)[0].firstChild)$(n).text($(a)[0].firstChild.nodeValue);
	}
	if(b !=undefined && b !=null) $(b).append(n);
	for(var i=0,ch=$(a)[0].attributes, l=$(a)[0].attributes.length; i<l;i++)
	{
		$(n)[0].setAttribute(ch[i].nodeName,ch[i].nodeValue);
	}
	$(a).children().each(function()
	{
		render(this,n);
	});
	return n;
}
function changePicture(a,b)
{
	$(a).removeClass('btn').html('');
	if($(a).find('img')[0]==null)
	{
		$('<img>').appendTo(a).css({'width':'100%'}).attr({'src':b.src}).addClass('form_pic');
		$('<div>').append($('<i>').addClass("material-icons black-text medium valign").html('photo_camera')).appendTo(a).css({'position':'absolute','right':'0px','top':'0px','opacity':'0.8','margin-top':'20px'}).append($('<span>').html(' Click to change picture ').addClass('valign')).addClass('white black-text center-align valign-wrapper');
	}else  $(a).find('img').attr({'src':b.src});
	$(a).next().val(b.src);

}