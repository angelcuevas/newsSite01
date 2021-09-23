<?php
    include("./1nclud3s/Config_y_funciones.php");
    include("./1nclud3s/utils.php");
    require_once 'clases/Noticia.php';
    require_once 'clases/Multimedia.php';
    require_once 'clases/Comentario.php';
    require_once 'clases/Columnista.php';
    require_once 'clases/Categoria.php';

    $parametrosDeClases["db"] = $db;
    $parametrosDeClases["config"] = $config;
    $parametrosDeClases["id_noticia"] = $_POST["id_noticia"];  

    $comentario = New Comentario($parametrosDeClases);

    if($_POST){
        $comentario->alta($_POST['nombre'],$_POST['texto']);
    }

    echo $_POST["id_noticia"];
?>