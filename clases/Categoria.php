<?php 
class Categoria {
    
    private $db;
    
        
    public function __construct( $parametrosDeClases = array() ){
		
        if( array_key_exists("db",$parametrosDeClases))
            $this->db = $parametrosDeClases["db"];
        else
            echo  "Debe enviar la variable DB para hacer las consuntas de la clase CATEGORIA ";
        


    }
    
    public function categoriaVerNoticia($id_categoria){
        
        $parametroConsulta = array("id_categoria" => $id_categoria);
        
        $categoria = $this->db->one_query("SELECT nombre,id_categoria FROM noticias_categorias  WHERE id_categoria = :id_categoria",$parametroConsulta);
        
        echo $categoria["nombre"];
    }    
    
    public function categoriaTodas(){
        
        $categoria = $this->db->query("SELECT id_categoria, nombre, ubicacion FROM noticias_categorias ORDER BY ubicacion ");
        
        return $categoria;
    }
    
    public static function descripcionCategoria( array $categoria , $id_categoria ){

        $descripcionCategoria="";

        foreach($categoria as $listado_categoria):

            if($listado_categoria["id_categoria"] == $id_categoria ):

                $descripcionCategoria = $listado_categoria["nombre"];

            endif;

        endforeach;

	   echo $descripcionCategoria;
    }
}
    

?>