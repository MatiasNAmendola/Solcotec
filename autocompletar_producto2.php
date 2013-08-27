<?

//defino una clase que voy a utilizar para generar los elementos sugeridos en autocompletar
class ElementoAutocompletar {
	var $value;
	var $label;
	var $id;
	var $neto;
	var $nombre;
	var $codigo_producto;
	
	
	
	
	   
   function __construct($value,$label, $id, $neto, $nombre, $codigo_producto){
      $this->value = $value;
	  $this->label = $label;
	  $this->id= $id;
	  $this->neto = $neto;
	  $this->nombre = $nombre;
	  $this->codigo_producto = $codigo_producto;
	  
	  
   }
}

//recibo el dato que deseo buscar sugerencias
$datoBuscar = trim(strip_tags($_GET['term']));

include "php/conexion.php";

//busco un valor aproximado al dato escrito
$ssql = "select nombre, codigo_producto, neto, stock, id_producto from producto where nombre like '%" . $datoBuscar . "%'" or die(mysql_error());
$rs = mysql_query($ssql);

//creo el array de los elementos sugeridos
$arrayElementos = array();

//bucle para meter todas las sugerencias de autocompletar en el array
while ($fila = mysql_fetch_array($rs)){
array_push($arrayElementos, new ElementoAutocompletar($fila["nombre"],$fila["nombre"]." - Stock: [".$fila["stock"]."]", $fila["id_producto"],$fila["neto"],$fila["nombre"],$fila["codigo_producto"]));
}

print_r(json_encode($arrayElementos));

?>