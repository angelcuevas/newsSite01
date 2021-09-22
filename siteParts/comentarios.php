<div class="comments-area">
    <h4><?php echo count($comentarios); ?> comentarios</h4>
    <div class="comment-list">

        <?php 
            foreach ($comentarios as $comentario) {
                ?>


            <div class="single-comment justify-content-between d-flex">
                <div class="user justify-content-between d-flex">
                    <div class="thumb">
                        <?php 
                            $letra = "s"; 
                            if(isset($comentario["id_miembro"])){
                                $letra = substr($comentario["id_miembro"],0,1);
                            }
                        ?>
                        <div class="circle"> <?php echo $letra; ?> </div>
                    </div>
                    <div class="desc">
                        <p class="comment">
                            <?php echo $comentario["texto"]; ?>
                        </p>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h5>
                                <a href="#"> <?php echo $comentario["id_miembro"];?> </a>
                                </h5>
                                <p class="date"> <?php echo $comentario["fecha"];?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        <br/>
        
        <?php
        }
        ?>
    </div>  
</div>                  
