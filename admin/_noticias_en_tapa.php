<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();
$tamaño_pagina = 20;

// col = 0 para um; 1 para izq; 2 derecha; col = Columna;3 para columnistas en tapa;

$idCategoria="";

$selectIdCategoria=1;

if( !empty($_GET["idCategoria"]) ):
	
	$idCategoria = $_GET["idCategoria"];
	
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
    header("Location: noticias_en_tapa.php?&exito=eliminar&idCategoria={$idCategoria}");
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
    header("Location: noticias_en_tapa.php?&exito=orden&idCategoria={$idCategoria}");
}




	if(!empty($_GET["id"])){//id de la noticia a destacar
		
		$banderaMensaje = 0 ;
		
		$categorias = consulta("SELECT `id_categoria`, `nombre`, `ubicacion` FROM `noticias_categorias`");
		
		$noticiasTapa = consulta("SELECT id_noticia_tapa FROM noticias_tapa WHERE columna = ". $_GET["col"] . "" );

		//En caso  que la consulta traiga mas de 4 notas destacadas en tapa muestra el mensaje
		
		if( count( $noticiasTapa ) >= 4 AND $_GET["col"] == 0 ) :

			?> <script> alert("No puede cololar mas de 4 noticias destacadas en tapa") </script><?php

		// En caso que la consulta traiga mas de 3 notas destacadas de la categoria elegida
		//en tapa muestra el mensaje	
		
		elseif( count( $noticiasTapa ) >= 3 ) :

			foreach($categorias as $listado_categorias ):	
			
				 echo $_GET["col"] ."==". $listado_categorias["id_categoria"]."1 </br>" ;
				if( $_GET["col"] == $listado_categorias["id_categoria"]."1" ):
			
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
			// header("Location: noticias_en_tapa.php?&exito=Agregar&idCategoria={$idCategoria}");
				
		else:
			
			?> <script> alert("No puede cololar mas de 3 noticias destacadas en tapa") </script><?php
			
		endif;

	}
	




if( empty($_GET["idCategoria"]) ):

	$noticias_um = consulta("		SELECT noticias_tapa.id_noticia_tapa,noticias_tapa.id_noticia,noticias.id_noticia,noticias.titulo,noticias.fecha FROM noticias_tapa,noticias WHERE noticias_tapa.id_noticia = noticias.id_noticia and columna = 0 ORDER BY ubicacion ASC");
	
endif;

	$noticias_show = consulta("		SELECT noticias_tapa.id_noticia_tapa,noticias_tapa.id_noticia,noticias.id_noticia,noticias.titulo,noticias.fecha FROM noticias_tapa,noticias WHERE noticias_tapa.id_noticia = noticias.id_noticia and columna = {$idCategoria}1 ORDER BY ubicacion ASC");

	$noticias_izquierda = consulta("SELECT noticias_tapa.id_noticia_tapa,noticias_tapa.id_noticia,noticias.id_noticia,noticias.titulo,noticias.fecha FROM noticias_tapa,noticias WHERE noticias_tapa.id_noticia = noticias.id_noticia and columna = {$idCategoria}2 ORDER BY ubicacion ASC");

	$noticias_derecha = consulta("	SELECT noticias_tapa.id_noticia_tapa,noticias_tapa.id_noticia,noticias.id_noticia,noticias.titulo,noticias.fecha FROM noticias_tapa,noticias WHERE noticias_tapa.id_noticia = noticias.id_noticia and columna = {$idCategoria}3 ORDER BY ubicacion ASC");

$largoDeTabla="";
	
if( !empty( $_GET["idCategoria"] ) ):

	$noticias_centro = consulta("	SELECT noticias_tapa.id_noticia_tapa,noticias_tapa.id_noticia,noticias.id_noticia,noticias.titulo,noticias.fecha FROM noticias_tapa,noticias WHERE noticias_tapa.id_noticia = noticias.id_noticia and columna = {$idCategoria}4 ORDER BY ubicacion ASC");
	
	$largoDeTabla = "style='width:33.3%'";
	
endif;	


$sql_paginador = "SELECT id_noticia,titulo,fecha from noticias WHERE {$selectIdCategoria} order by fecha DESC";

$consulta_noticias = datos_paginador($sql_paginador,$tamaño_pagina,$link);

$noticias = consulta($consulta_noticias);

include("partes/top.php");

/*-------------- Se ubica debajo del top.php porque en el se crea el array $categoria ---*/

$nombreCategoria = "Locales";

foreach($categorias as $listado_categorias ):

		if($listado_categorias["id_categoria"] == $idCategoria	):
		
			$nombreCategoria =  $listado_categorias["nombre"];
			
		endif;
			
endforeach;


if( !empty( $_GET["idCategoria"] ) ):
	?>
	<style>	
	.mitad{
		width:33.3%;
	}
	</style>
	<?php
	
endif;	


?>

    <div class="center_content">  

    <div class="right_content" style="width:95%;">            

<?php if( empty($_GET["idCategoria"]) ):	?>
	<h2>Destacadas</h2>
	<table id="rounded-corner" summary="">
		<thead>
			<tr>
				<th scope="col" class="rounded-company">Titulo</th>
				<th scope="col" class="rounded">Quitar</th>
				<th scope="col" class="rounded-q4">Orden</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($noticias_um as $key => $value): ?>
				<tr>
					<td scope="col" class="rounded"><?php echo $noticias_um[$key]["titulo"]; ?></td>
					<td>
						<a class="ask" href="?del=<?php echo $noticias_um[$key]["id_noticia_tapa"] ?>&col=0&idCategoria=<?php echo $idCategoria; ?>"><img src="images/trash.png" alt="" title="" border="0" /></a>
					</td>
					<td>
						<form method="GET" action="noticias_en_tapa.php">
						<input name="idCategoria" type="hidden" value="<?php echo $idCategoria; ?>" />
						<input name="col" type="hidden" value="0" />
						<input name="oid" type="hidden" value="<?php echo $noticias_um[$key]["id_noticia_tapa"] ?>" />
						<select name="orden" onchange="this.form.submit();">
						<?php for($num=1;$num<sizeof($noticias_um)+1;$num++): ?>
							<option <?php echo ($num==$key+1) ? 'selected="selected"' : ""; ?> value="<?php echo $num; ?>"><?php echo $num; ?></option>
						<?php endfor ?>
						</select>
						</form>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
<?php else: ?>

	<h2><?php  echo $nombreCategoria; ?> destacadas</h2>
	
	<table id="rounded-corner" summary="">
		<thead>
			<tr>
				<th scope="col" class="rounded-company">Titulo</th>
				<th scope="col" class="rounded">Quitar</th>
				<th scope="col" class="rounded-q4">Orden</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($noticias_show as $key => $value): ?>
				<tr>
					<td scope="col" class="rounded"><?php echo $noticias_show[$key]["titulo"]; ?></td>
					<td>
						<a class="ask" href="?del=<?php echo $noticias_show[$key]["id_noticia_tapa"] ?>&col=3&idCategoria=<?php echo $idCategoria; ?>"><img src="images/trash.png" alt="" title="" border="0" /></a>
					</td>
					<td>
						<form method="GET" action="noticias_en_tapa.php">
						<input name="idCategoria" type="hidden" value="<?php echo $idCategoria; ?>" />
						<input name="col" type="hidden" value="0" />
						<input name="oid" type="hidden" value="<?php echo $noticias_show[$key]["id_noticia_tapa"] ?>" />
						<select name="orden" onchange="this.form.submit();">
						<?php for($num=1;$num<sizeof($noticias_show)+1;$num++): ?>
							<option <?php echo ($num==$key+1) ? 'selected="selected"' : ""; ?> value="<?php echo $num; ?>"><?php echo $num; ?></option>
						<?php endfor ?>
						</select>
						</form>
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<br />
	
	<h2><?php echo $nombreCategoria." columnas 1ra / 2da / 3ra";?> </h2>
	<div style="border-bottom:1px dashed #ccc;display:inline-block;width: 100%;">
		<div class="mitad" style="border-right:1px dashed #ccc">
			<table id="rounded-corner" summary="">
				<thead>
					<tr>
						<th scope="col" class="rounded">Titulo</th>
						<th scope="col" class="rounded">Quitar</th>
						<th scope="col" class="rounded">Orden</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($noticias_izquierda as $key => $value): ?>
						<tr>
							<td scope="col" class="rounded"><?php echo $noticias_izquierda[$key]["titulo"]; ?></td>
							<td>
								<a class="ask" href="?del=<?php echo $noticias_izquierda[$key]["id_noticia_tapa"] ?>&col=1&idCategoria=<?php echo $idCategoria; ?>"><img src="images/trash.png" alt="" title="Ultimo momento" border="0" /></a>
							</td>
							<td>
								<form method="GET" action="noticias_en_tapa.php">
								<input name="idCategoria" type="hidden" value="<?php echo $idCategoria; ?>" />
								<input name="col" type="hidden" value="1" />
								<input name="oid" type="hidden" value="<?php echo $noticias_izquierda[$key]["id_noticia_tapa"] ?>" />
								<select name="orden" onchange="this.form.submit();">
								<?php for($num=1;$num<sizeof($noticias_izquierda)+1;$num++): ?>
									<option <?php echo ($num==$key+1) ? 'selected="selected"' : ""; ?> value="<?php echo $num; ?>"><?php echo $num; ?></option>
								<?php endfor ?>
								</select>
								</form>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="mitad">
			<table id="rounded-corner" summary="">
				<thead>
					<tr>
						<th scope="col" class="rounded">Titulo</th>
						<th scope="col" class="rounded">Quitar</th>
						<th scope="col" class="rounded">Orden</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($noticias_derecha as $key => $value): ?>
						<tr>
							<td scope="col" class="rounded"><?php echo $noticias_derecha[$key]["titulo"]; ?></td>
							<td>
								<a class="ask" href="?del=<?php echo $noticias_derecha[$key]["id_noticia_tapa"] ?>&col=2&idCategoria=<?php echo $idCategoria; ?>"><img src="images/trash.png" alt="" title="Ultimo momento" border="0" /></a>
							</td>
							<td>
								<form method="GET" action="noticias_en_tapa.php">
								<input name="idCategoria" type="hidden" value="<?php echo $idCategoria; ?>" />
								<input name="col" type="hidden" value="2" />
								<input name="oid" type="hidden" value="<?php echo $noticias_derecha[$key]["id_noticia_tapa"] ?>" />
								<select name="orden" onchange="this.form.submit();">
								<?php for($num=1;$num<sizeof($noticias_derecha)+1;$num++): ?>
									<option <?php echo ($num==$key+1) ? 'selected="selected"' : ""; ?> value="<?php echo $num; ?>"><?php echo $num; ?></option>
								<?php endfor ?>
								</select>
								</form>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	
		<div class="mitad" style="border-left: 1px solid white;">
			<table id="rounded-corner" summary="">
				<thead>
					<tr>
						<th scope="col" class="rounded">Titulo</th>
						<th scope="col" class="rounded">Quitar</th>
						<th scope="col" class="rounded">Orden</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($noticias_derecha as $key => $value): ?>
						<tr>
							<td scope="col" class="rounded"><?php echo $noticias_derecha[$key]["titulo"]; ?></td>
							<td>
								<a class="ask" href="?del=<?php echo $noticias_derecha[$key]["id_noticia_tapa"] ?>&col=2&idCategoria=<?php echo $idCategoria; ?>"><img src="images/trash.png" alt="" title="Ultimo momento" border="0" /></a>
							</td>
							<td>
								<form method="GET" action="noticias_en_tapa.php?>">
								<input name="idCategoria" type="hidden" value="<?php echo $idCategoria; ?>" />
								<input name="col" type="hidden" value="2" />
								<input name="oid" type="hidden" value="<?php echo $noticias_derecha[$key]["id_noticia_tapa"] ?>" />
								<select name="orden" onchange="this.form.submit();">
								<?php for($num=1;$num<sizeof($noticias_derecha)+1;$num++): ?>
									<option <?php echo ($num==$key+1) ? 'selected="selected"' : ""; ?> value="<?php echo $num; ?>"><?php echo $num; ?></option>
								<?php endfor ?>
								</select>
								</form>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	<?php endif; ?>
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
    	<?php foreach ($noticias as $key => $value): ?>
            <tr>
                <td scope="col" class="rounded"><?php echo $noticias[$key]["fecha"]; ?></td>
                <td scope="col" class="rounded"><?php echo $noticias[$key]["titulo"]; ?></td>
                <td width="400">
				<?php if( empty($_GET["idCategoria"]) ): ?>
                	<a style="display:inline;text-decoration:none;" href="?col=0&id=<?php echo $noticias[$key]["id_noticia"] ?>"><span class="editar">Destacadas</span></a>
				<?php else: ?>
					<a style="display:inline;text-decoration:none;" href="?col=<?php echo $idCategoria; ?>1&id=<?php echo $noticias[$key]["id_noticia"] ?>&idCategoria=<?php echo $idCategoria ?>"><span class="editar"><?php echo $nombreCategoria; ?> destacadas</span></a>
                	<a style="display:inline;text-decoration:none;" href="?col=<?php echo $idCategoria; ?>2&id=<?php echo $noticias[$key]["id_noticia"] ?>&idCategoria=<?php echo $idCategoria ?>"><span class="editar">1er col</span></a>
                    <a style="display:inline;text-decoration:none;" href="?col=<?php echo $idCategoria; ?>3&id=<?php echo $noticias[$key]["id_noticia"] ?>&idCategoria=<?php echo $idCategoria ?>"><span class="editar">2da col </span></a>
					<a style="display:inline;text-decoration:none;" href="?col=<?php echo $idCategoria; ?>4&id=<?php echo $noticias[$key]["id_noticia"] ?>&idCategoria=<?php echo $idCategoria ?>"><span class="editar">3da col </span></a>
				<?php endif; ?>	
                	
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
              
     </div>
  </div>         

<?php include("partes/fotter.php"); ?>