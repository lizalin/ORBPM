<?php 
	$objBanner  = new clsBanner;
	$bannerRes = $objBanner->manageBanner('V',0,'','','',2,1);
	
?>
 
 <!--Start of Banner-->
 <section class="banner">
 	<div id="banner" class="carousel slide" data-ride="carousel">

 		<!-- Indicators -->
		<?php if (($bannerRes->num_rows) > 0) { ?>
 		<ul class="carousel-indicators">
			<?php for ($i=0; $i <$bannerRes->num_rows ; $i++) {  $activeClass= ($i==0)?'active':'';?>
				<li data-target="#banner" data-slide-to="<?php echo $i;?>" class="<?php echo $activeClass;?>"></li>
			<?php }?>
 			<!-- 
 			<li data-target="#banner" data-slide-to="1"></li>
 			<li data-target="#banner" data-slide-to="2"></li>
 			<li data-target="#banner" data-slide-to="3"></li> -->
 		</ul>
		 <?php }?>

 		<!-- The slideshow -->
 		<div class="carousel-inner">
		<?php 
		if (($bannerRes->num_rows) > 0) { 
			$cnt=0;
			while ($row = $bannerRes->fetch_array()) {
				$activeClass= ($cnt==0)?'active':'';
		?> 
 			<div class="carousel-item <?php echo $activeClass;?>">
 				<div class="bannerimg">
 					<img src="<?php echo APP_URL ?>uploadDocuments/banner/<?php echo $row['VCH_IMAGE'];?>" alt="<?php echo htmlspecialchars_decode($row['VCH_CAPTIONS'],ENT_NOQUOTES);?>">
 				</div>
 			</div>
		<?php 
			$cnt++;
			}
		}?>
 			<!-- <div class="carousel-item ">
 				<div class="bannerimg">
 					<img src="<?php echo SITE_URL; ?>images/slide1.jpg" alt="Banner2">
 				</div>
 			</div>
 			<div class="carousel-item">
 				<div class="bannerimg">
 					<img src="<?php echo SITE_URL; ?>images/slide2.jpg" alt="Banner2">
 				</div>
 			</div>

 			<div class="carousel-item">
 				<div class="bannerimg">
 					<img src="<?php echo SITE_URL; ?>images/Banner1.jpg" alt="Banner1">
 				</div>
 			</div> -->
 			
 		</div>

 		<!-- Left and right controls -->
 		<a class="carousel-control-prev" href="#demo" data-slide="prev">
 			<span class="carousel-control-prev-icon"></span>
 		</a>
 		<a class="carousel-control-next" href="#demo" data-slide="next">
 			<span class="carousel-control-next-icon"></span>
 		</a>
 	</div>
 	<div>
 		<!-- <div class="container">
 <div class="row">
  <div class="col-sm-12">
   
  <div class="newsevents">
  <div class="row">
      <div class="col-xl-3 col-lg-3">
        <div class="eventbg"><h3>NEWS & UPDATES</h3></div>
       
      </div>
      <div class="col-xl-2 col-lg-2">
        <div class="newsdate">
           <p>27 | 10 | 2019</p>
        </div>
     
    </div>
      <div class="col-xl-7 col-lg-7">
      <ul class="newslist">
        <li>There are many variations of passages of Lorem Ipsum</li>
      </ul>

      </div>
    </div>
</div>
</div>

</div> 
</div> -->
 	</div>
 </section>
 <!--End of Banner-->