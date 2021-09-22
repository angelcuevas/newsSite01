<?php
include_once("includes/db.inc.php");
include_once("includes/image.inc.php");
conectar();
if (!empty($_POST)){
	$directio = $config["imagenes_galerias"];
	$id = $_POST["id"];
	$id_foto = $_POST["id_foto"];
	$nombre_imagen_final =  $id . "_" . date(time()) . ".jpg";
	$nombre_imagen = $directio . $nombre_imagen_final;
	$descripcion = $_POST["descripcion"];
	

	$especiales = una_consulta("SELECT nombre,width,width_m,height,height_m FROM galerias_especiales WHERE id_galeria = '$id' LIMIT 1");
	$procesado = false;
	if(!empty($especiales)){
		if($especiales["width"] == 0) $especiales["width"] = false;
		if($especiales["height"] == 0) $especiales["height"] = false;
		if($especiales["width_m"] == 0) $especiales["width_m"] = false;
		if($especiales["height_m"] == 0) $especiales["height_m"] = false;

		$procesado = thumbnail($_FILES["imagen"]['tmp_name'], $nombre_imagen, $especiales["width"],$especiales["height"],false);
			if($procesado) thumbnail($_FILES["imagen"]['tmp_name'], $nombre_imagen . "_t.jpg", $especiales["width_m"],$especiales["height_m"],80);
	}else{
		$procesado = cargar_archivo("imagen",$nombre_imagen,"image/jpeg");
	}

	if($procesado){
		if($id_foto == 0){
			mysql_query("INSERT INTO galerias_fotos(id_galeria,url,descripcion) VALUES('$id','$nombre_imagen_final','$descripcion')");
		header("Location: galerias_imagenes.php?editar_id=".$id."&exito=agregar");
		}else{
			mysql_query("UPDATE galerias_fotos SET url = '$nombre_imagen_final',descripcion = '$descripcion' WHERE id_foto = '$id_foto'");
		header("Location: galerias_imagenes.php?editar_id=".$id."&exito=actualizar#titulo");
		}
	}else{
		if($id_foto > 0){
			mysql_query("UPDATE galerias_fotos SET descripcion = '$descripcion' WHERE id_foto = '$id_foto'");
			header("Location: galerias_imagenes.php?editar_id=".$id."&exito=actualizar#titulo");
		}
	}
}
else{
		header("Location: galerias_imagenes.php");
}
desconectar();
?>