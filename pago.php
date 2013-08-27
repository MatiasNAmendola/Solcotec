<?
include"php/valida.php";

include "php/conexion.php";
$id_factura=$_POST['id'];

$resultado=mysql_query("select * from factura_venta where id_fv='$id_factura';"); //captura todos los datos de factura.
$datos_factura=mysql_fetch_array($resultado);
$id_vendedor=$datos_factura["id_vendedor"];

$resultado2=mysql_query("select nombre from vendedor where id_vendedor='$id_vendedor'; "); //captura el
$fila2=mysql_fetch_array($resultado2);
$nombre_vendedor=$fila2["nombre"];
mysql_free_result($resultado2);

$id_cliente=$datos_factura["id_cliente"];
$resultado3=mysql_query("select * from cliente where id_cliente='$id_cliente';");
$fila3=mysql_fetch_array($resultado3);

$resultado4=mysql_query("select producto.codigo_producto,factura_x_producto.detalle, factura_x_producto.cantidad, factura_x_producto.precio_venta, factura_x_producto.precio_final, factura_x_producto.descuento, factura_x_producto.id_producto, factura_x_producto.detalle, factura_x_producto.id_fv, factura_x_producto.n_serie from factura_x_producto, producto where factura_x_producto.id_fv='$id_factura' AND producto.id_producto=factura_x_producto.id_producto;") or die (mysql_error());

$resultado5=mysql_query("SELECT * FROM pago WHERE id_factura='$id_factura';") or die (mysql_error());
$datos_pago=mysql_fetch_array($resultado5);
?>

<!DOCTYPE HTML>
<html lang="es"> <!--la indexacion es mas rapida-->
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/estructura.css" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Pagos</title>

<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js" ></script>

<script type="text/javascript">


//VALIDACIÓN DE CAMPOS
$(document).ready(function () {
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
$("#doc").focus().after("<div class='error'>Ingrese el folio del documento relacionado.</div>");
return false;
}else if( $("#giro").val() == "" ){
$("#giro").focus().after("<span class='error'>Falto ingresar el giro del cliente.</span>");
return false;
}else if( $("#comuna").val() == "" ){
$("#comuna").focus().after("<span class='error'>Ingrese la comuna.</span>");
return false;
}
});
$("#nombre_cliente, #rut, #telefono").keyup(function(){
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


$(function date() {
    $( "#fecha_documento" ).datepicker();
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


    
<form action="php/insert_pago.php" method="post">

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
<p>SUB TOTAL :</p><input id="total_neto" name="total_neto" class="campo" value="<? echo $datos_factura['total_neto']?>"readonly/>
</div>

<div class="ingreso">
<p>DESCUENTO X FACTURA :</p><input id="porcentaje_descuento" name="porcentaje_descuento" class="campo" value="<? echo $datos_factura['porcent_fact']?>"/>
</div>

<div class="ingreso">
<p>NETO:</p><input id="total_descuento"  name="total_descuento" class="campo" value="<? echo $datos_factura['total_descuento']?>" readonly/>
</div>

<div class="ingreso">
<p>IVA (19%) :</p><input id="total_iva" name="total_iva" class="campo" value="<? echo $datos_factura['total_iva']?>" readonly/>
</div>

<div class="ingreso">
<p>TOTAL FINAL :</p><input id="total_final" name="total_final" class="campo" style="font-weight:bolder" readonly onChange="compara()" value="<? echo $datos_factura['total_final']?>"/>
</div>


</div><!--fin totales-->
<input type="hidden" value="<? echo $id_cliente?>" name="id_cliente"/>
<input type="hidden" value="<? echo $id_factura?>" name="id_factura"/>
<input type="submit" class="boton_guardar" value="Pagar"/>
</form>
  
<h1 style="clear:both;">Factura de Venta Emitida [ <strong style="color:#CC0000">FOLIO Nº <? echo $datos_factura["folio"] ?></strong> ]</h1>
<h2>A continuación se muestra el detalle de la factura emitida.</h2>

<div id="formulario">

<div class="columna">

<div class="ingreso">
<p>Nombre Cliente:</p> 
<textarea name="nombre_cliente" id="nombre_cliente" cols="45" rows="5" readonly/><? echo $fila3["nombre_cliente"] ?></textarea>
</div>

<div class="ingreso">
<p>Rut:</p> 
<input name="rut" type="text" class="campo" id="rut" value="<? echo $fila3["rut"] ?>" readonly/>
</div>

<div class="ingreso">
<p>Teléfono:</p> 
<input name="telefono" type="text" class="campo" id="telefono"  value="<? echo $fila3["telefono"] ?>"readonly="readonly"/>
</div>


<div class="ingreso">
<p>Email:</p> 
<input type="email" id="mail" name="mail" placeholder="usuario@ejemplo.com" class="campo" value="<? echo $fila3["mail"] ?>"readonly="readonly"/>
</div>





</div> <!--termina div columna 1-->


<div class="columna">

<div class="ingreso">
<div class="ingreso">
<p>Dirección:</p> 
<textarea name="direccion" id="direccion" cols="45" rows="5" readonly><? echo $fila3["direccion"] ?></textarea>
</div>

<p>Comúna:</p> 
<input name="comuna" type="text" class="campo" id="comuna" placeholder="Santiago" value="<? echo $fila3["comuna"] ?>" readonly/>
</div>

<div class="ingreso">
<p>Giro Empresa:</p> 
<textarea name="giro" id="giro" cols="45" rows="5" readonly><? echo $fila3["giro"] ?></textarea>
</div>

<div class="ingreso">
<p>Vendedor Asignado:</p> 
<select name="nombre_vendedor" id="nombre_vendedor" disabled="disabled">
<option><? echo $nombre_vendedor;?></option>
</select>
</div>




</div> <!--termina div columna 2-->

<div class="ingreso">
<p>Comentarios Cliente:</p> 
<textarea name="comentario_cliente" id="comentario_cliente" cols="45" rows="5" readonly><? echo $fila3["comentario_cliente"] ?></textarea>
</div>	

<? //  DA VUELTA LA FECHA QUE VIENE DE LA BD.
$fecha=$datos_factura["fecha"];
$nuevafecha = date('d-m-Y', strtotime($fecha));// da vuelta la fecha para ser valida BD 
?>

<div class="ingreso">
<p>Fecha de Emisión Factura:</p> 
<input name="fecha_ingreso" type="text" id="fecha_ingreso" class="campo" value="<? echo $nuevafecha?>" readonly/>
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
<select id="tipo_documento" name="tipo_documento" disabled="disabled">
<option selected><? echo $tipo_documento?></option>
<option><? echo $otro?></option>
</select>
</div> 
<div class="ingreso">
<input type="text" id="doc" name="documento_rel" placeholder="# del documento" class="campo" value="<? echo $datos_factura["documento_rel"]?>" readonly/>
</div>

</div><!--fin div formulario-->


<table id="tabla_productos">
<tbody>
<?
while ($fila4=mysql_fetch_array($resultado4))
{
?>

<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina td_detalle">Detalle</td>
<td colspan="5"><textarea id="detalle" name="detalle[]" type="text" class="tabla descripcion_maquina" placeholder="busca aquí..." readonly><? echo $fila4['detalle']?></textarea></td>
</tr>

<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina">Cant.</td><td class="td_maquina">Código</td><td class="td_maquina">Nº Serie</td><td class="td_maquina">V.Unitario</td><td class="td_maquina">Desc.</td><td class="td_maquina">Final</td>
</tr>

<tr class="tr_sinfondo"> 
<td class="tabla" id="td_cantidad"><input id="cantidad" name="cantidad[]" type="number" class="tabla campo cantidad" onChange="subtotal_fila(),calculo_neto()" value="<? echo $fila4['cantidad']?>" readonly/></td>

<td class="tabla"><input id="codigo" name="codigo[]" type="text" class="tabla campo codigo" value="<? echo $fila4['codigo_producto']?>" readonly/></td>

<td class="tabla"><input name="n_serie[]" type="text" class="tabla campo" value="<? echo $fila4['n_serie']?>" readonly/></td>


<td class="tabla"><input id="precio_unitario" name="precio_unitario[]"    type="text"   class="tabla campo precio_unitario" onChange="subtotal_fila(),calculo_neto()" value="<? echo $fila4['precio_venta']?>" readonly/></td>

<td class="tabla"><input id="descuento" name="descuento[]" type="text" class="tabla campo" onChange="subtotal_fila(),calculo_neto()" value="<? echo $fila4['descuento']?>" readonly/></td> 

<td class="tabla"><input id="sub_total" name="precio_final[]"  type="text" class="tabla campo final" value="<? echo $fila4['precio_final']?>" readonly/></td> 
</tr>
<?
}
?> 

</tbody>
</table>
<p>COMENTARIO FACTURA:</p>
<textarea id="comentario_factura" name="comentario_factura" class="supertextarea" placeholder="ingrese un comentario sobre la factura." readonly><? echo $datos_factura["comentario_factura"]?></textarea>

<?
mysql_free_result($resultado3);
mysql_free_result($resultado4);
mysql_free_result($resultado);
include"php/cerrar_conexion.php";
?>
</div><!--fin contenido-->

<div id="pie"></div>
</body>
</html>