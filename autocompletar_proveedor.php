<?

//defino una clase que voy a utilizar para generar los elementos sugeridos en autocompletar
class ElementoAutocompletar {
	var $value;
	var $label;
	var $rut;
	var $telefono;
	var $email;
	var $direccion;
	var $giro;
	var $comuna;
	var $vendedor_asignado;
	var $comentario;
	
   
   function __construct($label, $value, $rut, $telefono, $email, $direccion, $giro, $comuna, $vendedor_asignado, $comentario){
      $this->label = $label;
      $this->value = $value;
	  $this->rut = $rut;
	  $this->telefono = $telefono;
	  $this->email = $email;
	  $this->direccion = $direccion;
	  $this->giro = $giro;
	  $this->comuna = $comuna;
	  $this->vendedor_asignado = $vendedor_asignado;
	  $this->comentario = $comentario;
	  
   }
}

//recibo el dato que deseo buscar sugerencias
$datoBuscar = trim(strip_tags($_GET['term']));

include "php/conexion.php";

//busco un valor aproximado al dato escrito
$ssql = "select proveedor.nombre, proveedor.rut, proveedor.direccion, proveedor.giro, proveedor.comuna, proveedor.telefono, proveedor.mail, proveedor.comentario, proveedor.vendedor_asignado from proveedor where nombre like '%".$datoBuscar."%';";
$rs = mysql_query($ssql);

//creo el array de los elementos sugeridos
$arrayElementos = array();

//bucle para meter todas las sugerencias de autocompletar en el array
while ($fila = mysql_fetch_array($rs)){
	
   array_push($arrayElementos, new ElementoAutocompletar($fila["nombre"], $fila["nombre"],$fila["rut"],$fila["telefono"],$fila["mail"],$fila["direccion"],$fila["giro"],$fila["comuna"],	$fila["vendedor_asignado"],$fila["comentario"]));
}

print_r(json_encode($arrayElementos));
include "php/cerrar_conexion.php";

?>