// JavaScript Document
var _date=new Date();
var _today=_date.getFullYear()+'-'+(_date.getMonth()+1)+'-'+_date.getDate();
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
} 
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
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
$.fn.extend({
	emptyState:function(message){ 
		var $this = $(this);
		var ehd = $('<div>').addClass('center empty').appendTo($this).css({'width':'100%','padding':'5%'}).attr('data-empty','empty');
		message = message ? message : "No result found";
		$('<i>').addClass('material-icons  grey-text').attr({src:'icons/warning.svg'}).appendTo(ehd);
		$('<span>').html(message).addClass(' grey-text').appendTo(ehd).css({'font-size':'1.5rem','margin':'10%'})
		$(ehd).show();
		return ehd;
	}
});

function emptyState(currPage)
{
	var ehd=$('<div>').addClass('center').appendTo(currPage).css({'width':'100%','padding':'5%'}).attr('data-empty','empty');
	var eText='No result found';
	$('<img>').addClass('material-icons  grey-text').attr({src:'icons/warning.svg'}).appendTo(ehd);
	$('<span>').html(eText).addClass(' grey-text').appendTo(ehd).css({'font-size':'1.5rem','margin':'10%'})
	$(ehd).show();
	return ehd;
}
function numberFormat(_number, _sep) {
	_number +='';
    _number = typeof _number != "undefined"  ? _number : "";
    _number = _number.replace(new RegExp("^(\\d{" + (_number.length%3? _number.length%3:0) + "})(\\d{3})", "g"), "$1 $2").replace(/(\d{3})+?/gi, "$1 ").trim();
    if(typeof _sep != "undefined" && _sep != " ") {
        _number = _number.replace(/\s/g, _sep);
    }
    return _number;
}
function extractColumn(a,n)
{
	var r=new Array;
	
	if(a==undefined || a==null) return r;
	a=a.toString();
	var b=a.split('|')
	for(i in b)
	{
		var c=b[i].split(',')
		if(c[n] !=undefined) r.push(c[n]);
	}
	return r;
}
$.fn.extend(
{
	checkNumeric: function()
	{
		$(this).keydown(function(e){
			var num=$(this).val();
			var l=num.length;
			var num2=e.key;
			
			var test="1234567890.-";
			var rst=test.indexOf(num2);
			var rst2=num.indexOf('.');
			var rst3=num.indexOf('-');
			if(rst==-1){if(num2.length==1)e.preventDefault();};
			if(rst2!=-1 && num2=='.'){e.preventDefault();};
			if(rst3!=-1 && num2=='-'){e.preventDefault();};
			if(l !=0 && num2=='-'){e.preventDefault();};
		})
		
	}
})
$.fn.extend(
{
	activateInput: function(type,a)
	{
		switch(type)
		{
			case "account":
			var ap=$(this).attr('name');
			
			if(ap==undefined) break;
			var cp=ap.replace('account','');

			$('<input>').insertBefore(this).attr({'type':'text','name':'acctid'+cp,'id':'acctid'+cp+a}).addClass('acctid').hide();
			$('<input>').insertBefore(this).attr({'type':'text','name':'account_name'+cp,'id':'account_name'+cp+a}).addClass('account_name').hide();
			$(this).attr({'data-type':'accounts'}).comboInit(function(p,field){
				var prt=$(p).parent().parent();
				$(prt).find('.acctid').val(field.i);
				$(prt).find('.account_name').val(field.c[1]);
				
			});
			break;
			
			case "joborder":
			var ap=$(this).attr('name');
			
			if(ap==undefined) break;
			var cp=ap.replace('joborder','');

			$('<input>').insertBefore(this).attr({'type':'text','name':'jid'+cp,'id':'jid'+cp+a}).addClass('jid').hide();
			$(this).attr({'data-type':'miniJoborder'}).comboInit(function(p,field){
				var prt=$(p).parent().parent();
				$(prt).find('.jid').val(field.i);
			});
			
			break;
			case "itemid":
			var ap=$(this).attr('name');
			if(ap==undefined) break;
			var cp=ap.replace('itemid','');

			$('<input>').insertBefore(this).attr({'type':'text','name':'it_id'+cp,'id':'it_id'+cp+a}).addClass('it_id').hide();
			$(this).attr({'data-type':'microItem',"size":"large"}).comboInit(function(p,field){
			var prt=$(p).parent().parent();
			$(prt).find('.description').val(field.c[1]);
			$(prt).find('.rate').val(field.c[2]);
			$(prt).find('.it_id').val(field.i);
			var qt =$(prt).find('.quantity'); var am = $(prt).find('.amount'); var rt =$(prt).find('.rate');
			var amt=parseFloat($(qt).val()) * parseFloat($(rt).val());
			amt = isNaN(amt) ? '' : amt;
			var a=$(p).data('pageid');
			$(am).val(amt);sum(a);
			var field=$('#sparam'+a).val();
			$('#_itemlist_div1'+a).createTransRow(field,a);
	});
			
			break;
			
			case "quantity":
				$(this).keyup(function()
				{ 
					var prt=$(this).parent().parent();
					var rt =$(prt).find('.rate'); var am = $(prt).find('.amount'); 
					var amt=parseFloat($(this).val()) * parseFloat($(rt).val());
					amt = isNaN(amt) ? '' : amt;
					$(am).val(amt);sum(a);
				}).checkNumeric();
			
			break;
			
			case "rate":
			
				$(this).keyup(function()
				{ 
					var prt=$(this).parent().parent();
					var qt =$(prt).find('.quantity'); var am = $(prt).find('.amount'); 
					var amt=parseFloat($(this).val()) * parseFloat($(qt).val());
					amt = isNaN(amt) ? '' : amt;
					$(am).val(amt);sum(a);
				}).checkNumeric();
			break;
			
			case "amount":
			
				$(this).keyup(function()
				{ 
					var prt=$(this).parent().parent();
					var qt =$(prt).find('.quantity'); var rt = $(prt).find('.rate'); 
					var amt=parseFloat($(this).val()) / parseFloat($(qt).val());
					amt = isNaN(amt) ? '' : amt.toFixed(2);
					$(rt).val(amt);sum(a);
				}).checkNumeric();
			break;
			
			case "debit":
				$(this).keyup(function() { balance(a); } )
			break;
			
			case "credit":
				$(this).keyup(function() { balance(a); } )
			break;
			
			
		}
	}
	
})
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
		if($(this).attr('data-account') !=undefined) {var dl=2; var al=2} else {var dl=2; var al=3}
		var rw=$('<div>').appendTo($(this)).addClass('row l-row');
	if(f.itemid !=undefined)$('<input>').appendTo(rw).val(f.itemid).addClass('input-field col s12 m2').attr({'type':'text','name':'itemid'+i});
	if(f.it_id !=undefined)$('<input>').appendTo(rw).val(f.it_id).attr({'type':'text','name':'it_id'+i}).hide();
	if(f.old_discount !=undefined)$('<input>').appendTo(rw).val(f.old_discount).attr({'type':'text','name':'old_discount'+i}).hide();
	if(f.old_amount !=undefined)$('<input>').appendTo(rw).val(f.old_amount).attr({'type':'text','name':'old_amount'+i}).hide();
	if(f.in_id !=undefined)$('<input>').appendTo(rw).val(f.in_id).attr({'type':'text','name':'in_id'+i}).hide();
	if(f.tid !=undefined)$('<input>').appendTo(rw).attr({'type':'text','name':'tid'+i}).hide().val(f.tid);
	if(f.desc !=undefined)$('<input>').addClass('input-field col s12 m'+dl).appendTo(rw).val(f.desc).attr({'type':'text','placeholder':'Description','name':'description'+i});
	if(f.invoice !=undefined)$('<input>').addClass('input-field col s12 m3').appendTo(rw).val(f.invoice).attr({'type':'text','placeholder':'Invoice','name':'invoice'+i,'readonly':true});
	if(f.date !=undefined)$('<input>').addClass('input-field col s12 m2').appendTo(rw).val(f.date).attr({'type':'text','placeholder':'Date','name':'date'+i,'readonly':true});
	if($(this).attr('data-account') !=undefined){if(f.account !=undefined){var acn=$('<div>').addClass('col s12 m2').css({'padding':'0px','margin-top':'-1px'}).appendTo(rw);$('<input>').addClass('combo').appendTo(acn).val(f.account).attr({'type':'text','placeholder':'Account','name':'account'+i,'data-type':'accounts'}).comboInit();} }
	if(f.qty !=undefined)$('<input>').addClass('input-field col s12 m2').appendTo(rw).val(f.qty).attr({'type':'number','placeholder':'Qty','name':'quantity'+i}).keyup(function()
	{ var rt =$(this).next(); var am = $(rt).next();
		var amt=parseFloat($(this).val()) * parseFloat($(rt).val());
		$(am).val(amt);sum(p);
	});
	
	if(f.rate !=undefined)$('<input>').addClass('input-field col s12 m2').appendTo(rw).val(f.rate).attr({'type':'number','placeholder':'Rate','name':'rate'+i}).keyup(function()
	{ var qt =$(this).prev(); var am = $(this).next();
		var amt=parseFloat($(this).val()) * parseFloat($(qt).val());
		$(am).val(amt);sum(p);
	});
	if(f.amountdue !=undefined)$('<input>').addClass('input-field col s12 m2').appendTo(rw).val(f.amountdue).attr({'type':'number','placeholder':'Amount','name':'amountdue'+i,'readonly':true})

	if(f.discount !=undefined)$('<input>').addClass('input-field discount col s12 m2').appendTo(rw).val(f.discount).attr({'type':'number','placeholder':'Discount','name':'discount'+i}).keyup(function()
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
		$('<input>').addClass('input-field amount col s12 m'+al).appendTo(rw).val(am).attr({'type':'number','placeholder':'Amount','name':'amount'+i}).keyup(function()
		{ var rt =$(this).prev(); var qt = $(rt).prev();
			var qty= (parseFloat($(qt).val()) ==0) ? 1: parseFloat($(qt).val()) ;
			
			var amt=parseFloat($(this).val()) / qty ;
			$(rt).val(amt);sum(p);
		});
	}
	if(f.amountdue !=undefined && f.discount !=undefined)
	{
		var am=f.amountpaid==undefined ? f.amountdue - f.discount: f.amountpaid;
		$('<input>').addClass('input-field amount col s12 m2').appendTo(rw).val(am).attr({'type':'number','placeholder':'Amount','name':'amount_paid'+i}).keyup(function()
		{ var ds =$(this).prev(); var amd = $(ds).prev();
			if(parseFloat($(this).val()) > parseFloat($(amd).val())
			-parseFloat($(ds).val())) $(this).val(parseFloat($(amd).val())
			-parseFloat($(ds).val()))
			sum(p);
		});
	}
	
	$('<a>').attr({'href':'javascript:;'}).html('<i class="material-icons">clear</i>').appendTo(rw).click(function(){$(this).parent().remove(); sum(p);});
	$(rw).appear();
	sum(p);
	}
});
$.fn.extend(
{
	createHeaderRow: function(field)
	{
		var num=Math.floor(12/field.length);
		var nDiv=$('<div>').css({'float':'left','margin-top':'2.2rem'}).addClass('row col s10').appendTo($(this));
		$.each(field, function(j, col)
		{
			nDiv.append($("<div>").css({'margin-top':'0px','font-weight':'bold'}).addClass('col s'+num).html(col+ " "));
		});
	}
});
$.fn.extend(
{
	createSoldItemRow: function(f,p)
	{
		var nD=$("<a>").addClass("collection-item").css({'float':'left','width':'100%'}).appendTo($(this)).attr({'href':'javascript:;'}).click(function(){
			var i=$('#_count'+p).val()==''? 1: $('#_count'+p).val();																																			
			$('#_item_display'+p).createItemRow(f,p);
			i++;
			$('#_count'+p).val(i);
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
	createRow: function(field,order,ext)
	{
		//console.log(field);return;
		var num=Math.floor(12/order.length);
		var nDiv=$('<div>').addClass('row col s10').appendTo($(this));
		if(ext.length){$('<div>').css({'float':'right'}).addClass('extcol').appendTo($(this)).optionBox(ext,field.i);}
		$.each(field.c, function(j, col)
		{
			var vt="";
			col = toTitleCase(col);
			if(order[j]=="t")
			{ 
				nDiv.append(col+" ");
			} else if (order[j]=="span")
			{
				nDiv.append($("<span></span>").text(col + " ").addClass('col s'+num).css({'font-size':'11px','font-style':'italic'}));
			} else if (order[j]=="rightBold")
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
	optionBox: function(field,id)
	{
		if(field !=null && field !=undefined)
		{
			
			var vt=$('<a>').attr({'href':'javascript:;'}).append($('<i>').addClass('material-icons col s1 right').append($('<img>').attr({'src':'icons/more_vert.svg'})));
			var bDiv=$('<div>').addClass('optionBox').appendTo($(vt));
			var thx=$(this);
			$.each(field,function(i,col)
			{
				var opener = col.ModalForm ? 'modal' : 'swipe'
				var ed2 = $('<span>').attr({title:col.page_title, pageId:col.pageTitle,'data-id':id,'data-open':opener}).append(
				$('<i>').addClass('material-icons grey-text left').append($('<img>').attr({'src':'icons/'+col.icon+'.svg'}))).click(function(e){
					e.stopPropagation();
					loadSelection(this,col.pageTitle,col.formId);
					});
				if(i < 3) $(ed2).appendTo($(thx)); 
				else{
					$(ed2).appendTo($(bDiv)).addClass('row').append($('<p>').addClass('uc_arng').html(col.text));
					$(vt).appendTo($(thx));
				}
				
			});
			
			$(vt).click(function(e)
			{
				$(this).find('.optionBox').toggle(200);
				e.stopPropagation();
			});
		}					   
	}
});

$.fn.extend(
{
	uploadOptn: function(c, f)
	{
		var nDiv=$(this);
		$(this).css({'position':'relative'})
		var uc_optn = $('<div>').addClass('uploadOptn').css({'position':'absolute','top':'8px','right':'5px','z-index':'1'}).appendTo(nDiv).click(
		function(){
			$(this).parent().children('.ed_del').show(300);
			
			})
	 	var uc_i = $('<img>').addClass('material-icons grey-text text-darken-1').attr({src:'icons/more_vert_black.svg'}).appendTo(uc_optn)
		
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
		//var ed2i = $('<img>').addClass('material-icons grey-text left').attr({src:'icons/mode_edit_black.svg'}).appendTo(ed2);
		var ed2p = $('<p>').addClass('uc_arng').html('Edit').appendTo(ed2);
			
		var ed3 = $('<span>').addClass('row').click(
			function(){
				
				var urlsend=$('#upload_modal').attr('data-href');
				var ref = $(this).closest('a')
				var src = ref.attr('data-src');
				var type = ref.attr('data-type');
				if(type == undefined)typ = 0; else typ = 1;
				$(this).questionBox('Are you sure you want to delete',
				  function(){
					$('#upload_modal .progress').removeClass('hide')
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
		//var ed3i = $('<img>').addClass('material-icons grey-text left').attr({src:'icons/delete_black.svg'}).appendTo(ed3);
		var ed3p = $('<p>').addClass('uc_arng').html('Delete').appendTo(ed3);
		
		var uc_dv = $('<ul>').addClass('ed_del').append(ed2).append(ed3).appendTo(nDiv)
		
		
		
	}
});
$.fn.extend(
{
	createRowLite: function(field,order)
	{
		var num=Math.floor(12/order.length);
		var nDiv=$('<div>').css({'float':'left'}).addClass('row col s12').appendTo($(this));
		$.each(field.c, function(j, col)
		{
			var vt="";
			
			if(order[j]=="t")
			{ 
				nDiv.append(col+" ");
			} else if (order[j]=="s")
			{
				nDiv.append($("<span>").text(col + " ").css({'font-size':'11px','font-style':'italic'}));
			} else if (order[j]=="r")
			{
				nDiv.append($("<span></span>").text(col + " ").css({'float':'right','font-weight':'bold','font-size':'12px'}));
			}else if (order[j]=="d")
			{
				nDiv.append($("<div>").html(col + " "));
			}else if (order[j]=="b")
			{
				nDiv.append($("<h6>").css({'margin-top':'0px','font-weight':'bold'}).html(col+ " "));
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
	createRowList: function(field,order,a)
	{
		var nD=$("<a>").addClass("collection-item").appendTo($(this)).attr({"id":field.i+a,"data-id":field.i,'href':'javascript:;'})
		var nDiv=$('<div>').appendTo($(nD));
		$.each(field.c, function(j, col)
		{
			var vt="";
			if(order[j]=="t")
			{ 
				nDiv.append(col+" ");
			} else if (order[j]=="s")
			{
				nDiv.append($("<span></span>").text(col + " ")).css({'font-size':'12px'});
			} else if (order[j]=="r")
			{
				nDiv.append($("<span></span>").text(col + " ").css({'float':'right','font-weight':'bold','font-size':'12px'}));
			}else if (order[j]=="d")
			{
				nDiv.append($("<div>").html(col + " "));
			}else if (order[j]=="b")
			{
				nDiv.append($("<h6>").css({'margin-top':'0px'}).html(col + " "));
			}else if (order[j]=="a")
			{
				nDiv.append(col+ " ");
				vt+=col;
				nDiv.prop("dName",vt)
			}
		});
		$(nD).appear();
	}

});
$.fn.extend(
{
	createSetupRow: function(field,order)
	{
		var num=Math.floor(12/order.length);
		var nDiv=$('<div>').css({'float':'left'}).addClass('row col s10').appendTo($(this));
		$.each(field.c, function(j, col)
		{
			var vt="";
			
				nDiv.append($("<div>").addClass('col s'+num).html(col + " "));
		});
	}

});
$.fn.extend({
			createTransRow:function(field,p,d)
			{
				d= d ==undefined ? new Object: d;
				var i=$('#_count'+p).val()==''? 2: $('#_count'+p).val();
				
				var nD =$('<div>').appendTo($(this)).addClass("row teal-text lighten-1 newRow l-row");
				var col=extractColumn(field,0);
				var desc=extractColumn(field,1);
				var st=extractColumn(field,2);
				$('<input>').appendTo(nD).attr({'type':'text','name':'tid'+i,'id':'tid'+i+p}).addClass('tid').hide();

				$.each(col, function(j,v)
				{
					//if( d !=undefined && d[v] !=undefined ){ var vl=d[v];} else {var vl=''; }
					var vl=d[v] !=undefined ? d[v]:'';
					var n=$('<div>').appendTo(nD).addClass('input-field no-padding col '+ st[j]).attr({'style':'margin-top:0px !important'});
					$('<input>').appendTo(n).attr({'type':'text','placeholder':desc[j],'name':v+i,'id':v+i+p,'data-pageid':p,'data-class':v,'style':'margin-bottom:0px !important'}).addClass(v + ' capitalize').css({'margin-bottom':'0px !important'}).val(vl).activateInput(v,p);
				})
				$.each(d, function(j,v)
				{
					$(nD).find("#"+j+i+p).val(v).html(v);
				})
				$('<a>').attr({'href':'javascript:;'}).addClass('right').css({'position':'absolute','right':'0px'}).html('<i class="material-icons">clear</i>').appendTo(nD).click(function(){$(this).parent().remove(); sum(p);});
				i++;
				$('#_count'+p).val(i);
				
				return nD;
			}
})
$.fn.extend({
			createPictureCard:function(field,a)
			{
				var order=['p','t','c'];
				var nD=$("<a>").addClass("col s6 m3").appendTo($(this)).attr({"id":field.i+a,"data-id":field.i,'href':'javascript:;'})
				var nDiv=$('<div>').addClass('card small').appendTo($(nD));
				var cIm=$('<div>').addClass('card-image').appendTo(nDiv);
				var cNt=$('<div>').addClass('card-content').appendTo(nDiv);
				$.each(order,function(i,v)
				{
					$.each(field.c, function(j, col)
					{
						if(col.f==v)
						{
							if(col.f=="p")
							{ 
								$('<img>').attr({'src':col.v}).appendTo(cIm);
								$('<a>').appendTo(cIm).addClass("btn-floating halfway-fab waves-effect waves-light red").append($('<input>').attr({'type':'checkbox','id':'cbx_'+field.i,'value':field.i}).click(function(e){e.stopPropagation();}).addClass('cbx')).append($('<label>').attr({'for':'cbx_'+field.i}).click(function(e){e.stopPropagation();}));
																
							} else if (col.f=="t")
							{
								$('<span>').addClass('card-title grey-text').html(col.v).appendTo(cNt);
								
								
							} else if (col.f=="c")
							{
									$('<p>').appendTo(cNt).html(col.v);
							}
							
						}	
						
							
					});					  
				})
				$(nD).appear();
			}
});
			

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
	questionBox:function(q,f,h)
	{
		if(h==undefined) h='250px';
		if($('#_question_dialog').get(0)==null)
		{
			var div=$('<div>').addClass('modal modal-fixed-footer').appendTo($(document.body)).attr({"id":"_question_dialog"}).hide().css({'height':'300px !important'});
				
				var cntr =$('<div>').addClass("modal-content col l6 m6 s12 center").appendTo(div)
				$('<img>').attr({src:'icons/warning.svg'}).addClass('large material-icons left').appendTo(cntr).css({'margin':'20px'});
				$('<div>').appendTo(cntr).attr({"id":"_question_text"}).css({'margin-top':'30px','font-size':'1.2rem'});
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
	divPrint:function(q,f,h)
	{
		var header="<html><head><link href='css/materialize.css' type='text/css' rel='stylesheet'><link href='css/print.css' type='text/css' rel='stylesheet'></head><body class='white'>";
		var footer="</body></html>";
		var v=render(this);
		var page=header + v.html() + footer
		if($('#printID')[0] !=null) var p=$('#printID');
		else var p=$("<iframe>").attr({"height":"0px","width":"0px","id":'printID'}).hide().appendTo($this);
		//else var p=$("<iframe>").attr({"height":"500px","width":"500px","id":'printID'}).appendTo($this);
		var iframe=$(p)[0];
		windowToWriteTo = (iframe.contentWindow || iframe.contentDocument);
            if (windowToWriteTo.document)
                documentToWriteTo = windowToWriteTo.document;
            iframe = document.frames ? document.frames['printID'] : document.getElementById('printID');
       
        documentToWriteTo.open();
        documentToWriteTo.write(page);
        documentToWriteTo.close();
		windowToWriteTo.print();
		
	}
})
$.fn.extend({
	printJournal:function(q,f,h)
	{
		var header="<html><head><link href='css/materialize.css' type='text/css' rel='stylesheet'><link href='css/print.css' type='text/css' rel='stylesheet'></head><body class='white'>";
		var footer="</body></html>";
		var title=$('<div>').html($('#_logo').html()).addClass('row  rhead');
		var sb1=$('<div>').html($('#_address').html()).addClass('cpaddress');
		var sb2=$('<h5>').html($(this).attr('data-type').replace(/_/g,' ')).addClass('col s12 tname rowline');

		//var subtitle=$('<div>').addClass('row ').append(sb1,sb2);
		var v=render(this);
		$(v).find('.dropdown-content').css({'display':'none'}).remove();
		$(v).find('select').css({'display':'none'}).remove();
		$(v).find('option').css({'display':'none'}).remove();
		$(v).find('.c_address').show();$(v).find('.cmp').show();
		$(v).find('.total').removeClass('s11').addClass('s5');
		$(v).find('.sendEntry').css({'display':'none'}).remove();
		var prc=parseInt($(v).find('.count').val()) ;
		alert(prc);
		$(v).find(".table").each(function(i,j)
		{
				//if($(this).is(':visible'))var tr=$(this).turnTable(prc);	
				var tr=$(j).turnTable(prc);
		})
		$(v).prepend(sb1,sb2).prepend(title);
		var ft=$('<div>').addClass('row capitalize foot').append($('<div>').addClass('col s3 offset-s1 brow ').html('Processed By: '+getCookie("ELIMS-Login_Name"))).append($('<div>').addClass('col s3 offset-s1 bline').html('For:'+ $('#_name').html()));
		$(v).append(ft);
		var page=header + v.html() + footer
		if($('#printID')[0] !=null) var p=$('#printID');
		else var p=$("<iframe>").attr({"height":"0px","width":"0px","id":'printID'}).hide().appendTo($this);
		//else var p=$("<iframe>").attr({"height":"500px","width":"500px","id":'printID'}).appendTo($this);
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
$.fn.extend({
	printDiv:function(q,f,h)
	{
		var header="<html><head><link href='css/materialize.css' type='text/css' rel='stylesheet'><link href='css/print.css' type='text/css' rel='stylesheet'></head><body class='white'>";
		var footer="</body></html>";
		var title=$('<div>').html($('#_logo').html()).addClass('row  rhead');
		var sb1=$('<div>').html($('#_address').html()).addClass('cpaddress');
		var sb2=$('<h5>').html($(this).attr('data-type').replace(/_/g,' ')).addClass('col s12 tname rowline');

		//var subtitle=$('<div>').addClass('row ').append(sb1,sb2);
		var v=render(this);
		$(v).find('.dropdown-content').css({'display':'none'}).remove();
		$(v).find('select').css({'display':'none'}).remove();
		$(v).find('option').css({'display':'none'}).remove();
		$(v).find('.c_address').show();$(v).find('.cmp').show();
		$(v).find('.total').removeClass('s11').addClass('s5');
		var total=$(v).find('.total').html().replace(/ /g,'');
		$(v).find('.words').html('Amount in words: '+ConvertWord(total) + ' Naira Only');
		$(v).find('.prepayment').parent().hide();
		var prc=parseInt($(v).find('.count').html()) + parseInt($(v).find('.invoice_count').html());
		$(v).find(".table").each(function(i,j)
		{
				//if($(this).is(':visible'))var tr=$(this).turnTable(prc);	
				var tr=$(j).turnTable(prc);
		})
		$(v).prepend(sb1,sb2).prepend(title);
		var ft=$('<div>').addClass('row capitalize foot').append($('<div>').addClass('col s3  bline').html('Customer Sign')).append($('<div>').addClass('col s3 offset-s1 brow ').html('Processed By: '+getCookie("ELIMS-Login_Name"))).append($('<div>').addClass('col s3 offset-s1 bline').html('For:'+ $('#_name').html()));
		$(v).append(ft);
		var page=header + v.html() + footer
		if($('#printID')[0] !=null) var p=$('#printID');
		else var p=$("<iframe>").attr({"height":"0px","width":"0px","id":'printID'}).hide().appendTo($this);
		//else var p=$("<iframe>").attr({"height":"500px","width":"500px","id":'printID'}).appendTo($this);
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
$.fn.extend({
	turnTable:function(prc)
	{
		var n= $('<table>'); var cr=0;
		for(var v=0,ch=$(this)[0].attributes, l=$(this)[0].attributes.length; v<l;v++)
		{
			$(n)[0].setAttribute(ch[v].nodeName,ch[v].nodeValue);
		}
		$(n).css({'display':'table'})
		$(this).children().each(function(i)
		{
			if(!i) n1=$('<thead>').appendTo($(n)); else n1=$('<tr>').appendTo($(n));
			 
			$(this).children().each(function()
			{
				var nthis=null;var n2=null;
				if(i)
				{
					
						$(this).find('#_combo').remove();
						$(this).find('.combo_hold').remove();
						$(this).find('label').remove();
						$(this).children().each(function()
						{
							var k=$(this).prop('nodeName').toLowerCase();
							if($(this).css('display') !== 'none' && k!=='a')
							{
								n2=$('<td>').appendTo($(n1)).html($(this).html());
								for(var v=0,ch=$(this)[0].attributes, l=$(this)[0].attributes.length; v<l;v++)
								{
									$(n2)[0].setAttribute(ch[v].nodeName,ch[v].nodeValue);
								}
							}
						
						});
					
				}
				else 
				{
					n2=$('<th>').appendTo($(n1)).html($(this).html());
					for(var v=0,ch=$(this)[0].attributes, l=$(this)[0].attributes.length; v<l;v++)
					{
						$(n2)[0].setAttribute(ch[v].nodeName,ch[v].nodeValue);
					}
					cr++;
				}
				
			});
												 
		});
		for(k=prc;k<12;k++)
		{
			n1=$('<tr>').appendTo($(n));
			for(l=0;l<cr;l++)
			{
				n2=$('<td>').appendTo($(n1)).html(' ');
			}
		}
		$(this).replaceWith($(n));
		return n;
	}
})
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
function changePicture(a,b){
	$(a).removeClass('btn').html('');
	if($(a).find('img')[0]==null)
	{
		$('<img>').appendTo(a).css({'width':'100%'}).attr({'src':b.src}).addClass('form_pic');
		$('<div>').append($('<img>').addClass("material-icons black-text medium valign").attr({src:'icons/photo_camera.svg'})).appendTo(a).css({'position':'absolute','right':'0px','top':'0px','opacity':'0.8','margin-top':'20px'}).append($('<span>').html(' Click to change picture ').addClass('valign')).addClass('white black-text center-align valign-wrapper');
	}else  $(a).find('img').attr({'src':b.src});
	$(a).next().val(b.src);

}
function editPicture(a,b){

	editModal(a,function(o,c){
		
		var dv=$(a).attr('data-div');
		c.pageType=$(a).attr('data-pagetype');
		alert(JSON.stringify(c));
		$.post("process_generic.php",c).done( function(rspText,status,xHr)
			{
				//$('#'+dv).createPictureCard(c);
				alert(rspText);
			
			}).fail(function(e){Materialize.toast('Error in sending message', 4000);
			});
		
												   
	});

	

	  var imgg=$('#img_img');

	  $('#editModal').find('#title').val('');

	$('#editModal').find('#description').val('');

	  imgg.attr({'src':b.src,'data-type':b.type,'data-id':b.name});
  }

//urch 
$.fn.extend(
{
	myDropOptions: function(v){
		
		var nDiv=$(this);
		$(this).css({'position':'relative'})
		var uc_optn = $('<div>').addClass('uploadOptn').css({'position':'absolute','top':'5px','right':'5px','z-index':'10'}).appendTo(nDiv).click(
		function(){
			$(this).parent().children('.ed_del').show(300);
			
			})
	 	var uc_i = $('<img>').attr({src:'icons/more_vert_black.svg'}).addClass('material-icons indigo-text text-darken-1 pointer').appendTo(uc_optn)
		
		var ed2 = $('<span>').addClass('row')
		//var ed2i = $('<img>').attr({src:'icons/mode_edit_black.svg'}).addClass('material-icons grey-text left pointer').appendTo(ed2);
		var ed2p = $('<p>').addClass('uc_arng').html('Edit').appendTo(ed2);
			
		var ed3 = $('<span>').addClass('row')
		//var ed3i = $('<img>').attr({src:'icons/delete_black.svg'}).addClass('material-icons grey-text left').appendTo(ed3);
		var ed3p = $('<p>').addClass('uc_arng').html('Delete').appendTo(ed3);
		if(v){
			if(v.del){ed3.on('click',v.del)}
			if(v.edit){ed2.on('click',v.edit)}
		}
		
		var uc_dv = $('<ul>').css({'top':'25px','right':'5px'}).addClass('ed_del').append(ed2).append(ed3).appendTo(nDiv);
		
	}
}
);


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
		var icon = $('<img>').addClass('material-icons purple-text').css({'font-size':'200px','margin':'50px 0'}).attr({src:'icons/'+a.icon+'.svg'}).appendTo(dv);
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
		var icon = $('<img>').addClass('material-icons pink-text').attr({src:'icons/hourglass_empty.svg'}).appendTo(dv);
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
			var ii = $('<img>').addClass('material-icons  waves-effect uc_vert').attr('onclick','course_tree.showOptions(this)').attr({src:'icons/more_vert_black.svg'}).appendTo(span1);
		
		//var edit_icon = $('<img>').addClass('material-icons grey-text left').attr({src:'icons/mode_edit_black.svg'});
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
		
		var del_icon = $('<img>').addClass('material-icons grey-text left').attr({src:'icons/delete_black'}).html('');
		var del_p = $('<p>').addClass('uc_arng').html('Delete')
		var del = $('<span>').addClass('row').attr({'onclick':'course_tree.cancel_createFolder(this)'}).append(del_icon).append(del_p)
		
		var ul = $('<ul>').addClass('ed_del').append(edit).append(del).appendTo(span1);
		$(this).append(y);
			
		}else
		{
			
			var eddel1 = $('<img>').addClass('material-icons waves-effect no_vert_align').attr({'onclick':'course_tree.showOptions(this)'}).attr({src:'icons/more_vert_black.svg'});
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
			
			
			//var ed2i = $('<img>').addClass('material-icons grey-text left').attr({src:'icons/mode_edit_black.svg'}).appendTo(ed2);
			var ed2p = $('<p>').addClass('uc_arng').html('Edit').appendTo(ed2);
			
			
			var ed3 = $('<span>').addClass('row').on('click',v)
			//var ed3i = $('<img>').addClass('material-icons grey-text left').attr({src:'icons/delete_black.svg'}).appendTo(ed3);
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
					var nf3 = $('<img>').attr({src:'icons/folder_open.svg'}).addClass('material-icons tiny foldam ').attr({'onclick':'course_tree.openclose(this)'}).prependTo(nf2);
					var nf4 = $('<div>').addClass('collapsible-body').appendTo(nf1);	
					var ul1 = $('<ul>').appendTo(nf4);
					$('<img>').attr({src:'icons/add.svg'}).attr({'onclick':'course_tree.createFolder(this)','data-id':''}).addClass('material-icons blue-text pointer add_icon ').prependTo($(nf1));
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
			if(i>0)var inc=$('<span>').append($('<img>').attr({src:'icons/navigate_next.svg'}).addClass('material-icons'));
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
			
			var inc=$('<img>').addClass('material-icons circle '+colos[colo]).css({'background-image':burl}).attr({src:'icons/'+icn+'.svg'});
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
			var div=$('<div>').addClass('modal mini modal-fixed-footer').css({'max-width':'400px'}).appendTo($(document.body)).attr({"id":"_question_dialog"}).hide().css({'height':'300px !important'});
				
				var cntr =$('<div>').addClass("modal-content col l6 m6 s12 center").appendTo(div)
				$('<img>').attr({src:'icons/warning.svg'}).addClass('large material-icons left').appendTo(cntr).css({'margin':'20px'});
				$('<div>').appendTo(cntr).attr({"id":"_question_text"}).css({'margin-top':'16px','font-size':'16px'});
				var mod_ft=$('<div>').addClass('modal-footer').appendTo(div);
				var mod_fta=$('<a>').addClass('modal-action modal-close waves-effect waves-blue btn').attr({'href':'javascript:;','id':'_question_action'}).html('OK').appendTo(mod_ft);
				var mod_fta=$('<a>').addClass('modal-action modal-close waves-effect waves-blue btn-flat').attr({'href':'javascript:;'}).html('CANCEL').appendTo(mod_ft);
		}
		$('#_question_action').off('click');
		$('#_question_action').click(f);
		$('#_question_text').html(q)
		$('#_question_dialog').openModal({
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
		$('<div>').append($('<img>').addClass("material-icons black-text medium valign").attr({src:'icons/photo_camera.svg'})).appendTo(a).css({'position':'absolute','right':'0px','top':'0px','opacity':'0.8','margin-top':'20px'}).append($('<span>').html(' Click to change picture ').addClass('valign')).addClass('white black-text center-align valign-wrapper');
	}else  $(a).find('img').attr({'src':b.src});
	$(a).next().val(b.src);

}
