<?php
include("includes/db.inc.php");
include("includes/paginador.php");
include("includes/funciones.inc.php");
conectar();

if(!empty($_GET["eliminar_id"])){
    $eliminar_id = $_GET["eliminar_id"];
    mysql_query("DELETE FROM encuestas  WHERE id_encuesta = '$eliminar_id'");
    header("Location: encuestas.php?&exito=eliminar");
}

if(!empty($_GET["activar"])){
    $activar_id = $_GET["activar"];
    mysql_query("UPDATE encuestas SET activa = NOT activa WHERE id_encuesta = '$activar_id'");
    header("Location: encuestas.php");
}

$tamaño_pagina = 10;
$where = "1";
if(!empty($_GET["titulo"])){
    $where .= " and titulo like '%" . $_GET["titulo"] . "%'";
    $titulo = $_GET["Titulo"];
}
if(!empty($_GET["fecha"])){
    $where .= " and date(fecha) = '" . $_GET["fecha"] . "'"; 
}

$encuesta["id_encuesta"] = 0;
$encuesta["nombre"] = "";
$encuesta["activa"] = "";
$encuesta["fecha"] = "";

if(!empty($_GET["editar_id"]))
{   
    $editar_id =  $_GET["editar_id"];    
    
    if(!empty($_GET["eliminar_pregunta_id"])){
        $eliminar_pregunta_id = $_GET["eliminar_pregunta_id"];
        mysql_query("DELETE FROM encuestas_preguntas WHERE id_encuestas_preguntas = '$eliminar_pregunta_id'");
        $reordenar = consulta("SELECT id_encuestas_preguntas FROM encuestas_preguntas WHERE id_encuesta = '$editar_id' ORDER BY ubicacion ASC");
        foreach ($reordenar as $key => $value) {
            $ubc = $key + 1;
            mysql_query("UPDATE encuestas_preguntas SET ubicacion = '$ubc' WHERE id_encuestas_preguntas = '$value[id_encuestas_preguntas]'");
        }
        header("Location: encuestas.php?editar_id=".$editar_id."&exito=eliminar"); 
    }

    if (isset($_GET["editar_pregunta_id"]) and !empty($_GET["texto"])) {
        $editar_pregunta_id = $_GET["editar_pregunta_id"];
        $texto = $_GET["texto"];
        if($editar_pregunta_id == 0){
            $max = una_consulta("SELECT MAX(ubicacion) as max FROM encuestas_preguntas WHERE id_encuesta = '$editar_id'");
            mysql_query("INSERT INTO encuestas_preguntas(id_encuesta,texto,ubicacion,hits) VALUES('$editar_id','$texto',$max[max]+1,0)");
        header("Location: encuestas.php?editar_id=".$editar_id."&exito=agregar"); 
        }else{
            mysql_query("UPDATE encuestas_preguntas SET texto = '$texto' WHERE id_encuestas_preguntas = '$editar_pregunta_id'");
            header("Location: encuestas.php?editar_id=".$editar_id."&exito=actualizar"); 
        }

    }
    
    if (!empty($_GET["editar_pregunta_id"]) and !empty($_GET["orden"])) {
        $orden = $_GET["orden"];
        $editar_pregunta_id = $_GET["editar_pregunta_id"];
        $ubicacion_actual = una_consulta("SELECT ubicacion FROM encuestas_preguntas WHERE id_encuestas_preguntas = '$editar_pregunta_id' ");
        $ubicacion_actual = $ubicacion_actual["ubicacion"];
        mysql_query("UPDATE encuestas_preguntas SET ubicacion = '$ubicacion_actual' WHERE id_encuesta = '$editar_id' AND ubicacion = '$orden'");
        echo mysql_error();
        mysql_query("UPDATE encuestas_preguntas SET ubicacion = '$orden' WHERE id_encuestas_preguntas = '$editar_pregunta_id'");
        echo mysql_error();
        header("Location: encuestas.php?editar_id=".$editar_id."&exito=orden"); 
    }

    $encuesta = una_consulta("SELECT * from encuestas WHERE id_encuesta = '" . $editar_id . "'"); //sacar el * por los campos
    $encuestas_preguntas = consulta("SELECT * FROM encuestas_preguntas WHERE id_encuesta = '" . $editar_id . "' ORDER BY ubicacion ASC");
    echo mysql_error();
    if(empty($encuesta)){
        header("Location: encuestas.php?editar_id=".$id_encuesta."&exito=false"); }
}

$consulta_encuestas = datos_paginador("SELECT * from encuestas WHERE $where order by activa DESC,fecha DESC",$tamaño_pagina,$link);
$encuestas = consulta($consulta_encuestas);
desconectar();

if(!empty($_GET["exito"]))
{
    $mensaje = $_GET["exito"];
}
include("partes/top.php");
?>                                    

    <div class="center_content">  

    <div class="left_content">
         <div class="izq">
            <h2>Agregar/editar</h2>
            <form action="a_agregar_encuesta.php" method="POST" id="encuesta" >
            <label>nombre</label>
            <input type="text" size="54" name="nombre" id="nombre" placeholder="nombre" value="<?php echo $encuesta["nombre"]; ?>" required>
            <label>fecha</label>
            <input type="text" name="fecha" class="sfecha" placeholder="fecha" value="<?php echo $encuesta["fecha"]; ?>">
            <label>En tapa</label>
            <input type="checkbox" name="activa" id="activa" placeholder="activa" <?php echo ($encuesta["activa"]==TRUE) ? "checked=checked" : ""; ?>>
            <input type="hidden" name="id_encuesta" value="<?php echo $encuesta["id_encuesta"]; ?>">
            <input type="submit" value="Guardar">
                <?php if($encuesta["id_encuesta"] != 0) : ?>
                    <input type="button" value="cancelar" onclick="location.href='encuestas.php'">
                <?php endif ?>
        </form>
        </div>
    </div>  

    <div class="right_content">
    <?php include("mensajes.php"); ?>    
    <h2>Encuestas</h2>
                    
<table id="rounded-corner" summary="">
    <thead>
    	<tr>
            <th scope="col" class="rounded-company">fecha</th>
            <th scope="col" class="rounded">Titulo</th>
            <th scope="col" class="rounded">Tapa</th>
            <th scope="col" class="rounded">Editar</th>
            <th scope="col" class="rounded-q4">borrar</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left">
                <div class="pagination">
                    <?php paginador("SELECT * from encuestas WHERE $where order by fecha",$tamaño_pagina,$link); ?>
                </div> 
            </td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
    <tbody>
    	<?php foreach ($encuestas as $key => $value): ?>
            <tr>
                <td scope="col" class="rounded"><?php echo dmal($encuestas[$key]["fecha"]); ?></td>
                <td scope="col" class="rounded"><?php echo $encuestas[$key]["nombre"]; ?></td>
                <td><a href="?activar=<?php echo $encuestas[$key]["id_encuesta"]; ?>"><img src="images/<?php echo ($encuestas[$key]["activa"]) ? "visto" : "user_logout" ; ?>.png" alt="" title="" border="0" /></a></td>
                <td width="52"><a href="encuestas.php?editar_id=<?php echo $encuestas[$key]["id_encuesta"] ?>" class="editar"><span>Editar</span></a></td>
                <td width="52"><a href="?eliminar_id=<?php echo $encuestas[$key]["id_encuesta"] ?>" class="borrar ask"><span>Borrar</span></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>   

<?php if (!empty($editar_id)): ?>
<?php 
conectar();
$editar_pregunta_id = (!empty($_GET["editar_pregunta_id"])) ? mysql_real_escape_string($_GET["editar_pregunta_id"]) : 0;
$pregunta_simple["texto"] = "";
$pregunta_simple = una_consulta("SELECT texto FROM encuestas_preguntas WHERE id_encuestas_preguntas = '$editar_pregunta_id'");
desconectar();
?>
<div class="encuestas">
    <table id="rounded-corner">
        <thead>
            <tr>
            <th>Pregunta</th>
            <th width="60">Orden</th>
            <th width="60">Editar</th>
            <th width="60">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($encuestas_preguntas as $key => $pregunta): ?>
                <tr>
                    <td><?php echo $pregunta["texto"]; ?></td>
                    <td>
                        <form method="GET" action="">
                        <input name="editar_id" type="hidden" value="<?php echo $editar_id; ?>" />
                        <input name="editar_pregunta_id" type="hidden" value="<?php echo $pregunta["id_encuestas_preguntas"]; ?>" />
                        <select name="orden" onchange="this.form.submit();">
                        <?php for($num=1;$num<sizeof($encuestas_preguntas)+1;$num++): ?>
                            <option <?php echo ($num==$key+1) ? 'selected="selected"' : ""; ?> value="<?php echo $num; ?>"><?php echo $num; ?></option>
                        <?php endfor ?>
                        </select>
                        </form>
                    </td>
                    <td><a class="editar" href="?editar_id=<?php echo $editar_id ?>&editar_pregunta_id=<?php echo $pregunta["id_encuestas_preguntas"]; ?>">Editar</a></td>
                    <td><a class="borrar" href="?editar_id=<?php echo $editar_id ?>&eliminar_pregunta_id=<?php echo $pregunta["id_encuestas_preguntas"]; ?>" >Borrar</a></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="4">
                <form action="" method="get">
                    <input name="editar_id" type="hidden" value="<?php echo $editar_id; ?>" />
                    <input name="editar_pregunta_id" type="hidden" value="<?php echo $editar_pregunta_id;  ?>" />
                    <input style="width:70%;" name="texto" type="text" placeholder="Escriba aquí la pregunta" value="<?php echo $pregunta_simple["texto"]; ?>" />
                    <input type="submit" class="editar" value="Guardar">
                    <?php if ($editar_pregunta_id != 0): ?>
                    <input type="button" class="borrar" value="cancelar" onclick="location.href='encuestas.php?editar_id=<?php echo $editar_id ?>'">
                    <?php endif ?>
                </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>    
<?php endif ?>


     </div>
  </div>                  

<?php include("partes/fotter.php"); ?>