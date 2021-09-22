<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();

if(empty($_POST)){
	$id = $_GET["id"];
	$clasificado = una_consulta("SELECT id_categoria,fecha,aviso,telefono,domicilio,email,foto,activo,tipo,destacado FROM clasificados WHERE id_clasificado = '$id'");
	$categoria = $clasificado["id_categoria"];
	$fecha = $clasificado["fecha"];
	$aviso = $clasificado["aviso"];
	$telefono = $clasificado["telefono"];
	$domicilio = $clasificado["domicilio"];
	$email = $clasificado["email"];
	$activo = (!empty($clasificado["activo"])) ? TRUE : FALSE;
	$tipo = $clasificado["tipo"];
	$destacado = (!empty($clasificado["destacado"])) ? TRUE : FALSE;}
else{
	$id = $_GET["id"];
	$categoria = $_POST["categoria"];
	$fecha = $_POST["fecha"];
	$aviso = $_POST["aviso"];
	$telefono = $_POST["telefono"];
	$domicilio = $_POST["domicilio"];
	$email = $_POST["email"];
	$activo = (!empty($_POST["activo"])) ? TRUE : FALSE;
	$tipo = $_POST["tipo"];
	$destacado = (!empty($_POST["destacado"])) ? TRUE : FALSE;
	mysql_query("UPDATE clasificados SET id_categoria = '$categoria',fecha = '$fecha',aviso = '$aviso',telefono = '$telefono',domicilio = '$domicilio',email = '$email',activo = '$activo',tipo = '$tipo',destacado = '$destacado' WHERE id_clasificado = '$id' ");
    echo mysql_error();
    header("Location: clasificados_moderacion.php?exito=actualizar");
}

$categorias = consulta("SELECT id_categoria,nombre FROM clasificados_categorias ORDER BY nombre ASC");

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
    <div class="largo">
   		<form action="" method="POST">
   			<label>Categorias</label>
   			<select name="categoria">
   				<?php foreach ($categorias as $key => $value): ?>
   				<option <?php if($categoria == $categorias[$key]["id_categoria"]) { ?> selected="selected" <?php } ?> value="<?php echo $categorias[$key]["id_categoria"] ?>"><?php echo $categorias[$key]["nombre"] ?></option>	
   				<?php endforeach ?>
   			</select>
   			<label>Fecha</label>
   			<input type="text" name="fecha" id="sfecha" value="<?php echo $fecha ?>">
   			<label>Aviso</label>
   			<textarea name="aviso"><?php echo $aviso ?></textarea>
   			<label>Telefono</label>
			<input type="text" name="telefono" value="<?php echo $telefono ?>">
   			<label>Domicilio</label>
			<input type="text" name="domicilio" value="<?php echo $domicilio ?>">
   			<label>Email</label>
			<input type="text" name="email" value="<?php echo $email ?>">
   			<label>Tipo</label>
			<select name="tipo">
				<option <?php if($tipo == "c" ) echo 'selected="selected"' ?> value="c">compra</option>
				<option <?php if($tipo == "v" ) echo 'selected="selected"' ?> value="v">venta</option>
				<option <?php if($tipo == "p" ) echo 'selected="selected"' ?> value="p">pedidos</option>
				<option <?php if($tipo == "o" ) echo 'selected="selected"' ?> value="o">ofrecidos</option>
			</select>
   			<label>Activo</label>
			<select name="activo">
				<option <?php if($activo == true ) echo 'selected="selected"' ?> value="1">Si</option>
				<option <?php if($activo == false ) echo 'selected="selected"' ?> value="0">No</option>
			</select>
   			<label>Destacado</label>
			<select name="destacado">
				<option <?php if($destacado == true ) echo 'selected="selected"' ?> value="0">No</option>
				<option <?php if($destacado == false ) echo 'selected="selected"' ?> value="1">Si</option>
			</select>
			<input type="Submit" value="Guardar">
		</form>
	</div>      
    </div>
  </div>             


<?php include("partes/fotter.php"); ?>
