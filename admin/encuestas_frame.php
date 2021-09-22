<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();
$tamaño_pagina = 4;
$editar_id = $_GET["editar_id"];

if(!empty($_GET["eliminar_id"])){
	$eliminar_id = $_GET["eliminar_id"];
	if (is_numeric($eliminar_id))
	{
		mysql_query("DELETE FROM noticias_encuestas WHERE id_noticias_encuestas = '$eliminar_id' ");
	}
}

if(!empty($_GET["agregar_id"])){
	$agregar_id = $_GET["agregar_id"];
	if (is_numeric($agregar_id))
	{
		mysql_query("INSERT INTO noticias_encuestas(id_noticia,id_encuesta) VALUES('$editar_id','$agregar_id') ");
	}
}

$noticias_encuestas = consulta("SELECT id_noticias_encuestas,id_encuesta,(SELECT nombre FROM encuestas WHERE encuestas.id_encuesta = noticias_encuestas.id_encuesta) as titulo from noticias_encuestas WHERE id_noticia = '$editar_id' ");
$consulta_encuestas = datos_paginador("SELECT id_encuesta,nombre,fecha from encuestas WHERE 1 order by fecha",$tamaño_pagina,$link);
$encuestas = consulta($consulta_encuestas);
desconectar();
?>
<!DOCTYPE>
<html>
<head>
<title>Agregar encuestas</title>
<link rel="stylesheet" type="text/css" href="css/paginacion.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/main.css" />
<style type="text/css">
body{
    background: #FFF;
}
</style>
</head>
<body>
<table id="rounded-corner" summary="">
    <thead>
    	<tr>
            <th scope="col" class="rounded">Titulo</th>
            <th width="52" scope="col" class="rounded">Eliminar</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="1" class="rounded-foot-left">
            </td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
    <tbody>
    	<?php foreach ($noticias_encuestas as $key => $value): ?>
            <tr>
                <td scope="col" class="rounded"><?php echo $noticias_encuestas[$key]["titulo"]; ?></td>
                <td><a href="?editar_id=<?php echo $editar_id ?>&eliminar_id=<?php echo $noticias_encuestas[$key]["id_noticias_encuestas"] ?>"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<table id="rounded-corner" summary="">
    <thead>
    	<tr>
            <th scope="col" class="rounded-company">Fecha</th>
            <th scope="col" class="rounded">Titulo</th>
            <th width="52" scope="col" class="rounded">Agregar</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="2" class="rounded-foot-left">
                <div class="pagination">
                    <?php paginador("SELECT * from encuestas WHERE 1 order by fecha",$tamaño_pagina,$link); ?>
                </div> 
            </td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
    <tbody>
    	<?php foreach ($encuestas as $key => $value): ?>
            <tr>
                <td scope="col" class="rounded"><?php echo $encuestas[$key]["fecha"]; ?></td>
                <td scope="col" class="rounded"><?php echo $encuestas[$key]["nombre"]; ?></td>
                <td><a href="?editar_id=<?php echo $editar_id ?>&agregar_id=<?php echo $encuestas[$key]["id_encuesta"] ?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>
</html>