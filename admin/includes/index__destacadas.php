<section id="Frist-Post" class="col-md-6">
			
		<?php foreach( $Destacadas as $key => $value ): ?>
						
			<?php if( $key == 0): ?>
			
				<?php echo $A = fotosNoticia($fotos,$Destacadas[$key]["id_noticia"]); ?>
						
				<article class="Main-content__articleContent" >
				
					<h2 class="Main-content__articleContent-title"><?php echo $Destacadas[$key]["titulo"]; ?></h2>
					
					<div class="row-fluid">
					
						<div class="col-md-6">
						
							<div class="Main-content__articleContent-volanta">	<?php echo $Destacadas[$key]["volanta"]; ?></div>
							
						</div>
						
						<div class=" col-md-6">
						
							<span class="Main-content__articleContent-socialContent">
							
								<a class="icon-facebook" href=""></a>
								
								<a class="icon-twitter" href=""></a>
								
							</span>
						</div>	
						
					</div>								
					
					<div class="clearfix"></div>
					
					<figure class="Main-content__articleContent-imgContent" >
					
						<img class="image" src="multimedia/imagenes/<?php echo $A."_l.jpg"; ?>">
						
						<p><span></span><?php echo $$Destacadas[$key]["copete"]; ?></p>
						
					</figure>
					
				</article>				
			
			<?php endif; ?>
						
		<?php endforeach; ?>	
					
</section>

<section id="SecondAndThird-Post" class="col-md-6" >	

	<div class="row-fluid">
	
		<?php foreach( $Destacadas as $key => $value ): ?>
		
			<?php if( $key >= 1 ): ?>	
					
				<div class="col-md-12">	
				
					<article class="Main-content__articleContentSmall">
					
							<h2 class="Main-content__articleContentSmall-title"><?php echo $Destacadas[$key]["titulo"]; ?></h2>
							
							<div class="row-fluid">
							
								<div class="col-md-9">
								
									<div class="Main-content__articleContentSmall-volanta"><?php echo $Destacadas[$key]["volanta"]; ?></div>
									
								</div>
								<div class=" col-md-3">
								
									<span class="List-content__articleContentSmall-socialContent">
									
										<a class="icon-facebook" href=""></a>
										
										<a class="icon-twitter" href=""></a>
										
									</span>
									
								</div>	
								
							</div>		
							
						<div class="col-md-6">
						
							<?php echo $Destacadas[$key]["copete"]; ?>
								
						</div>	
						
						<div class="col-md-6">
						
							<figure>
							
								<img class="image" src="multimedia/imagenes/<?php echo $Destacadas[$key]["imagen"]"_xs.jpg"; ?>">
								
							</figure>
							
						</div>	
						
						<div class="clearfix"></div>
						
					</article>
								
				</div>
				
			<?php endif; ?>
						
		<?php endforeach; ?>				
					
	</div>
				
</section>
<div class="clearfix marginBottom40"></div>