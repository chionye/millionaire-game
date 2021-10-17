// JavaScript Document 
var show=new Array();
var showObject=new Array();

$(document).ready(function()
{

	$(".noref").click(function(){noref(this);});
				  
});

function noref(x){
	
		var thisObj=$(x);
		$('#pageLabel').html($(this).text());
		if($(x).attr('data-active')==undefined)
		{
			x.pid=$(x).attr('href');
			
			$(x).attr({'href':'javascript:;'})
			$('.progress').removeClass('hide');
			var nId=new Date().getTime();
			var nDiv=$("<div></div>").hide().attr({'id':nId});
			var crr=$(x);
			if(x.pid.indexOf('?')==-1) var url=x.pid+'?ajax=1';
			else var url=x.pid+'&ajax=1';
			$(nDiv).load(url,function(responseTxt, statusTxt, xhr)
				{
					$('.progress').addClass('hide');
					if(statusTxt == "success")
						
						$(crr).attr({'data-active':nId})
						$("#default_div").append(nDiv);
						$(".active-div:first").swapDiv($(nDiv));	
						$(".active-div").removeClass("active-div");
						$(nDiv).addClass("active-div");
					if(statusTxt == "error")Materialize.toast('Page setting error', 4000);
				});
		}else{
			var nd=$(x).attr('data-active');
			$(".active-div:first").swapDiv($('#'+nd));	
			$(".active-div").removeClass("active-div");
			$($('#'+nd)).addClass("active-div");
		}
		if($(x).data('title') && !$(x).hasClass('active')){
			var a = $(x).data('title');
			reload_selects(a);
		}
		$(".noref").removeClass('active');
		$(x).addClass('active');
	
}