<?php

    $trending = $db->query("SELECT noticias.hits,noticias.id_categoria,	noticias_tapa.columna,	noticias.id_noticia, noticias.volanta,	noticias.copete,	noticias.titulo,	noticias.fecha,	noticias.activa, noticias_categorias.nombre	FROM noticias_tapa INNER JOIN noticias ON  noticias_tapa.Id_Noticia = noticias.id_Noticia LEFT JOIN noticias_categorias ON noticias_categorias.id_categoria = noticias.id_categoria where columna = 2 ORDER BY noticias_tapa.ubicacion ASC");
    $abajo = Array();
    $lateral = Array();

    $principal = array_shift($trending);
    
    //$abajo = array_slice($trending, 0, - (count($trending)-3) );
    //$lateral = array_slice($trending, 0, - (count($trending)-5) );
    if(count($trending) > 0) array_push($abajo, array_shift($trending) );
    if(count($trending) > 0) array_push($abajo, array_shift($trending) );
    if(count($trending) > 0) array_push($abajo, array_shift($trending) );

    if(count($trending) > 0) array_push($lateral, array_shift($trending) );
    if(count($trending) > 0) array_push($lateral, array_shift($trending) );
    if(count($trending) > 0) array_push($lateral, array_shift($trending) );
    if(count($trending) > 0) array_push($lateral, array_shift($trending) );
    if(count($trending) > 0) array_push($lateral, array_shift($trending) );

?>

<div class="trending-area fix">
        <div class="container">
            <div class="trending-main">
                <!-- Trending Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <?php include("siteParts/tendencias.php"); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Trending Top -->
                        <div class="trending-top mb-30">
                            <div class="trend-top-img">
                                <img src="<?php $foto = getFoto($fotos,$principal); echo $config["url"]["urlImagenes"]."".$foto["url"];  ?>" alt="">
                                <div class="trend-top-cap">
                                    <!-- <span>Appetizers</span> -->
                                    <h2><a href="noticia.php?id=<?php showNoticiaId($principal)?>"> <?php echo $principal["titulo"]; ?> </a></h2>
                                </div>
                            </div>
                        </div>
                        <!-- Trending Bottom -->
                        <div class="trending-bottom">
                            <div class="row">

                                <?php 
                                    foreach ($abajo as $ab) {
                                        
                                ?>
                                    <div class="col-lg-4">
                                        <div class="single-bottom mb-35">
                                            <div class="trend-bottom-img mb-30">
                                                <?php $foto = getFoto($fotos,$ab); ?>
                                                <img src="<?php echo $config["url"]["urlImagenes"]."".$foto["url"];?>" alt=""> 
                                            </div>
                                            <div class="trend-bottom-cap">
                                                <span class="color1"><?php echo $ab["nombre"]; ?></span>
                                                <h4><a href="noticia.php?id=<?php showNoticiaId($ab)?>"> <?php echo $ab["titulo"];?> </a></h4>
                                            </div>
                                        </div>
                                    </div>
                                <?php            
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <!-- Riht content -->
                    <div class="col-lg-4">

                        <?php 
                            foreach ($lateral as $late) {
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
                </div>
            </div>
        </div>
    </div>