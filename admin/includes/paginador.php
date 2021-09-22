<?php

function datos_paginador($SQL,$cantidad_mostrar,$link){

	$consulta=$SQL;
	if(isset($_GET['page'])){
		$page= $_GET['page'];
	}
	else{
	    $page=1;
	}

	$datos = mysql_query($SQL);

	$num_rows = mysql_num_rows($datos);

	$rows_per_page = $cantidad_mostrar;

	$lastpage = ceil($num_rows / $rows_per_page);

	$page = (int) $page;

	if($page > $lastpage){
	    $page= $lastpage;
	}

	if($page < 1){
	    $page=1;
	}

	$limit= 'LIMIT '. ($page -1) * $rows_per_page . ',' .$rows_per_page;
	$consulta .=" $limit";

	return $consulta;
}




function get_url(){
	$url="http://".$_SERVER['HTTP_HOST'].":".$_SERVER['PHP_SELF'];
	return $url;
}

function paginador($SQL,$cantidad_mostrar,$link){
	$gets = "";
		//pasar datos del get por el paginador
	foreach ($_GET as $key => $value) {
		if ($key != "page" and $key != "exito" and $key != "agregar_id" and $key != "eliminar_id" and $key != "id" and $key != "del" and $key != "col")
			$gets .= "&".$key."=".$value;
	}

	$url=get_url();

	if(isset($_GET['page'])){
		$page= $_GET['page'];
	}
	else{
	    $page=1;
	}
		
	$datos=mysql_query($SQL,$link);
	$num_rows=mysql_num_rows($datos);
	$rows_per_page= $cantidad_mostrar;
	$lastpage= ceil($num_rows / $rows_per_page);
	$page=(int)$page;
	
	if($page > $lastpage){
		$page= $lastpage;
	}
	if($page < 1){
		$page=1;
	}

	if($num_rows != 0){
	   $nextpage= $page +1;
	   $prevpage= $page -1;

	echo '<ul id="pagination-clean">';

	//SI ES LA PRIMERA PÁGINA DESHABILITO EL BOTON DE PREVIOUS, MUESTRO EL 1 COMO ACTIVO Y MUESTRO EL RESTO DE PÁGINAS

	 if ($page == 1) {
	    
	    echo '<li class="previous-off">&laquo;</li><li class="active">1</li>';
		  
	    for($i= $page+1; $i<= $lastpage ; $i++)
		
		{
	         
	     echo '<li><a href="'.$url.'?page='.$i.$gets.'">'.$i.'</a></li>';
		}
	     
		//Y SI LA ULTIMA PÁGINA ES MAYOR QUE LA ACTUAL MUESTRO EL BOTON NEXT O LO DESHABILITO
	    
		if($lastpage >$page)
		
			{       
		 	echo '<li class="next"><a href="'.$url.'?page='.$nextpage.$gets.'" >&raquo;</a></li>';
	    	}
							 
		else
			{  
		  	echo '<li class="next-off">&raquo;</li>';
			}
			
	 } else {

	    //EN CAMBIO SI NO ESTAMOS EN LA PÁGINA UNO HABILITO EL BOTON DE PREVIUS Y MUESTRO LAS DEMÁS
	    
	    echo '<li class="previous"><a href="'.$url.'?page='.$prevpage.$gets.'">&laquo;</a></li>';
	      
		  for($i= 1; $i<= $lastpage ; $i++){
	            
				//COMPRUEBO SI ES LA PÁGINA ACTIVA O NO
	            
				if($page == $i){
					
	        	echo '<li class="active">'.$i.'</li>';
	           
			   }else{
				   
	        	echo '<li><a href="'.$url.'?page='.$i.$gets.'" >'.$i.'</a></li>';
	            
				}
	      }
	         //SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT    
	      
		  if($lastpage >$page ){    
	      
	      echo '<li class="next"><a href="'.$url.'?page='.$nextpage.$gets.'">&raquo;</a></li>';
	      
		  }else{
	    
	      echo '<li class="next-off">&raquo;</li>';
		  
	      }
	 }   
	echo '</ul>';
	}

}

function paginador_buscador($SQL,$cantidad_mostrar,$link,$id,$texto) {
	
$url=get_url();

//AL PRINCIPIO COMPRUEBO SI HICIERON CLICK EN ALGUNA PÁGINA

if(isset($_GET['page']))

	{
	$page= $_GET['page'];
	}

else
	{
    $page=1;
	}
	
//ACA SE SELECCIONAN TODOS LOS DATOS DE LA TABLA

$datos=mysql_query($SQL,$link);

//MIRO CUANTOS DATOS FUERON DEVUELTOS
$num_rows=mysql_num_rows($datos);

//ACA SE DECIDE CUANTOS RESULTADOS MOSTRAR POR PÁGINA , EN EL EJEMPLO PONGO 15
$rows_per_page= $cantidad_mostrar;

//CALCULO LA ULTIMA PÁGINA
$lastpage= ceil($num_rows / $rows_per_page);

//COMPRUEBO QUE EL VALOR DE LA PÁGINA SEA CORRECTO Y SI ES LA ULTIMA PÁGINA

$page=(int)$page;

if($page > $lastpage)
					
					{$page= $lastpage;}

if($page < 1)
					{$page=1;}

//UNA VEZ Q MUESTRO LOS DATOS TENGO Q MOSTRAR EL BLOQUE DE PAGINACIÓN SIEMPRE Y CUANDO HAYA MÁS DE UNA PÁGINA

if($num_rows != 0){
   $nextpage= $page +1;
   $prevpage= $page -1;

echo '<ul id="pagination-clean">';

//SI ES LA PRIMERA PÁGINA DESHABILITO EL BOTON DE PREVIOUS, MUESTRO EL 1 COMO ACTIVO Y MUESTRO EL RESTO DE PÁGINAS

 if ($page == 1) {
    
    echo '<li class="previous-off">&laquo;</li><li class="active">1</li>';
	  
    for($i= $page+1; $i<= $lastpage ; $i++)
	
	{
         
     echo '<li><a href="'.$url.'?page='.$i.'&id='.$id.'&texto='.$texto.'&acc=buscar">'.$i.'</a></li>';
	}
     
	//Y SI LA ULTIMA PÁGINA ES MAYOR QUE LA ACTUAL MUESTRO EL BOTON NEXT O LO DESHABILITO
    
	if($lastpage >$page)
	
		{       
	 	echo '<li class="next"><a href="'.$url.'?page='.$nextpage.'" >&raquo;</a></li>';
    	}
						 
	else
		{  
	  	echo '<li class="next-off">&raquo;</li>';
		}
		
 } else {

    //EN CAMBIO SI NO ESTAMOS EN LA PÁGINA UNO HABILITO EL BOTON DE PREVIUS Y MUESTRO LAS DEMÁS
    
    echo '<li class="previous"><a href="'.$url.'?page='.$prevpage.'&id='.$id.'&texto='.$texto.'&acc=buscar">&laquo;</a></li>';
      
	  for($i= 1; $i<= $lastpage ; $i++){
            
			//COMPRUEBO SI ES LA PÁGINA ACTIVA O NO
            
			if($page == $i){
				
        	echo '<li class="active">'.$i.'</li>';
           
		   }else{
			   
        	echo '<li><a href="'.$url.'?page='.$i.'&id='.$id.'&texto='.$texto.'&acc=buscar" >'.$i.'</a></li>';
            
			}
      }
         //SI NO ES LA ÚLTIMA PÁGINA ACTIVO EL BOTON NEXT    
      
	  if($lastpage >$page ){    
      
      echo '<li class="next"><a href="'.$url.'?page='.$nextpage.'&id='.$id.'&texto='.$texto.'&acc=buscar">&raquo;</a></li>';
      
	  }else{
    
      echo '<li class="next-off">&raquo;</li>';
	  
      }
 }   
echo '</ul>';
}

}



?>