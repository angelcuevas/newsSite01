
<?php $key = 1;  ?>

<?php foreach($noticias as $notas ): ?>

	<?php

	$imagenNoticia     = mutimeNoticia($fotos,  $notas["id_noticia"]); 

	$audioNoticia      = mutimeNoticia($audios, $notas["id_noticia"]); 

	$videoNoticia      = mutimeNoticia($videos, $notas["id_noticia"]); 

	$categoriaNoticia  = descripcionCategoria($categorias, $notas["id_categoria"]); 

	$videoCss='';

	$audioCss='';

	if(strlen($videoNoticia)>0){$videoCss='<div class="video"> <img src="images\video.png" /> </div>';}
		
	if(strlen($audioNoticia)>0){$audioCss='<div class="audio"> <img src="images\audio.png" /> </div>';}

	$styleWithoutImage="";

	if(	strlen($videoNoticia) == 0 AND strlen($imagenNoticia) == 0){$styleWithoutImage='class="styleWithoutImage"';}

	$urlImagen="";

	if( strlen($videoNoticia)>0 AND strlen($imagenNoticia) OR  strlen($videoNoticia) == 0 AND strlen($imagenNoticia) > 0):


		$urlImagen .= 	'
						<figure class="post-image" >
						
							<a href="'. $config["url"]["urlNoticia"].$notas["id_noticia"] .'">
							
								 <img  src="'. $config["url"]["urlImagenes"].$imagenNoticia .'_m.jpg" />
								 
								 '. $videoCss.'
								 
								 '.$audioCss .'								
								 
							</a>
							
						</figure>
						';

					
	elseif( strlen($videoNoticia)>0 AND  strlen($imagenNoticia) == 0):

		$urlImagen .= 	'
						<figure class="post-image" >
						
							<a href="'. $config["url"]["urlNoticia"].$notas["id_noticia"] .'">
							
								<img src=""http://img.youtube.com/vi/'.$videoNoticia.'/0.jpp"" />
								
								'. $videoCss.'
								 
								'.$audioCss .'									
								
							</a>
							
							
						</figure>
						';
		
	endif;
	
	$fechaNoticia = fechaDiaMes($notas["fecha"]);
	

	?>
    <div class="span4">
        
        <article class="entry">

            <?php echo $urlImagen; ?>

            <div class="post">
                
                <div class="post-detail">
                    
                    <h3 class="post-title"><a href="<?php echo $config["url"]["urlNoticia"].$notas["id_noticia"];  ?>"><?php echo $notas["titulo"];  ?> </a></h3>
                    
                    <span class="dates"><?php echo fecha($notas["fecha"]); ?> </span>
                    
                    <p class="post-description"><?php echo $notas["copete"];  ?></p>
                    

                    <div class="clearfix"></div>
                    
                    <div class="social">

                        <span class="mr-5" >
                            <a target="_blank" href="<?php echo $config["url"]["fbShare"].$notas["id_noticia"]; ?>" class="link f" data-original-title="Facebook"><img src="images/facebook.png"/></a>
                        </span>

                        <span>
                            <a target="_blank" href="<?php echo $config["url"]["twShare"].$notas["id_noticia"]; ?>" class="link twit" data-original-title="Twitter"> <img src="images/twitter.png"/></a>
                        </span>

            	   </div>
                    
                    <div class="read-more">
                    	<a href="<?php echo $config["url"]["urlNoticia"].$notas["id_noticia"];  ?>">Continuar leyendo</a>
                    </div>


                    <div class="clearfix mb-30"></div>
                    
               
                    
                    <div class="sign-up"></div>

                                           
                </div>    
                
            </div>    
                    
        </article>

    </div>    

    <?php if($key % 2 == 0): ?>
    
        <div class="clearfix mb-30"></div>

    <?php endif;  ?>


    <?php if($key  == 2 and $notas["id_categoria"] == 11 ): ?> 

        <div class="banner"><a href="https://www.larioja.gob.ar/" target="_blank"><img src="../img/publicidad/971X192.gif" alt="Gobierno de La Rioja" width="770" height="152" /></a></div>
        

    <?php elseif($key  == 4  and $notas["id_categoria"] == 11 ): ?> 

        <div class="banner"><a href="https://www.facebook.com/gobmunchilecito/" target="_blank"><img src="../img/publicidad/municipio.jpg" alt="Municipio Chilecito" /></a></div>

    <?php elseif($key  == 6  and $notas["id_categoria"] == 11 ): ?> 

       <div class="banner"><a href="https://www.edelar.com.ar/" target="_blank"><img src="../img/publicidad/edelar2021.jpg" alt="Edelar" width="708" height="279" /></a></div>
    <!-- <div class="banner">
        </div>-->

    <?php elseif($key  == 8  and $notas["id_categoria"] == 11 ): ?> 

       <!-- <div class="banner">
            
           
        </div>-->


    <?php endif; $key++; ?>
    

<?php  endforeach; ?>

