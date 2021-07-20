<?php 
/* ================================================
	File Name         	  : indexInner.php
	Description		  : Manage functions in Index	
	Date Created		  : 08-06-2021
	Designed By		  : Ashok Kumar Samal    
	Update History		  :
	<Updated by>		<Updated On>		<Remarks>

	==================================================*/
	$outMsg = '';
    $flag   =  0;
    //print_r($_REQUEST);exit;
	if (isset($_POST['btnFeedbackSubmit']) && !empty($_POST['btnFeedbackSubmit'])) 
	{
		include_once(APP_CLASS_PATH."clsFeedbackForm.php");
		$objFeedback 	= new clsFeedback();
		$fb_uname = htmlspecialchars($_POST['txtFeedbackUserName'],ENT_QUOTES);
		$fb_mobile = $_POST['txtFeedbackMob'];
		$fb_email = htmlspecialchars($_POST['txtFeedbackEmail'],ENT_QUOTES);
		$fb_msg = htmlspecialchars($_POST['txtFeedbackMessage'],ENT_QUOTES);

		$blankFbName        = $objFeedback->isBlank($fb_uname);
        $errFbName          = $objFeedback->isSpclChar($_POST['txtFeedbackUserName']);
        $blankFbMobile      = $objFeedback->isBlank($fb_mobile);
        $blankFbEmail       = $objFeedback->isBlank($fb_email);
        $blankFbMsg         = $objFeedback->isBlank($fb_msg);
        
        $action = 'A';
        if($blankFbName > 0 || $blankFbMobile >0 || $blankFbEmail >0 || $blankFbMsg >0)
        {               
                        $flag           = 1;
                        $outMsg         = "Mandatory fields should not be left blank!";
        }else if($errFbName>0)
        {
                        $flag           = 1;
                        $outMsg         = "Special Characters are not allowed!";  
        }
        if($errFlag==0)
        {
        	
            $result = $objFeedback->manageFeedback($action,0,$fb_uname,'',$fb_email, $fb_mobile,'',$fb_msg,'','','',0);
                if ($result){
                    if (sendMail == 'Y') {
                        $Subject = 'Greetings From Raj bhavan:Odisha || Feedback Received';
                        $strFrom = $fb_email;
                        $strTo = portalEmail;
                        $MailMessage .= '<table width="100%" border="1">';
                        $MailMessage .= '<tr>';
                        $MailMessage .= '<th>Name</th>';
                        $MailMessage .= '<th>Mobile No.</th>';
                        $MailMessage .= '<th>Email Id</th>';
                        $MailMessage .= '<th>Message</th>';
                        $MailMessage .= '</tr>';
                        $MailMessage .= '<tr>';
                        $MailMessage .= '<td>'.$fb_uname.'</td>';
                        $MailMessage .= '<td>'.$fb_mobile.'</td>';
                        $MailMessage .= '<td>'.$fb_email.'</td>';
                        $MailMessage .= '<td>'.$fb_msg.'</td>';
                        $MailMessage .= '</tr>';
                        $MailMessage .= '</table>';
                        $objFeedback->Sendmail($strFrom, $strTo, $Subject, $MailMessage,'');
                    }
                    $outMsg = 'Feedback has been saved successfully.';
                }
                else
                	$outMsg = 'Oops! Something went wrong!';
        }
	}
?>