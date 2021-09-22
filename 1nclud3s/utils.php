<?php
    function getFoto($fotos, $noticia){
        foreach ($fotos as $foto) {
            if($foto["id_noticia"] == $noticia["id_noticia"]){
                return $foto; 
            }
        }
    }

    function getUrlImagenSmall($foto){
        $partes = explode( '.', $foto["url"] );

        return $partes[0].".jpg_s.".$partes[1];
    }

    function showNoticiaId($noticia){
        echo $noticia["id_noticia"];
    }

    function mostrarSoloFecha($fecha){
        $partes = explode(' ', $fecha);

        return $partes[0];
    }

    function determinarDireccionDebusqueda(){
        $url = $_SERVER['REQUEST_URI']; 
        $end = end(explode('/', $url));
        $file = explode('?', $end);
        
        if($file[0] == "index.php"){
            echo "categoria.php";
        }
        if($file[0] == "categoria.php")
            echo "#";
    }

    function mostrarFechaDeHoy(){
        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        echo $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        
    }
?>