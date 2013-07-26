<link rel="stylesheet" type="text/css" media="all" href="css/product.css"> 
<script type="text/javascript" src="Addons/slider/slider.js"></script>

<?php 
	require_once("capaControlador/product.php"); 
	$producto = new Producto();
	$descripcion = $producto->getDatos();
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=150061965179618";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="product">
	<div class="row productS">
		<div class="col045 first">&nbsp;</div>
		<div class="col111 bordercol">
			<div class="img"> 
				<div class="sliderImg">
					<div class="imagesMov">
					<?php
						$img = $producto->getPhoto();
						foreach($img as $vector){
							echo '<div class="imgSlider"><img src="'.$vector->source.'" class="imgItem"/></div>';
						}
					?>
					</div>
					<div class="btn_prev"><img src="Addons/slider/img/btn_prev.png" /></div>
					<div class="btn_next"><img src="Addons/slider/img/btn_next.png" /></div>
				</div>
			</div>
			<div class="datos">
				<div class="titulo"><?php echo $descripcion['nombre']; ?></div>
				<div class="bajada">
					<?php echo $descripcion['descripcion_small']; ?>
				</div>
				<div class="precio">
					<div class="precioD">Precio : $<?php echo number_format($descripcion['precio_descuento'],0,",","."); ?></div>
					<div class="numeros">
						<div class="descuento">Descuento : 40%</div>
						<div class="precioR">Antes : $<?php echo number_format($descripcion['precio_real'],0,",","."); ?></div>
					</div>
					<div class="stock">
						<div class="stockTitle">Quedan</div>
						<div class="stockNumber">16</div>
					</div>
					<div class="tiempo"> 6h:3m:45s</div>
					<div class="vendidos">Se han vendido: <?php echo $producto->getSell(); ?> CuponPerfumes de este producto.</div>
				</div>
				<div id="compra">Comprar</div>
				<div class="social">
					<div class="Socialbotones">
						<div class="fb-like" data-href="<?php echo "http://".$_SERVER['HTTP_HOST']."".@$_SERVER['REQUEST_URI']; ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo "http://".$_SERVER['HTTP_HOST']."".@$_SERVER['REQUEST_URI']; ?>" data-via="CuponPerfumes" data-lang="es">Twittear</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

					</div>
				</div>
			</div>
			<div class="infoS">
				<div class="info">
					<div class="menus">
						<div class="btn-description">Descripcion del Cupon</div>
						<div class="btn-condiciones">Condiciones</div>
					</div>
					<div class="tab-description"> <?php echo utf8_encode($descripcion['descripcion']); ?></div>
					<div class="tab-condiciones"><?php echo utf8_encode($descripcion['condiciones']); ?></div>
				</div>
			</div>
			<div class="mapa">
				<div class="map">
					<div class="menus">
						<div class="btn-where">Donde Nos Encontramos</div>
					</div>
					<div class="tab-where"><iframe width="460" height="310" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.cl/maps?f=q&amp;source=s_q&amp;hl=es&amp;geocode=&amp;q=Luis+Thayer+Ojeda+183,+Providencia&amp;aq=0&amp;oq=luis+tayer+ojeda&amp;sll=-33.407827,-70.602103&amp;sspn=0.007801,0.016512&amp;g=Luis+Thayer+Ojeda+183,+Providencia&amp;ie=UTF8&amp;hq=&amp;hnear=Luis+Thayer+Ojeda+183,+Providencia,+Santiago,+Regi%C3%B3n+Metropolitana&amp;t=h&amp;ll=-33.412099,-70.602779&amp;spn=0.02221,0.039396&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe></div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
//handler de inicio
$(document).ready(function(){ 
	var slider = new $.slider({
		object: $('.sliderImg'),
		images: $('.imagesMov'),
		img: '.imgSlider',
		prev: $('.btn_prev'),
		next:$('.btn_next')
	})
	var contador = setInterval(function(){
		var tiempo = new Date;
		var dif = (<?php echo $descripcion['tiempoFinal']; ?> - (tiempo.getTime()/1000));
		var horas = Math.floor(dif/3600);
		var minutos = Math.floor((dif%3600)/60);
		var seg = Math.floor((dif%3600)%60);
		$('#relojT').html(horas+'h '+minutos+'m '+seg+'s');
	}, 1000);
	$(".btn-description").click(function(){
		$(".tab-description").fadeIn();
		$(".tab-condiciones").fadeOut();
		$(".btn-condiciones").css({
			color: "#999"
		});
		$(this).css({
			color: "#555"
		});
	});
	$(".btn-condiciones").click(function(){
		$(".tab-description").fadeOut();
		$(".tab-condiciones").fadeIn();
		$(".btn-description").css({
			color: "#999"
		});
		$(this).css({
			color: "#555"
		});
	});
	$("#compra").click(function(){
		$.ajax({
			url:"capaAjax/addCompra.php",
			type: "POST",
			data: {
				id: $(this).attr("nP")
			},
			success: function(resultado){
				if(resultado == "true")
				{
					location.href="checkout.php"
				}
			}
		})
	});
});
</script>