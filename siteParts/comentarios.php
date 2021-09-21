<div class="comments-area">
    <h4><?php echo count($comentarios); ?> comentarios</h4>
    <div class="comment-list">

        <?php 
            foreach ($comentarios as $comentario) {
                ?>


        <div class="single-comment justify-content-between d-flex">
            <div class="user justify-content-between d-flex">
            <div class="thumb">
                <!-- <img src="assets/img/comment/comment_1.png" alt=""> -->
                <div class="circle">C</div>
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
                    <!-- <div class="reply-btn">
                        <a href="#" class="btn-reply text-uppercase">reply</a>
                    </div> -->
                </div>
            </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>  
    </div>                  
    
</div>