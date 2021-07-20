<!DOCTYPE html>
<?php
/* ================================================
  ' File Name                   : sitemap.php
  ' Description 	  	: Arrear Page
  ' Created by            	: Bikash Kumar PAnda
  ' Created on            	: 12-May-2016
  ' Developed by          	:  
  ' Developed on          	: 
  ' Modification History  	: 
  ' Modified by             : 
  ' <Updated By>           	  <Date>                  <Updated Summary>'
  
  ' Style sheet           	: ct-style.css
  ' Javscript  			   	: 
  ' Javscript Functions   	:
  ' includes		  		: header.php
  ================================================== */
?>
<?php include 'includes/doctype.php';?>
<link rel="stylesheet" type="text/css" href="<?php echo SITE_PATH;?>css/custom.css">
<style> body{background: url(./images/arrear.jpg) 50% 50% no-repeat; background-attachment: fixed;background-position: center;background-size: cover;}
.bannerlogin{margin:2% auto;width: 800px;background: rgba(0,0,0,0.7);padding: 20px;border-radius: 8px;}
.img-sec{float: left;width: 65%;height: auto;margin-right: 20px;border-radius: 4px;    border: 1px solid #6d6d6d;}
.img-sec img{width: 100%;border-radius: 4px;}

.buttons-sec{padding: 110px 0px;float: left;width: 32%;}
.buttons-sec a {display:block;vertical-align: middle;-webkit-transform: translateZ(0); transform: translateZ(0); box-shadow: 0 0 1px rgba(0, 0, 0, 0); -webkit-backface-visibility: hidden;backface-visibility: hidden;-moz-osx-font-smoothing: grayscale;  position: relative;  -webkit-transition-property: color; transition-property: color;-webkit-transition-duration: 0.3s;transition-duration: 0.3s;    background: #de8801; padding: 4px 20px; margin-bottom: 10px;color: #fff;}
.buttons-sec a:before {content: "";position: absolute; z-index: -1;top: 0;left: 0; right: 0;bottom: 0;background: rgba(0,0,0,0.2);-webkit-transform: scaleX(0);transform: scaleX(0); -webkit-transform-origin: 0 50%; transform-origin: 0 50%; -webkit-transition-property: transform;transition-property: transform;-webkit-transition-duration: 0.3s;transition-duration: 0.3s;-webkit-transition-timing-function: ease-out;transition-timing-function: ease-out;}
.buttons-sec a:hover, .buttons-sec a:focus, .buttons-sec a:active {color: white;}
.buttons-sec a:hover:before, .buttons-sec a:focus:before, .buttons-sec a:active:before {-webkit-transform: scaleX(1);transform: scaleX(1);}
.buttons-sec a h4{font-size: 20px;line-height: 25px;letter-spacing: .5px;}
.buttons-sec a h4 .fa{font-size: 34px; margin-right: 10px;  display: inline-block;color: #ffe2b4;}</style>
</head>
    <body>
        <div class="bannerlogin"> 
          <div class="img-sec">
          	<img src="<?php echo SITE_PATH;?>images/AIMS-IMAGE.jpg" title="img">
          </div>
           <div class="buttons-sec">
           
           
<a href="http://sta.odisha.gov.in/ArrearManagement/ArrearRegdPublicValidate.aspx" target="_blank" class="hvr-sweep-to-right" > <h4 ><i class="fa fa-file-text-o" ></i>Online Form</h4></a>
<a href="<?php echo URL;?>uploadDocuments/Directory/Offline_Form_Public_View.pdf" target="_blank" ><h4 ><i class="fa fa-file-pdf-o "></i>Download Form</h4></a>
<a href="<?php echo URL;?>uploadDocuments/Directory/User_Manual_AIMS.pdf" target="_blank" ><h4 ><i class="fa fa-book "></i>User Manual</h4></a>

			  </div>
          <div class="clearfix"></div>
           
          </div>


    </body>
</html>
