<?


if(isset($_POST["botonSubirImagen"])){
$nameimagen = $_FILES['imagen']['name'];
$tmpimagen = $_FILES['imagen']['tmp_name'];
$extimagen = pathinfo($nameimagen);
$ext = array("bmp","gif","jpg","png");
$urlnueva = "imagenes/".md5($name . time()).'.'.$extimagen['extension'];

            
if(is_uploaded_file($tmpimagen)){

if(array_search($extimagen['extension'],$ext)){

copy($tmpimagen, $urlnueva);
echo '<img src="'.$urlnueva.'" /><br>';
}

else {

echo "Solo se permiten imágenes con formato bmp, jpg, gif o png<br>";

}

}

else {

echo "Selecciona una imagen.";

}

}
?>