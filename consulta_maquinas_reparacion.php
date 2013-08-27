<?
include"php/valida.php";
?>
<!DOCTYPE HTML>

<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<link rel="stylesheet" href="css/estructura.css" />
<title>Consulta Máquinas Reparación</title>
</head>

<body>
    <div id="contenido">
<? echo $nav;?>

    <header>
            <a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
<? echo $logo;?>


<a class="ninguno" href="orden_trabajo.php"><div id="boton_gigante" style="width:9em; margin-left:1em;"><div id="asterisco">*</div><div id="texto_botongrande">Nueva<br/>Orden</div></div></a>
<a class="ninguno" href="../consulta_orden_trabajo.php"><div id="boton_gigante"><div id="interrogacion">?</div><div id="texto_botongrande">Ordenes<br/>Emitidas</div></div></a>
  </header>
  
        <h1>Consulta Estado de Máquinas [ <span style="color: #F40000">REPARACIÓN</span> ]</h1>
    	<h2>Aquí podrá ver el estado de las máquinas a partir del folio de una Orden de Trabajo.</h2>
        <?
	include "php/conexion.php";
	$resultado=mysql_query("select id_ot, n_serie, nombre, estado from maquina where tipo = 1 ORDER BY id_ot DESC") or die(mysql_error());// Cero indica reparación
	$numero = mysql_num_rows($resultado);
    echo"<p>(Hay $numero máquinas ingresadas).</p>";
  ?>
<input type="text" name="search" value="" id="id_search" placeholder="Buscar" autofocus class="campo" />
		<table id="productos">
			<thead>
			
                <tr>
                	<th>OT</th>
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
$id=$datos_maquina["id_ot"];
// Dar vuelta la fecha.
$fecha_correcta=date("d/m/Y",strtotime($fila["fecha"]));

// Agarrar el estado de la factura.

$estado=$datos_maquina["estado"];

switch($estado){
case 1:
$estado="COTIZACIÓN";
break;

case 2:
$estado="ACEPTADA";
break;

case 3:
$estado="REPARADA";
break;

case 5:
$estado="EN GARANTIA";
break;

case 0:
$estado="RECHAZADA";
break;
}





?>
<tr onMouseOver="this.className='pintafila'" onMouseOut="this.className=''">

<td class="center"><? echo "OT".$datos_maquina["id_ot"] ?></td>
<td class="center"><? echo $datos_maquina["n_serie"] ?></td>
<td class=""><? echo $datos_maquina["nombre"] ?></td>
<td class="center"><? echo $estado ?></td>



<td class="center"><form id="boton_modificar" action="ver_orden.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
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
			 case "COTIZACIÓN":
			 $(this).find('td').eq(3).css({ background:"red", color:"white", border:"0.1em white solid"});
			 break;
			 
			 case "ACEPTADA":
			 $(this).find('td').eq(3).css({ background:"purple", color:"white", border:"0.1em white solid"});
			 break;
			 
			 
			  case "REPARADA":
			 $(this).find('td').eq(3).css({ background:"green",color:"white", border:"0.1em white solid"});
			 break;
			 
			  case "RECHAZADA":
			 $(this).find('td').eq(3).css({ background:"black",color:"white", border:"0.1em white solid"});
			 break;
			 
			 case "EN GARANTIA":
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
