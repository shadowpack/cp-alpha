<link rel="stylesheet" type="text/css" media="all" href="css/catalog_dev.css"> 
<script type="text/javascript" src="capaControlador/catalogController.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/bigCatalog.css" />
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=150061965179618";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="items">
	<div class="row preitem"><div class="col12"></div></div>
</div>
<script>
//handler de inicio
$(window).load(function(){
	
	var catalogo = new $.catalogo();
	catalogo._createCatalog();

});
</script>
<script type="text/javascript" src="capaControlador/screen.js"></script>