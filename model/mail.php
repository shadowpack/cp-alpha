<?php
$para      = 'shadowpack@gmail.com';
$asunto    = 'el asunto';
$mensaje   = 'hola';
$cabeceras = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $asunto, $mensaje, $cabeceras);
?> 