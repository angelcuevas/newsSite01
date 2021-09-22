<?php 
    $semanales = $db->query("SELECT noticias.hits,noticias.id_categoria,	noticias_tapa.columna,	noticias.id_noticia, noticias.volanta,	noticias.copete,	noticias.titulo,	noticias.fecha,	noticias.activa, noticias_categorias.nombre	FROM noticias_tapa INNER JOIN noticias ON  noticias_tapa.Id_Noticia = noticias.id_Noticia LEFT JOIN noticias_categorias ON noticias_categorias.id_categoria = noticias.id_categoria where columna = 3 ORDER BY noticias_tapa.ubicacion ASC");
?>

<!--   Weekly-News start -->
<div class="weekly-news-area pt-50">
        <div class="container">
           <div class="weekly-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Semanales</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly-news-active dot-style d-flex dot-style">
                            <?php
                                foreach ($semanales as $noticia) {

                            ?>
                            <div class="weekly-single" >
                                <div class="weekly-img">
                                    <?php 
                                        // style="min-height:400px;"
                                        $foto = getFoto($fotos,$noticia);
                                    ?>
                                    <img src="<?php echo $config["url"]["urlImagenes"]."".$foto["url"];?>" alt="">
                                </div>
                                <div class="weekly-caption">
                                    <span class="color1"><?php echo $noticia["nombre"]; ?></span>
                                    <h4><a href="noticia.php?id=<?php showNoticiaId($noticia)?>"> <?php echo $noticia["titulo"];?> </a></h4>
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