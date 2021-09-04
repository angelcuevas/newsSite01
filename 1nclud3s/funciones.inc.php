<?php

// $config["db"]["usuario"] = "root";
// $config["db"]["pass"] = "";
// $config["db"]["host"] = "localhost";
// $config["db"]["db_nombre"] = "www_infralarioja_gov_ar";
/*

$config["db"]["usuario"] = "root";
$config["db"]["pass"] = "123456";
$config["db"]["host"] = "localhost";
$config["db"]["db_nombre"] = "www_infralarioja_gov_ar";
*/

// include_once("database.php");

$config["sitio"]["host"] = "http://" .$_SERVER["SERVER_NAME"] . "/";
$config["sitio"]["noticia_url"] = $config["sitio"]["host"] . "ver_noticia.php?id=" . "{id}";

$config["titulo"] = "Ministerio de infraestructura";

$config["sitio"]["titulo"] = "Ministerio de infraestructura";
$config["sitio"]["descripcion"] = "Ministerio de infraestructura. Diseño y desarrollo: http://PabloRios.com.ar";
$config["sitio"]["keywords"] = "Ministerio,infraestructura,la,rioja";

$config["meta"]["og:title"] = $config["sitio"]["titulo"];
$config["meta"]["og:url"] = $config["sitio"]["host"];
$config["meta"]["og:type"] = "website";
$config["meta"]["og:image"] = $config["sitio"]["host"] . "multimedia/imagenes/defaul.jpg";
$config["meta"]["author"] = "PabloRios.com.ar";

$config["paginacion"]["resultadosPorPagina"] = 10;

$config["url"]["urlImagenes"] ="http://ecopolitico.com.ar/multimedia/imagenes/"
$config["url"]["urlAudios"] ="http://ecopolitico.com.ar/multimedia/audios/"
$config["url"]["urlSinElarchivo"] ="http://ecopolitico.com.ar/"
$config["url"]["urlNoticia"] ="http://ecopolitico.com.ar/ver_noticia.php?id="





function mutimeNoticia( $multimedia = array(), $iDnoticias ){

	$urlArchivo="";

	foreach($multimedia as $listado_multimedia):
	
		if($listado_multimedia["id_noticia"] == $iDnoticias):
		
			$urlArchivo = $listado_multimedia["url"];
			
		endif;
		
	endforeach;

	return $urlArchivo;
}


function fecha_pablo($fecha,$hora = FALSE){
  $fecha = strtotime($fecha);
  
  $meses = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
  if($hora){
  		return $dias[date('w',$fecha)]." ".date('d',$fecha)." de ".$meses[date('n',$fecha)-1]. " de ".date('Y',$fecha) . " | " . date("H:m",$fecha);
	}else{
  		return date('d',$fecha)." ".$meses[date('n',$fecha)-1]. " de ".date('Y',$fecha);
	}
}


function fecha($fecha,$hora = FALSE){
  $fecha = strtotime($fecha);
  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","S&aacute;bado");
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  if($hora){
  		return $dias[date('w',$fecha)]." ".date('d',$fecha)." de ".$meses[date('n',$fecha)-1]. " de ".date('Y',$fecha) . " " . date("H:m",$fecha);
	}else{
  		return $dias[date('w',$fecha)]." ".date('d',$fecha)." de ".$meses[date('n',$fecha)-1]. " de ".date('Y',$fecha);
	}
}






function fechaDiaMes($fecha,$hora = FALSE){
  $fecha = strtotime($fecha);
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  
  		
  		$fecha["dias"] = $date('d',$fecha); ;
		$fecha["mes"] = $meses[date('n',$fecha)-1];
		
		print_r($fecha);
		
		return 
}



function dma($fecha){
      $fecha = strtotime($fecha);
      return date("d/m/Y H:m:s",$fecha);
}

function dma_sin_hora($fecha){
      $fecha = strtotime($fecha);
      return date("d/m/Y",$fecha);
}

function limpiar($datos){
	$datos =  htmlentities($datos, ENT_QUOTES, "ISO-8859-1");
	return $datos;
}


function hace($fecha){
        $fecha = strtotime($fecha);
        $ahora=time();       

        if($ahora > $fecha){
          $segundos=$ahora-$fecha;
          $texto = "Hace ";
        }else{
          $segundos=$fecha-$ahora;
          $texto = "Faltan ";
        }
        
        $dias=floor($segundos/86400);
        $mod_hora=$segundos%86400;
        $horas=floor($mod_hora/3600);
        $mod_minuto=$mod_hora%3600;
        $minutos=floor($mod_minuto/60);
        
        if($horas<=0){
                return $texto . $minutos.' minutos';
        }elseif($dias<=0){
                return $texto . $horas.' horas '.$minutos.' minutos';
        }else{
                return $texto  . $dias.' dias '.$horas.' horas '.$minutos.' minutos';
        }
}

function archivar($nombre_campo,$nombre,$ext = FALSE){

    $fext = explode(".",$_FILES[$nombre_campo]["name"]);
    $fext = $fext[sizeof($fext) - 1];
    $ext = " " . $ext;
    
    if(empty($_FILES[$nombre_campo]['tmp_name'])){
      return FALSE;
    }
    
    if(!strpos($ext, $fext) and $ext){return FALSE;}

    move_uploaded_file($_FILES[$nombre_campo]['tmp_name'], $nombre);

    if(file_exists($nombre)){
      return true;       
    }else{
      return false;
    }
}



function clean_string($value){

	$result=htmlentities(trim($value),ENT_QUOTES);
	
	if($length>0 && strlen($result)>$length)
	
		$result=substr($result,0,$length);
		
	return $result;


}

function averiguaUrl() {
 // $protocolo = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http'; // Se extrae el protocolo (http o https)
 return $_SERVER['HTTP_HOST']; // Se devuelve la URL completa
}


function wordlimit($string, $length = 50, $ellipsis = "...")
{
    $words = explode(' ', $string);
    if (count($words) > $length)
    {
            return implode(' ', array_slice($words, 0, $length)) ." ". $ellipsis;
    }
    else
    {
            return $string;
    }
}



function validar_entero($variable){

	$variable = filter_var($variable, FILTER_SANITIZE_NUMBER_INT);

	if(filter_var($variable, FILTER_VALIDATE_INT) === false){
			$variable=0;
	}

	return $variable;
}





function sanear_string($string)
{

    $string = trim($string);

    $string = str_replace(
        array('à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    

    $string = str_replace(
        array( 'ç', 'Ç'),
        array( 'c', 'C'),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             ".", "="),
        '',
        $string
    );


    return $string;
}


function urls_amigables($url) {
 
      // Tranformamos todo a minusculas
 
	$url = sanear_string($url);
 
      $url = strtolower($url);
  
      // Añadimos los guiones
 
      $find = array(' ', '&', '\r\n', '\n', '+');
      $url = str_replace ($find, '-', $url);
 
	//$find = array('quot', '039' );
	//$url = str_replace ($find, '', $url);
 
      // Eliminamos y Reemplazamos otros carácteres especiales
 
      $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
 
      $repl = array('', '-', '');
 
      $url = preg_replace ($find, $repl, $url);
 
      return $url;
 
}

function diferenciaEntreFechaAcutalYFechaIngresada($fecha){

$fechaActual= strtotime('now') - strtotime($fecha) ;

$diferencia_dias=intval($fechaActual/60/60/24);

return $diferencia_dias;

}

?>