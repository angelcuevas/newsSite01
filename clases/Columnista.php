<?php 
class Columnista {
    
    private $id_noticia;
    private $id_comunista;
    private $nombre; 
        
    public function __construct( $parametrosDeClases = array() ){
		
        if( array_key_exists("db",$parametrosDeClases))
            $this->db = $parametrosDeClases["db"];
        else
            echo  "Debe enviar la variable DB para hacer las consuntas de la clase COLUMNISTA ";

    }
    
    public function columnistaVerNoticia($id_comunista){
        
        $parametroConsulta = array("id_columnista" => $id_comunista );
        
        $columnista = $this->db->one_query("SELECT nombre FROM noticias_columnistas WHERE id_columnista = :id_columnista LIMIT 1 ",$parametroConsulta); 
        
        echo $columnista["nombre"];
    }
}
    

?>