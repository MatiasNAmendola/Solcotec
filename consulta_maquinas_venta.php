<?
include"php/valida.php";
?>
<!DOCTYPE HTML>

<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<link rel="stylesheet" href="css/estructura.css" />
<title>Consulta Máquinas Ventas</title>
</head>

<body>
    <div id="contenido">
<? echo $nav;?>

    <header>
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
<? echo $logo;?>


<a class="ninguno" href="../consulta_producto.php"><div id="boton_gigante"><div id="interrogacion" style="margin-left:0.17em">?</div><div id="texto_botongrande">Consulta<br/>Producto</div></div></a>

  </header>
  
        <h1>Consulta Máquinas Ventas
    	<h2>Aquí podrá ver las máquinas disponibles para la venta .</h2>
        <?
	include "php/conexion.php";
	$resultado=mysql_query("select * from maquina where tipo = 0") or die(mysql_error());// 1 indica reparación, 0 indica nuevas a la venta.
	$numero = mysql_num_rows($resultado);
    echo"<p>(Hay $numero máquinas ingresadas).</p>";
  ?>
<input type="text" name="search" value="" id="id_search" placeholder="Buscar" autofocus class="campo" />
<table id="productos">
<thead>

<tr>
<th>Folio FC</th>
<th>Nº Serie</th>
<th>Nombre Máquina</th>
<th>Estado</th>
<th colspan="1"></th>

</tr>
</thead>
<tbody>
 <?
//Mostramos los registros
while ($datos_maquina=mysql_fetch_array($resultado))
{
// obtener el id que se pasará por POST
$id=$datos_maquina["id_fc"];
// Dar vuelta la fecha.
$fecha_correcta=date("d/m/Y",strtotime($fila["fecha"]));

// Agarrar el estado de la factura.

$estado=$datos_maquina["estado"];

switch($estado){
case 4:
$estado="EN STOCK";
break;

case 5:
$estado="VENDIDA";
break;

case 6:
$estado="NO GARANTÍA";
break;
}

?>
<tr onMouseOver="this.className='pintafila'" onMouseOut="this.className=''">


<td class="center"><? echo "F".$datos_maquina["id_fc"] ?></td>
<td class="center"><? echo $datos_maquina["n_serie"] ?></td>
<td class="center"><? echo $datos_maquina["nombre"] ?></td>
<td class="center"><? echo $estado ?></td>



<td class="center"><form id="boton_modificar" action="ver_fc.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="submit"  value="Ver" class="boton" >
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
		 estado=$(this).find('td').eq(3).html();
		 
		 switch(estado){
			 
			 case "EN STOCK":
			 $(this).find('td').eq(3).css({ background:"green",color:"white", border:"0.1em white solid"});
			 break;
			 
			  case "NO GARANTÍA":
			 $(this).find('td').eq(3).css({ background:"black",color:"white", border:"0.1em white solid"});
			 break;
			 
			 case "VENDIDA":
			 $(this).find('td').eq(3).css({ background:"grey",color:"white", border:"0.1em white solid"});
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