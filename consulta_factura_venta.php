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
<? echo $logo;
include "php/conexion.php";
	
	$mes_enviado=$_POST['mes_enviado'];
	
	if($_POST['mes_enviado']==''){
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
?>

<a class="ninguno" href="factura_venta.php"><div id="boton_gigante"><div id="asterisco">*</div><div id="texto_botongrande">Nueva<br/>Factura</div></div></a>

  </header>
  
        <h1 class="float_left">Facturas de Venta Emitidas - <span class="mes_destacado"><? echo '( '.$mes.' )'?></span></h1>
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
    	</div>
        <h2>Aquí podrá buscar cualquier factura emitida a partir de cualquier característica.</h2>
        <?
	
	
	$resultado=mysql_query("select factura_venta.id_fv,factura_venta.total_final,factura_venta.folio, factura_venta.fecha, cliente.nombre_cliente, vendedor.nombre, factura_venta.estado  from factura_venta, cliente, vendedor WHERE cliente.id_cliente=factura_venta.id_cliente AND vendedor.id_vendedor=factura_venta.id_vendedor AND MONTH( factura_venta.fecha )='$mes_enviado' ORDER BY factura_venta.folio DESC  ");
	$numero = mysql_num_rows($resultado);
    echo"<p>(Hay $numero facturas emitidas).</p>";
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
<th>Total</th>
<th colspan="3"></th>

</tr>
</thead>

<tbody>
 <?
//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
	
// obtener el id que se pasará por POST
$id=$fila["id_fv"];
// Dar vuelta la fecha.
$fecha_correcta=date("d/m/Y",strtotime($fila["fecha"]));

// Agarrar el estado de la factura.

$estado_factura=$fila["estado"];
$plazo_dias=$fila["plazo_dias"];
	if($plazo_dias = 0 && $estado_factura==2 && $plazo_dias < 0){
		$estado_factura=3;
		}
switch($estado_factura){
case 1:
$estado="PAGADA";
break;

case 2:
$estado="PENDIENTE";
break;

case 3:
$estado="VENCIDA";
break;

case 0:
$estado="NULA";
break;
}



?>
<tr onMouseOver="this.className='pintafila'" onMouseOut="this.className=''">

<td align="center"><? echo "F".$fila["folio"] ?></td>
<td align="center"><? echo $fecha_correcta ?></td>
<td><? echo $fila["nombre_cliente"] ?></td>
<td align="center"><? echo $fila["nombre"] ?></td>
<td class="estado" style="color:white;" align="center" ><? echo $estado?></td>
<td align="center"><? echo $fila["total_final"] ?></td>




<td class="center"><form id="boton_modificar" action="redireccion-fv.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="submit" value="Imprimir" style="width:6.5em;" ></form>
</td>


<td><form id="boton_modificar" action="#" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<!-- Action = pago.php-->
<input type="hidden" name="id" value="<? echo $id?>">
<input name="nota" class="boton_nota" type="submit" value="Pagar" ></form>
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
