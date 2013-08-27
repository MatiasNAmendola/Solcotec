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
<title>Consulta Pagos</title>
</head>

<body>

    <div id="contenido">
<? echo $nav;?>
    <header>
        <a id="cerrar" href="php/logout.php">Cerrar Sesión</a>

<? echo $logo;?>

<a class="ninguno" href="../consulta_factura_compra.php"><div id="boton_gigante" style="width:10.6em;"><div id="interrogacion">?</div><div id="texto_botongrande">Facturas<br/>Ingresadas</div></div></a>   

  </header>
  
        <h1>Registro de Pagos (Compras)</h1>
    	<h2>Aquí encontrará todos los pagos realizados, relacionados con una factura y proveedor determinado.</h2>

<?
include "php/conexion.php";
$resultado=mysql_query("SELECT factura_compra.folio,factura_compra.id_fc, proveedor.nombre, pago_efectuado.forma_pago, pago_efectuado.banco_documento, pago_efectuado.n_documento, pago_efectuado.fecha_emision FROM proveedor, factura_compra, pago_efectuado	WHERE factura_compra.id_fc = pago_efectuado.id_factura AND proveedor.id_proveedor=factura_compra.id_proveedor ORDER BY folio DESC;") or die (mysql_error());
$numero = mysql_num_rows($resultado);
echo"<p>(Hay $numero pagos realizados).</p>";
?>
<input type="text" name="search" value="" id="id_search" placeholder="Buscar" autofocus class="campo" />
<table id="productos">
<thead>

<tr>
<th>Folio</th>
<th>Proveedor</th>
<th>Pago en:</th>
<th># Doc</th>
<th>Banco</th>
<th>Pagado el:</th>

<th></th>



<!--    <th colspan="3"></th>-->

</tr>
</thead>
<tbody>
 <?
//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
$id=$fila["id_fc"];
switch($fila["forma_pago"]){
	case "1":
	$forma_pago="EFECTIVO";
	break;
	
	case "2":
	$forma_pago="CHEQUE";
	break;
	
	case "3":
	$forma_pago="VALE VISTA";
	break;
	
	case "4":
	$forma_pago="TRASFERENCIA";
	break;
	}

// Dar vuelta la fecha.
$fecha_correcta=date("d/m/Y",strtotime($fila["fecha_emision"]));



?>
<tr onMouseOver="this.className='pintafila'" onMouseOut="this.className=''">

<td align="center"><? echo "F".$fila["folio"] ?></td>
<td style="padding:0.4em"><? echo $fila["nombre"] ?></td>
<td align="center" style="color:#FFFFFF"><? echo $forma_pago ?></td>
<td align="center"><? echo $fila["n_documento"] ?></td>
<td align="center"><? echo $fila["banco_documento"] ?></td>
<td align="center"><? echo $fecha_correcta?></td>




<td align="center"><form id="boton_modificar" action="ver_pago.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="submit" value="VER" class="boton" ></form>
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
		 forma_pago=$(this).find('td').eq(2).html();
		 
		 switch(forma_pago){
			 case "EFECTIVO":
			 $(this).find('td').eq(2).css({ background:"green", border:"0.1em white solid"});
			 break;
			 
			 case "VALE VISTA":
			 $(this).find('td').eq(2).css({ background:"brown", border:"0.1em white solid"});
			 break;
			 
			 case "TRASFERENCIA":
			 $(this).find('td').eq(2).css({ background:"blue", border:"0.1em white solid"});
			 break;
			 
			 
			  case "CHEQUE":
			 $(this).find('td').eq(2).css({ background:"orange", border:"0.1em white solid"});
			 break;
			 }
		 
	
		   
		});
			
        }); 
		
//--------------------------------------------------------
       



        </script>
        
</body>
</html>
