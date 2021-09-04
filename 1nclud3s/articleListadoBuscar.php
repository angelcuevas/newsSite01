<?php $contador=1; ?>

<?php foreach($noticias as $notas ): ?>

	<?php

	$imagenNoticia     = mutimeNoticia($fotos,  $notas["id_noticia"]); 

	$audioNoticia      = mutimeNoticia($audios, $notas["id_noticia"]); 

	$videoNoticia      = mutimeNoticia($videos, $notas["id_noticia"]);

    $videoCss='';

	$audioCss='';

	if(strlen($videoNoticia)>0){$videoCss='<div class="video"> <img class="image" src="assets\images\video.png" /> </div>';}
		
	if(strlen($audioNoticia)>0){$audioCss='<div class="audio"> <img class="image" src="assets\images\audio.png" /> </div>';}

	$styleWithoutImage="col-xs-7";

    

    ( ($contador % 2) == 0 )? $posicionImangen="" : $posicionImangen="floatRight";

	if(	strlen($videoNoticia) == 0 AND strlen($imagenNoticia) == 0){$styleWithoutImage='col-xs-12';}

	$urlImagen="";

	if( strlen($videoNoticia)>0 AND strlen($imagenNoticia) OR  strlen($videoNoticia) == 0 AND strlen($imagenNoticia) > 0):

		
		$urlImagen .= 	'
        
                        <div class="col-xs-5 '.$posicionImangen.' ">
                        
                            <figure>

                                <img  class="image"  src="'. $config["url"]["urlImagenes"].$imagenNoticia .'_m.jpg" />

                                '. $videoCss.'

                                '.$audioCss .'								


                            </figure>
                            
                        </div>
						';

					
	elseif( strlen($videoNoticia)>0 AND  strlen($imagenNoticia) == 0):

		$urlImagen .= 	'
                        <div class="col-xs-5 '.$posicionImangen.' ">
                    
                            <figure>

                                <img class="image" src=""http://img.youtube.com/vi/'.$videoNoticia.'/0.jpp"" />


                                '. $videoCss.'

                                '.$audioCss .'									

                            </figure>
                        
                        </div>
						';
		
	endif;
	
	?>


    <a href="<?php echo $config["url"]["urlNoticia"].$notas["id_noticia"];  ?>">
        
        <article class="category__article">
            
            <a href="<?php echo $config["url"]["urlNoticia"].$notas["id_noticia"];  ?>">
            
                <?php echo $urlImagen; ?>
                
            </a>    
            
            <div class="<?php echo $styleWithoutImage ?>">
                
                <h2>
                    
                    <a href="<?php echo $config["url"]["urlNoticia"].$notas["id_noticia"];  ?>">
                        
                        <?php echo $notas["titulo"];  ?>
                        
                    </a>        
                    
                </h2>
                
                <p>
                    <a href="<?php echo $config["url"]["urlNoticia"].$notas["id_noticia"];  ?>">
                        
                        <?php echo $notas["copete"];  ?>
                        
                    </a>        
                </p>
                
            </div>
            
        </article>
        
    
    
    <div class="clearfix"></div>
    <div class="col-xs-12">
        <div class="category__line"></div>
    </div>

	<?php $contador++; ?>

<?php  endforeach; ?>	