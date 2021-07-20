<?php
    /* ================================================
    File Name         	  : index.php
    Description		  : This is page is used for login propose.	
    Designed By		  : Bikash Kumar Panda
    Designed On	          : 13-05-2016
    Devloped By           : T Ketaki Debadarshini
    Devloped On           : 13-Aug-2015
    Update History		  :
                                            <Updated by>		<Updated On>		<Remarks>

    Style sheet           : bootstrap.min.css ,login.css                                      
    Javscript Functions   : jquery.min.js, bootstrap.min.js, custom.js,validator.js,md5.js,loadscript.js
    includes			  :

    ==================================================*/
	require("indexInner.php"); 
        $random = (rand()%1000);
	$_SESSION["salt"] = $random;
?>

<!DOCTYPE html>
<html>
 <head>
 <title><?php echo TITLE;?></title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!-- Bootstrap -->
 <link href="<?php echo APP_URL;?>css/bootstrap.min.css" rel="stylesheet">
 <link rel="icon" href="<?php echo APP_URL;?>img/Logo.ico" type="image/x-icon">
 <script src="<?php echo APP_URL;?>js/jquery-1.8.2.min.js"></script>
 <script src="<?php echo APP_URL;?>js/bootstrap.min.js"></script>
 <script src="<?php echo APP_URL;?>js/custom.js"></script>
 <script src="<?php echo APP_URL; ?>js/validatorchklist.js"></script>
 <script src="<?php echo APP_URL;?>js/loadComponent.js"></script>
 <script src="<?php echo APP_URL;?>js/loadAjax.js"></script>
 <script language="javascript" type="text/javascript" src="<?php echo APP_URL; ?>js/md5.js"></script>
 <link href="<?php echo APP_URL;?>css/custom.css" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="<?php echo APP_URL;?>css/login.css">
 <script type="text/javascript">
$(document).ready(function(){
    //getLogo();
           $('#reload').click(function(){
       
            $('#captchaImage').attr('src',$('#captchaImage').attr('src')+'#');
               });
	$('form').attr('autocomplete','off');
	$('#txtuserID').focus();
	$('#passwordTitle').hide();
	$('#txtemailID').hide();
	$('#btnSubmit').hide();
	$('#backtologin').hide();
	$('#fp-heading').hide();
	
$('#forgotPwdLink').click(function(){
		$('#txtPassword').hide();
		$('#btnLogin').hide();
		$('#txtemailID').show();
		$('#btnSubmit').show();
		$('#backtologin').show();	
		$('#forgotPwdLink').hide();	
		$('#fp-heading').show();	
		$('#log-heading').hide();				   
	});
	
	$('#backtologin').click(function(){
		$('#txtPassword').show();
		$('#btnLogin').show();
		$('#txtemailID').hide();
		$('#btnSubmit').hide();
		$('#backtologin').hide();	
		$('#forgotPwdLink').show();	
		$('#fp-heading').hide();
		$('#log-heading').show();									   
	});
        
	
	<?php if($out_msg!='' && isset($_REQUEST['btnLogin'])){?>
		alert('<?php echo $out_msg;?>');
	<?php }?>
	          <?php if($out_msg_fp!='' && isset($_REQUEST['btnSubmit'])){?>
		alert('<?php echo $out_msg_fp;?>');
	<?php }?>  
	});
       
       
    function Validate()
	{		
            if (!blankCheck('txtuserID', 'User Id can not be left blank'))
                    return false;	
            if (!checkSpecialChar('txtuserID'))
                    return false;	
            if (!blankCheck('txtPassword', 'Password can not be left blank')) 	
                    return false;	
            if (!checkSpecialChar('txtPassword'))	
                    return false;	
//           if (!blankCheck('txtCaptcha', 'Please enter captcha code'))
//                    return false;
            var str=hex_md5($("#txtPassword").val())+"<?php echo $random;?>";
            $("#txtPassword").val( hex_md5(str));
	}
             function ValidateForgotPass()
        {
            if (!blankCheck('txtuserID', 'User ID can not be left blank'))
                return false;

            if (!checkSpecialChar('txtuserID'))
                return false;
            if (!blankCheck('txtemailID', 'Email can not be left blank'))
                return false;
            if(!validEmail('txtemailID'))
                return false;

        }
	
 </script>
 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
 <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
 <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
 <!--[if IE]>
	  <script src="js/html5.js"></script>
	<![endif]-->

 </head>
 <body id="loginBodyBg">
 <div class="login_page"> 
 <h2> <img src="img/logo.png" alt="Odisha Motor Vehicle Department">
      <?php 
        if($_SESSION['languageType']=='O'){
        ?>
     <br>&#2835;&#2849;&#2879;&#2870;&#2878; &#2862;&#2891;&#2847;&#2864; &#2860;&#2878;&#2873;&#2856;  &#2860;&#2879;&#2861;&#2878;&#2839;<br><span>&#2835;&#2849;&#2879;&#2870;&#2878; &#2872;&#2864;&#2837;&#2878;&#2864;</span></h2>
        <?php }else{?>
      <br>Raj Bhavan <br><span>Odisha</span></h2>
        <?php }?>
   <div class="login-top">
  
    <div class="login">
       <h3 id="log-heading">Login</h3>
         <h3 id="fp-heading">Forgot Password</h3>
         <form role="form" class="login_form" method="post" autocomplete="off">
             <input type="text" name="txtuserID" value="" style="display: none" /> 
           <input type="text" class="text" placeholder="Enter User ID"   id="txtuserID" name="txtuserID" autocomplete="off" >
           <input type="text" name="not-an-email" value="" style="display: none" />
          <input type="text" class="email" placeholder="Enter Your Email"  id="txtemailID" name="txtemailID" >
          <input type="password" name="txtPassword" value="" style="display: none" /> 
          <input type="password"  placeholder="Enter Password"   id="txtPassword" name="txtPassword" autocomplete="off">
         <div class="form-group">
          <div class="col-md-6 col-xs-6 padding-left0" >
           <input type="text"  class="captcha-text"    placeholder="Enter Captcha Code"   id="txtCaptcha" name="txtCaptcha">
           </div>
           <div class="col-md-5 col-xs-5 padding-left0 padding-right0" >
           <img class="captcha-img" src="<?php echo APP_URL;?>includes/captcha.php" alt="captcha image" id="captchaImage" />
            </div>
           <div class="col-md-1 col-xs-1 padding-left0 padding-right0">
          <img class="img-button" src="<?php echo APP_URL;?>img/refresh.jpg" id="reload" alt="reload image"/>
          </div>
          <div class="clearfix"></div>
           </div>
          
          
          
                                      
         <div class="submit">
           <input type="submit"  id="btnLogin" name="btnLogin" value="Login" onClick="return Validate();" >
         </div>
          <div class="forgotpass">
         <input type="submit"  id="btnSubmit" name="btnSubmit" value="Submit" onClick="return ValidateForgotPass();" >
         </div>
        <div class="clearfix"></div>
        <div class="new">
           <p><a id="forgotPwdLink" class="pull-left" title="Forgot Password">Forgot Password ?</a><a title="Back to login" id="backtologin" class="pull-left">Back to login</a><a title="Back to Website" href="<?php echo ROOT_URL;?>" class="pull-right">Back to Website</a></p>
       <div class="clearfix"></div>
         </div>
      </form>
     </div>
  </div>
</div><br/>
<div class="footer">
  
   <p>&copy <?php echo date(Y);?>-  All Rights Reserved - Raj Bhavan, Odisha</p>
 </div>
<br/><br/>

</body>
</html>