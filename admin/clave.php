<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();

if(!empty($_POST)){

        $clave = una_consulta("SELECT clave from administradores WHERE id_administrador = '" . $_SESSION["id_administrador"] . "'");
        
        $clave_antigua = $_POST["clave_antigua"];

        if( $clave["clave"] == $clave_antigua ){

            $clave_nueva1 = $_POST["clave_nueva1"];
            $clave_nueva2 = $_POST["clave_nueva2"];
            
            if($clave_nueva1 == $clave_nueva2){
                mysql_query("UPDATE administradores SET Clave = '$clave_nueva1' WHERE id_administrador = '". $_SESSION["id_administrador"] . "'");
                header("Location: clave.php?exito=actualizar");            
            }else{
                header("Location: clave.php?exito=false&err=Las+contraseñas+no+son+iguales");
            }
        }else{
            header("Location: clave.php?exito=false&err=Contraseña+incorrecta");
        }
}

include("partes/top.php");
?>   

    <div class="center_content">  
    <div class="left_content">
            <div class="izq">
                <h2>Sin acciones</h2>
                
            </div>
    </div>  
    
    <div class="right_content">            
        <?php include("mensajes.php"); ?>
        <h2>Cambiar clave</h2>
        <form action="" method="POST">
            <label>Clave antigua</label>
            <input type="text" name="clave_antigua" placeholder="clave antigua" required>
            <label>Clave nueva</label>
            <input type="text" name="clave_nueva1" placeholder="clave nueva" required>
            <label>Repetir clave nueva</label>
            <input type="text" name="clave_nueva2" placeholder="clave nueva" required>
            <input type="submit" value="cambiar" style="margin-left:18px;">
        </form>       
    </div>
  </div>

<?php include("partes/fotter.php"); ?>