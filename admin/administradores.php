<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();

if(!empty($_GET["eliminar_id"])){
    $eliminar_id = $_GET["eliminar_id"];
    mysql_query("DELETE FROM administradores WHERE id_administrador = '$eliminar_id'");
    header("Location: administradores.php?exito=eliminar");
}

if(!empty($_POST)){
    $editar_id = (int) $_POST["id"];
    $nombre = trim($_POST["nombre"]);
    $usuario = trim($_POST["usuario"]);
    $clave = trim($_POST["clave"]);
    $columnista = (int) $_POST["columnista"];

    if($nombre == "" or $usuario == "" or $clave == ""){
        header("Location: administradores.php?exito=false&err=Debe+completar+los+campos");
        die();
    }

     if($editar_id != 0){
        mysql_query("UPDATE administradores SET nombre = '$nombre', usuario = '$usuario', clave = '$clave',id_columnista = '$columnista' WHERE id_administrador = '$editar_id'");
        header("Location: administradores.php?exito=actualizar");
     }else
     {
        mysql_query("INSERT INTO administradores(nombre,usuario,clave,activo,id_columnista) VALUES('$nombre','$usuario','$clave',1,'$columnista')");
        if(!mysql_error()){
            header("Location: administradores.php?exito=agregar");            
        }else{
            header("Location: administradores.php?exito=false&err=". urlencode(mysql_error()));     
        }
     }
}

if(!empty($_GET["permiso"])){
    $id_permiso = $_GET["permiso"];
    $id=$_GET["editar_id"];
    mysql_query("UPDATE admin_secciones_permisos SET permiso = NOT permiso WHERE id_permiso = '$id_permiso'");
    header("Location: administradores.php?editar_id=$id");
}


$administrador["id_administrador"] = "0";
$administrador["nombre"] = "";
$administrador["usuario"] = "";
$administrador["clave"] = "";
$administrador["id_columnista"] = "0";

if(!empty($_GET["editar_id"])){
    $id = (int) $_GET["editar_id"];
    $administrador = una_consulta("SELECT id_administrador,nombre,usuario,clave,id_columnista FROM administradores WHERE id_administrador = '$id'");
    $secciones = consulta("SELECT id_seccion FROM admin_secciones WHERE 1");       
        foreach ($secciones as $key => $value) {
            $verificar = una_consulta("SELECT id_seccion FROM admin_secciones_permisos WHERE id_administrador = '$id' AND id_seccion = '" . $secciones[$key]["id_seccion"] . "' ");
            if(empty($verificar)){
                mysql_query("INSERT INTO admin_secciones_permisos(id_seccion,id_administrador,permiso) VALUES('" . $secciones[$key]["id_seccion"] . "', '$id',0) ");
            }
        }
    $admin_secciones_permisos = consulta("SELECT nombre,id_permiso,permiso FROM admin_secciones, admin_secciones_permisos WHERE admin_secciones.id_seccion = admin_secciones_permisos.id_seccion AND admin_secciones_permisos.id_administrador = '$id' ");
    echo mysql_error();
}

$administradores = consulta("SELECT id_administrador,nombre,usuario FROM administradores WHERE id_administrador != 1 ORDER BY usuario");

$columnistas = array();

include("partes/top.php");
?>   
    <div class="center_content">  
    <div class="left_content">
            <div class="izq">
                    <h2>Agregar/modificar</h2>
                <form method="POST" action="" class="">
                    <input type="hidden" name="id" value="<?php echo $administrador["id_administrador"]; ?>">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="<?php echo $administrador["nombre"]; ?>">
                    <label>Usuario</label>
                    <input type="text" name="usuario" value="<?php echo $administrador["usuario"]; ?>">
                    <label>Clave</label>
                    <input type="password" name="clave" value="<?php echo $administrador["clave"]; ?>">

                    <select name="columnista" style="display:none;">
                        <option value="0">No es un columnista</option>
                        <?php foreach ($columnistas as $columnista): ?>
                            <option <?php echo ($columnista["id_columnista"] == $administrador["id_columnista"]) ? "selected='selected'" : ""; ?> value="<?php echo $columnista["id_columnista"] ?>"><?php echo $columnista["nombre"] ?></option>
                        <?php endforeach ?>
                    </select>
                    <input type="submit" value="Aceptar">
                    <?php if(!empty($id)): ?>
                    <input type="button" value="cancelar" onclick="location.href='administradores.php'">
                    <?php endif ?>
                </form>
            </div>
    </div>  
    
    <div class="right_content">            
    <?php include("mensajes.php"); ?>
    <h2>Administradores</h2> 

        <table id="rounded-corner" summary="">
            <thead>
            	<tr>
                    <th scope="col" class="rounded-company">Usuario</th>
                    <th scope="col" class="rounded">Editar</th>
                    <th scope="col" class="rounded-q4">borrar</th>
                </tr>
            </thead>
            <tfoot>
                <tr><td colspan="3"></td></tr>
            </tfoot>
            <tbody>
            	<?php foreach ($administradores as $key => $value): ?>
                    <tr>
                        <td scope="col" class="rounded"><b><?php echo $administradores[$key]["usuario"]; ?></b> <?php echo $administradores[$key]["nombre"]; ?></td>
                        <td width="52"><a href="?editar_id=<?php echo $administradores[$key]["id_administrador"] ?>" class="editar"><span>Editar</span></a></td>
                        <td width="52"><a href="?eliminar_id=<?php echo $administradores[$key]["id_administrador"] ?>" class="borrar ask"><span>Borrar</span></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    <?php if(!empty($id)): ?><br>
        <h2>Permisos</h2> 

        <table id="rounded-corner" summary="">
            <thead>
                <tr>
                    <th scope="col" class="rounded">Usuario</th>
                    <th scope="col" class="rounded">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($admin_secciones_permisos as $key => $value): ?>
                    <tr>
                        <td scope="col" class="rounded"><?php echo $admin_secciones_permisos[$key]["nombre"]; ?></td>
                        <td scope="col" class="rounded">
                        <a href="?editar_id=<?php echo $id ?>&permiso=<?php echo $admin_secciones_permisos[$key]["id_permiso"] ?>">
                        <img src="images/<?php echo ($admin_secciones_permisos[$key]["permiso"]) ? "visto" : "user_logout" ; ?>.png" alt="" title="" border="0" />
                        </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
     </div>
  </div>

<?php include("partes/fotter.php"); ?>