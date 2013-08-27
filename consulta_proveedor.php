<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/estructura.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />

<title>Consulta Proveedores</title>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.quicksearch.js"></script>

<script type="text/javascript">
	$(function () {
	$('#id_search').quicksearch('table tbody tr');
					}
						);
						
											
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
</head>

<body>
<div id="contenido">
<? echo $nav;?>
    
 <header> 
      <a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
 
<? echo $logo;
if($_SESSION['tipo_usuario']!=1){
	echo'<a class="ninguno" href="ingreso_proveedor.php"><div id="boton_gigante" style="width:9.6em;"><div id="asterisco" style="margin-left:0.12em;">*</div><div id="texto_botongrande">Nuevo<br/>Proveedor</div></div></a>';
	
	$variable1='<th colspan="2"></th>';
	}
?>

    
      </header>
      <h1>Consulta Proveedores</h1>
    	<h2>Aquí podrá buscar cualquier proveedor a partir de cualquier característica.</h2>
        <a href="pdf_listaproveedores.php" target="_blank" style="float:right; font-weight:bold; font-size:1.2em">[ Imprimir Listado. ]</a>

 
 <?
	include "php/conexion.php";
	$resultado=mysql_query("select * from proveedor");
	$numero = mysql_num_rows($resultado);
    echo"<p>Hay $numero proveedores ingresados en el sistema.</p>";
 ?>
<input type="text" name="search" value="" id="id_search" placeholder="Buscar" autofocus class="campo" /> 
		
<table>
   <thead>
          <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
           	<? echo $variable1;?>
           </tr>
	</thead>
<tbody>       
 <?
 if($_SESSION['tipo_usuario']!=1){
 
//Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
	$id = $fila["id_proveedor"];
	?>
<tr>   

<td><? echo $fila["nombre"] ?></td>
<td><? echo $fila["mail"] ?></td>
<td class="center"><? echo $fila["telefono"] ?></td>
<td class="center"><? echo $fila["direccion"] ?></td>
<td class="center">
<form  action="modificar_proveedor.php" method="post" enctype="application/x-www-form-urlencoded" name="form_modificar">
<input type="hidden" name="id" value="<? echo $id ?>">
<input id="boton_modificar" type="submit" value="Cambiar" ></form>
</td>



<td class="center"><form id="boton_modificar" action="php/delete_proveedor.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
<input type="hidden" name="id" value="<? echo $id?>">
<input type="submit" onClick="return estaseguro()"  value="Eliminar" ></form>
</td>

</tr>

<?
}
 }
 
 else{
	 
	 //Mostramos los registros
while ($fila=mysql_fetch_array($resultado))
{
?>
<tr onClick="chekear(this)" onMouseOver="this.className='pintafila'" onMouseOut="this.className=''">   

<td><? echo $fila["nombre"] ?></td>
<td><? echo $fila["mail"] ?></td>
<td class="center"><? echo $fila["telefono"] ?></td>
<td class="center"><? echo $fila["direccion"] ?></td>
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

</body>
</html>
