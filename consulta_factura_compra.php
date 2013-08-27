<?
include"php/valida.php";
date_default_timezone_set("Chile/Continental");
?>
<!DOCTYPE HTML>

<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<link rel="stylesheet" href="css/estructura.css" />
<title>Consulta Factura Compra</title>
</head>

<body>
    <div id="contenido">
<? echo $nav;?>

    <header>
            <a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
<? echo $logo;?>


<a class="ninguno" href="factura_compra.php"><div id="boton_gigante"><div id="asterisco">*</div><div id="texto_botongrande">Nueva<br/>Factura</div></div></a>

<a class="ninguno" href="../consulta_pago_compras.php"><div id="boton_gigante" style="width:10.3em; margin-right:1em;"><div id="interrogacion">?</div><div id="texto_botongrande">Pagos<br/>Realizados</div></div></a>
  </header>
  
        <h1 class="float_left">Facturas de Compra Ingresadas</h1>
        <div class="fecha_consulta">
        <select class="select_chico">
        	<option>Enero</option>
            <option>Febrero</option>
            <option>Marzo</option>
            <option>Abril</option>
            <option>Mayo</option>
            <option>Junio</option>
            <option>Julio</option>
            <option>Agosto</option>
            <option>Septiembre</option>
            <option>Octubre</option>
            <option>Noviembre</option>
            <option>Diciembre</option> 
        </select>
        <select class="select_chico">
        	<option>2013</option>
            <option>2014</option>
            <option>2015</option>
         
        </select>
        <input id="consultar" type="button" value="Consultar" class="boton" />
        </div><!--fin fecha consulta-->
    	<h2 style="clear:both">Aquí podrá buscar cualquier factura ingresada a partir de cualquier característica.</h2>
                
        <?
	include "php/conexion.php";
$resultado=mysql_query("SELECT factura_compra.gasto, factura_compra.id_fc	,factura_compra.total_final,factura_compra.estado, factura_compra.folio, factura_compra.fecha, proveedor.nombre, proveedor.rut from factura_compra, proveedor WHERE factura_compra.id_proveedor=proveedor.id_proveedor ORDER BY factura_compra.folio DESC ;") or die(mysql_error());
	$numero = mysql_num_rows($resultado);
    echo"<p>(Hay $numero facturas de compra emitidas).</p>";
  ?>
<input type="text" name="search" id="id_search" placeholder="Buscar" autofocus class="campo" />
<table id="productos">
<thead>

<tr>
<th>Folio</th>
<th>Fecha</th>
<th>Proveedor</th>
<th>Rut</th>
<th>Estado</th>
<th>Total</th>
<th colspan="2"></th>

</tr>
</thead>
<tbody>
 <?
//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
// obtener el id que se pasará por POST
$id=$fila["id_fc"];

$gasto=$fila["gasto"];
// Dar vuelta la fecha.
$fecha_correcta=date("d/m/Y",strtotime($fila["fecha"]));

// Agarrar el estado de la factura.

$estado=$fila["estado"];

switch($estado){
case 1:
$estado="PAGADA";
break;

case 2:
$estado="PENDIENTE";
break;
}


?>
<tr onMouseOver="this.className='pintafila'" onMouseOut="this.className=''">

<td class="center"><? echo "F".$fila["folio"] ?></td>
<td class="center"><? echo $fecha_correcta ?></td>
<td><? echo $fila["nombre"] ?></td>
<td class="center"><? echo $fila["rut"] ?></td>
<td class="center"><? echo $estado ?></td>
<td class="center"><? echo $fila["total_final"] ?></td>


<td class="center"><form id="boton_modificar" action="modificar_fc.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="hidden" name="gasto" value="<? echo $gasto?>">
<input type="submit" value="Cambiar" class="boton" >
</form>
</td>

<td class="center"><form id="boton_modificar" action="ver_fc.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="submit" value="Imprimir" class="boton" >
</form>
</td>



</tr>
<?

}
	mysql_free_result($resultado);
	include "php/cerrar_conexion.php";
?>    
</tbody>
</table>

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
estado=$(this).find('td').eq(4).html();

switch(estado){
case "PAGADA":
$(this).find('td').eq(4).css({ background:"green", border:"0.1em white solid", color:"white"});
break;

case "NULA":
$(this).find('td').eq(4).css({ background:"black", border:"0.1em white solid", color:"white"});
$(this).find('td').eq(6).css({ display:"none"});
$(this).find('td').eq(7).css({ display:"none"});
break;


case "PENDIENTE":
$(this).find('td').eq(4).css({ background:"#F45E00", border:"0.1em white solid", color:"white"});
break;

case "VENCIDA":
$(this).find('td').eq(4).css({ background:"red", border:"0.1em white solid", color:"white"});
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