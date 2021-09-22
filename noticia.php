<?php
    include("./1nclud3s/Config_y_funciones.php");
    include("./1nclud3s/new_consultas.php");
    include("./1nclud3s/utils.php");
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

    $currentNoticia     = $verNoticia->verNoticia();

    $fotos       = $multimedia->archivosMultimedia("noticias_fotos");

    $audios      = $multimedia->archivosMultimedia("noticias_audios"); 

    $videos      = $multimedia->archivosMultimedia("noticias_videos");  

    $adjuntos    = $multimedia->archivosMultimedia("noticias_adjuntos");

    $comentarios = $comentario->listaComentario();

    $lastPost    =   $verNoticia->getLastNews();

    if($_POST){
        $comentario->alta($_POST['nombre'],$_POST['texto']);
    }

    $fechaNoticia = fechaDiaMes($currentNoticia["fecha"]);

    $fecha = date("Y-m-d H:i:s");	

?>

<!doctype html>
<html class="no-js" lang="zxx">
    
<!-- Mirrored from technext.github.io/aznews/details.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Aug 2021 16:35:52 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php include("siteParts/titulo.php");?>
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
            width: 60px;
            height: 60px;
            border-radius: 50%;
            text-align: center;
            vertical-align: middle;
            line-height: 60px; 
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
                            <?php include("siteParts/tendencias.php"); ?>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-lg-8">
                            <!-- Trending Tittle -->
                            <div class="about-right mb-90">
                                <div class="about-img">
                                    <?php
                                        if(count($fotos) == 1){
                                            ?>
                                                <img src="<?php echo $config["url"]["urlImagenes"]."".$fotos[0]["url"];?>" alt=""> 
                                            <?php
                                        }else{
                                           if(count( $fotos  ) > 0 ){?>
                                                <?php include("siteParts/noticia_fotos.php"); ?>  
                                            <?php
                                            }
                                        }
                                    ?>
                                    
                                </div>
                                <div class="section-tittle mb-30 pt-30">
                                    <h3><?php echo $currentNoticia["titulo"]; ?></h3>
                                </div>
                                <div class="about-prea">
                                    <p><i><?php echo $currentNoticia["copete"]; ?></i> </p>
                                </div> 
                                <br/>
                                <!-- <div class="section-tittle">
                                    <h3>Unordered list style?</h3>
                                </div> -->
                                <div class="about-prea">
                                    <?php echo $currentNoticia["cuerpo"]; ?>

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
                                <div>
                                    <?php if(count($audios)): ?>
										
                                        <div class="clearfix"></div>
                                                
                                        <?php foreach($audios as $audio ): ?>
                                        
                                            <br>
                                        
                                            <audio  src="<?php $multimedia->audioLink($audio); ?>" preload="auto" controls></audio>
            
                                            <?php if(!empty($audio["descripcion"])): ?>
                                    
                                                <div class="mutlimedia-description " style="padding-left: 25px;"> <?php echo $audio["descripcion"] ?></div>
                                    
                                            <?php endif; ?>                        
                                                    
                                        <?php endforeach; ?>	
                                                        
                                        <div class="clearfix mb-30"></div>
                                                    
                                    <?php endif; ?>  
                                </div>
                                <div>
                                    <?php if( count($adjuntos)>0 ): ?>
                                        <br>
                                        <?php foreach( $adjuntos as $adjunto): ?>
                                            <a download href="<?php echo  $config["url"]["urlAdjuntos"].$adjunto["url"]  ?>" >
                                            <button class="btn btn-outline-secondary" style="margin:5px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
                                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"></path>
                                                </svg>
                                                <!-- <span class="reply-icon"><img src="assets/img/adjunto.png" /> </span> -->
                                                <?php echo  $adjunto["descripcion"] ?>	
                                                </button>
                                            </a>    
                                        <?php endforeach; ?>				
                                    <?php endif; ?>  
                                </div>  

                                <div>
                                    <?php if(count( $videos  ) > 0 ): ?>
                                        <?php include("siteParts/youtube_noticia.php"); ?>  
                                    <?php endif; ?>  
                                </div>                   

                   
                                <div>
                                                <!-- FOTOS -->
                                </div>  

                            </div>
   
 

                            <!-- From -->
                            <div class="row">

                                <?php 
                                    $NOMBRE_PLACE_HOLDER = "Tu nombre";
                                    $MENSAJE_PLACE_HOLDER = "Mensaje";
                                ?>
                                
                                <div class="col-lg-8">
                                <div>

                                <?php include('./siteParts/comentarios.php'); ?>
                                </div>
                                

                                    <form class="form-contact contact_form mb-80" action="noticia.php?id=<?php echo $id_noticia; ?>&acc=comentario" method="POST" id="contactForm2" novalidate="novalidate">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea class="form-control w-100 error" maxlength="256" name="texto" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?php echo $MENSAJE_PLACE_HOLDER; ?>'" placeholder="<?php echo $MENSAJE_PLACE_HOLDER; ?>"></textarea>
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
                            <?php include("siteParts/social_media.php"); ?>
                            <!-- New Poster -->
                            <div class="news-poster d-none d-lg-block">
                                <img src="assets/img/news/news_card.jpg" alt="">
                            </div>
                            
                            <?php //include("siteParts/noticias_laterales.php"); ?>

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

        <script>
window.player = new window.YT.Player(video, {
  videoId: videoId,
  playerVars: {
    autoplay: 1,
    modestbranding: 1,
    rel: 0
    // more parameters here
  }
});
</script>
        
    </body>

<!-- Mirrored from technext.github.io/aznews/details.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Aug 2021 16:35:52 GMT -->
</html>