<?php
include("includes/db.inc.php");
include("includes/image.inc.php");
conectar();
$editar_id = $_GET["editar_id"];
if(!empty($_POST)){
    $descripcion = $_POST["descripcion"];
    $audio_archivo = $_FILES["audio"]["name"];
    
    if(empty($audio_archivo)){
    mysql_query("UPDATE noticias_audios SET descripcion = '$descripcion' WHERE id_audio = '$editar_id'");
    }
    else{
    $nombre_audio =  $editar_id . "_" . date(time()) . ".jpg";
    cargar_archivo("audio",$config["audios"] . $nombre_audio,"audio/mpeg");
    mysql_query("UPDATE noticias_audios SET url = '$nombre_audio' ,descripcion = '$descripcion' WHERE id_audio = '$editar_id'");
    }
}

if(!empty($_GET["editar_id"])){
    $editar_id = $_GET["editar_id"];
    $audio = una_consulta("SELECT id_audio,url,descripcion from noticias_audios WHERE id_audio = '$editar_id' ");
}else{die("Seleccione una audio");}

desconectar();
?>
<!DOCTYPE>
<html>
<head>
<title>Audio</title>
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
                <label>Descripci&oacute;n</label>
                <input type="text" size="53" name="descripcion" value="<?php echo $audio["descripcion"] ?>" /> <br \>
                <label>Audio</label>
                <input type="file" size="40" name="audio"/><br \>
                <input type="submit" value="Guardar" />
            </form>
        </div>
    </div>
</body>
</html>