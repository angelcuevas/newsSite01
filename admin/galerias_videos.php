<?php
include("includes/db.inc.php");
include("includes/funciones.inc.php");
conectar();

$galeria["id_galeria"] = "0";
$galeria["nombre"] = "";
$galeria["descripcion"] = "";

if(isset($_GET["eliminar_video_id"])){
	$eliminar_video_id = $_GET["eliminar_video_id"];
	mysql_query("DELETE from galerias_videos WHERE id_video  = '$eliminar_video_id'");
    header("Location: galerias_videos.php?editar_id=" . $_GET["editar_id"] . "&exito=eliminar");
}

if(!empty($_GET["eliminar_id"])){
	$eliminar_id = $_GET["eliminar_id"];
//<Eliminar>
    $videos = una_consulta("SELECT url from galerias_videos WHERE id_galeria = '$eliminar_id'");
    foreach ($videos as $key => $value) {
        unlink($config["videos_galerias"] . $videos[$key]["url"]);
    }
	mysql_query("DELETE from galerias_videos WHERE id_galeria = '$eliminar_id'");
//</Eliminar>
	mysql_query("DELETE from galerias WHERE id_galeria = '$eliminar_id'");
	$reordenar = consulta("SELECT id_galeria FROM galerias WHERE tipo = 1 ORDER BY ubicacion ASC");
	foreach ($reordenar as $key => $value) {
		$ubc = $key + 1;
		mysql_query("UPDATE galerias SET ubicacion = '$ubc' WHERE id_galeria = '$value[id_galeria]'");
	}
    header("Location: galerias_videos.php?&exito=eliminar");
}

if(!empty($_GET["activar"])){
	$activar_id = $_GET["activar"];
	mysql_query("UPDATE galerias SET muestra = NOT muestra WHERE id_galeria = '$activar_id'");
	header("Location: galerias_videos.php?&exito=activar");
}

if(!empty($_GET["orden"])){
	$id = $_GET["oid"];
	$orden = $_GET["orden"];
    $ubicacion_actual = una_consulta("SELECT ubicacion FROM galerias WHERE id_galeria = '$id'");
    $ubicacion_actual = $ubicacion_actual["ubicacion"];
    mysql_query("UPDATE galerias SET ubicacion = '$ubicacion_actual' WHERE ubicacion = '$orden' AND tipo = 1");
    mysql_query("UPDATE galerias SET ubicacion = '$orden' WHERE id_galeria = '$id' AND tipo = 1");
	header("Location: galerias_videos.php?&exito=orden");
}

if(!empty($_POST)){
	$id_galeria = limpiar($_POST["id_galeria"]);
	$nombre = limpiar($_POST["nombre"]);
	$descripcion = limpiar($_POST["descripcion"]);
	
	if($id_galeria == 0){
		$ubicacion = una_consulta("SELECT max(ubicacion) as ubicacion FROM galerias WHERE tipo = 1 ");
		$ubicacion = (int) $ubicacion["ubicacion"] + 1;
		$sql = "INSERT INTO galerias(nombre,descripcion,ubicacion,muestra,tipo) VALUES('$nombre','$descripcion','$ubicacion',0,1)";
		mysql_query($sql);
   		header("Location: galerias_videos.php?exito=agregar");
	}else{
		$sql = "UPDATE galerias SET nombre='$nombre', descripcion='$descripcion' WHERE id_galeria = '$id_galeria'";
		mysql_query($sql);
   		header("Location: galerias_videos.php?exito=actualizar");
	}
}

if(!empty($_GET["editar_id"])){
	$editar_id = $_GET["editar_id"];
	$galeria = una_consulta("SELECT id_galeria,nombre,descripcion,ubicacion,muestra FROM galerias WHERE id_galeria = '$editar_id'");
}

$galerias = consulta("SELECT id_galeria,nombre,descripcion,ubicacion,muestra FROM galerias WHERE tipo = 1  ORDER BY ubicacion ASC");

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
				<input type="button" value="Cancelar" onclick="location.href='galerias_videos.php'">				
				<?php endif ?>
			</form>
            </div>
	</div>
	<div class="right_content">
	<?php include("mensajes.php"); ?>	
		<h2>Galerias de videos</h2>
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
                    <a href="?activar=<?php echo $galerias[$key]["id_galeria"]; ?>"><img src="images/<?php echo ($galerias[$key]["muestra"]) ? "visto" : "user_logout" ; ?>.png" alt="" title="" border="0" /></a>
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
						<!--
						<a href="?eliminar_id=<?php echo $galerias[$key]["id_galeria"]; ?>" class="borrar ask"><span>Borrar</span></a> -->
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
			$video["id_video"] = 0;
			$video["descripcion"] = "";
			$video["url"] = "";
			$video["tipo"] = 1;
			if(!empty($_GET["video_id"])){
						$video_id = $_GET["video_id"];
						$video = una_consulta("SELECT * FROM galerias_videos WHERE id_video = '$video_id'");
			}
		?>
		<div class="galeria">
			<div class="galeria_form" style="width:220px;margin:20px 46px;display:inline-block;">
				<form action="a_agregar_galerias_videos.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $galeria["id_galeria"]; ?>">
					<input type="hidden" name="id_video" value="<?php echo $video["id_video"]; ?>">
					<label>Video de youtube</label>
					<?php if ($video["id_video"]): ?>
						: <?php echo $video["url"] ?>
						<a class="editar" href="http://www.youtube.com/watch?v=<?php echo $video["url"] ?>" target="_blank">Ver</a>
						<a class="borrar" href="?editar_id=<?php echo $galeria["id_galeria"] ?>&eliminar_video_id=<?php echo $video["id_video"] ?>">
							Borrar
						</a>
					<?php endif ?>
					<input type="hidden" name="video" id="file" <?php echo ($video["tipo"]) ? "disabled" : "" ?> >
					<fieldset id="ytf" style="display:inline;border:1px solid #ccc;" <?php echo (!$video["tipo"]) ? "disabled" : "" ?>>
						  <legend style="display:inline;">
						    <label>
						      <input type="checkbox" onchange="form.ytf.disabled = !checked;form.file.disabled = checked" style="display:none;" <?php echo ($video["tipo"]) ? "checked" : "" ?>>
						      Codigo de Youtube
						    </label>
						  </legend>
						<input type="text" name="yt" value="<?php echo $video["url"] ?>">
					<label>Descripci&oacute;n</label>
					<textarea name="descripcion"><?php echo $video["descripcion"] ?></textarea>
					</fieldset>
					<input type="submit" value="Guardar">
					<?php if ($video["id_video"]): ?>
						<input type="button" value="Cancelar" onclick="location.href='galerias_videos.php?editar_id=<?php echo $editar_id ?>#titulo'">				
					<?php endif ?>
				</form>
			</div>

			<div class="lista_multimedia" style="width:300px;display:inline-block;">
				<?php 
					$videos = consulta("SELECT * FROM galerias_videos WHERE id_galeria = '" . $galeria["id_galeria"] . "'");
				?>
				<table id="rounded-corner">
					<thead>
						<tr>
							<td>Video</td>
							<td>Descripci&oacute;n</td>
						</tr>
					</thead>
					<tbody>
				<?php foreach($videos as $key => $value): ?>
						<tr>
							<td>
								<a title="<?php echo $videos[$key]["descripcion"] ?>" href="galerias_videos.php?editar_id=<?php echo $galeria["id_galeria"] ?>&video_id=<?php echo $videos[$key]["id_video"] ?>#titulo"><label><?php echo $videos[$key]["url"] ?></label></a>
								</td>
							<td><?php echo $videos[$key]["descripcion"] ?></td>
						</tr>
				<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div> 
		<?php endif ?>
	</div>
</div>                    
<?php include("partes/fotter.php"); ?>