<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();

$editar_id = (!empty($_GET["editar_id"])) ? $_GET["editar_id"] : 0;

if(!empty($_GET["eliminar_adjunto_id"])){
    $eliminar_adjunto_id = $_GET["eliminar_adjunto_id"];
//<Eliminar>
    $adjunto = una_consulta("SELECT url from noticias_adjuntos WHERE id_adjunto = '$eliminar_adjunto_id'");
        unlink($config["adjuntos"] . $adjunto["url"]);
//</Eliminar>   
    mysql_query("DELETE FROM noticias_adjuntos  WHERE id_adjunto = '$eliminar_adjunto_id'");
    header("Location: noticias.php?editar_id=$editar_id#adjuntos");
}

if(!empty($_GET["eliminar_foto_id"])){
    $eliminar_foto_id = $_GET["eliminar_foto_id"];
//<Eliminar>
    $foto = una_consulta("SELECT url from noticias_fotos WHERE id_foto = '$eliminar_foto_id'");
        unlink($config["imagenes"] . $foto["url"]);
        unlink($config["imagenes"] . $foto["url"] . "_t.jpg");
//</Eliminar>   
    mysql_query("DELETE FROM noticias_fotos  WHERE id_foto = '$eliminar_foto_id'");
    header("Location: noticias.php?editar_id=$editar_id#fotos");
}
if(!empty($_GET["eliminar_audio_id"])){
    $eliminar_audio_id = $_GET["eliminar_audio_id"];
//<Eliminar>
    $audio = una_consulta("SELECT url from noticias_audios WHERE id_audio = '$eliminar_audio_id'");
        unlink($config["audios"] . $audio["url"]);
//</Eliminar>   
    mysql_query("DELETE FROM noticias_audios  WHERE id_audio = '$eliminar_audio_id'");
    header("Location: noticias.php?editar_id=$editar_id#audios");
}
if(!empty($_GET["eliminar_video_id"])){
    $eliminar_video_id = $_GET["eliminar_video_id"];
//<Eliminar>
    $video = una_consulta("SELECT url from noticias_videos WHERE id_video = '$eliminar_video_id'");
        unlink($config["videos"] . $video["url"]);
//</Eliminar> 
    mysql_query("DELETE FROM noticias_videos  WHERE id_video = '$eliminar_video_id'");
    header("Location: noticias.php?editar_id=$editar_id#videos");
}

if(!empty($_GET["eliminar_id"])){
    $eliminar_id = $_GET["eliminar_id"];
//<Eliminar>
    $fotos = consulta("SELECT url from noticias_fotos WHERE id_noticia = '$eliminar_id'");
    foreach ($fotos as $key => $value) {
        unlink($config["imagenes"] . $fotos[$key]["url"]);
        unlink($config["imagenes"] . $fotos[$key]["url"] . "_t.jpg");
    }
    mysql_query("DELETE from noticias_fotos WHERE id_noticia = '$eliminar_id'");
    $audios = una_consulta("SELECT url from noticias_audios WHERE id_noticia = '$eliminar_id'");
    foreach ($audios as $key => $value) {
        unlink($config["audios"] . $audios[$key]["url"]);   
    }
    mysql_query("DELETE from noticias_audios WHERE id_noticia = '$eliminar_id'");
    $videos = una_consulta("SELECT url from noticias_videos WHERE id_video = '$eliminar_video_id'");
    foreach ($videos as $key => $value) {
        unlink($config["videos"] . $videos[$key]["url"]);
    }
    mysql_query("DELETE from noticias_videos WHERE id_noticia = '$eliminar_id'");
    mysql_query("DELETE from noticias_tapa WHERE id_noticia = '$eliminar_id'");
    mysql_query("DELETE from noticias_linksrelacionados WHERE id_noticia = '$eliminar_id' OR Id_relacion = '$eliminar_id'");
    mysql_query("DELETE from noticias_encuestas WHERE id_noticia = '$eliminar_id'");
//</Eliminar>   
    mysql_query("DELETE FROM noticias  WHERE id_noticia = '$eliminar_id'");
    header("Location: noticias.php?&exito=eliminar");
}

if(!empty($_GET["um"])){
    $um = $_GET["um"];
    mysql_query("UPDATE noticias SET um = NOT um WHERE id_noticia = '$um'");
    header("Location: noticias.php");
}

$tamaño_pagina = 10;
$where = "1";
if(!empty($_GET["titulo"])){
    $where .= " and titulo like '%" . mysql_real_escape_string($_GET["titulo"]) . "%'";
    $titulo = $_GET["titulo"];
}
if(!empty($_GET["fecha"])){
    $where .= " and date(fecha) = '" . mysql_real_escape_string($_GET["fecha"]) . "'"; 
}
if(!empty($_GET["cat"])){
    $where .= " and id_categoria = '" . mysql_real_escape_string($_GET["cat"]) . "'"; 
    $id_categoria = $_GET["cat"];
}

$noticia["id_noticia"] = 0;
$noticia["id_categoria"] = "";
$noticia["volanta"] = "";
$noticia["titulo"] = "";
$noticia["copete"] = "";
$noticia["cuerpo"] = "";
$noticia["fecha"] = date("Y-m-d H:i",time()-(0*60*60));
$noticia["fecha_vencimiento"] = date("Y-m-d H:i",time()+(30*24*60*60));
$noticia["palabras_clave"] = "";
$noticia["activa"] = TRUE;
$noticia["um"] = FALSE;
$noticia["autor"] = $_SESSION["usuario"];
$noticia["categoria"] = "";
$noticia["id_columnista"] = "";

if(!empty($_GET["editar_id"]))
{   
    $editar_id =  $_GET["editar_id"];
    $noticia = una_consulta("SELECT * FROM noticias WHERE id_noticia ='" . $editar_id . "'"); //sacar el * por los campos
    
    

    if($_SESSION["id_columnista"] != 0){
        if($noticia["id_columnista"] != $_SESSION["id_columnista"]){
            header("Location: noticias.php?editar_id=".$id_noticia."&exito=false&err=Ud+no+es+el+autor/a+de+esta+noticia"); 
            }
    }
    $noticias_fotos = consulta("SELECT id_foto,url,descripcion from noticias_fotos WHERE id_noticia = '$editar_id'");
    $noticias_audios = consulta("SELECT id_audio,url,descripcion from noticias_audios WHERE id_noticia = '$editar_id'");
    $noticias_videos = consulta("SELECT id_video,url,descripcion,Tipo from noticias_videos WHERE id_noticia = '$editar_id'");
    $noticias_adjuntos = consulta("SELECT id_adjunto,url,descripcion from noticias_adjuntos WHERE id_noticia = '$editar_id'");

    echo mysql_error();
    
    if(empty($noticia)){
        header("Location: noticias.php?editar_id=".$id_noticia."&exito=false&err=No+exise+la+noticia+o+fue+eliminada"); 
    }
}

if($_SESSION["id_columnista"] != 0) $where .= " and id_columnista = '" . $_SESSION["id_columnista"] . "'"; 

    $consulta_noticias = datos_paginador("SELECT id_noticia,titulo,fecha,um from noticias WHERE $where order by fecha DESC",$tamaño_pagina,$link);
    $noticias = consulta($consulta_noticias);
    $noticias_categorias = consulta("SELECT id_categoria,nombre from noticias_categorias WHERE 1 ORDER BY nombre ASC");
    $noticias_columnistas = array();


include("partes/top.php");

desconectar();
?>                                    
                    
    <div class="center_content">  

    <div class="left_content">
        <div class="izq">
            <h2>Busqueda</h2>
            <div class="submenu" style="align=center;">
            <form class="niceform">
                    <h4>Titulo</h4>
            <input type="text" name="titulo" class="" value="" placeholder="Buscar..." onclick="this.value=''" />
                    <h4>Fecha</h4>
            <input type="datetime" name="fecha" class="sfecha" value="" placeholder="fecha...">
                    <h4>Categoria</h4>
            <select name="cat" class="">
                <option value="">En Todas las categorias</option>
                <?php foreach ($noticias_categorias as $key => $value): ?>
                <option value="<?php echo $noticias_categorias[$key]["id_categoria"]; ?>">
                    <?php echo $noticias_categorias[$key]["nombre"]; ?>
                </option>
                <?php endforeach ?>
            </select>
            <input type="submit" value="buscar" />
            </form>            
            </div>
            <?php if(!empty($editar_id)): ?>
                <h2>Agregar fotos</h2>
                <div class="submenu">
                    <h4>Imagenes JPG</h4>
                    <form action="a_agregar_noticia_fotos.php" method="POST" enctype="multipart/form-data">
                        <input name="id" type="hidden" value="<?php echo $editar_id; ?>">
                        <input name="imagen" size="10" type="file" multiple="multiple" >
                        <input name="descripcion" placeholder="Descripción..."  type="text" >
                        <input type="submit" value="Agregar">
                    </form>
                </div>
                <h2>Agregar Audio</h2>
                <div class="submenu">
                    <h4>Archivos mp3</h4>
                    <form action="a_agregar_noticia_audios.php" method="POST" enctype="multipart/form-data">
                        <input name="id" type="hidden" value="<?php echo $editar_id; ?>">
                        <input name="audio" size="10" type="file" >
                        <input name="descripcion" placeholder="Descripción..."  type="text" >
                        <input type="submit" value="Agregar">
                    </form>
                </div>
                <h2>Agregar Video</h2>
                <div class="submenu">
                    <form style="display:none;" action="a_agregar_noticia_videos.php" method="POST" enctype="multipart/form-data">
                        <input name="id" type="hidden" value="<?php echo $editar_id; ?>">
                        <input name="video" size="10" type="file">
                        <input name="descripcion" placeholder="Descripción..."  type="text" >
                        <input type="submit" value="Agregar">
                    </form>
                    <h4>Youtube</h4>
                    <form action="a_agregar_noticia_videos.php?y=true" method="POST">
                        <input name="id" type="hidden" value="<?php echo $editar_id; ?>">
                        <input name="video" type="text">
                        <input name="descripcion" placeholder="Descripción..."  type="text" >
                        <input type="submit" value="Agregar">
                    </form>
                </div>
                <h2 >Adjuntar</h2>
                <div class="submenu">
                    <h4>Pdf/doc</h4>
                    <form action="a_agregar_noticia_adjuntos.php" method="POST" enctype="multipart/form-data">
                        <input name="id" type="hidden" value="<?php echo $editar_id; ?>">
                        <input name="imagen" size="10" type="file" multiple="multiple" >
                        <input name="descripcion" placeholder="Descripción..."  type="text" >
                        <input type="submit" value="Agregar">
                    </form>
                    <table>
                        <?php foreach ($noticias_adjuntos as $key => $adjunto): ?>
                        <tr>
                            <td colspan="" rowspan="" headers=""><?php echo $adjunto["url"] ?></td>
                            <td colspan="" rowspan="" headers="">
                                <a href="?editar_id=<?php echo $editar_id ?>&eliminar_adjunto_id=<?php echo $adjunto["id_adjunto"] ?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a>
                           </td>
                        </tr>
                        <?php endforeach ?>
                    </table>
                </div>
            <?php endif ?>  
            </div>
    </div>  
    
    <div class="right_content">            
    <?php include("mensajes.php"); ?>    
    <h1>Noticias</h1> 
                    
<table id="rounded-corner" summary="">
    <thead>
    	<tr>
            <th scope="col" class="rounded-company">Fecha</th>
            <th scope="col" class="rounded">Titulo</th>
            <th scope="col" class="rounded">UM</th>
            <th scope="col" class="rounded">Editar</th>
            <th scope="col" class="rounded-q4">borrar</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left">
                <div class="pagination">
                    <?php paginador("SELECT id_noticia,titulo,fecha from noticias WHERE $where order by fecha",$tamaño_pagina,$link); ?>
                </div> 
            </td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
    <tbody>
    	<?php foreach ($noticias as $key => $value): ?>
            <tr>
                <td scope="col" class="rounded"><?php echo $noticias[$key]["fecha"]; ?></td>
                <td scope="col" class="rounded"><?php echo $noticias[$key]["titulo"]; ?></td>
                <td>
                    <a href="?um=<?php echo $noticias[$key]["id_noticia"]; ?>"><img src="images/<?php echo ($noticias[$key]["um"]) ? "visto" : "user_logout" ; ?>.png" alt="" title="" border="0" /></a>
                </td>
                <td><a class="editar" href="?editar_id=<?php echo $noticias[$key]["id_noticia"] ?>"><span>Editar</span></a></td>
                <td><a class="borrar ask" href="?eliminar_id=<?php echo $noticias[$key]["id_noticia"] ?>"><span>Borrar</span></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

        <h1>Noticia</h1>
         <div class="largo">
         <form action="a_agregar_noticia.php" method="POST" >
             
            <label>Volanta</label>
            <input type="text" size="54" name="volanta" id="volanta" placeholder="volanta" value='<?php echo $noticia["volanta"]; ?>'>
             
            <label>Titulo</label>
            <input type="text" name="titulo" id="titulo" placeholder="titulo" required value='<?php echo $noticia["titulo"]; ?>'>
             
            <label>Copete</label>
            <textarea name="copete"><?php echo $noticia["copete"]; ?></textarea>
             
            <label>Cuerpo</label>
            <textarea name="cuerpo" id="cuerpo" class=""><?php echo $noticia["cuerpo"]; ?></textarea>
             
            <label>Fecha</label>
            <input type="text" name="fecha" class="fecha" placeholder="fecha" value='<?php echo $noticia["fecha"]; ?>'>
             
            <div style="display:none">
                <label>Fecha de vencimiento</label>
                <input type="text" name="fecha_vencimiento" class="fecha" placeholder="fecha" value="<?php echo $noticia["fecha_vencimiento"]; ?>">
             </div>
             
            <div style="display:none">
			     <label>Palabras claves <small> &nbsp;( Separar las palabras con una coma )</small></label>
                <input type="text" name="palabras_clave" id="palabras_clave" placeholder="Palabras claves de la nota" value="<?php echo $noticia["palabras_clave"]; ?>">
             </div>
			
            <label style="display:inline;">¿Activar?</label>
            <input type="checkbox" name="activa" id="activa" placeholder="activa" <?php echo ($noticia["activa"]==TRUE) ? "checked=checked" : ""; ?>>

            <label style="display:none;">¿&Uacute;ltimo momento?</label>
            <input type="checkbox" style="display:none;" name="um" id="um" placeholder="um" <?php echo ($noticia["um"]==TRUE) ? "checked=checked" : ""; ?>>

            <input type="text" style="display:none;" name="autor" id="autor" placeholder="autor" value="<?php echo $noticia["autor"]; ?>">
             
            <label>Categoria</label>
            <select name="id_categoria" id="categoria" required>
                    
                    <?php foreach ($noticias_categorias as $key => $value): ?>
                        <option <?php echo ($noticias_categorias[$key]["id_categoria"] == $noticia["id_Categoria"]) ? "selected='selected'" : ""; ?> value="<?php echo $noticias_categorias[$key]["id_categoria"]; ?>">
                            <?php echo $noticias_categorias[$key]["nombre"]; ?>
                        </option>
                    <?php endforeach ?>
             </select>
            
            <select name="id_columnista" style="display:none;">
                <option value="0">Ninguno</option>      
                    <?php foreach ($noticias_columnistas as $key => $value): ?>
                        <option <?php echo ($noticias_columnistas[$key]["id_columnista"] == $noticia["id_columnista"]) ? "selected='selected'" : ""; ?> value='<?php echo $noticias_columnistas[$key]["id_columnista"]; ?>'>
                            <?php echo $noticias_columnistas[$key]["nombre"]; ?>
                        </option>
                    <?php endforeach ?>
                </select>

            <input type="hidden" name="id_noticia" value="<?php echo $noticia["id_Noticia"]; ?>" />

			
            <input type="submit" value="Guardar">
        </form>
       </div>  
       <?php if(!empty($editar_id)): ?>

        <h1>Multimedia</h1>
        <div id="multimedia">
                <h2>Fotos</h2>
                    <div class="submenu">
                        <div class="album">
                        <?php foreach ($noticias_fotos as $key => $value): ?>
                        <div class="fotocontenedor">
                            <img title="<?php echo $noticias_fotos[$key]["descripcion"] ?>" class="foto" src="<?php echo $config["imagenes"] . $noticias_fotos[$key]["url"] ?>_s.jpg" alt="imagen">
                            <a class="editar_imagen_iframe" onclick="window.open(this.href,'','width=780,height=300');return false;" target="editar_imagen" href="editar_imagen_iframe.php?editar_id=<?php echo $noticias_fotos[$key]["id_foto"] ?>"><img border="0" src="images/user_edit.png"></a>
                            <a class="ask" href="?editar_id=<?php echo $editar_id ?>&eliminar_foto_id=<?php echo $noticias_fotos[$key]["id_foto"] ?>"><img border="0" src="images/trash.png"></a>
                        </div>
                        <?php endforeach ?>
                        </div>
                    </div>
                    <h2>Videos</h2>
                    <div class="submenu">
                        <table id="rounded-corner">
                        <thead>
                            <tr>
                                <td>Escuchar</td>
                                <td>Descripci&oacute;n</td>
                                <td width="12">Editar</td>
                                <td width="12">Borrar</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($noticias_videos as $key => $value): ?>
                        <tr>
                            <td>
                                <a target="_blank" href="<?php echo "http://youtube.com/watch?v=" . $noticias_videos[$key]["url"] ?>">
                                    <?php echo "http://youtube.com/watch?v=" . $noticias_videos[$key]["url"] ?>
                                </a>
                            </td>
                            <td>
                                <?php echo $noticias_videos[$key]["descripcion"] ?>
                            </td>
                            <td>
                                <a onclick="window.open(this.href,'','width=600,height=300');return false;" target="editar_video" href="editar_video_iframe.php?editar_id=<?php echo $noticias_videos[$key]["id_video"]; ?>"><img border="0" src="images/user_edit.png" /></a>
                            </td>
                            <td><a href="?editar_id=<?php echo $editar_id ?>&eliminar_video_id=<?php echo $noticias_videos[$key]["id_video"] ?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                        </table>
                    </div>
                    <h2>Audios</h2>
                    <div class="submenu">
                        <table id="rounded-corner">
                        <thead>
                            <tr>
                                <td>Escuchar</td>
                                <td>Descripci&oacute;n</td>
                                <td width="12">Editar</td>
                                <td width="12">Borrar</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($noticias_audios as $key => $value): ?>
                        <tr>
                            <td>
                                <object type="application/x-shockwave-flash" data="../dewplayer.swf" width="200" height="20" id="dewplayerclassic" name="dewplayerclassic">
                                <param name="movie" value="<?php echo '../dewplayer.swf?mp3=' . $config["audios"] . $noticias_audios[$key]["url"] ?>" />
                                <param name="flashvars" value="<?php echo'mp3='.$config["audios"].$noticias_audios[$key]["url"] ?>" /> 
                                <?php echo $noticias_audios[$key]["url"] ?>
                            </td>
                            <td>
                                <?php echo $noticias_audios[$key]["descripcion"] ?>
                            </td>
                            <td>
                                <a onclick="window.open(this.href,'','width=600,height=300');return false;" target="editar_audio" href="editar_audio_iframe.php?editar_id=<?php echo $noticias_audios[$key]["id_audio"]; ?>"><img border="0" src="images/user_edit.png" /></a>
                            </td>
                            <td><a href="?editar_id=<?php echo $editar_id ?>&eliminar_audio_id=<?php echo $noticias_audios[$key]["id_audio"] ?>" class="ask"><img src="images/trash.png" alt="" title="" border="0" /></a></td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                        </table>
                    </div>
                    <br /> <br />
                <!--    
                <div class="">
                    <h2>Encuestas en la noticia</h2>
                    <iframe width="100%" frameborder="0" src="encuestas_frame.php?editar_id=<?php echo $editar_id; ?>"></iframe>
                </div>
                    <br /> <br />
                <div class="">
                    <h2>Noticias relacionadas</h2>
                    <iframe width="100%" frameborder="0" src="noticias_frame.php?editar_id=<?php echo $editar_id; ?>"></iframe>
                </div>
                -->
         </div>       
                <?php endif ?>     
     </div>
  </div>             


<script type="text/javascript">

    bkLib.onDomLoaded(function() { 
        new nicEditor().panelInstance('cuerpo'); 
    });
/*
$(document).ready(function() {
        $('#fecha_vencimiento').datetimepicker({
                        timeFormat: 'hh:mm',
                        dateFormat: 'yy-mm-dd'
        });   
    });

$('iframe').iframeAutoHeight({

});

$('#ifotos').hide();
$('#ivideos').hide();
$('#iaudios').hide();
*/
</script>
<?php include("partes/fotter.php"); ?>