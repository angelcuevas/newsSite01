<?php

class Paginador extends Noticia  {

    private    $cantidadMostrar;
    private    $url;
    private    $whereConsultasListados=""; 
    private    $parametrosConsulta;
    private    $filtrosDeBusqueda="";

    
    public function __construct($parametrosClases){
        // -Traigo el Obj $db para hacer las consultas
        // - El id_categoria de la categoria
        // - Consulta del listado por el id_categoria
        
        parent::__construct($parametrosClases);
        
        if( !empty($_GET['s'])  ):

            $this->whereConsultasListados.= " AND (titulo LIKE :texto OR copete LIKE :texto OR volanta LIKE :texto OR cuerpo LIKE :texto OR palabras_clave LIKE :texto)";

            $this->parametrosConsulta["texto"] = "%".$_GET['s']."%";
                  
            $this->filtrosDeBusqueda 	.= '&s='.$_GET['s']; 	    

        endif;


        if( !empty($_GET['fechaBusqueda']) AND strlen($_GET['fechaBusqueda'])>0  ):

            $this->whereConsultasListados .= " AND DATE(fecha) = :fechaBusqueda"; 

            $fecha = self::formato_fecha_mysql($_GET['fechaBusqueda']);
        
            $this->parametrosConsulta["fechaBusqueda"] = $fecha; 
        
            $this->filtrosDeBusqueda 	.= '&fechaBusqueda='. $_GET['fechaBusqueda'];

        endif;


        if(  !empty($_GET['id_categoria']) AND strlen($_GET['id_categoria'])>0  ):

            $this->whereConsultasListados .= " AND id_categoria = :id_categoria"; 

            $this->parametrosConsulta["id_categoria"]= $_GET['id_categoria'];

            $this->filtrosDeBusqueda	.= '&id_categoria='.$_GET['id_categoria'];
        
        endif; 

        if(  !empty($_GET['id_subcategoria']) AND strlen($_GET['id_subcategoria'])>0  ):

            $this->whereConsultasListados .= " AND id_subcategoria = :id_subcategoria"; 

            $this->parametrosConsulta["id_subcategoria"]= $_GET['id_subcategoria'];

            $this->filtrosDeBusqueda	.= '&id_subcategoria='.$_GET['id_subcategoria'];
        
        endif; 
        
        $this->cantidadMostrar  = $parametrosClases["config"]["paginacion"]["resultadosPorPagina"];
        
        
        $this->url              = $parametrosClases["config"]["url"]["listados"].$this->id_categoria.$this->filtrosDeBusqueda;
                
        
        $this->consultaListadoParaPaginador = $this->consultaListadoParaPaginador." ". $this->whereConsultasListados ." ORDER BY fecha DESC ";
        
        $this->consultaListadoParaPaginador." ". $this->whereConsultasListados ." ORDER BY fecha DESC ";
    }

    public function datos_paginador(){

      
        //AL PRINCIPIO COMPRUEBO SI HICIERON CLICK EN ALGUNA PÁGINA

        if(isset($_GET['page']) ):
            $page= $_GET['page'];
        else:
            $page=1;
        endif;

        //ACA SE SELECCIONAN TODOS LOS DATOS DE LA TABLA
        $datos = $this->db->query($this->consultaListadoParaPaginador ,$this->parametrosConsulta);

        //MIRO CUANTOS DATOS FUERON DEVUELTOS
        $num_rows=count($datos);

        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR PÁGINA , EN EL EJEMPLO PONGO 15
        $rows_per_page = $this->cantidadMostrar;

        //CALCULO LA ULTIMA PÁGINA
        $lastpage= ceil($num_rows / $rows_per_page);// ceil: Devuelve el siguiente valor entero mayor redondeando hacia arriba 
           
        $last = $lastpage;	

        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA PÁGINA

        $page=(int)$page;//LO CONVIERNTE EN ENTEREO

        if($page > $lastpage):
            $page= $lastpage;
        endif;
           
        if($page < 1):
            $page=1;
        endif;

        if(!($lastpage<11)):

            if(($page % $rows_per_page) == 0): //si  da cero es q estamos en la ultima pagina
                $lastpage = (($page / 10) * 10) + 1;
            else:
                $lastpage = ceil($page / 10) * 10;
            endif;
           
        endif;


           //CREO LA SENTENCIA LIMIT PARA AÑADIR A LA CONSULTA QUE DEFINITIVA
        $limit= 'LIMIT '. ($page -1) * $rows_per_page . ',' .$rows_per_page;
        //                primer registro a mostrar              cantidad de ellos que queremos ver  


        //REALIZO LA CONSULTA QUE VA A MOSTRAR LOS DATOS (ES LA ANTERIOR + EL $limit)
        
        $this->consultaListadoParaPaginador ." ". $limit;
        

       $noticias = $this->db->query(  $this->consultaListadoParaPaginador ." ". $limit , $this->parametrosConsulta );

        return $noticias;

    }
    
    private function formato_fecha_mysql($fecha){

        $fecha_array = explode("-",$fecha);

        $fechaConFormato=  $fecha_array[2]."-".$fecha_array[1]."-".$fecha_array[0];

        return $fechaConFormato;

    }
    


    private function siguienteLink($page=null){
	
        if($page == null)
            $page ="#";
        
        echo '<li><a href="'. $this->url .'&page='.$page.'"     ><i class="fa fa-angle-right"></i></a></li>';

    }

    private function anteriorLink( $page = null ){
	
        if($page == null)
			$page ="#";
	   
        echo '<li><a href="'. $this->url .'&page='.$page.'" 	 ><i class="fa fa-angle-left"></i></a></li>';

    }

    function paginaLink($page = null){

        if($page == null)
            $page ="#";
        
		echo '<li><a href="'. $this->url .'&page='.$page.'"  >'. $page .'</a></li>';

    }


    function paginaActivaLink($page = null){

        if($page == null)
            $page ="#";
        
        echo '<li class="active"  ><a  href="'. $this->url .'&page='.$page.'"  >'. $page .'</a></li>';
    }	

    public function paginador(){
        
   

        
        //AL PRINCIPIO COMPRUEBO SI HICIERON CLICK EN ALGUNA PÁGINA

        if(isset($_GET['page'])):

            $page = $_GET['page'];

        else:

           $page = 1;
		   
        endif;

        //ACA SE SELECCIONAN TODOS LOS DATOS DE LA TABLA

        $datos = $this->db->query($this->consultaListadoParaPaginador,$this->parametrosConsulta);

        //MIRO CUANTOS DATOS FUERON DEVUELTOS

        $num_rows = count($datos);

        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR PÁGINA , EN EL EJEMPLO PONGO 15

        $rows_per_page = $this->cantidadMostrar;

        //CALCULO LA ULTIMA PÁGINA

        $lastpage = ceil($num_rows / $rows_per_page);

        $last = $lastpage;		


        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA PÁGINA

        $page = (int)$page;

        if($page > $lastpage)
			$page = $lastpage;

        if($page < 1)
			$page=1;


        if(!($lastpage<11)):

            if(($page % $rows_per_page) == 0)://si  da cero es q estamos en la ultima pagina

                $lastpage = (($page / 10) * 10) + 1;

            else:

                $lastpage = ceil($page / 10) * 10;

            endif;	

        endif;	



        //UNA VEZ Q MUESTRO LOS DATOS TENGO Q MOSTRAR EL BLOQUE DE PAGINACIÓN SIEMPRE Y CUANDO HAYA MÁS DE UNA PÁGINA

        if($num_rows != 0):

			$nextpage= $page +1;

			$prevpage= $page -1;

			echo '<ul>';

			//SI ES LA PRIMERA PÁGINA DESHABILITO EL BOTON DE PREVIOUS, MUESTRO EL 1 COMO ACTIVO Y MUESTRO EL RESTO DE PÁGINAS

            if ($page == 1):
					
					self::anteriorLink();
					
                    self::paginaActivaLink(1);


                for($i= $page+1; $i<= $lastpage ; $i++):

                   self::paginaLink($i);

                endfor;

                //Y SI LA ULTIMA PÁGINA ES MAYOR QUE LA ACTUAL MUESTRO EL BOTON NEXT O LO DESHABILITO

                if($lastpage >$page):

                    // echo '<li class="next"><a href="'.$url.'?page='.$nextpage.'" >Siguiente &raquo;</a></li>';
                    self::siguienteLink($nextpage);

                else:

                    self::siguienteLink();

                endif;	

            else:

                //EN CAMBIO SI NO ESTAMOS EN LA PÁGINA UNO HABILITO EL BOTON DE PREVIUS Y MUESTRO LAS DEMÁS


                // echo '<li><a href="'.$url.'?page='.$prevpage.'" class="btn btn-default"><i class="fa fa-angle-left"></i></a></li>';
                self::anteriorLink($prevpage);
				
				if($lastpage - 10 == 0):

                    $lastpage = 11;

                endif;	

                if($last<11):

                        for($i= $lastpage+1 - $last; $i<= $lastpage ; $i++):

                            //COMPRUEBO SI ES LA PÁGINA ACTIVA O NO

                            if($page == $i):

                                // echo '<li class="active">'.$i.'</li>';
                                self::paginaActivaLink($i);


                           else:

                                // echo '<li><a href="'.$url.'?page='.$i.'" >'.$i.'</a></li>';
                                self::paginaLink($i);

                            endif;

                        endfor;

                else:


                    for($i= $lastpage - 10; $i<= $lastpage ; $i++):

                        //COMPRUEBO SI ES LA PÁGINA ACTIVA O NO

                        if($page == $i):

                            self::paginaActivaLink($i);

                        else:

                            self::paginaLink($i);

                        endif;

                    endfor;
					
				endif; 

                //SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT    

                if($lastpage >$page ):

                    
                    self::siguienteLink($nextpage);

                else:

                    self::siguienteLink();

                endif;
				
            endif;  

            echo '</ul>';
			
        endif;

    }
        
}
?>
        
