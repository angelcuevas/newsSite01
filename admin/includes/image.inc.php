<?php
include("resize-class.php");
function cargar_archivo($nombre_campo,$nombre,$tipo,$multiple = FALSE){

	if($multiple == FALSE)
	{
		if($_FILES[$nombre_campo]['type']==$tipo){
			if($tipo == "image/jpeg"){
				
				thumbnail($_FILES[$nombre_campo]['tmp_name'], $nombre, false,false,80);

				// *** 1) Initialise / load image
				$resizeObj = new resize($nombre);
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> resizeImage(525, 268, 'crop');
				// *** 3) Save image
				$resizeObj -> saveImage($nombre. "_m.jpg", 75);
				
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> resizeImage(350, 233, 'crop');
				// *** 3) Save image
				$resizeObj -> saveImage($nombre. "_s.jpg", 75);
				
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> resizeImage(225, 126, 'crop');
				// *** 3) Save image
				$resizeObj -> saveImage($nombre. "_xs.jpg", 75);
								
				
				// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				$resizeObj -> resizeImage(467, 262, 'crop');
				// *** 3) Save image
				$resizeObj -> saveImage($nombre. "_l.jpg", 75);

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

	
	
}



function thumbnail($path, $save, $width,$height,$quality)
{
	$info = getimagesize($path);
	$size = array($info[0],$info[1]);

	if ($width === false) $width = $info[0];
	if ($height === false) $height = $info[1];
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
