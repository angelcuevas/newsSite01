<?php
    include("./1nclud3s/Config_y_funciones.php");
    require_once 'clases/Noticia.php';
    require_once 'clases/Multimedia.php';
    require_once 'clases/Comentario.php';
    require_once 'clases/Columnista.php';
    require_once 'clases/Categoria.php';
    
    //Obtiene el valor ID de la URL y consulta si es numerico 

    if(is_numeric($_GET["id"]))
	    $id_noticia=$_GET["id"];
    else
	    header("location:404.html");

    $parametrosDeClases["db"] = $db;
    $parametrosDeClases["config"] = $config;
    $parametrosDeClases["id_noticia"] = $id_noticia;    
    
    $verNoticia = New Noticia($parametrosDeClases);
    $multimedia = New Multimedia($parametrosDeClases);
    $comentario = New Comentario($parametrosDeClases);
    $columnista = New Columnista($parametrosDeClases);
    $categoriaNoticia  = New Categoria($parametrosDeClases);


 /////////////////////////////// Consultas /////////////////////////////////////////

    $parametroConsulta = array("id_noticia" => $id_noticia );

    $noticia     = $verNoticia->verNoticia();

    $fotos       = $multimedia->archivosMultimedia("noticias_fotos");

    $audios      = $multimedia->archivosMultimedia("noticias_audios"); 

    $videos      = $multimedia->archivosMultimedia("noticias_videos");  

    $adjuntos    = $multimedia->archivosMultimedia("noticias_adjuntos");

    $comentarios = $comentario->listaComentario();

    $lastPost    =   $verNoticia->getLastNews();

    if($_POST){
        $comentario->alta($_POST['nombre'],$_POST['texto']);
    }

    $fechaNoticia = fechaDiaMes($noticia["fecha"]);

    $fecha = date("Y-m-d H:i:s");	



    
?>

<!doctype html>
<html class="no-js" lang="zxx">
    
<!-- Mirrored from technext.github.io/aznews/details.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Aug 2021 16:35:52 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>News HTML-5 Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.html">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">

    <link rel="stylesheet" href="assets/css/ticker-style.css">

    <link rel="stylesheet" href="assets/css/flaticon.css">

    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <style>
        .circle {
            background: #61EAF9;
            width: 75px;
            height: 75px;
            border-radius: 50%;
            text-align: center;
            vertical-align: middle;
            line-height: 75px; 
            font-size: 2em;
            font-weight: bold;
            font-family: 'helvetica';
            color: #333;

        }

    </style>

   </head>

   <body>
       
    <!-- Preloader Start
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
     Preloader Start -->


    <?php include("./siteParts/navbar.php") ?>

    <main>
        <!-- About US Start -->
        <div class="about-area">
            <div class="container">
                    <!-- Hot Aimated News Tittle-->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="trending-tittle">
                                <strong>Trending now</strong>
                                <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
                                <div class="trending-animated">
                                    <ul id="js-news" class="js-hidden">
                                        <li class="news-item">Bangladesh dolor sit amet, consectetur adipisicing elit.</li>
                                        <li class="news-item">Spondon IT sit amet, consectetur.......</li>
                                        <li class="news-item">Rem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-lg-8">
                            <!-- Trending Tittle -->
                            <div class="about-right mb-90">
                                <div class="about-img">
                                    <img src="<?php echo $config["url"]["urlImagenes"]."".$fotos[0]["url"];?>" alt=""> 
                                </div>
                                <div class="section-tittle mb-30 pt-30">
                                    <h3><?php echo $noticia["titulo"]; ?></h3>
                                </div>
                                <div class="about-prea">
                                    <p><i><?php echo $noticia["copete"]; ?></i> </p>
                                </div> 
                                <br/>
                                <!-- <div class="section-tittle">
                                    <h3>Unordered list style?</h3>
                                </div> -->
                                <div class="about-prea">
                                    <?php echo $noticia["cuerpo"]; ?>

                                </div>
                                <!-- <div class="social-share pt-30">
                                    <div class="section-tittle">
                                        <h3 class="mr-20">Share:</h3>
                                        <ul>
                                            <li><a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a></li>
                                            <li><a href="#"><img src="assets/img/news/icon-fb.png" alt=""></a></li>
                                            <li><a href="#"><img src="assets/img/news/icon-tw.png" alt=""></a></li>
                                            <li><a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div> -->
                            </div>



                            <!-- From -->
                            <div class="row">

                                <?php 
                                    $NOMBRE_PLACE_HOLDER = "Tu nombre";
                                    $MENSAJE_PLACE_HOLDER = "Mensaje";
                                ?>
                                
                                <div class="col-lg-8">

                                <?php include('./siteParts/comentarios.php'); ?>

                                    <form class="form-contact contact_form mb-80" action="noticia.php?id=<?php echo $id_noticia; ?>&acc=comentario" method="POST" id="contactForm2" novalidate="novalidate">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea class="form-control w-100 error" name="texto" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $MENSAJE_PLACE_HOLDER; ?>'" placeholder="<?php echo $MENSAJE_PLACE_HOLDER; ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input class="form-control error" name="nombre" id="nombre" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $NOMBRE_PLACE_HOLDER; ?>'" placeholder="<?php echo $NOMBRE_PLACE_HOLDER; ?>">
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input class="form-control error" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-12">
                                                <div class="form-group">
                                                    <input class="form-control error" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject">
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="form-group mt-3">
                                            <button type="submit" class="button button-contactForm boxed-btn">Enviar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Section Tittle -->
                            <!-- <div class="section-tittle mb-40">
                                <h3>Follow Us</h3>
                            </div> -->
                            <!-- Flow Socail -->
                            <!-- <div class="single-follow mb-45">
                                <div class="single-box">
                                    <div class="follow-us d-flex align-items-center">
                                        <div class="follow-social">
                                            <a href="#"><img src="assets/img/news/icon-fb.png" alt=""></a>
                                        </div>
                                        <div class="follow-count">  
                                            <span>8,045</span>
                                            <p>Fans</p>
                                        </div>
                                    </div> 
                                    <div class="follow-us d-flex align-items-center">
                                        <div class="follow-social">
                                            <a href="#"><img src="assets/img/news/icon-tw.png" alt=""></a>
                                        </div>
                                        <div class="follow-count">
                                            <span>8,045</span>
                                            <p>Fans</p>
                                        </div>
                                    </div>
                                        <div class="follow-us d-flex align-items-center">
                                        <div class="follow-social">
                                            <a href="#"><img src="assets/img/news/icon-ins.png" alt=""></a>
                                        </div>
                                        <div class="follow-count">
                                            <span>8,045</span>
                                            <p>Fans</p>
                                        </div>
                                    </div>
                                    <div class="follow-us d-flex align-items-center">
                                        <div class="follow-social">
                                            <a href="#"><img src="assets/img/news/icon-yo.png" alt=""></a>
                                        </div>
                                        <div class="follow-count">
                                            <span>8,045</span>
                                            <p>Fans</p>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- New Poster -->
                            <div class="news-poster d-none d-lg-block">
                                <img src="assets/img/news/news_card.jpg" alt="">
                            </div>
                        </div>
                   </div>
            </div>
        </div>
        <!-- About US End -->
    </main>
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
        <!-- Date Picker -->
        <script src="assets/js/gijgo.min.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="assets/js/wow.min.js"></script>
		<script src="assets/js/animated.headline.js"></script>
        <script src="assets/js/jquery.magnific-popup.js"></script>

        <!-- Breaking New Pluging -->
        <script src="assets/js/jquery.ticker.js"></script>
        <script src="assets/js/site.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="assets/js/jquery.scrollUp.min.js"></script>
        <script src="assets/js/jquery.nice-select.min.js"></script>
		<script src="assets/js/jquery.sticky.js"></script>
        
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

<!-- Mirrored from technext.github.io/aznews/details.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Aug 2021 16:35:52 GMT -->
</html>