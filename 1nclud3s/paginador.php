<?php

class Paginador{
    
    private    $cantidadMostrar;
    private    $db;
    private    $url;
    
    public function __construct($parametrosClases){
        $this->db               = $parametrosClases["db"];
        $this->cantidadMostrar  = $parametrosClases["cantidadMostrar"];
        $this->url              = $parametrosClases["config"]["host"];
        $htis->cantidadMostrar  = $parametrosClases["config"]["paginacion"]["resultadosPorPagina"];
    }

    public function datos_paginador( $consultaSql,$parametrosConsulta = array()  ){
     
        //AL PRINCIPIO COMPRUEBO SI HICIERON CLICK EN ALGUNA PÁGINA

        if(isset($_GET['page']):
            $page= $_GET['page'];
        else:
            $page=1;
        endif;

        //ACA SE SELECCIONAN TODOS LOS DATOS DE LA TABLA
        $datos= $this->db->query($consultaSql,$parametrosConsulta);

        //MIRO CUANTOS DATOS FUERON DEVUELTOS
        $num_rows=count($datos);

        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR PÁGINA , EN EL EJEMPLO PONGO 15
        $rows_per_page= $this->cantidadMostrar;

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
        $SQL .=" $limit";

        $noticias = $this->db->query($this->consultaSql,$parametrosConsulta );

        return $noticias;

    }

///////////////////////////////////////////////////////////////////////////////////////


    private function siguienteLink($page=null){
	
        if($page == null)
            $page ="#";
        

        echo '<li><a href="'. $this->url .'?page='.$page.'"    class="btn btn-default" ><i class="fa fa-angle-left"></i></a></li>';

    }

    private function anteriorLink( $page = null ){
	
        if($page == null)
			$page ="#";
	   

        echo '<li><a href="'. $this->url .'?page='.$page.'" 	 class="btn btn-default" ><i class="fa fa-angle-right"></i></a></li>';

    }

    function paginaLink($page = null){

        if($page == null){
			$page ="#";
        
		echo '<li><a href="'. $this->url .'?page='.$page.'" class="btn btn-default" >'. $page .'</a></li>';

    }


    function paginaActivaLink($page = null){

        if($page == null)
            $page ="#";
        

        echo '<li><a href="'. $this->url .'?page='.$page.'" class="btn btn-primary" >'. $page .'</a></li>';
    }	

    function paginador( $parametrosConsulta =  array(), $b = null) {

        $filtrosDeBusqueda="";

        ($id              != NULL)  ?  $filtrosDeBusqueda	.= '&id='.$id 	  						:"";
        ($s               != NULL)  ?  $filtrosDeBusqueda 	.= '&s='.$s 							:"";
        ($tag             != NULL)  ?  $filtrosDeBusqueda 	.= '&tag='.$tag 						:"";
        ($titulo_busqueda != NULL)  ?  $filtrosDeBusqueda   .='&titulo_busqueda='.$titulo_busqueda 	:"";

        //AL PRINCIPIO COMPRUEBO SI HICIERON CLICK EN ALGUNA PÁGINA

        if(isset($_GET['page'])):

            $page= $_GET['page'];

        else:

           $page=1;
		   
        endif;

        //ACA SE SELECCIONAN TODOS LOS DATOS DE LA TABLA

        $datos= $db->query($SQL,$parametrosConsulta);

        //MIRO CUANTOS DATOS FUERON DEVUELTOS

        $num_rows=count($datos);

        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR PÁGINA , EN EL EJEMPLO PONGO 15

        $rows_per_page= $this->cantidadMostrar;

        //CALCULO LA ULTIMA PÁGINA

        $lastpage= ceil($num_rows / $rows_per_page);

        $last = $lastpage;		


        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA PÁGINA

        $page=(int)$page;

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

			echo '<ul class="pagination">';

			//SI ES LA PRIMERA PÁGINA DESHABILITO EL BOTON DE PREVIOUS, MUESTRO EL 1 COMO ACTIVO Y MUESTRO EL RESTO DE PÁGINAS

            if ($page == 1):
					
					anteriorLink();
					
                    paginaActivaLink(1);


                for($i= $page+1; $i<= $lastpage ; $i++):

                    paginaLink($i);

                endfor;

                //Y SI LA ULTIMA PÁGINA ES MAYOR QUE LA ACTUAL MUESTRO EL BOTON NEXT O LO DESHABILITO

                if($lastpage >$page):

                    // echo '<li class="next"><a href="'.$url.'?page='.$nextpage.'" >Siguiente &raquo;</a></li>';
                    siguienteLink($nextpage);

                else:

                    siguienteLink();

                endif;	

            else:

                //EN CAMBIO SI NO ESTAMOS EN LA PÁGINA UNO HABILITO EL BOTON DE PREVIUS Y MUESTRO LAS DEMÁS


                // echo '<li><a href="'.$url.'?page='.$prevpage.'" class="btn btn-default"><i class="fa fa-angle-left"></i></a></li>';
                anteriorLink($prevpage);
				
				if($lastpage - 10 == 0):

                    $lastpage = 11;

                endif;	

                if($last<11):

                        for($i= $lastpage+1 - $last; $i<= $lastpage ; $i++):

                            //COMPRUEBO SI ES LA PÁGINA ACTIVA O NO

                            if($page == $i):

                                // echo '<li class="active">'.$i.'</li>';
                                paginaActivaLink($i);


                           else:

                                // echo '<li><a href="'.$url.'?page='.$i.'" >'.$i.'</a></li>';
                                paginaLink($i);

                            endif;

                        endfor;

                else:


                    for($i= $lastpage - 10; $i<= $lastpage ; $i++):

                        //COMPRUEBO SI ES LA PÁGINA ACTIVA O NO

                        if($page == $i):

                            // echo '<li class="active">'.$i.'</li>';
                            paginaActivaLink($i);

                        else:

                            // echo '<li><a href="'.$url.'?page='.$i.'" >'.$i.'</a></li>';
                            paginaLink($i);

                        endif;

                    endfor;
					
				endif; 

                //SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT    

                if($lastpage >$page ):

                    // echo '<li class="next"><a href="'.$url.'?page='.$nextpage.'">Siguiente &raquo;</a></li>';
                    siguienteLink($nextpage);

                else:

                    // echo '<li class="next-off">Siguiente &raquo;</li>';
                    siguienteLink();

                endif;
				
            endif;  

            echo '</ul>';
			
        endif;

    }

//Paginador para Buscadores

//
//    function paginador_buscador($SQL, array $parametrosConsulta = null ,$this->cantidadMostrar , $s=null ,$id = NULL ,$tag=null,$titulo_busqueda = null){
//
//        global $db;
//
//        $filtrosDeBusqueda="";
//
//        ($id              != NULL)  ?  $filtrosDeBusqueda	.= '&id='.$id 	  						:"";
//        ($s               != NULL)  ?  $filtrosDeBusqueda 	.= '&s='.$s 							:"";
//        ($tag             != NULL)  ?  $filtrosDeBusqueda 	.= '&tag='.$tag 						:"";
//        ($titulo_busqueda != NULL)  ?  $filtrosDeBusqueda   .='&titulo_busqueda='.$titulo_busqueda 	:"";
//
//
//
//        $url=get_url();
//
//        //AL PRINCIPIO COMPRUEBO SI HICIERON CLICK EN ALGUNA PÁGINA
//
//        if(isset($_GET['page'])){
//            $page= $_GET['page'];
//        }else{
//            $page=1;
//        }
//
//        //ACA SE SELECCIONAN TODOS LOS DATOS DE LA TABLA
//
//        $datos= $db->query($SQL,$parametrosConsulta);
//
//        //MIRO CUANTOS DATOS FUERON DEVUELTOS
//
//        $num_rows= count($datos);
//
//        //ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR PÁGINA , EN EL EJEMPLO PONGO 15
//
//        $rows_per_page= $this->cantidadMostrar;
//
//        //CALCULO LA ULTIMA PÁGINA
//
//        $lastpage= ceil($num_rows / $rows_per_page);
//
//        $last = $lastpage;	
//
//        //COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA PÁGINA
//
//        $page=(int)$page;
//
//        // SI LA PAGINA ES MAYOR A LA ULTIMA LA ULTIMA VA SER LA PAGINA ACTUAL
//        if($page > $lastpage):
//            $page= $lastpage;
//        endif;
//
//        if($page < 1):
//            $page=1;
//        endif;
//
//        if(!($lastpage<11)){
//
//            if(($page % $rows_per_page) == 0)//si  da cero es q estamos en la ultima pagina
//                {$lastpage = (($page / 10) * 10) + 1;}
//            else
//                {$lastpage = ceil($page / 10) * 10;}
//        }
//
//        //UNA VEZ Q MUESTRO LOS DATOS TENGO Q MOSTRAR EL BLOQUE DE PAGINACIÓN SIEMPRE Y CUANDO HAYA MÁS DE UNA PÁGINA
//
//        if($num_rows != 0){
//
//           $nextpage= $page +1;
//
//           $prevpage= $page -1;
//
//            echo '<ul class="pagination__custom list-unstyled list-inline">';
//
//            //SI ES LA PRIMERA PÁGINA DESHABILITO EL BOTON DE PREVIOUS, MUESTRO EL 1 COMO ACTIVO Y MUESTRO EL RESTO DE PÁGINAS
//
//            if ($page == 1){
//
//
//                    echo '<li><a href="#" class="btn btn-default"><i class="fa fa-angle-left"></i></a></li>';
//                    echo '<li><a href="#" class="btn btn-primary">1</a></li>';
//
//                    for( $i= $page+1; $i<= $lastpage ; $i++):
//
//                        echo '<li><a class="btn btn-default" href="'.$url.'?page='.$i.$filtrosDeBusqueda .'">'.$i.'</a></li>';
//
//                    endfor;
//
//                    //Y SI LA ULTIMA PÁGINA ES MAYOR QUE LA ACTUAL MUESTRO EL BOTON NEXT O LO DESHABILITO
//
//                    if($lastpage >$page):
//
//                        echo '<li><a href="'.$url.'?page='.$nextpage.'&id='.$id.$filtrosDeBusqueda.'" class="btn btn-default"><i class="fa fa-angle-right"></i></a></li>';
//
//                    else:  
//
//
//                        echo '<li><a href="#" class="btn btn-default"><i class="fa fa-angle-right"></i></a></li>';
//
//                    endif;
//
//            }else{
//
//                //EN CAMBIO SI NO ESTAMOS EN LA PÁGINA UNO HABILITO EL BOTON DE PREVIUS Y MUESTRO LAS DEMÁS
//
//
//                echo '<li><a href="'.$url.'?page='.$prevpage.$filtrosDeBusqueda.'" class="btn btn-default"><i class="fa fa-angle-left"></i></a></li>';
//
//
//                if($lastpage - 10 == 0){$lastpage = 11;}
//
//                if($last<11):
//
//                    for($i= $lastpage+1 - $last; $i<= $lastpage ; $i++){
//
//                        //COMPRUEBO SI ES LA PÁGINA ACTIVA O NO
//
//                        if($page == $i){
//
//
//                            echo '<li><a href="#" class="btn btn-primary">'.$i.'</a></li>';
//
//                        }else{
//
//
//                            echo '<li><a class="btn btn-default"  href="'.$url.'?page='.$i.'&id='.$id.$filtrosDeBusqueda.'" >'.$i.'</a></li>';
//
//                        }
//                    }
//
//                else:
//
//                    for($i= $lastpage - 10; $i<= $lastpage ; $i++){
//
//                        //COMPRUEBO SI ES LA PÁGINA ACTIVA O NO
//
//                        if($page == $i){
//
//                            echo '<li><a href="#" class="btn btn-primary">'.$i.'</a></li>';
//
//                        }else{
//
//                            echo '<li><a class="btn btn-default"  href="'.$url.'?page='.$i.'&id='.$id.$filtrosDeBusqueda.'" >'.$i.'</a></li>';
//
//                        }
//                    }
//
//                endif; 
//
//                 //SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT    
//
//                if($lastpage >$page ){    
//
//                    echo '<li><a href="'.$url.'?page='.$nextpage.'&id='.$id.$filtrosDeBusqueda.'" class="btn btn-default"><i class="fa fa-angle-right"></i></a></li>';
//
//                }else{
//
//                    echo '<li><a href="#" class="btn btn-default"><i class="fa fa-angle-right"></i></a></li>';
//
//                }
//
//            }   
//
//            echo '</ul>';
//
//        }
//
//    }


           }
?>
