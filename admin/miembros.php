<?php
include("includes/db.inc.php");
include("includes/paginador.php");
conectar();

$consulta_miembros = datos_paginador("SELECT id_miembro,nombre,apellido,email from miembros WHERE 1 order by id_miembro DESC",$tamaño_pagina,$link);
$miembros = consulta($consulta_miembros);

desconectar();
include("partes/top.php");
?>                                    
<div class="center_content">

    <div class="left_content">
        <div class="izq">
        	<h2>Sin acciones</h2>
		</div>
	</div>

	<div class="right_content">
		<h2>Miembros</h2>
		<table id="rounded-corner">
			<thead>
				<tr>
					<th>Apellido, nombre</th>
					<th>email</th>
					<th>Editar</th>
				</tr>
			</thead>
			<tfoot>
		    	<tr>
		        	<td colspan="2" class="rounded-foot-left">
		                <div class="pagination">
		                    <?php paginador("SELECT id_miembro from miembros WHERE 1 order by id_miembro",$tamaño_pagina,$link); ?>
		                </div> 
		            </td>
		        	<td class="rounded-foot-right">&nbsp;</td>
		        </tr>
			</tfoot>
			<tbody>
				<?php foreach ($miembros as $key => $value): ?>
					<tr>
						<td><?php echo ($miembros[$key]["apellido"] . ", " . $miembros[$key]["nombre"]); ?></td>
						<td><?php echo $miembros[$key]["email"] ?></td>
						<td width="52"><a class="editar" href="?editar_id=<?php echo $miembros[$key]["id_miembro"] ?>"><span>Editar</span></a></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>


</div>                    
<?php include("partes/fotter.php"); ?>