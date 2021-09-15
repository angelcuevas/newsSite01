    <?php 
        $noticias = array_slice($noticiasTapa, 0, - (count($noticiasTapa)-5) );
    ?>
    
    <!--   Weekly2-News start -->
    <div class="weekly2-news-area  weekly2-pading gray-bg">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>Weekly Top News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="weekly2-news-active dot-style d-flex dot-style">
                            <?php 
                            foreach ($noticias as $noti) {
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