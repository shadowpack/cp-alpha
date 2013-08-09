<link rel="stylesheet" type="text/css" media="all" href="css/headers.css"> 
<div class="rowHeader">
	<div class="col5">
		<div class="divAll">&nbsp;
			<img src="img/logo2.png" id="logo"/>
		</div>
	</div>
	<div class="col7">
		<div class="fisrt col12 btns">
			<div class="col108">
				<div class="infoAdicional">
					<div class="col5"><img src="img/casa.png" class="telefono"/>&nbsp;Luis Tayer Ojeda 183, Of 304; Providencia</div>
					<div class="col3"><img src="img/telefono.png" class="telefono"/>&nbsp;(02) 23333 218</div>
					<div class="col4"><img src="img/mail.png" class="telefono"/>&nbsp;&nbsp;contacto@cuponperfumes.cl</div>
				</div>
			</div>
			<div class="col1-2">
				<?php 
                if($_SESSION['id'] != NULL AND $_SESSION['token'] != NULL)
                {
                    echo '<div class="col12"><div class="btnHeader" id="account">Mi Cuenta</div></div>';
                }
                else
                {
                    echo '<div class="col12"><div class="btnHeader" id="join">Accede</div></div>';
                }
            	?>
			</div>
			<div class="col12 first">
				<div class="mailing">
					<div class="mailing-title">¡Recibe nuestras ofertas!</div>
	                <div class="mailing-input"><input type="text" placeholder="Ingresa tu E-Mail" id="mailing-input-text"/><input type="button" id="mailing-input-btn" value="Recibir"/></div>
	                <div class="mailing-check"><input type="checkbox" id="mailing-check-input"/><div id="mailing-check-text">Acepto la política de privacidad</div></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="rowAll menu">
	<div class="row menu">
		<div class="col2"><div class="allSpace"><div class="btnMenu" id="destacados">Destacados</div></div></div>
		<div class="col2">&nbsp;</div>
		<div class="col2">&nbsp;</div>
	</div>
</div>
<div class="rowAll submenu">&nbsp;</div>


<!-- FORMULARIO MODAL DE INGRESO O REGISTRO DE USUARIO -->
<div id="joinModal" class="joinModal">
    <input type="text" id="user" class="input" placeholder="E-Mail"/>
    <input type="password" id="password" class="input" placeholder="Password"/>
    <div id="forgotPassword">¿Has olvidado tu password?</div>
    <div id="createPassword">¿No tienes Cuenta?</div>
    <input type="button" id="login" class="login_btn" value="Ingresar"/>
</div>
<!-- FORMULARIO MODAL DE REGISTRO -->
<div class="regModal">
	<div id="regClose"></div>
	<div id="regBody">
		<div class="RowContainer12fixed">
			<div class="col12"><div class="titleDiv"><img src="img/img-form-reg.png" class="regImgTitle"/><div class="regTitle">Registra una cuenta en CuponPerfumes</div></div></div>
			<div class="first col12"><div class="regEsp">&nbsp;</div></div>
			<div id="regDatum">
				<div class="first col6"><div class="inputdiv"><input type="text" placeholder="Nombre Completo" class="inputReg" id="regName"/></div></div>
				<div class="col6">
					<div class="col1">&nbsp;</div>
					<div class="col11">
					<div class="inputdiv"><input type="text" placeholder="Direccion" class="inputReg" id="regLocation"/></div>
					</div>
				</div>
				<div class="first col6"><div class="inputdiv"><input type="text" placeholder="Comuna" class="inputReg" id="regComuna"/></div></div>
				<div class="col6">
					<div class="col1">&nbsp;</div>
					<div class="col11">
					<div class="inputdiv"><input type="text" placeholder="Ciudad" class="inputReg" id="regCity"/></div>
					</div>
				</div>
				<div class="first col12"><div class="inputdiv">
					<select class="optionReg" id="regGenero"/>
						<option value="0">Genero</option>
						<option value="1">Masculino</option>
						<option value="2">Femenino</option>
					</select>
				</div></div>
				<div class="first col12"><div class="inputdiv"><input type="text" placeholder="E-Mail" class="inputReg" id="regEmail"/></div></div>
				<div class="first col12"><div class="inputdiv"><input type="password" placeholder="Contraseña" class="inputReg" id="regPassword"/></div></div>
				<div class="first col12"><div class="inputdiv"><input type="password" placeholder="Repite tu Contraseña" class="inputReg" id="regRePassword"/></div></div>
				<div class="first col12"><div class="checkDiv"><input type="checkbox" id="checkReg"/><div id="reg-checkReg">Acepto las condiciones y la política de privacidad</div></div></div>
				<div class="first col12"><div class="btndiv"><input type="button" id="btnReg" value="Registrar"/></div></div>
			</div>
			<div id="postDatum">
				<div class="col12">
					<div class="postDatum-text">Felicitaciones, te has registrado con exito en CuponPerfumes.cl</br></br>
						Como ultimo paso te hemos enviado un correo con instrucciones para activar tu cuenta.</br>
						</br> 
						Equipo CuponPerfumes.cl

					</div>
				</div>
				<div class="col12">&nbsp;</div>
				<div class="col12">
					<img src="img/landind_logo.png"/>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- RECUPERAR PASSWORD -->
<div class="recoverPassword">
	<div id="recoverClose"></div>
	<div id="recoverBody">
		<div class="RowContainer12fixed">
			<div class="row">
				<div class="col12"><div class="titleDiv"><img src="img/img-form-reg.png" class="regImgTitle"/><div class="regTitle">Recuperar Contraseña</div></div></div>
				<div class="first col12"><div class="regEsp">&nbsp;</br></div></div>
				<div id="recoverDatum">
					<div class="first col12"><div class="recoverDescript">Ingrese el E-Mail asociado a su cuenta.</div></div>
					<div class="first col12"><div class="regEsp">&nbsp;</div></div>
					<div class="first col12"><div class="inputdiv"><input type="text" placeholder="E-mail" class="inputReg" id="recoverEmail"/></div></div>
					<div class="first col12"><div class="checkDiv"><input type="checkbox" id="checkRecover"/><div id="reg-checkRecover">Acepto las condiciones y la política de privacidad</div></div></div>
					<div class="first col12"><div class="btndiv"><input type="button" id="btnRecover" value="Recuperar"/></div></div>
				</div>
				<div id="postRecoverDatum">
					<div class="col12">
						<div class="postDatum-text">Hemos enviado un E-mail con las instrucciones que debes seguir.</br></br>
							A traves de este proceso tu contraseña sera restablecida y redefinida.</br>
							</br></br> 
							<b>Equipo CuponPerfumes.cl</b>

						</div>
					</div>
					<div class="col12">&nbsp;</div>
					<div class="col12">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- SCRIPTS -->
<script type="text/javascript">
    $(document).ready(function(){
        //EVENTO DE CLICK DEL BOTON INGRESAR
        $("#join").click(function(){
            if($(this).data('active') == true)
            {

            	$(this).css({
            		color: "#999"
            	});
                $("#joinModal").fadeOut();
                $(this).data('active',false);
            }
            else
            {
            	$(this).css({
            		color: "#CCC"
            	});
                $("#joinModal").appendTo('body');
                $("#joinModal").fadeIn();
                $(this).data('active', true);
                $("#joinModal").mouseleave(function(){
		        	$(document).click(function(){
						$("#joinModal").fadeOut();
						$("#join").data('active',false);
						$(document).unbind();
						$("#joinModal").unbind();
					});
		        }).mouseenter(function(){
		        	$(document).unbind();
		        })
            }
        })
        //EVENTO DE CLICK DEL BOTON REGISTRAR
        $("#createPassword").click(function(){
            var action = new $.esential();
            action.modalWindows($(".regModal"), $("#regClose"));
            $("#regDatum").show();
            $("#postDatum").hide();
        });
        //EVENTO DE LOGIN
        $("#login").click(function(){
            if(($("#user").val() != '' && $("#password").val() != '') && ($("#user").val() != 'E-Mail' && $("#password").val() != 'Password'))
            {
	            $.ajax({
	                url: 'capaAjax/loginUser.php',
	                type: 'POST',
	                data: {
	                	user: $("#user").val(),
	                	password: $("#password").val()
	                },
	                success: function(resultado){
	                	var result = JSON.parse(resultado);
	                	if(result.status)
	                	{
	                		location.reload();	
	                	}
	                	else
	                	{
	                		alert('El usuario y la coontraseña no coinciden');
	                	}
	                }
	            });
        	}
        	else
        	{
        		alert('Debe indicar un nombre de usuario y contraseña');
        	}
        });
        //EVENTO LOGOUT
        $("#logout").click(function(){
        	 $.ajax({
                url: 'capaAjax/logoutUser.php',
                type: 'POST',
                data: {
                },
                success: function(resultado){
                	var result = JSON.parse(resultado);
                	if(result.status)
                	{
                		location.reload();	
                	}
                }
            });
        });
        //EVENTO MI CUENTA
        $("#account").click(function(){
        	 location.href="account.php";
        });
        //EVENTO DE REGISTRAR EL CORREO
        $("#mailing-input-btn").click(function(){
        	if($("#mailing-input-text").val() != '' && validarEmail($("#mailing-input-text").val()))
            {
            	if($("#mailing-check-input").attr('checked'))
            	{
            		$.ajax({
		                url: 'capaAjax/mailCa.php',
		                type: 'POST',
		                data: {
		                	email: $("#mailing-input-text").val()
		                },
		                success: function(resultado){
		                	var result = JSON.parse(resultado);
		                	if(result.status)
		                	{
		                		alert('Gracias, Pronto te enviaremos las ultimas novedades a tu E-Mail');
		                	}
		                }
		            });
            	}
            	else
            	{
            		alert('Debes aceptar las condiciones y politica de privacidad');
            	}
            }
            else
            {
            	alert('Debes indicar un E-Mail valido');
            }
            function validarEmail(email) {
			    var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			    if (expr.test(email))
			    {
			        return true;
				}
				else
				{
					return false;
				}
			}
        });
		//BOTON PARA REGISTRAR USUARIO
		$('#btnReg').click(function(){
			if($('#regName').val() != '' && $('#regLocation').val() != '' && $('#regCity').val() != '' && $('#regGenero').val() != '' && $('#regEmail').val() != '' && $('#regPassword').val() != '' && $('#regRePassword').val() != '' && $('#checkReg').attr('checked'))
			{
				if(validarEmail($('#regEmail').val()))
				{
					if($('#regPassword').val() == $('#regRePassword').val())
					{
						$.ajax({
			                url: 'capaAjax/regUser.php',
			                type: 'POST',
			                data: {
			                	name: $('#regName').val(),
			                	comuna: $('#regComuna').val(),
			                	location: $('#regLocation').val(),
			                	city: $('#regCity').val(),
			                	genero: $('#regGenero').val(),
			                	email: $('#regEmail').val(),
			                	password: $("#regPassword").val()
			                },
			                success: function(resultado){
			                	var result = JSON.parse(resultado);
			                	if(result.status == 1)
			                	{
								    $("#regDatum").hide();
						            $("#postDatum").show();
			                	}
			                	else if(result.status == 2)
			                	{

			                	}
			                	else if(result.status == 3)
			                	{

			                	}
			                	else if(result.status == 4)
			                	{

			                	}
			                	else
			                	{

			                	}
			                }
			            });
					}
					else
					{
						alert('Las contraseñas indicadas no coinciden.');
					}
				}
				else
				{
					alert('Debe indicar un E-Mail valido.')
				}
			}
			else
			{
				alert('Debes Completar los datos y aceptar las condiciones y terminos de uso');
			}
			function validarEmail(email) {
			    var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			    if (expr.test(email))
			    {
			        return true;
				}
				else
				{
					return false;
				}
			}
		});
		//RECOVERY PASSWORD
		$("#forgotPassword").click(function(){
			var action = new $.esential();
            action.modalWindows($(".recoverPassword"), $("#recoverClose"));
            $("#recoverDatum").show();
    		$("#postRecoverDatum").hide();
		});
		$("#btnRecover").click(function(){
			if($('#recoverEmail').val() != '' && validarEmail($('#recoverEmail').val()))
			{
				if($("#checkRecover").attr("checked"))
				{
					$.ajax({
		                url: 'capaAjax/recoverPassword.php',
		                type: 'POST',
		                data: {
		                	email: $('#recoverEmail').val()
		                },
		                success: function(resultado){
		                	var result = JSON.parse(resultado);
		                	if(result.status == 1)
		                	{
		                		$("#recoverDatum").hide();
		                		$("#postRecoverDatum").show();
		                	}
		                	else
		                	{
		                		alert('El mail indicado no esta asociado a ninguna cuenta. Proceda crear una nueva cuenta.')
		                	}
		                }
		            });
				}
				else
				{
					alert("Debes aceptar las politicas y condiciones de uso.")
				}
				
			}
			else
			{
				alert('Debe proporcionar un E-Mail Valido');
			}
			function validarEmail(email) {
			    var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			    if (expr.test(email))
			    {
			        return true;
				}
				else
				{
					return false;
				}
			}
		});
		$("#destacados").click(function(){
			if($(".precontent").data("active") == true || typeof $(".precontent").data("active") == "undefined")
			{
				$(".precontent").data("active",false);
				$(".precontent").fadeOut();
			}
			else
			{
				$(".precontent").data("active",true);
				$(".precontent").fadeIn();
			}
			
			
		});
    });
</script>