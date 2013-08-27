<?
include "php/valida.php";
date_default_timezone_set("Chile/Continental");

?>
<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/estructura.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Consulta Proveedores</title>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.quicksearch.js"></script>
<script type="text/javascript">

function puntos(numero){
numero=Math.round(numero);
numero=new String(numero);
numero=numero.replace(/\./g,'');
var resultado='';

while(numero.length>3){
resultado='.'+numero.substr(numero.length-3)+resultado;
numero = numero.substring(0,numero.length-3);
}

resultado=numero+resultado;
return resultado;
} 

$(document).ready(function() {

$('.total_vendido').each(function() {
total_vendido = $(this).html();
total_vendido = total_vendido*0.05; 
total_vendido = puntos(total_vendido);
$(this).html('$'+total_vendido);   
$(this).css('color','green');

});


$('.total_reparacion').each(function() {
	
	
total_reparacion = $(this).html();
total_reparacion = total_reparacion*0.03; 
total_reparacion = puntos(total_reparacion);
$(this).html('$'+total_reparacion); 
$(this).css('color','red'); 
});


$("table tr").each(function(i) {
indice=i;
estado=$(this).find('td').eq(2).html();

switch(estado){

case "0":
$(this).find('td').eq(2).css({ background:"grey", border:"0.1em white solid"});
break;

case "1":
$(this).find('td').eq(2).css({ background:"yellow", border:"0.1em white solid"});
break;

}


	

});

 
});


</script>
</head>



<body>
<div id="contenido">
<? echo $nav;?>
    
<header> 
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>

<? echo $logo;

include("php/conexion.php");
$id_vendedor=$_SESSION['id_usuario'];

$mes_enviado=$_POST['mes_enviado'];

if($mes_enviado==''){
	$mes_enviado=date('m');
	}
	
	switch($mes_enviado){
		case '01':
		$mes='Enero';
		break;
		
		case '02':
		$mes='Febrero';
		break;
		
		case '03':
		$mes='Marzo';
		break;
		
		case '04':
		$mes='Abril';
		break;
		
		case '05':
		$mes='Mayo';
		break;
		
		case '06':
		$mes='Junio';
		break;
		
		case '07':
		$mes='Julio';
		break;
		
		case '08':
		$mes='Agosto';
		break;
		
		case '09':
		$mes='Septiembre';
		break;
		
		case '10':
		$mes='Octubre';
		break;
		
		case '11':
		$mes='Noviembre';
		break;
		
		case '12':
		$mes='Diciembre';
		break;
		}




if($_SESSION['tipo_usuario']!=1){
	
	echo '<a class="ninguno" href="../consulta_vendedor.php"><div id="boton_gigante"><div id="interrogacion" style="margin-left:0.17em">?</div><div id="texto_botongrande">Consulta<br/>Vendedor</div></div></a>';
	
	$consulta="SELECT vendedor.nombre, factura_venta.tipo_factura, SUM( REPLACE( REPLACE( factura_venta.total_neto,  '$',  '' ) ,  '.',  '' ) ) as suma
FROM factura_venta, vendedor
WHERE factura_venta.id_vendedor = vendedor.id_vendedor
AND MONTH( factura_venta.fecha ) =  '$mes_enviado'
GROUP BY vendedor.nombre, factura_venta.tipo_factura;";

$listado="SELECT vendedor.nombre, factura_venta.tipo_factura, factura_venta.folio , factura_venta.fecha ,factura_venta.total_final, cliente.nombre_cliente FROM factura_venta, cliente, vendedor WHERE factura_venta.id_vendedor = vendedor.id_vendedor AND factura_venta.id_cliente=cliente.id_cliente AND MONTH( factura_venta.fecha ) =  '$mes_enviado' GROUP BY vendedor.nombre, factura_venta.tipo_factura; ";


	
	$resultado=mysql_query($consulta,$conexion) or die('Error 1 : '.mysql_error());
	$resultado_2=mysql_query($listado,$conexion) or die('Error 2 : '.mysql_error());
	
	}else{
		$consulta="SELECT vendedor.nombre, factura_venta.tipo_factura, SUM( REPLACE( REPLACE( factura_venta.total_neto,  '$',  '' ) ,  '.',  '' ) ) as suma
FROM factura_venta, vendedor
WHERE factura_venta.id_vendedor='$id_vendedor' AND vendedor.id_vendedor='$id_vendedor'
AND MONTH( factura_venta.fecha ) =  '$mes_enviado'
GROUP BY vendedor.nombre, factura_venta.tipo_factura;";
	
	$resultado=mysql_query($consulta,$conexion) or die('Error 3 : '.mysql_error());
		
		
		}
	
	
	
	?>

</header>
<h1>Consulta Comisiones por Vendedor - <span class="mes_destacado"><? echo '( '.$mes.' )'?></span></h1>
<h2>Seleccione el mes a consultar.</h2>


<form action="comisiones.php" enctype="application/x-www-form-urlencoded" method="post">
<select id="select_mes" name="mes_enviado">
<option selected></option>
<option value="01">Enero</option>
<option value="02">Febrero</option>
<option value="03">Marzo</option>
<option value="04">Abril</option>
<option value="05">Mayo</option>
<option value="06">Junio</option>
<option value="07">Julio</option>
<option value="08">Agosto</option>
<option value="09">Septiembre</option>
<option value="10">Octubre</option>
<option value="11">Noviembre</option>
<option value="12">Diciembre</option>
</select>	
	
<input type="submit" value="Consultar"/> 
</form>
<section>
<?

while($fila=mysql_fetch_array($resultado)){

if($nombre==''){
$nombre=$fila['nombre'];
?>
<div class="titulo_vendedor"><? echo $fila['nombre'];?></div>
<?

}// fin if nombre vacio

if($nombre!=$fila['nombre']){
?>

<div class="titulo_vendedor"><? echo $fila['nombre'];?></div>

<?
}// fin if cambio de nombre

if($fila['tipo_factura']==0)
{
?>

<div class="caja">Ventas 5% :</div>
<div class=" caja caja_total total_vendido"><? echo $fila['suma']  ?></div>

<?


}//fin if tipo factura = 0
 else{
?>
<div class="caja">Reparación 3% :</div>
<div class="caja caja_total total_reparacion"><? echo $fila['suma']  ?></div>

<? 

}// fin else

	


$nombre=$fila['nombre'];
?>
<?
 }// fin while
 
?>

</section>
<div class="separador"></div>

</div><!--fin contenido-->

<div id="pie"></div>

</body>
</html>


