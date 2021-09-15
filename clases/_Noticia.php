<?php 

class Noticia {
    
    protected   $db="";
    protected   $id_noticia="";
    protected   $id_categoria;
    private     $glShare  = "";
    private     $twShare  = "";
    private     $fbShare  = "";
    public      $idDeLasNoticias = "";
    protected   $consultaListadoParaPaginador = "SELECT  noticias.id_noticia, id_categoria,noticias.volanta, noticias.copete, noticias.titulo, noticias.fecha, (SELECT noticias_columnistas.nombre FROM noticias_columnistas WHERE noticias_columnistas.id_columnista = noticias.id_columnista LIMIT 1) as nombreColumnista FROM noticias  WHERE noticias.activa = 1 ";
 
    
    
    
    
    public function __construct(array $parametrosDeClases  ){
		
        $this->db = $parametrosDeClases["db"];
        
        if( array_key_exists("id_noticia",$parametrosDeClases) )
		  $this->id_noticia =  $parametrosDeClases["id_noticia"];
        
        $this->glShare = $parametrosDeClases["config"]["url"]["glShare"];
            
        $this->twShare = $parametrosDeClases["config"]["url"]["twShare"];
            
        $this->fbShare = $parametrosDeClases["config"]["url"]["fbShare"];
        
        if( array_key_exists("id_categoria",$parametrosDeClases) )
            $this->id_categoria =  $parametrosDeClases["id_categoria"]; ;
	 
	}
	
	public function tapa(){
        
        $noticias = $this->db->query("SELECT noticias.hits,noticias.id_categoria,	noticias_tapa.Columna, noticias_tapa.ubicacion,	noticias.id_noticia, noticias.volanta,	noticias.copete,	noticias.titulo,	noticias.fecha,	noticias.activa	FROM noticias_tapa INNER JOIN noticias ON  noticias_tapa.Id_Noticia = noticias.id_Noticia ORDER BY Columna,ubicacion ASC");
        
        return $noticias;
    }
    
//    public function listadoPorCategoriaUltimasTres(){
//        
//        $parametroConsulta = array("id_categoria" => $this->id_categoria );
//        
//        $noticias = $this->db->query( "SELECT  
//                                            noticias.id_noticia, 
//                                            id_categoria,
//                                            noticias.volanta, 
//                                            noticias.copete, 
//                                            noticias.titulo, 
//                                            noticias.fecha, 
//                                            (SELECT noticias_columnistas.nombre FROM noticias_columnistas WHERE noticias_columnistas.id_columnista = noticias.id_columnista LIMIT 1) as nombreColumnista, 
//                                            (SELECT noticias_fotos.url          FROM noticias_fotos       WHERE noticias_fotos.id_noticia = noticias.id_noticia ) as foto
//                                        FROM 
//                                            noticias  
//                                        WHERE 
//                                                noticias.activa = 1 
//                                            AND id_categoria = :id_categoria 
//                                            ORDER BY fecha ASC 
//                                            LIMIT 3",$parametroConsulta);
//        
//        
//        
//        return $noticias;
//    }
    
    public function listadoPorCategoria($paginador){
        

        
            $noticias = $paginador->datos_paginador();
        
            foreach( $noticias as $key => $value ):
                
                if( $key ==  (Count($noticias)-1) ):
        
                    $this->idDeLasNoticias .= $noticias[$key]["id_noticia"];
        
                else:
        
                    $this->idDeLasNoticias .= $noticias[$key]["id_noticia"]." , ";
        
                endif;
        
            endforeach;
        
            return $noticias;

        
    }
    
    public function verNoticia(){
    
        $parametroConsulta = array("id_noticia" => $this->id_noticia );

        $noticias  = $this->db->one_query("SELECT palabras_clave ,noticias.id_noticia,noticias.volanta,noticias.copete,noticias.titulo,noticias.fecha,noticias.cuerpo, noticias.id_categoria ,noticias.id_columnista FROM noticias  WHERE 	noticias.id_noticia = :id_noticia ",$parametroConsulta);
        
        return $noticias;
    }
    
    public function noticiasMasLeidas(){
        
        // $noticias = $this->db->query("SELECT noticias.id_noticia, noticias.titulo, noticias.fecha, (SELECT noticias_fotos.url FROM noticias_fotos WHERE noticias_fotos.id_noticia = noticias.id_noticia ) as foto FROM noticias WHERE DAY(NOW())-30 < DAY(noticias.fecha) ORDER BY hits DESC LIMIT 5");
        
        // return $noticias;
    }
    

    
    public function fbShareLink($id_nota = NULL ){
        
        if($this->id_noticia != NULL):
        
            $this->fbShare = $this->fbShare.$this->id_noticia;
        
        elseif( $id_nota != NULL):
        
            $this->fbShare = $this->fbShare.$id_nota;
        else:
        
            $this->fbShare = "Debe definir un ID de la noticia cuando invoca la clase o cuando llama al metodo";
        
        endif;
        
        echo $this->fbShare;
    }
    
      public function twShareLink($id_nota = NULL ){
        
        if($this->id_noticia != NULL):
        
            $this->twShare = $this->twShare.$this->id_noticia;
        
        elseif( $id_nota != NULL):
        
            $this->twShare = $this->twShare.$id_nota;
        else:
        
            $this->twShare = "Debe definir un ID de la noticia cuando invoca la clase o cuando llama al metodo";
        
        endif;
        
        echo $this->twShare;
    }  
	
    public function glShareLink($id_nota = NULL ){
        
        if($this->id_noticia != NULL):
        
            $this->glShare = $this->glShare.$this->id_noticia;
        
        elseif( $id_nota != NULL):
        
            $this->glShare = $this->glShare.$id_nota;
        else:
        
            $this->glShare = "Debe definir un ID de la noticia cuando invoca la clase o cuando llama al metodo";
        
        endif;
        
        echo $this->glShare;
    }  
    
    
}

?>
