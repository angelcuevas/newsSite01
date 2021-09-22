<?php
include("includes/db.inc.php");
include("includes/image.inc.php");
include("includes/funciones.inc.php");
conectar();

if(!empty($_POST)){
	$anio = $_POST["anio"];
	$edicion = $_POST["edicion"];
	$fecha = $_POST["fecha"];
	$foto = $_FILES["foto"]["name"];

	if(!empty($foto)){

		$directio = $config["imagenes_ediciones"];
		$nombre_imagen_final = $anio . "_" . $edicion . "_" . $fecha . "_" . date(time()) . ".jpg";
		$nombre_imagen = $directio . $nombre_imagen_final;
		
		if(cargar_archivo("foto",$nombre_imagen,"image/jpeg")){
			$foto = $nombre_imagen_final;
		}else{
			$foto = "";
		}
	}

	mysql_query("INSERT INTO edicion_hoy(anio,edicion,fecha,foto) VALUES('$anio','$edicion','$fecha','$foto')");
    header("Location: hoy.php?exito=agregar");
}

$hoy = una_consulta("SELECT anio,edicion,fecha,foto FROM edicion_hoy ORDER BY id_edicion DESC LIMIT 1");

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
		<h2>Edicion de Hoy</h2>
		<div class="largo">
		<form action="" method="POST" enctype="multipart/form-data">
			<label>Año</label>
			<input type="text" name="anio" placeholder="LIV" value="<?php echo $hoy["anio"] ?>" required>
			<label>Edici&oacute;n</label>
			<input type="number" name="edicion" placeholder="edicion" value="<?php echo $hoy["edicion"] ?>" required>
			<label>Fecha</label>
			<input type="fecha" id="sfecha" name="fecha" placeholder="fecha" value="<?php echo $hoy["fecha"] ?>" required>
			<label>Foto</label>
			<input type="file" name="foto">
			<br />
			<input type="submit" value="Guardar">
			</div>
		</form>
		<br />
		<h2> Ultima edici&oacute;n </h2>
		<div style="border:1px dashed #ccc;padding:20px;text-align:center;">
			
			Año: <label><?php echo $hoy["anio"] ?></label><br />
			Edicion: <label><?php echo $hoy["edicion"] ?></label><br />
			Fecha: <label><?php echo fecha($hoy["fecha"],FALSE) ?></label><br />

			<img style="width:485px" src="../imagenes/ediciones/<?php echo $hoy["foto"] ?>">
		</div>
	</div>
</div>                    
<?php include("partes/fotter.php"); ?>