<?php 

    function getPrimerasNoticiasCategoria($noticiasTapa, $categoria_id, $cantidad){
        $noticias = array();
        $contador = 0; 
        foreach ($noticiasTapa as $tapa) {
            
            if($tapa["id_categoria"] == $categoria_id){
                array_push($noticias, $tapa);
                $contador++;
            }
            if($contador >= $cantidad)
                break; 
        }
        return $noticias;
    }

?>
   
   <!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
            <div class="row">
            <div class="col-lg-8">
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>Novedades</h3>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="properties__button">
                            <!--Nav Button  -->                                            
                            <nav>                                                                     
                                <div class="nav nav-tabs" id="nav-tab" role="tablist" style="overflow-x: auto;overflow-y:hidden;flex-wrap: nowrap;">
                                    <?php 
                                        $contador = 0; 
                                        foreach($categorias as $categoria){
                                        ?>                                                        
                                            <a class="nav-item nav-link <?php if($contador == 0) echo "active"; ?>" id="nav-<?php echo $categoria["id_categoria"];?>-tab" data-toggle="tab" href="#nav-<?php echo $categoria["id_categoria"];?>" role="tab" aria-controls="nav-home" aria-selected="true"><?php echo $categoria["nombre"];?></a>
                                        <?php                                                   
                                            $contador++;
                                        }                                                
                                    ?>

                                    <!-- <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Lifestyle</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Travel</a>
                                    <a class="nav-item nav-link" id="nav-last-tab" data-toggle="tab" href="#nav-last" role="tab" aria-controls="nav-contact" aria-selected="false">Fashion</a>
                                    <a class="nav-item nav-link" id="nav-Sports" data-toggle="tab" href="#nav-nav-Sport" role="tab" aria-controls="nav-contact" aria-selected="false">Sports</a>
                                    <a class="nav-item nav-link" id="nav-technology" data-toggle="tab" href="#nav-techno" role="tab" aria-controls="nav-contact" aria-selected="false">Technology</a> -->
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <!-- Nav Card -->
                        <div class="tab-content" id="nav-tabContent">
                            <!-- card one -->
                            <?php 
                                $contador = 0; 
                                foreach($categorias as $categoria){
                                    ?>                                                        
                                        <div class="tab-pane fade show <?php if($contador == 0) echo 'active'; ?>" id="nav-<?php echo $categoria["id_categoria"] ?>" role="tabpanel" aria-labelledby="nav-<?php echo $categoria["id_categoria"]; ?>-tab">           
                                            <div class="whats-news-caption">
                                                <div class="row">
                                                    <?php 

                                                        $noticias = getPrimerasNoticiasCategoria($noticiasTapa, $categoria["id_categoria"],4);
                                                        foreach ($noticias as $noticia) {
                                                        
                                                    ?>
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="single-what-news mb-100">
                                                                <div class="what-img">
                                                                    <?php $foto = getFoto($fotos,$noticia);?>
                                                                    <img src="<?php echo $config["url"]["urlImagenes"]."".$foto["url"] ?>" alt="">
                                                                </div>
                                                                <div class="what-cap">
                                                                    <span class="color1"><?php echo $categoria["nombre"] ?></span>
                                                                    <h4><a href="noticia.php?id=<?php showNoticiaId($noticia)?>"><?php echo $noticia["titulo"]; ?></a></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <? $contador++; }?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php                                                   
                                }                                                
                            ?>

                            <!-- Card two -->
                            <!-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews1.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews2.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews3.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews4.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- Card three -->
                            <!-- <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews1.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews2.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews3.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews4.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- card fure -->
                            <!-- <div class="tab-pane fade" id="nav-last" role="tabpanel" aria-labelledby="nav-last-tab">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews1.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews2.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews3.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews4.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- card Five -->
                            <!-- <div class="tab-pane fade" id="nav-nav-Sport" role="tabpanel" aria-labelledby="nav-Sports">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews1.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews2.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews3.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews4.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- card Six -->
                            <!-- <div class="tab-pane fade" id="nav-techno" role="tabpanel" aria-labelledby="nav-technology">
                                <div class="whats-news-caption">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews1.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews2.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews3.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="single-what-news mb-100">
                                                <div class="what-img">
                                                    <img src="assets/img/news/whatNews4.jpg" alt="">
                                                </div>
                                                <div class="what-cap">
                                                    <span class="color1">Night party</span>
                                                    <h4><a href="#">Welcome To The Best Model  Winner Contest</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    <!-- End Nav Card -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Section Tittle -->
                <div class="section-tittle mb-40">
                    <h3>Seguimos en</h3>
                </div>
                <!-- Flow Socail -->
                <div class="single-follow mb-45">
                    <div class="single-box">
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="https://www.facebook.com/catamarcauno/"><img src="assets/img/news/icon-fb.png" alt=""></a>
                            </div>
                            <!-- <div class="follow-count">  
                                <span>8,045</span>
                                <p>Fans</p>
                            </div> -->
                        </div> 
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="https://twitter.com/catamarcauno?s=09"><img src="assets/img/news/icon-tw.png" alt=""></a>
                            </div>
                            <!-- <div class="follow-count">
                                <span>8,045</span>
                                <p>Fans</p>
                            </div> -->
                        </div>
                        <!-- <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a>
                            </div>
                        </div>
                        <div class="follow-us d-flex align-items-center">
                            <div class="follow-social">
                                <a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- New Poster -->
                <div class="news-poster d-none d-lg-block">
                    <img src="assets/img/news/news_card.jpg" alt="">
                </div>
            </div>
            </div>
        </div>
    </section>
    <!-- Whats New End -->