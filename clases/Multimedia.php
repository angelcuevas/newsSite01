<?php
class Multimedia extends Noticia{
    
    
    private $urlAudio="";
    private $urlImagen="";
    private $urlAdjunto="";
    
    public function __construct( $parametrosDeClases = array() ){

        parent::__construct($parametrosDeClases);
        
        $this->urlAudio    = $parametrosDeClases["config"]["url"]["urlAudios"] ;
        
        $this->urlImagen   = $parametrosDeClases["config"]["url"]["urlImagenes"];
        
        $this->urlAdjunto  = $parametrosDeClases["config"]["url"]["urlAdjuntos"];
        
    }

    public function tapa($tabla){
        
        $multimedia = $this->db->query("SELECT ". $tabla.'.url' ." , ". $tabla.'.id_noticia' ."  FROM $tabla INNER JOIN noticias_tapa ON noticias_tapa.id_noticia = ". $tabla.'.id_noticia' ." ");
        
        return    $multimedia;
    }
    
    
    public function archivosMultimedia($tabla){
        
        $parametroConsulta = array("id_noticia" => $this->id_noticia );
        
        $multimedia = $this->db->query(" SELECT url, descripcion, id_noticia FROM $tabla WHERE id_noticia = :id_noticia ",$parametroConsulta);
       
        return $multimedia;
        
    }
    
    public function archivosMultimediaListado($tabla,$idDelasNoticas){
        
        
        
        if(strlen($idDelasNoticas)>0): //Si no envia los id de las noticias no ejecuta la consulta
        
            $parametroConsulta = array("id_noticia" => $idDelasNoticas );

            $multimedia = $this->db->query(" SELECT url, descripcion, id_noticia FROM $tabla WHERE id_noticia IN ($idDelasNoticas)  ");

            return $multimedia;
        
        endif;
        
    }    
    public static function mutimeNoticia( $multimedia = array(), $iDnoticias ){

        $urlArchivo="";

        foreach($multimedia as $listado_multimedia):

            // echo $listado_multimedia["id_noticia"]." == ". $iDnoticias ."</br>";
            if($listado_multimedia["id_noticia"] == $iDnoticias):

                $urlArchivo = $listado_multimedia["url"];

            endif;

        endforeach;

        return $urlArchivo;
}
    
    public function audioLink( $audio = array() ){
        
        if (array_key_exists("url",$audio) ):
        
            echo  $this->urlAudio.$audio["url"];
        
        endif;
        
    }


        
    public function imagenLink( $audio = array() ){
        
        if (array_key_exists("url",$audio) ):
        
            echo $this->urlImagen.$audio["url"];
        
        endif;
        
        
    }
    
    
    public function adjuntoLink( $audio = array() ){
        
        if (array_key_exists("url",$audio) ):
        
            echo   $this->urlAdjunto.$audio["url"];
            
        endif;
        
        
        
        
    }    

}
?>
