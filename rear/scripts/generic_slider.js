// Generic Slider by clinton onuigbo 15/07/2018
/*
	This document requires Jquery, materialize and uploadDialog.js
	TO INITIALIZE THE SLIDERS
	* run $(document).initSlider(images, editable) on any element to want the sliders to be initiated on
	* images = 	 array of image objects in this format below
				*[0 => {'src':'','title':'','short_desc':''}]
				*It can also accept an empty array to create a default image
	*editable = boolean (true or false) to create editors
	
	TO RE-APPEND IMAGES on an existing slider
	* run $(document).reloadSlider(images) on the ul.slides within the generic slider element  
	
	TO SAVE THE SLIDERS BACK TO OBJECT ARRAY
	* run $('.slides').readSlider() on the ul.slides within the generic slider element
*/

$.fn.extend({
	initSlider:function(images, editable){
	if(typeof($.uploadDialog) != 'function'){
		console.log("uploadDialog.js is required for this to work");
		return;
	}
	
	var $this = $(this);
	var slides = returnSlides(images, editable);
	var container = $this;
	container.prepend($('<div>').addClass('col s12 generic-slider').attr({'data-cr':editable})
		.append(function(){
			if(editable === true){
				return(
					$('<a>').addClass('addSlide').attr({'data-href':'upload.php','data-path':'../asset/','data-edit':'2'}).click(function(){
					var active = $(this).closest('.generic-slider').find('.slides > li.active');
					$(this).uploadDialog({
						callback:function(a,image,type){insertSlide(active, image, type);}
					});
					}).append($('<i>').addClass('material-icons small').text('wallpaper')));
			}else{return null;}
		})
		.append($('<div>').addClass('slider')
		.append(slides)));
	container.find('.slider').slider();
	var indicators = container.find('.indicators');
	if(indicators[0] !== undefined && indicators.find('li').length < 2){
		indicators.remove();
	}
}});

function returnSlides(data, editable){
	var edit = editable ? editable : false;
	var  images= [], slides = $('<ul>').addClass('slides'),
		classes = ['','right-align','center-align','left-align'];
	if(!data || typeof(data) != 'object' || !data.length){
		images.push({'src':'../asset/picture/default-banner.jpg','title':'Default Slogan','short_desc':'Short Description','default':true,'type':'picture'});
		edit = false;
	}else{
		images = data;
	}
	for(var i in images){
		var place = classes[1 + Math.floor(Math.random() * 3)];
		images[i].type = images[i].type.toLowerCase();
		if(images[i].type != "picture" && images[i].type != 'video')continue;
		var def = images[i].default ? ' default' : '';
		var slide = $('<li>').addClass('lim'+def).attr({'data-type':images[i].type}).append(function(){
			if(images[i].type == 'picture'){
					return($('<img>').attr({'src':images[i].src}))
				}else if(images[i].type == 'video'){
					return($('<video>').attr({'width':'100%','height':'100%','play':true}).append($('<source>').attr({'src':images[i].src})))
				}
			}
		).append($('<div>').addClass('caption '+place).append($('<h3>').text(images[i].title)).append($('<h5>').addClass('light grey-text text-lighten-3').text(images[i].short_desc)));
		slide.append(function(){
			if(edit === true){
				return(
					$('<span>').addClass('slidEditors').append($('<i>').addClass('material-icons tiny').click(function(){editSlide(this);}).text('edit')).append($('<i>').addClass('material-icons tiny').text('clear').click(function(){insertSlide($(this),false);}))
				)
			}else{
				return null;
			}
		})
		slides.append(slide);
	}
	return slides;
}						

function insertSlide($this,image,type){
	var slider = $this.closest('ul');
	if(image === false){
		if($($this).prop('nodeName').toLowerCase() == 'ul'){
			$($this).empty();
		}else{
			$($this).closest('li').remove();
		}
	}else{
		type = type.toLowerCase();
		if(type != "picture" && type != 'video')return;
		$this.after($('<li>').attr({'data-type':type}).addClass('hide lim').append(function(){
			if(type == 'picture'){
					return($('<img>').attr({'style':'background-image: url("'+image.src+'");'}))
			}else if(type == 'video'){
				return($('<video>').attr({'width':'100%','height':'100%'}).append($('<source>').attr({'src':image.src})))
			}
		}).append($('<div>').addClass('caption center-align').append($('<h3>').text(image.name)).append($('<h5>').addClass('light grey-text text-lighten-3').text(image.desc))));
	}
	
	var data = slider.readSlider();
	slider.parent().reloadSlider(data, true);
}

$.fn.extend({reloadSlider:function(data, editable){
	var slides = returnSlides(data, editable);
	$(this).empty().append(slides).slider();
	var indicators = $(this).find('.indicators');
	if(indicators[0] != undefined && indicators.find('li').length < 2){
		indicators.remove();
	}
}});

$.fn.extend({readSlider:function(){
	var data = [], img;
	var dom = $(this);
	dom.find('li.lim:not(.default)').each(function(){
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
		obj.short_desc = $(this).find('.caption h5').text();
		
		data.push(obj);
	});
	return data;
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
	var a = img, b = img, t = type, ch = img.split('/'),c = ch[ch.length-parseInt(1)], e = 0;
	var title = $this.find('.caption h3').text();
	var desc = $this.find('.caption h5').text();
	var thsImg = $this.find('img');
	callResModal(a,b,c,t,e,title,desc);
	thsImg.attr({'data-hide':'true','data-href':'upload.php','data-path':'../asset/','data-edit':'2'});
	uploadModal(thsImg,function(a, image, newtype){
		$this.attr({'data-type':newtype});
		$this.find('.caption h3').text(image.name);
		$this.find('.caption h5').text(image.desc);
		if(newtype == 'picture' && type == 'picture'){
			$this.find('img').attr({'style':'background-image: url("'+image.src+'");'})
		}else if(newtype == 'video' && type == 'picture'){
			$this.find('img').remove();
			$this.prepend($('<video>').attr({'width':'100%', 'height':'100%'}).append($('<source>').attr({'src':image.src})));
		}else if(newtype == 'video' && type == 'video'){
			$this.find('source').attr({'src':image.src});
		}else if(newtype == 'picture' && type == 'video'){
			$this.find('video').remove();
			$this.prepend($('<img>').attr({'style':'background-image: url("'+image.src+'");','src':'data:image/gif;base64,R0lGODlhAQABAIABAP///wAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=='}));
		}
	});
	
	
	
}