<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/estructura.css" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Visualizacion Documento</title>
</head>

<body>    

<div id="contenido">

<? echo $nav;?>
   
<header>  
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
 <? echo $logo;?>

<a class="ninguno" href="../consulta_factura_venta.php"><div id="boton_gigante"><div id="interrogacion">?</div><div id="texto_botongrande">Facturas<br/>Emitidas</div></div></a>

 </header>

<?
include "php/conexion.php";
$id_factura=$_POST['id'];

$resultado=mysql_query("select * from factura_venta where id_fv='$id_factura';") or die (mysql_error()); //captura todos los datos de factura.
$datos_factura=mysql_fetch_array($resultado);
$id_vendedor=$datos_factura["id_vendedor"];

$estado_factura=$datos_factura["estado"];

switch($estado_factura){

case 0:
include("php/ver_notacredito.php");
break;

default:
include("php/ver_normal.php");
break;
}

?>