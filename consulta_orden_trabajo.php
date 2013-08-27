<?
include"php/valida.php";
?>
<!DOCTYPE HTML>

<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<link rel="stylesheet" href="css/estructura.css" />
<title>Consulta Orden Trabajo</title>
</head>

<body>
    <div id="contenido">
<? echo $nav;?>

    <header>
            <a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
<? echo $logo;?>


<a class="ninguno" href="orden_trabajo.php"><div id="boton_gigante" style="width:9em;"><div id="asterisco">*</div><div id="texto_botongrande">Nueva<br/>Orden</div></div></a>
<a class="ninguno" href="consulta_maquinas_reparacion.php"><div id="boton_gigante" style="margin-right:1em; width:10.7em;"><div id="interrogacion">&curren;</div><div id="texto_botongrande">Máquinas<br/>Reparación</div></div></a>
  </header>
  
        <h1>Ordenes de Trabajo Emitidas</h1>
    	<h2>Aquí podrá buscar cualquier orden emitida a partir de cualquier característica.</h2>
        <?
	include "php/conexion.php";
	$resultado=mysql_query("select orden_trabajo.id_ot,orden_trabajo.folio_ot, orden_trabajo.fecha, cliente.nombre_cliente FROM orden_trabajo, cliente WHERE orden_trabajo.id_cliente=cliente.id_cliente ORDER BY orden_trabajo.folio_ot DESC  ") or die(mysql_error());
	$numero = mysql_num_rows($resultado);
    echo"<p>(Hay $numero ordenes emitidas).</p>";
  ?>
<input type="text" name="search" value="" id="id_search" placeholder="Buscar" autofocus class="campo" />
		<table id="productos">
			<thead>
			
                <tr>
                    <th>Folio</th>
					<th>Fecha</th>
					<th>Cliente</th>
                    <th colspan="3"></th>
                    
				</tr>
   			</thead>
            <tbody>
 <?
//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
// obtener el id que se pasará por POST
$id=$fila["id_ot"];
// Dar vuelta la fecha.
$fecha_correcta=date("d/m/Y",strtotime($fila["fecha"]));



?>
<tr onMouseOver="this.className='pintafila'" onMouseOut="this.className=''">

<td align="center"><? echo "OT".$fila["folio_ot"] ?></td>
<td align="center"><? echo $fecha_correcta ?></td>
<td><? echo $fila["nombre_cliente"] ?></td>




<td class="center"><form id="boton_modificar" action="modificar_orden.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="submit" onClick=""  value="Cambiar" class="boton" >
</form>
</td>

<td class="center"><form id="boton_modificar" action="#" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input name="nota"  class="boton_nota boton"  type="submit" value="Informe" style="width:6.5em;" ></form>
</td>


<td class="center"><form id="boton_modificar" action="redireccion-ot.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input name="nota"  class="boton_nota boton"  type="submit" value="Imprimir" style="width:6.5em;" ></form>
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
case "COTIZACION":
$(this).find('td').eq(4).css({ background:"orange", border:"0.1em white solid"});
$(this).find('td').eq(7).css({ display:"none"});
break;

case "ACEPTADA":
$(this).find('td').eq(4).css({ background:"blue", border:"0.1em white solid"});
$(this).find('td').eq(6).css({ display:"none"});
$(this).find('td').eq(7).css({ display:"none"});
break;


case "REPARADA":
$(this).find('td').eq(4).css({ background:"green", border:"0.1em white solid"});
break;

case "RECHAZADA":
$(this).find('td').eq(4).css({ background:"black", border:"0.1em white solid"});
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
