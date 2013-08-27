<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<link rel="stylesheet" href="css/estructura.css" />
<title>Consulta Vendedores</title>
</head>

<body>
    <div id="contenido">
<? echo $nav;?>

<header>
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>

<? echo $logo;?>
<a class="ninguno" href="comisiones.php"><div id="boton_gigante" style="width:9.1em;"><div id="peso" style="font-size:2.5em;">$</div><div id="texto_botongrande">Comision<br />Vendedor</div></div></a>
</header>
 
<h1>Vendedores</h1>
<h2>Aquí podrá buscar cualquier vendedor a partir de cualquier característica.</h2>
<?
include "php/conexion.php";
$resultado=mysql_query("select id_vendedor, nombre, rut, telefono, direccion from vendedor") or die(mysql_error());
$numero = mysql_num_rows($resultado);
echo"<p>Hay $numero vendedores ingresados.</p>";
?>
<table>
<thead>

<tr>
<th>Nombre</th>
<th>Rut</th>
<th>Teléfono</th>
<th>Dirección</th>
<th colspan="2"></th>

</tr>
</thead>

<tbody>

<?
//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
$id=$fila["id_vendedor"];
?>
<tr>

<td><? echo $fila["nombre"] ?></td>
<td class="center"><? echo $fila["rut"] ?></td>
<td class="center"><? echo $fila["telefono"] ?></td>
<td><? echo $fila["direccion"] ?></td>

<td class="center"><form id="boton_modificar" action="modificar_cliente.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="ID" value="<? echo $id?>">
<input type="submit" value="Cambiar" class="boton"></form>
</td>

<td class="center"><form id="boton_modificar" action="php/delete_vendedor.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="ID" value="<? echo $id?>">
<input type="submit" onClick="return estaseguro()"  value="Eliminar" class="boton" ></form>
</td>

</tr>
<?
}
	mysql_free_result($resultado);
	include "php/cerrar_conexion.php";
?>
<tr>
<form id="boton_nuevo" action="php/insert_vendedor.php" method="post" enctype="application/x-www-form-urlencoded">
<td><input type="text" name="nombre" class="campo tabla" placeholder="ingrese nombre"/></td>
<td><input id="rut" type="text" name="rut" class="campo tabla" placeholder="ingrese rut"/></td>
<td><input type="text" name="telefono" class="campo tabla" placeholder="ingrese teléfono"/></td>
<td><input type="text" name="direccion" class="campo tabla" placeholder="ingrese dirección"/></td>
<td class="center" colspan="2">
<input type="submit" value="Ingresar" class="boton">
</form>
</td>

</tr>    
</tbody>
</table>

</div>
<div id="pie"></div>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.quicksearch.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js"></script>
<script type="text/javascript">

$(document).ready(function(){
$('#rut').Rut({
  on_error: function(){ alert('Rut incorrecto'); },
  format_on: 'keyup',
  
});
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
