<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/estructura.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Consulta Productos</title>
</head>

<body>
<div id="contenido">
<? echo $nav;?>
 
<header> 
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a> 
<? echo $logo;
if($_SESSION['tipo_usuario']!=1){
	
echo '<a class="ninguno" href="ingreso_producto.php"><div id="boton_gigante"><div id="asterisco" style="margin-left:0.14em;">*</div><div id="texto_botongrande">Nuevo<br/>Producto</div></div></a>
';	
}
	?>
<a class="ninguno" href="consulta_maquinas_venta.php"><div id="boton_gigante" style="margin-right:1em; width:10.5em;"><div id="interrogacion">&curren;</div><div id="texto_botongrande">Máquinas<br/>Ingresadas</div></div></a>
</header>

        <h1>Consulta de Productos</h1>
    	<h2>Aquí podrá buscar cualquier producto a partir de cualquier característica.</h2>
        <a href="pdf_listaprecios.php" target="_blank" style="float:right; font-weight:bold; font-size:1.2em">[ Imprimir Listado. ]</a>



 
 <?
 
include "php/conexion.php";

if($_SESSION['tipo_usuario']!=1){
	
	$resultado=mysql_query("select id_producto, codigo_producto, nombre, stock, neto, p_venta  from producto;") or die (mysql_error());
$numero = mysql_num_rows($resultado);
echo"<p>Hay $numero tipos de productos ingresados en bodega.</p>";
	
	
	$variable1='<th>P.Costo</th>';
	$variable2='<th colspan="2"></th>';
	}else{
		$variable1='<th>Posicion</th>';
		$resultado=mysql_query("select codigo_producto, nombre, stock, p_venta, posicion  from producto;") or die (mysql_error());
$numero = mysql_num_rows($resultado);
echo"<p>Hay $numero tipos de productos ingresados en bodega.</p>";
		}
	
 ?>
<input type="text" name="search" id="id_search" placeholder="Buscar" autofocus class="campo" />

<form method="post" name="consulta_producto" style="float:right" action="consulta_producto0.php" enctype="application/x-www-form-urlencoded">

<input type="submit" id="boton_stocks" class="boton" value="Consultar Stocks">

</form>
	
<table>
<thead>
<tr>
<th>Código</th>
<th>Nombre</th>
<th>Stock</th>
<? echo $variable1; ?>
<th>P.Venta</th>
<? echo $variable2; ?>

</tr>
</thead>

<tbody>       
<tr>

    <?

if($_SESSION['tipo_usuario']!=1){
	
	//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
$id = $fila["id_producto"];?>
<td class="td_consulta_codigo center"><? echo $fila["codigo_producto"] ?></td>
<td class="td_consulta_nombre"><? echo $fila["nombre"] ?></td>
<td class="center"><? echo '<div style="display:none">S</div>'.$fila["stock"] ?></td>
<td class="td_consulta_codigo"><? echo $fila["neto"] ?></td>
<td class="td_consulta_codigo"><? echo $fila["p_venta"] ?></td>

<td class="center">
<form name="modificar" action="modificar_producto.php" method="post" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="id" value="<? echo $id;?>"><input id="boton_modificar" type="submit" value="Cambiar">
</form>
</td>

<td class="center">
<form  name="borrar" action="php/delete_producto.php" method="post" enctype="application/x-www-form-urlencoded" >
<input type="hidden" name="id" value="<? echo $id;?>"/>
<input type="submit" id="boton_borrar" onClick="return estaseguro()" value="Eliminar"/>
</form>
</td>

</tr>

<?

}//fin while
}// fin if

else{
	//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
	?>
   <tr>
<td class="td_consulta_codigo center"><? echo $fila["codigo_producto"] ?></td>
<td class="td_consulta_nombre"><? echo $fila["nombre"] ?></td>
<td class="center"><? echo '<div style="display:none">S</div>'.$fila["stock"] ?></td>
<td class="center"><? echo $fila["posicion"] ?></td>
<td class="center"><? echo $fila["p_venta"] ?></td>
</tr>
	<?
}// fin while
	}//fin if
	mysql_free_result($resultado);
	include "php/cerrar_conexion.php";
?>  

</tbody>
</table>
   </div><!--fin contenido-->
   </div><!--fin margen-->
   <div id="pie"></div>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.quicksearch.js"></script>
<script type="text/javascript">
$(function () {


$('input#id_search').quicksearch('table tbody tr');

});


</script>
        
        <script type="text/javascript">
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
