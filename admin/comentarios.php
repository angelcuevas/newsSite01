<?php 
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();
$tamaño_pagina = 20;
if (!empty($_GET["eliminar"])) {
	$id = $_GET["eliminar"];
	$page = $_GET["page"];
	$ver = $_GET["ver"];
	mysql_query("DELETE FROM noticias_comentarios WHERE id_comentario = '$id'");
    header("Location: comentarios.php?page=".$page."&ver=".$ver."&exito=eliminar");

}

	if(!empty($_GET["revisar"])){
		$revisar = $_GET["revisar"];
		mysql_query("UPDATE noticias_comentarios SET revisado = not revisado WHERE id_comentario = '$revisar'");
	}

$where = 1;

if(empty($_GET["page"])) { $_GET["page"] = 1; }

$consulta_noticias = datos_paginador("SELECT id_noticia,titulo,fecha, (SELECT count(*) as count FROM noticias_comentarios WHERE noticias_comentarios.id_noticia = noticias.id_noticia and revisado = 1) as revisados,(SELECT count(*) as count FROM noticias_comentarios WHERE noticias_comentarios.id_noticia = noticias.id_noticia) as total from noticias WHERE (SELECT count(*) FROM noticias_comentarios WHERE noticias_comentarios.id_noticia = noticias.id_noticia) > 0 ORDER BY (total - revisados) DESC, fecha DESC",$tamaño_pagina,$link);

$noticias = consulta($consulta_noticias);

if(!empty($_GET["ver"])){
	$id_noticia = $_GET["ver"];
	$comentarios = consulta("SELECT id_comentario,id_miembro,fecha,texto,habilitado,revisado FROM noticias_comentarios WHERE id_noticia = " . $id_noticia);
	$mostrar = TRUE;
}

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
    <h2>Comentarios en noticias</h2> 
        <table id="rounded-corner" summary="">
            <thead>
            	<tr>
		            <th scope="col" class="rounded-company">Fecha</th>
		            <th scope="col" class="rounded">Titulo</th>
		            <th scope="col" width="100" class="rounded-q4">Cantidad</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="2" class="rounded-foot-left">
                        <div class="pagination">
            		        <?php paginador("SELECT id_noticia,titulo,fecha from noticias WHERE (SELECT count(*) FROM noticias_comentarios WHERE noticias_comentarios.id_noticia = noticias.id_noticia) > 0 order by fecha DESC",$tamaño_pagina,$link); ?>
                        </div> 
                    </td>
                    <td class="rounded-foot-right">&nbsp;</td>
                </tr>
            </tfoot>
            <tbody>
		    	<?php foreach ($noticias as $key => $value): ?>
		            <tr>
		                <td scope="col" class="rounded"><?php echo $noticias[$key]["fecha"]; ?></td>
		                <td scope="col" class="rounded"><a href="?page=<?php echo $_GET["page"]; ?>&ver=<?php echo $noticias[$key]["id_noticia"]; ?>#comentarios"><?php echo $noticias[$key]["titulo"]; ?></a></td>
		                <td>
		                	<?php if (($noticias[$key]["total"] - $noticias[$key]["revisados"]) > 0): ?>		                		
		                	<a class="editar" href="?page=<?php echo $_GET["page"]; ?>&ver=<?php echo $noticias[$key]["id_noticia"]; ?>#comentarios">
								<?php echo $noticias[$key]["total"] - $noticias[$key]["revisados"]; ?> Nuevos
		                	</a>
		                	<?php else: ?>
		                		<a class="borrar" href="?page=<?php echo $_GET["page"]; ?>&ver=<?php echo $noticias[$key]["id_noticia"]; ?>#comentarios">
		                			<?php echo $noticias[$key]["total"]; ?> Revisados
		                		</a>
		                	<?php endif ?>
		                </td>
		            </tr>
		        <?php endforeach ?>
            </tbody>
        </table>     
        <br />
        <?php if(!empty($mostrar)): ?>
        <div id="comentarios">
	        <table id="rounded-corner" summary="">
	            <thead>
	            	<tr>
			            <th scope="col" class="rounded-company">Fecha</th>
			            <th scope="col" class="rounded">Usuario</th>
			            <th scope="col" class="rounded">Texto</th>
			            <!--
			            <th scope="col" class="rounded">Habilitado</th>
			        	-->
			            <th scope="col" class="rounded">Revisado</th>
			            <th scope="col" class="rounded-q4">Eliminar</th>
	                </tr>
	            </thead>
	            <tbody>
			    	<?php foreach ($comentarios as $key => $value): ?>
			            <tr>
			                <td scope="col" class="rounded">
			                	<?php echo $comentarios[$key]["fecha"]; ?>
			                </td>
			                <td scope="col" class="rounded">
			                	<?php echo htmlentities($comentarios[$key]["id_miembro"]); ?>
			                </td>
			                <td>
			                	<?php echo strip_tags($comentarios[$key]["texto"],"<blockquote><p><b>"); ?>
			                </td>
							<!--
			                <td>
			                	<img src="images/<?php echo ($comentarios[$key]["habilitado"]) ? "visto" : "user_logout" ; ?>.png" alt="" title="" border="0" />
			                </td>
							-->
			                <td>
			                	<a href="?page=<?php echo $_GET["page"]; ?>&ver=<?php echo $id_noticia; ?>&revisar=<?php echo $comentarios[$key]["id_comentario"]; ?>">
            	                    <img src="images/<?php echo ($comentarios[$key]["revisado"]) ? "visto" : "user_logout" ; ?>.png" alt="" title="" border="0" />
			                	 </a>
			                </td>
			                <td>
			                	<a class="borrar ask" href="?page=<?php echo $_GET["page"]; ?>&ver=<?php echo $id_noticia; ?>&eliminar=<?php echo $comentarios[$key]["id_comentario"]; ?>">
			                	<span>Borrar</span>
			                	</a> 
			                </td>
			            </tr>
			        <?php endforeach ?>
	            </tbody>
	        </table>
        </div>
	    <?php endif ?>     
     </div>
  </div>
<?php include("partes/fotter.php"); ?>