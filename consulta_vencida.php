<?
include"php/valida.php";

function limpiar($entrada){
	$entrada=str_replace(".","",$entrada);
	$entrada=str_replace("$","",$entrada);
	return $entrada;
	}
?>
<!DOCTYPE HTML>

<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<link rel="stylesheet" href="css/estructura.css" />
<title>Facturas Vencidas</title>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
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

valor_deuda=puntos($('#deuda').val());
$('#deuda').val('$'+valor_deuda);
    
});



</script>

</head>

<body>
    <div id="contenido">
<? echo $nav;?>

    <header>
            <a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
<? echo $logo;?>

<!--<a class="ninguno" href="factura_venta.php"><div id="boton_gigante"><div id="asterisco">*</div><div id="texto_botongrande">Nueva<br/>Factura</div></div></a>
-->
  </header>
       <?
	   	include "php/conexion.php";

       $id_cliente=$_GET["id"];
		$datos=mysql_query("select nombre_cliente from cliente where id_cliente='$id_cliente';") or die (mysql_error());   
	   	$datos_cliente=mysql_fetch_array($datos);
	   
	   ?>
        <h1><span style="color:#E10000">CLIENTE BLOQUEADO</span> | <? echo $datos_cliente["nombre_cliente"]?></h1>
    	<h2>Presenta las siguientes facturas vencidas:</h2>
   <?
	
	
	
$resultado=mysql_query("select factura_venta.id_fv, factura_venta.total_final, factura_venta.plazo_dias, factura_venta.folio, factura_venta.fecha, cliente.nombre_cliente, vendedor.nombre, factura_venta.estado from cliente, factura_venta, vendedor where factura_venta.id_cliente='$id_cliente' and cliente.id_cliente='$id_cliente' and factura_venta.id_vendedor=vendedor.id_vendedor and factura_venta.estado=3 ; ") or die(mysql_error());
$numero = mysql_num_rows($resultado);
echo"<p>(Tiene $numero facturas vencidas en total).</p>";
  ?>
<input type="text" name="search" value="" id="id_search" placeholder="Buscar" autofocus class="campo" />
<table id="productos">
<thead>

<tr>

<th>Folio</th>
<th>Fecha Emision</th>
<th>Días Plazo</th>
<th>Estado</th>
<th>Total Final</th>
<th colspan="3"></th>

</tr>
</thead>

<tbody>
 <?
//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
	
$total_parcial=limpiar($fila["total_final"]);	
$suma_totales=$suma_totales+$total_parcial;
	
// obtener el id que se pasará por POST
$id=$fila["id_fv"];
// Dar vuelta la fecha.
$fecha_correcta=date("d/m/Y",strtotime($fila["fecha"]));

// Agarrar el estado de la factura.

$estado_factura=$fila["estado"];

$plazo_dias=$fila["plazo_dias"];
if($plazo_dias<=0 && $estado_factura==2){
		$estado_factura=3;
		}

switch($estado_factura){
case 1:
$estado_factura="PAGADA";
break;

case 2:
$estado_factura="PENDIENTE";
break;

case 3:
$estado_factura="VENCIDA";
break;

case 0:
$estado_factura="NULA";
break;
}



?>
<tr>

<td class="center"><? echo "F".$fila["folio"] ?></td>
<td class="center"><? echo $fecha_correcta ?></td>
<td class="center"><? echo $fila["plazo_dias"] ?></td>
<td class="center" style="color:white;"><? echo $estado_factura?></td>
<td class="center" style="color:white; background:#333; font-size:1em;"><? echo $fila["total_final"] ?></td>



<td class="center"><form id="boton_modificar" action="ver.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="submit" onClick=""  value="Ver" class="boton" >
</form>
</td>

<td class="center"><form id="boton_modificar" action="nota_credito.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input name="nota"  class="boton_nota boton"  type="submit" value="Nota Crédito" style="width:8em;" ></form>
</td>

<td class="center"><form id="boton_modificar" action="pago.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input name="nota" class="boton_nota boton" type="submit" value="Pagar" ></form>
</td>

</tr>
<?

}
	mysql_free_result($resultado);
	include "php/cerrar_conexion.php";
?>    
</tbody>
</table>
<form action="php/pago_totaldeuda.php" enctype="application/x-www-form-urlencoded">
<div id="deuda_total"><h1>DEUDA TOTAL :
<input id="deuda" type="text" value="<? echo $suma_totales?>" class="deuda" readonly/>
<input type="hidden" name="id_moroso" value="" />
</h1>



</div>
<input type="submit" style="margin-left:47.3em;" class="boton_guardar" value="Pagar Total"/> 
</form>
</div>
<div id="pie"></div>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.quicksearch.js"></script>
<script type="text/javascript">

$(function () {
$('input#id_search').quicksearch('table tbody tr');
});
</script>

<script type="text/javascript">
$(document).ready(function(){

$("table tr").each(function(i) {
indice=i;
estado=$(this).find('td').eq(3).html();

switch(estado){

case "PAGADA":
$(this).find('td').eq(3).css({ background:"green", border:"0.1em white solid"});
$(this).find('td').eq(7).css({ display:"none"});
break;

case "NULA":
$(this).find('td').eq(3).css({ background:"black", border:"0.1em white solid"});
$(this).find('td').eq(6).css({ display:"none"});
$(this).find('td').eq(7).css({ display:"none"});
break;


case "PENDIENTE":
$(this).find('td').eq(3).css({ background:"#F45E00", border:"0.1em white solid"});
break;

case "VENCIDA":
$(this).find('td').eq(3).css({ background:"red", border:"0.1em white solid"});
break;

}


	

});

}); 

//--------------------------------------------------------
function estaseguro(){
var respuesta=confirm('¿Desea eliminar el registro?');
if(respuesta){
return true;
}

else{
return false;
}
}



</script>

</body>
</html>
