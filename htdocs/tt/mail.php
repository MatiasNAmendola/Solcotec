<?php
// Guardar los datos recibidos en variables:
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$mail = $_POST['mail'];
$comentario = $_POST['comentario'];
// Definir el correo de destino:
$dest = "ventas@solcotec.net"; 
 
// Estas son cabeceras que se usan para evitar que el correo llegue a SPAM:
$headers = "From: $nombre $mail\r\n";
$headers .= "X-Mailer: PHP5\n";
$headers .= 'MIME-Version: 1.0' . "\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Aqui definimos el asunto y armamos el cuerpo del mensaje
$asunto = "Solicitud Visita en Terreno";
$cuerpo = "<strong>Nombre de la Empresa:</strong> ".$nombre."<br>";
$cuerpo = "<strong>Dirección de la Empresa:</strong> ".$direccion."<br>";
$cuerpo .= "<strong>Teléfono:</strong> ".$telefono."<br>";
$cuerpo .= "<strong>Email:</strong> ".$mail."<br>";
$cuerpo .= "<strong>Comentario:</strong> ".$comentario;
 
// Esta es una pequena validación, que solo envie el correo si todas las variables tiene algo de contenido:
if($nombre != '' && $direccion != '' && $telefono != '' && $mail != ''  && $comentario != ''){
    mail($dest,$asunto,$cuerpo,$headers); //ENVIAR!
}
?>