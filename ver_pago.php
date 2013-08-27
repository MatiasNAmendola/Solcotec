<?
include"php/valida.php";
date_default_timezone_set("Chile/Continental");
?>
<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->

<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/estructura.css" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Pagos</title>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js" ></script>


</head>

<body>    

<div id="contenido">
<? echo $nav;?>

<header>  
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>   
<? echo $logo;?>

<a class="ninguno" href="../consulta_pago.php"><div id="boton_gigante" style="width:9.3em;"><div id="interrogacion" style="margin-left:0.15em;">?</div><div id="texto_botongrande">Pagos<br/>Recibidos</div></div></a>

</header>

<?
include "php/conexion.php";
$id_factura=$_POST['id'];

$resultado=mysql_query("select * from factura_venta where id_fv='$id_factura';") or die(mysql_error()); //captura todos los datos de factura.
$datos_factura=mysql_fetch_array($resultado);
$id_vendedor=$datos_factura["id_vendedor"];


$consultap="select * from pago where id_factura='$id_factura';";
$resultado0=mysql_query($consultap,$conexion) or die (mysql_error());
$datos_pago=mysql_fetch_array($resultado0);
?> 




<div id="notacredito">
<h1 class="notacredito">PAGO DE FACTURA RECIBIDO</h1>
<h2 class="notacredito">Los comentarios de este pago fueron.</h2>
<textarea style="margin-bottom:0.5em" style="margin-bottom:0em;"  name="comentario_pago" class="supertextarea" readonly><? echo $datos_pago["comentario_pago"]?></textarea>

<?
$forma_pago=$datos_pago["forma_pago"];
switch($forma_pago){
case 1:
$forma_pago="Efectivo";
break;

case 2:
$forma_pago="Cheque";
break;

case 3:
$forma_pago="Vale Vista";
break;

}
?>

<div class="columna">
<div class="ingreso">
<p>Forma de Pago:</p>
<input id="forma_pago" name="condiciones" type="text" class="campo" value="<? echo $forma_pago?>" readonly/>
</div>

<div class="ingreso">
<p>Nº del Documento:</p>
<input id="n_documento" name="n_documento" type="text" class="campo" value="<? echo $datos_pago["n_documento"]?>" readonly/>
</div><!--fin ingreso-->

</div><!--fin columna-->

<div class="columna">

<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.
$fecha_documento=$datos_pago["fecha_documento"];
$fecha_documento = date('d-m-Y', strtotime($fecha_documento));// da vuelta la fecha para ser valida BD 
?>

<div class="ingreso">
<p>Banco del Documento:</p>
<input id="banco_documento" name="banco_documento" type="text" class="campo" value="<? echo $datos_pago["banco_documento"]?>" readonly/>
</div><!--fin ingreso-->

<div class="ingreso">
<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.
$fecha_documento=$datos_pago["fecha_documento"];
$fecha_documento = date('d-m-Y', strtotime($fecha_documento));// da vuelta la fecha para ser valida BD 
?> 
<p>Fecha del Documento:</p>
<input type="text" class="campo" name="fecha_recepcion" id="fecha_ingreso" value="<? echo $fecha_documento?>" readonly/>
</div><!--fin ingreso-->
</div><!--fin columna-->

<div class="ingreso">
<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.
$fecha_recepcion=$datos_pago["fecha_recepcion"];
$fecha_recepcion = date('d-m-Y', strtotime($fecha_recepcion));// da vuelta la fecha para ser valida BD 
?> 
<p>Fecha de Recepción:</p>
<input type="text" class="campo" name="fecha_recepcion" id="fecha_ingreso" value="<? echo $fecha_recepcion?>" readonly/>
</div><!--fin ingreso-->
</div><!--fin nota credito-->
</div><!--fin contenido-->
<div id="pie"></div>
</body>
</html>
