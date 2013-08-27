<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Prueba Dinamica</title>

<style>




table,td{
	
	border:0.1em solid black;
	height:10em;
	width:20em;}




</style>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.20.custom.min.js"></script>

<script type="text/javascript">


$(document).delegate('#agregar_fila','click',function()
{
var largo_tabla=$('#tabla_productos >tbody >tr').length;
if(largo_tabla<10){

$('#tabla_productos > tbody:last').append('<tr><td><input type="text" name="1[]" /></td><td><input type="text" name="2[]" /></td><td><input type="text" name="3[]" /></td></tr>');
}// fin if
/*$(this).closest("tr").clone(true).appendTo("#tabla_productos");*/
if(largo_tabla==9){
$('#agregar_fila').css("display","none");
}// fin if
});// fin delegate 





</script>
</head>

<body>
<form action="dinamica.php" method="post">

<table id="tabla_productos">



<thead>
<tr>
<th>azul</th>
<th>rojo</th>
<th>verde</th>
</tr>
</thead>

<tbody>
<tr>
<td><input type="text" name="uno[]" /></td>
<td><input type="text" name="dos[]" /></td>
<td><input type="text" name="tres[]" /></td>
<td><input type="text" name="tres[]" /></td>
<td><input type="text" name="tres[]" /></td>
<td><input type="text" name="tres[]" /></td>
</tr>

<tr>
<td><input type="text" name="uno[]" /></td>
<td><input type="text" name="dos[]" /></td>
<td><input type="text" name="tres[]" /></td>
<td><input type="text" name="tres[]" /></td>
<td><input type="text" name="tres[]" /></td>
<td><input type="text" name="tres[]" /></td>
</tr>
</tbody>


</table>

<input type="button" id="agregar_fila" value="agregar fila"/>
<input type="submit" />

</form>
</body>
</html>