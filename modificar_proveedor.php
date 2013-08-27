<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/estructura.css" type="text/css" media="all"/>
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Modificar Proveedor</title>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js"></script>

<script type="text/javascript">

$(document).ready(function(){

$('#rut').Rut({
  on_error: function(){ alert('Rut incorrecto'); },
  format_on: 'keyup',
  
});// fin rut
});// fin ready

</script>
</head>

<body>
<div id="contenido">

<? echo $nav;?>

    <header>
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
<? echo $logo;?>
<a class="ninguno" href="../consulta_proveedor.php"><div id="boton_gigante" style="width:9.5em"><div id="interrogacion" style="margin-left:0.15em;">?</div><div id="texto_botongrande">Consulta<br/>Proveedor</div></div></a>     

</header>

        <h1>Modificar Proveedor</h1>
    	<h2>Aquí podrá modificar cualquier información referente al proveedor seleccionado.</h2>
<div id="formulario">
<form  action="php/update_proveedor.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
   <?
	include "php/conexion.php";
	$id_proveedor=$_POST['id'];
	$resultado=mysql_query("select * from proveedor where id_proveedor='$id_proveedor';");
	$fila=mysql_fetch_array($resultado);
    ?>
 <div class="columna">


<div class="ingreso">
<p>Nombre:</p> 
<label for="nombre"></label>
<textarea name="nombre" type="text" class="campo" id="nombre"><? echo $fila["nombre"]?></textarea>
</div><!--fin ingreso-->

<div class="ingreso">
<p>Rut:</p> 
<label for="rut"></label>
<input name="rut" type="text" class="campo" id="rut" value="<? echo $fila["rut"]?>"  />
</div><!--fin ingreso-->

<div class="ingreso">
<p>Teléfono:</p> 
<label for="telefono"></label>
<input name="telefono" type="tel" class="campo" id="telefono"  size="10" value="<? echo $fila["telefono"]?>"/>
</div><!--fin ingreso-->

<div class="ingreso">
<p>Email:</p> 
<label for="direccion"></label>
<input type="email" id="mail" name="mail" placeholder="usuario@ejemplo.com" class="campo" value="<? echo $fila["mail"]?>"/>
</div> 

</div><!--fin de columna -->

<div class="columna">

<div class="ingreso">
<p>Dirección:</p> 
<label for="direccion"></label>
<textarea name="direccion" type="text" class="campo" id="direccion"><? echo $fila["direccion"]?></textarea>
</div><!--fin ingreso-->

<div class="ingreso">
<p>Giro:</p> 
<label for="giro"></label>
<textarea name="giro" id="giro" cols="45" rows="5" ><? echo $fila["giro"]?></textarea>
</div>


<div class="ingreso">
<p>Comúna:</p> 
<label for="comuna"></label>
<input name="comuna" type="text" class="campo" id="comuna" value="<? echo $fila["comuna"]?>"/>
</div>
    
</div>



<div class="ingreso">
<p>Comentario Proveedor:</p> 
<label for="comentario"></label>
<textarea name="comentario" id="comentario" cols="45" rows="5"><? echo $fila["comentario"]?></textarea>
</div>


<div class="ingreso">
<p>Vendedor Asignado:</p> 
<label for="vendedor_asignado"></label>
<textarea name="vendedor_asignado" id="vendedor_asignado" cols="45" rows="5"><? echo $fila["vendedor_asignado"]?></textarea>
</div>


  
     </div><!--fin formulario-->

     <!--Boton guardar Datos-->  
     <input type="submit"  id="boton_guardar" class="boton_guardar" value="Guardar Datos" /> 
     <input type="hidden" name="id" value="<? echo "$id_proveedor" ?>">



  </form>
    <?
	mysql_free_result($resultado);
	include"php/cerrar_conexion.php";
	?>
</div><!--fin contenido-->
<div id="pie"></div>
</body>
</html>
