<?php
session_start();
include_once("config.inc.php");

$defecto = ",noticias_editar_imagenes.php,noticias_editar_audio.php,noticias_editar_video.php,a_agregar_galerias_fotos.php,a_agregar_encuesta.php,a_agregar_noticia.php,a_agregar_noticia_audios.php,a_agregar_noticia_fotos.php,a_agregar_noticia_videos.php,a_agregar_galerias_videos.php,a_agregar_noticia_adjuntos.php,consultas_mail.php";


//header("Location: index.php?exito=false&err=No+tiene+permisos+para+entrar+en+la+seccion");

// if($_SERVER['PHP_SELF'] != $config["directorio_abm"]."index.php" ){
// 	if(!isset($_SESSION["id_administrador"])){
// 	    //header("Location: index.php");
	    
// 	}else{	
// 		if( strpos( $_SESSION["permisos"], basename($_SERVER['PHP_SELF']) ) != false or strpos( $defecto, basename($_SERVER['PHP_SELF']) ) != false ){

// 		} 
// 		else{			
// 			header("Location: index.php?exito=false&err=No+tiene+permisos+para+entrar+en+la+seccion");
// 		}
// 	}
// }

?>