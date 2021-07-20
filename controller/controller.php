<?php 
include_once('config/config.php');
include_once("Application/model/customModel.php");
include_once("Application/controller/commonClass.php");

class Controller {

    public function __construct() {
		
        $this->invoke();
    }

// === Function for call pages and created by T Ketaki Debadarshini on 15-Sept-2015 ===//
    public function invoke() {

        $page 	= (isset($_REQUEST['PG']) && $_REQUEST['PG'] != '') ? $_REQUEST['PG'] : 'home';
        $slug=$id 	= (isset($_REQUEST['ID']) && $_REQUEST['ID'] !="") ? $_REQUEST['ID'] : '0';
        $webGl 	= (isset($_REQUEST['GL']) && $_REQUEST['GL'] > 0) ? $_REQUEST['GL'] : '0';
        $webPl 	= (isset($_REQUEST['PL']) && $_REQUEST['PL'] > 0) ? $_REQUEST['PL'] : '0';
        $webNm 	= (isset($_REQUEST['NM']) && $_REQUEST['NM'] != '') ? $_REQUEST['NM'] : '';
       
	    if ($page == 'home' || $page =='index') 
        {
            include_once('include/doctype.php');
            include_once('view/indexInner.php');
            include 'view/index.php';
            include_once('include/footer.php');
        }
        else  if ($page == 'homepage') 
        {       
            include_once('include/doctype.php');
            include("include/header.php");
 
            include 'view/homepage.php';
            // include_once('include/footer.php');
        }
        else if (file_exists("view/" . $page . ".php")) 
        {
            include_once('include/doctype.php');
            include_once('include/header.php');
            if (file_exists("view/" . $page . "Inner.php")) 
            {
                include_once 'view/' . $page . 'Inner.php';
            }
            include_once 'view/' . $page . '.php';

            // Add chek for session in the dealer Logins
            $pages_ary=array('omvrule','omvrule2','omvrule3','omvrule4','omvrule5','mvach1','mvach3','mvach5','mvach8','mvach10','mvach12','mvach14','contactmaps','arrearInfo','paymentReceipt');
            if(!in_array($page,$pages_ary))
            {
              include_once('include/footer.php');
            }            
        }
        else if ($page == 'proxy')
            include ('proxy.php');
        else {
            include_once('include/doctype.php');
            include 'view/error.php';
            include_once('include/footer.php');
        }
    }
}

//class to manage Page :: By:: T Ketaki Debadarshini :: on::16-Sept-2015	
class clsMangePortalPage extends Model {

   /*------------------------------------------------
               Function to display all page contents
               By : T Ketaki Debadarshini
               On : 16-Sept-2015	
              ------------------------------------------------*/
            public function viewPageContentDetails($action,$menuId,$hdnPgNo)
            {            
                $sql	= "CALL USP_PAGE_CONTENT('$action','$hdnPgNo','$menuId','0');";
              // echo $sql;exit;
                $result	= Model::executeQry($sql);           
                return $result;
            }
            /*------------------------------------------------
              Function to display all page contents as per the page number
              By : T Ketaki Debadarshini
               On : 16-Sept-2015	
             ------------------------------------------------*/
            public function viewPageContentPaging($action,$menuId)
            {            
                $sql	= "CALL USP_PAGE_CONTENT('$action','','$menuId','0');";
               //echo $sql;exit;
                $result	= Model::executeQry($sql);           
                return $result;
            }
            
            /*------------------------------------------------
              Function to display all page meta details and title
              By : T Ketaki Debadarshini
              On : 16-Sept-2015	
             ------------------------------------------------*/
             public function managepageDetails($action,$menuId,$functionId)
            {            
                $sql	= "CALL USP_PAGES('$action','$menuId','','','','','','','','','','0','','0','','0','0','0','0','',$functionId);";
                
                //echo $sql;exit;
                $result	= Model::executeQry($sql);           
                return $result;
            }
            
             /*------------------------------------------------
              Function to display all page meta details and title
              By : T Ketaki Debadarshini
              On : 16-Sept-2015	
             ------------------------------------------------*/
             public function viewmetaDetails($action,$menuId)
            {            
                $sql	= "CALL USP_PAGES('$action','$menuId','','','','','','','','','','0','','0','','0','0','0','0','','0');";
                
               // echo $sql;
                $result	= Model::executeQry($sql);           
                return $result;
            }
            
             /*------------------------------------------------
              Function to display total no of visitors
              By : T Ketaki Debadarshini
              On : 18-Sept-2015	
             ------------------------------------------------*/
             public function hitCounter()
            { 
                $curdate = date('Y-m-d');
                $ipAddress = $_SERVER['REMOTE_ADDR'];
                 
                $sql	= "CALL USP_HIT_COUNTER('A','$curdate','$ipAddress');";
                
               // echo $sql;
                $result	= Model::executeQry($sql); 
                $resrow = mysqli_fetch_array($result);
                 
                return $resrow[0];
            }
            
            /*************Function to manage Feedback ***********************
	 		BY :T Ketaki Debadarshini
			On	:16-Sept-2015	
            ****************************************************************/
            public function contactUs()
                {
                        $arrResult		= array();
                        $strCaptcha		= $_REQUEST["txtCaptcha"]; 
                        if($_SESSION['captcha']==$strCaptcha)
                        {	
                            $strName 		= htmlspecialchars(addslashes($_REQUEST["txtName"]), ENT_QUOTES);
                            $strEmail 		= $_REQUEST["txtEmail"];
                            $strMessage		= htmlspecialchars(addslashes($_REQUEST["txtMessage"]), ENT_QUOTES);
                          //  $strSubject		= htmlspecialchars(addslashes($_REQUEST["txtSubject"]), ENT_QUOTES);
                            $strPhone               = $_REQUEST["txtPhone"];
                            $MailMessage            = '';
                            $errMsgName		= Model::isSpclChar($strName);
                            $errMsgMail		= Model::isSpclChar($strEmail);
                            $errMsgMessage          = Model::isSpclChar($strMessage);
                            $errMsgSubject          = Model::isSpclChar($strSubject);
                            if($errMsgName>0 || $errMsgMail>0 || $errMsgMessage>0)
                            {
                                   // $msg		= "<font color='#FF0000'><strong>Error: Special Characters(<,>,',%,=) Are Not Allowed </strong></font>";
                                    $msg		= "Error: Special Characters(<,>,',%,=) Are Not Allowed ";
                                    $errFlag	= 1; 
                            }
                            if($errFlag != 1)
                            {
                                $sql		= "CALL USP_FEEDBACK('A', '0', '$strName', '$strEmail', '$strPhone', '', '$strMessage','', '0000-00-00','0000-00-00',0,@out);"; 
                               // echo $sql;
                                $result		= Model::executeQry($sql);
                                if($result)
                                {
                                    if(sendMail==Y)
                                    {
                                            $Subject	= "Feedback Details from HPSSA portal";
                                            $strTo     = portalEmail;
                                            $strFrom	= $strEmail;
                                            $MailMessage.= "Below are Feedback Details of Mr./Mrs. <strong>".$strName."</strong></br>";
                                            $MailMessage.="<div>";
                                            $MailMessage.="<strong>Name &nbsp; &nbsp; &nbsp; : </strong>";
                                            $MailMessage.=$strName."<br/>";
                                            $MailMessage.="<strong>Contact No &nbsp; &nbsp; &nbsp; : </strong>";
                                            $MailMessage.=$strPhone."<br/>";
                                            $MailMessage.="<strong>Feedback : </strong>";
                                            $MailMessage.=$strMessage;
                                            $MailMessage.="</div>";
                                            Model::Sendmail($strFrom,$strTo,$strSubject,$MailMessage);
                                    }

                                    $msg= "Thanks you for your Feedback."; 
                                    $txtName	= '';
                                    $txtEmail	= '';
                                    $txtSubject	= '';
                                    $txtMessage	= '';
                                    $txtPhone='';
                                }
                            }
                        }
                        else
                        {
                                $msg		= "The Captcha code is invalid! Please try it again";
                                $errFlag	= 1;
                        }
                        if($errFlag	== 1)
                        {
                                $txtName	= $_POST["txtName"];
                                $txtEmail	= $_POST["txtEmail"];
                                $txtSubject     = $_POST["txtSubject"];
                                $txtMessage	= $_POST["txtMessage"];
                                $txtPhone	= $_POST["txtPhone"];
                        }

                        $arrResult[]	= array('flag'=>$errFlag,'msg'=>$msg,'txtName'=>$txtName,'txtEmail'=>$txtEmail,'txtSubject'=>$txtSubject,'txtMessage'=>$txtMessage,'txtPhone'=>$txtPhone);
                        return $arrResult;

                }

}
