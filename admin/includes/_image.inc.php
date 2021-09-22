<?php

include_once("config.inc.php");

function cargar_archivo($nombre_campo,$nombre,$tipo,$multiple = FALSE){
	global $config;
	if($multiple == FALSE)
	{
		if($_FILES[$nombre_campo]['type']==$tipo){
			if($tipo == "image/jpeg"){
				thumbnail($_FILES[$nombre_campo]['tmp_name'], $nombre, false,false,80);
				thumbnail($_FILES[$nombre_campo]['tmp_name'], $nombre . "_t.jpg" , $config["miniatura_width"],$config["miniatura_height"],$config["imagenes_calidad"]);
			}
			else{
			move_uploaded_file($_FILES[$nombre_campo]['tmp_name'], $nombre);
			}
			if(file_exists($nombre))
				return true;
			else
				return false;
		}
			else{
			return false;
		}
	}
	else{
		/* //MULTIPLES ARCHIVOS (ARREGLAR)
		foreach ($FILES[$nombre_campo] as $key => $value) {
			if($_FILES[$nombre_campo][$key]['type']=="image/jpeg"){
					thumbnail($_FILES[$nombre_campo][$key]['tmp_name'], "yei.jpg", false,false,"80");
			}
		}
		return $nombres;
		*/
	}

}
function thumbnail($path, $save, $width,$height,$quality)
{
	$info = getimagesize($path);
	$size = array($info[0],$info[1]);

	if ($width === false) $width = $info[0];
	if ($height === false) $height = $info[1];
	if ($quality === false) $quality = 80;
	//if ($info[0] < 1024)  $width = $info[0];
	//if ($info[1] < 800)  $height = $info[1];

	if($info['mime'] == 'image/png')
	{
			$src = imagecreatefrompng($path);
	}
	else
		if($info['mime'] == 'image/jpeg')
		{
				$src = imagecreatefromjpeg($path);
		}
		else
			if($info['mime'] == 'image/gif')
			{
				$src = imagecreatefromgif($path);
			}
			else
				return false;
	$thumb = imagecreatetruecolor($width, $height);
	$src_aspect = $size[0] / $size[1];
	$thumb_aspect = $width / $height;
	if($src_aspect < $thumb_aspect)
	{	
		//estirada
		$scale = $width / $size[0];
		$new_size = array($width, $width / $src_aspect);
		$src_position = array(0, ($size[1] * $scale - $height ) / $scale / 2);
	}else
		if($src_aspect > $thumb_aspect)
		{
			//ancha
			$scale = $height / $size[1];
			$new_size = array($height * $src_aspect, $height);
			$src_position = array(($size[0] * $scale - $width ) / $scale / 2,0);
		}
		else
			//misma figura
			{
				$new_size = array($width,$height);
				$src_position = array(0,0);
			}
	$new_size[0] = max($new_size[0],1);
	$new_size[1] = max($new_size[1],1);
	imagecopyresampled($thumb, $src, 0, 0, $src_position[0], $src_position[1], $new_size[0], $new_size[1], $size[0], $size[1]);

	if ($save === false)
	{
		return imagejpeg($thumb,NULL,$quality);
	}
	else
	{
		return imagejpeg($thumb,$save,$quality);
	}
}

?>