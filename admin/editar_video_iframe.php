<?php
include("includes/db.inc.php");
include("includes/image.inc.php");
conectar();
$editar_id = $_GET["editar_id"];

if(!empty($_POST)){
    $url = $_POST["url"];
    $descripcion = $_POST["descripcion"];
    mysql_query("UPDATE noticias_videos SET url = '$url', descripcion = '$descripcion' WHERE id_video = '$editar_id'");
}

if(!empty($_GET["editar_id"])){
    $editar_id = $_GET["editar_id"];
    $video = una_consulta("SELECT id_video,url,descripcion from noticias_videos WHERE id_video = '$editar_id' ");
}else{die("Seleccione una video");}

desconectar();
?>
<!DOCTYPE>
<html>
<head>
<title>videos</title>
<link rel="stylesheet" type="text/css" href="css/paginacion.css" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">
body{
    background: #FFF;
}
</style>
</head>
<body>
    <div class="album">
        <div class="agregarnoticia" style="float:left;margin-top:20px;">
            <form method="POST" class="niceform" enctype="multipart/form-data">
                <label>Link</label>
                <input type="text" style="width:500px;" name="url" value="<?php echo $video["url"] ?>" /> <br \>
                <label>Descripci&oacute;</label>
                <input type="text" style="width:500px;" name="descripcion" value="<?php echo $video["descripcion"] ?>" /> <br \>
                <input type="submit" value="Guardar" />
            </form>
        </div>
    </div>
</body>
</html>