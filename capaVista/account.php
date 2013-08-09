<?php
	include('capaControlador/accountControler.php');
	$cupones = new account();
?>
<link rel="stylesheet" type="text/css" media="all" href="css/account.css"> 
<div class="row account">
	<div class="col12 accountAll">
		<div class="accountChar">
			
			<div class="headerbtn">
				<div class="btn" id="cupones">Mis Cupones</div>
				<div class="btn" id="data">Cambiar Datos</div>
				<div class="btn" id="changepass">Cambiar Contraseña</div>
			</div>
			<div class="tab-cupones tabsA">
				<div class="botonUp"><img src="img/1downarrow.png" /></div>
				<div class="botonDown"><img src="img/1downarrow1.png" /></div>
				<div class="productAccount" num="<?php echo $cupones->getNumCupones(); ?>" numA="5">
				</div>
			</div>
			<div class="tab-changedata tabsA"></div>
			<div class="tab-changepass tabsA"></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$.fn.pop = function() {
	    var top = this.get(-1);
	    this.splice(this.length-1,1);
	    return top;
	};

	$.fn.shift = function() {
	    var bottom = this.get(0);
	    this.splice(0,1);
	    return bottom;
	};
	$('#cupones').click(function(){
		$(".tabsA").each(function(key,value){
			$(value).hide();
		});
		$(".tab-cupones").show();
	});
	$('#data').click(function(){
		$(".tabsA").each(function(key,value){
			$(value).hide();
		});
		$(".tab-changedata").show();
	});
	$('#changepass').click(function(){
		$(".tabsA").each(function(key,value){
			$(value).hide();
		});
		$(".tab-changepass").show();
	});
	$('.botonUp').click(function(){
			if(parseInt($('.productAccount').attr('numA')) > 5)
			{
				var element = $('.productAccount').find('.lineProduct').shift();
				$(element).detach();
				$(element).appendTo($('.productAccount'));
				$('.productAccount').attr('numA', (parseInt($('.productAccount').attr('numA')) - 1));
			}
	}); 
	$('.botonDown').click(function(){
			if(parseInt($('.productAccount').attr('numA')) < parseInt($('.productAccount').attr('num')))
			{
				var element = $('.productAccount').find('.lineProduct').pop();
				$(element).detach();
				$(element).prependTo($('.productAccount'));
				$('.productAccount').attr('numA',(parseInt($('.productAccount').attr('numA')) + 1));
			}
	});                         
});
</script>