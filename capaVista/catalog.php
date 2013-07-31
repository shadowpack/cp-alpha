<link rel="stylesheet" type="text/css" media="all" href="css/catalog_dev.css"> 
<script type="text/javascript" src="capaControlador/catalogController.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="" id="screenCss"/>
<div id="fb-root"></div>
<script></script>
<div class="items">
	<div class="row preitem"><div class="col12"></div></div>
</div>
<script>
//handler de inicio
$(window).load(function(){
	if(screen.width >= 1470)
	{
		var catalogo = new $.catalogo();
		catalogo._createCatalog();
		$("#screenCss").attr("href", "css/bigCatalog_hd.css");

	}
	else
	{
		var catalogo = new $.catalogo();
		catalogo._createCatalog();
		$("#screenCss").attr("href", "css/bigCatalog1024.css");
		$(".rowItem").css({
			height: "380px"
		});
	}
	

});
</script>
<script type="text/javascript" src="capaControlador/screen.js"></script>