<?php
include("includes/db.inc.php");
conectar();
$diarios = una_consulta("SELECT id_galeria FROM galerias_especiales WHERE nombre = 'diarios'");
include("partes/top.php");
?>                                    
<div class="center_content">

    <div class="left_content">
        <div class="izq">
        	<h2>Sin acciones</h2>
		</div>
	</div>

	<div class="right_content">
		<h2>Titulo</h2>
	</div>


</div>                    
<?php include("partes/fotter.php"); ?>