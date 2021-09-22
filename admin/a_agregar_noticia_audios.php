<?php
include("includes/db.inc.php");
include("includes/image.inc.php");
conectar();
if (!empty($_POST)){
	$directio = $config["audios"];
	$id = $_POST["id"];
	$nombre_audio_final =  $id . "_" . date(time()) . ".mp3";
	$nombre_audio = $directio . $nombre_audio_final;
	$descripcion = $_POST["descripcion"];
	if(cargar_archivo("audio",$nombre_audio,"audio/mp3")){
		mysql_query("INSERT INTO noticias_audios(Id_Noticia,url,Descripcion) VALUES('$id','$nombre_audio_final','$descripcion')");
		header("Location: noticias.php?editar_id=".$id."&exito=agregar");
	}elseif(cargar_archivo("audio",$nombre_audio,"audio/mpeg")){
		mysql_query("INSERT INTO noticias_audios(Id_Noticia,url,Descripcion) VALUES('$id','$nombre_audio_final','$descripcion')");
		header("Location: noticias.php?editar_id=".$id."&exito=agregar");
	}
	else{
		header("Location: noticias.php?editar_id=".$id."&exito=false");
	}
}
else{
	header("Location: noticias.php");
}
desconectar();
?>