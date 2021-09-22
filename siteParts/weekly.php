<?php 
    $noticias = array_slice($noticiasTapa, 0, - (count($noticiasTapa)-5) );
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
                                foreach ($noticias as $noticia) {

                            ?>
                            <div class="weekly-single">
                                <div class="weekly-img">
                                    <?php $foto = getFoto($fotos,$noticia); ?>
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