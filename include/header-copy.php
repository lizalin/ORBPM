<body>

	<?php
	$objGlmenu   = new clsGlobalLink;
	$resGlmenu   = $objGlmenu->viewMenulIstRec1();
	echo "<pre>";
	print_r($resGlmenu);
	echo "</pre>";
	exit;

	?>
	<!-- TopBar Starts Here -->
	<div class="headercontainer">
		<section class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-3 col-sm-3 col-12">
						<h1 class="headerarea"><a href="index"><img src="<?php echo SITE_URL; ?>images/logo.png" alt="Logo">RAJ BHAVAN<small>ODISHA</small></a></h1>
					</div>
					<div class="col-lg-8 col-md-9 col-sm-9 col-12">
						<div class="utilArea  h-100">

							<ul class="shortcot mr-2">
								<li><a href="<?php echo SITE_URL; ?>contactUs">Contact Us</a></li>
								<li><a href="<?php echo SITE_URL; ?>feedBack">Feedback</a></li>
								<!-- 
              <li><a href="javascript:void(0)">Sitemap</a></li> -->
							</ul>


							<!-- 
         <ul class="fontAdjust">
            
              <li><a href="javascript:decreaseFontSize();"  class="decrease-font" title="Increase Font Size">A -</a></li>
              <li><a href="javascript:reSetFontSize();" class="reset-font" title="Normal Font Size">A</a></li>
              <li><a href="javascript:increaseFontSize();" class="increase-font" title="Decrease Font Size">A +</a></li>
            </ul>    -->

							<a href="<?php echo SITE_URL; ?>raj-bhawan-services" target="_blank" class="btn btn-info login" title="Raj Bhavan Services">Raj Bhavan Services</a>
							<!-- <a href="../rboapp" class="btn login mobileapp" title="login"><i class="fa fa-mobile"> </i>Download App</a> -->
							<a href="https://play.google.com/store/apps/details?id=com.csm.rajbhawan&hl=en" class="btn mobileapp" target="_blank" title="Download App"><i class="fa fa-mobile mr-2"> </i>Download App</a>
							<!-- <a href="../rboapp/RajBhavanOdisha.apk" class="btn btn-info mobileapp" title="login"><i class="fa fa-mobile"> Download App</i></a> -->
							<!-- <a href="http://rbpm.rajbhavanodisha.gov.in/" target="_blank" class="btn btn-info login" title="login">Raj Bhavan Services</a> -->


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
								<a class="nav-link active" href="<?php echo SITE_URL; ?>index"><i class="fa fa-home"></i> <span class="sr-only">(current)</span></a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									His Excellency The Governor
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="<?php echo SITE_URL; ?>profile">Profile</a>
									<a class="dropdown-item" href="<?php echo SITE_URL; ?>governerRole">Role of Governor</a>
									<a class="dropdown-item" href="<?php echo SITE_URL; ?>formerGovernors">Incumbency Chart of Governors</a>
									<a class="dropdown-item" href="<?php echo SITE_URL; ?>organizationalChart">Officers of RAJ BHAVAN </a>
									<a class="dropdown-item" href="<?php echo SITE_URL; ?>formersecretaries">Former Secretaries</a>

								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									History
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<!--  <a class="dropdown-item" href="introduction">Introduction</a> -->
									<a class="dropdown-item" href="<?php echo SITE_URL; ?>rajbhavanCuttack">Raj Bhavan, Cuttack </a>
									<a class="dropdown-item" href="<?php echo SITE_URL; ?>rajbhavanPuri">Raj Bhavan, Puri</a>
									<a class="dropdown-item" href="<?php echo SITE_URL; ?>rajbhavanBbsr">Raj Bhavan, Bhubaneswar</a>
								</div>
							</li>

							<li class="dropdown-submenu">
								<a class="dropdown-toggle nav-link" tabindex="-1" href="#">
									Explore Raj Bhavan
								</a>
								<ul class="dropdown-menu menumanag ">
									<li class="dropdown-submenu">
										<a class="dropdown-item" href="javascript:void(0);">
											Inside Raj Bhavan, Bhubaneswar
										</a>
										<ul class="dropdown-menu menu-scroll">
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>complex">The Raj Bhavan Complex</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>mainbuilding">Main Building</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>abhishekhall">Abhishek Hall</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>banquethall">Banquet Hall</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>conferencehall">Mini Conference Hall</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>library">Library</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>residence">Seating Hall of Hon’ble Governor</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>guestRooms">Guest Rooms</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>administrativebuilding">Administrative Building</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>garden">Garden</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>fountain">Fountain</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>medicinalgardens">Medicinal Gardens</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>cactushouse">Cactus House</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>deerpark">Deer Park</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>postOffice">Post Office</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>printingPress">Printing Press</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>childrensPark">Children’s Park</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>badmintonCourt">Indoor Sports Complex and Badminton court</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>dispensary">Dispensary</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>stateBank">State Bank of India, Raj Bhavan Branch</a></li>
											<!--  <li><a class="dropdown-item" href="swearinginCeremony">Swearing-in Ceremony</a></li> -->
										</ul>
									</li>
									<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>homeParty">At Home Party</a></li>
									<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>roshni">ROSHNI - A Green Innovation for Sustainable Habitats</a></li>
								</ul>
							</li>

							<li class="dropdown-submenu">
								<a class="dropdown-toggle nav-link" tabindex="-1" href="#">
									Media
								</a>
								<ul class="dropdown-menu menumanag ">
									<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>download/RTIupdated.pdf" target="_blank">RTI</a></li>
									<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>mediagallery">Photo Archives </a></li>
									<li class="dropdown-submenu">
										<a class="dropdown-item" href="javascript:void(0);">
											Speeches
										</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>download/10ConvocationRavenshawUniversityCuttack.pdf" target="_blank">10th Convocation of Ravenshaw University, Cuttack</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>download/50ConferenceGovernorsRashtrapatiBhavanNewDelhi.pdf" target="_blank">50th Conference of Governors at Rashtrapati Bhavan, New Delhi</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>download/AcceptanceSpeechHanseoUniversityKorea.pdf" target="_blank">Acceptance Speech at Hanseo University, Korea</a></li>
											<li><a class="dropdown-item" href="<?php echo SITE_URL; ?>download/ConvocationCUTMGajapati.pdf" target="_blank">Convocation of (CUTM) at Gajapati</a></li>

										</ul>
									</li>

								</ul>
							</li>








							<!--     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Media
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo SITE_URL; ?>download/RTI.pdf" target="_blank">RTI</a>
          <a class="dropdown-item" href="javascript:void(0)">Speeches</a>
          <a class="dropdown-item" href="mediagallery">Photo Archives </a>
       <a class="dropdown-item" href="javascript:void(0)"> Important meetings</a> 
        </div>
      </li> -->

							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Events
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="culture-events">Cultural Events</a>
									<a class="dropdown-item" href="offical-events">Official Events</a>
								</div>
							</li>

							<!-- <li class="nav-item">
        <a class="nav-link" href="gallery" role="button">
       Events
        </a>       
      </li> -->
							<li class="nav-item">
								<a class="nav-link blinking" href="tender" role="button">Tender</a>
							</li>


						</ul>

					</div>
				</nav>
			</div>

		</section>
	</div>
	<!--End of Nav-->