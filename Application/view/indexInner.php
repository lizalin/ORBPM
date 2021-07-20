<?php
/* ================================================
	File Name         	  : indexInner.php
	Description		  : This is for Login.	
	
 *      Devloped By               : T Ketaki Debadarshini
 *      Devloped On               : 31-Aug-2015
	Update History		  :
	<Updated by>				<Updated On>		<Remarks>
	include Class             :  clsUserProfile
	Functions                 : doLogin(),forgotPassword();
	==================================================*/ 
     
 
    include_once(APP_CLASS_PATH."clsUserProfile.php");

        /*if(isset($_SESSION['adminConsole_userID']) || $_SESSION['adminConsole_userID']=='' || $_SESSION['token_id']=='')
        {
            unset($_SESSION['adminConsole_userID']);
            unset($_SESSION['adminConsole_UserName']);
            unset($_SESSION['adminConsole_FullName']);
            unset($_SESSION['userPrivilege']);
            unset($_SESSION['portalType']);
            unset($_SESSION['adminPrivilege']);
            if(session_destroy())
            {
                   echo  "<script>location.href='".APP_URL."home'</script>" ;
            }
        }*/
      
	//unset($_SESSION['adminConsole_EMail']);

        //session_regenerate_id();

	//====== Button click ==========================
         $displayFlag = 0;
         $objUser        = new clsUserProfile;	
      
        if(isset($_POST['btnLogin']))
        {            
           $strCaptcha		= $_POST["txtCaptcha"];
		//print_r($_SESSION);exit('1');
           if($_SESSION['captcha']==$strCaptcha){
               //print_r($_SESSION);//exit;    
            $displayFlag = 1;
            $strUser	 = trim($_REQUEST['txtuserID']);
            $strPass	 = trim($_REQUEST['txtPassword']);
            $intsalt 	 = $_SESSION['salt'];

            $result	= $objUser->manageUser('VP','0','0','0','0','0','','0','','','','','','','','','','',$strUser,'','0','0','0','0','0','0','0');
                if($result->num_rows >0)
                {
                    $row		= $result->fetch_array();
                    $strId		= $row["INT_ID"];
                    $strUserId          = $row["VCH_USER_ID"];
                    $strPassword	= $row["VCH_PASSWORD"];	
                    $strFullname	= $row['VCH_FULL_NAME'];
                    $intDesignation	= $row['INT_DESIGNATION_ID'];
                    $strImage           = $row['VCH_IMAGE'];
                    $strCheckPass	= $row['INT_PASSWORD_CHECK'];
                    $privilege  	= $row['INT_PREVILIGE_STATUS'];
                    $adminPrivilege	= $row['INT_ADMIN_PRIVILEGE'];
                    $pubstatus          =     $row['INT_PUBLISH_STATUS'];		
                    $portalType 	= $row['INT_PORTAL_TYPE'];		
                    if($strUserId==$strUser && $pubstatus ==1)
                        $flag=1;		
                    else
                        $flag=0;			

                    if($flag==1 && md5($strPassword.$intsalt)==$strPass)		
                    {
                        // /session_regenerate_id();
                      
                        $_SESSION['token_id']     =session_id();
                        $_SESSION['adminConsole_userID']	= $strId;
                        //  $_SESSION['UserID']                     = $strUserId;
                        $_SESSION['adminConsole_UserName']  = $strFullname;
                        $_SESSION['userPrivilege']          = $privilege;
                        $_SESSION['portalType']             = $portalType;
                        $_SESSION['adminPrivilege']         = $adminPrivilege;
                        $_SESSION['loggedin'] = true;
                            echo  "<script>location.href='".APP_URL."dashboard/'</script>" ;
                    }
                    else
                    {
                        if($pubstatus ==1)
                            $out_msg = 'Invalid User ID and Password';
                        else
                            $out_msg = 'You are not Authorised User';
                    }	
                }
                    else{
                        $out_msg = 'You are not Authorised User';					
                    }
            }else{
               $out_msg		= "The Captcha code is invalid! Please try it again";                    
             } 
        }	
                /* Forgot Password */
        if(isset($_POST['btnSubmit']))
	{
            $displayFlag        = 2;
            $strUser		= trim($_POST['txtuserID']);
            $strEmail		= trim($_POST["txtemailID"]);				
            $strPass		=  $objUser->generate_password(8);
            $strMD5Pass		= md5($strPass);
            $MailMessage	= "";
            $headers		= "";
            $strEmailId         = portalEmail;
            //echo $strEmail ."==".portalEmail;exit;
            
            if($strEmailId!=$strEmail)
            {
                 $out_msg_fp='Incorrect Email Id';
                
            }
            else						
            {
                 $result	= $objUser->manageUser('CP','0','0','0','0','0','','0','','','','','','','','','','',$strUser,$strMD5Pass,'0','0','0','0','1','0','0');
               
                if($result)
                {
                    $Subject="Password Details";
                    $strFrom= portalEmail;
                    $MailMessage.="<div style='margin-bottom:10px'>Dear</div>";
                    $MailMessage.="<div style='margin-bottom:10px'>Below is the password Details</div>";
                    $MailMessage.="<table cellspacing='0' cellpadding='2'>";
                    $MailMessage.="<tr>";
                    $MailMessage.="<td>User ID&nbsp;</td>";
                    $MailMessage.="<td>".$strUser."</td>";
                    $MailMessage.="</tr>";
                    $MailMessage.="<tr>";
                    $MailMessage.="<td>Password&nbsp;</td>";
                    $MailMessage.="<td>".$strPass."</td>";
                    $MailMessage.="</tr>";
                    $MailMessage.="</table>";
                    $MailMessage.="<div style='margin-bottom:10px'>Don't Reply on this mail</div>";	
                    if(sendMail=='Y')
                      $objUser->Sendmail($strFrom,$strEmail,$Subject,$MailMessage);
                    
                     $out_msg_fp="Please check your mail to get Password";
                }
            }
        }
?>