    <?php 
        $recientes = $db->query("SELECT noticias.hits,noticias.id_categoria,	noticias_tapa.columna,	noticias.id_noticia, noticias.volanta,	noticias.copete,	noticias.titulo,	noticias.fecha,	noticias.activa, noticias_categorias.nombre	FROM noticias_tapa INNER JOIN noticias ON  noticias_tapa.Id_Noticia = noticias.id_Noticia LEFT JOIN noticias_categorias ON noticias_categorias.id_categoria = noticias.id_categoria where columna = 4 ORDER BY noticias_tapa.ubicacion ASC");
    ?>
    
    <!--   Weekly2-News start -->
    <div class="weekly2-news-area  weekly2-pading gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Recientes</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly2-news-active dot-style d-flex dot-style">
                            <?php 
                            foreach ($recientes as $noti) {
                            ?>
                                <div class="weekly2-single">
                                    <div class="weekly2-img">
                                        <?php $foto = getFoto($fotos,$noti); ?>
                                        <img src="<?php echo $config["url"]["urlImagenes"]."".$foto["url"];?>" alt="">
                                    </div>
                                    <div class="weekly2-caption">
                                        <span class="color1"> <?php echo $noti["nombre"]; ?> </span>
                                        <p><?php echo mostrarSoloFecha($noti["fecha"]); ?></p>
                                        <h4><a href="noticia.php?id=<?php showNoticiaId($noti)?>"><?php echo $noti["titulo"]; ?> </a></h4>
                                    </div>
                                </div> 
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>           
    <!-- End Weekly-News -->