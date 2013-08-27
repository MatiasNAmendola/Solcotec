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
<title>Factura de Venta</title>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js" ></script>
<script type="text/javascript">

// FUNCION QUE MUESTRA EL CALENDARIO.


// FUNCION QUE EVITA SUBMIT AL PRESIONAR ENTER.
$('*').keypress(function(e){

// Si la tecla presionada en la tecla enter
if (e.keyCode == 13){
return false;
}
});

// FUNCIONES PARA CHECKBOX PAGO.
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
	
$('.boton_guardar').click(function(e) {
id=$('#id_factura').val();
window.open("../pdf_facturaventa.php?id="+id,"Factura de Venta","toolbar=no","location=yes","status=yes","width=900","height=700");
});
	

// FUNCION VALIDACION DE CAMPOS
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
}else if( $("#giro").val() == "" ){
$("#giro").focus().after("<span class='error'>Falto ingresar el giro del cliente.</span>");
return false;
}else if( $("#comuna").val() == "" ){
$("#comuna").focus().after("<span class='error'>Ingrese la comuna.</span>");
return false;
}
});// fin click function

$("#nombre_cliente, #rut, #telefono, #direccion, #doc, #giro, #comuna").keyup(function(){
if( $(this).val() != "" ){
$(".error").fadeOut();
return false;
}
});// fin function keyup

$("#mail").keyup(function(){
if( $(this).val() != "" && emailreg.test($(this).val())){
$(".error").fadeOut();
return false;
}
});//FIN FUNCION MAIL



//VALIDACION DE RUT

$('.rut').Rut({
on_error: function(){ alert('Rut incorrecto'); },
format_on: 'keyup',
});// FIN FUNCION RUT

});// FIN FUNCION READY

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

//FUNCION AGREGAR A UN NUMERO PUNTOS PARA LOS MILES  

function a(numero,descuento){  // funcion de descuento
var resto;
resto=(numero*descuento)/100;
resultado=numero-resto;
return resultado;
}






// AUTOCOMPLETE CLIENTE

$(document).ready(function(){


$('#rut_cliente').autocomplete({
source: "autocompletar_rut.php",
minLength: 2,
select: function(event, ui) {
$('#comuna').val(ui.item.comuna);
$('#nombre_cliente').val(ui.item.nombre_cliente);
$('#direccion').val(ui.item.direccion);
$('#telefono').val(ui.item.telefono);
$('#giro').val(ui.item.giro);
$('#cod_vendedor').val(ui.item.cod_vendedor);
$('#comentario_cliente').val(ui.item.comentario_cliente);
$('#mail').val(ui.item.email);
$('#bloqueado').val(ui.item.bloqueado);
$('#tipo_documento').focus();

if(ui.item.bloqueado==1){
id=ui.item.id_cliente;
//window.location.href='../consulta_vencida.php?id='+id;
window.open("../consulta_vencida.php?id="+id,"Facturas Vencidas","toolbar=no","location=yes","status=yes","width=900","height=700");
}//FIN IF
}//fin SELECT
});//fin AUTOCOMPLETE


$('#nombre_cliente').autocomplete({
source: "autocompletar.php",
minLength: 2,
select: function(event, ui) {
$('#comuna').val(ui.item.comuna);
$('#rut_cliente').val(ui.item.rut);
$('#direccion').val(ui.item.direccion);
$('#telefono').val(ui.item.telefono);
$('#giro').val(ui.item.giro);
$('#cod_vendedor').val(ui.item.cod_vendedor);
$('#comentario_cliente').val(ui.item.comentario_cliente);
$('#mail').val(ui.item.email);
$('#bloqueado').val(ui.item.bloqueado);
$('#tipo_documento').focus();

if(ui.item.bloqueado==1){
id=ui.item.id_cliente;
//window.location.href='../consulta_vencida.php?id='+id;
window.open("../consulta_vencida.php?id="+id,"Facturas Vencidas","toolbar=no","location=yes","status=yes","width=900","height=700");
}//FIN IF
}//fin SELECT
});//fin AUTOCOMPLETE


// AUTOCOMPLETE DE PRODUCTOS
$(document).delegate('table tbody tr','focus',function(){

$(this).each(function(i) {
var element=$(this);	

$(this).find('textarea').autocomplete ({
source: "autocompletar_producto.php",
minLength: 2,
select: function(event, ui) {   
$(element).next().next().find('input').eq(0).val(ui.item.id_producto);
$(element).next().next().find('input').eq(4).val(ui.item.p_venta);
$(element).next().next().find('input').eq(2).val(ui.item.codigo_producto);
$(element).next().next().find('input').eq(1).focus();
subtotal_fila();
calculo_neto();


console.log('id :'+ui.item.id_producto);
console.log('codigo :'+ui.item.codigo_producto);
console.log('pventa :'+ui.item.p_venta);
}

});//fin function
});//fin autocomplete

});//fin delegate


// AUTOCOMPLETE OT
$(document).delegate('table tbody tr','focus',function(){

$(this).each(function(i) {
var element=$(this);	

$(this).find('.ot').autocomplete ({
source: "autocompletar_ot.php",
minLength: 1,
select: function(event, ui) {   
$(element).find('.descripcion_maquina').html(ui.item.nombre);
$(element).next().next().find('input').eq(1).val(1);
$(element).next().next().find('input').eq(3).val(ui.item.n_serie);
$(element).next().next().find('input').eq(4).focus();
}

});//fin function
});//fin autocomplete

});//fin delegate


});//fin ready


 

// CALCULO DE PRODUCTO FINAL.

function subtotal_fila(){

$('table tbody tr').not('.fila_descripcion').each(function() {

var element=$(this);

cantidad=$(element).find('input').eq(1).val();
//console.log('cantidad :'+cantidad);
precio=$(element).find('input').eq(4).val();
//console.log('precio :'+precio);
descuento=$(element).find('input').eq(5).val();
//console.log('descuento :'+descuento);


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


$('#tabla_productos > tbody:last').append('<tr class="tr_sinfondo fila_descripcion ultima"><td class="td_maquina td_detalle">Detalle</td><td colspan="4"><textarea id="detalle" name="detalle[]" type="text" class="tabla descripcion_maquina" placeholder="busca aquí..." autofocus></textarea></td><td><input type="text" name="n_ot[]" class="tabla campo ot" placeholder="Nº Orden Trabajo:"/></td><td class="center td_botoneliminar" style="width:7%;"><input type="button" class="deleteButton boton" value="Eliminar" /></td></tr><tr class="tr_sinfondo fila_descripcion"><td class="td_maquina">Cant.</td><td class="td_maquina">Código</td><td class="td_maquina">Nº Serie</td><td class="td_maquina">V.Unitario</td><td class="td_maquina">Desc.</td><td class="td_maquina">Final</td></tr><tr class="tr_sinfondo"> <td class="tabla" id="td_cantidad"><input type="hidden" id="id_producto" name="id_producto[]"/><input id="cantidad" name="cantidad[]" type="number" class="tabla campo cantidad" onChange="subtotal_fila(),calculo_neto()"/></td><td class="tabla"><input id="codigo" name="codigo[]" type="text" class="tabla campo codigo"/></td><td class="tabla"><input name="n_serie[]" class=" tabla campo" /></td><td class="tabla"><input id="precio_unitario" name="precio_unitario[]"    type="text"   class="tabla campo precio_unitario" onChange="subtotal_fila(),calculo_neto()"/></td><td class="tabla"><input id="descuento" name="descuento[]" type="text" class="tabla campo" onChange="subtotal_fila(),calculo_neto()" value="0%"/></td> <td class="tabla"><input id="sub_total" name="precio_final[]"  type="text" class="tabla campo final" /></td></tr>');}

if(largo_tabla==27){
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
$resultado=mysql_query("select count(id_fv) as folio from factura_venta") or die (mysql_error());
$fila=mysql_fetch_array($resultado);
$folio=$fila["folio"]+798;
$id_factura=$fila["folio"]+1;
?>

<h1>Factura de Venta [ <span style="color: #E1001D">FOLIO Nº <? echo $folio+1; ?></span> ]</h1>
<h2>Aquí podrá generar una factura de venta para el registro de productos vendidos.</h2>

<form action="php/gestion_factura_venta.php" id="datos" enctype="application/x-www-form-urlencoded" method="post">

<div id="formulario">

<div class="columna">

<p>Nombre Cliente:</p> 
<textarea name="nombre_cliente" id="nombre_cliente" cols="45" rows="5" autofocus/></textarea>

<div class="ingreso">
<p>Rut:</p> 
<label for="rut"></label>
<input id="rut_cliente" name="rut" type="text" class="campo rut" />
</div>

<div class="ingreso">
<p>Teléfono:</p> 
<label for="telefono"></label>
<input name="telefono" type="text" class="campo" id="telefono" />
</div>


<div class="ingreso">
<p>Email:</p> 
<label for="direccion"></label>
<input type="email" id="mail" name="mail" placeholder="usuario@ejemplo.com" class="campo" />
</div>

</div> <!--termina div columna 1-->


<div class="columna">


<p>Dirección:</p> 
<textarea name="direccion" id="direccion" cols="45" rows="5" ></textarea>

<div class="ingreso">
<p>Comúna:</p> 
<input name="comuna" type="text" class="campo" id="comuna" placeholder="Santiago" />
</div>

<p>Giro Empresa:</p> 
<textarea name="giro" id="giro" cols="45" rows="5"></textarea>

<div class="ingreso">
<p>Vendedor Asignado:</p> 

<?
echo '<select name="cod_vendedor" id="cod_vendedor">';
$resultado=mysql_query("select id_vendedor,nombre from vendedor") or die(mysql_error());
while ($fila=mysql_fetch_array($resultado)){	
echo '<option>'.$fila["nombre"].'</option>'; 
}
echo '</select>';
?>
</div>

</div> <!--termina div columna 2-->

<p>Comentarios Cliente:</p> 
<textarea name="comentario_cliente" id="comentario_cliente" cols="45" rows="5"></textarea>



<div class="ingreso">
<?
$fecha_ingreso=date("d-m-Y");
?>
<p>Fecha de Emision Factura:</p>
<input id="fecha_ingreso" type="text" class="campo fecha" name="fecha_ingreso" id="fecha_ingreso" value="<? echo $fecha_ingreso?>"/>
</div>

<div class="ingreso">
<p>Documento Relacionado:</p> 
<select id="tipo_documento" name="tipo_documento" onChange="cambia_focus()">
<option></option>
<option>Orden de Compra</option>
<option>Guía de Despacho</option>
</select>
</div> 

<input type="hidden" id="bloqueado" name="bloqueado" />

<input type="text" id="doc" name="documento_rel" placeholder="# del documento" class="campo" />

</div><!--fin div formulario-->
<table id="tabla_productos">

<tbody>

<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina td_detalle">Detalle</td>
<td colspan="4"><textarea id="detalle" name="detalle[]" type="text" class="tabla descripcion_maquina" placeholder="Busca Aquí ..."></textarea></td>
<td><input type="text" name="n_ot[]" class="tabla campo ot" placeholder="Nº Orden Trabajo:"/></td>
</tr>

<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina">Cant.</td><td class="td_maquina">Código</td><td class="td_maquina">Nº Serie</td><td class="td_maquina">V.Unitario</td><td class="td_maquina">Desc.</td><td class="td_maquina">Final</td>
</tr>

<tr class="tr_sinfondo"> 
<td class="tabla" id="td_cantidad"><input type="hidden" id="id_producto" name="id_producto[]"/><input id="cantidad" name="cantidad[]" type="number" class="tabla campo cantidad" onChange="subtotal_fila(),calculo_neto()"/></td>

<td class="tabla"><input id="codigo" name="codigo[]" type="text" class="tabla campo codigo"/></td>

<td class="tabla"><input name="n_serie[]" type="text" class="tabla campo"/></td>

<td class="tabla"><input id="precio_unitario" name="precio_unitario[]" type="text" class="tabla campo precio_unitario" onChange="subtotal_fila(),calculo_neto()"/></td>

<td class="tabla"><input id="descuento" name="descuento[]" type="text" class="tabla campo" onChange="subtotal_fila(),calculo_neto()" value="0%"/></td>
<td class="tabla"><input id="sub_total" name="precio_final[]"  type="text" class="tabla campo final" /></td> 

</tr>



</tbody>
</table>

<input id="agregar_fila" class="boton" type="button" value="Agregar Producto" />

<div id="pago_factura">

<h1>PAGO FACTURA</h1>
<h2 style="color:#006">Señale a continuación los detalles del pago a realizar.</h2>

<div id="div_nopago">

<div id="checkbox_nopago" class="float_left checkbox" onClick="checkbox_verde(), habilitar()"></div>
<input id="no_pago" type="hidden" name="no_pago" value="0"/>
<p class="float_left" id="text_nopago">NO Pago</p>

<input type="number" name="plazo_dias" id="dias_plazo" class="campo float_left desabilitar" placeholder="(en dias)" value="32"  disabled/>
<p id="text_nopago2" class="desabilitar">Días Plazo</p> 

</div><!--fin div no pago-->



<div class="columna">

<div class=" float_left">
<p class="des">Forma de Pago:</p>
<select id="condiciones" name="condiciones"  class="campo des">
<option>Efectivo</option>
<option>Cheque</option>
<option>Vale Vista</option>
<option>Trasferencia Electrónica</option>
</select>
</div>

<p class="des">Nº Serial del Documento:</p>
<input id="n_documento" name="n_documento" type="text" class="campo pago des"/>
</div>

<p class="des">Fecha Pago del Documento:</p>
<input id="fecha_documento" name="fecha_documento" type="text" class="campo pago des fecha"  onClick="date()" />

<p class="des">Banco del Documento:</p>
<input id="banco_documento" name="banco_documento" type="text" class="campo pago des"/>


<p style="clear:both">Detalle Pago:</p>
<textarea maxlength="170"  id="comentario_pago" name="comentario_pago" style="margin-bottom:0.5em" placeholder="Abonos y otros comentarios." ></textarea>


</div><!--fin pago_factura-->


<div id="totales">
<span id="titulo_totales">TOTALES</span>
<div class="ingreso">
<p>SUB TOTAL :</p><input id="total_neto" name="total_neto" class="campo" onChange="b()" readonly/>
</div>

<div class="ingreso">
<p>DESCUENTO X FACTURA :</p><input id="porcentaje_descuento" name="porcentaje_descuento" class="campo" value="0%" onChange="b(),c(),d()" />
</div>

<div class="ingreso">
<p>NETO:</p><input id="total_descuento"  name="total_descuento" class="campo" readonly/>
</div>

<div class="ingreso">
<p>IVA (19%) :</p><input id="total_iva" name="total_iva" class="campo" readonly/>
</div>

<div class="ingreso">
<p>TOTAL FINAL :</p><input id="total_final" name="total_final" class="campo" style="font-weight:bolder" readonly onChange="compara()"/>
</div>
</div>

<div style=" margin-top:3em;margin-bottom:0.5em; clear:both;" class="linea_superior"></div>
<div class="columna">
<p>Nombre de Contacto:</p>
<input name="nombre_contacto" class="campo" type="text" maxlength="30" placeholder="nombre, apellido."/>
</div>
<p>RUT de Contacto:</p>
<input name="rut_contacto" class="campo rut" type="text" maxlength="30"/>
<div class="linea"></div>

<h1 style="margin-top:0.5em;">Comentarios</h1>
<textarea id="comentario_factura" name="comentario_factura" class="supertextarea" placeholder="ingrese un comentario sobre la factura."></textarea>
<input name="folio" type="hidden" value="<? echo $folio+1?>" class="oculto"/>

<input id="id_factura"  type="hidden" value="<? echo $id_factura ?>" class="oculto"/>


<input id="boton_guardar" type="submit" class="boton_guardar" value="Emitir Factura"/> 

</form>

<?
mysql_free_result($resultado);
include"php/cerrar_conexion.php";
?>

</div><!--fin totales-->
</div><!--fin contenido-->
<div id="pie"></div>
</body>
</html>