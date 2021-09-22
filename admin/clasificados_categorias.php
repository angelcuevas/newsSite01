<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();

if(!empty($_GET["eliminar_id"])){
    $eliminar_id = $_GET["eliminar_id"];
    mysql_query("DELETE FROM clasificados_categorias WHERE id_categoria = '$eliminar_id'");
    header("Location: clasificados_categorias.php?exito=eliminar");
}

if(!empty($_POST["nombre"])){
    $id_categoria = $_POST["id_categoria"];
    $nombre = $_POST["nombre"];
    if($id_categoria == 0)
        mysql_query("INSERT INTO clasificados_categorias(nombre) VALUES('$nombre') ");
    else
        mysql_query("UPDATE clasificados_categorias SET nombre='$nombre' WHERE id_categoria = '$id_categoria' ");
    header("Location: clasificados_categorias.php?exito=agregar");
}

$categoria["id_categoria"] = "0";
$categoria["nombre"] = "";

if(!empty($_GET["editar_id"])){
    $editar_id = $_GET["editar_id"];
    $categoria = una_consulta("SELECT id_categoria,nombre from clasificados_categorias WHERE id_categoria = '$editar_id'");
}

$categorias = consulta("SELECT id_categoria,nombre from clasificados_categorias WHERE 1 ORDER BY nombre ASC ");

include("partes/top.php");
?>   

    <div class="center_content">  

    <div class="left_content">
        <div class="izq">
            <h2>Agregar/modificar</h2>
            <div class="submenu" style="align=center;">
            <form method="POST" action="" class="cuteform">
            <center>
                <input type="hidden" name="id_categoria" value="<?php echo $categoria["id_categoria"]; ?>">
                <input type="text" name="nombre" value="<?php echo $categoria["nombre"]; ?>">
                <input type="submit" value="Aceptar">
                <?php if($categoria["id_categoria"] != 0) : ?>
                    <input type="button" value="cancelar" onclick="location.href='clasificados_categorias.php'">
                <?php endif ?>
            </center>
            </form>
            </div>
        </div>
    </div>  
    
    <div class="right_content">            
    <?php include("mensajes.php"); ?>
    <h2>Categorias de clasificados</h2> 

        <table id="rounded-corner" summary="">
            <thead>
            	<tr>
                    <th scope="col" class="rounded-company">Nombre</th>
                    <th scope="col" class="rounded">Editar</th>
                    <th scope="col" class="rounded-q4">borrar</th>
                </tr>
            </thead>
            <tbody>
            	<?php foreach ($categorias as $key => $value): ?>
                    <tr>
                        <td scope="col" class="rounded"><?php echo $categorias[$key]["nombre"]; ?></td>
                        <td width="52"><a href="?editar_id=<?php echo $categorias[$key]["id_categoria"] ?>" class="editar"><span>Editar</span></a></td>
                        <td width="52"><a href="?eliminar_id=<?php echo $categorias[$key]["id_categoria"] ?>" class="borrar ask"><span>Borrar</span></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
           
     </div>
  </div>  

<?php include("partes/fotter.php"); ?>
