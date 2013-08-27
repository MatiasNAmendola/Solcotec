<?
include"php/valida.php";
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/estructura.css" type="text/css" media="all" title="" />
<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" />
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js" ></script>
<title>Ingreso de Clientes</title>

<script type="text/javascript">
$(document).ready(function(){

$('*').keypress(function(e){
// Si la tecla presionada en la tecla enter
if (e.keyCode == 13){
return false;
}
});

	
$('#rut').Rut({
  on_error: function(){ alert('Rut incorrecto'); },
  format_on: 'keyup'
});

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
});


});// fin ready


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

        <h1>Ingreso de Nuevos Clientes</h1>
    	<h2>Aquí podrá ingresar toda la información referente a un nuevo cliente.</h2>
<div id="formulario">
<form  action="php/insert_cliente.php" method="post" enctype="application/x-www-form-urlencoded" name="datos" accept-charset="utf8">
  
  <div class="columna">
  
<p>Nombre Cliente:</p> 
<label for="nombre_cliente"></label>
<textarea name="nombre_cliente" id="nombre_cliente"  autofocus></textarea>


<div class="ingreso">
<p>Rut:</p> 
<label for="rut"></label>
<input name="rut" type="text" class="campo" id="rut" value=""  />
</div>

<div class="ingreso">
<p>Teléfono:</p> 
<label for="telefono"></label>
<input name="telefono" type="text" class="campo" id="telefono" value="" />
</div> 

<div class="ingreso">
<p>Email:</p> 
<label for="direccion"></label>
<input type="email" id="mail" name="mail" placeholder="usuario@ejemplo.com" class="campo"/>
</div>    
       
       
       
</div> <!--termina div columna 1-->
              
<div class="columna">
  
<p>Dirección:</p> 
<label for="direccion"></label>
<textarea name="direccion" id="direccion"  ></textarea>


<div class="ingreso">
<p>Comúna:</p> 
<label for="comuna"></label>
<input name="comuna" type="text" class="campo" id="comuna" value="Santiago"/>
</div>

<div class="ingreso">
<p>Giro:</p> 
<label for="giro"></label>
<textarea name="giro" id="giro"  ></textarea>
</div>



    
    
         </div> <!--termina div columna 2-->

  
<div class="ingreso">
<p>Vendedor Asignado:</p> 
<label for="cod_vendedor"></label>

<?
include "php/conexion.php";
echo '<select name="nombre_vendedor" id="nombre_vendedor">';
$resultado=mysql_query("select id_vendedor,nombre from vendedor") or die("caca");
while ($fila=mysql_fetch_array($resultado)){	
echo '<option>'.$fila["nombre"].'</option>'; 
}
echo '</select>';
?>
</div>

<p>Comentarios Cliente:</p> 
<label for="comentario_cliente"></label>
<textarea name="comentario_cliente" id="comentario_cliente"  value=""></textarea>

</div><!--fin div formulario-->

<!--Boton guardar Datos-->
<input type="submit"  class="boton_guardar"   value="Guardar Datos" /> 
<input type="hidden" value="" onClick="php/insert_cliente.php"  class="oculto"/>

  </form>
    

   </div><!--fin div contenido-->
</body>
</html>
