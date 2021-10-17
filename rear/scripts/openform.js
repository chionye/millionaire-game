// JavaScript Document
$(document).ready(function(){
	$('.myMenu').click(function(){
		$(this).closest('ul').find('.myMenu').removeClass('active');
		$(this).addClass('active');
	});
});
function newForm(a){
	//alert(a);
	var page = $('#'+a);
	var pageid = page.data('pageid');
	$("#open_form"+pageid).swapDiv(page);
}
function openForm(a)
{
	var page = $('#'+a);
	var pageid = page.data('pageid');
	page.attr('class')
	page.swapDiv($("#open_form"+pageid));
}
function extForm(a){
	$("#open_form"+a).swapDiv($("#new_form"+a));
}

function loadOpen(a){
	//alert(a)limit
	pagetype=$('#page_type'+a).val();
	pagetitle=$('#page_title'+a).val();
	currPage=$('#dialog_display'+a).addClass('text-darken-1');
	var cnd=new Array;
	$('#'+a+' .filterList').each(function(){if($(this).attr('name') !=undefined)cnd.push($(this).attr('name')+","+$(this).val()+',date');})
	$('#'+a+' .filterValue').each(function(){if($(this).val()!='')cnd.push($(this).val());})
	$('#'+a+' .dateFilter').each(function(){if($(this).attr('name')!=undefined)cnd.push($(this).attr('name')+","+$(this).val()+',date');  })
	var limit = $('#_rangeBox'+a).val() || 50;
	var page =$('#active_page'+a).val() || 1;
	var condition=cnd.join('|');
	$('.progress').removeClass('hide');
	var param = "processAjax.php?pageType="+pagetype+"&p=0&l=4&limit="+limit+"&page="+page+"&search="+$('#_searchBox'+a).val()+'&condition='+condition;
	//alert(param);
	$('#reloadPage'+a).addClass('rotating');
	$.getJSON(param, function(result){$('#reloadPage'+a).removeClass('rotating');
		//console.log(result);
		pageAlgorithm(result.total, limit, a)
		$('.progress').addClass('hide');
		$(currPage).html("");
		if(result.row==undefined || result.row.length==0){
			var ehd=$('<div>').addClass('center').appendTo(currPage).css({'width':'100%','margin-top':'5%'});
			if($('#_searchBox'+a).val()=='') eText="No "+pagetitle+' found to display, click the "( + )" button below';else eText='No result found';
			$('<i>').attr({src:'icons/playlist_add.svg'}).addClass('material-icons large').appendTo(ehd);
			$('<div>').html(eText).appendTo(ehd).css({'margin':'5%','font-size':'2rem'});
			$(ehd).appear();						
			return 0;
		}
		var hd=$('<div>').addClass('collection-header left capitalize').appendTo(currPage).css({'width':'100%'});
		var nCh=$('<span>').css({'float':'left','margin-top':'2.2rem','margin-left':'10px'}).appendTo(hd);
		$('<input>').attr({'type':'checkbox','id':'_selectAll'+a}).addClass('cbx_all filled-in').appendTo(nCh).click(function(e){
			e.stopPropagation(); var ck=$(this).prop('checked'); if(ck){ $('#'+a).find('.cbx').prop({'checked':true}); }else   $('#'+a).find('.cbx').prop({'checked':false});  });
		$('<label>').appendTo(nCh).attr({'for':'_selectAll'+a}).click(function(e){e.stopPropagation();});
		//$('<h3>').html(pagetitle).appendTo(hd).css({'float':'left'});
		$(hd).createHeaderRow(result.desc);
		var opener = currPage.data('open') || 'swipe';
		var $recordstart = (page - 1) * limit;
		$.each(result.row, function(i, field){
			$recordstart++;
			var nD=$("<a>").addClass("oRow collection-item capitalize").css({'float':'left','width':'100%'}).appendTo(currPage).attr({"id":field.i+a,"data-id":field.i,'href':'javascript:;','data-open':opener}).click(function(){
				$(this).parent().find('a.collection-item').each(function(){$(this).removeClass('active');});
				$(this).addClass('active');
				if($('#_journal_no'+a).val() !=undefined)
				{
					loadJournal(this,a);
				}else if($('#_invoice'+a).val() !=undefined)
				{
					loadInvoice(this,a);
				}else if($('#_trans_no'+a).val() !=undefined)
				{
					loadTransaction(this,a);
				}else if($('#_load_report'+a).html() !=undefined)
				{
					loadReport(a,this);
				}else if($('#_toplevel'+a).val() !=undefined)
				{
					loadTopLevel(this,a);
				}
				else loadSelection(this,a,'new_form'+a);
			})
			var nCs=$('<span>').css({'float':'left'}).appendTo(nD); 
			$('<input>').attr({'type':'checkbox','id':'cbx_'+field.i+a,'value':field.i}).appendTo(nCs).click(function(e){e.stopPropagation();}).addClass('cbx filled-in');
			$('<span>').css({'float':'left'}).text($recordstart+'. ').appendTo(nD);
			$('<label>').appendTo(nCs).attr({'for':'cbx_'+field.i+a}).click(function(e){e.stopPropagation();});
			$(nD).createRow(field,result.fmt,result.ext);

			$(nD).appear();
		});

	}).fail(function(rsp){
		$('.progress').addClass('hide');
		$('#reloadPage'+a).removeClass('rotating');
		console.log(JSON.stringify(rsp));
		Materialize.toast('Error loading data', 4000);
});

}

function loadTopLevel(ths,a){
	pagetype=$('#page_type'+a).val();
	var parentTitle=$('#_toplevel'+a).val();
	var id = $(ths).data('id');
	if(ths.active==1) return 0;
	var dt=$(ths).find('div:first');
	var t=$(dt).children(':first').html();
	var p=parseInt($(ths).attr('id'));
	$('.progress').addClass('hide'); ths.active=0;
	$('#'+a).swapDiv('#'+parentTitle);
	$('#_linkInput'+parentTitle).val(p);
	var n=$('#_linkFilter'+parentTitle).attr('name');
	$('#_linkFilter'+parentTitle).val(n+','+p);
	$('#_linkTitle'+parentTitle).html(t);
	$('#_filterList'+parentTitle).find('.collection.back').empty();
	$('#_filterList'+parentTitle).find('.combo_hold > input').val('');
	//alert(parentTitle);
	loadOpen(parentTitle);
	var hie_name = $('#hierachy'+a).val();
	$('#'+parentTitle).find('form').each(function(){
		if($(this).find('input[name='+hie_name+']')[0] == null){
			$(this).append($('<input>').attr({type:'hidden','name':hie_name,value:id}));}
		else{$(this).find('input[name='+hie_name+']').val(id);}
		if($(this).find('input[name=hierachy_name]')[0] == null){
			$(this).append($('<input>').attr({type:'hidden','name':'hierachy_name',value:$(ths).text()}));
		}else{$(this).find('input[name=hierachy_name]').val($(ths).text());}
		
	});
	//Check for external selects
	var get_ext = {}, found = 0;
	$('#'+parentTitle).find('select.get_ext').each(function(){
		var sname = $(this).prop('name') || null;
		var cur_hierachy = $(this).attr('data-hierachy') || 0;
		if(id != cur_hierachy){
			$(this).attr({'data-hierachy':id});
			var data = $(this).data();
			if(data.table && data.column && sname !== null){
				data.hierachy_name = $('#hierachy'+a).val();
				data.hierachy = id;
				get_ext[sname] = data;
				found++;
			}
		}
	});
	if(found > 0){
		$.post("process_load.php?get_ext=1",get_ext,function(response){
			var daata = isJson(response);
			if(daata === false){
				console.log(response);
			}else{
				for(var element in daata){
					var el = $('#'+parentTitle).find('select.get_ext[name='+element+']');
					el.empty();
					for(var i in daata[element]){
						($('<option>').val(daata[element][i][0]).text(daata[element][i][1])).appendTo(el);
					}
				}
			}
		});
	}
}

function loadSelection(ths,a,formpage){
	if(typeof(ths) == 'number'){
		p = ths;
	}else{
		if(ths.active==1) return 0;
		p=$(ths).data('id');
	}
	var form = $('#'+formpage).find('form').eq(0);
	pagetype=$('#page_type'+a).val();
	$('.progress').removeClass('hide'); 
	if(typeof(ths) != 'number'){ths.active=1;}
	resetForm(form.attr('id'));
	$.getJSON("processAjax.php?pageType="+pagetype+"&id="+p, function(result){
		//console.log(result);
		$('.progress').addClass('hide'); 
		if(typeof(ths) != 'number'){ths.active=0;}
		form.attr({'data-value':p});
		if(typeof(ths) != 'number'){form.attr({'data-name':$(ths).text()});}
		$('#form_title'+a).text($(ths).text());
		$.each(result, function(i, field){
			if(i==0) ip=""; else ip=i;
			$.each(field, function(j,col){
				if(j=='roledesc'){
					var pr=col.split(',');
					for(var ip in pr){
						var pn=pr[ip].replace(':','_');
						//alert("#"+pn+a)
						form.find("#"+pn+a).prop('checked',true);
					}
				}
				var tag='';
				
				//alert("#"+j+a+" : "+col)
				var el=form.find("#"+j+a).val(col);
				form.find('.displaypicture > img#'+j+a).attr({src:'../'+col})
				if($(el).prop('tagName') !=undefined) tag=$(el).prop('tagName').toLowerCase();
				
				if($(el).hasClass('contentEdittable')){ $(el).html(col);}
				if($(el).is(':checkbox')){
					if(col){$(el).prop('checked',true);}else{$(el).prop('checked',false);}
				}
				if(tag=='select'){
					$(el).find("option[value='"+col+"']").prop('selected', true);
					$(el).next().removeClass('active').addClass('active');	
				}else if(tag == 'input' || tag == 'textarea'){
					if(col){
						$(el).next().removeClass('active').addClass('active');
					}else{
						if($(el).attr('type') != 'date'){
							$(el).next().removeClass('active');
						}
					}
				}
				if(defaultClass !=undefined) $(el).removeClass(defaultClass);
			});
			
			//Insert page image Sliders
			if(form.find('.generic-slider')[0] !== undefined){
				form.find('.generic-slider').each(function(){
					var name = $(this).parent().attr('name');
					if(field[name] !== undefined){
						var spec = isJson(field[name]);
						if(spec !== false){
							$(this).reloadSlider(spec);
						}
					}
				});
			 }
			//Insert page product descriptions
			if(form.find('.card_specifications')[0] !== undefined){
				form.find('.card_specifications').each(function(){
					var name = $(this).parent().attr('name');
					if(field[name] !== undefined){
						var spec = isJson(field[name]);
						if(spec !== false){
							$(this).reloadSpecifications(spec);
						}
					}
				});
			 }
			//Insert page product descriptions
			if(form.find('.card_images')[0] !== undefined){
				form.find('.card_images').each(function(){
					var name = $(this).parent().attr('name');
					if(field[name] !== undefined){
						var spec = isJson(field[name]);
						if(spec !== false){
							$(this).reload_cardImages(spec);
						}
					}
				});
			 }
			//Images
			if(form.find("#uploadPic"+a)[0] !== undefined){
				setTimeout(function(){
					form.find("#uploadPic"+a+' .form_pic').each(function(){
						var name = $(this).attr('data-name');
						//alert(field[name])
						if(field[name] !== undefined){
							$(this).attr({'src':field[name]});
						}
					});
				},500)
			 }
		});//alert(formpage)
		if(typeof(ths) != 'number'){
			if($(ths).data('open') == 'modal'){
				$('#'+formpage).openModal();
			}else if($(ths).data('open') == 'results'){
				loadResults(a, ths);
			}else {
				//alert(formpage);
				newForm(formpage);
			}
		}
	});
}

function isJson(str) {
	if(!str){
		return false;
	}else{
		try {
			var data = JSON.parse(str);
			if(typeof(data).toLowerCase() !== 'object'){
				return false;
			}
			return data;
		} catch (e) {
			return false;
		}
	}
}

function saveForm(a,ths,p){
	if($('#_journal_no'+a).val() !=undefined){saveJournal(a,ths,p);return;}
	else if($('#_trans_no'+a).val() !=undefined){saveTransaction(a,ths,p);return;}	
	if(ths.active==1) return 0;
	var error=0;
	$('#formData'+a+' input[data-label]').each(function(){
		if($(this).is(':visible') && $(this).attr('data-label') !=$(this).val()){
			error++;
			if($(this).val()!="") Materialize.toast($(this).val() +' is invalid', 4000);
		}
	});
	$('#formData'+a+' .unique').each(function(){
		if($(this).val()=="" || $(this).attr('validate')=='false')
		{
			error++;
			if($(this).val()!="") Materialize.toast($(this).val() +' already exists', 4000);
		}
	});
	
	 $('#formData'+a+' .richtext-title').each(function(){
		if($(this).is(':visible') && ($(this).html()=="" || $(this).html()==defaultTitle))
		{
			error++;
		   Materialize.toast('Title is not set',2000,'red');
			
		}
	 });
	
	$('#formData'+a+' .role').each(function(){
		var dId=new Array;
		$(this).find('input:checkbox:checked').each(function()
		{
			dId.push($(this).val());
		})
		if(dId.length)
		{
			var strId=dId.join();
			$(this).find('input:hidden').val(strId);
		}
	});
	var modal = $(ths).data('modal');

	if(!error)	 {	
		if(modal != undefined) {
			$('#'+modal+a).openModal();
			$('#'+modal+a).find('input')
		}else{
			//$('#status'+a)
			if($('#formData'+a)[0].checkValidity()){
				 performSave(a,ths);
				//alert('yes')
			}else{
				$('#formData'+a).find('input[required], select[required], textarea[required]').each(function(){
					if($(this).val()=="" && !$(this).is(':visible')){
						Materialize.toast($(this).attr('name')+' is empty', 1000, 'red');
						return false;
					}
				});
				//alert('yes')
			}
		}
	} 
}

function performSave(a, ths, callback){	
		var go = true;
		var param=$( "#formData"+a ).serializeArray();
		$('#formData'+a+' .contentEdittable').each(function(){
			var key= $(this).attr('name');
			var val= $(this).hasClass('richtext-title') ? $(this).text().trim() : $(this).html().trim();
			param.push({'name':key,'value':val});
		})
		$('#formData'+a+' input:checkbox').each(function(){
			var key= $(this).attr('name');
			var val=!$(this).prop('checked') ? 0: 1;
			param.push({'name':key,'value':val});
		})
		//collect image slider
		if($('#formData'+a+' .generic-slider')[0] != undefined){
			var dom = $('#formData'+a+' .generic-slider');
			dom.each(function(){
				var stringed_images = dom.readSlider();
				if(dom.parent().hasClass('required') && !stringed_images.length){
					Materialize.toast('Add an image to the slider',2000,'red');
					go = false
					return;
				}
				param.push({'name':dom.parent().attr('name'),'value':JSON.stringify(stringed_images)});
			});
		}

		//collect Card images as Object
		if($('#formData'+a+' .card_images')[0] != undefined){
			var dom = $('#formData'+a+' .card_images');
			dom.each(function(){
				var imgCard = dom.read_imageCard();
				if(dom.parent().hasClass('required') && !imgCard.length){
					Materialize.toast('Add an image to the slider',2000,'red');
					go = false
					return;
				}
				param.push({'name':dom.parent().attr('name'),'value':JSON.stringify(imgCard)});
			});
		}

		//collect product description
		if($('#formData'+a+' .card_specifications')[0] != undefined){
			var dom = $('#formData'+a+' .card_specifications');
			dom.each(function(){
				var spec = dom.getSpecifications();
				if(dom.parent().hasClass('required') && !spec.length){
					Materialize.toast('Add at least one product description',2000,'red');
					go = false;
					return;
				}
				param.push({'name':dom.parent().attr('name'),'value':JSON.stringify(spec)});
			});
		}
		 //console.log(param);
		 
		
		if(go === false){return;}
		$('.progress').removeClass('hide');ths.active=1;
		$.post( "process_generic.php", param ).done(function(data)
		{
			//console.log(data);
			$('.progress').addClass('hide'); ths.active=0;
			try
			{
				//JSON.parse(data);
				if(parseInt(data) !==0)
				{
					if(isNaN(parseFloat(data))){
						console.log(data);
						console.log(e);
						Materialize.toast('An Error Ocurred', 4000,'red');
						return;
					}
					Materialize.toast('Successfully submitted', 4000);
					if($('#formData'+a).parent().hasClass('modal')){
						$('#formData'+a).parent().closeModal();
					}
					if(typeof(callback) == 'function'){callback(data);}
					if($('#noreset'+a).get(0) ==null){
						resetForm('formData'+a);
						loadOpen(a);
					}
				}else Materialize.toast('You donot have the appropriate access for the operation', 4000);
			}catch (e)
			{
				console.log(data);
				console.log(e);
				Materialize.toast('Error while submitting', 4000);
			}
		});
}
function resetForm(a){
	var form = $('#'+a);
	var p = form.attr('data-pageid');
	form.find('input:not([type=hidden]), textarea').each(function(){
		if(!$(this).hasClass('keep')){
			$(this).val('');
			if($(this).attr('type') != 'date'){$(this).next().removeClass('active');}
		}
	});
	$('#form_title'+p).empty();
	form.find('.extra').val('');
	form.find('.displaypicture > img').attr({src:''});
    form.find('input:radio, input:checkbox').prop({'checked':false}).removeAttr('selected');
	form.find('.contentEdittable').each(function(){
			var df= $(this).attr('data-default');
			$(this).html(df);
		})
	form.find('select').each(function()	{ 
		$(this).find('option:first').prop({'selected':true});
		$(this).next().removeClass('active');
	});
	//$("#formData"+a).find('select.heirachy').empty();
	form.find('.cashAccount').each(function(){ 
		var sl=$(this).attr('default-value');
		if(sl!=undefined){
		 	$(this).val(sl);
		}
	});
 	if(form.find('.generic-slider')[0] != undefined){
		insertSlide(form.find('.generic-slider ul.slides'),false);
	}
	if(form.find('.card_specifications')[0] != undefined){
		form.find('.card_specifications').each(function(){
			$(this).resetSpecifications();
		});
	}
	if(form.find('.card_images')[0] != undefined){
		form.find('.card_images').each(function(){
			$(this).resetCardImages();
		});
	}
	$('#_item_display'+p).html('');
	$('#_invoice_display'+p).html('');
	$('#_invoice_category'+p).html('');
	$('#_itemlist_div'+p).hide();
	$('#_invoiceitem_div'+p).hide();
	$('#_itemlist_div1'+p).find('.newRow').remove();
	
	$('#_item_div'+p).show();
	$('#_prep_div'+p).hide();
	$('#_item_div'+p).find('input').prop({'disabled':false});
	$('#_prep_div'+p).find('input').prop({'disabled':true});
	var td=getCookie('_today')==''?_today:getCookie('_today');
	$('.date').val(td).next().addClass('active');
	$('.form_pic').attr({'src':'images/default.png'});
	$('.form_image').attr({'src':'images/default-image.png'});
	$('#_count'+p).val('2');
}

function deleteMultiple(a)
{
	pagetype=$('#page_type'+a).val();
	var dId=new Array;
	$('#'+a+' .cbx:checked').each(function(){ dId.push($(this).val())});
	if(dId.length)
	{
		var strId=dId.join();
		$(this).questionBox(' Are you sure you want to delete these row(s)',function(){
			$('.progress').removeClass('hide');
			$.post('processAjax.php',{'delIds':strId,'pageType':pagetype},function(data)
			{
				$('.progress').addClass('hide');

				if(data=='1')
				{
					Materialize.toast('Rows successfully deleted', 4000);
					for(var k=0; k<dId.length; k++)
					{
						$("#"+dId[k]+a).remove();
					}
				}else {
					console.log(data);
					Materialize.toast('Error deleting rows or you donot have access for deletion', 4000);
				}
				
			})
		});
	}else Materialize.toast('No row selected. Select row first', 4000);
}

function printMultiple(a){
	pagetype=$('#page_type'+a).val();
	var dId=new Array;
	$('#'+a+' .cbx:checked').each(function(){ dId.push($(this).val())});
	if(dId.length)
	{
		var strId=dId.join();
		window.showModalDialog('multi_print.php?pageType='+pagetype+'&printIds='+strId);
	}else Materialize.toast('No row selected. Select row first', 4000);
}
function deleteSingle(a)
{
	pagetype=$('#page_type'+a).val();
	var dId=new Array;
	$('#'+a+' .uniqueId').each(function(){ dId.push($(this).val())});
	var strId=dId.join('');
	if(strId!='')
	{
		$(this).questionBox(' Are you sure you want to delete',function(){
			$('.progress').removeClass('hide');
			$.post('processAjax.php',{'delIds':strId,'pageType':pagetype},function(data)
			{
				console.log(data);
				$('.progress').addClass('hide');
				if(data=='1')
				{
					
					for(var k=0; k<dId.length; k++)
					{
						$("#"+dId[k]+a).remove();
					}
					Materialize.toast('Record successfully deleted', 4000);
					resetForm('formData'+a);
				}else Materialize.toast('Error deleting rows or you donot have access for deletion', 4000);
				
			})
		});
	}else Materialize.toast('No record selected', 4000);
}
function formInitialize(p,t){
	var a = p==undefined ? '' : p;
	$('#new'+a).click(function(){resetForm('formData'+a),newForm('new_form'+a);});
	$('#close'+a).click(function(){openForm('new_form'+a);resetForm('formData'+a)});
	$('#loadclose'+a).click(function(){loadClose(a)});
	$('#formSave'+a).click(function(){saveForm(a,this);});
	$('#resultLoad'+a).click(function(){loadResults(a,this);});
	$('#getAnnual'+a).click(function(){get_annual(a,this);});
	$('#resultDelete'+a).click(function(){deleteResult(a,this);});
	$('#loadSave'+a).click(function(){submitAction(this,a);});
	$('#secondarySave'+a).click(function(){saveForm(a,this);});
	$('#saveModal'+a).click(function(){$(this).saveModal(a)});
	$('#formReset'+a).click(function(){resetForm('formData'+a);});
	$('#reloadPage'+a).click(function(){reloadPageList(a);});
	$('#holder'+a+' .noref').click(function(){noref(this);});
	$('#_multiDelete'+a).click(function(){deleteMultiple(a)});
	$('#_multiPrint'+a).click(function(){printMultiple(a)});
	$('#_singleDelete'+a).click(function(){deleteSingle(a)});
	$('#newFloat'+a).click(function(){$('#new_form'+a).openModal(); resetForm('formData'+a);});
	$('#reportSetup'+a).click(function(){$('#_report_setup'+a).openModal()});
	$('#uploadPic'+a).click(function(){$(this).uploadDialog({
		'callback':function(a, b){ changePicture(a,b) ;},
		'onDrag':function(data){console.log(data);dragResponse();}
	})});
	if($('#formData'+a).find('.description-container')[0] !== undefined){
		$('#formData'+a).find('.description-container').each(function(){
			$(this).init_specifications({directory:'../asset/',processor:'upload_v2_0.php'});
		})
	}
	if($('#formData'+a).find('.slider-container')[0] !== undefined){
		$('#formData'+a).find('.slider-container').each(function(){
			$(this).initSlider({editable:true,anchors:true,directory:'../asset/',processor:'upload_v2_0.php'})
		})
	}
	if($('#formData'+a).find('.items-container')[0] !== undefined){
		$('#formData'+a).find('.items-container').each(function(){
			$(this).init_cardImages({directory:'../asset/',processor:'upload_v2_0.php',editable:true,max:4});
		})
	}
	$('#'+a+' .richtext-body').richtextBody();
	$('#'+a+' .richtext-title').richtextTitle();
	$('#'+a).prepareMultiPager(a);
	$('#'+a).find('.unique').each(function(i,v){$(v).uniqueInit()});
	$('#'+a).find('select').material_select();
	$('#'+a).find('.modal-trigger').leanModal();
	$('#'+a).find('.action-btn').click(function(){submitAction(this,a)});
	$('#'+a).find('.role-check').click(function()	{
		if($(this).prop('checked')) $(this).parent().parent().find('input:checkbox').prop({'checked':true}); else $(this).parent().parent().find('input:checkbox').prop({'checked':false})
	});
	$('#'+a+' .formfilterList').each(function(){
		if($(this).attr('name') !=undefined) $(this).change(function(){loadReport(a,this)});
	})

	$('#_searchBox'+a).keyup(function(){loadOpen(a)});
	$('#_rangeBox'+a).change(function(){$('#active_page'+a).attr({'data-active':1}).val(1);loadOpen(a)});
	$('#'+a+' .rlAll').click(function(){ var cd=$(this).val(); if($(this).prop('checked'))$('#'+a+' .cbr'+cd).prop({"checked":true}); else $('#'+a+' .cbr'+cd).prop({"checked":false});})
	$('#'+a+' .combo').each(function(i,v){$(v).comboInit()});
	$('#'+a+' .filter').each(function(i,v){$(v).filterInit(a,function(){loadOpen(a);})});
	$('#'+a+' .tooltipped').tooltip({delay:50});
	if($('#'+a+' .date')[0] != null){
		$('#'+a+' .date').datetimepicker({'format':'Y-m-d','timepicker':false});
	}
	$('#'+a+' .uploadDoc').click(function(){ uploadModal(this,function(a,b){ editPicture(a,b) ;})});
	$('#'+a+' .subformSave').click(function(){ saveSubform(a,this)})
	$('#'+a+' .dateFilter').each(function(i,thx){
		$(this).initDateRange(a, function(a){loadOpen(a)});
	})
	if(t!=undefined && t==2)loadSelection(1, a ,'new_form'+a);
	else loadOpen(a);
	
}
function saveSubform(a,b)
{
	var fm =$(b).attr('data-action');
	//alert(fm);
	var error=0;
	$(fm+' input[required]').each(function(){
		if($(this).val()=="")
		{
			error++;
			if($(this).attr('created')==undefined)
			{
	 			$('<div>').text('This is required').insertAfter($(this)).animate({"margin-left":'40px'});
				$(this).attr({'created':1})
			}
			else $(this).next().animate({"margin-left":'40px','opacity':100});
		}else if($(this).attr('created')==1)$(this).next().animate({"margin-left":'0px','opacity':0});
	 
	 });
	 $(fm+' select[required]').each(function(){
		if($(this).val()=="")
		{
			error++;
			if($(this).attr('created')==undefined)
			{
	 			$('<div>').text('This is required').insertAfter($(this)).animate({"margin-left":'40px'});
				$(this).attr({'created':1})
			}
			else $(this).next().animate({"margin-left":'40px','opacity':100});
		}else if($(this).attr('created')==1)$(this).next().animate({"margin-left":'0px','opacity':0});
	 
	 });
	
	$(fm+' .role').each(function()
	{
		var dId=new Array;
		$(this).find('input:checkbox:checked').each(function()
		{
			dId.push($(this).val());										   
		})
		if(dId.length)
		{
			var strId=dId.join();
			$(this).find('input:hidden').val(strId);
		}
	});
	 if(!error)
	 {	
	 	$('.progress').removeClass('hide');
		$.post( "process_generic.php", $(fm ).serialize() ).done(function(data)
		{
			//alert(data);
			$('.progress').addClass('hide');
			try
			{
				JSON.parse(data);
				if(parseInt(data) !=0)
				{
					Materialize.toast('Successfully submitted', 4000);
					resetForm('formData'+a);
					loadOpen(a);
				}else Materialize.toast('You donot have the appropriate access for the operation', 4000);
			}catch (e)
			{
				Materialize.toast('Error while submitting', 4000);
			}
		});
			
		
	}

	
}
function submitAction(a,p){
		var fm=$(a).attr('href');
		var frm=$(a).closest('form');
		var dId=new Array;
		$('#'+p+' .cbx:checked').each(function(){ dId.push($(this).val())});
		var strId=dId.join();
		$(frm).find('.filter_checkbox').val(strId);
		if($(frm)[0].checkValidity()){
			var formData, $type;
			/*if($(frm).attr('data-submit') != '1'){
				alert('not 1')
				formData = $(frm).serialize();
				$type = 'GET';
			}else{*/
				var data = $(frm).serializeArray();
				formData = new FormData;
				$.each(data, function(i,v){
					var name = v.name;
					var value = v.value;
					formData.append(name, value);
				})
				if($('#datafile'+p)[0] != null){
					formData.append('datafile', $('#datafile'+p)[0].files[0]);
				}
				formData.append('ajax', 1);
				$type = 'POST';
			//}
			
			console.log(data);
			$('.progress').removeClass('hide');
			$.ajax({
				url: $(frm).attr('action'),
				type: $type,
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (response) {
					$('.progress').addClass('hide');
					console.log(response);
					if($(frm).attr('data-submit')=='1'){
						//return;
						if($('#confirm_load'+p)[0] == null){
							$('#'+p).append($('<div>').addClass('confirm_load').attr({'id':'confirm_load'+p}));
						}
						$('#confirm_load'+p).html(response);
						$(a).closest('.modal').closeModal({
							complete:function(){
								$('.lean-overlay').hide();
							}
						});
						$(frm)[0].reset();
						$('#open_form'+p).swapDiv($('#confirm_load'+p));
					}else{
						//console.log(response);
						Materialize.toast(response, 4000);
						if(response == 'submitted'){
							loadClose(p);
						}
					}
				}
			})
		}//else{alert('no')}
}

$.fn.extend({saveModal:function(a){
	var form = $(this).closest('form'),
		modal = form.find('#formSave'+a).data('modal')+a;
	//alert(form.find('#status'+a).val());
	//return;
	if(form[0].checkValidity()){
		performSave(a, $(this),function(data){
			$('#'+modal).closeModal();
		});
	}else{
	    form.find('input[required], select[required], textarea[required]').each(function(){
			if(!$(this).val() && !$(this).is(':visible')){
				Materialize.toast($(this).attr('name')+' is empty', 1000, 'red');
				return false;
			}
		});
	}
}});

$.fn.extend({prepareMultiPager:function(a){
	var forms = $(this).find('form');// Find all forms within a section
	forms.each(function(i){
		$(this).find('.page').eq(0).addClass('active');//Activate the first page
		var thsfom = $(this);
		if(thsfom.find('.page').length > 1){// If pages are more than one
			thsfom.find('.page').not('.active').hide();
			thsfom.find('.prevPage').hide().click(function(){
				var form = $(this).closest('form');
				var active = form.find('.page.active').eq(0);
				var pages = form.find('.page');
				$(active).swapDiv(active.prev('.page'));
				pages.removeClass('active');
				active.prev('.page').addClass('active');
				if(!form.find('.page.active').prev('.page').length){$(this).hide();}//Hide previous of first page
				if(form.find('.page.active').next('.page').length){thsfom.find('.flt button.nextPage').attr({disabled:false})}
			});
			thsfom.find('.flt button#formSave'+a).removeAttr('id').addClass('nextPage teal').removeClass('red').off('click').click(function(){
				var form = $(this).closest('form');
				var active = form.find('.page.active').eq(0);
				var pages = form.find('.page');
				$(active).swapDiv(active.next('.page'));
				pages.removeClass('active');
				active.next('.page').addClass('active');
				if(!form.find('.page.active').next('.page').length){$(this).attr({'disabled':true});}
				if(form.find('.page.active').prev('.page').length){thsfom.find('.prevPage').show();}
			}).find('img').attr({'src':'icons/chevron_right.svg'});
			thsfom.find('.flt ul').append($('<li>').append($('<button>').attr({'id':'formSave'+a}).click(function(){saveForm(a,this);}).addClass('btn-floating orange').append($('<img>').attr({'src':'icons/save.svg'}).addClass('material-icons'))));
		}else{
			thsfom.find('.prevPage').remove();
			thsfom.find('.flt ul #secondarySave'+a).remove();
		}
	});
	
}});

function toTitleCase(str){
	//console.log(str);
	if(str==undefined) return '';else if(typeof(str) != 'string') return str;
	else return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

function loadClose(a){
	var page = a.split('_');
	page = '_'+page[page.length-parseInt(1)];
	loadOpen(page);
	$('#'+a).swapDiv($('#open_form'+page));
}

function synchronize(ths){
	
	$(ths).questionBox('Are you sure you want to run synchronization', function(){
		var obj = {switch:1};
		$(ths).find('img').addClass('rotating');
		$('.progress').removeClass('hide');
		$.post('backup_database.php',obj,function(response){
			$(ths).find('img').removeClass('rotating');
			$('.progress').addClass('hide');
			if(response == 'done'){
				Materialize.toast('Successfully Synchronized',2000,'green');
			}else{
				console.log(response);
				Materialize.toast('An error occured , check console',2000,'red');
			}
		})
	});
}

$.fn.extend({initDateRange:function(defaultRange, callback){
	var thx = this;
	var obj = {			 
		"showDropdowns": true,
		firstDayOfWeek: 0,
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		startDate: moment().startOf('month'),
		endDate: moment(),
		"alwaysShowCalendars": true,
		"minDate": "01/01/2018",
		"maxDate": moment(),
		"opens": "left",
		"drops": 'bottom'
	}
	if(obj.ranges[defaultRange]){
		$(thx).attr({'data-date':obj.ranges[defaultRange][0].format('L') + ' - ' + obj.ranges[defaultRange][1].format('L')});
	}else{
		$(thx).attr({'data-date':moment().format('L') + ' - ' + moment().format('L')});
	}
	$(thx).daterangepicker(obj, function (startDate, endDate, label) {
		setTimeout(function(){
			$(thx).attr({'data-date':startDate.format('L') + ' - ' + endDate.format('L')});
			$(thx).val(label);
			if(typeof(callback) == 'function'){callback({startDate:startDate, endDate:endDate, label:label});}
		},10);
	});
	var val = defaultRange ||'Today';
	$(thx).val(val);
	
}})

function heirachy_select(x){
	var $this = $(x);
	var a = $this.data('pageid');
	var target = $this.data('target');
	var source = $this.data('target_source');
	var filter = $this.data('target_filter');
	var val = $this.val();
	//alert(val);return;
	var obj = {source:source, value:val, heirachy_select:true, filter:filter};
	$('.progress').removeClass('hide');
	$.post('get_param.php',obj,function(response){
		$('.progress').addClass('hide');
		var data = isJson(response);
		var sel = $('#'+target+a);
		sel.empty();
		if(data == false){
			console.log(response);
		}else{
			for(var i in data){
				sel.append($('<option>').attr({value:i}).text(data[i]));
			}
		}
	});
}

function reloadPageList(a){
	$('#'+a+' .filterList').each(function(){$(this).val('');$(this).attr({value:''});});
	$('#'+a+' .filterValue').each(function(){$(this).val('');$(this).attr({value:''});});
	$('#'+a+' .dateFilter').each(function(){$(this).val('');$(this).attr({value:''});});
	$('#_rangeBox'+a).val('');
	loadOpen(a);
}

function reload_selects(a){
//return;
	a = '_'+a;
	var data = {}, found = 0;
	setTimeout(function(){
		var arr = []; 
		$('#formData'+a).find('select[data-target]').each(function(){
			arr.push($(this).data('target')+a);
		})
		$('#formData'+a).find('select:not(.get_ext)').each(function(){
			var obj = {};
			var id = $(this).attr('id');
			if($.inArray(id, arr) == -1){
				obj.source = $(this).data('source');
				if($(this).data('target') != undefined){
					//alert($(this).val());
					var nObj = {};
					var nIid = $(this).data('target')+a;
					nObj.value = $(this).val();
					nObj.filter = $(this).data('target_filter');
					nObj.source = $(this).data('target_source');
					data[nIid] = nObj;
				}
				if($(this).data('column') != undefined){obj.column = $(this).data('column');}
				data[id] = obj;
				found++;
			}else{$(this).addClass('heirachy');}
		});
		if(found > 0){//console.log(data);//return;
			$.post('get_param.php?reload_select=true',data,function(response){
				var data_ = isJson(response);
				if(data_ == false){
					console.log(response);
				}else{
					//console.log(response);
					for(var id in data_){
						var val = $('#'+id).val();
						$('#'+id).empty();
						$('#'+id).append($('<option>').attr({value:""}).text('Select'));
						for(var i in data_[id]){
							$('#'+id).append($('<option>').attr({value:i}).text(data_[id][i]));
						}
						$('#'+id).val(val);
					}
				}
			});
		}
	}, 250)
}

function pageAlgorithm($total, $limit, a){
	
	var dec = $total / $limit, floor = Math.ceil(dec);
	floor = floor > 25 ? 25 : floor;
	var pages_cont = $('#pagination'+a);
	var active = $('#active_page'+a).attr('data-active') || 1;
	active = parseInt(active);
	pages_cont.empty();
	if(dec > 1){
		for(i = 1; i<=floor; i++){
			var o = i;
			$('<a>').addClass(function(){
				if(o == active){
					return "active";
				}
			}).click(function(){
				loadpage(this);
			}).attr({'data-pagenum':o}).text(o).appendTo(pages_cont);
		}
	}
	return pages_cont;
}



function loadpage(x){
	var a = $(x).parent().data('pageid');
	var page = $(x).data('pagenum');
	//alert(page);
	$('#active_page'+a).attr({'data-active':page}).val(page);
	loadOpen(a);
}