<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<link rel="stylesheet" href="css/estructura.css" />
<title>Consulta Clientes</title>
</head>

<body>
    <div id="contenido">
<? echo $nav;?>

<header>
        <a id="cerrar" href="php/logout.php">Cerrar Sesión</a>

<? echo $logo;

include "php/conexion.php";
$id_vendedor=$_SESSION['id_usuario'];
if($_SESSION['tipo_usuario']!=1){
	
echo '<a class="ninguno" href="ingreso_cliente.php"><div id="boton_gigante"><div id="asterisco">*</div><div id="texto_botongrande">Nuevo<br/>Cliente</div></div></a>';

$resultado=mysql_query("SELECT id_cliente, nombre_cliente, rut, telefono, direccion FROM cliente ORDER BY nombre_cliente;") or die(mysql_error());
$numero = mysql_num_rows($resultado);
	}
	else{
$resultado=mysql_query("SELECT cliente.id_cliente, cliente.nombre_cliente, cliente.rut, cliente.telefono, cliente.direccion, vendedor.nombre FROM cliente, vendedor WHERE cliente.id_vendedor='$id_vendedor' AND vendedor.id_vendedor='$id_vendedor' ORDER BY nombre_cliente;") or die(mysql_error());
$numero = mysql_num_rows($resultado);
$fila=mysql_fetch_array($resultado);
$nombre_vendedor=$fila["nombre"];
	}
?>

</header>
  
<h1>Consulta Clientes</h1>
<h2>Aquí podrá buscar cualquier cliente a partir de cualquier característica.</h2>
<a href="pdf_listaclientes.php?nombre_vendedor=<? echo $nombre_vendedor ?>" target="_blank" style="float:right; font-weight:bold; font-size:1.2em">[ Imprimir Listado. ]</a>
<?

echo"<p>Hay $numero clientes ingresados.</p>";
?>
<input type="text" name="search" value="" id="id_search" placeholder="Buscar" autofocus class="campo" />
<table>
<thead>

<tr>
<th>Nombre</th>
<th>Rut</th>
<th>Teléfono</th>
<th>Dirección</th>
<? if($_SESSION['tipo_usuario']!=1){
$variable1='<th colspan="2"></th>';
echo $variable1;
}
	?>


</tr>
</thead>

<tbody>
<?
if($_SESSION['tipo_usuario']!=1){

//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
$id=$fila["id_cliente"];
?>
<tr>

<td><? echo $fila["nombre_cliente"] ?></td>
<td id="td_rut" class="center"><? echo $fila["rut"] ?></td>
<td class="center"><? echo $fila["telefono"] ?></td>
<td><? echo $fila["direccion"] ?></td>

<td class="center"><form id="boton_modificar" action="modificar_cliente.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="ID" value="<? echo $id?>" />
<input type="submit" value="Cambiar" /></form>
</td>

<td class="center"><form id="boton_modificar" action="php/delete_cliente.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="ID" value="<? echo $id?>">
<input type="submit" onClick="return estaseguro()"  value="Eliminar" ></form>
</td>

</tr>
<?

}

}

else{
	
	while ($fila=mysql_fetch_array($resultado))
{
?>
<tr>

<td><? echo $fila["nombre_cliente"] ?></td>
<td id="td_rut" class="center"><? echo $fila["rut"] ?></td>
<td class="center"><? echo $fila["telefono"] ?></td>
<td><? echo $fila["direccion"] ?></td>

</tr>
<?
}
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
