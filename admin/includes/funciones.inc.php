<?php

function fecha($fecha,$hora = TRUE){
  $fecha = strtotime($fecha);
  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  if($hora){
  		return $dias[date('w',$fecha)]." ".date('d',$fecha)." de ".$meses[date('n',$fecha)-1]. " de ".date('Y',$fecha) . " " . date("H:m",$fecha);
	}else{
  		return $dias[date('w',$fecha)]." ".date('d',$fecha)." de ".$meses[date('n',$fecha)-1]. " de ".date('Y',$fecha);
	}
}

function dma($fecha){
      $fecha = strtotime($fecha);
      return date("d/m/Y H:m",$fecha);
}

function dmal($fecha){
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
?>