<?php
class Comentario{
    
    private $db;
    private $id_noticia;
    public  $tipoDeMensaje;
    public  $mensaje;
        
    public function __construct($parametrosDeClases = array() ){
        
        if( array_key_exists("db",$parametrosDeClases))
            $this->db = $parametrosDeClases["db"];
        
        if( array_key_exists("id_noticia",$parametrosDeClases))
            $this->id_noticia = $parametrosDeClases["id_noticia"];
    }
    
    public function listaComentario(){
        
        $parametroConsulta = array("id_noticia" => $this->id_noticia );
        
        $cometario = $this->db->query("SELECT  fecha,nombre,id_miembro,texto FROM noticias_comentarios  WHERE id_noticia = :id_noticia AND revisado=1 ORDER BY Fecha DESC",$parametroConsulta);
        
        return $cometario;
    }

    public function alta($nombre,$texto){

        if( !empty($_POST['nombre']) AND !empty($_POST['texto'])):
            
            $parametroConsulta = array("id_noticia" => $this->id_noticia , "nombre" => $nombre,"texto" => $texto );
        
            $this->db->exec("INSERT INTO noticias_comentarios(id_noticia,id_miembro,fecha,texto,habilitado,revisado) VALUES(:id_noticia,:nombre,NOW(),:texto,1,0)",$parametroConsulta);
    
            $this->tipoDeMensaje = "exito";
        
            $this->mensaje        = "El comentario se ha enviado  correctamente.";
        
        elseif( empty($_POST['nombre']) AND empty($_POST['texto']) ):
        
            $this->tipoDeMensaje = "sinComentarioSinNombre";
        
            $this->mensaje         = "Debe ingresar un nombre y un comentario.";
        
        elseif( empty($_POST['nombre'])  ):   
        
            $this->tipoDeMensaje  = "sinComentario";
        
            $this->mensaje         = "Debe ingresar un comentario.";    
        
        elseif(  empty($_POST['texto']) ):   
        
            $this->tipoDeMensaje  = "sinNombre";
        
            $this->mensaje  = "Debe ingresar su nombre.";
        else:
        
            $this->tipoDeMensaje  = $this->mensaje  = "";
        
        endif;
        
    }
    
    public function cantidadComentariosVerNoticia($cantidadComentario = array() ){
        
        if( $cantidadComentario != NULL ):
            $cantidadComentario = Count($cantidadComentario);
        else:
            $cantidadComentario = " Debe enviar el array en el que se listan los comentario ";
        endif;
        
        echo $cantidadComentario;
    }

}

?>