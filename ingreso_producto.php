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
<title>Ingreso de Productos</title>
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
if(numero=='$' || numero==''){
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
precio_venta=elemento*1.4;
//console.log('con limpia :'+elemento);
elemento=puntos(elemento);
//console.log('con puntos :'+elemento);

$('#precio_compra').val('$'+elemento);


precio_venta=puntos(precio_venta);
$('#precio_venta').val('$'+precio_venta);
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

$(document).delegate('#agregar_compatible','click',function()
{
var n_compatibles=$('#zona_compatible>input').length;
console.log(n_compatibles);

if(n_compatibles>=0 && n_compatibles<3){
	
$('#zona_compatible').append('<p  style="margin-top:0.2em">También compatible con:</p><input type="text" class="campo" name="compatible[]" id="compatible" autofocus />');
n_compatibles++;
}

if(n_compatibles==3){

$('#agregar_compatible').css('display','none');
}

});// fin delegate 

</script>

</head>
<div id="contenido">
<body>
<? echo $nav;?>

    
    <header>
            <a id="cerrar" href="php/logout.php">Cerrar Sesión</a>
 
 <? echo $logo;?>
<a class="ninguno" href="../consulta_producto.php"><div id="boton_gigante"><div id="interrogacion" style="margin-left:0.15em;">?</div><div id="texto_botongrande">Consulta<br/>Producto</div></div></a>
    
        
</header>

<h1>Ingreso de Nuevos Productos</h1>
<h2>Aqui podrá ingresar toda la información referente a un nuevo producto.</h2>
<div id="formulario">
<form id="datos" method="post" enctype="application/x-www-form-urlencoded" name="datos" action="php/insert_producto.php">
  
<div class="columna">

<div class="ingreso">
<p>Código del Producto:</p> 
<input name="codigo" type="text" class="campo" id="codigo" autofocus/>
</div><!--fin ingreso-->

<p>Nombre Producto:</p> 
<textarea name="nombre_producto" id="nombre_producto" cols="45" rows="5" ></textarea>

<div class="ingreso">
<p>Marca:</p>
<input type="text" class="campo" name="marca" id="marca" />
</div><!--fin ingreso-->


<div class="ingreso">
<p>Cantidad Inicial:</p> 
<label for="cantidad"></label>
<input name="cantidad" type="text" class="campo" id="cantidad"  size="10" value="0"/>
</div><!--fin ingreso-->



</div><!--fin columna-->

<div class="columna">




<div class="ingreso">
<p>Precio Compra:</p> 
<input name="precio_compra" type="text" class="campo" id="precio_compra" onKeyUp="cambiar_compra()" placeholder="$" />
</div><!--fin ingreso-->

<div class="ingreso">
<p>Precio Venta:</p> 
<input name="precio_venta" type="text" class="campo" id="precio_venta" onKeyUp="cambiar_venta()" placeholder="$"/>
</div><!--fin ingreso-->

<p>Nombre(s) Proveedor(es):</p> 
<textarea name="proveedor" id="proveedor" placeholder="nombres distintos proveedores con datos de contacto."></textarea>

<div class="ingreso">
<p>Posición en Bodega:</p> 
<input name="posicion" type="text" class="campo" id="posicion" placeholder="A2"/>
</div><!--fin ingreso-->


</div><!--fin columna-->






<div class="ingreso">
<? $fecha_ingreso=date("d-m-Y"); ?>
<p>Fecha de Ingreso:</p>
<input type="text" class="campo fecha" name="fecha_ingreso" id="fecha_ingreso" value="<? echo $fecha_ingreso ?>" />
</div><!--fin ingreso-->


<p>Compatible con:</p>
<input type="text" class="campo" name="compatible[]" id="compatible" />
<div id="zona_compatible"></div>

<input id="agregar_compatible" type="button" value="Añadir Compatible" />



</div><!--fin div formulario-->


<input type="submit"  class="boton_guardar"   value="Guardar Datos"/> 


</form>


</div><!--fin div contenido-->

<div id="pie"></div>
</body>
</html>
