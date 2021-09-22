<?php
include("includes/db.inc.php");
include("includes/image.inc.php");
conectar();
if (!empty($_POST)){
	$directio = $config["imagenes"];
	$id = $_POST["id"];
	$nombre_imagen_final =  $id . "_" . date(time()) . ".jpg";
	$nombre_imagen = $directio . $nombre_imagen_final;
	$descripcion = $_POST["descripcion"];
	if(cargar_archivo("imagen",$nombre_imagen,"image/jpeg")){
		mysql_query("INSERT INTO noticias_fotos(Id_noticia,url,descripcion) VALUES('$id','$nombre_imagen_final','$descripcion')");
		header("Location: noticias.php?editar_id=".$id."&exito=agregar");
	}
	else{
		header("Location: noticias.php?editar_id=".$id."&exito=false&err=Formato+de+imagen+no+permitido");
	}
}
else{
	header("Location: noticias.php");
}
desconectar();
?>