<?php 
    
    $recientes = $db->query("SELECT noticias.hits,noticias.id_categoria,	noticias_tapa.columna,	noticias.id_noticia, noticias.volanta,	noticias.copete,	noticias.titulo,	noticias.fecha,	noticias.activa, noticias_categorias.nombre	FROM noticias_tapa INNER JOIN noticias ON  noticias_tapa.Id_Noticia = noticias.id_Noticia LEFT JOIN noticias_categorias ON noticias_categorias.id_categoria = noticias.id_categoria where columna = 4 ORDER BY noticias_tapa.ubicacion ASC");
?>

<div class="recent-articles" >
            <div class="container">
                <div class="recent-wrapper">
                    <!-- section Tittle -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-tittle mb-30">
                                <h3>Recientes</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding:20px;">
                        <div class="col-12">
                            <div class="recent-active dot-style d-flex dot-style">

                                <?php 
                                    $rc = 0;
                                    foreach ($recientes as $noticia) {
                                        ?>
                                            <div class="single-recent mb-100 <?php if($rc == 0) echo  "active"; ?>">
                                                <div class="what-img">
                                                    <img src="<?php $foto = getFoto($fotos,$noticia); echo $config["url"]["urlImagenes"]."".$foto["url"];  ?>" alt="">    
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1"> <?php echo $noticia["nombre"]; ?> </span>
                                                    <h4><a href="noticia.php?id=<?php showNoticiaId($noticia)?>"> <?php echo $noticia["titulo"]; ?> </a></h4>
                                                </div>
                                            </div>
                                        <?php
                                        $rc++;
                                    }
                                
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>