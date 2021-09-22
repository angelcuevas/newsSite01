<?php
include("includes/db.inc.php");
include("includes/funciones.inc.php");
conectar();

$galeria["id_galeria"] = "0";
$galeria["nombre"] = "";
$galeria["descripcion"] = "";

if(!empty($_GET["eliminar_foto_id"])){
	$eliminar_foto_id = $_GET["eliminar_foto_id"];
	$foto = una_consulta("SELECT url from galerias_fotos WHERE id_foto = '$eliminar_foto_id'");
	unlink($config["imagenes_galerias"] . $foto["url"]);
	unlink($config["imagenes_galerias"] . $foto["url"] . "_t.jpg");
	mysql_query("DELETE from galerias_fotos WHERE id_foto = '$eliminar_foto_id'");
    header("Location: galerias_imagenes.php?&exito=eliminar");
}

if(!empty($_GET["eliminar_id"])){
	$eliminar_id = $_GET["eliminar_id"];
//<Eliminar>
	$fotos = consulta("SELECT url from galerias_fotos WHERE id_galeria = '$eliminar_id'");
	foreach ($fotos as $key => $value) {
		unlink($config["imagenes_galerias"] . $fotos[$key]["url"]);
		unlink($config["imagenes_galerias"] . $fotos[$key]["url"] . "_t.jpg");
	}
	mysql_query("DELETE from galerias_fotos WHERE id_galeria = '$eliminar_id'");
//</Eliminar>
	mysql_query("DELETE from galerias WHERE id_galeria = '$eliminar_id'");
	$reordenar = consulta("SELECT id_galeria FROM galerias WHERE tipo = 0 ORDER BY ubicacion ASC");
	foreach ($reordenar as $key => $value) {
		$ubc = $key + 1;
		mysql_query("UPDATE galerias SET ubicacion = '$ubc' WHERE id_galeria = '$value[id_galeria]'");
	}
    header("Location: galerias_imagenes.php?&exito=eliminar");
}

if(!empty($_GET["activar"])){
	$activar_id = $_GET["activar"];
	mysql_query("UPDATE galerias SET muestra = NOT muestra WHERE id_galeria = '$activar_id'");
	header("Location: galerias_imagenes.php?&exito=activar");
}

if(!empty($_GET["orden"])){
	$id = $_GET["oid"];
	$orden = $_GET["orden"];
    $ubicacion_actual = una_consulta("SELECT ubicacion FROM galerias WHERE id_galeria = '$id'");
    $ubicacion_actual = $ubicacion_actual["ubicacion"];
    mysql_query("UPDATE galerias SET ubicacion = '$ubicacion_actual' WHERE ubicacion = '$orden' AND tipo = 0");
    mysql_query("UPDATE galerias SET ubicacion = '$orden' WHERE id_galeria = '$id'");
	header("Location: galerias_imagenes.php?&exito=orden");
}

if(!empty($_POST)){
	$id_galeria = limpiar($_POST["id_galeria"]);
	$nombre = limpiar($_POST["nombre"]);
	$descripcion = limpiar($_POST["descripcion"]);
	
	if($id_galeria == 0){
		$ubicacion = una_consulta("SELECT max(ubicacion) as ubicacion WHERE tipo = 0 FROM galerias");
		$ubicacion = (int) $ubicacion["ubicacion"] + 1;
		$sql = "INSERT INTO galerias(nombre,descripcion,ubicacion,muestra,tipo) VALUES('$nombre','$descripcion','$ubicacion',0,0)";
		mysql_query($sql);
   		header("Location: galerias_imagenes.php?exito=agregar");
	}else{
		$sql = "UPDATE galerias SET nombre='$nombre', descripcion='$descripcion' WHERE id_galeria = '$id_galeria'";
		mysql_query($sql);
   		header("Location: galerias_imagenes.php?exito=actualizar");
	}
}

if(!empty($_GET["editar_id"])){
	$editar_id = $_GET["editar_id"];
	$galeria = una_consulta("SELECT id_galeria,nombre,descripcion,ubicacion,muestra FROM galerias WHERE id_galeria = '$editar_id'");
}

$galerias = consulta("SELECT galerias.id_galeria,galerias.nombre,descripcion,ubicacion,muestra,galerias_especiales.nombre as especial FROM galerias LEFT JOIN galerias_especiales ON galerias.id_galeria = galerias_especiales.id_galeria WHERE tipo = 0 ORDER BY ubicacion ASC");

include("partes/top.php");
?>
<div class="center_content">
    <div class="left_content">
            <div class="izq">
            <h2>Agregar/modificar</h2>
			<form method="POST">
				<input type="hidden" name="id_galeria" value="<?php echo $galeria["id_galeria"] ?>">
				<label>Nombre</label>
				<input type="text" name="nombre" id="nombre" value="<?php echo $galeria["nombre"] ?>">
				<label>Descripci&oacute;n</label>
				<textarea name="descripcion"><?php echo $galeria["descripcion"] ?></textarea>
				<input type="submit" value="Guardar">
				<?php if ($galeria["id_galeria"]): ?>
				<input type="button" value="Cancelar" onclick="location.href='galerias_imagenes.php'">				
				<?php endif ?>
			</form>
            </div>
	</div>
	<div class="right_content">

	<?php include("mensajes.php"); ?>
		
		<h2>Galerias de imagenes</h2>
		<table id="rounded-corner">
			<thead>
				<tr>
				<th class="rounded-company">Nombre</th>
				<th>Descripci&oacute;n</th>
				<th>Activa</th>
				<th>Orden</th>
				<th>Editar</th>
				<th class="rounded-q4">Borrar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($galerias as $key => $value): ?>
				<tr>
					<td><?php echo $galerias[$key]["nombre"]; ?></td>
					<td><?php echo $galerias[$key]["descripcion"]; ?></td>
					<td>
                    <?php if (empty($galerias[$key]["especial"])): ?>
                  		<a href="?activar=<?php echo $galerias[$key]["id_galeria"]; ?>"><img src="images/<?php echo ($galerias[$key]["muestra"]) ? "visto" : "user_logout" ; ?>.png" alt="" title="" border="0" /></a>
					<?php endif ?>
					</td>
					<td>
	                	<form method="GET" action="">
		                	<input name="oid" type="hidden" value="<?php echo $galerias[$key]["id_galeria"] ?>" />
		                	<select name="orden" onchange="this.form.submit();">
		    				<?php for($num=1;$num<sizeof($galerias)+1;$num++): ?>
		                		<option <?php echo ($num==$key+1) ? 'selected="selected"' : ""; ?> value="<?php echo $num; ?>"><?php echo $num; ?></option>
		                	<?php endfor ?>
			               	</select>
		               	</form>
					</td>	
					<td width="52"><a href="?editar_id=<?php echo $galerias[$key]["id_galeria"]; ?>" class="editar"><span>Editar</span></a></td>
					<td width="52">
                    <?php if (empty($galerias[$key]["especial"])): ?>
                    	<a href="?eliminar_id=<?php echo $galerias[$key]["id_galeria"]; ?>" class="borrar ask"><span>Borrar</span></a>
					<?php endif ?>
                    </td>
				</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr><td colspan="6"></td></tr>
			</tfoot>
		</table>

		<?php if ($galeria["id_galeria"]): ?>
		<br />
		<h2 id="titulo"><?php echo $galeria["nombre"] ?></h2>
		<?php
			$imagen["id_foto"] = 0;
			$imagen["descripcion"] = "";
			if(!empty($_GET["imagen_id"])){
						$imagen_id = $_GET["imagen_id"];
						$imagen = una_consulta("SELECT * FROM galerias_fotos WHERE id_foto = '$imagen_id'");
			}
		?>
		<div class="galeria">
			<div class="galeria_form" style="width:220px;float:left;margin:20px 46px;">
				<form action="a_agregar_galerias_fotos.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $galeria["id_galeria"]; ?>">
					<input type="hidden" name="id_foto" value="<?php echo $imagen["id_foto"]; ?>">
					<?php if ($imagen["id_foto"]): ?>
						<a class="editar" href="<?php echo $config["imagenes_galerias"] . $imagen["url"] ?>" target="_blank"><?php echo $imagen["url"] ?> Ver</a>
						<a href="?eliminar_foto_id=<?php echo $imagen["id_foto"] ?>" class="borrar">Elminar</a>				
					<?php endif ?>
					<input type="file" name="imagen">
					<label>Descripci&oacute;n</label>
					<textarea name="descripcion"><?php echo $imagen["descripcion"] ?></textarea>
					<input type="submit" value="Guardar">
					<?php if ($imagen["id_foto"]): ?>
						<input type="button" value="Cancelar" onclick="location.href='galerias_imagenes.php?editar_id=<?php echo $editar_id ?>#titulo'">				
					<?php endif ?>
				</form>
			</div>
			<br />
			<div>
				<?php 
					$imagenes = consulta("SELECT * FROM galerias_fotos WHERE id_galeria = '" . $galeria["id_galeria"] . "'");
				?>
				<?php foreach($imagenes as $key => $value): ?>
				<a href="galerias_imagenes.php?editar_id=<?php echo $galeria["id_galeria"] ?>&imagen_id=<?php echo $imagenes[$key]["id_foto"] ?>#titulo">
				<img src="<?php echo $config["imagenes_galerias"].$imagenes[$key]["url"] ?>_t.jpg" title="<?php echo $imagenes[$key]["descripcion"] ?>">
				</a>
				<?php endforeach ?>
			</div>
		</div> 
		<?php endif ?>

	</div>
</div>                    
<?php include("partes/fotter.php"); ?>