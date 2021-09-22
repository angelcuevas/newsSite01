<?php if(count( $videos  ) > 0 ): ?>
                        
    <?php  foreach( $videos as $video ): ?>

        <br>

        <div class="videoWrapper"> 
            
            
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo  $video["url"] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                    
            
        </div>

        <?php if(!empty($video["descripcion"])): ?>

            <div class="mutlimedia-description" style="padding-left: 20px;"> <?php echo $video["descripcion"] ?></div>

        <?php endif; ?>

    <?php endforeach; ?>

<?php endif; ?>