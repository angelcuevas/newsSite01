<?php 
include("includes/db.inc.php");
conectar();

if(!empty($_POST)){
	$usuario = $_POST["usuario"];
	$pass = $_POST["pass"];
	$user = una_consulta("SELECT id_administrador,nombre,id_columnista FROM administradores WHERE usuario = '$usuario' and clave = '$pass' and activo = 1");
	if(mysql_affected_rows() == 1){
		$_SESSION["id_administrador"] = $user["id_administrador"];
		$_SESSION["usuario"] = $user["nombre"];	
		$_SESSION["id_columnista"] = $user["id_columnista"];	
		$permisos = consulta("SELECT link FROM admin_secciones,admin_secciones_permisos WHERE admin_secciones_permisos.id_seccion = admin_secciones.id_seccion AND admin_secciones_permisos.id_administrador = '" . $user["id_administrador"] . "' AND permiso = 1" );	
		$_SESSION["permisos"] = "";
		foreach ($permisos as $key => $value) {
			$_SESSION["permisos"] .= "'". $permisos[$key]["link"] . "',";
		}
		header("location:index.php");
	}else{header("location:index.php?exito=false&err=Usuario+o+contraseña+incorrecta");}
}
?>