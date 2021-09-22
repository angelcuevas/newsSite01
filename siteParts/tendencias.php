<div class="trending-tittle">
    <strong>Tendencias</strong>
    <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
    <div class="trending-animated">
        <ul id="js-news" class="js-hidden">
            <?php 
                foreach ($noticiasTapa as $noticia) {
                    if($noticia["columna"] == 1){
                    ?>
                        <li class="news-item"><a href="noticia.php?id=<?php echo $noticia["id_noticia"]; ?>"> <?php echo $noticia["titulo"]; ?></a></li>
                    <?php
                    }
                }
            ?>
        </ul>
    </div>
    
</div>