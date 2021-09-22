<?php
include("../includes/db.inc.php");
conectar();
$id_video = mysql_real_escape_string($_GET["id"]);
$video = consulta("SELECT url,descripcion,tipo FROM galerias_videos WHERE id_video = $id_video LIMIT 1");
desconectar();
?>
<?php if (!$video["tipo"]): ?>
<div class="ver_video">
	<video width="320" height="240" controls>
	<source src="<?php echo $config["videos_galerias"] . $video["url"]; ?>" type="<?php echo ($config["videos_galerias"] . $video["url"]); ?>">
	 Tu navegador no soporta videos, actualizalo o utiliza uno diferente.
	</video> 
</div>
<?php endif ?>
