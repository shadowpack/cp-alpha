$.esential = function(){
	this.modalWindows= function(cap,cierre){
		var capa = $('<div></div>').appendTo($('body')).addClass('back').click(function(){
			$(this).remove();
			cap.hide();
		});
		cierre.click(function(){
			capa.remove();
			cap.hide();
		});
		cap.appendTo($('body')).show();
	};
}