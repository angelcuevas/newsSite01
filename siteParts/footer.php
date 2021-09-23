<?php
    $categorias = $db->query("SELECT id_categoria, nombre, ubicacion FROM noticias_categorias");
?>
   <footer>
       <!-- Footer Start-->
       
       <!-- footer-bottom aera -->
       <div class="footer-bottom-area">
           <div class="container">
               <div class="footer-border">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-lg-6">
                            <div class="footer-copy-right">
                            <a href="index.php"><img src="assets/logo.png" alt="" style="max-height:75px;"></a>
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  <!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com/" target="_blank">Colorlib</a> -->
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="footer-menu f-right">
                                <ul>       
              
                                    <li><a href="https://twitter.com/catamarcauno?s=09"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.facebook.com/catamarcauno/"><i class="fab fa-facebook"></i></a></li>
                                 
                                    <!-- <li><a href="#">Terms of use</a></li>
                                    <li><a href="#">Privacy Policy</a></li> -->
                                    <li><a href="contacto.php">Contacto</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
               </div>
           </div>
       </div>
       <!-- Footer End-->
   </footer>