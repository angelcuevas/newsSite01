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
?>