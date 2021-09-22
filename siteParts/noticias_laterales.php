<?php 
    
    $noticias_laterales = $db->query("SELECT noticias.hits,noticias.id_categoria,	noticias_tapa.columna,	noticias.id_noticia, noticias.volanta,	noticias.copete,	noticias.titulo,	noticias.fecha,	noticias.activa, noticias_categorias.nombre	FROM noticias_tapa INNER JOIN noticias ON  noticias_tapa.Id_Noticia = noticias.id_Noticia LEFT JOIN noticias_categorias ON noticias_categorias.id_categoria = noticias.id_categoria where columna = 2 ORDER BY noticias_tapa.ubicacion ASC");

    $notis = Array();

    if(count($noticias_laterales) > 0) array_push($notis, array_shift($noticias_laterales) );
    if(count($noticias_laterales) > 0) array_push($notis, array_shift($noticias_laterales) );
    if(count($noticias_laterales) > 0) array_push($notis, array_shift($noticias_laterales) );
    ?>
                    <div class="col-lg-4">

<?php 
    foreach ($notis as $late) {
    ?>
        <div class="trand-right-single d-flex">
            <div class="trand-right-img">
                <?php $foto = getFoto($fotos,$late);  ?>
                <img style="height: 100px;" src="<?php echo $config["url"]["urlImagenes"]."".getUrlImagenSmall($foto);?>" alt="">
            </div>
            <div class="trand-right-cap">
                <span class="color1"><?php echo $late["nombre"]; ?></span>
                <h4><a href="noticia.php?id=<?php showNoticiaId($late)?>"><?php echo $late["titulo"];?></a></h4>
            </div>
        </div>
    <?php
    }
?>
</div>