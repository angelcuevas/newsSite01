<?php 

$noticiasIzq = $noticiasDer = $noticiasCentro = array();

foreach( $noticiasTapa as $key => $value):
		

		if( $noticiasTapa[$key]["Columna"]== $idCategoria."1" ): 
											
			$noticiasIzq[]=$noticiasTapa[$key];
			
		endif;
		
			
		if( $noticiasTapa[$key]["Columna"]== $idCategoria."2" ): 
											
			$noticiasCentro[]=$noticiasTapa[$key];
			
		endif;
		
		if( $noticiasTapa[$key]["Columna"]== $idCategoria."3" ): 
											
			$noticiasDer[]=$noticiasTapa[$key];
			
		endif;		
						
endforeach;



?>
			<?php if( count( $noticiasIzq ) > 0 OR count($noticiasCentro) > 0 OR count($noticiasDer) > 0 ): ?>
				<div class="section-title-wrapper section-title-wrapper__sm">
					<div class="section-title-inner">
						<h1 class="section-title"><?php echo $nombreCategoria ; ?></h1>
					</div>
				</div>
			<?php endif; ?>

			<div class="masonry-feed row">
			
				<div class="masonry-item col-md-4 web-design development updates">			
				
					<?php 
					
					if( count( $noticiasIzq ) > 0 ):
											
						unset($noticias);
				
						$noticias = $noticiasIzq;
										
						include("1nclud3s/articleListadoBuscar.php"); 
					
					endif;
										
					?>	
							
				</div>
		
				<div class="masonry-item col-md-4 web-design development updates">				
				
					<?php 
					
					if( count($noticiasCentro) > 0 ):
					
						unset($noticias);
					
						$noticias = $noticiasCentro;
										
						include("1nclud3s/articleListadoBuscar.php"); 
												
					endif;
										
					?>	
			
				</div>
							
				<div class="masonry-item col-md-4 web-design development updates">				
							
					<?php 
					
					if( count($noticiasDer) > 0 ):
						
						unset($noticias);
										
						$noticias = $noticiasDer;
										
						include("1nclud3s/articleListadoBuscar.php"); 
					
					endif;
										
					?>	
									
				</div>
				
		</div>	
