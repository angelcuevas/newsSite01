<?php
include("includes/db.inc.php");

    ini_set('display_errors', 'On');
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    error_reporting(E_ALL);
    error_reporting(-1);


header('Content-Type: text/html; charset=utf-8');

if (!empty($_POST)){
	conectar();
	
	$id_noticia = $_POST["id_noticia"];
	$id_categoria =	$_POST["id_categoria"];
	$volanta = $_POST["volanta"] ;
	$titulo = $_POST["titulo"] ;
	$copete = $_POST["copete"] ;
	$cuerpo = $_POST["cuerpo"] ;
	$fecha = ($_POST["fecha"]);
	$fecha_vencimiento = $_POST["fecha_vencimiento"];
	$palabras_clave = $_POST["palabras_clave"];
	$activa =$_POST["activa"];
	$autor = $_POST["autor"];
	$activa = (isset($_POST["activa"])) ? TRUE : FALSE;
	$um = (isset($_POST["um"])) ? TRUE : FALSE;

	if($_SESSION["id_columnista"] == 0){
		$id_columnista = $_POST["id_columnista"];
	}else{
		$id_columnista = $_SESSION["id_columnista"];
		$categoria = 12; // CATEGORIA DE COLUMNA; $categoria = 12;
		$um = FALSE;
	}


	if ($id_noticia == 0){

		mysql_query("INSERT INTO noticias(id_categoria,volanta,titulo,copete,cuerpo,fecha,fecha_vencimiento,palabras_clave,activa,autor,id_columnista,um) VALUES('$id_categoria','$volanta','$titulo','$copete','$cuerpo','$fecha','$fecha_vencimiento','$palabras_clave','$activa','$autor','$id_columnista','$um')");
		$id_noticia = mysql_insert_id();
		header("Location: noticias.php?editar_id=".$id_noticia."&exito=agregar");
	}
	else{
		mysql_query("UPDATE noticias SET id_categoria='$id_categoria',volanta='$volanta',titulo='$titulo',copete='$copete',cuerpo='$cuerpo',fecha='$fecha',fecha_vencimiento='$fecha_vencimiento',palabras_clave='$palabras_clave',activa='$activa',autor='$autor',id_columnista='$id_columnista',um='$um' WHERE id_noticia = '$id_noticia' ");
		header("Location: noticias.php?editar_id=".$id_noticia."&exito=actualizar");
	}
	echo mysql_error();
	desconectar($link);

}
else{
	header("Location: noticias.php");
}

?>