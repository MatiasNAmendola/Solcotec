<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/estructura.css" type="text/css" media="all"/>
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Modificar Producto</title>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript">


$(function date() {
$( "#fecha_ingreso" ).datepicker();
});

$('*').keypress(function(e){
	
// Si la tecla presionada en la tecla enter
if (e.keyCode == 13){
return false;
}

});

function puntos(numero){
if(numero=='$' || elemento==''){
numero='';
return numero;
}
		
numero=Math.round(numero);
numero=new String(numero);
numero=numero.replace(/\./g,'');
var resultado='';
 
while(numero.length>3){
resultado='.'+numero.substr(numero.length-3)+resultado;
numero = numero.substring(0,numero.length-3);
}

resultado=numero+resultado;
return resultado;
} 
 
 
//FUNCION QUE EXTRAE LOS PUNTOS Y EL SIGNO PESO DE UN NUMERO  
 
function limpia(elemento){
	if(elemento=='$' || elemento==''){
		elemento='';
		return elemento;
		}
//console.log('hola'+ elemento);
elemento=elemento.replace(/\%/g,'');	
elemento=elemento.replace(/\$/g,'');
elemento=elemento.replace(/\./g,'');
elemento=parseInt(elemento,10);
return elemento;
} 



function cambiar_compra(){
elemento=$('#precio_compra').val();
//console.log(elemento);


elemento=limpia(elemento);
//console.log('con limpia :'+elemento);
elemento=puntos(elemento);
//console.log('con puntos :'+elemento);

$('#precio_compra').val('$'+elemento);
}// fin funcion cambiar


function cambiar_venta(){
elemento=$('#precio_venta').val();
//console.log(elemento);


elemento=limpia(elemento);
//console.log('con limpia :'+elemento);
elemento=puntos(elemento);
//console.log('con puntos :'+elemento);

$('#precio_venta').val('$'+elemento);
}// fin funcion cambiar


//////////////////////////

$(document).ready(function(e) {
	


	
// boton Eliminar producto	
$(document).delegate('.botoneliminar','click',function(){
	
id_compatible=$(this).closest('input').prev().prev().val();
var valores='id_compatible='+id_compatible;

$(this).closest('input').prev().remove();
$(this).closest('input').prev().prev().remove();
$(this).remove();
$.ajax({ 
type:'POST',
url:'php/eliminar_compatible.php',
data:valores,
success:function(response){
	
	}
	});


});//fin funcion delegate.
	
	
	
	
	
$('#proveedor').autocomplete({
source: "autocompletar_proveedor.php",
minLength: 2,
});//fin autocomplete
    
});

//VALIDACIÓN DE CAMPOS
$(document).ready(function () {

var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$("#boton_guardar").click(function (){
$(".error").remove();
if( $("#nombre_producto").val() == "" ){
$("#nombre_producto").focus().after("<span class='error'>Ingrese el nombre del producto.</span>");
return false;
}else if( $("#codigo").val() == ""){
$("#codigo").focus().after("<span class='error'>Ingrese un codigo del producto.</span>");
return false;
}else if( $("#precio_venta").val() == ""){
$("#precio_venta").focus().after("<span class='error'>Ingrese un precio de venta.</span>");
return false;
}
});
$("#nombre_producto, #codigo, #precio_venta").keyup(function(){
if( $(this).val() != "" ){
$(".error").fadeOut();
return false;
}
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
<a class="ninguno" href="../consulta_producto.php"><div id="boton_gigante"><div id="interrogacion" style="margin-left:0.17em">?</div><div id="texto_botongrande">Consulta<br/>Producto</div></div></a>

</header>
<h1>Modificación de Productos</h1>
<h2>Aquí podrá modificar cualquier información referente al producto seleccionado.</h2>

<div id="formulario">
<form  action="php/update_producto.php" method="post" enctype="application/x-www-form-urlencoded" name="datos">
   <?
	include "php/conexion.php";
	$id_producto=$_POST['id'];
	$resultado=mysql_query("select * from producto where id_producto='$id_producto';");
	$fila=mysql_fetch_array($resultado);
	
    ?>
  
<div class="columna">
 
 
<div class="ingreso">
<p>Codigo del Producto:</p> 
<input name="codigo_producto" type="text" class="campo" id="codigo_producto" value="<? echo $fila["codigo_producto"] ?>" />
</div>
 
 <p>Nombre Producto:</p> 
<textarea name="nombre_producto" id="nombre_producto" cols="45" rows="5" ><? echo $fila["nombre"] ?></textarea>

<div class="ingreso">
<p>Marca:</p>
<input type="text" class="campo" name="marca" id="marca" value="<? echo $fila["marca"] ?>" />
</div><!--fin ingreso-->
 


<div class="ingreso">
<p>Cantidad:</p> 
<label for="cantidad"></label>
<input name="cantidad" type="text" class="campo" id="cantidad"  size="10" value="<? echo $fila["stock"] ?>"/>
</div><!--fin ingreso-->




</div><!--fin columna -->

<div class="columna">
<div class="ingreso">
<p>Precio Compra:</p> 
<input name="precio_compra" type="text" class="campo" id="precio_compra" onKeyUp="cambiar_compra()" placeholder="$" value="<? echo $fila["neto"] ?>" />
</div><!--fin ingreso-->

<div class="ingreso">
<p>Precio Venta:</p> 
<input name="precio_venta" type="text" class="campo" id="precio_venta" onKeyUp="cambiar_venta()" placeholder="$" value="<? echo $fila["p_venta"] ?>"/>
</div><!--fin ingreso-->

<p>Nombre(s) Proveedor(es):</p> 
<textarea name="proveedor" placeholder="nombres distintos proveedores con datos de contacto." id="proveedor"><? echo $fila["proveedor"] ?></textarea>

<div class="ingreso">
<p>Posición en Bodega:</p> 
<label for="posicion"></label>
<input name="posicion" type="text" class="campo" id="posicion" value="<? echo $fila["posicion"] ?>" />
</div>
</div>



   	
<div style="overflow:hidden;">

<div class="ingreso">
<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.
$fecha_ingreso=$fila["fecha_ingreso"];
$fecha_ingreso = date('d-m-Y', strtotime($fecha_ingreso));// da vuelta la fecha para ser valida BD 
?>
<p>Fecha de Ingreso:</p>
<input type="text" 	class="campo fecha" name="fecha_ingreso" id="fecha_ingreso" value="<? echo $fecha_ingreso ?>" />
</div>

<div id="zona_compatible">
<?
$compatibles=mysql_query("select nombre, id_compatible from compatible where id_producto='$id_producto';") or die (mysql_error());
//Mostramos los registros
while ($compatible=mysql_fetch_array($compatibles))
{

?>
<p  style="margin-top:0.2em">También compatible con:</p>
<input type="hidden"  name="id_compatible[]" id="id_compatible" value="<? echo $compatible["id_compatible"]?>" />
<input type="text" class="campo" name="compatible[]" id="compatible" value="<? echo $compatible["nombre"]?>" />
<input type="button" value="Eliminar" class="botoneliminar" />
<?
}// fin del while.
?>



</div><!--fin zona_compatible-->



</div><!--fin columna -->

</div><!--fin formulario-->

<!--Boton guardar Datos-->  
<input type="submit"  class="boton_guardar"   value="Guardar Datos" /> 
<input type="hidden" name="id" value="<? echo "$id_producto" ?>">

</form>
<?
mysql_free_result($resultado);
include"php/cerrar_conexion.php";
?>
</div> <!--fin contenido-->
<div id="pie"></div>
</body>
</html>
