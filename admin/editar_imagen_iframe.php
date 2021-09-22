<?php
include("includes/db.inc.php");
include("includes/image.inc.php");
conectar();
$editar_id = $_GET["editar_id"];
if(!empty($_POST)){
    $descripcion = $_POST["descripcion"];
    $foto_archivo = $_FILES["foto"]["name"];
    
    if(empty($foto_archivo)){
    mysql_query("UPDATE noticias_fotos SET descripcion = '$descripcion' WHERE id_foto = '$editar_id'");
    }
    else{
    $nombre_imagen_final =  $editar_id . "_" . date(time()) . ".jpg";
    cargar_archivo("foto",$config["imagenes"] . $nombre_imagen_final,"image/jpeg");
    mysql_query("UPDATE noticias_fotos SET url = '$nombre_imagen_final' ,descripcion = '$descripcion' WHERE id_foto = '$editar_id'");
    }
}

if(!empty($_GET["editar_id"])){
    $editar_id = $_GET["editar_id"];
    $foto = una_consulta("SELECT id_foto,url,descripcion from noticias_fotos WHERE id_foto = $editar_id ");
}else{die("Seleccione una foto");}

desconectar();
?>
<!DOCTYPE>
<html>
<head>
<title>fotos</title>
<link rel="stylesheet" type="text/css" href="css/paginacion.css" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<style type="text/css">
body{
    background: #FFF;
}
</style>
</head>
<body>
    <div class="album">
        <div class="fotocontenedor" style="float:left;">
            <img src="<?php echo $config["imagenes"] . $foto["url"] ?>_t.jpg" class="foto" />
        </div>
        <div class="agregarnoticia" style="float:left;margin-top:20px;">
            <form method="POST" class="niceform" enctype="multipart/form-data">
                <textarea style="width:400px;height:80px;" name="descripcion" ><?php echo $foto["descripcion"] ?></textarea>
                <input type="file" size="40" name="foto"/><br \>
                <input type="submit" value="Guardar" />
            </form>
        </div>
    </div>
</body>
</html>
