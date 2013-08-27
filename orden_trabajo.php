<?
include"php/valida.php";
date_default_timezone_set("Chile/Continental");
//echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/estructura.css" />
<link rel="stylesheet" href="css/smoothness/jquery-ui-1.9.2.custom.css" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<title>Orden de Trabajo</title>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js" ></script>
<script type="text/javascript">

$(document).ready(function(){


$('.boton_guardar').click(function(e) {

id=$('#id_orden').val();
window.open("../pdf_orden.php?id="+id,"Orden de Trabajo","toolbar=no","location=yes","status=yes","width=900","height=700");
});

$(function date() {
    $( "#fecha_documento" ).datepicker();
	$( "#fecha_ingreso" ).datepicker();
  });

$('*').keypress(function(e){

// Si la tecla presionada en la tecla enter
if (e.keyCode == 13){
return false;
}

});	


//-----------------------------------------------------	

$('.rut').Rut({
on_error: function(){ alert('Rut incorrecto'); },
format_on: 'keyup'
});


$('#nombre_cliente').autocomplete({
source: "autocompletar.php",
minLength: 2,
select: function(event, ui) {
$('#rut').val(ui.item.rut);
$('#telefono').val(ui.item.telefono);
$('#mail').val(ui.item.email);
$('#direccion').val(ui.item.direccion);
$('#giro').val(ui.item.giro);
$('#comuna').val(ui.item.comuna);
$('#cod_vendedor').val(ui.item.cod_vendedor);
$('#comentario_cliente').val(ui.item.comentario_cliente);
$('#n_serie').focus();

}//fin 
});//fin each



// boton Eliminar producto	
$(document).delegate('.deleteButton','click',function(){

var tete=$(this).closest('tr');
$(this).closest('tr').prev().prev().remove();
$(this).closest('tr').prev().remove();
$(this).closest('tr').remove();
$('#agregar_fila').css("display","block");

});//fin funcion delegate.



$(document).delegate('#agregar_fila','click',function()
{
var largo_tabla=$('#tabla_productos >tbody >tr').length;
if(largo_tabla<15){


$('#tabla_productos > tbody:last').append('<tr class="tr_sinfondo fila_descripcion"><td class="td_maquina">Nº Serie</td><td class="td_maquina">Descripción Máquina</td></tr><tr class="tr_sinfondo"><td class="tabla" id="td_cantidad"><input id="n_serie" name="n_serie[]" type="text" class="tabla campo cantidad" autofocus /></td><td class="tabla"><input id="descripcion_maquina" name="descripcion_maquina[]" type="text" class="tabla campo codigo"/></td></tr><tr class="tr_sinfondo fila_descripcion"><td class="td_maquina td_detalle">Observaciones</td><td colspan="4"><textarea id="observaciones" name="observaciones[]" type="text" class="tabla descripcion_maquina" placeholder="Detalle de problemas de la máquina, si trae accesorios, daños visibles, observaciónes en general."></textarea></td><td class="center td_botoneliminar" style="width:1%;"><input type="button" class="deleteButton boton" value="Eliminar" /></td></tr>');
}// fin if
if(largo_tabla==12){
$('#agregar_fila').css("display","none");
}// fin if
});// fin delegate 

});
</script>
</head>

<body>    

<div id="contenido">
<? echo $nav;?>

<header>  
<a id="cerrar" href="php/logout.php">Cerrar Sesión</a>   

<? echo $logo;?>

<a class="ninguno" href="../consulta_orden_trabajo.php"><div id="boton_gigante"><div id="interrogacion">?</div><div id="texto_botongrande">Ordenes<br/>Emitidas</div></div></a>
<a class="ninguno" href="consulta_maquinas_reparacion.php"><div id="boton_gigante" style="margin-right:1em; width:10.7em;"><div id="interrogacion">&curren;</div><div id="texto_botongrande">Máquinas<br/>Reparación</div></div></a>

</header>
<?
include "php/conexion.php";
$resultado=mysql_query("select max(id_ot) as folio from orden_trabajo") or die (mysql_error());
$fila=mysql_fetch_array($resultado);
$folio=$fila["folio"];
if($folio==''){
$folio=1000;
}

else{
$folio=$folio+1;
}

mysql_free_result($resultado);
?>

<h1>Orden de Trabajo [ <span style="color: #E1001D">FOLIO Nº <? echo $folio ?></span> ]</h1>
<h2>Aquí podrá generar un registro del ingreso de máquinas a reparar.</h2>

<form action="php/gestion_ot.php" method="post">

<div id="formulario">

<div class="columna">

<p>Nombre Cliente:</p> 
<label for="nombre_cliente"></label>
<textarea name="nombre_cliente" id="nombre_cliente" cols="45" rows="5" autofocus/></textarea>

<div class="ingreso">
<p>Rut:</p> 
<input name="rut" type="text" class="campo rut" id="rut" />
</div>

<div class="ingreso">
<p>Teléfono:</p> 
<label for="telefono"></label>
<input name="telefono" type="text" class="campo" id="telefono" />
</div>


<div class="ingreso">
<p>Email:</p> 
<label for="mail"></label>
<input type="email" id="mail" name="mail" placeholder="usuario@ejemplo.com" class="campo" />
</div>

</div> <!--termina div columna 1-->


<div class="columna">


<p>Dirección:</p> 
<label for="direccion"></label>
<textarea name="direccion" id="direccion" cols="45" rows="5" ></textarea>

<div class="ingreso">
<p>Comúna:</p> 
<label for="comuna"></label>
<input name="comuna" type="text" class="campo" id="comuna" placeholder="Santiago" />
</div>

<div class="ingreso">
<p>Giro Empresa:</p> 
<label for="giro"></label>
<textarea name="giro" id="giro" cols="45" rows="5"></textarea>
</div>



</div> <!--termina div columna 2-->

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


<div class="ingreso">
<p>Comentarios Cliente:</p> 
<label for="comentario_cliente"></label>
<textarea name="comentario_cliente" id="comentario_cliente" cols="45" rows="5"></textarea>
</div>

<div class="ingreso">
<?
$fecha_ingreso=date("d-m-Y");?>
<p>Fecha de Emision Orden:</p>

<input type="text" class="campo fecha" name="fecha_ingreso" id="fecha_ingreso" value="<? echo $fecha_ingreso ?>" />

</div>

<? include "../conexion.php";
$consulta="SELECT max(id_ot) as id_orden FROM orden_trabajo;";
$resultado=mysql_query($consulta, $conexion) or die (mysql_error());
$fila=mysql_fetch_array($resultado);
$id_orden=$fila["id_orden"];

if($id_orden==''){
$id_orden=1000;
}
else{
$id_orden=$id_orden+1;
}
?>

<input type="hidden" id="id_orden" value="<? echo $id_orden ?>" />
 
</div><!--fin div formulario-->

<h1>Identificación de Máquinas y Observaciónes</h1>
<div id="linea"></div>

<table id="tabla_productos">

<tbody>
            

<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina">Nº Serie</td><td class="td_maquina">Descripción Máquina</td>
</tr>

<tr class="tr_sinfondo"> 
<td class="tabla" id="td_cantidad"><input id="n_serie" name="n_serie[]" type="text" class="tabla campo cantidad"  /></td>

<td class="tabla"><input id="descripcion_maquina" name="descripcion_maquina[]" type="text" class="tabla campo codigo"/></td>


</tr>
<tr class="tr_sinfondo fila_descripcion">
<td class="td_maquina td_detalle">Observaciones</td>
<td colspan="4"><textarea id="observaciones" name="observaciones[]" type="text" class="tabla descripcion_maquina" placeholder="Detalle de problemas de la máquina, si trae accesorios, daños visibles, observaciónes en general."></textarea></td>

</tr>

</tbody>
</table>

<input id="agregar_fila" class="boton" type="button" value="Agregar Máquina" />
<div style="margin-bottom:0.5em;" class="linea_superior"></div>
<div class="columna">
<p>Nombre de Contacto:</p>
<input name="nombre_contacto" class="campo" type="text" maxlength="30" placeholder="nombre, apellido."/>
</div>
<p>RUT de Contacto:</p>
<input name="rut_contacto" class="campo rut" type="text" maxlength="30"/>
<div class="linea"></div>

<h1 style="margin-top:0.5em;">Comentarios</h1>
<textarea id="comentario_orden" name="comentario_orden" class="supertextarea" placeholder="Direccion de entrega, mails o teléfonos de contacto, otros comentarios"></textarea>


<input name="folio" type="hidden" value="<? echo $folio ?>" class="oculto"/>

<input type="submit" class="boton_guardar" value="Emitir Orden"/> 
     
</form>

<?
mysql_free_result($resultado);
include"php/cerrar_conexion.php";
?>
    
</div><!--fin totales-->
<div id="pie"></div>
<script type="text/javascript">
//VALIDACIÓN DE CAMPOS
$(document).ready(function () {
var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$("#boton_guardar").click(function (){
$(".error").remove();
if( $("#nombre_cliente").val() == "" ){
$("#nombre_cliente").focus().after("<span class='error'>Ingrese el nombre del cliente.</span>");
return false;
}else if( $("#rut").val() == ""){
$("#rut").focus().after("<span class='error'>Ingrese un rut.</span>");
return false;
}else if( $("#telefono").val() == "" ){
$("#telefono").focus().after("<span class='error'>Ingrese un teléfono de contacto.</span>");
return false;
}else if( $("#mail").val() == "" || !emailreg.test($("#mail").val()) ){
$("#mail").focus().after("<span class='error'>Ingrese un email correcto</span>");
return false;
}else if( $("#direccion").val() == "" ){
$("#direccion").focus().after("<span class='error'>Ingrese una dirección.</span>");
return false;
}else if( $("#comuna").val() == "" ){
$("#comuna").focus().after("<span class='error'>Ingrese la comuna.</span>");
return false;
}else if( $("#giro").val() == "" ){
$("#giro").focus().after("<span class='error'>Falto ingresar el giro del cliente.</span>");
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

</script>
</body>
</html>
