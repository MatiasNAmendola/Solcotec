<?
include"php/valida.php";
date_default_timezone_set("Chile/Continental");
?>
<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/estructura.css" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Modificación Factura de Compra</title>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js"></script>
<script type="text/javascript">

//Funcion que evita el submit por la tecla ENTER
$('*').keypress(function(e){
// Si la tecla presionada en la tecla enter
if (e.keyCode == 13){
return false;
}
});

//FUNCION AGREGAR A UN NUMERO PUNTOS PARA LOS MILES  
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

	
function a(numero,descuento){  // funcion de descuento
var resto;
resto=(numero*descuento)/100;
resultado=numero-resto;
return resultado;
}

// CALCULO DE SUBTOTAL X FILA
function subtotal_fila(){
$('table tbody tr').not('.fila_descripcion').each(function() {
var element=$(this);
cantidad=$(element).find('input').eq(1).val();
//console.log(cantidad);
precio=$(element).find('input').eq(4).val();
//console.log(precio);
descuento=$(element).find('input').eq(5).val();
//console.log(descuento);

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

function checkbox(){
if($('#gasto').val()==0){
$('#checkbox_gasto').html('&#x2713');
$('#checkbox_gasto').css({border:"0.1em red solid" });
$('#gasto').val(1);
}
else{
$('#checkbox_gasto').html('');
$('#checkbox_gasto').css({border:"0.1em black solid" });
$('#gasto').val(0);
}
}


function habilitar(){ // CAMBIA LOS CSS DE LA SECCION PAGO SI EL TICKET ESTA O NO.
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

$(document).ready(function () {
	
if($('#gasto').val()==1){
$('#checkbox_gasto').html('&#x2713');
$('#checkbox_gasto').css({border:"0.1em red solid" });
$('#gasto').val(1);
}
else{
$('#checkbox_gasto').html('');
$('#checkbox_gasto').css({border:"0.1em black solid" });
$('#gasto').val(0);
}

if($('#no_pago').val()==1){
$('#checkbox_nopago').html('&#x2713');
$('#dias_plazo').removeAttr('disabled');
$('#text_nopago2').removeClass('desabilitar');
$('#dias_plazo').removeClass('desabilitar');
$('#dias_plazo').css({border:"red solid 0.19em"});
$('.des').addClass('desabilitar');
$('.des').attr('disabled','disabled');
$('#no_pago').val(1);
}
else{
$('#checkbox_nopago').html('');
$('#checkbox_nopago').css({border:"0.1em black solid" });
$('#no_pago').val(0);
}


//pone puntos y signo peso automaticamente al unitario y recalcula este si es cambiado.	
$('table tbody tr').find('.precio_unitario').each(function() {

$(this).keyup(function(){
resultado=$(this).val();
resultado=limpia(resultado);
resultado=puntos(resultado);
$(this).val('$'+resultado);
subtotal_fila();
calculo_neto();
});//fin funcio keyup
});//fin funcion each
	
	






	
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
$('#rut').Rut({
on_error: function(){ alert('Rut incorrecto'); },
format_on: 'keyup',

});

// AUTOCOMPLETE PROVEEDOR
$('#nombre_proveedor').autocomplete({
source: "autocompletar_proveedor.php",
minLength: 2,
select: function(event, ui) {
$('#comuna').val(ui.item.comuna);
$('#rut').val(ui.item.rut);
$('#direccion').val(ui.item.direccion);
$('#telefono').val(ui.item.telefono);
$('#giro').val(ui.item.giro);
$('#comentario_proveedor').val(ui.item.comentario);
$('#mail').val(ui.item.email);
$('#vendedor_asignado').val(ui.item.vendedor_asignado);
$('#tipo_documento').focus();
}//fin autocomplete
});//fin each
	 
	
// AUTOCOMPLETE DE PRODUCTOS

$(document).delegate('table tbody tr','focus',function(){

$(this).each(function(i) {
var element=$(this);	

$(this).find('textarea').autocomplete ({
source: "autocompletar_producto2.php",
minLength: 2,
select: function(event, ui) { 
$(element).next().next().find('input').eq(0).val(ui.item.id);
$(element).next().next().find('input').eq(2).val(ui.item.codigo_producto);
$(element).next().next().find('input').eq(4).val(ui.item.neto);
$(element).next().next().find('input').eq(1).focus();
subtotal_fila();
calculo_neto();

console.log('id :'+ui.item.id);
console.log('codigo :'+ui.item.codigo_producto);
console.log('neto :'+ui.item.neto);
}

});//fin function
});//fin autocomplete

});//fin delegate


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



$(document).delegate('#agregar_fila','click',function(){
var largo_tabla=$('#tabla_productos >tbody >tr').length;
if(largo_tabla<30){

$('#tabla_productos > tbody:last').append('<tr class="tr_sinfondo fila_descripcion ultima"><td class="td_maquina td_detalle">Detalle</td><td colspan="5"><textarea id="detalle" name="detalle[]" type="text" class="tabla descripcion_maquina" placeholder="busca aquí..." ></textarea></td><td class="center td_botoneliminar" style="width:7%;"><input type="button" class="deleteButton boton" value="Eliminar" /></td></tr><tr class="tr_sinfondo fila_descripcion"><td class="td_maquina">Cant.</td><td class="td_maquina">Código</td><td class="td_maquina">Nº Serie</td><td class="td_maquina">V.Unitario</td><td class="td_maquina">Desc.</td><td class="td_maquina">Final</td></tr><tr class="tr_sinfondo"><td class="tabla" id="td_cantidad"><input type="hidden" id="id_producto" name="id_producto[]" value=""/><input id="cantidad" name="cantidad[]" type="number" class="tabla campo cantidad" onChange="subtotal_fila(),calculo_neto()" value=""/></td><td class="tabla"><input id="codigo" name="codigo[]" type="text" class="tabla campo codigo" value=""/></td><td class="tabla"><input name="n_serie[]" type="text" class="tabla campo" value=""/></td><td class="tabla"><input id="precio_unitario" name="precio_unitario[]" type="text"   class="tabla campo precio_unitario" onChange="subtotal_fila(),calculo_neto()" value=""/></td><td class="tabla"><input id="descuento" name="descuento[]" type="text" class="tabla campo" onChange="subtotal_fila(),calculo_neto()" value="0%"/></td> <td class="tabla"><input id="sub_total" name="precio_final[]"  type="text" class="tabla campo final" value=""/></td></tr>');

}

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

<a class="ninguno" href="../consulta_factura_compra.php"><div id="boton_gigante" style="width:10.6em;"><div id="interrogacion">?</div><div id="texto_botongrande">Facturas<br/>Ingresadas</div></div></a>

</header>
<?
include "php/conexion.php";
$id_factura=$_POST['id'];
$gasto=$_POST['gasto'];
$resultado=mysql_query("SELECT factura_compra.fecha_emision,factura_compra.folio, proveedor.nombre, proveedor.rut, proveedor.telefono, proveedor.mail, proveedor.direccion, proveedor.giro, proveedor.comuna, proveedor.vendedor_asignado, proveedor.comentario, factura_compra.fecha, factura_compra.tipo_documento, factura_compra.documento_rel, factura_compra.folio_factura, factura_compra.total_descuento, factura_compra.total_neto, factura_compra.total_iva, factura_compra.total_final, factura_compra.comentario_factura, factura_compra.no_pago, factura_compra.plazo_dias, factura_compra.porcent_fact
FROM proveedor, factura_compra
WHERE factura_compra.id_fc ='$id_factura'
AND factura_compra.id_proveedor = proveedor.id_proveedor;") or die (mysql_error()); 
$datos_factura=mysql_fetch_array($resultado);
mysql_free_result($resultado);

?>

<h1>Modificación Factura de Compra [ <span style="color: #E1001D">FOLIO Nº <? echo $datos_factura["folio"]; ?></span> ]</h1>
<h2>Aquí podrá modificar cualquier información relacionada con esta factura de compra.</h2>

<form id="datos" action="php/update_fc.php" enctype="application/x-www-form-urlencoded"  method="post">

<div id="formulario">

<div class="columna">
<div class="cuadrante_gasto">
<div id="checkbox_gasto" class="float_left checkbox" onClick="checkbox()"></div>
<input id="gasto" type="hidden" name="gasto" value="<? echo $gasto?>"/>
<p id="text_nopago">ES UN GASTO ?</p>
</div><!--fin cuadrante gasto-->
<div class="ingreso">
<p>Nombre Proveedor:</p> 
<textarea name="nombre_proveedor" id="nombre_proveedor"/><? echo $datos_factura["nombre"] ?></textarea>
</div>

<div class="ingreso">
<p>Rut:</p> 
<input name="rut" type="text" class="campo" id="rut" value="<? echo $datos_factura["rut"] ?>" />
</div>

<div class="ingreso">
<p>Teléfono:</p> 
<input name="telefono" type="text" class="campo" id="telefono" value="<? echo $datos_factura["telefono"] ?>" />
</div>


<div class="ingreso">
<p>Email:</p> 
<input type="email" id="mail" name="mail" placeholder="usuario@ejemplo.com" class="campo" value="<? echo $datos_factura["mail"] ?>" />
</div>


</div> <!--termina div columna 1-->


<div class="columna">


<div class="ingreso">
<p>Dirección:</p> 
<label for="direccion"></label>
<textarea name="direccion" id="direccion"  ><? echo $datos_factura["direccion"] ?></textarea>
</div>

<div class="ingreso">
<p>Giro Empresa:</p> 
<label for="giro"></label>
<textarea name="giro" id="giro" ><? echo $datos_factura["giro"] ?></textarea>
</div>




<div class="ingreso">
<p>Comúna:</p> 
<input name="comuna" type="text" class="campo" id="comuna" placeholder="Santiago" value="<? echo $datos_factura["comuna"] ?>" />
</div>


<div class="ingreso">
<p>Vendedor Asignado:</p> 
<textarea name="vendedor_asignado" id="vendedor_asignado" ><? echo $datos_factura["vendedor_asignado"] ?></textarea>
</div>


</div> <!--termina div columna 2-->

<div class="ingreso">
<p>Comentarios Proveedor:</p> 
<textarea name="comentario_proveedor" id="comentario_proveedor" ><? echo $datos_factura["comentario"] ?></textarea>
</div>

<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.
   $fecha=$datos_factura["fecha"];
   $nuevafecha = date('d-m-Y', strtotime($fecha));// da vuelta la fecha para ser valida BD 
?>



<div class="ingreso">
<p>Fecha Ingreso Factura:</p> 
<label for="Fecha Emisión"></label>
<input name="fecha_ingreso" type="text" id="fecha_ingreso" class="campo" value="<? echo $nuevafecha?>"/>
</div>

<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.

$fecha_emision=$datos_factura["fecha_emision"];

if($fecha_emision=='0000-00-00'){
	$fecha_emision='';
	}
	
if($fecha_emision!=''){
$fecha_emision= date('d-m-Y', strtotime($fecha_emision));// da vuelta la fecha para ser valida BD
}

?>

<div class="ingreso">
<p>Fecha de Emisión Factura:</p>
<input type='text' class='campo fecha' name='fecha_emision' id='fecha_emision' value="<? echo $fecha_emision?>" />
</div>


<? $tipo_documento=$datos_factura["tipo_documento"];
switch($tipo_documento){
	
	case "1":
	$tipo_documento="Orden de Compra";
	$otro="Guía de Despacho";
	$otro2="";
	break;
	
	case "2":
	$tipo_documento="Guía de Despacho";
	$otro="Orden de Compra";
	$otro2="";
	break;
	
	case "0":
	$tipo_documento="";
	$otro="Orden de Compra";
	$otro2="Guía de Despacho";
	} 
	
?>

<div class="ingreso">
<p>Documento Relacionado:</p> 
<select id="tipo_documento" name="tipo_documento" onChange="cambia_focus()">
<option><? echo $tipo_documento ?></option>
<option><? echo $otro?></option>
<option><? echo $otro2?></option>
</select>
</div> 
<div class="ingreso">
<input type="text" id="doc" name="documento_rel" placeholder="# del documento" class="campo" value="<? echo $datos_factura["documento_rel"] ?>"/>
</div>
<div class="ingreso">
<p>Folio Factura Original:</p> 
<input name="folio_factura" type="text" class="campo" id="folio_factura" value="<? echo $datos_factura["folio_factura"] ?>" />
</div>

</div><!--fin div formulario-->


<table id="tabla_productos">
<tbody>
<?

if($gasto==0){
$resultado=mysql_query("SELECT producto.codigo_producto,facturac_x_producto.detalle, facturac_x_producto.cantidad, facturac_x_producto.precio_venta, facturac_x_producto.precio_final, facturac_x_producto.descuento, facturac_x_producto.id_facturaxproducto,facturac_x_producto.id_producto, facturac_x_producto.n_serie FROM facturac_x_producto , producto WHERE facturac_x_producto.id_fc='$id_factura' AND producto.id_producto=facturac_x_producto.id_producto;") or die (mysql_error());
}if($gasto==1){
	$resultado=mysql_query("SELECT facturac_x_producto.id_facturaxproducto,facturac_x_producto.id_producto, facturac_x_producto.detalle, facturac_x_producto.cantidad, facturac_x_producto.precio_venta, facturac_x_producto.precio_final, facturac_x_producto.descuento, facturac_x_producto.n_serie FROM facturac_x_producto WHERE facturac_x_producto.id_fc='$id_factura';") or die (mysql_error());
	}

while ($datos_producto=mysql_fetch_array($resultado)){
	?>


<tr class="tr_sinfondo fila_descripcion ultima">
<td class="td_maquina td_detalle">Detalle</td>
<td colspan="5"><textarea id="detalle" name="detalle[]" type="text" class="tabla descripcion_maquina" placeholder="busca aquí..." ><? echo $datos_producto["detalle"]?></textarea></td>

<td class="center td_botoneliminar" style="width:7%;"><input type="button" class="deleteButton boton" value="Eliminar" /></td>
</tr>

<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina">Cant.</td><td class="td_maquina">Código</td><td class="td_maquina">Nº Serie</td><td class="td_maquina">V.Unitario</td><td class="td_maquina">Desc.</td><td class="td_maquina">Final</td>
</tr>

<tr class="tr_sinfondo"> 
<td class="tabla" id="td_cantidad"><input type="hidden" id="id_producto" name="id_producto[]" value="<? echo $datos_producto["id_producto"]?>"/>
<input id="cantidad" name="cantidad[]" type="number" class="tabla campo cantidad" onChange="subtotal_fila(),calculo_neto()" value="<? echo $datos_producto["cantidad"]?>"/></td>

<td class="tabla"><input id="codigo" name="codigo[]" type="text" class="tabla campo codigo" value="<? echo $datos_producto["codigo_producto"]?>"/></td>

<td class="tabla"><input name="n_serie[]" type="text" class="tabla campo" value="<? echo $datos_producto["n_serie"]?>"/></td>


<td class="tabla"><input id="precio_unitario" name="precio_unitario[]" type="text"   class="tabla campo precio_unitario" onChange="subtotal_fila(),calculo_neto()" value="<? echo $datos_producto["precio_venta"]?>"/></td>

<td class="tabla"><input id="descuento" name="descuento[]" type="text" class="tabla campo" onChange="subtotal_fila(),calculo_neto()" value="<? echo $datos_producto["descuento"]?>"/></td> <td class="tabla"><input id="sub_total" name="precio_final[]"  type="text" class="tabla campo final" value="<? echo $datos_producto["precio_final"]?>"/></td> 
</tr>
<input type="hidden" id="id_facturaxproducto" name="id_facturaxproducto[]" value="<? echo $datos_producto["id_facturaxproducto"]?>"/>
<input name="cantidad_antigua[]" type="hidden" value="<? echo $datos_producto["cantidad"]?>"/>
<?
}
?>
</tbody>
</table>

<input id="agregar_fila" class="boton" type="button" value="Agregar Producto" />

<h2>COMENTARIO FACTURA:</h2>
<textarea style="width:99%" id="comentario_factura" name="comentario_factura" class="supertextarea" placeholder="ingrese un comentario sobre la factura."><? echo $datos_factura["comentario_factura"]?></textarea>


<div id="linea"></div>
<?


	
	$consulta=mysql_query("SELECT id_pago, forma_pago, n_documento, fecha_documento, banco_documento, comentario_pago FROM pago_efectuado WHERE id_factura='$id_factura'") or die (mysql_error());
	
	$datos_pago=mysql_fetch_array($consulta);	
switch($datos_pago['forma_pago']){
	
	case "1":
	$forma_pago='Efectivo';
	$forma_pago_2='Cheque';
	$forma_pago_3='Vale Vista';
	$forma_pago_4='Trasferencia Electrónica';
	break;
	
	case "2":
	$forma_pago='Cheque';
	$forma_pago_2='Efectivo';
	$forma_pago_3='Vale Vista';
	$forma_pago_4='Trasferencia Electrónica';
	break;
	
	case "3":
	$forma_pago='Vale Vista';
	$forma_pago_2='Efectivo';
	$forma_pago_3='Cheque';
	$forma_pago_4='Trasferencia Electrónica';
	break;
	
	case "4":
	$forma_pago='Trasferencia Electrónica';
	$forma_pago_2='Efectivo';
	$forma_pago_3='Cheque';
	$forma_pago_4='Vale Vista';
	break;
	
	default:
	$forma_pago='Efectivo';
	$forma_pago_2='Cheque';
	$forma_pago_3='Vale Vista';
	$forma_pago_4='Trasferencia Electrónica';
	break;
	}

?>
<div id="pago_factura">
<h1>PAGO FACTURA</h1>

<h2 style="color:#006">Señale a continuación los detalles del pago realizado.</h2>

<div id="div_nopago">


<div id="checkbox_nopago" class="float_left checkbox" onClick="checkbox_verde(), habilitar()"></div>
<input id="no_pago" type="hidden" name="no_pago" value="<? echo $datos_factura['no_pago']?>"/>
<p class="float_left" id="text_nopago">NO Pago</p>

<input type="number" name="plazo_dias" id="dias_plazo" class="campo float_left desabilitar" placeholder="(en dias)" value="<? echo $datos_factura['plazo_dias']?>" class="float_left" disabled/>
<p id="text_nopago2" class="desabilitar">Días de Plazo</p> 

</div><!--fin div no pago-->


<div class="columna">

<div class="ingreso">
<p class="des">Forma de Pago:</p>
<select id="forma_pago" name="forma_pago"  class="campo des">
<option><? echo $forma_pago?></option>
<option><? echo $forma_pago_2?></option>
<option><? echo $forma_pago_3?></option>
<option><? echo $forma_pago_4?></option>
</select>
</div>

<div class="ingreso">
<p class="p_pagar des">Nº Serial del Documento:</p>
<input id="n_documento" name="n_documento" type="text" class="campo pago des" value="<? echo $datos_pago['n_documento']?>"/>
</div><!--fin ingreso-->

</div><!--fin columna-->        
<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.

$fecha=$datos_pago["fecha_documento"];

if($fecha=='0000-00-00'){
	$fecha='';
	}
	
if($fecha!=''){
$fecha= date('d-m-Y', strtotime($fecha));// da vuelta la fecha para ser valida BD
}

?>
<div class="ingreso">
<p class="p_pagar des">Fecha Pago del Documento:</p>
<input id="fecha_documento" name="fecha_documento" type="text" class="campo pago des fecha" value="<? echo $fecha ?>" />
</div><!--fin ingreso-->

<div class="ingreso">
<p class="p_pagar des">Banco del Documento:</p>
<input id="banco_documento" name="banco_documento" type="text" class="campo pago des" value="<? echo $datos_pago['banco_documento']?>"/>
</div>

<div class="ingreso">
<p class="p_pagar">Detalle Pago:</p>
<textarea id="comentario_pago" name="comentario_pago" style="margin-bottom:0.5em" placeholder="Abonos y otros comentarios." ><? echo $datos_pago['comentario_pago']?></textarea>
</div><!--fin ingreso-->


</div><!--fin pago_factura-->


<div id="totales">
<span id="titulo_totales">TOTALES</span>
<div class="ingreso">
<p>SUB TOTAL :</p><input id="total_neto" name="total_neto" class="campo" onChange="b()" readonly value="<? echo $datos_factura["total_neto"]?>"/>
</div>

<div class="ingreso">
<p>DESCUENTO X FACTURA :</p><input id="porcentaje_descuento" name="porcentaje_descuento" class="campo" value="<? echo $datos_factura["porcent_fact"]?>" onChange="b(),c(),d()" />
</div>

<div class="ingreso">
<p>NETO:</p><input id="total_descuento"  name="total_descuento" class="campo" readonly value="<? echo $datos_factura["total_descuento"]?>"/>
</div>

<div class="ingreso">
<p>IVA (19%) :</p><input id="total_iva" name="total_iva" class="campo" readonly value="<? echo $datos_factura["total_iva"]?>"/>
</div>

<div class="ingreso">
<p>TOTAL FINAL :</p><input id="total_final" name="total_final" class="campo" style="font-weight:bolder" readonly value="<? echo $datos_factura["total_final"]?>"/>

</div>
</div>
<input name="id_factura" type="hidden" value="<? echo $id_factura?>" class="oculto"/>
<input name="id_pago" type="hidden" value="<? echo $datos_pago['id_pago']?>" class="oculto"/>
<input name="no_pago_antiguo" type="hidden" value="<? echo $datos_factura['no_pago']?>" class="oculto"/>



<input type="submit" class="boton_guardar" value="Modificar Factura" /> 
</form>

<?
mysql_free_result($resultado);
mysql_free_result($consulta);
include"php/cerrar_conexion.php";
?>
    
</div><!--fin totales-->
<div id="pie"></div>
</body>
</html>