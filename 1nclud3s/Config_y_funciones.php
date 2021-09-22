<?php

$config["db"]["usuario"]    = "joker";//prechi_db joker
$config["db"]["pass"]       = "whysoserious";//twm2GJC_aoX8 whysoserious
$config["db"]["host"]       = "angelcuevas.ddns.net";
$config["db"]["db_nombre"]  = "prechi_db";

include_once("db.inc.pdo.php");

$config["url"]["host"]        ="http://" .$_SERVER["SERVER_NAME"];
$config["url"]["urlImagenes"] = "http://angelcuevas.ddns.net/multimedia/imagenes/";  //$config["url"]["host"]."/multimedia/imagenes/";
$config["url"]["urlAudios"]   = $config["url"]["host"]."/multimedia/audios/";
$config["url"]["urlAdjuntos"] = $config["url"]["host"]."/multimedia/adjuntos/";
$config["url"]["urlNoticia"] = $config["url"]["host"]."/ver_noticia.php?id=";
$config["url"]["fbShare"]    = "https://www.facebook.com/sharer/sharer.php?u=".$config["url"]["host"]."/ver_noticia.php?id=";
$config["url"]["twShare"]    = "https://twitter.com/intent/tweet?url=".$config["url"]["host"]."/ver_noticia.php?id=";
$config["url"]["glShare"]    = "https://plus.google.com/share?url=".$config["url"]["host"]."/ver_noticia.php?id=";
$config["url"]["listados"]   = $config["url"]["host"]."/listado.php?id_categoria=";
$config["url"]["sublistados"]   = $config["url"]["host"]."/listado.php?id_subcategoria=";
$config["titulo"] = "Enfoque Directo";
$config["sitio"]["titulo"] = $config["titulo"];
$config["sitio"]["descripcion"] = "";
$config["sitio"]["keywords"] = "";
$config["meta"]["og:title"] = $config["sitio"]["titulo"];
$config["meta"]["og:url"] = $config["url"]["host"];
$config["meta"]["og:type"] = "website";
$config["meta"]["og:image"] = $config["url"]["host"] . "multimedia/imagenes/defaul.jpg";
$config["meta"]["author"] = "PabloRios.com.ar";
$config["paginacion"]["resultadosPorPagina"] = 5;

function multimediaListado( $multimedia = array(), $indiceArray ){

	$arrayMultimedia = array();

	foreach($multimedia as $key => $value):
	
		if( $multimedia[$key][$indiceArray] != NULL ):
		
			$arrayMultimedia[$key]["url"]         = $multimedia[$key][$indiceArray];
			$arrayMultimedia[$key]["id_noticia"]  = $multimedia[$key]["id_noticia"];
			
		endif;	
	
	endforeach;
	
	return $arrayMultimedia;

}





function mutimeNoticia( $multimedia = array(), $iDnoticias ){

	$urlArchivo="";

	foreach($multimedia as $listado_multimedia):
	
		if($listado_multimedia["id_noticia"] == $iDnoticias):
		
			$urlArchivo = $listado_multimedia["url"];
			
		endif;
		
	endforeach;

	return $urlArchivo;
}

function descripcionCategoria( $categoria = array(), $iDnoticias ){

	$descripcionCategoria="";

	foreach($categoria as $listado_categoria):
	
		if($listado_categoria["id_categoria"] == $iDnoticias):
		
			$descripcionCategoria = $listado_categoria["nombre"];
			
		endif;
		
	endforeach;

	return $descripcionCategoria;
}

function descripcionSubcategoria( $subcategoria = array(), $iDsubcategoria ){

	$descripcionSubcategoria="";

	foreach($subcategoria as $listado_subcategoria):
	
		if($listado_subcategoria["id_subcategoria"] == $iDsubcategoria):
		
			$descripcionSubcategoria = $listado_subcategoria["nombre"];
			
		endif;
		
	endforeach;

	return $descripcionSubcategoria;
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

function fechaDiaMes($fecha){
	$fecha = strtotime($fecha);
	$meses = array("ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC");
	$fechaDiaMes["dias"] =  date('d',$fecha);
	$fechaDiaMes["mes"] = $meses[date('n',$fecha)-1];
	return $fechaDiaMes;
}

function fecha_jorge_R($fecha){
   
  //$fecha = date("d/m/Y ",strtotime($fecha));
  
  $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
  
  return date('d',strtotime($fecha))." ".$meses[date('n',strtotime($fecha))-1];
	
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







function urls_amigables($url) {
 
      // Tranformamos todo a minusculas
 
	$url = sanear_string($url);
 
      $url = strtolower($url);
  
      // A񡤩mos los guiones
 
      $find = array(' ', '&', '\r\n', '\n', '+');
      $url = str_replace ($find, '-', $url);
 
	//$find = array('quot', '039' );
	//$url = str_replace ($find, '', $url);
 
      // Eliminamos y Reemplazamos otros car⤴eres especiales
 
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
