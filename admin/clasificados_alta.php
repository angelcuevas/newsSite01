<?php
include("includes/db.inc.php");
include("includes/image.inc.php");
include("includes/paginador.php");
conectar();

if(!empty($_POST)){
	$categoria = $_POST["categoria"];
	$fecha = $_POST["fecha"];
	$aviso = $_POST["aviso"];
	$telefono = $_POST["telefono"];
	$domicilio = $_POST["domicilio"];
	$email = $_POST["email"];

	$activo = (!empty($_POST["activo"])) ? TRUE : FALSE;
	$tipo = $_POST["tipo"];
	$destacado = (!empty($_POST["destacado"])) ? TRUE : FALSE;
	
	$foto = (!empty($_FILES["foto"]["name"])) ? TRUE : FALSE;	
	
		if($foto){
			$directio = $config["imagenes_clasificados"];
			$nombre_imagen_final =  date(time()) . ".jpg";
			$nombre_imagen = $directio . $nombre_imagen_final;
			if(thumbnail($_FILES["foto"]['tmp_name'], $nombre_imagen, 100,100,80)){
				mysql_query("INSERT INTO clasificados(id_categoria,fecha,aviso,telefono,domicilio,email,foto,activo,tipo,destacado) VALUES('$categoria','$fecha','$aviso','$telefono','$domicilio','$email','$nombre_imagen_final','$activo','$tipo','$destacado') ");
		    	echo mysql_error();
	    		header("Location: clasificados_alta.php?exito=agregar");
			}else{
	    		header("Location: clasificados_alta.php?exito=false");
			}
		}else{
				mysql_query("INSERT INTO clasificados(id_categoria,fecha,aviso,telefono,domicilio,email,foto,activo,tipo,destacado) VALUES('$categoria','$fecha','$aviso','$telefono','$domicilio','$email','$foto','$activo','$tipo','$destacado') ");
		    	echo mysql_error();
	    		header("Location: clasificados_alta.php?exito=agregar");
		}
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
   			<h2>Clasificados</h2>
   		<form action="" method="POST" enctype="multipart/form-data">
   			<select name="categoria">
   				<?php foreach ($categorias as $key => $value): ?>
   				<option value="<?php echo $categorias[$key]["id_categoria"] ?>"><?php echo $categorias[$key]["nombre"] ?></option>	
   				<?php endforeach ?>
   			</select>
   			<label>Fecha</label>
   			<input type="text" name="fecha" class="sfecha">
   			<label>Aviso</label>
   			<textarea name="aviso"></textarea>
   			<label>Telefono</label>
			<input type="text" name="telefono">
   			<label>Domicilio</label>
			<input type="text" name="domicilio">
   			<label>Email</label>
			<input type="text" name="email">
   			<label>Foto</label>
			<input name="foto" type="file" value="" id="foto">
   			<label>Tipo</label>
			<select name="tipo">
				<option value="c">compra</option>
				<option value="v">venta</option>
				<option value="p">pedidos</option>
				<option value="o">ofrecidos</option>
			</select>
   			<label>Activo</label>
			<select name="activo">
				<option value="1">Si</option>
				<option value="0">No</option>
			</select>
   			<label>Destacado</label>
			<select name="destacado">
				<option value="0">No</option>
				<option value="1">Si</option>
			</select>
			<input type="Submit" value="Agregar">
		</form>
	</div>      
    </div>
  </div>             


<?php include("partes/fotter.php"); ?>
