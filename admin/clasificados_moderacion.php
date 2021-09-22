<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();

if(!empty($_GET["eliminar"])){
    $eliminar_id = $_GET["eliminar"];
    mysql_query("DELETE FROM clasificados WHERE id_clasificado = '$eliminar_id'");
    header("Location: clasificados_moderacion.php?exito=eliminar");
}

if(!empty($_GET["editar"])){
    $editar_id = $_GET["editar"];
    header("Location: clasificados_editar.php?id=$editar_id");
}

if(!empty($_GET["activar"])){
    $activar_id = $_GET["activar"];
    mysql_query("UPDATE clasificados SET activo = NOT activo WHERE id_clasificado = '$activar_id'");
    header("Location: clasificados_moderacion.php");
}

$consulta_clasificados = datos_paginador("SELECT id_clasificado,id_categoria,fecha,aviso,telefono,domicilio,email,foto,activo,tipo,destacado from clasificados WHERE 1 ORDER BY fecha DESC",$tamaño_pagina,$link);
$clasificados = consulta($consulta_clasificados);

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
    <h2>Clasificados</h2> 

        <table id="rounded-corner" summary="">
            <thead>
            	<tr>
                    <th scope="col" class="rounded-company">Fecha</th>
                    <th scope="col" class="rounded">Aviso</th>
                    <th scope="col" class="rounded">Email</th>
                    <th scope="col" class="rounded">Activar</th>
                    <th scope="col" class="rounded">Editar</th>
                    <th scope="col" class="rounded-q4">Eliminar</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="5" class="rounded-foot-left">
                        <div class="pagination">
                            <?php paginador("SELECT id_clasificado,id_categoria,fecha,aviso,telefono,domicilio,email,foto,activo,tipo,destacado from clasificados WHERE 1 ORDER BY fecha DESC",$tamaño_pagina,$link); ?>
                        </div> 
                    </td>
                    <td class="rounded-foot-right">&nbsp;</td>
                </tr>
            </tfoot>
            <tbody>
            	<?php foreach ($clasificados as $key => $value): ?>
                    <tr>
                        <td><?php echo $clasificados[$key]["fecha"]; ?></td>
                        <td><?php echo $clasificados[$key]["aviso"]; ?></td>
                        <td><?php echo $clasificados[$key]["email"]; ?></td>
                        <td width="52"><a href="?activar=<?php echo $clasificados[$key]["id_clasificado"]; ?>"><img src="images/<?php echo ($clasificados[$key]["activo"]) ? "visto" : "user_logout" ; ?>.png" alt="" title="" border="0" /></a></td>
                        <td width="52"><a class="editar" href="?editar=<?php echo $clasificados[$key]["id_clasificado"]; ?>"><span>Editar</span></a></td>
                        <td width="52"><a class="borrar ask" href="?eliminar=<?php echo $clasificados[$key]["id_clasificado"]; ?>"><span>Borrar</span></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
           
     </div>
  </div>  

<?php include("partes/fotter.php"); ?>
