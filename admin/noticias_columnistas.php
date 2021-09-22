<?php
include("includes/db.inc.php");
include("includes/image.inc.php");
include("includes/paginador.php");
conectar();
if(!empty($_GET["eliminar_id"])){
    $eliminar_id = $_GET["eliminar_id"];
    mysql_query("DELETE FROM noticias_columnistas WHERE id_columnista = '$eliminar_id'");
    header("Location: noticias_columnistas.php?exito=eliminar");
}

if(!empty($_POST["nombre"])){
    $id_columnista = $_POST["id_columnista"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $descripcion = $_POST["descripcion"];

    $imagen = (!empty($_FILES["imagen"]["name"])) ? TRUE : FALSE;

    if($imagen){
        $directio = $config["imagenes_columnistas"];
        $nombre_imagen_final =  date(time()) . ".jpg";
        $nombre_imagen = $directio . $nombre_imagen_final;
        
        /*if(cargar_archivo("imagen",$nombre_imagen,"image/jpeg")){
            $imagen = $nombre_imagen_final;
        }
        else{
            $imagen = "";
        }*/
        if(thumbnail($_FILES["imagen"]['tmp_name'], $nombre_imagen, $config["miniatura_width"],$config["miniatura_height"],$config["imagenes_calidad"])){
            $imagen = $nombre_imagen_final;
            thumbnail($_FILES["imagen"]['tmp_name'], $nombre_imagen . "_t.jpg", 86,78,$config["imagenes_calidad"]);
        }else{
            $imagen = "";
        }
    }


    if($id_columnista == 0)
        mysql_query("INSERT INTO noticias_columnistas(nombre,tipo,descripcion,foto) VALUES('$nombre','$tipo','$descripcion','$imagen')");
    else
        if ($imagen == "")
        mysql_query("UPDATE noticias_columnistas SET nombre='$nombre',tipo='$tipo',descripcion='$descripcion' WHERE id_columnista = '$id_columnista' ");
        else
        mysql_query("UPDATE noticias_columnistas SET nombre='$nombre',tipo='$tipo',descripcion='$descripcion',foto='$imagen' WHERE id_columnista = '$id_columnista' ");
    echo mysql_error();


    header("Location: noticias_columnistas.php?exito=actualizar");
}

$columnista["id_columnista"] = "0";
$columnista["nombre"] = "";
$columnista["tipo"] = "0";
$columnista["descripcion"] = "";

if(!empty($_GET["editar_id"])){
    $editar_id = $_GET["editar_id"];
    $columnista = una_consulta("SELECT id_columnista,nombre,tipo,descripcion from noticias_columnistas WHERE id_columnista = '$editar_id'");
}

$columnistas = consulta("SELECT id_columnista,nombre,tipo,descripcion,foto from noticias_columnistas WHERE 1 ORDER BY nombre ASC");

include("partes/top.php");
?>   

    <div class="center_content">  

    <div class="left_content">
        <div class="izq">
            <h2>Agregar/modificar</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="id_columnista" value="<?php echo $columnista["id_columnista"]; ?>">
                <label>Nombre</label>
                <input type="text" name="nombre" value="<?php echo $columnista["nombre"]; ?>">
                <label>Tipo</label>
                <select name="tipo">
                    <option <?php echo ($columnista["tipo"] == 0) ? 'selected="selected"' : "" ?> value="0">Columnista</option>
                </select>
                <textarea name="descripcion"><?php echo $columnista["descripcion"]; ?></textarea>
                <input type="file" name="imagen" value="">
                <input type="submit" class="center" value="Aceptar">
                <?php if($columnista["id_columnista"] != 0) : ?>
                    <input type="button" class="center" value="cancelar" onclick="location.href='noticias_columnistas.php'">
                <?php endif ?>
            </form>
        </div>
    </div>  

    <div class="right_content">

    <?php include("mensajes.php"); ?>    
        
    <h2>Columnistas</h2> 

        <table id="rounded-corner" summary="">
            <thead>
                <tr>
                    <th scope="col" class="rounded-company">Nombre</th>
                    <th scope="col" class="rounded">Tipo</th>
                    <th scope="col" class="rounded">Editar</th>
                    <th scope="col" class="rounded-q4">borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($columnistas as $key => $value): ?>
                    <tr>
                        <td scope="col" class="rounded"><?php echo $columnistas[$key]["nombre"]; ?></td>
                        <td scope="col" class="rounded"><?php echo ($columnistas[$key]["tipo"] == 0) ? "Columnista" : "Corresponsal" ?></td>
                        <td width="52"><a href="?editar_id=<?php echo $columnistas[$key]["id_columnista"] ?>" class="editar"><span>Editar</span></a></td>
                        <td width="52"><a href="?eliminar_id=<?php echo $columnistas[$key]["id_columnista"] ?>" class="borrar ask"><span>Borrar</span></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
           
     </div>
  </div>

<?php include("partes/fotter.php"); ?>
