<?php


    $principal = array_shift($noticiasTapa);
    
    $abajo = array_slice($noticiasTapa, 0, - (count($noticiasTapa)-3) );

    $lateral = array_slice($noticiasTapa, 0, - (count($noticiasTapa)-5) );


    

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