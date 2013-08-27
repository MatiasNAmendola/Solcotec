<?
include"php/valida.php";
?>
<!DOCTYPE HTML>

<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<link rel="stylesheet" href="css/estructura.css" />
<title>Consulta Factura Venta</title>
</head>

<body>
    <div id="contenido">
<? echo $nav;?>

    <header>
            <a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
<? echo $logo;?>


<a class="ninguno" href="guia_despacho.php"><div id="boton_gigante"><div id="asterisco">*</div><div id="texto_botongrande">Nueva<br/>Guía</div></div></a>

  </header>
  
        <h1>Guías de Despacho Emitidas</h1>
    	<h2>Aquí podrá buscar cualquier guía emitida a partir de cualquier característica.</h2>
        <?
	include "php/conexion.php";
	$resultado=mysql_query("select cliente.nombre_cliente, guia_despacho.fecha, guia_despacho.folio , guia_despacho.estado_guia, vendedor.nombre from guia_despacho, vendedor, cliente WHERE guia_despacho.id_cliente=cliente.id_cliente AND vendedor.id_vendedor=guia_despacho.id_vendedor ORDER BY guia_despacho.folio DESC; ") or die(mysql_error());
	$numero = mysql_num_rows($resultado);
    echo"<p>(Hay $numero guías emitidas).</p>";
  ?>
<input type="text" name="search" value="" id="id_search" placeholder="Buscar" autofocus class="campo" />
<table id="productos">
<thead>

<tr>
<th>Folio</th>
<th>Fecha</th>
<th>Cliente</th>
<th>Vendedor</th>
<th>Estado</th>
<th colspan="3"></th>

</tr>
</thead>

<tbody>
 <?
//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
	
// obtener el id que se pasará por POST
$id=$fila["id_guia"];
// Dar vuelta la fecha.
$fecha_correcta=date("d/m/Y",strtotime($fila["fecha"]));

// Agarrar el estado de la factura.

$estado_factura=$fila["estado"];

switch($estado_factura){
case 0:
$estado="VALIDA";
break;

case 1:
$estado="NULA";
break;

}

?>
<tr onMouseOver="this.className='pintafila'" onMouseOut="this.className=''">

<td align="center"><? echo "F".$fila["folio"] ?></td>
<td align="center"><? echo $fecha_correcta ?></td>
<td><? echo $fila["nombre_cliente"] ?></td>
<td><? echo $fila["nombre"] ?></td>
<td class="estado" style="color:white;" align="center" ><? echo $estado?></td>

<td class="center"><form id="boton_modificar" action="#" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="submit" onClick=""  value="Ver" class="boton" >
</form>
</td>

<td class="center"><form id="boton_modificar" action="#" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input name="anular"  class="boton"  type="submit" value="Anular"></form>
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


</body>
</html>

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

case "VALIDA":
$(this).find('td').eq(4).css({ background:"green", border:"0.1em white solid"});
$(this).find('td').eq(7).css({ display:"none"});
break;

case "NULA":
$(this).find('td').eq(4).css({ background:"black", border:"0.1em white solid"});
$(this).find('td').eq(6).css({ display:"none"});
$(this).find('td').eq(7).css({ display:"none"});
break;


case "PENDIENTE":
$(this).find('td').eq(4).css({ background:"#F45E00", border:"0.1em white solid"});
break;

case "VENCIDA":
$(this).find('td').eq(4).css({ background:"red", border:"0.1em white solid"});
break;

}	
});
}); 

</script>
