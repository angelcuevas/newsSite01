<?php if(isset($_GET["exito"])): ?>
<div class="boxes">
	<?php if($_GET["exito"] == "actualizar" ): ?>
		<div class="valid_box">Actualizado correctamente.</div> 
	<?php endif ?>

	<?php if($_GET["exito"] == "agregar"): ?>
	<div class="valid_box">Agregado correctamente.</div>
	<?php endif ?>
	<?php if($_GET["exito"] == "eliminar"): ?>
		<div class="valid_box">Eliminado correctamente.</div>
	<?php endif ?>
	<?php if($_GET["exito"] == "false"): ?>
		<div class="error_box">Se ha producido un error.
			<?php if(!empty($_GET["err"])): ?>
			<?php echo $_GET["err"]; ?>.
			<?php endif ?>
		</div>
	<?php endif ?>
</div>
<?php endif ?>
