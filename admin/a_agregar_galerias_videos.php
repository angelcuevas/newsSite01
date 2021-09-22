<?php
include("includes/db.inc.php");
include("includes/funciones.inc.php");
conectar();
if (!empty($_POST)){
	$directio = $config["videos_galerias"];
	$id = $_POST["id"];
	$id_video = $_POST["id_video"];
	$descripcion = $_POST["descripcion"];

	if(!isset($_POST["yt"]) or $_POST["yt"] == ""){
		/*
		$nombre_imagen_final =  $_FILES["video"]["name"];
		$nombre_imagen = $directio . $nombre_imagen_final;

		if(archivar("video",$nombre_imagen,"flv,mp4,3gp,mkv,mov,swf,avi")){
		
			if($id_video == 0){
				mysql_query("INSERT INTO galerias_videos(id_galeria,url,descripcion,tipo) VALUES('$id','$nombre_imagen_final','$descripcion',0)");
				echo mysql_error();
				header("Location: galerias_videos.php?editar_id=".$id."&exito=agregar&yt=false");
			}else{
				mysql_query("UPDATE galerias_videos SET url = '$nombre_imagen_final',descripcion = '$descripcion', tipo = 0 WHERE id_video = '$id_video'");
				header("Location: galerias_videos.php?editar_id=".$id."&exito=actualizar#titulo");
			}
		}else{
			if($id_video > 0){
				mysql_query("UPDATE galerias_videos SET descripcion = '$descripcion' WHERE id_video = '$id_video'");
				header("Location: galerias_videos.php?editar_id=".$id."&exito=actualizar#titulo");
			}else{
				header("Location: galerias_videos.php?editar_id=".$id."&exito=false");
			}
		}*/
		header("Location: galerias_videos.php?editar_id=".$id."&exito=false&err=Debe+escribir+el+codigo+de+un+video");
		die();
	}else{
		$yt = $_POST["yt"];
			if($id_video == 0){
				mysql_query("INSERT INTO galerias_videos(id_galeria,url,descripcion,tipo) VALUES('$id','$yt','$descripcion',1)");
				header("Location: galerias_videos.php?editar_id=".$id."&exito=agregar&yt=true");
			}else{
				mysql_query("UPDATE galerias_videos SET url = '$yt',descripcion = '$descripcion', tipo = 1 WHERE id_video = '$id_video'");
				header("Location: galerias_videos.php?editar_id=".$id."&exito=actualizar#titulo");
			}

	}
}
else{
		header("Location: galerias_videos.php?editar_id=".$id."&exito=null");
}
desconectar();
?>