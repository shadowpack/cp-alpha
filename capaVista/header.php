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
		<div class="col2"><div class="allSpace btnmenus"><div class="btnMenu" id="ofertas">Ofertas</div></div></div>
		<div class="col2"><div class="allSpace btnmenus"><div class="btnMenu" id="destacados">Destacados</div></div></div>
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

<!-- RECUPERAR PASSWORD -->
<div class="recoverPassword">
	<div id="recoverDatum">
		<div class="TitleTab">
			<div class="figura">1</div>
			<div class="titleBody">Recuperar Contraseña</div>
			<div class="close" id="closeBtnRecover"></div>
		</div>
		<div class="lineDataUp"></div>
		<div class="lineData">Ingrese el E-Mail asociado a su cuenta.</div>
		<div class="lineData"><input type="text" placeholder="E-mail" class="inputReg" id="recoverEmail"/></div>
		<div class="lineData"><input type="checkbox" id="checkRecover"/><div id="reg-checkRecover">Acepto las condiciones y la política de privacidad</div></div>
		<div class="lineData"><div class="btndiv"><input type="button" id="btnRecover" value="Recuperar"/></div></div>
	</div>
	<div id="postRecoverDatum">
		<div class="TitleTab">
			<div class="figura">2</div>
			<div class="titleBody">Continuar Proceso</div>
			<div class="close" id="closeBtnRecover"></div>
		</div>
		<div class="lineDataUp"></div>
		<div class="lineData">Hemos enviado un E-mail con las instrucciones que debes seguir.</br></br>
		A traves de este proceso tu contraseña sera restablecida y redefinida.</br>
		</br></br> 
		<b>Equipo CuponPerfumes.cl</b></div>
	</div>
</div>
<div class="modalAccount">
	<div class="menuoptionimg"><img src="img/view_text.png" class="imgMenuAco"/></div>
	<div class="menuoption" id="myCupon">Mis Cupones</div>
	<div class="menuoptionimg"><img src="img/exec.png" class="imgMenuAco"/></div>
	<div class="menuoption" id="changePassword">Cambiar Contraseña</div>
	<div class="lastmenuoptionimg"><img src="img/endturn.png" class="imgMenuAco"/></div>
	<div class="lastmenuoption" id="closeSesion">Cerrar Sesion</div>
</div>
<!-- SCRIPTS -->
<script type="text/javascript">
    $(document).ready(function(){
        //EVENTO DE CLICK DEL BOTON INGRESAR
        $("#myCupon").click(function(){
        	location.href="account.php?section=cupon";
        });
        $("#changePassword").click(function(){
        	location.href="account.php?section=password";
        });
        $("#closeSesion").click(function(){
        	 $.ajax({
	                url: 'capaAjax/logoutUser.php',
	                type: 'POST',
	                data: {
	                },
	                success: function(resultado){
	                	location.href="catalog.php"
	                }
	            });
        });
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
        	$(".modalAccount").css({
        		left: $("#account").offset().left-$(this).width()+"px",
        		top: $("#account").offset().top+ $("#account").height()+"px"
        	})
        	$(".modalAccount").show();
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
		
		//RECOVERY PASSWORD
		$("#forgotPassword").click(function(){
			var action = new $.esential();
            action.modalWindows($(".recoverPassword"), $("#closeBtnRecover"));
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
		                	alert(resultado);
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
		$("#ofertas").click(function(){
			location.href="catalog.php?oferta=1"
		});
		$("#createPassword").click(function(){
			location.href="loginreg.php"
		});
		$("#closeBtnRecover").click(function(){
			$(".back").fadeOut();
			$(".recoverPassword").fadeOut();
		});

    });
</script>