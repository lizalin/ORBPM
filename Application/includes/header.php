<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="utf-8">
<title><?php echo TITLE;?></title>
<meta name="description" content="overview &amp; stats">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="icon" href="<?php echo APP_URL;?>img/Logo.ico" type="image/x-icon">
<!-- bootstrap & fontawesome -->
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
<!-- ace settings handler -->
<script src="<?php echo APP_URL;?>js/jquery-1.8.2.min.js"></script>
<script src="<?php echo APP_URL;?>js/ace-extra.min.js"></script>
<script src="<?php echo APP_URL;?>js/bootstrap.min.js"></script>
<!-- extra custom script -->
<script src="<?php echo APP_URL;?>js/custom.js"></script>
<script src="<?php echo APP_URL;?>js/loadComponent.js"></script>
<script src="<?php echo APP_URL;?>js/clock.js"></script>
<script src="<?php echo APP_URL;?>js/loadAjax.js"></script>
<script>
	$(document).ready(function () {
		dateTime('clock');
		$('form').find('input[type=text],textarea,select').not('.date-picker').filter(':visible:first').focus();
		$('form').find('input[type=text],textarea').attr('autocomplete','off'); 
                getLogo();
		$('.userSetting').click(function(){
			$('.user-menu').toggle();
                          /* For home page logo */
                     
		});    
	});
        function viewAlert(msg, ctrlId,redLoc)
	{	
		
            $('#btnAlertOk').off('click');
		if(typeof(ctrlId)=='undefined')
		{
			ctrlId	= '';
		}
		if(typeof(redLoc)=='undefined')
		{
			redLoc	= '';
		}
		$('#alertModal').modal({backdrop: 'static', keyboard: false});
		$('.alertMessage').html(msg);
		$('#btnAlertOk').on('click',function(){
			if(ctrlId !='')
			{
				$('#'+ctrlId).focus();
			}
			if(redLoc!='')
			{
				window.location.href =redLoc;
			}
		});
		
	}
	function confirmAlert(msg)
	{
		$('#confirmModal').modal({backdrop: 'static', keyboard: false});
		$('.confirmMessage').html(msg);
                //$('#btnConfirmOk').removeAttr('data-dismiss');
	}
        
</script>

<script>function toggleChevron(e) {
    $(e.target)
        .prev('.panel-heading')
        .find("i")
        .toggleClass('fa-angle-up fa-angle-down ');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);</script>
</head>
<body class="no-skin">
<form class="form-horizontal" role="form" name="frmTCP" id="frmTCP" method="post" enctype="multipart/form-data">
<!--[if lte IE 8]>
<script src="<?php echo APP_URL;?>js/html5shiv.js"></script>
<script src="<?php echo APP_URL;?>js/respond.min.js"></script>
<![endif]-->

<div id="navbar" class="navbar navbar-default navbar-fixed-top">
  <script type="text/javascript">
	try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>
  <div class="navbar-container" id="navbar-container">
    <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler"> <span class="sr-only">Toggle sidebar</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
    
    <div class="navbar-header pull-left" id="header"> <a href="<?php echo APP_URL;?>dashboard" class="navbar-brand" title="Smart City Bhubaneswar">  </a>
    <div class="pull-left text_logo" > 
           <h1 class="logo"> <span id="homePageLogo"></span>
        
         <br>
      <small>RAJ BHAVAN ODISHA</small>
      </h1>
    </div> </div>
    <div class="navbar-buttons navbar-header pull-right" role="navigation" style="margin-top:15px;">
        
      <ul class="nav ace-nav settingNav">          
        <li class="userSetting">
            <a data-toggle="dropdown" href="javascript: void(0);" class="dropdown-toggle"> <!--<img class="nav-user-photo" src="<?php echo APP_URL;?>img/noPhptoThumbnail.jpg" alt="Jason&#39;s Photo"> --><span class="user-info"> 
		Welcome <?php echo $_SESSION['adminConsole_UserName']; ?>
         </span> 
        <i class="ace-icon fa fa-caret-down"></i> </a>
        
          <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">           
            <li> <a href="<?php echo APP_URL;?>home"> <i class="ace-icon fa fa-power-off"></i> Logout </a> </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- /.navbar-container -->
</div>

<div class="main-container" id="main-container">
    <script type="text/javascript">
		try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
    <?php include('includes/left_panel.php'); ?>
  <div class="main-content">
  <?php include('includes/navigation.php'); ?>
<input type="hidden" name="hdnPrevSessionId" id="hdnPrevSessionId" value="<?php echo $_SESSION['token_id']; ?>" />