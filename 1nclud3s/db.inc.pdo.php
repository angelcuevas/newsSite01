<?php

$config["sitio"]["host"] = "http://" .$_SERVER["SERVER_NAME"] . "/";

//
//	$config["db"]["usuario"] = "root";
//	$config["db"]["pass"] = "";
//	$config["db"]["host"] = "localhost";
//	$config["db"]["db_nombre"] = "infra";

 

try {
	$pdo = new PDO('mysql:host='.$config["db"]["host"].';port=3306;dbname='.$config["db"]["db_nombre"], $config["db"]["usuario"], $config["db"]["pass"]);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// $pdo->exec("set names latin1"); //it could break default charset
	$pdo->exec("set names utf8"); //it could break default charset
	echo "<script>console.log('conectado con exito, pa.');</script>";
} catch (PDOException $e) {
    echo $e->getMessage();
	exit("<h1>ERROR EN BASE DE DATOS</h1>");
}

class DB extends PDO{

	/*
	 * 
	 * @showErrors boolen set to true if you want that the PDO show errors
	 */
	private static $showErrors = true;

	/*
	 *
	 * @param string $dns the dns string of the PDO connexion. ex: "mysql:host=localhost;dbname=databasename"
	 * @param string $username
	 * @param string $password
	 * @return void
	 */
	public function __construct($dsn,$username = null,$password = null){
		try {
			parent::__construct($dsn,$username,$password);
			if (DB::$showErrors) $this->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION);
			parent::exec("set names utf8"); //it could break default charset
		} catch (Exception $e) {
			throw new Exception('Couldn\'t connect to the database. ' . $e->getMessage());

		}
	}

	public function query($query, array $campos = null){
		$execute = $this->prepare($query);
		if ($campos) {
			foreach ($campos as $key => $campo) {
				
				if(is_string($campo))
					$tipo = PDO::PARAM_STR;
				else
					$tipo = PDO::PARAM_INT;
				$execute->bindValue(":" . $key, $campo ,$tipo);
			}
		}
		try {
			$execute->execute();

			return $execute->fetchAll(PDO::FETCH_ASSOC);
			

		return false;

		} catch (Exception $e) {
			throw new Exception('Error while trying to execute the query. ' . $e->getMessage());
		}
	}
	
		public function one_query($query, array $campos = null){
		$execute = $this->prepare($query);
		if ($campos) {
			foreach ($campos as $key => $campo) {
				
				if(is_string($campo))
					$tipo = PDO::PARAM_STR;
				else
					$tipo = PDO::PARAM_INT;
				$execute->bindValue(":" . $key, $campo ,$tipo);
			}
		}
		try {
			$execute->execute();

			return $execute->fetch(PDO::FETCH_ASSOC);
			

		return false;

		} catch (Exception $e) {
			throw new Exception('Error while trying to execute the query. ' . $e->getMessage());
		}
	}

	public function count($tabla,$condicion){
		$query = $this->query("SELECT count(*) as cantidad FROM ".$tabla." WHERE ".$condicion);
		return $query["cantidad"];
	}

    public function exec($query,array $campos = null) {
        $execute = $this->prepare($query);
		try {
			return $execute->execute($campos);
		} catch (Exception $e) {
			throw new Exception('Error while trying to execute the query. ' . $e->getMessage());
		}
    }

	public function import($file){
		$fichero = file_get_contents($file);
		if($fichero) {
			$this->exec($fichero);
			//return true;
		}else{
			return false;
		}
	}

	public function lastId(){
		return parent::lastInsertId();
	}
	
}

$db = New DB("mysql:host={$config["db"]["host"]};dbname={$config["db"]["db_nombre"]}","{$config["db"]["usuario"]}","{$config["db"]["pass"]}");


/////////////////////// Crea un array  con las categorias y subcategorias para navbar ///////////////////					



$categorias = $db->query("SELECT nombre,id_categoria FROM noticias_categorias");

$subcategorias = $db->query("SELECT nombre,id_categoria,id_subcategoria FROM noticias_subcategorias");


$arrayCategorias = array();
$arraySubcategorias = array();

foreach($categorias as $key => $value ): 
	$arrayCategorias[$key]["nombre"]   = $categorias[$key]["nombre"];
	$arrayCategorias[$key]["id_categoria"]       = $categorias[$key]["id_categoria"];
	$arrayCategorias[$key]["tieneSubcategoria"] = 0;
	unset($arraySubcategorias);
	foreach($subcategorias as $key2 => $value):
		if( $subcategorias[$key2]["id_categoria"] == $categorias[$key]["id_categoria"]):
			$arrayCategorias[$key]["tieneSubcategoria"] = 1;
			$arraySubcategorias[$key2]["nombre"] = $subcategorias[$key2]["nombre"];
			$arraySubcategorias[$key2]["id_subcategoria"]     = $subcategorias[$key2]["id_subcategoria"];
		endif;
	endforeach;
	if( $arrayCategorias[$key]["tieneSubcategoria"] == 1):
		$arrayCategorias[$key]["Subcategoria"] = $arraySubcategorias;
	endif;
endforeach;
			
	

?>


