<?php include(SITE_PATH . "include/banner.php"); ?>
<?php include(SITE_PATH . "include/header.php"); ?>
<?php 
$objPages       = new clsPages;	
$result          = $objPages->readPage(7);
$resultPageContent          = $objPages->viewPageContent(7,1);

$resultProfileSlug          = $objPages->readPage(1);
?>
<!--Start of Governers-->
<section class="governersexcell governer">
	<div class="container governer">
		<div class="row">
			<div class="col-xl-6 col-lg-8">
			<?php echo htmlspecialchars_decode($resultPageContent['strContentE'],ENT_NOQUOTES);?>
				<!-- <a href="profile.php" class="btnsrtyle3">Continue Reading</a> -->
				<a href="<?php echo SITE_URL.'content/'.htmlspecialchars_decode($resultProfileSlug['strPageAlias'],ENT_NOQUOTES);?>" class="btnsrtyle3">Continue Reading </a>
			</div>
			<div class="govsec">
				<div class="col-xl-4 col-lg-4">
					<div class="governarimg">
						<img src="<?php echo APP_URL. 'uploadDocuments/featuredImage/' . $result['strFileName']; ?>" alt="Governor Image">
					</div>
					<div class="title">
						<h3><?php echo htmlspecialchars_decode($result['strSnippet'],ENT_NOQUOTES);?></h3>
						<small>Honourable Governor, Odisha </small>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--End of Governers-->


<!--Start of social wall-->
<section class="socialwall">
	<div class="container">
		<h1 class="hdStyle4">Social Wall</h1>

		<div class="row">
			<div class="col-xl-12 col-sm-12">
				<div class="socialwall-bg">


					<iframe class="wall-io" allowfullscreen id="wallsio-iframe" src="https://walls.io/y4u2y?nobackground=1&amp;show_header=0" style="border:0;height:481px;width:100%" title="My social wall"></iframe>

				</div>
			</div>

		</div>
		<!-- <img src="<?php echo SITE_URL; ?>images/socialcontact.jpg" alt="socialcontact"> -->
	</div>
</section>
<!--End of social wall-->


<!--Start of Gallery-->
<section class="gallery">
	<div class="container">
		<div class="introductioncontent">
			<h1 class="hdStyle4">GALLERY</h1>
			<!-- <div class="gallerybutn">
				<a href="gallery.php" class="btnStyle4">View Gallery Details</a>
				<br>
			</div> -->
			<?php 
				$objGallery      = new clsGallery;
				$intCategory=4; //home gallery
				$resultGallery                 = $objGallery->manageGallery('V',0,0,0,$intCategory,0,'','','','','','','',2,0,0,'',0);
				//echo 'num_rows::'.$resultGallery->num_rows;
				
			?>

			<div class="galleryimg">
				<?php if (($resultGallery->num_rows) > 0) { ?>
				<div id="demo" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ul class="carousel-indicators">
						<?php
						$cnt=0;
						$i=0;
						//while ($row = $resultGallery->fetch_array()) {
						for ($i=0; $i <$resultGallery->num_rows ; $i++) {
							if($i %6==0){
								$activeClass= ($cnt==0)?'active':'';
								echo '<li data-target="#demo" data-slide-to="'.$cnt.'" class="'.$activeClass.'"></li>';
								$cnt++;
							}
							
						}
						?>
						
					</ul>
					
					<!-- The slideshow -->
					<div class="carousel-inner">
						<?php
						$cnt=0;
						$i=0;
						$loopcnt=0;
						while ($row = $resultGallery->fetch_array()) {
							$loopcnt++;
							if($i %6==0){
								$activeClass= ($cnt==0)?'active':'';
								echo '<div class="carousel-item '.$activeClass.'"><div class="spotlight-group"><div class="row">';
								$cnt++;
							} ?>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<a class="spotlight" href="<?php echo APP_URL ?>uploadDocuments/gallery/<?php echo $row['VCH_LARGE_IMAGE']; ?>">
									<img src="<?php echo APP_URL ?>uploadDocuments/gallery/<?php echo $row['VCH_LARGE_IMAGE']; ?>" alt="<?php echo htmlspecialchars_decode($row['VCH_HEADLINE_E'],ENT_NOQUOTES);?>" class="photo">
									<p class="text"><?php echo htmlspecialchars_decode($row['VCH_DESCRIPTION_E'],ENT_NOQUOTES);?></p>
								</a>
							</div>
							<?php if($loopcnt %6==0){
								echo '</div></div></div>';
								
							}
							
							?>
							
							<?php
							$i++;
						}
						?>
						
					</div>
					<?php if($resultGallery->num_rows>6){ ?>
					<!-- Left and right controls -->
					<a class="carousel-control-prev" href="#demo" data-slide="prev">
						<span class="carousel-control-prev-icon"></span>
					</a>
					<a class="carousel-control-next" href="#demo" data-slide="next">
						<span class="carousel-control-next-icon"></span>
					</a>
					<?php }?>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
</section>
<!--End of Gallery-->
<?php 
$objLocation=new clsLocation;
$locationRes=$objLocation->manageLocation('VF',0,'','','','','','',1);
?>

<!--Start of Contactus-->
<section class="contactus">
	<div class="container">
		<div class="row">
		<?php if (($locationRes->num_rows) > 0) { ?>
			<div class="col-lg-6 mx-auto">
				<h1 class="hdStyle1">CONTACT US</h1>
				<?php 
				$i=0;
				while ($row = $locationRes->fetch_array()) {
					$i++;
				?>
				<div class="contactustext">
					<strong><?php  echo htmlspecialchars_decode($row['VCH_LOCATION'],ENT_NOQUOTES);?></strong>
					<p><?php  echo htmlspecialchars_decode($row['VCH_DESCRIPTION'],ENT_NOQUOTES);?> </p>
					<?php if($row['VCH_OFFICE_NO1'] !="" || $row['VCH_OFFICE_NO2'] !="" || $row['VCH_OFFICE_EMAIL']!=""){?>
					<ul class="contacticon">
						<li><a><i class="fa fa-phone-square"></i><?php  echo htmlspecialchars_decode($row['VCH_OFFICE_NO1'],ENT_NOQUOTES);?></a></li>
						<li><a><i class="fa fa-fax"></i><a href="javascript:void(0)"><?php  echo htmlspecialchars_decode($row['VCH_OFFICE_NO2'],ENT_NOQUOTES);?></a></li>
						<li><a><i class="fa fa-envelope"></i><a href="javascript:void(0)"><?php  echo htmlspecialchars_decode($row['VCH_OFFICE_EMAIL'],ENT_NOQUOTES);?></a></li>
					</ul>
					<?php }?>
					<?php if($i == $locationRes->num_rows){?>
					<ul class="puricontact">
						<li><a href="https://www.facebook.com/GovernorOdisha/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/GovernorOdisha" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
					</ul>
					<?php }?>
				</div>
				<?php }?>
				<!-- <div class="contactustext mt-4">
					<strong>Raj Bhavan, Puri</strong>
					<p>Puri, 751005</p>
					<ul class="puricontact">
						<li><a href="https://www.facebook.com/GovernorOdisha/" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/GovernorOdisha" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
					</ul>
				</div> -->
			</div>
			<?php }?>
			<div class="col-lg-6 mx-auto">
				<h1 class="hdStyle2">FEEDBACK</h1>
				<div class="feedback">
					<form name="frmFeedback" method="post" id="frmFeedback">

						<div class="form-group">
							<label for="txtFeedbackUserName">Name</label>
							<input type="text" maxlength="100" class="form-control" id="txtFeedbackUserName" name ="txtFeedbackUserName" placeholder="">
						</div>

						<div class="form-group">
							<label for="txtFeedbackMob">Mobile No.</label>
							<input type="text" class="form-control" id="txtFeedbackMob" maxlength="10" name="txtFeedbackMob" placeholder="" onkeypress="return isNumberKey(event);">
						</div>

						<div class="form-group">
							<label for="txtFeedbackEmail">Email Id</label>
							<input type="text" maxlength="200" class="form-control" id="txtFeedbackEmail" name="txtFeedbackEmail" placeholder="">
						</div>

						<div class="form-group">
							<label for="txtFeedbackMessage">Message</label>
							<textarea type="text" class="form-control" id="txtFeedbackMessage" name="txtFeedbackMessage" placeholder="" rows="4" cols="50" maxlength="500"></textarea>
						</div>
						<button type="submit" name="btnFeedbackSubmit" id="btnFeedbackSubmit" class="btnsrtyle2" onclick="return validateFeedback();" value="submitFeedback">Submit</button>
					</form>
					
				</div>
			</div>
		
		</div>
	</div>
</section>
<!--End of Contactus-->
<script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		<?php if(!empty($outMsg)){?>
			viewAlert('<?php echo $outMsg;?>');
		<?php }?>
	});
	function validateFeedback()
	{
		if (!blankCheck('txtFeedbackUserName', 'Name can not be left blank'))
            return false;
        if (!checkSpecialChar('txtFeedbackUserName'))
            return false;
        if (!maxLength('txtFeedbackUserName',100, 'Name'))
            return false;

        if (!blankCheck('txtFeedbackMob', 'Mobile No. can not be left blank'))
            return false;
        if (!validMobileNo('txtFeedbackMob','Please enter a valid mobile no.'))
            return false;
      

        if (!blankCheck('txtFeedbackEmail', 'Email Id can not be left blank'))
            return false;
        if (!validEmail('txtFeedbackEmail'))
            return false;
        if (!maxLength('txtFeedbackEmail',200, 'Email Id'))
            return false;

        if (!blankCheck('txtFeedbackMessage', 'Message can not be left blank'))
            return false;
        if (!checkSpecialChar('txtFeedbackMessage'))
            return false;
        if (!maxLength('txtFeedbackMessage',500, 'Message'))
            return false;
        $('#frmFeedback').submit();
	}
</script>
</body>

</html>