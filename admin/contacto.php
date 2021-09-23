<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();


$contacto = una_consulta("SELECT * from contacto WHERE 1");

if(!empty($_POST)){

    try {
        mysql_query("UPDATE contacto SET descripcion = '".$_POST["descripcion"]."', direccion = '".$_POST["direccion"]."', ciudad = '".$_POST["ciudad"]."', horario = '".$_POST["horario"]."',telefono = '".$_POST["telefono"]."' ,email = '".$_POST["email"]."' WHERE 1 ");
        header("Location: contacto.php?exito=actualizar");
    } catch (exception $th) {
        
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
        <h2>Cambiar info de contacto</h2>
        <form action="" method="POST">
            <label>Descripción</label>
            <textarea  name="descripcion" placeholder="Descripcion"  required> <?php echo $contacto["descripcion"];  ?> </textarea>
            <label>Dirección</label>
            <input type="text" name="direccion" placeholder="Direccion" value="<?php echo $contacto["direccion"];  ?>" required>
            <label>Ciudad</label>
            <input type="text" name="ciudad" placeholder="Ciudad" value="<?php echo $contacto["ciudad"];  ?>" required>
            <label>Horario</label>
            <input type="text" name="horario" placeholder="Horario" value="<?php echo $contacto["horario"];  ?>" required>
            <label>Telefono</label>
            <input type="text" name="telefono" placeholder="telefono" value="<?php echo $contacto["telefono"];  ?>" required>
            <label>Email</label>
            <input type="text" name="email" placeholder="Email" value="<?php echo $contacto["email"];  ?>" required>            
            <input type="submit" value="cambiar" style="margin-left:18px;">
        </form>       
    </div>
  </div>

<?php include("partes/fotter.php"); ?>