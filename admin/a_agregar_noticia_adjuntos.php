<?php
include("includes/db.inc.php");
include("includes/funciones.inc.php");
conectar();

echo "<pre>";
print_r($_FILES);
echo "</pre>";

function extension($str) {
    return end(explode(".", $str));
}

$exten = extension($_FILES["imagen"]["name"]);

if (!empty($_POST)){
	$directio = $config["adjuntos"];
	$id = $_POST["id"];
	$nombre_imagen_final =  $id . "_" . date(time()) . "." . $exten;
	$nombre_imagen = $directio . $nombre_imagen_final;
	$descripcion = $_POST["descripcion"];
	if(archivar("imagen",$nombre_imagen,",doc,pdf,docx")){
		mysql_query("INSERT INTO noticias_adjuntos(id_noticia,url,descripcion) VALUES('$id','$nombre_imagen_final','$descripcion')");
		echo "bien";
		header("Location: noticias.php?editar_id=".$id."&exito=agregar");
	}
	else{
		header("Location: noticias.php?editar_id=".$id."&exito=false&err=Formato+no+permitido");
		echo "mal";
	}
}
else{
	header("Location: noticias.php");
}

desconectar();
?>