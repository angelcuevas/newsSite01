<?php
include("includes/db.inc.php");
include("includes/funciones.inc.php");
conectar();

include("partes/top.php");
?> 
<div class="center_content">
	<div class="right_content" style="width:94%;">
		<?php include("mensajes.php"); ?>
    <?php if(empty($_SESSION["id_administrador"])){ ?>
		<div>
			<div style="width:400px;margin:0px auto;">
			<h2>Login</h2>
			<form method="POST" action="entrar.php">
				<label>Usuario:</label>
				<input type="text" name="usuario" required>
				<label>Contraseña:</label>
				<input type="password" name="pass" required>
				<input type="submit" value="Entrar" style="margin-left:12px;">
			</form>
		</div>
	<?php }else{ ?>
			<div style="min-height:300px;">
			
			<div style="font-size:14px;color:#256c89;font-family:Arial;text-align:center;margin-bottom:10px;">
			
				<div style="float:left;margin:10px;border:1px solid #f2f2f2;padding:5px;border-radius:5px;">
					<a href="noticias.php"><img src="images/noticia_alta.png" style="padding:10px;"/></a>
					<div>Alta de Noticia</div>
				</div>
			
				<div style="float:left;margin:10px;border:1px solid #f2f2f2;padding:5px;border-radius:5px;">
					<a href="noticias_categorias.php"><img src="images/noticia_categoria.png" style="padding:10px;"/></a>
					<div>Categoría de Noticias</div>
				</div>
				
				
				<div style="float:left;margin:10px;border:1px solid #f2f2f2;padding:5px;border-radius:5px;">
					<a href="noticias.php"><img src="images/noticia_tapa.png" style="padding:10px;"/></a>
					<div>Noticia en tapa</div>
				</div>
				
				<div style="float:left;margin:10px;border:1px solid #f2f2f2;padding:5px;border-radius:5px;">
					<a href="comentarios.php" ><img src="images/comentarios.png" style="padding:10px;" height="60"/></a>
					<div>Comentarios</div>
				</div>
				

				<div style="float:left;margin:10px;border:1px solid #f2f2f2;padding:5px;border-radius:5px;">
					<a href="administradores.php" ><img src="images/usuarios.png" style="padding:10px;" height="60"/></a>
					<div>Administradores</div>
				</div>
				
				<div style="float:left;margin:10px;border:1px solid #f2f2f2;padding:5px;border-radius:5px;">
					<a href="clave.php" ><img src="images/pass.png" style="padding:10px;" height="60"/></a>
					<div>Cambiar Clave</div>
				</div>
			
				<div style="clear:both;">&nbsp;</div>
			</div>
			
			<br />		
		

		<?php
		$comentarios = consulta("SELECT COUNT(*) as cantidad FROM noticias_comentarios WHERE revisado=0");
		foreach ($comentarios as $key => $value):
			$cantidad=$comentarios[$key]["cantidad"];
		endforeach 
		?>
		
		<?php if ((int)$cantidad==0){?>
			<!-- <div class="valid_box">No hay comentarios por revisar.</div> -->
		<?php } else {?>
			<!-- <div class="error_box">Tiene <?php echo $cantidad; ?> comentarios por revisar. <a href="comentarios.php?filtro=activa"><i>Revisar Comentarios</i></a></div> -->
		<?php }?>
				
	

		
		</div>
	
	<?php } ?>
	</div>
</div>                    
<?php include("partes/fotter.php"); ?>