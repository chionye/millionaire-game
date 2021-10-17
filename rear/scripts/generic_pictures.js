// Generic Pictures by clinton onuigbo 15/07/2018
/*
	*This document requires Jquery, materialize, upload.php latest version and uploadDialog.js' latest version
	*This document contains Generic Sliders, Generic card images, Generic DP, and lot more generic pictures to come
	
	*NB:// upload.php should be in the same dir as the page your working on
	____________________________________________________________________________________________________________
	FOR GENERIC SLIDERS
		TO INITIALIZE THE SLIDERS
		* run $(document).initSlider({
			images:'',
			editable:'',
			anchors:'',
			animatable:'',
			onDrag:'',
			directory:'',
			processor:''
		}) on any element to want the sliders to be initialized on;
			* images = 	 array of image objects in this format below
				- [0 => {'src':'','title':'','desc':'',anchors:{'name':'', 'href':''}(optional, only shows when intiSlider.anchor is set true)}]
				- It can also accept an empty array to create a default image
				- default is an empty array
			*editable = boolean (true or false) to create editors
				- default is false
			*anchors = boolean (true or false) to buttons
				- default is false
			*animatable = boolean (true or false) to create slides with animations
				- default is true
				- animatable when images are more than 1
			*onDrag = callback function for draging a file into a folder in uploadDialog
				- default is toast success message
			*directory = A working directory to your server files for the uploadDialog
				- default directory is '../asset/'
			*processor = A working directory to the latest version of the upload.php file
				- default is toast success message

		TO re-initialize an existing slider
			* run $(document).reloadSlider(images) on the generic-slider element  

		TO SAVE THE SLIDERS BACK TO OBJECT ARRAY
			* run $('document').readSlider({
				required : ''
			}) on the generic-slider element 
				*required = boolean (true or false) to validate the image
					- default is false
	____________________________________________________________________________________________________________
	FOR GENERIC CARD IMAGES
		TO INITIALIZE THE CARD IMAGES
		* run $(document).init_cardImages({
			images:[],
			editable:'',
			max:''
		})on any element to want the CARD IMAGES to be initialized on;
		* images = 	 array of image objects in this format below
			- [0 => {'src':'','title':'','desc':'',anchors:{'name':'', 'href':''}(optional, only shows when intiSlider.anchor is set true)}]
			- It can also accept an empty array to create a default image
			- default is an empty array
		*editable = boolean (true or false) to create editors
			- default is false
		*max = boolean (true or false) to buttons
			- default is false
		*onDrag = callback function for draging a file into a folder in uploadDialog
			- default is toast success message
			
		TO COLLECT THE  CARD IMAGES AS OBJECT
		* run $('.card_images').read_imageCard() on the initialized (card_images) element
		
		TO RELOAD THE  CARD IMAGES AS OBJECT
		* run $('.card_images').reload_cardImages() on the initialized (card_images) element
		
		TO RESET THE CARD IMAGES 
		* run $('.card_images').resetCardImages() on the initialized (card_images) element
	____________________________________________________________________________________________________________
	FOR DESCRIPTION
		TO INITIALIZE DESCRIPTION
		* run $(document).init_specifications({
			directory:'../asset/',
			processor:'upload_v2_0.php'
		});
		on any element to want the CARD IMAGES to be initialized on;
		* images = 	 array of image objects in this format below
			- [0 => {'src':'','title':'','desc':'',anchors:{'name':'', 'href':''}(optional, only shows when intiSlider.anchor is set true)}]
			- It can also accept an empty array to create a default image
			- default is an empty array
		*editable = boolean (true or false) to create editors
			- default is false
		*max = boolean (true or false) to buttons
			- default is false
		*onDrag = callback function for draging a file into a folder in uploadDialog
			- default is toast success message
			
		TO RELOAD THE DESCRIPTION
		* run $(document).reloadSpecifications([array of images]) on the initialized (card_images) element
		
		TO RESET THE DESCRIPTION
		* run $(document).reloadSpecifications([]) on the initialized (card_images) element
		
		TO COLLECT THE IMAGES AS OBJECT
		* run $('.card_images').read_imageCard() on the initialized (card_images) element
	____________________________________________________________________________________________________________
	
*/
var animatable = true;
var slide_editable = false;
$.fn.extend({
	initSlider:function(init){
	/*if(typeof($.uploadDialog) != 'function'){
		console.log("uploadDialog.js is required for this to work");
		return;
	}*/
	var $this = $(this);
	var container = $this;
	init.directory = !init.directory ? 'asset/' : init.directory;
	init.processor = !init.processor ? 'admin/upload_v2_0.php' : init.processor;
	var slides = returnSlides(init);
	if(init.editable !== undefined){
		slide_editable = init.editable === true ? init.editable : false;
	}
	container.prepend($('<div>').addClass('col s12 generic-slider')
		.append(function(){
			if(slide_editable === true){
				return(
				 $('<a>').addClass('addSlide').attr({'data-path':init.directory,'data-display':'all','data-href':init.processor,'data-edit':'2','data-anchor':init.anchors}).click(function(){
					var active = $(this).closest('.generic-slider').find('.slides > li.active');
					$(this).uploadDialog({
						callback:function(a, data){insertSlide(active, data);}
					});
				 }).append($('<img>').attr({src:'icons/wallpaper.svg'}).addClass('material-icons small'))
				);
			}else{return null;}
		})
		.append($('<div>').addClass('slider')
		.append(slides)));
	container.find('.slider').slider();
	container.find('.generic-slider').activate();
}});

function returnSlides(obj){
	var edit = obj.editable ? obj.editable : false;
	var anchor = obj.anchors || $('.addSlide').attr('data-anchor') == 'true' ? true : false;
	var  images= [], slides = $('<ul>').addClass('slides'),
		classes = ['','right-align','center-align','left-align'];
	if(!obj.images && typeof(obj.images) != 'object' || !obj.images.length){
		var defaulT = {'src':obj.directory+'picture/default-banner.jpg','title':'Default Slogan','desc':'Short Description','default':true,'type':'picture'};
		if(anchor){
			defaulT.anchor = {};
			defaulT.anchor.name = 'Default Button';
			defaulT.anchor.href = 'javascript:;';
		}
		images.push(defaulT);
		edit = false;
	}else{
		images = obj.images;
	}
	for(var i in images){
		var place = classes[1 + Math.floor(Math.random() * 3)];
		images[i].type = images[i].type.toLowerCase();
		if(images[i].type != "picture" && images[i].type != 'video'){continue;}
		var def = images[i].default ? ' default' : '';
		var slide = $('<li>').addClass('lim'+def).attr({'data-type':images[i].type}).append(function(){
			if(images[i].type == 'picture'){
					return($('<img>').attr({'src':images[i].src}));
				}else if(images[i].type == 'video'){return($('<video>').attr({'width':'100%','height':'100%','play':true}).append($('<source>').attr({'src':images[i].src})));
				}
			}
		).append($('<div>').addClass('caption '+place)
			.append($('<h3>').addClass('modak').text(images[i].title))
			.append($('<h5>').addClass('light grey-text text-lighten-3').text(images[i].desc))
			.append(function(){
				if(anchor && images[i].anchor && images[i].anchor.name){ 
				   return($('<a>').addClass('slider_anchor btn '+place.split('-')[0]).attr({'href':images[i].anchor.href}).text(images[i].anchor.name));
				 }else{ return false;}
			})
		);
		slide.append(function(){
			if(edit === true){
				return(
					$('<span>').addClass('slidEditors').append($('<i>').addClass('material-icons tiny').attr({'data-anchor':anchor}).css({'background-image':'url("icons/edit_black.svg")'}).click(function(){editSlide(this);})).append($('<i>').addClass('material-icons tiny').css({'background-image':'url("icons/clear_black.svg")'}).click(function(){insertSlide($(this),false);}))
				)
			}else{
				return null;
			}
		})
		slides.append(slide);
	}
	return slides;
}						

function insertSlide($this,image){
	var dom = $this.closest('.generic-slider');
	if(image === false){
		if($($this).prop('nodeName').toLowerCase() == 'ul'){
			$($this).empty();//clears all slides
		}else{
			$($this).closest('li').remove();
		}
	}else{
		
		image.type = image.type.toLowerCase();
		if(image.type != "picture" && image.type != 'video'){return;}
		var anchor = $this.closest('.generic-slider').find('.addSlide').attr('data-anchor');
		$this.after($('<li>').attr({'data-type':image.type}).addClass('hide lim').append(function(){
			if(image.type == 'picture'){
					return($('<img>').attr({'style':'background-image: url("'+image.src+'");'}));
			}else if(image.type == 'video'){
				return($('<video>').attr({'width':'100%','height':'100%'}).append($('<source>').attr({'src':image.src})));
			}
		}).append($('<div>').addClass('caption center-align').append($('<h3>').text(image.title)).append($('<h5>').addClass('light grey-text text-lighten-3').text(image.desc)).append(function(){
			if(anchor && image.anchor_name){ 
			   return($('<a>').addClass('btn').attr({'href':image.anchor_href}).text(image.anchor_name));
			 }else{ return false;}
		})));
	}
	var data = dom.readSlider();
	dom.reloadSlider(data);
}

$.fn.extend({
	readSlider:function(option){
	var data = [], img;
	var dom = $(this);
	var anchor = dom.find('.addSlide').attr('data-anchor');
	dom.find('.slides > li.lim:not(.default)').each(function(){
		var obj = {};
		obj.type = $(this).attr('data-type');
		if(obj.type == 'picture'){
			img = $(this).find('img').attr('style');
			img = img.split('("')[1];
			img = img.split('")')[0];
		}else if(obj.type == 'video'){
			img = $(this).find('source').attr('src');
		}
		obj.src = img;
		obj.title = $(this).find('.caption h3').text();
		obj.desc = $(this).find('.caption h5').text();
		if(anchor){
			obj.anchor = {};
			obj.anchor.name = $(this).find('.caption a.btn').text();
			obj.anchor.href = $(this).find('.caption a.btn').attr('href');
		}
		data.push(obj);
	});
	if(!data.length && option && option.getall === true){
		Materialize.toast('Add an Image to the slider', 2000, 'red');
		return;
	}
	return data;
}});

$.fn.extend({
	reloadSlider:function(data){
	var slides = returnSlides({
		images:data,
		editable:slide_editable
	});
	$(this).find('.slider').empty().append(slides).slider();
	$(this).activate();
}});

$.fn.extend({
	activate:function(){
	var indicators = $(this).find('.indicators');
	if(indicators[0] != undefined && indicators.find('li').length < 2){
		indicators.remove();
	}
	if(animatable === true && indicators.find('li').length > 1){
		$(this).closest('.generic-slider').addClass('animatable');
	}else{
		$(this).closest('.generic-slider').removeClass('animatable');
	}
}});


function editSlide(x){
	var $this = $(x).closest('li'), img,
	type = $this.attr('data-type');
	if(type == 'picture'){
		img = $this.find('img').attr('style');
		img = img.split('("')[1];
		img = img.split('")')[0];
	}else if(type == 'video'){
		img = $this.find('source').attr('src');
	}
	var title = $this.find('.caption h3').text();
	var desc = $this.find('.caption h5').text();
	var name = $this.find('.caption a.btn').text();
	var href = $this.find('.caption a.btn').attr('href');
	var data = {
		src:img,
		title:title,
		desc:desc,
		type:type,
	};
	if(name){
		data.anchor = {};
		data.anchor.href = href;
		data.anchor.name = name;
	}
	var dir = $this.closest('.generic-slider').find('.addSlide').attr('data-path');
	$(x).attr({'data-edit':2,'data-path':dir}).modify_resource({
		'data':data,
		'onDrag':false,
		'callback':function(a, image){
			$this.attr({'data-type':image.type});
			$this.find('.caption h3').text(image.title);
			$this.find('.caption h5').text(image.desc);
			if(image.anchor_name){
				if($this.find('.caption a.btn')[0]){
					$this.find('.caption a.btn').text(image.anchor_name);
					$this.find('.caption a.btn').attr({'href':image.anchor_href});
				}else{
				   	$this.find('.caption').append($('<a>').addClass('btn slider_anchor').attr({'href':image.anchor_href}).text(image.anchor_name));
				}
			}else{
				if($this.find('.caption a.btn')[0]){
					$this.find('.caption a.btn').remove();
				}
			}
			if(image.type == 'picture' && type == 'picture'){
				$this.find('img').attr({'style':'background-image: url("'+image.src+'");'});
			}else if(image.type == 'video' && type == 'picture'){
				$this.find('img').remove();
				$this.prepend($('<video>').attr({'width':'100%', 'height':'100%'}).append($('<source>').attr({'src':image.src})));
			}else if(image.type == 'video' && type == 'video'){
				$this.find('source').attr({'src':image.src});
			}else if(image.type == 'picture' && type == 'video'){
				$this.find('video').remove();
				$this.prepend($('<img>').attr({'style':'background-image: url("'+image.src+'");','src':'data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='}));
			}
		}
	});
}

// ---------------------------------------------------------- Card Images Here ---------------------------------------
var card_height;
$.fn.extend({init_cardImages:function(init){

	var $this = $(this);
	var card_cont = $('<div>').addClass('card_images initialized');
	init.directory = !init.directory ? 'asset/' : init.directory;
	init.processor = !init.processor ? 'admin/upload_v2_0.php' : init.processor;

	var slides = returnCards(init);
	card_cont.attr({'data-path':init.directory,'data-href':init.processor});
	card_cont.append(slides);
	card_cont[0].param = init;
	$this.prepend(card_cont);
	setTimeout(function(){
		card_height = $this.find('.card_images .ch-grid > li').eq(0).height(); // Val remember to change the height() to width() for responsibiliity.
		// alert(card_height);
		$this.find('.card_images .ch-grid > li').css({'height':card_height});
		card_cont[0].param.height = card_height;
	}, 100);
}});

$.fn.extend({reload_cardImages:function(array){
	if($(this).hasClass('card_images')){
		var $this = $(this);
		var param = $(this).prop('param');
		param.images = array;
		$(this).empty();
		var slides = returnCards(param);
		$(this).append(slides);
		setTimeout(function(){
			$this.find('.card_images .ch-grid > li').css({'height':param.height});
		}, 100);
	}else{
		alert('Cant reload items on an uninitialized element');
	}
}})

function returnCards(data){
	var max = data.max ? data.max : 4,
		editable = data.editable !== undefined ? data.editable : false,
		defaulT = {
			src:data.directory+'/picture/default-banner.jpg',
			title:'Default Title',
			'desc':'Default Description, click to add image',
			//'anchor':{'name':'Click Here','href':'javascript:;'}
		},
		ul = $('<ul>').addClass('ch-grid'), images = [];

	if(!data.images && typeof(data.images) != 'object' || !data.images.length){
		images.push(defaulT);
	}else{
		images = data.images;
	}
	for(var i = 0; i <= max-parseInt(1); i++){
		var obj, cls = '';
		if(images[i] === undefined){obj = defaulT; cls = 'default';}else{obj = images[i];}
		var li = $('<li>').addClass('li');
		var card = oneCard(obj,editable, cls);
		li.append(card);
		ul.append(li);
	}
	if(max !== 4){
		$('.card_images').css({'height':'auto !important'});
	}
	return ul;
}

$.fn.extend({editCard:function(){
	var $this = $(this).closest('.ch-item');
	$this.attr({'data-edit':2, 'data-href':$('.card_images').attr('data-href')});
	var data = {};
	var src = $this.css('background-image');
	src = src.replace('url("', '');
	src = src.replace('")', '');
	data.type = 'picture';
	data.src = src; 
	data.title = $this.find('.ch-info h3').text() == 'Default Title' ? '' : $this.find('.ch-info h3').text();
	data.desc = $this.find('.ch-info .card_desc').text() == 'Default Description' ? '' : $this.find('.ch-info .card_desc').text();
	if($this.find('.ch-info a').attr('href') !== undefined){
		data.anchor = {
			name : $this.find('.ch-info a').text(),
			href : $this.find('.ch-info a').attr('href')
		};
	}
	$this.modify_resource({
		data:data,
		callback:function(a, image){
			$this.modify_imageCard(image);
			$this.removeAttr('data-edit');
		}
	});
}});

$.fn.extend({modify_imageCard:function(image){
	
	if(image.type == 'picture'){
		var $this = $(this).parent();
		if(image.anchor_name && image.anchor_href){
			image.anchor = {};
			image.anchor.name = image.anchor_name;
			image.anchor.href = image.anchor_href;
		}
		var card = oneCard(image, true, '');
		$this.empty().append(card);
		$(this).css({'background-image': 'url('+image.src+')'});
	}else{
		console.log('Only images are supported');
	}
}});

$.fn.extend({read_imageCard:function(){
	if($(this).hasClass('card_images initialized')){
		var images = [];
		$(this).find('.ch-grid .ch-item').each(function(){
			if(!$(this).hasClass('default')){
				var obj = {};
				var src = $(this).css('background-image');
				src = src.replace('url("', '');
				src = src.replace('")', '');
				obj.type = 'picture';
				obj.src = src; 
				obj.title = $(this).find('.ch-info h3').text();
				obj.desc = $(this).find('.ch-info .card_desc').text();
				if($(this).find('.ch-info a').attr('href') !== undefined){
					obj.anchor = {
						name : $(this).find('.ch-info a').text(),
						href :$(this).find('.ch-info a').attr('href')
					};
				}
				images.push(obj);
			}
		});
		console.log(images);
		return images;
	}else{
		console.log('This can only be run on the initialized card_images element');
		return null;
	}
}});


$.fn.extend({resetCardImages:function(){
	if($(this).hasClass('card_images initialized')){
		$(this).find('.ch-item').each(function(){
			$(this).resetCard();
		})
	}else{
		console.log('This can only be run on the initialized card_images element');
		return null;
	}
}});

$.fn.extend({resetCard:function(){
	var $this = $(this).hasClass('ch-item') ? $(this) : $(this).closest('.ch-item'),
		defaulT = {
		src:$(this).closest('.card_images').attr('data-path')+'picture/default-banner.jpg',
		title:'Default Title',
		'desc':'Default Description, click to add image',
		//'anchor':{'name':'Click Here','href':'javascript:;'}
	}, 
	card = oneCard(defaulT, true, 'default');
	$this.parent().empty().append(card);
	$this.css({'background-image': 'url('+defaulT.src+')'});
}});

function oneCard(obj, editable, cls){
	var defalt = obj.title == 'Default Title' ? true : false;
	var card = $('<div>').addClass('ch-item '+cls).css({'background-image': 'url("'+obj.src+'")'}).append($('<div>').addClass('ch-info')
		.append($('<h3>').text(obj.title))
		.append($('<p>')
			.append($('<span>').addClass('card_desc').text(obj.desc))
			.append(function(){
				var a = obj.anchor === undefined ? false : $('<a>').addClass('card_anchor').click(function(e){e.stopPropagation();}).attr({'href':obj.anchor.href}).text(obj.anchor.name);return a;
			})
			.append(function(){
				if(editable && !defalt){
					var ed = $('<span>').addClass('card_editor').click(function(e){e.stopPropagation();});
					$('<img>').attr({src:'icons/clear.svg'}).addClass('material-icons tiny').appendTo(ed).click(function(){$(this).resetCard();});
					$('<img>').attr({src:'icons/edit.svg'}).addClass('material-icons tiny').appendTo(ed).click(function(){$(this).editCard();});
					return ed;
				}else{
					return false;
				}
			})
		));
	if(!defalt){
		card.click(function(){
			preview_card(obj.src);
		});
	}else{
		card.click(function(){
			var dir = $(this).closest('.card_images.initialized').attr('data-path') || 'asset/';
			$(this).attr({'data-edit':2,'data-path':dir});
			$(this).uploadDialog({
				callback:function(a, data){$(a).modify_imageCard(data);}
			});
		});
	}
	return card;
}

function preview_card(img){
	if(!$('#imageCard_preview')[0]){
		$('<div>').attr({id:'imageCard_preview'}).click(function(){
			$('#imageCard_preview > img').animate({
			  width: "toggle"
			},700);
			setTimeout(function(){
				$('#imageCard_preview').removeClass('show').addClass('hide').find('img').attr({src:''});
			},500);
		}).addClass('show').append($('<img>').addClass('hoverable z-depth-1').click(function(e){
			e.stopPropagation();
		})).appendTo('body');
		$('#imageCard_preview > img').animate({width: 'toggle'},10);
	}
	$('#imageCard_preview').removeClass('hide').addClass('show').find('img').attr({src:img});
	setTimeout(function(){
		$('#imageCard_preview > img').animate({
		  	'width': "toggle",
			'max-width':'600px',
			'max-height': '500px'
		},'slow');
	},10);
}

/*-----------------------------------------------------Product DESCRIPTIONS--------------------------------------------------- */
$.fn.extend({init_specifications:function(init){
	var $this = $(this);
	var card_cont = $('<div>').addClass('card_specifications row initialized');
	
	init.directory = !init.directory ? 'asset/' : init.directory;
	init.specs = !init.specs ? [] : init.specs;
	init.processor = !init.processor ? 'admin/upload_v2_0.php' : init.processor;
	init.name = !init.name ? ($this.attr('data-name') == undefined ? 'Product Specifications' : $this.attr('data-name')) : init.name;
	card_cont[0].specArray = init.specs;
	var lists = returnSpecifications(init);	card_cont.append($('<div>').addClass('specification_head').append($('<span>').text(init.name)).append($('<div>').addClass('add_specification hoverable').append($('<img>').attr({src:'icons/add_black.svg'}).addClass('material-icons')).click(function(){
		var spec = $(this).closest('.card_specifications.initialized');
		spec.modify_resource({
			data:{src:init.directory+'picture/default-image.jpg', type:'picture'},
			callback:function(a, file){
				var obj = {};
				obj.src = file.src;
				obj.title = file.title;
				obj.desc = file.desc;
				spec.prop('specArray').push(obj);
				var arraY = spec.prop('specArray');
				spec.reloadSpecifications(arraY);
			}
		});
	})));
	card_cont.attr({'data-path':init.directory,'data-href':init.processor,'data-edit':2});
	card_cont.append($('<div>').addClass('fullWidth left lists').append(lists));
	$this.prepend(card_cont);
	console.log($this.find('.card_specifications.initialized').prop('specArray'));
	$this.find('.collapsible').collapsible({
	  accordion : false
	});
}});

$.fn.extend({reloadSpecifications: function(arr){
	if(!$(this).hasClass('initialized')){
		Materialize.toast('Cant get spections on this element',2000,'red');
		console.log('Run "getSpecifications" only on an initialized card_specifications element');
		return;
	}
	$(this)[0].specArray = arr;
	var temp = {}; temp.specs = arr;
	var ul = returnSpecifications(temp);
	$(this).find('.lists').empty().append(ul);
	$(this).find('.collapsible').collapsible({
	  accordion : false
	});
}});

function returnSpecifications(data){
	var lists = [],
	defaulT = {
		title:'Default Title',
		desc:'No Specification for this item yet',
		default:true
		//'anchor':{'name':'Click Here','href':'javascript:;'}
	};
	var ul = $('<ul>').addClass('collapsible').attr({'data-collapsible':'accordion'});
	if(!data.specs && typeof(data.specs) != 'object' || !data.specs.length){
		lists.push(defaulT);
	}else{
		lists = data.specs;
	}
	for( var i in lists){
		var list = createOnespecification(lists[i], i);
		ul.append(list);
	}
	return ul;
	
	function createOnespecification(data, i){
		var li = $('<li>').addClass(function(){if(data.default){return 'default';}}).attr({'data-num':i});
		var cola_h = $('<div>').addClass('collapsible-header').append(function(){
			if(!data.default){
				return $('<div>').addClass('collapsible-logo').css({'background-image':'url("'+data.src+'")'});
			}else{
				return $('<img>').attr({src:'icons/wallpaper.svg'}).addClass('material-icons small grey-text text-darken-2');
			}
		}).append($('<span>').addClass('collapsible-title').text(data.title)).append(function(){
			if(!data.default){
				return($('<span>').addClass('editors').append($('<img>').addClass('material-icons tiny').click(function(e){
					e.stopPropagation();
					$(this).editSpec();
				}).attr({src:'icons/edit.svg'})).append($('<img>').addClass('material-icons tiny').click(function(e){
					e.stopPropagation();
					$(this).deleteSpec();
				}).attr({src:'icons/clear.svg'})));
			}
		});

		var cola_b = $('<div>').addClass('collapsible-body').html(data.desc);
		
		setTimeout(function(){
			cola_h.find('.collapsible-logo').css({'background-image':'url('+data.src+')'});
		},10);
		li.append(cola_h).append(cola_b);
		return li;
	} 
}



$.fn.extend({editSpec:function(){
	var spec = $(this).closest('.card_specifications.initialized');
	var specNum = parseInt(spec.attr('data-num'));
	var li = $(this).closest('li');
	var num = li.attr('data-num');
	var data = spec.prop('specArray')[num];
	var new_data = {
		src: data.src,
		title: data.title,
		desc: data.desc,
		type: 'picture'
	};
	spec.modify_resource({
		data:new_data,
		callback: function(a, file){
			var edited = {
				src : file.src,	
				title : file.title,	
				desc : file.desc	
			};
			spec.prop('specArray')[num] = edited;
			spec.reloadSpecifications(spec.prop('specArray'));
		}
	});
	
}});

$.fn.extend({deleteSpec:function(){
	var spec = $(this).closest('.card_specifications.initialized');
	var li = $(this).closest('li');
	var num = li.attr('data-num');
	var data = spec.prop('specArray')[num];
	spec.questionBox('Delete ("'+data.title+'")',function(){
		spec.prop('specArray').splice(num,1);
		spec.reloadSpecifications(spec.prop('specArray'));
	});
}});

$.fn.extend({getSpecifications:function(){
	if(!$(this).hasClass('initialized')){
		Materialize.toast('Cant get spections on this element',2000,'red');
		console.log('Run "getSpecifications" only on an initialized card_specifications element');
		return;
	}
	return $(this).prop('specArray');
}});

$.fn.extend({resetSpecifications:function(){
	if(!$(this).hasClass('initialized')){
		Materialize.toast('Cant get spections on this element',2000,'red');
		console.log('Run "getSpecifications" only on an initialized card_specifications element');
		return;
	}
	if($(this).prop('specArray') !== undefined){
		$(this).prop('specArray').splice(0, $(this).prop('specArray').length);
		$(this).reloadSpecifications([]);
	}
}});

