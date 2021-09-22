<?php
include("includes/db.inc.php");
include("includes/image.inc.php");
conectar();


if(!empty($_GET["eliminar_id"])){
	$eliminar_id = $_GET["eliminar_id"];
	mysql_query("DELETE FROM eventos WHERE id_evento = '$eliminar_id'");
	header("Location: eventos.php?exito=eliminar");
}

if(!empty($_POST)){
	$id_evento = $_POST["id_evento"];
	$titulo = $_POST["titulo"];
	$texto = $_POST["texto"];
	$fecha = $_POST["fecha"];
	$imagen = (!empty($_FILES["imagen"]["name"])) ? TRUE : FALSE;

	if($imagen){
		$directio = $config["imagenes_eventos"];
		$nombre_imagen_final =  $id_evento . "_" . date(time()) . ".jpg";
		$nombre_imagen = $directio . $nombre_imagen_final;
		if(cargar_archivo("imagen",$nombre_imagen,"image/jpeg")){
			$imagen = $nombre_imagen_final;
		}
		else{
			$imagen = "";
		}
	}

	if($id_evento == 0){
		mysql_query("INSERT INTO eventos(titulo,texto,fecha,imagen) VALUES('$titulo','$texto','$fecha','$imagen')");
			header("Location: eventos.php?exito=agregar");
	}else{
		if($imagen == ""){
			mysql_query("UPDATE eventos SET titulo = '$titulo', texto = '$texto', fecha = '$fecha' WHERE id_evento = '$id_evento' ");
			header("Location: eventos.php?exito=actualizar");
		}else{
			mysql_query("UPDATE eventos SET titulo = '$titulo', texto = '$texto', fecha = '$fecha', imagen = '$imagen' WHERE id_evento = '$id_evento' ");
			}
			header("Location: eventos.php?exito=actualizar");
	}	
}

$evento["id_evento"] = 0;
$evento["fecha"] = date("Y-m-d H:i");
$evento["titulo"] = "";
$evento["texto"] = "";

if(!empty($_GET["editar_id"])){
	$editar_id = $_GET["editar_id"];
	$evento = una_consulta("SELECT id_evento, titulo, texto, fecha FROM eventos WHERE id_evento = '$editar_id' ");
}

$eventos = consulta("SELECT id_evento,titulo,texto,fecha,imagen FROM eventos WHERE 1 ORDER BY fecha DESC");
include("partes/top.php");
?>                                    
<div class="center_content">

    <div class="left_content">
        <div class="izq">
            <h2>Sin acciones</h2>
		</div>
	</div>

	<div class="right_content">
		
		<?php include("mensajes.php"); ?>
		
		<h2>Eventos</h2>
		<table id="rounded-corner">
			<thead>
				<tr>
					<th class="rounded-company">Fecha</th>
					<th>Titulo</th>
					<th width="5">Editar</th>
					<th class="rounded-q4" width="5">Borrar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($eventos as $key => $value): ?>
					<tr>
						<td><?php echo $eventos[$key]["fecha"] ?></td>
						<td><?php echo $eventos[$key]["titulo"] ?></td>
						<td width="52"><a href="?editar_id=<?php echo $eventos[$key]["id_evento"] ?>" class="editar"><span>Editar</span></a></td>
						<td width="52"><a href="?eliminar_id=<?php echo $eventos[$key]["id_evento"] ?>" class="borrar ask"><span>Borrar</span></a></td>
					</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr><td colspan="4"></td></tr>
			</tfoot>
		</table>
		<br />
		<h2><?php echo ($evento["id_evento"]) ? "Editando: " . $evento["titulo"] : "Agregar" ?></h2>
		<div class="largo">
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id_evento" value="<?php echo $evento["id_evento"] ?>">
			<label>Fecha</label>
			<input type="text" name="fecha" class="fecha" value="<?php echo $evento["fecha"] ?>">
			<label>Titulo</label>
			<input type="text" name="titulo" value="<?php echo $evento["titulo"] ?>" required>
			<label>Cuerpo</label>
			<textarea name="texto"><?php echo $evento["texto"] ?></textarea>
			<br />
			<label>Imagen</label>
			<input type="file" name="imagen">
			<br />
			<input type="submit" value="Guardar">
			<?php if ($evento["id_evento"]): ?>
				<input type="button" value="Cancelar" onclick="location.href='eventos.php'">
			<?php endif ?>
		</form>
		</div>
	</div>
</div>                    
<script type="text/javascript">
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<?php include("partes/fotter.php"); ?>