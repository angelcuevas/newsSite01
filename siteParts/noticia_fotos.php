
<!--Carousel Wrapper-->
<div id="video-carousel-example2" class="carousel slide carousel-fade" data-ride="carousel">
  <!--Indicators-->
  <ol class="carousel-indicators " >
    <?php 
      $ccf = 0; 
      foreach ($fotos as $ft) {
        ?>
          <li data-target="#video-carousel-example2" data-slide-to="<?php echo  $ccf; ?>" class="<?php if( $ccf == 0) echo "active"; ?> "></li>
        <?php
         $ccf++;
      }
    ?>
    
    <!-- <li data-target="#video-carousel-example2" data-slide-to="1"></li>
    <li data-target="#video-carousel-example2" data-slide-to="2"></li> -->
  </ol>
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
      <?php 
        $ccf = 0; 
        foreach ($fotos as $ft) {
          ?>
            <!-- First slide -->
            <div class="carousel-item <?php if( $ccf == 0) echo "active"; ?>">
              <!--Mask color-->
              <div class="view" style="background: black; text-align: center;">
                <!--Video source-->
                <img src="<?php echo $config["url"]["urlImagenes"]."".$ft["url"];?>" alt="" > 
                <div class="mask rgba-indigo-light"></div>
              </div>

              <!--Caption-->
              <div class="carousel-caption">
                <div class="animated fadeInDown">
                  <h5 class="h3-responsive badge badge-secondary"><?php echo $ft["descripcion"]; ?></h5>
                </div>
              </div>
              <!--Caption-->
            </div>
            <!-- /.First slide -->
          <?php
          $ccf++;
        }
      ?>

   
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#video-carousel-example2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#video-carousel-example2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
<!--Carousel Wrapper-->