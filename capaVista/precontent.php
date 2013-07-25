<link rel="stylesheet" type="text/css" media="all" href="css/precontent.css">
<script type="text/javascript" src="Addons/slider/slider3.js"></script>
<div class="rowAll precontent">
	<div class="row allHeight">
		<div class="imagesSlider3">
			<div class="col06">&nbsp;</div>
			<div class="col108 imagesMov">
				<div class="imageItem"><img src="images/boss ok.png" class="imagelider" /></div>
				<div class="imageItem"><img src="images/benetton ok.png" class="imagelider" /></div>
				<div class="imageItem"><img src="images/brit spears ok.png" class="imagelider" /></div>
				<div class="imageItem"><img src="images/jusus del pozo ok.png" class="imagelider" /></div>
				<div class="imageItem"><img src="images/kenzo ok.png" class="imagelider" /></div>
				<div class="imageItem"><img src="images/vic secret ok.png" class="imagelider" /></div>
				<div class="imageItem"><img src="images/ck logo 1 ok.png" class="imagelider" /></div>
			</div>
			<div class="col06">&nbsp;</div>
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