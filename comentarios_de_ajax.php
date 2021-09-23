<?php 
    include("./1nclud3s/Config_y_funciones.php");
    include("./1nclud3s/new_consultas.php");
    include("./1nclud3s/utils.php");

    require_once 'clases/Comentario.php';

    //Obtiene el valor ID de la URL y consulta si es numerico
    
    $parametrosDeClases["db"] = $db;
    $parametrosDeClases["config"] = $config;
    $parametrosDeClases["id_noticia"] = $_POST["id_noticia"];    
    
    $comentario = New Comentario($parametrosDeClases);

    $comentarios = $comentario->listaComentario();

    echo "id noticia : " .$_POST["id_noticia"];
?>

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
