<?php
    $categorias = $db->query("SELECT id_categoria, nombre, ubicacion FROM noticias_categorias");
?>
   <footer>
       <!-- Footer Start-->
       <div class="footer-area footer-padding fix">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-5 col-lg-5 col-md-7 col-sm-12">
                        <div class="single-footer-caption">
                            <div class="single-footer-caption">
                                <!-- logo -->
                                <!-- <div class="footer-logo">
                                    <a href="index.html"><img src="assets/logo.jpg" alt="" style="max-height:75px;"></a>
                                </div> -->
                                <!-- <div class="footer-tittle">
                                    <div class="footer-pera">
                                        
                                    </div>
                                </div> -->
                                <!-- social -->
                                <!-- <div class="footer-social">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4  col-sm-6">

                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">

                    </div>
                </div>
            </div>
        </div>
       <!-- footer-bottom aera -->
       <div class="footer-bottom-area">
           <div class="container">
               <div class="footer-border">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="footer-copy-right">
                            <a href="index.html"><img src="assets/logo.jpg" alt="" style="max-height:75px;"></a>
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  <!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com/" target="_blank">Colorlib</a> -->
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="footer-menu f-right">
                                <ul>                             
                                    <!-- <li><a href="#">Terms of use</a></li>
                                    <li><a href="#">Privacy Policy</a></li> -->
                                    <li><a href="#">Contacto</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
       <!-- Footer End-->
   </footer>