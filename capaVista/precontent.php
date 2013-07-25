<link rel="stylesheet" type="text/css" media="all" href="css/precontent.css">
<script type="text/javascript" src="Addons/slider/slider3.js"></script>
<div class="rowAll precontent">
	<div class="row allHeight">
		<div class="imagesSlider3">
			<div class="col02">&nbsp;</div>
			<div class="col1106 imagesMov">
			<?php
				$directorio = opendir("categoryimages"); //ruta actual
				while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
				{
				    if (!is_dir($archivo))//verificamos si es o no un directorio
				    {
				        echo '<div class="imageItem"><img src="categoryimages/'.$archivo.'" class="imagelider" /></div>'; //de ser un directorio lo envolvemos entre corchetes
				    }
				}
			?>
			</div>
			<div class="col02">&nbsp;</div>
			<div class="btn_prev"><img src="Addons/slider/img/btn_prev.png" /></div>
			<div class="btn_next"><img src="Addons/slider/img/btn_next.png" /></div>
		</div>
	</div>
	<div class="subline"></div>
</div>
<script>
//handler de inicio
$(document).ready(function(){ 
	var slider = new $.slider3({
		object: $('.imagesSlider3'),
		images: $('.imagesMov'),
		img: '.imageItem',
		prev: $('.btn_prev'),
		next:$('.btn_next')
	});
});
</script>