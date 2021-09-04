<?php foreach( $noticia as $key => $value ): ?>

    <?php

    $imagenNoticia     = Multimedia::mutimeNoticia($fotos,  $noticia[$key]["id_noticia"]); 

    $audioNoticia      = Multimedia::mutimeNoticia($audios, $noticia[$key]["id_noticia"]); 

    $videoNoticia      = Multimedia::mutimeNoticia($videos, $noticia[$key]["id_noticia"]);

    $videoCss='';

    $audioCss='';

    if(strlen($videoNoticia)>0){$videoCss='<div class="video"> <img class="image" src="assets\images\video.png" /> </div>';}

    if(strlen($audioNoticia)>0){$audioCss='<div class="audio"> <img class="image" src="assets\images\audio.png" /> </div>';}

    if( $key == 0 ): 
        $classContentImage='class="col-xs-5"';
        $styleWithoutImage="col-xs-7";
    else:
        $classContentImage='class="col-xs-2 paddingRightNone"';
        $styleWithoutImage="col-xs-4";
    endif;
    

    

    if(	strlen($videoNoticia) == 0 AND strlen($imagenNoticia) == 0){
        ( $key == 0 )? $styleWithoutImage="col-xs-12" : $styleWithoutImage="col-xs-6";
    }

    $urlImagen="";

    if( strlen($videoNoticia)>0 AND strlen($imagenNoticia) OR  strlen($videoNoticia) == 0 AND strlen($imagenNoticia) > 0):


        $urlImagen .= 	"
        
                         <div {$classContentImage} >
                        
                            <figure>

                                <img  class='image'  src='". $config["url"]["urlImagenes"].$imagenNoticia ."_s.jpg' />

                                ". $videoCss ."

                                ". $audioCss ."								

                            </figure>

                        </div>

                        ";


    elseif( strlen($videoNoticia)>0 AND  strlen($imagenNoticia) == 0):
        
        $urlImagen .= 	"
        
                         <div {$classContentImage} >
                        
                            <figure>

                                <img class='image' src='http://img.youtube.com/vi/".$videoNoticia."/0.jpg' />

                                ". $videoCss ."

                                ". $audioCss ."								

                            </figure>

                        </div>

                        ";
    endif;

    ?>

<?php if( $key == 0 ): ?>
    <div class="category__content">

        <div class="col-xs-9">
            <div class="category__content-title">ÚLTIMOS ARTÍCULOS DE <span style="color: #FF78A9;"><?php Categoria::descripcionCategoria($categorias,$noticia[$key]["id_categoria"]) ?></span></div>
        </div>
        <div class=" col-xs-3 paddingRightNone">
            <div class="category__content-morePost" style="background-color: #FF78A9;"><a href="<?php echo  $config["url"]["listados"].$noticia[$key]["id_categoria"]; ?>"> VER TODOS</a></div>  
        </div>

        <div class="clearfix"></div>
    </div>

    <a href="<?php echo $config["url"]["urlNoticia"].$noticia[$key]["id_noticia"] ?>" >
        <article class="category__article">

            <?php echo $urlImagen; ?>

            <div class="<?php echo $styleWithoutImage; ?>">
                <h2><?php echo $noticia[$key]["titulo"] ?></h2>
                <p><?php  echo $noticia[$key]["copete"] ?></p>
            </div>    

        </article>
    </a>    
    <div class="clearfix"></div>    
    <div class="col-xs-12">
        <div class="category__line"></div>
    </div>                                        
    <?php else: ?>          
        <a href="<?php echo $config["url"]["urlNoticia"].$noticia[$key]["id_noticia"] ?>" >
            <article class="category__article-small" >
                <?php echo $urlImagen; ?>    
                <h3 class="<?php echo $styleWithoutImage; ?>" ><?php echo    $noticia[$key]["titulo"] ?></h3>
            </article>
        </a>    

    <?php if(($key % 2) == 0): ?>    
        <div class="clearfix"></div>    
        <div class="col-xs-12">
            <div class="category__line"></div>
        </div>  
    <?php  endif; ?>    

    <?php endif; ?>          

                        <?php endforeach; ?>