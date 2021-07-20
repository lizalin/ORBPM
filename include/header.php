<body>
	<!-- TopBar Starts Here -->
	<div class="headercontainer">
		<section class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-3 col-sm-3 col-12">
						<h1 class="headerarea"><a href="<?php echo SITE_URL; ?>"><img src="<?php echo SITE_URL; ?>images/logo.png" alt="Logo">RAJ BHAVAN<small>ODISHA</small></a></h1>
					</div>
					<div class="col-lg-8 col-md-9 col-sm-9 col-12">
						<div class="utilArea  h-100">

							<ul class="shortcot mr-2">
								<li><a href="<?php echo SITE_URL; ?>contactUs" title="Contact Us">Contact Us</a></li>
								<li><a href="<?php echo SITE_URL; ?>feedBack" title="Feedback" >Feedback</a></li>
							</ul>
							
							<a href="https://play.google.com/store/apps/details?id=com.csm.rajbhawan&hl=en" class="btn mobileapp" target="_blank" title="Download App"><i class="fa fa-mobile mr-2"> </i>Download App</a>

						</div>
					</div>
				</div>

			</div>
		</section>

		<!-- TopBar End Here -->
		<!--Start of Nav-->
		<section class="toplower">
			<div class="container">
			
				<nav class="navbar navbar-expand-lg">

					<a class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon toggleicon mt-2"><i class="fa fa-bars text-white"></i></span>
					</a>
					

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						
						<ul class="navbar-nav mr-auto text-white">
							<li class="nav-item">
								<a class="nav-link active" href="<?php echo SITE_URL; ?>"><i class="fa fa-home"></i> <span class="sr-only">(current)</span></a>
							</li>
							
							<?php 
							$objGlmenu   = new clsGlobalLink;
							$menuRes = $objGlmenu->viewMenulIstRec();
							
							?>
							
						</ul>

					</div>
				</nav>
			</div>

		</section>
	</div>
	<!--End of Nav-->