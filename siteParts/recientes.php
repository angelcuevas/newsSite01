<?php 
    $recientes = array_slice($noticiasTapa, 0, - (count($noticiasTapa)-5) );
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
                                    foreach ($recientes as $noticia) {
                                        ?>
                                            <div class="single-recent mb-100">
                                                <div class="what-img">
                                                    <img src="<?php $foto = getFoto($fotos,$noticia); echo $config["url"]["urlImagenes"]."".$foto["url"];  ?>" alt="">    
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1"> <?php echo $noticia["nombre"]; ?> </span>
                                                    <h4><a href="noticia.php?id=<?php showNoticiaId($noticia)?>"> <?php echo $noticia["titulo"]; ?> </a></h4>
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