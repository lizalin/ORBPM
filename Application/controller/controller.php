<?php
/* ================================================
  File Name         	  : controller.php
  Description		  : This is used for manage all classes. 
  Devloped By		  : Dharashree Mohapatra
  Devloped On	          : 10-02-2021
  Update History	  :	<Updated by>		<Updated On>		<Remarks>

  ================================================== */
class Controller 
{
    public function __construct() {
        $this->invoke();
    }

    // === Function for call pages and created by T Ketaki Debadarshini on 28-Aug-2015===//
    public function invoke() 
    {
        include('../config/config.php');
        include_once("model/customModel.php");
        include_once("controller/commonClass.php");
        $page   = (isset($_REQUEST['PAGE']) && $_REQUEST['PAGE'] != '') ? $_REQUEST['PAGE'] : 'home';
        $glId	= (isset($_REQUEST['GL']) && $_REQUEST['GL']>0)?$_REQUEST['GL']:'';	
        $plId   = (isset($_REQUEST['PL']) && $_REQUEST['PL']>0)?$_REQUEST['PL']:'';	
        $dcId   = (isset($_REQUEST['ID']) && $_REQUEST['ID']>0)?$_REQUEST['ID']:''; 	

        if ($page == 'home')
        { 
             include 'view/index.php';
             //include 'sessionCheck.php';
        } 
        else if (file_exists("view/" . $page . ".php") && $page!='error') 
        {
           
             if ($page == 'viewPlugindetails') 
             {
                include_once(APP_CLASS_PATH."clsAdminLinks.php");
                $objAdmLink     = new clsAdminLinks();
                $adminPLResult  =  $objAdmLink->manageAdminPLinks('R',$plId,$glId,'','');
                $adminPLRow     = $adminPLResult->fetch_array();                            
                $vchPlName      = $adminPLRow['VCH_PL_NAME'];          
                $pageId         = $adminPLRow['PAGE_ID'];
                $intfuncId      = $adminPLRow['INT_FUNCTION_ID'];

                $pageId                     = ($pageId !='')?$pageId:0;
                $intfuncId                  = ($intfuncId !='')?$intfuncId:0;
                $_SESSION['sessPageId']     =  $pageId; 
                $_SESSION['sessFuncId']     =  $intfuncId; 
                $_SESSION['sessPageName']   =  $vchPlName; 
             }
             
            include 'sessionCheck.php';
            include('includes/header.php');
            include 'view/' . $page . '.php';
            include('includes/footer.php');
            
        } else if ($page == 'proxy') 
        {
            include_once('proxy.php');
        } 
        else 
        {        
            include_once('view/error.php');
        }
          
    }

}
?>