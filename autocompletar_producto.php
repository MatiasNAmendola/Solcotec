<?

//defino una clase que voy a utilizar para generar los elementos sugeridos en autocompletar
class ElementoAutocompletar {
	var $value;
	var $label;
	var $id_producto;
	var $codigo_producto;
	var $p_venta;
	var $nombre;
	
	
	
	   
   function __construct($label, $value, $id_producto,$codigo_producto, $p_venta, $nombre ){
      $this->label = $label;
      $this->value = $value;
	  $this->id_producto = $id_producto;
	  $this->codigo_producto = $codigo_producto;
	  $this->p_venta = $p_venta;
	  $this->nombre = $nombre;
	  
	  
   }
}

//recibo el dato que deseo buscar sugerencias
$datoBuscar = trim(strip_tags($_GET['term']));

include "php/conexion.php";


//busco un valor aproximado al dato escrito
$ssql = "select id_producto,codigo_producto, p_venta, nombre , stock  from producto where nombre like '%" . $datoBuscar . "%'" or die(mysql_error());
$rs = mysql_query($ssql);

//creo el array de los elementos sugeridos
$arrayElementos = array();

//bucle para meter todas las sugerencias de autocompletar en el array
while ($fila = mysql_fetch_array($rs)){
array_push($arrayElementos, new ElementoAutocompletar($fila["nombre"]." - Stock: [".$fila["stock"]."]",$fila["nombre"],$fila["id_producto"],$fila["codigo_producto"],$fila["p_venta"]));
}

print_r(json_encode($arrayElementos));

?>