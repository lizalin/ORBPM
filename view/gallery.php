<?php
$objPage  = new clsPages();
$pageConent=$objPage->managePage('VP',0,'','','','',0,'','0','','','',0,0,0,0,'','',$slug,'','','','','','0','',0,'');
$row = $pageConent ->fetch_array();
$pageID=$row['intPageId']; 

$objGallery      = new clsGallery;
if($pageID==26){
	$intCategory = 3; //Photo Archieves
}else if($pageID==33){
	$intCategory = 2; //Official Events
}else if($pageID==32){
	$intCategory = 1; //Cultural Events
}


$resultGallery                 = $objGallery->manageGallery('V', 0, 0, 0, $intCategory, 0, '', '', '', '', '', '', '', 2, 0, 0, '', 0);
//echo 'num_rows::'.$resultGallery->num_rows;

?>
<style type="text/css">
	#culturalevent {
		display: none;
	}

	#officialevents {
		display: none;
	}

	.title {
		width: 100% !important;
		margin-left: 16px !important;
		margin-top: -26px !important;
	}
</style>

<div class="page-navigator">
	<div class="container">

		<h2>Gallery</h2>

		<ul class="breadcrumb">
			<li><a href="../"><i class="fa fa-home"></i></a></li>
			<li>Gallery</li>
		</ul>

	</div>
</div>
<!--=== Content Section ===-->
<div class="container">
	<div class="content-sec">

		<div class="content-inner">


			<div class="row">
			<?php 
				if (($resultGallery->num_rows) > 0) { 
					while ($row = $resultGallery->fetch_array()) {
			?>
				<div class="col-md-3 col-lg-3 col-xl-3">
					<a class="spotlight" data-footer="A custom footer text" href="<?php echo APP_URL ?>uploadDocuments/gallery/<?php echo $row['VCH_LARGE_IMAGE']; ?>">

						<img src="<?php echo APP_URL ?>uploadDocuments/gallery/<?php echo $row['VCH_LARGE_IMAGE']; ?>" alt="<?php echo htmlspecialchars_decode($row['VCH_HEADLINE_E'],ENT_NOQUOTES);?>" class="photo">
						<p class="text"><?php echo htmlspecialchars_decode($row['VCH_DESCRIPTION_E'],ENT_NOQUOTES);?></p>
					</a>
				</div>
			<?php }
			}?>

			</div>





		</div>
	</div>
</div>
</div>
</div>
</div>

<!--=== Content Section ===-->
<?php include("../include/footer.php"); ?>

<script type="text/javascript">
	$(document).ready(function() {
		$(".culturalev").click(function() {
			$("#culturalevent").show();
			$("#officialevents").hide();
			$(".allimages/events/").hide();
		});
		$(".officialev").click(function() {
			$("#officialevents").show();
			$("#culturalevent").hide();
			$(".allimages/events/").hide();

		});
	});
</script>
</body>