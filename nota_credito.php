<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/estructura.css" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Nota de Crédito</title>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js" ></script>
<script type="text/javascript">
$(function date() {
    $( "#fecha_documento" ).datepicker();
	$( "#fecha_ingreso" ).datepicker();
  });


$(document).ready(function(e) {
    if($('#no_pago').val()==1){
$('#checkbox_nopago').html('&#x2713');
$('#checkbox_nopago').css({border:"0.1em red solid" });
}
else{
$('#checkbox_nopago').html('');
$('#checkbox_nopago').css({border:"0.1em black solid" });
}

if($('#no_pago').val()==1){
$('#dias_plazo').removeAttr('disabled');
$('#text_nopago2').removeClass('desabilitar');
$('#dias_plazo').removeClass('desabilitar');
$('#dias_plazo').css({border:"#000 solid 0.19em"});
$('.des').addClass('desabilitar');
$('.des').attr('disabled','disabled');
}

else{
$('#dias_plazo').attr('disabled','disabled');
$('#text_nopago2').addClass('desabilitar');
$('#dias_plazo').addClass('desabilitar');
$('#dias_plazo').css({border:"#ccc solid 0.19em"});
$('.des').removeClass('desabilitar');
$('.des').removeAttr('disabled');//
}
});


$('*').keypress(function(e){

// Si la tecla presionada en la tecla enter
if (e.keyCode == 13){
return false;
}

});


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


function habilitar(){
if($('#no_pago').val()==1){
$('#dias_plazo').removeAttr('disabled');
$('#text_nopago2').removeClass('desabilitar');
$('#dias_plazo').removeClass('desabilitar');
$('#dias_plazo').css({border:"#000 solid 0.19em"});
$('.des').addClass('desabilitar');
$('.des').attr('disabled','disabled');
$('#dias_plazo').focus();
}

else{
$('#dias_plazo').attr('disabled','disabled');
$('#text_nopago2').addClass('desabilitar');
$('#dias_plazo').addClass('desabilitar');
$('#dias_plazo').css({border:"#ccc solid 0.19em"});
$('.des').removeClass('desabilitar');
$('.des').removeAttr('disabled');//
}
} 

function cambia_focus(){
$('#doc').focus();
}

//VALIDACIÓN DE CAMPOS
$(document).ready(function () {

bloqueado=$('#bloqueado').val()
if(bloqueado==1){

}

var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$("#boton_guardar").click(function (){
$(".error").remove();
if( $("#nombre_cliente").val() == "" ){
$("#nombre_cliente").focus().after("<span class='error'>Ingrese el nombre del cliente.</span>");
return false;
}else if( $("#mail").val() == "" || !emailreg.test($("#mail").val()) ){
$("#mail").focus().after("<span class='error'>Ingrese un email correcto</span>");
return false;
}else if( $("#rut").val() == ""){
$("#rut").focus().after("<span class='error'>Ingrese un rut.</span>");
return false;
}else if( $("#telefono").val() == "" ){
$("#telefono").focus().after("<span class='error'>Ingrese un teléfono de contacto.</span>");
return false;
}else if( $("#direccion").val() == "" ){
$("#direccion").focus().after("<span class='error'>Ingrese una dirección.</span>");
return false;
}else if( $("#doc").val() == "" ){
$("#doc").focus().after("<span class='error'>Ingrese el folio.</span>");
return false;
}else if( $("#giro").val() == "" ){
$("#giro").focus().after("<span class='error'>Falto ingresar el giro del cliente.</span>");
return false;
}else if( $("#comuna").val() == "" ){
$("#comuna").focus().after("<span class='error'>Ingrese la comuna.</span>");
return false;
}
});
$("#nombre_cliente, #rut, #telefono, #direccion, #doc, #giro, #comuna").keyup(function(){
if( $(this).val() != "" ){
$(".error").fadeOut();
return false;
}
});
$("#mail").keyup(function(){
if( $(this).val() != "" && emailreg.test($(this).val())){
$(".error").fadeOut();
return false;
}
});
});


//VALIDACION DE RUT

$(document).ready(function(){
$('#rut').Rut({
on_error: function(){ alert('Rut incorrecto'); },
format_on: 'keyup',

});
});

</script>

<script type="text/javascript">

//FUNCION AGREGAR A UN NUMERO PUNTOS PARA LOS MILES  

function puntos(numero){
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

elemento=elemento.replace(/\%/g,'');	
elemento=elemento.replace(/\$/g,'');
elemento=elemento.replace(/\./g,'');
elemento=parseInt(elemento,10);
return elemento;
} 

//FUNCION DESCUENTO APLICADO

function a(numero,descuento){  // funcion de descuento
var resto;
resto=(numero*descuento)/100;
resultado=numero-resto;
return resultado;
}
// AUTOCOMPLETE CLIENTE

$(document).ready(function(){

$('#nombre_cliente').autocomplete({
source: "autocompletar.php",
minLength: 2,
select: function(event, ui) {
$('#comuna').val(ui.item.comuna);
$('#rut').val(ui.item.rut);
$('#direccion').val(ui.item.direccion);
$('#telefono').val(ui.item.telefono);
$('#giro').val(ui.item.giro);
$('#cod_vendedor').val(ui.item.cod_vendedor);
$('#comentario_cliente').val(ui.item.comentario_cliente);
$('#mail').val(ui.item.email);
$('#bloqueado').val(ui.item.bloqueado);
$('#tipo_documento').focus();
}//fin autocomplete
});//fin each


// AUTOCOMPLETE DE PRODUCTOS
$(document).delegate('table tbody tr','focus',function(){

$(this).each(function(i) {
var element=$(this);	

$(this).find('textarea').autocomplete ({
source: "autocompletar_producto.php",
minLength: 2,
select: function(event, ui) {   
$(element).next().next().find('input').eq(2).val(ui.item.nombre);
$(element).next().next().find('input').eq(4).val(ui.item.codigo_producto);
$(element).next().next().find('input').eq(0).focus();

}

});//fin function
});//fin autocomplete

});//fin delegate

});//fin ready


// CALCULO DE PRODUCTO FINAL. EN NOTA DE CREDITO HAY UN INPUT + OJO CON LAS POSICIONES !!

function subtotal_fila(){

$('table tbody tr').not('.fila_descripcion').each(function() {

var element=$(this);

cantidad=$(element).find('input').eq(0).val();
//console.log('CANTIDAD: '+cantidad);
precio=$(element).find('input').eq(4).val();
//console.log('PRECIO: '+precio);
descuento=$(element).find('input').eq(5).val();
//console.log('DESCUENTO: '+descuento);


//------------------------------------------

if(cantidad!='' && precio!=''){
precio=limpia(precio);
//console.log(precio);
final=precio*cantidad;
//console.log(final);
descuento=limpia(descuento);
//console.log(descuento);
nuevo_final=a(final,descuento);
//console.log(nuevo_final);
nuevo_final=puntos(nuevo_final);
//console.log(nuevo_final);
$(element).find('input').eq(6).val('$'+nuevo_final);
}//fin if


});//fin funcion each

}//fin funcion subtotal_fila


/// CALCULO DE TOTAL NETO
function calculo_neto(){
var suma=0;
$('table tbody tr').not('.fila_descripcion').each(function() {

var element=$(this);
//console.error(element);
valor=$(element).find('input').eq(6).val();
//console.log(valor);

if(valor!=''){
valor=limpia(valor);
suma=suma+valor;
}//fin if



}); //fin each


//------------------------------------------------------------------------

// CODIGO QUE FUNCIONA SIN ENTRAR A UNA FUNCION.


//imprime el total neto
suma=puntos(suma);
$('#total_neto').val('$'+suma);


//obtiene el valor total neto escrito
total_neto=$('#total_neto').val();

//limpia el valor total neto
total_neto=limpia(total_neto);

//obtiene el valor porcentaje descuento factura
desc_factura=$('#porcentaje_descuento').val();

// si existe valores de descuento 
if(desc_factura!=0){

//limpia valor porcentaje de de descuento
desc_factura=limpia(desc_factura);

//sub_total sera igual a valor que devuelva la funcion de porciento

sub_total=a(total_neto,desc_factura);
sub_total=puntos(sub_total);

$('#total_descuento').val('$'+sub_total);
}//fin del if

descuento_aplicado=$('#total_descuento').val();
descuento_aplicado=limpia(descuento_aplicado);
iva=descuento_aplicado*0.19;
iva2=descuento_aplicado*0.19;// valor de iva numeral usado para calculos matematicos

if(iva%1>=0.5){
resto=iva%1;
iva=iva-resto;
iva=iva+1;
iva=puntos(iva);
}
else{
resto=iva%1;
iva=iva-resto;
iva=puntos(iva);
}
$('#total_iva').val('$'+iva);

valor_final=descuento_aplicado+iva2;
valor_final=puntos(valor_final);
$('#total_final').val('$'+valor_final);


}//fin funcion calculo total neto.

function d(){
descuento_aplicado=$('#total_descuento').val();
descuento_aplicado=limpia(descuento_aplicado);
iva=$('#total_iva').val();
iva=limpia(iva);
valor_final=descuento_aplicado+iva;
valor_final=puntos(valor_final);
$('#total_final').val('$'+valor_final);	
}



function c(){

descuento_aplicado=$('#total_descuento').val();
descuento_aplicado=limpia(descuento_aplicado);
iva=descuento_aplicado*0.19;
if(iva%1>=0.5){
resto=iva%1;
iva=iva-resto;
iva=iva+1;
}
else{
resto=iva%1;
iva=iva-resto;
}
iva=puntos(iva);
$('#total_iva').val('$'+iva);
}



function b(){
//obtiene el valor total neto escrito
total_neto=$('#total_neto').val();

//limpia el valor total neto
total_neto=limpia(total_neto);

//obtiene el valor porcentaje descuento factura
desc_factura=$('#porcentaje_descuento').val();

// si existe valores de descuento 
if(desc_factura!=0){

//limpia valor porcentaje de de descuento
desc_factura=limpia(desc_factura);

//sub_total sera igual a valor que devuelva la funcion de porciento

sub_total=a(total_neto,desc_factura);
sub_total=puntos(sub_total);

$('#total_descuento').val('$'+sub_total);
}//fin del if
}


// boton Eliminar producto	
$(document).delegate('.deleteButton','click',function(){

precio_eliminado=limpia($(this).closest("tr").next().next().find('#sub_total').val());
temp_final=limpia($('#total_neto').val());

rafa=temp_final-precio_eliminado;
rafa2=puntos(rafa);

$('#total_neto').val('$'+rafa2);
var tete=$(this).closest('tr');
$(this).closest('tr').next().next().remove();
$(this).closest('tr').next().remove();
$(this).closest('tr').remove();
subtotal_fila();
calculo_neto();
$('#agregar_fila').css("display","block");

});//fin funcion delegate.



$(document).delegate('#agregar_fila','click',function()
{
var largo_tabla=$('#tabla_productos >tbody >tr').length;
if(largo_tabla<30){


$('#tabla_productos > tbody:last').append('<tr class="tr_sinfondo fila_descripcion ultima"><td class="td_maquina td_detalle">Detalle</td><td colspan="5"><textarea id="detalle" name="detalle[]" type="text" class="tabla descripcion_maquina" placeholder="busca aquí..." autofocus></textarea></td><td class="center td_botoneliminar" style="width:7%;"><input type="button" class="deleteButton boton" value="Eliminar" /></td></tr><tr class="tr_sinfondo fila_descripcion"><td class="td_maquina">Cant.</td><td class="td_maquina">Código</td><td class="td_maquina">Nº Serie</td><td class="td_maquina">V.Unitario</td><td class="td_maquina">Desc.</td><td class="td_maquina">Final</td></tr><tr class="tr_sinfondo"> <td class="tabla" id="td_cantidad"><input id="cantidad" name="cantidad[]" type="number" class="tabla campo cantidad" onChange="subtotal_fila(),calculo_neto()"/></td><input type="hidden" name="cantidad_v[]" value="0"/><td class="tabla"><input id="codigo" name="codigo[]" type="text" class="tabla campo codigo"/></td><td class="tabla"><input name="n_serie[]" class=" tabla campo" /></td><td class="tabla"><input id="precio_unitario" name="precio_unitario[]"    type="text"   class="tabla campo precio_unitario" onChange="subtotal_fila(),calculo_neto()"/></td><td class="tabla"><input id="descuento" name="descuento[]" type="text" class="tabla campo" onChange="subtotal_fila(),calculo_neto()" value="0%"/></td> <td class="tabla"><input id="sub_total" name="precio_final[]"  type="text" class="tabla campo final" /></td></tr>');}

if(largo_tabla==30){
$('#agregar_fila').css("display","none");
}// fin if

});// fin delegate 

</script>
</head>

<body>    

<div id="contenido">
<? echo $nav;?>

<header>  
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>   

<? echo $logo;?>

<a class="ninguno" href="../consulta_factura_venta.php"><div id="boton_gigante"><div id="interrogacion">?</div><div id="texto_botongrande">Facturas<br/>Emitidas</div></div></a>

</header>

 <?
	include "php/conexion.php";
	$id_factura=$_POST['id'];
	
	$resultado=mysql_query("select * from factura_venta where id_fv='$id_factura';") or die(mysql_error()); //captura todos los datos de factura.
	$datos_factura=mysql_fetch_array($resultado);
	$id_vendedor=$datos_factura["id_vendedor"];
	?>

<form action="php/insert_notacredito.php" method="post">
 
<div id="notacredito">
<h1 class="notacredito">NOTA DE CRÉDITO</h1>
<h2 class="notacredito">Señale a continuación las modificaciones a realizar a la factura seleccionada.</h2>
<textarea style="margin-bottom:0em;"  name="comentario_notacredito" class="supertextarea" autofocus></textarea>
</div><!--fin notacredito-->

<h1>Factura de Venta Emitida [ <strong style="color:#CC0000">FOLIO Nº <? echo $datos_factura["folio"] ?></strong> ]</h1>
<h2>A continuación se muestra el detalle de la factura emitida.</h2>

<div id="formulario">
<?
$resultado2=mysql_query("select nombre from vendedor where id_vendedor='$id_vendedor'; ") or die (mysql_error()); //
$fila2=mysql_fetch_array($resultado2);
$nombre_vendedor=$fila2["nombre"];
mysql_free_result($resultado2);

$id_cliente=$datos_factura["id_cliente"];
$resultado3=mysql_query("select * from cliente where id_cliente='$id_cliente'; ") or die (mysql_error());
$fila3=mysql_fetch_array($resultado3);



$resultado4=mysql_query("select producto.codigo_producto,factura_x_producto.detalle, factura_x_producto.cantidad, factura_x_producto.precio_venta, factura_x_producto.precio_final, factura_x_producto.descuento, factura_x_producto.id_producto, factura_x_producto.detalle, factura_x_producto.id_fv, factura_x_producto.n_serie  from factura_x_producto , producto where factura_x_producto.id_fv='$id_factura' AND producto.id_producto=factura_x_producto.id_producto;") or die (mysql_error());

$resultado5=mysql_query("SELECT * FROM pago WHERE id_factura='$id_factura';") or die (mysql_error());
$datos_pago=mysql_fetch_array($resultado5);
?>
    
<div class="columna">

<div class="ingreso">
<p>Nombre Cliente:</p> 
<label for="nombre_cliente"></label>
<textarea name="nombre_cliente" id="nombre_cliente" cols="45" rows="5"/><? echo $fila3["nombre_cliente"] ?></textarea>
</div>

<div class="ingreso">
<p>Rut:</p> 
<label for="rut"></label>
<input name="rut" type="text" class="campo" id="rut" value="<? echo $fila3["rut"] ?>" />
</div>

<div class="ingreso">
<p>Teléfono:</p> 
<label for="telefono"></label>
<input name="telefono" type="text" class="campo" id="telefono"  value="<? echo $fila3["telefono"] ?>"/>
</div>


<div class="ingreso">
<p>Email:</p> 
<label for="direccion"></label>
<input type="email" id="mail" name="mail" placeholder="usuario@ejemplo.com" class="campo" value="<? echo $fila3["mail"] ?>"/>
</div>

</div> <!--termina div columna 1-->


<div class="columna">


<div class="ingreso">
<p>Dirección:</p> 
<label for="direccion"></label>
<textarea name="direccion" id="direccion" cols="45" rows="5" value="" ><? echo $fila3["direccion"] ?></textarea>
</div>
<div class="ingreso">
<p>Comúna:</p> 
<label for="comuna"></label>
<input name="comuna" type="text" class="campo" id="comuna" placeholder="Santiago" value="<? echo $fila3["comuna"] ?>"/>
</div>

<div class="ingreso">
<p>Giro Empresa:</p> 
<label for="giro"></label>
<textarea name="giro" id="giro" cols="45" rows="5"><? echo $fila3["giro"] ?></textarea>
</div>

<div class="ingreso">
<p>Vendedor Asignado:</p> 
<label for="cod_vendedor"></label>
<select name="nombre_vendedor" id="nombre_vendedor">

<?
$resultado=mysql_query("select nombre from vendedor where nombre != '$nombre_vendedor'") or die(mysql_error());
echo '<option>'.$nombre_vendedor.'</option>';
while ($fila=mysql_fetch_array($resultado)){	
echo '<option>'.$fila["nombre"].'</option>'; 
}
echo '</select>';
?>
</div>

</div> <!--termina div columna 2-->

<div class="ingreso">
<p>Comentarios Cliente:</p> 
<label for="comentario_cliente"></label>
<textarea name="comentario_cliente" id="comentario_cliente" cols="45" rows="5"><? echo $fila3["comentario_cliente"] ?></textarea>
</div>

<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.
$fecha=$datos_factura["fecha"];
$nuevafecha = date('d-m-Y', strtotime($fecha));// da vuelta la fecha para ser valida BD 
?>

<div class="ingreso">
<p>Fecha Emisión Factura:</p> 
<label for="Fecha Emisión"></label>
<input name="fecha_ingreso" style="font-weight:bolder; background:#F6FBF0" type="text" id="fecha_ingreso" class="campo" value="<? echo $nuevafecha?>"/>
</div>


<? $tipo_documento=$datos_factura["tipo_documento"];
switch($tipo_documento){

case "1":
$tipo_documento="Orden de Compra";
$otro="Guía de Despacho";
break;

case "2":
$tipo_documento="Guía de Despacho";
$otro="Orden de Compra";
break;
} ?>

<div class="ingreso">
<p>Documento Relacionado:</p> 
<select id="tipo_documento" name="tipo_documento">
<option selected><? echo $tipo_documento?></option>
<option><? echo $otro?></option>
</select>
</div> 
<div class="ingreso">
<input type="text" id="doc" name="documento_rel" placeholder="# del documento" class="campo" value="<? echo $datos_factura["documento_rel"]?>"/>
</div>
</div><!--fin div formulario-->


<table id="tabla_productos">

<tbody>

<?
while ($fila4=mysql_fetch_array($resultado4))
{
$car=$fila4['cantidad'];
?>
            
<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina td_detalle">Detalle</td>
<td colspan="5"><textarea id="detalle" name="detalle[]" type="text" class="tabla descripcion_maquina" placeholder="busca aquí..."><? echo $fila4['detalle']?></textarea></td>
</tr>

<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina">Cant.</td><td class="td_maquina">Código</td><td class="td_maquina">Nº Serie</td><td class="td_maquina">V.Unitario</td><td class="td_maquina">Desc.</td><td class="td_maquina">Final</td>
</tr>

<tr class="tr_sinfondo"> 
<td class="tabla" id="td_cantidad"><input id="cantidad" name="cantidad[]" type="number" class="tabla campo cantidad" onChange="subtotal_fila(),calculo_neto()" value="<? echo $fila4['cantidad']?>"/></td>
<input type="hidden" name="cantidad_v[]" value="<? echo $fila4['cantidad']?>"/>

<td class="tabla"><input id="codigo" name="codigo[]" type="text" class="tabla campo codigo" value="<? echo $fila4['codigo_producto']?>"/></td>

<td class="tabla"><input name="n_serie[]" type="text" class="tabla campo" value="<? echo $fila4['n_serie']?>"/></td>


<td class="tabla"><input id="precio_unitario" name="precio_unitario[]"    type="text"   class="tabla campo precio_unitario" onChange="subtotal_fila(),calculo_neto()" value="<? echo $fila4['precio_venta']?>"/></td>

<td class="tabla"><input id="descuento" name="descuento[]" type="text" class="tabla campo" onChange="subtotal_fila(),calculo_neto()" value="<? echo $fila4['descuento']?>"/></td> 
<td class="tabla"><input id="sub_total" name="precio_final[]"  type="text" class="tabla campo final" value="<? echo $fila4['precio_final']?>"/></td> 
</tr>



<?

}
?> 



</tbody>
</table>

<input id="agregar_fila" class="boton" type="button" value="Agregar Producto" />
<h2>Comentario Factura:</h2>
<textarea id="comentario_factura" name="comentario_factura" class="supertextarea" placeholder="ingrese un comentario sobre la factura."><? echo $datos_factura["comentario_factura"]?></textarea>

<div id="linea" style="width:100%; border:0.1em solid grey; font-size:10px;"></div>

<div id="pago_factura">
<h1>Pago de Factura Emitida</h1>
<h2 style="color:#006">Señale a continuación los detalles del pago a realizar.</h2>

<?

$fecha_emision=floor(strtotime($datos_factura['fecha'])/86400);
$fecha_actual=floor(strtotime(date("d-m-Y"))/86400);
$dias_trascurridos=$fecha_actual-$fecha_emision;
$plazo_dias=$datos_factura['plazo_dias'];
$plazo_actual=$plazo_dias-$dias_trascurridos;
if($datos_factura['no_pago']==0){
	$plazo_actual=32;
	$fecha_documento=date('d-m-Y', strtotime($datos_pago["fecha_documento"]));
	}
	else{
		$fecha_documento='';
		}

?>
<div id="div_nopago">


<div id="checkbox_nopago" class="float_left" onClick="checkbox_verde(), habilitar()"></div>
<input id="no_pago" type="hidden" name="no_pago" value="<? echo $datos_factura['no_pago']?>"/>
<p class="float_left" id="text_nopago">NO Pago</p>

<input type="number" name="plazo_dias" id="dias_plazo" class="campo float_left desabilitar" placeholder="(en dias)" value="<? echo $plazo_actual?>" class="float_left" disabled/>
<p id="text_nopago2" class="desabilitar">Días de Plazo</p> 

</div><!--fin div no pago-->

<div class="columna">

<div class="ingreso">
<p class="des">Forma de Pago:</p>
<select id="condiciones" name="condiciones"  class="campo des">
<? 

switch($datos_pago["forma_pago"]){
	case 1:
	$forma_pago='Efectivo';
	$otro1='Cheque';
	$otro2='Vale Vista';
	break;
	
	case 2:
	$forma_pago='Cheque';
	$otro1='Efectivo';
	$otro2='Vale Vista';
	break;
	
	case 3:
	$forma_pago='Vale Vista';
	$otro1='Efectivo';
	$otro2='Cheque';
	break;
	
	default:
	$forma_pago='Efectivo';
	$otro1='Cheque';
	$otro2='Vale Vista';
	break;
	
	}
 ?>
<option ><? echo $forma_pago?></option>
<option><? echo $otro1?></option>
<option><? echo $otro2?></option>
</select>
</div>

<div class="ingreso">
<p class="p_pagar des">Nº Serial del Documento:</p>
<input id="n_documento" name="n_documento" type="text" class="campo pago des" value="<? echo $datos_pago["n_documento"]?>"/>
</div><!--fin ingreso-->

</div><!--fin columna-->        
<div class="ingreso">
<p class="p_pagar des">Fecha Pago del Documento:</p>
<input style="font-weight:bolder; background:#F6FBF0" id="fecha_documento" name="fecha_documento" type="text" class="campo pago des" value="<? echo $fecha_documento?>"/>
</div><!--fin ingreso-->

<div class="ingreso">
<p class="p_pagar des">Banco del Documento:</p>
<input id="banco_documento" name="banco_documento" type="text" class="campo pago des" value="<? echo $datos_pago["banco_documento"]?>"/>
</div>

<div class="ingreso">
<p class="p_pagar des">Detalle Pago:</p>
<textarea id="comentario_pago" name="comentario_pago" style="margin-bottom:0.5em" class="des" ><? echo $datos_pago["comentario_pago"]?></textarea>
</div><!--fin ingreso-->


</div><!--fin pago_factura-->


<div id="totales">
<span id="titulo_totales">TOTALES</span>

<div class="ingreso">
<p>SUB TOTAL :</p><input id="total_neto" name="total_neto" class="campo" onChange="b()" readonly value="<? echo $datos_factura['total_neto']?>"/>
</div>

<div class="ingreso">
<p>DESCUENTO X FACTURA :</p><input id="porcentaje_descuento" name="porcentaje_descuento" class="campo" onChange="b(),c(),d()" value="<? echo $datos_factura['porcent_fact']?>"/>
</div>

<div class="ingreso">
<p>NETO:</p><input id="total_descuento"  name="total_descuento" class="campo" readonly value="<? echo $datos_factura['total_descuento']?>"/>
</div>

<div class="ingreso">
<p>IVA (19%) :</p><input id="total_iva" name="total_iva" class="campo" readonly value="<? echo $datos_factura['total_iva']?>"/>
</div>

<div class="ingreso">
<p>TOTAL FINAL :</p><input id="total_final" name="total_final" class="campo" style="font-weight:bolder" readonly value="<? echo $datos_factura['total_final']?>"/>

</div>
</div>


<input name="id_factura" type="hidden" value="<? echo $id_factura?>" class="oculto"/>
<input name="id_vendedor"type="hidden" value="<? echo $id_vendedor?>" class="oculto"/>
<input name="folio" type="hidden" value="<? echo $datos_factura["folio"]?>" class="oculto"/>

<input type="submit" class="boton_guardar" value="Emitir Nota" formaction="php/insert_notacredito.php" /> 
     
</form>

    <?
	mysql_free_result($resultado3);
	mysql_free_result($resultado4);
	mysql_free_result($resultado);
	include"php/cerrar_conexion.php";
	?>
    
</div><!--fin totales-->
<div id="pie"></div>
</body>
</html>
