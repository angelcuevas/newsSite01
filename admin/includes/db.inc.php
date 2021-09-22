<?php
ob_start();
$StartTime=microtime(1);
ini_set('display_errors', '0');

include_once("escape.inc.php");
include_once("config.inc.php");

//$config["db_host"] = "localhost";
//$config["db_user"] = "root";
//$config["db_password"] = "";
//$config["db_select"] = "sidiunlar";

$link;


function conectar() 
	{
		global $config,$link;
		$link = mysql_connect($config["db_host"], $config["db_user"] , $config["db_password"]);
        mysql_set_charset('utf8');
		mysql_select_db($config["db_select"]);
		

	}

function consulta($sql) 
	{
		$query = mysql_query($sql);
		$resultados = array();
		while($q = mysql_fetch_assoc($query)) 
			{
				$resultados[] = $q;
			}
		mysql_free_result($query);
		if(mysql_error()){
			echo '<div class="error_box">' . mysql_error() . "</div>";
		}
		return $resultados;
	}

function una_consulta($sql) 
	{
		$query = mysql_query($sql);
		$resultados = array();
		$q = mysql_fetch_assoc($query);
				$resultados = $q;
		mysql_free_result($query);
		if(mysql_error()){
			echo '<div class="error_box">' . mysql_error() . "</div>";
		}
		return $resultados;
	}


function desconectar($link) 
	{
		try {
			mysql_close($link);
		} catch (Exception $e) {
			
		}

	}

include("login.php");

	?>