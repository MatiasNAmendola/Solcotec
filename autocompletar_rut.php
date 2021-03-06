<?

//defino una clase que voy a utilizar para generar los elementos sugeridos en autocompletar
class ElementoAutocompletar {
	var $value;
	var $label;
	var $id_cliente;
	var $nombre_cliente;
	var $telefono;
	var $direccion;
	var $giro;
	var $comuna;
	var $cod_vendedor;
	var $comentario_cliente;
	var $email;
	var $bloqueado;
   
   function __construct($label, $value, $id_cliente, $nombre_cliente, $telefono, $direccion, $giro, $comuna, $cod_vendedor, $comentario_cliente, $email, $bloqueado){
      $this->label = $label;
      $this->value = $value;
	  $this->id_cliente = $id_cliente;
	  $this->nombre_cliente = $nombre_cliente;
	  $this->telefono = $telefono;
	  $this->direccion = $direccion;
	  $this->giro = $giro;
	  $this->comuna = $comuna;
	  $this->cod_vendedor = $cod_vendedor;
	  $this->comentario_cliente = $comentario_cliente;
	  $this->email = $email;
	  $this->bloqueado = $bloqueado;
   }
}

//recibo el dato que deseo buscar sugerencias
$datoBuscar = trim(strip_tags($_GET['term']));

include "php/conexion.php";

//busco un valor aproximado al dato escrito
$ssql = "select cliente.id_cliente, cliente.nombre_cliente, cliente.rut, cliente.telefono, cliente.direccion, cliente.giro, cliente.comuna, vendedor.nombre, cliente.comentario_cliente, cliente.mail, cliente.bloqueado from cliente,vendedor where cliente.rut like '%" .$datoBuscar. "%' and vendedor.id_vendedor = cliente.id_vendedor ;";
$rs = mysql_query($ssql);


//creo el array de los elementos sugeridos
$arrayElementos = array();

//bucle para meter todas las sugerencias de autocompletar en el array
while ($fila = mysql_fetch_array($rs)){
	
   array_push($arrayElementos, new ElementoAutocompletar($fila["nombre_cliente"], $fila["rut"],$fila["id_cliente"],$fila["nombre_cliente"],$fila["telefono"],$fila["direccion"],$fila["giro"],$fila["comuna"],$fila["nombre"],$fila["comentario_cliente"],$fila["mail"],$fila["bloqueado"]));
}

print_r(json_encode($arrayElementos));
include "php/cerrar_conexion.php";
?>