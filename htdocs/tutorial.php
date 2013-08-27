<form name="subir_imagen" method="post" enctype="multipart/form-data">      	
	<input type="file" name="imagen"  /> <br />
	<input type="submit" name="botEnviarImagen" value="Subir Imagen" />          
</form>

<?php 
        if(isset($_POST["botEnviarImagen"])){
			$nameimagen = $_FILES['imagen']['name'];
			$tmpimagen = $_FILES['imagen']['tmp_name'];
			$extimagen = pathinfo($nameimagen);
			$ext = array("bmp","gif","jpg","png");
			$urlnueva = "imagenes/".md5($name . time()).'.'.$extimagen['extension'];
            
            
                if(is_uploaded_file($tmpimagen)){
                
                    if(array_search($extimagen['extension'],$ext)){
                    
                        copy($tmpimagen, $urlnueva);
        				echo '<img src="'.$urlnueva.'" /><br>';
                        echo "Tu imagen (URL): <a href='$urlnueva'>$urlnueva</a>";
                    }
                    
                    else {
                    
                        echo "Solo se permiten imagenes con formato bmp, jpg, gif o png<br>";
                        
                    }
                    
                }
                
                else {
                
                    echo "Selecciona una imagen.";
                    
                }
        
        }
?>