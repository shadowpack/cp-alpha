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
			<div class="col6 img"> 
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
			<div class="col6 datos">
				<div class="pretitulo"></div>
				<div class="titulo"><?php echo $descripcion['nombre']; ?></div>
				<div class="bajada">
					<div class="col1">&nbsp;</div> 
					<div class="col10"><?php echo $descripcion['descripcion_small']; ?></div>
					<div class="col1">&nbsp;</div> 
				</div>
				<div class="precio">
					<div class="col1">&nbsp;</div> 
					<div class="col5">
						<div class="precioD">Precio: $<?php echo $descripcion['precio_descuento']; ?></div>
						<div class="precioR">Antes: $<?php echo $descripcion['precio_real']; ?></div>
					</div>
					<div class="col5">
						<div class="col2">&nbsp;</div>
						<div class="col10">
							<div class="tiempo">
								<div id="reloj"><img src="img/clock2.png" height="18" width="18"/></div>
								<div id="relojT"></div>
								<div id="compra" nP="<?php echo $descripcion['id_item']; ?>">Compra</div>
							</div>
						</div>						
					</div>
					<div class="col1">&nbsp;</div> 
					
				</div>
				<div class="foot">
					<div class="footP">
						<div class="col1 first">&nbsp;</div> 
						<div class="col10">
							<div class="sell">Se han vendido: <?php echo $producto->getSell(); ?> CuponPerfumes de este producto.</div>
						</div>
						<div class="col1">&nbsp;</div> 
					</div>
					<div class="social">
						<div class="col1 first">&nbsp;</div> 
						<div class="col10">
							<div class="Socialbotones">
								<div class="fb-like" data-href="<?php echo "http://".$_SERVER['HTTP_HOST']."".@$_SERVER['REQUEST_URI']; ?>" data-send="true" data-layout="button_count" data-width="450" data-show-faces="true"></div>
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo "http://".$_SERVER['HTTP_HOST']."".@$_SERVER['REQUEST_URI']; ?>" data-via="CuponPerfumes" data-lang="es">Twittear</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

							</div>

						</div>
						<div class="col1">&nbsp;</div> 
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">&nbsp;</div>
<div class="info">
	<div class="row infoS">
		<div class="col045 first">&nbsp;</div>
		<div class="col111 menu">
			<div class="col12 topmenu"></div>
			<div class="col045 first">&nbsp;</div>
			<div class="col111">
				<div class="col4"><div class="btnMenu">Descripcion y Condiciones</div></div>
				<div class="col2"><div class="btnMenu">Donde Estamos</div></div>
				<div class="col2"></div>
				<div class="col2"></div>
				<div class="col2"></div>
			</div>
			<div class="col045">&nbsp;</div>
			<div class="col12 submenu"></div>
		</div>
		<div class="col045 first">&nbsp;</div>
		<div class="col111 borderDes">			
			<div class="col6 colAll">
				<div class="infoso">
					<div class="col1">&nbsp;</div>
					<div class="col10"><div class="Description">
						<div class="titleCol">¿En que consiste este CuponPerfumes?</div>
						<div class="bodyInfo"><?php echo $descripcion['descripcion']; ?></div>
					</div></div>
					<div class="col1">&nbsp;</div>
				</div>
			</div>
			<div class="col6 colAll">
				<div class="col1">&nbsp;</div>
				<div class="col10"><div class="Reglas">
					<div class="titleCol">¿Cuales son las Condiciones?</div>
					<div class="bodyInfo"><?php echo $descripcion['reglas']; ?></div>
				</div></div>
				<div class="col1">&nbsp;</div>
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