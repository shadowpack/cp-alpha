$.slider = function(opt){
	var settings = {
		object:null,
		images: null,
		img: null,
		prev:null,
		next:null,
		index:0,
		total:0
	};	
	var slider = function(opt){
		settings = $.extend({},settings,opt);
		settings.total = settings.images.find(settings.img).size();
		settings.prev.hide().click(function(){
			if((settings.index-1) < 0)
			{
				$(settings.images.find(settings.img)[settings.index]).fadeOut(500,function(){
					$(settings.images.find(settings.img)[settings.total-1]).fadeIn(500);
					settings.index = settings.total-1;
				});
			}
			else
			{
				$(settings.images.find(settings.img)[settings.index]).fadeOut(500,function(){
					$(settings.images.find(settings.img)[settings.index-1]).fadeIn(500);
					settings.index--;
				});
			}
			
		});
		settings.next.hide().click(function(){
			if((settings.index+1) == settings.total)
			{
				$(settings.images.find(settings.img)[settings.index]).fadeOut(500,function(){
					$(settings.images.find(settings.img)[0]).fadeIn(500);
					settings.index = 0;
				});
			}
			else
			{
				$(settings.images.find(settings.img)[settings.index]).fadeOut(500,function(){
					$(settings.images.find(settings.img)[settings.index+1]).fadeIn(500);
					settings.index++;
				});
			}
		});
		settings.object.mouseenter(function(){
			settings.prev.show();
			settings.next.show();
		}).mouseleave(function(){
			settings.prev.hide();
			settings.next.hide();
		});

	};
	slider(opt);
}