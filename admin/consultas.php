<?php
include("includes/db.inc.php");
conectar();

if (isset($_GET["activar"])) {
	$id_consulta = mysql_real_escape_string($_GET["activar"]);
	mysql_query("UPDATE consultas SET activa = not activa WHERE id_consulta = " . $id_consulta);
    header("Location: consultas.php?exito=eliminar");
}

if(!isset($_GET["respondidos"])){
		$consultas = consulta("SELECT * FROM consultas WHERE activa = 1 AND local = 0 AND respondido = 0 ORDER BY fecha DESC");
}else{
		$consultas = consulta("SELECT * FROM consultas WHERE activa = 1 AND local = 0 AND respondido = 1 ORDER BY fecha DESC");
}

include("partes/top.php");
?>                                    
<div class="center_content">

    <div class="left_content">
        <div class="izq">
        	<h2>Sin acciones</h2>
        	<a class="borrar" href="consultas.php">Ver mensajes sin responder</a>
        	<br />
        	<br />
        	<a class="borrar" href="?respondidos">Ver mensajes ya respondidos</a>
		</div>
	</div>

	<div class="right_content">
    <?php include("mensajes.php"); ?>
		<h2>Consultas</h2>
		<table id="rounded-corner">
			<thead>
				<tr>
					<th class="rounded-company">Fecha</th>
					<th>Nombre</th>
					<th>email</th>
					<th>tel</th>
					<th class="rounded-q4"></th>
					<th class="rounded-q4"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($consultas as $key => $consulta): ?>
				<tr>
					<td width="100"><span style="color:grey;"><?php echo $consulta["fecha"]; ?></span></td>
					<td width="150"><span style=""><?php echo $consulta["nombre"]; ?></span></td>
					<td width="52"><a style="text-decoration: none;" href="mailto:<?php echo $consulta["email"]; ?>"><span style="color:green;"><?php echo $consulta["email"]; ?></span></a></td>
					<td width="52"><span style="color:green;"><?php echo $consulta["telefono"]; ?></span></td>
					<td width="52"><a onclick="resp(Resp<?php echo $consulta["id_consulta"] ?>);return false;" href="#Resp<?php echo $consulta["id_consulta"] ?>" class="editar"><span>Responder</span></a></td>
					<td width="52"><a href="?activar=<?php echo $consulta["id_consulta"]; ?>" class="borrar ask"><span>Borrar</span></a></td>
				</tr>
				<tr>
					<td colspan="6">
						<b>
							<?php echo htmlentities($consulta["consulta"]); ?>
						</b>
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<form id="Resp<?php echo $consulta["id_consulta"] ?>" style="display:none;" action="consultas_mail.php" method="POST">
							<input type="hidden" name="id" value="<?php echo $consulta["id_consulta"]; ?>">
							<input type="hidden" name="email" value="<?php echo $consulta["email"]; ?>">
							<input type="hidden" name="nombre" value="<?php echo $consulta["nombre"]; ?>">
							<input type="text" name="asunto" value="Re:<?php echo substr($consulta["consulta"],0,70) ; ?>...">
							<textarea name="cuerpo"></textarea>
							<input style="margin-right: 18px; margin-left: auto; display: block;" type="submit" class="borrar" value="Enviar">
						</form>
					</td>
				</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr><td colspan="5"></td></tr>
			</tfoot>
		</table>		
	</div>
</div>
<SCRIPT TYPE="text/javascript">
	function resp($id){
		if ($id.getAttribute("style") == "display:none;" ){			
			$id.setAttribute("style", "display:block;");
		}else{
			$id.setAttribute("style", "display:none;");
		}
	}
</SCRIPT>
<?php include("partes/fotter.php"); ?>