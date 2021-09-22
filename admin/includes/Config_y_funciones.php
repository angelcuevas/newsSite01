<?php

$nombreDelArchivo = basename($_SERVER["PHP_SELF"]);

// /*

$config["db"]["usuario"]    = "joker";//prechi_db
$config["db"]["pass"]       = "whysoserious";//twm2GJC_aoX8
$config["db"]["host"]       = "angelcuevas.ddns.net";
$config["db"]["db_nombre"]  = "prechi_db";




$config["url"]["host"]              ="http://" .$_SERVER["SERVER_NAME"]."/infra";
$config["url"]["urlImagenes"]       = $config["url"]["host"]."/multimedia/imagenes/";
$config["url"]["imagenes_galerias"] = $config["url"]["host"]."/multimedia/imagenes/galerias/";
$config["url"]["urlAudios"]         = $config["url"]["host"]."/multimedia/audios/";
$config["url"]["audios_galerias"]   = $config["url"]["host"]."/multimedia/audios/galerias/";
$config["url"]["urlAdjuntos"]       = $config["url"]["host"]."/multimedia/adjuntos/";
$config["url"]["urlNoticia"]        = $config["url"]["host"]."/ver_noticia.php?id=";
$config["url"]["listados"]          = $config["url"]["host"]."/listado.php?id_categoria=";
$config["url"]["sublistados"]       = $config["url"]["host"]."/listado.php?id_subcategoria=";
$config["url"]["fbShare"]           = "https://www.facebook.com/sharer/sharer.php?u=".$config["url"]["host"]."/ver_noticia.php?id=";
$config["url"]["twShare"]           = "https://twitter.com/intent/tweet?url=".$config["url"]["host"]."/ver_noticia.php?id=";
$config["url"]["glShare"]           = "https://plus.google.com/share?url=".$config["url"]["host"]."/ver_noticia.php?id=";

$config["titulo"] = "";
$config["sitio"]["titulo"] = $config["titulo"];
$config["sitio"]["descripcion"] = "";
$config["sitio"]["keywords"] = "";

$config["meta"]["og:title"] = $config["sitio"]["titulo"];
$config["meta"]["og:url"] = $config["url"]["host"];
$config["meta"]["og:type"] = "website";
$config["meta"]["og:image"] = $config["url"]["host"] . "multimedia/imagenes/defaul.jpg";
$config["meta"]["author"] = "PabloRios.com.ar";
$config["paginacion"]["resultadosPorPagina"] = 10;

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


/////////////////////////////////////////////////////////////////////
///////////////////  Inyeccion SQL  /////////////////////////////////
/////////////////////////////////////////////////////////////////////


function filterXSS($val){
        // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
        // this prevents some character re-spacing such as <java\0script>
        // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
        
		$val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);
 
        // straight replacements, the user should never need these since they're normal characters
        // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29>
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search .= '1234567890!@#$%^&*()';
        $search .= '~`";:?+/={}[]-_|\'\\';
        for ($i = 0; $i < strlen($search); $i++) {
            // ;? matches the ;, which is optional
            // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
 
            // &#x0040 @ search for the hex values
            $val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
            // &#00064 @ 0{0,7} matches '0' zero to seven times
            $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
        }
 
        // now the only remaining whitespace attacks are \t, \n, and \r
        $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
        $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
        $ra = array_merge($ra1, $ra2);
 
        $found = true; // keep replacing as long as the previous round replaced something
        while ($found == true) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                    if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
                        $pattern .= '|(&#0{0,8}([9][10][13]);?)?';
                        $pattern .= ')?';
                }
                $pattern .= $ra[$i][$j];
             }
             $pattern .= '/i';
             $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
             $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
             if ($val_before == $val) {
                // no replacements were made, so exit the loop
                $found = false;
             }
          }
        }
 
        return $val;
    }
 
 
foreach($_GET as $variable=>$valor)
{
   $_GET[$variable] = str_replace("'","\'",$_GET[$variable]);
   $_GET[$variable] = filterXSS($_GET[$variable]);
}
foreach($_POST as $variable=>$valor)
{
   $_POST[$variable] = str_replace("'","\'",$_POST[$variable]);
   $_POST[$variable] = filterXSS($_POST[$variable]);
}
 
// Modificamos las variables pasadas por GET
foreach($_GET as $variable=>$valor)
{
 $_GET[$variable] = addslashes($valor); 
}
// Modificamos las variables PASADAS POR POST
foreach($_POST as $variable=>$valor)
{
 $_POST[$variable] = addslashes($valor); 
}
 
 
 
if (isset($inyeccion) && $inyeccion==1)
{
    foreach($_GET as $variable=>$valor)
    {
       $_GET[$variable] = mysql_real_escape_string($_GET[$variable]);
    }
    foreach($_POST as $variable=>$valor)
    {
       $_POST[$variable] = mysql_real_escape_string($_POST[$variable]);
    }    
}
 
 
foreach($_GET as $variable=>$valor)
{
    if (isset($excepcion))
    {
        if (!in_array($_GET[$variable],$excepcion))
            $_GET[$variable] = strip_tags($_GET[$variable]);
    }
    else
        $_GET[$variable] = strip_tags($_GET[$variable]);
}
 
foreach($_POST as $variable=>$valor)
{
    if (isset($excepcion))
    {
        if (!in_array($variable,$excepcion))
            $_POST[$variable] = strip_tags($_POST[$variable]);
    }
    else
        $_POST[$variable] = strip_tags($_POST[$variable]);
}

/////////////////////////////////////////////////////////////////////
///////////////////  Inyeccion SQL Fin //////////////////////////////
/////////////////////////////////////////////////////////////////////


?>
