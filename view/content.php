<?php
/* ============================================================
  ' File Name		  	        : content.php
  ' Description 	  	      : Website  Page content
  ' Created by            	: Rajesh Kumar Sahoo
  ' Created on            	: 04-June-2021
  ' Developed by          	:  
  ' Developed on          	: 
  ' Modification History  	: 
  ' Modified by             : 
  ' <Updated By> Indrani  <Date> 29-12-2020  <Updated Summary>'
  
  ' Style sheet           	: 
  ' Javscript  			   	    : 
  ' Javscript Functions   	:
  ' includes		  		      : header.php
 
  ============================================================= */
?>
<?php 
$objPage  = new clsPages();
$pageConent=$objPage->managePage('VP',0,'','','','',0,'','0','','','',0,0,0,0,'','',$slug,'','','','','','0','',0,'');
$row = $pageConent ->fetch_array();
// echo "<pre>"; print_r($row);echo "</pre>";
// echo $row['vchContentE'];
?>
<div class="page-navigator">
	<div class="container">

		<h2><?php echo htmlspecialchars_decode($row['vchTitle'],ENT_NOQUOTES);?></h2>

		<ul class="breadcrumb">
			<li><a href="<?php echo SITE_URL; ?>"><i class="fa fa-home"></i></a></li>
			<li>His Excellency The Governor</li>
			<li><?php echo htmlspecialchars_decode($row['vchTitle'],ENT_NOQUOTES);?></li>
		</ul>

	</div>
</div>
<!--=== Content Section ===-->
<div class="container">
	<div class="content-sec">
		<!--=== Content ===-->

		<div class="content-inner">
			<?php if($row['vchName'] !=""){?>
			<h5><?php echo htmlspecialchars_decode($row['vchName'],ENT_NOQUOTES);?></h5>
			<?php }?>
			<?php if($row['vchFeaturedImage'] !=""){?>
			<div class="image-div-right">
				<img src="<?php echo APP_URL ?>uploadDocuments/featuredImage/<?php echo $row['vchFeaturedImage']; ?>" alt="<?php echo htmlspecialchars_decode($row['vchTitle'],ENT_NOQUOTES);?>">
			</div>
			<?php }?>
			<?php echo htmlspecialchars_decode($row['vchContentE']);?>
		</div>
	</div>
</div>