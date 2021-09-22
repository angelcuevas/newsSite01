<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();

if(!empty($_GET["eliminar_id"])){
    $eliminar_id = $_GET["eliminar_id"];
    mysql_query("DELETE FROM noticias_categorias WHERE id_categoria = '$eliminar_id'");
    header("Location: noticias_categorias.php?exito=eliminar");
}

if(!empty($_POST["nombre"])){
    $id_categoria = $_POST["id_categoria"];
    $nombre = mysql_real_escape_string($_POST["nombre"]);
    if($id_categoria == 0):
        mysql_query("INSERT INTO noticias_categorias(nombre) VALUES('$nombre') ");
        header("Location: noticias_categorias.php?exito=agregar");
    else:
        mysql_query("UPDATE noticias_categorias SET nombre='$nombre'WHERE id_categoria = '$id_categoria' ");
        header("Location: noticias_categorias.php?exito=actualizar");
    endif;
    
}

$categoria["id_categoria"] = "0";
$categoria["nombre"] = "";

if(!empty($_GET["editar_id"])){
    $editar_id = $_GET["editar_id"];
    $categoria = una_consulta("SELECT id_categoria,nombre from noticias_categorias WHERE id_categoria = '$editar_id'");
}

$categorias = consulta("SELECT id_categoria,nombre from noticias_categorias WHERE 1 ORDER BY nombre ASC ");

include("partes/top.php");
?>   

    <div class="center_content">  

    <div class="left_content">
        <div class="izq">
            <h2>Agregar/modificar</h2>
            <div class="submenu" style="align=center;">
            <form method="POST" action="" class="cuteform">
                <input type="hidden" name="id_categoria" value="<?php echo $categoria["id_categoria"]; ?>">
                <input type="text" name="nombre" value="<?php echo $categoria["nombre"]; ?>">
                <input type="submit" value="Aceptar">
                <?php if($categoria["id_categoria"] != 0) : ?>
                    <input type="button" value="cancelar" onclick="location.href='noticias_categorias.php'">
                <?php endif ?>
            </form>
            </div>
        </div>
    </div>  
    
    <div class="right_content">            
    <?php include("mensajes.php"); ?>    
    <h2>Categorias de noticias</h2> 

        <table id="rounded-corner" summary="">
            <thead>
            	<tr>
                    <th scope="col" class="rounded-company">Nombre</th>
                    <th width="52" scope="col" class="rounded">Editar</th>
                    <th width="52" scope="col" class="rounded-q4">borrar</th>
                </tr>
            </thead>
            <tbody>
            	<?php foreach ($categorias as $key => $value): ?>
                    <tr>
                        <td scope="col" class="rounded"><?php echo $categorias[$key]["nombre"]; ?></td>
                        <td><a class="editar" href="?editar_id=<?php echo $categorias[$key]["id_categoria"] ?>"><span>Editar</span></a></td>
                        <td><a href="?eliminar_id=<?php echo $categorias[$key]["id_categoria"] ?>" class="borrar ask"><span>Borrar</span></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
           
     </div>
  </div>  

<?php include("partes/fotter.php"); ?>
