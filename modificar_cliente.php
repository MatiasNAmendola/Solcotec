<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/estructura.css" type="text/css" media="all" title="" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Modificar Cliente</title>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js" ></script>
<script type="text/javascript">



function checkbox_verde(){

if($('#no_pago').val()==0){
$('#checkbox_nopago').html('&#x2713');
$('#checkbox_nopago').css({border:"0.1em red solid" });
$('#no_pago').val(1);
}
else{
$('#checkbox_nopago').html('');
$('#checkbox_nopago').css({border:"0.1em black solid" });
$('#no_pago').val(0);
}

}
$(document).ready(function(){

if($('#no_pago').val()==0){
$('#checkbox_nopago').html('&#x2713');
$('#checkbox_nopago').css({border:"0.1em red solid" });
$('#no_pago').val(1);
}
else{
$('#checkbox_nopago').html('');
$('#checkbox_nopago').css({border:"0.1em black solid" });
$('#no_pago').val(0);
}


	
$('*').keypress(function(e){
// Si la tecla presionada en la tecla enter
if (e.keyCode == 13){
return false;
}
});

$('#rut').Rut({
  on_error: function(){ alert('Rut incorrecto'); },
  format_on: 'keyup',
  
});
});
</script>

</head>

<body>
<div id="contenido">
<? echo $nav;?>
<header>
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>

<? echo $logo;?>

<a class="ninguno" href="../consulta_cliente.php"><div id="boton_gigante"><div id="interrogacion" style="margin-left:0.17em">?</div><div id="texto_botongrande">Consulta<br/>Clientes</div></div></a>
</header>
<h1>Modificación de Clientes</h1>
<h2>Aquí podrá modificar cualquier información referente al cliente seleccionado.</h2>

<div id="formulario">
<form action="php/update_cliente.php" method="post" enctype="application/x-www-form-urlencoded" name="datos" id="clientes">
   <?
	include "php/conexion.php";
	$id_cliente=$_POST['ID'];
	$resultado=mysql_query("select * from cliente where id_cliente='$id_cliente'");
	$fila=mysql_fetch_array($resultado);
	
	$id_vendedor=$fila["id_vendedor"];
	$resultado_2=mysql_query("select nombre from vendedor where id_vendedor='$id_vendedor'; ");
	$fila2=mysql_fetch_array($resultado_2);
	$nombre_vendedor=$fila2["nombre"]
    ?>
    
  <div class="columna">
<p>Nombre Cliente:</p> 
<label for="nombre_cliente"></label>
<textarea name="nombre_cliente" id="nombre_cliente"  tabindex="1"><? echo $fila["nombre_cliente"] ?></textarea>

<div class="ingreso">
<p>Rut:</p> 
<label for="rut"></label>
<input name="rut" type="text" class="campo" id="rut" value="<? echo $fila["rut"] ?>" tabindex="2"  />
</div>

<div class="ingreso">
<p>Teléfono:</p> 
<label for="telefono"></label>
<input name="telefono" type="text" class="campo" id="telefono" value="<? echo $fila["telefono"] ?>" tabindex="3"/>
</div>

<div class="ingreso">
<p>Email:</p> 
<label for="direccion"></label>
<input type="email" id="mail" name="mail" placeholder="usuario@ejemplo.com" class="campo" value="<? echo $fila["mail"] ?>"/>
</div> 



</div>
  
  
  
  <div class="columna">
  <p>Dirección:</p> 
<label for="direccion"></label>
<textarea name="direccion" id="direccion"  tabindex="4"><? echo $fila["direccion"] ?></textarea>

<div class="ingreso">
<p>Giro:</p> 
<label for="giro"></label>
<textarea name="giro" id="giro"  tabindex="5"><? echo $fila["giro"] ?></textarea>
</div>


<div class="ingreso">
<p>Comúna:</p> 
<label for="comuna"></label>
<input name="comuna" type="text" class="campo" id="comuna" value="<? echo $fila["comuna"] ?>" tabindex="6"/>
</div>




</div>



<div class="ingreso">
<p>Comentarios Cliente:</p> 
<label for="comentario_cliente"></label>
<textarea name="comentario_cliente" id="comentario_cliente"  value=""><? echo $fila["comentario_cliente"] ?></textarea>
</div>



<div class="ingreso">
<p>Vendedor Asignado:</p> 
<label for="cod_vendedor"></label>
<?
include "php/conexion.php";
echo '<select name="cod_vendedor">';
$res=mysql_query("select nombre from vendedor where nombre != '$nombre_vendedor'");
echo '<option>'.$nombre_vendedor.'</option>';
while ($fila2=mysql_fetch_array($res)){	
echo '<option>'.$fila2["nombre"].'</option>'; 
}
echo '</select>';
?>
</div>


<? if ($fila["bloqueado"]==1){
	$ticket='0';
	}
	else{
		$ticket='1';
		}
		
 ?>
<div id="checkbox_nopago" style="margin-top:0.4em;" class="float_left" onClick="checkbox_verde()"></div>
<input id="no_pago" type="hidden" name="bloqueado" value="<? echo $ticket?>"/>
<p class="float_left" id="text_nopago" style="margin-top:1.5em;">BLOQUEADO</p>

</div><!--fin div formulario-->

<!--Boton guardar Datos-->  
<input type="hidden" name="ID" value="<? echo "$id_cliente" ?>">
<input type="submit"  class="boton_guardar"   value="Guardar Datos" /> 


</form>
<?
mysql_free_result($resultado);
include"php/cerrar_conexion.php";
?>
</div><!--fin div contenido-->
<div id="pie"></div>
</body>
</html>
