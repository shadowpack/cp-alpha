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
if(screen.width >= 1470)
{
	$("#screenCss").attr("href", "css/bigCatalog_hd.css");
}
else
{
	$("#screenCss").attr("href", "css/bigCatalog1024.css");
}
$(window).load(function(){
	var catalogo = new $.catalogo();
	catalogo._createCatalog();
	if(getUrlVars()["oferta"]!=1)
	{
		$(".precontent").data("active",true);
		$(".precontent").fadeIn();
	}
	function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	};
});
</script>
<script type="text/javascript" src="capaControlador/screen.js"></script>