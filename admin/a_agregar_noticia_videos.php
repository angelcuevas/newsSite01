<?php
include("includes/db.inc.php");
include("includes/image.inc.php");
conectar();
if (!empty($_POST)){
	$directio = $config["videos"];
	$id = $_POST["id"];
	
	$nombre_video_final =  $id . "_" . date(time()) . ".flv";
	$nombre_video = $directio . $nombre_video_final;
	$descripcion = $_POST["descripcion"];
	
	if(!empty($_GET["y"])){
		$nombre_video_final = $_POST["video"];
		mysql_query("INSERT INTO noticias_videos(Id_noticia,url,tipo,descripcion) VALUES('$id','$nombre_video_final',0,'$descripcion')");
		header("Location: noticias.php?editar_id=".$id."&exito=agregar");
	}else
	{
		if(cargar_archivo("video",$nombre_video,"video/x-flv")){
			mysql_query("INSERT INTO noticias_videos(Id_noticia,url,tipo,descripcion) VALUES('$id','$nombre_video_final',1,'$descripcion')");
			header("Location: noticias.php?editar_id=".$id."&exito=agregar");
		}
		else{
			header("Location: noticias.php?editar_id=".$id."&exito=false");
		}
	}
}
else{
	header("Location: noticias.php");
}
desconectar();
?>