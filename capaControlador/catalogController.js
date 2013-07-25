//JAVASCRIPT DOCUMENT
//catalogController
//CLASE DE ITEM
$.item = function(settings){
	var atributos = {
		id:null,
		nombre:null, 
		tiempo: new Date().getTime()/1000, 
		descripcion:null, 
		precio_r:0, 
		precio:0,
		precio_d:0,
		descuento:0, 
		cantidad:0, 
		cantidad_o:0, 
		clasificacion:null,
		img: null,
		first: false
	};
	//DECLARACION DEL CONSTRUCTOR
	function _construct(settings)
	{
		atributos = $.extend({},atributos,settings);
		atributos.precio_d = atributos.precio_r - atributos.precio;
		atributos.descuento = Math.ceil((atributos.precio_d/atributos.precio_r)*100);
	}
	//CODE GOES HERE
	//FUNCION PARA RETORNAR EL OBJETO
	this._createView = function ()
	{
		//DIVS PRINCIPALES
		var bigcatalog = $('<div></div>').addClass("bigCatalog");
		var container = $('<div></div>').addClass("container").appendTo(bigcatalog);
		var header = $('<div></div>').addClass("header").appendTo(container);
		var image = $('<div></div>').addClass("image").appendTo(container).html('<img src="'+atributos.img+'" class="img"/>');
		var footer = $('<div></div>').addClass("footerCatag").appendTo(container);
		//FIN DIVS PRINCIPALES
		// SUBCAPAS
		var title = $('<div></div>').addClass("title").appendTo(header).html(atributos.nombre);
		var social = $('<div></div>').addClass("social").appendTo(header).html('<div class="fb-like" data-href="http://developers.facebook.com/docs/reference/plugins/like" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>');
		var footerLeft = $('<div></div>').addClass("footerLeft").appendTo(footer);
			var microTitle = $('<div></div>').addClass("microTitle").appendTo(footerLeft).html(atributos.descripcion_small);
			var logo = $('<div></div>').addClass("logo").appendTo(footerLeft);
		var footerRight = $('<div></div>').addClass("footerRight").appendTo(footer);
			var info = $('<div></div>').addClass("info").appendTo(footerRight);
				var text = $('<div></div>').addClass("text").appendTo(info);
					var descuento = $('<div></div>').addClass("descuento").appendTo(text).html(atributos.descuento +"%");
					var hora = $('<div></div>').addClass("hora").appendTo(text).html(getHora(atributos.tiempo));
					var precio = $('<div></div>').addClass("precioReal").appendTo(text).html("$"+atributos.precio);
				var precioDescuento = $('<div></div>').addClass("precioDescuento").appendTo(info).html("$"+atributos.precio_d);
				var boton = $('<div></div>').addClass("boton").appendTo(info).html('Ver Mas').click(function(){
					location.href="product.php?id="+atributos.id;
				});
		return bigcatalog;
	}
	function getHora(time){
		var actual = new Date().getTime()/1000;
		var tiempo = time - actual;
		var hora = Math.floor(tiempo/3600);
		var minutos = Math.floor((tiempo%3600)/60);
		var segundos = Math.floor((tiempo%3600)%60);
		return hora+":"+minutos+":"+segundos;
	}
	var num_format = function(num){
		var cadena = ""; var aux;  
		var cont = 1,m,k;  
		if(num<0) aux=1; else aux=0;  
		num=num.toString();  
		for(m=num.length-1; m>=0; m--){  
		 cadena = num.charAt(m) + cadena;  
		 if(cont%3 == 0 && m >aux)  cadena = "." + cadena; else cadena = cadena;  
		 if(cont== 3) cont = 1; else cont++;  
		}  
		cadena = cadena.replace(/.,/,",");  
		return cadena;
	}
	//CODE FINISH HERE
	_construct(settings);
};
//CLASE CATALOGO
$.catalogo = function(settings){
	var atributos = {
		items: [],
		div: $('.items') 
	}
	//DECLARACION DEL CONSTRUCTOR
	function _construct(settings){
		atributos = $.extend({},atributos,settings);
	}
	//CODE GOES HERE
	this._createCatalog = function(){
		$.ajax({
			url:'model/getCatalog.php',
			success: function(resultado){
				var result = JSON.parse(resultado);
				var count = 0;
				var target;
				var target2;
				$.each(result,function(key,value){
					if(count == 0)
					{
						target2 = $('<div class="row rowItem"></div>').appendTo(atributos.div);
						target3 =  $('<div class="col12"></div>').appendTo(target2);
						target = $('<center></center>').appendTo(target3);
						var obj = $.extend({},value,{first:true});
						var objeto = new $.item(obj);
						objeto._createView().appendTo(target);
						count++;
					}
					else if(count == 1)
					{
						var objeto = new $.item(value);
						objeto._createView().appendTo(target);
						count++;
					}
					else if(count == 2)
					{
						var objeto = new $.item(value);
						objeto._createView().appendTo(target);
						target2 = '';
						target = '';
						count = 0;
					}
				});
			}
		})
	}
	//CODE FINISH HERE
	_construct(settings);
};
