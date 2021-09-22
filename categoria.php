<?php
    if(is_numeric($_GET["id"]))
    $id_categoria=$_GET["id"];
// else
//     header("location:404.html");

    include("./1nclud3s/Config_y_funciones.php");
    include("./1nclud3s/new_consultas.php");
    include("./1nclud3s/utils.php");





    if(is_numeric($_GET["pagina"])){
        $nroPagina=$_GET["pagina"];
        $nroPagina = $nroPagina -1 ;
    }else
        $nroPagina = 0; 

    $busquedaStr = "";
    if($_POST){
        $busquedaStr = $_POST["busqueda"];
    }
    


    function getWhere($id_categoria,$busquedaStr){
        $result = "";
        
        if(isset($id_categoria) && $id_categoria != "")
            $result = $result." AND noticias.id_categoria = ".$id_categoria."";
        if($busquedaStr != ""){
            $result = $result." AND noticias.titulo LIKE '%".$busquedaStr."%'";
        }
        return $result;
    }

    $where = getWhere($id_categoria,$busquedaStr);

    $qry =  $db->query("SELECT COUNT(noticias.id_noticia) as cantidad	FROM noticias_tapa INNER JOIN noticias ON  noticias_tapa.Id_Noticia = noticias.id_Noticia LEFT JOIN noticias_categorias ON noticias_categorias.id_categoria = noticias.id_categoria where 1 ".$where."  ORDER BY noticias_tapa.ubicacion ASC ");
    $cantidadRows = $qry[0]["cantidad"];

    $noticias = $db->query("SELECT noticias.hits,noticias.id_categoria,	noticias_tapa.columna,	noticias.id_noticia, noticias.volanta,	noticias.copete,	noticias.titulo,	noticias.fecha,	noticias.activa, noticias_categorias.nombre, COUNT(comentarios.id_comentario) as cantidadComentarios FROM noticias_tapa INNER JOIN noticias ON  noticias_tapa.Id_Noticia = noticias.id_Noticia LEFT JOIN noticias_categorias ON noticias_categorias.id_categoria = noticias.id_categoria LEFT JOIN noticias_comentarios AS comentarios ON comentarios.revisado = 1 AND comentarios.id_noticia = noticias.id_noticia where 1 ".$where." GROUP BY noticias.id_noticia  ORDER BY noticias_tapa.ubicacion ASC limit ".($nroPagina * 4).",4");
    $cantidadDePaginas = ceil(($cantidadRows/4));

?>



<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from technext.github.io/aznews/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Aug 2021 16:35:46 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php include("siteParts/titulo.php"); ?>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.html">
    <!-- Place favicon.ico in the root directory -->
    
  <!-- CSS here -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/slicknav.css">
  <link rel="stylesheet" href="assets/css/animate.min.css">
  <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/slick.css">
  <link rel="stylesheet" href="assets/css/nice-select.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    
    <!-- Preloader Start -->
    <!-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div> -->
    <!-- Preloader Start -->
    <?php include("./siteParts/navbar.php") ?>

    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <?php 

                        if($busquedaStr != "" && count($noticias) == 0 ){
                            echo "<h5 class='text-center'>Sin resultados.</h5>";
                        }

                        foreach ($noticias as $noticia) {
                            ?>
                                <article class="blog_item">
                                    <div class="blog_item_img">
                                        <?php $foto = getFoto($fotos,$noticia); ?>
                                        <img style="max-height: 500px;" class="card-img rounded-0" src="<?php echo $config["url"]["urlImagenes"]."".$foto["url"];?>" alt="">
                                        <a href="#" class="blog_item_date">
                                            <h3>  </h3>
                                            <p> <?php echo mostrarSoloFecha($noticia["fecha"]); ?>  </p>
                                        </a>
                                    </div>

                                    <div class="blog_details">
                                        <a class="d-inline-block" href="noticia.php?id=<?php echo $noticia["id_noticia"];?>" >
                                            <h2> <?php echo $noticia["titulo"]; ?> </h2>
                                        </a>
                                        <p> <?php echo $noticia["copete"]; ?> </p>
                                        <ul class="blog-info-link">
                                            <li><a href="#"><i class="fa fa-user"></i> <?php echo $noticia["nombre"]; ?> </a></li>
                                            <li><a href="#"><i class="fa fa-comments"></i> <?php echo $noticia["cantidadComentarios"];?> </a></li>
                                        </ul>
                                    </div>
                                </article>
                            <?php
                        }


                        ?>

                        <!--PAGINADOR -->
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Previous">
                                        <i class="ti-angle-left"></i>&nbsp
                                    </a>
                                </li>
                                <?php 
                                    for ($i=0; $i < $cantidadDePaginas; $i++) { 
                                        ?>
                                            <li class="page-item <?php if(($i) ==$nroPagina ) echo "active"; ?>">
                                                <?php $url = "categoria.php?id=".$id_categoria."&pagina=".($i+1)."" ;  ?>
                                                <a href="<?php echo $url?>" class="page-link "> <?php echo $i+1; ?> </a>
                                            </li>
                                        <?php
                                    }
                                ?>

                                <!-- <li class="page-item active">
                                    <a href="#" class="page-link">2</a>
                                </li> -->
                                <li class="page-item">
                                    <a href="#" class="page-link" aria-label="Next">
                                        <i class="ti-angle-right"></i>&nbsp 
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">

                    <aside class="single_sidebar_widget search_widget">
                        <div class="news-poster d-none d-lg-block">
                            <img src="assets/img/news/news_card.jpg" alt="">
                        </div>   
                    </aside>  
                    <aside class="single_sidebar_widget search_widget">
                        <div class="news-poster d-none d-lg-block">
                            <img src="assets/img/news/news_card.jpg" alt="">
                        </div>   
                    </aside>                                                        

                        <!-- <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="button"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside> -->

                        <!-- <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Resaurant food</p>
                                        <p>(37)</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Travel news</p>
                                        <p>(10)</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Modern technology</p>
                                        <p>(03)</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Product</p>
                                        <p>(11)</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Inspiration</p>
                                        <p>21</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex">
                                        <p>Health Care (21)</p>
                                        <p>09</p>
                                    </a>
                                </li>
                            </ul>
                        </aside> -->

                        <!-- <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Post</h3>
                            <div class="media post_item">
                                <img src="assets/img/post/post_1.png" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>From life was you fish...</h3>
                                    </a>
                                    <p>January 12, 2019</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="assets/img/post/post_2.png" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>The Amazing Hubble</h3>
                                    </a>
                                    <p>02 Hours ago</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="assets/img/post/post_3.png" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>Astronomy Or Astrology</h3>
                                    </a>
                                    <p>03 Hours ago</p>
                                </div>
                            </div>
                            <div class="media post_item">
                                <img src="assets/img/post/post_4.png" alt="post">
                                <div class="media-body">
                                    <a href="single-blog.html">
                                        <h3>Asteroids telescope</h3>
                                    </a>
                                    <p>01 Hours ago</p>
                                </div>
                            </div>
                        </aside> -->
                        <!-- <aside class="single_sidebar_widget tag_cloud_widget">
                            <h4 class="widget_title">Tag Clouds</h4>
                            <ul class="list">
                                <li>
                                    <a href="#">project</a>
                                </li>
                                <li>
                                    <a href="#">love</a>
                                </li>
                                <li>
                                    <a href="#">technology</a>
                                </li>
                                <li>
                                    <a href="#">travel</a>
                                </li>
                                <li>
                                    <a href="#">restaurant</a>
                                </li>
                                <li>
                                    <a href="#">life style</a>
                                </li>
                                <li>
                                    <a href="#">design</a>
                                </li>
                                <li>
                                    <a href="#">illustration</a>
                                </li>
                            </ul>
                        </aside> -->


                        <!-- <aside class="single_sidebar_widget instagram_feeds">
                            <h4 class="widget_title">Instagram Feeds</h4>
                            <ul class="instagram_row flex-wrap">
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="assets/img/post/post_5.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="assets/img/post/post_6.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="assets/img/post/post_7.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="assets/img/post/post_8.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="assets/img/post/post_9.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="assets/img/post/post_10.png" alt="">
                                    </a>
                                </li>
                            </ul>
                        </aside> -->


                        <!-- <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title">Newsletter</h4>

                            <form action="#">
                                <div class="form-group">
                                    <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Subscribe</button>
                            </form>
                        </aside> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    <!-- Footer Start-->
    <?php include("./siteParts/footer.php"); ?>
    <!-- Footer End-->

    <!-- JS here -->

		<!-- All JS Custom Plugins Link Here here -->
        <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/slick.min.js"></script>

		<!-- One Page, Animated-HeadLin -->
        <script src="assets/js/wow.min.js"></script>
		<script src="assets/js/animated.headline.js"></script>
		
		<!-- Scrollup, nice-select, sticky -->
        <script src="assets/js/jquery.scrollUp.min.js"></script>
        <script src="assets/js/jquery.nice-select.min.js"></script>
		<script src="assets/js/jquery.sticky.js"></script>
        <script src="assets/js/jquery.magnific-popup.js"></script>

        <!-- contact js -->
        <script src="assets/js/contact.js"></script>
        <script src="assets/js/jquery.form.js"></script>
        <script src="assets/js/jquery.validate.min.js"></script>
        <script src="assets/js/mail-script.js"></script>
        <script src="assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>

</body>

<!-- Mirrored from technext.github.io/aznews/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Aug 2021 16:35:50 GMT -->
</html>