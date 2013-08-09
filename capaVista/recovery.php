<link rel="stylesheet" type="text/css" media="all" href="css/recovery.css">
<div class="row recovery">
	<div class="col12 recoveryAll">
		<div class="recoveryChar">
			<div class="tab-changepass tabsA">
				<div class="lineDataUp"></div>
				<div class="lineData">Recupera tu contraseña</div>
				<div class="lineData"><input class="inputText" id="newpass" placeholder="Nueva Contraseña"/></div>
				<div class="lineData"><input class="inputText" id="repeatnewpass" placeholder="Repite Nueva Contraseña"/></div>
				<div class="lineMessage"></div>
				<div class="lineProduct"><div class="butonChange">Cambiar Contraseña</div></div>
				
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('.butonChange').click(function(){
		if($("#newpass").val() != "" && $("#repeatnewpass").val() != "")
		{
			$.ajax({
				url: "capaAjax/changePassword.php",
				type: "POST",
				data:{
					token: getUrlVars()["recovertoken"],
					recovery: "true",
					password: $("#newpass").val()
				}
				success: function(resultado){
					if(resultado == "true")
					{
						$(".lineMessage").html("La contraseña fue cambiada con Exito.").show();
					}
					else if(resultado == "ErrorPassword")
					{
						$(".lineMessage").html("El token especificado no es valido, pida un nuevo cambio de contraseña").show();
					}
				}
			});
		}
		else
		{
			$(".lineMessage").html("Debe completar todos los campos antes de continuar.").show();
		}
	});
	function getUrlVars() {
		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			vars[key] = value;
		});
		return vars;
	}
});
</script>