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
		mysql_query("DELETE FROM noticias_linksrelacionados WHERE id_link = '$eliminar_id'");
	}
}

if(!empty($_GET["agregar_id"])){
	$agregar_id = $_GET["agregar_id"];
	if (is_numeric($agregar_id))
	{
		mysql_query("INSERT INTO noticias_linksrelacionados(id_noticia,id_relacion) VALUES('$editar_id','$agregar_id') ");
	}
}

$noticias_relacionadas = consulta("SELECT id_link,noticias.id_noticia,titulo from noticias_linksrelacionados,noticias WHERE noticias_linksrelacionados.id_noticia = '$editar_id' AND noticias_linksrelacionados.id_relacion = noticias.id_noticia ORDER BY id_link ASC");

$consulta_relacionadas = datos_paginador("SELECT * from noticias ORDER BY fecha DESC",$tamaño_pagina,$link);

$relacionadas = consulta($consulta_relacionadas);
echo mysql_error();

desconectar();
?>
<!DOCTYPE>
<html>
<head>
<title>Agregar noticias relacionadas</title>
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
    <tbody>
    	<?php foreach ($noticias_relacionadas as $key => $value): ?>
            <tr>
                <td scope="col" class="rounded"><?php echo $noticias_relacionadas[$key]["titulo"]; ?></td>
                <td><a href="?editar_id=<?php echo $editar_id ?>&eliminar_id=<?php echo $noticias_relacionadas[$key]["id_link"] ?>"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
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
                    <?php paginador("SELECT * from noticias ORDER BY fecha DESC",$tamaño_pagina,$link); ?>
                </div> 
            </td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
    <tbody>
    	<?php foreach ($relacionadas as $key => $value): ?>
            <tr>
                <td scope="col" class="rounded"><?php echo $relacionadas[$key]["fecha"]; ?></td>
                <td scope="col" class="rounded"><?php echo $relacionadas[$key]["titulo"]; ?></td>
                <td><a href="?editar_id=<?php echo $editar_id ?>&agregar_id=<?php echo $relacionadas[$key]["id_noticia"] ?>"><img src="images/user_edit.png" alt="" title="" border="0" /></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>
</html>