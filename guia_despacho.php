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
<title>Guía de Despacho</title>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js" ></script>
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
}//FIN WHILE
resultado=numero+resultado;
return resultado;
}//FIN FUNCION PUNTOS
	
//FUNCION QUE EXTRAE LOS PUNTOS Y EL SIGNO PESO DE UN NUMERO  
function limpia(elemento){
elemento=elemento.replace(/\%/g,'');	
elemento=elemento.replace(/\$/g,'');
elemento=elemento.replace(/\./g,'');
elemento=parseInt(elemento,10);
return elemento;
}//FIN FUNCION LIMPIA

//FUNCION QUE APLICA DESCUENTO A UN NUMERO Y PORCENTAJE DADO.
function aplica_descuento(numero,descuento){  
var resto;
resto=(numero*descuento)/100;
resultado=numero-resto;
return resultado;
}

// CALCULO DE PRODUCTO FINAL.
function subtotal_fila(){
$('table tbody tr').not('.fila_descripcion').each(function() {
var element=$(this);
cantidad=$(element).find('input').eq(0).val();
console.log('cantidad :'+cantidad);
precio=$(element).find('input').eq(3).val();
console.log('precio :'+precio);
descuento=$(element).find('input').eq(4).val();
console.log('descuento :'+descuento);
//------------------------------------------

if(cantidad!='' && precio!=''){
precio=limpia(precio);
//console.log(precio);
final=precio*cantidad;
//console.log(final);
descuento=limpia(descuento);
//console.log(descuento);
nuevo_final=aplica_descuento(final,descuento);
//console.log(nuevo_final);
nuevo_final=puntos(nuevo_final);
//console.log(nuevo_final);
$(element).find('input').eq(5).val('$'+nuevo_final);
}//fin if


});//fin funcion each

}//fin funcion subtotal_fila


/// CALCULO DE TOTAL NETO
function calculo_neto(){
var suma=0;
$('table tbody tr').not('.fila_descripcion').each(function() {
var element=$(this);
//console.error(element);
valor=$(element).find('input').eq(5).val();
//console.log(valor);
if(valor!=''){
valor=limpia(valor);
suma=suma+valor;
}//fin if
}); //fin each	
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

sub_total=aplica_descuento(total_neto,desc_factura);
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

sub_total=aplica_descuento(total_neto,desc_factura);
sub_total=puntos(sub_total);

$('#total_descuento').val('$'+sub_total);
}//fin del if
}

/*-------------------------------------------------------------------------------------------------*/
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
/*-------------------------------------------------------------------------------------------------*/

$(document).ready(function() {
// triggers de PDF
$('#azul').click(function() {
id=$('#id_factura').val();
window.open("../pdf_guiadespacho.php?id="+id,"Guía de gestion_guia_despacho","toolbar=no","location=yes","status=yes","width=900","height=700");
});
$('#rojo').click(function() {
id=$('#id_factura').val();

alert('holap');
});
   
// FUNCION VALIDACION DE CAMPOS
var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$(".boton_guardar").click(function (){
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
	
// FUNCION QUE EVITA SUBMIT AL PRESIONAR ENTER.
$('*').keypress(function(e){
// Si la tecla presionada en la tecla enter
if (e.keyCode == 13){
return false;
}
});	

//VALIDACION DE RUT
$('.rut').Rut({
on_error: function(){ alert('Rut incorrecto'); },
format_on: 'keyup',
});// FIN FUNCION RUT
	


// AUTOCOMPLETE CLIENTE
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
$(element).next().next().find('input').eq(1).val(ui.item.nombre);
$(element).next().next().find('input').eq(3).val(ui.item.codigo_producto);
$(element).next().next().find('input').eq(0).focus();
subtotal_fila();
calculo_neto();
}// fin select
});//fin autocomplete
});//fin funcion
});//fin delegate


//AUTOCOMPLETE OT
$(document).delegate('table tbody tr','focus',function(){

$(this).each(function(i) {
var element=$(this);	

$(this).find('input .ot').autocomplete ({
source: "autocompletar_ot.php",
minLength: 1,
select: function(event, ui) {   
$(element).find('.descripcion_maquina').html(ui.item.nombre);
$(element).next().next().find('input').eq(0).val(1);
$(element).next().next().find('input').eq(2).val(ui.item.n_serie);
$(element).next().next().find('input').eq(3).focus();
}//fin select

});//fin autocomplete
});//fin each

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



$(document).delegate('#agregar_fila','click',function()
{
var largo_tabla=$('#tabla_productos >tbody >tr').length;
if(largo_tabla<30){
$('#tabla_productos > tbody:last').append('<tr class="tr_sinfondo fila_descripcion ultima"><td class="td_maquina td_detalle">Detalle</td><td colspan="4"><textarea id="detalle" name="detalle[]" type="text" class="tabla descripcion_maquina" placeholder="busca aquí..." autofocus></textarea></td><td><input type="text" name="n_ot[]" class="tabla campo" placeholder="Nº Orden Trabajo:"/></td><td class="center td_botoneliminar" style="width:7%;"><input type="button" class="deleteButton boton" value="Eliminar" /></td></tr><tr class="tr_sinfondo fila_descripcion"><td class="td_maquina">Cant.</td><td class="td_maquina">Código</td><td class="td_maquina">Nº Serie</td><td class="td_maquina">V.Unitario</td><td class="td_maquina">Desc.</td><td class="td_maquina">Final</td></tr><tr class="tr_sinfondo"> <td class="tabla" id="td_cantidad"><input id="cantidad" name="cantidad[]" type="number" class="tabla campo cantidad" onChange="subtotal_fila(),calculo_neto()"/></td><td class="tabla"><input id="codigo" name="codigo[]" type="text" class="tabla campo codigo"/></td><td class="tabla"><input name="n_serie[]" class=" tabla campo" /></td><td class="tabla"><input id="precio_unitario" name="precio_unitario[]"    type="text"   class="tabla campo precio_unitario" onChange="subtotal_fila(),calculo_neto()"/></td><td class="tabla"><input id="descuento" name="descuento[]" type="text" class="tabla campo" onChange="subtotal_fila(),calculo_neto()" value="0%"/></td> <td class="tabla"><input id="sub_total" name="precio_final[]"  type="text" class="tabla campo final" /></td></tr>');}//fin if

if(largo_tabla==27){
$('#agregar_fila').css("display","none");
}// fin if

});// fin delegate
	
});// FIN FUNCION READY


</script>
</head>

<body>    

<div id="contenido">
<? echo $nav;?>

<header>  
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>   

<? echo $logo;?>

<a class="ninguno" href="../consulta_guia.php"><div id="boton_gigante"><div id="interrogacion">?</div><div id="texto_botongrande">Guias<br/>Emitidas</div></div></a>

</header>
<?
include "php/conexion.php";
$resultado=mysql_query("select count(id_guia) as folio from guia_despacho") or die (mysql_error());
$fila=mysql_fetch_array($resultado);
$folio=$fila["folio"]+254;
?>

<h1>Guía de Despacho [ <span style="color: #E1001D">FOLIO Nº <? echo $folio+1; ?></span> ]</h1>
<h2>Aquí podrá generar una guía de despacho para el registro de productos egresados.</h2>

<form action="php/gestion_guia_despacho.php" id="datos" enctype="application/x-www-form-urlencoded" method="post">

<div id="formulario">

<div class="columna">

<p>Nombre Cliente:</p> 
<textarea name="nombre_cliente" id="nombre_cliente" cols="45" rows="5" autofocus/></textarea>

<div class="ingreso">
<p>Rut:</p> 
<label for="rut"></label>
<input name="rut" type="text" class="campo rut" id="rut" />
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
<select id="cod_vendedor" name="cod_vendedor">
<?
$resultado=mysql_query("select id_vendedor,nombre from vendedor") or die(mysql_error());
while ($fila=mysql_fetch_array($resultado)){	
echo '<option>'.$fila["nombre"].'</option>'; 
}
?>
</select>
</div>

</div> <!--termina div columna 2-->

<p>Comentarios Cliente:</p> 
<textarea name="comentario_cliente" id="comentario_cliente" cols="45" rows="5"></textarea>

<div class="ingreso">
<?
$fecha_ingreso=date("d-m-Y");
?>
<p>Fecha de Emision Guía:</p>
<input id="fecha_ingreso" type="text" class="campo fecha" name="fecha_ingreso" id="fecha_ingreso" value="<? echo $fecha_ingreso?>"/>
</div>

<div class="ingreso">
<p>Tipo de Traslado:</p> 
<select id="tipo_traslado" name="tipo_traslado">
<option>Operación Constituye Venta</option>
<option>Ventas por Efectuar</option>
<option>Consignaciones</option>
<option>Entrega Gratuita</option>
<option>Traslados Internos</option>
<option>Otros Traslados (No Venta)</option>
<option>Guía de Devolución</option>
</select>
</div> 

<div class="ingreso">
<p>Nº Factura Relacionada:</p> 
<input name="factura_rel" type="text" class="campo" id="factura_rel" />
</div>

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
<td class="tabla" id="td_cantidad"><input id="cantidad" name="cantidad[]" type="number" class="tabla campo cantidad" onChange="subtotal_fila(),calculo_neto()"/></td>

<td class="tabla"><input id="codigo" name="codigo[]" type="text" class="tabla campo codigo"/></td>

<td class="tabla"><input name="n_serie[]" type="text" class="tabla campo"/></td>


<td class="tabla"><input id="precio_unitario" name="precio_unitario[]" type="text" class="tabla campo precio_unitario" onChange="subtotal_fila(),calculo_neto()"/></td>

<td class="tabla"><input id="descuento" name="descuento[]" type="text" class="tabla campo" onChange="subtotal_fila(),calculo_neto()" value="0%"/></td>
<td class="tabla"><input id="sub_total" name="precio_final[]"  type="text" class="tabla campo final" /></td> 
</tr>

</tbody>
</table>

<input id="agregar_fila" class="boton" type="button" value="Agregar Producto" />

<div id="totales" style="float:right;">
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

<div class="columna">
<p>Nombre de Contacto:</p>
<input name="nombre_contacto" class="campo" type="text" maxlength="30" placeholder="nombre, apellido."/>
</div>
<p>RUT de Contacto:</p>
<input name="rut_contacto" class="campo rut" type="text" maxlength="30"/>
<div class="linea"></div>

<h1 style="margin-top:0.5em;">Comentario Guía Despacho</h1>
<textarea id="comentario_guia" name="comentario_guia" placeholder="Datos Contacto, Sucursal de entrega , indicaciones anexas."></textarea>

<input id="id_factura" name="folio" type="hidden" value="<? echo $folio+1?>" class="oculto"/>

<input id="rojo" type="submit" class="boton_guardar boton_guardar_rojo" value="Emitir & Facturar"/>
<input id="azul" type="submit" class="boton_guardar" value="Emitir Guía" /> 

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
