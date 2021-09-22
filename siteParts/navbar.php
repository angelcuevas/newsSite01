<?php 
    $categorias = $db->query("SELECT id_categoria, nombre, ubicacion FROM noticias_categorias");

    // $zip = 43101;
    // $codigoPais = "ar";
    // $apiKey = "5cb0bccef32d99b26506d2b0f48cb22e";

    // $url = "http://api.openweathermap.org/data/2.5/weather?zip=".$zip.",".$codigoPais."&appid=".$apiKey;
  
    // $contents = file_get_contents($url);
    // $clima = json_decode($contents, true);
    
    // echo $url;

    // echo "--------------------";
    // $clima_apikey = "axTqaaXXzaXfd3Z";
    // $url = "https://api.tutiempo.net/json/?lan=es&apid=".$clima_apikey."&lid=43101";
    // $WeatherJson = file_get_contents($url);
    // $WeatherArray = json_decode($WeatherJson,true);
    // echo $url;


 




?>
<header>
    <?php 

    ?>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top black-bg d-none d-md-block">
                   <div class="container">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>     
                                        <!-- <li><img src="assets/img/icon/header_icon1.png" alt="">34ºc, Sunny </li> <img src="assets/img/icon/header_icon1.png" alt=""> -->
                                        <li> <?php mostrarFechaDeHoy(); ?> </li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">    
                                        <li><a href="https://www.facebook.com/catamarcauno/"><i class="fab fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/catamarcauno?s=09"><i class="fab fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
                <div class="header-mid d-none d-md-block">
                   <div class="container">
                        <div class="row d-flex align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-3 col-lg-3 col-md-3">
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="assets/logo.png" alt="" style="max-height: 100px;">
                                        
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="header-banner f-right ">
                                    <img src="assets/img/hero/header_card.jpg" alt="">
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
               <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                                <!-- sticky -->
                                    <div class="sticky-logo">
                                        <a href="index.php"><img src="assets/logo.png" alt="" style="max-height: 100px;"></a>
                                    </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-md-block">
                                    <nav>                  
                                        <ul id="navigation">    
                                            <li><a href="index.php">Inicio</a></li>
                                            <?php 
                                                foreach($categorias as $categoria){
                                                    ?>                                                    
                                                        <li> <a href="categoria.php?id=<?php echo $categoria["id_categoria"]; ?>"><?php echo $categoria["nombre"];?></a></li>                                                  
                                                    <?php                                                   
                                                }                                                
                                            ?>
                                            <!-- <ul class="submenu">
                                                <li><a href="elements.html">Element</a></li>
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="single-blog.html">Blog Details</a></li>
                                                <li><a href="details.html">Categori Details</a></li>
                                            </ul> -->
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>             
                            <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <i class="fas fa-search special-tag"></i>
                                    <div class="search-box">
                                        <form action="<?php determinarDireccionDebusqueda(); ?>" method="POST" >
                                            <input type="text" name="busqueda" placeholder="Buscar" value="<?php if(isset($busquedaStr)) echo $busquedaStr; ?>">
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>