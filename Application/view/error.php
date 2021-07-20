<?php
	/* ================================================
	File Name         	  : addDownload.php
	Description		  : This is used for add downloadable forms.
	Designed By		  : Sunil Kumar Parida
        Designed On		  : 23-Dec-2014
        Devloped By		  : T Ketaki Debadarshini
        Devloped On		  : 2-Sep-2015
	Update History		  :	<Updated by>		<Updated On>		<Remarks>
						
	Style sheet           : bootstrap.min.css, font-awesome.min.css, ace.min.css, custom.css                                          
	Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js,  loadcomponent.js
	includes			  :	header.php, navigation.php, util.php, footer.php,addDownloadInner.php

	==================================================*/
  
	
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo TITLE;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo APP_URL;?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo APP_URL;?>css/font-awesome.min.css">
<!-- text fonts -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300">
<!-- ace styles -->
<link rel="stylesheet" href="<?php echo APP_URL;?>css/ace.min.css">
<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo APP_URL;?>css/ace-part2.min.css" />
		<![endif]-->
<link rel="stylesheet" href="<?php echo APP_URL;?>css/ace-skins.min.css">
<link rel="stylesheet" href="<?php echo APP_URL;?>css/ace-rtl.min.css">
<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php echo APP_URL;?>css/ace-ie.min.css" />
		<![endif]-->
<!-- custom styles -->
<link href="<?php echo APP_URL;?>css/custom.css" rel="stylesheet">
<script language="javascript">
	$(document).ready(function () {
		loadNavigation('Error');
		indicate = 'yes';

	});
        
</script>
   
    <!-- /.page-content -->

 </head>
<body id="loginBodyBg">
<div class="container">
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1">
      <div class="loginBox">
        <div class="panel panel-login" style="margin-top:50px;">
          <div class="panel-heading text-center">
          <img src="<?php echo APP_URL;?>img/logo.png" alt="logo" >
            <h4 id="loginTitle">
                 Odisha Motor vehicle Department 
			</h4>
           <span id="CompanyName">Goverment Of Odisha</span>
          </div>
         <div class="center">
        <h1 class="lighter smaller"> <span class="bigger-125"> <i class="ace-icon fa fa-sitemap"></i> 404 </span> Page Not Found </h1>
        
        <h3 class="lighter smaller">Oops! There was a problem!</h3>
        <div>
          <p>Sorry, but we can't find what you were looking for right now.</p>
          <p>The content may have been removed, or is temporarily unavailable.</p>
          <div class="space"></div>
        </div>
        
        <div class="space"></div>
        <div style="padding-bottom: 10px;"> <a href="javascript:void(0);" onClick="window.location.href='<?php echo URL;?>home'" class="btn btn-info"> <i class="ace-icon fa fa-home"></i> Home </a> </div>
      </div>
        </div>
        <div class="clearfix"></div>
        
      </div>
    </div>
  </div>
</div>
</body>
</html>
