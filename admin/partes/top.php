<!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="autor" content="ac"/>
	<meta name="robots" content="noindex, nofollow"> 
	<title><?php echo $config["titulo"]; ?></title>
	<link rel="shortcut icon" href="favicon.ico">

	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/noticias.css" />
	<link rel="stylesheet" type="text/css" href="css/paginacion.css" />
	<script type="text/javascript" src="js/funciones.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/nicEdit.js"></script>
	<script type="text/javascript" src="js/datetimepicker_css.js"></script>
	
	<?php if(!empty($_GET["editar_id"])): ?>
	<style type="text/css">
	.left_content{
		-webkit-animation: iluminar .25s ease 0s 4 alternate;
		-moz-animation: iluminar .25s ease 0s 4 alternate;
		-ms-animation: iluminar .25s ease 0s 4 alternate;
		-o-animation: iluminar .25s ease 0s 4 alternate;
		animation: iluminar .25s ease 0s 4 alternate;
	}
	@-webkit-keyframes iluminar {
		from { background-color: #fff;color:#D24726; }
		to { background-color: #D24726; color:#fff; }
	}
	@-moz-keyframes iluminar {
		from { background-color: #fff;color:#D24726; }
		to { background-color: #D24726; color:#fff; }
	}
	@-ms-keyframes iluminar {
		from { background-color: #fff;color:#D24726; }
		to { background-color: #D24726; color:#fff; }
	}
	@-o-keyframes iluminar {
		from { background-color: #fff;color:#D24726; }
		to { background-color: #D24726; color:#fff; }
	}
	@keyframes iluminar {
		from { background-color: #fff;color:#D24726; }
		to { background-color: #D24726; color:#fff; }
	}
	</style>
<?php endif ?>
	<style>
	ul li ul li ul{
		display:none;
		background-color:white;
	}
	
	ul li ul li:nth-child(3):hover ul{
		display:block;
	} 
	
	.menu ul ul ul a, .menu ul ul ul a:visited {
		background-color:initial;
	}
	
	</style>
	
	<?php $categorias = array() ;$categorias = consulta("SELECT nombre,id_categoria FROM noticias_categorias"); ?>

</head>
<body>
	<div id="main_container">

		<div class="header">
			<?php if(!empty($_SESSION)): ?>
			<div class="menu">
				<ul>
					<li><a <?php echo (basename($_SERVER['PHP_SELF']) == "index.php") ? ' class="current" ' : '' ; ?> href="index.php">Inicio</a></li>
					<li><a href="noticias.php">Noticias<!--[if IE 7]><!--></a><!--<![endif]-->
						<!--[if lte IE 6]><table><tr><td><![endif]-->
						<ul>
							<li><a href="noticias.php" title="">Noticias</a></li>
							<li><a href="noticias_categorias.php" title="">Categorias</a></li>
							<li>
								<a href="noticias_en_tapa.php" title="">Noticias en tapa</a>
								<ul>
									<li><a href="noticias_en_tapa.php?id_categoria=1" title="">Tapa: Tendencias</a></li>
									<li><a href="noticias_en_tapa.php?id_categoria=2" title="">Tapa: Principales</a></li>
									<li><a href="noticias_en_tapa.php?id_categoria=3" title="">Tapa: Semanales</a></li>

									<?php	foreach($categorias as $listado_categorias ): ?>
										<li><a href="noticias_en_tapa.php?id_categoria=<?php echo $listado_categorias["id_categoria"] ?>" title=""><?php echo $listado_categorias["nombre"] ?></a></li>
									<?php endforeach; ?>
									
								</ul>
							</li>
							
							
							
							<li><a href="comentarios.php" title="">Comentarios</a></li>
						</ul>
						<!--[if lte IE 6]></td></tr></table></a><![endif]-->
					</li>
					<li style="display:none" ><a href="consultas.php">Consultas<!--[if IE 7]><!--></a><!--<![endif]-->
					</li>
						<li style="display:none" ><a href="">Galerias<!--[if IE 7]><!--></a><!--<![endif]-->
							<!--[if lte IE 6]><table><tr><td><![endif]-->
							<ul>
								<li><a href="galerias_imagenes.php" title="">Imagenes</a></li>
								<li><a href="galerias_videos.php" title="">Videos</a></li>
							</ul>
							<!--[if lte IE 6]></td></tr></table></a><![endif]-->
						</li>
							<li><a href="">Administración<!--[if IE 7]><!--></a><!--<![endif]-->
								<!--[if lte IE 6]><table><tr><td><![endif]-->
								<ul>
									<li><a href="administradores.php" title="">Usuarios</a></li>
									<li><a href="clave.php" title="">Cambiar clave</a></li>
								</ul>
								<!--[if lte IE 6]></td></tr></table></a><![endif]-->
							</li>
						</ul>
					</div> 

					<div id="usuario">
						<span title="¿borrar datos locales?" style="cursor:pointer;" onclick="borrar_datos();"><?php echo $_SESSION["usuario"] ?></span>
						<a href="logout.php"> Salir </a>
					</div>
				<?php endif ?>
				<div class="clear"></div>
			</div>

			<div class="main_content">

