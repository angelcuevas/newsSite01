<?php
include("includes/db.inc.php");

conectar();

if (!empty($_POST)){
$id_encuesta = $_POST["id_encuesta"];
$nombre = $_POST["nombre"];
$activa = (isset($_POST["activa"])) ? TRUE : FALSE;
$fecha = $_POST["fecha"];

	if ($id_encuesta == 0){
		mysql_query("INSERT INTO encuestas(nombre,activa,fecha)
					values('$nombre','$activa','$fecha')");
		$Id_Encuesta = mysql_insert_id();
		header("Location: encuestas.php?editar_id=".$id_encuesta."&exito=agregar");
	}
	else{
		mysql_query("UPDATE encuestas SET nombre='$nombre',activa='$activa',fecha='$fecha' WHERE id_encuesta = '$id_encuesta'");
		header("Location: encuestas.php?editar_id=".$id_encuesta."&exito=actualizar");
	}
	echo mysql_error();

}
else{
	header("Location: encuestas.php");
}

desconectar();
?>