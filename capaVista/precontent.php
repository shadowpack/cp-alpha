<link rel="stylesheet" type="text/css" media="all" href="css/precontent.css">
<script type="text/javascript" src="Addons/slider/slider3.js"></script>
<div class="rowAll precontent">
	<div class="row allHeight">
		<div class="imagesSlider3">
			<div class="col02">&nbsp;</div>
			<div class="col1106 imagesMov">
			<?php
				require_once('model/db_core.php');
				$db = new db_core();
				$consulta[0] = $db->query("SELECT * FROM category as c ORDER BY c.position");
				while($consulta[1] = mysql_fetch_array($consulta[0]))
				{
					echo '<div class="imageItem"><img src="'.$consulta[1][2].'" class="imagelider" position="'.$consulta[1][3].'"/></div>'; //de ser un directorio lo envolvemos entre corchetes
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
	$(".imagelider").click(function(){
		var num = 350+460*($(this).attr('position')-1);
		$(document).scrollTop(num);
	});
});
</script>