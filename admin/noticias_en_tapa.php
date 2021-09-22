<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();
$tamaño_pagina = 20;

// col = 0 para um; 1 para izq; 2 derecha; col = Columna;3 para columnistas en tapa;

$idCategoria= $_GET["id_categoria"];

$selectIdCategoria="id_categoria={$idCategoria}";//1

$mostrarTodasLasNoticias = false; 


if( !empty($_GET["id_categoria"]) and (int)$_GET["id_categoria"] > 5 ):
	$mostrarTodasLasNoticias = true;
	$idCategoria = $_GET["id_categoria"];
	
	$selectIdCategoria =	"id_categoria={$idCategoria}";
		
endif;	


if(!empty($_GET["del"])){
	$columna = $_GET["col"];
	$del = $_GET["del"];
	mysql_query("DELETE from noticias_tapa WHERE id_noticia_tapa = '$del'");
	$reordenar = consulta("SELECT id_noticia_tapa FROM noticias_tapa WHERE columna = '$columna' ORDER BY ubicacion ASC");
	foreach ($reordenar as $key => $value) {
		$ubc = $key + 1;
		mysql_query("UPDATE noticias_tapa SET ubicacion = '$ubc' WHERE id_noticia_tapa = '$value[id_noticia_tapa]'");
	}
    header("Location: noticias_en_tapa.php?&exito=eliminar&{$selectIdCategoria}");
}

if(!empty($_GET["orden"])){
	$id = $_GET["oid"];
	$columna = $_GET["col"];
	$orden = $_GET["orden"];
    $ubicacion_actual = una_consulta("SELECT ubicacion FROM noticias_tapa WHERE id_noticia_tapa = '$id' ");
    $ubicacion_actual = $ubicacion_actual["ubicacion"];
    mysql_query("UPDATE noticias_tapa SET ubicacion = '$ubicacion_actual' WHERE columna = '$columna' AND ubicacion = '$orden'");
    echo mysql_error();
    mysql_query("UPDATE noticias_tapa SET ubicacion = '$orden' WHERE id_noticia_tapa = '$id'");
    echo mysql_error();
    header("Location: noticias_en_tapa.php?&exito=orden&{$selectIdCategoria}");
}




	if(!empty($_GET["id"])){//id de la noticia a destacar
		
		$banderaMensaje = 0 ;
		
		$categorias = consulta("SELECT `id_categoria`, `nombre`, `ubicacion` FROM `noticias_categorias`");
		
		$noticiasTapa = consulta("SELECT id_noticia_tapa FROM noticias_tapa WHERE columna = ". $_GET["col"] . "" );

		//En caso  que la consulta traiga mas de 4 notas destacadas en tapa muestra el mensaje
		
		if( count( $noticiasTapa ) >= 4 AND $_GET["col"] == 0 ) :

			?> <script> alert("No puede cololar mas de 4 noticias destacadas en tapa") </script><?php
			
			$banderaMensaje = 1 ;

		// En caso que la consulta traiga mas de 3 notas destacadas de la categoria elegida
		//en tapa muestra el mensaje	
		
		elseif( count( $noticiasTapa ) >= 3 ) :

			foreach($categorias as $listado_categorias ):	
			
				if( $_GET["col"] == $listado_categorias["id_categoria"]."0" ):
			
					$banderaMensaje = 1 ;
				
				endif;
				
			endforeach;	
			
		endif;
		
		
		if( $banderaMensaje == 0 ):
		
			$columna = $_GET["col"];
			$id = $_GET["id"];
			$max = una_consulta("SELECT MAX(ubicacion) as max FROM noticias_tapa WHERE columna = '$columna'");
			$max = ($max["max"]) + 1;
			mysql_query("INSERT INTO noticias_tapa(id_noticia,columna,ubicacion) VALUES ('$id','$columna',$max)");
			header("Location: noticias_en_tapa.php?&exito=Agregar&{$selectIdCategoria}");
				
		else:
			
			?> <script> alert("No puede cololar mas de 3 noticias destacadas en tapa") </script><?php
			
		endif;

	}
	

    $idCategoria = ( $idCategoria == "") ? 1 : $idCategoria; 
	
	$noticias_tapa = consulta("SELECT noticias_tapa.id_noticia_tapa,noticias_tapa.id_noticia,noticias.id_noticia,noticias.titulo,noticias.fecha FROM noticias_tapa,noticias WHERE noticias_tapa.id_noticia = noticias.id_noticia and columna = {$idCategoria} ORDER BY ubicacion ASC");
	
    $largoDeTabla = "style='width:33.3%'";
	
$cosa = $selectIdCategoria;
if($mostrarTodasLasNoticias === false){
	$cosa = "1";
}


$sql_paginador = "SELECT id_noticia,titulo,fecha from noticias WHERE {$cosa} order by fecha DESC";

$consulta_noticias = datos_paginador($sql_paginador,$tamaño_pagina,$link);

$noticias_listado = consulta($consulta_noticias);

include("partes/top.php");

/*-------------- Se ubica debajo del top.php porque en el se crea el array $categoria ---*/

$nombreCategoria = "Tendencias";

if($idCategoria == 2) $nombreCategoria = "Principales";
if($idCategoria == 3) $nombreCategoria = "Semanales";

foreach($categorias as $listado_categorias ):

		if($listado_categorias["id_categoria"] == $idCategoria	):
		
			$nombreCategoria =  $listado_categorias["nombre"];
			
		endif;
			
endforeach;

	


?>

    <div class="center_content">  

    <div class="right_content" style="width:95%;">            


	
	
	<h2><?php echo $nombreCategoria;?> </h2>

		<div >
		
			<?php

			;  
			
			$noticias = $noticias_tapa;
			
			 include("includes/notasTapa.php");  
			 
			?>
			
		</div>
</div>

<div class="clear"></div>

<br />
<h2>Agregar</h2>                                      
<table id="rounded-corner" summary="" >
    <thead>
    	<tr>
            <th scope="col" class="rounded-company">Fecha</th>
            <th scope="col" class="rounded">Titulo</th>
            <th scope="col" class="rounded-q4" style="width:80px;">Agregar</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<td colspan="2" class="rounded-foot-left">
                <div class="pagination">
                    <?php paginador($sql_paginador,$tamaño_pagina,$link); ?>
                </div> 
            </td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
    <tbody>
    	<?php foreach ($noticias_listado as $key => $value): ?>
            <tr>
                <td scope="col" class="rounded"><?php echo $noticias_listado[$key]["fecha"]; ?></td>
                <td scope="col" class="rounded"><?php echo $noticias_listado[$key]["titulo"]; ?></td>
                <td width="400">

					
                	<a style="display:inline;text-decoration:none;" href="?col=<?php echo $idCategoria; ?>&id=<?php echo $noticias_listado[$key]["id_noticia"] ?>&<?php echo $selectIdCategoria ?>"><span class="editar">Subir a tapa</span></a>
                    
				
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
              
     </div>
  </div>         

<?php include("partes/fotter.php"); ?>