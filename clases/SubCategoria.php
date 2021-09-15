<?php 
class SubCategoria {
    
    private $db;
    
        
    public function __construct( $parametrosDeClases = array() ){
		
        if( array_key_exists("db",$parametrosDeClases))
            $this->db = $parametrosDeClases["db"];
        else
            echo  "Debe enviar la variable DB para hacer las consuntas de la clase CATEGORIA ";
    }
    
    
    
    public function subcategoriaTodas(){
        
        $categoria = $this->db->query(" SELECT id_subcategoria, id_categoria, nombre, ubicacion FROM noticias_subcategorias ");
        
        return $categoria;
    }
    
    public static function descripcionSubcategoria( $subcategoria = array(), $id_categoria ){

        $descripcionSubcategoria="";

        foreach($subcategoria as $listado_categoria):

            if($listado_categoria["id_categoria"] == $id_categoria ):

                $descripcionSubcategoria = $listado_categoria["nombre"];

            endif;

        endforeach;

	   echo $descripcionSubcategoria;
    }
}
    

?>