<?php  if( count($noticiasPrincipales)>0 ):?>

    <?php foreach( $noticiasPrincipales as $key => $value ): ?>

            <?php

            $imagenNoticia     = Multimedia::mutimeNoticia($fotos,  $noticiasPrincipales[$key]["id_noticia"]); 

            $audioNoticia      = Multimedia::mutimeNoticia($audios, $noticiasPrincipales[$key]["id_noticia"]); 

            $videoNoticia      = Multimedia::mutimeNoticia($videos, $noticiasPrincipales[$key]["id_noticia"]);

            $videoCss='';

            $audioCss='';

            if(strlen($videoNoticia)>0){$videoCss='<div class="video"> <img class="image" src="assets\images\video.png" /> </div>';}

            if(strlen($audioNoticia)>0){$audioCss='<div class="audio"> <img class="image" src="assets\images\audio.png" /> </div>';}

            $styleWithoutImage=" ";

            if(	strlen($videoNoticia) == 0 AND strlen($imagenNoticia) == 0){$styleWithoutImage="style='height:185px'";}

            $urlImagen="";

            if( strlen($videoNoticia)>0 AND strlen($imagenNoticia) OR  strlen($videoNoticia) == 0 AND strlen($imagenNoticia) > 0):


                $urlImagen .= 	'
                                <figure>

                                    <img  class="image"  src="'. $config["url"]["urlImagenes"].$imagenNoticia .'_s.jpg" />

                                    '. $videoCss.'
                                    
                                    '. $audioCss .'								

                                </figure>

                                ';


            elseif( strlen($videoNoticia)>0 AND  strlen($imagenNoticia) == 0):

                $urlImagen .= 	'
                                <figure>

                                    <img class="image" src=""http://img.youtube.com/vi/'.$videoNoticia.'/0.jpg"" />

                                    '. $videoCss.'

                                    '.$audioCss .'									

                                </figure>

                                
                                ';

            endif;

            ?>

        <?php if($key == 0): ?>
            <a href="<?php echo $config["url"]["urlNoticia"].$noticiasPrincipales[$key]["id_noticia"] ?>" >
                <div class="col-xs-9 paddingLeftRightNone post">
                    <article class="post__primary " <?php echo $styleWithoutImage; ?>>
                        <?php echo $urlImagen ; ?>
                        <div class="post__secondary-textContent">
                            <div class="post__category" style="background: #76D5DB;"><?php Categoria::descripcionCategoria($categorias,$noticiasPrincipales[$key]["id_categoria"]); ?></div>
                            <h1><?php   echo $noticiasPrincipales[$key]["titulo"]; ?></h1>
                        </div> 
                    </article>
                </div>
            </a>    
        <?php else: ?>
            <?php echo ($key == 1)? '<div class="col-xs-3 paddingLeftRightNone">': ""; ?>
            <a href="<?php echo $config["url"]["urlNoticia"].$noticiasPrincipales[$key]["id_noticia"] ?>" >
                <div class="post">
                    <article class="post__secondary first" <?php echo $styleWithoutImage; ?>>
                        <?php echo $urlImagen ; ?>
                        <div class="post__secondary-textContent">
                            <div class="post__category" style="background: #76D5DB;"><?php Categoria::descripcionCategoria($categorias,$noticiasPrincipales[$key]["id_categoria"]); ?></div>
                            <h2><?php echo $noticiasPrincipales[$key]["titulo"]; ?></h2>
                        </div> 
                    </article>
                </div> 
            </a> 
            <?php echo ($key == 4)? '</div>': ""; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>